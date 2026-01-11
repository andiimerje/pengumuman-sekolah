<?php
// Konfigurasi database localhost
$host = "localhost";
$user = "root";
$pass = ""; // kosong di localhost
$db   = "pengumuman"; // nama database di phpMyAdmin

// Membuat koneksi
$koneksi = mysqli_connect($host, $user, $pass, $db);

// Cek koneksi
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Set default timezone Indonesia
date_default_timezone_set("Asia/Jakarta");
?>
