// Globaali muuttuja. Esim tässä hyväksytään vain aakkoset ja numerot
var validChars = /^[a-zA-Z0-9-]*$/;
var skandinavian =/^äöåÄÖÅ*$/;
var charactersForEmail = /^!#$%&'*+\/-=\`?^_{|}~$/;
var charactersForSreet = /^.*$/
// Tässä voidaan printata mikä tahansa error toisesta metodista
function printError(error){
	console.log(error); // Lopullisessa projektissa tehdään tästä visuaalinen, console.log on OK testailuun
}

function regExpCheck() {
	// Otetaan kaikki kentät muuttujiin. Tässä esim input kentällä on id="username" ja val() hakee arvon kentästä
	var username = $("#username").val();
	var password = $("#passwd").val();
	var firstname = $("#first_name").val();
    var lastname = $("#last_name").val();
    var email = $("#email").val();
    var street = $("#street").val();
    var city = $("#city").val();
    var country = $("#country").val();
    

    
   if (username == "" || username.length > 16 || username.length < 4 || validChars.test(username) == false){
        printError("Käyttäjänimessä saa olla ainoastaan aakkosia ja numeroita. (pituus 4-16 merkkiä)");
        return false;
    }
    if (password == "" || password.length > 64 || password.length < 5 || validChars.test(password) == false){
        printError("Salasanassa saa olla ainoastaan aakkosia ja numeroita. (pituus 5-64 merkkiä)");
        return false;
    }
    if (firstname == "" || firstname.length > 64 || validChars.test(firstname) == false){
        printError("Etunimessä saa olla ainoastaan aakkosia ja numeroita. (max. pituus 64 merkkiä)");
        return false;
    }
    if (lastname == "" || lastname.length > 64 || validChars.test(lastname) == false){
        printError("Sukunimessä saa olla ainoastaan aakkosia ja numeroita. (max. pituus 64 merkkiä)");
        return false;
    }
    if (email == "" || email.length > 128) || validChars.test(email) || charactersForEmail.test(email){
        printError("Käyttäjänimessä saa olla ainoastaan aakkosia ja numeroita. (pituus 5-16 merkkiä)");
        return false;
    }
    
    if (street == "" || email.length > 128 ||charactersForSreet.test(street) || validChars.test(street) == false ){
        printError("Tarkista katuosoitetiedot.");
        return false;
    } 
    
    if (city == "" || city.length > 64 || validChars.test(city) == false ){
        printError("Tarkista kirjoititko kaupungin oikein.");
        return false;
    } 
    
    if (country == "" || country.length > 64 || validChars.test(country) == false ){
        printError("Tarkista kirjoititko maan oikein.");
        return false;
    }
    
    if (Math.abs(zip) != zip && $.isNumeric(zip) != zip == false){
        printError("Postinumerossa saa olla ainoastaan numeroita.");
        return false;
    }
   
    else return true; // Return true jos kaikki on OK
}

function submitform(form) {
    form.submit();
}

// Kun sivu on ladattu
$(document).ready(function(){
	$("#submitbutton").click(function(){ // Kun painetaan "Submit-nappia" formin lopussa
		if (regExpCheck()){ // Jos metodi palauttaa "true" eli kaikki on OK
		  submitform($("#registrationform"));
            
		}
	});
});