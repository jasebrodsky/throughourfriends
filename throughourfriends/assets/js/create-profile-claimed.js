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


$(document).ready(function() {



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



	// Send all profile data via AJAX to save-profile.php when submit is clicked. 
	$("#continue_btn").click(function(e) {

		e.preventDefault();
		validate('#unique');

		//if unique is not validated, show error message
		if (validate('#unique') == false) {
			$('#unique-error').fadeIn('slow');
		}

		// if it is, hide the error message
		else { 
			$('#unique-error').hide(); 

		
		


		//save all profile variables
		var Unique = $("#unique").val();
		
		 window.location.href = "create-tastes.php?unique="+Unique;
		           
		            
		 }
		        
    });
});  
	
	
