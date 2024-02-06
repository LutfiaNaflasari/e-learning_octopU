<?php
require 'db.php';
$admin_nama = $_POST["admin_nama"];
$username = $_POST["username"];
$admin_mail = $_POST["admin_mail"];
$admin_telp   = $_POST["admin_telp"];
$password = $_POST["password"];

$query_sql = "INSERT INTO tb_admin (admin_nama, username, admin_mail, admin_telp, password)
            VALUES ('$admin_nama', '$username', '$admin_mail', '$admin_telp', '$password')";

if (mysqli_query($conn, $query_sql)){
    header("Location: index.php");
}else{
    echo "Pendaftaran gagal : " . mysqli_error($conn);
}
?>