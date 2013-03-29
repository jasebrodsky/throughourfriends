 <?php
require 'connect.inc.php';
require 'core.inc.php';
?>



<?php
 // start session in order to use session user id
 	if(!isset($_SESSION))
	  {
	  session_start();
	  }



//security check if user-id-creator is equal to session user if so...
$User_id_creator = check_input($_GET['user_id_creator']);
$User_id = $_SESSION['User_user_id'];

if ($User_id_creator == $User_id){

	//check if get variables are set
	$Unique = check_input($_GET['unique']);
	$Taste_id = check_input($_GET['tastes_id']);
	$Friend_userid = check_input($_GET['User_id_friend']);
 	 
	//update appropriate taste record 		
			
	//run update query
	 $query = "UPDATE `tastes`	SET `Unique`='$Unique', `seen`='0' WHERE `Taste_id`='$Taste_id'";
	//if sql query was successful, then direct to verify.php else show sql error. 
	 if ($query_run = mysql_query($query)) {

		 	//create new notification for this new updated taste record
			$query = "INSERT INTO notifications (Notification_type, Foreign_id, Actor1_id, Actor2_id) VALUES ('Updated_review', '$Friend_userid', '$User_id', '$Friend_userid')";

			if ($query_run = mysql_query($query)) {

				echo("Saved!");

			}	
			else {
			echo mysql_error();
			} 


		 }	else {
				 echo mysql_error();
		 }

}else{
	echo('you do not have the correct permisisons');
}

 
?>