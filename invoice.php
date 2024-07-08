<?php
include 'database.php';
session_start();

$cust_id = $_SESSION['customer_id'];
$transaksi_id = $_GET['transaksi_id'];

$transaksi_query = mysqli_query($conn, "SELECT *, (select sum(c.product_price * b.jumlah) from transaksi_barang b left join tb_product c on c.product_id = b.product_id where b.transaksi_id = transaksi.id) as total from transaksi where id = $transaksi_id");
$transaksi = mysqli_fetch_assoc($transaksi_query);
$cust_id = $transaksi['id_pelanggan'];

$profile_query = mysqli_query($conn, "SELECT * from tb_customer where id_pelanggan = $cust_id");
$profile = mysqli_fetch_assoc($profile_query);


$resi = mt_rand(100000000000000, 999999999999999);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Invoice | BatiKraft</title>
    <link rel="stylesheet" href="style2.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@300&display=swap" rel="stylesheet">
    <script src="pdf.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>

    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous"> -->
    <style media="print">
        .noPrint {
            display: none !important;
        }

        .yesPrint {
            display: block !important;
        }
    </style>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap");

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Work Sans", sans-serif;
        }

        body {
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        .modal_content {
            display: none;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 75%;
            height: 80%;
            letter-spacing: 1px;
            line-height: 28px;
            text-align: center;
            /* background: rgb(70, 70, 130); */
            background: #b5adad;
            color: #fff;
            /* padding: 15px; */
            /* border-radius: 30px; */
        }

        .modal_content .modal_title h2 {
            margin-bottom: 30px;
            margin-top: 20px;
        }

        .modal_content .close_btn p {
            text-align: right;
            cursor: pointer;
            font-size: 24px;
        }

        .modal_content .close_btn i {
            display: flex;
            justify-content: flex-end;
            font-size: 30px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <!---header--->
    <header>
        <div class="container">
            <h1><a href="index.php">BatiKraft</a></h1>
        </div>
    </header>
    <!-- <div>
        <button class="back" onclick="history.back()"><i class="fa-solid fa-angle-left"></i></button>
    </div> -->
    <section id="content">
        <main>
            <div class="table-data">
                <div class="order">
                    <div class="section">
                        <div class="container">
                            <h3>Invoice</h3>
                        </div>
                    </div>
                    <br>
                    <div class="head-title information">
                        <table style="width: 100%">
                            <tr>
                                <td style="width: 50%">
                                    <?php echo "<b>Date : </b>" . date(" d/m/Y") ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <br>
                    <div class="head-title information">
                        <table style="width: 100%">
                            <tr>
                                <td style="width: 50%; padding-right: 60px; vertical-align: text-top;">
                                    <p><b>Invoice To : </b></p>
                                    <p>Nama : <?= $profile['nama_lengkap'] ?></p>
                                    <p>No Hp : <?= $profile['no_hp'] ?></p>
                                    <p>Alamat : <?= $profile['detail_alamat'] ?>, <?= $profile['kelurahan'] ?>, <?= $profile['kota'] ?>, <?= $profile['provinsi'] ?>, <?= $profile['kode_pos'] ?></p>

                                    <br>
                                    <!-- <p><b>Status Pesanan : </b> <?= $transaksi['status_pesanan'] ?> <?= $transaksi['status_pesanan'] == 'Penerimaan' ? '- Paket telah diterima' : '' ?></p> -->
                                    <!-- <br> -->
                                    <p><b>No Resi : </b> <?= $resi ?></p>
                                </td>
                                <td style="width: 50%; padding-left: 85px">
                                    <!-- <p><b>Total Bayar : Rp. <?= number_format($transaksi['total_harga']) ?></b></p> -->


                                    <p class="noPrint"><b>Pay To : </b></p>
                                    <?php if ($transaksi['pembayaran'] == "cod") { ?>
                                        <p>Bayar Di Tempat</p>
                                    <?php } else { ?>
                                        <p class="noPrint"><?= $transaksi['payment_method_code'] == 'COD' ? '' : "Transfer Ke " ?> <?= strtoupper($transaksi['pembayaran']) ?> <?= $transaksi['pay_code'] ?></p>
                                    <?php } ?>

                                    <p></p>
                                </td>
                            </tr>
                        </table>

                    </div>
                    <br class="noPrint"><br>
                    <div class="head-title information noPrint">
                        <table style="width: 100%">
                            <tr>
                                <td>

                                    <a href="proses_pengiriman.php?transaksi_id=<?= $transaksi['id'] ?>&status_pesanan=Penerimaan" <?= $transaksi['status_pesanan'] == 'Pengiriman' ? '' : 'hidden' ?>>
                                        <button class="button" style="background-color: #6DB758; color : #FFFF">Pesanan Diterima</button>
                                    </a>

                                    <a href="#" onclick="window.print();" <?= isset($_SESSION['id']) ? '' : 'hidden' ?>>
                                        <button class="button" style="background-color: #b396bc; color : #FFFF">Cetak Invoice </button>
                                    </a>


                                    <a href="<?= $transaksi['checkout_url'] ?>" target="__blank">
                                        <button class="button" style="background-color: #b396bc; color : #FFFF">Rician Pembayaran</button>
                                    </a>
                                </td>
                            </tr>

                        </table>
                    </div>


                    <br>

                    <div>
                        <div class="box">
                            <table border="1" cellspacing="0" class="tabel">
                                <thead>
                                    <tr>
                                        <th>Foto Produk</th>
                                        <th>Nama Produk</th>
                                        <th>Harga</th>
                                        <th>Jumlah Produk</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    $keranjang = mysqli_query($conn, "SELECT *, (transaksi_barang.jumlah * tb_product.product_price) as total_harga FROM `transaksi_barang`
                                right join tb_product on tb_product.product_id = transaksi_barang.product_id
                                where transaksi_barang.transaksi_id = {$transaksi_id}");

                                    $no = 0;
                                    $total = 0;
                                    while ($row = mysqli_fetch_array($keranjang)) :
                                        $total += $row["total_harga"];
                                    ?>
                                        <tr>
                                            <td style="text-align: center;"><img src="produk/<?= $row["product_image"]; ?>" height="60" alt=""></td>
                                            <td><?= $row["product_name"]; ?></td>
                                            <td>Rp. <?= number_format($row["product_price"], 0, ',', '.'); ?> </td>
                                            <td><?= number_format($row["jumlah"], 0, ',', '.'); ?> Barang</td>
                                            <td>Rp. <?= number_format($row["total_harga"], 0, ',', '.'); ?> </td>
                                        </tr>
                                    <?php
                                    endwhile;
                                    ?>
                                </tbody>

                            </table>
                            <p>Total pembayaran: Rp. <?= number_format($transaksi['total_harga']) ?></p>
                        </div>
                    </div>
                    <center class="noPrint">
                        <p><b>Terimakasih Sudah Berbelanja di toko kami <3< /b>
                        </p>
                    </center>
                </div>
        </main>
    </section>
    <!---footer--->
    <footer>
        <div class="footer_kecil">
            <div class="container">
                <small>Copyright &copy2024 BatiKraft</small>
            </div>
        </div>
    </footer>

    <button class="btn noPrint" id="btn-co-page" hidden>Open Modal</button>


    <div class="modal_content noPrint">
        <div class="close_btn">
            <i class='bx bxs-x-circle'></i>
        </div>
        <div class="modal_info" style="height: 100%">
            <iframe src="<?= $transaksi['checkout_url'] ?>" frameborder="0" style="width: 100%; height: 100%"></iframe>
        </div>
    </div>

</body>
<br><br>

</html>

<?php

/** Hapus cart */
mysqli_query($conn, "DELETE FROM tb_cart where customer_id = '$cust_id'");

?>

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script>
    <?php if ($transaksi['payment_method_code'] !== 'COD') { ?>
        $(document).ready(function() {
            $('.modal_content').css('display', 'block');
            $('button').click(function() {
                $('.modal_content').css('display', 'block');
            })
            $('.close_btn').click(function() {
                $('.modal_content').css('display', 'none');
            })
            $('body').click(function() {
                $('.modal_content').css('display', 'none');
            })
        });

    <?php } ?>
</script>