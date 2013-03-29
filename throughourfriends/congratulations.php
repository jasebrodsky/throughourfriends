
		<?php
			
				$matchmaker = ('');
				$friend = ('');

			if ((isset($_GET['mm'])) and (isset($_GET['f']))) {
		
				$matchmaker = ($_GET['mm']);
				$friend = ($_GET['f']);

				 };
		?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>ThroughOurFriends</title>
		<meta property="og:title" content="ThroughOurFriends" />
		<meta property="og:type" content="website" />
		<meta property="og:url" content="http://throughourfriends.com/congratulations.php?mm=<?php echo($matchmaker) ?>&f=<?php echo($friend) ?>" />
		<meta property="og:image" content="http://africanlimelight.com/wp-content/uploads/2012/09/basketballwivesla2-200x200.jpg" />
		<meta property="og:description" content="Who knows you better than your friends?" />

		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">
		<link href="assets/css/bootstrap.min.css" rel="stylesheet">
		<link href="assets/css/bootstrap-responsive.min.css" rel="stylesheet">
		<link href="assets/css/style-launch.css" rel="stylesheet">
		<link href="assets/css/bootstrap-lightbox.min.css" rel="stylesheet">
		<link href='http://fonts.googleapis.com/css?family=Quicksand:300,400,700' rel='stylesheet' type='text/css'>
		<link rel="image_src" href="http://awerest.com/demo/superawesome/skyapp/thumbnail.png" />
		<link rel="icon" type="image/ico" href="favicon.ico">

	</head>
	<body data-spy="scroll" data-target=".navbar">
		<?php include_once("analyticstracking.php"); ?>

		<div id="home">
			<div class="container"> 
				
				
				

				<div class="row">
					<div class="span6 margin5 visible-phone text-align-center">
						<img src="assets/img/Logo.png" alt="">
						<h1 class="margin5 margin-5">Congratulations <?php echo($friend) ?>! <br> Your friend <?php echo($matchmaker) ?> has someone <br> for you to meet! </h1>
						<a class="button btn btn-large margin-5 margin5" href="fbconnect.php"><img src="assets/img/ButtonIconOrange.png" alt=""> See who it is </a>
					</div>
					
					<div class="span12 margin5 hidden-phone text-align-center">
						<img src="assets/img/Logo.png" alt="">
						<h1 class="margin5 margin-5">Congratulations <?php echo($friend) ?>! <br> Your friend <?php echo($matchmaker) ?> has someone <br> for you to meet! </h1>
						<a class="button btn btn-large margin-5 margin5" href="fbconnect.php"><img src="assets/img/ButtonIconOrange.png" alt=""> See who it is </a>

						


					</div>
				</div>
			</div>
		</div>
	<!-- break -->
		
	<!-- break -->
		<div class="footer"> 
			<div class="container"> 
				<div class="row">
					<div class="span4 margin5 margin-5">
						<span>Who knows your friends better than you?</span>
					</div>
					<div class="span4 margin5 margin-5">
						<img src="assets/img/TOF%20LogoBlack.png" alt="">
					</div>
					<div class="span4 margin5 margin-5">
						<a class="button btn" href="http://www.facebook.com/awerest" target="_blank"><img src="http://awerest.com/demo/superawesome/skyapp/img/social/facebook_icon.png" alt=""></a>
						<a class="button btn" href="http://twitter.com/awerest" target="_blank"><img src="http://awerest.com/demo/superawesome/skyapp/img/social/twitter_icon.png" alt=""></a>
						<a class="button btn" href="http://instagram.com/awerest/" target="_blank"><img src="http://awerest.com/demo/superawesome/skyapp/img/social/instagram_icon.png" alt=""></a>
						<a class="button btn" href="http://pinterest.com/awerest/" target="_blank"><img src="http://awerest.com/demo/superawesome/skyapp/img/social/pinterest_icon.png" alt=""></a>
						<a class="button btn" href="mailto:someone@example.com" target="_blank"><img src="http://awerest.com/demo/superawesome/skyapp/img/social/mail_icon.png" alt=""></a>
					</div>
				</div>
			</div>
		</div>
	<script src="http://code.jquery.com/jquery-latest.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/retina.js"></script>
	<script src="assets/js/jquery.backstretch.min.js"></script>
	<script src="assets/js/bootstrap-lightbox.min.js"></script>
	<script src="assets/js/custom.js"></script>
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
	<script type="text/javascript">
		var settingsItemsMap = {
			zoom: 13,
			center: new google.maps.LatLng(40.718344,-73.991352),
			panControl: false,
			zoomControl: true,
			zoomControlOptions: {
				style: google.maps.ZoomControlStyle.SMALL
			},
			mapTypeControl: false,
			scaleControl: false,
			streetViewControl: false,
			overviewMapControl: false,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		};
		var map = new google.maps.Map(document.getElementById('map_canvas'), settingsItemsMap );

		var myMarker = new google.maps.Marker({
			position: new google.maps.LatLng(40.718344,-73.991352),
			draggable: false
		});

		map.setCenter(myMarker.position);
		myMarker.setMap(map);
	</script>
	<div id="backstretch" style="left: 0px; top: 0px; position: fixed; overflow: hidden; z-index: -999999; margin: 0px; padding: 0px; height: 322px; width: 1349px;"><img style="position: absolute; margin: 0px; padding: 0px; border: none; z-index: -999999; max-width: none; width: 1349px; height: 843.125px; left: 0px; top: -260.5625px;" src="assets/img/LandingPageBG.jpg"></div>
	
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

	</body>
</html>