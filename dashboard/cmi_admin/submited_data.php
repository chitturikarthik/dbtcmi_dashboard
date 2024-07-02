

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
  <h1><b>New submitted Datasets</b></h1>
</div>
  <div class="container">
    <div class="table-responsive">
      <table class="table">
     
  <thead>
    <tr>
      <th scope="col">User Name</th>
      <th scope="col">datatype</th>
      <th scope="col">Organization</th>
      <th scope="col">Seq_plaform</th>
      <th scope="col">seq region</th> 
      <th scope="col">main_env</th>
      <th scope="col">State</th>
      <th scope="col">email</th>
      <th scope="col">No. of sample</th>
      <th scope="col">Library Type</th>
      <th scope="col">Description</th>
      <th scope="col">lat</th>
      <th scope="col">long</th>
      <th scope="col">all_env</th>
      <th scope="col">isolation source</th>
      <th scope="col">single-file</th>
      <th scope="col">forward-file</th>
      <th scope="col">reverse-file</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>
    <?php 

      $sql= "SELECT T1.user_name, T1.data_type, T1.organization, T1.seq_platform, T1.seq_region, T1.main_env, T1.state, T1.email, T1.sample_size, T1.library_type, T1.description, 
      T2.user_name, T2.latitude, T2.longitude, T2.all_env, T2.isolation_source, T2.collection_date, T2.single_end_file, T2.forward_file, T2.reverse_file
      FROM new_submit_data AS T1 
      JOIN new_submit_sample_data AS T2 
      ON T1.user_name= T2.user_name;";
      $result = mysqli_query($conn,$sql) or die(mysqli_error ($conn) );
      while($rows = mysqli_fetch_array($result)) {

    ?>

    <tr>
    
                              <td><?php echo $rows ["user_name"];?></td>
                              <td><?php echo $rows ["data_type"];?></td>
                              <td><?php echo $rows ["organization"];?></td>
                              <td><?php echo $rows ["seq_platform"];?></td>
                              <td><?php echo $rows ["seq_region"];?></td>
                              <td><?php echo $rows ["main_env"];?></td>
                              <td><?php echo $rows ["state"];?></td>
                              <td><?php echo $rows ["email"];?></td>
                              <td><?php echo $rows ["sample_size"];?></td>
                              <td><?php echo $rows ["library_type"];?></td>
                              <td><?php echo $rows ["description"];?></td>
                              <td><?php echo $rows ["latitude"];?></td>
                              <td><?php echo $rows ["longitude"];?></td>
                              <td><?php echo $rows ["all_env"];?></td>
                              <td><?php echo $rows ["isolation_source"];?></td>
                              <td><?php echo $rows ["collection_date"];?></td>
                              <td><?php echo $rows ["single_end_file"];?></td>
                              <td><?php echo $rows ["forward_file"];?></td>
                              <td><?php echo $rows ["reverse_file"];?></td>
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