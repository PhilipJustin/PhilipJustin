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

// Mengambil data pesanan
$sql = "SELECT * FROM orderheavenly";
$result = $conn->query($sql);

// Menghapus data jika tombol delete ditekan
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_sql = "DELETE FROM orderheavenly WHERE id = $delete_id";
    if ($conn->query($delete_sql) === TRUE) {
        echo "<script>alert('Pesanan berhasil dihapus!');</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Menutup koneksi
$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Order - Heavenly</title>
    <style>
        /* Global Styles */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f2f2f2;
            margin: 0;
            padding: 0;
            color: #734128;
        }

        h1 {
            font-size: 2.5rem;
            color: #fff;
            text-align: center;
            margin-top: 50px;
            text-shadow: 2px 2px 5px rgba(0,0,0,0.1);
            padding: 20px 0;
            background-color: #4CAF50;
            border-radius: 5px;
            box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.1);
        }

        .container {
            width: 85%;
            max-width: 1200px;
            margin: 0 auto;
            padding-top: 30px;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 8px 16px rgba(0,0,0,0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
            font-size: 1.1rem;
        }

        td {
            background-color: #f9f9f9;
            font-size: 1rem;
            color: #555;
        }

        /* Efek Hover untuk Baris Tabel */
        tr:hover {
            background-color: #e0f7fa;
            transition: background-color 0.3s ease-in-out;
        }

        /* Tombol */
        .button {
            padding: 8px 15px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .button:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
        }

        .delete-button {
            background-color: #e74c3c;
        }

        .delete-button:hover {
            background-color: #c0392b;
        }

        /* Responsif */
        @media (max-width: 768px) {
            h1 {
                font-size: 2rem;
            }

            table {
                font-size: 0.9rem;
            }

            .button {
                font-size: 0.9rem;
                padding: 6px 12px;
            }
        }

        .action-buttons {
            display: flex;
            gap: 10px;
            justify-content: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Daftar Pesanan Pie Susu Heavenly</h1>

        <table>
            <thead>
                <tr>
                    <th>ID Order</th>
                    <th>Nama Pembeli</th>
                    <th>Kelas</th>
                    <th>Jumlah</th>
                    <th>Total Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Membuka koneksi untuk mengambil data
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Mengambil data pesanan
                $sql = "SELECT * FROM orderheavenly";
                $result = $conn->query($sql);

                // Mengecek apakah ada data
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $totalharga = number_format($row['totalharga'], 2, ',', '.'); // Format total harga
                        echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['namapembeli']}</td>
                                <td>{$row['kelas']}</td>
                                <td>{$row['quantity']}</td>
                                <td>Rp {$totalharga}</td>
                                <td class='action-buttons'>
                                    <a href='edit_order.php?id={$row['id']}' class='button'>Edit</a>
                                    <a href='?delete_id={$row['id']}' class='button delete-button' onclick='return confirm(\"Apakah Anda yakin ingin menghapus pesanan ini?\")'>Hapus</a>
                                </td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>Tidak ada pesanan</td></tr>";
                }

                // Menutup koneksi setelah query
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
