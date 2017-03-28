<meta charset="UTF-8">

<!-- Latest compiled and minified CSS -->
<script type=text/javascript src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<?php
session_start();
require_once('db-init.php');
    //kertoo ohjatulta sivulta uuden käyttäjänimen:
echo "Lisätty käyttäjä: {$_SESSION['username']}"; 
//timeoutfunktio ohjaa tietyn ajan kuluessa etusivulle
?>

<script>
    
    //6 sekunnin kuluttua automaattinen ohjaus etusivulle
    setTimeout(function(){
        window.location.replace("etusivu.php");
    },4000); 
</script>


    <button type="button" id='submitbutton' class="btn btn-default">Siiry etusivulle</button>
<!-- <button type="submit" id='submitbutton' class="btn btn-default">Siirry etusivulle</button> -->

<script>
    // nopeampi keino päästä etusivulle
    $("#submitbutton").click(function(){ 
        console.log("testi");
        window.location.replace("etusivu.php");		
	});    
</script>