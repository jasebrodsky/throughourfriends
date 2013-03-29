 	
	
$(document).ready(function() {

	 
	  $(".friend-li").live("click", function() {

    
    // save the img src of the profile that was clicked on into a var
	var img = $(this).children().children().attr('src');
	
	
	
	// - save friends name into var in order to display that in prompt
	var name = $(this).text();
	
	
	
	// save fb id of clicked on friend into a var
	var friend_id = $(this).attr("friend_id");

	

	//update dialog with that img src
	$('#friend-img').attr('src', img);
	$('#friend-name').text(name+'?');

	
	
	// link to friend-select.php page		
			$('#friend-select').click(function() {

				// save the relationship of the friend into a var
				var relationship_of_friend = $("#relationship_of_friend option:selected").text();
				document.location.href = 'pick-friend.php?friend_fb_id='+friend_id+'&name='+name+'&img='+img+'&relationship='+relationship_of_friend;
				return false;
			});	
			
			
		 });

	 

	}
	
	
	);
	 