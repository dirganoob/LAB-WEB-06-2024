<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password']; 
    $role = $_POST['role'];

     // Cek apakah username sudah ada
     $checkQuery = $conn->prepare("SELECT * FROM users WHERE username = ?");
     $checkQuery->bind_param("s", $username);
     $checkQuery->execute();
     $result = $checkQuery->get_result();
 
     if ($result->num_rows > 0) {
         $error = "Username sudah terdaftar. Silakan gunakan username lain.";
     } else {
         // Lanjutkan proses registrasi jika username belum ada
         $query = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
         $query->bind_param("sss", $username, $password, $role);
 
         if ($query->execute()) {
             header("Location: login.php");
             exit();
         } else {
             $error = "Registrasi gagal, coba lagi!";
         }
     }
 }
 ?>
 

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register</title>
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
        .register-container {
            background: rgba(255, 255, 255, 0.9);
            padding: 40px;
            border-radius: 10px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
        }
        .register-container h2 {
            font-size: 1.8em;
            margin-bottom: 1em;
            color: #333;
        }
        .form-control {
            background-color: #f3f3f3;
            border: none;
            border-radius: 5px;
        }
        .btn-primary {
            background-color: #00acc1;
            border: none;
            width: 100%;
            font-size: 1.2em;
            margin-top: 1em;
        }
        .btn-primary:hover {
            background-color: #00838f;
        }
        .back-to-login {
            font-size: 0.9em;
            color: #555;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <img src="https://img.icons8.com/ios-filled/100/00acc1/user.png" alt="User Icon" />
        <h2>Register</h2>
        <form method="POST" action="">
            <div class="mb-3">
                <input type="text" name="username" placeholder="Username" required class="form-control">
            </div>
            <div class="mb-3">
                <input type="password" name="password" placeholder="Password" required class="form-control">
            </div>
            <div class="mb-3">
                <select name="role" class="form-control" placeholder="Role">
                    <option value="admin">Admin</option>
                    <option value="mahasiswa">Mahasiswa</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
            <p class="back-to-login mt-3">Already have an account? <a href="login.php">LOGIN HERE</a></p>
        </form>
        <?php if (isset($error)) echo "<p class='text-danger'>$error</p>"; ?>
    </div>
</body>
</html> 