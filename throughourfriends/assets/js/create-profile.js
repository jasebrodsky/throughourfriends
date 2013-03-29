//scroll to div on page
function scrollToElement(ele) {
    $(window).scrollTop(ele.offset().top).scrollLeft(ele.offset().left);
}

function validate($id){

if (($($id).val() == "_empty") || ($($id).val() == "")) {

    ($($id).parent().prev().css('color','#B94A48'));

    return false

  }
  else {
    //validated
    ($($id).next().css('border',''));
    ($($id).parent().prev().css('color', '#333'));
    return true
  }
}

//dont allow enter to sumbit form becuase that interferes with google places API on enter handler. 
$('input').keydown(function(e){
	return e.keyCode !== 13;
});

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
		$('#age_req').show();
		return false;

	}
	else {
		//change label back to black
		($(date).parent().prev().css('color','#333'));
		//remove error message
		$('#age_req').hide();
		return true;
	}
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
		 	 $('.close').trigger('click');//close modal

		 	});


	});

	//put first 3 returned photos as the default for profile photos on page load
	//save src's of the first 3 photos returned
	// update the srcs of the first 3 profile photos with the saved srcs on page load

	var src1 = $(".fb_pic:eq(0)").attr('src_big');
	var src2 = $(".fb_pic:eq(1)").attr('src_big');
	var src3 = $(".fb_pic:eq(2)").attr('src_big');

	$("#first-pic").attr('src',src1);
	$("#second-pic").attr('src',src2);
	$("#third-pic").attr('src',src3);

	$("#first-pic-link").attr('href',src1);
	$("#second-pic-link").attr('href',src2);
	$("#third-pic-link").attr('href',src3);


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



	$('.close_btn').click(function(){

		$(this).parent().hide();

	});




	// Send all profile data via AJAX to save-profile.php when submit is clicked. 
	$("#continue_btn").click(function(e) {
		e.preventDefault();

		validate('#sexual_pref');
		validate('#relationship_status');
		validateDate('#birthday');
		validate('#unique');
		validate('#input_one');
		

		//if any of the required fields is fails validation, then show the appropriate error message
		if ((validate('#sexual_pref') == false) || (validate('#relationship_status') == false)
			|| (validate('#unique') == false) || (validateDate('#birthday') == false)
			|| (validate('#input_one') == false) ) {

				//if unique is not validated, show error message
				if (validate('#unique') == false) {
					$('#unique-error').fadeIn('slow');

				}

				// if it is, hide the error message
				else { 
					$('#unique-error').fadeOut('slow');



				}

				// if any of the basics is not validated, show error message
				if ((validate('#sexual_pref') == false) || (validate('#relationship_status') == false) 
					|| (validateDate('#birthday') == false) || (validate('#input_one') == false)) 

					{

					//show error message
					$('#basics-error').fadeIn('slow');
					//scroll to page to that div
					scrollToElement($('#photos'));
				}
				// if it is, hide the error message
				else {
					$('#basics-error').hide();
				}
			}
				
		
		else {





		// var validated = ($("#commentForm1").validate().form());
			
		// 	if (validated === (false)){	}
		// 	else {

    
		//save all profile variables
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

		data = ("gender=" + Gender +"&"+ "birthday=" + Birthday +"&"+ "sexual_pref=" + Sexual_pref +"&"+
		 "looking_for=" + Looking_for +"&"+ "city=" + City +"&"+
		 "ethnicity=" + Ethnicity +"&"+ "height=" + Height +"&"+
		 "relationship_status=" + Relationship_status +"&"+ "body_type=" + Body_type +"&"+
		 "drugs=" + Drugs +"&"+ "diet=" + Diet +"&"+
		 "kids=" + Kids +"&"+ "education=" + Education +"&"+
		 "hometown=" + Hometown +"&"+ "religion=" + Religion +"&"+
		 "income=" + Income +"&"+ "politics=" + Politics +"&"+
		 "sign=" + Sign +"&"+ "profession=" + Profession +"&"+
		 "languages=" + Languages +"&"+ "drinks=" + Drinks +"&"+
		 "smokes=" + Smokes +"&"+ 
		 "main_pic=" + Main_pic +"&"+ "first_pic=" + First_pic +"&"+
		 "second_pic=" + Second_pic +"&"+ "third_pic=" + Third_pic +"&"+ "lat_city=" + Lat_city
		 +"&"+ "long_city=" + Long_city +"&"+ "lat_hometown=" + Lat_hometown +"&"+ "long_hometown=" + Long_hometown

			);
		
		

	
			// ajax call to send via search variables 'data' via GET to load_profile_top.php. Take results and put on page. 
		    $.ajax({
		        type: "GET",
		        url: "save-profile.php",
		        data: data,
		        success: function(result) {
		            
		            window.location.href = "create-tastes.php?unique="+Unique;
		           
		            

		        }
		    });

		 }
	});  
	

});
	
