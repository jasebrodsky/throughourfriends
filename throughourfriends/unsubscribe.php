 <?php
require 'connect.inc.php';
require 'core.inc.php';

//function to turn true and false into booleans. 


 // start session in order to use session user id
 	if(!isset($_SESSION))
	  {
	  session_start();
	  }

//run check_input function, then save item as variable.
//$Matchable_status = bol(check_input($_GET['matchable'])); 
//$_SESSION['Matchable_status'] = $Matchable_status;
//$Deleted = bol(check_input($_GET['deleted'])); 
$New_friend_email = '0';
$New_pending_match_email = '0';
$New_active_match_email = '0';
$New_message_email = '0';
$Userid = (check_input($_GET['userid']));

//change variables into 1 if true, and 0 if false. 




    //update settings with new variables from GET
     $sql = "UPDATE `settings` SET New_friend_email='$New_friend_email', New_pending_match_email= '$New_pending_match_email', New_active_match_email= '$New_active_match_email', New_message_email= '$New_message_email' WHERE Userid='$Userid'";
  
     if ($query_run = mysql_query($sql)) {

     	echo('You have been unsubscribed from all email notifications');

		

		}	
			else {
			echo mysql_error();
	} 


?>