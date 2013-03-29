//need to update the main pic with more attribute..specifically the match id, userid stuff. Those variables seem to not be updating when the a vote from the pending match page is going off. 

$(document).ready(function() {

            // save session variable of currently logged in user_id
            var session_user_id = $("#logged-in-user").attr('userid');

            // load the first 7 matches for the friend selected on page load. 
            $.ajax({
                  type: "GET",
                  url: "load_pending_matches.php",
                  data: { start: 0, duration: 7  }
                }).done(function( data ) {
                  $("#matches-viewer").html(data);
                  $('#matches-viewer .match-pic:first-child').hide();
                 // update match-pic with variables returned from ajax call
                 var userid = $('#matches-viewer .match-pic:first-child').attr("userid");
                 var name = $('#matches-viewer .match-pic:first-child').attr("name");
                 var age = $('#matches-viewer .match-pic:first-child').attr("age");
                 var city_match = $('#matches-viewer .match-pic:first-child').attr("city");
                 var gender = $('#matches-viewer .match-pic:first-child').attr("gender");
                 var sexual_pref = $('#matches-viewer .match-pic:first-child').attr("sexual_pref");
                 var relationship_status = $('#matches-viewer .match-pic:first-child').attr("relationship_status");
                 var fb_id = $('#matches-viewer .match-pic:first-child').attr("fb_id");
                 var pic_src = $('#matches-viewer .match-pic:first-child img').attr("src");
                 var match_id = $('#matches-viewer .match-pic:first-child').attr("match_id");
                 var matchee_user_id =  $('#matches-viewer .match-pic:first-child').attr("matchee_user_id");
                 var match_user_id =  $('#matches-viewer .match-pic:first-child').attr("match_user_id");


                // update the match summary describing your friend on page load.
                $("#match-summary-top").text(age+'/'+gender+'/'+sexual_pref+'/'+relationship_status);
                $("#match-summary-city").text(city_match);
                $("#match-summary-name").text(name);
                $("#match-pic").attr('src', pic_src);
                $(".match-link").attr('href', 'profile.php?user_id='+userid);
                $("#main-match").attr('match_id', match_id);
                $("#main-match").attr('matchee_user_id', matchee_user_id);
                $("#main-match").attr('match_user_id', match_user_id);


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

             

            //when buttons clicked- hide first element in the list.
//when buttons clicked- hide first element in the list.
    var count = 7; // set count at 5. This will be iterated each time a match is clicked. This is used to pull the 'next' row in the db each time the user clicks.
  $("#accept-button, #reject-button").live("click", function() {
   
   var this_vote = $(this).attr('vote'); // save vote variable
   var this_match_id =$("#main-match").attr('match_id');
   var this_match_user_id =$("#main-match").attr('match_user_id');
   var this_matchee_user_id =$("#main-match").attr('matchee_user_id');

    // determine if user is the match or matchee in order to do correctly fill out vote column voter_type. 
     if (this_matchee_user_id == session_user_id){
      var voter_type = 'matchee';
     }else{
      var voter_type = 'match';
     }

     
     $('#match-info').fadeOut('slow', function() {



    // record vote for this match

        $.ajax({
                  type: "GET",
                  url: "vote.php",
                  data: { match_id: this_match_id, vote: this_vote, voter_user_id: session_user_id, voter_type: voter_type, match_user_id: this_match_user_id, matchee_user_id: this_matchee_user_id }

                }).done(function( data ) {
                          
                });

        //update match record to seen via AJAX call
        $.ajax({
            type: "GET",
            url: "seen.php",
            data: {new_pending_match: this_match_id},

            success: function(result) {
            }
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
         var match_id =  $('#matches-viewer .match-pic:first-child').attr("match_id");
         var matchee_user_id =  $('#matches-viewer .match-pic:first-child').attr("matchee_user_id");
         var match_user_id =  $('#matches-viewer .match-pic:first-child').attr("match_user_id");
   
     
  
    $('#matches-viewer .match-pic:first-child').stop().hide('medium', function(){

    // add new element to end of list
    
    // ajax function that will populate friends matches based on selected friend
            $.ajax({
                  type: "GET",
                  url: "load_pending_matches.php",
                  data: { start: count, duration: 1  }
                }).done(function( data ) {
                  $('#matches-viewer').append(data);  
                   count++;
                });    
        
 
  


        // update the match summary describing your friend on page load.

        $("#match-summary-top").text(age+'/'+gender+'/'+sexual_pref+'/'+relationship_status);
        $("#match-summary-city").text(city);
        $("#match-summary-name").text(name);
        $("#match-pic").attr('src', pic_src);
        $("#match-link").attr('href', 'profile.php?user_id='+userid);
        $("#main-match").attr('match_id', match_id);
        $("#main-match").attr('matchee_user_id', matchee_user_id);
        $("#main-match").attr('match_user_id', match_user_id);
        $('#match-info').show();



        // finaly remove the first match elemlent from the list. 
         $('#matches-viewer .match-pic:first-child').remove();
       

        });
    }); // end of main function

  });

 })