 <?php
// connection error message
 $conn_error = 'Could not connect here baby';

// connection variables
$mysql_host = 'localhost';
$mysql_user = 'root';
$mysql_pass = '';
$mysql_db = 'a_database';

//if connection to mysqyl server and db is not successful kill page and show error, else show connected
if (!@mysql_connect($mysql_host, $mysql_user, $mysql_pass) or !@mysql_select_db($mysql_db)) {
	die($conn_error);
}




?>