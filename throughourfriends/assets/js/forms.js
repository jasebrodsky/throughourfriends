// toggle #expanded section when #basics button is clicked on. Also toggle button text. 

$(document).ready(function(){


//$('#input_one').simulate('mousedown');
//$('#input_one').trigger('click');
//selectFirstResult();
//alert(latcity);

//alert(selectFirstResult2());


$('#basics-button').click( function() {
  $("#expanded").toggle( function(){
	if ($("#expanded").is(':visible')) {
	 $('#basics-button').text('-Less criteria') 
	} else {
		$('#basics-button').text('+More criteria') 
	  }
    });
  });
    
	$( "#birthday" ).datepicker({
     changeMonth: true,
     changeYear: true,
	 yearRange: "-100:+0",
   dateFormat: 'yy-mm-dd'
});


$(".chzn-select").chosen();


var input = document.getElementById('input_one');         
var autocomplete = new google.maps.places.Autocomplete(input, {
    types: ["geocode"]
});          
 
google.maps.event.addListener(autocomplete, 'place_changed', function() {
    var place = autocomplete.getPlace();
});  

$("#input_one").focusin(function () {
    $(document).keypress(function (e) {
        if (e.which == 13) {
             selectFirstResult();   
        }
    });
});
$("#input_one").blur(function() {
  
        selectFirstResult();
        //alert(latcity);
});
 
 function selectFirstResult() {
    $(".pac-container").hide();
    var firstResult = $(".pac-container .pac-item:first").text();
    
    var geocoder = new google.maps.Geocoder();
    geocoder.geocode({"address":firstResult }, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            var latcity = results[0].geometry.location.lat();
                lngcity = results[0].geometry.location.lng();
                //placeName = results[0].address_components[0].long_name,
                //latlng = new google.maps.LatLng(lat, lng);
                $("#input_one").val(firstResult);
                $('#input_one').attr('lat', latcity);
                $('#input_one').attr('long', lngcity);
                return (latcity);
                return (lngcity);
        }
    });   
 }

$('#input_one').trigger('click');

var input2 = document.getElementById('input_two');         
var autocomplete = new google.maps.places.Autocomplete(input2, {
    types: ["geocode"]
});          
 
google.maps.event.addListener(autocomplete, 'place_changed', function() {
    var place = autocomplete.getPlace();
});  

$("#input_two").focusin(function () {
    $(document).keypress(function (e) {
        if (e.which == 13) {
             selectFirstResult2();   
        }
    });
});
$("#input_two").blur(function() {
  
        selectFirstResult2();
});
 
 function selectFirstResult2() {
    $(".pac-container").hide();
    var firstResult = $(".pac-container:eq(1) .pac-item:first").text();
    
    var geocoder = new google.maps.Geocoder();
    geocoder.geocode({"address":firstResult }, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            var lathome = results[0].geometry.location.lat();
                lnghome = results[0].geometry.location.lng();
                //placeName = results[0].address_components[0].long_name,
                //latlng = new google.maps.LatLng(lat, lng);
                $("#input_two").val(firstResult);
                $('#input_two').attr('lat', lathome);
                $('#input_two').attr('long', lnghome);
                return (lathome);
                return (lnghome);
        }
    });   
 }



// //google maps API to auto-complete lives_in and hometown fields. 	
// // add autocomplete functionality to our search fields
// var input_one = document.getElementById('input_one');
// var input_two = document.getElementById('input_two');
// var options = {
//   types: ['(cities)']};
// var autocomplete_one = new google.maps.places.Autocomplete(input_one, options);
// var autocomplete_two = new google.maps.places.Autocomplete(input_two, options);

// // listeners to capture updated location
// google.maps.event.addListener(autocomplete_one, 'place_changed', function() {
//   var objLocation1 = autocomplete_one.getPlace();
//   autoComplete_Update(objLocation1);
//   window.myGlobalVar = objLocation1;
 
// });
// google.maps.event.addListener(autocomplete_two , 'place_changed', function() {
//   var objLocation2 = autocomplete_two.getPlace();
//   autoComplete_Update(objLocation2);
// });

// function autoComplete_Update( objLocation ) {
//   // handle results from either autocomplete here.
//   // you could obviously have two handler functions, 
//   // or pass in extra parameters if you wanted to differentiate between the two
// }

	
});

