
<div class="pagination-centered">

                <!-- <h4><span class="blue"> Click the save button at the bottom if everything looks fine</span></h4> -->
                <h2 class="blue"> <?php 
                //check if user has claimed there profile
                if ($Claimed == 0){
                  //if the profile is not claimed, tell them to claim their profile
                  echo('Click the claim button at the bottom in order to claim your profile and see your matches');
                } else{
                  //else, profile must be claimed, tell them to save their profile instead of claiming it. 
                   echo('Click the save button at the bottom if everything looks fine');
                }
                ?>


              </h2>
              </div>
              
            </div> 
             <div id="profile">
               <div id="profile-top">
                 <div id="friend-summary">
                    <ul class="unstyled" id="profile-summary">
                      <li><h2 class="orange no-margin-bottom"><?php echo $this_profile['Name']?></h2> </li>
                      <li><span class="blue bold"> 
                        <span id="tb-age"><?php echo $this_profile['Age']?></span>/<span id="tb-gender"><?php echo $this_profile['Gender']?></span>/<span id="tb-sexual_pref"><?php echo $this_profile['Sexual_pref']?></span>/                        <span id="tb-relationship_status"><?php echo $this_profile['Relationship_status']?></span></span> </li> 
                      <li><span class="blue bold"><span id="tb-city"><?php echo $this_profile['City'] ?></span></span></li>
                    </ul>
                  </div>
                  <div class="row-fluid" id="profile-photos">
                                <div id="photos" class="row-fluid">
                                  <ul class="thumbnails">
                                    <li class="span3 my-profile-pic" style="margin-top: 0px;">
                                              <a id="main-pic-link" href=<?php echo $this_profile['Main_pic'] ?> class="gallery thumbnail cboxElement">
                                                <img id="main-pic" class="big_pic" src=<?php echo $this_profile['Main_pic'] ?> </img>
                                              </a>
                                              <a href="#myModal" data-toggle="modal"> <button id="main-pic-button" class="pic_btn btn btn-primary" type="button">Change photo</button></a>
                                     </li>
                                     <li class="span3 my-profile-pic">
                                              <a id="first-pic-link" href=<?php echo $this_profile['First_pic'] ?> class="background-color-black gallery thumbnail cboxElement">
                                              <img id="first-pic" class="profile_pic" src=<?php echo $this_profile['First_pic'] ?> alt=""> 
                                              </a> 
                                              <a href="#myModal" data-toggle="modal"> <button id="first-pic-button" class="pic_btn btn btn-primary" type="button">Change photo</button></a>
                                     </li>
                                     <li class="span3 my-profile-pic">
                                              <a id="second-pic-link" href=<?php echo $this_profile['Second_pic'] ?> class="background-color-black gallery thumbnail cboxElement">
                                              <img id="second-pic" class="profile_pic" src=<?php echo $this_profile['Second_pic'] ?> alt="">
                                              </a> 
                                              <a href="#myModal" data-toggle="modal"> <button id="second-pic-button" class="pic_btn btn btn-primary" type="button">Change photo</button></a>
                                     </li>
                                     
                                     <li class="span3 my-profile-pic">
                                          
                                              <a id="third-pic-link" href=<?php echo $this_profile['Third_pic'] ?> class="background-color-black gallery thumbnail cboxElement">
                                              <img id="third-pic" class="profile_pic" src=<?php echo $this_profile['Third_pic'] ?> alt="">
                                              </a> 
                                              <a href="#myModal" data-toggle="modal"> <button id="third-pic-button" class="pic_btn btn btn-primary" type="button">Change photo</button></a>
                                     </li>               
                      
                                  </ul>
                            </div>
                          </div>
                    
     			        </div>
                 </div>
                <div class="row-fluid">
                  <div class="span12">
                    <h2 id="describe-text" class="pagination-left"><span class="orange"> Can be described as: </span></h2>
                    <a href="#myModal">
                      <a href="#myModal" data-toggle="modal" data-target="#modal_profile"> <button id="edit-basics-button"class="btn btn-primary profile-button pull-right" type="button">Edit</button></a>
                    </a>
                  </div>
                </div>	
                <div id="basics">
                  <div class="row-fluid">
                    <div id="basics-table" class="span12">
                      <table class="table table-striped">
                        <tbody>
                          <tr>
                            <td><strong>Ethnicity:</strong></td>
                            <td id="tb-ethnicity"><em><?php echo $this_profile['Ethnicity']?></em></td>
                            <td><strong>Drinks:</strong></td>
                            <td id="tb-drinks"><em><?php echo $this_profile['Drinks']?></em></td>
                          </tr>
                          <tr>
                            <td><strong>height:</strong></td>
                            <td id="tb-height"><em><?php echo $this_profile['Height']?></em></td>
                            <td><strong>Smokes:</strong></td>
                            <td id="tb-smokes"><em><?php echo $this_profile['Smokes']?></em></td>
                          </tr>
                          <tr>
                            <td><strong>Body Type:</strong></td>
                            <td id="tb-body_type"><em><?php echo $this_profile['Body_type']?></em></td>
                            <td><strong>Drugs:</strong></td>
                            <td id="tb-drugs"><em><?php echo $this_profile['Drugs']?></em></td>
                          </tr>
                          <tr>
                            <td><strong>Diet:</strong></td>
                            <td id="tb-diet"><em><?php echo $this_profile['Diet']?></em></td>
                            <td><strong>Kids:</strong></td>
                            <td id="tb-kids"><em><?php echo $this_profile['Kids']?></em></td>
                          </tr>
                          <tr>
                            <td><strong>Education:</strong></td>
                            <td id="tb-education"><em><?php echo $this_profile['Education']?></em></td>
                            <td><strong>Hometown:</strong></td>
                            <td id="tb-hometown"><em><?php echo $this_profile['Hometown']?></em></td>
                          </tr>
                          <tr>
                            <td><strong>Religion:</strong></td>
                            <td id="tb-religion"><em><?php echo $this_profile['Religion']?></em></td>
                            <td><strong>Income:</strong></td>
                            <td id="tb-income"><em><?php echo $this_profile['Income']?></em></td>
                          </tr>
                          <tr>
                            <td><strong>Languages:</strong></td>
                            <td id="tb-languages"><em><?php echo $this_profile['Languages']?></em></td>                           
                            <td><strong>Sign:</strong></td>
                            <td id="tb-sign"><em><?php echo $this_profile['Sign']?></em></td>
                          </tr>
                          <tr>
                            <td><strong>Politics:</strong></td>
                            <td id="tb-politics"><em><?php echo $this_profile['Politics']?></em></td>	
                            <td><strong>Profession:</strong></td>
                            <td id="tb-profession"><em><?php echo $this_profile['Profession']?></em></td>
                          </tr>
                          
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="row-fluid">
                    <div class="span12">
                      <h2 id="describe-text" class="pagination-left"><span class="orange"> What their friends' say: </span></h2>
                      
                    </div>
                  </div>
                  <div id="friend-error" class="alert alert-error" style="display:none;" >  
                    <a class="close close_btn" >×</a>   
                    <strong>Sorry</strong>, You must have atleast one friend to continue.
                  </div>
                  <div class="row-fluid no-list-style">     
                     
     
                     <?php echo $this_profile['friends_say'] ?>




        

                  </div>
                </div>
             </div><!--/span9-->

             <div class="row pagination-centered">
              <div class=span9>
                <div id="button-text">
                  <h2 class="blue"> <?php 
                          //check if user has claimed there profile
                          if ($Claimed == 0){
                            //if the profile is not claimed, tell them to claim their profile
                            echo('Click claim in order in order to see your matches');
                          } else{
                            //else, profile must be claimed, tell them to save their profile instead of claiming it. 
                             echo('Click save if everything looks fine');
                          }
                          ?></h2>
                </div>
                <div class="age-error alert alert-error" style='display:none'>  
                  <a class="close close_btn" >×</a>   
                  <strong>Sorry</strong>, You must be 18 years or older to continue. <a href="#myModal" data-toggle="modal" data-target="#modal_profile"> Click here </a>to edit your birthday.
                </div>
                <a>
                
                <button id="save-btn" class="btn btn-large btn-success" type="button" claimed='<?php echo($Claimed) ?>'>

                          <?php 
                            //check if user has claimed there profile
                            if ($Claimed == 0){
                              //if the profile is not claimed, tell them to claim their profile
                              echo('Claim');
                            } else{
                              //else, profile must be claimed, tell them to save their profile instead of claiming it. 
                               echo('Save');
                            }
                            ?>
                          </button>
                </a>
                <br></br>
                <div id="success-message">
                </div>
              </div>
             </div>