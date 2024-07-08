<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Event | BatiKraft</title>
    <link rel="stylesheet" href="style2.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@300&display=swap" rel="stylesheet">
</head>

<body>
    <!----header--->
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
            <h3>Tambah Event</h3>
            <div class="box">
                <form action="" method="POST" enctype="multipart/form-data">
                    <input type="text" name="nama" class="input" placeholder="Nama Event" required>
                    <input type="text" name="harga" class="input" placeholder="Harga Event" required>
                    <input type="text" name="kuota" class="input" placeholder="Kuota Event" required>
                    <input type="file" name="gambar" class="input" required>
                    <input type="submit" name="submit" value="Submit" class="button">
                </form>
                <?php
                include 'database.php';

                if (isset($_POST['submit'])) {
                    // Menampung inputan dari form
                    $event_name = $_POST['nama']; // Sesuaikan dengan nama input form
                    $event_price = $_POST['harga']; // Sesuaikan dengan nama input form
                    $even_capacity = $_POST['kuota']; // Sesuaikan dengan nama input form

                    // Menampung file yang diupload
                    $filename = $_FILES['gambar']['name'];
                    $tmp_name = $_FILES['gambar']['tmp_name'];

                    $type1 = explode('.', $filename);
                    $type2 = $type1[1];

                    $newname = 'event' . time() . '.' . $type2;
                    // Menampung format file yang diizinkan
                    $tipe_diizinkan = array('jpg', 'jpeg', 'png', 'gif');
                    // Validasi format file
                    if (!in_array($type2, $tipe_diizinkan)) {
                        // Format file tidak sesuai
                        echo 'Format file tidak sesuai';
                    } else {
                        // Jika format file sesuai
                        // Proses upload file sekaligus insert ke database
                        move_uploaded_file($tmp_name, './produk/' . $newname);

                        // Insert data
                        $insert = mysqli_query($conn, "INSERT INTO tb_event VALUES (
                null,
                '" . $event_name . "',
                '" . $event_price . "',
                '" . $newname . "',
                '" . $even_capacity . "'
            )");
                        if ($insert) {
                            echo 'Simpan data berhasil';
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