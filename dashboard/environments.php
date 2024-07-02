<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Initiating DB connection -->
    <?php include("../conn.php"); ?>
    <title>DBT-CMI: Environments</title>
    <base href="../">
    <?php include_once '../head_links.php'; ?>
    <?php $page = 'db > env'; ?>
</head>
<body>
  <!-- Navbar -->
  <?php include_once '../navbar.php'; ?>

  <div class="container-fluid pt-4 mt-3">
    <div class="row">
      <!-- Sidebar -->
      <?php include_once "sidebar.php"; ?>

      <!-- Main Content -->
      <main class="col-md-9 ms-sm-auto col-xl-10 px-md-4 bg-secondary-subtle">
        <div class="row px-4 pt-3 mt-5 text-center text-uppercase">
          <p class="fs-5 fw-bold mb-0">Habitats &</p>
          <h2 class="text-accent2 fw-bold mb-2">Environments</h2>
        </div>
        <hr class="w-25 mx-auto">
        
        <!-- Broad Environments -->
        <div class="row px-4 mt-3">
          <div class="col mx-auto p-4">
            <div class="row p-5 bg-white rounded mr-0 me-lg-4 shadow">
              <h5 class="mb-4">Broad Categories</h5>
              <hr class="w-25 mb-4">
              <div class="row">
                <div class="col-xl-3 mb-3">
                  <!-- Vertical Nav Tabs -->
                  <div class="nav flex-column nav-pills nav-pills-custom" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <!-- Human -->
                    <button class="nav-link mb-3 p-3 shadow active" id="v-pills-human-tab" data-bs-toggle="pill" data-bs-target="#v-pills-human" role="tab" aria-controls="v-pills-human" aria-selected="true" style="background-image: url(images/environments/humans.jpg);">
                      <i class="fa-solid fa-users mr-2"></i>
                      <span class="font-weight-bold small text-uppercase">
                        Human 
                        <?php 
                          $sql= "SELECT COUNT(T1.CMIS_ID) as human_total  FROM new_meta_samples AS T1 
                          JOIN main_environments AS T2 
                          ON T1.menv_id= T2.menv_id 
                          WHERE T2.main_environment='Human'";
                          $result = mysqli_query($conn,$sql) or die(mysqli_error ($conn) );
                          $rows = mysqli_fetch_array($result);
                        ?>
                        (<?php echo  $rows["human_total"]; ?>)
                      </span>
                    </button>
                    <!-- Plant -->
                    <button class="nav-link mb-3 p-3 shadow" id="v-pills-plant-tab" data-bs-toggle="pill" data-bs-target="#v-pills-plant" role="tab" aria-controls="v-pills-plant" aria-selected="false" style="background-image: url(images/environments/plants.jpg);">
                      <i class="fa-solid fa-tree mr-2"></i>
                      <span class="font-weight-bold small text-uppercase">
                        Plant 
                        <?php 
                          $sql= "SELECT COUNT(T1.CMIS_ID) as plant_total  FROM new_meta_samples AS T1 
                          JOIN environments AS T2 
                          ON T1.env_id= T2.env_id
                          WHERE T2.env_name='Plant'";
                          $result = mysqli_query($conn,$sql) or die(mysqli_error ($conn) );
                          $rows = mysqli_fetch_array($result);
                        ?>
                        (<?php echo  $rows["plant_total"]; ?>)
                      </span>
                    </button>
                    <!-- Animal -->
                    <button class="nav-link mb-3 p-3 shadow" id="v-pills-animal-tab" data-bs-toggle="pill" data-bs-target="#v-pills-animal" role="tab" aria-controls="v-pills-animal" aria-selected="false" style="background-image: url(images/environments/animals.jpg);">
                      <i class="fa-solid fa-paw mr-2"></i>
                      <span class="font-weight-bold small text-uppercase">
                        Animal 
                        <?php 
                          $sql= "SELECT COUNT(T1.CMIS_ID) as animal_total  FROM new_meta_samples AS T1 
                          JOIN main_environments AS T2 
                          ON T1.menv_id= T2.menv_id 
                          WHERE T2.main_environment='Animal'";
                          $result = mysqli_query($conn,$sql) or die(mysqli_error ($conn) );
                          $rows = mysqli_fetch_array($result);
                        ?>
                        (<?php echo  $rows["animal_total"]; ?>)
                      </span>
                    </button>
                    <!-- Insect -->
                    <button class="nav-link mb-3 p-3 shadow" id="v-pills-insect-tab" data-bs-toggle="pill" data-bs-target="#v-pills-insect" role="tab" aria-controls="v-pills-insect" aria-selected="false" style="background-image: url(images/environments/insects.jpg);">
                      <i class="fa-solid fa-bug mr-2"></i>
                      <span class="font-weight-bold small text-uppercase">
                        Insect 
                        <?php 
                          $sql= "SELECT COUNT(T1.CMIS_ID) as Insect_total  FROM new_meta_samples AS T1 
                          JOIN main_environments AS T2 
                          ON T1.menv_id= T2.menv_id 
                          WHERE T2.main_environment='Insect'";
                          $result = mysqli_query($conn,$sql) or die(mysqli_error ($conn) );
                          $rows = mysqli_fetch_array($result);
                        ?>
                        (<?php echo  $rows["Insect_total"]; ?>)
                      </span>
                    </button>
                    <!-- Bird -->
                    <button class="nav-link mb-3 p-3 shadow" id="v-pills-bird-tab" data-bs-toggle="pill" data-bs-target="#v-pills-bird" role="tab" aria-controls="v-pills-bird" aria-selected="false" style="background-image: url(images/environments/bird.jpg);">
                      <i class="fa-solid fa-dove mr-2"></i>
                      <span class="font-weight-bold small text-uppercase">
                        Bird 
                        <?php 
                          $sql= "SELECT COUNT(T1.CMIS_ID) as bird_total  FROM new_meta_samples AS T1 
                          JOIN main_environments AS T2 
                          ON T1.menv_id= T2.menv_id 
                          WHERE T2.main_environment='bird'";
                          $result = mysqli_query($conn,$sql) or die(mysqli_error ($conn) );
                          $rows = mysqli_fetch_array($result);
                        ?>
                        (<?php echo  $rows["bird_total"]; ?>)
                      </span>
                    </button>
                    <!-- Aquatic -->
                    <button class="nav-link mb-3 p-3 shadow" id="v-pills-aquatic-tab" data-bs-toggle="pill" data-bs-target="#v-pills-aquatic" role="tab" aria-controls="v-pills-aquatic" aria-selected="false" style="background-image: url(images/environments/aquatic.jpg);">
                      <i class="fa-solid fa-cloud-showers-water mr-2"></i>
                      <span class="font-weight-bold small text-uppercase">
                        Aquatic 
                        <?php 
                          $sql= "SELECT COUNT(T1.CMIS_ID) as Aquatic_total FROM new_meta_samples AS T1 
                          JOIN main_environments AS T2 
                          ON T1.menv_id= T2.menv_id 
                          JOIN environments AS T3
                          ON T1.env_id= T3.env_id
                          WHERE T2.main_environment='Aquatic' AND env_name!='Marine'";
                          $result = mysqli_query($conn,$sql) or die(mysqli_error ($conn) );
                          $rows = mysqli_fetch_array($result);
                        ?>
                        (<?php echo  $rows["Aquatic_total"]; ?>)
                      </span>
                    </button>
                    <!-- Marine -->
                    <button class="nav-link mb-3 p-3 shadow" id="v-pills-marine-tab" data-bs-toggle="pill" data-bs-target="#v-pills-marine" role="tab" aria-controls="v-pills-marine" aria-selected="false" style="background-image: url(images/environments/marine.jpg);">
                      <i class="fa-solid fa-water mr-2"></i>
                      <span class="font-weight-bold small text-uppercase">
                        Marine 
                        <?php 
                          $sql= "SELECT COUNT(T1.CMIS_ID) as Marine_total  FROM new_meta_samples AS T1 
                          JOIN environments AS T2 
                          ON T1.env_id= T2.env_id
                          WHERE T2.env_name='Marine'";
                          $result = mysqli_query($conn,$sql) or die(mysqli_error ($conn) );
                          $rows = mysqli_fetch_array($result);
                        ?>
                        (<?php echo  $rows["Marine_total"]; ?>)
                      </span>
                    </button>
                    <!-- Terrestrial -->
                    <button class="nav-link mb-3 p-3 shadow" id="v-pills-terrestrial-tab" data-bs-toggle="pill" data-bs-target="#v-pills-terrestrial" role="tab" aria-controls="v-pills-terrestrial" aria-selected="false" style="background-image: url(images/environments/terrestrial.jpg);">
                      <i class="fa-solid fa-mountain-sun mr-2"></i>
                      <span class="font-weight-bold small text-uppercase">
                        Terrestrial 
                        <?php 
                          $sql= "SELECT COUNT(T1.CMIS_ID) as Terrestrial_total  FROM new_meta_samples AS T1 
                          JOIN main_environments AS T2 
                          ON T1.menv_id= T2.menv_id 
                          WHERE T2.main_environment='Terrestrial'";
                          $result = mysqli_query($conn,$sql) or die(mysqli_error ($conn) );
                          $rows = mysqli_fetch_array($result);
                        ?>
                        (<?php echo  $rows["Terrestrial_total"]; ?>)
                      </span>
                    </button>
                  </div>
                </div>
                <div class="col-xl-9">
                  <!-- Tabs content -->
                  <div class="tab-content" id="v-pills-tabContent">
                    <!-- Human Table -->
                    <div class="tab-pane fade shadow rounded bg-white show active p-5" id="v-pills-human" role="tabpanel" aria-labelledby="v-pills-human-tab">
                      <h4 class="mb-4">Human Metagenomes</h4>
                      <div class="table-responsive">
                        <table class="table table-hover w-100 table-sm" id="envHumanTable">
                          <thead>
                            <tr>
                              <th>CMIS ID</th>
                              <th>Biosample </th>
                              <th>Study ID</th>
                              <th>Source 	</th>
                              <th>State </th>
                            </tr>
                          </thead>
                        </table>
                      </div>
                    </div>
                    <!-- Plant Table -->
                    <div class="tab-pane fade shadow rounded bg-white p-5" id="v-pills-plant" role="tabpanel" aria-labelledby="v-pills-plant-tab">
                      <h4 class="mb-4">Plant Metagenomes</h4>
                      <div class="table-responsive">
                        <table class="table table-hover w-100 table-sm" id="envPlantTable">
                          <thead>
                            <tr>
                              <th>CMIS ID</th>
                              <th>Biosample </th>
                              <th>Study ID</th>
                              <th>Source 	</th>
                              <th>State </th>
                            </tr>
                          </thead>
                        </table>
                      </div>
                    </div>
                    <!-- Animal Table -->
                    <div class="tab-pane fade shadow rounded bg-white p-5" id="v-pills-animal" role="tabpanel" aria-labelledby="v-pills-animal-tab">
                      <h4 class="mb-4">Animal Metagenomes</h4>
                      <div class="table-responsive">
                        <table class="table table-hover w-100 table-sm" id="envAnimalTable">
                          <thead>
                            <tr>
                              <th>CMIS ID</th>
                              <th>Biosample </th>
                              <th>Study ID</th>
                              <th>Source 	</th>
                              <th>State </th>
                            </tr>
                          </thead>
                        </table>
                      </div>
                    </div>
                    <!-- Insect Table -->
                    <div class="tab-pane fade shadow rounded bg-white p-5" id="v-pills-insect" role="tabpanel" aria-labelledby="v-pills-insect-tab">
                      <h4 class="mb-4">Insect Metagenomes</h4>
                      <div class="table-responsive">
                        <table class="table table-hover w-100 table-sm" id="envInsectTable">
                          <thead>
                            <tr>
                              <th>CMIS ID</th>
                              <th>Biosample </th>
                              <th>Study ID</th>
                              <th>Source 	</th>
                              <th>State </th>
                            </tr>
                          </thead>
                        </table>
                      </div>
                    </div>
                    <!-- Bird Table -->
                    <div class="tab-pane fade shadow rounded bg-white p-5" id="v-pills-bird" role="tabpanel" aria-labelledby="v-pills-bird-tab">
                      <h4 class="mb-4">Bird Metagenomes</h4>
                      <div class="table-responsive">
                        <table class="table table-hover w-100 table-sm" id="envBirdTable">
                          <thead>
                            <tr>
                              <th>CMIS ID</th>
                              <th>Biosample </th>
                              <th>Study ID</th>
                              <th>Source 	</th>
                              <th>State </th>
                            </tr>
                          </thead>
                        </table>
                      </div>
                    </div>
                    <!-- Aquatic Table -->
                    <div class="tab-pane fade shadow rounded bg-white p-5" id="v-pills-aquatic" role="tabpanel" aria-labelledby="v-pills-aquatic-tab">
                      <h4 class="mb-4">Aquatic Metagenomes</h4>
                      <div class="table-responsive">
                        <table class="table table-hover w-100 table-sm" id="envAquaticTable">
                          <thead>
                            <tr>
                              <th>CMIS ID</th>
                              <th>Biosample </th>
                              <th>Study ID</th>
                              <th>Source 	</th>
                              <th>State </th>
                            </tr>
                          </thead>
                        </table>
                      </div>
                    </div>
                    <!-- Marine Table -->
                    <div class="tab-pane fade shadow rounded bg-white p-5" id="v-pills-marine" role="tabpanel" aria-labelledby="v-pills-marine-tab">
                      <h4 class="mb-4">Marine Metagenomes</h4>
                      <div class="table-responsive">
                        <table class="table table-hover w-100 table-sm" id="envMarineTable">
                          <thead>
                            <tr>
                              <th>CMIS ID</th>
                              <th>Biosample </th>
                              <th>Study ID</th>
                              <th>Source 	</th>
                              <th>State </th>
                            </tr>
                          </thead>
                        </table>
                      </div>
                    </div>
                    <!-- Terrestrial Table -->
                    <div class="tab-pane fade shadow rounded bg-white p-5" id="v-pills-terrestrial" role="tabpanel" aria-labelledby="v-pills-terrestrial-tab">
                      <h4 class="mb-4">Terrestrial Metagenomes</h4>
                      <div class="table-responsive">
                        <table class="table table-hover w-100 table-sm" id="envTerrestrialTable">
                          <thead>
                            <tr>
                              <th>CMIS ID</th>
                              <th>Biosample </th>
                              <th>Study ID</th>
                              <th>Source 	</th>
                              <th>State </th>
                            </tr>
                          </thead>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Specific Environments -->
        <div class="row px-4 mt-3">
          <div class="col mx-auto p-4">
            <div class="row p-5 bg-white rounded mr-0 me-lg-4 shadow">
              <h5 class="mb-4">Specific Categories</h5>
              <hr class="w-25 mb-4">
              <div class="row">
                <div class="col-xl-3 mb-3">
                  <!-- Vertical Nav Tabs -->
                  <div class="nav flex-column nav-pills nav-pills-custom" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <!-- Gut -->
                    <button class="nav-link mb-3 p-3 shadow active" id="v-pills-gut-tab" data-bs-toggle="pill" data-bs-target="#v-pills-gut" role="tab" aria-controls="v-pills-gut" aria-selected="true" style="background-image: url(images/environments/gut.jpg);">
                      <i class="fa-solid fa-poop mr-2"></i>
                      <span class="font-weight-bold small text-uppercase">
                        Gut 
                        <?php 
                          $sql= "SELECT COUNT(T1.CMIS_ID) as Gut_total  FROM new_meta_samples AS T1 
                          JOIN source AS T2 
                          ON T1.Source_ID = T2.Source_ID
                          WHERE T2.source_name='Gut'";
                          $result = mysqli_query($conn,$sql) or die(mysqli_error ($conn) );
                          $rows = mysqli_fetch_array($result);
                        ?>
                        (<?php echo  $rows["Gut_total"]; ?>)
                      </span>
                    </button>
                    <!-- Rhizosphere -->
                    <button class="nav-link mb-3 p-3 shadow" id="v-pills-rhizosphere-tab" data-bs-toggle="pill" data-bs-target="#v-pills-rhizosphere" role="tab" aria-controls="v-pills-rhizosphere" aria-selected="false" style="background-image: url(images/environments/roots.jpg);">
                      <i class="fa-solid fa-seedling mr-2"></i>
                      <span class="font-weight-bold small text-uppercase">
                        Rhizosphere 
                        <?php 
                          $sql= "SELECT COUNT(T1.CMIS_ID) as Rhizo_Root_total  FROM new_meta_samples AS T1 
                          JOIN source AS T2 
                          ON T1.Source_ID = T2.Source_ID
                          WHERE T2.source_name='Rhizosphere' OR T2.source_name='Root'";
                          $result = mysqli_query($conn,$sql) or die(mysqli_error ($conn) );
                          $rows = mysqli_fetch_array($result);
                        ?>
                        (<?php echo  $rows["Rhizo_Root_total"]; ?>)
                      </span>
                    </button>
                    <!-- Industry -->
                    <button class="nav-link mb-3 p-3 shadow" id="v-pills-industry-tab" data-bs-toggle="pill" data-bs-target="#v-pills-industry" role="tab" aria-controls="v-pills-industry" aria-selected="false" style="background-image: url(images/environments/industry.jpg);">
                      <i class="fa-solid fa-industry mr-2"></i>
                      <span class="font-weight-bold small text-uppercase">
                        Industry 
                        <?php 
                          $sql= "SELECT COUNT(T1.CMIS_ID) as Industry_total  FROM new_meta_samples AS T1 
                          JOIN environments AS T2 
                          ON T1.env_id= T2.env_id
                          WHERE T2.env_name='Industry'";
                          $result = mysqli_query($conn,$sql) or die(mysqli_error ($conn) );
                          $rows = mysqli_fetch_array($result);
                        ?>
                        (<?php echo  $rows["Industry_total"]; ?>)
                      </span>
                    </button>
                    <!-- Oil Refinery -->
                    <button class="nav-link mb-3 p-3 shadow" id="v-pills-refinery-tab" data-bs-toggle="pill" data-bs-target="#v-pills-refinery" role="tab" aria-controls="v-pills-refinery" aria-selected="false" style="background-image: url(images/environments/refinery.jpg);">
                      <i class="fa-solid fa-oil-well mr-2"></i>
                      <span class="font-weight-bold small text-uppercase">
                        Oil Refinery 
                        <?php 
                          $sql= "SELECT COUNT(T1.CMIS_ID) as Refinery_total  FROM new_meta_samples AS T1 
                          JOIN environments AS T2 
                          ON T1.env_id= T2.env_id
                          WHERE T2.env_name='Refinery'";
                          $result = mysqli_query($conn,$sql) or die(mysqli_error ($conn) );
                          $rows = mysqli_fetch_array($result);
                        ?>
                        (<?php echo  $rows["Refinery_total"]; ?>)
                      </span>
                    </button>
                    <!-- Anthropogenic -->
                    <button class="nav-link mb-3 p-3 shadow" id="v-pills-anthropogenic-tab" data-bs-toggle="pill" data-bs-target="#v-pills-anthropogenic" role="tab" aria-controls="v-pills-anthropogenic" aria-selected="false" style="background-image: url(images/environments/city.jpg);">
                      <i class="fa-solid fa-city mr-2"></i>
                      <span class="font-weight-bold small text-uppercase">
                        Anthropogenic 
                        <?php 
                          $sql= "SELECT COUNT(T1.CMIS_ID) as Anthropogenic_total FROM new_meta_samples AS T1 
                          JOIN main_environments AS T2 
                          ON T1.menv_id= T2.menv_id
                          JOIN environments AS T3 
                          ON T1.env_id= T3.env_id
                          WHERE T2.main_environment='Anthropogenic' AND env_name  NOT IN ('Industry','Refinery')";
                          $result = mysqli_query($conn,$sql) or die(mysqli_error ($conn) );
                          $rows = mysqli_fetch_array($result);
                        ?>
                        (<?php echo  $rows["Anthropogenic_total"]; ?>)
                      </span>
                    </button>
                    <!-- Poultry -->
                    <button class="nav-link mb-3 p-3 shadow" id="v-pills-poultry-tab" data-bs-toggle="pill" data-bs-target="#v-pills-poultry" role="tab" aria-controls="v-pills-poultry" aria-selected="false" style="background-image: url(images/environments/poultry.jpg);">
                      <i class="fa-solid fa-feather mr-2"></i>
                      <span class="font-weight-bold small text-uppercase">
                        Poultry 
                        <?php 
                          $sql= "SELECT COUNT(T1.CMIS_ID) as Chicken_total  FROM new_meta_samples AS T1 
                          JOIN environments AS T2 
                          ON T1.env_id= T2.env_id
                          WHERE T2.env_name='Chicken'";
                          $result = mysqli_query($conn,$sql) or die(mysqli_error ($conn) );
                          $rows = mysqli_fetch_array($result);
                        ?>
                        (<?php echo  $rows["Chicken_total"]; ?>)
                      </span>
                    </button>
                    <!-- Cattle -->
                    <button class="nav-link mb-3 p-3 shadow" id="v-pills-cattle-tab" data-bs-toggle="pill" data-bs-target="#v-pills-cattle" role="tab" aria-controls="v-pills-cattle" aria-selected="false" style="background-image: url(images/environments/cattle.jpg);">
                      <i class="fa-solid fa-cow mr-2"></i>
                      <span class="font-weight-bold small text-uppercase">
                        Cattle 
                        <?php 
                          $sql= "SELECT COUNT(T1.CMIS_ID) as Cattle_total  FROM new_meta_samples AS T1 
                          JOIN environments AS T2 
                          ON T1.env_id= T2.env_id
                          WHERE T2.env_name='Cattle'";
                          $result = mysqli_query($conn,$sql) or die(mysqli_error ($conn) );
                          $rows = mysqli_fetch_array($result);
                        ?>
                        (<?php echo  $rows["Cattle_total"]; ?>)
                      </span>
                    </button>
                    <!-- Fish -->
                    <button class="nav-link mb-3 p-3 shadow" id="v-pills-fish-tab" data-bs-toggle="pill" data-bs-target="#v-pills-fish" role="tab" aria-controls="v-pills-fish" aria-selected="false" style="background-image: url(images/environments/fish.jpg);">
                      <i class="fa-solid fa-fish mr-2"></i>
                      <span class="font-weight-bold small text-uppercase">
                        Fish 
                        <?php 
                          $sql= "SELECT COUNT(T1.CMIS_ID) as Fish_total  FROM new_meta_samples AS T1 
                          JOIN environments AS T2 
                          ON T1.env_id= T2.env_id
                          WHERE T2.env_name='Fish'";
                          $result = mysqli_query($conn,$sql) or die(mysqli_error ($conn) );
                          $rows = mysqli_fetch_array($result);
                        ?>
                        (<?php echo  $rows["Fish_total"]; ?>)
                      </span>
                    </button>
                  </div>
                </div>
                <div class="col-xl-9">
                  <!-- Tabs content -->
                  <div class="tab-content" id="v-pills-tabContent">
                    <!-- Gut Table -->
                    <div class="tab-pane fade shadow rounded bg-white show active p-5" id="v-pills-gut" role="tabpanel" aria-labelledby="v-pills-gut-tab">
                      <h4 class="mb-4">Gut Metagenomes</h4>
                      <div class="table-responsive">
                        <table class="table table-hover w-100 table-sm" id="envGutTable">
                          <thead>
                            <tr>
                              <th>CMIS ID</th>
                              <th>Biosample </th>
                              <th>Study ID</th>
                              <th>Environment</th>
                              <th>State</th>
                            </tr>
                          </thead>
                        </table>
                      </div>
                    </div>
                    <!-- Rhizosphere Table -->
                    <div class="tab-pane fade shadow rounded bg-white p-5" id="v-pills-rhizosphere" role="tabpanel" aria-labelledby="v-pills-rhizosphere-tab">
                      <h4 class="mb-4">Rhizosphere Metagenomes</h4>
                      <div class="table-responsive">
                        <table class="table table-hover w-100 table-sm" id="envRhizosphereTable">
                          <thead>
                            <tr>
                              <th>CMIS ID</th>
                              <th>Biosample </th>
                              <th>Study ID</th>
                              <th>Environment</th>
                              <th>State</th>
                            </tr>
                          </thead>
                        </table>
                      </div>
                    </div>
                    <!-- Industry Table -->
                    <div class="tab-pane fade shadow rounded bg-white p-5" id="v-pills-industry" role="tabpanel" aria-labelledby="v-pills-industry-tab">
                      <h4 class="mb-4">Industry Metagenomes</h4>
                      <div class="table-responsive">
                        <table class="table table-hover w-100 table-sm" id="envIndustryTable">
                          <thead>
                            <tr>
                              <th>CMIS ID</th>
                              <th>Biosample </th>
                              <th>Study ID</th>
                              <th>Source</th>
                              <th>State</th>
                            </tr>
                          </thead>
                        </table>
                      </div>
                    </div>
                    <!-- Oil Refinery Table -->
                    <div class="tab-pane fade shadow rounded bg-white p-5" id="v-pills-refinery" role="tabpanel" aria-labelledby="v-pills-refinery-tab">
                      <h4 class="mb-4">Oil Refinery Metagenomes</h4>
                      <div class="table-responsive">
                        <table class="table table-hover w-100 table-sm" id="envRefineryTable">
                          <thead>
                            <tr>
                              <th>CMIS ID</th>
                              <th>Biosample </th>
                              <th>Study ID</th>
                              <th>Source</th>
                              <th>State</th>
                            </tr>
                          </thead>
                        </table>
                      </div>
                    </div>
                    <!-- Anthropogenic Table -->
                    <div class="tab-pane fade shadow rounded bg-white p-5" id="v-pills-anthropogenic" role="tabpanel" aria-labelledby="v-pills-anthropogenic-tab">
                      <h4 class="mb-4">Anthropogenic Metagenomes</h4>
                      <div class="table-responsive">
                        <table class="table table-hover w-100 table-sm" id="envAnthropogenicTable">
                          <thead>
                            <tr>
                              <th>CMIS ID</th>
                              <th>Biosample </th>
                              <th>Study ID</th>
                              <th>Source</th>
                              <th>State</th>
                            </tr>
                          </thead>
                        </table>
                      </div>
                    </div>
                    <!-- Poultry Table -->
                    <div class="tab-pane fade shadow rounded bg-white p-5" id="v-pills-poultry" role="tabpanel" aria-labelledby="v-pills-poultry-tab">
                      <h4 class="mb-4">Poultry Metagenomes</h4>
                      <div class="table-responsive">
                        <table class="table table-hover w-100 table-sm" id="envPoultryTable">
                          <thead>
                            <tr>
                              <th>CMIS ID</th>
                              <th>Biosample </th>
                              <th>Study ID</th>
                              <th>Source</th>
                              <th>State</th>
                            </tr>
                          </thead>
                        </table>
                      </div>
                    </div>
                    <!-- Cattle Table -->
                    <div class="tab-pane fade shadow rounded bg-white p-5" id="v-pills-cattle" role="tabpanel" aria-labelledby="v-pills-cattle-tab">
                      <h4 class="mb-4">Cattle Metagenomes</h4>
                      <div class="table-responsive">
                        <table class="table table-hover w-100 table-sm" id="envCattleTable">
                          <thead>
                            <tr>
                              <th>CMIS ID</th>
                              <th>Biosample </th>
                              <th>Study ID</th>
                              <th>Source</th>
                              <th>State</th>
                            </tr>
                          </thead>
                        </table>
                      </div>
                    </div>
                    <!-- Fish Table -->
                    <div class="tab-pane fade shadow rounded bg-white p-5" id="v-pills-fish" role="tabpanel" aria-labelledby="v-pills-fish-tab">
                      <h4 class="mb-4">Fish Metagenomes</h4>
                      <div class="table-responsive">
                        <table class="table table-hover w-100 table-sm" id="envFishTable">
                          <thead>
                            <tr>
                              <th>CMIS ID</th>
                              <th>Biosample </th>
                              <th>Study ID</th>
                              <th>Source</th>
                              <th>State</th>
                            </tr>
                          </thead>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              
            </div>
          </div>
        </div>

        <hr>
        <!-- Footer -->
        <?php include_once "../footer.php"; ?>
      </main>
    </div>
  </div>
  
</body>
</html>