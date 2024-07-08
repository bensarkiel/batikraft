<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Customer | BatiKraft</title>
    <link rel="stylesheet" href="style2.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@300&display=swap" rel="stylesheet">
</head>

<body id="bg-login">
    <div class="login-box">
        <br><br>
        <h2>Login</h2>
        <br><br>
        <form action="" method="POST">
            <input type="email" name="user" placeholder="Email" class="input" valid_email>
            <input type="password" id="password" name="pass" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{7,}" title="Minimal 8 karakter dengan perpaduan angka, huruf, dan karakter khusus" class="input" required>
            <br><br>
            <input type="submit" name="submit" value="Login" class="button">
            <br><br>
            <p>belum memiliki akun?<i><a href="registrasi_cust.php"><u> registrasi</u></a><i></p>
            <!-- <p><a href="lupa_password.php">Lupa Password?</a></p> -->
            <!-- <p>email : seller</p>
                <p>password : lupapass</p> -->
        </form>
        <?php
        if (isset($_POST['submit'])) {
            session_start();
            include 'database.php';

            $user = mysqli_real_escape_string($conn, $_POST['user']);
            $pass = mysqli_real_escape_string($conn, $_POST['pass']);

            /*menghubungkan dengan database*/
            $sql = "SELECT * FROM tb_customer WHERE email = '$user' AND password = '$pass'";
            $cek = mysqli_query($conn, $sql);
            if (mysqli_num_rows($cek) > 0) {
                $d = mysqli_fetch_object($cek);

                $_SESSION['customer_id'] = $d->id_pelanggan;
                // echo "<script>alert('$sql')</script>";
                echo '<script>window.location="index.php"</script>';
            } else {
                echo '<script>alert("email atau password yang anda masukan salah!")</script>';
            }
        }
        ?>
    </div>

</body>

</html>