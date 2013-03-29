          <div id='divWrap' class="span10">
            <div class="row-fluid">
                <div id='top-text'  style="font-size: 24px;" class="grey span9"> <i class="blue icon-group  icon-large"></i> My Friends:
                  <select id="friend-list">
                    <?php echo $my_friends['friend_list'] ?>
                  </select> 
                  <a href="#myModal">
                    <a class='btn' id='friend_options' href="#myModal" data-toggle="modal" data-target="#modal_profile"> Options</a>
                  </a>
                </div>
              <div class="span3 text-align-right">
                <a href="friend-select.php">
                  <button class="btn btn-large btn-primary" type="button">Setup new friend</button>
                </a>
              </div>
              <div class="row-fluid">
                <div class="span12">
                  <span># of matches gave: 23</span><br>
                  <span># of matches recieved: 23</span>
                </div>
              </div>
              <div class="row-fluid">
                <div class="span12 pagination-centered blue">
                  <span><h2 class='blue'>Accept or Reject your friends' matches</h2></span>
                </div>
              </div>
           </div>
            <div class="well row-fluid"> 
                <div class="span12"> 
                    <div class="span5"> 
                        <div class="span8 offset4 text-align-left blue"> 
                          <a class='friend-link' href="">
                            <span id="friend-summary-name" class="first-name medium-text"></span><br>
                            <span id="friend-summary-top" class="small-text"></span><br>
                            <span id="friend-summary-city" class="small-text"></span>
                          </a>
                        </div>
                        <div class="row-fluid">
                          <div class="span4 text-align-right blue">

                          </div>
                          <div class="span8">
                            <a class="friend-link thumbnail" href="">
                             <img class="match-pic" id="friend-pic" src="" alt=""></img>
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
                        <button vote='1' id="accept-button" style="width: 73%;" class="btn btn-large btn-primary" type="button"><i class="icon-ok icon-large"> </i>Accept</button>
                      </div>
                    </div>
                    <div class="row-fluid text-align-center">
                      <div class="accept-reject-bts span12"> 
                        <button vote='0' id="reject-button"style="width: 73%;" class="btn btn-large btn-danger" type="button"><i class="icon-remove icon-large"> </i>Reject</button>
                      </div>
                    </div>
                </div>
                <div class="row-fluid">
                  <div class="row12">
                    <span class="blue"> Up next! </span>
                  </div>
                </div>
                <div class="row-fluid">
                  <ul id="matches-viewer" class="span12">
                  </ul>
                </div>
            </div>        
          </div>