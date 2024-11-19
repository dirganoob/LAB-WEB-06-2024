<?php
    include 'connect.php';

    $id = $_GET['id'];
    $query = "SELECT * FROM users WHERE id = $id";
    $user = $conn->query($query);

    $data = $user->fetch_assoc();


    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $nama = $_POST['nama'];
        $nim = $_POST['nim'];
        $prodi = $_POST['prodi'];
        $id = $_POST['id'];
    
    
        $query = $conn->prepare("UPDATE users SET nama = ?, nim = ?, prodi = ? WHERE id = ?");
        $query->bind_param("sssi", $nama, $nim, $prodi, $id);
    
    
        if($query->execute()){
            header('Location: dashboard.php');
        } else {
            echo "Error: " . $query->error;
        }
    }
    $conn->close();

?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data</title>
    <link href="https://fonts.googleapis.com/css2?family=El+Messiri&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="formulir">
        <div class="wipe-in">
            <h1>Edit Data</h1>
        </div>

        <form id="register" method="POST">
            <br>
            <label for="id">Id</label><br>
            <input type="text" name="id" value="<?= $data['id']?>" readonly>
            
            <label for="nama">Nama</label><br>
            <input type="text" name="nama" value="<?= $data['nama']?>">
            
            <label for="nim">NIM</label><br>
            <input type="text" name="nim" value="<?= $data['nim']?>">
            
            <label for="prodi">Program Studi</label><br>
            <input type="text" name="prodi" value="<?= $data['prodi']?>">


            
            <button type="submit" name="regis">Perbarui Data</button>
            <a href="dashboard.php" class="backHome"><i class="ph-fill ph-house-line"></i>Back to Dashboard</a>
        </form>

    </div>
</body>
</html>