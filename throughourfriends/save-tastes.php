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
 	

//run check_input function, then save item as variable.
$Gender = check_input($_GET['gender']); 
$Max_age = check_input($_GET['max_age']);
$Min_age = check_input($_GET['min_age']);
$City = check_input($_GET['city']);
$Distance = check_input($_GET['distance']);
$Distance_unit = check_input($_GET['distance_unit']);
$Lat_city = check_input($_GET['lat_city']);
$Long_city = check_input($_GET['long_city']);

//calculate bounding box coordination from lat/long distance and distance unit
$bounding_box = (boundingbox($Lat_city, $Long_city, $Distance, $Distance_unit));

//save coordinates of each corner of bounding box as max/min for each lat/long. 
$Long_city_max = $bounding_box['long_max'];
$Long_city_min = $bounding_box['long_min'];
$Lat_city_max = $bounding_box['lat_max'];
$Lat_city_min = $bounding_box['lat_min'];

//continue saving variables about the taste record. 
$Ethnicity = check_input($_GET['ethnicity']);
$Religion = check_input($_GET['religion']);
$Politics = check_input($_GET['politics']);
$Unique = check_input($_GET['unique']);
$Friend_fb_id = $_SESSION['friend_fb_id'];
$fb_id = $_SESSION['fb_id'];
$Relationship_of_friend = $_SESSION['relationship_of_friend'];
$First_name_creator = $_SESSION['Name'];
$User_id = $_SESSION['User_user_id'];
$Friend_userid = $_SESSION['friend_userid'];
$Friend_claimed = $_SESSION['Claimed'];




 	// if user is already has a taste record on their friend, they will update their existing taste record

	$query = "SELECT `Taste_id`\n" //qry tastes table to see if a record already exists
	. "FROM `tastes`\n"
	. "WHERE `User_id_creator` = '$User_id'\n"
	. "AND `User_id_friend` = '$Friend_userid'\n"
	. " ORDER BY `tastes`.`Creation_date` ASC LIMIT 0,30 ";
	
  	$query_run = mysql_query($query); //store result in var
 	
  if (mysql_num_rows($query_run)) { // check if any rows were returned if so, update that row, else create a new taste record

 	//if there are results (this user already set up their friend) update that record
	if ($query_row = mysql_fetch_assoc($query_run))  
		//save userid as $Friend_userid var
		$Taste_id = $query_row['Taste_id'];
		
		//run update query
		 $query = "UPDATE `tastes`	SET `Gender`='$Gender', `Min_age`='$Min_age', `Max_age`='$Max_age', `City`= '$City', `Lat_city`= '$Lat_city', `Lat_city_max`= '$Lat_city_max', `Lat_city_min`= '$Lat_city_min', `Long_city`= '$Long_city', `Long_city_max`= '$Long_city_max', `Long_city_min`= '$Long_city_min', `Distance`= '$Distance', `Distance_unit`= '$Distance_unit', `Ethnicity`='$Ethnicity', `Religion`='$Religion', `Politics`='$Politics', `Relationship_of_friend`='$Relationship_of_friend', `Unique`='$Unique', `seen`='0' WHERE `Taste_id`='$Taste_id'";
		//if sql query was successful, then direct to verify.php else show sql error. 
		 if ($query_run = mysql_query($query)) {

			 	//create new notification for this new updated taste record
				$query = "INSERT INTO notifications (Notification_type, Foreign_id, Actor1_id, Actor2_id) VALUES ('Updated_review', '$Friend_userid', '$User_id', '$Friend_userid')";

				if ($query_run = mysql_query($query)) {

				}	
				else {
				echo mysql_error();
				} 


			 }	else {
					 echo mysql_error();
			 }
		}

 	else {
 		//if there are no results (this user has never set up their friend) create new tast record
		 echo mysql_error();
		  //run the sql query to insert variables into tastes table.
		  $query = "INSERT INTO `tastes` (`User_id_creator`, `fb_id_creator`, `First_name_creator`, `User_id_friend`, `Gender`,  `Min_age`, `Max_age`, `City`, `Lat_city`, `Lat_city_max`, `Lat_city_min`, `Long_city`, `Long_city_max`, `Long_city_min`, `Distance`, `Distance_unit`, `Ethnicity`,  `Religion`, `Politics`,  `Relationship_of_friend`, `Unique`) VALUES ( '$User_id', '$fb_id', '$First_name_creator', '$Friend_userid', '$Gender', '$Min_age', '$Max_age', '$City', '$Lat_city', '$Lat_city_max', '$Lat_city_min', '$Long_city', '$Long_city_max', '$Long_city_min', '$Distance', '$Distance_unit', '$Ethnicity', '$Religion', '$Politics', '$Relationship_of_friend', '$Unique')";
		//if sql query was successful, then direct to verify.php else show sql error. 
		 if ($query_run = mysql_query($query) AND $Friend_claimed == 1) {
				 
				//create new notification for this new friend
				$query = "INSERT INTO notifications (Notification_type, Foreign_id, Actor1_id, Actor2_id) VALUES ('New_friend', '$Friend_userid', '$User_id', '$Friend_userid')";

				if ($query_run = mysql_query($query)) {

				}	
				else {
				echo mysql_error();
				} 

		 		
		 		echo mysql_error();
			 }	else {
					 echo mysql_error();
			 }
 		}

 		//check if friend has a claimed profile or not. This will be used to direct user to verify page if the friend is not claimed the profile, or direct to my-friends.php if the friend has claimed their profile
 		if ($Friend_claimed == 1){
 			//if friend being set up is claimed, send to my-friends (skip verify)
 			echo('my-friends.php');
		}else{
			//else, friend being set up is not claimed yet, so they need to go to verify before matching. 
			echo('verify.php');
		}

 		//send out any emails if that aren't set yet (this should be turned on in production)
		//include 'send_emails.php';

 
?>