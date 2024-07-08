<?php
session_start();
include 'database.php';
if ($_SESSION['login_status'] != true) {
    echo '<script>window.location="login.php"</script>';
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD Produk | BatiKraft</title>
    <link rel="stylesheet" href="style2.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@300&display=swap" rel="stylesheet">
</head>

<body>
    <!---header--->
    <header>
        <div class="container">
            <h1><a href="beranda_admin.php">BatiKraft</a></h1>
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
    <!---content kategori--->
    <div class="section">
        <div class="container">
            <h3>CRUD Produk</h3>
            <div class="box">
                <p color="#688333" style="text-align: left;"><a href="tambah_produk.php">Tambah Produk</a></p>
                <table border="1" cellspacing="0" class="tabel">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kategori</th>
                            <th>Nama</th>
                            <th>Harga</th>
                            <th>Gambar</th>
                            <th>Status</th>
                            <th>Stok</th>
                            <th width="150px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $produk = mysqli_query($conn, "SELECT * FROM tb_product LEFT JOIN tb_category USING (category_id) ORDER BY product_id DESC");
                        if (mysqli_num_rows($produk) > 0) {
                            while ($row = mysqli_fetch_array($produk)) {
                        ?>
                                <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $row['category_name'] ?></td>
                                    <td><?php echo $row['product_name'] ?></td>
                                    <td>Rp. <?php echo number_format($row['product_price']) ?></td>
                                    <td><a href="produk/<?php echo $row['product_image'] ?>" target="_blank"><img src="produk/<?php echo $row['product_image'] ?>" width="60px"></a></td>
                                    <td><?php echo ($row['product_status'] == 0) ? 'Tidak Aktif' : 'Aktif'; ?></td>
                                    <td><?php echo $row['stock'] ?></td>
                                    <td>
                                        <a href="edit_produk.php?id=<?php echo $row['product_id'] ?>">Edit</a> || <a href="hapus_kategori.php?idp=<?php echo $row['product_id'] ?>" onclick="return confirm('Yakin ingin menghapus produk?')">Hapus</a>
                                    </td>
                                </tr>
                            <?php }
                        } else { ?>
                            <tr>
                                <td colspan="8">Tidak ada data</td>
                            </tr>
                        <?php } ?>
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
            <p>BatiKraftSMG@gmail.com</p>
            <br>

            <h3 style="text-align: center;">Telp</h3>
            <p>081256123765</p>
            <br>
            <small>Copyright &copy2024 BatiKraft</small>
        </div>
    </footer>
</body>

</html>