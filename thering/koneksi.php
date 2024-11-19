<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "thering";  // Menggunakan database 'thering'

// Membuat koneksi
$koneksi = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($koneksi->connect_error) {
    die("Connection failed: " . $koneksi->connect_error);
}
?>