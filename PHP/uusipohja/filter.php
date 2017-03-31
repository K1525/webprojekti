<head>
        <meta charset="utf-8">
</head>
<?php 
        require_once("db-init.php");
 
        /*if ($_GET['id'] == 8) {
            $sql = "select ProductId, Name, Price, Description, Gender, File_name, CategoryId
                from product join product_image
                on product_ProductId = ProductId";
        }
else*/
        $sql = "select ProductId, Name, Price, Description, Gender, File_name, CategoryId
                from product join product_image
                on product_ProductId = ProductId
                WHERE CategoryId LIKE {$_GET['id']} 
                AND (Gender LIKE '{$_GET['param']}' or Gender IS NULL )";
        $stmt = $db->query("$sql"); 
 
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo    "<div class='col-md-4 product'>
                    <div class='kuvaa'><img src='kuvat/{$row['File_name']}.png' class='tuotekuva'/></div>
                    <div class='nimi'>{$row['Name']} </div>
                    <div class='hinta'>{$row['Price']} </div>
                    <div class='kuvaus'>{$row['Description']} </div>
                    <input type='button' value='luelisaa' class='myBtnn' id='{$row['ProductId']}'>
                    </div>";  
            }
?>