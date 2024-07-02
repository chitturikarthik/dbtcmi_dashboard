<?php include("../../conn.php"); ?>



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


                  <div class="data-tabs text-center">
                    <div class="row">
                      <div class="col-lg-4 mx-auto">
                      <a id="submit_info" href="dashboard/submit/information.php" > <button  id="submit_info" class="btn btn-primary"> Information </button></a>
                      </div>
                      <div class="col-lg-4 mx-auto">
                      <a id="submit_studyd" href="dashboard/submit/study_details.php" >  <button id="submit_studyd"  class="btn btn-primary enableOnInput" disabled> Study Details </button></a>
                      </div>
                      <div class="col-lg-4 mx-auto">
                        <a id="submit_sampled" href="dashboard/submit/sample_details.php" class="disabled"> <button type="submit" name =" submit" class="btn btn-primary" value="Information" disabled> Sample Details </button></a>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-12 mx-auto">
                      <div class="card mt-2 mx-auto p-4 bg-light">
                        <div class="card-body bg-light">
                    
                          <div class = "container">
                            <?php include_once "insert_fresh_data.php"; ?>
                            <!--  <form id="add_form_detail" role="form" action="dashboard/submit/insert_fresh_data.php" method="post"> !-->
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
                                          <span class="error" style ="color:red"> <?= $data_typeErr; ?></span>
                                        </div>
                                      </div>
                    
                                      <div class="col-md-4">
                                        <div class="form-group">
                                          <label for="form_sequencing platform ">Sequencing Platform *</label>
                                          <input id="seqpl" type="sequencing platform" name="sequencing_platform" class="form-control" placeholder="Please enter your Sequencing Platform *" data-error="Valid Sequencing_Platformis required.">
                                          <span class="error" style ="color:red"> <?= $sequencing_platformErr; ?></span>
                                        </div>
                                      </div>
                                      <div class="col-md-4">
                                        <div class="form-group">
                                          <label for="form_sequenced_region">Sequenced region *</label>
                                          <input id="seqreg" type="Sequenced_region" name="Sequenced_region" class="form-control" placeholder="Please enter your Sequenced region *" data-error="Valid Sequenced region  is required.">
                                          <span class="error" style ="color:red"> <?= $Sequenced_regionErr; ?></span>
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
                                          <span class="error" style ="color:red"> <?= $study_envErr; ?></span>
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
                                          <span class="error" style ="color:red"> <?= $stateErr; ?></span>
                                        </div>
                                      </div>
                                    
                                    </div>

                                  </div>

                                </div>
                              </form>
                          </div>
                        </div>
                      </div>
                      <!-- /.8 -->
                    </div>
                    <!-- /.row-->
                  </div>
                </div>
              </div>
            </div>
          
          </div>
        
        </main>
      </div>
    </div>


    
<script>

  // document.getElementById("#submit_newdata").style.display = 'block';
  
  //form submit button enable
  
  $(function() {
  $('#selectdt, #org, #seqpl, #seqreg, #studyenv, #studystate, #studyemail, #studysample, #reqlat').on('keyup change',
  
  function() {
    if ($('#selectdt').val() == '' || $('#org').val() == '' || $('#seqpl').val() == '' || $('#seqreg').val() == ''
     || $('#studyenv').val() == '' || $('#studystate').val() == '' || $('#studyemail').val() == ''  || $('#studysample').val() == ''
     || $('#reqlat').val() == ''  && function verify() {

  document.getElementById("submit").disabled = true;

  })

 {
      $('.enableOnInput').prop('disabled', true);
    } 

    else {

      $('.enableOnInput').prop('disabled', false);
    }
  });
});



</script>
