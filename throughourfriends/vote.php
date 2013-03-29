
<?php

require 'connect.inc.php';
require 'core.inc.php';

//call get friend matches function in order to put 5 new matches into match-viewer based on userid of friend. 
if (isset  ($_GET['match_id']) || ($_GET['vote']) || ($_GET['voter_user_id']) || ($_GET['voter_type']) ) {

	//save variabels from GET
	$Match_id = check_input($_GET['match_id']);
	$Vote = check_input($_GET['vote']);
  	$Voter_user_id = check_input($_GET['voter_user_id']);
  	$Voter_type = check_input($_GET['voter_type']);
	$Matchee_user_id = check_input($_GET['matchee_user_id']);
  	$Match_user_id = check_input($_GET['match_user_id']);


  	//check if Match_id = 0. If so, create a new match first, then continue to record the vote. 
  	if ($Match_id == '0' AND $Vote == '1'){

	  	//save variabels into local variables to use in save_match function. 
		$Matchmaker = $Voter_user_id;
		$Matchee = $Matchee_user_id;
		$Match = $Match_user_id;
	  
	  	//save the returned value of the save_match fuction into a variable
		$Match_saved = save_match($Matchmaker, $Matchee, $Match);

		//save id of this match to use later...if needed. 
		$Match_id = (mysql_insert_id());

  	}


 
 	// check if vote has already been cast by this user, if so dont do anything. 




    // query to insert variables into votes table with variables
	$query = "INSERT INTO votes (Match_id, Vote, Voter_user_id, Voter_type) VALUES ('$Match_id', '$Vote', '$Voter_user_id', '$Voter_type')";

	if ($query_run = mysql_query($query)) {


		}	
			else {
			echo mysql_error();
			}
		
	// update match row with friend accepted = 1 and acceptor id = voter_user_id, accepted_time = now(), where match_id = match_id clicked on
	if  ($Vote == 1 and $Voter_type == 'friend'){

		$query = "UPDATE `matches` SET Friend_accepted='1', Friend_acceptor_id='$Voter_user_id', Accepted_time=CURRENT_TIMESTAMP WHERE Match_id ='$Match_id'";

			if ($query_run = mysql_query($query)) {	
				//create new notification for this new pending match
				$query = "INSERT INTO notifications (Notification_type, Foreign_id, Actor1_id, Actor2_id) VALUES ('Pending_match', '$Match_id', '$Matchee_user_id', '$Match_user_id')";

				if ($query_run = mysql_query($query)) {

				}	
					else {
					echo mysql_error();
					} 
			
			}	
			
			else {
			echo mysql_error();
			}		

	} 
	// update match row with match accepted = 1 and match_accepted_time = where match_id = match_id clicked on
	if  ($Vote == 1 and $Voter_type == 'match'){

			// update match row with friend accepted = 1 and acceptor id = voter_user_id, accepted_time = now(), where match_id = match_id clicked on
			$query = "UPDATE `matches` SET Match_accepted='1', Match_accepted_time=CURRENT_TIMESTAMP WHERE Match_id ='$Match_id'";

				if ($query_run = mysql_query($query)) {	
					
					// query if the matchee already accepted this match. If yes, create new notification for this new pending match					
					 $query ="SELECT Matchee_accepted FROM `matches` WHERE Match_id = '$Match_id' AND Matchee_accepted = 1";

					 	if ($query_run = mysql_query($query)) { //run query

							if (mysql_num_rows($query_run)) { // check if a run was returned

								$query = "INSERT INTO notifications (Notification_type, Foreign_id, Actor1_id, Actor2_id) VALUES ('Active_match', '$Match_id', '$Matchee_user_id', '$Match_user_id')";

								if ($query_run = mysql_query($query)) { //run query

								}	
									else {
									echo mysql_error();
									} 

							}


					 	}

				}	

			else {
			echo mysql_error();
			} 

	}	
				
				

	// update match row with matchee accepted = 1 and matchee_accepted_time = where match_id = match_id clicked on
	if  ($Vote == 1 and $Voter_type == 'matchee'){

		// update match row with friend accepted = 1 and acceptor id = voter_user_id, accepted_time = now(), where match_id = match_id clicked on
		$query = "UPDATE `matches` SET Matchee_accepted='1', Matchee_accepted_time=CURRENT_TIMESTAMP WHERE Match_id ='$Match_id'";

			if ($query_run = mysql_query($query)) {

					if ($query_run = mysql_query($query)) {	
		
						// query if the match already accepted this match. If yes, create new notification for this new pending match					
						 $query ="SELECT Match_accepted FROM `matches` WHERE Match_id = '$Match_id' AND Match_accepted = 1";

						 	if ($query_run = mysql_query($query)) { //run query

								if (mysql_num_rows($query_run)) { // check if a run was returned

									$query = "INSERT INTO notifications (Notification_type, Foreign_id, Actor1_id, Actor2_id) VALUES ('Active_match', '$Match_id', '$Matchee_user_id', '$Match_user_id')";

									if ($query_run = mysql_query($query)) { //run query

									}	
										else {
										echo mysql_error();
										} 

								}


						 	}

					}

			}	
			
			else {
			echo mysql_error();
			}		

	} 


};
?>


