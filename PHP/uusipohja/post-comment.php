<?php
require_once("db-init.php");

if(isset($_POST["data"]))
{
    insert_comment($db); // data muuttuja voi olla esim. array ja sen sisällä tarvittavat tiedot
}

else show_comment($db);

function insert_comment ($db) { 
             
   $comment = (isset($_POST["data"]) && !empty($_POST["data"])) ?  $_POST["data"] : NULL;
   
    $_SESSION['productId'] = 1;
    $_SESSION['customerId'] = 1;
    
    $productId = $_SESSION['productId'];
    $customerId = $_SESSION['customerId'];
    
    $timestamp = now();
    
   $sql = "INSERT INTO product_ratings (Title,Comment,Date,ProductId,CustomerId) VALUES (:f1, :f2, :f5, :f3, :f4)";
   $stmt = $db->prepare($sql);
   $stmt->execute(array(':f1' => $customerId, ':f2' => $comment, ':f3' => $productId ,':f4' => $customerId, ':f5' => $timestamp ));
   
    //SELECT Username FROM customer WHERE CustomerId = '.$customerId.'  

    echo "inserted";
}

//show_comment($db);

function show_comment ($db) {
   $sql = "SELECT * FROM product_ratings WHERE ProductId=1"; // 1 tilalle pitää hakea jostain tuotteen ProductId sessiomuuttujista
   $result = $db->query($sql);
   while($row = $result->fetch(PDO::FETCH_ASSOC)) {
       $output = <<<OUTPUTEND
       <tr>
   <td>{$row['Title']}</td>  <td>{$row['Comment']}</td>  <td>{$row['Date']}</td><br><br>
   </tr>
OUTPUTEND;
   echo $output;
   }
}?>