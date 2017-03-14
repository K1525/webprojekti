<?php
session_start();
include('navbar.php');
  //ohjaa kirjautumis-sivulle, jos ei ole kirjautunut:
if (!isset($_SESSION['app2_islogged']) || $_SESSION['app2_islogged'] !== true) {
header("Location: http://" . $_SERVER['HTTP_HOST']
                           . dirname($_SERVER['PHP_SELF']) . '/'
                           . "login.php");
exit;
}
?>

<title>Verkkokauppasivu</title>

<p>Tassa voit tutkia mita verkokaupassa on: </p>