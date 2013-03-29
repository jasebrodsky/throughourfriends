
<?php

require 'connect.inc.php';
require 'core.inc.php';


//save all get variables and session variables


	//save variabels from GET
	//check if GET variable updated_profile is true
	 	 // start session in order to use session user id
 	if(!isset($_SESSION))
	  {
	  session_start();
	  }

	$Userid = $_SESSION['User_user_id'];
	$Friend_userid = $_SESSION['friend_userid'];
	

	//run check_input function, then save item as variable.
	$Changed = check_input($_GET['changed']);
	$Gender = check_input($_GET['gender']); 
	$Birthday = check_input($_GET['birthday']);
	$Sign = getSign($Birthday);
	$Sexual_pref = check_input($_GET['sexual_pref']);
	$Looking_for = check_input($_GET['looking_for']);
	$City = check_input($_GET['city']);
	$Lat_city = check_input($_GET['lat_city']);
	$Long_city = check_input($_GET['long_city']);
	$Ethnicity = check_input($_GET['ethnicity']);
	$Height = check_input($_GET['height']);
	$Relationship_status = check_input($_GET['relationship_status']);
	$Body_type = check_input($_GET['body_type']);
	$Drugs = check_input($_GET['drugs']);
	$Diet = check_input($_GET['diet']);
	$Kids = check_input($_GET['kids']);
	$Education = check_input($_GET['education']);
	$Hometown = check_input($_GET['hometown']);
	$Lat_hometown = check_input($_GET['lat_hometown']);
	$Long_hometown = check_input($_GET['long_hometown']);
	$Religion = check_input($_GET['religion']);
	$Income = check_input($_GET['income']);
	//$Income = str_replace( ',', '/,/', $Income );//comma in this string seems to be breaking sql from saving properly
	$Politics = check_input($_GET['politics']);
	$Profession = check_input($_GET['profession']);
	$Languages = check_input($_GET['languages']);
	$Drinks = check_input($_GET['drinks']);
	$Smokes = check_input($_GET['smokes']);
	$Main_pic = check_input($_GET['main_pic']);
	$First_pic = check_input($_GET['first_pic']);
	$Second_pic = check_input($_GET['second_pic']);
	$Third_pic = check_input($_GET['third_pic']);
	$Taste_id = check_input($_GET['taste_id']);
	$Unique = check_input($_GET['unique']);


	$Friends_email = check_input($_GET['friends_email']);
	$findme = '@';
	$save_email = strpos($Friends_email, $findme);

	//if email is blank, its because user choose to user fb message instead of email. In this case do not update the db with a blank email. 
	if ($save_email === false) {
		$email_qry = null;
	}else{
		$email_qry = ", Email='$Friends_email'";
	}


	//check if profile has been changed on the verify page. If it has run full update, if it hasn't run faster update. 
	if ($Changed == 'false'){

	    // update profile with verified = 1 and email = $Friends_email
		$query = "UPDATE `profiles` SET Verified='1', Verified_time=CURRENT_TIMESTAMP $email_qry  WHERE userid='$Friend_userid'";

		if ($query_run = mysql_query($query)) {
				//echo $query;
				//echo('quick update was run'.$Changed);
				//create new notification for this new profile

			if ($save_email === false) {
				//do nothing
			}else{
				//create notification
				$query = "INSERT INTO notifications (Notification_type, Foreign_id, Actor1_id, Actor2_id) VALUES ('New_profile', '$Friend_userid', '$Userid', '$Friend_userid')";

				if ($query_run = mysql_query($query)) {

				}	
				else {

				echo mysql_error();
				} 
			}

				


			}	
			else {
			//echo $query;
			echo mysql_error();
			}
	
	} else{

	//update profile with new variables from GET
	     $sql = "UPDATE `profiles` SET Verified='1', Verified_time=CURRENT_TIMESTAMP $email_qry, Gender='$Gender', Birthday='$Birthday', Sexual_pref='$Sexual_pref', Looking_for= '$Looking_for', Ethnicity= '$Ethnicity', Drinks= '$Drinks', Height= '$Height', Relationship_status= '$Relationship_status', Smokes= '$Smokes',  Body_type= '$Body_type', Drugs= '$Drugs', Diet= '$Diet', Kids= '$Kids', Education= '$Education', Hometown= '$Hometown', Lat_hometown= '$Lat_hometown', Long_hometown= '$Long_hometown', Religion= '$Religion', Income= '$Income', City= '$City', Lat_city= '$Lat_city', Long_city= '$Long_city', Politics= '$Politics', Languages= '$Languages', Profession= '$Profession', Sign= '$Sign', Main_pic= '$Main_pic', First_pic= '$First_pic', Second_pic= '$Second_pic', Third_pic= '$Third_pic' WHERE userid='$Friend_userid'";
	  
		     if ($query_run = mysql_query($sql)) {

				//header("Location: create-tastes.php?unique='$Unique'");
				//echo $sql;
				//echo('major update was run');

					if ($save_email === false) {
						//do nothing
					}else{
						//create notification
						$query = "INSERT INTO notifications (Notification_type, Foreign_id, Actor1_id, Actor2_id) VALUES ('New_profile', '$Friend_userid', '$Userid', '$Friend_userid')";

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


		//run update query
		 $query = "UPDATE `tastes`	SET `Unique`='$Unique' WHERE `Taste_id`='$Taste_id'";
		//if sql query was successful, then direct to verify.php else show sql error. 
		 if ($query_run = mysql_query($query)) {
		 	//echo('tastes have been updated son');
			 }	else {
					 echo mysql_error();
			 } 

			
			
	}
?>


