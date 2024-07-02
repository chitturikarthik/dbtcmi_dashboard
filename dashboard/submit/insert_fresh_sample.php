<?php

 $organizationErr = $emailErr =  $messageErr = NULL;
$data_type = $organization = $email = $message = NULL;
$flag = true;


include("../../conn.php"); 
include_once '../../head_links.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
//if (isset ($_POST["submit"])); {

 // $organization = $_POST['organization'];
  if(empty($_POST['organization'])) {
    $organizationErr = "organization is requeired";
    $flag= false;
    }
  else {
    $organization = test_input($_POST["organization"]);
    }

  //$email = $_POST['email'];
  if(empty($_POST['email'])) {
    $emailErr = "email is requeired";
    $flag= false;
    }
  else {
    $email = test_input($_POST["email"]);
    }

 
  //$library_type = $_POST['check'];
  

 // $message = $_POST['message'];
  if(empty($_POST['message'])) {
    $library_typeErr = "message requeired";
    $flag= false;
    }
  else {
    $library_type = test_input($_POST["message"]);
    }
  // print ($library_type);

  //--------------------------- USER : I N F O R M A T I O N - D E T A I L S-----------------------------

  //--------------------------------------------------------  
    
  if ($flag) {
    $query_study = "INSERT INTO `information_data` VALUES (NULL, '$organization', '$email', '$message')"; 

  //$result1 = mysqli_query($conn,$query_study);

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