<form action="salt.php" method="post">
    <input type="text" name="input">
    <input type="submit" name="button">
</form>

<?php
require_once("db-init.php");
require_once("password_compat-master/lib/password.php");

//SUOLAUS
if(isset($_POST['button'])){
    $password = $_POST['input'];
    
    echo "Password: $password <br>";
    
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
    echo "Random: $random <br>";
    
    //Random hash
    //$salt = password_hash($random, PASSWORD_BCRYPT);
    //echo "Salt: $salt <br>";
    
    //Yhdistetään suola ja salsana
    $finalPassword = $random.$password;    
    echo "Salt + password: $finalPassword <br>"; 
    
    //Suola + salasana hash
    $hash = password_hash($finalPassword, PASSWORD_BCRYPT);
    echo "Hashed salt + password: $hash <br>";
    if(password_verify($finalPassword,$hash)){
        echo "Valid";
    }
    else{
        echo "Invalid";
    }
    
    //Tietokanta
    $sql = "INSERT INTO customer (Username, Password, First_name, Last_name, Email, Password_salt) VALUES ('Kissa', '{$hash}', 'Janne', 'Hyyrylainen', 'sposti', '{$random}');";
    $stmt = $db->prepare($sql);
    $stmt->execute();
}
?>