<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>DBT-CMI: Login</title>

    <base href="../../">
    <?php include_once '../../head_links.php'; ?>
    <?php include_once '../../conn.php'; ?>
  </head>
  <body>

<div class="text-center">
  <h1><b>Missing datasets</b></h1>
</div>
  <div class="container">
    <div class="table-responsive">
      <table class="table">
      
  <thead>
    <tr>
    
      <th scope="col">Datatype</th>
      <th scope="col">Study-ID</th>
      <th scope="col">Environment</th>
      <th scope="col">Sequence Region</th>
      <th scope="col">State</th>
      <th scope="col">Email</th>
      <th scope="col">Message</th>

    </tr>
  </thead>
  <tbody>
    <?php 

      $sql= "SELECT * from missing_data_submit";
      $result = mysqli_query($conn,$sql) or die(mysqli_error ($conn) );
      while($rows = mysqli_fetch_array($result)) {

    ?>

    <tr>
    
                              <td><?php echo $rows ["data_type"];?></td>
                              <td><?php echo $rows ["study_id"];?></td>
                              <td><?php echo $rows ["env"];?></td>
                              <td><?php echo $rows ["state"];?></td>
                              <td><?php echo $rows ["email"];?></td>
                              <td><?php echo $rows ["message"];?></td>
                              
    </tr> 
    <?php
      }
    ?>
  </tbody>
        
      </table>
    </div>
  </div>

  </body>
</html>