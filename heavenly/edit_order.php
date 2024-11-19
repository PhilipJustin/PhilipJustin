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

// Mengecek apakah ada ID yang dikirimkan untuk diedit
if (isset($_GET['id'])) {
    $id_order = $_GET['id'];
    
    // Mengambil data pesanan berdasarkan ID
    $sql = "SELECT * FROM orderheavenly WHERE id = $id_order";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Pesanan tidak ditemukan!";
        exit;
    }
}

// Menyimpan perubahan jika form disubmit
if (isset($_POST['submit'])) {
    $namapembeli = $_POST['namapembeli'];
    $kelas = $_POST['kelas'];
    $quantity = $_POST['quantity'];
    $totalharga = $_POST['totalharga'];
    
    $update_sql = "UPDATE orderheavenly SET namapembeli='$namapembeli', kelas='$kelas', quantity='$quantity', totalharga='$totalharga' WHERE id = $id_order";
    
    if ($conn->query($update_sql) === TRUE) {
        echo "<script>alert('Pesanan berhasil diperbarui!'); window.location.href='displayorder.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pesanan - Heavenly</title>
    <style>
        /* CSS Style */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f2f2f2;
            color: #734128;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            background-color: #4CAF50;
            color: white;
            padding: 20px;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
        }

        .container {
            width: 50%;
            margin: 0 auto;
            padding-top: 30px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
            font-size: 1rem;
        }

        button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        a {
            display: inline-block;
            margin-top: 10px;
            text-decoration: none;
            background-color: #007bff;
            padding: 10px 20px;
            color: white;
            border-radius: 5px;
        }

        a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Pesanan</h1>
        <form method="POST">
            <div class="form-group">
                <label for="namapembeli">Nama Pembeli:</label>
                <input type="text" name="namapembeli" id="namapembeli" value="<?php echo $row['namapembeli']; ?>" required>
            </div>
            <div class="form-group">
                <label for="kelas">Kelas:</label>
                <input type="text" name="kelas" id="kelas" value="<?php echo $row['kelas']; ?>" required>
            </div>
            <div class="form-group">
                <label for="quantity">Jumlah:</label>
                <input type="number" name="quantity" id="quantity" value="<?php echo $row['quantity']; ?>" required>
            </div>
            <div class="form-group">
                <label for="totalharga">Total Harga:</label>
                <input type="text" name="totalharga" id="totalharga" value="<?php echo $row['totalharga']; ?>" required>
            </div>
            <button type="submit" name="submit">Simpan Perubahan</button>
            <a href="displayorder.php">Kembali</a>
        </form>
    </div>
</body>
</html>
