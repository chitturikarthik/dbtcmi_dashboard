<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Initiating DB connection -->
    <?php include("../conn.php"); ?>
    <title>DBT-CMI: Geographical Distribution</title>
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
                <div class="row px-4 pt-3 mt-5 text-center text-uppercase">
                    <p class="fs-5 fw-bold mb-0">Geographical</p>
                    <h2 class="text-accent2 fw-bold mb-2">Distribution</h2>
                </div>
                <hr class="w-50 mx-auto">
                <!-- Map -->
                <div class="row px-4 mt-5">
                    <div class="col mx-auto p-4">
                        <h5 class="mb-4">Geographical Distribution of Metagenome Samples Studied Across India</h5>
                        <div class="p-4 bg-white rounded mr-0 me-lg-4 shadow">
                            <div id="map" style="width: auto; height: 95vh"></div>
                            <?php
                                $rows = array();
                                
                                $result = mysqli_query($conn,"SELECT T1.CMIM_ID, T1.latitude, T1.longitude, T1.sample_name, T1.CMIS_ID
                                FROM  new_meta_samples AS T1 WHERE T1.latitude AND T1.longitude <> 'NA'");
                                
                                while($row = mysqli_fetch_array($result)) {
                                $rows[] = $row;
                                }
                            ?>
                            <script>
                                // getting only one row for map view point (lat & long) 
                                var map_view_point = <?php echo JSON_encode($rows[0]); ?>; 
                                
                                var map = L.map('map').setView([20.5937, 78.9629], 5); 
                                L.tileLayer('https://api.maptiler.com/maps/basic/256/{z}/{x}/{y}.png?key=dVhthbXQs3EHCi0XzzkL',{
                                    attribution: '<a href="https://www.maptiler.com/copyright/" target="_blank">&copy; MapTiler</a> <a href="https://www.openstreetmap.org/copyright" target="_blank">&copy; OpenStreetMap contributors</a>'
                                }).addTo(map);

                                var city = L.markerClusterGroup();
                                // change input data into JSON format 
                                var data = <?php echo JSON_encode($rows); ?>;
                  
                                for (var i = 0; i < data.length; i++) {
                                    var new_location = new L.LatLng(data[i].latitude, data[i].longitude);
                                    let CMIS_ID = data[i].CMIS_ID
                                    var sample_name = data[i].sample_name;
                                    var marker = new L.Marker(new_location,  {
                                        title: sample_name
                                    });

                                    var message = 'Sample name: ' +sample_name ;
                                    // link on Popup 
                                    marker.bindPopup(`<a href="dashboard/mg_sample.php?msample=${CMIS_ID}" target="_blank" rel="noopener noreferrer"> ${sample_name}</a>`);
                                    city.addLayer(marker);

                                }
                          
                                map.addLayer(city);

                            </script>
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