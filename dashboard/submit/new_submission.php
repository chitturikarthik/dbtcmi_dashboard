
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
                  <div class="dropdown">
                   <h3>User Name : <span><?php echo htmlspecialchars($_SESSION["username"]); ?></span></h3>
                    
                  </div>  

                  <div class="row">
                    <div class="col-lg-12 mx-auto">
                      <div class="card mt-2 mx-auto p-4 bg-light">
                        <div class="card-body bg-light">
                    
                          <div class = "container">
                            <?php
                                  
                              if ($_SERVER["REQUEST_METHOD"] == "POST") {
                              //if (isset ($_POST["submit"])); {
                              $user_name= $_SESSION["username"];
                              $data_type = $_POST['ge_me'];
                              $organization = $_POST['organization'];
                              $sequencing_platform = $_POST['sequencing_platform'];
                              $Sequenced_region= $_POST['Sequenced_region'];
                              $study_env = $_POST['study_env'];
                              $state = $_POST['state'];
                              $email = $_POST['email'];
                              $sample_size = $_POST['sample_size']; // no of samples
                              $library_type = $_POST['check'];
                              $message = $_POST['message'];
                              //print ($library_type);

                              //--------------------------- S A M P L E - D E T A I L S-----------------------------


                              $lat = $_POST['lat']; 
                              $long = $_POST['long'];
                              $sample_env = $_POST['sampleEnv'];
                              $source = $_POST['source']; 
                              $cdate = $_POST['cdate']; // collection date

                            
                                //single  end  file upload start 

                                  if (isset ($_FILES["single_file"])){ 

                                    // $single_file = $_POST['single_file'];   
                                    $single_file_name = $_FILES['single_file']['name'];
                                    $file_size = $_FILES['single_file']['size'];
                                    $file_tmp = $_FILES['single_file']['tmp_name'];
                                    $file_type = $_FILES['single_file']['type'];
                                  
                                      foreach ($single_file_name as  $key => $value) {
                                  
                                        move_uploaded_file($file_tmp[$key], "upload_single_end/".$single_file_name[$key]);
                                      
                                      }
                                    
                                  }
                            


                                //Paired end forword file upload start 

                                  if (isset ($_FILES["forward_file"])){ 

                                  // $forward_file = $_POST['forward_file'];   
                                    $forward_file_name = $_FILES['forward_file']['name'];
                                    $file_size = $_FILES['forward_file']['size'];
                                    $file_tmp = $_FILES['forward_file']['tmp_name'];
                                    $file_type = $_FILES['forward_file']['type'];

                                      foreach ($forward_file_name as  $key => $value) {

                                        move_uploaded_file($file_tmp[$key], "upload_paired_end/".$forward_file_name[$key]);
                                      
                                      }
                                    
                                  }

                                //paired end Reverse file upload start 

                                  if (isset ($_FILES["reverse_file"])){ 

                                    //$reverse_file = $_POST['reverse_file']; 
                                    $reverse_file_name = $_FILES['reverse_file']['name'];
                                    $file_size = $_FILES['reverse_file']['size'];
                                    $file_tmp = $_FILES['reverse_file']['tmp_name'];
                                    $file_type = $_FILES['reverse_file']['type'];

                                      foreach ($reverse_file_name as  $key => $value){

                                        move_uploaded_file($file_tmp[$key], "upload_paired_end/".$reverse_file_name[$key]);
                                      
                                      }
                                    
                                  }


                                //--------------------------------------------------------  
                                  
                              
                                $query_study = "INSERT INTO `new_submit_data` VALUES (NULL, '$user_name', '$data_type', '$organization', '$sequencing_platform', '$Sequenced_region', '$study_env', '$state', '$email', '$sample_size', '$library_type', '$message')"; 

                                //$result1 = mysqli_query($conn,$query_study);
                               
                                  foreach ($lat as $key => $value) {
                                    
                                    //use LAST_INSERT_ID() function to insert id (as a foreign key) from new_submit_data table
                                    // $single_file_name[$key] = !empty($single_file_name) ? "'$single_file_name'" : "NULL";
                                    //$forward_file_name[$key] = !empty($forward_file_name) ? "'$forward_file_name'" : "NULL";
                                    //$reverse_file_name[$key] = !empty($reverse_file_name) ? "'$reverse_file_name'" : "NULL";

                                    $query_sample = "INSERT INTO `new_submit_sample_data` VALUES (LAST_INSERT_ID(), '".$user_name."', '".$value."', '".$long[$key]."', '".$sample_env[$key]."', '".$source[$key]."', '".$cdate[$key]."', '".$single_file_name[$key]."', '".$forward_file_name[$key]."', '".$reverse_file_name[$key]."')"; 
                              
                                    //$result2 = mysqli_query($conn,$query_sample);
                                    if ($conn->query($query_study) === true) {
                                      $conn->query($query_sample);
                                      echo '<script>swal({
                                        title: "Data submit successfuly",
                                        text: "Our Team will contact you shortly",
                                        icon: "success",
                                        
                                      });</script>';
                                    }
                                    else {
                                      echo '<script>swal({
                                        title: "Data not submited successfuly",
                                        text: "Failed",
                                        icon: "Failed",
                                        
                                      });</script>';
                                    }
                                  }
                                
                                
                              } 
                              ?>

                              <!--  <form id="add_form_detail" role="form" action="dashboard/submit/insert_fresh_data.php" method="post"> !-->
                              <form id="add_form_detail" role="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data"> 
                                <div class="controls">
                                  
                                  <h4>Study Details:</h4>
                                    <div class="row">
                                      <div class="col-md-4">
                                        <div class="form-group">
                                          <label for="form_need">Data Type *</label>
                                          <select id ="selectdt" name="ge_me"  class="form-select" aria-label="Default select example" data-error="Please specify your need.">
                                              <option>Select Datatype</option>
                                              <option>Genome</option>
                                              <option> Metagenome</option>
                                          </select>
                                          
                                        </div>
                                      </div>
                    
                                      <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="form_oganization">Organization *</label>
                                            <input id="org"  name="organization" class="form-control" placeholder="Please enter your Organization *" data-error="Valid Organization is required.">
                                          
                                        </div>
                                      </div>
                                      <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="form_sequencing platform ">Sequencing Platform *</label>
                                            <input id="seqpl" type="sequencing platform" name="sequencing_platform" class="form-control" placeholder="Please enter your Sequencing Platform *" data-error="Valid Sequencing_Platformis required.">
                                            
                                        </div>
                                      </div>
                                      <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="form_sequenced_region">Sequenced region *</label>
                                            <input id="seqreg" type="Sequenced_region" name="Sequenced_region" class="form-control" placeholder="Please enter your Sequenced region *" data-error="Valid Sequenced region  is required.">
                                            
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
                                          
                                        </div>
                                      </div>

                                      <div class="col-md-3">
                                        <div class="form-group">
                                          <label for="form_email">Email *</label>
                                          <input id="studyemail" type="email" name="email" class="form-control" placeholder="Please enter your email *" data-error="Valid email is required.">   
                                         
                                        </div>
                                      </div>

                                      <div class='col-md-3'>
                                        <div class="form-group">
                                          <label class='inline'>No. of Sample *
                                            <input  id ="studysample" name="sample_size" type='number' data-id='textInput' min="1" max="1500" required />
                                          </label>
                                         
                                        </div>
                                      </div>
                                    
                                      <div class='col-md-4 my-4'>
                                        <div class='form-group'>
                                          <label>Library Type *</label>
                                          
                                          <div class='col-md-4'>
                                            <label>Single end: <input id="se" type='radio' data-id='single' name='check' value="singl-end"   /></label>
                                            <label>Paired end: <input id="pe" type='radio' data-id='pair' name='check' value="pair-end"  /></label>
                                          </div>
                                       
                                        </div>
                                      </div> 

                                      <div class="col-md-12">
                                        <div class="form-group">
                                          <label for="form_message">Message *</label>
                                          <textarea id="message" name="message" class="form-control" placeholder="Write your Study description here." rows="4" data-error="Please, leave us a message."></textarea>
                                        </div>
                                      </div>
                                      
                                    </div>

                                    <div class="col-md-12 ">
                                      <div class="form-group">
                                        <div class="col-md-12 my-3 text-center">
                                          <p required="required" >
                                            <input id ="load" class="btn btn-link" type='button'  value='Click to add samples' onclick="LoadTable()" role="button"  />
                                          </p>
                                        </div>
                                        <h4>Sample Details : </h4>
                                         <div>
                                          <table style= "border:1" id="displayCellTable2" class="table table-bordered">
                                            <thead>
                                            <tr>
                                            
                                              <th><label>Latitude</label></th>
                                              <th><label>Longitude</label></th>
                                              <th><label>Environment</label></th>	
                                              <th><label>Isolation Source</label></th>
                                              <th><label>Collection Date</label></th>											 
                                              <th><label>Upload file</label></th>
                                              
                                              <!-- <input type="file"  name="target_file" accept=".csv" onchange="checkExt()" style="display: inline-block;" class="btn btn-default targer_file" id="target_file"/>
                                              <input type="button" class="btn btn-default targer_file" style="display: inline-block; " value="Upload File"  onclick="addTargetByFile()"/>
                                                    -->
                                              </tr>
                                            </thead>
                                            <tbody id="displayCellTable_body2"></tbody>
                                          </table>
                                      
                                        </div> <!-- hide samples fields with javascript-->
                                      </div>
                                    </div>
                                    

                                    <div class="col-md-12 text-center">
                                      <h6> Make sure all information are correct and filled <input type="checkbox" onclick="selectstudyCheckbox()" id="form_data" name="check_input" value="Inputs"></h6>
                                    </div>
                                    <div class="col-md-12 text-center">

                                      <div class="form-group">
                                        <input id="allSubmit"class="enableOnInput" type='submit' disabled />
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

var LoadTable = function(){
var flagRadio = false;


//for()
//var option =

    if((document.getElementById('se').checked) || document.getElementById('pe').checked){
     flagRadio=true;
    }
		if(($('#studysample').val() == ''||$('#studysample').val() == '0' )){
                  swal("Error", "Add no of Sample", "error");
                  $('#form_data').prop('checked',false);
                  return;
                }
               
                
                  else if(flagRadio==false){
                    swal("Error", "Please choose your Library Type: Single End or Paired End", "error");
                    $('#form_data').prop('checked',false);
                    return;
                }
        var count=$('#studysample').val();
        var rows='';
		
        for(var i =0; i<count;i++){
		
		if(document.getElementById('pe').checked){
      rows+='<tr><td><input id="latitude'+i+'" type="latitude'+i+'" name="lat[]" class="form-control"</td> <td><input id="long'+i+'" type="longitude" name="long[]" class="form-control"></td> <td><select id="sampenv'+i+'" name="sampleEnv[]" class="form-select" aria-label="Default select example"> <option value="" selected disabled>--Select Environment--</option><?php $query = "SELECT env_name FROM environments";$result = mysqli_query($conn,$query);while($rows = mysqli_fetch_array($result)) {?><option><?php echo $rows ["env_name"]; ?></option><?php }?></select></td> <td><input id="isosource'+i+'" type="source" name="source[]"  class="form-control" placeholder="Please enter your source *"></td><td><input type="date" id="form_cdate"  name="cdate[]"  class="date-picker form-control" placeholder="Please enter your cdate *"></td> <td><input type="file"  name="forward_file[]" accept=".csv" onchange="checkExt()" style="display: inline-block;" class="btn btn-default targer_file" id="file'+i+'"><input type="file"  name="reverse_file[]" accept=".csv" onchange="checkExt()" style="display: inline-block;" class="btn btn-default targer_file" id="filepe'+i+'"></td></tr>';
        }
		else{
			rows+='<tr><td><input id="latitude'+i+'" type="latitude'+i+'" name="lat[]" class="form-control"</td> <td><input id="long'+i+'" type="longitude" name="long[]" class="form-control"></td> <td><select id="sampenv'+i+'" name="sampleEnv[]" class="form-select" aria-label="Default select example"> <option value="" selected disabled>--Select Environment--</option><?php $query = "SELECT env_name FROM environments";$result = mysqli_query($conn,$query);while($rows = mysqli_fetch_array($result)) {?><option><?php echo $rows ["env_name"]; ?></option><?php }?> </select></td> <td><input id="isosource'+i+'" type="source" name="source[]"  class="form-control" placeholder="Please enter your source *"></td><td><input type="date" id="form_cdate"  name="cdate[]"  class="date-picker form-control" placeholder="Please enter your cdate *"></td> <td><input type="file" name="single_file[]" accept=".csv" onchange="checkExt()" style="display: inline-block;" class="btn btn-default targer_file" id="file'+i+'"></td></tr>';
        }
		}
        $('#displayCellTable_body2').html(rows);
  }
  

var selectstudyCheckbox = function(){
 var count=$('#studysample').val();
        var rows='';
     
  
     
  var inputText=document.getElementById("studyemail").value;
  var flag = false;
  var flagRadio = false;
    if((document.getElementById('se').checked)||document.getElementById('pe').checked){
     flagRadio=true;
    }

    if(inputText.includes("@")){
      flag= true;
    }

    if ($('#selectdt').val() == 'Select Datatype'){
      //alert("Please Select Data type");
      $("#samplecheck").attr("checked", false);
      swal("Error", "Please Select Data type", "error");
      $('#form_data').prop('checked',false);
      return;
    }
      else if ($('#org').val() == ''){
        // alert("Please enter your Organization name");
        swal("Error", "Please enter your Organization name", "error");
        $('#form_data').prop('checked',false);
        return;
      }
      else if(($('#seqpl').val() == '')){
        swal("Error", "please enter Sequence Platform", "error");
        $('#form_data').prop('checked',false);
        return;
      }
        else if(($('#seqreg').val() == '')){
          swal("Error", "please enter Sequence Region", "error");
          $('#form_data').prop('checked',false);
          return;
        }
          else if(($('#studyenv').val() == 'Select Environment')){
            swal("Error", "Select your study Environment", "error");
            $('#form_data').prop('checked',false);
            return;
          }
            else if(($('#studystate').val() == 'Select State')){
              swal("Error", "Please select State", "error");
              $('#form_data').prop('checked',false);
              return;
            }
              else if(($('#studyemail').val() == '') || (flag==false)){
                swal("Error", "please enter Your valid email", "error");
                $('#form_data').prop('checked',false);
                return;
              }
                else if(($('#studysample').val() == ''||$('#studysample').val() == '0' )){
                  swal("Error", "Add no of Sample", "error");
                  $('#form_data').prop('checked',false);
                  return;
                }
                else if(($('#message').val() == '')){
                  swal("Error", "Enter some Message....", "error");
                  $('#form_data').prop('checked',false);
                  return;
                }             
                
                  else if(flagRadio==false){
                    swal("Error", "Please choose your Library Type: Single End or Paired End", "error");
                    $('#form_data').prop('checked',false);
                    return;
                }




 
   for(var i =0; i<count;i++){
   var theFile = document.getElementById("file"+i).files[0];
	
		    if(($('#latitude'+i+'').val() == '')){
          $('#form_data').prop('checked',false);
          swal("Error", "Please enter Latitude", "error");
         return;
        }
          else if(($('#long'+i+'').val() == '')){
            $('#form_data').prop('checked',false);
            swal("Error", "Please enter Logitude", "error");
          return;
          }
            else if (($('#sampenv'+i+'').val() == '')) {
              $('#form_data').prop('checked',false);
              swal("Error", "Please enter Sample Environment", "error");
              return;
            }
              else if (($('#isosource'+i+'').val() == '')){
                $('#form_data').prop('checked',false);
                swal("Error", "Please enter Isolation Source", "error");
                return;
              }
                else if (!theFile){
                        $('#form_data').prop('checked',false);
                        swal("Error", "Please upload file", "error");
                        return;
                      }

                  else if(document.getElementById('pe').checked){
                      var theFile1 = document.getElementById("filepe"+i).files[0];
                        if (!theFile1){
                                  $('#form_data').prop('checked',false);
                                  swal("Error", "Please upload paired end file", "error");
                                  return;
                                }
                      }
        else {
           $('#allSubmit').prop('disabled', false);
          swal("Success", "Make sure all information you enterd is correct and click on submit button to submit your information to us. </br>Once you submit, then you can't able to edit again", "success");
         
        }

		}
		// else  {
    $('#allSubmit').prop('disabled', false);
   // $('#load').prop('disabled', false);
    // alert("success");
    swal("Success", "Make sure all information you enterd is correct and click on submit button to submit your information to us.", "success");
    $('#form_data').prop('checked',false);
  //}
  
}
                

</script>
