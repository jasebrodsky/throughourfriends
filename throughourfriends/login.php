
<?php
session_start();
session_destroy();
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Bootstrap, from Twitter</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/css/font-awesome.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/chosen.css" rel="stylesheet">
    <link href="assets/css/jquery-ui.css" rel="stylesheet">
    <link href="assets/css/bootstrap-responsive.css" rel="stylesheet">
    <link href="assets/css/footer.css" rel="stylesheet" type="text/css">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
    </style>
    

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="shortcut icon" href="../assets/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">

  </head>

  <body>
  	<?php include_once("analyticstracking.php"); ?>




  
  <div id="wrap">
    

    <div class="container">

      <!-- Main hero unit for a primary marketing message or call to action -->
      <div class="hero-unit pagination-centered">
        <h1>Bemigo</h1>
        <h2>You have been logged out of Bemigo!</h2>
        <p><a id="friend-setup-button" class="btn btn-primary btn-large">Set up your friend &raquo;</a></p>
        
        <div id="friend-setup" style="display: none;">
          <h3>To set up your friend, just enter their name below!</h3>
          <div><i class="icon-circle-arrow-down icon-large"></i></div>
          <input style="margin-top: 10px; margin-bottom: 20px;" id="friend-name" type="text" size="50" placeholder="Your friends name here">
          <div><i class="icon-circle-arrow-down icon-large"></i></div>
          <h3>Now click login with Facebook to prove you're their friend</h3>
         
    
        </div>
      </div>
      
     

      <!-- Example row of columns -->
      <div class="row pagination-centered">
        <div class="span4">
          <h2>Step 1</h2>
          <p>Pick a friend to set up and tell us about them. </p>
          
        </div>
        <div class="span4">
          <h2>Step 2</h2>
          <p>Describe who they would like to meet.  </p>
          
       </div>
        <div class="span4">
          <h2>Step 3</h2>
          <p>Accept and reject people that want to meet your friend!</p>
          
        </div>
      </div>

      <hr>

      <div id="push"></div>
    </div><!--/wrap-->
     <?php include ("footer.php"); ?>

    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
   <script src="assets/js/jquery.js"></script>
  <script src="assets/js/home.js"></script>
    
    
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
  


  </body>
</html>
