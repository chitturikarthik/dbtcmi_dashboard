<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Initiating DB connection -->
  <?php include("../conn.php"); 
    $_id = $_GET['msample'];
    echo $_id;
  ?>
  <title>DBT-CMI: <?php echo $_id; ?></title>
  <base href="../">
  <?php include_once '../head_links.php'; ?>

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
        <div class="row px-5 pt-3 mt-5">
          <?php 
            $query= "SELECT t1.sample_name, t1.DNA_extraction, t1.Sequence_stratergy, t1.Instrument, t1.Library_layout, t1.Location, t1.latitude, t1.longitude, t1.Sequence_depth, t1.bases, t1.Analysis_pipeline, t1.No_of_otus, t1.CMIS_ID, t1.Biosample_ID, t1.CMIM_ID, t2.state_name, t3.study_id, t4.env_name, t5.source_name
            FROM new_meta_samples AS t1 
            JOIN states AS t2
            ON t1.state_id=t2.state_id
            JOIN new_meta_studies AS t3
            ON t1.CMIM_ID=t3.CMIM_ID
            JOIN environments AS t4
            ON t1.env_id = t4.env_id
            JOIN source AS t5
            ON t1.Source_ID = t5.Source_ID
            WHERE t1.CMIS_ID='$_id'";
            $result = mysqli_query($conn,$query);
          ?>
          <?php 
            // $result = mysqli_query($conn,$sql) or die(mysqli_error ($conn) );
            while($rows = mysqli_fetch_array($result)) {
          ?> 
          <!-- Breadcrumb -->
          <nav class="navbar navbar-expand-lg bg-transparent mb-3 justify-content-end">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb shadow-sm rounded">
                <li class="breadcrumb-item"><a href="dashboard/collections.php">Collections</a></li>
                <li class="breadcrumb-item"><a href="dashboard/mg_home.php">Metagenomes</a></li>
                <li class="breadcrumb-item">
                  <a href="dashboard/mg_study.php?cmimid=<?php echo $rows ["CMIM_ID"];?>">Study: <?php echo $rows ["CMIM_ID"]; ?></a>
                </li>
                <li class="breadcrumb-item active">
                  <a href="dashboard/mg_sample.php?msample=<?php echo $rows ["CMIS_ID"];?>">Sample: <?php echo $rows ["CMIS_ID"]; ?></a>
                </li>
              </ol>
            </nav>
          </nav>
          <h2 class="text-accent2 fw-bold mb-2 text-uppercase">
            <?php echo $rows ["sample_name"]; ?>
          </h2>
          <p class="mb-1 text-muted">
            SampleID: <?php echo $rows ["CMIS_ID"]; ?>
          </p>
          <p class="mb-0">
            <?php echo $rows ["state_name"]; ?>
          </p>
        </div>
        <hr class="w-25 ms-5">
        
        <!-- Details & Plot -->
        <div class="row px-4 mt-3">
          <div class="col-xl-6 mx-auto p-4">
            <div class="p-5 bg-white rounded mr-0 me-lg-4 shadow">
              <div class="mb-3">
                <h5 class="mb-4">Details</h5>
                <hr class="w-25 mb-4">
                <div class="table-responsive">
                  <table class="table table-xs">
                    <tbody>
                      <tr>
                        <th>Study ID</th>
                        <td><a target="_blank" rel="noopener noreferrer" href="<?php 
                          require_once('ext_links.php'); // for use diff links like mgrast ncbi
                          foreach ($links as $key => $value) {
                            if (str_contains($rows ["study_id"], $key)) {
                                echo $value;
                            }
                          }
                        ?><?php echo $rows ["study_id"];?>"><?php echo $rows ["study_id"];?></a></td>
                      </tr>
                      <tr>
                        <th>Sample Name</th>
                        
                        <td><a target="_blank" rel="noopener noreferrer" href="<?php 
                          require_once('ext_links.php');
                          foreach ($links as $key => $value) {
                            if (str_contains($rows ["Biosample_ID"], $key)) {
                                echo $value;
                            }
                          }
                        ?><?php echo $rows ["study_id"];?>"><?php echo $rows ["study_id"];?></a></td>
                      </tr>
                      <!-- <tr>
                        <th>Metadata</th>
                        <td><a href="#"> <?php //echo $rows ["Metadata"]; ?></a></td>
                      </tr> -->
                      <tr>
                        <th>Location</th>
                        <td><?php echo $rows ["Location"]; ?></td>
                      </tr>
                      <tr>
                        <th>Latitude & Longitude</th>
                        <td>
                          <?php echo $rows ["latitude"]; ?>, 
                          <?php echo $rows ["longitude"]; ?>
                        </td>
                      </tr>
                      <tr>
                        <th>Isolation Source</th>
                        <td>
                          <?php echo $rows ["env_name"]; ?>
                          <i class="bi bi-arrow-right-circle-fill text-accent3"></i>
                          <?php echo $rows ["source_name"]; ?>
                        </td>
                      </tr>
                      <tr>
                        <th>DNA Extraction</th>
                        <td><?php echo $rows ["DNA_extraction"]; ?></td>
                      </tr>
                      <tr>
                        <th>Sequence Strategy</th>
                        <td><?php echo $rows ["Sequence_stratergy"]; ?></td>
                      </tr>
                      <tr>
                        <th>Instrument</th>
                        <td><?php echo $rows ["Instrument"]; ?></td>
                      </tr>
                      <tr>
                        <th>Library layout</th>
                        <td><?php echo $rows["Library_layout"]; ?></td>
                      </tr>
                      <tr>
                        <th>Sequence depth</th>
                        <td><?php echo $rows["Sequence_depth"]; ?></td>
                      </tr>
                      <!-- <tr>
                        <th>Raw reads accessiblity</th>
                        <td><a href="#"><?php // echo $rows["raw_reads_accessiblity"]; ?></a></td>
                      </tr> -->
                      <tr>
                        <th>Bases</th>
                        <td><?php echo $rows["bases"]; ?></td>
                      </tr>
                      <tr>
                        <th>Analysis Pipeline</th>
                        <td><?php echo $rows["Analysis_pipeline"]; ?></td>
                      </tr>
                      <tr>
                        <th>No. of OTUs</th>
                        <td><?php echo $rows["No_of_otus"]; ?></td>
                      </tr>
                      <!-- <tr>
                        <th>alpha Diversity indices</th>
                        <td><?php // echo $rows["Alpha_diversity_Indices"]; ?></td>
                      </tr> -->
                    </tbody>
                    <?php } ?>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-6 mx-auto p-4">
            <div class="p-5 bg-white rounded mr-0 me-lg-4 shadow">
              <div class="mb-3">
                <h5 class="mb-4">Top Genera (%)</h5>
                <hr class="w-25 mb-4">
                <!--<canvas id="topGenera" aria-label="Top Genera" role="img"></canvas>-->
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

  <!-- Auto color generation for Chart JS -->
  <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-autocolors"></script>

  <!-- Chart JS & Plots -->
  <script src="js/chart.js/chart.min.js"></script>

  <!-- Donut plot - Top Genera - Sample 
  <script>
    // Colors
    const autocolors = window['chartjs-plugin-autocolors'];
    Chart.register(autocolors);
    const lighten = (color, value) => Chart.helpers.color(color).lighten(value).rgbString();

    const donutGeneraStudy = document.getElementById('topGenera');
    const topGeneraStudy = new Chart(donutGeneraStudy, {
      type: 'doughnut',
      options: {
        cutout: '70%',
      },
      data: {
        labels: [
          'Lachnospiraceae_Un', 'Dialister', 'Roseburia', 'Clostridiales_Un', 'Coprococcus', 'Enterobacteriaceae_Un', 'Dorea', 'Faecalibacterium', 'Enterobacter', 'Lachnospira', 'Anaerostipes', 'Klebsiella', 'Blautia', 'Catenibacterium', 'Clostridiaceae_Un', '[Ruminococcus]', 'Ruminococcaceae_Un', 'Ruminococcus', 'Pseudobutyrivibrio', 'Others'
        ],
        datasets: [{
          label: 'Top Genera',
          data: [75641, 30514, 12827, 8116, 2154, 1461, 972, 892, 871, 585, 526, 497, 437, 242, 237, 224, 207, 108, 104, 1406],
          borderColor: '#fff',
          hoverOffset: 4
        }]
      },
      options: {
        cutout: '60%',
        plugins: {
          autocolors: {
            mode: 'data',
            customize(context) {
              const colors = context.colors;
              return {
                background: lighten(colors.background, 0.5),
                border: lighten(colors.border, 0.5)
              };
            }
          },
          legend: {
            position: 'bottom',
            align: 'start',
            labels: {
              font: {
                size: 14,
                family: 'Roboto',
                style: 'italic',
                useBorderRadius: true,
              }
            }
          },
        }
      },
    })
  </script>-->
    
</body>
</html>