<?php
//tähän taimer ja ohjaus kirjautumis sivulle
session_start();
  
if (isset($_SESSION['loggedIn'])) {
    unset($_SESSION['loggedIn']);
}
  
header("Location: http://" . $_SERVER['HTTP_HOST']
                           . dirname($_SERVER['PHP_SELF']) . '/'
                           . "test.php");
?>