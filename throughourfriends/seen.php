


<?php
// - Create SEEN.PHP accessible via AJAX. Needed to update db that record has been 'seen'


require 'connect.inc.php';

if(!isset($_SESSION))
	{
	session_start();
	}

$Session_user = $_SESSION['User_user_id'];




if (isset  ($_GET['new_friend'])) {
//- new_friend
		$tasteid = ($_GET['new_friend']);
		$tasteid = join(',',$tasteid);  
 		 $query = "UPDATE tastes SET seen = '1' WHERE taste_id IN ($tasteid) AND User_id_friend = $Session_user";
		if ($query_run = mysql_query($query)) {
		
			}	
				else {
				
		}
		 	
}




if (isset  ($_GET['new_pending_match'])) {

// 		- new_pending_match. Update pending matche seen when user approves/rejects their pending matches. 

		 $match_id = ($_GET['new_pending_match']);

 		 $query = "SELECT Match_user_id, Matchee_user_id FROM matches WHERE Match_id = $match_id";
 		 if ($query_run = mysql_query($query)) {
		
			$result1 = mysql_fetch_array($query_run);
			
				if ($result1['Match_user_id'] == $Session_user){ //session user is match_user_id of match
				 	$query = "UPDATE matches SET match_pending_seen = '1' WHERE Match_id = $match_id AND Match_user_id = $Session_user";
					if ($query_run = mysql_query($query)) {
					
						}	
							else {
							echo mysql_error();
					}
	 		 }
	 		 	else { //session user must be matchee_user_id
		 		 	$query = "UPDATE matches SET matchee_pending_seen = '1' WHERE Match_id = $match_id AND Matchee_user_id = $Session_user";
						if ($query_run = mysql_query($query)) {
						
							}	
								else {
								echo mysql_error();
						}

	 		 	}


			}	
				else {
				echo mysql_error();
		}
	}



if (isset  ($_GET['new_active_match'])) {
// 		- new_active_match. Update active matche seen when user approves/rejects their active matches. 

		 $match_id = ($_GET['new_active_match']);
		 $match_id = join(',',$match_id);

 		 $query = "SELECT Match_user_id, Matchee_user_id FROM matches WHERE Match_id IN ($match_id)";
 		 if ($query_run = mysql_query($query)) {
		
			$result1 = mysql_fetch_array($query_run);
			
				if ($result1['Match_user_id'] == $Session_user){ //session user is match_user_id of match
				 	$query = "UPDATE matches SET match_active_seen = '1' WHERE Match_id IN ($match_id) AND Match_user_id = $Session_user";
					if ($query_run = mysql_query($query)) {
						echo('successfulyy updated match active seen');
						}	
					else {

						echo mysql_error();
					}
	 		 }
		 		 	else { //session user must be matchee_user_id
			 		 	$query = "UPDATE matches SET matchee_active_seen = '1' WHERE Match_id IN ($match_id) AND Matchee_user_id = $Session_user";
							if ($query_run = mysql_query($query)) {
								echo('successfulyy updated matchee active seen');
								}	
							else {
								echo mysql_error();
								
							}

		 		 	}


			}	
				else {
				echo mysql_error();
		}
 		 
	}

	
if (isset  ($_GET['new_message'])) {
//- new_message
		$message_id = ($_GET['new_message']);
 		 $query = "UPDATE messages SET `Read` = '1' WHERE `Message_id` = $message_id AND `Recipient_user_id` = $Session_user";

		if ($query_run = mysql_query($query)) {
		
			// echo results of successful match intiation
			echo ("Successfully updated message record");
			}	
				else {
				echo mysql_error();
		}
		 	
}


	
?>