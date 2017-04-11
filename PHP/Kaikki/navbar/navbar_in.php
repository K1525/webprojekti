<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    
    <link type="text/css" rel="stylesheet" href="navbar.css">
</head>
<body>
    <?php
    if(!isset($_SESSION)){ 
        session_start();                
    }
    include("../v0.2/cart-test.php");
    createCart();
    ?>    
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">LOGO</a>
    </div>

    
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <!--LINKS-->
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>        
      </ul>
        
      <!--SEARCH-->        
      <form class="navbar-form navbar-left" method="post" action="../navbar/navbar_in.php">
        <div class="form-group has-feedback">
            <i class="glyphicon glyphicon-search form-control-feedback"></i>
            <input type="search" class="form-control" placeholder="Search" name="searchBar">
        </div>
        <input id="mySubmit" type="submit" class="btn btn-default hidden" name='searchButton'>
      </form>        
        
        <!--USER-->
        <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
              
              <?php
        if(!isset($_SESSION)){ 
        session_start(); 
        } 
        if($_SESSION['loggedIn'] == 1){
            echo "{$_SESSION['username']}";
        }              
        ?>
              
              <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="../tilinhallinta/kayttaja.php">Tilinhallinta</a></li>
            <li role="separator" class="divider"></li>
            <li>
                <a href="../navbar/logout.php">Kirjaudu ulos</a>
            </li>
          </ul>
        </li>
      </ul>
        
        <!--CART-->
        <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Ostoskori
              <span class="caret"></span></a>
          <ul class="dropdown-menu wider">
              <!--OSTOSKORI TÄHÄN-->
              <?php
                printCart();
              ?>
          </ul>
        </li>
      </ul>
    
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<?php
    if(!isset($_SESSION)){ 
        session_start(); 
    }
    if(isset($_POST['logout'])){
        unset($_POST['logout']);
        header("location: logout.php");
    }
    if(isset($_POST['searchButton'])){
        $_SESSION['searchWord'] = $_POST['searchBar'];
        header("Location: ../search/search.php");
    }    
?>
</body>