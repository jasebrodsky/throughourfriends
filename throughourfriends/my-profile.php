<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>My Profile</title>
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

      $User_userid = $_SESSION['User_user_id'];
      $this_profile = get_profile($User_userid);
      $User_fb_id = $_SESSION['fb_id'];
      $Claimed = $_SESSION['Claimed']
     
          

     


      ?>
      <div class="container-fluid">
          <div class="row">
            <?php include ("nav.php"); ?>
          <div class="span10">
            <div class="row">
            <div id="top-text" >
              <div class='grey' style="font-size: 24px;">
                  <i class="blue icon-user icon-large"></i> My Profile
              </div>
              <?php
            
            //check if user been set up first. 
             if ((count_records('profile', $User_userid)) == true){
              include ("my-profile-inc.php");
           } else{
             
             include ("my-profile-empty-inc.php");
           }

             ?>
  
             
             
             
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
      <?php (get_fb_photos("me()"))?> 
    </div>
  </div>
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
    <a href="#" data-dismiss="modal" class="btn">Cancel</a>
    <a href="#" data-dismiss="modal" class="btn btn-primary">Save</a>
  </div>
</div> 
  

    <!-- Le javascript
    ================================================== -->

    <!-- Placed at the end of the document so the pages load faster -->
    


    <script src="assets/js/jquery.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.21/jquery-ui.min.js"></script>
    <script src="assets/js/jquery.colorbox.js"></script>
    <script src="assets/js/chosen-jquery.js"></script>
    <script type="text/javascript" src="assets/js/my-profile.js"></script>
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
