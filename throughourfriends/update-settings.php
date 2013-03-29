 <?php
require 'connect.inc.php';
require 'core.inc.php';

//function to turn true and false into booleans. 


?>




<?php
 // start session in order to use session user id
 	if(!isset($_SESSION))
	  {
	  session_start();
	  }

//run check_input function, then save item as variable.
$Matchable_status = bol(check_input($_GET['matchable'])); 
$_SESSION['Matchable_status'] = $Matchable_status;
$Deleted = bol(check_input($_GET['deleted'])); 
$New_friend_email = bol(check_input($_GET['new_friend_email']));
$New_pending_match_email = bol(check_input($_GET['new_pending_email']));
$New_active_match_email = bol(check_input($_GET['new_active_email']));
$New_message_email = bol(check_input($_GET['new_message_email']));
$Email = check_input($_GET['email']);
$Userid = $_SESSION['User_user_id'];

//change variables into 1 if true, and 0 if false. 




    //update settings with new variables from GET
     $sql = "UPDATE `settings` SET New_friend_email='$New_friend_email', New_pending_match_email= '$New_pending_match_email', New_active_match_email= '$New_active_match_email', New_message_email= '$New_message_email' WHERE Userid='$Userid'";
  
     if ($query_run = mysql_query($sql)) {

		
		

		}	
			else {
			echo mysql_error();
	} 

	 //Update profile records with deleted and matchable variables
	
		 $sql = "UPDATE `profiles` SET Matchable_status='$Matchable_status', Deleted='$Deleted', Email='$Email'  WHERE userid='$Userid'";
		
	      if ($query_run = mysql_query($sql)) {


		 	}	
		 		else {
		 		echo mysql_error();
		 } 
		 echo("Your settings has been saved");

?>