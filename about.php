<?php
include 'database.php';
$kontak = mysqli_query($conn, "SELECT admin_telp, admin_email, admin_address FROM tb_admin WHERE admin_id = 1");
$a = mysqli_fetch_object($kontak);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>About| BatiKraft</title>
    <link rel="stylesheet" href="style2.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@300&display=swap" rel="stylesheet">
</head>

<body>
    <!---header--->
    <header>
        <div class="container">
            <h1><a href="index.php">beautyskin</a></h1>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="produk.php">Produk</a></li>
                <li><a href="order.php">Keranjang</a></li>
            </ul>
        </div>
    </header>

    <!---content about--->
    <div class="section">
        <div class="container">
            <h3>About</h3>
            <div class="box">
                <a>Selamat datang di sourchic, sebuah toko online yang menyediakan berbagai produk, mulai dari kategori skincare, haircare, bodycare, serta health. Di sourchic ini memenuhi semua keinginan pelanggan dan bebrbagai brand tersedia disini, dengan harga yang menggiurkan.</a>
            </div>
        </div>
    </div>
    <!---footer--->
    <footer>
        <div class="container">
            <small>Copyright &copy2024 beautyskin</small>
        </div>
    </footer>
</body>

</html>