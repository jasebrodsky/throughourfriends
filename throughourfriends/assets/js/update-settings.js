
function isValidEmailAddress(emailAddress) {
    var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
    return pattern.test(emailAddress);
    if (!pattern) {
    //show invalid email address alert
    
    return false;
  } else

 	return true;
};

$(document).ready(function() {




	// Send all profile data via AJAX to save-profile.php when submit is clicked. 
	$("#save-button").click(function(e) {
		e.preventDefault();
		var Email = $("#Email").val();
		validated = (isValidEmailAddress(Email));


		if (validated == false){
			$('#email-error').show();			
		}
		else{
			$('#email-error').hide();

		//save all profile variables
		var Matchable = $("#Matchable").is(':checked');
		var New_friend_email = $("#Friend_email").is(':checked');
		var New_pending_email = $("#Pending_email").is(':checked');
		var New_active_email = $("#Active_email").is(':checked');
		var New_message_email = $("#Message_email").is(':checked');
		var Deleted = $("#Deleted").is(':checked');
		var Email = $("#Email").val();

		data = ("matchable=" + Matchable +"&"+ "new_friend_email=" + New_friend_email +"&"+ "new_pending_email=" + New_pending_email +"&"+
		 "new_active_email=" + New_active_email +"&"+ "new_message_email=" + New_message_email +"&"+
		 "email=" + Email +"&"+ "deleted=" + Deleted +"&"+ "email=" + Email

			);

		//alert(data);
		
		

	
			// ajax call to update users' profile when they click submit. 
		    $.ajax({
		        type: "GET",
		        url: "update-settings.php",
		        data: data,
		        success: function(result) {
		       
		        	$("#success-message").hide().html(result).fadeIn(2000);

		        }
		    });
		}
		});  
	

});
	
