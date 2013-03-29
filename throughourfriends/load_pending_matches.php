<?php

require 'connect.inc.php';
require 'core.inc.php';
//call get friend matches function in order to put 5 new matches into match-viewer based on userid of friend. 
if ((isset($_GET['start'])) and (isset($_GET['duration']))) {
	
	$start = ($_GET['start']);
	$duration = ($_GET['duration']);

	//session_start(); // start session in order to use session user id
 	//$User_user_id = $_SESSION['User_user_id'];

 	$pending_matches = get_pending_matches($start, $duration);
	echo $pending_matches['pending_match_list'];


	 };
?>