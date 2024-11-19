<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data</title>
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
            width: 400px;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        label {
            color: #333;
            margin-bottom: 5px;
        }
        input[type="text"], input[type="number"], select {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 100%;
        }
        .btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Edit Data Order</h2>

        <?php
        include 'conn.php';

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $query = "SELECT * FROM orderthering WHERE id = '$id'";
            $result = mysqli_query($conn, $query);

            if ($result) {
                $row = mysqli_fetch_assoc($result);
            } else {
                echo "<script>alert('Data tidak ditemukan.');window.location='yourpage.php';</script>";
            }
        }

        if (isset($_POST['update'])) {
            $namapembeli = $_POST['namapembeli'];
            $kelas = $_POST['kelas'];
            $minuman = $_POST['minuman'];
            $quantity = $_POST['quantity'];
            $totalharga = $_POST['totalharga'];

            $update_query = "UPDATE orderthering SET 
                namapembeli = '$namapembeli', 
                kelas = '$kelas', 
                minuman = '$minuman', 
                quantity = '$quantity', 
                totalharga = '$totalharga'
                WHERE id = '$id'";

            if (mysqli_query($conn, $update_query)) {
                echo "<script>alert('Data berhasil diperbarui!');window.location='yourpage.php';</script>";
            }
        }
        ?>

        <form method="post">
            <label for="namapembeli">Nama Pembeli:</label>
            <input type="text" id="namapembeli" name="namapembeli" value="<?php echo $row['namapembeli']; ?>" required>

            <label for="kelas">Kelas:</label>
            <input type="text" id="kelas" name="kelas" value="<?php echo $row['kelas']; ?>" required>

            <label for="minuman">Minuman:</label>
            <input type="text" id="minuman" name="minuman" value="<?php echo $row['minuman']; ?>" required>

            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" value="<?php echo $row['quantity']; ?>" required>

            <label for="totalharga">Total Harga:</label>
            <input type="number" id="totalharga" name="totalharga" value="<?php echo $row['totalharga']; ?>" required>

            <button type="submit" name="update" class="btn">Update Data</button>
        </form>
    </div>

</body>
</html>
