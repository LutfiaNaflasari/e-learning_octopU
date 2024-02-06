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
                <li><a href="data-event.php">Jenis Event</a></li>
                <li><a href="data-jenis-event.php">Event</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
    </div>
    </header>

    <div class="section">
        <div class="container">
            <h3>Tambah Data Event</h3>
            <div class="box">
                <form action="" method="POST" enctype="multipart/form-data">
                    <select class="input-control" name="event" required>
                        <option value="">--Pilih--</option>
                        <?php
                            $event = mysqli_query($conn, "SELECT * FROM tb_event ORDER BY event_id DESC");
                            while($r = mysqli_fetch_array($event)){
                        ?>
                        <option value="<?php echo $r['event_id']?>"><?php echo $r['event_nama']?></option>
                        <?php } ?>
                    </select>

                    <input type="text" name="nama" class="input-control" placeholder="Nama Event" required>
                    <input type="text" name="harga" class="input-control" placeholder="Harga" required>
                    <input type="file" name="gambar" class="input-control" required>
                    <textarea class="input-control" name="deskripsi" placeholder="deskripsi"></textarea>
                    <select class="input-control" name="status">
                        <option value="">--Pilih--</option>
                        <option value="1">Aktif</option>
                        <option value="0">TidakAktif</option>
                    </select>
                    <input type="submit" name="submit" value="Submit" class="button">
                </form>
                <?php
                    if(isset($_POST['submit'])){

                        //print_r($_FILES['gambar']);
                        //menampung inputan form
                        $event  = $_POST['event'];
                        $nama      = $_POST['nama'];
                        $harga     = $_POST['harga'];
                        $deskripsi = $_POST['deskripsi'];
                        $status = $_POST['status'];


                        //menampung data file yang diupload
                        $filename = $_FILES['gambar']['name'];
                        $tmp_name = $_FILES['gambar']['tmp_name'];

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
                            // jika format file sesuai dengan yang ada di dalam array tipe diizinkan
                            //prosrs upload file sekaligus insert ke database
                            move_uploaded_file($tmp_name, './event/'.$newname);

                            $insert = mysqli_query($conn, "INSERT INTO tb_jenis_event VALUES (
                                        null,
                                        '".$event."',
                                        '".$nama."',
                                        '".$harga."',
                                        '".$deskripsi."',
                                        '".$newname."',
                                        '".$status."',
                                        null
                                            )");
                            if($insert){
                                echo '<script>alert("Tambah event berhasil")</script>';
                                echo '<script>window.location="data-jenis-event.php"</script>';
                            }else{
                                echo 'gagal',mysqli_error($conn);
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