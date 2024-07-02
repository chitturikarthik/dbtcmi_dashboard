
<?php
// Initialize the session
session_start();
//echo session_id();
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

// isu1918dfa1tmhkq16gobiru5o 
// isu1918dfa1tmhkq16gobiru5o 
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
          <div class="submisssion_header">
            <div class="row px-5 pt-3 mt-5 ">
              <!-- Breadcrumb -->
              <div class="row ">
                <div class="col-md-8 col-xxl-8 text-end">
                  <h2 class="text-accent2 fw-bold mb-2 text-uppercase">DBT-CMI submission Portal</h2>
                  
                </div>

                <div class="col-md-4 col-xxl-4 text-end">
                  <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"><?php echo htmlspecialchars($_SESSION["username"]); ?>
                    <span class="caret"></span></button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                      <li><a class="dropdown-item"  href="dashboard/submit/reset-password.php" class="btn btn-warning">Reset Your Password</a></li>
                      <li><a class="dropdown-item"  href="dashboard/submit/logout.php" class="btn btn-danger ml-3">Sign Out </a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
            <!-- Breadcrumb -->
            
      

              <div class="row px-4 mt-5 text-center text-muted" id="countBoxes">
                <!-- welcome -->
                <div class="col-md-12 col-xxl-12 mx-auto p-4 gx-5">
                  <div class="special-list-item p-2 bg-white rounded mr-0 me-lg-4 shadow">
                    <div class="d-block d-sm-flex align-items-center m-2">

                      <div class="block text-start">
                        <h3 class="my-5"> Welcome to Department of Biotechnology Centre for Microbial Informatics</h3>
                        <p class="mb-0 text-muted  text-uppercase">Submit to the India's largest Microbiome public repository of biological and scientific information</p>
                      </div>

                    </div>
                  </div>
                </div>  
                <!-- submit Fresh Data -->
                <div class="col-md-6 col-xxl-6 mx-auto p-4 gx-5">
                  <div class="special-list-item p-2 bg-white rounded mr-0 me-lg-4 shadow">
                    <div class="d-block d-sm-flex align-items-center m-2">

                      <div class="block text-start">
                        <h5>submit fresh Data</h5>
                        <a class="mb-0 fs-4" href="dashboard/submit/new_submission.php">submit fresh Data
                        </a>
                      </div>
                      
                    </div>
                  </div>
                </div>  

                <!-- Submit Missing Data -->
                <div class="col-md-6 col-xxl-6 mx-auto p-4 gx-5">
                  <div class="special-list-item p-2 bg-white rounded mr-0 me-lg-4 shadow">
                    <div class="d-block d-sm-flex align-items-center m-2">
                      <div class="block text-start">
                        <h5>submit missing Data</h5>
                        <a class="mb-0 fs-4" href="dashboard/submit/submit_missing.php">
                        If your data is available in public databases (NCBI, MGRAST, EMBL, etc..) and Missing from the DBT-CMI database please fill and submit below details 
                        </a>
                      </div>                

                    </div>
                  </div>
                </div>

                <!-- submit Fresh Data -->
                <div class="col-md-12 col-xxl-12 mx-auto p-4 gx-5">
              
                    <div class="d-block d-sm-flex align-items-center m-2">

                      <div class="block text-start">
                        <h3>Need help?</h3>
                        <p class="my-5"> If you need help with your data submission, <a targert="_blank" href="contact.php">please contact</a></p>
                
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