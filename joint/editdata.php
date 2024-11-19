<?php
// Memasukkan file koneksi
include 'conn.php';

// Mendapatkan ID dari parameter URL
$id = $_GET['id'];

// Mendapatkan data dari database berdasarkan ID
$sql = "SELECT * FROM orderanjoint WHERE id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

// Proses update data jika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $namapembeli = $_POST['namapembeli'];
    $kelas = $_POST['kelas'];
    $minuman = $_POST['minuman'];
    $quantity = $_POST['quantity'];
    $totalharga = $_POST['totalharga'];

    $sql_update = "UPDATE orderanjoint SET namapembeli='$namapembeli', kelas='$kelas', minuman='$minuman', quantity=$quantity, totalharga=$totalharga WHERE id=$id";

    if ($conn->query($sql_update) === TRUE) {
        echo "Data berhasil diperbarui!";
        header("Location: displayorder.php"); // Redirect ke halaman utama setelah update
        exit();
    } else {
        echo "Error: " . $sql_update . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Edit Data Pesanan</h2>

    <form method="POST">
        <div class="mb-3">
            <label for="namapembeli" class="form-label">Nama Pembeli:</label>
            <input type="text" class="form-control" id="namapembeli" name="namapembeli" value="<?= $row['namapembeli'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="kelas" class="form-label">Kelas:</label>
            <input type="text" class="form-control" id="kelas" name="kelas" value="<?= $row['kelas'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="minuman" class="form-label">Minuman:</label>
            <input type="text" class="form-control" id="minuman" name="minuman" value="<?= $row['minuman'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="quantity" class="form-label">Jumlah:</label>
            <input type="number" class="form-control" id="quantity" name="quantity" value="<?= $row['quantity'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="totalharga" class="form-label">Total Harga:</label>
            <input type="number" class="form-control" id="totalharga" name="totalharga" value="<?= $row['totalharga'] ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Data</button>
    </form>
</div>
</body>
</html>

<?php
$conn->close();
?>
