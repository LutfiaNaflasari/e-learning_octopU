<?php
    session_start();
    $_SESSION['mail'] = " ";
    $_SESSION['pass'] = " ";
    session_destroy();

    $cookie_mail = "cookie_mail";
    $cookie_value = " ";
    $time = time() - (60 * 60);
    setcookie($cookie_mail, $cookie_value, $time, "/");

    $cookie_mail = "cookie_password";
    $cookie_value = " ";
    $time = time() - (60 * 60);
    setcookie($cookie_mail, $cookie_value, $time, "/");
    echo '<script>window.location="login-kons.php"</script>';
?>