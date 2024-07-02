<?php
//Initiating DB connection
include("../../conn.php");

  // Define variables and initialize with empty values
  $username = $password = $confirm_password = "";
  $username_err = $password_err = $confirm_password_err = "";
  
  // Processing form data when form is submitted
  if($_SERVER["REQUEST_METHOD"] == "POST"){
  
      // Validate username
      if(empty(trim($_POST["user"]))){
          $username_err = "Please enter a username.";
      } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
          $username_err = "Username can only contain letters, numbers, and underscores.";
      } else{
          // Prepare a select statement
          $sql = "SELECT id FROM users WHERE username = ?";
          
          if($stmt = mysqli_prepare($conn, $sql)){
              // Bind variables to the prepared statement as parameters
              mysqli_stmt_bind_param($stmt, "s", $param_username);
              
              // Set parameters
              $param_username = trim($_POST["user"]);
              
              // Attempt to execute the prepared statement
              if(mysqli_stmt_execute($stmt)){
                  /* store result */
                  mysqli_stmt_store_result($stmt);
                  
                  if(mysqli_stmt_num_rows($stmt) == 1){
                      $username_err = "This username is already taken. try with other username";
                  } else{
                      $username = trim($_POST["user"]);
                  }
              } else{
                  echo "Oops! Something went wrong. Please try again later.";
              }

              // Close statement
              mysqli_stmt_close($stmt);
          }
      }
      
      // Validate password
      if(empty(trim($_POST["pass"]))){
          $password_err = "Please enter a password.";     
      } elseif(strlen(trim($_POST["pass"])) < 6){
          $password_err = "Password must have atleast 6 characters.";
      } else{
          $password = trim($_POST["password"]);
      }
      
      // Validate confirm password
      if(empty(trim($_POST["confirm_password"]))){
          $confirm_password_err = "Please confirm password.";     
      } else{
          $confirm_password = trim($_POST["confirm_password"]);
          if(empty($password_err) && ($password != $confirm_password)){
              $confirm_password_err = "Password did not match.";
          }
      }
      
      // Check input errors before inserting in database
      if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
          
          // Prepare an insert statement
          $sql = "INSERT INTO admintable (user, pass) VALUES (?, ?)";
          
          if($stmt = mysqli_prepare($conn, $sql)){
              // Bind variables to the prepared statement as parameters
              mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
              
              // Set parameters
              $param_username = $username;
              $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
              
              // Attempt to execute the prepared statement
              if(mysqli_stmt_execute($stmt)){
                  // Redirect to login page
                  header("location: adminlogin.php");
              } else{
                  echo "Oops! Something went wrong. Please try again later.";
              }

              // Close statement
              mysqli_stmt_close($stmt);
          }
      }
      
      // Close connection
      mysqli_close($conn);
  }
?>

<!DOCTYPE html>
  <html lang="en">
    <head>

      <title>DBT-CMI: Admin-Sign-up</title>
     <base href="../../">
      <?php include_once '../../head_links.php'; ?>
      <!-- Navbar -->
      <?php include_once '../../navbar.php'; ?>

    </head>
  <body>
    <div class="container-fluid pt-4 mt-3">
      <div class="row">
        <!-- Sidebar -->
        <?php include_once "../sidebar.php"; ?>
        <main class="col-md-9 ms-sm-auto col-xl-10 px-md-4 bg-secondary-subtle">
          <div class="row px-5 pt-3 mt-5">
            <div class="text-center">
              <!-- Breadcrumb -->
              <h2 class="text-accent2 fw-bold mb-2 text-uppercase">DBT-CMI admin Portal</h2>
              
            </div>
          </div>
         

          <div class="row px-4 mt-5 text-center text-muted" id="countBoxes">

            <!-- Welcome submit portal -->
            <div class="col-md-6 col-xxl-6 mx-auto p-4 gx-5">
              <div class="special-list-item p-2 bg-white rounded mr-0 me-lg-4 shadow">
                <div class="d-block d-sm-flex align-items-center m-2">

                  <div class="block text-start">
                    <h5>Welcome to the DBT-CMI Admin Portal.</h5>
                   
                  </div>
                </div>
              </div>
            </div>
            <!-- Sign-up portal -->
            <div class="col-md-6 col-xxl-6 mx-auto p-4 gx-5">
              <div class="special-list-item p-2 bg-white rounded mr-0 me-lg-4 shadow">
                <div class="d-block d-sm-flex align-items-center m-2">
            
                  <div class="block text-start">
                    <div class="wrapper">
                        <h2>Sign Up</h2>
                        <p>Please fill this form to create an account.</p>
                      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                          <label>Username</label>
                          <input type="text" name="user" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                          <span class="invalid-feedback"><?php echo $username_err; ?></span>
                        </div>    
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="pass" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                            <span class="invalid-feedback"><?php echo $password_err; ?></span>
                        </div>
                        <div class="form-group">
                          <label>Confirm Password</label>
                          <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                          <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                        </div>
                        <div class="form-group">
                          <input type="submit" class="btn btn-primary" value="Submit">
                          <input type="reset" class="btn btn-secondary ml-2" value="Reset">
                        </div>
                        <p>Already have an account? <a href="dashboard/cmi_admin/adminlogin.php">Login here</a>.</p>
                      </form>    
                    </div>       
                  </div>

                </div>
              </div>
            </div>
          </div>
            
          <!-- Footer -->
          <?php include_once "../../footer.php"; ?>
        </main>
      </div>
    </div>             
  </body>
</html>