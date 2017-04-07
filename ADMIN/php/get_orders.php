<?php
require_once ("db-init.php");
$sql;
$stmt;
$sql = "SELECT OrderId,Username,Date FROM orders join customer on customer.CustomerId=orders.CustomerId";

if(isset($_POST['param'])) $sql = $sql." WHERE CONCAT_WS(Username,Email,First_name,Last_name)
 LIKE '%".$_POST['param']."%'";

$stmt = $db->prepare($sql); 
$stmt->execute();

$array = array();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
    array_push($array, $row);
echo json_encode($array);
?>