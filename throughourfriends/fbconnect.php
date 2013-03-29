<?php
require 'connect.inc.php';
require 'assets/php/facebook/facebook.php'; //include the facebook php sdk in order to intialize the facebook object
require 'assets/php/facebook/functions.php';
require 'assets/php/facebook/fbappconfig.php';




# Creating the facebook object
  $facebook = new Facebook(array(
  'appId'  => $_SESSION['app_id'],
  'secret' => $_SESSION['secret'],
  'cookie' => true,
  ));

$accessToken = $facebook->getAccessToken();
$facebook->setAccessToken($accessToken);

$user = $facebook->getUser();

if ($user) {
  try {
    // Proceed knowing you have a logged in user who's authenticated.
    $user_profile = $facebook->api('/me');
  } catch (FacebookApiException $e) {
    echo($e);
    $user = null;
  }


    if (!empty($user_profile )) {
        # User info ok? Let's print it (Here we will be adding the login and registering routines)
  
        $username = $user_profile['name'];
        $uid = $user_profile['id'];
        $email = $user_profile['email'];
        $user = new User();
        $userdata = $user->checkUser($uid, $username, $email);
        if(!empty($userdata)){
            session_start();
            $_SESSION['User_user_id'] = $userdata['userid'];
            $_SESSION['fb_id'] = $uid;
            $_SESSION['Name'] = $userdata['Name'];
            $_SESSION['token'] = ($_SESSION["fb_".$_SESSION['app_id']."_access_token"]);
           

            //$verified = $userdata['Verified'];
            //$claimed = $userdata['Claimed'];

            $_SESSION['Verified'] = $userdata['Verified'];   
            $_SESSION['Claimed'] = $userdata['Claimed'];
            $_SESSION['Matchable_status'] = $userdata['Matchable_status'];
            $_SESSION['Main_pic'] = $userdata['Main_pic'];

            // [] matchmaker (profile that has never been verified..verifed = 0)                   --> direct to friend-select.php
            // [] matchee (profile that has been verified (but not claimed)...verified = 1)        --> direct to my-profile.php
            // [] existing user (profile that has been claimed...claimed = 1)                      --> direct to my-friends.php
    
            if ($_SESSION['Verified'] == '0') {
                header("Location: friend-select.php");
                }

            else if ($_SESSION['Verified'] == '1' AND $_SESSION['Claimed'] == '0') {
                header("Location: my-profile.php");
                }

            else if ($_SESSION['Claimed'] == '1') {
                header("Location: my-friends.php");
                }



        }
    } else {
        # For testing purposes, if there was an error, let's kill the script
        die("There was an error.");
    }
} else {
    # There's no active session, let's generate one
    $login_url = $facebook->getLoginUrl(array( 'scope' => 'email, user_likes, friends_birthday, friends_hometown, friends_location, friends_photos, user_photos, user_photo_video_tags, friends_photo_video_tags'));
    header("Location: " . $login_url);

}
?>