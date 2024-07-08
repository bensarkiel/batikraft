<?php
// error_reporting(true);
// session_start();
include 'database.php';
// header("Location: order.php");
// $cust_id = 6;
session_start();

$cust_id = $_SESSION['customer_id'];
if (isset($_GET['metode_pembayaran'])) {
    $profile_query = mysqli_query($conn, "SELECT * from tb_customer where id_pelanggan = $cust_id");
    $profile = mysqli_fetch_assoc($profile_query);

    $keranjang = mysqli_query($conn, "SELECT *, (tb_cart.jumlah * tb_product.product_price) as total_harga FROM `tb_cart`
                left join tb_customer on tb_customer.id_pelanggan = tb_cart.customer_id
                left join tb_product on tb_product.product_id = tb_cart.product_id;");

    $total = 0;
    while ($row = mysqli_fetch_array($keranjang)) {
        $total += $row["total_harga"];
    }

    // $transaksi = mysqli_query($conn, "INSERT INTO transaksi (id, id_pelanggan, total_harga, pembayaran) VALUES (NULL, '$cust_id', '$total', '{$_POST['metode_pembayaran']}')");
    $transaksi_query = mysqli_query($conn, "select * from transaksi order by id desc limit 1");
    $transaksi = mysqli_fetch_assoc($transaksi_query);
    var_dump($transaksi);

    $keranjang = mysqli_query($conn, "SELECT *, (tb_cart.jumlah * tb_product.product_price) as total_harga FROM `tb_cart`
                left join tb_customer on tb_customer.id_pelanggan = tb_cart.customer_id
                left join tb_product on tb_product.product_id = tb_cart.product_id
                where tb_cart.customer_id = '$cust_id'");
    while ($row = mysqli_fetch_array($keranjang)) {
        mysqli_query($conn, "INSERT INTO transaksi_barang (id, transaksi_id, product_id, jumlah) VALUES (NULL, '{$transaksi['id']}', '{$row['product_id']}', '{$row['jumlah']}')");
    }
    // echo $total;
    header("Location: invoice.php?transaksi_id={$transaksi['id']}");
    
} else {
    header("Location: order.php");
}

?>

