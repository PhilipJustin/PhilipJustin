<?php
// Koneksi ke database
$servername = "localhost"; 
$username = "root";        
$password = "";            
$dbname = "joint";      

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Mengecek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Variabel untuk notifikasi
$showNotification = false;
$notif_nama = '';
$notif_kelas = '';
$notif_minuman = '';
$notif_quantity = '';
$notif_totalharga = '';

// Proses form jika disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];
    $minuman = $_POST['minuman'];
    $quantity = $_POST['quantity'];
    
    // Menghitung total harga (misalkan harga per minuman adalah Rp 15.000)
    $harga_per_minuman = 15000;
    $totalharga = $quantity * $harga_per_minuman;

    // Menyimpan data ke database
    $sql = "INSERT INTO orderanjoint (nama, kelas, minuman, quantity, totalharga)
            VALUES ('$nama', '$kelas', '$minuman', $quantity, $totalharga)";

    if ($conn->query($sql) === TRUE) {
        // Set notifikasi untuk ditampilkan
        $showNotification = true;
        $notif_nama = $nama;
        $notif_kelas = $kelas;
        $notif_minuman = $minuman;
        $notif_quantity = $quantity;
        $notif_totalharga = number_format($totalharga, 2, ',', '.');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Minuman</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Notifikasi di pojok kanan atas */
        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 20px;
            background-color: #4CAF50;
            color: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            opacity: 0;
            transform: translateY(-20px);
            transition: opacity 0.5s, transform 0.5s;
            z-index: 1000;
        }

        .notification.show {
            opacity: 1;
            transform: translateY(0);
        }

        .notification.hide {
            opacity: 0;
            transform: translateY(-20px);
        }

        .notification .thumbs-up {
            font-size: 20px;
            margin-left: 10px;
        }

        /* Tambahkan style untuk confetti */
        .confetti {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            overflow: hidden;
            z-index: 999;
        }

        .particle {
            position: absolute;
            width: 10px;
            height: 10px;
            background-color: red;
            opacity: 0.8;
            animation: fall 3s infinite;
        }

        @keyframes fall {
            0% {
                transform: translateY(-50px);
                opacity: 1;
            }
            100% {
                transform: translateY(100vh);
                opacity: 0;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="menu">
            <h1>Menu Minuman</h1>
            <img src="joint.jpeg" alt="Gambar Minuman" class="menu-image">
            <p>Pilih minuman yang Anda inginkan dengan harga Rp 15.000</p>
        </div>

        <div class="form-container">
            <form action="#" method="POST">
                <div class="form-group">
                    <label for="nama">Nama:</label>
                    <input type="text" id="nama" name="nama" required>
                </div>

                <div class="form-group">
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
                </div>

                <div class="form-group">
                    <label for="minuman">Minuman:</label>
                    <select id="minuman" name="minuman" required>
                        <option value="milktea">Milktea</option>
                        <option value="kopi susu">Kopi Susu</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="quantity">Jumlah Pesanan:</label>
                    <input type="number" id="quantity" name="quantity" placeholder="Masukkan jumlah pesanan" min="1" required>
                </div>

                <div class="form-group">
                    <p>Harga per Minuman: Rp 15.000</p>
                </div>

                <div class="form-group">
                    <button type="submit">Pesan Sekarang</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Notifikasi -->
    <?php if ($showNotification): ?>
        <div class="notification show" id="notif">
            Pesanan Berhasil!<br>
            Nama Pembeli: <?= $notif_nama ?><br>
            Kelas: <?= $notif_kelas ?><br>
            Minuman: <?= $notif_minuman ?><br>
            Jumlah: <?= $notif_quantity ?><br>
            Total Harga: Rp <?= $notif_totalharga ?>
            <span class="thumbs-up">👍</span>
        </div>
    <?php endif; ?>

    <!-- Partikel/Pernak Pernik Pesta -->
    <div class="confetti" id="confetti"></div>

    <script>
    // Fungsi untuk memunculkan partikel pesta secara acak
    function generateConfetti() {
        const confettiContainer = document.getElementById('confetti');
        
        // Membuat 100 partikel confetti
        for (let i = 0; i < 100; i++) {
            const particle = document.createElement('div');
            particle.classList.add('particle');
            particle.style.left = `${Math.random() * 100}%`;
            particle.style.animationDelay = `${Math.random() * 5}s`;
            confettiContainer.appendChild(particle);
        }

        // Menghapus partikel setelah 5 detik
        setTimeout(function() {
            while (confettiContainer.firstChild) {
                confettiContainer.removeChild(confettiContainer.firstChild);
            }
        }, 5000); // Partikel akan hilang setelah 5 detik
    }

    // Fungsi untuk menghilangkan notifikasi setelah beberapa detik
    setTimeout(function() {
        const notif = document.getElementById('notif');
        if (notif) {
            notif.classList.add('hide');
        }
    }, 5000);

    // Generate Confetti
    generateConfetti();
</script>

</body>
</html>
