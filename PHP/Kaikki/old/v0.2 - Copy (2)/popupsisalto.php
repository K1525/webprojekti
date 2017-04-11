<head>
        <meta charset="utf-8">
</head>
<?php 
        require_once("db-init.php");

        include("ostoskori.php");


        $sql = "select ProductId, Name, Price, Description_more, gender, File_name
                from product join product_image
                on product_ProductId = ProductId
                WHERE ProductId LIKE {$_GET['id']}";
        $stmt = $db->query("$sql"); 
 
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo    "<div class='isoproduct'>
                    <img src='kuvat/{$row['File_name']}.png' class='tuotekuvapop'/>
                        <div class='nimipop'>{$row['Name']} </div>
                        <div class='hintapop'>{$row['Price']} </div>
                        <div class='kuvauspop'>{$row['Description_more']}
                        
                        
                        <input type='submit' name='submitCart' class='btn btn-default'>
                        
                        
                        </div>
                 
                </div>";  
    }
    if(isset($_POST['submitCart'])){
        addToCart();
    }
?>