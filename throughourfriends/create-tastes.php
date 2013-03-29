<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>create tastes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/css/font-awesome.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/chosen.css" rel="stylesheet">
    <link href="assets/css/jquery-ui.css" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Quicksand:300,400,700" rel="stylesheet" type="text/css">

    
    <style type="text/css">
      body {
	padding-top: 60px;
	padding-bottom: 40px;

      }
      .sidebar-nav {
        padding: 9px 0;
      }
    </style>
    <link href="assets/css/bootstrap-responsive.css" rel="stylesheet">

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
    <link href="assets/css/footer.css" rel="stylesheet" type="text/css">
    <link href="assets/css/style.css" rel="stylesheet" type="text/css">
</head>

  <body>
    <?php include_once("analyticstracking.php"); ?>
  	<div id="wrap">
      <?php 
      include ("header.php");
      include ("core.inc.php");
      $name = $_SESSION['name'];
      $Unique = $_GET['unique'];
      $Friend_userid = $_SESSION['friend_userid'];
      $this_profile = get_profile($Friend_userid);
      $age = get_age($this_profile['Birthday']);
      $max_age = ($age + 5);
      $min_age = ($age - 5);
      $gender = ($this_profile['Gender']);
      $sexual_pref = ($this_profile['Sexual_pref']);

      //need to guess if user will be interested in male or female
      // if user is male ...and straight, then he is interested in female, else if he is gay, then he is interested in men, else both
      // if user is male ...and straight, then he is interested in female, else if he is gay, then he is interested in men, else both
      if ($gender == 'Male') {//if friend is male
        if ($sexual_pref == 'Straight') {//check if hes straight
          $interestedIn = "'<option>Female and Male</option>
                            <option>Male only</option>
                            <option selected='selected'>Female only</option>'";//then he probally likes women
        }
        elseif ($sexual_pref == 'Gay'){//check if hes gay
          $interestedIn = "'<option>Female and Male</option>
                            <option selected='selected'>Male only</option>
                            <option>Female only</option>'";//then he probally likes men
        }
        else {$interestedIn = "'<option selected='selected'>Female and Male</option>
                                <option>Male only</option>
                                <option>Female only</option>'";//esle he probally bi and likes both men and women
        }
      }

      if ($gender == 'Female') {//if friend is female
        if ($sexual_pref == 'Straight') {//check if shes straight
          $interestedIn = "'<option>Female and Male</option>
                            <option selected='selected'>Male only</option>
                            <option>Female only</option>'";//then she probally likes men
        }
        elseif ($sexual_pref == 'Gay'){//check if shes gay
          $interestedIn = "'<option>Female and Male</option>
                            <option>Male only</option>
                            <option selected='selected'>Female only</option>'";//then she probally likes women
        }
        else {$interestedIn = "'<option selected='selected'>Female and Male</option>
                                <option>Male only</option>
                                <option>Female only</option>'";//esle she probally bi and likes both men and women
        }
      }

       ?>
  
      <div class="container-fluid">
          <div class="row">
            <?php include ("nav.php"); ?>
          <div class="span10 pagination-centered">
            <div class="row">
            <br>
              <!-- <p class="bold"> <span class="big-text blue">1</span><span class="small-text black">Description</span> <span class="big-text blue">2</span> <span class="small-text black">Tastes</span> <span class="big-text grey">3</span> <span class="small-text grey">Verify</span>
              </p> -->
              <h2><span class="blue"> Who would <?php echo $name ?> like to meet? </span></h2>
              <h4><span class="blue"> (This will never be shown publicly) </span></h4>
              <hr>
              <div id='basics-error' class="alert alert-error" style='display:none'>  
                <a class="close close_btn" >×</a>   
                <strong>Almost there</strong>, please complete the below red field(s) then you can continue.  
              </div> 
              <div id="basics" class="well">
                <div class="row-fluid">
                <div class="form-horizontal "> 
                <div class="row-fluid">
                    <div class="span6">
                      <div class="control-group">
                        <label class="control-label" for="select01"><strong>Gender:</strong></label>
                          <div class="controls">
                            <select id="gender" data-placeholder="Choose one" class="chzn-select">
                              <option value="_empty" selected="selected" style="display:none;"></option>
                              <?php echo $interestedIn?>
                            </select>
                          </div>
                      </div>
                    </div><!--/span-->
                    <div class="span6">
                      <div class="control-group">
                        <label class="control-label" for="select01"><strong>Age range:</strong> </label>
                          <div class="controls">
                            <input class="span4" name="min_age" id="min-age" value="<?php echo $min_age?>" min="18" placeholder="min age" type="number">
                            <p id="age-range-text"> <em>to</em> </p>
                            <input class="span4" name="max_age" id="max-age" value="<?php echo $max_age?>" min="18" placeholder="max age" type="number">
                          </div>
                      </div> 
                    </div><!--/span-->
                </div><!--/span-->
                <div class="row-fluid">
                  <div class="span6">
                    <div class="control-group">
                      <label class="control-label" for="select01"><strong>Religion:</strong></label>
                        <div class="controls">
                          <select name="religion" id="religion" data-placeholder="Choose one" class="chzn-select" multiple="multiple">
                              <option value="_empty" selected="selected" style="display:none;"></option>
                              <option>Not important</option>
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
                      <label class="control-label" for="select01"><strong>Politics:</strong></label>
                        <div class="controls">
                          <select name="politics" id="politics" data-placeholder="Choose one" class="chzn-select" multiple="multiple">>
                              <option value="_empty" selected="selected" style="display:none;"></option>
                              <option>Not important</option>
                              <option>Liberal</option>
                              <option>Independent</option>
                              <option>Conservative</option>
                            </select>
                        </div>
                    </div>
                  </div><!--/span-->
                <div class="row-fluid">
                  <div class="span6">
                    <div class="control-group">
                      <label class="control-label" for="select01"><strong>Ethnicity:</strong></label>
                        <div class="controls">
                           <select name="ethnicity" id="ethnicity" data-placeholder="Choose one" class="chzn-select" multiple="multiple">
                            <option value="_empty" selected="selected" style="display:none;"></option>
                            <option>Not important</option>
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
                      <label class="control-label" for="select01"><strong>Lives within:</strong></label>
                        <div class="controls">
                              <select id="distance" class="chzn-select" style="width:107.5px">
                                <option></option>
                                <option>50</option>
                                <option selected>100</option>
                                <option>200</option>
                                <option>500</option>
                              </select> 
                              <select id="distance_unit" class="chzn-select" style="width:107.5px">
                                <option></option>
                                <option selected>miles</option>
                                <option>kilometers</option>
                              </select> 
                              <div class="last-name">of</div>
                              <input name="city" id="input_one" type="text" lat="<?php echo $this_profile['Lat_city']?>" long="<?php echo $this_profile['Long_city']?>" size="50" value= "<?php echo $this_profile['City']?>" placeholder="Choose a location">
                        </div>
                    </div>
                  </div><!--/span-->
                 </div>
                </div>
               </div>
              </div>

              <textarea name="unique" id="unique" style="display:none;" ><?php echo $Unique ?></textarea>
          </div>
        </div><!--/span9-->
	         <a>
              <input id="continue_btn"class="btn btn-large btn-success" value="Continue"/></button>
	         </a>
      </div>
      </div><!--/span9-->
      </div>
  </div><!--/container-->
  <div id="push"></div>
</div><!--/wrap-->
<?php include ("footer.php"); ?>
  
    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    
	  <script src="assets/js/jquery.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.21/jquery-ui.min.js"></script>
    <script src="assets/js/chosen-jquery.js"></script>
    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false&libraries=places"></script>
    <script type="text/javascript" src="assets/js/forms.js"></script> 
	  <script type="text/javascript" src="assets/js/create-tastes.js"></script>
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
