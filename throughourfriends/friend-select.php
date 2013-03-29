<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Friend select</title>
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
	<script src="assets/js/friend-select.js"></script>
  


  
    
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
require 'assets/php/facebook/fbappconfig.php'; 
?>

<?php

# Creating the facebook object
  $facebook = new Facebook(array(
  'appId'  => $_SESSION['app_id'],
  'secret' => $_SESSION['secret'],
  'cookie' => true,
  ));

// save variables from session
$token = $_SESSION['token'];
		
$id = ($_SESSION['fb_id']);

//call faceboook api to get list of friends then save them into local php variable
$friends = $facebook->api("/".'me'."/friends?access_token=".$token);
?>

<script type="text/javascript">


$(document).ready(function() {


 if (document.documentElement.clientWidth < 980) {
  // check if user is mobile or not. 

    $(window).scroll(function(){
      var scrolltop = $(window).scrollTop();
      if(scrolltop>=180) {
       $("#search-top").addClass("search-top-fixed");
       
      } else {
        $(".search-top-fixed").removeClass("search-top-fixed");
     
      }
    });
}



//save friend list to JSON object
var friends = <?php echo json_encode($friends); ?>;

//create friends_table ul
var friends_table = $('<ul id="friend-table" class="thumbnails"></ul>');

//populate friends into DOM
pop_friends(friends);

//Show the first 28 friends at first
for(var i=0; i < 50; i++) {
   $("#"+i).show();
}

// hide and show friends when search criteria matches friends name
 $("#friend-search").keyup(function(){
   var width = screen.width;
    var val=$(this).val();
   $(".friend-li").hide().filter(":containsi('"+val+"')").find('.friend-li').andSelf().show();
 });

// custom containsi fucntion to search case insensetive
 $.extend($.expr[':'], {
  'containsi': function(elem, i, match, array)
  {
    return (elem.textContent || elem.innerText || '').toLowerCase()
    .indexOf((match[3] || "").toLowerCase()) >= 0;
  }
});



//function pop friends will take in friends and display each element in DOM
 function pop_friends(friends1) {
     for(var i=0; i < friends.data.length; i++) {
    friends_table.append("<li class='span2 friend-li' id="+i+" friend_id="+friends1.data[i].id+" style='display: none;'> <a href='#myModal' class='thumbnail' data-toggle='modal'> <img class='friend-thumb' src= https://graph.facebook.com/"+friends1.data[i].id+"/picture?width=140&height=100 /> </a> <p style='height:20px;'> <span class='first-name-friend-select'>"+(friends1.data[i].name)+"</span> </p> </li>");
	} 

   
$('#friend-row').append(friends_table);
}

});
</script>




      <div class="container-fluid">
          <div class="row">
		    
           
		   <?php include ("nav.php"); ?>
          <div class="span10 pagination-centered">
            
            <div>
              <h2 class="blue"> Click on the friend you're setting up! </h2>
              <hr>
              <div id='search-top' class='row-fluid'>
                <input id="friend-search" type="text" placeholder="Enter friends' name here">
              </div>
            </div>



            <div id="friend-row" >
			 
              
            </div>
          </div><!--/span-->
          <div class="row">
              <div class="span1">
              </div><!--/span-->
          </div><!--/row-->
          </div><!--/.fluid-container-->
      </div>
      <div id="push"></div>
  	</div><!--/wrap-->	
  <?php include ("footer.php"); ?>

<!-- Modal -->
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 class="blue" id="myModalLabel">Select your friend</h3>
  </div>
  <div class="modal-body">
  	<div class="row-fluid pagination-centered">
      <div class="span4">
        <img id="friend-img" src="http://placehold.it/100X100" alt="">
      </div>

      <div class="span8" style="margin-top: 20px;">
      <h4 class="blue">Are you sure you want to set up:</h4>
      <h3 id="friend-name" class="first-name"> Tom Furstenburg-Carroll </h3>
    </div>
    <div class="row-fluid text-align-left" >
      
        <strong class="blue">I'm their: </strong>
        
        <div class="control-group" style="display: inline;" >        
            <div class="controls" style="display: inline;">
              <select id="relationship_of_friend" style="width: 140px; margin-top:5px;">
                <option>Friend</option>
                <option>College Friend</option>
                <option>Highschool Friend</option>
                <option>Childhood Friend</option>
                <option>Family Friend</option>
                <option>Family</option>
                <option>Brother</option>
                <option>Sister</option>
                <option>Mother</option>
                <option>Cousin</option>
                <option>Son</option>
                <option>Daughter</option>
                <option>Grandchild</option>
              </select>
            </div>
      
      </div>

        
                  


        
    </div>
    </div>
    
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">No</button>
    <a>
      <button id="friend-select" class="btn btn-primary">Yes, thats right</button>
    </a>
  </div>
</div>
  
  

    <!-- Le javascript
    ================================================== -->
   
    
    

  </body>
  
</html>


