<?php
session_start();
include 'config.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$role = $_SESSION['role'];
$search = $_GET['search'] ?? '';
$page = $_GET['page'] ?? 1;
$limit = 10;
$offset = ($page - 1) * $limit;
$counter = 1;


$query = "SELECT * FROM mahasiswa 
WHERE nama LIKE '%$search%' OR nim 
LIKE '%$search%' LIMIT $limit OFFSET $offset";
$result = $conn->query($query);

$totalQuery = "SELECT COUNT(*) as total FROM mahasiswa WHERE nama LIKE '%$search%' OR nim LIKE '%$search%'";
$totalResult = $conn->query($totalQuery);
$totalData = $totalResult->fetch_assoc()['total'];
$totalPages = ceil($totalData / $limit);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Data Mahasiswa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f0f2f5;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(135deg, #e0f7fa, #80deea);
        }
        .data-container {
            background: #ffffff;
            padding: 20px;
            border-radius: 10px;
            width: 100%;
            max-width: 900px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        }
        h2 {
            font-size: 1.8em;
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }
        .form-control {
            margin-bottom: 10px;
        }
        .table {
            margin-top: 20px;
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
        }
        .table th, .table td {
            text-align: center;
            vertical-align: middle;
        }
        .table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .btn-edit {
            background-color: #ff9800;
            color: #fff;
            border: none;
            padding: 5px 10px;
            font-size: 0.9em;
            margin-right: 5px;
        }
        .btn-delete {
            background-color: #f44336;
            color: #fff;
            border: none;
            padding: 5px 10px;
            font-size: 0.9em;
        }
        .pagination .page-item .page-link {
            color: #007bff;
        }
        .pagination .page-item.active .page-link {
            background-color: #007bff;
            border-color: #007bff;
            color: #fff;
        }

        .search-button {
            position: relative;
            margin-left: 10px; 
            margin-top : 0px;
            height : 40px;
        }

    </style>
</head>
<body>
    <div class="data-container">
        <h2>Data Mahasiswa</h2>
        <form method="GET" action="">
            <div class="input-group mb-3">
                <input type="text" name="search" placeholder="Cari Nama atau NIM" class="form-control" value="<?= htmlspecialchars($search) ?>">
                <button type="submit" class="btn btn-info search-button">Cari</button>
            </div>
        </form>

        <?php if ($role == 'admin') : ?>
            <a href="add.php" class="btn btn-success mb-3">Tambah Mahasiswa</a>
        <?php endif; ?>
        <a href="logout.php" class="btn btn-secondary mb-3">Logout</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Prodi</th>
                    <?php if ($role == 'admin') : ?>
                        <th>Aksi</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) : ?>
                    <tr>
                        <td><?= htmlspecialchars($counter++) ?></td>
                        <td><?= htmlspecialchars($row['nama']) ?></td>
                        <td><?= htmlspecialchars($row['nim']) ?></td>
                        <td><?= htmlspecialchars($row['prodi']) ?></td>
                        <?php if ($role == 'admin') : ?>
                            <td>
                                <a href='edit.php?id=<?= $row['id'] ?>' class='btn btn-edit'>Edit</a>
                                <a href='delete.php?id=<?= $row['id'] ?>' class='btn btn-delete'>Hapus</a>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <nav>
            <ul class="pagination justify-content-center">
                <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                    <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                        <a class="page-link" href="index.php?page=<?= $i ?>&search=<?= htmlspecialchars($search) ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>
            </ul>
        </nav>
    </div>
</body>
</html>
