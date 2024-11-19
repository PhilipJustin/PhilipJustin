<?php
// Koneksi ke database
$servername = "localhost"; // Ganti dengan host server database Anda
$username = "root";        // Ganti dengan username database Anda
$password = "";            // Ganti dengan password database Anda
$dbname = "heavenly";      // Nama database yang sudah Anda buat

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Mengecek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Mengambil data pesanan
$sql = "SELECT * FROM orderheavenly";
$result = $conn->query($sql);

// Menghapus data jika tombol delete ditekan
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_sql = "DELETE FROM orderheavenly WHERE id = $delete_id";
    if ($conn->query($delete_sql) === TRUE) {
        echo "Pesanan berhasil dihapus!";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Menutup koneksi setelah query
$conn->close();
?>
