<?php
require_once ("db-init.php");
$sql;
$stmt;
$sql = "SELECT OrderId,Username,Date FROM orders join customer on customer_CustomerId=CustomerId";
$stmt = $db->prepare($sql); 
$stmt->execute();

$array = [];
while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
    array_push($array, $row);
echo json_encode($array);
?>