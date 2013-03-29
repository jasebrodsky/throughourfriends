<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Verify</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

   <!-- Le styles -->
    <link rel="stylesheet" href="assets/css/colorbox.css" /> 
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/css/font-awesome.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/chosen.css" rel="stylesheet">
    <link href="assets/css/jquery-ui.css" rel="stylesheet">
    <link href="assets/css/footer.css" rel="stylesheet" type="text/css">
    <link href="assets/css/bootstrap-responsive.css" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Quicksand:300,400,700" rel="stylesheet" type="text/css">


    <style type="text/css">
      
      .sidebar-nav {
        padding: 9px 0;
      }
    </style>
    

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">

</head>

  <body>
    <?php include_once("analyticstracking.php"); ?>
  	<div id="wrap">
      <?php 
      include ("header.php"); 
      require 'connect.inc.php';
      require 'core.inc.php';
      require 'assets/php/facebook/fbappconfig.php';
      $fb_app_id = $_SESSION['app_id'];

      $User_userid = $_SESSION['User_user_id'];
      $Friend_userid = $_SESSION['friend_userid'];
      $friend_fb_id = $_SESSION['friend_fb_id'];
      $session_user_name = $_SESSION['Name'];
      $friend_info = get_friends_fb_info($friend_fb_id);
      $this_profile = get_profile($Friend_userid);
      $this_tastes = get_tastes($User_userid, $Friend_userid);
      $User_fb_id = $_SESSION['fb_id'];

      if ($friend_info['sex'] === 'male') {
            $hisHer = 'his';
            $heShe = 'he';
          } else {
            $hisHer = 'her';
            $heShe = 'she';
          }
  
      //convert last name to intial
      $last_intial = $this_profile['Last_name'][0];

      $name = $this_profile['First_name']." ".$last_intial.".";
     
          

     


      ?>
      <div class="container-fluid">
          <div class="row">
            <?php include ("nav.php"); ?>
          <div class="span10">
            <div class="row">
              <div id="top-text" class="pagination-centered">
	              <h2><span class="blue"> Verify <?php echo $name ?>'s profile below? </span></h2>
	              <h4><span class="blue"> (Click the verify button at the bottom if everything looks fine) </span></h4>
			  
              
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
                                              <a id="main-pic-link" href=<?php echo $this_profile['Main_pic'] ?> class="thumbnail cboxElement">
                                              <img id="main-pic" class="big_pic" src=<?php echo $this_profile['Main_pic'] ?>
                                              </a>
                                              <a href="#myModal" data-toggle="modal"> <button id="main-pic-button" class="change-btn pic_btn btn btn-primary" type="button">Change photo</button></a>
                                     </li>
                                     <li class="span3 my-profile-pic">
                                              <a id="first-pic-link" href=<?php echo $this_profile['First_pic'] ?> class="background-color-black gallery thumbnail cboxElement">
                                              <img id="first-pic" class="profile_pic" src=<?php echo $this_profile['First_pic'] ?> alt=""> 
                                              </a> 
                                              <a href="#myModal" data-toggle="modal"> <button id="first-pic-button" class="change-btn pic_btn btn btn-primary" type="button">Change photo</button></a>
                                     </li>
                                     <li class="span3 my-profile-pic">
                                              <a id="second-pic-link" href=<?php echo $this_profile['Second_pic'] ?> class="background-color-black gallery thumbnail cboxElement">
                                              <img id="second-pic" class="profile_pic" src=<?php echo $this_profile['Second_pic'] ?> alt="">
                                              </a> 
                                              <a href="#myModal" data-toggle="modal"> <button id="second-pic-button" class="change-btn pic_btn btn btn-primary" type="button">Change photo</button></a>
                                     </li>
                                     
                                     <li class="span3 my-profile-pic">
                                          
                                              <a id="third-pic-link" href=<?php echo $this_profile['Third_pic'] ?> class="background-color-black gallery thumbnail cboxElement">
                                              <img id="third-pic" class="profile_pic" src=<?php echo $this_profile['Third_pic'] ?> alt="">
                                              </a> 
                                              <a href="#myModal" data-toggle="modal"> <button id="third-pic-button" class="change-btn pic_btn btn btn-primary" type="button">Change photo</button></a>
                                     </li>               
                      
                                  </ul>
                            </div>
                          </div>
                    
     			        </div>
                 </div>
                <div class="row-fluid">
                  <div class="span12">
                    <h2 id="describe-text" class="pagination-left"><span class="orange"> Can be described as: </span></h2>
                    
                      <a href="#myModal" data-toggle="modal" data-target="#modal_profile">
                      	<button id="edit-basics-button"class="change-btn btn btn-primary profile-button pull-right" type="button">Edit</button>
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
                    
                      <a href="#uniqueModal" data-toggle="modal" data-target="#uniqueModal"> 
                      	<button id="edit-unique-button"class="change-btn btn btn-primary profile-button pull-right" type="button">Edit</button>
                      </a>
                    
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
                  <h2 class="blue"> Verify to begin matching <?php echo $this_profile['Name'] ?></h2>
                </div>
                <div class="age-error alert alert-error" style='display:none'>  
                  <a class="close close_btn" >×</a>   
                  <strong>Sorry</strong>, You must be 18 years or older to continue. <a href="#myModal" data-toggle="modal" data-target="#modal_profile"> Click here </a>to edit your birthday.
                </div>
                <a changed='false' id='verify-btn' href="#verifyModal" role="button" data-toggle="modal">
                  <button  class="btn btn-large btn-success" type="button">Verify</button>
                </a>
                <br></br>
                <div id="success-message">
                </div>
              </div>
             </div>
              </div>
             </div>
            </div>
            </div><!--/container-->
          
        </div><!--/wrap-->
        <div id="push"></div>
      <?php include ("footer.php"); ?>
  <!-- change pic modal -->
<div id="myModal" class="modal modal-big hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 class="blue">Photo select</h3>
  </div>
  <div class="modal-body">
    <div class="row-fluid pagination-centered">
      <?php (get_fb_photos($friend_fb_id))?> 
    </div>
  </div>f
  <div class="modal-footer">
    <a href="#" data-dismiss="modal" class="btn">Close</a>
  </div>
</div> 

  <!-- edit profile modal -->
<div id="modal_profile" class="modal modal-big hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 class="blue">Edit Profile</h3>
  </div>
  <div class="modal-body">
    <div class="row-fluid pagination-centered">
      <div class="age-error alert alert-error" style='display:none'>  
        <a class="close close_btn" >×</a>   
        <strong>Sorry</strong>, You must be 18 years or older to continue.  
      </div> 
      <div class="row-fluid ">

        <div class="span6">
          <div class="control-group">
            <label class="control-label" for="select01"><strong>Gender:</strong></label>
              <div class="controls">
                <select id="gender" data-placeholder="Choose one" class="chzn-select">
                  <option></option>
                  <option>Rather not say</option>
                  <option>Male</option>
                  <option>Female</option>
                </select>
              </div>
          </div>
        </div><!--/span-->
        
        <div class="span6">
          <div class="control-group">
            <label class="control-label" for="select01"><strong>Birthday:</strong> </label>
              <div class="controls">
                <input type="text" placeholder="Choose a date" id="birthday" value =<?php echo $this_profile['Birthday']?> id="datepicker" >
              </div> 
          </div>
        </div><!--/span-->
        
        <div class="row-fluid">
          <div class="span6">
            <div class="control-group">
              <label class="control-label" for="select01"><strong>Sexual preference:</strong></label>
                <div class="controls">
                  <select id="sexual_pref" data-placeholder="Choose one" class="chzn-select" current-val="<?php echo $this_profile['Sexual_pref']?>">
                    <option></option>
                    <option>Rather not say</option>
                    <option>Straight</option>
                    <option>Gay</option>
                    <option>Bi</option>
                  </select>
                </div>
            </div>
          </div><!--/span-->
        
          <div class="span6">
            <div class="control-group">
              <label class="control-label" for="select01"><strong>Lives in:</strong></label>
                <div class="controls">               
                  <input name="city" id="input_one" type="text" lat="<?php echo($this_profile['Lat_city']);?>" long="<?php echo($this_profile['Long_city']);?>" size="50" value= "<?php echo $this_profile['City']?>" placeholder="Choose a location">

                </div>
            </div>
          </div><!--/span-->
         </div>
        <div class="row-fluid">
        <div class="span6">
          <div class="control-group">
            <label class="control-label" for="select01"><strong>Ethnicity:</strong></label>
              <div class="controls">
                <select id="ethnicity" id="ethnicity" data-placeholder="Choose one" class="chzn-select" multiple="multiple" current-val="<?php echo $this_profile['Ethnicity']?>">
                  <option value="_empty" selected="selected" style="display:none;"></option>
                  <option>Rather not say</option>
                  <option>Asian</option>
                  <option>Black</option>
                  <option>Indian</option>
                  <option>Hispanic/Latin</option>
                  <option>Middle Eastern</option>
                  <option>Native American</option>
                  <option>Pacific Islander</option>
                  <option>White</option>
                  <option>Too many!</option>
                  <option>Other</option>
                </select>
              </div>
          </div>
        </div><!--/span-->

        
        <div class="span6">
          <div class="control-group">
            <label class="control-label" for="select01"><strong>Politics:</strong></label>
              <div class="controls">
                <select id="politics" id="politics" data-placeholder="Choose one" class="chzn-select" multiple="multiple">>
                    <option value="_empty" selected="selected" style="display:none;"></option>
                    <option>Rather not say</option>
                    <option>Liberal</option>
                    <option>Independent</option>
                    <option>Conservative</option>
                  </select>
              </div>
          </div>
        </div><!--/span-->
       </div>
     </div>
       <div class="row-fluid">
        <div class="span6">
          <div class="control-group">
            <label class="control-label" for="select01"><strong>Height:</strong></label>
              <div class="controls">
                <select id="height" data-placeholder="Choose one" class="chzn-select">
                  <option></option>
                  <option>Rather not say</option>
                  <option>Tall</option>
                  <option>Average</option>
                  <option>Short</option>
                </select>
              </div>
          </div>
        </div><!--/span-->
        
        <div class="span6">
          <div class="control-group">
            <label class="control-label" for="select01"><strong>Relationship status:</strong></label>
              <div class="controls">
                <select id="relationship_status" data-placeholder="Choose one" class="chzn-select">
                  <option></option>
                  <option>Rather not say</option>
                  <option>Single</option>
                  <option>In a relationship</option>
                </select>
              </div>
          </div>
        </div><!--/span-->
       </div>
       
       
       
         <div class="row-fluid">
          <div class="span6">
            <div class="control-group">
              <label class="control-label" for="select01"><strong>Body Type:</strong></label>
                <div class="controls">
                  <select id="body_type" data-placeholder="Choose one" class="chzn-select">
                    <option></option>
                    <option>Rather not say</option>
                    <option>Thin</option>
                    <option>Overwieght</option>
                    <option>Skinny</option>
                    <option>Average</option>
                    <option>Fit</option>
                    <option>Athletic</option>
                    <option>Jacked</option>
                    <option>A little extra</option>
                    <option>Curvy</option>
                    <option>Full figured</option>
                  </select>
                </div>
            </div>
          </div><!--/span-->
          
          <div class="span6">
            <div class="control-group">
              <label class="control-label" for="select01"><strong>Drugs:</strong></label>
                <div class="controls">
                  <select id="drugs" data-placeholder="Choose one" class="chzn-select">
                    <option></option>>
                    <option>Rather not say</option>
                    <option>Never</option>
                    <option>Often</option>
                    <option>Rarely</option>
                  </select>
                </div>
            </div>
          </div><!--/span-->
         </div>
         <div class="row-fluid ">
          <div class="span6">
            <div class="control-group">
              <label class="control-label" for="select01"><strong>Diet:</strong></label>
                <div class="controls">
                  <select id="diet" id="diet" data-placeholder="Choose one" class="chzn-select" multiple="multiple">>
                    <option value="_empty" selected="selected" style="display:none;"></option>
                    <option>Rather not say</option>
                    <option>Anything</option>
                    <option>Vegetarian</option>
                    <option>Vegan</option>
                    <option>Kosher</option>
                    <option>Halal</option>
                    <option>Other</option>
                  </select>
                </div>
            </div>
          </div><!--/span-->
          
          <div class="span6">
            <div class="control-group">
              <label class="control-label" for="select01"><strong>Kids:</strong></label>
                <div class="controls">
                  <select id="kids" data-placeholder="Choose one" class="chzn-select">
                    <option></option>
                    <option>Rather not say</option>
                    <option>Has a kid</option>
                    <option>Has kids</option>
                    <option>Doesn't have kids</option>
                    <option>Want's a kid</option>
                    <option>Want's kids</option>
                    <option>Doesn't want kids</option>
                  </select>
                </div>
            </div>
          </div><!--/span-->
         </div>
         <div class="row-fluid">
          <div class="span6">
            <div class="control-group">
              <label class="control-label" for="select01"><strong>Education:</strong></label>
                <div class="controls">
                  <select id="education" id="education" data-placeholder="Choose one" class="chzn-select" multiple="multiple">>
                    <option value="_empty" selected="selected" style="display:none;"></option>
                    <option>Rather not say</option>
                    <option>High school</option>
                    <option>Two-year college</option>
                    <option>College/university</option>
                    <option>Masters program</option>
                    <option>Law school</option>
                    <option>Med school</option>
                    <option>Ph.D program</option>
                    <option>Other</option>
                  </select>
                </div>
            </div>
          </div><!--/span-->
          
          <div class="span6">
            <div class="control-group">
              <label class="control-label" for="select01"><strong>Hometown:</strong></label>
                <div class="controls">
                  <input id="input_two" type="text" lat="<?php echo($this_profile['Lat_hometown']);?>" long="<?php echo($this_profile['Long_hometown']);?>" value= "<?php echo $this_profile['Hometown']?>" size="50" placeholder="Choose a location">


                </div>
            </div>
          </div><!--/span-->
         </div>
         <div class="row-fluid">
          <div class="span6">
            <div class="control-group">
              <label class="control-label" for="select01"><strong>Religion:</strong></label>
                <div class="controls">
                  <select id="religion" id="religion" data-placeholder="Choose one" class="chzn-select" multiple="multiple">>
                    <option value="_empty" selected="selected" style="display:none;"></option>
                    <option>Rather not say</option>
                    <option>Agnosticism</option>
                    <option>Atheism</option>
                    <option>Christianity</option>
                    <option>Judaism</option>
                    <option>Catholicism</option>
                    <option>Islam</option>
                    <option>Hinduism</option>
                    <option>Buddhism</option>
                    <option>Other</option>
                  </select>
                </div>
            </div>
          </div><!--/span-->
          
          <div class="span6">
            <div class="control-group">
              <label class="control-label" for="select01"><strong>Income:</strong></label>
                <div class="controls">              

                  <select id="income" data-placeholder="Choose one" class="chzn-select">
                      <option></option>
                      <option>Rather not say</option>
                      <option>Less than $20k</option>
                      <option>$20k - $30k</option>
                      <option>$30k - $40k</option>
                      <option>$40k - $50k</option>
                      <option>$50k - $60k</option>
                      <option>$60k - $70k</option>
                      <option>$70k - $80k</option>
                      <option>$80k - $100k</option>
                      <option>$100k - $150k</option>
                      <option>$150k - $250k</option>
                      <option>$250k - $500k</option>                     
                      <option>More than $500k</option>
                    </select>
                </div>
            </div>
          </div><!--/span-->
         </div>
        
         <div class="row-fluid">
          <div class="span6">
            <div class="control-group">
              <label class="control-label" for="select01"><strong>Profession:</strong></label>
                <div class="controls">
                  <select id="profession" id="profession"  data-placeholder="Choose one" class="chzn-select"  multiple="multiple">
                    <option value="_empty" selected="selected" style="display:none;"></option>
                    <option>Rather not say</option>
                    <option>Student</option>
                    <option>Artistic / Musical / Writer</option>
                    <option>Banking / Financial / Real Estate</option>
                    <option>Clerical / Administrative</option>
                    <option>Computer / Hardware / Software</option>
                    <option>Construction / Craftsmanship</option>
                    <option>Education / Academia</option>
                    <option>Entertainment / Media</option>
                    <option>Executive / Management</option>
                    <option>Hospitality / Travel</option>
                    <option>Law / Legal Services</option>
                    <option>Medicine / Health</option>
                    <option>Military</option>
                    <option>Political / Government</option>
                    <option>Sales / Marketing / Biz Dev</option>
                    <option>Science / Tech / Engineering</option>
                    <option>Transportation</option>
                    <option>Unemployed</option>
                    <option>Other</option>
                    <option >Retired</option>
                  </select>
                </div>
            </div>
          </div><!--/span-->
          
          <div class="span6">
            <div class="control-group">
              <label class="control-label" for="select01"><strong>Languages:</strong></label>
                <div class="controls">
                  <select id="languages" id="languages" data-placeholder="Choose one" class="chzn-select" multiple="multiple">>
                    <option value="_empty" selected="selected" style="display:none;"></option>
                    <option>Rather not say</option>
                    <option>English</option>
                    <option>Afrikaans</option>
                    <option>Albanian</option>
                    <option>Arabic</option>
                    <option>Armenian</option>
                    <option>Basque</option>
                    <option>Belarusan</option>
                    <option>Bengali</option>
                    <option>Breton</option>
                    <option>Bulgarian</option>
                    <option>Catalan</option>
                    <option>Cebuano</option>
                    <option>Chechen</option>
                    <option>Chinese</option>
                    <option>C++</option>
                    <option>Croatian</option>
                    <option>Czech</option>
                    <option>Danish</option>
                    <option>Dutch</option>
                    <option>Esperanto</option>
                    <option>Estonian</option>
                    <option>Farsi</option>
                    <option>Finnish</option>
                    <option>French</option>
                    <option>Frisian</option>
                    <option>Georgian</option>
                    <option>German</option>
                    <option>Greek</option>
                    <option>Gujarati</option>
                    <option>Ancient Greek</option>
                    <option>Hawaiian</option>
                    <option>Hebrew</option>
                    <option>Hindi</option>
                    <option>Hungarian</option>
                    <option>Icelandic</option>
                    <option>Ilongo</option>
                    <option>Indonesian</option>
                    <option>Irish</option>
                    <option>Italian</option>
                    <option>Japanese</option>
                    <option>Khmer</option>
                    <option>Korean</option>
                    <option>Latin</option>
                    <option>Latvian</option>
                    <option>LISP</option>
                    <option>Lithuanian</option>
                    <option>Malay</option>
                    <option>Maori</option>
                    <option>Mongolian</option>
                    <option>Norwegian</option>
                    <option>Occitan</option>
                    <option>Other</option>
                    <option>Persian</option>
                    <option>Polish</option>
                    <option>Portuguese</option>
                    <option>Romanian</option>
                    <option>Rotuman</option>
                    <option>Russian</option>
                    <option>Sanskrit</option>
                    <option>Sardinian</option>
                    <option>Serbian</option>
                    <option>Sign Language</option>
                    <option>Slovak</option>
                    <option>Slovenian</option>
                    <option>Spanish</option>
                    <option>Swahili</option>
                    <option>Swedish</option>
                    <option>Tagalog</option>
                    <option>Tamil</option>
                    <option>Thai</option>
                    <option>Tibetan</option>
                    <option>Turkish</option>
                    <option>Ukrainian</option>
                    <option>Urdu</option>
                    <option>Vietnamese</option>
                    <option>Welsh</option>
                    <option>Yiddish</option>
                  </select>
                </div>
            </div>
          </div><!--/span-->

          <div class="row-fluid">
            <div class="span6">
              <div class="control-group">
                <label class="control-label" for="select01"><strong>Drinks:</strong></label>
                  <div class="controls">
                    <select id="drinks" data-placeholder="Choose one" class="chzn-select">
                      <option></option>
                      <option>Rather not say</option>
                      <option>Socially</option>
                      <option>Very often</option>
                      <option>Often</option>
                      <option>Rarely</option>
                      <option>Desperately</option>
                      <option>Not at all</option>
                    </select>
                  </div>
              </div>
            </div><!--/span-->

          <div class="span6">
          <div class="control-group">
            <label class="control-label" for="select01"><strong>Smokes:</strong></label>
              <div class="controls">
                <select id="smokes" data-placeholder="Choose one" class="chzn-select">
                  <option></option>
                  <option>Rather not say</option>
                  <option>Yes</option>
                  <option>Sometimes</option>
                  <option>No</option>
                  <option>Trying to quit</option>
                  <option>When drinking</option>
                </select>
              </div>
          </div>
        </div><!--/span-->
          
      </div>
    </div>
  </div>
  </div>
  <div class="modal-footer">
    <button id='cancel-basics-btn' class="btn" aria-hidden="true">cancel</button>
    <a>
      <button id='save-basics-btn' class="btn btn-primary" >Save</button>
    </a>
  </div>
</div> 




<div id="uniqueModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div id='unique-error' class="alert alert-error" style='display:none'>  
      <strong>Oops!!</strong>  Please share something special about <?php echo $this_profile['First_name']; ?>.  
    </div> 
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 class="blue" id="myModalLabel">How is <?php echo $this_profile['First_name']; ?> unique? </h3>

  </div>
  <div class="modal-body">
  	<div class='pagination-centered well'>
      <div class='row-fluid'>
        <textarea id='unique' class='span10' rows='5'> <?php echo $this_tastes['Unique']; ?> </textarea>
      </div><!--/span-->
      <div class='row-fluid'>
       <div>
       </div>
      </div>
    </div>

  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">cancel</button>
    <a>
      <button id="save-unique" class="btn btn-primary">Save</button>
    </a>
  </div>
</div>





<div id="verifyModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div id='email-error' class="alert alert-error" style='display:none'>  
       
      <strong>Oops!!</strong>  Please enter a valid email <div class='hidden-phone' style='display:inline;'> or <a style='cursor:pointer;' class='sendFBemail'>click here </a> to send them facebook message instead</div>.
      
    </div> 

  <div class="modal-header">

    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 class="blue" id="myModalLabel">Almost there...</h3>

  </div>
  <div class="modal-body">
  	<div class="row-fluid pagination-centered">
      <div class="span4">
        <img class='main-profile-pic' src="<?php echo $this_profile['Main_pic']?>">
      </div>
      <div class="span8">
      <h4 class="blue">We just need <span class="first-name"><?php echo $name ?>'s</span> email so <?php echo $heShe ?> can check out <?php echo $hisHer ?> profile</h4>
      
      <div class="control-group">
        <div class="controls">
          <input type="email" id="friends_email" <?php  if (!empty($this_profile['Email'])) {
                                              echo("value=". $this_profile['Email']);
                                              } ?> 
          type="email" size="50" placeholder="<?php echo $name ?>'s email here">
        </div>
      </div>
    </div>
    </div>

  </div>
  <div class="modal-footer">
    <div class='text-align-left pull-left hidden-phone' style='display:inline;'>Don't know their email? <br> <a style='cursor:pointer;' class='sendFBemail'>Click here to send a Facebook message</a></div>
    <button class="btn" data-dismiss="modal" aria-hidden="true">cancel</button>
    <a>
      <button id="start_matching" class="btn btn-primary">Start matching!</button>
    </a>
  </div>
</div>

   <script src="http://connect.facebook.net/en_US/all.js#xfbml=1&appId="+"<?php echo $fb_app_id ?>"></script>
    <div id="fb-root"></div>
     <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId="+"<?php echo $fb_app_id ?>";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

  $(".sendFBemail").click(function() {
    
        FB.ui({
            method: 'send',
            name: 'Hey <?php echo $this_profile['First_name'] ?>, you have been set up!',
            to:  <?php echo $this_profile['fb_id'] ?>,
            link: 'http://throughourfriends.com/congratulations.php?mm=<?php echo $session_user_name ?>&f=<?php echo $this_profile['First_name'] ?>',
            }, callback
          );

        function callback(response) {
		
          //check if there is a response or not. 
          if (!!response) 

            //if there is a resonse,(user clicked send) run verify_profile.php and direct to myfriends.php
            { 
			//save all variables on page
			var Gender = $("#gender").val();
			var Birthday = $("#birthday").val();
			var Sexual_pref = $("#sexual_pref").val();
			var Looking_for = $("#looking_for").val();
			var City = $("#input_one").val();
			var Lat_city =  $("#input_one").attr('lat');
			var Long_city =  $("#input_one").attr('long');
			var Ethnicity = $("#ethnicity").val();
			var Height =  $("#height").val();
			var Relationship_status = $("#relationship_status").val();
			var Body_type = $("#body_type").val();
			var Drugs = $("#drugs").val();
			var Diet = $("#diet").val();
			var Kids = $("#kids").val();
			var Education = $("#education").val();
			var Hometown = $("#input_two").val();
			var Lat_hometown =  $("#input_two").attr('lat');
			var Long_hometown =  $("#input_two").attr('long');
			var Religion = $("#religion").val();
			var Income = $("#income").val();
			var Politics =  $("#politics").val();
			var Sign = $("#sign").val();
			var Profession = $("#profession").val();
			var Languages = $("#languages").val();
			var Drinks = $("#drinks").val();
			var Smokes = $("#smokes").val();
			var Unique = $("#unique").val();
			var Main_pic =  $("#main-pic").attr('src');
			var First_pic = $("#first-pic").attr('src');
			var Second_pic = $("#second-pic").attr('src');
			var Third_pic = $("#third-pic").attr('src');
			var userid = $('#logged-in-user').attr('userid');
			var Taste_id = $('#'+userid+'').attr('taste_id');
			var Changed = $("#verify-btn").attr('changed');
		
			//consilidate variables into one variable called data
			data = ("changed=" + Changed +"&"+ "friends_email=" + friends_email +"&"+ "gender=" + Gender +"&"+ "birthday=" + Birthday +"&"+ "sexual_pref=" + Sexual_pref +"&"+
			 "looking_for=" + Looking_for +"&"+ "city=" + City +"&"+
			 "ethnicity=" + Ethnicity +"&"+ "height=" + Height +"&"+
			 "relationship_status=" + Relationship_status +"&"+ "body_type=" + Body_type +"&"+
			 "drugs=" + Drugs +"&"+ "diet=" + Diet +"&"+
			 "kids=" + Kids +"&"+ "education=" + Education +"&"+
			 "hometown=" + Hometown +"&"+ "religion=" + Religion +"&"+
			 "income=" + Income +"&"+ "politics=" + Politics +"&"+
			 "sign=" + Sign +"&"+ "profession=" + Profession +"&"+
			 "languages=" + Languages +"&"+ "drinks=" + Drinks +"&"+
			 "smokes=" + Smokes +"&"+ "unique=" + Unique +"&"+ "taste_id=" + Taste_id +"&"+
			 "main_pic=" + Main_pic +"&"+ "first_pic=" + First_pic +"&"+
			 "second_pic=" + Second_pic +"&"+ "third_pic=" + Third_pic 
			 +"&"+ "lat_city=" + Lat_city +"&"+ "long_city=" + Long_city +"&"+ "lat_hometown=" + Lat_hometown +"&"+ "long_hometown=" + Long_hometown

				);
		

			$.ajax({
		        type: "GET",
		        url: "verify_profile.php",
		        data: data,
		        success: function(result) {
		       		//alert(result);
		        	//$("#success-message").hide().html(result).fadeIn(2000);
		        	window.location.href = "my-friends.php";

		        }
		    });

			//window.location = "my-friends.php"; 
          } else 
          //do nothing if there is no response (user clicked cancel)
          {  
        }
      }

        });



</script>
  

    <!-- Le javascript
    ================================================== -->

    <!-- Placed at the end of the document so the pages load faster -->
    


    <script src="assets/js/jquery.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.21/jquery-ui.min.js"></script>
    <script src="assets/js/jquery.colorbox.js"></script>
    <script src="assets/js/chosen-jquery.js"></script>
    <script type="text/javascript" src="assets/js/verify.js"></script>
    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false&libraries=places"></script>
    <script src="assets/js/bootstrap-transition.js"></script>
    <script src="assets/js/bootstrap-alert.js"></script>
    <script src="assets/js/bootstrap-modal.js"></script>
    <script src="assets/js/bootstrap-dropdown.js"></script>
    <script src="assets/js/bootstrap-scrollspy.js"></script>
    <script src="assets/js/bootstrap-tab.js"></script>
    <script src="assets/js/bootstrap-tooltip.js"></script>
    <script src="assets/js/bootstrap-popover.js"></script>
    <script src="assets/js/bootstrap-button.js"></script>
    <script src="assets/js/bootstrap-collapse.js"></script>
    <script src="assets/js/bootstrap-carousel.js"></script>
    <script src="assets/js/bootstrap-typeahead.js"></script>
  

  </body>
  
</html>
