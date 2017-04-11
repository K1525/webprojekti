<?php
session_start();
$id = $_GET['id'];

unset($_SESSION['cart'][$id]);

//Jos Kori on tyhjä id = 0
if(sizeof($_SESSION['cart']) == 0){
    $_SESSION['id'] = 0;
}

//Id ei ole koskaan isompi kuin korin pituus
$_SESSION['id'] = sizeof($_SESSION['cart']);

//Vaihdetaan delete linkit
$length = sizeof($_SESSION['cart']);
for($i = 0; $i < $length; $i++){
    $_SESSION['cart'][$i][3] = "<a href='subtractItem.php?id={$i}'>-</a>  <a href='addItem.php?id={$i}'>+</a>  <a href='delete.php?id={$i}'>Poista</a>"; 
}
//??Hinnan lasku menee sekaisin??

header("Location:ostoskori.php");
?>