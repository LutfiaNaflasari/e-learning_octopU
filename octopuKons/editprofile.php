<?php
session_start();
   // error_reporting(0);
  include 'connect1.php';

  // if(isset ($_SESSION['status_login'])){
  //     $_SESSION['status_login'] = true;
  // } else{
  //     echo "<meta http-equiv='refresh' content='0; url=../landingpage-kons.html'>";
  // }

   $query = mysqli_query($connection, "SELECT * FROM tb_konsumen WHERE kons_id = '".$_SESSION['id']."' ");
    $d = mysqli_fetch_object($query);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="image/o_c_t_o_p_ 1.png" type="image/png">
    <title>Home</title>

    <!-- FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins600:wght@600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- CSS -->
    <link rel="stylesheet" href="editprofile.css" />
</head>

<body>
    <div class="main">
        <!-- NAVBAR -->
        <div class="navbar">
            <div class=" logo" style="margin-bottom: 50px;">
                <a href=" index.html"><b>octop.U</b></a>
            </div>
            <ul class="menu">
                <li><a href="index.html">Home</a></li>
                <li class="dropdown">
                    <a href="#" class="dropbtn">Explore</a>
                    <div class="dropdown-content">
                        <a href="try.php">Self-Learning</a>
                        <a href="event.php">Event</a>
                    </div>
                </li>
                <li><a href="index.html">About Us</a></li>
                <li><a href="editprofile.php">Profile</a></li>
                <li><a href="logout.php">Log Out</a></li>
            </ul>
        </div>

        <!-- CONTENT -->
        <div class="content">
            <!-- USERNAME -->
            <!-- <div class="username">
                <img src="image/octopu.png" alt="" width="90px" />
                <div class="h1" style="color: #25167b; margin-left: 20px">
                    Selamat Datang
                </div>
            </div> -->
            <!-- EDIT PROFILE -->
            <div class="editprofile" style="text-align: center; margin-top: 20px;">
                <h1 class="editprofile" style="font-weight: bold; margin-top: 50px;">Edit Profile</h1>
            </div>

            <br>
             <form action="" method="POST">
            <div class="mb-3" style="margin-left: 20px;">
                <input type="username" class="form-control rounder-lg" id="txtUsername" name="user" placeholder="Username" value="<?php echo $d->kons_username ?>" required>
            </div>
            <div class="mb-3" style="margin-left: 20px;">
                <input type="username" class="form-control rounder-lg" id="txtUsername" name="nama" placeholder="Nama Lengkap" value="<?php echo $d->kons_nama ?>" required>
            </div>
            <div class="mb-3" style="margin-left: 20px;">
                <input type="email" name="mail" class="form-control rounder-lg" id="txtEmail" placeholder="Email" value="<?php echo $d->kons_mail ?>" required>
            </div>
            <div class="mb-3" style="margin-left: 20px;">
                <input type="noHP"  name="nohp" class="form-control rounder-lg" id="txtNoHP" placeholder="No. Handphone" value="<?php echo $d->kons_telp ?>" required>
            </div>
            <!-- <div class="mb-3" style="margin-left: 20px;">
                <input type="password"  name="pass"  class="form-control rounder-lg" id="txtPassword" placeholder="Password">
            </div>
 -->            <!-- <div class="mb-3" style="margin-left: 20px;">
                <input type="passwordbaru" class="form-control rounder-lg" id="txtPasswordBaru"
                    placeholder="Password Baru"> -->
            </div>
            <div class="tombol mt-5 d-flex justify-content-center">
                <input type="submit" name="submit" value="Ubah Profil" class="button medium2 shadow mr-3">
            </div>
            </form>
             <?php
                    if(isset($_POST['submit'])){

                        $nama   = $_POST['nama'];
                        $user   = $_POST['user'];
                        $hp     = $_POST['nohp'];
                        $email  = $_POST['mail'];
                        

                        $update = mysqli_query($connection, "UPDATE tb_konsumen SET
                                        kons_nama = '".$nama."',
                                        kons_username = '".$user."',
                                        kons_telp = '".$hp."',
                                        kons_mail = '".$email."'
                                        WHERE kons_id = '".$d->kons_id."' ");
                        if($update){
                            echo '<script>alert("Ubah data berhasil")</script>';
                            echo '<script>window.location="editprofile.php"</script>';
                        }else{
                            echo 'gagal'.mysqli_error($conn);
                        }
                    }
                ?>   
        </div>
    </div>

    <!-- FOOTER -->
    <footer>
        <div class="container">
            <div class="contact-info">
                <h3 class="conperson">Contact Person</h3>
                <div class="gmail">
                    <img src="image/gmail.png" alt="" width="40px" style="margin-right: 10px;">
                    octopu@gmail.com
                </div>
                <div class="whatsapp">
                    <img src="image/whatsapp.png" alt="" width="40px" style="margin-right: 10px;"> 082325446477
                </div>
                <div class="phone">
                    <img src="image/call.png" alt="" width="40px" style="margin-right: 10px;"> 024-3515915
                </div>
            </div>
            <div class="social-media">
                <h3 class="followus">Follow Us</h3>
                <ul>
                    <li><a href="#"><img src="image/facebook.png" alt="Facebook"></a></li>
                    <li><a href="#"><img src="image/twiter.png" alt="Twitter"></a></li>
                    <li><a href="#"><img src="image/instagram.png" alt="Instagram"></a></li>
                </ul>
            </div>
            <div class="address">
                <h3 class="address">Address</h3>
                <p> Jl. Sinar Kencana IV no.334, kec Tembalang</p>
                <p>Semarang, Jawa Tengah</p>
            </div>
        </div>
        <div class="copyright" style="text-align: center;">
            <hr class="hr-copyright">
            <p>&copy; 2023 octopU. Hak Cipta Dilindungi.</p>
        </div>
    </footer>
</body>

</html>