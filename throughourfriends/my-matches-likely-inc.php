
 <div class="well row-fluid"> 
    <div class="span12"> 
        <div class="span5"> 
            <div class="span8 offset4 text-align-left blue"> 
              <a href="profile.php?user_id=<?php echo $this_profile['userid'] ?>">
                <span id="friend-summary-name" class="first-name medium-text"><?php echo $this_profile['Name'] ?></span><br>
                <span id="friend-summary-top" class="small-text"><?php echo $this_profile['Age']?>/<?php echo $this_profile['Gender']?>/<?php echo $this_profile['Sexual_pref']?>/<?php echo $this_profile['Relationship_status']?></span><br>
                <span id="friend-summary-city" class="small-text"><?php echo $this_profile['City'] ?></span>
              </a>
            </div>
            <div class="row-fluid">
              <div class="span4 text-align-right blue">
                
              </div>
              <div class="span8">
                <a class="thumbnail" id="friend-link" href="profile.php?user_id=<?php echo $this_profile['userid'] ?>">
                 <img class="match-pic" id="friend-pic" src="<?php echo $this_profile['Main_pic']?>" alt=""></img>
                </a>
              </div>
            </div>
        </div>
        <div style="margin-top:15%;" class="span2 text-align-center"> 
          <i id="plus-icon" class="grey icon-plus icon-4x"></i>
        </div>
        <div id='match-info' class="span5"> 
            <div class="span12 text-align-left blue"> 
               <a class='match-link' href="">
                  <span id="match-summary-name" class="first-name medium-text"></span><br>
                  <span id="match-summary-top" class="small-text"></span><br>
                  <span id="match-summary-city" class="small-text"></span>
               </a>
            </div>
            <div class="row-fluid">
              <div id="main-match" match-id="123" matchee-user-id="123" match-user-id="123" class="span8">
                <a class="match-link thumbnail" href="">
                 <img class="match-pic" id="match-pic" src="" alt=""></img>
                </a>
              </div>
              <div class="span4 blue">
                
              </div>
            </div>
        </div>

        <div class="row-fluid text-align-center">
          <div class="accept-reject-bts span12"> 
            <button vote='1' id="accept-button" style="width: 73%;" class="btn btn-large btn-primary" type="button"><i class="icon-ok icon-large"> </i>Interested</button>
          </div>
        </div>
        <div class="row-fluid text-align-center">
          <div class="accept-reject-bts span12"> 
            <button vote='0' id="reject-button"style="width: 73%;" class="btn btn-large btn-danger" type="button"><i class="icon-remove icon-large"> </i>Not my type</button>

          </div>
        </div>
    </div>
    <div class="row-fluid">
      <div class="row12">
        <span class="blue"> Up next! </span>
      </div>
    </div>
    <hr></hr>
    <div class="row-fluid">
      <ul id="matches-viewer" class="span12">
      </ul>
    </div>
</div>  