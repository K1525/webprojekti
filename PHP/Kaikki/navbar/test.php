<?php
if(!isset($_SESSION)){ 
        session_start(); 
    } 
include("login.php");

if($_SESSION['loggedIn'] == 1){
    include("navbar_in.php");
}
else{
    include("navbar_out.php");
}

//echo "<p>{$_SESSION['loggedIn']}</p>";


?>