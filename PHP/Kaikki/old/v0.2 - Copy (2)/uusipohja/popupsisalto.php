<head>
        <meta charset="utf-8">
        
</head>
<?php 
session_start();        

require_once("db-init.php");
        
//Tämä
include("../ostoskori.php");


$sql = "select ProductId, Name, Price, Description_more, gender, File_name
                from product join product_image
                on product_ProductId = ProductId
                WHERE ProductId LIKE {$_GET['id']}";
$stmt = $db->query("$sql"); 
    
    $_SESSION['productName'] = "";
    $_SESSION['price'] = "";
    $_SESSION['amount'] = 0;
    $_SESSION['productId'] = 0;
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        //Tämä
        $_SESSION['productName'] = $row['Name'];
        $_SESSION['price'] = $row['Price'];
        $_SESSION['amount'] = 1;
        $_SESSION['productId'] = $row['ProductId'];
        echo    "<div class='isoproduct'>
                    <img src='kuvat/{$row['File_name']}.png' class='tuotekuvapop'/>
                        <div class='nimipop'>{$row['Name']} </div>
                        <div class='hintapop'>{$row['Price']} </div>
                        <div class='kuvauspop'>{$row['Description_more']}
                        
                        <form method='post' action='../addToCart.php'>
                            <input id='addToCart' type='submit' name='submitCart' class='btn btn-default' value='Lisää ostoskoriin'>
                        </form>
                        
                        </div>
                 
                </div>";  
    }


?>