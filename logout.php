<?php
    session_start();
    $_SESSION['user'] = " ";
    $_SESSION['pass'] = " ";
    session_destroy();

    $cookie_name = "cookie_username";
    $cookie_value = " ";
    $time = time() - (60 * 60);
    setcookie($cookie_name, $cookie_value, $time, "/");

    $cookie_name = "cookie_password";
    $cookie_value = " ";
    $time = time() - (60 * 60);
    setcookie($cookie_name, $cookie_value, $time, "/");
    echo '<script>window.location="login.php"</script>';
?>