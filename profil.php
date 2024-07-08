<?php
session_start();
include 'database.php';
if ($_SESSION['login_status'] != true) {
    echo '<script>window.location="login.php"</script>';
}
$query = mysqli_query($conn, "SELECT * FROM tb_admin WHERE admin_id = '" . $_SESSION['id'] . "' ");
$d = mysqli_fetch_object($query);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profil Admin | BatiKraft</title>
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
    <!---data admin--->
    <div class="section">
        <div class="container">
            <h3>Profil</h3>
            <div class="box">
                <form action="" method="POST">
                    <input type="text" name="nama" placeholder="Nama Lengkap" class="input" value="<?php echo $d->admin_name ?>" required>
                    <input type="text" name="user" placeholder="Username" class="input" value="<?php echo $d->username ?>" required>
                    <input type="text" name="telp" placeholder="No. Telepon" class="input" value="<?php echo $d->admin_telp ?>" required>
                    <input type="text" name="email" placeholder="Email" class="input" value="<?php echo $d->admin_email ?>" required>
                    <input type="text" name="alamat" placeholder="Alamat" class="input" value="<?php echo $d->admin_address ?>" required>
                    <input type="submit" name="submit" value="Ubah Profil" class="button">
                </form>
                <?php
                if (isset($_POST['submit'])) {
                    $nama   = ucwords($_POST['nama']);
                    $user   = $_POST['user'];
                    $telp   = $_POST['telp'];
                    $email  = $_POST['email'];
                    $alamat = ucwords($_POST['alamat']);

                    //ubah data profil admin
                    $update = mysqli_query($conn, "UPDATE tb_admin SET
                                    admin_name = '" . $nama . "',
                                    username = '" . $user . "',
                                    admin_telp = '" . $telp . "',
                                    admin_email = '" . $email . "',
                                    admin_address = '" . $alamat . "'
                                    WHERE admin_id = '" . $d->admin_id . "'");
                    if ($update) {
                        echo '<script>alert("Ubah data profil berhasil")</script>';
                        echo '<script>window.location="profil.php"</script>';
                    } else {
                        echo 'Gagal' . mysqli_error($conn);
                    }
                }
                ?>
            </div>
            <!---ubah password admin --->
            <h3>Ubah Password</h3>
            <div class="box">
                <form action="" method="POST">
                    <input type="password" name="pass1" placeholder="Masukan Password Baru" class="input" required>
                    <input type="password" name="pass2" placeholder="Konfirmasi Password Baru" class="input" required>
                    <input type="submit" name="ubah_password" value="Password" class="button">
                </form>
                <?php
                if (isset($_POST['ubah_password'])) {
                    $pass1   = $_POST['pass1'];
                    $pass2   = $_POST['pass2'];

                    if ($pass2 != $pass1) {
                        echo '<script>alert("Konfirmasi Password Baru Gagal")</script>';
                    } else {
                        $update_password = mysqli_query($conn, "UPDATE tb_admin SET
                                    password = '" . $pass1 . "'
                                    WHERE admin_id = '" . $d->admin_id . "'");
                        if ($update_password) {
                            echo '<script>alert("Ubah password berhasil")</script>';
                            echo '<script>window.location="profil.php"</script>';
                        } else {
                            echo 'Gagal' . mysqli_error($conn);
                        }
                    }
                }
                ?>
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