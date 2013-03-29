<!DOCTYPE html>
<html lang="en">
<head>

  <?php include ("header.php"); 
      require 'connect.inc.php';
      require 'core.inc.php';
      $user_id = check_input($_GET['user_id']);
      $this_profile = get_profile($user_id);
      $my_friends = get_friends($_SESSION['User_user_id']);
  ?>
    <meta charset="utf-8">
    <title><?php echo $this_profile['Name'] ?>'s profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link rel="stylesheet" href="assets/css/colorbox.css" /> 
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
              <div id="top-text" class="pagination-centered blue">
                <h2> <span>Who does <?php echo $this_profile['Name'] ?> like?</span></h2>
                <div id="ask-button-container" class='row pagination-centered span4 offset3'>
                 
                 <a href="#myModal" role="button" data-toggle="modal">
                  <button id="ask-button" class="btn btn-primary " type="button">Click here to find out!</button>
                </a>
               </div>
              </div> 
            </div> 
          <div id="profile">
               <div id="profile-top">
                 <div id="friend-summary">
                    <ul class="unstyled" id="profile-summary">
                      <li>
                        <h2 class="orange no-margin-bottom">
                          <?php echo $this_profile['Name'] ?>
                        </h2>
                      </li>
                      <li><span class="blue"> <?php echo $this_profile['Age']?>/<?php echo $this_profile['Gender']?>/<?php echo $this_profile['Sexual_pref']?>/<?php echo $this_profile['Relationship_status']?> </span> </li> 
                      <li><span class="blue"> <?php echo $this_profile['City'] ?> </span> </li>
                    </ul>
                  </div>
                  <div class="row-fluid" id="profile-photos">
                    <ul class="thumbnails">
                      <li class="span3">
                                <a id="main-pic-link" href="<?php echo $this_profile['Main_pic'] ?>" class="gallery thumbnail">
                                  <img class="big_pic" src=<?php echo $this_profile['Main_pic'] ?>>
                                </a> 
                       </li>
                       <li class="span3 profile-pic">
                                <a id="first-pic-link" href="<?php echo $this_profile['First_pic'] ?>" class="gallery thumbnail">
                                  <img class="profile_pic" src=<?php echo $this_profile['First_pic'] ?>>
                                </a> 
                       </li>
                       <li class="span3 profile-pic">
                                <a id="second-pic-link" href="<?php echo $this_profile['Second_pic'] ?>" class="gallery thumbnail">
                                  <img class="profile_pic" src=<?php echo $this_profile['Second_pic'] ?>>
                                </a> 
                       </li>
                       <li  class="span3 profile-pic">
                                
                                <a id="third-pic-link" href="<?php echo $this_profile['Third_pic'] ?>" class="gallery thumbnail">
                                  <img class="profile_pic" src=<?php echo $this_profile['Third_pic'] ?>>
                                </a> 
                       </li>               
                      </ul>
                    </div>          
                    
            </div>
                 </div>
                <div class="row">
                  <div class="span9">
                    <h2 id="describe-text" class="pagination-left"><span class="orange"> Can be described as: </span></h2>
                  </div>
                </div>  
                <div id="basics">
                  <div class="row-fluid">
                    <div id="basics-table" class="span12">
                      <table class="table table-striped">
                        <tbody>
                          <tr>
                            <td><strong>Ethnicity:</strong></td>
                            <td><em><?php echo $this_profile['Ethnicity']?></em></td>
                            <td><strong>Drinks:</strong></td>
                            <td><em><?php echo $this_profile['Drinks']?></em></td>
                          </tr>
                          <tr>
                            <td><strong>height:</strong></td>
                            <td><em><?php echo $this_profile['Height']?></em></td>
                            <td><strong>Smokes:</strong></td>
                            <td><em><?php echo $this_profile['Smokes']?></em></td>
                          </tr>
                          <tr>
                            <td><strong>Body Type:</strong></td>
                            <td><em><?php echo $this_profile['Body_type']?></em></td>
                            <td><strong>Drugs:</strong></td>
                            <td><em><?php echo $this_profile['Drugs']?></em></td>
                          </tr>
                          <tr>
                            <td><strong>Diet:</strong></td>
                            <td><em><?php echo $this_profile['Diet']?></em></td>
                            <td><strong>Kids:</strong></td>
                            <td><em><?php echo $this_profile['Kids']?></em></td>
                          </tr>
                          <tr>
                            <td><strong>Education:</strong></td>
                            <td><em><?php echo $this_profile['Education']?></em></td>
                            <td><strong>Hometown:</strong></td>
                            <td><em><?php echo $this_profile['Hometown']?></em></td>
                          </tr>
                          <tr>
                            <td><strong>Religion:</strong></td>
                            <td><em><?php echo $this_profile['Religion']?></em></td>
                            <td><strong>Income:</strong></td>
                            <td><em><?php echo $this_profile['Income']?></em></td>
                          </tr>
                          <tr>
                            <td><strong>Languages:</strong></td>
                            <td><em><?php echo $this_profile['Languages']?></em></td>
                           
                            <td><strong>Sign:</strong></td>
                            <td><em><?php echo $this_profile['Sign']?></em></td>
                          </tr>
                          <tr>
                            <td><strong>Politics:</strong></td>
                            <td><em><?php echo $this_profile['Politics']?></em></td>  
                            <td><strong>Profession:</strong></td>
                            <td><em><?php echo $this_profile['Profession']?></em></td>
                          </tr>
                          
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="row-fluid">
                    <div class="span12">
                      <h2 id="describe-text" class="pagination-left"><span class="orange"> What their friends' say: </span></h2>
                    </div>
                  </div>
                  <div class="row-fluid no-list-style">     
                      <?php echo $this_profile['friends_say'] ?>

                  </div>
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
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
    <h3 class="pagination-centered blue" id="myModalLabel">Anonymously ask <br> <?php echo $this_profile['Name']?>'s friends if:</h3>
  </div>
  <div class="modal-body">
    <div class="row-fluid pagination-centered">
      <div class="span12">
      
        <select id="ask-list" data-placeholder="Choose">
          <option main_pic='<?php echo $this_profile['Main_pic']?>' userid="<?= ($_SESSION['User_user_id']) ?>" fb_id="<?= ($_SESSION['fb_id']) ?>">I am </option>
          <?php echo $my_friends['friend_list'] ?>
          
        </select>
        
         <h4 style="display: inline;">a good match with <span class="first-name"><?php echo $this_profile['Name']?></span></h4>
       </div>
       <div class="row-fluid pagination-centered">
       
        <img id="ask-matchee" userid="<?= ($_SESSION['User_user_id']) ?>" src="<?php echo $_SESSION['Main_pic']?>">
        <div id="icon" style="display: inline;" >
          <h4 style="display: inline;margin: 30px;"> + </h4>
        </div>
        <img id="ask-match" userid="<?php echo $this_profile['userid']?>" src="<?php echo $this_profile['Main_pic']?>">
      </div>
      
      
   </div>
    
  </div>
  <div id ="modal-footer" class="modal-footer">
    <h5 id="ask-message"style="display: inline;"></h5>
    <button class="btn" data-dismiss="modal" aria-hidden="true">cancel</button>
    <a href="#">
      <button id="ask-confirm-button" class="btn btn-primary">ASK!</button>
    </a>
  </div>
</div>

 <!-- Modal -->
<div id="unclaimed" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
    <h3 class="blue" id="myModalLabel">Profile not set up yet</h3>
  </div>
  <div class="modal-body">
    <div class="row-fluid pagination-centered">
      <div class="span12">
      
         <h4 style="display: inline;">This users friends have not yet set them up. </h4>
       </div>
       
   </div>  
  </div>
  <div class="modal-footer">
    <a "#">
      <button class="btn btn-primary" data-dismiss="modal">Ok</button>
    </a>
  </div>
</div>

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
      <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.21/jquery-ui.min.js"></script>
    <script src="assets/js/jquery.colorbox.js"></script>
    <script type="text/javascript" src="assets/js/profile.js"></script>  
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
