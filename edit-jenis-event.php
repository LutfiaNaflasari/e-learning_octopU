<?php
   session_start();
   include 'db.php';

   if(isset ($_SESSION['status_login'])){
       $_SESSION['status_login'] = true;
   } else{
       echo "<meta http-equiv='refresh' content='0; url=login.php'>";
   }
    
    $produk = mysqli_query($conn, "SELECT * FROM tb_jenis_event WHERE jenis_id = '".$_GET['id']."' ");
    if(mysqli_num_rows($produk)  == 0){
        echo '<script>window.location="data-mapel.php"</script>';
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
                    <li><a href="data-event.php">Jenis Event</a></li>
                <li><a href="data-jenis-event.php">Event</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
        </div>
    </header>

    <div class="section">
        <div class="container">
            <h3>Edit Data Event</h3>
            <div class="box">
                <form action="" method="POST" enctype="multipart/form-data">
                    <select class="input-control" name="event" required>
                        <option value="">--Pilih--</option>
                        <?php
                            $event = mysqli_query($conn, "SELECT * FROM tb_event ORDER BY event_id DESC");
                            while($r = mysqli_fetch_array($event)){
                        ?>
                        <option value="<?php echo $r['event_id']?>" <?php echo ($r['event_id']== $p->event_id)? 'selected':'';?>><?php echo $r['event_nama']?></option>
                        <?php } ?>
                    </select>

                    <input type="text" name="nama" class="input-control" placeholder="Nama Event" value="<?php echo $p->jenis_nama?>" required>
                    <input type="text" name="harga" class="input-control" placeholder="Harga" value="<?php echo $p->jenis_harga?>" required>
                    
                    <img src="event/<?php echo $p->jenis_gambar?>" width="100px">
                    <input type="hidden" name="gambar" value="<?php echo $p->jenis_gambar?>">
                    <input type="file" name="gambar" class="input-control" required>
                    <textarea class="input-control" name="deskripsi" placeholder="deskripsi" <?php echo $p->jenis_desk?>></textarea>
                    <select class="input-control" name="status">
                        <option value="">--Pilih--</option>
                        <option value="1" <?php echo ($p->jenis_status == 1)? 'selected':''; ?>>Aktif</option>
                        <option value="0" <?php echo ($p->jenis_status == 0)? 'selected':''; ?>>TidakAktif</option>
                    </select>
                    <input type="submit" name="submit" value="Submit" class="button">
                </form>
                <?php
                    if(isset($_POST['submit'])){

                        // data inputan dari form
                        $event  = $_POST['event'];
                        $nama      = $_POST['nama'];
                        $harga     = $_POST['harga'];
                        $deskripsi = $_POST['deskripsi'];
                        $status    = $_POST['status'];
                        $gambar      = $_POST['gambar'];
                        
                        
                        // data gambar
                        $filename = $_FILES['gambar']['name'];
                        $tmp_name = $_FILES['gambar']['tmp_name'];

                        

                        // jika admin ganti gambar
                        if($filename != ''){

                        $type1 = explode('.', $filename);
                        $type2 = $type1[1];

                        $newname = 'event'.time().'.'.$type2;

                        //menampung data format file yang diizinkan
                        $tipe_diizinkan = array('jpg','jpeg','png');

                             //validasi format file
                            if(!in_array($type2, $tipe_diizinkan)){
                            // jika format file tidak terdapat dalam file yang diizinkan
                                echo '<script>alert("Format file tidak diizinkan")</script>';

                            }else{
                                unlink('./event/'.$gambar);
                                move_uploaded_file($tmp_name, './event/'.$newname);
                                $namagambar = $newname;

                            }

                        }else{
                            //jika admin tidak ganti gambar
                            $namagambar = $gambar;

                        }

                        //query update data produk
                        $update = mysqli_query($conn, "UPDATE tb_jenis_event SET 
                                                event_id = '".$event."',
                                                jenis_nama = '".$nama."',
                                                jenis_harga = '".$harga."',
                                                jenis_desk ='".$deskripsi."',
                                                jenis_gambar = '".$namagambar."',
                                                jenis_status = '".$status."'
                                                WHERE jenis_id = '".$p->jenis_id."' ");
                        if($update){
                            echo '<script>alert("Ubah data berhasil")</script>';
                            echo '<script>window.location="data-jenis-event.php"</script>';
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