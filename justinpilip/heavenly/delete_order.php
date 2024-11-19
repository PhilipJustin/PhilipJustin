<?php
// Koneksi ke database
$servername = "localhost"; 
$username = "root";        
$password = "";            
$dbname = "heavenly";      

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Mengecek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Menghapus data jika tombol delete ditekan
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_sql = "DELETE FROM orderheavenly WHERE id = $delete_id";
    
    if ($conn->query($delete_sql) === TRUE) {
        echo "<script>alert('Pesanan berhasil dihapus!'); window.location.href='displayorder.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Menutup koneksi
$conn->close();
?>
