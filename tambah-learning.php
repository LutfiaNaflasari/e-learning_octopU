<?php
    session_start();
    include 'db.php';

    if(isset ($_SESSION['status_login'])){
        $_SESSION['status_login'] = true;
    } else{
        echo "<meta http-equiv='refresh' content='0; url=login.php'>";
    }
    
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
            <h3>Tambah Data Mata Pelajaran</h3>
            <div class="box">
                <form action="" method="POST" enctype="multipart/form-data">
                    <input type="text" name="nama" placeholder="Nama Mata Pelajaran" class="input-control" required>
                    <input type="file" name="gambar" class="input-control" required>
                    <input type="submit" name="submit" value="Submit" class="button">
                </form>
                <?php
                    if(isset($_POST['submit'])){

                        $nama = $_POST['nama'];

                        $filename = $_FILES['gambar']['name'];
                        $tmp_name = $_FILES['gambar']['tmp_name'];

                        $type1 = explode('.', $filename);
                        $type2 = $type1[1];

                        $newname = 'learn'.time().'.'.$type2;

                        //menampung data format file yang diizinkan
                        $tipe_diizinkan = array('jpg','jpeg','png');

                        //validasi format file
                        if(!in_array($type2, $tipe_diizinkan)){
                            // jika format file tidak terdapat dalam file yang diizinkan
                            echo '<script>alert("Format file tidak diizinkan")</script>';

                        }else{
                            // jika format file sesuai dengan yang ada di dalam array tipe diizinkan
                            //prosrs upload file sekaligus insert ke database
                            move_uploaded_file($tmp_name, './mapel/'.$newname);

                        $insert = mysqli_query($conn, "INSERT INTO tb_selflearning VALUES (
                            null,
                            '".$nama."', 
                            '".$newname."'
                             ) ");
                        if($insert){
                            echo '<script>alert("Tambah data berhasil")</script>';
                            echo '<script>window.location="data-learning.php"</script>';
                        }else if($nama > 0){
                            echo "<font color='red'>Gagal! Data sudah ada</font><br>";
                        }else{
                            echo 'gagal' .mysqli_error($conn);
                        }
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