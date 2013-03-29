
$(document).ready(function() {



	// Send all profile data via AJAX to save-profile.php when submit is clicked. 
	$("#continue_btn").click(function() {
		//save all profile variables
		var Gender = $("#gender").val();
		var Birthday = $("#birthday").val();
		var Max_age = $("#max-age").val();
		var Min_age = $("#min-age").val();
		var City = $("#input_one").val();
		var Ethnicity = $("#ethnicity").val();
		
		var Religion = $("#religion").val();
		
		var Politics =  $("#politics").val();
		
		var Unique = $("#unique").val();

		data = ("gender=" + Gender +"&"+ "max_age=" + Max_age +"&"+ "min_age=" + Min_age +"&"+ "city=" + City +
			"&"+ "ethnicity=" + Ethnicity +"&"+ "religion=" + Religion +
			"&"+ "politics=" + Politics +"&"+ "unique=" + Unique

			);
		
	
			//ajax call to send via search variables 'data' via GET to load_profile_top.php. Take results and put on page. 
		    $.ajax({
		        type: "GET",
		        url: "save-tastes.php",
		        data: data,
		        success: function(result) {
		            
		            window.location.href = "verify.php";
		           //alert(result);
		           
		            

		        }
		    });
		});  
	

});
	
