<?php

require 'connect.inc.php';
require 'core.inc.php';
$count = check_input(($_GET['Count']));
$count = $count * 5;
$order_by = check_input(($_GET['Order_by']));

//format order by into a sql friends format, so i can insert it into the sql query
if ($order_by == 'Recently created'){
  $Order = 'ORDER BY Creation_date DESC';
}

elseif ($order_by == 'Totally random'){
  $Order = 'ORDER BY RAND()';
}

elseif ($order_by == 'Recently logged in'){
  $Order = 'ORDER BY Last_login DESC';
}

elseif ($order_by == 'Distance'){
  $Order = 'ORDER BY Creation_date ASC';
}

elseif ($order_by == 'Friends of friends'){
  $Order = 'ORDER BY Creation_date ASC';
}






    //put on get variables into a conditions array using the function search_results();
    $conditions = (search_results());


    //if there are conditions, save variable as $clause
    if(count($conditions) > 0) {
        $clause = "AND " . implode (" AND ", $conditions)."";

    }
    //if there arent any conditions, save $clause as nothing
    else {
      $clause = "";
    }

    //echo($clause);

    // count total records
    $query2 = "SELECT COUNT(userid) FROM profiles WHERE Claimed = 1 AND Matchable_status = 1 ".$clause." ";

    //count total returned records
    $result = mysql_query($query2)
        or die (mysql_error());

    //save $tot as a total count of all returned profiles. This will be used to know when all profiles have been returned. 
    $tot = mysql_result($result, 0);


     //if there are conditions, save variable as $clause
    if(count($conditions) > 0) {
        $clause = "AND " . implode (" AND ", $conditions)."";
    }
    //if there arent any conditions, save $clause as nothing
    else {
      $clause = "";
    }


    // builds the query
    $query1 = "SELECT * FROM profiles WHERE Claimed = 1 AND Matchable_status = 1 ".$clause." ".$Order."  LIMIT $count, 5 ";
 
    //if sql query was successful, then save variables. 
      
      //echo ($query1);
      

      $loop = mysql_query($query1)
        or die (mysql_error());

        
        $array["search-results"] ="";
        
        //check if any results were returned before looping through results. If no results were returned show message. 
        if (!mysql_num_rows($loop)){
           $array['search-results'] = "<h3 class='pagination-centered'> Sorry, no more results <br> <a href='#Top'>click here</a> to search again</h3>";
          }else{

          
        
      while ($row = mysql_fetch_array($loop))
        {



             $array['search-results'] = $array['search-results'] ."<li class='well' tot='".$tot."' userid='".$row['userid']."' name='".$row['Name']."' fb_id='".$row['fb_id']."'>
               <div id='profile-top'>
                 <div id='friend-summary'>
                    <ul class='unstyled' id='profile-summary'>
                      <li><h2 class='orange no-margin-bottom'>".$row['Name']."</h2></li>
                      <li><span class='blue'>".get_age($row['Birthday'])."/".$row['Gender']."/".$row['Sexual_pref']."/".$row['Relationship_status']." </span> </li> 
                      <li><span class='blue'> ".$row['City']." </span> </li>
                    </ul>
                  </div>
                  
                  
                  <div class='row-fluid' id='profile-photos'>
                    <ul class='thumbnails'>
                      <li class='span3'>
                                <a style='min-height:200px;' href='profile.php?user_id=" . $row['userid'] ."' class='thumbnail background-color-black' >
                                  <img class='big_pic' src='" . $row['Main_pic'] ."'>
                                </a>
                       </li>
                 <li class='hidden-phone span3 profile-pic'>
                                <a href='profile.php?user_id=" . $row['userid'] ."' class='thumbnail background-color-black'>
                                <img class='profile_pic' src='" . $row['First_pic'] ."' alt=''>
                                </a> 
                       </li>
                       <li class='hidden-phone span3 profile-pic'>
                                <a href='profile.php?user_id=" . $row['userid'] ."' class='thumbnail background-color-black'>
                                <img class='profile_pic' src='" . $row['Second_pic'] ."'>
                                </a> 
                       </li>
                       
                       <li class='hidden-phone span3 profile-pic'>
                                <a href='profile.php?user_id=" . $row['userid'] ."' class='thumbnail background-color-black'>
                                <img class='profile_pic' src='" . $row['Third_pic'] ."'>
                                </a> 
                       </li>               
        
                       </div>          
                    </ul>
                 </li>
                 <br>";
        };
      }
  
    //return $array;
    echo $array['search-results'];
  
                
?>