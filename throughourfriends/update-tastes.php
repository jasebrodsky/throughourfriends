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

//run check_input function, then save item as variable.
	$Ethnicity = check_input($_GET['ethnicity']);
	$Religion = check_input($_GET['religion']);
	$Politics = check_input($_GET['politics']);
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
	$Taste_id = check_input($_GET['tastes_id']);
	$Friend_userid = check_input($_GET['User_id_friend']);

	//update appropriate taste record 		
			
	//run update query
	 $query = "UPDATE `tastes`	SET `Gender`='$Gender', `Min_age`='$Min_age', `Max_age`='$Max_age', `City`= '$City', `Lat_city`= '$Lat_city', `Lat_city_max`= '$Lat_city_max', `Lat_city_min`= '$Lat_city_min', `Long_city`= '$Long_city', `Long_city_max`= '$Long_city_max', `Long_city_min`= '$Long_city_min', `Distance`= '$Distance', `Distance_unit`= '$Distance_unit', `Ethnicity`='$Ethnicity', `Religion`='$Religion', `Politics`='$Politics' WHERE `Taste_id`='$Taste_id'";
	//if sql query was successful, then direct to verify.php else show sql error. 
	 if ($query_run = mysql_query($query)) {

	 	echo("Saved!");

	 
		 }	else {
				 echo mysql_error();
		 }
		
		
}else{
	echo('you do not have the correct permisisons');
}


 
?>