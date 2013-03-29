<?php require("count.php"); 

$New_message_count = $_SESSION['New_message_count'];
$New_friend_count = $_SESSION['New_friend_count'];
$New_pending_match = $_SESSION['New_pending_match'];
$New_active_match = $_SESSION['New_active_match'];

$Total_new_match = ($New_active_match + $New_pending_match);

if ($New_message_count > 0) {
	$message_badge = ("<span class='badge badge-important'>$New_message_count</span>");
}
	else {
	          $message_badge = (""); 
	        }



if ($New_friend_count > 0) {
	$friend_badge = ("<span class='badge badge-important'>$New_friend_count</span>");
}
	else {
	              $friend_badge = (""); 
	            }




if ($Total_new_match > 0) {
	$total_new_match_badge = ("<span class='badge badge-important'>$Total_new_match</span>");
}
	else {
	              $total_new_match_badge = (""); 
	            }



if ($New_friend_count > 0) {
	$new_friend_badge = ("<span class='badge badge-important'>$New_friend_count</span>");
}
	else {
	              $new_friend_badge = (""); 
	            }

?>






<div id='nav-wrap' class="span2 visible-desktop">
  <div class="sidebar-nav-fixed">
    <ul class="nav nav-list">
      <li><a href="my-profile.php"><i class="icon-user"></i>My Profile <?php echo $new_friend_badge; ?></a></li>
      <li><a href="my-friends.php"><i class="icon-group"></i>My Friends </a></li>
      <li><a href="search.php"><i class="icon-search"></i> Search</a></li>
      <li><a href="my-matches-likely.php"><i class="icon-heart"></i> My matches <?php echo $total_new_match_badge; ?></a></li>
      <li><a href="my-messages.php"><i class="icon-envelope"></i> My messages <?php echo $message_badge; ?>  </a></li>
    </ul>
  </div><!--/.well -->
</div><!--/span-->