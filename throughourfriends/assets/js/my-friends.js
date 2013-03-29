




$(document).ready(function() {

                 
            // grab current friend selected on page load.
            var element = $("option:selected", this);
            var fb_id = element.attr("fb_id");
            var age = element.attr("age");
            var gender = element.attr("gender");
            var relationship_status = element.attr("relationship_status");
            var sexual_pref = element.attr("sexual_pref");
            var city = element.attr("city");
            var userid_friend = element.attr("userid");
            var main_pic = element.attr("main_pic");
            var name = element.val();
            // save session variable of currently logged in user_id
            var session_user_id = $("#logged-in-user").attr('userid');


            // update the friend summary describing your friend on page load.
            $("#friend-summary-top").text(age+'/'+gender+'/'+sexual_pref+'/'+relationship_status);
            $("#friend-summary-city").text(city);
            $("#friend-summary-name").text(name);
            $("#friend-pic").attr('src', main_pic);
            $(".friend-link").attr('href', 'profile.php?user_id='+userid_friend);
            $("#friend-title").text("Accept or reject "+name+"'"+" matches below");
            


            // load the first 7 matches for the friend selected on page load. 
            $.ajax({
                  type: "GET",
                  url: "load_friend_matches.php",
                  data: { userid: userid_friend, start: 0, duration: 7  }
                }).done(function( data ) {
                  $("#matches-viewer").html(data);
                  $('#matches-viewer .match-pic:first-child').hide();
                 // update match-pic with variables returned from ajax call
                 var userid_below = $('#matches-viewer .match-pic:first-child').attr("userid");
                 var name = $('#matches-viewer .match-pic:first-child').attr("name");
                 var age = $('#matches-viewer .match-pic:first-child').attr("age");
                 var city_match = $('#matches-viewer .match-pic:first-child').attr("city");
                 var gender = $('#matches-viewer .match-pic:first-child').attr("gender");
                 var sexual_pref = $('#matches-viewer .match-pic:first-child').attr("sexual_pref");
                 var relationship_status = $('#matches-viewer .match-pic:first-child').attr("relationship_status");
                 var fb_id = $('#matches-viewer .match-pic:first-child').attr("fb_id");
                 var pic_src = $('#matches-viewer .match-pic:first-child img').attr("src");
                 var match_id = $('#matches-viewer .match-pic:first-child').attr("match_id");
                 var matchee_user_id = $('#matches-viewer .match-pic:first-child').attr("userid");
                 var match_user_id = $('#matches-viewer .match-pic:first-child').attr("match_user_id");


                // update the match summary describing your friends match on page load.
                $("#match-summary-top").text(age+'/'+gender+'/'+sexual_pref+'/'+relationship_status);
                $("#match-summary-city").text(city_match);
                $("#match-summary-name").text(name);
                $("#match-pic").attr('src', pic_src);
                $(".match-link").attr('href', 'profile.php?user_id='+userid_below);
                $("#main-match").attr('match-id', match_id);
                $("#main-match").attr('matchee-user-id', matchee_user_id);
                $("#main-match").attr('match-user-id', match_user_id);


                $('#matches-viewer .match-pic:first-child').remove();
                  // save userid of 2nd friend match. Use that id to generate an ajax call to populate the #profile at the bottom

                  // var userid_below = $('#matches-viewer .match-pic:first-child').next().attr("userid");
                  // // save userid of 2nd friend match. Use that id to generate an ajax call to populate the #profile at the bottom
                  //     $.ajax({
                  //               type: "GET",
                  //               url: "load_profile.php",
                  //               data: { userid: userid_below}
                  //             }).done(function( data ) {
                  //               $('#profile').html(data);
                  //             });

                });


                                  
  

  // grab all attributes in friend list and save as variables whenever user changes their friend.
  $("#friend-list").change(function(){
            var element = $("option:selected", this);
            var fb_id =element.attr("fb_id");
            var main_pic =element.attr("main_pic");
            var age = element.attr("age");
            var gender = element.attr("gender");
            var relationship_status = element.attr("relationship_status");
            var sexual_pref = element.attr("sexual_pref");
            var city = element.attr("city");
            var userid_friend = element.attr("userid");      
            var name = element.val();
            count = 7;
            $('#match-info').show();

            
            // update the friend summary describing your friend whenever the user changes their friend. 
            $("#friend-summary-top").text(age+'/'+gender+'/'+sexual_pref+'/'+relationship_status);
            $("#friend-summary-city").text(city);
            $("#friend-pic").attr('src', main_pic);
            $(".friend-link").attr('href', 'profile.php?user_id='+userid_friend);
            $("#friend-title").text("Accept or reject "+name+"'"+" matches below");
            $("#friend-summary-name").text(name);
            // ajax function that will populate friends matches based on selected friend
            $.ajax({
                  type: "GET",
                  url: "load_friend_matches.php",
                  data: { userid: userid_friend, start: 0, duration: 7  }
                }).done(function( data ) {
                  $("#matches-viewer").hide().html(data).fadeIn(2000);
                  $('#matches-viewer .match-pic:first-child').hide();
                 // update match-pic with variables returned from ajax call
                 var userid_below = $('#matches-viewer .match-pic:first-child').attr("userid");
                 var name = $('#matches-viewer .match-pic:first-child').attr("name");
                 var age = $('#matches-viewer .match-pic:first-child').attr("age");
                 var city = $('#matches-viewer .match-pic:first-child').attr("city");
                 var gender = $('#matches-viewer .match-pic:first-child').attr("gender");
                 var sexual_pref = $('#matches-viewer .match-pic:first-child').attr("sexual_pref");
                 var relationship_status = $('#matches-viewer .match-pic:first-child').attr("relationship_status");
                 var fb_id = $('#matches-viewer .match-pic:first-child').attr("fb_id");
                 var pic_src = $('#matches-viewer .match-pic:first-child img').attr("src");
                 var match_id = $('#matches-viewer .match-pic:first-child').attr("match_id");
                 var matchee_user_id = $('#matches-viewer .match-pic:first-child').attr("userid");
                 var match_user_id = $('#matches-viewer .match-pic:first-child').attr("match_user_id");
                 

                // update the match summary describing your friends match on page load.
                $("#match-summary-top").text(age+'/'+gender+'/'+sexual_pref+'/'+relationship_status);
                $("#match-summary-city").text(city);
                $("#match-summary-name").text(name);
                $("#match-pic").attr('src', pic_src);
                $(".match-link").attr('href', 'profile.php?user_id='+userid_below);
                $("#main-match").attr('match-id', match_id);
                $("#main-match").attr('matchee-user-id', matchee_user_id);
                $("#main-match").attr('match-user-id', match_user_id);

                $('#matches-viewer .match-pic:first-child').remove();

                //   // save userid of 2nd friend match. Use that id to generate an ajax call to populate the #profile at the bottom
                //    var userid_below = $('#matches-viewer .match-pic:first-child').next().attr("userid");

                //    $.ajax({
                //           type: "GET",
                //           url: "load_profile.php",
                //           data: { userid: userid_below}
                //         }).done(function( data ) {
                //           $('#profile').hide().html(data).fadeIn(1000);
                //         });
                 });


            

        });

    $("#friend_options").click(function() {
      var userid_friend = $('#friend-list :selected').attr('userid');

      
      // ajax function that will populate friends options based on selected friend
            $.ajax({
                  type: "GET",
                  url: "load_friend_options.php",
                  data: { userid_friend: userid_friend}
                }).done(function( data ) {

                  $('#modal-body').html(data);


                  $(".chzn-select").chosen();

                  var input = document.getElementById('input_one');         
                  var autocomplete = new google.maps.places.Autocomplete(input, {
                      types: ["geocode"]
                  });          
                   
                  google.maps.event.addListener(autocomplete, 'place_changed', function() {
                      var place = autocomplete.getPlace();
                  });  

                  $("#input_one").focusin(function () {
                      $(document).keypress(function (e) {
                          if (e.which == 13) {
                               selectFirstResult();   
                          }
                      });
                  });
                  $("#input_one").blur(function() {
                    
                          selectFirstResult();
                          //alert(latcity);
                  });
        
                  $('#input_one').trigger('click');

                  }); 

                   function selectFirstResult() {
                $(".pac-container").hide();

                
                var firstResult = $(".pac-container .pac-item:first").text();
                var geocoder = new google.maps.Geocoder();
                geocoder.geocode({"address":firstResult }, function(results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        
                        var latcity = results[0].geometry.location.lat();
                        var lngcity = results[0].geometry.location.lng();
                        var placeName = results[0].address_components[0].long_name;
                            //latlng = new google.maps.LatLng(lat, lng);
                            $("#input_one").attr('value', placeName);
                            $('#input_one').attr('lat', latcity);
                            $('#input_one').attr('long', lngcity);
                            return (latcity);
                            return (lngcity);
                            var firstResult = $(".pac-container .pac-item:first").text();
                            var latcity = results[0].geometry.location.lat();
                            var lngcity = results[0].geometry.location.lng();
                            var placeName = results[0].address_components[0].long_name;
                            $('#input_one').attr('lat', latcity);
                            $('#input_one').attr('long', lngcity);
                            $("#input_one").attr('value', placeName);


                    }
                });   
             }


    });

//update save options button attribute unique changed..when unique is changed. This is needed to determine if a notification should be sent regarding an updated friend description. 
$('#unique').live('input', function() {
    //update button attribute to true
    $('#save-options-button').attr('unique-changed','true');
});




$("#save-options-button").live('click',function() {

      //save all profile variables
      var Unique_changed = $("#save-options-button").attr('unique-changed');
      var Unique = $("#unique").val();
      var Tastes_id = $("#modal_id").attr('taste-id');
      var User_id_friend = $("#modal_id").attr('user-id-friend');
      var User_id_creator = $("#modal_id").attr('user-id-creator');

      var userid_friend = $('#friend-list :selected').attr('userid');
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
      //var Unique = $("#unique").val();
      var Tastes_id = $("#modal_id").attr('taste-id');
      var User_id_friend = $("#modal_id").attr('user-id-friend');
      var User_id_creator = $("#modal_id").attr('user-id-creator');

      
      data1 = ("unique=" + Unique +"&"+ "tastes_id=" + Tastes_id +"&"+ "User_id_friend=" + User_id_friend +"&"+ "user_id_creator=" + User_id_creator

        );

       data2 = ("gender=" + Gender +"&"+ "max_age=" + Max_age +"&"+ "min_age=" + Min_age +"&"+ "city=" + City +
    "&"+ "ethnicity=" + Ethnicity +"&"+ "religion=" + Religion +
    "&"+ "politics=" + Politics +"&"+ "tastes_id=" + Tastes_id +"&"+ "distance=" + Distance +"&"+ "distance_unit=" + Distance_unit
    +"&"+ "lat_city=" + Lat_city +"&"+ "long_city=" + Long_city +"&"+ "User_id_friend=" + User_id_friend +"&"+ "user_id_creator=" + User_id_creator

    );

      //check if unique field has been updated before running update-unique.php
      if (Unique_changed == 'true'){
      //ajax call to send via search variables 'data' via GET to update-uniquye.php.
        $.ajax({
            type: "GET",
            url: "update-unique.php",
            data: data1,
            success: function(result) {
                //change flag unique changed attribute on button back to false. 
                $('#save-options-button').attr('unique-changed','false');
                
            }
        });
      
      }


        //ajax call to send via search variables 'data' via GET to load_profile_top.php. Take results and put on page. 
        $.ajax({
            type: "GET",
            url: "update-tastes.php",
            data: data2,
            success: function(result) {
                
                $("#success-message-tastes").hide().html(result).fadeIn(2000);
                //close modal
                $('#modal_profile').modal('hide');
            }
        });

      

    });

    

  //when buttons clicked- hide first element in the list, copy that match into the main match above, then remove the that match from the match-viewer.
    var count = 7; // set count at 7. This will be iterated each time a match accept/reject buttons are clicked. This is used to pull the 'next' row in the db each time the user clicks.
  $("#accept-button, #reject-button").live("click", function() {
   var this_vote = $(this).attr('vote'); // save vote variable
   var this_match_id = $("#main-match").attr("match-id"); // save match_id variable
   var this_matchee_user_id = $("#main-match").attr("matchee-user-id"); // save match_id variable
   var this_match_user_id = $("#main-match").attr("match-user-id"); // save match_id variable
   var userid_friend = $('#friend-list :selected').attr('userid');
   $('#match-info').fadeOut('slow', function() {

            $.ajax({
                  type: "GET",
                  url: "vote.php",
                  data: { match_id: this_match_id, matchee_user_id: this_matchee_user_id, match_user_id: this_match_user_id, vote: this_vote, voter_user_id: session_user_id, voter_type: 'friend' }
                }).done(function( data ) {

                });
  
    $('#matches-viewer .match-pic:first-child').stop().hide('medium', function(){ 

		// add new element to end of list
		
		// ajax function that will populate friends matches based on selected friend
            $.ajax({
                  type: "GET",
                  url: "load_friend_matches.php",
                  data: { userid: userid_friend, start: count, duration: 1  }
                }).done(function( data ) {
                  $('#matches-viewer').append(data);
                   count++;
                });    
        

        // save variables of first match. Use these to update the main-match section
         var userid = $('#matches-viewer .match-pic:first-child').attr("userid");
         var name = $('#matches-viewer .match-pic:first-child').attr("name");
         var age = $('#matches-viewer .match-pic:first-child').attr("age");
         var city = $('#matches-viewer .match-pic:first-child').attr("city");
         var gender = $('#matches-viewer .match-pic:first-child').attr("gender");
         var sexual_pref = $('#matches-viewer .match-pic:first-child').attr("sexual_pref");
         var relationship_status = $('#matches-viewer .match-pic:first-child').attr("relationship_status");
         var fb_id = $('#matches-viewer .match-pic:first-child').attr("fb_id");
         var pic_src = $('#matches-viewer .match-pic:first-child img').attr("src");
         var matchee_user_id = $('#matches-viewer .match-pic:first-child').attr("userid");
         var match_user_id = $('#matches-viewer .match-pic:first-child').attr("match_user_id");
         var match_id = $('#matches-viewer .match-pic:first-child').attr("match_id");

        // update the match summary describing your friends match on page load.
        $('#match-info').show();
        $("#match-summary-top").text(age+'/'+gender+'/'+sexual_pref+'/'+relationship_status);
        $("#match-summary-city").text(city);
        $("#match-summary-name").text(name);
        $("#match-pic").attr('src', pic_src);
        $(".match-link").attr('href', 'profile.php?user_id='+userid);

        $("#main-match").attr('matchee-user-id', matchee_user_id);
        $("#main-match").attr('match-user-id', match_user_id);
        $("#main-match").attr('match-id', match_id);

        // finaly remove the first match elemlent from the list. 
         $('#matches-viewer .match-pic:first-child').remove();
         
         // use ajax call here to load match into modal window for viewing before they user might click it. 
         // $.ajax({
         //          type: "GET",
         //          url: "load_profile.php",
         //          data: { userid: userid_below}
         //        }).done(function( data ) {
         //          $('#profile').hide().html(data).fadeIn(1000);
         //        });

        // record vote for this match


        });
        
    }); // end of main function

  });

})