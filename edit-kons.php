<?php
    session_start();
    include 'db.php';

    if(isset ($_SESSION['status_login'])){
        $_SESSION['status_login'] = true;
    } else{
        echo "<meta http-equiv='refresh' content='0; url=login.php'>";
    }
    
    $produk = mysqli_query($conn, "SELECT * FROM tb_konsumen WHERE kons_id = '".$_GET['id']."' ");
    if(mysqli_num_rows($produk)  == 0){
        echo '<script>window.location="data-kons.php"</script>';
    }
    $p = mysqli_fetch_object($produk);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>octop.U</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <div class="container">
               <h1><a href="index.php">octop.U</a></h1>
            <ul>
                <li><a href="index.php">Dashboard</a></li>
                <li><a href="profil.php">Profil</a></li>
                <li><a href="data-kons.php">Data Konsumen</a></li>
                    <li><a href="data-learning.php">Self Learning</a></li>
                    <li><a href="data-mapel.php">Mata Pelajaran</a></li>
                    <li><a href="data-event.php">Jenis Event</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
        </div>
    </header>

    <div class="section">
        <div class="container">
            <h3>Edit Data Materi</h3>
            <div class="box">
                <form action="" method="POST" enctype="multipart/form-data">

                    <input type="text" name="nama" class="input-control" placeholder="Nama Lengkap" value="<?php echo $p->kons_nama?>" required>
                    <input type="text" name="username" class="input-control" placeholder="Username" value="<?php echo $p->kons_username?>" required>
                    <input type="text" name="email" class="input-control" placeholder="Email" value="<?php echo $p->kons_mail?>" required>
                    <input type="text" name="telp" class="input-control" placeholder="Telpon" value="<?php echo $p->kons_telp?>" required>
                    <input type="text" name="pass" class="input-control" placeholder="Password" value="<?php echo $p->kons_password?>" required>
                   
                    <input type="submit" name="submit" value="Submit" class="button">
                </form>
                <?php
                    if(isset($_POST['submit'])){

                        // data inputan dari form
                        $nama      = $_POST['nama'];
                        $username     = $_POST['username'];
                        $email = $_POST['email'];
                        $telp    = $_POST['telp'];
                        $pass      = $_POST['pass'];
                        
                        
                        //query update data produk
                        $update = mysqli_query($conn, "UPDATE tb_konsumen SET 
                                                kons_nama = '".$nama."',
                                                kons_username = '".$username."',
                                                kons_mail ='".$email."',
                                                kons_telp = '".$telp."',
                                                kons_password = '".$pass."'
                                                WHERE kons_id = '".$p->kons_id."' ");
                        if($update){
                            echo '<script>alert("Ubah data berhasil")</script>';
                            echo '<script>window.location="data-kons.php"</script>';
                        }else{
                            echo 'gagal',mysqli_error($conn);
                        }
                    }
                    
                ?>
            </div>
        </div>
    </div>

    <footer>
        <div class="container">
            <small>Copyright &copy; 2023 - octopu</small>
        </div>
    </footer>
</body>
</html>