<?php
session_start();
$id = $_GET['id'];

@$_SESSION['cart'][$id][1] = $_SESSION['cart'][$id][1] - 1;

if($_SESSION['cart'][$id][1] == 0){
    unset($_SESSION['cart'][$id]);
    $_SESSION['cart'] = array_values($_SESSION['cart']);
    for($k = 0; $k < sizeof($_SESSION['cart']); $k++){
        echo "{$_SESSION['cart'][$k]}";
    }
    //Id ei ole koskaan isompi kuin korin pituus
    $_SESSION['id'] = sizeof($_SESSION['cart']);

    //Vaihdetaan delete linkit
    $length = sizeof($_SESSION['cart']);
    for($i = 0; $i < $length; $i++){
        $_SESSION['cart'][$i][3] = "<a href='subtractItem.php?id={$i}'>-</a>  <a href='addItem.php?id={$i}'>+</a>  <a href='delete.php?id={$i}'>Poista</a>"; 
    }
}

header("location: ostoskori.php");
?>