<?php
session_start();
include 'config/config.php';

$success = "";
$error = "";

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_role = $_SESSION['role']; 

// Fungsi untuk menambah mahasiswa
if (isset($_POST['add']) && $user_role === 'admin') {
    $nama = mysqli_real_escape_string($conn, $_POST['name']);
    $nim = mysqli_real_escape_string($conn, $_POST['nim']);
    $prodi = mysqli_real_escape_string($conn, $_POST['studyProgram']);
    $faculty = mysqli_real_escape_string($conn, $_POST['faculty']);
    
    // Cek apakah NIM sudah ada
    $cekNimQuery = "SELECT * FROM students WHERE nim = '$nim'";
    $cekNimResult = mysqli_query($conn, $cekNimQuery);
    
    if (mysqli_num_rows($cekNimResult) > 0) {
        $error = "NIM sudah terdaftar. Gunakan NIM lain.";
    } else {
        // Query untuk menambah mahasiswa
        $query = "INSERT INTO students (`name`, nim, studyProgram, faculty) VALUES ('$nama', '$nim', '$prodi', '$faculty')";
        if (mysqli_query($conn, $query)) {
            $success = "Berhasil menambah data mahasiswa.";
        } else {
            $error = "Gagal menambah data mahasiswa: " . mysqli_error($conn);
        }
    }
}

// Fungsi untuk mengedit mahasiswa
if (isset($_POST['edit']) && $user_role === 'admin') {
    $id = (int)$_POST['id'];
    $nama = mysqli_real_escape_string($conn, $_POST['name']);
    $nim = mysqli_real_escape_string($conn, $_POST['nim']);
    $prodi = mysqli_real_escape_string($conn, $_POST['studyProgram']);
    $faculty = mysqli_real_escape_string($conn, $_POST['faculty']);
    
    // Cek apakah NIM sudah ada pada mahasiswa lain
    $cekNimQuery = "SELECT * FROM students WHERE nim = '$nim' AND id != $id";
    $cekNimResult = mysqli_query($conn, $cekNimQuery);
    
    if (mysqli_num_rows($cekNimResult) > 0) {
        $error = "NIM sudah terdaftar pada mahasiswa lain. Gunakan NIM lain.";
    } else {
        // Query untuk mengupdate mahasiswa
        $query = "UPDATE students SET `name`='$nama', nim='$nim', studyProgram='$prodi', faculty='$faculty' WHERE id=$id";
        if (mysqli_query($conn, $query)) {
            $success = "Berhasil mengupdate data mahasiswa.";
        } else {
            $error = "Gagal mengupdate data mahasiswa: " . mysqli_error($conn);
        }
    }
}


// Fungsi untuk menghapus mahasiswa
if (isset($_GET['action']) && $_GET['action'] == 'delete' && $user_role === 'admin') {
    $id = (int)$_GET['id']; // Validasi id sebagai integer
    $query = "DELETE FROM students WHERE id=$id";
    if (mysqli_query($conn, $query)) {
        $success = "Berhasil menghapus data mahasiswa.";
    } else {
        $error = "Gagal menghapus data mahasiswa: " . mysqli_error($conn);
    }
}

// Mengambil data mahasiswa
$query = "SELECT * FROM students";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.6.3/dist/flowbite.min.css" />
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-image: url(images/bg.jpeg);
            background-size: cover;
        }
        .hero-section {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 40px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 20px auto;
            max-width: 1200px;
            height: 510px;
        }

        .content {
            max-width: 50%;
        }

        .content h1 {
            font-size: 2.5em;
            color: #333;
            margin-bottom: 10px;
            font-weight: 700;
            color:#FA4A70
        }

        .content p {
            font-size: 1.2em;
            color: #666;
            margin-bottom: 20px;
        }

        .hero-btn {
            background-color: #FA4A70;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .hero-btn:hover {
            background-color: #e24466;
        }

        .image img {
            width: 300px;
            height: auto;
            border-radius: 8px;
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">

    <!-- Hero Section -->
    <div class="w-full max-w-5xl mx-auto p-4">
        <?php if ($user_role === 'admin'): ?>
        <div class="hero-section">
            <div class="content">
                <h1>Hello, admin!</h1>
                <p>Welcome to the Student Admin Portal!</p>
                <p>Our system is designed to make it easier for you to manage student information. </p>
                <button data-modal-target="tambahModal" data-modal-toggle="tambahModal" class="hero-btn mt-4">
                    Tambah Data
                </button>
            </div>
            <div class="image">
                <img src="images/admin.png" alt="Illustration of admin">
            </div>
        </div>
        <?php endif; ?>
    </div>

    <div class="w-full max-w-5xl mx-auto p-4">
        <!-- Menampilkan success message -->
        <?php if ($success): ?>
            <div id="successModal" class="fixed inset-0 flex items-center justify-center z-50">
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span class="text-green-600"><?php echo $success; ?></span>
                    </div>
                </div>
            </div>
            <script>
                setTimeout(function() {
                    document.getElementById('successModal').style.display = 'none';
                    window.location.href = 'index.php';
                }, 2000);
            </script>
        <?php endif; ?>

        <!-- Menampilkan error message -->
        <?php if ($error): ?>
            <div id="errorModal" class="fixed inset-0 flex items-center justify-center z-50">
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        <span class="text-red-600"><?php echo $error; ?></span>
                    </div>
                </div>
            </div>
            <script>
                setTimeout(function() {
                    document.getElementById('errorModal').style.display = 'none';
                    window.location.href = 'index.php';
                }, 2000);
            </script>
        <?php endif; ?>

        <div class="bg-white shadow-md rounded-lg p-6">
            <div class="flex justify-between items-center">
                <h2 class="text-xl font-bold">Data Mahasiswa</h2>
            </div>

            <!-- Table data mahasiswa -->
            <table class="w-full table-auto border-collapse border border-gray-300 mt-4">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border px-4 py-2 text-start">No</th>
                        <th class="border px-4 py-2 text-start">Nama</th>
                        <th class="border px-4 py-2 text-start">NIM</th>
                        <th class="border px-4 py-2 text-start">Program Studi</th>
                        <th class="border px-4 py-2 text-start">Fakultas</th>
                        <?php if ($user_role === 'admin'): ?> 
                            <th class="border px-4 py-2 text-start">Aksi</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $number = 1;
                    while ($data = mysqli_fetch_assoc($result)) { ?> <!-- Mengambil satu baris hasil query dari database-->
                        <tr class="odd:bg-white even:bg-gray-100">
                            <td class="border px-4 py-2"><?= $number++ ?></td>
                            <td class="border px-4 py-2"><?= htmlspecialchars($data['name']) ?></td>
                            <td class="border px-4 py-2"><?= htmlspecialchars($data['nim']) ?></td>
                            <td class="border px-4 py-2"><?= htmlspecialchars($data['studyProgram']) ?></td>
                            <td class="border px-4 py-2"><?= htmlspecialchars($data['faculty']) ?></td>
                            <?php if ($user_role === 'admin'): ?> <!-- Tampilkan kolom "Aksi" hanya untuk admin -->
                                <td class="border px-4 py-2">
                                    <button data-modal-target="editModal<?= $data['id'] ?>" data-modal-toggle="editModal<?= $data['id'] ?>" style="background-color: #FA4A70; color: white; padding: 0.25rem 0.75rem; border-radius: 0.375rem;">
                                        Edit
                                    </button>
                                    <button onclick="showDeleteModal(<?= $data['id'] ?>)" class="bg-red-700 hover:bg-red-800 text-white px-3 py-1 rounded">Hapus</button>
                                </td>
                            <?php endif; ?>
                        </tr>
                        <!-- Modal Edit -->
                        <div id="editModal<?= $data['id'] ?>" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden backdrop-blur-sm fixed top-0 right-0 left-0 z-50 w-full h-modal h-full">
                            <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                                <div class="bg-white rounded-lg shadow">
                                    <div class="p-6">
                                        <h3 class="text-lg font-bold text-gray-900">Edit Data Mahasiswa</h3>
                                        <form method="post" action="index.php">
                                            <input type="hidden" name="id" value="<?= $data['id'] ?>">
                                            <div class="mt-4">
                                                <label class="block text-gray-700">Nama:</label>
                                                <input type="text" name="name" value="<?= htmlspecialchars($data['name']) ?>" required class="border border-gray-300 p-2 rounded w-full">
                                            </div>
                                            <div class="mt-4">
                                                <label class="block text-gray-700">NIM:</label>
                                                <input type="text" name="nim" value="<?= htmlspecialchars($data['nim']) ?>" required class="border border-gray-300 p-2 rounded w-full">
                                            </div>
                                            <div class="mt-4">
                                                <label class="block text-gray-700">Program Studi:</label>
                                                <input type="text" name="studyProgram" value="<?= htmlspecialchars($data['studyProgram']) ?>" required class="border border-gray-300 p-2 rounded w-full">
                                            </div>
                                            <div class="mt-4">
                                                <label class="block text-gray-700">Fakultas:</label>
                                                <input type="text" name="faculty" value="<?= htmlspecialchars($data['faculty']) ?>" required class="border border-gray-300 p-2 rounded w-full">
                                            </div>
                                            <button type="submit" name="edit" class="bg-pink-600 text-white font-bold py-2 px-4 rounded mt-4">Simpan Perubahan</button>
                                            <button type="button" class="mt-2 bg-gray-400 hover:bg-gray-500 text-white font-bold py-2 px-4 rounded" data-modal-hide="editModal<?= $data['id'] ?>">Batal</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </tbody>
            </table>
            <!-- Tombol Logout di bawah tabel -->
            <div class="flex justify-start mt-4">
                <a href="login.php" class="bg-red-700 text-white px-4 py-2 rounded">Logout</a>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Data -->
    <div id="tambahModal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden backdrop-blur-sm fixed top-0 right-0 left-0 z-50 w-full h-modal h-full">
        <div class="relative p-4 w-full max-w-md h-full md:h-auto">
            <div class="bg-white rounded-lg shadow">
                <div class="p-6">
                    <h3 class="text-lg font-bold text-gray-900">Tambah Data Mahasiswa</h3>
                    <form method="post" action="index.php">
                        <div class="mt-4">
                            <label class="block text-gray-700">Nama:</label>
                            <input type="text" name="name" required class="border border-gray-300 p-2 rounded w-full">
                        </div>
                        <div class="mt-4">
                            <label class="block text-gray-700">NIM:</label>
                            <input type="text" name="nim" required class="border border-gray-300 p-2 rounded w-full">
                        </div>
                        <div class="mt-4">
                            <label class="block text-gray-700">Program Studi:</label>
                            <input type="text" name="studyProgram" required class="border border-gray-300 p-2 rounded w-full">
                        </div>
                        <div class="mt-4">
                            <label class="block text-gray-700">Fakultas:</label>
                            <input type="text" name="faculty" required class="border border-gray-300 p-2 rounded w-full">
                        </div>
                        <button type="submit" name="add" class="bg-pink-600 text-white font-bold py-2 px-4 rounded mt-4">Tambah Data</button>
                        <button type="button" class="mt-2 bg-gray-400 hover:bg-gray-500 text-white font-bold py-2 px-4 rounded" data-modal-hide="tambahModal">Batal</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi Hapus -->
    <div id="deleteModal" tabindex="-1" class="hidden fixed inset-0 flex items-center justify-center z-50 backdrop-blur-sm bg-black bg-opacity-50">
        <div class="bg-white rounded-lg shadow">
            <div class="p-6">
                <h3 class="text-lg font-bold text-gray-900">Konfirmasi Hapus</h3>
                <p class="mt-4">Apakah Anda yakin ingin menghapus data mahasiswa ini?</p>
                <div class="flex justify-end mt-4">
                    <button id="cancelDelete" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md">Batal</button>
                    <button id="confirmDelete" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md ml-2">Hapus</button>
                </div>
            </div>
        </div>
    </div>

    <!-- NIM modal -->
    <?php if ($error == "NIM sudah terdaftar. Gunakan NIM lain." || $error == "NIM sudah terdaftar pada mahasiswa lain. Gunakan NIM lain."): ?>
        <div id="nimErrorModal" class="fixed inset-0 flex items-center justify-center z-50">
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    <span class="text-red-600"><?php echo $error; ?></span>
                </div>
            </div>
        </div>
        <script>
            setTimeout(function() {
                document.getElementById('nimErrorModal').style.display = 'none';
            }, 2000);
        </script>
    <?php endif; ?>
    
    <script src="https://unpkg.com/flowbite@1.6.3/dist/flowbite.js"></script>
    <script>
        function showDeleteModal(id) {
            document.getElementById('deleteModal').classList.remove('hidden');
            document.getElementById('confirmDelete').setAttribute('data-id', id);
        }

        document.getElementById('cancelDelete').addEventListener('click', function() {
            document.getElementById('deleteModal').classList.add('hidden');
        });

        document.getElementById('confirmDelete').addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            window.location.href = 'index.php?action=delete&id=' + id;
        });
    </script>

</body>

</html>
