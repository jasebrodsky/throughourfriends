
<?php

require 'connect.inc.php';
require 'core.inc.php';

// get all variables sent in the GET array relevent to the match being saved. 
if (isset  ($_GET['matchmaker']) || ($GET['matchee']) || ($GET['match']) ) {

	//save variabels into local variables to use in save_match function. 
	$Matchmaker = check_input($_GET['matchmaker']);
	$Matchee = check_input($_GET['matchee']);
	$Match = check_input($_GET['match']);
  
  	//save the returned value of the save_match fuction into a variable
	$match_saved = save_match($Matchmaker, $Matchee, $Match);

		//check if the returned value of the save_match funtion is true. If so echo a success message. 
		if ($match_saved = true) {
			
			//save id of this match to use later...if needed. 
			//$match_id = (mysql_insert_id());

			echo 
			"<h5 id='ask-message'style='display: inline;'>thanks, we'll let you know if their friends agree </h5>
	    <a href='#'>
	      <button id='after-ask-button' class='btn btn-primary' data-dismiss='modal' aria-hidden='true'>Ok</button>
	    </a>";

		}	//else echo the error returned by the save_match function. 
			else {
			echo $match_saved;
	} 
};
?>


