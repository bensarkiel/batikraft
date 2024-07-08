<?php
// reset_password.php

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $token = $_POST["token"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    // Periksa apakah token valid
    if (validatePasswordResetToken($token)) {
        
        // Periksa kecocokan password baru dan konfirmasi password
        if ($password === $confirm_password) {
            // Reset password ke database
            if (resetPassword($token, $password)) {
                
                // Password berhasil direset
                header("Location: index.php?message=Password Anda telah direset. Silakan masuk menggunakan password baru Anda.");
            } else {
                // Terjadi kesalahan saat mereset password
                header("Location: index.php?message=Terjadi kesalahan saat mereset password. Silakan coba lagi.");
            }
        } else {
            // Password baru dan konfirmasi password tidak cocok
            header("Location: index.php?message=Password baru dan konfirmasi password tidak cocok.");
        }
    } else {
        // Token tidak valid
        header("Location: index.php?message=Token tidak valid. Silakan kembali ke halaman lupa password dan coba lagi.");
    }
} else {
    // Redirect ke halaman lupa password jika tidak ada permintaan POST yang diberikan
    header("Location: lupa_password.php");
    exit();
}

// Fungsi untuk memvalidasi token (sesuaikan dengan logika Anda)
function validatePasswordResetToken($token) {
    // Logika validasi token di sini
    include 'database.php';

    $profile_query = mysqli_query($conn, "SELECT * from tb_customer where token = '$token'");
    $profile = mysqli_fetch_assoc($profile_query);

    // Contoh sederhana: Token valid jika tidak kosong
    return isset($profile['id_pelanggan']);
}

// Fungsi untuk mereset password (sesuaikan dengan logika Anda)
function resetPassword($token, $new_password) {
    include 'database.php';
    
    // Contoh sederhana: Mengganti password user dengan password baru yang diberikan
    mysqli_query($conn, "UPDATE `tb_customer` SET `password` = '$new_password' WHERE `tb_customer`.`token` = '$token'");
    mysqli_query($conn, "UPDATE `tb_customer` SET `token` = null WHERE `tb_customer`.`token` = '$token'");
    
    return true;
}
?>
