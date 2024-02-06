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
                <li><a href="profil.php">Data Konsumen</a></li>
                <li><a href="data-learning.php">Self Learning</a></li>
                <li><a href="data-event.php">Jenis Event</a></li>
                <li><a href="data-jenis-event.php">Event</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
    </div>
    </header>

    <div class="section">
        <div class="container">
             <!-- tambah jenis event utk output tampilan saja -->
            <h3>Jenis Event</h3>
            <div class="box">
                <p style="padding-bottom: 15px;"><a href="tambah-event.php" class="btn-tmbh">Tambah Jenis Event</a></p>
               <table border="1" cellspacing="0" class="table">
                   <thead>
                       <tr>
                           <th width="60px">No</th>
                           <th>Event</th>
                           <th>Gambar</th>
                           <th width="150px">Aksi</th>
                       </tr>
                   </thead>
                   <tbody>
                       <?php
                            $no = 1;
                            $selflearning = mysqli_query($conn, "SELECT * FROM tb_event ORDER BY event_id DESC");
                            while($row = mysqli_fetch_array($selflearning)){
                       ?>
                       <tr>
                           <td><?php echo $no++ ?></td>
                           <td><?php echo $row['event_nama'] ?></td>
                           <td><a href="event/<?php echo $row['event_gambar']?>"target="_blank"> <img src="event/<?php echo $row['event_gambar'] ?>" width="50px"></td>
                           <td style="padding-bottom: 12px; padding-top: 12px;">
                               <a href="edit-event.php?id=<?php echo $row['event_id'] ?>" class="btn-edt" style="margin-right: 5px;">Edit</a><a href="proses-hapus.php?ide=<?php echo $row['event_id']?>" class="btn-mrh">Hapus</a>
                           </td>
                           <!--  <td>
                               <a href="edit-event.php?id=<?php echo $row['event_id'] ?>">Edit</a> || <a href="proses-hapus.php?ide=<?php echo $row['event_id']?>">Hapus</a>
                           </td> -->
                       </tr>
                       <?php  
                    } ?>
                   </tbody>
               </table>
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
