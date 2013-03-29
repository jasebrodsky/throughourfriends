  
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


 		// when send button is clicked save variables then save message to db and close modal
 		$("#send_message").click(function(e) {
 			var element = $("option:selected", $("#match-list"));
 			var match_user_id = element.attr("match_user_id");
 			var matchee_user_id = element.attr("matchee_user_id");
 			var message = $("#message_textarea").val();
			var match_selected = element.val();
 			
 			//prevent any link from happening
			e.preventDefault();
			
			//validate a message has been entered
 			validate('#message_textarea');

 			//if message_textarea is not validated or no match is selected, show error message
				if ((validate('#message_textarea') == false) || (match_selected == 'Select a match')) {
					$('#compose-error').fadeIn('slow');

				}

				// if it is, hide the error message
				else { 
					$('#compose-error').fadeOut('slow');






	 		// send data to db and close modal
	 	    $.ajax({
	              type: "GET",
	              url: "send-message.php",
	              data: { match_user_id: match_user_id, matchee_user_id: matchee_user_id, message: message }
	            }).done(function(data) {
	            	 //close modal. 	            	 
	 				 $('.cancel_btn').trigger('click');

	 				 //reset all message details after closing modal
	            	 $("#match-list").val('Select a match');
	            	 $('#reply_message_text').val('');
	 				 $('#message_textarea').val('');

	            });

        	}
		});

 		// when message preview text is clicked save message variables and display them in modal window. 
		$(".message-preview").click(function() {
			   // save message variables
			   var complete_message = $(this).attr("complete-message"); // save match_id variable
			   var fb_id = $(this).attr("fb_id"); // save match_id variable
			   var name = $(this).attr("name"); // save match_id variable
			   var creation_date = $(this).attr("creation_date"); // save match_id variable
			   var session_user_id = $("#logged-in-user").attr('userid');
			   var user_id = $(this).attr("user_id"); // save user_id variable
			   var sender_main_pic = $(this).attr("sender_main_pic");

			   //update sent message modal with saved variables
			   $('#complete_message_modal').text(complete_message);
			   $('#message_from_modal').text('Sent to: '+name);
			   $('#message_title').text('Message sent to '+name);
			   $('#message_date_modal').text(creation_date);
			   $('#message_to_modal').text('To: '+name);

			   $('#message_pic_from_modal').attr("userid", user_id);
			   $('#message_pic_reply_modal').attr("userid", session_user_id);
			   
			});

		// when reply button is clicked save variables then save message to db and close modal
 		$("#reply_button").click(function(e) {
 			
 			// save message variables
			   var message = $('#reply_message_text').val(); // save reply_message_text_variable
			   var matchee_user_id = $('#message_pic_from_modal').attr("userid"); // save user_id variable
			   var match_user_id =$('#message_pic_reply_modal').attr('userid');

			   e.preventDefault();
 				validate('#reply_message_text');

 			//if reply_message_text is not validated, show error message
				if (validate('#reply_message_text') == false) {
					$('#reply-error').fadeIn('slow');

				}

				// if it is, hide the error message
				else { 
					$('#reply-error').fadeOut('slow');


	 		// send data to db and close modal
	 	    $.ajax({
	              type: "GET",
	              url: "send-message.php",
	              data: { match_user_id: match_user_id, matchee_user_id: matchee_user_id, message: message }
	            }).done(function(data) {
	            	 // trigger the modal to close
	            	 //$('.cancel_btn').trigger('click');

	            	 //remove any text in text areas after replying and close modal 
	            	 $('.cancel_btn').trigger('click');
	            	 $('#reply_message_text').val('');
	 				 $('#message_textarea').val('');

	            	 
	            });
        	}
		});

		// when cancel button is clicked remove text from text areas. 
 		$(".cancel_btn, .close").click(function() {
 			
 			$('#reply_message_text').val('');
 			$('#message_textarea').val('');
 			$('#reply-error').fadeOut('slow');
 			$('#compose-error').fadeOut('slow');
 			$("#match-list").val('Select a match');
 			

 		
		});

 		


});



