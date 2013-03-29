 <?php
 require 'connect.inc.php';
 require 'count.php';
 require 'assets/php/facebook/fbappconfig.php';
  require_once 'assets/php/facebook/facebook.php';


//function to count if user has 1 or more records availble. This is used to determine whether or not to show the no content page. 


	function count_records($type, $user_id){

		if ($type == 'friends'){

		    $query = mysql_query("SELECT COUNT(*)\n"
	     . "FROM tastes\n"
	     . "WHERE User_id_creator = $user_id");
		}

		if ($type == 'active_matches'){
			
			$query =  mysql_query("SELECT COUNT(*)\n"
	     . "FROM `matches` \n"
	     . "WHERE ((`Matchee_user_id` = $user_id) OR (`Match_user_id` = $user_id)) \n"
	     . " AND (`Friend_accepted` = 1) AND (`Match_accepted` = 1)\n"
	     . " AND (`Matchee_accepted` = 1)");
		}

		if ($type == 'incoming_messages'){

			$query = mysql_query("SELECT COUNT(*) \n"
	     . "FROM `messages` \n"
	     . "WHERE `Recipient_user_id` = $user_id");
		}

		if ($type == 'sent_messages'){

		 	$query = mysql_query("SELECT COUNT(*) \n"
	     . "FROM `messages` \n"
	     . "WHERE `Sender_user_id` = $user_id");	
		}

		if ($type == 'profile'){

			$query = mysql_query("SELECT COUNT(*)\n"
	    . "FROM `profiles` \n"
	    . "WHERE `userid` = $user_id AND `Verified` = 1");	
		}
		
		//run query that depending on type
		$result = mysql_fetch_array($query);
		 	
		//check if query returned 1 or more results
		 if (($result['0']) >= 1){
		 
		 //if query returned more than 1, return true. 

	    	 return true;
	    	}
	    else{
			//else return false
			return false;
		}
	}



	


function save_match($Matchmaker, $Matchee, $Match){

	  // check if matchmaker already has an exisiting match between matchee and match, if so dont do anything. 


	 // query to insert new match row with variables
	$query = "INSERT INTO matches (Matchmaker_user_id, Matchee_user_id, Match_user_id) VALUES ('$Matchmaker', '$Matchee', '$Match')";

	// run query
	if ($query_run = mysql_query($query)) {
	
		// if query is successful return true
		return true;

	}

	else {
		// if query is not successful return error
		echo mysql_error();
	} 

};
    

function search_results(){
	 // define the list of fields
    $fields = array('Gender', 'City', 'Min_age', 'Max_age', 'Sexual_pref', 'Relationship_status', 'Ethnicity', 'Drinks', 'Height', 'Smokes', 'Body_type', 'Drugs', 'Diet', 'Kids', 'Education', 'Hometown', 'Religion', 'Income', 'Politics' ,'Sign', 'Profession', 'Languages', 'languages');

    // create an empty array called conditions
    $conditions = array();

    // loop through the defined fields
    foreach($fields as $field){

        //if city is entered, put this clause in the condition array
        if(isset($_GET[$field]) && ($_GET[$field] != 'N/A' && $_GET[$field] != 'null' && $_GET[$field] != '_empty' && $_GET[$field] != '') && $field == 'City') {
            // create a new condition while escaping the value inputed by the user (SQL Injection)

            $Distance_city = check_input(($_GET['Distance_city']));
            $Distance_city_unit = check_input(($_GET['Distance_city_unit']));
            $Long_city = check_input(($_GET['Long_city']));
            $Lat_city = check_input(($_GET['Lat_city']));

            $bounding_box_city = (boundingbox($Lat_city, $Long_city, $Distance_city, $Distance_city_unit));

            $conditions[] = "(`Lat_city` BETWEEN ".$bounding_box_city['lat_min']." AND ".$bounding_box_city['lat_max'].") AND (`Long_city` BETWEEN ".$bounding_box_city['long_min']." AND ".$bounding_box_city['long_max'].") ";

        }

        //if city is entered, put this clause in the condition array
        else if(isset($_GET[$field]) && ($_GET[$field] != 'N/A' && $_GET[$field] != 'null' && $_GET[$field] != '_empty' && $_GET[$field] != '') && $field == 'Hometown') {
            // create a new condition while escaping the value inputed by the user (SQL Injection)

            $Distance_hometown = check_input(($_GET['Distance_hometown']));
            $Distance_hometown_unit = check_input(($_GET['Distance_hometown_unit']));
            $Long_hometown = check_input(($_GET['Long_hometown']));
            $Lat_hometown = check_input(($_GET['Lat_hometown']));

            $bounding_box_hometown = (boundingbox($Lat_hometown, $Long_hometown, $Distance_hometown, $Distance_hometown_unit));

            $conditions[] = "(`Lat_hometown` BETWEEN ".$bounding_box_hometown['lat_min']." AND ".$bounding_box_hometown['lat_max'].") AND (`Long_hometown` BETWEEN ".$bounding_box_hometown['long_min']." AND ".$bounding_box_hometown['long_max'].") ";
            
            
        }

        //if age range is entered, put this clause in the condition array
        else if(isset($_GET[$field]) && ($_GET[$field] != 'N/A' && $_GET[$field] != 'null' && $_GET[$field] != '') && ($field == 'Min_age' OR $field == 'Max_age')) {
            $min_age = check_input(($_GET['Min_age']));
            $max_age = check_input(($_GET['Max_age']));
            //add one to max age so search includes max age. Probally a better way to do this with rounding or <=
            $max_age = $max_age+1;


            // if either min or max age is left blank, fill in with a value so a range can be computed. 
            if ($min_age == null) {
              $min_age = 18;

            }
            else if ($max_age == null) {
              $max_age = 100;
            }

             
            //convert both min and max ages into bday to compute range in sql.
            $lower = date('Y-m-d', strtotime('today -'.$min_age.' years'));
            $upper = date('Y-m-d', strtotime('today -'.$max_age.' years'));        
            

            // create a new condition while escaping the value inputed by the user (SQL Injection)
            $conditions[] = "(`Birthday` BETWEEN '".$upper."' AND '".$lower."') "; 

        }


        // if the field is set and not empty or blank
        else if(isset($_GET[$field]) && ($_GET[$field] != 'N/A' && $_GET[$field] != 'null' && $_GET[$field] != '_empty' && $_GET[$field] != '' && $_GET[$field] != 'Not important')) {

          //convert gender into a value that can be compared to the taste record for a user. 
        	if ($field == 'Gender'){

			 	
			 	if ($_GET[$field] == 'Male only') {
			 		//Male only
			 		 $_GET[$field] = 'Male';
			 	}
			 	elseif 
			 		($_GET[$field] == 'Female only') {
			 		//Female only
			 		$_GET[$field] = 'Female';
			 	}
			 	elseif 
			 		($_GET[$field] == 'Female and Male') {
			 		//Female only
			 		$_GET[$field] = 'Female,Male';
			 	}
			 }

          //explode field into list $pieces. For each item in list add an apropriate element to the condition array. First format list with 'OR' operator after between elements.           
          $input_sent  = check_input(($_GET[$field]));
          $pieces = explode(",", $input_sent);;

          //define prefix var to use lists with only one element. 
          $prefix = '';

          //define list of elements
          $my_list='';

          // if each piece in list format correctly for SQL
          foreach ($pieces as $piece) {

              // format for SQL
              $addToList =$prefix. "`$field` LIKE '". $piece."%'";

              //change prefix var to OR in case there are more elements in list
              $prefix = ' OR ';

              // add all elements into list
              $my_list = $my_list.$addToList;
             
          }

          // put parantheses around list of elemtns
          $my_list = "(".$my_list.")";

          // add list of elemtns to the conditions array
          $conditions[] = $my_list;



        }

    }
    return $conditions;
        
  };

function getSign($date){
     list($year,$month,$day)=explode("-",$date);
     if(($month==1 && $day>20)||($month==2 && $day<20)){
          return "Aquarius";
     }elseif(($month==2 && $day>18 )||($month==3 && $day<21)){
          return "Pisces";
     }elseif(($month==3 && $day>20)||($month==4 && $day<21)){
          return "Aries";
     }elseif(($month==4 && $day>20)||($month==5 && $day<22)){
          return "Taurus";
     }elseif(($month==5 && $day>21)||($month==6 && $day<22)){
          return "Gemini";
     }elseif(($month==6 && $day>21)||($month==7 && $day<24)){
          return "Cancer";
     }elseif(($month==7 && $day>23)||($month==8 && $day<24)){
          return "Leo";
     }elseif(($month==8 && $day>23)||($month==9 && $day<24)){
          return "Virgo";
     }elseif(($month==9 && $day>23)||($month==10 && $day<24)){
          return "Libra";
     }elseif(($month==10 && $day>23)||($month==11 && $day<23)){
          return "Scorpio";
     }elseif(($month==11 && $day>22)||($month==12 && $day<23)){
          return "Sagittarius";
     }elseif(($month==12 && $day>22)||($month==1 && $day<21)){
          return "Capricorn";
     }
}

 function get_fb_photos($fb_id){
 	 

	$facebook = new Facebook(array(
	'appId'  => $_SESSION['app_id'],
	'secret' => $_SESSION['secret'],
	'cookie' => true,
	));


	
	// temporay fix for firefox issue where user token was not being saved...wierd. 
	$access_token = ($_SESSION["fb_".$_SESSION['app_id']."_access_token"]);
	$facebook->setAccessToken($access_token);


	//Create Query
	$multiQuery = '{
	"albums":"SELECT src_big, src, pid FROM photo WHERE aid IN (SELECT aid FROM album WHERE owner='.$fb_id.')",
	"tags":"SELECT src_big, src, pid FROM photo WHERE pid IN (SELECT pid FROM photo_tag WHERE subject='.$fb_id.') AND NOT (pid IN (SELECT pid FROM #albums))"
																								            
	}';

	$params = array(
		    'method' => 'fql.multiquery',
		    'queries' => $multiQuery,
		    'callback' => '');
		



	//Run Query
	$fqlResult = $facebook->api($params);

	$array["friend_photos"] ="";

	foreach($fqlResult[1]['fql_result_set'] as $result)

	{
		$array['friend_photos'] = $array['friend_photos']."
	  		<li class='span4'>
	            <a href='#' class='thumbnail'>
	              <img class='fb_pic' src_big='".$result['src_big']."' src='".$result['src']."'</img>
	            </a></li>";


	} 

	foreach($fqlResult[0]['fql_result_set'] as $result)

	{
		$array['friend_photos'] = $array['friend_photos']."
	  		<li class='span4'>
	            <a href='#' class='thumbnail'>
	              <img class='fb_pic' src_big='".$result['src_big']."' src='".$result['src']."'</img>
	            </a></li>";


	} 

// if array is empty message that the friend doesnt allow thier photos to be shared, else display all friends photos
if(empty($array['friend_photos'])) {

	echo ("<h4 class='blue'> Sorry, ".$_SESSION["name"]." does not allow access to their photos. They will have to pick their own later.</h4");
}
else {
	
	echo ("<h4 class='blue'>Click on the photo you like!</h4> <ul class='thumbnails friend-table'>".$array['friend_photos']."</ul>");

	
}

 };

function get_friends_fb_info($fb_id){
	
	$facebook = new Facebook(array(
	'appId'  => $_SESSION['app_id'],
	'secret' => $_SESSION['secret'],
	'cookie' => true,
	));


	//Create Query
	$fql    =  	"SELECT uid,name,first_name,last_name,username,sex,languages,education,current_location,hometown_location,birthday_date FROM user WHERE uid=" .$fb_id;

	$param  =   array(
	 'method'    => 'fql.query',
	 'query'     => $fql,
	 'callback'  => ''
	 );

	//Run Query
	$fqlResult   =  $facebook->api($param);
	//$fqlResult['birthday_date'] = '1980-01-01';
	
	foreach($fqlResult as $result)
	{
	  //print_r($result);
		//$array["sex"] = $result['sex'];
		//$array["city"] = $result['city']['name'];
	  return ($result);
	} 
  };

  function like_page($fb_id){
	
	$facebook = new Facebook(array(
	'appId'  => $_SESSION['app_id'],
	'secret' => $_SESSION['secret'],
	'cookie' => true,
	));


	//Create Query
	$fql    =  	"SELECT page_id FROM page_fan WHERE page_id=85439812053  AND uid=" .$fb_id;

	$param  =   array(
	 'method'    => 'fql.query',
	 'query'     => $fql,
	 'callback'  => ''
	 );

	//Run Query
	$fqlResult   =  $facebook->api($param);
	
	if (empty($fqlResult)) {
    	return false;
	}else{
		return true;
	}
		
	  return bol;
	
  };

  //fucntion to check if user has signed up more than 2 friends. 
function enoughFriends($user_id){

  $query = mysql_query("SELECT COUNT(*)\n"
	     . "FROM tastes\n"
	     . "WHERE User_id_creator = $user_id");

  //run query that depending on type
		$result = mysql_fetch_array($query);

		//check if query returned 2 or more results
		 if (($result['0']) >= 152){
		 
		 //if query returned more than 2, return true. 
	    	 return true;
	    	}
	    else{
			//else return false
			return false;
		}
		
};


 function get_coord($location_id){

 $facebook = new Facebook(array(
	'appId'  => $_SESSION['app_id'],
	'secret' => $_SESSION['secret'],
	'cookie' => true,
	));


	//Create Query
	$fql    =  	"SELECT latitude,longitude FROM place WHERE page_id=".$location_id;

	$param  =   array(
	 'method'    => 'fql.query',
	 'query'     => $fql,
	 'callback'  => ''
	 );

	//Run Query
	$fqlResult   =  $facebook->api($param);

	
	foreach($fqlResult as $result)
	{

	  return ($result);
	} 
  };

 function get_age($birthday) {
 	$age = floor((strtotime(date('Y-m-d')) - strtotime($birthday)) / 31556926);
 	return $age;
 };

function boundingbox($lat,  $long, $distance, $unit){

      // check if unit is in km or m, and convert appropriately
      if ($unit == 'miles of'){
      $ratio = 1.609344; 
      $kms = $distance * $ratio; 
      $distance = $kms; 
      }

      //convert kms into degrees
      $degrees = $distance*(90/10001.965729);

      //save new variables into array
		$array["lat_max"] = $lat + $degrees;
		$array["lat_min"] = $lat - $degrees;
		$array["long_max"] = $long + $degrees;
		$array["long_min"] = $long - $degrees;



      //return array with max and min coordination of bounding box
      return $array;
      
    };





 function get_profile($userid) {
	//run the sql query to view variables fom profile table.
	$query = "SELECT * \n"
		. "FROM `profiles`\n"
		. "WHERE `userid`= $userid\n"
		. "LIMIT 0, 1";

	//if sql query was successful, save variabels, else show sql error. 
	 if ($query_run = mysql_query($query)) {
		if ($query_row = mysql_fetch_assoc($query_run)) {
			$array["userid"] = $userid;
			$array["fb_id"] = $query_row['fb_id'];
			$array["Name"] = $query_row['Name'];
			$array["First_name"] = $query_row['First_name'];
			$array["Last_name"] = $query_row['Last_name'];
			$array["Gender"] = $query_row['Gender'];
			$array["Birthday"] = $query_row['Birthday'];
			$array["Age"] = get_age($array["Birthday"]);
			$array["Sexual_pref"] = $query_row['Sexual_pref'];
			$array["Looking_for"] = $query_row['Looking_for'];
			$array["Ethnicity"] = $query_row['Ethnicity'];
			$array["Height"] = $query_row['Height'];
			$array["Relationship_status"] = $query_row['Relationship_status'];
			$array["Body_type"] = $query_row['Body_type'];
			$array["Drugs"] = $query_row['Drugs'];
			$array["Diet"] = $query_row['Diet'];
			$array["Kids"] = $query_row['Kids'];
			$array["Education"]  = $query_row['Education'];
			$array["Income"]  = $query_row['Income'];
			$array["Hometown"] = $query_row['Hometown'];
			$array["Lat_hometown"] = $query_row['Lat_hometown'];
			$array["Long_hometown"] = $query_row['Long_hometown'];
			$array["Religion"]  = $query_row['Religion'];
			$array["City"] = $query_row['City'];
			$array["Lat_city"] = $query_row['Lat_city'];
			$array["Long_city"] = $query_row['Long_city'];
			$array["Politics"]  = $query_row['Politics'];
			$array["Languages"] = $query_row['Languages'];
			$array["Drinks"] = $query_row['Drinks'];
			$array["Smokes"] = $query_row['Smokes'];
			$array["Profession"]  = $query_row['Profession'];
			$array["Sign"] = $query_row['Sign'];
			$array["Main_pic"] = $query_row['Main_pic'];
			$array["First_pic"] = $query_row['First_pic'];
			$array["Second_pic"] = $query_row['Second_pic'];
			$array["Third_pic"] = $query_row['Third_pic'];
			$array["Email"] = $query_row['Email'];
			$array["Claimed"] = $query_row['Claimed'];
			$array["Verified"] = $query_row['Verified'];
			$array["Matchable_status"] = $query_row['Matchable_status'];
			$array["Deleted"] = $query_row['Deleted'];
			}
		 }	else {
				 echo mysql_error();
		 }
	 
		 //run select query to generate the 'what their friends say' section. 
		$query = "SELECT profiles.Claimed, profiles.Main_pic, profiles.Name, `Taste_id`, `User_id_creator`, `First_name_creator`, `fb_id_creator`, `Relationship_of_friend`, `Unique`\n"
	 . "FROM `tastes`\n"
	 . "INNER JOIN profiles\n"
	 . "ON tastes.User_id_creator = profiles.userid\n"
	 . "WHERE `User_id_friend` = $userid AND `Approved` = '1' LIMIT 0, 30 ";

		//if sql query was successful, then save variables. 
		  $loop = mysql_query($query)
		 		or die (mysql_error());

		 		$url = $_SERVER['REQUEST_URI'];
				$url_exploded = explode('/', $url);
				$page = end($url_exploded);
				
				if ($page == 'my-profile.php'){
					//if user is on my-profile show x
					$close_tag = "<a class='close_btn close icon-4x' href='#''><img src='assets/img/ButtonIconX.png'></img></a>";
				}else{
					//if user is on other page dont show x
					$close_tag = "";
				}

		 		$array["friends_say"] ="";
		 		
			while ($row = mysql_fetch_array($loop))
				{

					if ($row['Claimed'] == 1){
						//link to profile
						$profile_link = ("href=profile.php?user_id=".$row['User_id_creator']);
					}
					else{
						//link to modal
						$profile_link = ("href='#unclaimed' role='button' data-toggle='modal'");

					}
				     $array["friends_say"] = $array["friends_say"] ."<li taste-id=" . $row['Taste_id'] ." claimed=" .$row['Claimed'] ." class='span4 friend_review'>
				     ".$close_tag."
                          <a style='background-color:black;' class='thumbnail' ".$profile_link.">
                            <img class='big_pic' src=".$row['Main_pic'].">
                          </a>
                          <div id='friend-summary'>
                            <ul class='unstyled' id='profile-summary'>
                              <li href='index.php'>   <a ".$profile_link."> <h3 class='orange no-margin-bottom'>" . $row['Name'] ." <em class='blue'> (" . $row['Relationship_of_friend'] . ")</em> </h3></a> </li> 
                            </ul>
                          </div>
                          <div id='friend-quote'>
                            <a ".$profile_link."> <i class='icon-quote-left pull-left grey'></i> <p taste_id=".$row['Taste_id']." id=".$row['User_id_creator'].">" . ($row['Unique']) . "
                            <i class='icon-quote-right grey'></i></p>  </a>
                          </div>
                      </li> ";
				};
			
		

	
	
		return $array;
	
	};

function bol ($val){
	if ($val === 'true'){
		return $val = '1';
	}
	else {
		return $val = '0';
	}
}

function checked ($val){
	if ($val == '1'){
		return $val = 'checked';
	}
	else {
		return $val = '';
	}
}

function get_settings($userid) {
	//run the sql query to view variables fom profile table.
	$query = "SELECT * \n"
		. "FROM `settings`\n"
		. "WHERE `Userid`= $userid\n"
		. "LIMIT 0, 1";

	//if sql query was successful, save variabels, else show sql error. 
	 if ($query_run = mysql_query($query)) {
		if ($query_row = mysql_fetch_assoc($query_run)) {
			$array["New_friend_email"] = $query_row['New_friend_email'];
			$array["New_pending_match_email"] = $query_row['New_pending_match_email'];
			$array["New_active_match_email"] = $query_row['New_active_match_email'];
			$array["New_message_email"] = $query_row['New_message_email'];
			$array["Setting_id"] = $query_row['Setting_id'];
			}
		 }	else {
				 echo mysql_error();
		 }

		 return $array;
	}

function get_tastes($userid_creator, $userid_friend) {
	//run the sql query to view variables fom tastes table.

	$query = "SELECT tastes.Taste_id, tastes.User_id_creator, tastes.User_id_friend, tastes.Gender, tastes.Min_age, tastes.Max_age, tastes.Religion, tastes.Politics, tastes.Ethnicity, tastes.City, tastes.Lat_city, tastes.Long_city, tastes.Distance, tastes.Distance_unit, tastes.Unique, profiles.First_name \n"
    . "FROM `tastes` \n"
    . "JOIN profiles\n"
    . "ON tastes.User_id_friend = profiles.userid\n"
    . "WHERE `User_id_creator` = $userid_creator AND `User_id_friend` = $userid_friend \n"
    . "LIMIT 0, 1 ";

	//if sql query was successful, save variabels, else show sql error. 
	 if ($query_run = mysql_query($query)) {
		if ($query_row = mysql_fetch_assoc($query_run)) {
			$array["Gender"] = $query_row['Gender'];
			$array["Min_age"] = $query_row['Min_age'];
			$array["Max_age"] = $query_row['Max_age'];
			$array["Religion"] = $query_row['Religion'];
			$array["Politics"] = $query_row['Politics'];
			$array["Ethnicity"] = $query_row['Ethnicity'];
			$array["City"] = $query_row['City'];
			$array["Lat_city"] = $query_row['Lat_city'];
			$array["Long_city"] = $query_row['Long_city'];
			$array["Distance"] = $query_row['Distance'];
			$array["Distance_unit"] = $query_row['Distance_unit'];
			$array["Unique"] = $query_row['Unique'];
			$array["User_id_creator"] = $query_row['User_id_creator'];
			$array["User_id_friend"] = $query_row['User_id_friend'];
			$array["Taste_id"] = $query_row['Taste_id'];
			$array["First_name"] = $query_row['First_name'];
			

			}
		 }	else {
				 echo mysql_error();
		 }

		 return $array;
	}



 
function check_input($data, $problem =' ') 
 {	// do these security checks
	$data = trim($data);
	$data = addslashes($data);
	$data = htmlspecialchars($data);
	$data = mysql_real_escape_string($data);

	$data = str_replace("_empty,", "", $data); // replace all "_empty" from variables where no value is

	// if variable is empty then save as N/A otherwise return variable
	if (($data == "_empty") OR ($data == null) OR ($data == ''))
	{
		$data = 'N/A';
	}
	return $data;
 };

 // function changeToNA($data) 
 // {	// do these security checks

	// // if variable is empty then save as N/A otherwise return variable
	// if ($data == "_empty")
	// {
	// 	$data = 'N/A';
	// }
	// return $data;
 // };



function get_active_matches_and_friends($userid2) {
	//run sql query that returns active matches of the specific user id

	$query = "SELECT matches.Matchee_user_id, matches.Match_user_id, matches.Match_id, profiles.fb_id, profiles.Name, profiles.Gender, profiles.Sexual_pref, profiles.Relationship_status, profiles.City\n"
    . "FROM matches\n"
    . "INNER JOIN profiles\n"
    . "ON matches.matchee_user_id = profiles.userid\n"
    . "WHERE Match_user_id = $userid2 and `Match_accepted` = 1 and `Matchee_accepted` = 1 \n"
    . "and Friend_accepted = 1\n"
    . "UNION\n"
    . "SELECT matches.Matchee_user_id, matches.Match_user_id, matches.Match_id, profiles.fb_id, profiles.Name, profiles.Gender, profiles.Sexual_pref, profiles.Relationship_status, profiles.City\n"
    . "FROM matches\n"
    . "INNER JOIN profiles\n"
    . "ON matches.match_user_id = profiles.userid\n"
    . "WHERE Matchee_user_id = $userid2 and `Match_accepted` = 1 and `Matchee_accepted` = 1 \n"
    . "and Friend_accepted = 1 LIMIT 0, 30 ";


//if sql query was successful, then save variables. 
		  $loop = mysql_query($query)
		 		or die (mysql_error());

		 		$array["match_list"] ="";
		 		
			while ($row = mysql_fetch_array($loop))
				{
				     $array["match_list"] = $array["match_list"] ."
                      <option matchee_user_id='" .$row['Matchee_user_id']. "' match_user_id='" .$row['Match_user_id']. "' fb_id= '" .$row['fb_id']."'>To: " .$row['Name']." </option>";
				};

				return $array;

	 };


  function get_friends($userid2) {
	//run sql query that returns friends of the specific user id
	// return user_id_friend of all taste records where the logged user userid = user_id_creator

	$query = "SELECT `profiles`.Creation_date,`profiles`.userid,`profiles`.Main_pic, `profiles`.fb_id,`profiles`.Name,`profiles`.Gender,`profiles`.Birthday,`profiles`.Sexual_pref,`profiles`.Relationship_status,`profiles`.City\n"
    . "FROM `profiles`\n"
    . "INNER JOIN `tastes` ON `profiles`.userid = `tastes`.User_id_friend\n"
    . "WHERE `tastes`.User_id_creator= $userid2\n"
    . "ORDER BY `profiles`.Creation_date DESC\n"
    . "LIMIT 0, 200";


//if sql query was successful, then save variables. 
		  $loop = mysql_query($query)
		 		or die (mysql_error());

		 		$array["friend_list"] ="";
		 		
			while ($row = mysql_fetch_array($loop))
				{
				     $array["friend_list"] = $array["friend_list"] ."
                      <option userid='" .$row['userid']."' fb_id='" .$row['fb_id']."' main_pic='" .$row['Main_pic']."' gender='" .$row['Gender']."' relationship_status='" .$row['Relationship_status']."' age='" .get_age($row['Birthday'])."' sexual_pref='" .$row['Sexual_pref']."' fb_id='" ."' city='" .$row['City']."'>" .$row['Name']." </option>";
				};

				return $array;

	 };



 function get_friends_matches($id, $start, $duration) {
 	// query to generate a users matches. $id = the user you want to view matches of. 


 	$conditions = (search_results());
 	

 	 //if there are conditions, save variable as $clause
	    if(count($conditions) > 0) {
	        $clause = "AND " . implode (" AND ", $conditions)."";
	    }
	    //if there arent any conditions, save $clause as nothing
	    else {
	      $clause = "";
	    }

 	 // start session in order to use session user id
 	if(!isset($_SESSION))
	  {
	  session_start();
	  }
 	
 	$User_user_id = $_SESSION['User_user_id'];

    $query = "SELECT  0 AS list, matches.Matchee_user_id, matches.Match_user_id, matches.Match_id,  profiles.userid, profiles.fb_id, profiles.Main_pic, profiles.Name, profiles.City, profiles.Gender, profiles.Sexual_pref, profiles.Relationship_status, profiles.Birthday \n"
    . "FROM matches \n"
    . "INNER JOIN profiles\n"
    . "ON matches.matchee_user_id = profiles.userid\n"
    . "LEFT JOIN votes\n"
    . "ON matches.match_id = votes.match_id\n"
    . "WHERE Match_user_id = $id \n"
    . "and (votes.match_id IS NULL or \n"
    . "(votes.voter_user_id != ".$User_user_id." and votes.vote = 0 ))\n"
 	. "UNION \n"
  	. "SELECT 1 AS list, 0 as Matchee_user_id, 0 as Match_user_id, 0 as Match_id,  profiles.userid, profiles.fb_id, profiles.Main_pic,  profiles.Name, profiles.City, profiles.Gender, profiles.Sexual_pref, profiles.Relationship_status, profiles.Birthday \n"
 	. "FROM profiles \n"
 	. "LEFT OUTER JOIN matches \n"
 	. "ON profiles.userid = matches.matchee_user_id AND $id = matches.match_user_id\n"
 	. "WHERE matches.Friend_accepted IS NULL   \n"
 	. "AND profiles.Claimed = 1 ".$clause." \n"
 	. "ORDER BY list, userid DESC  \n"
 	. "LIMIT $start, $duration";

 	//echo($query);
   
//if sql query was successful, then save variables. 
		  $loop = mysql_query($query)
		 		or die (mysql_error());

		 		$array["friend_match_list"] ="";
		 		
			while ($row = mysql_fetch_array($loop))
				{
					//check if match is from an 'ask' or if it was generated. This can be done by checking if an Matchee_user_id exists or not. 
					if ($row['Matchee_user_id'] == 0){
						
						//if no matchee userid exists. Save userid generated for this match. 
						$userid = $row['userid'];

						//save the userid as the matchee_user_id for the match. 
						$row['Matchee_user_id'] = $userid;
					}

				     $array["friend_match_list"] = $array["friend_match_list"] ."<li class='span2 friend-match-list-small match-pic' match_id=" . $row['Match_id'] ." userid=" . $row['Matchee_user_id'] ." match_user_id=" . $id ." fb_id=" . $row["fb_id"] ." gender=" . $row["Gender"] ." city='" . $row['City'] ."' relationship_status=" . $row["Relationship_status"] ." name='" . $row['Name'] ."' sexual_pref=" . $row["Sexual_pref"] ." age=". get_age($row['Birthday']) .">
                      <a class='thumbnail' href='profile.php?user_id=" . $row['Matchee_user_id'] ."'>
                		<img src=" . $row['Main_pic'] ." >
              		  </a>
                    </li>";
                     
				};

				return $array;

	 };

 function get_pending_matches($start, $duration) {
 	// query to generate a users pending matches. $id = the user you want to view matches of. 

 	if(!isset($_SESSION))
	  {
	  session_start();
	  } // start session in order to use session user id
 	$User_user_id = $_SESSION['User_user_id'];

		$query ="SELECT m.Matchee_user_id, m.Match_user_id, m.Match_id, p.fb_id , p.Gender, p.fb_id, p.Main_pic, p.City, p.Relationship_status, p.Sexual_pref, p.Name, p.userid, p.Birthday
		FROM matches m
		INNER JOIN profiles p
		ON m.matchee_user_id = p.userid
		LEFT JOIN votes v
		ON m.match_id = v.match_id
		WHERE(Match_user_id = $User_user_id) 
		AND (Friend_accepted = 1) 
		AND (p.userid <> $User_user_id)
		AND
		NOT EXISTS (SELECT match_id FROM votes v
		WHERE
		m.match_id = v.match_id
		AND v.voter_type = 'match')
		UNION
		SELECT  m.Matchee_user_id, m.Match_user_id, m.Match_id, p.fb_id , p.Gender, p.fb_id, p.Main_pic, p.City, p.Relationship_status, p.Sexual_pref, p.Name, p.userid, p.Birthday
		FROM matches m
		INNER JOIN profiles p
		ON m.match_user_id = p.userid
		LEFT JOIN votes v
		ON m.match_id = v.match_id
		WHERE(Matchee_user_id = $User_user_id) 
		AND (Friend_accepted = 1) 
		AND (p.userid <> $User_user_id)
		AND
		NOT EXISTS (SELECT match_id FROM votes v
		WHERE
		m.match_id = v.match_id
		and v.voter_type = 'matchee')
		LIMIT $start, $duration";


//if sql query was successful, then save variables. 
		  $loop = mysql_query($query)
		 		or die (mysql_error());

		 		$array["pending_match_list"] ="";
		 		
			while ($row = mysql_fetch_array($loop))
				{
				     $array["pending_match_list"] = $array["pending_match_list"] . "<li class='span2 friend-match-list-small match-pic' match_id=" . $row['Match_id'] ." matchee_user_id=" . $row['Matchee_user_id'] ." match_user_id=" . $row['Match_user_id'] ." fb_id=" . $row["fb_id"] ." userid=" . $row["userid"] ." gender=" . $row["Gender"] ." city='" . $row['City'] ."' relationship_status=" . $row["Relationship_status"] ." name='" . $row['Name'] ."' sexual_pref=" . $row["Sexual_pref"] ." age=". get_age($row['Birthday']) .">
                      <a class='thumbnail' href='profile.php?user_id=" . $row['Matchee_user_id'] ."'>
                		<img src=" . $row['Main_pic'] .">
              		  </a>
                    </li>";
				};

				return $array;

	 };


	 function get_likely_matches($start, $duration) {
 	// query to generate a users pending matches. $id = the user you want to view matches of. 

 	if(!isset($_SESSION))
	  {
	  session_start();
	  } // start session in order to use session user id
 	$User_user_id = $_SESSION['User_user_id'];
 	$this_profile = get_profile($User_user_id);
 	$this_Gender = $this_profile['Gender'];
 	$this_Ethnicity = $this_profile['Ethnicity'];
 	$this_Religion = $this_profile['Religion'];
 	$this_Politics = $this_profile['Politics'];
 	$this_Age = get_age($this_profile['Birthday']);
 	$this_City_lat = $this_profile['Lat_city'];
 	$this_City_long = $this_profile['Long_city'];

 	//convert gender into a value that can be compared to the taste record for a user. 
	 	if ($this_Gender == 'Male') {
	 		//Male only
	 		 $this_Gender = 'Male only';
	 	}
	 	elseif 
	 		($this_Gender == 'Female') {
	 		//Female only
	 		$this_Gender = 'Female only';
	 	}

 	
    $query = "SELECT p.userid, p.Main_pic, p.fb_id, p.Gender, p.Relationship_status, p.Sexual_pref, p.Birthday, p.City, p.Name\n"
    . "FROM `tastes` t \n"
    . "INNER JOIN `profiles` p \n"
    . "ON p.userid = t.User_id_friend \n"
    . "WHERE (t.Gender LIKE '%$this_Gender%' OR t.Gender = 'Female and Male') \n"
    . "AND (t.Ethnicity LIKE '%$this_Ethnicity%' OR t.Ethnicity = '_empty') \n"
    . "AND (t.Religion LIKE '%$this_Religion%' OR t.Religion = '_empty')\n"
    . "AND (t.Politics LIKE '%$this_Politics%' OR t.Religion = '_empty')\n"
    . "AND t.Min_Age <= '$this_Age' \n"
    . "AND t.max_Age >= '$this_Age'\n"
	. "AND ($this_City_lat BETWEEN Lat_city_min AND Lat_city_max)\n"
    . "AND ($this_City_long BETWEEN Long_city_min AND Long_city_max)\n"
    . "AND (p.userid != $User_user_id )\n"
    . "LIMIT $start, $duration\n";

//echo $query;
//if sql query was successful, then save variables. 
		  $loop = mysql_query($query)
		 		or die (mysql_error());

		 		$array["likely_match_list"] ="";
		 		
			while ($row = mysql_fetch_array($loop))

				{
					
				     $array["likely_match_list"] = $array["likely_match_list"] ."<li class='span2 friend-match-list-small match-pic' match_id='0' userid=" . $row['userid'] ." fb_id=" . $row["fb_id"] ." gender=" . $row["Gender"] ." city='" . $row['City'] ."' relationship_status=" . $row["Relationship_status"] ." name='" . $row['Name'] ."' sexual_pref=" . $row["Sexual_pref"] ." age=". get_age($row['Birthday']) .">
                      <a class='thumbnail' href='profile.php?user_id=" . $row['userid'] ."'>
                		<img src=" . $row['Main_pic'] ." >
              		  </a>
                    </li>";
             
				};

				return $array;

	 };


	 function get_messages($start, $duration, $type) {
 	// query to generate a users messages. $type describes if you want users' incoming or sent messages

 	$User_user_id = $_SESSION['User_user_id'];

 	if ($type == 'incoming'){

 		//query for this users incoming messages
 	$query = "SELECT m.Creation_date, m.Message_id, m.Sender_user_id, m.Message_preview, m.Message, m.Read, p.fb_id, p.userid, p.Name, p.Main_pic, p.Gender, p.Sexual_pref, p.Relationship_status, p.City, p.Birthday\n"
    . "FROM `messages` AS m\n"
    . "JOIN `profiles` AS p ON m.Sender_user_id = p.userid \n"
    . "WHERE (m.Recipient_deleted != 1) and (m.Recipient_user_id = $User_user_id) ORDER BY m.Message_id DESC LIMIT $start, $duration ";
 	}
 	else{

 		//query for this users sent messages
 	$query = "SELECT m.Creation_date, m.Message_id, m.Sender_user_id, m.Message_preview, m.Message, m.Read, p.fb_id, p.userid, p.Name, p.Main_pic, p.Gender, p.Sexual_pref, p.Relationship_status, p.City, p.Birthday\n"
    . "FROM `messages` AS m\n"
    . "JOIN `profiles` AS p ON m.Recipient_user_id = p.userid \n"
    . "WHERE (m.Recipient_deleted != 1) and (m.Sender_user_id = $User_user_id) ORDER BY m.Message_id DESC LIMIT $start, $duration ";
 	}

    


//if sql query was successful, then save variables. 
		  $loop = mysql_query($query)
		 		or die (mysql_error());

		 		$array["my_messages"] ="";
		 		
			while ($row = mysql_fetch_array($loop))
				{
					$date = date_create($row['Creation_date']);
					$formated_date = date_format($date, 'M jS, Y');

				     $array["my_messages"] = $array["my_messages"] ."
                      <tr message_id=" . $row['Message_id'] ." >
                            <td class='span4'>
                                <a href='profile.php?user_id=" . $row['userid'] ."'>
                                  <img id='message_pic' class='span1 message_img' src=" . $row['Main_pic'] ." >
                                
                                <span class='medium-text first-name'> " . $row['Name'] ."</span><br>
                                <span class='blue'> " . get_age($row['Birthday']) ."/" . $row['Gender'] ."/" . $row['Sexual_pref'] ."/" . $row['Relationship_status'] ."</span>
                                <span class='blue'> " . $row['City'] ." </span>
                                </a>
                            </td>                           
                              <td id='message-text' class='span4 vertical_middle'> 
                                <a class='message-preview' sender_main_pic=" . $row['Main_pic'] ." message_id=" . $row['Message_id'] ." read=" . $row['Read'] ." href='#myModal' role='button' data-toggle='modal' complete-message='" . $row['Message'] ."' name='" . $row['Name'] ."' fb_id='" . $row['fb_id'] ."' user_id='" . $row['userid'] ."' creation_date='" . $formated_date ."' >
                                  <p class='message-show'>" . $row['Message_preview'] ."</p></td>
                                </a>
                            <td class='span4 vertical_middle row-fluid'>
                              <div class='span6' id='message_date'><p>
                                " . $formated_date ."
                              </p></div>
                              <div class='span6' id='delete'>
                                <label class='checkbox'>
                                  <input type='checkbox'> 
                                    <a href='#'> 
                                      <i class='icon-trash icon-large'></i>
                                    </a>
                                </label>
                              </div>
                            </td>                     
                          </tr>";
				};

				return $array;

	 };


?>