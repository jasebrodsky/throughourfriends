<?php

require 'connect.inc.php';
require 'core.inc.php';




// return list of profiles that user described their friend might like. 
// use search_results() function to generate a conditions array. Use that to generate a SQL query. 

$User_id_friend = $_GET['userid'];

if(!isset($_SESSION))
	  {
	  session_start();
	  }

$User_id = $_SESSION['User_user_id'];



//query the db for the taste record between the session user and the friend selected. Save the returned variables into the _GET array. These will be used with the get friends matches function!

//required for QRY:
// - session user, userid of friend
$query = "SELECT p.Gender AS Friend_gender, t.Gender, t.Min_age, t.Max_age, t.City, t.Lat_city, t.Long_city, t.Distance, t.Distance_unit, t.Ethnicity, t.Religion, t.Politics\n"
    . "FROM tastes t\n"
    . "JOIN profiles p\n"
    . "ON p.userid = t.User_id_friend\n"
    . "WHERE User_id_creator = $User_id AND User_id_friend = $User_id_friend \n"
    . "LIMIT 0, 1";

	//if sql query was successful, save variabels, else show sql error. 
	 if ($query_run = mysql_query($query)) {
		if ($query_row = mysql_fetch_assoc($query_run)) {


			$_GET['Gender'] = $query_row['Gender'];
			$_GET['Min_age'] = $query_row['Min_age'];
			$_GET['Max_age'] = $query_row['Max_age'];
			$_GET['City'] = $query_row['City'];
			$_GET['Lat_city'] = $query_row['Lat_city'];
			$_GET['Long_city'] = $query_row['Long_city'];
			$_GET['Distance_city'] = $query_row['Distance'];
			$_GET['Distance_city_unit'] = $query_row['Distance_unit'];
			$_GET['Ethnicity'] = $query_row['Ethnicity'];
			$_GET['Religion'] = $query_row['Religion'];
			$_GET['Politics'] = $query_row['Politics'];

			//check friend gender and GET['Gender'] to produce correct sexual pref value
			
			$Friend_gender = $query_row['Friend_gender'];
			$Gender = $query_row['Gender'];

			if (($Friend_gender == 'Female') && ($Gender =='Male only')){
				//friend is straight, his girl matches should be straight or bi
				$_GET['Sexual_pref'] = 'Straight,Bi';
			}

			elseif (($Friend_gender == 'Female') && ($Gender =='Female only')){
				//friend is gay, her girl matches should be gay or bi
				$_GET['Sexual_pref'] = 'Gay,Bi';
			}

			elseif (($Friend_gender == 'Male') && ($Gender =='Male only')){
				//friend is gay, his male matches should be gay or bi
				$_GET['Sexual_pref'] = 'Gay,Bi';
			}

			elseif (($Friend_gender == 'Male') && ($Gender =='Female only')){
				//friend is straight, his girl matches should be straight or bi
				$_GET['Sexual_pref'] = 'Straight,Bi';
			}

			

			}
		 }	else {
				 echo mysql_error();
		 }


//call get friend matches function in order to put 5 new matches into match-viewer based on userid of friend. 
if ((isset($_GET['userid'])) and (isset($_GET['start'])) and (isset($_GET['duration']))) {

	//from session user id and GET(userid), need to generate fields from taste record describing who users' friend likes. 
	//put the returned values into the GET ARRAY. 
	//run get_friends_matches. (which calls search_results()) to generate a query. 
	//
	// 
	
	$friends_matches = get_friends_matches($_GET['userid'], $_GET['start'], $_GET['duration']);
	echo $friends_matches['friend_match_list'];

}
?>