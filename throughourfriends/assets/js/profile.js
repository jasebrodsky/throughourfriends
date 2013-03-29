$(document).ready(function() {

	//save variables on page load
	var matchmaker = $('#logged-in-user').attr("userid");
	var match_userid = $('#ask-match').attr("userid");
	var matchee_userid =$('#ask-matchee').attr("userid");
	

	$("#ask-list").change(function(){
	            
        // save new variables if friend changes.
        var element = $("option:selected", this);
        var matchee_userid =element.attr("userid");
        var fb_id = element.attr("fb_id");
        var main_pic = element.attr("main_pic");



     
     	// update the friend summary describing your friend on friend change.
        $("#ask-matchee").attr('src', main_pic);
        $("#ask-matchee").attr('userid', matchee_userid);

        $("#modal-footer").html("<h5 id='ask-message'style='display: inline;'></h5><button class='btn' data-dismiss='modal' aria-hidden='true'>cancel</button><a href='#''><button id='ask-confirm-button' class='btn btn-primary'>ASK!</button></a>");
  		
     });

	//colorbox plugin. Treat all a tags with class gallery as image for the colorbox photo viewer. 
	$('a.gallery').colorbox({ opacity:0.5 , rel:'group1' });

	//if main pic is .jpg run photo:false, else run photo:true
	var main_pic_link = $('#main-pic-link').attr('href'); //save link to var
	var last4 = main_pic_link.substr(main_pic_link.length - 4); // find last 4 char of link
	if (last4 == '.jpg'){ //if last4 characters is equal to '.jpg'
		$('#main-pic-link').colorbox({ opacity:0.5 , rel:'group1' }); //treat as photo:false (.jpg image)
	} else {
		$('#main-pic-link').colorbox({ photo:true, opacity:0.5 , rel:'group1' });//else trea as link (fb default profile photo format)
	}

	

	$("#ask-confirm-button").live("click", function() {
		
		    // put all form variables in variable to send in ajax call
		    var matchee_userid = $("#ask-matchee").attr("userid");
		    data = ("matchmaker=" + matchmaker +"&"+ "matchee=" + matchee_userid +"&"+ "match=" + match_userid);
	
			// ajax call to send via search variables 'data' via GET to load_profile_top.php. Take results and put on page. 
		    $.ajax({
		        type: "GET",
		        url: "save-match.php",
		        data: data,
		        success: function(result) {
		            $("#modal-footer").hide().html(result).fadeIn(2000);

		        }
		    });
		});

	$("#after-ask-button").live("click", function() {
		// after the ok button is clicked change the modal footer back to an ask and cancel button
		$("#modal-footer").html("<h5 id='ask-message'style='display: inline;'></h5><button class='btn' data-dismiss='modal' aria-hidden='true'>cancel</button><a href='#''><button id='ask-confirm-button' class='btn btn-primary'>ASK!</button></a>");
		// also, change the friend dropdown back to the 'me' option
		$("#ask-list")[0].selectedIndex = 0;
		$('#ask-list').trigger('change');
		 
	});

});