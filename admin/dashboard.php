<?php
SESSION_START();
if(!isset($_SESSION['access']) == 'dbtcmi'){header("Location: index.php");};

include 'connect.php';


$current_date = date("Y-m-d");
$visitor_query = "SELECT * , COUNT(DISTINCT visitor_ip) AS distinct_ip_count , COUNT(visitor_ip) AS count_ip , COUNT(CASE WHEN DATE(time) = '$current_date' THEN visitor_ip END) AS present_day_ip FROM page_visits";

$Vresult = mysqli_query($conn, $visitor_query);
$Vrow = mysqli_fetch_assoc($Vresult);
$unique_ip = $Vrow['distinct_ip_count'];
$total_ip = $Vrow['count_ip'];
$present_ip = $Vrow['present_day_ip'];


$query = "SELECT COLUMN_NAME 
          FROM INFORMATION_SCHEMA.COLUMNS 
          WHERE TABLE_NAME = 'page_visits' 
          AND COLUMN_NAME LIKE '%.php'";
$result = mysqli_query($conn, $query);

if ($result === false) {
    echo "Error in SELECT query: " . mysqli_error($conn);
    exit;
}

$page_hits = [];
while ($row = mysqli_fetch_assoc($result)) {
    $page_name = $row['COLUMN_NAME'];
	$page_name = ucfirst($page_name);
    $hits_query = "SELECT COUNT(*) AS hits FROM page_visits WHERE `$page_name` = 1";
    $hits_result = mysqli_query($conn, $hits_query);
    $hits_row = mysqli_fetch_assoc($hits_result);
    $hits_count = $hits_row['hits'];
    $page_hits[$page_name] = $hits_count;
	$view_count[] = array('label' => $page_name , 'value' => $hits_count);
}
arsort($page_hits);
$js_morrisDonutData = json_encode($view_count);

$sql = "SELECT region FROM page_visits ORDER BY region";
$result = mysqli_query($conn, $sql);
$countryCounts = array();
// Check if the query was successful
if ($result === false) {
    echo "Error in SELECT query: " . mysqli_error($conn);
    exit;
}

// Loop through the query results
while ($row = mysqli_fetch_assoc($result)) {
    $countries = explode(",", $row['region']); // Assuming countries are comma-separated

    // Count occurrences of each country
    foreach ($countries as $country) {
        $country = trim($country); // Remove extra spaces
        if (!empty($country)) {
            if (isset($countryCounts[$country])) {
                $countryCounts[$country]++;
            } else {
                $countryCounts[$country] = 1;
            }
        }
    }
}

// Convert the country counts array into JavaScript data format
$jsCountryData = '';
foreach ($countryCounts as $country => $count) {
    $jsCountryData .= '["' . $country . '", ' . $count . '],';
}
$jsCountryData = rtrim($jsCountryData, ',');


$present_visitors = "SELECT * , DATE(time) AS main_time  FROM page_visits  WHERE DATE(time) = '$current_date'";
$present_result = mysqli_query($conn , $present_visitors);

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
<style>
#morrisDonut text{
	font-size:12px !important;
	font-family:Inter,sans-serif;
	text-transform:uppercase;
	font-weight:400;
}
</style>
	</head>
	<body>
		<section class="body">

			<!-- start: header -->
			<?php include 'header.php';?>
			<!-- end: header -->

			<div class="inner-wrapper">
				<!-- start: sidebar -->
				<?php include 'sidebar.php'; ?>
				<!-- end: sidebar -->

				<section role="main" class="content-body">
					<!-- start: page -->
						
						<!-- <h4 class="font-weight-bold text-dark text-uppercase">Visitor Insights</h4> -->
						<div class="row">

							<div class="col-lg-4 pt-5">
								<a href="visitors.php">
									<div class="col-lg-12">
										<section class="card mb-4">
											<div class="card-body bg-primary">
												<div class="widget-summary">
													<div class="widget-summary-col widget-summary-col-icon">
														<div class="summary-icon">
															<i class="fa fa-users mt-3"></i>
														</div>
													</div>
													<div class="widget-summary-col">
														<div class="summary mt-4">
															<h4 class="title">Total Visitors</h4>
															<div class="info">
																<strong class="amount"><?php echo $total_ip; ?></strong>
															</div>
														</div>
													</div>
												</div>
											</div>
										</section>
									</div>
								</a>

								<a href="#present_visitors">
									<div class="col-lg-12">
										<section class="card mb-4">
											<div class="card-body bg-success">
												<div class="widget-summary">
													<div class="widget-summary-col widget-summary-col-icon">
														<div class="summary-icon">
															<i class="fa fa-user-clock mt-3"></i>
														</div>
													</div>
													<div class="widget-summary-col">
														<div class="summary mt-4">
															<h4 class="title">Present Day Visitors</h4>
															<div class="info">
																<strong class="amount"><?php echo $present_ip; ?></strong>
															</div>
														</div>
													</div>
												</div>
											</div>
										</section>
									</div>
								</a>

								<a href="ip.php">
									<div class="col-lg-12">
										<section class="card mb-4">
											<div class="card-body bg-dark">
												<div class="widget-summary">
													<div class="widget-summary-col widget-summary-col-icon">
														<div class="summary-icon">
															<i class="fa fa-user mt-3"></i>
														</div>
													</div>
													<div class="widget-summary-col">
														<div class="summary mt-4">
															<h4 class="title">Unique IPs</h4>
															<div class="info">
																<strong class="amount"><?php echo $unique_ip; ?></strong>
															</div>
														</div>
													</div>
												</div>
											</div>
										</section>
									</div>
								</a>

							</div>

							<div class="col-lg-8">
								<div class="col-lg-12">
									<section class="card">
										<header class="card-header">
											<div class="card-actions">
												<a href="#" class="card-action card-action-toggle" data-card-toggle></a>
												<a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>
											</div>
											<h4 class="font-weight-bold text-dark text-uppercase">Visitors count per region</h4>
											<h5>Number of visitors coming from different regions of the world.</h5>
										</header>
										<div class="card-body">
											<!-- Flot: Bars -->
											<div class="chart chart-md" id="flotBars"></div>
											<script type="text/javascript">
												var flotBarsData = [<?php echo $jsCountryData; ?>];
											</script>
										</div>
									</section>
								</div>
							</div>

						</div>

						<div class="row">
							<div class="col-lg-6">
									<section class="card">
									<header class="card-header">
											<div class="card-actions">
												<a href="#" class="card-action card-action-toggle" data-card-toggle></a>
												<a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>
											</div>
											<h4 class="font-weight-bold text-dark text-uppercase">Web Page Rankings</h4>
											<h5>Ranking done based on the respective page hits.</h5>
										</header>
										<div class="card-body">
											<?php
												echo "<table class='table table-responsive-md table-bordered mb-0'>
												<thead>
													<tr>
														<th>Page Name</th>
														<th>Page Rank</th>
													</tr>
												</thead>
												<tbody>";
												
												$rank = 1;
												foreach ($page_hits as $page_name => $hits_count) {
													echo "<tr>
															<td>$page_name</td>
															<td>$rank</td>
														</tr>";
													$rank++;
												}
												
												echo "</tbody></table>";
											?>
										</div>
									</section>
							</div>

							<div class="col-lg-6">
									<section class="card">
										<header class="card-header">
											<div class="card-actions">
												<a href="#" class="card-action card-action-toggle" data-card-toggle></a>
												<a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>
											</div>
											<h4 class="font-weight-bold text-dark text-uppercase">Individual Page Hits</h4>
											<h5>Number of times a page is visited.</h5>
										</header>
										<div class="card-body">
							
											<div class="chart chart-md" id="morrisDonut"></div>
											<script type="text/javascript">
							
												var morrisDonutData = <?php echo $js_morrisDonutData ?>
												
												var colors =['#3498DB','#ECF0F1','#34495E','#F1C40F','#F97300','#10828C','#F64E8B','#FFBF86','#E21818','#E21818']
												
												for (var i = 0; i < morrisDonutData.length; i++) {
													morrisDonutData[i].color = colors[i % colors.length];
												}
			
												Morris.Donut({
													element: 'morrisDonut',
													data : morrisDonutData,
													resize: true,
												});
											</script>
							
										</div>
									</section>
								</div>
							</div>
						</div>
					<!-- end: page -->
				</section>

				<section role="main" class="content-body">
					
					<div class="row">
						<section class="card col-lg-12" id="present_visitors">
										<header class="card-header">
											<div class="card-actions">
												<a href="#" class="card-action card-action-toggle" data-card-toggle></a>
												<a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>
											</div>
											<h4 class="font-weight-bold text-dark text-uppercase">Present Day Visitors</h4>
										</header>
                            <div class="card-body">
                                <table class="table table-bordered table-striped mb-0" id="datatable-tabletools">
                                    <thead>
                                        <tr>
                                            <th>Visited On</th>
                                            <th>IP Address</th>
											<th>City</th>
                                            <th>Region</th>
                                            <th>Country</th>
                                            <th>Continent</th>
											<th>Pages Visited</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($user = mysqli_fetch_assoc($present_result)) : ?>
                                            <tr>
                                                <td data-title="date">
                                                    <?php
                                                    $registration_date = $user['time'];
                                                    $date = date("d", strtotime($registration_date));  // Day as a number
                                                    $month = date("F", strtotime($registration_date));
                                                    $year = date("Y", strtotime($registration_date)); // Month as a full string
                                                    $month . " " . $date . " , " . $year;
													echo $user['main_time'];
                                                    ?>
                                                </td>
                                                <td><?php echo $user['visitor_ip']; ?></td>
                                                <td><?php echo $user['city']; ?></td>
												<td><?php echo $user['region']; ?></td>
                                                <td><?php echo $user['country']; ?></td>
                                                <td><?php echo $user['continent']; ?></td>
												<td>
													<?php
														$columns = array_keys($user);
														$pages_visited = [];
														foreach($columns as $column){
															if(substr($column , -4) === '.php' && $user[$column] == 1){
																$page_name = str_replace(".php" , " Page" , $column);
																$page_name = ucfirst($page_name);
																$pages_visited[] = $page_name;
															}
														}
														echo implode(", ", $pages_visited);
													?>
												</td>
                                            </tr>
                                        <?php
                                        endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        </section>
					</div>

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
		<script src="vendor/jquery-ui/jquery-ui.js"></script>
		<script src="vendor/jqueryui-touch-punch/jquery.ui.touch-punch.js"></script>
		<script src="vendor/jquery-appear/jquery.appear.js"></script>
		<script src="vendor/bootstrap-multiselect/js/bootstrap-multiselect.js"></script>
		<script src="vendor/jquery.easy-pie-chart/jquery.easypiechart.js"></script>
		<script src="vendor/flot/jquery.flot.js"></script>
		<script src="vendor/flot.tooltip/jquery.flot.tooltip.js"></script>
		<script src="vendor/flot/jquery.flot.pie.js"></script>
		<script src="vendor/flot/jquery.flot.categories.js"></script>
		<script src="vendor/flot/jquery.flot.resize.js"></script>
		<script src="vendor/jquery-sparkline/jquery.sparkline.js"></script>
		<script src="vendor/raphael/raphael.js"></script>
		<script src="vendor/morris/morris.js"></script>
		<script src="vendor/gauge/gauge.js"></script>
		<script src="vendor/snap.svg/snap.svg.js"></script>
		<script src="vendor/liquid-meter/liquid.meter.js"></script>
		<script src="vendor/jqvmap/jquery.vmap.js"></script>
		<script src="vendor/jqvmap/data/jquery.vmap.sampledata.js"></script>
		<script src="vendor/jqvmap/maps/jquery.vmap.world.js"></script>
		<script src="vendor/jqvmap/maps/continents/jquery.vmap.africa.js"></script>
		<script src="vendor/jqvmap/maps/continents/jquery.vmap.asia.js"></script>
		<script src="vendor/jqvmap/maps/continents/jquery.vmap.australia.js"></script>
		<script src="vendor/jqvmap/maps/continents/jquery.vmap.europe.js"></script>
		<script src="vendor/jqvmap/maps/continents/jquery.vmap.north-america.js"></script>
		<script src="vendor/jqvmap/maps/continents/jquery.vmap.south-america.js"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="js/theme.js"></script>
		
		<!-- Theme Custom -->
		<script src="js/custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="js/theme.init.js"></script>

		<!-- Examples -->
		<script src="js/examples/examples.dashboard.js"></script>

		<script src="vendor/datatables/extras/TableTools/JSZip-2.5.0/jszip.min.js"></script>
    	<script src="vendor/datatables/extras/TableTools/pdfmake-0.1.32/pdfmake.min.js"></script>
    	<script src="vendor/datatables/extras/TableTools/pdfmake-0.1.32/vfs_fonts.js"></script>
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