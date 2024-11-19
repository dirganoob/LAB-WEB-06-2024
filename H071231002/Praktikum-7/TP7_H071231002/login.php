<?php
session_start();

include 'connect.php';

$pesanLogin = "";

if ($_SERVER['REQUEST_METHOD'] == "POST"){
    $username = $_POST['username'];
    $password = $_POST['pass'];


    $sql = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $sql->bind_param("s", $username);
    $sql->execute();
    $result = $sql->get_result();

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        $_SESSION['username'] = $data['username'];

        if (password_verify($password, $data['pass'])) {
            header("Location: dashboard.php");
            exit;
        } else {
            $pesanLogin = "Password salah!";
        }
    } else {
        $pesanLogin = "Akun tidak ditemukan!";
    }

    $conn->close();
}

// if (isset($_POST['login'])) {
//     $input = $_POST['username'];
//     $password = $_POST['password'];

//     foreach ($users as $user) {
//         if ($user['email'] == $input || $user['username'] == $input) {
//             if (password_verify($password, $user['password'])) {
//                 $_SESSION['user'] = $user;
//                 header('Location: dashboard.php');
//                 exit;
//             }
//         }
//     }

//     $error = 'Invalid email or password';
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=El+Messiri&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="sparkles"></div>
    <img src="img2.svg" alt="">
    <div class="formulir">
        <div class="wipe-in">
            <h1>LOGIN</h1>
        </div>

        <form id="login" action="" method="post">
            <br>
            <label for="username">Email or Username</label><br>
            <input type="text" id="username" name="username" placeholder="Masukkan Email or Username Anda" required>
            
            <label for="pass">Password</label><br>
            <input type="password" id="pass" name="pass" placeholder="Masukkan Password Anda" required>

            <a href="register.php">Don't Have an Account? Register Here...</a>
            
            <button type="submit" name="login" class="button">Submit</button>

            <i><?= $pesanLogin ?></i>
            
            <?php if (isset($error)) { echo '<p style="color: red;">' . $error . '</p>'; } ?>
        </form>


        
        <script src="scriptLogin.js"></script>
    </div>
</body>
</html>
