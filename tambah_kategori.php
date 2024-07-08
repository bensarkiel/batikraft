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
    <title>Tambah Kategori | BatiKraft</title>
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
            <h3>Tambah Kategori</h3>
            <div class="box">
                <form action="" method="POST">
                    <input type="text" name="nama" placeholder="Nama Kategori" class="input" required>
                    <input type="submit" name="submit" value="Submit" class="button">
                </form>
                <?php
                if (isset($_POST['submit'])) {
                    $nama = ucwords($_POST['nama']);

                    $insert = mysqli_query($conn, "INSERT INTO tb_category VALUES (
                                                null,
                                                '" . $nama . "') ");
                    if ($insert) {
                        echo '<script>alert("Tambah kategori berhasil")</script>';
                        echo '<script>window.location="data_kategori.php"</script>';
                    } else {
                        echo 'Gagal' . mysqli_error($conn);
                    }
                }
                ?>
            </div>
        </div>
    </div><br><br><br><br><br><br>
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