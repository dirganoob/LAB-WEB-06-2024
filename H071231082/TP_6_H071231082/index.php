<?php
session_start();

// Data user
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

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $input_email_or_username = $_POST['email_or_username'];
    $input_password = $_POST['password'];

    foreach ($users as $user) {
        if (($user['email'] === $input_email_or_username || $user['username'] === $input_email_or_username) && password_verify($input_password, $user['password'])) {
            $_SESSION['logged_in'] = true;
            $_SESSION['user'] = $user;

            // Set all users data in session
            $_SESSION['all_users_data'] = $users; // Add this line

            header('Location: dashboard.php');
            exit();
        }
    }

    $error_message = 'Invalid email/username or password!';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
    body { 
        font-family: Arial, sans-serif; 
        background-color: #f0f0f0; 
        display: flex; 
        justify-content: center; 
        align-items: center; 
        height: 100vh; 
        margin: 0; 
        background-image: url(./bg.jpg);
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
    }

    .login-container { 
        background: #fff; 
        padding: 20px; 
        box-shadow: 0 0 100px rgba(0,0,0,0.1); 
        border-radius: 8px; 
        width: 300px; 
    }

    .login-container h2 { 
        text-align: center; 
    }

    .form-group { 
        margin-bottom: 15px; 
        display: flex;
        width: 100%; 
    }

    .form-group input { 
        width: 100%; 
        padding: 10px; 
        border: 1px solid #ddd; 
        border-radius: 5px; 
    }

    .error { 
        color: red; 
        text-align: center; 
        margin-bottom: 15px;
    }

    button { 
        width: 100%; 
        padding: 10px; 
        background-color: blue; 
        color: white; 
        border: none; 
        border-radius: 5px; 
        cursor: pointer; 
    }

</style>

</head>
<body>
<div class="login-container">
    <h2>Login</h2>
    <?php if ($error_message): ?>
        <div class="error"><?= $error_message; ?></div>
    <?php endif; ?>
    <form method="POST">
        <div class="form-group">
            <input type="text" name="email_or_username" placeholder="Email or Username" required>
        </div>
        <div class="form-group">
            <input type="password" name="password" placeholder="Password" required>
        </div>
        <button type="submit">Login</button>
    </form>
</div>
</body>
</html>
