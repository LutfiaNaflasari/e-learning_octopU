<?php
session_start();
error_reporting(0);
include 'connect1.php';

if(isset ($_SESSION['status_login'])){
    $_SESSION['status_login'] = true;
} else{
    echo "<meta http-equiv='refresh' content='0; url=../landingpage-kons.html'>";
}

    $produk = mysqli_query($connection, "SELECT * FROM tb_mapel WHERE mapel_id = '".$_GET['id']."' ");
    $p = mysqli_fetch_object($produk);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="image/o_c_t_o_p_ 1.png" type="image/png" />
    <title>Self-Learning</title>

    <!-- FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins600:wght@600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet" />

    <!-- SWIPER CSS -->
    <link rel="stylesheet" href="css/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />

    <!-- CSS -->
    <link rel="stylesheet" href="detailproduk1.css" />
</head>

<body>
    <div class="main">
        <!-- NAVBAR -->
        <div class="navbar">
            <div class="logo">
                <a href="index.html"><b>octop.U</b></a>
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
            <div class="username1">
                <h1 style="text-align: center;">Detail Produk</h1>
            </div>

            <div class="section">
                <div class="container">
                    <div class="box " style="background-color: #998fd5;">
                        <div class="col-2">

                            <!-- CONNECT PHP | Gambar detail materi nya -->
                            <img src="../mapel/<?php echo $p->mapel_gambar?>" width="100%">

                            <!-- <img src="image/atom.jpg" alt=""> -->
                        </div>
                        <div class="col-2">
                            <h2 class="judul_produk">

                                <!-- CONNECT PHP | Nama materi nya-->
                                <?php echo $p->mapel_nama ?>
                               
                            </h2>

                            <h4 style="color: maroon;">
                                <!-- CONNECT PHP | Harga materi -->
                                Rp <?php echo number_format($p->mapel_harga) ?>
                            </h4>
                            <p> Deskripsi : <br>
                                <!-- CONNECT PHP | Deskripsi materi -->
                                <?php echo $p->mapel_desk?>
                            </p>
                            <p>
                            <h4>
                                <!-- CONNECT PHP | WHATSAPP -->
                                <a href="https://wa.me/6289637984446?text=Hai%20Octopu%20Saya%20Ingin%20Order"
                                    target="_blank" style="margin-top : 15px; color:green">Hubungi via Whatsapp</a>
                            </h4>
                            </p>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- FOOTER -->
    <footer>
        <div class=" container">
            <div class="contact-info">
                <h3 class="conperson" style="padding-bottom: 10px;">Contact Person</h3>
                <div class="gmail">
                    <img src="image/gmail.png" alt="" width="40px" style="margin-right: 10px" />
                    octopu@gmail.com
                </div>
                <div class="whatsapp">
                    <img src="image/whatsapp.png" alt="" width="40px" style="margin-right: 10px" />
                    082325446477
                </div>
                <div class="phone">
                    <img src="image/call.png" alt="" width="40px" style="margin-right: 10px" />
                    024-3515915
                </div>
            </div>
            <div class="social-media">
                <h3 class="followus" style="padding-bottom: 10px;">Follow Us</h3>
                <ul>
                    <li>
                        <a href="#"><img src="image/facebook.png" alt="Facebook" /></a>
                    </li>
                    <li>
                        <a href="#"><img src="image/twiter.png" alt="Twitter" /></a>
                    </li>
                    <li>
                        <a href="#"><img src="image/instagram.png" alt="Instagram" /></a>
                    </li>
                </ul>
            </div>
            <div class="address">
                <h3 class="address">Address</h3>
                <p>Jl. Sinar Kencana IV no.334, kec Tembalang</p>
                <p>Semarang, Jawa Tengah</p>
            </div>
        </div>
        <div class="copyright" style="text-align: center">
            <hr class="hr-copyright" />
            <p>&copy; 2023 octopU. Hak Cipta Dilindungi.</p>
        </div>
    </footer>
</body>

<!-- SWIPER JS -->
<script src="js/swiper-bundle.min.js"></script>

<!-- JAVASCRIPT -->
<script src="js/self-learning.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

</html>