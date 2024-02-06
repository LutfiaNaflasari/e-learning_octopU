<?php
require 'octopuAdmin/db.php';
$kons_nama = $_POST["kons_nama"];
$kons_username = $_POST["kons_username"];
$kons_mail = $_POST["kons_mail"];
$kons_telp   = $_POST["kons_telp"];
$kons_password = $_POST["kons_password"];

$query_sql = "INSERT INTO tb_konsumen (kons_nama, kons_username, kons_mail, kons_telp, kons_password)
            VALUES ('$kons_nama', '$kons_username', '$kons_mail', '$kons_telp', '$kons_password')";

if (mysqli_query($conn, $query_sql)){
    header("Location: index.php");
}else{
    echo "Pendaftaran gagal : " . mysqli_error($conn);
}
?>