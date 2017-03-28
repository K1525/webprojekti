<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">


<meta charset="UTF-8">
<p>Rekisteröidy:</p>
<?php
require_once('db-init.php');
?>
      <form id="registrationform" method="post" action="rekisterointisivu.php"> 
        
        Käyttäjänimi:<br><input type="text" name="username" id="username" size="30"><br>
        Etunimi:<br><input type="text" name="first_name" id="first_name" size="30"><br>
        Sukunimi:<br><input type="text" name="last_name" id="last_name" size="30"><br>
        Salasana:<br><input type="text" name="passwd" id="passwd" size="30"><br>
        Email:<br><input type="text" name="email" id="email" size="30"><br>
        Katu:<br><input type="text" name="street" id="street" size="30"><br>
        Kaupunki:<br><input type="text" name="city" id="city" size="30"><br>
        Maa:<br><input type="text" name="country" id="country" size="30"><br>
        Postinumero:<br><input type="text" name="zip" id="zip" size="30"><br>
          
        <input type='button' id='submitbutton' name='action' value='Kirjaudu'>
        </form>

<script type=text/javascript src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
<script type=text/javascript src='skript.js'></script>

<?php
//include('kayttajatiedot.php');
if (isset($_POST['username']) && !empty($_POST['username'])) addUserToDB($db); // TESTATAAN ONKO FORM SUBMITATTU

function addUserToDB($db){
    
   $username = (isset($_POST['username']) && !empty($_POST['username'])) ? $_POST['username'] : null;
   $password = (isset($_POST['password']) && !empty($_POST['password'])) ? $_POST['password'] : null;
   $firstname = (isset($_POST['first_name']) && !empty($_POST['first_name'])) ? $_POST['first_name'] : null;
   $lastname = (isset($_POST['last_name']) && !empty($_POST['last_name'])) ? $_POST['last_name'] : null; 
   $email = (isset($_POST['email']) && !empty($_POST['email'])) ? $_POST['email'] : null;
   $street = (isset($_POST['street']) && !empty($_POST['street'])) ? $_POST['street'] : null;
   $zip = (isset($_POST['zip']) && !empty($_POST['zip'])) ? $_POST['zip'] : null;
   $city = (isset($_POST['city']) && !empty($_POST['city'])) ? $_POST['city'] : null;
   $country = (isset($_POST['country']) && !empty($_POST['country'])) ? $_POST['country'] : null;
   $stmt = $db->prepare("INSERT INTO customer (Username, Password, First_name, Last_name, Email)
   
   VALUES (:username, :password, :firstname, :lastname, :email)");
   $stmt->bindParam(':username', $username);
   $stmt->bindParam(':password', $password);
   $stmt->bindParam(':firstname', $firstname);
   $stmt->bindParam(':lastname', $lastname);
   $stmt->bindParam(':email', $email);
   $stmt->execute();
   $id = $db->lastInsertId();
   $stmt2 = $db->prepare("INSERT INTO address (CustomerId, Address_street, Address_zip, Address_city, Address_country)
   VALUES (:id, :street, :zip, :city, :country)");
   $stmt2->bindParam(':id', $id);
   $stmt2->bindParam(':street', $street);
   $stmt2->bindParam(':zip', $zip);
   $stmt2->bindParam(':city', $city);
   $stmt2->bindParam(':country', $country);
   $stmt2->execute();
    
    // lisäyksen jälkeen:
            //location header ohjaa erillisille php-sivulle
                // kertoo lisätyn käyttäjän --> timeout funktio --> ohjaa etusivulle
    header("Location: valitila.php");
    
} 

?>