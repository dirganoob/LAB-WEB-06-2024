<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: index.php');
    exit();
}

$user = $_SESSION['user'];
$admin = $user['username'] === 'adminxxx';
$users_data = $_SESSION['all_users_data'] ?? [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            background-color: #e8e8e8; 
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

        .dashboard-container { 
            background: #fff; 
            padding: 20px; 
            box-shadow: 0 0 10px rgba(0,0,0,0.1); 
            border-radius: 8px; 
        }

        h2 { 
            text-align: center; 
        }
        
        .logout { 
            text-align: right; 
        }

        .logout a { 
            text-decoration: none; color: red; 
        }

        .user-info { 
            margin: 15px 0; 
            padding: 10px; 
            border: 1px solid #ddd; 
            border-radius: 5px; 
            background-color: #f9f9f9; 
        }

        .user-info p { 
            margin: 10px 0; 
        }

        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 20px; 
        }

        th, td { 
            padding: 10px; 
            text-align: left; 
            border: 1px solid #ddd; 
        }

        th { 
            background-color: #f2f2f2; 
        }
    </style>
</head>
<body>

<div class="dashboard-container">
    <div class="logout"><a href="logout.php">Logout</a></div>
    <h2>Welcome, <?= htmlspecialchars($user['name']); ?>!</h2>

    <?php if ($admin): ?>
        <h3>All Users Data</h3>
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
                <?php foreach ($users_data as $u): ?>
                    <tr>
                        <td><?= htmlspecialchars($u['name']); ?></td>
                        <td><?= htmlspecialchars($u['email']); ?></td>
                        <td><?= htmlspecialchars($u['username']); ?></td>
                        <td><?= isset($u['gender']) ? htmlspecialchars($u['gender']) : 'N/A'; ?></td>
                        <td><?= isset($u['faculty']) ? htmlspecialchars($u['faculty']) : 'N/A'; ?></td>
                        <td><?= isset($u['batch']) ? htmlspecialchars($u['batch']) : 'N/A'; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <h3>User Information</h3>
        <div class="user-info">
            <p><strong>Name:</strong> <?= htmlspecialchars($user['name']); ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($user['email']); ?></p>
            <p><strong>Username:</strong> <?= htmlspecialchars($user['username']); ?></p>
            <p><strong>Gender:</strong> <?= isset($user['gender']) ? htmlspecialchars($user['gender']) : 'N/A'; ?></p>
            <p><strong>Faculty:</strong> <?= isset($user['faculty']) ? htmlspecialchars($user['faculty']) : 'N/A'; ?></p>
            <p><strong>Batch:</strong> <?= isset($user['batch']) ? htmlspecialchars($user['batch']) : 'N/A'; ?></p>
        </div>
    <?php endif; ?>
</div>

</body>
</html>
