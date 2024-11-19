<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Orderan yang Masuk</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f9;
        }
        h2 {
            color: #333;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 12px;
            text-align: center;
        }
        th {
            background-color: #333;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
        td {
            background-color: #e9e9e9;
        }
        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 10px;
        }
        .edit-btn, .delete-btn {
            padding: 8px 12px;
            text-decoration: none;
            color: white;
            border-radius: 4px;
        }
        .edit-btn {
            background-color: #4CAF50;
        }
        .edit-btn:hover {
            background-color: #45a049;
        }
        .delete-btn {
            background-color: #f44336;
        }
        .delete-btn:hover {
            background-color: #e53935;
        }
    </style>
</head>
<body>

    <h2>Data Orderan</h2>

    <table>
        <tr>
            <th>No</th>
            <th>ID</th>
            <th>Nama</th>
            <th>Kelas</th>
            <th>Makanan</th>
            <th>Aksi</th>
        </tr>
        <?php
        include "conn.php";
        $no = 1;
        $data = mysqli_query($conn, "SELECT * FROM ordercoc");
        while ($row = mysqli_fetch_array($data)) {
        ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['Nama']; ?></td>
            <td><?php echo $row['Kelas']; ?></td>
            <td><?php echo $row['Makanan']; ?></td>
            <td>
                <div class="action-buttons">
                    <a class="edit-btn" href="editdata.php?id=<?php echo $row['id']; ?>">Edit</a>
                    <a class="delete-btn" href="deletedata.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">Delete</a>
                </div>
            </td>
        </tr>
        <?php
        }
        ?>
    </table>

</body>
</html>
