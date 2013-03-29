<?php

require 'connect.inc.php';
//require 'core.inc.php';

if(!isset($_SESSION))
  {
  session_start();
  }
  $User_user_id = $_SESSION['User_user_id'];

    // builds the query

    $query = "SELECT matches.Matchee_user_id, matches.Match_user_id, matches.Match_id, profiles.fb_id, profiles.Birthday, profiles.Name, profiles.Gender, profiles.Sexual_pref, profiles.Relationship_status, profiles.City, profiles.Main_pic, profiles.First_pic, profiles.Second_pic, profiles.Third_pic \n"
    . "FROM matches\n"
    . "INNER JOIN profiles\n"
    . "ON matches.matchee_user_id = profiles.userid\n"
    . "WHERE Match_user_id = $User_user_id and `Match_accepted` = 1 and `Matchee_accepted` = 1 \n"
    . "and Friend_accepted = 1\n"
    . "UNION\n"
    . "SELECT matches.Matchee_user_id, matches.Match_user_id, matches.Match_id, profiles.fb_id, profiles.Birthday, profiles.Name, profiles.Gender, profiles.Sexual_pref, profiles.Relationship_status, profiles.City, profiles.Main_pic, profiles.First_pic, profiles.Second_pic, profiles.Third_pic \n"
    . "FROM matches\n"
    . "INNER JOIN profiles\n"
    . "ON matches.match_user_id = profiles.userid\n"
    . "WHERE Matchee_user_id = $User_user_id and `Match_accepted` = 1 and `Matchee_accepted` = 1 \n"
    . "and Friend_accepted = 1 LIMIT 0, 30 ";



//if sql query was successful, then save variables. 
      $loop = mysql_query($query)
        or die (mysql_error());

        $array["active-matches"] ="";
        
      while ($row = mysql_fetch_array($loop))
        {
            // determine if user is the match or matchee in order to do correctly link to his user_id. 
               if ($row['Match_user_id'] == $User_user_id) 
                    {
                    $link = $row['Matchee_user_id']; //use the matchee_user_id in the link
                    }
                   else 
                   {
                    $link = $row['Match_user_id']; //use the matchee_user_id in the link;
                   }


             $array['active-matches'] = $array['active-matches'] ."<li class='well active_match' match_id='".$row['Match_id']."'match_user_id='".$row['Match_user_id']."' matchee_user_id='".$row['Matchee_user_id']."' name='".$row['Name']."' fb_id='".$row['fb_id']."'>
               
               <div id='profile-top'>
                
                 <div id='friend-summary'>
                    <ul class='unstyled' id='profile-summary'>
                      <li><h2 class='orange no-margin-bottom'>".$row['Name']."</h2></li>
                      <li><span class='blue'>".get_age($row['Birthday'])."/".$row['Gender']."/".$row['Sexual_pref']."/".$row['Relationship_status']." </span> </li> 
                      <li><span class='blue'> ".$row['City']." </span> </li>
                    </ul>
                     <a  href='#compose-modal' role='button' data-toggle='modal'>
                      <button name='To: ".$row['Name']."' match_user_id='".$row['Match_user_id']."' matchee_user_id='".$row['Matchee_user_id']."' style='width:200px;' id='send_message' class='send_message btn btn-success ' type='button' >Message</button>
                    </a>


              



                  </div>
                  <div class='row-fluid' id='profile-photos'>
                    <ul class='thumbnails'>
                      <li class='span3 '>
                                
                                <a rel='group1' id='main-pic-link' href='profile.php?user_id=" . $link ."' class='thumbnail background-color-black' target='_blank'>
                                  <img class='big_pic' src='" . $row['Main_pic'] ."'>
                                </a>
                       </li>
                       <li class='span3 profile-pic hidden-phone'>
                                <a rel='group1' class='gallery thumbnail background-color-black' href='profile.php?user_id=" . $link ."' >
                                <img id='first-pic' class='profile_pic' src='" . $row['First_pic'] ."'>
                                </a> 
                       </li>
                       <li class='span3 profile-pic hidden-phone'>
                                <a rel='group1' class='gallery thumbnail background-color-black' href='profile.php?user_id=" . $link ."' >
                                <img  class='profile_pic' src='" . $row['Second_pic'] ."'>
                                </a> 
                       </li>
                       
                       <li  class='span3 profile-pic hidden-phone'>

                                
                                <a rel='group1' class='gallery thumbnail background-color-black' href='profile.php?user_id=" . $link ."' >
                                <img id='third-pic' class='profile_pic' src='" . $row['Third_pic'] ."'>
                                </a> 
                       </li>               
        
                       </div>          
                    </ul>
                 </li>";
        };
      
  
    //return $array;
    echo $array['active-matches'];
  
                
?>