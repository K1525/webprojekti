<?php
require_once ("db-init.php");

add_product_to_db($db);

function add_product_to_db($db){
    $sql = "INSERT INTO product (Name, Price, Description, 
    Description_more, Gender, CategoryId) 
    VALUES (:Name, :Price, :Description, :Description_more, 
    :Gender, :CategoryId)";
    $sql2 = "INSERT INTO product_image (File_name, ProductId) 
    VALUES (:File_name, :ProductId)";
    $p = $_POST['product'];
    $name = (isset($p['0']) && !empty($p['0'])) ? $p['0'] : null;
    $price = (isset($p['1']) && !empty($p['1'])) ? $p['1'] : null;
    //$stock = (isset($p['2']) && !empty($p['2'])) ? $p['2'] : null;
    $description = (isset($p['3']) && !empty($p['3'])) ? $p['3'] : null;
    $description_more = (isset($p['4']) && !empty($p['4'])) ? $p['4'] : null;
    $gender = (isset($p['5']) && !empty($p['5'])) ? $p['5'] : null;
    $category = (isset($p['6']) && !empty($p['6'])) ? $p['6'] : null;

    $stmt = $db->prepare($sql);
    $stmt->bindParam(':Name', $name);
    $stmt->bindParam(':Price', $price);
    //$stmt->bindParam(':Stock', $stock);
    $stmt->bindParam(':Description', $description);
    $stmt->bindParam(':Description_more', $description_more);
    $stmt->bindParam(':Gender', $gender);
    $stmt->bindParam(':CategoryId', $category);
    
    $stmt->execute();
/*
    $stmt2 = $db->prepare($sql2);

    $id = $db->lastInsertId();
    $stmt2->bindParam('File_name', $_POST['img']);
    $stmt2->bindParam('ProductId', $id);

    $stmt2->execute();
*/
    echo "Tuote lisätty";
}
?>