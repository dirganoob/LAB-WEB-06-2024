<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $query->bind_param("s", $username);
    $query->execute();
    $result = $query->get_result();
    $user = $result->fetch_assoc();

    if ($user && $password === $user['password']) {
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        header("Location: index.php");
    } else {
        $error = "Username or Password is incorrect!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
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
        .login-container {
            background: rgba(255, 255, 255, 0.9);
            padding: 40px;
            border-radius: 10px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
        }
        .login-container h2 {
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
        .login-options {
            display: flex;
            justify-content: space-between;
            font-size: 0.9em;
            color: #555;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <img src="https://img.icons8.com/ios-filled/100/00acc1/user.png" alt="User Icon" />
        <h2>Sign In</h2>
        <form method="POST" action="">
            <div class="mb-3">
                <input type="text" name="username" placeholder="Username" required class="form-control">
            </div>
            <div class="mb-3">
                <input type="password" name="password" placeholder="Password" required class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
            <p class="mt-3">Don't have an account? <a href="register.php">Register Here</a></p>
        </form>
        <?php if (isset($error)) echo "<p class='text-danger'>$error</p>"; ?>
    </div>
</body>
</html>
