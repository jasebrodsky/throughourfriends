<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>create profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author">

    <!-- Le styles -->
    <link rel="stylesheet" href="assets/css/colorbox.css" /> 
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/css/font-awesome.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/chosen.css" rel="stylesheet">
    <link href="assets/css/jquery-ui.css" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Quicksand:300,400,700" rel="stylesheet" type="text/css">

    <style type="text/css">

      .sidebar-nav {
        padding: 9px 0;
      }
    </style>
    <link href="assets/css/bootstrap-responsive.css" rel="stylesheet">



    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
    <link href="assets/css/footer.css" rel="stylesheet" type="text/css">
    
</head>

  <body>
    <?php include_once("analyticstracking.php"); ?>
  
    <div id="wrap">
      <?php 
      include ("header.php");
      require ("core.inc.php");
      

      // save variables from session into local variables. 

      $friend_fb_id = $_SESSION['friend_fb_id'];
      $friend_info = get_friends_fb_info($friend_fb_id);
      if ($friend_info['hometown_location']['id'] == null){
        //hometown is null
        $hometown_coord['latitude'] = '';
        $hometown_coord['logitude'] = '';
      } else {
        //hometown is not null
        $hometown_coord = get_coord($friend_info['hometown_location']['id']);
      }

      if ($friend_info['current_location']['id'] == null){
        //city is null
        $city_coord['latitude'] = '';
        $city_coord['logitude'] = '';
      } else {
        //city is not null
        $city_coord = get_coord($friend_info['current_location']['id']);
      }
      
      $name = $_SESSION["name"];


      //convert last name to intial
      //$last_intial = $last_name[0];

      //combine names into one variable
      //$first_last = "$first_name"." $last_intial".".";


      //save bday from facebook
      $bday = ($friend_info['birthday_date']);

      //check if bday from facebook is 1970
      if ($bday == ("")){
        $bday = ("''");
      }
      else {

        $bday = (date('Y-m-d', strtotime($bday)));
      }
      

      ?>
  
      <div class="container-fluid">
          <div class="row">
            <?php include ("nav.php"); ?>
          <div class="span10 pagination-centered">
            <br>
            <div class="row">
            
            
              <!-- <p class="bold"> <span class="big-text blue">1</span><span class="small-text black">Description</span> <span class="big-text grey">2</span> <span class="small-text grey">Tastes</span> <span class="big-text grey">3</span> <span class="small-text grey">Verify</span>
              </p> -->
              <h2><span class="blue"> What does <?php echo $name ?> look like? </span></h2>
              <hr>
              
                <div id="photos" class="row-fluid">
                  <ul class="thumbnails">
                        <li class="span3">
                                  <a id="main-pic-link" href="https://graph.facebook.com/<?php echo $friend_fb_id ?>/picture?type=large" class="thumbnail">
                                  <img id="main-pic" class="big_pic" src="https://graph.facebook.com/<?php echo $friend_fb_id ?>/picture?type=large">
                                  </a>
                                  <a href="#myModal" data-toggle="modal"> <button id="main-pic-button" class="pic_btn btn btn-primary" type="button">Change photo</button></a>
                         </li>
                         <li class="span3 my-profile-pic">
                                  <a id="first-pic-link" href="#" class="background-color-black gallery thumbnail">
                                  <img id="first-pic" class="profile_pic" src='assets/img/NoImage.png' alt=""> 
                                  </a> 
                                  <a href="#myModal" data-toggle="modal"> <button id="first-pic-button" class="pic_btn btn btn-primary" type="button">Change photo</button></a>
                         </li>
                         <li class="span3 my-profile-pic">
                                  <a id="second-pic-link" href="#" class="background-color-black gallery thumbnail">
                                  <img id="second-pic" class="profile_pic" src='assets/img/NoImage.png' alt="">
                                  </a> 
                                  <a href="#myModal" data-toggle="modal"> <button id="second-pic-button" class="pic_btn btn btn-primary" type="button">Change photo</button></a>
                         </li>
                         
                         <li class="span3 my-profile-pic">
                              
                                  <a id="third-pic-link" href="#" class="background-color-black gallery thumbnail">
                                  <img id="third-pic" class="profile_pic" src='assets/img/NoImage.png' alt="">
                                  </a> 
                                  <a href="#myModal" data-toggle="modal"> <button id="third-pic-button"  class="pic_btn btn btn-primary" type="button">Change photo</button></a>
                         </li>               
          
                         </ul>
                </div>
              
              
                <h2><span class="blue"> Who is <?php echo $name ?>? </span></h2>

                <div id='basics-error' class="alert alert-error" style='display:none'>  
                  <a class="close close_btn" >×</a>   
                  <strong>Almost there</strong>, please complete the below red field(s) then you can continue.  
                </div> 
              <form id="commentForm1" class="form-horizontal">
                <div id="basics" class="form-horizontal well">

  
                  <div class="row-fluid">
                    <div class="span6">
                      <div class="control-group">
                        <label class="control-label" for="select01"><strong>Gender:</strong></label>
                          <div class="controls">
                            <select id="gender" data-placeholder="Choose one" class="chzn-select required">
                              <option></option>
                              <option <?=$friend_info['sex'] == 'male' ? ' selected="selected"' : '';?>>Male</option>
                              <option <?=$friend_info['sex'] == 'female' ? ' selected="selected"' : '';?>>Female</option>
                            </select>
                          </div>
                      </div>
                    </div><!--/span-->
                    <div class="span6">
                      <div class="control-group">
                        <label class="control-label" for="select01"><strong>Birthday:</strong> </label>
                          <div class="controls">
                            <input type="text" placeholder="Choose a date" id="birthday" value =<?php echo ($bday); ?> id="datepicker" >
                            <p id='age_req' style='color:#B94A48; display:none'> Must be 18 years or older</p>
                          </div> 
                      </div>
                    </div><!--/span--> 
                  </div>

                  <div class="row-fluid">
                    <div class="span6">
                      <div class="control-group">
                        <label class="control-label" for="select01"><strong>Sexual preference:</strong></label>
                          <div class="controls">
                            <select id="sexual_pref" data-placeholder="Choose one" class=" chzn-select required">
                              <option></option>
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
                            <input name="city" id="input_one" type="text" lat="<?php echo($city_coord['latitude']);?>" long="<?php echo($city_coord['longitude']);?>" size="50" value= "<?php echo($friend_info['current_location']['name']);?>" placeholder="Choose a location">
                                                                          


                          </div>
                      </div>
                    </div><!--/span-->
                   </div>
                   <div class="row-fluid">
                    <div class="span6">
                      <div class="control-group">
                        <label class="control-label" for="select01"><strong>Ethnicity:</strong></label>
                          <div class="controls">
                            <select id="ethnicity" id="ethnicity" data-placeholder="Choose one" class="chzn-select" multiple="multiple">
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
                          <label class="control-label" for="select01"><strong>Hometown:</strong></label>
                            <div class="controls">
                              <input id="input_two" type="text" lat="<?php echo($hometown_coord['latitude']);?>" long="<?php echo($hometown_coord['longitude']);?>" size="50" value= "<?php echo($friend_info['hometown_location']['name']);?>" placeholder="Choose a location">
                            </div>
                        </div>
                      </div><!--/span-->
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
                              
                              <option>Single</option>
                              <option>In a relationship</option>
                              <option>It's complicated</option>
                            </select>
                          </div>
                      </div>
                    </div><!--/span-->
                   </div>
                   
                   
                   <div id="expanded">
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
                                <option>Bangin</option>
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
                                <option>Has kids</option>
                                <option>Does not have kids</option>
                                <option>Wants kids</option>
                                <option>Does not want kids</option>
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
                          <label class="control-label" for="select01"><strong>Income:</strong></label>
                            <div class="controls">
                              <select id="income" data-placeholder="Choose one" class="chzn-select">
                                <option></option>
                                <option>Rather not say</option>
                                <option>Less than $20,000</option>
                                <option>$20,000 - $30,000</option>
                                <option>$30,000 - $40,000</option>
                                <option>$40,000 - $50,000</option>
                                <option>$50,000 - $60,000</option>
                                <option>$60,000 - $70,000</option>
                                <option>$70,000 - $80,000</option>
                                <option>$80,000 - $100,000</option>
                                <option>$100,000 - $150,000</option>
                                <option>$150,000 - $250,000</option>
                                <option>$250,000 - $500,000</option>
                                <option>$500,000 - $1,000,000</option>
                                <option>More than $1,000,000</option>
                              </select>
                            </div>
                        </div>
                      </div><!--/span-->
                     </div>
                     <div class="row-fluid">
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
                  </div> <!--/expanded-->
  
                  
                
                 
                 </div> <!--/expanded-->
                 <legend></legend>
                 <div class='row-fluid'>
                    <button id="basics-button"class="btn btn-primary pull-right" type="button">+More criteria</button>
                </div>
                 
                 
                </div><!--/form well-->
             
              <h2><span class="blue" > How is <?php echo $name ?> unique? </span></h2>

              <div id='unique-error' class="alert alert-error" style="display:none">  
                  <a class="close close_btn" >×</a>  
                  <strong>One more thing</strong>, please tell me something special about <?php echo $name ?>
              </div> 


              <div class="well">
                <div class="control-group">
                  
                    <textarea id="unique" class="field span8 required"  placeholder="<?php echo $name ?> is great because..."></textarea>
                  
                </div><!--/span-->
              </div>
              
              <button class="btn btn-large btn-success" id="continue_btn"> Continue</button>

              

            </div><!--/span9-->
          </form>     
          </div><!--/span9-->
          
          
          </div>
          
      </div><!--/container-->
      <div id="push"></div>
    </div><!--/wrap-->

  
  <?php include ("footer.php"); ?>
  
  <!-- Modal -->
<div id="myModal" class="modal modal-big hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 class="blue">Photo select</h3>
  </div>
  <div class="modal-body">
    <div class="row-fluid pagination-centered">
      <?php (get_fb_photos($friend_fb_id))?> 
    </div>
  </div>
  <div class="modal-footer">
    <a href="#" data-dismiss="modal" class="btn">Close</a>
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
    
    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false&libraries=places"></script>
    
    
    <script type="text/javascript" src="assets/js/create-profile.js"></script>
    <script type="text/javascript" src="assets/js/forms.js"></script>
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
