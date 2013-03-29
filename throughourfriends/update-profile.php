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
$Userid = $_SESSION['User_user_id'];
$ApprovedTastes = ($_GET['approvedTastes']);




	    //update profile with new variables from GET
	     $sql = "UPDATE `profiles` SET Gender='$Gender', Birthday='$Birthday', Sexual_pref='$Sexual_pref', Looking_for= '$Looking_for', Ethnicity= '$Ethnicity', Drinks= '$Drinks', Height= '$Height', Relationship_status= '$Relationship_status', Smokes= '$Smokes',  Body_type= '$Body_type', Drugs= '$Drugs', Diet= '$Diet', Kids= '$Kids', Education= '$Education', Hometown= '$Hometown', Lat_hometown= '$Lat_hometown', Long_hometown= '$Long_hometown', Religion= '$Religion', Income= '$Income', City= '$City', Lat_city= '$Lat_city', Long_city= '$Long_city', Politics= '$Politics', Languages= '$Languages', Profession= '$Profession', Sign= '$Sign', Main_pic= '$Main_pic', First_pic= '$First_pic', Second_pic= '$Second_pic', Third_pic= '$Third_pic', Claimed= '1' WHERE userid='$Userid'";
	  
	     if ($query_run = mysql_query($sql)) {

			//header("Location: create-tastes.php?unique='$Unique'");
			echo("Your profile has been saved");
			$_SESSION['Claimed'] = '1';
			// update main_pic
		    $_SESSION['Main_pic'] = $Main_pic;

			}	
				else {
				echo mysql_error();
		} 

		// //Update taste records to approved = 0 if for each taste id sent in the ApprovedTastes array. Dont run if array is empty. 
		
		if (!empty($ApprovedTastes)) {


			$sql = "UPDATE `tastes` SET Approved='0' WHERE Taste_id IN ($ApprovedTastes)";
			
	  
		     if ($query_run = mysql_query($sql)) {

				//header("Location: create-tastes.php?unique='$Unique'");

				}	
					else {
					echo mysql_error();
			} 
		}
		






	  


?>