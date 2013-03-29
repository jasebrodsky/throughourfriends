 

 // ajax call to send via search variables 'data' via GET to load_profile_top.php. Take results and put on page. 




 $(document).ready(function() {


if (document.documentElement.clientWidth > 980) {
  // check if user is mobile or not. 
  	

       $(".chzn-select1").addClass("chzn-select");
       $(".chzn-select1").removeClass("chzn-select1");

};



 	// variable to keep track if any search results are currently being inserted into page. 
 	var isActive = false;

 	//size the location related search criteria appropriately
	$('#distance_city_chzn').css("width","107.5px");
	$('#distance_city_unit_chzn').css("width","107.5px");
	$('#distance_hometown_chzn').css("width","107.5px");
	$('#distance_hometown_unit_chzn').css("width","107.5px");


 	var count = 0;
 	//save variable tot 
 
 	function get_search_results(count){
		
	    // put all form variables in variable to send in ajax call
	    data = "Count=" + count +"&"+ "Gender=" + gender +"&"+ "Min_age=" + min_age +"&"+ "Max_age=" + max_age +"&"+ "Sexual_pref=" + sexual_pref +"&"+ "Relationship_status=" + relationship_status +"&"+ "City=" + city +"&"+ "Lat_city=" + lat_city +"&"+ "Long_city=" + long_city +"&"+ "Distance_city=" + distance_city +"&"+ "Distance_city_unit=" + distance_city_unit +"&"+ "Ethnicity=" + ethnicity +"&"+ "Drinks=" + drinks +"&"+ "Height=" + height +"&"+ "Smokes=" + smokes +"&"+ "Body_type=" + body_type +"&"+ "Drugs=" + drugs +"&"+ "Diet=" + diet +"&"+ "Kids=" + kids +"&"+ "Education=" + education +"&"+ "Hometown=" + hometown +"&"+ "Lat_hometown=" + lat_hometown +"&"+ "Long_hometown=" + long_hometown +"&"+ "Distance_hometown=" + distance_hometown +"&"+ "Distance_hometown_unit=" + distance_hometown_unit +"&"+  "Religion=" + religion +"&"+ "Income=" + income +"&"+ "Politics=" + politics +"&"+ "Sign=" + sign +"&"+ "Profession=" + profession +"&"+ "Languages=" + languages +"&"+ "Order_by=" + order_by;


	    $.ajax({
	        type: "GET",
	        url: "load_profile_top.php",
	        data: data,
	        success: function(result) {
	            $("#search-results").append(result).show();
	            isActive = false;
	            
	        }
	    });
	   }
 	 
 	
    $(window).scroll(function() {
	   if(!isActive && $(window).scrollTop() + $(window).height() > $(document).height()-400) {
	   		if ($('#search-results li').length == 0) {
	       	return false;
		   
	   }
	   else{
	   		// check if there are more results (tot) then results displayed(count*n). 
	   	     tot = $("#search-results li").attr('tot');


		   	   if (tot > (count*5) ) {
			   	   count++;
			   		
			       get_search_results(count);
			       isActive = true;
		   		}
		   		else {
		   			
		   			return false;

		   		}

	   }
	 }
});  

 	//grab search values to send via ajax that will return search results to append to page. 
	$("#search-button").click(function() {
	    // store all search form fields to variables
	    gender = $("#gender").val();
	    min_age = $("#min-age").val();
	    max_age = $("#max-age").val();
	    //convert to bday max, min in order to compare with db values
	    ethnicity = $("#ethnicity").val();
	    city = $("#input_one").val();
	    distance_city = $("#distance_city").val();
		distance_city_unit = $("#distance_city_unit").val();
		lat_city = $("#input_one").attr('lat');
		long_city = $("#input_one").attr('long');
		hometown = $("#input_two").val();
	   	distance_hometown = $("#distance_hometown").val();
	    distance_hometown_unit = $("#distance_hometown_unit").val();
	    lat_hometown = $("#input_two").attr('lat');
		long_hometown = $("#input_two").attr('long');
	    sign = $("#sign").val();
	    sexual_pref = $("#sexual_pref").val();
	    relationship_status = $("#relationship_status").val();
	    height = $("#height").val();
	    smokes = $("#smokes").val();
	    body_type = $("#body-type").val();
	    drugs = $("#drugs").val();
	    diet = $("#diet").val();
	    kids = $("#kids").val();
	    education = $("#education").val();
	    drinks = $("#drinks").val();   
	    religion = $("#religion").val();
	    income = $("#income").val();
	    politics = $("#politics").val();
	    languages = $("#languages").val();   
	    profession = $("#profession").val();    
	    order_by = $("#order-by").val();

	    //clear search-results div when search is clicked.
	  	$("#search-results").html('');
	  	
	  	//clear the count variable because a new search has been intiated.
	  	count = 0;
	  	
	  	// call function to retrieve search results. 
	  	get_search_results(count);
		
	});

 

 	

});