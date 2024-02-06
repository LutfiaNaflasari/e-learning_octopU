<?php
    session_start();
    include 'db.php';
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
                    <li><a href="logout.php">Logout</a></li>
                </ul>
        </div>
    </header>

    <div class="section">
        <div class="container">
            <h3>Kelola Data Konsumen</h3>
            <div class="box">
                <!-- Add the button for generating PDF -->
                <p style="padding-bottom: 15px;">
                    <a href="generate-pdfKons.php" class="btn-tmbh">Generate PDF</a>
                </p>
                <!-- <p style="padding-bottom: 15px;"><a href="tambah-mapel.php" class="btn-tmbh">Tambah Materi</a></p> -->
               <table border="1" cellspacing="0" class="table">
                   <thead>
                       <tr>
                           <th width="60px">No</th>
                           <th>Nama Lengkap</th>
                           <th>Username</th>
                           <th>Email</th>
                           <th>No. Telp</th>
                           <th>Password</th>
                           <th width="150px">Aksi</th>
                       </tr>
                   </thead>
                   <tbody>
                       <?php
                            $no = 1;
                            $kons = mysqli_query($conn, "SELECT * FROM tb_konsumen ORDER BY kons_id DESC");
                            while($row = mysqli_fetch_array($kons)){
                       ?>
                       <tr>
                           <td><?php echo $no++ ?></td>
                           <td><?php echo $row['kons_nama'] ?></td>
                            <td><?php echo $row['kons_username'] ?></td>
                           <td><?php echo $row['kons_mail'] ?></td>
                            <td><?php echo $row['kons_telp'] ?></td>
                             <td><?php echo $row['kons_password'] ?></td>
                          <td style="padding-bottom: 12px; padding-top: 12px;">
                               <a href="edit-kons.php?id=<?php echo $row['kons_id'] ?>" class="btn-edt" style="margin-right: 5px;">Edit</a><a href="proses-hapus.php?idc=<?php echo $row['kons_id']?>" class="btn-mrh">Hapus</a>
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
