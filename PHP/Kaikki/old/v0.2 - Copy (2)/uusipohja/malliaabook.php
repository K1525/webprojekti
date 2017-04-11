<style type='text/css'>
tr:nth-child(odd) {background: #f1f1f1}
tr:nth-child(even) {background: #ffffff}
tr:nth-child(1) {background: #ffeedd}
</style>
<a href='mysql-pdo-search-form.php'>Uusi haku</a>
<hr>
<?php
// mysql-pdo-search.php
 
include("navbar.php");
require_once('/home/K2048/php-db-config/db-init.php');
 
$hakuehto = isset($_GET['hakuehto']) ? $_GET['hakuehto'] : '';
     
$stmt = haeHenkilot($db, $hakuehto);
sqlResult2Html($stmt);
 
// 
function haeHenkilot($db, $hakuehto) {
   $sql = <<<SQLEND
   SELECT tunnus, sukunimi, etunimi, email, osoite, puhnro
   FROM henkilot WHERE sukunimi
   LIKE :hakuehto
SQLEND;
 
   $stmt = $db->prepare("$sql");
   $stmt->bindValue(':hakuehto', "%$hakuehto%", PDO::PARAM_STR);
   $stmt->execute();
   return $stmt;    
}
 
// SQL-kyselyn tulosjoukko HTML-taulukkoon.
function sqlResult2Html($stmt) {
 
$row_count = $stmt->rowCount();
$col_count  = $stmt->columnCount();
 
echo "Hakutulokset:" . $row_count. " riviÃ¤:<hr>\n";
echo "<table border='0'>\n";    
$output = <<<OUTPUTEND
<tr bgcolor='#ffeedd'>
<td>Tunnus</td><td>Sukunimi</td><td>Etunimi</td>
<td>Osoite</td><td>Puhnro</td><td>Email</td>
</tr>
OUTPUTEND;
echo $output;
 
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $output = <<<OUTPUTEND
    <tr>
    <td><a href='abook-muokkauslomake.php?id={$row['tunnus']}'>{$row['tunnus']}</a></td><td>{$row['sukunimi']}</td><td>{$row['etunimi']}</td>
    <td>{$row['osoite']}</td><td>{$row['puhnro']}</td><td>{$row['email']}</td>
   </tr>
OUTPUTEND;
    echo $output;
}
echo "</table>\n";
}
 
?>
 
 
 
<?php
include("navbar.php");
require_once('/home/K2048/php-db-config/db-init.php');
 
$id = isset($_GET['id']) ? $_GET['id'] : '';
 
$sql_result = haeHenkilo($db, $id);
 
tee_muokkauslomake($sql_result);
 
 
 
function haeHenkilo($db, $id) {
   $sql = <<<SQLEND
   SELECT tunnus, sukunimi, etunimi, email, osoite, puhnro
   FROM henkilot WHERE tunnus =  :id
SQLEND;
 
   $stmt = $db->prepare("$sql");
   $stmt->bindValue(':id', "$id", PDO::PARAM_STR);
   $stmt->execute();
   return $stmt;    
}
 
 
function tee_muokkauslomake($sql_result){
   $row = $sql_result->fetch(PDO::FETCH_ASSOC);
   $forms = <<<FORMSEND
 
    </form>
    <h2>Osoitekirja</h2>
    <em>Muokkaa osoitetta</em><form method='post' action='muokkaa.php'>
    <table border='0' cellpadding='5'>
    <tr valign='top'>
      <td align='right' bgcolor='#ffeedd'>Tunnus</td>
      <td bgcolor='#dddddd'>{$row['tunnus']}<input type='hidden' name='tunnus' value='{$row['tunnus']}'></td>
    </tr>
    <tr valign='top'>
      <td align='right' bgcolor='#ffeedd'>Sukunimi</td>
      <td bgcolor='#dddddd'><input type='text' name='sukunimi' size='30' value='{$row['sukunimi']}'></td>
    </tr>
    <tr valign='top'>
      <td align='right' bgcolor='#ffeedd'>Etunimi</td>
      <td bgcolor='#dddddd'><input type='text' name='etunimi' size='30' value='{$row['etunimi']}'></td>
    </tr>
    <tr valign='top'>
      <td align='right' bgcolor='#ffeedd'>Osoite</td>
      <td bgcolor='#dddddd'><input type='text' name='osoite' size='30' value='{$row['osoite']}'></td>
    </tr>
    <tr valign='top'>
      <td align='right' bgcolor='#ffeedd'>Puhnro</td>
      <td bgcolor='#dddddd'><input type='text' name='puhnro' size='30' value='{$row['puhnro']}'></td>
    </tr>
    <tr valign='top'>
      <td align='right' bgcolor='#ffeedd'>Email</td>
      <td bgcolor='#dddddd'><input type='text' name='email' size='30' value='{$row['email']}'></td>
    </tr>
    </table>
    <input type='submit' name='action' value='Tallenna muutokset' onclick="javascript: return confirm('HyvÃ¤ksy muutokset?')">
    </form>
FORMSEND;
 
echo $forms;
}
 
?>
 
 
  function popupp(){
                        $asd = 'SELECT * from product WHERE ProductId LIKE' {$row['ProductId']};
                        $stamt = $db->query("$asd"); 
                            while($hae = $stamt->fetch(PD0::FETCH_ASSOC)){
                                echo "<div class='product'>
                                <img src='kuvat/{$row['Img']}.png' class='tuotekuva'/> <br>
                                {$row['Name']} <br>
                                {$row['Price']} <br>
                                {$row['Description']} <br>
                                {$row['DescriptionMore']} <br>
                                ";
                            }
                    }