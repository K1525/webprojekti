/*
$(document).ready(function() {
    $.ajax({
        url: "tiedot.json",
        cache: false
    }).done(function(data) {
        console.log("Tuotteet tulostettiin onnistuneesti");
        showProducts(data);
        tuoteData = data;
        Piiloita();
        deleteItem(data);
        filter();
        filterr();
        ostoskoriVisu();
        //search(data);
    }).fail(function() {
        console.log("Tuotteita ei haettu!");
    }).always(function() {
        console.log("complete...");
    });
});
*/





//GLOBAALI DATA MUUTTUJA
var tuoteData;

//FILTTERIT MIEHET
function filter(){
    $("#mpusero").click(function(){
        $("#tuotetaulu").empty();
        $.each(tuoteData.tiedot, function(index, tieto){
            if(tieto.tyyppi == "mhuppari"){
                console.log("Puserot");
                //$("#tuotetaulu").append(col);
                //showProducts(tuoteData);
                
                
                /*col = $("<div>").addClass("col-md-3 pad-top");
                var laatta = $("<div>").addClass("tiedot");
                // create a new image
                var kuva = $("<img>").attr("src", tieto.kuva).addClass("img-responsive");
                // get price
                var hintalappu = $("<div>").addClass("hintalappu");
                var hinta = $("<p>").text(tieto.hinta).addClass("hinta");
                // get name, description
                var pohja = $("<div>");
                var kuvaus = $("<p>").text(tieto.kuvaus).addClass("kuvaus");
                var nimi = $("<p>").text(tieto.nimi).addClass("nimi");
                pohja.append(nimi, kuvaus);
                hintalappu.append(hinta);

                laatta.append(kuva, hintalappu, pohja);

                col.append(laatta);
                $(".tuotetaulu").append(col);*/
                
                bootStrap(index, tieto);
                
            }            
        });
    });
    $("#mpaita").click(function(){
        $("#tuotetaulu").empty();
        $.each(tuoteData.tiedot, function(index, tieto){
            if(tieto.tyyppi == "mpaita"){
                console.log("T-Paidat");//showProducts()
                bootStrap(index, tieto);
            }            
        });                
    });
    $("#mhousut").click(function(){
        $("#tuotetaulu").empty();
        $.each(tuoteData.tiedot, function(index, tieto){
            if(tieto.tyyppi == "mhousut"){
                console.log("Housut");//showProducts()
                bootStrap(index, tieto);
            }            
        });                
    });
    $("#masuste").click(function(){
        $("#tuotetaulu").empty();
        $.each(tuoteData.tiedot, function(index, tieto){
            if(tieto.tyyppi == "asuste"){
                console.log("Asusteet");//showProducts()
                bootStrap(index, tieto);
            }            
        });                
    });
    $("#kaikki").click(function(){
        $("#tuotetaulu").empty();
        showProducts(tuoteData);                
    });
}
// FILTTERI NAISET 
//FILTTERIT
function filterr(){
    $("#npusero").click(function(){
        $("#tuotetaulu").empty();
        $.each(tuoteData.tiedot, function(index, tieto){
            if(tieto.tyyppi == "nhuppari"){
                console.log("Puserot");
                //$("#tuotetaulu").append(col);
                //showProducts(tuoteData);
                
                
                /*col = $("<div>").addClass("col-md-3 pad-top");
                var laatta = $("<div>").addClass("tiedot");
                // create a new image
                var kuva = $("<img>").attr("src", tieto.kuva).addClass("img-responsive");
                // get price
                var hintalappu = $("<div>").addClass("hintalappu");
                var hinta = $("<p>").text(tieto.hinta).addClass("hinta");
                // get name, description
                var pohja = $("<div>");
                var kuvaus = $("<p>").text(tieto.kuvaus).addClass("kuvaus");
                var nimi = $("<p>").text(tieto.nimi).addClass("nimi");
                pohja.append(nimi, kuvaus);
                hintalappu.append(hinta);

                laatta.append(kuva, hintalappu, pohja);

                col.append(laatta);
                $(".tuotetaulu").append(col);*/
                
                bootStrap(index, tieto);
                
            }            
        });
    });
    $("#npaita").click(function(){
        $("#tuotetaulu").empty();
        $.each(tuoteData.tiedot, function(index, tieto){
            if(tieto.tyyppi == "npaita"){
                console.log("T-Paidat");//showProducts()
                bootStrap(index, tieto);
            }            
        });                
    });
    $("#nhousut").click(function(){
        $("#tuotetaulu").empty();
        $.each(tuoteData.tiedot, function(index, tieto){
            if(tieto.tyyppi == "nhousut"){
                console.log("Housut");//showProducts()
                bootStrap(index, tieto);
            }            
        });                
    });
    $("#nasuste").click(function(){
        $("#tuotetaulu").empty();
        $.each(tuoteData.tiedot, function(index, tieto){
            if(tieto.tyyppi == "asuste"){
                console.log("Asusteet");//showProducts()
                bootStrap(index, tieto);
            }            
        });                
    });
    $("#kaikkii").click(function(){
        $("#tuotetaulu").empty();
        showProducts(tuoteData);                
    });
}


//MUUTETAAN BOOTSRAPIKS AJAX (SISÃ„LTÃ„Ã„ MYÃ–S MUITA FUNKTIOTA!!!)
function bootStrap(index, tieto){
        var col = $("<div>").addClass("asd");
        var laatta = $("<div>").addClass("tiedot");
        // create a new image
        var kuva = $("<img>").attr("src", tieto.kuva).addClass("img-responsive");
        // get price
        var hintalappu = $("<div>").addClass("hintalappu");
        var hinta = $("<p>").text(tieto.hinta).addClass("hinta");
        // get name, description
        var pohja = $("<div>").addClass("gradient");
        var kuvaus = $("<p>").text(tieto.kuvaus).addClass("kuvaus");
        var nimi = $("<p>").text(tieto.nimi).addClass("nimi");
        pohja.append(nimi);
        hintalappu.append(hinta);
        
        laatta.append(kuva, hintalappu, pohja);
        
        col.append(laatta);

        // lue lisÃ¤Ã¤ button || POPUPBOX AVAUS
        var moreinfoButton = $("<input type='button' value='Lue lisÃ¤Ã¤' id='myBtnn'>"); 
        laatta.append(moreinfoButton);

        
        $(".tuotetaulu").append(col);
        
        //YLÃ„OSAAN VIENTI
        col.click(function (){
            $("#ylaosa").removeClass("ylaosaHidden").addClass("ylaosa");
            $("#min").removeClass("glyphicon-chevron-up").addClass("glyphicon-chevron-down");
            $(".tuotekuva").empty();
            $(".tuotetiedot").empty();
            kuva.clone().appendTo(".tuotekuva").addClass("tuoteKuva");
            nimi.clone().appendTo(".tuotetiedot").removeClass("nimi").addClass("tuotenimi");
            kuvaus.clone().appendTo(".tuotetiedot").removeClass("kuvaus").addClass("tuotekuvaus");
            hinta.clone().appendTo(".tuotetiedot").removeClass("hinta").addClass("tuotehinta");
            
            //Cart button
            var cartButton = $("<input type='button' value='LisÃ¤Ã¤ ostoskoriin' id='add-to-cart'>");            
            $(".tuotetiedot").append(cartButton);
            
        
            $("#add-to-cart").click(function(event) {
                event.preventDefault();
                var name = tieto.nimi; //$(this).attr("data-name");
                var price = tieto.hinta; //Number($(this).attr("data-price")); 
                shoppingCart.addItemToCart(name, price, 1);
                displayCart();
            });
            //OSTOSKORI FUNKTIOT
            deleteItem();
            subtractItem();
            addItem();
            clearCart();
            })}



//HAETAAN TUOTTEET AJAXILLA
function showProducts(tuoteData){
    $.each(tuoteData.tiedot, bootStrap);
    //ostoskoriVisu();
}
                  
//OSTOSKORI   
function clearCart(){
    $("#clear-cart").click(function(event){
        shoppingCart.clearCart();
        displayCart();
    });
}

function displayCart() {
     var cartArray = shoppingCart.listCart();
     var output = "";

     for (var i in cartArray) {
         output += "<li>"+cartArray[i].name
                  +" <input class='item-count' type='number' data-name='"
                  +cartArray[i].name
                  +"' value='"+cartArray[i].count+"' >"
                  +" x "+cartArray[i].price
                  +" <button class='subtract-item' data-name='"+cartArray[i].name+"'>-</button>"
                  +" <button class='plus-item' data-name='"+cartArray[i].name+"'>+</button>"
                  +" <button class='delete-item' data-name='"+cartArray[i].name+"'>Poista</button>"
                  +"</li>";
          }
          $("#show-cart").html(output);
          //$("#count-cart").html ( shoppingCart.countCart() );
          $("#total-cart").html( shoppingCart.totalCart() );
}

function deleteItem(){
    $("#show-cart").on("click", ".delete-item", function(event) {
        //console.log($(this).attr('data-name'));
        var name = $(this).attr('data-name');//Miten saa haettua kyseisen objektin nimen?!
        shoppingCart.removeItemFromCartAll(name);
        displayCart();
    });
}

function subtractItem(){
    $("#show-cart").on("click", ".subtract-item", function(event) {
        var name = $(this).attr('data-name');
        shoppingCart.removeItemFromCart(name);
        displayCart();
    });
}

function addItem(){
    $("#show-cart").on("click", ".plus-item", function(event) {
       var name = $(this).attr('data-name');
        shoppingCart.addItemToCart(name, 0, 1);
        displayCart();
    });
}

function itemCount(){
    $("#show-cart").on("change", ".item-count", function(event) {
        var name = $(this).attr('data-name');
        var count = Number( $(tieto).val() );
        shoppingCart.setCountForItem(name, count);
        displayCart();
    });
}



    // SHOPPING CART functions
    var shoppingCart = {};
    shoppingCart.cart = [];
    shoppingCart.Item = function(name, price, count ) {
        this.name = name;
        this.price = price;
        this.count = count;
    };

    shoppingCart.addItemToCart = function(name, price, count) { 
        for (var i in this.cart) {
            if (this.cart[i].name === name) {
            this.cart[i].count += count;
            this.saveCart();
            return;
            }
        }
        var item = new this.Item(name, price, count);
        this.cart.push(item);
        this.saveCart();
    };

    shoppingCart.setCountForItem = function(name, count) {
        for (var i in this.cart) {
            if (this.cart[i].name === name) {
                this.cart[i].count = count;
                if (this.cart[i].count === 0) {
                    this.cart.splice(i,1);
                }
                break;
            }
        } 
        this.saveCart();
    };


    shoppingCart.removeItemFromCart = function(name) {
        for (var i in this.cart) {
            if (this.cart[i].name === name) {
                this.cart[i].count --;
                if (this.cart[i].count === 0) {
                this.cart.splice(i, 1);
                }
            break;
            }
        }
        this.saveCart();
    }


    shoppingCart.removeItemFromCartAll = function(name) {
        for (var i in this.cart) {
            if (this.cart[i].name === name) {
                this.cart.splice(i, 1);
                break;
            }
        }
        this.saveCart();
    }

    shoppingCart.clearCart = function() {
        this.cart = [];
        this.saveCart();
    }

    shoppingCart.countCart = function() {
        var totalCount = 0;
        for (var i in this.cart) {
            totalCount += this.cart[i].count;
        }
        return totalCount;
    }

    var totalCost = 0;
    console.log(totalCost);
    
    shoppingCart.totalCart = function() {
        totalCost = 0;
        for (var i in this.cart) {
            totalCost += /*this.cart[i].price * this.cart[i].count;*/
                $(this).attr('data-name') * $(".item-count").val();
        }
        return totalCost.toFixed(2);
    }


    shoppingCart.listCart = function() {
        var cartCopy = [];
        for (var i in this.cart) {
            var item = this.cart[i];
            var itemCopy = {};
            for (var p in item) {
                itemCopy[p] = item[p];
            }
            itemCopy.total = (item.price * item.count).toFixed(2);
            cartCopy.push(itemCopy);
        }
        return cartCopy;
    }

    shoppingCart.saveCart = function() {
        localStorage.setItem("shoppingCart", JSON.stringify(this.cart));
    }

    shoppingCart.loadCart = function() {
        this.cart = JSON.parse(localStorage.getItem("shoppingCart"));
    } 
      

//Luodaan piiloita nappi 
function Piiloita(){
    $("#piilota").empty();
    $("#piilota").append("<span type='button' value='Piiloita' id='min' class='glyphicon glyphicon-chevron-up'></span>")
    //Piiloita napin toiminta        
    $("#min").click(function(){
    $("#min").toggleClass("glyphicon-chevron-up glyphicon-chevron-down");
    $("#ylaosa").toggleClass("ylaosa ylaosaHidden");
    console.log("Luokka vaihdettu");
    });
}

/*Ostoskori (visuaalinen!)*/
function ostoskoriVisu(){        
    var cart = $("<div>").addClass("cartHidden toggle");

    var tyhjenna = $("<input type='button' value='TyhjennÃ¤' id='clear-cart'>");

    var lista = $("<ul id='show-cart'>");    

    var totalHinta = $("<div>").text("Hinta: ");

    var spanHinta = shoppingCart.totalCart;

    totalHinta.append(spanHinta);

    //Ostoskorin nappulat jne.
    cart.append(tyhjenna, lista, totalHinta);

    //Luodaan ostoskori
    $("#cartLayer").append(cart);

    //Avaa ja sulje ostoskori
    $("#cart").click(function(){        
        $(".toggle").toggleClass("cartHidden cart")   
    });                  
}

/*
function search(data){
        $('#search').keyup(function(){
            var searchField = $('#search').val();
            var regex = new RegExp(searchField, "i");
            var output = "";
            var count = 1;
            $.getJSON('tiedot.json', function(data) {
              $.each(data.tiedot, function(key, tieto){
                if (tieto.nimi.search(regex) != -1) {
                  output += "<div class='row'><h5 id='hakutulos'>" + tieto.nimi + tieto.hinta + "</h5></div>";                  
                  count++;
                }
              $('#results').html(output);
            }); 
        });
            //$("#hakutulos").click();
            console.log("haetaan..." + output);
      });
}*/

$(document).ready(function(){
    $(".clickable").click(function(event){
        var catid = $(this).attr("name");
        var param = $(this).parent().attr("name");
        $.ajax({    //create an ajax request to load_page.php
            type: "GET",
            url: "filter.php?id="+catid+"&param="+param,             
            dataType: "html",   //expect html to be returned                
            success: function(response){                    
                $("#tuotetaulu").html(response); 
               // alert(response);
            }
         });
    });
});