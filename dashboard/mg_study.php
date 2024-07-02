<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Initiating DB connection -->
    <?php include("../conn.php"); 
        $_id = $_GET['cmimid'];
    ?>
    <title>DBT-CMI: <?php echo $_id; ?></title>
    <base href="../">
    <?php include_once '../head_links.php'; ?>
    <?php $page = 'db > mg > study'; ?>
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
            $query = "SELECT t1.CMIM_ID, t1.Study_Name, t2.state_name FROM new_meta_studies AS t1
            JOIN  states AS t2 ON t1.state_id = t2.state_id
            where CMIM_ID =  '$_id' ";
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
                <li class="breadcrumb-item"><a href="dashboard/mg_home.php">Metagenomes & Amplicons</a></li>
                <li class="breadcrumb-item active">
                  <a href="dashboard/mg_study.php?cmimid=<?php echo $rows ["CMIM_ID"];?>">Study: <?php echo $rows ["CMIM_ID"]; ?></a>
                </li>
              </ol>
            </nav>
          </nav>
          <h2 class="text-accent2 fw-bold mb-2 text-uppercase"><?php echo $rows ["CMIM_ID"]; ?></h2>
          <p class="mb-1 text-muted"><?php echo $rows["Study_Name"]; ?></p>
          <p class="mb-0"><?php echo $rows ["state_name"]; ?></p>
          <?php } ?>
        </div>
        <hr class="w-25 ms-5">
        
        <!-- Study Description -->
        <div class="row px-4 mt-3">
          <!-- Description, Publication, Metadata -->
          <div class="col mx-auto p-4">
            <div class="p-5 bg-white rounded-4 mr-0 me-lg-4 shadow">
              <div class="mb-3">
                <h5 class="mb-4">Description</h5>
                <hr class="w-25 mb-4">
                <?php 
                  $query = "SELECT new_meta_studies.Description, new_meta_studies.Publication, new_meta_studies.metadata
                  FROM new_meta_studies 
                  JOIN new_meta_samples 
                  ON new_meta_studies.CMIM_ID=new_meta_samples.CMIM_ID 
                  where new_meta_studies.CMIM_ID =  '$_id'
                  LIMIT 1; ";
                  $result = mysqli_query($conn,$query);
                ?>
                <?php 
                  // $result = mysqli_query($conn,$sql) or die(mysqli_error ($conn) );
                  while($rows = mysqli_fetch_array($result)) {
                ?>
                <p class="text-muted">
                  <?php echo $rows ["Description"];?>
                </p>
                <div class="mt-5">
                  <a class="btn btn-outline-primary" type="button" target="_blank" rel="noopener noreferrer" href='<?php echo $rows ["Publication"];?>'>Publication</a>
                  <a class="btn btn-outline-primary mx-5" type="button" target="_blank" rel="noopener noreferrer" href='<?php echo $rows ["metadata"];?>'>Metadata</a>
                </div>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
        <!-- Details and Map -->
        <div class="row px-4 mt-3">
          <!-- Study Information -->
          <div class="col-xl-6 mx-auto p-4">
            <div class="p-5 bg-white rounded-4 mr-0 me-lg-4 shadow">
              <div class="mb-3">
                <h5 class="mb-4">Details</h5>
                <hr class="w-25 mb-4">
                <div class="table-responsive">
                  <table class="table table-xs">
                    <tbody>
                      <?php 
                        $query = "SELECT t1.study_id, t1.CMIM_ID, t2.main_environment, t1.Seq_platform, t1.Sequence_region, t1.Sample_size, t1.Organization, t1.Deposited_at 
                        FROM new_meta_studies AS t1 JOIN main_environments AS t2 ON t1.menv_id=t2.menv_id 
                        WHERE t1.CMIM_ID = '$_id'; ";
                        $result = mysqli_query($conn,$query);
                      ?>
                      <?php 
                        // $result = mysqli_query($conn,$sql) or die(mysqli_error ($conn) );
                        while($rows = mysqli_fetch_array($result)) {
                      ?>                            
                      <tr>
                        <th>Study ID</th>
                        <td><a target="_blank" rel="noopener noreferrer" href="<?php 
                          require_once('ext_links.php');
                          foreach ($links as $key => $value) {
                            if (str_contains($rows ["study_id"], $key)) {
                                echo $value;
                            }
                          }
                        ?><?php echo $rows ["study_id"];?>"><?php echo $rows ["study_id"];?></a></td>
                      </tr>
                      <tr>
                        <th>CMIM ID</th>
                        <td> <?php echo $rows ["CMIM_ID"]; ?></td>
                      </tr>
                      <tr>
                        <th>Environment</th>
                        <td> <?php echo $rows ["main_environment"]; ?></td>
                      </tr>
                      <tr>
                        <th>Sequencing Platform</th>
                        <td> <?php echo $rows ["Seq_platform"]; ?></td>
                      </tr>
                      <tr>
                        <th>Sequenced region</th>
                        <td> <?php echo $rows ["Sequence_region"]; ?></td>
                      </tr>
                      <tr>
                        <th>Sample Size</th>
                        <td><a href="dashboard/mg_study.php?cmimid=<?php echo $rows ["CMIM_ID"];?>#samplesTable"> <?php echo $rows ["Sample_size"]; ?></a></td>
                      </tr>
                      <tr>
                        <th>Organization</th>
                        <td> <?php echo $rows ["Organization"]; ?></td>
                      </tr>
                      <tr>
                        <th>Deposited at</th>
                        <td> <?php echo $rows ["Deposited_at"]; ?></td>
                      </tr>
                      <?php 
                          } 
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <!-- Map -->
          <div class="col-xl-6 mx-auto p-4">
              <div class="p-5 bg-white rounded-4 mr-0 me-lg-4 shadow">
                  <div class="mb-3">
                      <h5 class="mb-4">Location</h5>
                      <hr class="w-25 mb-4">
                      <div id="map" style="width: auto; height: 340px;">
                          <?php 
                              $rows = array();
                              
                              $result = mysqli_query($conn,"SELECT CMIM_ID, latitude, CMIS_ID, longitude, sample_name
                              FROM  new_meta_samples
                              WHERE CMIM_ID = '$_id'");
                          
                              while($row = mysqli_fetch_array($result)) {
                              $rows[] = $row;
                              }
                          ?>
                          <script>
                            // getting only one row for map view point (lat & long) 
                            var map_view_point = <?php echo JSON_encode($rows[0]); ?>;  
                            // set Dynamic view point with map zoom point 7 
                            var map = L.map('map').setView([map_view_point.latitude,map_view_point.longitude], 5);
                            L.tileLayer('https://api.maptiler.com/maps/basic/256/{z}/{x}/{y}.png?key=dVhthbXQs3EHCi0XzzkL',{
                              attribution: '<a href="https://www.maptiler.com/copyright/" target="_blank">&copy; MapTiler</a> <a href="https://www.openstreetmap.org/copyright" target="_blank">&copy; OpenStreetMap contributors</a>'
                            }).addTo(map);

                            // Fetch Dynamic marker latitute and longitude
                            //var marker = L.marker([map_view_point.latitude ,map_view_point.longitude]).addTo(map);
                            var city = L.markerClusterGroup();
                            var data = <?php echo JSON_encode($rows); ?>;
            
                            for (var i = 0; i < data.length; i++) {
                              var new_location = new L.LatLng(data[i].latitude, data[i].longitude);
                              let CMIS_ID = data[i].CMIS_ID;
                              let sample_name = data[i].sample_name;  // variabele to show sample name in map marker
                              var marker = new L.Marker(new_location, {
                                title: CMIS_ID
                              });
                              var message = 'Sample name: ' +CMIS_ID;
                              //marker.bindPopup(message);
                              marker.bindPopup(`<a href="dashboard/mg_sample.php?msample=${CMIS_ID}" target="_blank" rel="noopener noreferrer"> ${sample_name}</a>`);
                              city.addLayer(marker);
                    
                            }
                        
                            map.addLayer(city);
                          </script>
                      </div>
                  </div>
              </div>
          </div>
        </div>
        <!-- Samples Table -->
        <div class="row px-4 mt-3">
          <div class="col mx-auto p-4">
            <div class="p-5 bg-white rounded-4 mr-0 me-lg-4 shadow">
              <div class="mb-3">
                <h5 class="mb-4">Samples</h5>
                <hr class="w-25 mb-5">
                <div class="table-responsive">
                  <table class="table table-hover" id="samplesTable">
                    <thead>
                      <tr>
                        <th>CMIS_ID</th>
                        <th>Sample</th>
                        <th>BioSample ID</th>
                        <th>Environment</th>
                        <th>Isolation source</th>
                        <th>Collection Date</th>
                        <th>Location</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                        #Get CMIM_ID from mg_home.php 
                        $query = "SELECT t1.sample_name, t1.Biosample_ID, t1.CMIS_ID, t1.Collection_Date, t1.Location, t2.env_name, t4.source_name
                            FROM new_meta_samples AS t1
                            JOIN environments AS t2 
                            ON t1.env_id= t2.env_id
                            JOIN source AS t4
                            ON t1.Source_ID = t4.source_ID
                            WHERE t1.CMIM_ID='$_id'";                                    
                        $result = mysqli_query($conn,$query);
                      ?>  
      
                      <?php 
                          
                      while($rows = mysqli_fetch_array($result)) {

                      ?>                        
                      <tr>
                        <td><?php echo $rows ["CMIS_ID"];?></td>
                        <td><a name= "msample" href="dashboard/mg_sample.php?msample=<?php echo $rows ["CMIS_ID"];?>" target="_blank"><?php echo $rows ["sample_name"];?></a></td>
                        <td><a target="_blank" name= "msample" href="<?php
                          foreach ($links as $key => $value) {
                            if (str_contains($rows ["Biosample_ID"], $key)) {
                                echo $value;
                            }
                          }
                        ?><?php echo $rows ["Biosample_ID"];?>"><?php echo $rows ["Biosample_ID"];?></a></td>
                        <td><?php echo $rows ["env_name"];?></td>
                        <td><?php echo $rows ["source_name"];?></td>
                        <td><?php echo $rows ["Collection_Date"];?></td>
                        <td><?php echo $rows ["Location"];?></td>
                      </tr>
                      
                      <?php 
                      } 
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- OTU Table 
        <div class="row px-4 mt-3">
          <div class="col mx-auto p-4">
            <div class="p-5 bg-white rounded mr-0 me-lg-4 shadow">
              <div class="mb-3">
                <h5 class="mb-4">OTU Abundance</h5>
                <hr class="w-25 mb-5">
                <div class="table-responsive">
                  <table class="table table-hover" id="otuTable">
                    <thead>
                      <tr> 
                        <th>OTU-ID</th>
                        <th>FN12</th>
                        <th>FN144</th>
                        <th>FN146</th>
                        <th>FN147</th>
                        <th>FN160</th>  
                        <th>FN173</th>
                        <th>FN40</th>                       
                        <th>Kingdom</th>
                        <th>phylum</th>
                        <th>Class</th>
                        <th>Order</th>
                        <th>Family</th>
                        <th>Genus</th>
                        <th>Species</th>
                      </tr>
                    </thead>
                      <tbody>
                        <?php
                        #Get CMIM_ID from mg_home.php 
                        # query for getting otu table from 9 SQL tables (otu, otu_count_STD1, and seven level tables)
                        # extracting data with LEFT JOIN query because we need to extract NULL value from otu table also    
                        //$query = "SELECT  otu.otu_id, t1.FN12, t1.FN144, t1.FN146, t1.FN147, t1.FN160, t1.FN173, t1.FN40, 
                        //t2.kingdom, t3.phylum, t4.class, t5.order, t6.family, t7.genus, t8.species
                        //FROM otu 
                        //JOIN otu_count_STD1 as t1 
                        //ON t1.cmi_otu_id =otu.cmi_otu_id
                        //LEFT JOIN kingdom as t2
                        //ON t2.kingdom_ID= otu.kingdom_ID
                        //LEFT JOIN phylum as t3
                        //ON t3.phylum_ID= otu.phylum_ID
                        //LEFT JOIN class AS t4
                        //ON t4.class_ID= otu.class_ID
                        //LEFT JOIN ordr AS t5
                        //ON  t5.order_ID= otu.order_ID
                        //LEFT JOIN family As t6
                        //ON t6.family_ID= otu.family_ID
                        //LEFT JOIN genus AS t7
                        //ON t7.genus_ID= otu.genus_ID
                        //LEFT JOIN species AS t8
                        //ON t8.species_ID = otu.species_ID";

                        //$result = mysqli_query($conn,$query);
                        //while($rows = mysqli_fetch_array($result)) {
                        ?> 
                        <tr>
                          <td><?php //echo $rows ["otu_id"];?></td>
                          <td><?php //echo $rows ["FN12"];?></td>
                          <td><?php //echo $rows ["FN144"];?></td>
                          <td><?php //echo $rows ["FN146"];?></td>
                          <td><?php //echo $rows ["FN147"];?></td>
                          <td><?php //echo $rows ["FN160"];?></td>
                          <td><?php //echo $rows ["FN173"];?></td>
                          <td><?php //echo $rows ["FN40"];?></td>
                          <td><?php //echo $rows ["kingdom"];?></td>
                          <td><?php //echo $rows ["phylum"];?></td>
                          <td><?php //echo $rows ["class"];?></td>
                          <td><?php //echo $rows ["order"];?></td>
                          <td><?php //echo $rows ["family"];?></td>
                          <td><?php //echo $rows ["genus"];?></td>
                          <td><?php //echo $rows ["species"];?></td>
                        </tr>
                        <?php 
                           // } 
                        ?>
                      </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>-->
        <!-- Plots 
        <div class="row px-4 mt-3">-->
          <!-- Relative Abundance 
          <div class="col-xl-6 mx-auto p-4" >
            <div class="p-5 bg-white rounded mr-0 me-lg-4 shadow">
              <div class="mb-3">
                <h5 class="mb-4">Relative Abundance of Phyla</h5>
                <hr class="w-25 mb-4">
                <canvas id="phylaRelAb" aria-label="Phyla Relative Abundance" role="img"></canvas>
              </div>
            </div>
          </div>-->
          <!-- Donut - Top Genera 
          <div class="col-xl-6 mx-auto p-4">
            <div class="p-5 bg-white rounded mr-0 me-lg-4 shadow">
              <div class="mb-3">
                <h5 class="mb-4">Top Genera (%)</h5>
                <hr class="w-25 mb-4">
                <canvas id="topGenera" aria-label="Top Genera" role="img"></canvas>
              </div>
            </div>
          </div>
        </div>-->

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
  <!-- Stacked Bar - Phyla Relative Abundance - Study -->
  <script>
    const autocolors = window['chartjs-plugin-autocolors'];
    Chart.register(autocolors);
    const lighten = (color, value) => Chart.helpers.color(color).lighten(value).rgbString();

    const stackedPhyla = document.getElementById('phylaRelAb');
    stackedPhyla.height = 300;
    const stackedPhylaAb = new Chart(stackedPhyla, {
      type: 'bar',
      data: {
        labels: ['FN12',  'FN144',  'FN146',  'FN147',  'FN160',  'FN173',  'FN40'],
        datasets: [
          {
            label: 'Firmicutes',
            data: [0.972758, 0.887937, 0.697988, 0.890466, 0.886271, 0.629904, 0.731113],
          },
          {
            label: 'Proteobacteria',
            data: [0.023069, 0.052441, 0.023554, 0.013013, 0.007709, 0.226118, 0.054615],
          },
          {
            label: 'Bacteroidetes',
            data: [0.001355, 0.047225, 0.272987, 0.092587, 0.094660, 0.127495, 0.202245],
          },
          {
            label: 'Actinobacteria',
            data: [0.002210, 0.010766, 0.003949, 0.002768, 0.010962, 0.015845, 0.011150],
          },
          {
            label: 'Acidobacteria',
            data: [0.000290, 0.000225, 0.000341, 0.000254, 0.000217, 0.000254, 0.000370],
          },
          {
            label: 'Nitrospirae',
            data: [0.000138, 0.000065, 0.000130, 0.000116, 0.000058, 0.000094, 0.000138],
          },
          {
            label: 'Gemmatimonadetes',
            data: [0.000043, 0.000051, 0.000065, 0.000051, 0.000051, 0.000051, 0.000043],
          },
          {
            label: 'Cyanobacteria',
            data: [0.000036, 0.001188, 0.000014, 0.000674, 0.000022, 0.000022, 0.000007],
          },
          {
            label: 'Chloroflexi',
            data: [0.000022, 0.000043, 0.000007, 0.000014, 0.000007, 0.000087, 0.000036],
          },
          {
            label: 'TM7',
            data: [0.000007, 0.000007, 0.000000, 0.000022, 0.000022, 0.000022, 0.000022],
          },
          {
            label: 'Fusobacteria',
            data: [0.000000, 0.000000, 0.000007, 0.000000, 0.000000, 0.000000, 0.000138],
          },
          {
            label: 'Unknown',
            data: [0.000022, 0.000000, 0.000007, 0.000000, 0.000000, 0.000000, 0.000007],
          },
          {
            label: 'Tenericutes',
            data: [0.000000, 0.000007, 0.000000, 0.000000, 0.000000, 0.000029, 0.000000],
          },
          {
            label: 'Lentisphaerae',
            data: [0.000000, 0.000007, 0.000000, 0.000000, 0.000000, 0.000036, 0.000000],
          },
          {
            label: '[Thermi]',
            data: [0.000007, 0.000007, 0.000000, 0.000000, 0.000000, 0.000000, 0.000014],
          },
          {
            label: 'SBR1093',
            data: [0.000029, 0.000022, 0.000014, 0.000029, 0.000014, 0.000036, 0.000058],
          },
          {
            label: 'WS3',
            data: [0.000014, 0.000007, 0.000000, 0.000007, 0.000007, 0.000007, 0.000043],
          },
          {
            label: 'Spirochaetes',
            data: [0.000000, 0.000000, 0.000935, 0.000000, 0.000000, 0.000000, 0.000000],
          },
        ]
      },
      options: {
        plugins: {
          autocolors: {
            mode: 'dataset',
            customize(context) {
              const colors = context.colors;
              return {
                background: lighten(colors.background, 0.3),
                border: lighten(colors.border, 0.3)
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
                useBorderRadius: true,
              }
            }
          },
        },
        responsive: true,
        scales: {
          x: {
            stacked: true,
          },
          y: {
            stacked: true,
            max: 1.0,
          }
        }
      }
    })
  </script>

  <!-- Donut plot - Top Genera - Study -->
  <script>
    const donutGeneraStudy = document.getElementById('topGenera');
    const topGeneraStudy = new Chart(donutGeneraStudy, {
      type: 'doughnut',
      options: {
        cutout: '70%',
      },
      data: {
        labels: [
          'Lachnospiraceae_Un',
          'Dialister',
          'Prevotella',
          'Roseburia',
          'Faecalibacterium',
          'Clostridiales_Un',
          'Succinovibrio',
          'Coprococcus',
          'Ruminococcaceae_Un',
          'Veillonella',
          'Others'
        ],
        datasets: [{
          label: 'Top Genera',
          data: [32, 16, 11, 10, 8, 5, 3, 3, 2, 1, 9],
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
  </script>
  
</body>
</html>