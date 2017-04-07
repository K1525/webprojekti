<?php
require_once ("db-init.php");
$sql;
$stmt;
$sql = "SELECT ProductId,Name,Price,Gender,
Description/*,Stock*/,CategoryName,category.CategoryId as category_CategoryId 
FROM product join category on CategoryId=category_CategoryId";
$stmt = $db->prepare($sql); 
$stmt->execute();

$array = array();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
    array_push($array, $row);
echo json_encode($array);
?>