
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
  <?php include("../../conn.php"); ?>

  <body>
<script src="assets/js/initTheme.js"></script>
<div class="container-fluid pt-4 mt-3">
  <div class="row">
    <!-- Sidebar -->
    <?php include_once "../sidebar.php"; ?>
    <main class="col-md-9 ms-sm-auto col-xl-10 px-md-4 bg-secondary-subtle">
      <div id="app">

        <div id="main">
          <div class="page-content">
            <div class="container">
              <div class=" text-center mt-5 ">
                <h1>Submit your information</h1>
              </div>



              <div class="row">
                <div class="col-lg-7 mx-auto">
                  <div class="card mt-2 mx-auto p-4 bg-light">
                    <div class="card-body bg-light">
                
                      <div class = "container">
                        <?php
                          $data_typeErr = $study_idErr = $envErr = $stateErr = $emailErr = NULL;
                          $data_type = $study_id = $env = $state = $email = $message = NULL;
                          
                          $flag = true;
                          if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        

                          //if(isset($_POST['submit'])){
                          

                                //$data_type = $_POST['ge_me'];
                              if(empty($_POST['ge_me'])) {
                                // $email = $_POST['ge_me'];
                                $data_typeErr = "*data type is required";
                                $flag= false;
                                }
                              else {
                                $data_type = test_input($_POST["ge_me"]);
                                }
                                
                              if(empty($_POST['study_id'])) {
                                // $email = $_POST['ge_me'];
                                $study_idErr = "*study ID is required";
                                $flag= false;
                                }
                              else {
                                $study_id = test_input($_POST["study_id"]);
                                }

                              if(empty($_POST['env'])) {
                                    
                                $envErr = "*environment is required";
                                $flag= false;
                                }
                              else {
                                $env = test_input($_POST["env"]);
                                }

                                //$env = $_POST['env'];
                              if(empty($_POST['state'])) {
                      
                                $stateErr = "*state is required";
                                $flag = false;
                                }
                              else {
                                $state = test_input($_POST["state"]);
                                }
                                // $state = $_POST['state'];
                                
                              if(empty($_POST['email'])) {
                              // $email = $_POST['email'];
                                $emailErr = "*email is required";
                                $flag= false;
                                }
                                else {
                                  $email = test_input($_POST["email"]);
                                  }

                                $message = $_POST['message'];


                              // submit form if validated successfully
                              if ($flag) {
                                
                                // print_r("$message");

                                $query = "INSERT INTO `missing_data_submit` (`data_type`, `study_id`, `env`, `state`, `email`, `message`) 
                                          VALUES ('$data_type', '$study_id', '$env', '$state', '$email', '$message')";

                                  // execute sql insert
                                  if ($conn->query($query) === TRUE) {
                                     echo '<script>swal({
                                      title: "Data submit successfuly",
                                      text: "Our Team will contact you shortly",
                                      icon: "success",
                                      
                                    });</script>';
                                  }
                               // $result = mysqli_query($conn,$query);

                                
                                }
                          }	

                          function test_input($data)
                          {
                              $data = trim($data);
                              $data = stripslashes($data);
                              $data = htmlspecialchars($data);
                              return $data;
                          }
                        ?>

                        <form action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"   method="POST">

                          <div class="controls">
                            <p>*Note If your data is available in public databases and Missing from the DBT-CMI database please fill and submit below details </p>
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="form_need">Data Type *</label>
                                  <select id="selectdatatype"  name="ge_me" class="form-select" aria-label="Default select example"  >
                                    <option value="">--Select Your Datatype--</option>
                                    <option >Genome</option>
                                    <option > Metagenome</option>
                                  </select>
                                  <span class="error" style ="color:red"> <?= $data_typeErr; ?></span>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="form_name">Enter any one ID (Bioproject ID, MGPID or Study ID) *</label>
                                  <input name="study_id" id='searchInput' type="text" name="name" class="form-control" placeholder="Please enter your ID *">
                                  <span class="error" style ="color:red"> <?= $study_idErr; ?></span>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="form_lastname">Environment *</label>
                                    <select id="selectenv"  name="env" class="form-select" aria-label="Default select example">
                                    <option value="" >--Select Environment--</option>
                                    <?php
                                        $query = "SELECT main_environment FROM main_environments";
                                        $result = mysqli_query($conn,$query);
                                        while($rows = mysqli_fetch_array($result)) {
                                      ?>

                                      <option><?php echo $rows ["main_environment"]; ?></option>
                                      <?php 
                                        } 
                                    ?> 
                                  <option>other</option>
                                  </select>
                                  <span class="error" style ="color:red"> <?= $envErr; ?></span>
                                </div>
                              </div>
                            
                            
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="form_need">State *</label>
                                  <select id="selectstate"  name="state" class="form-select" aria-label="Default select example">
                                    <option value="" >--Select State--</option>
                                    <?php
                                          $query = "SELECT state_name FROM states";
                                          $result = mysqli_query($conn,$query);
                                          while($rows = mysqli_fetch_array($result)) {
                                        ?>

                                        <option><?php echo $rows ["state_name"]; ?></option>
                                        <?php 
                                          } 
                                    ?> <option>other</option>
                                  </select> 
                                  <span class="error" style ="color:red"> <?= $stateErr; ?></span>
                                </div>
                              </div>

                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="form_email">Email-id *</label>
                                  <input id="reqemail" name="email"  type="email" name="email" class="form-control" placeholder="Please enter a valid Email id *" >
                                  <span class="error" style ="color:red"> <?= $emailErr; ?></span>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-12">
                                  <div class="form-group">
                                      <label for="form_message">Message *</label>
                                      <textarea  name="message" id="form_message" name="message" class="form-control" placeholder="Write your Study description here." rows="4" ></textarea>
                                  </div>
                                </div>
                                <div class="col-md-12  text-center">
                                  <button type="submit" class="btn btn-primary enableOnInput" name="submit" disabled='disabled'>Submit</button>
                                  <button type="reset" class="btn btn-primary" name="reset" >Reset</button>
                                </div>
                              </div>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                  <!-- /.8 -->
              </div>
              <!-- /.row-->
            </div>
          </div>
        </div>
      </div> <!-- /.main-->
    </main>
  </div>
</div>
  </body>
</html><script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>

$(function() {
  $('#searchInput, #selectdatatype, #selectenv, #selectstate, #reqemail').on('keyup change',function() {
    if ($('#searchInput').val() == '' || $('#selectdatatype').val() == '' || $('#selectenv').val() == '' || $('#selectstate').val() == '' || $('#reqemail').val() == '') {
      $('.enableOnInput').prop('disabled', true);
    } else {
      $('.enableOnInput').prop('disabled', false);
    }
  });
})

</script>