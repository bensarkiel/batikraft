<?php
include 'database.php';
require 'vendor/autoload.php';
// lupa_password.php

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["email"])) {
    // Mengambil email dari form
    $email = $_POST["email"];
    $profile_query = mysqli_query($conn, "SELECT * from tb_customer where email = '$email'");
    $profile = mysqli_fetch_assoc($profile_query);
    // Proses pemulihan kata sandi di sini
    $token = generatePasswordResetToken($profile, $email);

    if ($token) {
        // Mengirim email pemulihan kata sandi
        sendPasswordResetEmail($profile, $email, $token);

        // Redirect ke halaman konfirmasi dengan menyertakan token sebagai parameter URL
        header("Location: lupa_password.php?message=Link verifikasi telah dikirim ke email");
        exit();
    } else {
        // Jika ada kesalahan dalam pemulihan kata sandi, tampilkan pesan kesalahan
        echo "Terjadi kesalahan dalam pemulihan kata sandi. Silakan coba lagi.";
    }
}

// Fungsi untuk menghasilkan token pemulihan kata sandi (sesuaikan dengan logika Anda)
function generatePasswordResetToken($profile, $email)
{
    include 'database.php';
    // Logika untuk menghasilkan token di sini
    $token = md5($email . $profile['id_pelanggan'] . 'tb_customer');

    // Contoh sederhana: Menggunakan timestamp sebagai token
    // return time();

    // UPDATE `tb_customer` SET `token` = 'tes' WHERE `tb_customer`.`id_pelanggan` = 8; 
    mysqli_query($conn, "UPDATE `tb_customer` SET `token` = '$token' WHERE `tb_customer`.`id_pelanggan` = {$profile['id_pelanggan']}");
    // return md5($email);
    return $token;
}

// Fungsi untuk mengirim email pemulihan kata sandi (sesuaikan dengan logika Anda)
function sendPasswordResetEmail($profile, $email, $token)
{
    echo "\nPreapre before sending emial";
    // Logika pengiriman email di sini
    $curl = curl_init();

    $data = [
        "personalizations" => [
            [
                "subject" => "Lupa Kata Sandi Beauty Skin!",
                "to" => [
                    ["email" => $email, "name" => $profile['nama_lengkap'], "subject" => "Lupa Kata Sandi Beauty Skin!",],
                ],
                "dynamic_template_data" => [
                    "name" => $profile["nama_lengkap"],
                    "url_reset_password" => "localhost/BatiKraft/konfirmasi_lupa_password.php?token=" . $token,
                ],
            ],
        ],
        "from" => [
            "email" => "baagas0@gmail.com",
        ],
        "template_id" => "d-68c6a2a70fb7436c830fd933ddb4d450",
    ];

    curl_setopt_array($curl, [
        CURLOPT_URL => 'https://api.sendgrid.com/v3/mail/send',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode($data),
        CURLOPT_HTTPHEADER => array(
            'X-Requested-With: XMLHttpRequest',
            'Content-Type: application/json',
            'Authorization: Bearer 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'
        ),
    ]);

    $response = curl_exec($curl);

    var_dump($response);
    // die();
    // curl_close($curl);


    echo $response;


    // Contoh sederhana: Tampilkan pesan ke konsol
    echo "Email pemulihan kata sandi telah dikirim ke: " . $email;
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lupa Password | BatiKraft</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@300&display=swap" rel="stylesheet">
</head>

<body id="bg-login">
    <div class="login-box">
        <br><br>
        <h2>Lupa Password</h2>
        <br><br>
        <form action="" method="POST">
            <input type="email" name="email" placeholder="Email" class="input" required>
            <br><br>
            <input type="submit" name="submit" value="Reset Password" class="button">
        </form>
    </div>
</body>

</html>