<?php
    session_start();
    require_once("db-init.php");
    
    //Luodaan tilaus
    //CustomerId pitää hakea käyttäjältä
    $ordersSQL = $db->prepare("INSERT IGNORE INTO orders (CustomerId) VALUES (:f1)");
    $ordersSQL->execute(array(':f1' => 1));
    $id = $db->lastInsertId();

    //Tallennetaan ostoskorista tiedot tietokantaan
    for($i = 0; $i < sizeof($_SESSION['cart']); $i++){
        $amount = $_SESSION['cart'][$i][1];
        $productId = $_SESSION['cart'][$i][4];
        $orderedProductSql = $db->prepare("INSERT IGNORE INTO ordered_product (Quantity, ProductId, OrderId) VALUES (:f1,:f2,:f3);");
        //:f2 haettava tuotteesta       
        $orderedProductSql->execute(array(':f1' => $amount, ':f2' => $productId, ':f3' => $id));
    }

    echo "Tuotteet tallennettu onnistuneesti tietokantaan";
    
?>
