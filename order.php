<?php
session_start();
include 'database.php';

$customer_id = $_SESSION['customer_id'];

if ($customer_id == NULL) {
    header("Location: login_cust.php");
}

if (isset($_GET['delete_cart_id'])) {
    mysqli_query($conn, "DELETE FROM tb_cart where id='{$_GET['delete_cart_id']}'");

    header("Location: order.php");
}

if (isset($_GET['product_id']) && isset($_GET['jumlah'])) {

    // var_dump($customer_id);

    $check_cart = mysqli_query($conn, "SELECT id, jumlah from tb_cart where customer_id = {$customer_id} and product_id = {$_GET['product_id']}");
    $row = mysqli_fetch_assoc($check_cart);

    if (isset($row['id'])) {
        if ($_GET['jumlah'] == "+1") {
            $jumlah = $row['jumlah'] + 1;
        } else {
            $jumlah = $row['jumlah'] - 1;
        }
        // $jumlah = $row['jumlah'] + 1;
        // $jumlah = $_GET['jumlah'];
        $result = mysqli_query($conn, "UPDATE `tb_cart` SET `jumlah` = '{$jumlah}' WHERE `tb_cart`.`id` = {$row['id']}");
    } else {
        $result = mysqli_query($conn, "INSERT INTO tb_cart (id, customer_id, product_id, jumlah) VALUES (NULL, $customer_id, {$_GET['product_id']}, {$_GET['jumlah']}); ");
    }

    header("Location: order.php");
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Keranjang | BatiKraft</title>
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
                <li><a href="index.php">Home</a></li>
                <li><a href="produk.php">Produk</a></li>
                <li><a href="order.php">Keranjang</a></li>
                <li><a href="logout_cust.php">Logout</a></li>
            </ul>
        </div>
    </header>


    <div class="row" style="padding-left: 1rem; padding-right: 1rem">
        <div class="section">
            <div class="container">
                <h3>Keranjang</h3>
            </div>
        </div>
        <div class="box">
            <table border="1" cellspacing="0" class="tabel">
                <thead>
                    <tr>
                        <th>Foto Produk</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Jumlah Produk</th>
                        <th>Total</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    $keranjang = mysqli_query($conn, "SELECT *, (tb_cart.jumlah * tb_product.product_price) as total_harga FROM `tb_cart`
                left join tb_customer on tb_customer.id_pelanggan = tb_cart.customer_id
                left join tb_product on tb_product.product_id = tb_cart.product_id;");

                    $no = 0;
                    $total = 0;
                    while ($row = mysqli_fetch_array($keranjang)) :
                        $total += $row["total_harga"];
                        $jumlah = number_format($row["jumlah"], 0, ',', '.');
                    ?>
                        <tr>
                            <td style="text-align: center;"><img src="produk/<?= $row["product_image"]; ?>" height="60" alt=""></td>
                            <td><?= $row["product_name"]; ?></td>
                            <td>Rp. <?= number_format($row["product_price"], 0, ',', '.'); ?> </td>
                            <td>
                                <?php if ($jumlah > 1) { ?>
                                    <a href="?product_id=<?= $row['product_id'] ?>&jumlah=-1" class=""><button>-</button></a>
                                <?php } ?>
                                <?= $jumlah; ?>
                                <a href="?product_id=<?= $row['product_id'] ?>&jumlah=+1" class=""><button>+</button></a>
                            </td>
                            <td>Rp. <?= number_format($row["total_harga"], 0, ',', '.'); ?> </td>
                            <td><u><a href="?delete_cart_id=<?= $row['id'] ?>">Hapus</a></u></td>
                        </tr>
                    <?php
                    endwhile;
                    ?>
                </tbody>
            </table>
        </div>
        <br>

        <!-- <h4>Total Pembayaran Rp. <?php echo number_format($total, 0, ',', '.'); ?> </h4> -->

        <a href="checkout.php" class="button">Buat Pesanan</a>
    </div>
    <br>
    <br>



    <!---footer--->
    <footer>
        <div class="footer_kecil">
            <small>Copyright &copy2024 BatiKraft</small>
        </div>
    </footer>
</body>

</html>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script>
    let harga;
    let qty;
    $('select[name="barang"]').on('change', function() {
        // console.log();
        harga = $(this).find(':selected').attr('data-harga');
        calc_price();
    });

    $('input[name="jumlah"]').on('keyup', function() {
        // console.log();
        qty = $(this).val();
        calc_price();
    });

    function calc_price() {
        console.log(harga);
        console.log(qty);

        if (harga && qty) {
            let total = parseInt(harga) * parseInt(qty);
            $('input[name="harga"]').val(total);
        }
    }
</script>