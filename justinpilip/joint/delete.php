<?php
// Memasukkan file koneksi
include 'conn.php';

// Mendapatkan ID dari parameter URL
$id = $_GET['id'];

// Query untuk menghapus data berdasarkan ID
$sql = "DELETE FROM orderanjoint WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "Data berhasil dihapus!";
    header("Location: displayorder.php"); // Redirect ke halaman utama setelah delete
    exit();
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
