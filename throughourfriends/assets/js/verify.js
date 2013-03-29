function validate($id){

if (($($id).val() == "_empty") || ($($id).val() == "")) {
	//not valid
    return false

  }
  else {
    //validated
    return true
  }
}


//determins if email is valid or not
function isValidEmailAddress(emailAddress) {
    var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
    return pattern.test(emailAddress);
    if (!pattern) {
    //show invalid email address alert
    
    return false;
  } else

 	return true;
};

// determin age from birthday
function validateDate(date){
	dob = new Date($(date).val());
	var today = new Date();
	var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));

	//check if age is greater than 18 or age did not compute
	if ((age < 18) || (isNaN(age))){
		//if so create change label to red
		($(date).parent().prev().css('color','#B94A48'));
		//create error message
		$('.age-error').show();
		return false;

	}
	else {
		//change label back to black
		($(date).parent().prev().css('color','#333'));
		//remove error message
		$('.age-error').hide();
		return true;
	}
}

function updateProfile(tb_field,field){
    //put current value into variable
	var data1=$(tb_field).text();
	
	//Make an array
	var dataarray=data1.split(",");

	// Set the value in the modal
	$(field).val(dataarray);

	//when modal value changes save variable
	$(field).change(function() {
		var new_value = $(field).val();

		//update profile with that variable
		$(tb_field).text(new_value);
	});
}


function getAge(dateString) {
    var today = new Date();
    var birthDate = new Date(dateString);
    var age = today.getFullYear() - birthDate.getFullYear();
    var m = today.getMonth() - birthDate.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }
    return age;
}

function updateProfileAge(tb_field,field){ 

	//when modal value changes save variable
	$(field).change(function() {
		var new_value = getAge($(field).val());

		//update profile with that variable
		$(tb_field).text(new_value);
	});
}

function updateProfileLoc(tb_field,field){ 

	//when modal value changes save variable
	$(field).change(function() {
		var new_value = $(field).val();

		//update profile with that variable
		$(tb_field).text(new_value);
	});
}






$(document).ready(function() {


var img_old;

	//when change photo button is clicked on run function to save the img url selected, then update the profile image above the button. 
		 
	$(".pic_btn").click(function(){
		//save img to update into var depending on button clicked
		img_old = ($(this).parent().siblings().children());
		 $(".fb_pic").click(function(){
		 	 var img_new = $(this).attr("src_big");// new src that was clicked on
		 	 $(img_old.attr("src", img_new));//update old images src to the new image clicked on
		 	 $(img_old.parents().attr("href", img_new));
		 	 $('#myModal').modal('hide')//close modal

		 	});

	});


	
	//colorbox plugin. Treat all a tags with class gallery as image for the colorbox photo viewer. 
	$('a.gallery').colorbox({ opacity:0.5 , rel:'group1' });

	//if main pic is .jpg run photo:false, else run photo:true
	var main_pic_link = $('#main-pic-link').attr('href'); //save link to var
	var last4 = main_pic_link.substr(main_pic_link.length - 4); // find last 4 char of link
	if (last4 == '.jpg'){ //if last4 characters is equal to '.jpg'
		$('#main-pic-link').colorbox({ opacity:0.5 , rel:'group1' }); //treat as photo:false (.jpg image)
	} else {
		$('#main-pic-link').colorbox({ photo:true, opacity:0.5 , rel:'group1' });//else trea as link (fb default profile photo format)
	}


	//keep profile and modal in sync whenver user changes their profile. 
	updateProfile('#tb-ethnicity','#ethnicity');
	updateProfile('#tb-drinks','#drinks');
	updateProfile('#tb-height','#height');
	updateProfile('#tb-smokes','#smokes');
	updateProfile('#tb-body_type','#body_type');
	updateProfile('#tb-drugs','#drugs');
	updateProfile('#tb-diet','#diet');
	updateProfile('#tb-kids','#kids');
	updateProfile('#tb-education','#education');
	updateProfile('#tb-religion','#religion');
	updateProfile('#tb-income','#income');
	updateProfile('#tb-languages','#languages');
	updateProfile('#tb-sign','#sign');
	updateProfile('#tb-politics','#politics');
	updateProfile('#tb-profession','#profession');
	updateProfileAge('#tb-age','#birthday');
	updateProfile('#tb-gender','#gender');
	updateProfile('#tb-sexual_pref','#sexual_pref');

	updateProfile('#tb-looking_for','#looking_for');
	updateProfile('#tb-relationship_status','#relationship_status');
	

	//google maps API to auto-complete lives_in and hometown fields. 	
	// add autocomplete functionality to our search fields
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
	                $('#tb-city').text(firstResult);
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
	                $('#tb-hometown').text(firstResult);
	                $('#input_two').attr('lat', lathome);
	                $('#input_two').attr('long', lnghome);
	                return (lathome);
	                return (lnghome);
	        }
	    });   
	 }

		$( "#birthday" ).datepicker({
	     changeMonth: true,
	     changeYear: true,
		 yearRange: "-100:+0",
	   dateFormat: 'yy-mm-dd'
	});


	$(".chzn-select").chosen();


	//  need to check if age is correct before closing modal window
	$('#save-basics-btn, #cancel-basics-btn').click(function() { 	
		
		//validate age is greater than 18
		validateDate('#birthday');

		//validate again if birthday is changed
		$('#birthday').change(function() {
		  validateDate('#birthday');
		});

		//check if birthday is validated in order to close modal with save or cancel buttons
		 if ( validateDate('#birthday') == true){
		
			//close modal
			$('#modal_profile').modal('hide');

		}
	});

	var userid = $('#logged-in-user').attr('userid');

	$('#save-unique').click(function() {
		//save variable of modal value
		//alert(userid);
		var unique_val = $('#unique').val();
		
		//save variable of page value
		var div = $('#'+userid+'').val();

		//update modal value with current page value
		$('#unique_val').html(div);


		//check if modal value  was validated to true
		if (validate('#unique') == false){
			$('#unique-error').fadeIn('slow');
		}
		// if it is, hide the error message
		else { 
			//hide error message
			$('#unique-error').hide(); 
			//close modal
			$('#uniqueModal').modal('hide');
			//update page value with modal value
			$('#'+userid+'').html(unique_val);
		}
	
	}); 

	


	//record if profile has been updated on the verify page with a variable. 
	var Changed = 'false';
	//if any button with class .change-btn is clicked, update variable changed to true. 
	$('.change-btn').click(function() {
		//update variable changed to true. 
		$("#verify-btn").attr('changed','true');
	
	}); 

	 
	// ajax function that will update the profile to verified and create a notification that a new profile has been created.
	$('#start_matching').click(function(e) { 	

		//save variable email to send in AJAX call to update profile. 
		var friends_email = $('#friends_email').val();
		e.preventDefault();
		validated = (isValidEmailAddress(friends_email));


		if (validated == false){
			$('#email-error').show();			
		}
		else{
			//hide email if present
			$('#email-error').hide();

			//save all variables on page
			var Gender = $("#gender").val();
			var Birthday = $("#birthday").val();
			var Sexual_pref = $("#sexual_pref").val();
			var Looking_for = $("#looking_for").val();
			var City = $("#input_one").val();
			var Lat_city =  $("#input_one").attr('lat');
			var Long_city =  $("#input_one").attr('long');
			var Ethnicity = $("#ethnicity").val();
			var Height =  $("#height").val();
			var Relationship_status = $("#relationship_status").val();
			var Body_type = $("#body_type").val();
			var Drugs = $("#drugs").val();
			var Diet = $("#diet").val();
			var Kids = $("#kids").val();
			var Education = $("#education").val();
			var Hometown = $("#input_two").val();
			var Lat_hometown =  $("#input_two").attr('lat');
			var Long_hometown =  $("#input_two").attr('long');
			var Religion = $("#religion").val();
			var Income = $("#income").val();
			var Politics =  $("#politics").val();
			var Sign = $("#sign").val();
			var Profession = $("#profession").val();
			var Languages = $("#languages").val();
			var Drinks = $("#drinks").val();
			var Smokes = $("#smokes").val();
			var Unique = $("#unique").val();
			var Main_pic =  $("#main-pic").attr('src');
			var First_pic = $("#first-pic").attr('src');
			var Second_pic = $("#second-pic").attr('src');
			var Third_pic = $("#third-pic").attr('src');
			var Taste_id = $('#'+userid+'').attr('taste_id');
			var Changed = $("#verify-btn").attr('changed');
		
			//consilidate variables into one variable called data
			data = ("changed=" + Changed +"&"+ "friends_email=" + friends_email +"&"+ "gender=" + Gender +"&"+ "birthday=" + Birthday +"&"+ "sexual_pref=" + Sexual_pref +"&"+
			 "looking_for=" + Looking_for +"&"+ "city=" + City +"&"+
			 "ethnicity=" + Ethnicity +"&"+ "height=" + Height +"&"+
			 "relationship_status=" + Relationship_status +"&"+ "body_type=" + Body_type +"&"+
			 "drugs=" + Drugs +"&"+ "diet=" + Diet +"&"+
			 "kids=" + Kids +"&"+ "education=" + Education +"&"+
			 "hometown=" + Hometown +"&"+ "religion=" + Religion +"&"+
			 "income=" + Income +"&"+ "politics=" + Politics +"&"+
			 "sign=" + Sign +"&"+ "profession=" + Profession +"&"+
			 "languages=" + Languages +"&"+ "drinks=" + Drinks +"&"+
			 "smokes=" + Smokes +"&"+ "unique=" + Unique +"&"+ "taste_id=" + Taste_id +"&"+
			 "main_pic=" + Main_pic +"&"+ "first_pic=" + First_pic +"&"+
			 "second_pic=" + Second_pic +"&"+ "third_pic=" + Third_pic 
			 +"&"+ "lat_city=" + Lat_city +"&"+ "long_city=" + Long_city +"&"+ "lat_hometown=" + Lat_hometown +"&"+ "long_hometown=" + Long_hometown

				);
		

			$.ajax({
		        type: "GET",
		        url: "verify_profile.php",
		        data: data,
		        success: function(result) {
		        	
		       		//alert(result);
		        	//$("#success-message").hide().html(result).fadeIn(2000);
		        	window.location.href = "my-friends.php";

		        }
		    });
           }  
		})
});
	
