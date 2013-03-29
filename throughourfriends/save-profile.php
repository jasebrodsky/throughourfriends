 <?php
require 'connect.inc.php';
require 'core.inc.php';





session_start();

//run check_input function, then save item as variable.
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
$Politics = check_input($_GET['politics']);

$Profession = check_input($_GET['profession']);
$Languages = check_input($_GET['languages']);
$Drinks = check_input($_GET['drinks']);
$Smokes = check_input($_GET['smokes']);
$Main_pic = check_input($_GET['main_pic']);
$First_pic = check_input($_GET['first_pic']);
$Second_pic = check_input($_GET['second_pic']);
$Third_pic = check_input($_GET['third_pic']);
$Friend_fb_id = $_SESSION['friend_fb_id'];

$First_name = $_SESSION['First_name'];
$Last_name = $_SESSION['Last_name'];
$last_intial = $Last_name[0];
$Name = $First_name." ".$last_intial.".";


$query = mysql_query("SELECT `userid` FROM `profiles` WHERE `fb_id` = ". $_SESSION['friend_fb_id']);  // set up query to check if a profile exists and whether its claimed.
$result = mysql_fetch_assoc($query); // put the result of the above query into variable
     
      if(empty($result)){ // check if above query returned anything. If not, we know we need to make a new account for this user. 
       
		$query = "INSERT INTO profiles (fb_id, Name, First_name, Last_name, Gender, Birthday, Sexual_pref, Looking_for, Ethnicity, Drinks, Height, Relationship_status, Smokes, Body_type, Drugs, Diet, Kids, Education, Hometown, Lat_hometown, Long_hometown, Religion, Income, City, Lat_city, Long_city, Politics, Languages, Profession, Sign, Main_pic, First_pic, Second_pic, Third_pic) VALUES ('$Friend_fb_id', '$Name', '$First_name', '$Last_name', '$Gender', '$Birthday', '$Sexual_pref', '$Looking_for', '$Ethnicity', '$Drinks', '$Height', '$Relationship_status', '$Smokes', '$Body_type', '$Drugs', '$Diet', '$Kids', '$Education', '$Hometown', '$Lat_hometown', '$Long_hometown', '$Religion', '$Income', '$City', '$Lat_city', '$Long_city', '$Politics', '$Languages', '$Profession', '$Sign', '$Main_pic', '$First_pic', '$Second_pic', '$Third_pic')";

		if ($query_run = mysql_query($query)) {

			//find id of last profile inserted, so we can also give them a settings record. 
			$last_userid = mysql_insert_id();

			//create query to insert new settings record for the new user
			$query2 = "INSERT INTO settings (Userid) VALUES ('$last_userid')";
			
			//run the query
			if ($query_run2 = mysql_query($query2)) {

				//if it was successful direct to create-tastes.php
				header("Location: create-tastes.php?unique='$Unique'");
			
				}	
				else {
					//if it wasnt successful display error message. 
					echo mysql_error();
				}	 


			}	
				else {
				echo mysql_error();
		} 

     }
    
	    else { // need to update existing unclaimed profile 
	    
	     $sql = "UPDATE `profiles` SET Name='$Name', First_name='$First_name', Last_name='$Last_name',  Gender='$Gender', Birthday='$Birthday', Sexual_pref='$Sexual_pref', Looking_for= '$Looking_for', Ethnicity= '$Ethnicity', Drinks= '$Drinks', Height= '$Height', Relationship_status= '$Relationship_status', Smokes= '$Smokes',  Body_type= '$Body_type', Drugs= '$Drugs', Diet= '$Diet', Kids= '$Kids', Education= '$Education', Hometown= '$Hometown', Lat_hometown= '$Lat_hometown', Long_hometown= '$Long_hometown', Religion= '$Religion', Income= '$Income', City= '$City', Lat_city= '$Lat_city', Long_city= '$Long_city', Politics= '$Politics', Languages= '$Languages', Profession= '$Profession', Sign= '$Sign', Main_pic= '$Main_pic', First_pic= '$First_pic', Second_pic= '$Second_pic', Third_pic= '$Third_pic', Claimed= '0', Verified= '0' WHERE fb_id='$Friend_fb_id'";
	  
	     if ($query_run = mysql_query($sql)) {

			//header("Location: create-tastes.php?unique='$Unique'");

			}	
				else {
				echo mysql_error();
		} 


	      }

	     // query database to obtain userid of friend being set up
			$query = "SELECT `userid`"
			    . "FROM `profiles`"
			    . "WHERE `fb_id` = $Friend_fb_id LIMIT 0, 30 ";
				
			 if ($query_run = mysql_query($query)) {
				if ($query_row = mysql_fetch_assoc($query_run)) 
								//save userid as $Friend_userid var
								$Friend_userid = $query_row['userid'];
								$_SESSION['friend_userid']  = $Friend_userid; //save to session var so we can use to populate verify page
								
							}
			 	else {
					 echo mysql_error();
			 }
      



?>