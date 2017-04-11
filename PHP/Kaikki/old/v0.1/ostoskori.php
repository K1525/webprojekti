<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<form method="post" action="ostoskori.php">
    <input type="text" name="productName">
    <input type="text" name="amount">
    <input type="text" name="price">
    <input type="submit" name="submit">
</form>

<?php
session_start();

//Tehdään ostoskori jos ei ole vielä olemassa
if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = array();
}
if(!isset($_SESSION['id'])){
    $_SESSION['id'] = 0;
}

//Kun lisää ostoskoriin nappia painetaan lisätään matriisiin uusi rivi
//Jos tuote on jo ostoskorissa lsätään tuotteen määrää yhdellä KESKEN!!!!!!
if(isset($_REQUEST['submit'])){
    $newdata = array($_REQUEST['productName'], $_REQUEST['amount'], $_REQUEST['price'],
                     "<a href='subtractItem.php?id={$_SESSION['id']}'><span class='glyphicon glyphicon-minus' aria-hidden='true'></span></a>  <a href='addItem.php?id={$_SESSION['id']}'><span class='glyphicon glyphicon-plus' aria-hidden='true'></span></a>  <a href='delete.php?id={$_SESSION['id']}'>Poista</a>");
    array_push($_SESSION['cart'], $newdata);
    $_SESSION['id']++;
    header("Location:ostoskori.php");    
}


//!!!Poistettaessa rivi matriisista rivien id muuttuu joten linkit eivät ohjaa enään oikein!!!


/*Kokonaishinta*/
$_SESSION['totalPrice'] = 0;

/*Lasketaan kokonaishinta*/
if(sizeof($_SESSION['cart']) == 0){
    echo "Ostoskori on tyhjä";
}
else{    
    echo "<form method='POST' action='ostoskori.php'>";
    for($i = 0; $i < sizeof($_SESSION['cart']); $i++){
        $_SESSION['totalPrice'] = $_SESSION['totalPrice'] + $_SESSION['cart'][$i][2] * $_SESSION['cart'][$i][1];
        echo "{$_SESSION['cart'][$i][0]} | {$_SESSION['cart'][$i][1]} | {$_SESSION['cart'][$i][2]}€ | {$_SESSION['cart'][$i][3]} <br>";    
    }
    echo "</form>";

    echo "KOKONAISHINTA: {$_SESSION['totalPrice']}€ <br>";
}

//TODO
//Jos on olemassa sama tuote kuin jonka lisää ostoskoriin nappia painettiin lisätään sen määrää yhdellä.
//Tuotteen poistaminen matriisin keskeltä antaa virheilmoituksen.
//Syötettävät tiedot tulevat kyseenomaisesta tuotteesta.
//Osta nappi ja siihen mysql komento joka lisää tilauksen tietokantaan.
?>