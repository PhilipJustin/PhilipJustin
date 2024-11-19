<?php
session_start();  // Mulai sesi untuk menyimpan data cart

// Daftar menu baru dengan gambar sesuai nama minuman
$menu_items = [
    ['id' => 1, 'name' => 'Matcha', 'price' => 10000, 'image' => 'images/matcha.jpeg'],
    ['id' => 2, 'name' => 'Coffee', 'price' => 10000, 'image' => 'images/coffee.jpeg'],
    ['id' => 3, 'name' => 'Ice Tea', 'price' => 10000, 'image' => 'images/icetea.jpeg'],
    ['id' => 4, 'name' => 'Lemon Tea', 'price' => 10000, 'image' => 'images/lemontea.jpeg'],
];

// Menambahkan item ke cart jika form disubmit
if (isset($_POST['add_to_cart'])) {
    $id = $_POST['id'];
    $quantity = $_POST['quantity'];

    // Mencari item yang ditambahkan berdasarkan ID
    $item = array_filter($menu_items, function ($menu_item) use ($id) {
        return $menu_item['id'] == $id;
    });
    $item = array_values($item)[0]; // Ambil item pertama yang ditemukan

    // Jika cart belum ada, buat array cart baru
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Menambahkan item ke cart (mungkin sudah ada, jadi kita tambahkan kuantitas)
    $found = false;
    foreach ($_SESSION['cart'] as &$cart_item) {
        if ($cart_item['id'] == $item['id']) {
            $cart_item['quantity'] += $quantity;
            $found = true;
            break;
        }
    }

    if (!$found) {
        // Jika item belum ada di cart, tambahkan item baru
        $_SESSION['cart'][] = [
            'id' => $item['id'],
            'name' => $item['name'],
            'price' => $item['price'],
            'image' => $item['image'],
            'quantity' => $quantity
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Twelve Three Treats - Menu</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Welcome to Twelve Three Treats</h1>
    <h2>Menu Minuman Dari Thering</h2>

    <div class="menu-section">
        <?php 
        $limited_menu_items = array_slice($menu_items, 0, 4);
        foreach ($limited_menu_items as $item): ?>
            <div class="menu-item">
                <!-- Menampilkan gambar menu -->
                <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['name']; ?>" class="menu-image">
                <h3><?php echo $item['name']; ?></h3>
                <p>Price: Rp <?php echo number_format($item['price'], 0, ',', '.'); ?></p>
                <form method="post" action="">
                    <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                    <label>Quantity:</label>
                    <input type="number" name="quantity" value="1" min="1">
                    <button type="submit" name="add_to_cart">Add to Cart</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>

    <a href="cart.php" class="view-cart">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
            <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l1.313 7h8.17l1.313-7zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
        </svg>
        View Cart
    </a>
</body>
</html>
