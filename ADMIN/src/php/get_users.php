<?php
require_once ("db-init.php");
$sql;
$stmt;
$sql = "SELECT CustomerId,Username,First_name,Last_name,Email,Phone,User_level 
FROM customer";
// $sql = "SELECT CustomerId,Username,First_name,Last_name,Email,Phone,User_level,Address_street,Address_city,
// Address_zip,Address_country from customer join address on customer_CustomerId=CustomerId where ...
$stmt = $db->prepare($sql); 
$stmt->execute();

$array = [];
while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
    array_push($array, $row);
echo json_encode($array);
?>