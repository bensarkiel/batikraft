<?php
include 'database.php';
session_start();

$cust_id = $_SESSION['customer_id'];

$profile_query = mysqli_query($conn, "SELECT * from tb_customer where id_pelanggan = $cust_id");
$profile = mysqli_fetch_assoc($profile_query);

$barang = mysqli_query($conn, "SELECT *, (tb_cart.jumlah * tb_product.product_price) as total_harga FROM `tb_cart`
    left join tb_customer on tb_customer.id_pelanggan = tb_cart.customer_id
    left join tb_product on tb_product.product_id = tb_cart.product_id 
    where tb_cart.customer_id = '$cust_id'");

$barangs = mysqli_query($conn, "SELECT *, (tb_cart.jumlah * tb_product.product_price) as total_harga FROM `tb_cart`
    left join tb_customer on tb_customer.id_pelanggan = tb_cart.customer_id
    left join tb_product on tb_product.product_id = tb_cart.product_id
    where tb_cart.customer_id = '$cust_id'");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Checkout | BatiKraft</title>
    <link rel="stylesheet" href="style2.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@300&display=swap" rel="stylesheet">
    <style>
        /* .kurir-card {
            
        } */

        .kurir-card-body {
            border: 1px solid #918282;
            border-style: dashed;
            border-radius: 5px;
            padding: 5px;
            margin-bottom: 1rem;
            width: 400px
        }
    </style>
</head>

<body>
    <!---header--->
    <header>
        <div class="container">
            <h1><a href="index.php">BatiKraft</a></h1>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="produk.php">Produk</a></li>
                <li><a href="order.php">Keranjang</a></li>
                <li><a href="logout_cust.php">Logout</a></li>
            </ul>
        </div>
    </header>
    <!-- <form action="invoice_proccess.php" method="post"> -->
    <form action="tripay/request.php" method="post" style="padding-left: 1rem; padding-right: 1rem">
        <div class="section">
            <div class="container">
                <h3>Detail Pemesanan</h3>
            </div>
        </div>
        <h3 style="text-align: left;">Data Customer</h3>
        <table>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td>
                    <?= $profile['nama_lengkap'] ?>
                    <input hidden type="text" name="customer_name" value="<?= $profile['nama_lengkap'] ?>">
                </td>
            </tr>
            <tr>
                <td>email</td>
                <td>:</td>
                <td><?= $profile['email'] ?>
                    <input hidden type="text" name="customer_email" value="<?= $profile['email'] ?>">
                </td>
            </tr>
            <tr>
                <td>No HP</td>
                <td>:</td>
                <td><?= $profile['no_hp'] ?>
                    <input hidden type="text" name="customer_phone" value="<?= $profile['no_hp'] ?>">
                </td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td><?= $profile['detail_alamat'] ?>, <?= $profile['kelurahan'] ?>, <?= $profile['kota'] ?>, <?= $profile['provinsi'] ?>, <?= $profile['kode_pos'] ?>
                    <input hidden type="text" name="id_alamat" value="<?= $profile['id_alamat'] ?>">
                </td>
            </tr>
        </table>

        <br>
        <h3 style="text-align: left;">Kurir Pengiriman</h3>
        <div class="kurir-card" id="kurir-card" style="margin-top: 1rem">

        </div>
        <input type="text" name="courier_name" hidden>
        <input type="text" name="shipment_description" hidden>
        <input type="text" name="shipment_duration" hidden>
        <input type="text" name="shipment_price" hidden>

        <br>

        <h3 style="text-align: left;">Metode Pembayaran</h3>
        <select name="method" id="">
            <?php
            $produk = mysqli_query($conn, "SELECT * FROM payment_methods");
            while ($row = mysqli_fetch_array($produk)) {
            ?>
                <option value="<?= $row['code'] ?>"><?= $row['name'] ?></option>
            <?php } ?>
        </select>
        <br>
        <br>
        <div class="box">
            <table border="1" cellspacing="0" class="tabel">
                <thead>
                    <tr>
                        <th>Foto Produk</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Jumlah Produk</th>
                        <th>Total</th>
                        <th>Aksi</th>
                    </tr>

                </thead>

                <tbody>
                    <tr hidden>
                        <td>
                            <input type="text" name="order_items[0][name]" value="Ongkos Kirim">
                            <input type="text" name="order_items[0][quantity]" value="1">
                            <input type="text" name="order_items[0][price]" value="">
                        </td>
                    </tr>

                    <?php

                    $no = 1;
                    $total = 0;
                    while ($row = mysqli_fetch_array($barang)) :
                        $total += $row["total_harga"];
                    ?>
                        <tr>
                            <td hidden>
                                <input type="text" name="order_items[<?= $no ?>][name]" value="<?= $row["product_name"]; ?>">
                                <input type="text" name="order_items[<?= $no ?>][quantity]" value="<?= $row["jumlah"]; ?>">
                                <input type="text" name="order_items[<?= $no ?>][price]" value="<?= $row["product_price"]; ?>">
                            </td>
                            <td style="text-align: center;"><img src="produk/<?= $row["product_image"]; ?>" height="60" alt=""></td>
                            <td><?= $row["product_name"]; ?></td>
                            <td>Rp. <?= number_format($row["product_price"], 0, ',', '.'); ?> </td>
                            <td><?= number_format($row["jumlah"], 0, ',', '.'); ?> Barang</td>
                            <td>Rp. <?= number_format($row["total_harga"], 0, ',', '.'); ?> </td>
                            <td><u><a href="?delete_cart_id=<?= $row['id'] ?>">Hapus</a></u></td>
                        </tr>
                    <?php
                        $no++;
                    endwhile;
                    ?>

                </tbody>
            </table>
            <p>Total pembayaran: <span id="ongkir"></span></p>
        </div>

        <br>

        <button type="submit" class="button">Check Out</button>
    </form>
    <!---footer--->
    <footer>
        <div class="footer_kecil">
            <small>Copyright &copy2024 BatiKraft</small>
        </div>
    </footer>
</body>

</html>

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {

        $('input[name="find-kurir"]').on('keyup', function() {
            var kurir = $(this).val();
            findCourier(kurir);
        });

        $('#kurir-card').on("click", ".kurir_detail", function(e) { //user click on remove text
            // e.preventDefault();
            // console.log($(this));

            var kurir = $(this)[0].dataset;

            let total = <?= $total ?>;
            let total_semua = total + parseInt(kurir["shipment_price"]);

            let number_string = total_semua.toString(),
                sisa = number_string.length % 3,
                rupiah = number_string.substr(0, sisa),
                ribuan = number_string.substr(sisa).match(/\d{3}/g);
            if (ribuan) {
                let separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            $(`#ongkir`).text(`Rp. ${rupiah}`);
            $('input[name="order_items[0][price]"]').val(kurir["shipment_price"]);

            for (const key in kurir) {
                if (Object.hasOwnProperty.call(kurir, key)) {
                    const value = kurir[key];
                    console.log(value);
                    $(`input[name="${key}"]`).val(value);

                }
            }
        });
        findCourier();

        function findCourier() {
            let items = [];

            <?php

            $no = 0;
            $total = 0;
            while ($row = mysqli_fetch_array($barangs)) :
                $total += $row["total_harga"];
            ?>
                // items[<?= $no ?>].name = '<?= $row["product_name"]; ?>';
                var obj = {
                    name: '<?= $row["product_name"]; ?>',
                    value: parseInt('<?= $row["product_price"]; ?>'),
                    quantity: parseInt('<?= $row["jumlah"]; ?>'),
                    weight: 10
                };

                items.push(obj);
            <?php
                $no++;
            endwhile;
            ?>

            console.log(items);

            $.ajax({
                url: "https://api.biteship.com/v1/rates/couriers",
                method: "POST",
                // dataType: 'json',
                contentType: 'application/json',
                data: JSON.stringify({
                    origin_area_id: 'IDNP10IDNC393IDND4704IDZ50131',
                    destination_area_id: '<?= $profile['id_alamat'] ?>',
                    couriers: 'jne',
                    items: items
                }),
                cache: false,
                headers: {
                    authorization: 'biteship_test.eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJuYW1lIjoiTG9jYWxob3N0IiwidXNlcklkIjoiNjQ4NThjNDI2OWEzNDYzNzQwMjAwNDFkIiwiaWF0IjoxNjg2NDczOTgyfQ.nl7lBx06zBbqlwfON4t2ETVHyA0PhEx4nHvxCcYWXB0'
                },
                success: function(response) {
                    console.log(response)
                    $('.kurir-card').empty();
                    var limit = response.pricing.length > 3 ? 3 : response.pricing.length;
                    for (let i = 0; i < limit; i++) {
                        const rate = response.pricing[i];
                        $('.kurir-card').append(`
                            <div class="kurir-card-body" style="">
                                <input type="radio" class="kurir_detail" name="kurir_detail"
                                    data-courier_name="${rate.courier_name}"
                                    data-shipment_description="${rate.description}"
                                    data-shipment_duration="${rate.duration}"
                                    data-shipment_price="${rate.price}"
                                    value="${rate.company}${rate.courier_name}${rate.price}"
                                >
                                <small>${rate.courier_name} / ${rate.duration} Rp. ${format(rate.price)}</small>
                                <br>
                                <small>${rate.description}</small>
                            </div>
                        `);
                    }
                },
                error: function(response) {
                    console.log(response)
                    response = {
                        "success": true,
                        "message": "berhasil mengambil harga logistik",
                        "origin": {
                            "latitude": -6.3031123,
                            "longitude": 106.7794934999,
                            "postal_code": 12440,
                            "country_name": "Indonesia",
                            "country_code": "IDN",
                            "administrative_division_level_1_name": "DKI Jakarta",
                            "administartive_division_level_1_type": "province",
                            "administrative_division_level_2_name": "Jakarta Selatan",
                            "administartive_division_level_2_type": "city",
                            "administrative_division_level_3_name": "Cilandak",
                            "administartive_division_level_3_type": "district",
                            "administrative_division_level_4_name": "Lebak bulus",
                            "administartive_division_level_4_type": "subdistrict",
                        },
                        "destination": {
                            "latitude": -6.2441792,
                            "longitude": 106.783529000,
                            "postal_code": 12240,
                            "country_name": "Indonesia",
                            "country_code": "IDN",
                            "administrative_division_level_1_name": "DKI Jakarta",
                            "administartive_division_level_1_type": "province",
                            "administrative_division_level_2_name": "Jakarta Selatan",
                            "administartive_division_level_2_type": "city",
                            "administrative_division_level_3_name": "Cilandak",
                            "administartive_division_level_3_type": "district",
                            "administrative_division_level_4_name": "Lebak bulus",
                            "administartive_division_level_4_type": "subdistrict",
                        },
                        "pricing": [{
                                "company": "jet",
                                "courier_name": "JET Express",
                                "courier_code": "jet",
                                "courier_service_name": "Cargo",
                                "courier_service_code": "crg",
                                "type": "crg",
                                "description": "Layanan kargo diatas 10 kg",
                                "duration": "3 - 6 Hari",
                                "shipment_duration_range": "3 - 6",
                                "shipment_duration_unit": "days",
                                "service_type": "standard",
                                "shipping_type": "freight",
                                "price": 24000
                            },
                            {
                                "company": "jne",
                                "courier_name": "JNE",
                                "courier_code": "jne",
                                "courier_service_name": "City to City (CTC)",
                                "courier_service_code": "ctc",
                                "description": "Pengiriman city to city",
                                "duration": "2 - 3 days",
                                "shipment_duration_range": "2 - 3",
                                "shipment_duration_unit": "days",
                                "service_type": "standard",
                                "shipping_type": "parcel",
                                "price": 9000,
                                "type": "ctc"
                            }
                        ]
                    };
                    console.log(response);
                    alert('data harga ongkir tidak valid.')

                    $('.kurir-card').empty();
                    var limit = response.pricing.length > 3 ? 3 : response.pricing.length;
                    for (let i = 0; i < limit; i++) {
                        const rate = response.pricing[i];
                        $('.kurir-card').append(`
                            <div class="kurir-card-body" style="">
                                <input type="radio" class="kurir_detail" name="kurir_detail"
                                    data-courier_name="${rate.courier_name}"
                                    data-shipment_description="${rate.description}"
                                    data-shipment_duration="${rate.duration}"
                                    data-shipment_price="${rate.price}"
                                    value="${rate.company}${rate.courier_name}${rate.price}"
                                >
                                <small>${rate.courier_name} / ${rate.duration} Rp. ${format(rate.price)}</small>
                                <br>
                                <small>${rate.description}</small>
                            </div>
                        `);
                    }
                },
            });
        }

        var format = function(num) {
            var str = num.toString().replace("", ""),
                parts = false,
                output = [],
                i = 1,
                formatted = null;
            if (str.indexOf(".") > 0) {
                parts = str.split(".");
                str = parts[0];
            }
            str = str.split("").reverse();
            for (var j = 0, len = str.length; j < len; j++) {
                if (str[j] != ",") {
                    output.push(str[j]);
                    if (i % 3 == 0 && j < (len - 1)) {
                        output.push(",");
                    }
                    i++;
                }
            }
            formatted = output.reverse().join("");
            return ("" + formatted + ((parts) ? "." + parts[1].substr(0, 2) : ""));
        };
    });
</script>