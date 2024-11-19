<?php
session_start();
include 'conn.php';

$error_message = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $nim = trim($_POST['nim']);
    $password = trim($_POST['pass']);
    
    if (empty($nim) || empty($password)) {
        $error_message = "NIM and Password are required.";
    } else {
        $stmt = $conn->prepare("SELECT nim, pass, nama FROM mahasiswa WHERE nim = ?");
        $stmt->bind_param("s", $nim);
        
        if ($stmt->execute()) {
            $stmt->store_result();
            
            if ($stmt->num_rows == 1) {
                $stmt->bind_result($db_nim, $db_password, $nama);
                $stmt->fetch();
                
                if (password_verify($password, $db_password)) {
                    $_SESSION['nim'] = $db_nim;
                    $_SESSION['nama'] = $nama;
                    header("Location: home.php");
                    exit;
                } else {
                    $error_message = "Incorrect password.";
                }
            } else {
                $error_message = "NIM not found.";
            }
        } else {
            $error_message = "Error executing query: " . $stmt->error;
        }
        
        $stmt->close();
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>Login</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
<div class="loginContainer">
    <h2>Login</h2>

    <!-- Display error message if login fails -->
    <?php if (!empty($error_message)): ?>
        <div class="error"><?= htmlspecialchars($error_message); ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="formGroup">
            <input type="text" name="nim" placeholder="NIM" required />
        </div>
        <div class="formGroup">
            <input type="password" name="pass" placeholder="Password" required />
        </div>
        <div class="loginButtonDiv">
            <button type="submit">Login</button>
            <button type="button" class="registerButton" onclick="window.location.href='input.php'">Registration</button>
        </div>
    </form>
</div>

</div>
</body>
</html>
