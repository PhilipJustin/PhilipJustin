<?php
include 'conn.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $data = mysqli_query($conn, "SELECT * FROM ordercoc WHERE id='$id'");
    $row = mysqli_fetch_array($data);
}

if(isset($_POST['update'])){
    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];
    $makanan = $_POST['makanan'];

    mysqli_query($conn, "UPDATE ordercoc SET Nama='$nama', Kelas='$kelas', Makanan='$makanan' WHERE id='$id'");
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Order</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 8px;
            color: #333;
        }
        input[type="text"], select {
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 100%;
        }
        input[type="submit"] {
            padding: 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .back-btn {
            text-align: center;
            margin-top: 20px;
        }
        .back-btn a {
            color: #4CAF50;
            text-decoration: none;
            padding: 10px 20px;
            border: 2px solid #4CAF50;
            border-radius: 4px;
            display: inline-block;
        }
        .back-btn a:hover {
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Data Order</h2>
        <form method="POST">
            <label for="nama">Nama:</label>
            <input type="text" id="nama" name="nama" value="<?php echo $row['Nama']; ?>" required>

            <label for="kelas">Kelas:</label>
            <select id="kelas" name="kelas" required>
                <option value="10-1" <?php if($row['Kelas'] == '10-1') echo 'selected'; ?>>10-1</option>
                <option value="10-2" <?php if($row['Kelas'] == '10-2') echo 'selected'; ?>>10-2</option>
                <option value="10-3" <?php if($row['Kelas'] == '10-3') echo 'selected'; ?>>10-3</option>
                <option value="11-1" <?php if($row['Kelas'] == '11-1') echo 'selected'; ?>>11-1</option>
                <option value="11-2" <?php if($row['Kelas'] == '11-2') echo 'selected'; ?>>11-2</option>
                <option value="11-3" <?php if($row['Kelas'] == '11-3') echo 'selected'; ?>>11-3</option>
                <option value="12-1" <?php if($row['Kelas'] == '12-1') echo 'selected'; ?>>12-1</option>
                <option value="12-2" <?php if($row['Kelas'] == '12-2') echo 'selected'; ?>>12-2</option>
                <option value="12-3" <?php if($row['Kelas'] == '12-3') echo 'selected'; ?>>12-3</option>
            </select>

            <label for="makanan">Makanan:</label>
            <select id="makanan" name="makanan" required>
                <option value="cookies" <?php if($row['Makanan'] == 'cookies') echo 'selected'; ?>>Cookies</option>
                <option value="mini cookies" <?php if($row['Makanan'] == 'mini cookies') echo 'selected'; ?>>Mini Cookies</option>
            </select>

            <input type="submit" name="update" value="Update Data">
        </form>

        <div class="back-btn">
            <a href="displayorder.php">Kembali ke Daftar Orderan</a>
        </div>
    </div>
</body>
</html>
