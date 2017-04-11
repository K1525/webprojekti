<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Black Banana verkkokauppa 2.1</title>
        <link href="https://fonts.googleapis.com/css?family=Prompt" rel="stylesheet">
        <!--JQUERY-->
        <script type="text/javascript" src="jquery-3.2.0.min.js"></script>
        <!--BOOTSTRAP-->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <!--OMAT CSS-->
        <link rel="stylesheet" href="CSS/mainStyle.css">
        <!--OMAT JS-->
        <script src="script.js" type="text/javascript"></script>
        <script src="popup.js" type="text/javascript" defer></script>
    </head>
     
    <?php
        session_start();
        require_once("db-init.php");
        include("../ostoskori.php");       
        $sql = "select ProductId, Name, Price, Description, gender, File_name
                from product join product_image
                on product_ProductId = ProductId";
        $stmt = $db->query("$sql");
        createCart();
    ?>
     
    <body>
        <!-- HEADER --> 
        <!--  <header id="header">
            <h4>VERKKOKAUPPA BLACK BANANA 2.1</h4>
        </header> -->
        <!--Navigaatio-->                
         
        <nav class="navbar navbar-default navbar-fixed-top">
            Navbaräääääääääääääääääää
        </nav>
 
        <div id="mainosbanner">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
           <!--     <ol class="carousel-indicators">
                  <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                  <li data-target="#myCarousel" data-slide-to="1"></li>
                  <li data-target="#myCarousel" data-slide-to="2"></li>
                </ol>-->
 
                <!-- Wrapper for slides -->
               <div class="carousel-inner" role="listbox">
 
                  <div class="item active">
                    <img src="kuvat/banner1.png" alt="Chania" width="460" height="345">
                    <div class="carousel-caption">
                      <h3></h3>
                      <p></p>
                    </div>
                  </div>
 
                  <div class="item">
                    <img src="kuvat/banner2.png" alt="Chania" width="460" height="345">
                    <div class="carousel-caption">
                      <h3></h3>
                      <p></p>
                    </div>
                  </div>
 
                  <div class="item">
                    <img src="kuvat/banner3.png" alt="Flower" width="460" height="345">
                    <div class="carousel-caption">
                      <h3></h3>
                      <p></p>
                    </div>
                  </div>
               </div>
 
                <!-- Left and right controls -->
                <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                  <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                  <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>
              </div>
        </div> 
         
         
         
         
        <!-- POPUP CONTENT -->
        <div id="myModal" class="modal">
            <!-- Popup content -->
            <div class="modal-content">
                <span class="close">&times;</span>
            </div>
        </div>
         
        <?php
            printCart();
        ?> 
         
        <div class="container">
            <!--Tuotteet ja filtterit-->
            <!--Filtterit-->
            <div class="left">
                <div class="col-md-3 col-sm-3 col-xs-12 filtterit">
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingOne">
                            <h4 class="panel-title">
                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Miehet
                                </a>
                            </h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                            <div class="panel-body">
                                <ul name="m">
                                    <li id="takit" name="1" class="clickable">Takit</li>
                                    <li id="huppari" name="2"  class="clickable">Pitkähihaiset</li>
                                    <li id="tpaidat" name="3"  class="clickable">T-Paidat</li>
                                    <li id="housut" name="4"  class="clickable">Housut</li>
                                    <li id="kengat" name="5"  class="clickable">Kengät</li>
                                    <li id="asusteet" name="6"  class="clickable">Asusteet</li>
                                    <li id="muut" name="7"  class="clickable">Muut</li>
                                    <li id="kaikki" name="8"  class="clickable">Kaikki</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                      <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingTwo">
                          <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                              Naiset
                            </a>
                          </h4>
                        </div>
                        <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                          <div class="panel-body">
                                <ul name="n">
                                    <li id="takit" class="clickable">Takit</li>
                                    <li id="huppari" class="clickable">Pitkähihaiset</li>
                                    <li id="tpaidat" class="clickable">T-Paidat</li>
                                    <li id="housut" class="clickable">Housut</li>
                                    <li id="kengat" class="clickable">Kengät</li>
                                    <li id="asusteet" class="clickable">Asusteet</li>
                                    <li id="muut" class="clickable">Muut</li>
                                    <li id="kaikki" class="clickable">Kaikki</li>
                                </ul>
                          </div>
                        </div>
                      </div>
 
                    </div>
                </div>                
            </div>
            <!--Tuotetaulu-->
            <div class="row tuotetaulu" id="tuotetaulu">
                   
                    <?php 
                        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo    "<div class='col-md-4 product'>
                                    <div class='kuvaa'><img src='kuvat/{$row['File_name']}.png' class='tuotekuva'/></div>
                                    <div class='nimi'>{$row['Name']} </div>
                                    <div class='hinta'>{$row['Price']} </div>
                                    <div class='kuvaus'>{$row['Description']} </div>
                                    <input type='button' value='luelisaa' class='myBtnn' id='{$row['ProductId']}'>
                                    </div>";  
                        }
                    ?>
 
                </div>
        </div>
         
 
        <footer id="footer">
            <ul>
                Black banana verkkokauppa | 
                Ota yhteyttä sähköpostitse tai somessa. | 
                s-posti : asd.asd@asd.fi | 
                Facebook.com/moi | 
                instagram.com/moi
            </ul>
        </footer>
    </body>
</html>