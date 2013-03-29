<!-- //send-message.php:

			1. isset all variables from POST...[Sendor_user_id], [Recipient_user_id], [Message]
			2. store $message_preview as concantenated version of originally message
				$message_preview = (strlen($message) > 80) ? substr($message,0,77).'...' : $string;
			3. write new row to table Messages:
				INSERT INTO messages
				[Sender_user_id], [Recipient_user_id], [Message_preview], [Message] set [session_user_id], [Recipient_user_id], [Message_preview], [Message]
 -->


<?php

require 'connect.inc.php';
require 'core.inc.php';

//call get friend matches function in order to put 5 new matches into match-viewer based on userid of friend. 
if (isset  ($_GET['match_user_id']) || ($GET['matchee_user_id']) || ($GET['message']) ) {

	//save variabels from GET
	session_start();
	$Session_user_id = $_SESSION['User_user_id'];
	$Match_user_id = check_input($_GET['match_user_id']);
	$Matchee_user_id = check_input($_GET['matchee_user_id']);
	$Message = check_input($_GET['message']);

 	// determine if the session user is the recipient or the sendor by comparing their user_id to both sendor and recipent ids passed. 
		if ($Match_user_id == $Session_user_id){
				// set recipient_user_id = matchee_id
				$Recipient_user_id = $Matchee_user_id;
			}
			else {
				// set recipient_user_id = match_user_id
				$Recipient_user_id = $Match_user_id;
			}  

	// store $message_preview as concantenated version of originally message
		if (strlen($Message) > 75){
				//take the first 77 characters and append "..." and save as $Message_preview
				$Message_preview = substr($Message,0,72).'...';
			} 
			else {
				$Message_preview = $Message;
			}


   // query to insert new match row with variables
	$query = "INSERT INTO messages (Sender_user_id, Recipient_user_id, Message_preview, Message) VALUES ('$Session_user_id', '$Recipient_user_id', '$Message_preview', '$Message')";

	if ($query_run = mysql_query($query)) {

		//create new notification for this message

		 $last_id = mysql_insert_id();

		 $query = "INSERT INTO notifications (Notification_type, Foreign_id, Actor1_id, Actor2_id) VALUES ('Message', '$last_id', '$Session_user_id', '$Recipient_user_id')";

		if ($query_run = mysql_query($query)) {

		}	
			else {
			echo mysql_error();
			} 

	}	
			else {
			echo mysql_error();
	} 
};
?>
