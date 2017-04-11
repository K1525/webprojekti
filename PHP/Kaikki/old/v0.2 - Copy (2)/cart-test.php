
    <?php
    //Funktioksi joka luodaan sisään kirjautuessa
    //Tehdään ostoskori jos ei ole vielä olemassa
    function createCart(){
        if(!isset($_SESSION['cart'])){
            $_SESSION['cart'] = array();
        }
        if(!isset($_SESSION['id'])){
            $_SESSION['id'] = 0;
        }
    }

    function data(){
        $newdata = array($_SESSION['productName'], $_SESSION['amount'], $_SESSION['price'],
                         "<a href='../subtractItem.php?id={$_SESSION['id']}'><span class='glyphicon glyphicon-minus' aria-hidden='true'></span></a>  <a href='../addItem.php?id={$_SESSION['id']}'><span class='glyphicon glyphicon-plus' aria-hidden='true'></span></a>  <a href='../delete.php?id={$_SESSION['id']}'>Poista</a>", $_SESSION['productId']);
        array_push($_SESSION['cart'], $newdata);
        $_SESSION['id']++;
        //header("Location:ostoskori.php");    
    }

    //Tämä funktioksi joka includeteaan button klikiksi tuotteen lightboxiin
    //Kun lisää ostoskoriin nappia painetaan lisätään matriisiin uusi rivi
    function addToCart(){ 
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
                if($_SESSION['productName'] == $_SESSION['cart'][$c][0]){
                    //Jos Käyttäjä haluaa lisätä useamman tuotteen
                        $_SESSION['cart'][$c][1] = $_SESSION['cart'][$c][1] + 1;
                        $_SESSION['flag'] = 1;                    
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
    
    function printCart(){
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
        echo "<form method='post' action='../osta.php'>";
        echo "<br><br><input type='submit' name='osta' class='btn btn-default' value='Osta'>";
        echo "</form>";
    }


    //TODO
    //Syötettävät tiedot tulevat kyseenomaisesta tuotteesta.
    //Osta nappi ja siihen mysql komento joka lisää tilauksen tietokantaan.
    ?>  