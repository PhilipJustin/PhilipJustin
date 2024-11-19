<?php
session_start();

// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_orderan";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Cek apakah keranjang ada
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "<div class='empty-cart-message'>Your cart is empty!</div>";
    exit;
}

// Jika form di-submit
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_order'])) {
    $namapembeli = $conn->real_escape_string($_POST['namapembeli']);
    $totalharga = 0;

    // Menghitung total harga
    foreach ($_SESSION['cart'] as $cart_item) {
        $totalharga += $cart_item['price'] * $cart_item['quantity'];
    }

    // Insert data pesanan ke tabel orderan menggunakan prepared statement
    $sql = "INSERT INTO orderan (namapembeli, totalharga) VALUES (?, ?)";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("si", $namapembeli, $totalharga);
        if ($stmt->execute()) {
            // Ambil ID pesanan terakhir yang baru ditambahkan
            $order_id = $stmt->insert_id;

            // Insert detail pesanan ke tabel order_details
            foreach ($_SESSION['cart'] as $cart_item) {
                $item_id = $cart_item['id']; // Menggunakan 'id', bukan 'id_order'
                $quantity = $cart_item['quantity'];
                $item_total = $cart_item['price'] * $quantity;

                $sql_detail = "INSERT INTO order_details (order_id, item_id, quantity, total) 
                               VALUES (?, ?, ?, ?)";
                if ($stmt_detail = $conn->prepare($sql_detail)) {
                    $stmt_detail->bind_param("iiii", $order_id, $item_id, $quantity, $item_total);
                    $stmt_detail->execute();
                    $stmt_detail->close();
                }
            }

            // Mengosongkan keranjang setelah pesanan berhasil
            unset($_SESSION['cart']);

            echo "<div class='order-success'>Order placed successfully! Your Order ID is $order_id</div>";
        } else {
            echo "Error: Could not execute order. Please try again.";
        }

        $stmt->close();
    } else {
        echo "Error: Could not prepare the statement.";
    }
}
?>
<?php

// Pastikan $_SESSION['cart'] ada dan terinisialisasi
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = []; // Inisialisasi keranjang belanja jika belum ada
}

// Inisialisasi variabel totalharga, totalquantity, dan minuman
$totalharga = 0;
$totalquantity = 0;
$minuman = "";

// Memastikan $_SESSION['cart'] ada dan merupakan array yang valid
if (isset($_SESSION['cart']) && is_array($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $cart_item) {
        // Proses item dalam keranjang
        $totalharga += $cart_item['price'] * $cart_item['quantity'];
        $totalquantity += $cart_item['quantity'];
        $minuman .= $cart_item['name'] . ", ";
    }
} else {
    // Jika keranjang kosong atau tidak terdefinisi
    echo "Keranjang belanja Anda kosong.";
}
?>



<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart - Twelve Three Treats</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Tabel untuk cart */
        .cart-container {
            width: 80%;
            margin: 20px auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
        }
        th {
            background-color: #d8b37c;
        }
        /* Styling untuk kolom total */
        td img {
            width: 50px;
        }
        .empty-cart-message {
            font-size: 2rem;
            text-align: center;
            padding: 50px;
            background-color: #d8b37c;
            color: white;
            border-radius: 10px;
            margin: 50px;
        }
        .back-to-menu {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            background-color: #d8b37c;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .back-to-menu:hover {
            background-color: #b78f57;
        }
        .delete-button {
            padding: 5px 10px;
            background-color: red;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .delete-button:hover {
            background-color: darkred;
        }
        .order-form {
            margin-top: 20px;
        }
        .order-form input {
            padding: 10px;
            width: 100%;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .submit-button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
        }
        .submit-button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Your Cart</h1>

    <div class="cart-container">
        <table>
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
    <?php
    // Memastikan session cart ada dan tidak kosong
    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])):
        $total_price = 0;
        foreach ($_SESSION['cart'] as $index => $cart_item):
            // Menghitung total harga per item
            $item_total = $cart_item['price'] * $cart_item['quantity'];
            // Mengakumulasi total keseluruhan
            $total_price += $item_total;
    ?>
            <tr>
                <td><img src="<?php echo htmlspecialchars($cart_item['image']); ?>" alt="<?php echo htmlspecialchars($cart_item['name']); ?>" style="width: 50px; height: auto;"></td>
                <td><?php echo htmlspecialchars($cart_item['name']); ?></td>
                <td>Rp <?php echo number_format($cart_item['price'], 0, ',', '.'); ?></td>
                <td><?php echo htmlspecialchars($cart_item['quantity']); ?></td>
                <td>Rp <?php echo number_format($item_total, 0, ',', '.'); ?></td>
                <td>
                    <!-- Tombol delete untuk item -->
                    <form method="post" action="cart.php">
                        <input type="hidden" name="delete_index" value="<?php echo htmlspecialchars($index); ?>">
                        <button type="submit" name="delete" class="delete-button">Delete</button>
                    </form>
                </td>
            </tr>
    <?php
        endforeach;
    else:
    ?>
        <tr>
            <td colspan="6" style="text-align: center;">Keranjang belanja kosong</td>
        </tr>
    <?php endif; ?>
</tbody>

        </table>

        <h3>Total Harga: Rp <?php echo number_format($totalharga, 0, ',', '.'); ?></h3>
<h3>Total Quantity: <?php echo $totalquantity; ?></h3>

<form method="post" class="order-form">
    <label for="namapembeli">Nama Pembeli:</label>
    <input type="text" id="namapembeli" name="namapembeli" required placeholder="Masukkan Nama Anda"><br>
    
    <label for="kelas">Kelas:</label>
    <select id="kelas" name="kelas" required>
        <option value="">--Pilih Kelas--</option>
        <option value="10-1">10-1</option>
        <option value="10-2">10-2</option>
        <option value="10-3">10-3</option>
        <option value="11-1">11-1</option>
        <option value="11-2">11-2</option>
        <option value="11-3">11-3</option>
        <option value="12-1">12-1</option>
        <option value="12-2">12-2</option>
        <option value="12-3">12-3</option>
    </select>
    
    <button type="submit" name="submit_order" class="submit-button">Submit Order</button>
</form>

           
       <?php
       include "koneksi.php";
       
       // Jika form di-submit
       if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_order'])) {
           // Mengambil data dari form
           $namapembeli = $_POST['namapembeli'];
           $kelas = $_POST['kelas'];
           $totalharga = 0;
           $totalquantity = 0;
           $minuman = ''; // Menyimpan nama minuman yang dibeli
        
         // Menghitung total harga, total quantity dan nama minuman
foreach ($_SESSION['cart'] as $cart_item) {
    $totalharga += $cart_item['price'] * $cart_item['quantity'];
    $totalquantity += $cart_item['quantity'];
    $minuman .= $cart_item['name'] . ", ";  // Menggabungkan nama minuman
}

// Menghapus koma terakhir pada daftar minuman
$minuman = rtrim($minuman, ", ");
           // Menyimpan data pemesanan ke dalam database
           $query = "INSERT INTO orderthering (namapembeli, kelas, minuman, quantity, totalharga) 
                     VALUES ('$namapembeli', '$kelas', '$minuman', '$totalquantity', '$totalharga')";
           
           if (mysqli_query($koneksi, $query)) {
               echo "Orderan anda telah direkam";
               // Mengosongkan keranjang setelah data berhasil disimpan
               unset($_SESSION['cart']);
           } else {
               echo "Error: " . mysqli_error($koneksi);
           }
       }
       ?>
       
       

        
    

        <a href="index.php" class="back-to-menu">Back to Menu</a>
    </div>

    <?php
    // Proses penghapusan item dari cart
    if (isset($_POST['delete'])) {
        $delete_index = $_POST['delete_index'];
        array_splice($_SESSION['cart'], $delete_index, 1); // Hapus item dari cart
        header("Location: cart.php"); // Reload halaman setelah penghapusan
        exit();
    }
    ?>
</body>
</html>
