<?php 
$server = "localhost";
$username = "root";
$password = "";
$database = "self_learning";
$connection = mysqli_connect("$server","$username","$password", "$database");
$select_db = mysqli_select_db($connection, $database);
if(!$select_db){
    echo("connection failed");
}

?>