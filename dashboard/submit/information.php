<?php include("../../conn.php"); ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>



<!DOCTYPE html>
  <html lang="en">
    <head>
      <meta charset="UTF-8">
      <title>DBT-CMI: Login</title>

      <base href="../../">
      <?php include_once '../../head_links.php'; ?>
        <!-- Navbar -->
        <?php include_once '../../navbar.php'; ?>
        
    </head>
    


  <body>

    <script src="assets/js/initTheme.js"></script>
    <div class="container-fluid pt-4 mt-3">
      <div class="row">
        <?php include_once "../sidebar.php"; ?>
        <main class="col-md-9 ms-sm-auto col-xl-10 px-md-4 bg-secondary-subtle">
          <div id="app">

            <div id="main">
              <div class="page-content">
                <div class="container">
                  <div class=" text-center mt-5 ">
                    <h1>Submit your information</h1>
                  </div>

                      <div class="main_div">
                        <div class="buttons">
                          <div class="row">
                            <div class="col-lg-3 mx-auto ">
                              <button  id="submit_info" class="btn btn-primary">
                                <a href="dashboard/submit/information.php#" onclick="divVisibility('Div1');" style= "color:white">User Information</a>
                            </div>
                            <div class="col-lg-3 mx-auto ">
                              <button  id="submit_info" class="btn btn-primary enableOnInput" onclick="divVisibility('Div2');" disabled>
                                <a href="dashboard/submit/information.php#" style= "color:white">Study Details</a>
                              </button>
                            </div>
                            <div class="col-lg-3 mx-auto">
                              <button  id="submit_info" class="btn btn-primary enableOnstudyInput" onclick="divVisibility('Div3');" disabled>
                                <a href="dashboard/submit/information.php#"  style= "color:white">Sample Details</a>
                              </button>
                            </div>

                             <!--  <div class="col-lg-3 mx-auto">
                                  <p required="required" >
                                    <input id ="opensample" class="btn btn-link" type='button' data-id='add' value='Click to add samples' onclick="divVisibility('Div4');"  />
                                  </p>
                            </div>-->

                          </div> 
                        </div>

                        <div class="inner_div">
                          <div id="Div1">
                            <form id="add_form_detail" role="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data"> 
                              <div class="controls">
                                
                                <h4>User  Information:</h4>
                                <div class="row">

                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="form_oganization">Organization *</label>
                                      <input id="org"  name="organization" class="form-control" placeholder="Please enter your Organization *" data-error="Valid Organization is required." autocomplete="off">
                                    <!-- <span class="error" style ="color:red"> <?//= $organizationErr; ?></span> -->
                                    </div>
                                  </div>
        
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="form_email">Email *</label>
                                      <input id="studyemail" type="email" name="email" class="form-control" placeholder="Please enter your email *" data-error="Valid email is required." autocomplete="off">   
                                    <!--  <span class="error" style ="color:red"> <?//= $emailErr; ?></span> -->
                                    </div>
                                  </div>

                                  <div class="col-md-12">
                                    <div class="form-group">
                                      <label for="form_message">Message *</label>
                                      <textarea id="form_message" name="message" class="form-control " placeholder="Write your Study description here." rows="4" data-error="Please, leave us a message."></textarea>
                                    </div>
                                  </div>

                                </div>
                                <div class=" text-center">
                                  <button  id="submit_info" class="btn btn-primary enableOnInput" onclick="divVisibility('Div2');" disabled>
                                    <a href="dashboard/submit/information.php#" style= "color:white">Next</a>
                                  </button>
                                </div>
                              </div>
                            </form>
                          </div>
                        
                          <div id="Div2" style="display: none;">
                                <!-- study form -->
                            <form id="add_form_detail" role="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data"> 
                              <div class="controls">
                                
                                <h4>Study Details:</h4>
                                  <div class="row">
                                    <div class="col-md-4">
                                      <div class="form-group">
                                        <label for="form_need">Data Type *</label>
                                        <select id ="selectdt" name="ge_me"  class="form-select" aria-label="Default select example" data-error="Please specify your need.">
                                          <option selected disabled>--Select Your Datatype--</option>
                                          <option>Genome</option>
                                          <option> Metagenome</option>
                                        </select>
                                        <!-- <span class="error" style ="color:red"> <?//= $data_typeErr; ?></span>-->
                                      </div>
                                    </div>
                  
                                    <div class="col-md-4">
                                      <div class="form-group">
                                        <label for="form_sequencing platform ">Sequencing Platform *</label>
                                        <input id="seqpl" type="sequencing platform" name="sequencing_platform" class="form-control" placeholder="Please enter your Sequencing Platform *" data-error="Valid Sequencing_Platformis required.">
                                        <!-- <span class="error" style ="color:red"> <?//= $sequencing_platformErr; ?></span> -->
                                      </div>
                                    </div>
                                    <div class="col-md-4">
                                      <div class="form-group">
                                        <label for="form_sequenced_region">Sequenced region *</label>
                                        <input id="seqreg" type="Sequenced_region" name="Sequenced_region" class="form-control" placeholder="Please enter your Sequenced region *" data-error="Valid Sequenced region  is required.">
                                        <!--  <span class="error" style ="color:red"> <//?= $Sequenced_regionErr; ?></span>-->
                                      </div>
                                    </div>
                                
                                    <div class="col-md-4">
                                      <div class="form-group">
                                        <label for="form_lastname">Environment *</label>
                                        <select id="studyenv" name="study_env" class="form-select" aria-label="Default select example"  data-error="Please specify your need.">
                                          <option value="" selected disabled>--Select Environment--</option>
                                          <?php
                                            $query = "SELECT main_environment FROM main_environments";
                                            $result = mysqli_query($conn,$query);
                                            while($rows = mysqli_fetch_array($result)) {
                                          ?>

                                          <option><?php echo $rows ["main_environment"]; ?></option>
                                          <?php 
                                            } 
                                          ?> 
                                        </select>
                                      <!-- <span class="error" style ="color:red"> <?//= $study_envErr; ?></span>-->
                                      </div>
                                    </div>
                                
                                
                                    <div class="col-md-4">
                                      <div class="form-group">
                                        <label for="form_need">State *</label>
                                        <select id="studystate" name="state" class="form-select" aria-label="Default select example" data-error="Please specify your need.">
                                          <option value="" selected disabled>--Select State--</option>
                                          <?php
                                            $query = "SELECT state_name FROM states";
                                            $result = mysqli_query($conn,$query);
                                            while($rows = mysqli_fetch_array($result)) {
                                          ?>

                                          <option><?php echo $rows ["state_name"]; ?></option>
                                          <?php 
                                            } 
                                          ?> 
                                        </select> 
                                        <!-- <span class="error" style ="color:red"> <?//= $stateErr; ?></span>-->
                                      </div>
                                    </div>
                                  
                                  </div>

                                </div>
                                <div class=" text-center">
                                 
                                  <button  id="submit_info" class="btn btn-primary enableOnstudyInput" onclick="divVisibility('Div3');" disabled>
                                    <a href="dashboard/submit/information.php#" style= "color:white">Next</a>
                                  </button>
                                </div>
                              </div>
                            </form>
                          </div>
                          <div id="Div3" style="display: none;">
                            <form id="add_form_detail" role="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data"> 
                              <div class="controls">
                                
                                <h4>Sample Details:</h4>
                                  <div class="row">
                                  
                                    <div class="col-md-4">
                                      <div class="form-group">
                                        <label for="form_need">Data Type *</label>
                                        <select id ="selectdt" name="ge_me"  class="form-select" aria-label="Default select example" data-error="Please specify your need.">
                                          <option selected disabled>--Select Your Datatype--</option>
                                          <option>Genome</option>
                                          <option> Metagenome</option>
                                        </select>
                                      <!-- <span class="error" style ="color:red"> <//?= $data_typeErr; ?></span> !-->
                                      </div>
                                    </div>

                                    <div class='col-md-3'>
                                      <div class="form-group">
                                        <label class='inline'>No. of Sample *
                                          <input  id ="studysample" name="sample_size" type='number' data-id='textInput' min="1" max="1500" required />
                                        </label>
                                        <!--  <span class="error" style ="color:red">  <//?= $sample_sizeErr; ?></span>!-->
                                      </div>
                                    </div>
                        
                             
                           
                                   <!--  <div id="divDynamicTexts"> 
                                      <div class="col-md-3">
                                        <div class="form-group">
                                          <div class="row">
                                            <div class="col-md-6"> 
                                              <label for="form_latitude">Latitude *</label>
                                              <input id="reqlat" type="latitude" name="lat[]" class="form-control" placeholder="Please enter latitude *" >
                                            
                                            </div>
                                            <div class="col-md-6"> 
                                              <label for="form_longitude">Longitude *</label>
                                              <input id="form_long" type="longitude" name="long[]" class="form-control" placeholder="Please eter longitude *"  >
                                              
                                            </div>
                                          </div>
                                        </div>
                                      </div>  
                                      <div class="col-md-3">
                                        <div class="form-group">
                                          <label for="form_lastname">Environment *</label>
                                          <select name="sampleEnv[]" class="form-select"  aria-label="Default select example">
                                            <option value="" selected disabled>--Select Environment--</option>
                                            <?php
                                              $query = "SELECT env_name FROM environments";
                                              $result = mysqli_query($conn,$query);
                                              while($rows = mysqli_fetch_array($result)) {
                                            ?>

                                            <option><?php echo $rows ["env_name"]; ?></option>
                                            <?php 
                                              } 
                                            ?> 
                                          </select>
                                        </div>
                                      </div>      
                                      <div class="col-md-3">
                                        <div class="form-group">
                                          <label for="form_source">Isolation Source *</label>
                                          <input id="form_source" type="source" name="source[]"  class="form-control" placeholder="Please enter your source *">
                                        </div>
                                      </div>
                                      <div class="col-md-3">
                                        <div class="form-group">
                                        <label for="form_cdate">Collection Date *</label>
                                        <input id="form_cdate" type="cdate" name="cdate[]"  class="date-picker form-control" placeholder="Please enter your cdate *">
                                        </div>
                                      </div>
                                      <div class="col-md-3" style="display:none" data-id="single" data-role="file-field">
                                        <div class="form-group">
                                          <label>Upload file *<input type="file"  name="single_file[]" /></label>                   
                                        </div>
                                      </div>
                                      <div class="col-md-3" style="display:none" data-id="pair" data-role="file-field">
                                        <div class="form-group ">
                                          <label>Upload Forward file *<input type="file"  name="forward_file[]" /></label>
                                          <label>Upload Reverse file *<input type="file"  name="reverse_file[]" /></label>        
                                        </div>
                                      </div>
                                    </div>
                                </div>!-->
                              </div>
                              <div class=" text-center">
                                
                                  <p required="required" >
                                    <input id ="opensample" class="btn btn-link" type='button' data-id='add' value='Click to add samples' onclick="divVisibility('Div4');"  />
                                  </p>
                                </div>
                            
                              
                              </div>
                            </form>
                          </div>
                          <div id="Div4" style="display: none;">
                            <form id="add_form_detail" role="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data"> 
                              <div class="controls">
                                
                                <h4>Add Sample Details:</h4>
                                <div class='col-md-4 my-4'>
                                      <div class='form-group'>
                                        <label>Library Type *</label>
                                      
                                        <div class='col-md-4'>
                                          <label>Single end: <input type='radio' data-id='single' name='check' value="singl-end" required/></label>
                                          <label>Paired end: <input type='radio' data-id='pair' name='check' value="pair-end" /></label>
                                        </div>
                                      <!--  <span class="error" style ="color:red">  <//?= $library_typeErr; ?></span>!-->
                                      </div>
                                    </div>
                                <div id="divDynamicTexts">
                             
                                  <div class="col-md-12 text-center">
                                    <div class="form-group">
                                      <button onclick="submit()" type="submit" id="submit_newdata" class="btn btn-primary enableOnInput" name="submit" disabled>Submit</button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>

                </div>
              </div>
            </div>
          
          </div>
        
        </main>
      </div>
    </div>



    <script>

const strhtml =     `<div data-id="dynrow" class="row border-top py-3">
                      <div class="col-md-3">
                        <div class="form-group">
                          <div class="row">
                            <div class="col-md-6"> 
                              <label for="form_latitude">Latitude *</label>
                              <input id="reqlat" type="latitude" name="lat[]" class="form-control" placeholder="Please enter latitude *" >
                             
                            </div>
                            <div class="col-md-6"> 
                              <label for="form_longitude">Longitude *</label>
                              <input id="form_long" type="longitude" name="long[]" class="form-control" placeholder="Please eter longitude *"  >
                              
                            </div>
                           </div>
                        </div>
                       </div>  
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="form_lastname">Environment *</label>
                          <select name="sampleEnv[]" class="form-select"  aria-label="Default select example">
                            <option value="" selected disabled>--Select Environment--</option>
                            <?php
                              $query = "SELECT env_name FROM environments";
                              $result = mysqli_query($conn,$query);
                              while($rows = mysqli_fetch_array($result)) {
                            ?>

                            <option><?php echo $rows ["env_name"]; ?></option>
                            <?php 
                              } 
                            ?> 
                          </select>
                        </div>
                      </div>      
                       <div class="col-md-3">
                         <div class="form-group">
                           <label for="form_source">Isolation Source *</label>
                           <input id="form_source" type="source" name="source[]"  class="form-control" placeholder="Please enter your source *">
                         </div>
                       </div>
                       <div class="col-md-3">
                         <div class="form-group">
                          <label for="form_cdate">Collection Date *</label>
                          <input id="form_cdate" type="cdate" name="cdate[]"  class="date-picker form-control" placeholder="Please enter your cdate *">
                         </div>
                       </div>
                      <div class="col-md-3" style="display:none" data-id="single" data-role="file-field">
                        <div class="form-group">
                          <label>Upload file *<input type="file"  name="single_file[]" /></label>                   
                        </div>
                      </div>
                      <div class="col-md-3" style="display:none" data-id="pair" data-role="file-field">
                        <div class="form-group ">
                          <label>Upload Forward file *<input type="file"  name="forward_file[]" /></label>
                          <label>Upload Reverse file *<input type="file"  name="reverse_file[]" /></label>        
                        </div>
                      </div>
                         <!-- <div class="col-md-3 d-grid">
                        <div class="form-group">
                          <button class="btn btn-danger remove_add_btn" data-id='remove'>Remove</button>
                        </div>
                        </div> --!>
                      </div>
                  </div>`
                  

             
                  ;
// static DOM elements
const _div = document.querySelector('#divDynamicTexts');
const _input = document.querySelector('input[type="number"][data-id="textInput"]');


// single delegated listener for ALL related click events.
document.addEventListener('click', e=> {
  if( e.target instanceof HTMLInputElement && e.target.dataset.id != null ) {
    switch (e.target.type) {
      case 'button':
        _div.innerHTML = '';
        for (let i = 0; i < _input.value; i++) _div.insertAdjacentHTML('afterbegin', strhtml);
      break;
      case 'radio':
        let expr = 'div[data-id="single"], div[data-id="pair"]';
        document.querySelectorAll(expr).forEach(n => n.style.display = 'none');

        expr = `div[data-id="${e.target.dataset.id}"]`;
        document.querySelectorAll(expr).forEach(n => n.style.display = 'block');
      break;
    }
  }
  if( e.target instanceof HTMLButtonElement && e.target.dataset.id != null ) {
    if( e.target.dataset.id == 'remove' ) {
      _div.removeChild(e.target.closest('[data-id="dynrow"]'));
    }
  }
});

var divs = ["Div1", "Div2", "Div3", "Div4"];
    var visibleDivId = null;
    function divVisibility(divId) {
      if(visibleDivId === divId) {
        visibleDivId = null;
      } else {
        visibleDivId = divId;
      }
      hideNonVisibleDivs();
    }
    function hideNonVisibleDivs() {
      var i, divId, div;
      for(i = 0; i < divs.length; i++) {
        divId = divs[i];
        div = document.getElementById(divId);
        if(visibleDivId === divId) {
          div.style.display = "block";
        } else {
          div.style.display = "none";
        }
      }
    }

 //enable Study detail button
    
 $(function() {
      $('#org, #studyemail, #usrmsg').on('keyup change',
      
      function() {
        if ($('#org').val() == '' || $('#studyemail').val() == '' || $('#usrmsg').val() == '')

    {
          $('.enableOnInput').prop('disabled', true);

        }
 
        else {

          $('.enableOnInput').prop('disabled', false);
        }
      });
    });
 
    //enable sample detail button

    $(function() {
      $('#selectdt, #seqpl, #seqreg, #studyenv, #studystate').on('keyup change',
      
      function() {
        if ($('#selectdt').val() == '' || $('#seqpl').val() == '' || $('#seqreg').val() == ''|| $('#studyenv').val() == '' || $('#studystate').val() == '') {
        
        $('.enableOnstudyInput').prop('disabled', true);

        }

        
        else {

          $('.enableOnstudyInput').prop('disabled', false);
        }
      });
    })




</script>