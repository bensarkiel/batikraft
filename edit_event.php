<?php
session_start();
include 'database.php';
if ($_SESSION['login_status'] != true) {
    echo '<script>window.location="login.php"</script>';
}
$event = mysqli_query($conn, "SELECT * FROM tb_event WHERE event_id = '" . $_GET['id'] . "' ");
if (mysqli_num_rows($event) == 0) {
    echo '<script>window.location ="data_event.php"</script>';
}
$k = mysqli_fetch_object($event);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk | BatiKraft</title>
    <<link rel="stylesheet" href="style2.css">
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
                <li><a href="profile.php">Profil</a></li>
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
            <h3>Edit Event</h3>
            <div class="box">
                <form action="" method="POST" enctype="multipart/form-data">
                    <input type="text" name="nama" class="input" placeholder="Nama Event" value="<?php echo $k->event_name ?>" required>
                    <input type="text" name="harga" class="input" placeholder="Harga Event" value="<?php echo $k->event_price ?>" required>
                    <input type="text" name="kuota" class="input" placeholder="Kuota Event" value="<?php echo $k->even_capacity ?>" required>
                    <img src="produk/<?php echo $k->event_image ?>" width="150px">
                    <input type="hidden" name="foto" value="">
                    <input type="file" name="gambar" class="input">
                    <input type="submit" name="submit" value="Submit" class="button">
                </form>
                <?php
                if (isset($_POST['submit'])) {
                    // Input from the form
                    $event_name = $_POST['nama'];
                    $event_price = $_POST['harga'];
                    $even_capacity = $_POST['kuota'];
                    // $foto = $_POST['gambar'];

                    // New image file
                    $filename = $_FILES['gambar']['name'];
                    $tmp_name = $_FILES['gambar']['tmp_name'];

                    // Valid image file types
                    $allowed_types = array('jpg', 'jpeg', 'png', 'gif');
                    $type1 = explode('.', $filename);
                    $type2 = strtolower(end($type1));

                    // New image name
                    $newname = 'produk' . time() . '.' . $type2;

                    // Check if the file type is allowed
                    if (!in_array($type2, $allowed_types)) {
                        echo 'Format file tidak sesuai';
                    } else {
                        // Delete the existing image file
                        unlink('./produk/' . $foto);

                        // Move the new image file to the directory
                        move_uploaded_file($tmp_name, './produk/' . $newname);

                        // Update the event details in the database
                        $update = mysqli_query($conn, "UPDATE tb_event SET
                            event_name = '$event_name',
                            event_price = '$event_price',
                            even_capacity = '$even_capacity',
                            event_image = '$newname'
                            WHERE event_id = '" . $k->event_id . "'");

                        if ($update) {
                            echo '<script>window.location="data_event.php"</script>';
                        } else {
                            echo 'Gagal menyimpan' . mysqli_error($conn);
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
            <h3>Alamat</h3>
            <p>Jl.Soekarno Hatta No.9, Semarang, Jawa Tengah</p>
            <br>

            <h3>E-mail</h3>
            <p>BatiKraftSMG@gmail.com</p>
            <br>

            <h3>Telp</h3>
            <p>081256123765</p>
            <br>

            <small>Copyright &copy2023 BatiKraft</small>
    </footer>
    </div>
</body>

</html>