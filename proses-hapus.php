<?php

    include 'db.php';

    if(isset($_GET['idk'])){
        $delete = mysqli_query($conn, "DELETE FROM tb_selflearning WHERE selflearning_id = '".$_GET['idk']."' ");
        echo '<script>window.location="data-learning.php"</script>';
    }

    if(isset($_GET['idp'])){
        $produk = mysqli_query($conn, "SELECT mapel_gambar FROM tb_mapel WHERE mapel_id = '".$_GET['idp']."' ");
        $p = mysqli_fetch_object($produk);

        unlink('./mapel/'.$p->mapel_gambar);

        $delete = mysqli_query($conn, "DELETE FROM tb_mapel WHERE mapel_id = '".$_GET['idp']."' ");
        echo '<script>window.location="data-mapel.php"</script>';
    }

    if(isset($_GET['ide'])){
        $delete = mysqli_query($conn, "DELETE FROM tb_event WHERE event_id = '".$_GET['ide']."' ");
        echo '<script>window.location="data-event.php"</script>';
    }

    if(isset($_GET['idj'])){
        $produk = mysqli_query($conn, "SELECT jenis_gambar FROM tb_jenis_event WHERE jenis_id = '".$_GET['idj']."' ");
        $p = mysqli_fetch_object($produk);

        unlink('./mapel/'.$p->jenis_gambar);

        $delete = mysqli_query($conn, "DELETE FROM tb_jenis_event WHERE jenis_id = '".$_GET['idj']."' ");
        echo '<script>window.location="data-jenis-event.php"</script>';
    }

    if(isset($_GET['idc'])){
        /*$produk = mysqli_query($conn, "SELECT mapel_gambar FROM tb_mapel WHERE mapel_id = '".$_GET['idp']."' ");
        $p = mysqli_fetch_object($produk);*/

       /* unlink('./mapel/'.$p->mapel_gambar);*/

        $delete = mysqli_query($conn, "DELETE FROM tb_konsumen WHERE kons_id = '".$_GET['idc']."' ");
        echo '<script>window.location="data-kons.php"</script>';
    }
?>