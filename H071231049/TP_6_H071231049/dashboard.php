<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}

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

$currentUser = $_SESSION['user'];

// Ambil data dari pengguna yang sedang login
$currentUserData = null;
foreach ($users as $user) {
    if ($user['username'] === $currentUser['username']) {
        $currentUserData = $user;
        break;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Welcome, <?= htmlspecialchars($currentUser['name']) ?></h2>
        
        <h3>Your Data</h3>
        <?php if ($currentUser['username'] === 'adminxxx'): ?>
            <p><strong>Email:</strong> <?= htmlspecialchars($currentUserData['email']) ?></p>
            <p><strong>Username:</strong> <?= htmlspecialchars($currentUserData['username']) ?></p>
        <?php else: ?>
            <p><strong>Name:</strong> <?= htmlspecialchars($currentUserData['name']) ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($currentUserData['email']) ?></p>
            <p><strong>Username:</strong> <?= htmlspecialchars($currentUserData['username']) ?></p>
            <p><strong>Gender:</strong> <?= htmlspecialchars($currentUserData['gender'] ?? '-') ?></p>
            <p><strong>Faculty:</strong> <?= htmlspecialchars($currentUserData['faculty'] ?? '-') ?></p>
            <p><strong>Batch:</strong> <?= htmlspecialchars($currentUserData['batch'] ?? '-') ?></p>
        <?php endif; ?>

        <?php if ($currentUser['username'] === 'adminxxx'): ?>
            <h3>Other User Data</h3>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Username</th>
                        <th>Gender</th>
                        <th>Faculty</th>
                        <th>Batch</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <?php if ($user['username'] !== $currentUser['username']): ?>
                            <tr>
                                <td><?= htmlspecialchars($user['name']) ?></td>
                                <td><?= htmlspecialchars($user['email']) ?></td>
                                <td><?= htmlspecialchars($user['username']) ?></td>
                                <td><?= htmlspecialchars($user['gender'] ?? '-') ?></td>
                                <td><?= htmlspecialchars($user['faculty'] ?? '-') ?></td>
                                <td><?= htmlspecialchars($user['batch'] ?? '-') ?></td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>

        <a href="logout.php" class="logout-button" style="float: left;">Logout</a>
    </div>
</body>
</html>
