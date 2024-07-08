<!DOCTYPE html>
<html>
    <head>
        <meta charset = "utf-8">
        <meta name = "viewport" content = "width=device-width, initial-scale=1">
        <title>Registrasi Customer | handcraft</title>
        <link rel="stylesheet" href="style2.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@300&display=swap" rel="stylesheet">
        <style>
       

            .address-card-body {
                border: 1px solid #918282;
                border-style: dashed; 
                border-radius: 5px; 
                padding: 5px;
                margin-bottom: 1rem
            }
        </style>
    </head>
    <body id="bg-login">
        <div class="login-box">
            <h2>Register</h2>
            <form action="" method="POST">
                <input type="text" name="nama_lengkap" placeholder="Nama" class="input" title="Kolom nama tidak boleh kosong" required>
                <!-- <input type="text" name="alamat" placeholder="Alamat" class="input"> -->
                <input type="email" name="email" placeholder="Email" class="input" valid_email>
                <input type="password" id="password" name="password" placeholder="Password" 
                title="Minimal 8 karakter dengan perpaduan angka, huruf, dan karakter khusus" class="input" required>
                <!-- <input type="password" name="password" placeholder="Password" class="input" required> -->
                <input type="tel" name="no_hp" pattern="[0-9]{10,12}" placeholder="Telepon" class="input" required>
                <!-- <input type="tel" name="no_hp" placeholder="Telepon" class="input" required> -->
                <input type="text" name="find-address" placeholder="Cari Alamat Anda" class="input" required>
                <div class="address-card" id="areas" style="">
                    
                    
                </div>
                
                <input type="text" name="id_alamat" hidden>
                <input type="text" name="provinsi" hidden>
                <input type="text" name="kota" hidden>
                <input type="text" name="kelurahan" hidden>
                <input type="text" name="kode_pos" hidden>

                <input type="text" name="detail_alamat" placeholder="Alamat detail anda" class="input" required>
                <input type="submit" name="submit" value="Submit" class="button">
                <!-- <p>email : seller</p>
                <p>password : lupapass</p> -->
            </form>
            <?php
                if(isset($_POST['submit'])){
                    session_start();
                    include 'database.php';

                    $nama_lengkap = mysqli_real_escape_string($conn, $_POST['nama_lengkap']);
                    // $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
                    $email = mysqli_real_escape_string($conn, $_POST['email']);
                    $password = mysqli_real_escape_string($conn, $_POST['password']);
                    $no_hp = mysqli_real_escape_string($conn, $_POST['no_hp']);

                    $id_alamat = mysqli_real_escape_string($conn, $_POST['id_alamat']);
                    $provinsi = mysqli_real_escape_string($conn, $_POST['provinsi']);
                    $kota = mysqli_real_escape_string($conn, $_POST['kota']);
                    // $kelurahan = mysqli_real_escape_string($conn, $_POST['kelurahan']);
                    $kecematan = mysqli_real_escape_string($conn, $_POST['kecamatan']);
                    $kode_pos = mysqli_real_escape_string($conn, $_POST['kode_pos']);
                    $detail_alamat = mysqli_real_escape_string($conn, $_POST['detail_alamat']);

                    /*menghubungkan dengan database*/ 
                    $sql = "INSERT INTO `tb_customer` (`id_pelanggan`, `nama_lengkap`, `email`, `password`, `no_hp`, `id_alamat`, `provinsi`, `kota`, `kecamatan`, `kode_pos`, `detail_alamat`) VALUES (NULL, '$nama_lengkap', '$email', '$password', '$no_hp', '$id_alamat', '$provinsi', '$kota', '$kecamatan', '$kode_pos', '$detail_alamat')";
                    $cek = mysqli_query($conn, $sql);
                    
                    header("Location: login_cust.php");
                }
            ?>
        </div>
    </body>
</html>
<!-- <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script> -->
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        
        $('input[name="find-address"]').on('keyup', function() {
            var address = $(this).val();
            findMap(address);
        });

        $('#areas').on("click",".address_detail", function(e){ //user click on remove text
            // e.preventDefault();
            
            var address = $(this)[0].dataset;
            console.log(address);
            for (const key in address) {
                if (Object.hasOwnProperty.call(address, key)) {
                    const value = address[key];
                    console.log(value);
                    $(`input[name="${key}"]`).val(value);
                }
            }

            $('input[name="find-address"]').val(address.area_name);
        });

        function findMap(search) {
            $.ajax({
                url: "https://api.biteship.com/v1/maps/areas?countries=ID&type=single",
                method: "GET",
                data: {
                    input: search
                },
                cache: false,
                headers: {
                    // 'Access-Control-Allow-Origin': '*',
                    // 'Access-Control-Allow-Methods': 'PUT, GET, HEAD, POST, DELETE, OPTIONS',
                    'Content-type': 'application/json',
                    authorization: 'biteship_test.eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJuYW1lIjoiTG9jYWxob3N0IiwidXNlcklkIjoiNjQ4NThjNDI2OWEzNDYzNzQwMjAwNDFkIiwiaWF0IjoxNjg2NDczOTgyfQ.nl7lBx06zBbqlwfON4t2ETVHyA0PhEx4nHvxCcYWXB0'
                },
                success: function(response){
                    console.log(response.areas)
                    $('.address-card').empty();
                    var limit = response.areas.length > 3 ? 3 : response.areas.length;
                    for (let i = 0; i < limit; i++) {
                        const area = response.areas[i];
                        $('.address-card').append(`
                            <div class="address-card-body" style="">
                                <input type="radio" class="address_detail" name="address_detail"
                                    data-id_alamat="${area.id}"
                                    data-provinsi="${area.administrative_division_level_1_name}"
                                    data-kota="${area.administrative_division_level_2_name}"
                                    data-kelurahan="${area.administrative_division_level_3_name}"
                                    data-kode_pos="${area.postal_code}"
                                    data-area_name="${area.name}"
                                    value="${area.id}"
                                >
                                <small>${area.name}</small>
                            </div>
                        `);                    
                    }
                },
                error: function(response){
                    console.log(response)
                },
            });
        }
    });
</script>