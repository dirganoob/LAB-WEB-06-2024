<?php
include 'connect.php';

$pesanRegister = ""; 

if ($_SERVER['REQUEST_METHOD'] == "POST"){
    $username = $_POST['username'];
    $password = password_hash($_POST['pass'], PASSWORD_DEFAULT);
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $prodi = $_POST['prodi'];


    $cekUser = $conn->prepare("SELECT username FROM users WHERE username = ?");
    $cekUser->bind_param("s", $username);
    $cekUser->execute();
    $cekUser->store_result();


    if ($cekUser->num_rows > 0) {
        $pesanRegister = "Username Sudah Ada, Silahkan Gunakan Username Lain.";
    } else {
        $sql = $conn->prepare("INSERT INTO users (username, pass, nama, nim, prodi) values(?,?,?,?,?)");
        $sql->bind_param("sssss", $username, $password, $nama, $nim, $prodi);

        if($sql->execute()){
            $pesanRegister = "Akun Berhasil Dibuat... Silahkan Login!";
        } else {
            $pesanRegister = "Error: " . $sql->error;
        }

        $sql->close();
    }

    $cekUser->close();
    $conn->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://fonts.googleapis.com/css2?family=El+Messiri&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="sparkles"></div>
    <img src="img2.svg" alt="">
    <div class="formulir">
        <div class="wipe-in">
            <h1>Register</h1>
        </div>

        <form id="register" action="register.php" method="POST">
            <br>
            <label for="username">Username</label><br>
            <input type="text" id="username" name="username" placeholder="Masukkan Username Anda" required>
            
            <label for="pass">Password</label><br>
            <input type="password" id="pass" name="pass" placeholder="Masukkan Password Anda" required>
            
            <label for="nama">Nama</label><br>
            <input type="text" id="nama" name="nama" placeholder="Masukkan Nama Anda" required>
            
            <label for="nim">NIM</label><br>
            <input type="text" id="nim" name="nim" placeholder="Masukkan NIM Anda" required>
            
            <label for="prodi">Program Studi</label><br>
            <input type="text" id="prodi" name="prodi" placeholder="Masukkan Prodi Anda" required>

            <i><?= $pesanRegister ?></i>
            
            <button type="submit" name="regis" class="button">Buat Akun</button>
            <a href="login.php" class="backHome"><i class="ph-fill ph-house-line"></i>Back Home</a>
        </form>


        
        <script src="scriptLogin.js"></script>
    </div>
</body>
</html>
