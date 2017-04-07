<?php
require_once ("db-init.php");
$sql;
$stmt;
$sql = "SELECT ProductId,Name,Price,Gender,Description,/*Stock,*/Category_name
FROM product join category on product.CategoryId=category.CategoryId 
/*join product_color on product.ProductId=product_color.ProductId*/";

if(isset($_POST['param'])) $sql = $sql." WHERE CONCAT(Name,ProductId,Gender,Description) LIKE '%".$_POST['param']."%'";

$sql = $sql." ORDER BY ProductId";

$stmt = $db->prepare($sql); 
$stmt->execute();

$array = array();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
    array_push($array, $row);
echo json_encode($array);
?>