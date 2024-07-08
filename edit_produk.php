<?php
session_start();
include 'database.php';
if ($_SESSION['login_status'] != true) {
    echo '<script>window.location="login.php"</script>';
}

$produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_id = '" . $_GET['id'] . "' ");
if (mysqli_num_rows($produk) == 0) {
    echo '<script>window.location ="data_produk.php"</script>';
}
$p = mysqli_fetch_object($produk);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Produk | BatiKraft</title>
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
    <!---kategori--->
    <div class="section">
        <div class="container">
            <h3>Edit Produk</h3>
            <div class="box">
                <form action="" method="POST" enctype="multipart/form-data">
                    <select class="input" name="kategori" required>
                        <option value="">Pilih</option>
                        <?php
                        $kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
                        while ($r = mysqli_fetch_array($kategori)) {
                        ?>
                            <option value="<?php echo $r['category_id'] ?>" <?php echo ($r['category_id'] == $p->category_id) ? 'selected' : ''; ?>><?php echo $r['category_name'] ?></option>
                        <?php } ?>
                    </select>

                    <input type="text" name="nama" class="input" placeholder="Nama Produk" value="<?php echo $p->product_name ?>" required>
                    <input type="text" name="harga" class="input" placeholder="Harga Produk" value="<?php echo $p->product_price ?>" required>

                    <img src="produk/<?php echo $p->product_image ?>" width="150px">
                    <input type="hidden" name="foto" value="<?php echo $p->product_image ?>">
                    <input type="file" name="gambar" class="input">
                    <textarea class="input" name="deskripsi" placeholder="Deskripsi Produk"><?php echo $p->product_description ?></textarea>
                    <select class="input" name="status">
                        <option value="">Pilih</option>
                        <option value="1" <?php echo ($p->product_status == 1) ? 'selected' : ''; ?>>Aktif</option>
                        <option value="0" <?php echo ($p->product_status == 0) ? 'selected' : ''; ?>>Tidak Aktif</option>
                    </select>
                    <input type="text" name="stok" class="input" placeholder="Stok Produk" value="<?php echo $p->stock ?>" required>
                    <input type="submit" name="submit" value="Submit" class="button">
                </form>
                <?php
                if (isset($_POST['submit'])) {

                    //inputan dari form

                    $kategori   = $_POST['kategori'];
                    $nama       = $_POST['nama'];
                    $harga      = $_POST['harga'];
                    $deskripsi  = $_POST['deskripsi'];
                    $status     = $_POST['status'];
                    $stok       = $_POST['stok'];
                    $foto       = $_POST['foto'];
                    //inputan gambar baru
                    $filename = $_FILES['gambar']['name'];
                    $tmp_name = $_FILES['gambar']['tmp_name'];

                    $type1 = explode('.', $filename);
                    $type2 = $type1[1]; //$type2 berisi format file

                    $newname = 'produk' . time() . '.' . $type2;

                    //menampung format file yang diizinkan
                    $tipe_diizinkan = array('jpg', 'jpeg', 'png', 'gif');
                    //jika gambar diubah
                    if ($filename != '') {
                        //validasi format file
                        if (!in_array($type2, $tipe_diizinkan)) {
                            //format file tidak sesuai
                            echo 'Format file tidak sesuai';
                        } else {
                            unlink('./produk/' . $foto);
                            move_uploaded_file($tmp_name, './produk/' . $newname);
                            $namagambar = $newname;
                        }
                    } else {
                        //jika tidak ubah gambar
                        $namagambar = $foto;
                    }
                    //query update produk
                    $update = mysqli_query($conn, "UPDATE tb_product SET
                                                    category_id = '" . $kategori . "', 
                                                    product_name = '" . $nama . "',
                                                    product_price = '" . $harga . "',
                                                    product_description = '" . $deskripsi . "',
                                                    product_image = '" . $namagambar . "',
                                                    product_status = '" . $status . "',
                                                    stock = '" . $stok . "'
                                                    WHERE product_id = '" . $p->product_id . "'");
                    if ($update) {
                        //echo 'Ubah data berhasil';
                        echo '<script>window.location="data_produk.php"</script>';
                    } else {
                        echo 'Gagal menyimpan' . mysqli_error($conn);
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <!---footer--->
    <footer>
        <div class="container">
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