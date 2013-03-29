<!DOCTYPE html>
<html lang="en">
<head>
    <link href="assets/css/font-awesome.css" rel="stylesheet">
    <link href="assets/css/bootstrap-no-mobile.css" rel="stylesheet">
    
    <link href="assets/css/style.css" rel="stylesheet">
<?php  
      include ("header.php");
      require 'connect.inc.php';
      require 'core.inc.php';
      $User_id = $_SESSION['User_user_id'];
      $my_friends = get_friends($User_id); 
      $this_profile = get_profile($User_id); 
      require("count.php");
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
  
    <meta charset="utf-8">
    <title>My matches-likely</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    
    
    <style type="text/css">
      body {
  padding-top: 60px;
  padding-bottom: 40px;

      }
      .sidebar-nav {
        padding: 9px 0;
      }
    </style>
    <link href="assets/css/bootstrap-responsive-no-mobile.css" rel="stylesheet">

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
    <link href="assets/css/style.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Quicksand:300,400,700" rel="stylesheet" type="text/css">

</head>
  <body>
    <?php include_once("analyticstracking.php"); ?>
    <div id="wrap">
      <div class="container-fluid">
          <div class="row">
            <?php include ("nav.php"); ?>
         

         <div id='divWrap' class="span10">
            <div class="row-fluid">
              <div id="top-text">
                <div class='grey' style="font-size: 24px;">
                  <i class="blue icon-heart icon-large"></i> My Matches
                </div>
                <br>
                <ul class="nav nav-tabs">
                  <li class="active"><a href="my-matches-likely.php">Likely</a></li>
                  <li><a href="my-matches-pending.php">Pending <?php echo $pending_match_badge; ?></a></li>
                  <li><a href="my-matches-active.php">Active <?php echo $active_match_badge; ?></a></li>
                </ul>

                <h2 class="blue pagination-centered"> <span>Here are your likely matches!</span></h2>
                <p class="blue pagination-centered">These matches have been <strong>described by their friends</strong> to like someone similar to you!</p>
              </div> 
            </div> 
           


             <?php  


             

               //check if user been set up first. 
               if ((count_records('profile', $User_id)) == true){

                //then check if has claimed their profile
                  if (($_SESSION['Claimed']) == true){


                   //then check if user's matchable status is checked
                   if (($_SESSION['Matchable_status']) == true){
                      
                      
                        //include their pending matches if they have 1 or more
                        include ("my-matches-likely-inc.php");
                      
                       
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
       </div><!--/span9-->
      <div id="push"></div>
    </div><!--/container-->
  <div id="push"></div>
</div><!--/wrap-->
<?php include ("footer.php"); ?>
  
  <!-- Modal -->
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 class="blue" id="myModalLabel">Anonymously ask Fernanda's friends if:</h3>
  </div>
  <div class="modal-body">
  	<div class="row-fluid pagination-centered">
      <div class="span12">
      
        <select id="ask-list" data-placeholder="Choose" class="chzn-select">
          <option>I am</option>
          <option>Ben is</option>
          <option>David is</option>
          <option>Tom is</option>
          
        </select>
        
         <h4 style="display: inline;">a good match with <span class="first-name">Fernanda</span></h4>
       </div>
       <div class="row-fluid pagination-centered">
       
        <img src="http://placehold.it/100X100" alt="">
        <div id="icon" style="display: inline;" >
       	  <h4 style="display: inline;margin: 30px;"> + </h4>
        </div>
        <img src="http://placehold.it/100X100" alt="">
      </div>
      
      
   </div>
    
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">cancel</button>
    <a href="profile.php">
      <button class="btn btn-primary">ASK!</button>
    </a>
  </div>
</div>

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

    <script src="assets/js/zoom.js"></script>
    <script src="assets/js/jquery.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.21/jquery-ui.min.js"></script>
    <script src="assets/js/my-matches-likely.js"></script> 

    
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
