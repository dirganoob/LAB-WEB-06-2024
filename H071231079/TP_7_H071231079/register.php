<?php
session_start();
include 'config/config.php'; // include your database connection

// Step 1
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['step1'])) {
    $_SESSION['nim'] = $_POST['nim'];
    $_SESSION['name'] = $_POST['name'];
    $_SESSION['studyProgram'] = $_POST['prodi'];
    $_SESSION['faculty'] = $_POST['fakultas'];

    header('Location: register.php?step=2');
    exit;
}

// Step 2
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['step2'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Encrypt the password
    $role = 'user'; // user itu role defaultnya

    $nim = $_SESSION['nim'];
    $name = $_SESSION['name'];
    $studyProgram = $_SESSION['studyProgram'];
    $faculty = $_SESSION['faculty'];

    $studentQuery = "INSERT INTO students (nim, name, studyProgram, faculty) VALUES ('$nim', '$name', '$studyProgram', '$faculty')";
    
    if (mysqli_query($conn, $studentQuery)) {
        $studentId = mysqli_insert_id($conn);

        $userQuery = "INSERT INTO users (id, username, password, role) VALUES ('$studentId', '$username', '$password', '$role')";
        
        if (mysqli_query($conn, $userQuery)) {
            session_destroy();
            header('Location: login.php');
            exit;
        } else {
            $error = "Pendaftaran gagal pada tahap penyimpanan pengguna: " . mysqli_error($conn);
        }
    } else {
        $error = "Pendaftaran gagal pada tahap penyimpanan mahasiswa: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Pengguna</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-image: url(images/bg.jpeg);
            background-size: cover;
        }

        .register-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #fff;
            padding: 20px;
            width: 70%;
            height: 70%;
            border-radius: 10px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
        }

        .register-image {
            width: 50%;
            padding-right: 30px;
        }

        .register-image img {
            max-width: 80%;
            justify-content: center;
            align-items: center;
            margin-left: 50px;
        }

        @keyframes slideUp {
            0% {
                transform: translateX(100px);
                opacity: 0;
            }
            100% {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .register-form {
            width: 40%;
            margin-left: 50px;
            display: flex;
            flex-direction: column;
            gap: 0px;
            margin-top: 0px;
            animation: slideUp 1s ease-out;
        }

        .register-form h1 {
            font-size: 2rem;
            font-weight: 500;
            margin-bottom: 0px;
            color: #FA4A70;
        }

        .register-form .error-message {
            color: red;
            font-size: 0.9rem;
            margin-bottom: 15px;
        }

        .register-form form {
            display: flex;
            flex-direction: column;
        }

        .register-form input {
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 1rem;
        }

        .register-form button {
            padding: 10px;
            background-color: #FA4A70;
            color: white;
            font-size: 1rem;
            font-weight: 600;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            margin-top: 0px;
            margin-bottom: 1rem;
        }

        .register-form .login-link {
            text-align: center;
        }

        .register-form .login-link a {
            color: #FA4A70;
            text-decoration: none;
        }

        .step-info {
            margin: 10px 0;
            font-weight: 500;
            color: #FA4A70;
        }

        .divider {
            border-top: 1px solid #FA4A70;
            margin: 10px 0;
        }
    </style>
</head>
<body>

<div class="register-container">
    
    <!-- Registration Form Section -->
    <div class="register-form">
        <h1><?php echo isset($_GET['step']) && $_GET['step'] == 2 ? 'Complete Your Registration' : 'Register Your Account'; ?></h1>
        
        <!-- Step 1 -->
        <?php if (!isset($_GET['step']) || $_GET['step'] == 1): ?>
            <div class="step-info">Step 1: Fill in your basic information</div>
            <form action="" method="POST">
                <input type="text" name="name" placeholder="Nama" required>
                <input type="text" name="nim" placeholder="NIM" required>
                <input type="text" name="prodi" placeholder="Prodi" required>
                <input type="text" name="fakultas" placeholder="Fakultas" required>
                <button type="submit" name="step1">Next</button>
            </form>
            <div class="login-link">
                    Already have an account? <a href="login.php">Login</a>
            </div>
            <?php endif; ?>
            
            <!-- Step 2 -->
            <?php if (isset($_GET['step']) && $_GET['step'] == 2): ?>
                <div class="step-info">Step 2: Fill in your user credentials</div>
                <form action="" method="POST">
                    <input type="text" name="username" placeholder="Username" required>
                    <input type="password" name="password" placeholder="Password" required>
                <input type="password" name="confirm_password" placeholder="Konfirmasi Password" required>
                
                <!-- Error message -->
                <?php if (!empty($error)): ?>
                    <div class="error-message"><?php echo $error; ?></div>
                    <?php endif; ?>
                    
                    <button type="submit" name="step2">Register</button>
                </form>
                <div class="login-link">
                    Already have an account? <a href="login.php">Login</a>
                </div>
                <?php endif; ?>
            </div>
            <!-- Image Section -->
            <div class="register-image">
                <img src="images/login.png" alt="Register Illustration">
            </div>
        </div>
    </body>
</html>
