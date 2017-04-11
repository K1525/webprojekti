<?php$db = new PDO('mysql:host=mysql.labranet.jamk.fi;dbname=H8718_1;charset=utf8',         
                   'H8718', 'XdyeRqeh7J7aKPhstPFq2qFXRpA75EvL');

$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);


if(isset($_POST["submit"])) insert_comment($db);

function insert_comment ($db) {
   $productid = 2;
   $author = (isset($_POST["comment_author"]) &&
              !empty($_POST["comment_author"])) ?  $_POST["comment_author"] : NULL;
             
   $email = (isset($_POST["email"])  && !empty($_POST["email"])) ?  $_POST["email"] : NULL;
             
   $comment = (isset($_POST["comment"]) && !empty($_POST["comment"])) ?  $_POST["comment"] : NULL;
   
   $sql = "INSERT INTO product_ratings (Title,Comment,Date,ProductId,CustomerId) VALUES (:f1, :f2, now(), :f3, 1)";
   $stmt = $db->prepare($sql);
   $stmt->execute(array(':f1' => $author, ':f2' => $comment, ':f3' => $productid));
}

show_comment($db);

function show_comment ($db) {
   $sql = "SELECT * FROM product_ratings";
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