


<?php
// - Create COUNT.PHP accessible via AJAX (from the header). Needed to count info that user needs to be notified about. Save each query to the session array. This page will be run in page load of header. 


require 'connect.inc.php';
if(!isset($_SESSION))
	{
	session_start();
	}

$Session_user = $_SESSION['User_user_id'];

// - New_friend_count
// 	- Count if current session user has any new friends. Count if any taste records exist where user_id_friend is session user and seen = 0
		// query for all taste records that havent been seen and have session user as friend. 
		 $query = mysql_query("SELECT Taste_id, Count(*) FROM `tastes` WHERE `seen` = '0' AND `User_id_friend` = $Session_user LIMIT 0, 30 ") or die(mysql_error());
		// put query result into var result
		 $result = mysql_fetch_array($query);
		// save result into session var
		 $_SESSION['New_friend_count'] = ($result['Count(*)']);


// - Friend_matches_count
// 	- Count if current session user's friends have any new matches. Count all matches that your friends have, that you could vote on. 
		// query for all taste records that havent been seen and have session user as friend. 
		 $query = mysql_query("SELECT Taste_id, Count(*) FROM `tastes` WHERE `seen` = '0' AND `User_id_friend` = $Session_user LIMIT 0, 30 ") or die(mysql_error());
		// put query result into var result
		 $result = mysql_fetch_array($query);
		// save result into session var
		 $_SESSION['New_friend_count'] = ($result['Count(*)']);

            
// 	- new_pending_match_count
// 	- Count if current session user has any new pending matches. Count if any match records exist where match/matchee_id is session user and match/matchee_pending_seen = 0

		// query all matches where session use is the match user id and match_pending_seen is 0
		$query1 = "SELECT Matchee_user_id, Match_user_id, Match_id, Count(*)"
		    . "FROM matches \n"
		    . "WHERE Match_user_id = $Session_user \n"
		    . "and Friend_accepted = 1 \n"
		    . "and Match_pending_seen = 0 \n";

		 $query_run = mysql_query($query1) or die(mysql_error());
		// put query result into var result
		 $result1 = mysql_fetch_array($query_run);
		// save result into var
		 $matches = ($result1['Count(*)']);
        

		// query all matches where session use is the matchee user id and matchee_pending_seen is 0
		 $query2   = "SELECT Matchee_user_id, Match_user_id, Match_id, Count(*)"
		    . "FROM matches \n"
		    . "WHERE Matchee_user_id = $Session_user \n"
		    . "and Friend_accepted = 1 \n"
		    . "and Matchee_pending_seen = 0 \n";

		 $query_run = mysql_query($query2) or die(mysql_error());
		// put query result into var result
		 $result2 = mysql_fetch_array($query_run);
		// save result into var
		  $matchees = ($result2['Count(*)']);

		 // add both matches and matchees variables where session user is part of the match and not seen the pending match yet. 
		 $_SESSION['New_pending_match'] = ($matches + $matchees); 

		      
// 	- new_message_count
// 	- Count if current session user has any new messages. Count if any message records exist where recipient is session user and read = 0
		 $query = mysql_query("SELECT message_id, Count(*) FROM `messages` WHERE `read` = '0' AND `Recipient_user_id` = $Session_user LIMIT 0, 100 ") or die(mysql_error());
		// put query result into var result
		 $result = mysql_fetch_array($query);
		// save result into session var
		 $_SESSION['New_message_count'] = ($result['Count(*)']);


// 	- new_active_match_count
// 	- Count if current session user has any new active matches. Count if any match records exist where match/matchee_id is session user and match/matchee_active_seen = 0

		// query all matches where session use is the match user id and match_active_seen is 0
		$query1 = "SELECT Matchee_user_id, Match_user_id, Match_id, Count(*)"
		    . "FROM matches \n"
		    . "WHERE Match_user_id = $Session_user \n"
		    . "and Friend_accepted = 1 \n"
		    . "and Match_accepted = 1 \n"
		    . "and Matchee_accepted = 1 \n"
		    . "and Match_active_seen = 0 \n";

		 $query_run = mysql_query($query1) or die(mysql_error());
		// put query result into var result
		 $result1 = mysql_fetch_array($query_run);
		// save result into var
		 $matches_active = ($result1['Count(*)']);
		        


		// query all matches where session use is the matchee user id and matchee_active_seen is 0
		 $query2   = "SELECT Matchee_user_id, Match_user_id, Match_id, Count(*)"
		    . "FROM matches \n"
		    . "WHERE Matchee_user_id = $Session_user \n"
		    . "and Friend_accepted = 1 \n"
		    . "and Match_accepted = 1 \n"
		    . "and Matchee_accepted = 1 \n"
		    . "and Matchee_active_seen = 0 \n";

		 $query_run = mysql_query($query2) or die(mysql_error());
		// put query result into var result
		 $result2 = mysql_fetch_array($query_run);
		// save result into var
		  $matchees_active = ($result2['Count(*)']);

		 // add both matches and matchees variables where session user is part of the match and not seen the pending match yet. 
		 $_SESSION['New_active_match'] = ($matches_active + $matchees_active); 
	
?>