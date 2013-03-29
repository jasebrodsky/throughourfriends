<!-- 1. isset all variables that have been sent
	2. if recipient has been sent: query for messages sent to that user_id
	3. else, if sendor has been sent: query for messages sent BY that user_id
		if (isset(POST(recipient))){
			//query for messages sent to that user_id
		} 
		else {
			//query for messages sent to that user_id
		} -->


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
		if (strlen($Message) > 80){
				//take the first 77 characters and append "..." and save as $Message_preview
				$Message_preview = substr($Message,0,77).'...';
			} 
			else {
				$Message_preview = $Message;
			}


   // query to insert new match row with variables
	$query = "INSERT INTO Messages (Sender_user_id, Recipient_user_id, Message_preview, Message) VALUES ('$Session_user_id', '$Recipient_user_id', '$Message_preview', '$Message')";

	if ($query_run = mysql_query($query)) {
		

		}	
			else {
			echo mysql_error();
	} 
};
?>