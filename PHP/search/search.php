<head>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    
    <!--CSS-->
    <link type="text/css" rel="stylesheet" href="style.css">
</head>
<body>
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
          <a class="navbar-brand" href="#">Brand</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
            <li><a href="#">Link</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="#">Separated link</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="#">One more separated link</a></li>
              </ul>
            </li>
          </ul>
            
           <!--FORM--> 
          <form class="navbar-form navbar-left" method="get" action="search.php">
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Search" name="searchBar">
            </div>
            <button type="submit" class="btn btn-default" name="searchButton">Submit</button>
          </form>
            
            
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#">Link</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="#">Separated link</a></li>
              </ul>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
    
    <div class="container">
        <div class="row">    
        <?php
            require_once("db-init.php");
        
            if(isset($_GET['searchButton'])){
                $searchWord = $_GET['searchBar'];                
                //Haetaan tietokannasta nimen tai kuvauksen perusteella
                $stmt = $db->prepare("SELECT * FROM product WHERE Name LIKE ? OR Description LIKE ?");                
                $keyword = $searchWord;
                $keyword = "%".$searchWord."%";
                $stmt->execute(array($keyword, $keyword)); 
                $rowCount = 0;
                //Tulostetaan käyttöliittymään
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {  
                    echo "<div class='col-md-12 base'>";
                    echo "<div class='col-md-4'>"; 
                    echo "<img src='../images/{$img}{$row['ProductId']}.png' alt='image'>";
                    echo "</div>";                    
                    echo "<div class='col-md-8'>";
                    echo "<h1>{$row['Name']}</h1><br>\n";
                    echo "<h4>{$row['Description']}</h4><br>\n";
                    echo "<h3>{$row['Price']}</h3><br>\n";
                    echo "<a href='{$row['ProductId']}'>Siirry tuotesivulle</a>";
                    echo "</div>";
                    echo "</div>";
                    $rowCount = $rowCount + 1;                    
                }
                //Jos ei löydy yhtään tuotetta hakuehdoilla
                if($rowCount == 0){
                    echo "Hakusanalla ei löytynyt yhtään tuotetta.";
                }
            }
        ?>  
        </div>
    </div>


</body>