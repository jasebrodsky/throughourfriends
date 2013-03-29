
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

	  
	//create an var array with all the active match ids on page, and change them to seen in db. 
	var seenMatches = [];

	$('.active_match').each(function(){ 
		seenMatches.push($(this).attr('match_id')); 
			}
		);
	

	//update all taste records on page to seen via AJAX call
		    $.ajax({
		        type: "GET",
		        url: "seen.php",
		        data: {new_active_match: seenMatches},

		        success: function(result) {
		        }
		    });


	//when send_message is clicked need to update modal with correct values
	// when send button is clicked save variables then save message to db and close modal
 		$(".send_message").click(function() {


 			var name = $(this).attr('name');
 			var match_user_id = $(this).attr('match_user_id');
 			var matchee_user_id = $(this).attr('matchee_user_id');
  			var message = $("#message_textarea").val();

  			//alert(name);
  			$('#message_to_modal').text(name);

  			//update the reply button with the correct attribute from the message. 
  			$('#send_message_btn').attr('match_user_id', match_user_id)
  			$('#send_message_btn').attr('matchee_user_id', matchee_user_id)

  			});

 			//when send_message_btn is clicked need to first verify message is entered, then AJAX message to be sent. 
 			$("#send_message_btn").click(function(e) {
 			//prevent any link from happening
			e.preventDefault();
			
			//validate a message has been entered
 			validate('#message_textarea');

 			//if message_textarea is not validated or no match is selected, show error message
				if (validate('#message_textarea') == false) {
					$('#compose-error').fadeIn('slow');

				}

				// if it is, hide the error message
				else { 
					$('#compose-error').fadeOut('slow');

					//gather all variables to send to AJAX send-message.php
					var matchee_user_id = $('#send_message_btn').attr('matchee_user_id');
					var match_user_id = $('#send_message_btn').attr('match_user_id');
					var message = $("#message_textarea").val();


	 		// send data to db and close modal
	 	     $.ajax({
	              type: "GET",
	              url: "send-message.php",
	              data: { match_user_id: match_user_id, matchee_user_id: matchee_user_id, message: message }
	             }).done(function(data) {
	             	 //close modal. 
	      			$('#compose-modal').modal('hide');	            	 
	 				 //reset all message details after closing modal
	 				 $('#message_textarea').val('');  
	             });
        	}
        });

// when cancel button is clicked remove text from text areas. 
 		$(".cancel_btn, .close").click(function() {
 			
 			$('#message_textarea').val('');
 			$('#compose-error').fadeOut('slow');

 			

 		
		});
		


	});
