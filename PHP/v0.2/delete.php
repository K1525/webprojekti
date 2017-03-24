<?php
session_start();
//Haetaan poistettavan tuotteen id
$id = $_GET['id'];

//Poistetaan rivi matriisista
unset($_SESSION['cart'][$id]);
//Uudelleen määrätään indeksit
$_SESSION['cart'] = array_values($_SESSION['cart']);

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
header("Location:ostoskori.php");
?>