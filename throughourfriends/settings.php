<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Settings</title>
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
      
      <?php include ("header.php");
      require 'core.inc.php';
      $my_settings = get_settings($_SESSION['User_user_id']);
        $New_friend_email = (checked($my_settings['New_friend_email']));
        $New_pending_match_email = (checked($my_settings['New_pending_match_email']));
        $New_active_match_email = (checked($my_settings['New_active_match_email']));
        $New_message_email = (checked($my_settings['New_message_email']));

      $this_profile = get_profile($_SESSION['User_user_id']);
        $Email = $this_profile['Email'];
        $Matchable_status = checked($this_profile['Matchable_status']);
        $Deleted = checked($this_profile['Deleted']);

        
      ?>

      <div class="container-fluid">
          <div class="row">
            <?php include ("nav.php"); ?>
          <div class="span10">
            <div class="row">
              <div id="top-text">
                <div class='grey' style="font-size: 24px;">
                  <i class="blue icon-search icon-large"></i> Settings
                </div>
                <br>
                
              </div> 

              <div id="basics" class="well ">

                <div class="row-fluid ">
                 <form >
                    <fieldset>
                      <legend><h3 class='blue'> Matchable Status</h3></legend>
                      <label class="grey checkbox">
                        <input id='Matchable' type="checkbox" <?php echo($Matchable_status) ?>> Are you currently available to receive matches and messages?
                      </label>
                      
                      

                      <legend><h3 class='blue'>Notify me when</h3></legend>
                      <label class="grey checkbox">
                        <input id='Friend_email' type="checkbox" <?php echo($New_friend_email) ?> > Friend sets me up or adds to my profile
                      </label>
                      <label class="grey checkbox">
                        <input id='Pending_email' type="checkbox"  <?php echo($New_pending_match_email) ?> > Receive new Pending Match
                      </label>
                      <label class="grey checkbox">
                        <input id='Active_email' type="checkbox" <?php echo($New_active_match_email) ?> > Receive new Active Match
                      </label>
                      <label class="grey checkbox">
                        <input id='Message_email' type="checkbox"<?php echo($New_message_email) ?> > Receive new Message
                      </label>
                      

                      <legend><h3 class='blue'>Email me at</h3></legend>
                      <div id="email-error" class="alert alert-error" style="display:none;" >  
                        <a class="close close_btn" >×</a>   
                        <strong>Whoops</strong>, please enter a valid email to continue.
                      </div>
                      <div class="control-group">
                        <label class="control-label" for="inputEmail"></label>
                        <div class="controls">
                          <input type="email" id="Email" placeholder="Email" value="<?php echo $Email?>">
                        </div>
                      </div>
                      
                      

                      <legend><h3 class='blue'>Delete Account</h3></legend>
                      <label class="grey checkbox">
                        <input type="checkbox" id="Deleted" <?php echo($Deleted) ?>> Are you you want to delete your account?
                      </label>
                      <a href="#myModal" role="button" data-toggle="modal">
                        <button type="submit" class="btn btn-danger pull-right" >Delete</button>
                      </a>
                    </fieldset>
                  
                    
                    
              
            </div>
          </div><!--/span9-->
          <div class="pagination-centered">
            <a>
              <button type="submit" name="submit" id="save-button" class="btn btn-large btn-success" type="button">Save</button>
            </a>
            </form>
          </div>
          <br></br>
          <div id="success-message" class='pagination-centered'>
          </div>
        </li>
      </ul>
    </div>
    
          </div>
        </div><!--/container-->
       <div id="push"></div>
      </div><!--/wrap-->
  <?php include ("footer.php"); ?>
  
  <!-- Modal -->
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 class="grey" id="myModalLabel">Delete profile</h3>
  </div>
  <div class="modal-body">
  	<div class="row-fluid pagination-centered">
      <div class="span12">
      
         <h4 style="display: inline;">Are you sure you want to delete your profile?</h4>
       </div>
       <legend></legend>
        <div id="email-error" class="alert-info" >  
          If you are in a relationship you can choose to not recieve matches or messages by unchecking the matchable status seen on the settings page.
        </div>
   </div>  
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">cancel</button>
    <a "#">
      <button class="btn btn-danger">Delete</button>
    </a>
  </div>
</div>
  

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
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
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.21/jquery-ui.min.js"></script>
    <script src="assets/js/chosen-jquery.js"></script>
    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places"></script>
    <script type="text/javascript" src="assets/js/forms.js"></script>
    <script type="text/javascript" src="assets/js/update-settings.js"></script>

  </body>
  
</html>
