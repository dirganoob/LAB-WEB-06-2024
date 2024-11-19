<?php
session_start();
include 'config/config.php';

$admin_username = 'admin';
$admin_password_hashed = password_hash('admin123', PASSWORD_DEFAULT);

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($username === $admin_username && password_verify($password, $admin_password_hashed)) {
        $_SESSION['user_id'] = 1; // Admin user ID
        $_SESSION['username'] = $admin_username;
        $_SESSION['role'] = 'admin';

        header('Location: index.php');
        exit;
    }

    if ($user) {
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            header('Location: index.php');
            exit;
        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "Pengguna tidak ditemukan, silahkan register terlebih dahulu!";
    }

    if (!empty($error)) {
        header("Refresh:3");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Design</title>
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

        .login-container {
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

        .login-image {
            width: 50%;
            padding-right: 30px;
        }

        .login-image img {
            max-width: 80%;
            justify-content: center;
            align-items: center;
            margin-left: 50px;
        }


        .login-form {
            width: 40%;
            margin-right: 50px;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .login-form h1 {
            font-size: 2rem;
            font-weight: 600;
            margin-bottom: 10px;
            color: #FA4A70;
        }

        .login-form .error-message {
            color: red;
            font-size: 0.9rem;
            margin-bottom: 15px;
        }

        .login-form form {
            display: flex;
            flex-direction: column;
        }

        .login-form input {
            padding: 12px;
            margin-bottom: 15px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 1rem;
        }

        .login-form button {
            padding: 12px;
            background-color: #FA4A70;
            color: white;
            font-size: 1rem;
            font-weight: 600;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            margin-top: 1rem;
            margin-bottom: 1rem;
        }

        .login-form .register-link {
            text-align: center;
        }

        .login-form .register-link a {
            color: #FA4A70;
            text-decoration: none;
        }

        .error-message {
            color: #FA4A70;
            justify-content: center;
        }
    </style>
</head>
<body>

<div class="login-container">
    <!-- Image Section -->
    <div class="login-image">
        <img src="images/login.png" alt="Login Illustration">
    </div>

    <!-- Login Form Section -->
    <div class="login-form">
        <h1>Welcome back!</h1>

        <!-- Login Form -->
        <form action="" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>

            <!-- Error message -->
            <?php if (!empty($error)): ?>
                <div class="error-message"><?php echo $error; ?></div>
            <?php endif; ?>

            <button type="submit">Login</button>
        </form>

        <div class="register-link">
            Don't have an account? <a href="register.php">Register</a>
        </div>
    </div>
</div>

</body>
</html>
