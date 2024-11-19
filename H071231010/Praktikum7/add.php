<?php 
session_start();
include 'config.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit;
}

$error = ""; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $prodi = $_POST['prodi'];

    // Cek apakah NIM sudah ada di database
    $checkQuery = $conn->prepare("SELECT * FROM mahasiswa WHERE nim = ?");
    $checkQuery->bind_param("s", $nim);
    $checkQuery->execute();
    $result = $checkQuery->get_result();

    if ($result->num_rows > 0) {
        // Jika NIM sudah ada, tampilkan pesan error
        $error = "Data mahasiswa dengan NIM ini sudah ada. Silakan gunakan NIM lain.";
    } else {
        // Jika NIM belum ada, lakukan proses insert
        $query = $conn->prepare("INSERT INTO mahasiswa (nama, nim, prodi) VALUES (?, ?, ?)");
        if (!$query) {
            die("Insert Query Error: " . $conn->error);
        }

        $query->bind_param("sss", $nama, $nim, $prodi);

        if ($query->execute()) {
            header("Location: index.php");
            exit;
        } else {
            $error = "Gagal menambahkan data mahasiswa. Error: " . $query->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Mahasiswa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(135deg, #e0f7fa, #80deea);
            font-family: Arial, sans-serif;
        }
        .form-container {
            background: rgba(255, 255, 255, 0.9);
            padding: 40px;
            border-radius: 10px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
        }
        .form-container h2 {
            font-size: 1.8em;
            margin-bottom: 1em;
            color: #333;
        }
        .form-control {
            background-color: #f3f3f3;
            border: none;
            border-radius: 5px;
            margin-top: 10px;
        }
        .btn-primary {
            background-color: #00acc1;
            border: none;
            width: 100%;
            font-size: 1.2em;
            margin-top: 20px;
        }
        .btn-primary:hover {
            background-color: #00838f;
        }
        .text-danger {
            color: #d9534f;
            font-size: 0.9em;
            margin-top: 15px;
        }
        .btn-secondary {
            width: 100%;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Tambah Data Mahasiswa</h2>
        <form method="POST" action="">
            <div class="mb-3">
                <input type="text" name="nama" class="form-control" placeholder="Nama" required>
            </div>
            <div class="mb-3">
                <input type="text" name="nim" class="form-control" placeholder="NIM" required>
            </div>
            <div class="mb-3">
                <input type="text" name="prodi" class="form-control" placeholder="Program Studi" required>
            </div>
            <button type="submit" class="btn btn-primary">Tambah Data</button>
            <a href="index.php" class="btn btn-secondary">Batal</a>
            <?php if (!empty($error)) echo "<p class='text-danger'>$error</p>"; ?>
        </form>
    </div>
</body>
</html>
