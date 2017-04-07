<?php
require_once ("db-init.php");
$sql;
$stmt;
$sql = "SELECT CustomerId,Username,First_name,Last_name,Email,Phone,User_level 
FROM customer";
// $sql = "SELECT CustomerId,Username,First_name,Last_name,Email,Phone,User_level,Address_street,Address_city,
// Address_zip,Address_country from customer join address on customer_CustomerId=CustomerId where ...

if(isset($_POST['param'])) $sql = $sql." WHERE CONCAT_WS(Username,Email,First_name,Last_name,
Phone,CustomerId,User_level) LIKE '%".$_POST['param']."%'";

$sql = $sql." ORDER BY CustomerId";

$stmt = $db->prepare($sql); 
$stmt->execute();

$array = array();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
    array_push($array, $row);
echo json_encode($array);
?>