<?php

require 'connect.inc.php';
require 'core.inc.php';

if(!isset($_SESSION))
  {
  session_start();
  }
  $User_user_id = $_SESSION['User_user_id'];

  $userid_friend = ($_GET['userid_friend']);


  //return taste value for the specific user and friend combo. 
  $friend_options = get_tastes($User_user_id, $userid_friend);


  //politics
  //save the selected politics to a variable
  $Politics = $friend_options['Politics'];
  //convert the selected politics value to an array
  $friends_politics = explode(',', $Politics);


  //Religion
   //save the selected religion to a variable
  $Religion = $friend_options['Religion'];
  //convert the selected religion value to an array
  $friends_religion = explode(',', $Religion);


  //Ethnicity
   //save the selected ethnicity to a variable
  $Ethnicity = $friend_options['Ethnicity'];
  //convert the selected ethnicity value to an array
  $friends_ethnicity = explode(',', $Ethnicity);  

  //Gender
    //save the selected ethnicity to a variable
  $Gender = $friend_options['Gender'];
  //convert the selected ethnicity value to an array
  $friends_gender = explode(',', $Gender);  

  ?>



    <div id='modal_id' taste-id='<?php echo $friend_options['Taste_id']; ?>' user-id-creator='<?php echo $friend_options['User_id_creator']; ?>' user-id-friend='<?php echo $friend_options['User_id_friend']; ?>' class='pagination-centered well'>
      <div class='age-error alert alert-error' style='display:none'>  
        <a class='close close_btn' >×</a>   
        <strong>Sorry</strong>, You must be 18 years or older to continue.  
      </div> 
      <h5 class='grey text-align-left'>Who would <?php echo $friend_options['First_name']; ?> like to meet?</h5>
      <hr>
        <div class='taste-option row-fluid'>
          <div class='span6'>
            <div class='control-group'>
              <label class='control-label' for='select01'><strong>Gender:</strong></label>
                <div class='controls'>
                  <select id='gender' data-placeholder='Choose one' class='chzn-select'>
                    <option value='_empty' selected='selected' style='display:none;'></option>
                    <option <?php if(in_array("Female and Male", $friends_gender)){ echo "selected='selected'";} ?>>Female and Male</option>
                    <option <?php if(in_array("Male only", $friends_gender)){ echo "selected='selected'";} ?>>Male only</option>
                    <option <?php if(in_array("Female only", $friends_gender)){ echo "selected='selected'";} ?> >Female only</option>
                  </select>
                </div>
            </div>
          </div><!--/span-->
          <div class='span6'>
            <div class='control-group'>
              <label class='control-label' for='select01'><strong>Age range:</strong> </label>
                <div class='controls'>
                  <input class='span4' name='min_age' id='min-age' value='<?php echo $friend_options['Min_age']; ?>' min='18' placeholder='min age' type='number'>
                  <p id='age-range-text'> <em>to</em> </p>
                  <input class='span4' name='max_age' id='max-age' value='<?php echo $friend_options['Max_age']; ?>' min='18' placeholder='max age' type='number'>
                </div>
            </div> 
          </div><!--/span-->
        </div><!--/span-->
        <div class='taste-option row-fluid'>
          <div class='span6'>
            <div class='control-group'>
              <label class='control-label' for='select01'><strong>Religion:</strong></label>
                <div class='controls'>
                  <select name='religion' id='religion' data-placeholder='Choose one' class='chzn-select' multiple='multiple'>
                      <option value='_empty' selected='selected' style='display:none;'></option>
                      <option <?php if(in_array("Not important", $friends_religion)){ echo "selected='selected'";} ?> >Not important</option>
                      <option <?php if(in_array("Agnosticism", $friends_religion)){ echo "selected='selected'";} ?> >Agnosticism</option>
                      <option <?php if(in_array("Atheism", $friends_religion)){ echo "selected='selected'";} ?> >Atheism</option>
                      <option <?php if(in_array("Christianity", $friends_religion)){ echo "selected='selected'";} ?> >Christianity</option>
                      <option <?php if(in_array("Judaism", $friends_religion)){ echo "selected='selected'";} ?> >Judaism</option>
                      <option <?php if(in_array("Catholicism", $friends_religion)){ echo "selected='selected'";} ?> >Catholicism</option>
                      <option <?php if(in_array("Islam", $friends_religion)){ echo "selected='selected'";} ?> >Islam</option>
                      <option <?php if(in_array("Hinduism", $friends_religion)){ echo "selected='selected'";} ?> >Hinduism</option>
                      <option <?php if(in_array("Buddhism", $friends_religion)){ echo "selected='selected'";} ?> >Buddhism</option>
                      <option <?php if(in_array("Other", $friends_religion)){ echo "selected='selected'";} ?> >Other</option>
                    </select>
                </div>
            </div>
          </div><!--/span-->
          <div class='span6'>
            <div class='control-group'>
              <label class='control-label' for='select01'><strong>Politics:</strong></label>
                <div class='controls'>
                  <select name='politics' id='politics' data-placeholder='Choose one' class='chzn-select' multiple='multiple'>>
                      <option value='_empty' selected='selected' style='display:none;'></option>
                      <option>Not important</option>
                      <option <?php if(in_array("Liberal", $friends_politics)){ echo "selected='selected'";} ?>>Liberal</option>
                      <option <?php if(in_array("Independent", $friends_politics)){ echo "selected='selected'";} ?>>Independent</option>
                      <option <?php if(in_array("Conservative", $friends_politics)){ echo "selected='selected'";} ?>>Conservative</option>
                    </select>
                </div>
            </div>
          </div><!--/span-->
        </div>
        <div class='taste-option row-fluid'>
          <div class='span6'>
            <div class='control-group'>
              <label class='control-label' for='select01'><strong>Ethnicity:</strong></label>
                <div class='controls'>
                   <select name='ethnicity' id='ethnicity' data-placeholder='Choose one' class='chzn-select' multiple='multiple'>
                    <option value='_empty' selected='selected' style='display:none;'></option>
                    <option <?php if(in_array("Not important", $friends_ethnicity)){ echo "selected='selected'";} ?>>Not important</option>
                    <option <?php if(in_array("Asian", $friends_ethnicity)){ echo "selected='selected'";} ?> >Asian</option>
                    <option <?php if(in_array("Black", $friends_ethnicity)){ echo "selected='selected'";} ?>>Black</option>
                    <option <?php if(in_array("Indian", $friends_ethnicity)){ echo "selected='selected'";} ?>>Indian</option>
                    <option <?php if(in_array("Hispanic/Latin", $friends_ethnicity)){ echo "selected='selected'";} ?>>Hispanic/Latin</option>
                    <option <?php if(in_array("Middle Eastern", $friends_ethnicity)){ echo "selected='selected'";} ?>>Middle Eastern</option>
                    <option <?php if(in_array("Native American", $friends_ethnicity)){ echo "selected='selected'";} ?>>Native American</option>
                    <option <?php if(in_array("Pacific Islander", $friends_ethnicity)){ echo "selected='selected'";} ?>>Pacific Islander</option>
                    <option <?php if(in_array("White", $friends_ethnicity)){ echo "selected='selected'";} ?>>White</option>
                    <option <?php if(in_array("Too many!", $friends_ethnicity)){ echo "selected='selected'";} ?>>Too many!</option>
                    <option <?php if(in_array("Other", $friends_ethnicity)){ echo "selected='selected'";} ?>>Other</option>
                  </select>
                </div>
            </div>
          </div><!--/span-->
          <div class='span6'>
            <div class='control-group'>
              <label class='control-label' for='select01'><strong>Lives within:</strong></label>
                <div class='controls'>
                      <select id='distance' class='chzn-select'>
                        <option></option>
                        <option <?php if("50" == $friend_options['Distance']){ echo "selected='selected'";} ?> >50</option>
                        <option <?php if("100" == $friend_options['Distance']){ echo "selected='selected'";} ?> >100</option>
                        <option <?php if("200" == $friend_options['Distance']){ echo "selected='selected'";} ?> >200</option>
                        <option <?php if("500" == $friend_options['Distance']){ echo "selected='selected'";} ?> >500</option>
                      </select> 
                      <select id='distance_unit' class='chzn-select'>
                        <option <?php if("miles" == $friend_options['Distance_unit']){ echo "selected='selected'";} ?> >miles</option>
                        <option <?php if("kilometers" == $friend_options['Distance_unit']){ echo "selected='selected'";} ?> >kilometers</option>
                      </select> 
                      <div class='last-name'>of</div>
                      <div>
                        <input name='city' id='input_one' type='text' lat='<?php echo $friend_options['Lat_city']; ?>' long='<?php echo $friend_options['Long_city']; ?>' size='50' value= '<?php echo $friend_options['City']; ?>' placeholder='Choose a location'>
                      </div>
                </div>
            </div>
          </div><!--/span-->
        </div>
        <div class='row-fluid'>
         <div>
          </div>
          </div>
        </div>
    </div>
    <div class='pagination-centered well'>
      <h5 class='grey text-align-left'>How is <?php echo $friend_options['First_name']; ?> unique?</h5>
      <div class='row-fluid'>
        <textarea id='unique' class='span10' rows='5'> <?php echo $friend_options['Unique']; ?> </textarea>
      </div><!--/span-->
      <div class='row-fluid'>
       <div>
       </div>
      </div>
    </div>
    <div class='pagination-centered well'> 
      <div class='row-fluid'>
        <div class='span6'>
          <h5 class='grey pull-left'>Remove <?php echo $friend_options['First_name']; ?> from your friends</h5>
        </div>
        <div class='span6'>
          <button id='remove-friend-button'class='pull-right btn btn-danger profile-button' type='button'>Remove friend</button>
        </div><!--/span-->
      </div><!--/span-->
    </div>
  </div>

  
      
  