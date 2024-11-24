<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "bkd_rev"; // Ganti dengan nama database yang digunakan

$koneksi = mysqli_connect($host, $user, $password, $dbname);

// Periksa koneksi
if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>
