<!DOCTYPE html>
<html lang="en">
<head>
    <?php  
      include ("header.php");
      require 'connect.inc.php';
      require 'core.inc.php';
      require("count.php");
      $User_id = $_SESSION['User_user_id'];
      $my_matches = get_active_matches_and_friends($User_id);   
      $my_messages = get_messages(0, 10, 'sent');
      $New_message_count = $_SESSION['New_message_count'];
      if ($New_message_count > 0) {
          $message_badge = ("<span class='badge badge-important'>$New_message_count</span>");
        } 
       
  ?>
    <meta charset="utf-8">
    <title>My Messages</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="assets/css/font-awesome.css" rel="stylesheet">
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    
    <link href="assets/css/style.css" rel="stylesheet">
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
      
      <div class="container-fluid">
          <div class="row">
            <?php include ("nav.php"); ?>
          <div class="span10">
            <div class="row">
              <div id="top-text">
                <div class='grey' style="font-size: 24px;">
                  <i class="blue icon-heart icon-large"></i> My Messages
                  <a href="#compose-modal" role="button" data-toggle="modal">
                    <button id="edit-basics-button" class="btn btn-success btn-large profile-button pull-right" type="button">Compose</button>
                  </a>
                </div>
                <br>
                <ul class="nav nav-tabs">
                  <li><a href="my-messages.php">Incoming <?php echo $message_badge; ?></a></li>
                  <li class="active"><a href="my-messages-sent.php">Sent</a></li>
            	</ul>
                <h2 class="blue pagination-centered"> <span>View your sent messages</span></h2>
              </div> 
            </div> 
            
            <div class="row" id="incoming-messages">

              <?php 
               //first check if user's matchable status is checked
                if (($_SESSION['Matchable_status']) == true){
                    //then, check if user has any incoming messages yet. 
                     if ((count_records('incoming_messages', $User_id)) == false){
                      //display you have no messages page
                      include ("my-messages-sent-empty-inc.php");
                   } 
                }
                ?>

                <table class="table table-striped table-hover">
                  <tbody>
                    <?php 
                      //check if users' matchable status is checked
                        if (($_SESSION['Matchable_status']) == true){
                          //check if user has any incoming messages
                          if ((count_records('incoming_messages', $User_id)) == true) {
                            //echo out the incoming messages
                            echo $my_messages['my_messages'];
                            } 
                          }else{
                            //show the not matchable page if they are not matchabel
                            include ("my-messages-not-matchable-inc.php");
                          }
                          ?>
                    </tbody>
                  </table>             
            </div>       
            <div id="push"></div>
          </div><!--/container-->
        <div id="push"></div>
      </div><!--/wrap-->
    </div>
    <?php include ("footer.php"); ?>
  
  <!-- Modal sent message -->
<div id="myModal" class="modal hide fade big-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
    <h3 id='message_title' class="blue" id="myModalLabel"></h3>
  </div>
  <div class="modal-body">
    <div id="message_from"class="row-fluid">
      <div class="span12">
        <div class="span2 hidden-phone">
         <img class='main-profile-pic' userid = "" id="message_pic_from_modal" src="<?php echo $_SESSION['Main_pic']?>"> </img> </img>
        </div>
        <div class="well span10" style='margin-top:0%;'>
          <div class="row-fluid">
            <div class="span6 well well-small background-color-white">
              <span id="message_from_modal"></span>
            </div>
            <div style="margin-top: 10px;" class="text-align-right span4 offset2">
              <span id="message_date_modal"></span>
            </div>
            <div class="row-fluid">
              <div id="message_text" class="span12 well well-small background-color-white">
                <p id="complete_message_modal"></p>
              </div>
            </div>
          </div>  
        </div>    
      </div>  
    </div>

    <div id="message_reply"class="row-fluid">
      <div class="span12">
        <div class="span2 hidden-phone">
          <img class='main-profile-pic' userid = "" id="message_pic_reply_modal" src="<?php echo $_SESSION['Main_pic']?>"> </img>
        </div>
        <div class="well span10" style='margin-top:0%;'>

          <div id='reply-error' class="alert alert-error" style='display:none'>  
            <a class="close close_btn">x</a>
            <strong>Whoops</strong>, can't send an empty message.  
          </div> 


          <div class="row-fluid">
            <div class="span6 well well-small background-color-white">
              <span id="message_to_modal"></span>
            </div>
            <div style="margin-top: 10px;" class="text-align-right span4 offset2">
              <span> Now </span>
            </div>
            <div class="row-fluid">
              <div id="message_text">
                <textarea id="reply_message_text" class="span12" rows="3"></textarea>
              </div>
            </div>
          </div>  
        </div>    
      </div>  
    </div>
  </div>
  <div class="modal-footer">
    <button class="btn cancel_btn" data-dismiss="modal" aria-hidden="true">cancel</button>
    <a id="reply_button" aria-hidden="true" class="btn btn-primary">Send</a>
  </div>
</div>

<!-- Modal compose -->
<div id="compose-modal" class="modal hide fade big-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
    <h3 class="blue" id="myModalLabel">Compose new message</h3>
  </div>
  <div class="modal-body">
    <div id="message_reply"class="row-fluid">
      <div class="span12">
        <div class="span2 hidden-phone" >
          <img class='main-profile-pic' src="<?php echo $_SESSION['Main_pic']?>"> </img>
        </div>
        <div class="well span10" style='margin-top:0%;'>

          <div id='compose-error' class="alert alert-error" style='display:none'>  
            <a class="close close_btn">x</a>
            <strong>Whoops</strong>, please select a match and/or construct a message.  
          </div> 

          <div class="row-fluid">
            <div class="span6">
              <select id="match-list" class="span12" >
                <option>Select a match</option>
                <?php echo $my_matches['match_list'] ?>
              </select>
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
    <a id="send_message" class="btn btn-primary">Send</a>
  </div>
</div>
  

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/my-messages-sent.js"></script>
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
