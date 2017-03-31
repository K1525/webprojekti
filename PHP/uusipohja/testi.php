<?php 
        require_once("db-init.php");
        $sql = "SELECT * from product";
        $stmt = $db->query("$sql"); 
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        $sql_result = haeHenkilo($db, $id);
 
        tee_muokkauslomake($sql_result);
 
function haeHenkilo($db, $id) {
       $sql = <<<SQLEND
       SELECT * from product WHERE ProductId =  :id
SQLEND;
 
   $stmt = $db->prepare("$sql");
   $stmt->bindValue(':id', "$id", PDO::PARAM_STR);
   $stmt->execute();
   return $stmt;    
}
 
function tee_muokkauslomake($sql_result){
   $row = $sql_result->fetch(PDO::FETCH_ASSOC);
   $forms = <<<FORMSEND
 
        <div class='product'>
                <img src='kuvat/{$row['Img']}.png' class='tuotekuva'/> <br>
        {$row['Name']} <br>
        {$row['Price']} <br>
        {$row['Description']} <br>
        {$row['DescriptionMore']} <br>
FORMSEND;
 
echo $forms;
}
 
?>