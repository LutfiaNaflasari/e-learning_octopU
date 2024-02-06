<?php
session_start();
error_reporting(0);
include 'connect1.php';

if(isset ($_SESSION['status_login'])){
    $_SESSION['status_login'] = true;
} else{
    echo "<meta http-equiv='refresh' content='0; url=landingpage-kons.html'>";
}
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
    <link rel="stylesheet" href="try.css" />
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
                <li><a href="#">Log Out</a></li>
            </ul>
        </div>

        <!-- CONTENT -->
        <div class="content">
            <!-- USERNAME -->
            <div class="username">
                <img src="image/octopu.png" alt="" width="90px" />
                <div class="h1" style="color: #25167b; margin-left: 20px">
                    Selamat Datang
                </div>
            </div>

            <!-- SELF LEARNING -->
            <div class="title-slearning">
                <img src="image/s-learning.png" alt="" class="img-self" width="100px" height="100px" />
                Self - Learning
            </div>

            <!-- TDK PERLU DIHIRAUKAN -->
            <div class="title-materi" style="color: white;">
                <h6>Self - Learning</h6>
            </div>

            <div class="slide">
                <!-- MENU CARD SLIDER -->
                <div class="slide-container swiper">
                    <div class="slide-content">
                        <div class="card-wrapper swiper-wrapper">

                            <?php
                $query = mysqli_query($connection, "SELECT * FROM tb_selflearning");
                while ($row = mysqli_fetch_array($query)) {
                ?>

                            <div class="card swiper-slide">
                                <div class="image-content">
                                    <span class="overlay"></span>
                                    <div class="card-image">

                                        <!-- CONNECT PHP | GAMBAR MAPEL -->
                                        <!-- <img src="image/math.jpeg" alt="" class="card-img" /> -->
                                        <img src="../mapel/<?php echo $row['selflearning_gambar']?>" alt=""
                                            class="card-img">
                                    </div>
                                </div>

                                <div class="card-content">

                                    <!-- CONNECT PHP | NAMA MAPEL -->
                                    <h2 class="name"><?php echo $row['selflearning_mapel']; ?></h2>

                                    <!-- BUTTON KE DAFTAR MATERI  -->
                                    <button class="button">
                                        <!-- <a href="try-next1.php" style="color: white;">View More </a> -->
                                        <a href="try-next1.php?kat=<?php echo $row['selflearning_id'] ?>"
                                            style="color: white;"> View More</a>
                                    </button>
                                </div>
                            </div>

                            <?php
                }
                ?>

                        </div>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>


        </div>
    </div>

    <!-- FOOTER -->
    <footer>
        <div class="container">
            <div class="contact-info">
                <h3 class="conperson">Contact Person</h3>
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
                <h3 class="followus">Follow Us</h3>
                <ul>
                    <li><a href="https://www.facebook.com/elecia.syabila"><img src="image/facebook.png"
                                alt="Facebook"></a></li>
                    <li><a href="https://twitter.com/FabrizioRomano/status/1671489895682940930?s=20"><img
                                src="image/twiter.png" alt="Twitter"></a></li>
                    <li><a href="https://www.instagram.com/"><img src="image/instagram.png" alt="Instagram"></a></li>
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