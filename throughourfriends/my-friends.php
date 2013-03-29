<!DOCTYPE html>
<html lang="en">
<head>
    <link href="assets/css/font-awesome.css" rel="stylesheet">
    <link href="assets/css/bootstrap-no-mobile.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/chosen.css" rel="stylesheet">
    <link href="assets/css/jquery-ui.css" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Quicksand:300,400,700" rel="stylesheet" type="text/css">

  <?php  
      include ("header.php");
      require 'connect.inc.php';
      require 'core.inc.php';
      $User_id = $_SESSION['User_user_id'];
      $my_friends = get_friends($User_id);    

  ?>
  
    <meta charset="utf-8">
    <title>My friends</title>
    <meta name="viewport" content="width=device-width">
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
      <div class="container-fluid">

          <div class="row">
            <?php include ("nav.php");
            
            //check if user has any friends yet. 
             if ((count_records('friends', $User_id)) == true){
              include ("my-friends-inc.php");
           } else{
             include ("my-friends-empty-inc.php");
           }

             ?>
           
       </div><!--/span9-->
      <div id="push"></div>
    </div><!--/container-->
  <div id="push"></div>
</div><!--/wrap-->
<?php include ("footer.php"); ?>
  
 <!-- edit tastes modal -->
<div id="modal_profile" class="modal modal-big hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">

    <button type="button" class="close close_btn" data-dismiss="modal" aria-hidden="true">&times</button>
    <h3 class="blue">Options</h3>
  </div>
  <div id='modal-body' class="modal-body">
  </div>

  <div class="modal-footer">
    <div class="text-align-center success-message-unique"></div>
    <button unique-changed='false' id='save-options-button' class='pull-right btn btn-primary profile-button' type='button'>Save</button>
    <a href="#" data-dismiss="modal" class="pull-right btn">Cancel</a>
  </div>
</div> 




    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/zoom.js"></script>
  
    <script src="assets/js/jquery.js"></script>

<script src="assets/js/my-friends.js"></script>
     <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.21/jquery-ui.min.js"></script>
    <script src="assets/js/chosen-jquery.js"></script>
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
