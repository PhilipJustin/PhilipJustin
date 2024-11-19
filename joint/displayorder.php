<?php
// Memasukkan file koneksi
include 'conn.php';

// Memeriksa apakah koneksi berhasil
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query untuk mengambil semua data dari tabel orderanjoint
$sql = "SELECT id, nama, kelas, minuman, quantity, totalharga FROM orderanjoint";
$result = $conn->query($sql);

// Memeriksa apakah query berhasil dijalankan
if (!$result) {
    die("Query failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pesanan</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    
    <style>
       body {
    font-family: 'Arial', sans-serif;
    background-color: #f8f9fa;
    margin: 0;
    padding: 0;
}

.container {
    margin-top: 30px;
}

h2 {
    font-size: 2rem;
    font-weight: bold;
    text-align: center;
    margin-bottom: 20px;
    color: #333;
}

/* Tabel */
table {
    width: 100%;
    border-collapse: collapse;
    background-color: #fff;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

table th, table td {
    padding: 12px 15px;
    text-align: center;
    border: 1px solid #dee2e6;
}

table th {
    background-color: #343a40;
    color: #fff;
    font-size: 1.1rem;
}

table tbody tr:nth-child(odd) {
    background-color: #f2f2f2;
}

table tbody tr:hover {
    background-color: #e9ecef;
    cursor: pointer;
}

/* Tombol Edit dan Delete */
.icon-btn {
    display: inline-block;
    padding: 8px 12px;
    margin: 0 5px;
    border-radius: 5px;
    background-color: #007bff;
    color: #fff;
    font-size: 1.2rem;
    transition: all 0.3s ease;
    text-decoration: none;
}

.icon-btn i {
    margin-right: 5px;
}

/* Efek Hover untuk Tombol */
.icon-btn:hover {
    background-color: #0056b3;
    transform: scale(1.05);
}

/* Tombol Delete dengan Warna Merah */
.icon-btn.delete {
    background-color: #dc3545;
}

.icon-btn.delete:hover {
    background-color: #c82333;
}

/* Tombol Edit dengan Warna Biru */
.icon-btn.edit {
    background-color: #28a745;
}

.icon-btn.edit:hover {
    background-color: #218838;
}

/* Responsif untuk Layar Kecil */
@media (max-width: 768px) {
    table th, table td {
        padding: 10px 5px;
    }

    h2 {
        font-size: 1.5rem;
    }
}

    </style>
</head>
<body>

<div class="container">
    <h2 class="my-4">Data Pesanan</h2>

    <!-- Tabel Data Pesanan -->
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nama Pembeli</th>
                <th>Kelas</th>
                <th>Minuman</th>
                <th>Jumlah</th>
                <th>Total Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Menampilkan setiap baris data
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['nama'] . "</td>";
                    echo "<td>" . $row['kelas'] . "</td>";
                    echo "<td>" . $row['minuman'] . "</td>";
                    echo "<td>" . $row['quantity'] . "</td>";
                    echo "<td>Rp " . number_format($row['totalharga'], 0, ',', '.') . "</td>";
                    echo "<td>";
                    // Tombol Edit
                    echo "<a href='editdata.php?id=" . $row['id'] . "' class='icon-btn' title='Edit Data'><i class='bi bi-pencil-fill'></i></a> ";
                    // Tombol Delete
                    echo "<a href='delete.php?id=" . $row['id'] . "' class='icon-btn' title='Hapus Data' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\");'><i class='bi bi-trash-fill'></i></a>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>Tidak ada data</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<!-- Ikon Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>

</body>
</html>

<?php
// Menutup koneksi
$conn->close();
?>
