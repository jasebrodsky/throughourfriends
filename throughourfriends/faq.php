<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>faq</title>
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
                  <i class="blue icon-search icon-large"></i> Frequently Asked Questions
                </div>
                <br>
              </div> 
                <div class="row-fluid ">
                  <div class="faq ">
               <div class="row-fluid well">
                  <div class="span12">
                     <!-- FAQ hero -->
                     <div class="hero">
                        <h3 class='blue'>Looking for an explanation? You’ve come to the right place.</h3>
                     </div>
                     <hr>
                     <!-- FAQ -->
                     <div class="accordion" id="accordion2">                        
                        <!-- First Accordion -->
                       <div class="accordion-group">
                         <div class="accordion-heading">
                           <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                              <!-- Title. Don't forget the <i> tag. -->
                             <h5><i class="icon-plus blue"></i> How are matches made?</h5>
                           </a>
                         </div>
                         <div id="collapseOne" class="accordion-body collapse" style="height: 0px;">
                           <div class="accordion-inner">
                              <!-- Para -->
                             <p>Matches are intiatiated by clicking the main match button seen on a users' profile page and selecting a matchee. After that, atleast one of the matchhee's friends must approve this specific match. Once a match is friend approved, both matchee and their match must approve eachother in their <a href='my-matches-pending.php'>pending matches page</a>. Then, they both will appear in eachothers <a href='my-matches-pending.php'>active matches page</a> where they can messsage eachother.</p>
                           </div>
                         </div>
                       </div>
                       <!-- Second Accordion -->
                       <div class="accordion-group">
                         <div class="accordion-heading">
                           <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                             <h5><i class="icon-plus blue"></i> How do I set up my friend?</h5>
                           </a>
                         </div>
                         <div id="collapseTwo" class="accordion-body collapse" style="height: 0px;">
                           <div class="accordion-inner">
                             <p>It's super easy to set up your friends. Just click on the <a href='friend-select.php'>setup a friend button </a> seen on your <a href='my-friends.php'>my-friends page</a>. Next, click on a friend you want to setup. If you don't see your friend immediately try using the search at the top of the page. Next, you'll need to describe who they are with photos and some basic descriptions. After that, you'll need to share who YOU think they would be interested in. That's it! Now you'll be all set to start matching them with people that have been set up by their friend's who match your friends criteria.  </p>
                           </div>
                         </div>
                       </div>
                       <!-- Thrid accordion -->
                       <div class="accordion-group">
                         <div class="accordion-heading">
                           <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                             <h5><i class="icon-plus blue"></i> I've been setup, now what?</h5>
                           </a>
                         </div>
                         <div id="collapseThree" class="accordion-body collapse">
                           <div class="accordion-inner">
                             <p>First of all, Congrats on being set up! You will first need to claim your profile on the <a href='my-profile.php'> My Profile page </a>. Before claiming your profile you can edit any part about it. Once your happy with it, click the claim button at the bottom. You can always edit your profile aftewards too After that, you will be able to see your <a href='my-matches-likely.php'> likely matches</a> (people that have been described to like someone similar to you) or <a href='my-matches-pending.php'>pending matches </a> (people who have been approved to meet you by your friend or theirs) or even use the <a href='search.php'>search </a> to intiate your own matches.</p>
                           </div>
                         </div>
                       </div>
                       <!-- Fourth accordion -->
                       <div class="accordion-group">
                         <div class="accordion-heading">
                           <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
                             <h5><i class="icon-plus blue"></i>How to edit my profile?</h5>
                           </a>
                         </div>
                         <div id="collapseFour" class="accordion-body collapse">
                           <div class="accordion-inner">
                             <p>You have full control over every detail seen on your profile. Changing your basic information, photos, or even removing what a friend said about you can all be done inside the <a href='My-profile.php'>My Profile page</a>. You can click on the Edit photo button to change any photo seen. Click the edit button on the right if you want to change any part of your description. Lastly, you can remove anything a friend has said about you by clicking the orange 'x' next to their photo. Everything is updated immediately. </p>
                           </div>
                         </div>
                       </div>
                       <!-- Fifth accordion -->
                       <div class="accordion-group">
                         <div class="accordion-heading">
                           <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseFive">
                             <h5><i class="icon-plus blue"></i> How to change my email settings?</h5>
                           </a>
                         </div>
                         <div id="collapseFive" class="accordion-body collapse">
                           <div class="accordion-inner">
                             <p>Changing your email settings is easy. Go to your <a href='settings.php'> Settings page</a> where you can decide what emails you want to recieve. You can choose to recieve an email every time a new friend wants to set you up, you recieved a new pending match, recieve a new active match, or recieve a message from a match. You can also update your email if you'd like.  </p>
                           </div>
                         </div>
                       </div>

                       <!-- sixth accordion -->
                       <div class="accordion-group">
                         <div class="accordion-heading">
                           <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseSix">
                             <h5><i class="icon-plus blue"></i> What is Matchable status seen in my settings page?</h5>
                           </a>
                         </div>
                         <div id="collapseSix" class="accordion-body collapse">
                           <div class="accordion-inner">
                             <p>The matchable status seen inside your <a href='settings.php'>settings page</a> just tells us if you are able to recieve matches and messages. If you are in a relationship with someone you should definetly disable your matchable status. You will still be able to help your friends out with matches and use the search. You can always re-enable your matchable status by clicking the checkbox if you are single. </p>
                           </div>
                         </div>
                       </div>
                       
                     </div>
                     
                  </div>
               </div>
           
                 
            </div>
            <br></br>
          </div>
         </div>
      </div>
    </div><!--/container-->
   <div id="push"></div>
  </div><!--/wrap-->
<?php include ("footer.php"); ?>
  
  
  

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
