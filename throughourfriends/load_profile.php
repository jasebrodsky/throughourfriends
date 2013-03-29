<?php

require 'connect.inc.php';
require 'core.inc.php';

//call get friend matches function in order to put 5 new matches into match-viewer based on userid of friend. 
if (isset($_GET['userid'])) {
  
  $this_profile = get_profile(($_GET['userid']));

  echo "<div id='profile'>
               <div id='profile-top'>
                 <div id='friend-summary'>
                    <ul class='unstyled' id='profile-summary'>
                      <li><h2 class='orange no-margin-bottom'>".$this_profile['Name']."</h2></li>
                      <li><h4 class='blue no-line-height'>".$this_profile['Age']."/".$this_profile['Name']."/".$this_profile['Sexual_pref']."/".$this_profile['Relationship_status']." </h4> </li> 
                      <li><h4 class='blue'> ".$this_profile['City']." </h4`> </li>
                    </ul>
                  </div>
                  
                  
                  <div class='row-fluid' id='profile-photos'>
                    <ul class='thumbnails'>
                      <li class='span3'>
                                <a href='#' class='thumbnail'>
                                <img src='https://graph.facebook.com/".$this_profile['fb_id']."/picture?width=200&height=200'>
                                </a> 
                       </li>
                 <li class='span3 profile-pic'>
                                <a href='#' class='thumbnail'>
                                <img src='assets/img/NoImage.png' alt=''>
                                </a> 
                       </li>
                       <li class='span3 profile-pic'>
                                <a href='#' class='thumbnail'>
                                <img src='assets/img/NoImage.png' alt=''>
                                </a> 
                       </li>
                       
                       <li id='profile-pic-3' class='span3 pagination-right'>
                            <a href='#myModal' role='button' data-toggle='modal'>
                                  <button id='ask-button' class='btn btn-primary ' type='button'>ASK!</button>
                                </a>
                                <a href='#' class='thumbnail'>
                                <img src='assets/img/NoImage.png' alt=''>
                                </a> 
                       </li>               
        
                       </div>          
                    </ul>
            
                 
                 
                 </div>
                <div class='row'>
                  <div class='span9'>
                    <h2 id='describe-text' class='pagination-left'><span class='orange'> Can be described as: </span></h2>
                  </div>
                </div>  
                <div id='basics'>
                  <div class='row-fluid'>
                    <div id='basics-table' class='span12'>
                      <table class='table table-striped'>
                        <tbody>
                          <tr>
                            <td><strong>Ethnicity:</strong></td>
                            <td><em>".$this_profile['Ethnicity']."</em></td>
                            <td><strong>Drinks:</strong></td>
                            <td><em>".$this_profile['Drinks']."</em></td>
                          </tr>
                          <tr>
                            <td><strong>height:</strong></td>
                            <td><em>".$this_profile['Height']."</em></td>
                            <td><strong>Smokes:</strong></td>
                            <td><em>".$this_profile['Smokes']."</em></td>
                          </tr>
                          <tr>
                            <td><strong>Body Type:</strong></td>
                            <td><em>".$this_profile['Body_type']."</em></td>
                            <td><strong>Drugs:</strong></td>
                            <td><em>".$this_profile['Drugs']."</em></td>
                          </tr>
                          <tr>
                            <td><strong>Diet:</strong></td>
                            <td><em>".$this_profile['Diet']."</em></td>
                            <td><strong>Kids:</strong></td>
                            <td><em>".$this_profile['Kids']."</em></td>
                          </tr>
                          <tr>
                            <td><strong>Education:</strong></td>
                            <td><em>".$this_profile['Education']."</em></td>
                            <td><strong>Hometown:</strong></td>
                            <td><em>".$this_profile['Hometown']."</em></td>
                          </tr>
                          <tr>
                            <td><strong>Religion:</strong></td>
                            <td><em>".$this_profile['Religion']."</em></td>
                            <td><strong>Income:</strong></td>
                            <td><em>".$this_profile['Income']."</em></td>
                          </tr>
                          <tr>
                            <td><strong>Languages:</strong></td>
                            <td><em>".$this_profile['Languages']."</em></td>
                           
                            <td><strong>Sign:</strong></td>
                            <td><em>".$this_profile['Sign']."</em></td>
                          </tr>
                          <tr>
                            <td><strong>Politics:</strong></td>
                            <td><em>".$this_profile['Politics']."</em></td> 
                            <td><strong>Profession:</strong></td>
                            <td><em>".$this_profile['Profession']."</em></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class='row-fluid'>
                    <div class='span12'>
                      <h2 id='describe-text' class='pagination-left'><span class='orange'> What their friends' say: </span></h2>
                    </div>
                  </div>
                  <div class='row-fluid no-list-style'>
                    ".$this_profile['friends_say']."
                </div>";

};
?>