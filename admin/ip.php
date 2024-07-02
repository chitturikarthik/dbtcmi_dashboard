<?php
SESSION_START();
if(!isset($_SESSION['access']) == 'dbtcmi'){header("Location: index.php");};

include 'connect.php';

$ip = "select visitor_ip , count(visitor_ip) as ip_count , city , region ,country, continent  from page_visits group by visitor_ip";
$ip_result = mysqli_query($conn,$ip);

$sql = "SELECT city, COUNT(DISTINCT visitor_ip) AS ip_count FROM page_visits GROUP BY city ORDER BY city";
$result = mysqli_query($conn, $sql);
$cityCounts = array();

// Check if the query was successful
if ($result === false) {
    echo "Error in SELECT query: " . mysqli_error($conn);
    exit;
}

// Loop through the query results
while ($row = mysqli_fetch_assoc($result)) {
    $city = $row['city'];
    $count = $row['ip_count'];

    // Store city and IP count in the array
    $cityCounts[$city] = $count;
}

// Convert the city counts array into JavaScript data format
$jsCityData = '';
foreach ($cityCounts as $city => $count) {
    $jsCityData .= '["' . $city . '", ' . $count . '],';
}
$jsCityData = rtrim($jsCityData, ',');



?>

<!doctype html>
<html class="fixed header-dark">
	<head>

		<!-- Basic -->
		<meta charset="UTF-8">

		<title>DBT-CMI Web Visitors</title>
		<meta name="keywords" content="HTML5 Admin Template" />
		<meta name="description" content="Porto Admin - Responsive HTML5 Template">
		<meta name="author" content="okler.net">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		<!-- Web Fonts  -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.css" />
		<link rel="stylesheet" href="vendor/animate/animate.css">

		<link rel="stylesheet" href="vendor/font-awesome/css/all.min.css" />
		<link rel="stylesheet" href="vendor/magnific-popup/magnific-popup.css" />
		<link rel="stylesheet" href="vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css" />

		<!-- Specific Page Vendor CSS -->
		<link rel="stylesheet" href="vendor/select2/css/select2.css" />
		<link rel="stylesheet" href="vendor/select2-bootstrap-theme/select2-bootstrap.min.css" />
		<link rel="stylesheet" href="vendor/datatables/media/css/dataTables.bootstrap4.css" />
    	<link rel="stylesheet" href="vendor/jquery-ui/jquery-ui.css" />
		<link rel="stylesheet" href="vendor/jquery-ui/jquery-ui.css" />
		<link rel="stylesheet" href="vendor/jquery-ui/jquery-ui.theme.css" />
		<link rel="stylesheet" href="vendor/bootstrap-multiselect/css/bootstrap-multiselect.css" />
		<link rel="stylesheet" href="vendor/morris/morris.css" />

		<link rel="stylesheet" href="vendor/jquery-ui/jquery-ui.css" />
		<!-- Theme CSS -->
		<link rel="stylesheet" href="css/theme.css" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="css/skins/default.css" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="css/custom.css">

		<!-- Head Libs -->
		<script src="vendor/modernizr/modernizr.js"></script>
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

	</head>
	<body>
	<section class="body">
        <!-- start: header -->
        <?php include 'header.php' ?>
        <!-- end: header -->

        <div class="inner-wrapper">
            <!-- start: sidebar -->
            <?php include 'sidebar.php' ?>
            <!-- end: sidebar -->

            <section role="main" class="content-body">

                <!-- start: page -->


                


                <div class="row">
							<div class="col-lg-12">
								<section class="card">
									<header class="card-header">
										<div class="card-actions">
											<a href="#" class="card-action card-action-toggle" data-card-toggle></a>
											<a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>
										</div>
						
										<h4 class="font-weight-bold text-dark text-uppercase">Detials of Unique IP Addresses</h4>
									</header>
									<div class="card-body">
                                        <table class="table table-bordered table-striped mb-0" id="datatable-tabletools">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>IP Address</th>
                                                    <th>Location</th>
                                                    <th>IP Count</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php $count = 1; while ($row = mysqli_fetch_assoc($ip_result)): ?>
                                                <tr>
                                                    
                                                    <td><?php echo $count; ?></td>
                                                    <td><?php echo $row['visitor_ip']; ?></td>
                                                    <td>
                                                        <?php 
                                                            $location = $row['city']." , ".$row['region']." , ".$row['country'] ;

                                                            echo $location;
                                                        ?>
                                                    </td>
                                                    <td><?php echo $row['ip_count']; ?></td>
                                                </tr>
                                            <?php $count++; endwhile; ?>
                                            </tbody>
                                            
                                        </table>
									</div>
								</section>
							</div>
						</div>



                        <div class="row">

                        <div class="col-lg-12">
								<div class="col-lg-12">
									<section class="card">
										<header class="card-header">
											<div class="card-actions">
												<a href="#" class="card-action card-action-toggle" data-card-toggle></a>
												<a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>
											</div>
											<h4 class="font-weight-bold text-dark text-uppercase">IP Per City</h4>
											<h5>Unique IP Addresses coming from different Cities.</h5>
										</header>
										<div class="card-body">
											<!-- Flot: Bars -->
											<div class="chart chart-md" id="flotBars"></div>
											<script type="text/javascript">
												var flotBarsData = [<?php echo $jsCityData; ?>];
											</script>
										</div>
									</section>
								</div>
							</div>

                </div>
                <!-- end: page -->
            </section>
        </div>
    </section>

		<!-- Vendor -->
		<script src="vendor/jquery/jquery.js"></script>
    <script src="vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
    <script src="vendor/popper/umd/popper.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.js"></script>
    <script src="vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script src="vendor/common/common.js"></script>
    <script src="vendor/nanoscroller/nanoscroller.js"></script>
    <script src="vendor/magnific-popup/jquery.magnific-popup.js"></script>
    <script src="vendor/jquery-placeholder/jquery.placeholder.js"></script>

    <!-- Specific Page Vendor -->
    <script src="vendor/select2/js/select2.js"></script>
    <script src="vendor/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/media/js/dataTables.bootstrap4.min.js"></script>
    <script src="vendor/datatables/extras/TableTools/Buttons-1.4.2/js/dataTables.buttons.min.js"></script>
    <script src="vendor/datatables/extras/TableTools/Buttons-1.4.2/js/buttons.bootstrap4.min.js"></script>
    <script src="vendor/datatables/extras/TableTools/Buttons-1.4.2/js/buttons.html5.min.js"></script>
    <script src="vendor/datatables/extras/TableTools/Buttons-1.4.2/js/buttons.print.min.js"></script>
    <script src="vendor/datatables/extras/TableTools/JSZip-2.5.0/jszip.min.js"></script>
    <script src="vendor/datatables/extras/TableTools/pdfmake-0.1.32/pdfmake.min.js"></script>
    <script src="vendor/datatables/extras/TableTools/pdfmake-0.1.32/vfs_fonts.js"></script>
    <script src="js/theme.js"></script>
    <script src="js/cstom.js"></script>
    <script src="js/theme.init.js"></script>
    <script src="js/examples/examples.datatables.default.js"></script>
    <script src="js/examples/examples.datatables.row.with.details.js"></script>
    <script src="js/examples/examples.datatables.tabletools.js"></script>
    <script src="vendor/liquid-meter/liquid.meter.js"></script>
    <script src="vendor/flot/jquery.flot.js"></script>
    <script src="vendor/flot.tooltip/jquery.flot.tooltip.js"></script>
    <script src="vendor/flot/jquery.flot.categories.js"></script>
    <script src="vendor/flot/jquery.flot.resize.js"></script>
    <script src="vendor/chartist/chartist.js"></script>
    <script src="js/examples/examples.charts.js"></script>
    <script src="js/examples/examples.modals.js"></script>

	</body>
</html>