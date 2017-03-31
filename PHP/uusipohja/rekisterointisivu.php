<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">


<meta charset="UTF-8">
<p>Rekisteröidy:</p>
<?php
session_start();
require_once('db-init.php');
require_once("password_compat-master/lib/password.php");
?>
        <form id="registrationform" method="post" action="rekisterointisivu.php">
            
            <div class="form-group">
                <label>Käyttäjänimi:<br></label>
                <input type="text" name="username" id="username" size="30" class="form-control"   placeholder="Kirjoita tähän Käyttäjänimesi">
            </div>

            <div class="form-group">
                <label>Etunimi:<br></label>
                 <input type="text" name="first_name" id="first_name" size="30" class="form-control"  placeholder="Etunimesi">
            </div>

            <div class="form-group">
                <label>Sukunimi:<br></label>
                <input type="text" name="last_name" id="last_name" size="30" class="form-control"  placeholder="Sukunimesi">
            </div>

            <div class="form-group">
                <label>Salasana:<br></label>
                <input type="password" name="passwd" id="passwd" size="30" class="form-control"  placeholder="Salasana vähintään 6 merkkiä">
            </div>
            
            <div class="form-group">
                <label>Sähköposti:<br></label>
                <input type="email" name="email" id="email" size="30" class="form-control"  placeholder="Kirjoita sähköpostisi">
            </div>
            
            <div class="form-group">
                <label>Lähiosoite:<br></label>
                <input type="text" name="street" id="street" size="30" class="form-control"  placeholder="Kirjoita lähiosoitteesi">
            </div>

            <div class="form-group">
                <label>Kaupunki:<br></label>
                <input type="text" name="city" id="city" size="30" class="form-control"  placeholder="Kirjoita lähiosoitteesi">
            </div>

            <div class="form-group">
                <label>Maa:<br></label>
                <input type="text" name="country" id="country" size="30" class="form-control"  placeholder="Kerro maa, jossa tällä hetkellä asut">
            </div>
            
             <div class="form-group">
                <label>Postinumero:<br></label>
                <input type="text" name="zip" id="zip" size="30" class="form-control"  placeholder="Ilmoita postinumerosi">
            </div>
            
             <button type="submit" id='submitbutton' class="btn btn-default">Rekisteroidy</button>
        </form>
      


        
    <!--    <input type='button' id='submitbutton' name='action' value='Kirjaudu'> -->
        
        

<script type=text/javascript src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
<script type=text/javascript src='skript.js'></script>

<?php
//include('kayttajatiedot.php');
if (isset($_POST['username']) && !empty($_POST['username'])) addUserToDB($db); // TESTATAAN ONKO FORM SUBMITATTU
function addUserToDB($db){
    
   $username = (isset($_POST['username']) && !empty($_POST['username'])) ? $_POST['username'] : null;
   $password = (isset($_POST['passwd']) && !empty($_POST['passwd'])) ? $_POST['passwd'] : null;
    
        //Salasanan suolaus
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
            //Yhdistetään suola ja salsana
            $finalPassword = $random.$password;
            //Suola + salasana hash
            $hash = password_hash($finalPassword, PASSWORD_BCRYPT);
    
   $firstname = (isset($_POST['first_name']) && !empty($_POST['first_name'])) ? $_POST['first_name'] : null;
   $lastname = (isset($_POST['last_name']) && !empty($_POST['last_name'])) ? $_POST['last_name'] : null; 
   $email = (isset($_POST['email']) && !empty($_POST['email'])) ? $_POST['email'] : null;
   $street = (isset($_POST['street']) && !empty($_POST['street'])) ? $_POST['street'] : null;
   $zip = (isset($_POST['zip']) && !empty($_POST['zip'])) ? $_POST['zip'] : null;
   $city = (isset($_POST['city']) && !empty($_POST['city'])) ? $_POST['city'] : null;
   $country = (isset($_POST['country']) && !empty($_POST['country'])) ? $_POST['country'] : null;
   $stmt = $db->prepare("INSERT INTO customer (Username, Password, First_name, Last_name, Email, Password_salt)
   
   VALUES (:username, :password, :firstname, :lastname, :email, :salt)");
   $stmt->bindParam(':username', $username);
   $stmt->bindParam(':password', $hash);
   $stmt->bindParam(':firstname', $firstname);
   $stmt->bindParam(':lastname', $lastname);
   $stmt->bindParam(':email', $email);
   $stmt->bindParam(':salt', $random);
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
    $_SESSION['username'] = $_POST['username'];
    header("Location: valitila.php");
    
    
} 
?>