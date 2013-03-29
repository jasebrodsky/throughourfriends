<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>My matches</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link rel="stylesheet" href="assets/css/colorbox.css" /> 
    <link href="assets/css/font-awesome.css" rel="stylesheet">
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Quicksand:300,400,700" rel="stylesheet" type="text/css">

    <link href="assets/css/style.css" rel="stylesheet">
    
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
    <?php include_once("analyticstracking.php"); 
          
          require("count.php");
          
          $User_id = $_SESSION['User_user_id'];
          $New_pending_match = $_SESSION['New_pending_match'];
          $New_active_match = $_SESSION['New_active_match'];
          if ($New_active_match > 0) {
              $active_match_badge = ("<span class='badge badge-important'>$New_active_match</span>");
            } 
            else {
              $active_match_badge = (""); 
            }
          if ($New_pending_match > 0) {
              $pending_match_badge = ("<span class='badge badge-important'>$New_pending_match</span>");

            }    
            else {
              $pending_match_badge = (""); 
              } 
    ?>
  	<div id="wrap">
      <?php include ("header.php"); ?>
      <div class="container-fluid">
          <div class="row">
            <?php include ("nav.php"); ?>
          <div class="span10">
            <div class="row">
              <div id="top-text">
                <div class='grey' style="font-size: 24px;">
                  <i class="blue icon-heart icon-large"></i> My Matches
                </div>
                <br>
                <ul class="nav nav-tabs">
                  <li><a href="my-matches-likely.php">Likely</a></li>
                  <li><a href="my-matches-pending.php">Pending <?php echo $pending_match_badge; ?></a></li>
                  <li class="active"><a href="#">Active <?php echo $active_match_badge; ?></a></li>
            	 </ul>
                <h2 class="blue pagination-centered"> <span>Here are your active matches!</span></h2>
                <p class="blue pagination-centered"> These matches have <strong>already</strong> been accepted by you, them, and atleast one of your friends or theirs.</p>
              </div> 

            </div> 
            
            <div style="list-style-type: none;" id="active-matches">
              
              
                  
                  <?php 
                  require 'core.inc.php';
              //check if user been set up first. 
               if ((count_records('profile', $User_id)) == true){

                //then check if has claimed their profile
                  if (($_SESSION['Claimed']) == true){

                         //check if users' matchable status is checked
                        if (($_SESSION['Matchable_status']) == true){

                               //check if user has any active matches.
                               if ((count_records('active_matches', $User_id)) == true){
                                
                               //include their active matches.
                               include ("load_active_matches.php");
                             } else{
                              
                              // if user does not have any active matches show message. 
                               include ("my-matches-active-empty-inc.php");
                             }
                        } else {
                    
                    //when matchable status is not checked show message.
                    include ("my-matches-not-matchable-inc.php");
                      }
                    }else{
                  //else if profile is not set up yet, include profile empty message.
                  include ("my-matches-not-claimed-inc.php");

                }

              }else{
              
              //else if profile is not set up yet, include profile empty message.
              include ("my-profile-empty-inc.php");

            }
            ?>
				
                  
              
                
              </div>
            </div>
            
            <div id="push"></div>
          </div><!--/container-->
        <div id="push"></div>
      </div><!--/wrap-->
    </div>
  <?php include ("footer.php"); ?>
  
  <!-- Modal compose -->
<div id="compose-modal" class="modal hide fade big-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
    <h3 class="blue" id="myModalLabel">Compose new message</h3>
  </div>
  <div class="modal-body">
    <div id="message_reply"class="row-fluid">
      <div class="span12">
        <div class="span2 hidden-phone">
          <img class='main-profile-pic' src="<?php echo $_SESSION['Main_pic']?>"> </img>
        </div>
        <div class="well span10" style='margin-top:0%;'>

          <div id='compose-error' class="alert alert-error" style='display:none'>  
            <a class="close close_btn">x</a>
            <strong>Whoops</strong>, can't send an empty message.
          </div> 

          <div class="row-fluid">
            <div class="span6">
              <div class="span6 well well-small background-color-white">
                <span id="message_to_modal"> </span>
              </div>
            </div>
            <div style="margin-top: 10px;" class="text-align-right">
             <span>Now </span> 
            </div>
            <div class="row-fluid">
              <div>
                <textarea id="message_textarea" class="span12" rows="3"></textarea>
              </div>
            </div>
          </div>  
        </div>    
      </div>  
    </div>
  </div>
  <div id="modal-footer"class="modal-footer">
    <button class="cancel_btn btn" data-dismiss="modal" aria-hidden="true">cancel</button>
    <a  id="send_message_btn" class="btn btn-primary" match_user_id='123' matchee_user_id='123'>Send</a>
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

    <script src="assets/js/my-matches-active.js"></script>
    
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
