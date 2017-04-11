<?php
session_start();
$id = $_GET['id'];

$_SESSION['cart'][$id][1] = $_SESSION['cart'][$id][1] + 1;

header("location: ostoskori.php");
?>