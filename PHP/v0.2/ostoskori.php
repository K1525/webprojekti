<head>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>

<body>
    <form method="post" action="ostoskori.php">
        <div class="form-group">
            <label>Tuotteen nimi</label>
            <input type="text" name="productName" class="form-control">
        </div>
        <div class="form-group">
            <label>Määrä</label>
            <input type="text" name="amount" class="form-control">
        </div>
        <div class="form-group">
            <label>Hinta</label>
            <input type="text" name="price" class="form-control">
        </div>    
        <input type="submit" name="submit" class="btn btn-default">
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

    function data(){
        $newdata = array($_REQUEST['productName'], $_REQUEST['amount'], $_REQUEST['price'],
                         "<a href='subtractItem.php?id={$_SESSION['id']}'><span class='glyphicon glyphicon-minus' aria-hidden='true'></span></a>  <a href='addItem.php?id={$_SESSION['id']}'><span class='glyphicon glyphicon-plus' aria-hidden='true'></span></a>  <a href='delete.php?id={$_SESSION['id']}'>Poista</a>");
        array_push($_SESSION['cart'], $newdata);
        $_SESSION['id']++;
        header("Location:ostoskori.php");    
    }

    //Kun lisää ostoskoriin nappia painetaan lisätään matriisiin uusi rivi
    if(isset($_REQUEST['submit'])){
        //Jos ostoskoria ei ole olemassa
        if(sizeof($_SESSION['cart']) == 0){
            data();        
        }
        //Jos on
        else{        
            $sizeof = sizeof($_SESSION['cart']);
            if(!isset($_SESSION['flag'])){
                $_SESSION['flag'] = 0;
            }
            //Tutkitaan onko kyseinen esine jo korissa jos on lisätään sen määrää yhdellä
            for($c = 0; $c < $sizeof; $c++){
                if($_REQUEST['productName'] == $_SESSION['cart'][$c][0]){
                    //Jos Käyttäjä haluaa lisätä useamman tuotteen
                    if($_REQUEST['amount'] > 0){
                        $_SESSION['cart'][$c][1] = $_SESSION['cart'][$c][1] + $_REQUEST['amount'];
                        $_SESSION['flag'] = 1;
                        header("location: ostoskori.php");
                    }
                    //Jos käyttäjä ei ole asettanut kappalemäärää mutta syöttää lomakkeen
                    else{
                        $_SESSION['cart'][$c][1] = $_SESSION['cart'][$c][1] + 1;
                        $_SESSION['flag'] = 1;
                        header("location: ostoskori.php");
                    }
                }                
            }
            //Jos tuotetta ei ole olemassa, lisätään tuote ostoskoriin.
            if($_SESSION['flag'] == 0){
                data();
                $_SESSION['flag'] = 1;
            }
            $_SESSION['flag'] = 0;
        }    
    }   

    /*Kokonaishinta*/
    $_SESSION['totalPrice'] = 0;

    /*Lasketaan kokonaishinta*/
    if(sizeof($_SESSION['cart']) == 0){
        echo "Ostoskori on tyhjä";
    }
    else{
        for($i = 0; $i < sizeof($_SESSION['cart']); $i++){
            $_SESSION['totalPrice'] = $_SESSION['totalPrice'] + $_SESSION['cart'][$i][2] * $_SESSION['cart'][$i][1];
            echo "{$_SESSION['cart'][$i][0]} | {$_SESSION['cart'][$i][1]} | {$_SESSION['cart'][$i][2]}€ | {$_SESSION['cart'][$i][3]} <br>";    
        }

        echo "KOKONAISHINTA: {$_SESSION['totalPrice']}€ <br>";
    }

    //Osta nappi
    echo "<form method='post' action='osta.php'>";
    echo "<br><br><input type='submit' name='osta' class='btn btn-default' value='Osta'>";
    echo "</form>";
    


    //TODO
    //Syötettävät tiedot tulevat kyseenomaisesta tuotteesta.
    //Osta nappi ja siihen mysql komento joka lisää tilauksen tietokantaan.
    ?>

</body>    