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

    <h2>Data Orderan Thering</h2>

    <table>
        <tr>
            <th>No</th>
            <th>ID</th>
            <th>Nama</th>
            <th>Kelas</th>
            <th>Minuman</th>
            <th>Quantity</th>
            <th>Totalharga</th>
            <th>Aksi</th>
        </tr>
        <?php

        include "conn.php";
        $no = 1;
        $data = mysqli_query($conn, "SELECT * FROM orderthering");
        while ($row = mysqli_fetch_array($data)) {
        ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['namapembeli']; ?></td>
            <td><?php echo $row['kelas']; ?></td>
            <td><?php echo $row['minuman']; ?></td>
            <td><?php echo $row['quantity']; ?></td>
            <td><?php echo $row['totalharga']; ?></td>
            <td>
            <div class="action-buttons">
    <!-- Tombol Edit dengan ikon pensil -->
    <a class="edit-btn btn btn-success" href="editdata.php?id=<?php echo $row['id']; ?>" title="Edit">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
        </svg>
    </a>

    <!-- Tombol Delete dengan ikon tong sampah -->
    <a class="delete-btn btn btn-danger" href="deletedata.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');" title="Delete">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
            <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
        </svg>
    </a>
</div>


            </td>
        </tr>
        <?php
        }
        ?>
    </table>

</body>
</html>
