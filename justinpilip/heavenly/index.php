<?php
// Koneksi ke database
$servername = "localhost"; // Ganti dengan host server database Anda
$username = "root";        // Ganti dengan username database Anda
$password = "";            // Ganti dengan password database Anda
$dbname = "heavenly";      // Nama database yang sudah Anda buat

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Mengecek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Variabel untuk notifikasi
$showNotification = false;
$notif_namapembeli = '';
$notif_kelas = '';
$notif_quantity = '';
$notif_totalharga = '';

// Proses form jika disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $namapembeli = $_POST['namapembeli'];
    $kelas = $_POST['kelas'];
    $quantity = $_POST['quantity'];
    
    // Menghitung total harga (misalkan harga Pie Susu Heavenly adalah Rp 50,000)
    $harga_per_pie = 4000;
    $totalharga = $quantity * $harga_per_pie;

    // Menyimpan data ke database
    $sql = "INSERT INTO orderheavenly (namapembeli, kelas, quantity, totalharga)
            VALUES ('$namapembeli', '$kelas', $quantity, $totalharga)";

    if ($conn->query($sql) === TRUE) {
        // Set notifikasi untuk ditampilkan
        $showNotification = true;
        $notif_namapembeli = $namapembeli;
        $notif_kelas = $kelas;
        $notif_quantity = $quantity;
        $notif_totalharga = number_format($totalharga, 2, ',', '.');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Pie Susu Heavenly</title>
    <style>
       body {
            font-family: Arial, sans-serif;
            background-color: #C2B280; /* Latar belakang yang lebih terang */
            margin: 0;
            padding: 0;
            position: relative;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            padding-top: 50px;
            text-align: center;
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
        }

        .menu-item {
            background-color: #F5E1A4;
            border: 1px solid #ddd;
            border-radius: 10px;
            display: inline-block;
            padding: 20px;
            width: 300px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .menu-item img {
            width: 100%;
            border-radius: 10px;
        }

        .menu-item h3 {
            margin: 10px 0;
            color: #555;
        }

        .menu-item p {
            color: #777;
            margin: 10px 0;
            font: roboto_slab
        }

        .form-container {
            background-color: #ffffff; /* Background putih untuk form */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width: 50%;
            margin: 0 auto;
        }

        .form-container input, .form-container select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        .form-container button {
            padding: 10px 20px;
            background-color: #007BFF; /* Tombol biru cerah */
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .form-container button:hover {
            background-color: #0056b3; /* Warna saat tombol dihover */
        }

        /* Notifikasi */
        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: #28a745;
            color: white;
            padding: 15px;
            border-radius: 5px;
            z-index: 9999;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            display: none;
            font-size: 1rem;
            opacity: 0;
            transition: opacity 1s ease-in-out;
        }

        .notification.show {
            display: block;
            opacity: 1;
            animation: fadeIn 1s ease-in-out forwards;
        }

        .notification.hide {
            animation: fadeOut 1s ease-in-out forwards;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes fadeOut {
            from { opacity: 1; }
            to { opacity: 0; }
        }

        .thumbs-up {
            display: inline-block;
            margin-left: 10px;
            font-size: 1.5rem;
            color: #FFD700; /* Warna emas untuk jempol */
            animation: thumbsUpAnim 1s ease-in-out infinite alternate;
        }

        @keyframes thumbsUpAnim {
            0% { transform: scale(1); }
            50% { transform: scale(1.2); }
            100% { transform: scale(1); }
        }

        /* Efek Partikel/Pernak-pernik Pesta */
        .confetti {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
            overflow: hidden;
        }

        .confetti .particle {
            position: absolute;
            background-color: #f39c12;
            width: 10px;
            height: 10px;
            opacity: 0;
            animation: confettiAnimation 5s infinite ease-in-out;
        }

        @keyframes confettiAnimation {
            0% {
                transform: translateY(-100px) rotate(0deg);
                opacity: 1;
            }
            50% {
                transform: translateY(100vh) rotate(180deg);
                opacity: 1;
            }
            100% {
                transform: translateY(-100px) rotate(360deg);
                opacity: 0;
            }
        }

        /* Multiple Colors for Confetti */
        .confetti .particle:nth-child(odd) {
            background-color: #e74c3c;
        }

        .confetti .particle:nth-child(2n) {
            background-color: #3498db;
        }

        .confetti .particle:nth-child(3n) {
            background-color: #9b59b6;
        }

        .confetti .particle:nth-child(4n) {
            background-color: #1abc9c;
        }

    </style>
</head>
<body>
    <div class="container">
        <h1>Menu Pie Susu Heavenly</h1>
        <div class="menu-item">
            <img src="piesusu.jpeg" alt="Pie Susu Heavenly">
            <h3>Pie Susu Heavenly</h3>
            <p>Rasakan kelezatan pie susu Heavenly yang terkenal dengan rasa manis dan lembut.</p>
            <p>Harga: Rp 4,000 per buah</p>
        </div>

        <h2>Form Pemesanan</h2>
        <div class="form-container">
            <form method="POST" action="">
                <label for="namapembeli">Nama Pembeli:</label>
                <input type="text" id="namapembeli" placeholder="Masukan Nama Anda" name="namapembeli" required>

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

                <label for="quantity">Jumlah:</label>
                <input type="number" id="quantity" placeholder="Masukan Jumlah Pesanan" name="quantity" min="1" required>

                <button type="submit">Pesan</button>
            </form>
        </div>

        <!-- Notifikasi -->
        <?php if ($showNotification): ?>
            <div class="notification show" id="notif">
                Pesanan Berhasil!<br>
                Nama Pembeli: <?= $notif_namapembeli ?><br>
                Kelas: <?= $notif_kelas ?><br>
                Jumlah: <?= $notif_quantity ?><br>
                Total Harga: Rp <?= $notif_totalharga ?>
                <span class="thumbs-up">👍</span>
            </div>
        <?php endif; ?>

        <!-- Partikel/Pernak Pernik Pesta -->
        <div class="confetti" id="confetti"></div>
    </div>

    <script>
        // Fungsi untuk memunculkan partikel pesta secara acak
        function generateConfetti() {
            const confettiContainer = document.getElementById('confetti');
            for (let i = 0; i < 100; i++) {
                const particle = document.createElement('div');
                particle.classList.add('particle');
                particle.style.left = `${Math.random() * 100}%`;
                particle.style.animationDelay = `${Math.random() * 5}s`;
                confettiContainer.appendChild(particle);
            }
        }

        // Fungsi untuk menghilangkan notifikasi setelah beberapa detik
        setTimeout(function() {
            const notif = document.getElementById('notif');
            if (notif) {
                notif.classList.add('hide');
            }
        }, 5000);
        setTimeout(function() {
            const notif = document.getElementById('notif');
            if (notif) {
                notif.classList.add('hide');
            }
        }, 10000);


        // Generate Confetti
        generateConfetti();
    </script>
</body>
</html>
