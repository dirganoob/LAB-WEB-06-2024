<?php
session_start();

include 'connect.php';

// Memeriksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

// Ambil data pengguna dari session
$username_session = $_SESSION['username'];



// Query untuk mendapatkan data pengguna yang sedang login
$query = "SELECT * FROM users WHERE username = ?";
$sql = $conn->prepare($query);
$sql->bind_param("s", $username_session);
$sql->execute();
$data = $sql->get_result();

// Mengambil data pengguna
if ($data->num_rows > 0) {
    $cetak = $data->fetch_assoc();
    $username = $cetak['username'];
    $nama = $cetak['nama'];
    $nim = $cetak['nim'];
    $prodi = $cetak['prodi'];
} else {
    echo "Data pengguna tidak ditemukan.";
    exit;
}

$is_admin = ($username === 'adminku');
if ($is_admin) {
    $allUsersQuery = "SELECT * FROM users";
    $dataAll= $conn->query($allUsersQuery);
}

if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: login.php');
    exit;
}


//pencarian
$pesanCari = "";
$search = '';
$query = "SELECT * FROM users";  // Query default

if (isset($_GET['search'])) {
    $search = $_GET['search'];
    if (!empty($search)) {
        $query = "SELECT * FROM users WHERE nama LIKE '%$search%' OR nim LIKE '%$search%' OR prodi LIKE '%$search%'";
        $result = $conn->query($query);

        if ($result->num_rows === 0) {
            $pesanCari = "Data Tidak Ditemukan";
        }
    } else {
        $pesanCari = "Masukkan kata kunci untuk mencari data.";
    }
} else {
    $result = $conn->query($query);
}

function highlight($text, $search) {
    if ($search != '') {
        return str_ireplace($search, '<mark>' . $search . '</mark>', $text);
    }
    return $text;
}

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=El+Messiri&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link rel="stylesheet" href="dash.css">
</head>
<body>
<div class="sparkles"></div>
    <div class="head">
        <div class="welcome">
            <img src="helo.svg" alt="">
            <h1>Selamat Datang,</h1>
            <marquee direction="down"  scrollamount="3"><h1><?= $nama ?></h1> </marquee>
        </div>
        <p><a href="?logout">Logout</a></p>
    </div>

    <?php if (!$is_admin){ ?>
        <div class="container">
            <div class="kiri">
                <div class="data">
                    <p class="label">Nama</p>
                    <p class="pembatas">|</p>
                    <p><?= $nama ?></p>       
                </div>
                <div class="data">
                    <p class="label">NIM</p>
                    <p class="pembatas">|</p>
                    <p><?= $nim ?></p>       
                </div>
                <div class="data">
                    <p class="label">Program Studi</p>
                    <p class="pembatas">|</p>
                    <p><?= $prodi ?></p>       
                </div>
            </div>
            <div class="kanan">
                <div class="data">
                    <p class="label">Username</p>
                    <p class="pembatas">|</p>
                    <p><?= $username ?></p>       
                </div>  
            </div>
        </div>

    <?php } else { ?>

        <div class="cariCover">
            <form method="GET" class="cari">
                <i class="ph-bold ph-magnifying-glass" id="iconCari"></i>
                <input type="text" name="search" placeholder="Cari Nama/NIM/Prodi" value="<?= $search ?>">
                <button type="submit">Cari</button>
            </form>
            <i class="pesanCari"><?= $pesanCari ?></i>
        </div>


        <div class="all">
        <h1>All Users</h1>
        <table border="5" class="tabel">
            <tr>
                <th>Id</th>
                <th>Nama</th>
                <th>Username</th>
                <th>NIM</th>
                <th>Program Studi</th>
                <th>Ubah Data User</th>
                <!-- <th>Hapus</th> -->
            </tr>
            <?php foreach ($dataAll as $cetak) { 
                if ($cetak['username'] === 'adminku') continue; ?>
            <tr>
                <td><?= highlight($cetak['id'], $search) ?></td>
                <td><?= highlight($cetak['nama'], $search)  ?></td>
                <td><?= highlight($cetak['username'], $search) ?></td>
                <td><?= highlight($cetak['nim'], $search) ?></td>
                <td><?= highlight($cetak['prodi'], $search) ?></td>
                <td><a href="edit.php?id=<?= $cetak['id'] ?>">Edit</a> &nbsp || &nbsp <a href="prosesHapus.php?id=<?= $cetak['id'] ?>">Hapus</a></td>
            </tr>
            <?php }; ?>
        </table>
    </div>
    <br>
    <?php } ?>



    <!-- <script src="scriptLogin.js"></script> -->
</body>
</html>