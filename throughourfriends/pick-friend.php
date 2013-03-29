 <?php
require 'connect.inc.php';
require 'core.inc.php';

session_start();
// run check_input function on GET variables, then save them as session variables.
$_SESSION['friend_fb_id']  = check_input($_GET['friend_fb_id']); 

$friend_info = get_friends_fb_info($_SESSION['friend_fb_id']);

$_SESSION['First_name'] = ($friend_info['first_name']);

$_SESSION['Last_name'] = ($friend_info['last_name']);

//convert last name to intial
$last_intial =$_SESSION['Last_name'][0];

$_SESSION['name'] = $_SESSION['First_name']." ".$_SESSION['Last_name'];


$_SESSION['relationship_of_friend'] = check_input($_GET['relationship']);

// query if the fb_id already has been setup by checking if userid exists. If so, check if is claimed. If it has been claimed direct create-profile-claimed.php, else direct to create-profile.php					
	 $query ="SELECT userid, Claimed FROM `profiles` WHERE fb_id = '$_SESSION[friend_fb_id]' AND Claimed = '1'";

	 	if ($query_run = mysql_query($query)) { //run query

			if (mysql_num_rows($query_run)) { // check if a row was returned

				$row = mysql_fetch_assoc($query_run); //put results into assoc array

				$_SESSION['friend_userid'] = $row['userid']; // save result into session variable

				$_SESSION['Claimed'] = 1; // save result into session variable
				
				header('Location: create-profile-claimed.php'); //link to create-profile-claimed.php

			}
			
			else {

				header('Location: create-profile.php');// else, continue flow to create a profile or overwrite existing unclaimed profile. 

				$_SESSION['Claimed'] = 0;

			}


	 	}

 
 
?>