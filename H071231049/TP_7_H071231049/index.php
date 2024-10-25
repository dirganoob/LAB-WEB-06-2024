<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}

$users = [ 
    [
        'email' => 'admin@gmail.com',
        'username' => 'admin',
        'name' => 'Admin',
        'password' => password_hash('admin123', PASSWORD_DEFAULT),
    ],
    [
        'email' => 'user@gmail.com',
        'username' => 'user',
        'name' => 'User',
        'password' => password_hash('user123', PASSWORD_DEFAULT),
    ],
];

$currentUser = $_SESSION['user'];

$currentUserData = null;
foreach ($users as $user) {
    if ($user['username'] === $currentUser['username']) {
        $currentUserData = $user;
        break;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="max-w-4xl mx-auto p-6 bg-white shadow-lg rounded-lg mt-10">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4 text-center">Halo, Kamu Login Sebagai <?= htmlspecialchars($currentUser['name']) ?> </h2>
        
        <?php if ($currentUser['username'] === 'admin'): ?>
        <h3 class="text-xl font-semibold text-gray-700 mb-4">Input Mahasiswa</h3>
        <form action="proses_input.php" method="POST" class="space-y-4">
            <div>
                <label for="nama" class="block text-gray-600">Nama</label>
                <input type="text" name="nama" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-200 focus:outline-none" required>
            </div>
            <div>
                <label for="nim" class="block text-gray-600">NIM</label>
                <input type="text" name="nim" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-200 focus:outline-none" required>
            </div>
            <div>
                <label for="prodi" class="block text-gray-600">Program Studi</label>
                <input type="text" name="prodi" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-200 focus:outline-none" required>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Tambah</button>
        </form>

        <h3 class="text-xl font-semibold text-gray-700 mt-8">Daftar Mahasiswa</h3>
        <table class="min-w-full bg-white border border-gray-300 mt-4">
            <thead>
                <tr>
                    <th class="border px-4 py-2">Nama</th>
                    <th class="border px-4 py-2">NIM</th>
                    <th class="border px-4 py-2">Prodi</th>
                    <th class="border px-4 py-2">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php 
            include 'conn.php';

            $query = 'SELECT * FROM mahasiswa';
            $user = $conn->query($query);

            while ($row = $user->fetch_assoc()) {
                $nama = $row['nama'];
                $nim = $row['nim'];
                $prodi = $row['prodi'];
                $id = $row['id'];
            ?>
                <tr class="text-center">
                    <td class="border px-4 py-2"><?= $nama ?></td>
                    <td class="border px-4 py-2"><?= $nim ?></td>
                    <td class="border px-4 py-2"><?= $prodi ?></td>
                    <td class="border px-4 py-2">
                        <a href="edit.php?id=<?= $id ?>" class="text-blue-500 hover:underline">Edit</a>
                        <a href="proses_hapus.php?id=<?= $id ?>" class="text-red-500 hover:underline ml-2">Hapus</a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <?php else: ?>
        <h3 class="text-xl font-semibold text-gray-700 mb-4">Daftar Mahasiswa</h3>
        <table class="min-w-full bg-white border border-gray-300 mt-4">
            <thead>
                <tr>
                    <th class="border px-4 py-2">Nama</th>
                    <th class="border px-4 py-2">NIM</th>
                    <th class="border px-4 py-2">Prodi</th>
                </tr>
            </thead>
            <tbody>
            <?php 
            include 'conn.php';

            $query = 'SELECT * FROM mahasiswa';
            $user = $conn->query($query);

            while ($row = $user->fetch_assoc()) {
                $nama = $row['nama'];
                $nim = $row['nim'];
                $prodi = $row['prodi'];
            ?>
                <tr class="text-center">
                    <td class="border px-4 py-2"><?= $nama ?></td>
                    <td class="border px-4 py-2"><?= $nim ?></td>
                    <td class="border px-4 py-2"><?= $prodi ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <?php endif; ?>

        <a href="logout.php" class="block text-center text-red-500 hover:underline mt-6">Logout</a>
    </div>
</body>
</html>