<?php
session_start();

if (!isset($_SESSION['nim'])) {
    header("Location: login.php");
    exit;
}

$username = $_SESSION['username'];
$nim = $_SESSION['nim'];
$admin = $nim === '001';

include 'conn.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" href="style.css"/>
    <style>
        .homeContainer { 
            background: #fff; 
            padding: 20px; 
            box-shadow: 0 0 10px rgba(0,0,0,0.1); 
            border-radius: 8px; 
        }

        .homeContainer h2 {
            text-align: center;
        }

        /* Table container for dynamic sizing */
        .tableContainer {
            margin-top: 20px;
            overflow-x: auto; /* Allows horizontal scrolling if needed */
        }

        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 20px; 
        }

        th, td { 
            padding: 10px; 
            text-align: center; 
            border: 1px solid #ddd; 
        }

        th { 
            background-color: #f2f2f2; 
        }

        .buttonContainer {
            display: flex;
            gap: 10px;
        }

        .homeButton, .logoutButton {
            background-color: #C7B7A3; 
            color: #561C24; 
            margin-top: 15px;
            display: block;
            width: 100%;
            padding: 10px;
            border: none;
            cursor: pointer;
        }

        .editButton, .deleteButton {
            background-color: blue; 
            display: block;
            width: 100%;
            border: none;
            cursor: pointer;
        }

        .homeButton:hover, .logoutButton:hover { 
            background-color: #d2c5b2; 
        }
    </style>
</head>
<body>
<div class="homeContainer">
    <?php if ($admin): ?>
        <h2>Dashboard Admin</h2>
        <div class="tableContainer">
            <table>
                <tr>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Prodi</th>
                    <th>Password</th>
                    <th>Edit</th>
                </tr>
                <?php
                $query = "SELECT * FROM mahasiswa";
                $data_mahasiswa = $conn->query($query);

                while ($row = $data_mahasiswa->fetch_assoc()) {
                    $nama = htmlspecialchars($row['nama']);
                    $nim = htmlspecialchars($row['nim']);
                    $prodi = htmlspecialchars($row['prodi']);
                    $pass_display = str_repeat('*', 8);
                ?>
                <tr>
                    <td><?= $nama; ?></td>
                    <td><?= $nim; ?></td>
                    <td><?= $prodi; ?></td>
                    <td><?= $pass_display; ?></td>
                    <td>
                        <div class="buttonContainer">
                            <a href="edit.php?nim=<?= $nim; ?>"><button class="editButton">Edit</button></a> 
                            <a href="proses_hapus.php?nim=<?= $nim; ?>"><button class="deleteButton">Delete</button></a>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            </table>
        </div>
        <button class="homeButton" onclick="window.location.href='input.php';">Add Data</button>

    <?php else: ?>
        <?php
        $stmt = $conn->prepare("SELECT nama, nim, prodi FROM mahasiswa WHERE nim = ?");
        $stmt->bind_param("s", $nim);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $user_data = $result->fetch_assoc();
            $nama = $user_data['nama'];
            $prodi = $user_data['prodi'];
        ?>
            <h2>Welcome, <?= htmlspecialchars($nama); ?></h2>
            <p><strong>NIM:</strong> <?= htmlspecialchars($nim); ?></p>
            <p><strong>Prodi:</strong> <?= htmlspecialchars($prodi); ?></p>
        <?php } else { ?>
            <p>User data not found.</p>
        <?php }
        $stmt->close();
        ?>
    <?php endif; ?>
    <div>
        <button class="logoutButton" onclick="window.location.href='logout.php';">Log Out</button>
    </div>
</div>
</body>
</html>
