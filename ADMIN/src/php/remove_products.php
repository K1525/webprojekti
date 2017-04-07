<?php
require_once ("db-init.php");

remove_products($db);

function remove_products($db){
    $sql = "DELETE FROM product WHERE ProductId IN (";
    $sql2 = "DELETE FROM product_image WHERE product_ProductId IN (";
    for($i=0;$i<count($_POST['ids']);$i++){
        $sql = $sql.$_POST['ids'][$i].",";
        $sql2 = $sql2.$_POST['ids'][$i].",";
    }
    $sql = $sql."0)";
    $sql2 = $sql2."0)";
    $stmt = $db->prepare($sql);
    $stmt2 = $db->prepare($sql2);

    $stmt->execute();
    $stmt2->execute();
    echo "Tuotteet poistettu";
}
?>