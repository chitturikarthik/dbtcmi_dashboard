<?php 


// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to Data-submission page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: submit.php");
    exit;
}


//Initiating DB connection
include("../../conn.php");

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $login_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            // Redirect user to welcome page
                            header("location: submit.php");
                        } else{
                            // Password is not valid, display a generic error message
                            $login_err = "Invalid username or password.";
                        }
                    }
                } else{
                    // Username doesn't exist, display a generic error message
                    $login_err = "Invalid username or password.";
                }
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
      <meta charset="UTF-8">
      <title>DBT-CMI: Login</title>

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
              <!-- Breadcrumb -->
              <div class="col-md-12 col-lg-12">
                <h2 class="text-accent2 fw-bold mb-2 text-uppercase text-center">DBT-CMI submission Portal</h2>
                <p class="mb-0 text-muted text-center">Submit to the India's largest Microbiome public repository of biological and scientific information</p>
              </div>
            <!--  <div class="col-md-2 col-lg-2">
                 <a href="dashboard/cmi_admin/" class="btn btn-outline-success float-end" role="button">Admin login</a>
              </div>-->
            </div>
           
            <div class="row px-4 mt-5 text-center text-muted" id="countBoxes">

              <!-- Welcome submit portal -->
              <div class="col-md-6 col-xxl-6 mx-auto p-4 gx-5">
                <div class="special-list-item p-2 bg-white rounded mr-0 me-lg-4 shadow">
                  <div class="d-block d-sm-flex align-items-center m-2">

                    <div class="block text-start">
                      <h5>Welcome to the DBT-CMI submission Portal.</h5>
                        <p class="mb-0 fs-4">To submit Indian Microbiome data requiring controlled access please log in using CMI credentials.
                        You can use this service for a range of submission activities as well as reports on your submissions.
                        </p>
                    </div>

                  </div>
                </div>
              </div>  

              <!-- log-in portal -->
              <div class="col-md-6 col-xxl-6 mx-auto p-4 gx-5">
                <div class="special-list-item p-2 bg-white rounded mr-0 me-lg-4 shadow">
                  <div class="d-block d-sm-flex align-items-center m-2">
                
                    <div class="block text-start">
                      <div class="wrapper">
                        <h2>Login</h2>
                        <p>Please fill in your credentials to login.</p>

                        <?php 
                        if(!empty($login_err)){
                            echo '<div class="alert alert-danger">' . $login_err . '</div>';
                        }        
                        ?>

                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                          <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                            <span class="invalid-feedback"><?php echo $username_err; ?></span>
                          </div>    
                          <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                            <span class="invalid-feedback"><?php echo $password_err; ?></span>
                          </div>
                          <div class="form-group mt-2">
                            <input type="submit" class="btn btn-primary" value="Login">
                          </div>
                            <p>Don't have an account? <a href="dashboard/submit/index.php">Sign up now</a>.</p>
                        </form>
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