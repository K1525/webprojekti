<!-- DB INIT -->
<?php
include("ostoskori.php");
require_once ("db-init.php");
$sql = "SELECT * FROM product";
$stmt = $db->query("$sql");
?><?php  
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) { 
echo "
<div class='asd'>
<div class='tiedot col-md-2'>
<img src='kuvat/{$row['img']}.png' class='img-responsive'>
<div class='hintalappu'><p class='hinta'>{$row['price']}</p>
<div class='gradient'><p class='nimi'>{$row['name']}</p></div><br>
<div><p>Varastossa: {$row['stock']}</p></div>
<div><p>Varastossa: {$row['description']}</p></div>
</div>
</div>";
}
?>