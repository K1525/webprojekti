<?php
require_once ("db-init.php");

upload_image_to_disk($db);

function upload_image_to_disk($db){

    $sourcePath = $_FILES['file']['tmp_name'];
    $targetPath = "../../images/".$_FILES['file']['name'];
    move_uploaded_file($sourcePath,$targetPath);

    echo "Kuva lisätty";
}
?>