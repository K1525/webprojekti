<?php
require_once ("db-init.php");

upload_image_to_disk($db);

function upload_image_to_disk($db){
    /*$sql = "INSERT INTO product_image (File_name,ProductId) 
    VALUES (:File_name, :ProductId)";*/
    
    $sourcePath = $_FILES['file']['tmp_name'];
    $targetPath = "../../../images/".$_FILES['file']['name'];
    move_uploaded_file($sourcePath,$targetPath);

    /*
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':File_name', $name);
    $stmt->bindParam(':ProductId', $name);

    $stmt->execute();
    */
    echo "Kuva lisätty";
}
?>