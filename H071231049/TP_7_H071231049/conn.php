<?php
// Tentukan Kredential DB
$server_name = 'localhost';
$username = 'root';
$password = '';
$database = 'mahasiswa_crud';

// Koneksikan DB
$conn = new mysqli($server_name, $username, $password, $database);

// Cek Keberhasilan Koneksi
if($conn->connect_error) {
    die("Koneksi Gagal: ". $conn->connection_error);
}