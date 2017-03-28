<?php

//tähän taimer ja ohjaus kirjautumis sivulle

session_start();
  
if (isset($_SESSION['app2_islogged'])) {
    unset($_SESSION['app2_islogged']);
}
  
header("Location: http://" . $_SERVER['HTTP_HOST']
                           . dirname($_SERVER['PHP_SELF']) . '/'
                           . "main.php");
?>