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
            <h3>Mata Pelajaran</h3>
            <div class="box">
            <p style="padding-bottom: 15px;">
                <a href="tambah-mapel.php" class="btn-tmbh">Tambah Materi</a>
                <a href="generate-pdfMapel.php" class="btn-tmbh" style="margin-left: 950px;">Generate PDF</a>
            </p>
                <table border="1" cellspacing="0" class="table">
                   <thead>
                       <tr>
                           <th width="60px">No</th>
                           <th>Mata Pelajaran</th>
                           <th>Nama Materi</th>
                           <th>Harga</th>
                           <th>Deskripsi</th>
                           <th>Gambar</th>
                           <th>Status</th>
                           <th width="150px">Aksi</th>
                       </tr>
                   </thead>
                   <tbody>
                       <?php
                            $no = 1;
                            $mapel = mysqli_query($conn, "SELECT * FROM tb_mapel LEFT JOIN tb_selflearning USING(selflearning_id) ORDER BY mapel_id DESC");
                            while($row = mysqli_fetch_array($mapel)){
                       ?>
                       <tr>
                           <td><?php echo $no++ ?></td>
                           <td><?php echo $row['selflearning_mapel'] ?></td>
                           <td><?php echo $row['mapel_nama'] ?></td>
                           <td>Rp <?php echo number_format($row['mapel_harga']) ?></td>
                           <td><?php echo $row['mapel_desk'] ?></td>
                           <td><a href="mapel/<?php echo $row['mapel_gambar']?>"target="_blank"> <img src="mapel/<?php echo $row['mapel_gambar'] ?>" width="50px"></td>
                           <td><?php echo ($row['mapel_status'] ==0)? 'Tidak Aktif':'Aktif'; ?></td>
                          <td style="padding-bottom: 12px; padding-top: 12px;">
                               <a href="edit-mapel.php?id=<?php echo $row['mapel_id'] ?>" class="btn-edt" style="margin-right: 5px;">Edit</a><a href="proses-hapus.php?idp=<?php echo $row['mapel_id']?>" class="btn-mrh">Hapus</a>
                           </td>
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
