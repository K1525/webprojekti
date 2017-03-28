<meta charset="UTF-8">

<!-- Latest compiled and minified CSS -->
<script type=text/javascript src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>



<form id="kirjautuminen" method="post" action="login.php">
    <div class="form-group">
        <label>Käyttäjänimi:<br></label>
        <input type="text" name="username" id="username" size="30" class="form-control"   placeholder="Kirjoita tähän Käyttäjänimesi">
    </div>
    
    <div class="form-group">
        <label>Salasana:<br></label>
        <input type="password" name="passwd" id="passwd" size="30" class="form-control" placeholder="Salasana vähintään 6 merkkiä">
    </div>
    
     <button type="submit" name='submitbutton' class="btn btn-default">Kirjaudu</button>
</form>
    
    <?php
session_start();
require_once('db-init.php');
require_once("password_compat-master/lib/password.php");

if(isset($_POST['submitbutton'])){
   $_SESSION['username'] = $_POST['username'];
            $password = $_POST['passwd'];
    
    $passSQL = "SELECT * FROM customer WHERE Username LIKE '{$_SESSION['username']}' ";
        $passSTMT = $db->prepare($passSQL);
        $passSTMT->execute();
        $passSalt = "";
        $hashedPass = "";
        $userid = "";
       while($row = $passSTMT->fetch(PDO::FETCH_ASSOC)){

           $passSalt = $row['Password_salt'];
           $hashedPass = $row['Password'];
           
           $userid = $row['CustomerId'];
       }

      $testSalt = $passSalt.$password;
        //Testataan salasanoja
        if(password_verify($testSalt, $hashedPass)){
           $_SESSION['loggedIn'] = 1;
            echo "toimii!";
        }
        else{
            echo "<div class='alert alert-warning infoForm'><strong>Tarkista salasana!</strong></div>";
        }

}
     
   
?>
