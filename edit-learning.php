<?php
   session_start();
   include 'db.php';

   if(isset ($_SESSION['status_login'])){
       $_SESSION['status_login'] = true;
   } else{
       echo "<meta http-equiv='refresh' content='0; url=login.php'>";
   }
    
    $kategori = mysqli_query($conn, "SELECT * FROM tb_selflearning WHERE selflearning_id = '".$_GET['id']."' ");
    if(mysqli_num_rows($kategori)  == 0){
        echo '<script>window.location="data-learning.php"</script>';
    }
    $k = mysqli_fetch_object($kategori);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foodiez</title>
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
            <h3>Edit Data Self Learning</h3>
            <div class="box">
                <form action=" " method="POST">
                    <input type="text" name="nama" placeholder="Jenis Self Learning" class="input-control" value="<?php echo $k-> selflearning_mapel ?>" required>
                    <img src="mapel/<?php echo $k->selflearning_gambar?>" width="100px">
                    <input type="hidden" name="foto" value="<?php echo $k->selflearning_gambar?>">
                    <input type="file" name="gambar" class="input-control" required>
                    <input type="submit" name="submit" value="Submit" class="button">
                </form>
                <?php
                    if(isset($_POST['submit'])){

                        $nama = $_POST['nama'];
                        $foto = $_POST['foto'];

                        $filename = $_FILES['gambar']['name'];
                        $tmp_name = $_FILES['gambar']['tmp_name'];
                        
                        if($filename != ''){

                            $type1 = explode('.', $filename);
                            $type2 = $type1[1];
    
                            $newname = 'materi'.time().'.'.$type2;
    
                            //menampung data format file yang diizinkan
                            $tipe_diizinkan = array('jpg','jpeg','png');
    
                                 //validasi format file
                                if(!in_array($type2, $tipe_diizinkan)){
                                // jika format file tidak terdapat dalam file yang diizinkan
                                    echo '<script>alert("Format file tidak diizinkan")</script>';
    
                                }else{
                                    unlink('./mapel/'.$foto);
                                    move_uploaded_file($tmp_name, './mapel/'.$newname);
                                    $namagambar = $newname;
    
                                }
    
                            }else{
                                //jika admin tidak ganti gambar
                                $namagambar = $foto;
    
                            }
                        

                            $update = mysqli_query($conn, "UPDATE tb_selflearning SET
                                                            selflearning_mapel = '".$nama."',
                                                            selflearning_gambar = '".$namagambar."'
                                                            WHERE selflearning_id = '".$k->selflearning_id."' ");

                        if($update){
                            echo '<script>alert("Edit data berhasil")</script>';
                            echo '<script>window.location="data-learning.php"</script>';
                        }else{
                            echo 'gagal' .mysqli_error($conn);
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