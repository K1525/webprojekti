// Get the modal

var modal = document.getElementById('myModal');

// Get the button that opens the modal

var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal

var span = document.getElementsByClassName("close")[0];

function getProduct(id){

     $.ajax({    //create an ajax request to load_page.php

        type: "GET",

        url: "popupsisalto.php?id="+id,             

        dataType: "html",   //expect html to be returned                

        success: function(response){                    

            $(".modal-content").html(response); 

           // alert(response);

        }

     });

}

// When the user clicks on the button, open the modal 

$(document).on( "click", ".myBtnn", function(event) {

    console.log(event);

    console.log("clicked on button id: "+event.target.id);

    getProduct(event.target.id);

    modal.style.display = "block";

    

});

// When the user clicks on <span> (x), close the modal

span.onclick = function() {

    modal.style.display = "none";

};

// When the user clicks anywhere outside of the modal, close it

window.onclick = function(event) {

    if (event.target == modal) {

        modal.style.display = "none";

    }

};