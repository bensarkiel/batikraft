<?php
include 'database.php';
mysqli_select_db($conn, $dbname);

$query = "SELECT * FROM tb_event;";
$sql = mysqli_query($conn, $query);
$no = 0;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Event | BatiKraft</title>
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
    <!---content event--->
    <div class="section">
        <div class="container">
            <h3>CRUD Event</h3>
            <div class="box">
                <p color="#688333" style="text-align: left;"><a href="tambah_event.php">Tambah Event</a></p>
                <table border="1" cellspacing="0" class="tabel">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Event</th>
                            <th>Harga</th>
                            <th>Gambar</th>
                            <th>Kuota</th>
                            <th width="150 px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($result = mysqli_fetch_assoc($sql)) {
                        ?>
                            <tr>
                                <td><?php echo ++$no ?>.</td>
                                <td><?php echo $result['event_name'] ?></td>
                                <td>Rp. <?php echo $result['event_price'] ?></td>
                                <td>
                                    <img src="produk/<?php echo $result['event_image'] ?>" style="width: 150px;">
                                </td>
                                <td><?php echo $result['even_capacity'] ?> kursi</td>
                                <td>
                                    <a href="edit_event.php?id=<?php echo $result['event_id'] ?>">Edit</a> || <a href="hapus_event.php?id=<?php echo $result['event_id']; ?>" onclick="return confirm('Yakin ingin menghapus Event?')">Hapus</a>

                                </td>
                            </tr>
                        <?php
                        }
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