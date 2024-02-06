<?php
session_start();
if(isset ($_SESSION['status_login'])){
    $_SESSION['status_login'] = true;
    echo "<meta http-equiv='refresh' content='0; url=index.html'>";
} else{
    echo "<meta http-equiv='refresh' content='0; url=landingpage-kons.html'>";
}
?>