<head>
    <title>Tilinhallinta</title>
    <meta charset="utf-8">
    <script
  src="https://code.jquery.com/jquery-3.1.1.js"
  integrity="sha256-16cdPddA6VdVInumRGo6IbivbERE8p7CQR3HzTBuELA="
  crossorigin="anonymous"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>    
    <link rel="stylesheet" href="form.css" type="text/css">
</head>
<body>
<?php
    session_start();
    require_once("db-init.php");
    require_once("password_compat-master/lib/password.php");
    
    $_SESSION['customerId'] = 1;
    
    //Haetaan tiedot kannasta
    $sql = "SELECT * FROM customer WHERE CustomerId LIKE {$_SESSION['customerId']};";
    $addressSql = "SELECT * FROM address WHERE CustomerId LIKE {$_SESSION['customerId']};";
    $formSQL = $db->query($sql);
    $addressSQL = $db->query($addressSql);
    
    $firstname = "";
    $surname = "";
    $puhnro = "";
    $password = "";
    $email = "";
    
    while($row = $formSQL->fetch(PDO::FETCH_ASSOC)) {
        @$firstname = $row['First_name'];
        @$surname = $row['Last_name'];
        @$puhnro = $row['Phone'];
        @$password = $row['Password'];
        @$email = $row['Email'];
    }
    while($rivi = $addressSQL->fetch(PDO::FETCH_ASSOC)) {
        @$address = $rivi['Address_street'];
        @$address_zip = $rivi['Address_zip'];
        @$address_city = $rivi['Address_city'];
        @$address_country = $rivi['Adress_country'];
        
    }
//Lomakkeet
$form = <<<FORM
<div class="infoForm">
    <form method='post' action='kayttaja.php'>
        <div class="form-group">
            <label>Etunimi</label>
            <input type='text' name='firstname' value='{$firstname}' class='form-control'>
        </div>
        <div class="form-group">
            <label>Sukunimi</label>
            <input type='text' name='surname' value='{$surname}' class='form-control'>
        </div>
        <div class="form-group">
            <label>Puhelinnumero</label>
            <input type='text' name='puhnumber' value='{$puhnro}' class='form-control'>
        </div>
        <div class="form-group">
            <label>Sähköposti</label>
            <input type='text' name='email' value='{$email}' class='form-control'>
        </div>
        <div class="form-group">
            <label>Osoite</label>
            <input type='text' name='address' value='{$address}' class='form-control'>
        </div>
        <div class="form-group">
            <label>Postinumero</label>
            <input type='text' name='postNumber' value='{$address_zip}' class='form-control'>
        </div>
        <div class="form-group">
            <label>Postitoimipaikka</label>
            <input type='text' name='postAddress' value='{$address_city}' class='form-control'>
        </div>
        <input type='submit' value='Tallenna' class="btn btn-default" name='Tallenna'>
    </form>
</div>
FORM;
    $passForm = <<<PASS
    <div class="infoForm">
    <form method='post' action='kayttaja.php'>
        <div class="form-group">
            <label>Uusi salasana</label>
            <input type='password' name='password' class='form-control'>            
        </div>
        <div class="form-group">
            <label>Uusi salasana uudestaan</label>
            <input type='password' name='passwordSecond' class='form-control'>            
        </div>
        <div class="form-group">
            <label>Vanha salasana</label>
            <input type='password' name='oldPassword' class='form-control'>
        </div>
        <input type='submit' value='Vaihda salasana' class="btn btn-default" name='TallennaSala'>
    </form>
    </div>
PASS;
//Tulostetaan lomake
    echo "$form";
    echo "$passForm";
    if(isset($_POST['Tallenna'])){
        $firstnameT = $_POST['firstname'];
        $surnameT = $_POST['surname'];
        $puhnroT = $_POST['puhnumber'];
        //$passwordT = $_POST['password'];
        $emailT = $_POST['email'];
        $address = $_POST['address'];
        $postnumber = $_POST['postNumber'];
        $postaddress = $_POST['postAddress'];
        $country = "Suomi";
        $stmt = $db->prepare('UPDATE customer SET First_name=?, Last_name=?, Email=?, Phone=? WHERE CustomerId=?');
        $stmt2 = $db->prepare('UPDATE address SET Address_street=?, Address_zip=?, Address_city=?, Address_country=? WHERE CustomerId=?');
        $stmt->execute(array($firstnameT, $surnameT, $emailT, $puhnroT, $_SESSION['customerId']));
        $stmt2->execute(array($address, $postnumber, $postaddress, $country, $_SESSION['customerId']));
        //$affected_rows = $stmt->rowCount();
        echo "<div class='alert alert-success infoForm'><strong>Tiedot tallennettiin onnistuneesti!</strong></div>";
        header("locaton: kayttaja.php");
    }
    if(isset($_POST['TallennaSala'])){
        $newPassword = $_POST['password'];
        $newPassword2 = $_POST['passwordSecond'];
        $oldPassword = $_POST['oldPassword'];
        
        
        //Haetaan suola ja salasana
        $passSQL = "SELECT * FROM customer WHERE CustomerId LIKE {$_SESSION['customerId']}";
        $passSTMT = $db->prepare($passSQL);
        $passSTMT->execute();
        $passSalt = "";
        $hashedPass = "";
        while($row = $passSTMT->fetch(PDO::FETCH_ASSOC)){
            $passSalt = $row['Password_salt'];
            $hashedPass = $row['Password'];
        }
        //Yhdistetään suola ja salasana
        $testSalt = $passSalt.$oldPassword;
        //Testataan salasanoja
        if(password_verify($testSalt, $hashedPass) && $newPassword == $newPassword2){
            //Suolataan uusi salasana
            //Luodaan random string
            function generateRandomString($length = 60) {
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $charactersLength = strlen($characters);
                $randomString = '';
                for ($i = 0; $i < $length; $i++) {
                    $randomString .= $characters[rand(0, $charactersLength - 1)];
                }
                return $randomString;
            }    
            $random = generateRandomString();
            
            $finalPassword = $random.$newPassword;
            $hash = password_hash($finalPassword, PASSWORD_BCRYPT);
            //Päivitetään tietokantaan
            $passwordstmt = $db->prepare('UPDATE customer SET Password=?, Password_salt=? WHERE CustomerId=?');
            $passwordstmt->execute(array($hash,$random, $_SESSION['customerId']));
            echo "<div class='alert alert-success infoForm'><strong>Salasana vaihdettiin onnistuneesti!</strong></div>";
        }
        else{
            echo "<div class='alert alert-warning infoForm'><strong>Tarkista salasana!</strong></div>";
        }
    }
    
    
?>
</body>
