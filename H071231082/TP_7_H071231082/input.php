<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>

<?php
include 'conn.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $nama = trim($_POST['nama']);
    $nim = trim($_POST['nim']);
    $prodi = trim($_POST['prodi']);
    $pass = trim($_POST['password']);
    
    // Check for empty fields
    if(empty($nama) || empty($nim) || empty($prodi) || empty($pass)) {
        echo "<p>All fields are required.</p>";
    } else {
        // Hash password
        $hashed_password = password_hash($pass, PASSWORD_BCRYPT);

        // Prepare and execute the SQL query
        $in = $conn->prepare("INSERT INTO mahasiswa (nama, nim, prodi, pass) VALUES (?, ?, ?, ?)");
        if($in === false) {
            die("Error preparing the SQL statement: " . $conn->error);
        }
        
        $in->bind_param("ssss", $nama, $nim, $prodi, $hashed_password);
        
        if ($in->execute()) {
            header("Location: home.php");
            exit;
        } else {
            echo "Error: " . $in->error;
        }

        $in->close();
        $conn->close();
    }
}
?>

<div class="loginContainer">
    <h2>Registration</h2>
    <form action="input.php" method="POST">
        <div class="formGroup">
            <input type="text" name="nama" placeholder="Nama" required />
        </div>
        <div class="formGroup">
            <input type="text" name="nim" placeholder="NIM" required />
        </div>
        <div class="formGroup">
            <input type="text" name="prodi" placeholder="Program Studi" required />
        </div>
        <div class="formGroup">
            <input type="password" name="password" placeholder="Password" required />
        </div>
        <div class="loginButtonDiv">
            <button type="submit">Submit</button>
        </div>
    </form>
</div>

</body>
</html>
