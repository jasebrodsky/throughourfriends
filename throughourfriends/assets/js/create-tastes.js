function validate($id){
  //var input = $($id).val();


if (($($id).val() == "_empty") || ($($id).val() == "")) {

    //($($id).closest('div[class^="controls"]').css('border','2px solid red'));
    //($($id).next().css('border','2px solid red'));
    //($($id).parent("label").css('border','2px solid red'));
    ($($id).parent().prev().css('color','#B94A48'));

    return false

  }
  else {
    //validated
    ($($id).next().css('border',''));
    ($($id).parent().prev().css('color', '#333'));
    return true
  }
}


$(document).ready(function() {

	//size distance and distance unit correctly on page load. 

	$('#distance_chzn').css("width","107.5px");
	$('#distance_unit_chzn').css("width","107.5px");



	// Send all profile data via AJAX to save-profile.php when submit is clicked. 
	$("#continue_btn").click(function(e) {

		e.preventDefault();

		validate('#min-age');
		validate('#max-age');

		//if any of the required fields is fails validation, then show the appropriate error message
		if ((validate('#min-age') == false) || (validate('#input_one') == false) || (validate('#max-age') == false)) {


				// if any of the basics is not validated, show error message
				if ((validate('#min-age') == false) || (validate('#input_one') == false) || (validate('#max-age') == false)) {

					//show error message
					$('#basics-error').fadeIn('slow');
				}
				// if it is, hide the error message
				else {
					$('#basics-error').hide();
				}
			}
				
		
		else {


		//save all profile variables
		var Gender = $("#gender").val();
		var Birthday = $("#birthday").val();
		var Max_age = $("#max-age").val();
		var Min_age = $("#min-age").val();
		var City = $("#input_one").val();
		var Lat_city =  $("#input_one").attr('lat');
		var Long_city =  $("#input_one").attr('long');
		var Distance = $("#distance").val();
		var Distance_unit = $("#distance_unit").val();
		var Ethnicity = $("#ethnicity").val();
		var Religion = $("#religion").val();
		var Politics =  $("#politics").val();
		var Unique = $("#unique").val();

		data = ("gender=" + Gender +"&"+ "max_age=" + Max_age +"&"+ "min_age=" + Min_age +"&"+ "city=" + City +
			"&"+ "ethnicity=" + Ethnicity +"&"+ "religion=" + Religion +
			"&"+ "politics=" + Politics +"&"+ "unique=" + Unique +"&"+ "distance=" + Distance +"&"+ "distance_unit=" + Distance_unit
			+"&"+ "lat_city=" + Lat_city +"&"+ "long_city=" + Long_city

			);
		
	
			//ajax call to send via search variables 'data' via GET to load_profile_top.php. Take results and put on page. 
		    $.ajax({
		        type: "GET",
		        url: "save-tastes.php",
		        data: data,
		        success: function(result) {
		            
		           window.location.href = result;
		           //alert(result);
		           
		            

		        }
		    });
		   }
		});  
	

});
	
