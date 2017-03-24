<form method="post" action="check.php">
    <input type="text" name="user">
    <input type="text" name="input">    
    <input type="submit" name="submit">
</form>

<?php
require_once("db-init.php");
require_once("password_compat-master/lib/password.php");

if(isset($_POST['submit'])){
    $user = $_POST['user'];
    $password = $_POST['input'];
    
    //Haetaan suola ja salasana
    $sql = "SELECT * FROM customer WHERE Username LIKE ?";
    $stmt = $db->prepare($sql);
    $stmt->execute(array($user));
    $passSalt = "";
    $hashedPass = "";
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $passSalt = $row['Password_salt'];
        $hashedPass = $row['Password'];
    }
    
    $testSalt = $passSalt.$password;
    
    if(password_verify($testSalt, $hashedPass)){
        echo "Toimii";
    }
    else{
        echo "Ei toimi";
    }
    
    /*
    echo "SALT: $passSalt <br>";
    
    //Suolan hash
    $passSalt = password_hash($passSalt, PASSWORD_BCRYPT);    
    echo "HASH SALT: $passSalt <br>";
    
    //Yhdistetään suola ja salasana
    $testSalt = $passSalt.$password;
    //Suola + salasana hash
    $hash = password_hash($testSalt, PASSWORD_BCRYPT);
    
    echo "$hash <br>";
    
    //Tarkistetaan onko samat
    if($hash == $hashedPass){
        echo "Kirjautuminen onnistui";
    }
    else{
        echo "Kirjautuminen epäonnistui";
    }
    */
}


?>