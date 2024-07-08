<?php
include 'database.php';
session_start();

$check_login = isset($_SESSION['customer_id']) && $_SESSION['customer_id'] != NULL ? true : false;

$kontak = mysqli_query($conn, "SELECT admin_telp, admin_email, admin_address FROM tb_admin WHERE admin_id = 1");
$a = mysqli_fetch_object($kontak);
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservasi</title>
    <link rel="stylesheet" href="style2.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@300&display=swap" rel="stylesheet">
</head>

<body>
    <!---header--->
    <header>
        <div class="container">
            <h1><a href="index.php">BatiKraft</a></h1>
            <ul>
                <li><a href="reservasi.php">Reservasi</a></li>
                <li><a href="index.php">Home</a></li>
                <li><a href="produk.php">Produk</a></li>
                <li><a href="order.php">Keranjang</a></li>
                <li><a href="logout_cust.php">Logout</a></li>
            </ul>
        </div>
    </header>

    <!---produk terbaru--->
    <div class="section">
        <div class="container">
            <h3>Event</h3>
            <div class="box">
                <?php
                $event = mysqli_query($conn, "SELECT * FROM tb_event ORDER BY event_id DESC");
                if (mysqli_num_rows($event) > 0) {
                    while ($e = mysqli_fetch_array($event)) {
                ?>
                        <a href="deskripsi_event.php?id=<?php echo $e['event_id'] ?>">
                            <div class="col-5">
                                <img src="produk/img1.png" width="50px" style="margin-bottom: 50px">
                                <p><?php echo $e['event_name'] ?></p>
                            </div>
                        </a>
                    <?php }
                } else { ?>
                    <p>Event tidak ada</p>
                <?php } ?>
            </div>
        </div>
    </div>
</body>

</html>