<?php 
include 'conn.php';
$id = $_GET['id'];

$query = "SELECT * FROM mahasiswa WHERE id = $id";
$user = $conn->query($query);

$result = $user->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Mahasiswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="max-w-xl mx-auto p-6 bg-white shadow-lg rounded-lg mt-10">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Edit Data Mahasiswa</h2>
        <form action="proses_edit.php" method="POST" class="space-y-4">
            <div>
                <label for="id" class="block text-gray-600">ID</label>
                <input type="text" name="id" value="<?= $result['id'] ?>" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-200 focus:outline-none" readonly>
            </div>
            <div>
                <label for="nama" class="block text-gray-600">Nama</label>
                <input type="text" name="nama" value="<?= $result['nama'] ?>" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-200 focus:outline-none" required>
            </div>
            <div>
                <label for="nim" class="block text-gray-600">NIM</label>
                <input type="text" name="nim" value="<?= $result['nim'] ?>" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-200 focus:outline-none" required>
            </div>
            <div>
                <label for="prodi" class="block text-gray-600">Program Studi</label>
                <input type="text" name="prodi" value="<?= $result['prodi'] ?>" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-200 focus:outline-none" required>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Edit</button>
        </form>
    </div>
</body>
</html>
