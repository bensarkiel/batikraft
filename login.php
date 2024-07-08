<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | BatiKraft</title>
    <link rel="stylesheet" href="style2.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@300&display=swap" rel="stylesheet">
</head>

<body id="bg-login">
    <div class="login-box">
        <br><br>
        <h2>Login to BatiKraftSMG</h2>
        <br><br>
        <form action="" method="POST">
            <input type="text" name="user" placeholder="Username" class="input">
            <input type="password" name="pass" placeholder="Password" class="input">
            <br><br>
            <input type="submit" name="submit" value="Login" class="button">
            <br><br>
            <p>p.s</p>
            <p>username : seller</p>
            <p>password : lupapass</p>
        </form>
        <?php
        if (isset($_POST['submit'])) {
            session_start();
            include 'database.php';

            $user = mysqli_real_escape_string($conn, $_POST['user']);
            $pass = mysqli_real_escape_string($conn, $_POST['pass']);

            /*menghubungkan dengan database*/
            $cek = mysqli_query($conn, "SELECT * FROM tb_admin WHERE username = '" . $user . "' AND password = '" . $pass . "'");
            if (mysqli_num_rows($cek) > 0) {
                $d = mysqli_fetch_object($cek);
                $_SESSION['login_status'] = true;
                $_SESSION['a_global'] = $d;
                $_SESSION['id'] = $d->admin_id;
                echo '<script>window.location="beranda_admin.php"</script>';
            } else {
                echo '<script>alert("Username atau password yang anda masukan salah!")</script>';
            }
        }
        ?>
    </div>
</body>

</html>