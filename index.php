<?php
include 'database.php';
session_start();

$check_login = isset($_SESSION['customer_id']) && $_SESSION['customer_id'] != NULL ? true : false;

$kontak = mysqli_query($conn, "SELECT admin_telp, admin_email, admin_address FROM tb_admin WHERE admin_id = 1");
$a = mysqli_fetch_object($kontak);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BatiKraft</title>
    <link rel="stylesheet" type="text/css" href="style2.css">
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
                <li><a href="index.php">Home</a></li>
                <li><a href="produk.php">Produk</a></li>
                <?php if (!$check_login) { ?>
                    <li><a href="login_cust.php">Log In</a></li>
                <?php } ?>

                <?php if ($check_login) { ?>
                    <li><a href="order.php">Keranjang</a></li>
                <?php } ?>
                <?php if ($check_login) { ?>
                    <li><a href="logout_cust.php">Logout</a></li>
                <?php } ?>
            </ul>
        </div>
    </header>

    <!-- MESSAGE -->
    <!-- <div>
            <p><?= isset($_GET['message']) ? $_GET['message'] : '' ?></p>
        </div> -->

    <!---search bar--->
    <div class="search">
        <div class="container">
            <form action="produk.php">
                <input type="text" name="search" placeholder="Cari Produk">
                <input type="submit" name="cari" value="Cari">
            </form>
        </div>
    </div>

    <!---category--->
    <div class="section">
        <div class="container">
            <h3>Kategori</h3>
            <div class="box_category">
                <?php
                $kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
                if (mysqli_num_rows($kategori) > 0) {
                    while ($k = mysqli_fetch_array($kategori)) {
                ?>
                        <a href="produk.php?kat=<?php echo $k['category_id'] ?>">
                            <div class="col-5">
                                <img src="Produk/icon/kainbatik.png" width="50px" style="margin-bottom:5px;">
                                <p><?php echo $k['category_name'] ?> </p>
                            </div>
                        </a>
                    <?php }
                } else { ?>
                    <p>Kategori tidak ada</p>
                <?php } ?>
            </div>
        </div>
    </div>




    <!---event--->
    <div class="section">
        <h3 style="font-size: 25px;">Event</h3>
        <div class="container2">

            <div class="card">
                <div class="head-card">
                    <a href="deskripsi_event.php">
                        <img src="1.png">
                    </a>
                </div>
                <div class="body-card">
                    <p>workshop 1</p>
                </div>
            </div>

            <div class="card">
                <div class="head-card">
                    <a href="deskripsi_event2.php">
                        <img src="2.png">
                    </a>
                </div>
                <div class="body-card">
                    <p>workshop 2</p>
                </div>
            </div>

            <div class="card">
                <div class="head-card">
                    <a href="deskripsi_event3.php">
                        <img src="3.png">
                    </a>
                </div>
                <div class="body-card">
                    <p>workshop 3</p>
                </div>
            </div>

            <div class="card">
                <div class="head-card">
                    <a href="deskripsi_event4.php">
                        <img src="4.png">
                    </a>
                </div>
                <div class="body-card">
                    <p>workshop 4</p>
                </div>
            </div>
        </div>
    </div>

    <!---produk terbaru--->
    <div class="section">
        <div class="container">
            <h3>Produk Terbaru</h3>
            <div class="box">
                <?php
                $produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_status = 1 ORDER BY product_id DESC LIMIT 10");
                if (mysqli_num_rows($produk) > 0) {
                    while ($p = mysqli_fetch_array($produk)) {
                ?>
                        <a href="detail_produk.php?id=<?php echo $p['product_id'] ?>">
                            <div class="col-2">
                                <img src="produk/<?php echo $p['product_image'] ?>">
                                <p class="nama"><?php echo $p['product_name'] ?></p>
                                <p class="harga">Rp.<?php echo number_format($p['product_price']) ?></p>
                                <a href="order.php?product_id=<?= $p['product_id'] ?>&jumlah=+1" class="button-cart" role="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                                        <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                    </svg>
                                </a>
                            </div>
                        </a>
                    <?php }
                } else { ?>
                    <p>Produk tidak ada</p>
                <?php } ?>
            </div>
        </div>
    </div>

    <!---footer--->
    <footer>
        <div class="footer_kecil">
            <h3>Alamat</h3>
            <p>Jl.Soekarno Hatta No.9, Semarang, Jawa Tengah</p>
            <br>

            <h3>E-mail</h3>
            <p>BatiKraftSMG@gmail.com</p>
            <br>

            <h3>Telp</h3>
            <p>081256123765</p>
            <br>

            <small>Copyright &copy2024 BatiKraft</small>
        </div>
    </footer>
</body>

</html>