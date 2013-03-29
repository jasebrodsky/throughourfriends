<?php 

# start session
if(!isset($_SESSION))
{
session_start();
}

if (!isset($_SESSION['User_user_id'])) {
    // Redirection to login page
    header("location: index.php");
}

require 'connect.inc.php';
require 'assets/php/facebook/facebook.php'; //include the facebook php sdk in order to intialize the facebook object
require 'assets/php/facebook/functions.php';
require 'assets/php/facebook/fbappconfig.php';



$facebook = new Facebook(array(
	'appId'  => $_SESSION['app_id'],
	'secret' => $_SESSION['secret'],
	'cookie' => true,
	));

$params = array( 'next' => $_SESSION['logout_next'] );
$logoutUrl = $facebook->getLogoutUrl($params);


// save variables from session
$token = $_SESSION['token'];
$id = ($_SESSION['fb_id']);
$name = ($_SESSION['Name']);


?>	

<?php require("count.php"); 

$New_message_count = $_SESSION['New_message_count'];
$New_friend_count = $_SESSION['New_friend_count'];
$New_pending_match = $_SESSION['New_pending_match'];
$New_active_match = $_SESSION['New_active_match'];

$Total_new_match = ($New_active_match + $New_pending_match);
$Total_notifications = ($New_active_match + $New_pending_match + $New_message_count + $New_friend_count);



if ($Total_notifications > 0) {
	$Total_notifications_badge = ("<span id='total_notifcations_badge' style='position: fixed; margin-left: 10px;' class='visible-phone visible-tablet badge badge-important'>$Total_notifications</span>");
}
	else {
	              $Total_notifications_badge = (""); 
	            }


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
	
<header>
<script src="assets/js/jquery.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {

			$("#account-list-btn").click(function() {
				$("#nav-list").hide();
				$("#account-list").show();
				$("#account-list").addClass('open');

			});

			$("#nav-list-btn").click(function() {
				$("#nav-list").show();
				$("#account-list").hide();
				$("#nav-list").addClass('open');
			});
		});



	</script>


  
  <div class="navbar navbar-inverse navbar-fixed-top">

	<div class="navbar-inner">
	  <div class="container-fluid">
	  	

	  	<a id='account-list-btn' style='float: left;' class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
		  <span class="icon-bar"></span>
		  <span class="icon-bar"></span>
		  <span class="icon-bar"></span>
		  <?php echo $Total_notifications_badge; ?>
		</a>
		
		

		<a id='nav-list-btn' class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
		  <span class="icon-bar"></span>
		  <span class="icon-bar"></span>
		  <span class="icon-bar"></span>
		</a>
		

		<a class="brand" href="index.php"><img  src='assets/img/TOF%20LogoInLineGrey.png'> </img> </a>
		<div class="nav-collapse collapse">
		  <ul class="nav pull-right">
			
			<li id='account-list' class="dropdown">
			  <a >
			  </a>
			  <ul  style="float: left;" class="span5 dropdown-menu">
				<li><a href="my-profile.php"><i class="icon-user"></i>My Profile <?php echo $new_friend_badge; ?></a></li>
				<li><a href="my-friends.php"><i class="icon-group"></i>My Friends </a></a></li>
				<li><a href="search.php"><i class="icon-search"></i>Search</a></li>
				<li><a href="my-matches-likely.php"><i class="icon-heart"></i>My matches <?php echo $total_new_match_badge; ?></a></li>
				<li><a href="my-messages.php"><i class="icon-envelope"></i> My messages <?php echo $message_badge; ?>  </a></li>
			  </ul>
			 </li>
			 
			 <li id='nav-list' class="dropdown">
			  

			 <a href="#" id="drop3" role="button" class="dropdown-toggle" data-toggle="dropdown">Account <b class="caret"></b></a>

			  <ul style="float: right;" class="dropdown-menu" role="menu" aria-labelledby="drop3">
				<li><a role="presentation" href="my-profile.php"><i class="icon-edit"></i>Edit profile</a></li>
				<li><a role="presentation" href="settings.php"><i class="icon-wrench"></i>Settings</a></li>
				<li><a role="presentation" href="faq.php"><i class="icon-cog"></i>Help</a></li>
				<li role="presentation" class="divider"></li>
				<li><a role="presentation" href="<?php echo $logoutUrl; ?>"><i class="icon-plane"></i>Log out</a></li>
			  </ul>
			</li>
		  
		  </ul>
		  <p class="navbar-text pull-right">
			Logged in as <a href="my-profile.php" class="navbar-link"><?=($_SESSION['Name'])?></a>
		  </p>
		  <div class="pull-right"> 
		  	<img id="logged-in-user" class="image" userid="<?=($_SESSION['User_user_id'])?>"src="<?=($_SESSION['Main_pic'])?>" img>
		  </div>
		</div><!--/.nav-collapse -->
	  </div>
	</div>
  </div>
</header>
	<!-- begin olark code -->
	<script data-cfasync="false" type='text/javascript'>/*<![CDATA[*/window.olark||(function(c){var f=window,d=document,l=f.location.protocol=="https:"?"https:":"http:",z=c.name,r="load";var nt=function(){
	f[z]=function(){
	(a.s=a.s||[]).push(arguments)};var a=f[z]._={
	},q=c.methods.length;while(q--){(function(n){f[z][n]=function(){
	f[z]("call",n,arguments)}})(c.methods[q])}a.l=c.loader;a.i=nt;a.p={
	0:+new Date};a.P=function(u){
	a.p[u]=new Date-a.p[0]};function s(){
	a.P(r);f[z](r)}f.addEventListener?f.addEventListener(r,s,false):f.attachEvent("on"+r,s);var ld=function(){function p(hd){
	hd="head";return["<",hd,"></",hd,"><",i,' onl' + 'oad="var d=',g,";d.getElementsByTagName('head')[0].",j,"(d.",h,"('script')).",k,"='",l,"//",a.l,"'",'"',"></",i,">"].join("")}var i="body",m=d[i];if(!m){
	return setTimeout(ld,100)}a.P(1);var j="appendChild",h="createElement",k="src",n=d[h]("div"),v=n[j](d[h](z)),b=d[h]("iframe"),g="document",e="domain",o;n.style.display="none";m.insertBefore(n,m.firstChild).id=z;b.frameBorder="0";b.id=z+"-loader";if(/MSIE[ ]+6/.test(navigator.userAgent)){
	b.src="javascript:false"}b.allowTransparency="true";v[j](b);try{
	b.contentWindow[g].open()}catch(w){
	c[e]=d[e];o="javascript:var d="+g+".open();d.domain='"+d.domain+"';";b[k]=o+"void(0);"}try{
	var t=b.contentWindow[g];t.write(p());t.close()}catch(x){
	b[k]=o+'d.write("'+p().replace(/"/g,String.fromCharCode(92)+'"')+'");d.close();'}a.P(2)};ld()};nt()})({
	loader: "static.olark.com/jsclient/loader0.js",name:"olark",methods:["configure","extend","declare","identify"]});
	/* custom configuration goes here (www.olark.com/documentation) */
	olark.identify('3976-943-10-8501');/*]]>*/</script><noscript><a href="https://www.olark.com/site/3976-943-10-8501/contact" title="Contact us" target="_blank">Questions? Feedback?</a> powered by <a href="http://www.olark.com?welcome" title="Olark live chat software">Olark live chat software</a></noscript>
	<!-- end olark code -->
