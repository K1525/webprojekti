<head>    
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    
    <!--CSS-->
    <link type="text/css" rel="stylesheet" href="style.css">
    <link type="text/css" rel="stylesheet" href="../navbar/navbar.css">
</head>
<body>
    <?php
    include("../navbar/test.php");
    ?>
    <div class="container">
        <div class="row">    
        <?php
            require_once("db-init.php");
        
            if(isset($_SESSION['searchWord'])){
                //$stmt = $db->prepare("SELECT * FROM product WHERE Name LIKE ? OR Description LIKE ?");                
                $stmt = $db->prepare("SELECT * FROM (SELECT * FROM product WHERE Name LIKE ? OR Description LIKE ?) AS pr INNER JOIN product_image AS im ON pr.ProductId = im.product_ProductId");
                /*
                
                SELECT *
                FROM product WHERE Name LIKE ? OR Description LIKE ? JOIN product_image
                ON product_ProductId = ProductId
                
                */
                $keyword = $_SESSION['searchWord'];
                $keyword = "%".$_SESSION['searchWord']."%";
                $stmt->execute(array($keyword, $keyword)); 
                $rowCount = 0;
                //Tulostetaan käyttöliittymään
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {  
                    echo "<div class='col-md-12 base'>";
                    echo "<div class='col-md-4'>"; 
                    echo "<img src='../images/{$row['File_name']}.png' alt='image'>";
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
                //unset $_SESSION['searchWord'];                
            }
            
            if(isset($_GET['searchButton'])){
                $_SESSION['searchWord'] = $_GET['searchBar'];                
                //Haetaan tietokannasta nimen tai kuvauksen perusteella
                $stmt = $db->prepare("SELECT * FROM (SELECT * FROM product WHERE Name LIKE ? OR Description LIKE ?) AS pr INNER JOIN product_image AS im ON pr.ProductId = im.product_ProductId");                
                $keyword = $_SESSION['searchWord'];
                $keyword = "%".$_SESSION['searchWord']."%";
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
                //unset $_SESSION['searchWord'];
            }
        ?>  
        </div>
    </div>


</body>