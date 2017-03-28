<?php
  
if (!isset($_SESSION['app2_islogged']) || $_SESSION['app2_islogged'] !== true) {
    echo "Et ole kirjautunut verkkokauppaan ";
    echo "| <a href='alku.php'>Kirjaudu </a>";
    echo "| <a href='rekisterointisivu.php'> Tai rekisteroidy <a>";
} else {
   echo "[Hei, <span style='background: yellow;'>{$_SESSION['uid']}</span> ] ";
   echo "[<a href='logout.php'>Kirjaudu ulos</a>]";
}
  
?>