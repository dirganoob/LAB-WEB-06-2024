<?php
session_start();
include 'conn.php';

if (isset($_GET['nim'])) {
    $nim = $_GET['nim'];

    // Prepare the delete query
    $query = $conn->prepare("DELETE FROM mahasiswa WHERE nim = ?");
    $query->bind_param('s', $nim);

    if ($query->execute()) {
        // Check if the table is empty after deletion
        $checkQuery = "SELECT COUNT(*) AS count FROM mahasiswa";
        $result = $conn->query($checkQuery);
        $row = $result->fetch_assoc();

        if ($row['count'] == 0) {
            // Destroy the session if the table is empty
            session_destroy();
            header('Location: login.php');
            exit;
        } else {
            // Redirect back to the home page if not empty
            header('Location: home.php');
            exit;
        }
    } else {
        echo "Error: " . $query->error;
    }
    $query->close();
}

$conn->close();
?>
