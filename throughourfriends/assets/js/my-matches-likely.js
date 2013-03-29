$(document).ready(function() {

            
            // save session variable of currently logged in user_id
            var session_user_id = $("#logged-in-user").attr('userid');

             // load the first 7 matches for the friend selected on page load. 
            $.ajax({
                  type: "GET",
                  url: "load_likely_matches.php",
                  data: { start: 0, duration: 7  }
                }).done(function( data ) {
                  $("#matches-viewer").html(data);
                  $('#matches-viewer .match-pic:first-child').hide();

                 // save variables of first match on page load
                 var name = $('#matches-viewer .match-pic:first-child').attr("name");
                 var age = $('#matches-viewer .match-pic:first-child').attr("age");
                 var city_match = $('#matches-viewer .match-pic:first-child').attr("city");
                 var gender = $('#matches-viewer .match-pic:first-child').attr("gender");
                 var sexual_pref = $('#matches-viewer .match-pic:first-child').attr("sexual_pref");
                 var relationship_status = $('#matches-viewer .match-pic:first-child').attr("relationship_status");
                 var fb_id = $('#matches-viewer .match-pic:first-child').attr("fb_id");
                 var pic_src = $('#matches-viewer .match-pic:first-child img').attr("src");
                 var match_id = $('#matches-viewer .match-pic:first-child').attr("match_id");
                 var matchee_user_id =  $('#matches-viewer .match-pic:first-child').attr("userid");
                 var userid = $('#matches-viewer .match-pic:first-child').attr("userid");
    

                // update the match summary describing your friend on page load.
                $("#match-summary-top").text(age+'/'+gender+'/'+sexual_pref+'/'+relationship_status);
                $("#match-summary-city").text(city_match);
                $("#match-summary-name").text(name);
                $("#match-pic").attr('src', pic_src);
                $(".match-link").attr('href', 'profile.php?user_id='+userid);
                $("#main-match").attr('match-id', match_id);
                $("#main-match").attr('matchee-user-id', session_user_id);
                $("#main-match").attr('match-user-id', userid);
                $('#matches-viewer .match-pic:first-child').remove();

                });

             //when buttons clicked- hide first element in the list, copy that match into the main match above, then remove the that match from the match-viewer.
            var count = 7; // set count at 7. This will be iterated each time a match accept/reject buttons are clicked. This is used to pull the 'next' row in the db each time the user clicks.
          $("#accept-button, #reject-button").live("click", function() {
               var this_vote = $(this).attr('vote'); // save vote variable
               var this_matchee_user_id = $("#main-match").attr("matchee-user-id"); // save match_id variable
               var this_match_user_id = $("#main-match").attr("match-user-id"); // save match_id variable
               var matchmaker = $("#main-match").attr("matchee-user-id"); // save match_id variable
               $('#match-info').fadeOut('slow', function() {

                        
                        if (this_vote == '1'){


                        

                        // put all form variables in variable to send in ajax call
                        data = ("matchmaker=" + matchmaker +"&"+ "matchee=" + this_matchee_user_id +"&"+ "match=" + this_match_user_id);

                        $.ajax({
                            type: "GET",
                            url: "save-match.php",
                            data: data,
                            success: function(result) {
                                $("#modal-footer").hide().html(result).fadeIn(2000);

                            }
                        });

                      }

          
            $('#matches-viewer .match-pic:first-child').stop().hide('medium', function(){ 

            // add new element to end of list
            
            // ajax function that will populate friends matches based on selected friend
                    $.ajax({
                          type: "GET",
                          url: "load_likely_matches.php",
                          data: { start: count, duration: 1  }
                        }).done(function( data ) {
                          $('#matches-viewer').append(data);
                           count++;
                        });    
                

                  // save variables of first match on page load
                 var name = $('#matches-viewer .match-pic:first-child').attr("name");
                 var age = $('#matches-viewer .match-pic:first-child').attr("age");
                 var city_match = $('#matches-viewer .match-pic:first-child').attr("city");
                 var gender = $('#matches-viewer .match-pic:first-child').attr("gender");
                 var sexual_pref = $('#matches-viewer .match-pic:first-child').attr("sexual_pref");
                 var relationship_status = $('#matches-viewer .match-pic:first-child').attr("relationship_status");
                 var fb_id = $('#matches-viewer .match-pic:first-child').attr("fb_id");
                 var pic_src = $('#matches-viewer .match-pic:first-child img').attr("src");
                 var match_id = $('#matches-viewer .match-pic:first-child').attr("match_id");
                 var matchee_user_id =  $('#matches-viewer .match-pic:first-child').attr("userid");
                 var userid = $('#matches-viewer .match-pic:first-child').attr("userid");
    

                // update the match summary describing your friend on page load.
                $("#match-summary-top").text(age+'/'+gender+'/'+sexual_pref+'/'+relationship_status);
                $("#match-summary-city").text(city_match);
                $("#match-summary-name").text(name);
                $("#match-pic").attr('src', pic_src);
                $(".match-link").attr('href', 'profile.php?user_id='+userid);
                $("main-match").attr('match-id', match_id);
                $("#main-match").attr('matchee-user-id', session_user_id);
                $("#main-match").attr('match-user-id', userid);
                $('#match-info').show();

                // finaly remove the first match elemlent from the list. 
                 $('#matches-viewer .match-pic:first-child').remove();
                 
                });
    }); // end of main function

  });

})