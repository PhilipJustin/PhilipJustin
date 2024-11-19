<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hapus Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .btn {
            background-color: #f44336;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
        }
        .btn:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        include 'conn.php'; // Pastikan koneksi ke database sudah benar

        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            // Sanitasi input agar lebih aman
            $id = mysqli_real_escape_string($conn, $id);

            // Query untuk menghapus data
            $query = "DELETE FROM orderthering WHERE id = '$id'";

            if (mysqli_query($conn, $query)) {
                echo "<h2>Data berhasil dihapus!</h2>";
            } else {
                echo "<h2>Gagal menghapus data: " . mysqli_error($conn) . "</h2>";
            }

            // Tutup koneksi database
            mysqli_close($conn);
        } else {
            echo "<h2>ID tidak ditemukan. Tidak ada data yang dihapus.</h2>";
        }
        ?>
        <br>
        <a href="yourpage.php" class="btn">Kembali ke Halaman Utama</a>
    </div>
</body>
</html>
