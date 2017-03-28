<meta charset="ISO-8859-1">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js" type="text/javascript"></script>
<script src="rekisteri.js" type="text/javascript"></script>

<?php 
session_start();
    //valmis filu S:m juuressa, tarvitaan salasanan käyttämiseen:
require_once('db-init.php');
$lib = new PasswordLib\PasswordLib();

    //hakee ja antaa käyttöön tietokantayhteyden:
$errmsg = '';
if (isset($_POST['uid']) AND isset($_POST['passwd'])) {
require_once('/home/H8851/php-dbconfig/db-init.php');

 $uid = $_POST['uid'];
   $passwd = $_POST['passwd'];
   
   $sql = "SELECT uid, password
            FROM php_pwlib_users
            WHERE uid = :uid";
       
    $stmt = $db->prepare($sql);
    $stmt->execute(array($uid));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);  
   
    if ($stmt->rowCount() == 1 AND $lib->verifyPasswordHash($passwd, $row['password'])) {
   
        $_SESSION['app2_islogged'] = true;
        $_SESSION['uid'] = $_POST['uid'];
         header("Location: http://" . $_SERVER['HTTP_HOST']
                                    . dirname($_SERVER['PHP_SELF']) . '/'
                                    . "verkkokauppasivu.php");
        exit;
    } else {
        $errmsg = '<span style="background: yellow;">Tunnus/Salasana vaarin!</span>';
    }
}
?>

<title>Kirjautusmislomake</title>
<?php
if ($errmsg != '')echo $errmsg;
?>
  
<p>Tervetuloa verkkokauppaan, et ole nyt kirjautunut</p>
<p>Kirjaudu tai rekisteroidy kayttaaksesi palvelua paremmin</p>

<p>Tunnus/salasanaparit: admin/sala, ara/sala ja ara2/sala</p>

<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>"
    style=color:#000;background-color:#eeeeee>
        Tunnus:<br><input type="text" name="uid" size="30"><br>
        Salasana:<br><input type="text" name="passwd" size="30"><br>
        <input type='submit' name='action' value='Kirjaudu'>
    <br>
</form>

<form method="post" action="alku.php">
    <style=color:#000;background-color:#eeeeee>
    <p>Jos sinulla ei ole tunnusta, voit myos rekisteroitya:</p>
        
    <input type='submit' name='nappi'  value='siirry rekisteroitymaan'>

</form>

<?php
if(isset($_POST['nappi'])){
   header("location: rekisterointi.php");
}
?>
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
