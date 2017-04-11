<?php
    session_start();
    include("ostoskori.php");
    createCart();
    addToCart();

    /*Kokonaishinta*/
    $_SESSION['totalPrice'] = 0;

    /*Lasketaan kokonaishinta*/
    if(sizeof($_SESSION['cart']) == 0){
        echo "Ostoskori on tyhjä";
    }
    else{
        for($i = 0; $i < sizeof($_SESSION['cart']); $i++){
            $_SESSION['totalPrice'] = $_SESSION['totalPrice'] + $_SESSION['cart'][$i][2] * $_SESSION['cart'][$i][1];
            echo "{$_SESSION['cart'][$i][0]} | {$_SESSION['cart'][$i][1]} | {$_SESSION['cart'][$i][2]}€ | {$_SESSION['cart'][$i][3]} <br>";    
        }

        echo "KOKONAISHINTA: {$_SESSION['totalPrice']}€ <br>";
    }


    header("location: uusipohja/index.php");
?>