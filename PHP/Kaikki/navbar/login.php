<?php
if(!isset($_SESSION)){ 
        session_start(); 
    } 
require_once('db-init.php');
require_once("password_compat-master/lib/password.php");
if(!isset($_SESSION['loggedIn'])){
    $_SESSION['loggedIn'] = 0;
}
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
           $_SESSION['customerId'] = $row['CustomerId'];
       }
      $testSalt = $passSalt.$password;
        //Testataan salasanoja        
        if(password_verify($testSalt, $hashedPass)){
           $_SESSION['loggedIn'] = 1;            
        }
        else{
            echo "<div class='alert alert-warning infoForm'><strong>Tarkista salasana!</strong></div>";
        }
}
     
   
?>