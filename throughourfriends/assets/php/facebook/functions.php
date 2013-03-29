<?php

//require 'dbconfig.php';
require 'connect.inc.php';

class User {
    //check if user already has an account already
    function checkUser($uid, $username,$email) 
	{
        $query = mysql_query("SELECT * FROM `profiles` WHERE fb_id = '$uid'") or die(mysql_error());
        $result = mysql_fetch_array($query);
        if (!empty($result)) {
            # User is already present, do nothing
        } else {

            $Main_pic = "http://graph.facebook.com/".$uid."/picture?type=large";


            #user not present. Insert a new Record
            $query = mysql_query("INSERT INTO profiles ( fb_id, Name, Email, Main_pic) VALUES ('$uid', '$username','$email', '$Main_pic')") or die(mysql_error());   
            $query = mysql_query("SELECT * FROM `profiles` WHERE fb_id = '$uid'");
            $result = mysql_fetch_array($query);
            $query = mysql_query("INSERT INTO settings ( Userid) VALUES ($result[userid])") or die(mysql_error()); 
            return $result;
        }

        $query = mysql_query("UPDATE profiles SET Last_login = CURRENT_TIMESTAMP WHERE fb_id = '$uid'") or die(mysql_error());
        return $result;
    }

    

}

?>
