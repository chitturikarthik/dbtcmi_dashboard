<?php




include("../../conn.php"); 
include_once '../../head_links.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
//if (isset ($_POST["submit"])); {

  $data_type = $_POST['ge_me'];
  $organization = $_POST['organization'];
  $sequencing_platform = $_POST['sequencing_platform'];
  $Sequenced_region= $_POST['sequencing_platform'];
  $study_env = $_POST['study_env'];
  $state = $_POST['state'];
  $email = $_POST['email'];
  $sample_size = $_POST['sample_size']; // no of samples
  $library_type = $_POST['check'];
  $message = $_POST['message'];
   print ($library_type);

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
    
 
  $query_study = "INSERT INTO `new_submit_data` VALUES (NULL, '$data_type', '$organization', '$sequencing_platform', '$Sequenced_region', '$study_env', '$state', '$email', '$sample_size', '$library_type', '$message')"; 

  //$result1 = mysqli_query($conn,$query_study);


    foreach ($lat as $key => $value) {
      
      //use LAST_INSERT_ID() function to insert id (as a foreign key) from new_submit_data table

      $query_sample = "INSERT INTO `new_submit_sample_data` VALUES (LAST_INSERT_ID(), '".$value."', '".$long[$key]."', '".$sample_env[$key]."', '".$source[$key]."', '".$cdate[$key]."', '".$single_file_name[$key]."', '".$forward_file_name[$key]."', '".$reverse_file_name[$key]."')"; 

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
  
/*
    if ($conn->query($query_study) && $conn->query($query_sample) === true) {
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
*/
}    


?>
