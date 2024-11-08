<?php

$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'tp7';

$conn = new mysqli($servername, $username, $password, $database);

if ($conn -> connect_error) {
    die("koneksi gagal: " . $conn -> connect_error);
} 

?>