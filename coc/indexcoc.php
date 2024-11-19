<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Cookies</title>
    <link rel="stylesheet" href="stylecoc.css">
</head>
<body>

<div class="container">
    <h1>Menu Crave n Crumble</h1>
    <div class="menu">
        <!-- Menu item Cookies Mini -->
        <div class="menu-item">
            <img src="cookiesmini.jpeg" alt="Cookies Mini">
            <h3>Cookies Mini</h3>
            <p>Cookies kecil dengan rasa yang lezat dan manis!</p>
            <div class="price">Rp 12.000</div>
           
        </div>

        <!-- Menu item Cookies -->
        <div class="menu-item">
            <img src="cookies.jpeg" alt="Cookies">
            <h3>Cookies</h3>
            <p>Cookies besar yang penuh dengan rasa nikmat!</p>
            <div class="price">Rp 10.000</div>
          
        </div>
    </div>
</div>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pengorderan Makanan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            padding: 20px;
        }
        .container {
            max-width: 400px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        label {
            display: block;
            margin: 15px 0 5px;
            color: #333;
        }
        input[type="text"],
        select {
            width: 100%;
            padding: 10px;
            margin: 5px 0 20px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Form Pengorderan Makanan</h2>
    <form action="" method="POST">
        <!-- Input untuk Nama -->
        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama" placeholder="Masukkan nama" required>

        <!-- Pilihan Kelas -->
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

        <!-- Pilihan Makanan -->
        <label for="makanan">Makanan:</label>
        <select id="makanan" name="makanan" required>
            <option value="">--Pilih Makanan--</option>
            <option value="cookies">Cookies</option>
            <option value="mini cookies">Mini Cookies</option>
        </select>

        <!-- Tombol Submit -->
        <input type="submit" value="Order Sekarang" name="proses">
    </form>
        <?php 
        include "koneksi.php";
        
        if(isset($_POST['proses'])){
            mysqli_query($koneksi,"insert into ordercoc set
            Nama = '$_POST[nama]',
            Kelas = '$_POST[kelas]',
            Makanan = '$_POST[makanan]' ");

            echo "Orderan anda telah direkam";
        }   

        ?>
    </div>

</body>
</html>


</div>
</body>
</html>
