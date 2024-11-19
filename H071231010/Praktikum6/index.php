<?php
session_start();

$users = [
    [
        'email' => 'admin@gmail.com',
        'username' => 'adminxxx',
        'name' => 'Admin',
        'password' => password_hash('admin123', PASSWORD_DEFAULT),
    ],
    [
        'email' => 'nanda@gmail.com',
        'username' => 'nanda_aja',
        'name' => 'Wd. Ananda Lesmono',
        'password' => password_hash('nanda123', PASSWORD_DEFAULT),
        'gender' => 'Female',
        'faculty' => 'MIPA',
        'batch' => '2021',
    ],
    [
        'email' => 'arif@gmail.com',
        'username' => 'arif_nich',
        'name' => 'Muhammad Arief',
        'password' => password_hash('arief123', PASSWORD_DEFAULT),
        'gender' => 'Male',
        'faculty' => 'Hukum',
        'batch' => '2021',
    ],
    [
        'email' => 'eka@gmail.com',
        'username' => 'eka59',
        'name' => 'Eka Hanny',
        'password' => password_hash('eka123', PASSWORD_DEFAULT),
        'gender' => 'Female',
        'faculty' => 'Keperawatan',
        'batch' => '2021',
    ],
    [
        'email' => 'adnan@gmail.com',
        'username' => 'adnan72',
        'name' => 'Adnan',
        'password' => password_hash('adnan123', PASSWORD_DEFAULT),
        'gender' => 'Male',
        'faculty' => 'Teknik',
        'batch' => '2020',
    ],
];

function authenticate($email_or_username, $password, $users) {
    foreach ($users as $user) {
        if (($user['email'] === $email_or_username || $user['username'] === $email_or_username) && password_verify($password, $user['password'])) {
            return $user;
        }
    }
    return null;
}

if (isset($_POST['login'])) {
    $email_or_username = $_POST['email_or_username'];
    $password = $_POST['password'];
    $user = authenticate($email_or_username, $password, $users);
    if ($user) {
        $_SESSION['user'] = $user;
        header('Location: dashboard.php');
        exit();
    } else {
        $error = "Email/Username atau Password salah!";
    }
}

if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            width: 900px;
            display: flex;
            background-color: #fff;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            border-radius: 20px;
        }
        .form-container {
            flex: 1;
            padding: 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .form-container h1 {
            font-size: 32px;
            font-weight: 600;
            margin-bottom: 20px;
        }
        .form-container p {
            font-size: 14px;
            color: #888;
            margin-bottom: 40px;
        }
        .form-container input[type="text"],
        .form-container input[type="password"] {
            width: 100%;
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
        }
        .form-container input[type="submit"] {
            padding: 15px;
            background-color: #5a67d8;
            color: #fff;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
        }
        .form-container input[type="submit"]:hover {
            background-color: #4c51bf;
        }
        .social-login {
            margin-top: 20px;
            text-align: center;
        }
        .social-login button {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            margin-bottom: 10px;
            cursor: pointer;
        }
        .google-login {
            background-color: #4285F4;
            color: #fff;
        }
        .facebook-login {
            background-color: #3B5998;
            color: #fff;
        }
        .image-container {
            flex: 1;    
            display: flex;
            justify-content: center;
            align-items: center;
           
        }
        .image-container img {
            width:80vw;
            height:80vh;
            width: 100%;
            border-radius: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <!-- Left: Login Form -->
    <div class="form-container">
        <h1>Login</h1>
        <p>How to get started? Lorem ipsum dolor sit amet.</p>
        <form action="index.php" method="post">
        <input type="text" name="email_or_username" placeholder="Email or Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" name="login" value="Submit">
            <?php if (isset($error)) : ?>
                <p class="error"><?= $error ?></p>
            <?php endif; ?>
        </form>
        <div class="social-login">
            <p>Login with Others</p>
            <button class="google-login">Login with Google</button>
            <button class="facebook-login">Login with Facebook</button>
        </div>
    </div>

    <!-- Right: Image Section -->
    <div class="image-container">
        <img src="login.jpg" alt="Login Illustration">
    </div>
</div>

</body>
</html>
