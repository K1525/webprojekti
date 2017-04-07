import AddProductPage from './AddProductPage.jsx';
import ListProductsPage from './ListProductsPage.jsx';
import AddUserPage from './AddUserPage.jsx';
import ListOrdersPage from './ListOrdersPage.jsx';
import DialogBox from './Dialog.jsx';
import React from 'react';
import ReactDOM from 'react-dom';
import $ from 'jquery';

var mostChars = /^[a-zA-Z0-9-.,äöåü ]*$/;
var basicChars = /^[a-zA-Zäöåü ]*$/;
var product = [];
var image;
var user = [];
var address = [];

function showMessage(msg){
	$("#message-text").stop().text(msg).fadeIn();
	$("#snackbar").stop().animate({height: "120px"});
	setTimeout(function(){
		$("#snackbar").stop().animate({height: "0px"});
		$("#message-text").stop().fadeOut();
	},3000);
}

function productRegExCheck(){
	var productName = $("#p1_1 > :first-child > :nth-child(2)").val();
	var price = $("#p1_2 > :first-child > :nth-child(2)").val();
	var description = $("#p2_1 > :first-child > :nth-child(2)").val();
	var descriptionMore = $("#p3_1 > :first-child > :nth-child(2)").val();
	//var stock = $("#stock").val();
	var gender = $("#Sukupuoli").val();
	gender = "m";
	switch(gender) {case null: gender=null; case 1: gender=null; 
		break; case 2: gender="m"; break; case 3: gender="n"; break;}
	if ($("#category").val()==null) var category = 7;
	else var category = $("#category").val();

	var img = $("#fd-img").data();
    /*
	if (productName == "" || productName.length > 255 || mostChars.test(productName) == false){
		printError("Tuotteen nimessä saa olla ainoastaan aakkosia ja numeroita. (pituus max. 255 merkkiä)");
		return false;
	}
	if (price == "" || !$.isNumeric(price)){
		printError("Merkitse hinta.");
		return false;
	}
	//if (stock.length > 5 || Math.floor(stock) != stock && $.isNumeric(stock) == false){
	//	printError("Varastomäärän täytyy olla kokonaisluku.");
	//	return false;
	//}
	if (description.length > 512 || mostChars.test(description) == false){ // Varmista max length
		printError("Tuotetiedoissa saa olla ainoastaan aakkosia ja numeroita. (pituus max. 512 merkkiä)");
		return false;
	}
	*/
	product = [];
	product.push(productName,price,5/*stock*/,description,descriptionMore,gender,category);
	image = img;
	return false;
    return true;
}

function userRegExCheck(){
	var username = $("#u1_1 > :first-child > :nth-child(2)").val();
	var password = $("#u1_2 > :first-child > :nth-child(2)").val();
	var firstname = $("#u1_3 > :first-child > :nth-child(2)").val();
    var lastname = $("#u1_4 > :first-child > :nth-child(2)").val();
    var email = $("#u1_5 > :first-child > :nth-child(2)").val();
	var phone = $("#u1_6 > :first-child > :nth-child(2)").val();
	if ($("#Käyttäjätaso").val()==null) var userLevel = 1;
    else var userLevel = $("#Käyttäjätaso").val();
	var street = $("#u2_1 > :first-child > :nth-child(2)").val();
	var zip = $("#u2_2 > :first-child > :nth-child(2)").val();
	var city = $("#u2_3 > :first-child > :nth-child(2)").val();
    var country = $("#u2_4 > :first-child > :nth-child(2)").val();

/*
	if (username == "" || username.length > 16 || username.length < 4 || mostChars.test(username) == false){
		printError('Käyttäjänimessä ei saa olla kiellettyjä merkkejä. (pituus 5-16 merkkiä)');
		return false;
	}
	if (password == "" || password.length > 64 || password.length < 5 || basicChars.test(password) == false){
		printError("Salasanassa saa olla ainoastaan kirjaimia ja numeroita. (pituus 5-64 merkkiä)");
		return false;
	}
	if (firstname == "" || firstname.length > 220 || basicChars.test(firstname) == false){
		printError("Etunimessä saa olla ainoastaan kirjaimia.");
		return false;
	}
	if (lastname == "" || firstname.length > 220 || basicChars.test(firstname) == false){
		printError("Sukunimessä saa olla ainoastaan kirjaimia.");
		return false;
	}
	if (email == "" || email.length > 220){
		printError("Käyttäjänimessä saa olla ainoastaan aakkosia ja numeroita. (pituus 5-16 merkkiä)");
		return false;
	}
	if (Math.floor(zip) != stock && $.isNumeric(zip) == false){
		printError("Postinumerossa saa olla ainoastaan numeroita.");
		return false;
	}
	if (mostChars.test(street) || mostChars.test(street) || mostChars.test(country) || mostChars.test(city)){
		printError("Tarkista osoitetiedot.");
		return false;
	}*/
	user = [];
	user.push(username,"sala"/*password*/,firstname,lastname,email,phone,userLevel);
	address = [];
	address.push(street,zip,city,country);
    return true;
}

function submitForm(form){
    form.submit();
}

function handleFile(){
	console.log("file dropped");
}

function removeProducts(){
	var ids = $("#ids").data();
	if (!ids) {
		showMessage("Valitse ensin tuotteita");
		return;
	}
	console.log(ids);
	/*ReactDOM.render(<DialogBox modal={false} open={true} 
	msg={"Haluatko poistaa tuotteet?"}/>,$("#dialog")[0]);*/
	$.ajax({
		method: "POST",
		url: "./php/remove_products.php",
		data: {'ids':ids}
	}).done(function(data) {
		console.log(data);
		if(data == "Tuotteet poistettu")
			showMessage(data);
		else showMessage("Poistaminen epäonnistui");
	});
  }

function addProductToDb() {
	console.log(product);
	$.ajax({
		method: "POST",
 		url: "./php/add_product.php",
		data: {'product':product, 'img':image}
	}).done(function(data) {
		if(data == "Tuote lisätty"){
			$("#container").html("");
			ReactDOM.render(<AddProductPage/>,$("#container")[0]);
			showMessage(data);
		}
		else showMessage("Lisääminen epäonnistui");
	});
}
function addUserToDb() {
	$.ajax({
		method: "POST",
 		url: "./php/add_user.php",
		data: {
			'user':user,
			'address':address
		}
	}).done(function(data) {
		console.log(data);
  		if(data == "Käyttäjä lisätty"){
		  	$("#container").html("");
			ReactDOM.render(<AddUserPage/>,$("#container")[0]);
			showMessage(data);
		}
		else showMessage("Lisääminen epäonnistui");
	});
}

$(document).ready(function(){

	$(document).on("click", "#remove-products-btn > :first > :first", function(){
		removeProducts();
	});

	$(document).on("click", "#add-product-btn > :first > :first", function(){
		if (productRegExCheck()){
            addProductToDb();
		}
    });
	$(document).on("click", "#add-user-btn > :first > :first", function(){
		if (userRegExCheck()){
        	addUserToDb();
		}
    });
});