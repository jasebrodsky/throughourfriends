<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Search</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/css/font-awesome.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
     <link href="assets/css/chosen.css" rel="stylesheet">
    <link href="assets/css/jquery-ui.css" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Quicksand:300,400,700" rel="stylesheet" type="text/css">

    
    <style type="text/css">
      body {
	padding-top: 60px;
	padding-bottom: 40px;

      }
      .sidebar-nav {
        padding: 9px 0;
      }
    </style>
    <link href="assets/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
    <link href="assets/css/footer.css" rel="stylesheet" type="text/css">
    <link href="assets/css/style.css" rel="stylesheet" type="text/css">
</head>

  <body>
    <a name="Top"></a>
    <?php include_once("analyticstracking.php"); ?>
  	<div id="wrap">
      
      <?php include ("header.php");
      require 'core.inc.php';
      $my_friends = get_friends($_SESSION['User_user_id']);
      ?>

      <div class="container-fluid">
          <div class="row">
            <?php include ("nav.php"); ?>
          <div class="span10">
            <div class="row">
              <div id="top-text">
                <div class='grey' style="font-size: 24px;">
                  <i class="blue icon-search icon-large"></i> Search
                </div>
                <br>
                
              </div> 

              <div id="basics" class="well">

                <div class="row-fluid">
                  <form class="form-horizontal ">
  
                   <div class="span6">
                  <div class="control-group">
                    <label class="control-label" for="select01"><strong>Gender:</strong></label>
                      <div class="controls">
                        <select id="gender" data-placeholder="Choose one" class="chzn-select1" >
                          <option></option>
                          <option>Male only</option>
                          <option>Female only</option>
                          <option>Female and Male</option>
                        </select>
                      </div>
                  </div>
                </div><!--/span-->
                
                
                <div class="span6">
                  <div class="control-group">
                    <label class="control-label" for="select01"><strong>Age range:</strong> </label>
                      <div class="controls">
                        <input class="span4" id="min-age" min="18" placeholder="min age" type="number">
                        <p id="age-range-text"> <em>to</em> </p>
                        <input class="span4" id="max-age" min="18" placeholder="max age" type="number">
                      </div>
                      
                   
                  </div>
                  
                  
                  
                  
                  
                </div><!--/span-->
                
                
                
                
                <div class="row-fluid">
                  <div class="span6">
                    <div class="control-group">
                      <label class="control-label" for="select01"><strong>Ethnicity:</strong></label>
                        <div class="controls">
                          <select id="ethnicity" data-placeholder="Choose" class="chzn-select1" multiple="multiple">
                            <option>Not important</option>
                            <option>Asian</option>
                            <option>Black</option>
                            <option>Indian</option>
                            <option>Hispanic/Latin</option>
                            <option>Middle Eastern</option>
                            <option>Native American</option>
                            <option>Pacific Islander</option>
                            <option>White</option>
                            <option>Too many!</option>
                            <option>Other</option>
                          </select>
                        </div>
                    </div>
                  </div><!--/span-->
                  
                  <div class="span6">
                    <div class="control-group">
                      <label class="control-label" for="select01"><strong>Lives in:</strong></label>
                        <div class="controls">
                              <select id="distance_city" class="chzn-select1" style="width:107.5px">
                                <option></option>
                                <option>50</option>
                                <option selected>100</option>
                                <option>200</option>
                                <option>500</option>
                              </select> 
                              <select id="distance_city_unit" class="chzn-select1" style="width:107.5px">
                                <option></option>
                                <option selected>miles of</option>
                                <option>kilometers of</option>
                              </select> 
                              
                              <input name="city" id="input_one" type="text" lat="" long="" size="50" value= "" placeholder="Choose a location">

                        </div>
                    </div>
                  </div><!--/span-->
                 </div>
                   <div id="expanded">
                 <div class="row-fluid">
                  <div class="span6">
                    <div class="control-group">
                      <label class="control-label" for="select01"><strong>Sign:</strong></label>
                        <div class="controls">
                          <select id="sign" data-placeholder="Choose" class="chzn-select1" >
                            <option></option>
                              <option>Not important</option>
                              <option>Aquarius</option>
                              <option>Pisces</option>
                              <option>Aries</option>
                              <option>Taurus</option>
                              <option>Gemini</option>
                              <option>Cancer</option>
                              <option>Leo</option>
                              <option>Virgo</option>
                              <option>Libra</option>
                              <option>Scorpio</option>
                              <option>Sagittarius</option>
                              <option>Capricorn</option>
                          </select>
                        </div>
                    </div>
                  </div><!--/span-->

                  
                  <div class="span6">
                    <div class="control-group">
                      <label class="control-label" for="select01"><strong>Drinks:</strong></label>
                        <div class="controls">
                          <select id="drinks" data-placeholder="Choose" class="chzn-select1" multiple="multiple">
                            <option>Not important</option>
                            <option>Socially</option>
                            <option>Very often</option>
                            <option>Often</option>
                            <option>Rarely</option>
                            <option>Desperately</option>
                            <option>Not at all</option>
                          </select>
                        </div>
                    </div>
                  </div><!--/span-->
                 </div>

                 <div class="row-fluid">
                  <div class="span6">
                    <div class="control-group">
                      <label class="control-label" for="select01"><strong>Sexual Preference:</strong></label>
                        <div class="controls">
                          <select id="sexual_pref" data-placeholder="Choose" class="chzn-select1" >
                            <option></option>
                            <option>Not important</option>
                            <option>Straight</option>
                            <option>Gay</option>
                            <option>Bi</option>
                          </select>
                        </div>
                    </div>
                  </div><!--/span-->

                  
                  <div class="span6">
                    <div class="control-group">
                      <label class="control-label" for="select01"><strong>Relationship Status:</strong></label>
                        <div class="controls">
                          <select id="relationship_status" data-placeholder="Choose" class="chzn-select1" multiple="multiple">
                            <option></option>
                            <option>Not important</option>
                            <option>Single</option>
                            <option>In a relationship</option>
                            <option>It's complicated</option>
                          </select>
                        </div>
                    </div>
                  </div><!--/span-->
                 </div>
                     <div class="row-fluid">
                  <div class="span6">
                    <div class="control-group">
                      <label class="control-label" for="select01"><strong>Height:</strong></label>
                        <div class="controls">
                          <select id="height" data-placeholder="Choose" class="chzn-select1" multiple="multiple">
                            <option></option>
                            <option>Not important</option>
                            <option>Tall</option>
                            <option>Average</option>
                            <option>Short</option>
                          </select>
                        </div>
                    </div>
                  </div><!--/span-->
                  
                  <div class="span6">
                    <div class="control-group">
                      <label class="control-label" for="select01"><strong>Smokes:</strong></label>
                        <div class="controls">
                          <select id="smokes" data-placeholder="Choose" class="chzn-select1" multiple="multiple">
                            <option></option>
                            <option>Not important</option>
                            <option>Yes</option>
                            <option>Sometimes</option>
                            <option>No</option>
                            <option>Trying to quit</option>
                            <option>When drinking</option>
                          </select>
                        </div>
                    </div>
                  </div><!--/span-->
                 </div>
                      <div class="row-fluid">
                    <div class="span6">
                      <div class="control-group">
                        <label class="control-label" for="select01"><strong>Body Type:</strong></label>
                          <div class="controls">
                            <select id="body-type" data-placeholder="Choose" class="chzn-select1" multiple="multiple">
                              <option></option>
                              <option>Not important</option>
                              <option>Thin</option>
                              <option>Overwieght</option>
                              <option>Skinny</option>
                              <option>Average</option>
                              <option>Fit</option>
                              <option>Athletic</option>
                              <option>Jacked</option>
                              <option>A little extra</option>
                              <option>Curvy</option>
                              <option>Full figured</option>
                            </select>
                          </div>
                      </div>
                    </div><!--/span-->
                    
                    <div class="span6">
                      <div class="control-group">
                        <label class="control-label" for="select01"><strong>Drugs:</strong></label>
                          <div class="controls">
                            <select id="drugs" data-placeholder="Choose" class="chzn-select1" multiple="multiple">
                              <option></option>>
                              <option>Not important</option>
                              <option>Never</option>
                              <option>Often</option>
                              <option>Rarely</option>
                            </select>
                          </div>
                      </div>
                    </div><!--/span-->
                   </div>
                     <div class="row-fluid ">
                    <div class="span6">
                      <div class="control-group">
                        <label class="control-label" for="select01"><strong>Diet:</strong></label>
                          <div class="controls">
                            <select id="diet" data-placeholder="Choose" class="chzn-select1" multiple="multiple">
                              <option></option>
                              <option>Not important</option>
                              <option>Anything</option>
                              <option>Vegetarian</option>
                              <option>Vegan</option>
                              <option>Kosher</option>
                              <option>Halal</option>
                              <option>Other</option>
                            </select>
                          </div>
                      </div>
                    </div><!--/span-->
                    
                    <div class="span6">
                      <div class="control-group">
                        <label class="control-label" for="select01"><strong>Kids:</strong></label>
                          <div class="controls">
                            <select id="kids" data-placeholder="Choose" class="chzn-select1" multiple="multiple">
                              <option></option>
                              <option>Not important</option>
                              <option>Has kids</option>
                              <option>Does not have kids</option>
                              <option>Wants kids</option>
                              <option>Does not want kids</option>
                            </select>
                          </div>
                      </div>
                    </div><!--/span-->
                   </div>
                   <div class="row-fluid">
                    <div class="span6">
                      <div class="control-group">
                        <label class="control-label" for="select01"><strong>Education:</strong></label>
                          <div class="controls">
                            <select id="education" data-placeholder="Choose" class="chzn-select1" multiple="multiple">
                              <option></option>
                              <option>Not important</option>
                              <option>High school</option>
                              <option>Two-year college</option>
                              <option>College/university</option>
                              <option>Masters program</option>
                              <option>Law school</option>
                              <option>Med school</option>
                              <option>Ph.D program</option>
                              <option>Other</option>
                            </select>
                          </div>
                      </div>
                    </div><!--/span-->
                    
                    <div class="span6">
                      <div class="control-group">
                        <label class="control-label" for="select01"><strong>Hometown:</strong></label>
                          <div class="controls">
                              <select id="distance_hometown" class="chzn-select1" style="width:107.5px">
                                <option></option>
                                <option>50</option>
                                <option selected>100</option>
                                <option>200</option>
                                <option>500</option>
                              </select> 
                              <select id="distance_hometown_unit" class="chzn-select1" style="width:107.5px">
                                <option></option>
                                <option selected>miles of</option>
                                <option>kilometers of</option>
                              </select> 
                             
                              <input name="city" id="input_two" type="text" lat="" long="" size="50" value= "" placeholder="Choose a location">

                        </div>
                      </div>
                    </div><!--/span-->
                   </div>
                      <div class="row-fluid">
                    <div class="span6">
                      <div class="control-group">
                        <label class="control-label" for="select01"><strong>Religion:</strong></label>
                          <div class="controls">
                            <select id="religion" data-placeholder="Choose" class="chzn-select1" multiple="multiple">
                              <option></option>
                              <option>Not important</option>
                              <option>Agnosticism</option>
                              <option>Atheism</option>
                              <option>Christianity</option>
                              <option>Judaism</option>
                              <option>Catholicism</option>
                              <option>Islam</option>
                              <option>Hinduism</option>
                              <option>Buddhism</option>
                              <option>Other</option>
                            </select>
                          </div>
                      </div>
                    </div><!--/span-->
                    
                    <div class="span6">
                      <div class="control-group">
                        <label class="control-label" for="select01"><strong>Income:</strong></label>
                          <div class="controls">
                            <select id="income" data-placeholder="Choose" class="chzn-select1" multiple="multiple">
                              <option></option>
                              <option>Not important</option>
                              <option>Less than $20,000</option>
                              <option>$20,000 - $30,000</option>
                              <option>$30,000 - $40,000</option>
                              <option>$40,000 - $50,000</option>
                              <option>$50,000 - $60,000</option>
                              <option>$60,000 - $70,000</option>
                              <option>$70,000 - $80,000</option>
                              <option>$80,000 - $100,000</option>
                              <option>$100,000 - $150,000</option>
                              <option>$150,000 - $250,000</option>
                              <option>$250,000 - $500,000</option>
                              <option>$500,000 - $1,000,000</option>
                              <option>More than $1,000,000</option>
                            </select>
                          </div>
                      </div>
                    </div><!--/span-->
                   </div>
                   <div class="row-fluid">
                    <div class="span6">
                      <div class="control-group">
                        <label class="control-label" for="select01"><strong>Politics:</strong></label>
                          <div class="controls">
                            <select id="politics" data-placeholder="Choose" class="chzn-select1" multiple="multiple">
                              <option></option>
                              <option>Not important</option>
                              <option>Liberal</option>
                              <option>Independent</option>
                              <option>Conservative</option>
                            </select>
                          </div>
                      </div>
                    </div><!--/span-->
                    
                    <div class="span6">
                      <div class="control-group">
                        <label class="control-label" for="select01"><strong>Languages:</strong></label>
                          <div class="controls">
                            <select id="languages" data-placeholder="Choose" class="chzn-select1" multiple="multiple">
                              <option></option>
                              <option>Not important</option>
                              <option>English</option>
                              <option>Afrikaans</option>
                              <option>Albanian</option>
                              <option>Arabic</option>
                              <option>Armenian</option>
                              <option>Basque</option>
                              <option>Belarusan</option>
                              <option>Bengali</option>
                              <option>Breton</option>
                              <option>Bulgarian</option>
                              <option>Catalan</option>
                              <option>Cebuano</option>
                              <option>Chechen</option>
                              <option>Chinese</option>
                              <option>C++</option>
                              <option>Croatian</option>
                              <option>Czech</option>
                              <option>Danish</option>
                              <option>Dutch</option>
                              <option>Esperanto</option>
                              <option>Estonian</option>
                              <option>Farsi</option>
                              <option>Finnish</option>
                              <option>French</option>
                              <option>Frisian</option>
                              <option>Georgian</option>
                              <option>German</option>
                              <option>Greek</option>
                              <option>Gujarati</option>
                              <option>Ancient Greek</option>
                              <option>Hawaiian</option>
                              <option>Hebrew</option>
                              <option>Hindi</option>
                              <option>Hungarian</option>
                              <option>Icelandic</option>
                              <option>Ilongo</option>
                              <option>Indonesian</option>
                              <option>Irish</option>
                              <option>Italian</option>
                              <option>Japanese</option>
                              <option>Khmer</option>
                              <option>Korean</option>
                              <option>Latin</option>
                              <option>Latvian</option>
                              <option>LISP</option>
                              <option>Lithuanian</option>
                              <option>Malay</option>
                              <option>Maori</option>
                              <option>Mongolian</option>
                              <option>Norwegian</option>
                              <option>Occitan</option>
                              <option>Other</option>
                              <option>Persian</option>
                              <option>Polish</option>
                              <option>Portuguese</option>
                              <option>Romanian</option>
                              <option>Rotuman</option>
                              <option>Russian</option>
                              <option>Sanskrit</option>
                              <option>Sardinian</option>
                              <option>Serbian</option>
                              <option>Sign Language</option>
                              <option>Slovak</option>
                              <option>Slovenian</option>
                              <option>Spanish</option>
                              <option>Swahili</option>
                              <option>Swedish</option>
                              <option>Tagalog</option>
                              <option>Tamil</option>
                              <option>Thai</option>
                              <option>Tibetan</option>
                              <option>Turkish</option>
                              <option>Ukrainian</option>
                              <option>Urdu</option>
                              <option>Vietnamese</option>
                              <option>Welsh</option>
                              <option>Yiddish</option>
                            </select>
                          </div>
                      </div>
                    </div><!--/span-->
                   </div>
                   <div class="row-fluid">
                    <div class="span6">
                      <div class="control-group">
                        <label class="control-label" for="select01"><strong>Profession:</strong></label>
                          <div class="controls">
                            <select id="profession" data-placeholder="Choose" class="chzn-select1" multiple="multiple">
                              <option></option>
                              <option>Not important</option>
                              </option>Student</option>
                              <option>Artistic / Musical / Writer</option>
                              <option>Banking / Financial / Real Estate</option>
                              <option>Clerical / Administrative</option>
                              <option>Computer / Hardware / Software</option>
                              <option>Construction / Craftsmanship</option>
                              <option>Education / Academia</option>
                              <option>Entertainment / Media</option>
                              <option>Executive / Management</option>
                              <option>Hospitality / Travel</option>
                              <option>Law / Legal Services</option>
                              <option>Medicine / Health</option>
                              <option>Military</option>
                              <option>Political / Government</option>
                              <option>Sales / Marketing / Biz Dev</option>
                              <option>Science / Tech / Engineering</option>
                              <option>Transportation</option>
                              <option>Unemployed</option>
                              <option>Other</option>
                              <option >Retired</option>
                            </select>
                          </div>
                      </div>
                    </div><!--/span-->
                    
                   
                     </div>

                     
                     
                     </div>
                     <hr> 
                     
                      <div class="row-fluid">
                      <div class="span6">
                        <div class="control-group">
                          <label class="control-label" for="select01"><strong>Order by:</strong> </label>
                            <div class="controls">
                              <select id="order-by">
                                <option>Recently created</option>
                                <option>Recently logged in</option>
                                <option>Totally random</option>
                                <option disabled >Friends of friends - coming soon</option>
                                <option disabled>Distance - coming soon</option>
                              </select>
                            </div>
                        </div>
                      </div><!--/span-->


                      
                      <div class="span6">
                       <button id="basics-button"class="btn btn-primary pull-right" type="button">+More criteria</button> 
                      </div><!--/span-->
                    </div>
                  </form>
                </div>
              </div><!--/span9-->


              <a>
                <div id="search-button" class="pagination-centered">
                  <button type="submit" name="submit" id="search-button" class="btn btn-large btn-success" type="button">Search</button>
                </div>
            </a>
            <hr>
            </div><!--/span9-->
            <div class='row'>
              <ul id="search-results" class="unstyled">
                
              </ul>
     			  </div>
          </div>
        </li>
      </ul>
    </div>
    
    </div>
  </div><!--/container-->
 <div id="push"></div>
</div><!--/wrap-->
  <?php include ("footer.php"); ?>
  
  

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

    <script type="text/javascript">
      $(document).ready(function() {

        if (document.documentElement.clientWidth > 980) {
          // check if user is mobile or not. 
               $(".chzn-select1").addClass("chzn-select");
               $(".chzn-select1").removeClass("chzn-select1");
        };
    });


  </script>
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap-transition.js"></script>
    <script src="assets/js/bootstrap-alert.js"></script>
    <script src="assets/js/bootstrap-modal.js"></script>
    <script src="assets/js/bootstrap-dropdown.js"></script>
    <script src="assets/js/bootstrap-scrollspy.js"></script>
    <script src="assets/js/bootstrap-tab.js"></script>
    <script src="assets/js/bootstrap-tooltip.js"></script>
    <script src="assets/js/bootstrap-popover.js"></script>
    <script src="assets/js/bootstrap-button.js"></script>
    <script src="assets/js/bootstrap-collapse.js"></script>
    <script src="assets/js/bootstrap-carousel.js"></script>
    <script src="assets/js/bootstrap-typeahead.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.21/jquery-ui.min.js"></script>
    <script src="assets/js/chosen-jquery.js"></script>
    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places"></script>
    <script type="text/javascript" src="assets/js/forms.js"></script>
    <script type="text/javascript" src="assets/js/search.js"></script>

  </body>
  
</html>
