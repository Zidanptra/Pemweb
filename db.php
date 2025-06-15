<?php
$host = 'localhost';
$user = 'root';
$pass = 'zidanputra19';
$dbname = 'artikel_db';

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
