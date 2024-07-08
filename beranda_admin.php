<?php
    session_start();
    include 'database.php';
    
    if($_SESSION['login_status'] != true){
        echo '<script>window.location="login.php"</script>';
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset = "utf-8">
        <meta name = "viewport" content = "width=device-width, initial-scale=1">
        <title>Beranda Admin | BatikKraft</title>
        <link rel="stylesheet" href="style2.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@300&display=swap" rel="stylesheet">
    </head>
    <body> 
        <!---header--->
        <header>
            <div class="container">    
                <h1><a href="beranda_admin.php">BatikKraft</a></h1>
                <ul>
                    <li><a href="beranda_admin.php">Beranda</a></li>
                    <li><a href="profil.php">Profil</a></li>
                    <li><a href="data_kategori.php">Kategori</a></li>
                    <li><a href="data_produk.php">Produk</a></li>
                    <li><a href="data_event.php">Event</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </div>    
        </header>
        
        <!---content beranda---> 
        <div class="section">
            <div class="container">
                <h3>Beranda</h3>
                <div class="box">
                    <h4>Detail Pemesanan Pelanggan</h4>
                </div>

                <div class="box">
                    <table border="1" cellspacing="0" class="tabel">
                        <thead>
                            <tr>
                                <th>Nama Pelanggan</th>
                                <th>Tanggal Pemesanan</th>
                                <th>Pembayaran</th>
                                <th>Jumlah Barang</th>
                                <th>Total Harga</th>
                                <th>Cetak</th>
                                <!-- <th>Proses</th> -->
                                <!-- <th>checkout url</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $keranjang = mysqli_query($conn, "SELECT transaksi.*, tb_customer.nama_lengkap, (select count(id) from transaksi_barang where transaksi_barang.transaksi_id = transaksi.id ) as jumlah_barang FROM `transaksi`
                            left join tb_customer on transaksi.id_pelanggan = tb_customer.id_pelanggan");

                            $no = 0;
                            $total = 0;
                            while ($row = mysqli_fetch_array($keranjang)) :
                                
                            ?>
                                <tr>
                                    <td><?= $row["nama_lengkap"]; ?></td>
                                    <td><?= $row["created_at"]; ?></td>
                                    <td><?= $row["pembayaran"]; ?></td>
                                    <td><?= $row["jumlah_barang"]; ?></td>
                                    <td><?= $row["total_harga"]; ?></td>
                                    <td><u><a href="invoice.php?transaksi_id=<?= $row['id'] ?>" target="_blank" rel="noopener noreferrer">Invoice</a></u></td>
                                    <!-- <td><u><a href="proses_pengiriman.php?transaksi_id=<?= $row['id'] ?>" target="_blank" rel="noopener noreferrer">Proses</a></u></td> -->
                                </tr>
                            <?php
                            endwhile;
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!---footer--->
        <footer>
            <div class="container">
                <h3 style="text-align: center;">Alamat</h3>
                <p>Jl.Soekarno Hatta No.9, Semarang, Jawa Tengah</p>
                <br>

                <h3 style="text-align: center;">E-mail</h3>
                <p>BatikKraftSMG@gmail.com</p>
                <br>

                <h3 style="text-align: center;">Telp</h3>
                <p>081256123765</p>
                <br>
                <small>Copyright &copy2024 BatikKraft</small>
            </div>
        </footer>
    </body>
</html>