<?php
require_once ("db-init.php");

add_user_to_db($db);

function add_user_to_db($db){
    $u = $_POST['user'];
    $a = $_POST['address'];
    $username = (isset($u['0']) && !empty($u['0'])) ? $u['0'] : null;
    $password = (isset($u['1']) && !empty($u['1'])) ? $u['1'] : null;
    $firstname = (isset($u['2']) && !empty($u['2'])) ? $u['2'] : null;
    $lastname = (isset($u['3']) && !empty($u['3'])) ? $u['3'] : null;
    $userLevel = (isset($u['6']) && !empty($u['6'])) ? $u['6'] : null;
    $email = (isset($u['4']) && !empty($u['4'])) ? $u['4'] : null;
    $phone = (isset($u['5']) && !empty($u['5'])) ? $u['5'] : null;
    $street = (isset($u['0']) && !empty($u['0'])) ? $u['0'] : null;
    $zip = (isset($a['1']) && !empty($a['1'])) ? $a['1'] : null;
    $city = (isset($a['2']) && !empty($a['2'])) ? $a['2'] : null;
    $country = (isset($a['3']) && !empty($a['3'])) ? $a['3'] : null;
    $stmt = $db->prepare("INSERT INTO customer (Username, Password, First_name, Last_name, Email, Phone, User_level) 
    VALUES (:username, :password, :firstname, :lastname, :email, :phone, :userlevel)");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':firstname', $firstname);
    $stmt->bindParam(':lastname', $lastname);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':userlevel', $userLevel);
    $stmt->execute();
    $id = $db->lastInsertId();
    $stmt2 = $db->prepare("INSERT INTO address (customer_CustomerId, Address_street, Address_zip, Address_city, Address_country) 
    VALUES (:id, :street, :zip, :city, :country)");
    $stmt2->bindParam(':id', $id);
    $stmt2->bindParam(':street', $street);
    $stmt2->bindParam(':zip', $zip);
    $stmt2->bindParam(':city', $city);
    $stmt2->bindParam(':country', $country);
    $stmt2->execute();
    echo "Käyttäjä lisätty";
}

?>