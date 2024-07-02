<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Submission Portal DBT-CMI</title>
  </head> 
  <body>
    <?php include("conn.php"); 


?>

<?php 
// if(isset($_POST['miss_submit'])){
  
  $data_type = $_POST['ge_me'];
  $env = $_POST['env'];
  $state = $_POST['state'];
  $email = $_POST['email'];
  $message = $_POST['message'];


  print_r("$message");

  $query = "INSERT INTO `missing_data_submit` (`data_type`, `env`, `state`, `email`, `message`) 
      VALUES ('$data_type', '$env','$state', '$email','$message')";
     $result = mysqli_query($conn,$query);
      if($result){
        echo "Data Submited successfully";
      }  
  // }

?>

</body>
</html>