<!DOCTYPE html>
<html lang="id">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!--link css-->
    <link rel="stylesheet" href="css/login.css">

    <!--link font awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <title>Login</title>
</head>
<body>
    <div class="container">
        <div class="header">
            <ul>
                <li><b>octop.U</b></li>
            </ul>
            <br>
            <h1 class="judul">Masuk</h1>
            <br>
            <form  action="" method="POST">
                <div class="content">
                    <div class="mb-3">
                        <input type="email" class="form-control rounder-lg" id="txtEmail" placeholder="Email"  name="mail">
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control rounder-lg" id="txtPassword" placeholder="Password"  name="pass">
                    </div>
                    <p>Belum punya akun? <a href="register-kons.html">Daftar akun</a></p>
                     </div>
        <div class="tombol mt-5 d-flex justify-content-center">
             <input type="submit" name="submit" value="Login" class="button medium2 shadow mr-3" style="margin-top: 10px;">
            <!-- <a href=".../sementara.index.php" class="button medium2 shadow mr-3">Login</a> -->
        </div>
                </div>
            </form>
            <?php
            if(isset($_POST['submit'])){
                require 'connect1.php';
                session_start();
                $mail = mysqli_real_escape_string($connection, $_POST['mail']);
                $pass = mysqli_real_escape_string($connection, $_POST['pass']);
                
                $cek = mysqli_query($connection, "SELECT * FROM tb_konsumen WHERE kons_mail = '".$mail."' AND kons_password = '".($pass)."'");
                if(mysqli_num_rows($cek) > 0){
                    $d = mysqli_fetch_object($cek);
                    $_SESSION['status_login'] = true;
                    $_SESSION['a_global'] = $d;
                    $_SESSION['id'] = $d->kons_id;
                    echo '<script>window.location="index.html"</script>';
                }else{
                    echo '<script>alert("Email atau password Anda salah!")</script>';
                }
            }
        ?>
       
    </div>
</body>
</html>