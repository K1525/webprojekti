<?php

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
   echo "Lisätty käyttäjä: $username ";
} 

?>