<?php
SESSION_START();
if(!isset($_SESSION['access']) || $_SESSION['access'] !== 'dbtcmi') {
    header("Location: index.php");
    exit; // Make sure to exit after redirecting
}

include 'connect.php';

// Query to select all page visits with the time column converted to DATE format
$selectQuery = "SELECT *, DATE(time) AS main_time FROM page_visits ORDER BY DATE(time)";
$page_result = mysqli_query($conn, $selectQuery);

// Check for errors
if (!$page_result) {
    die("Query failed: " . mysqli_error($conn));
}

// Query to dynamically select column names ending with '.php' from the page_visits table
$column_query = "SELECT COLUMN_NAME
                 FROM INFORMATION_SCHEMA.COLUMNS
                 WHERE TABLE_NAME = 'page_visits'
                 AND COLUMN_NAME LIKE '%.php'";

$column_result = mysqli_query($conn, $column_query);

// Check for errors
if (!$column_result) {
    die("Column query failed: " . mysqli_error($conn));
}

// Initialize the count query
$count_query = "SELECT visitor_ip, MONTH(time) AS month, ";

// Add the dynamic column names to the count query
while ($column_row = mysqli_fetch_assoc($column_result)) {
    $column_name = $column_row['COLUMN_NAME'];
    $count_query .= "SUM(`$column_name`) AS `$column_name`, ";
}

// Remove the trailing comma and space
// Remove the trailing comma and space
$count_query = rtrim($count_query, ", ");

// Add the rest of the count query
$count_query .= " FROM page_visits
                  GROUP BY MONTH(time)
                  ORDER BY MONTH(time)";

// Execute the count query
$count_result = mysqli_query($conn, $count_query);

// Check for errors
if (!$count_result) {
    die("Count query failed: " . mysqli_error($conn));
}

// Initialize an array to store data organized by month
$monthlyData = [];

// Loop through the query results
while ($c_row = mysqli_fetch_assoc($count_result)) {
    $month = date("F", mktime(0, 0, 0, $c_row['month'], 1)); // Get month name
    
    // Calculate the sum of columns with 1s and 0s
    $columnsWithOnes = 0;
    $columnsWithZeros = 0;
    foreach ($c_row as $column => $value) {
        if ($value == 1) {
            $columnsWithOnes++;
        } elseif ($value == 0) {
            $columnsWithZeros++;
        }
    }
    
    // Create the entry for the current month
    $entry = [
        'Month Name' => $month,
        'Columns with 1s' => $columnsWithOnes,
        'Columns with 0s' => $columnsWithZeros
    ];
    
    // Add the entry to the monthlyData array
    $monthlyData[] = $entry;
}

// Convert the monthlyData array to JSON
$js_morrisAreaData = json_encode($monthlyData);

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
                    <div class="col">
                        <section class="card">
                            <header class="card-header">
                                <div class="card-actions">
                                    <a href="#" class="card-action card-action-toggle" data-card-toggle></a>
                                    <!-- <a href="#" class="card-action card-action-dismiss" data-card-dismiss></a> -->
                                </div>

                                <h3 class="text-uppercase text-dark"><b>Page Details</b></h3>
                                <h4 class=''>Details about page visits respective to different IP Addresses.</h4>
                            </header>
                            <div class="card-body">
                                <table class="table table-bordered table-striped mb-0" id="datatable-tabletools">
                                    <thead>
                                        <tr>
                                            <th>Visited On</th>
                                            <th>IP Address</th>
                                            <?php

                                                $query = "SELECT COLUMN_NAME 
                                                        FROM INFORMATION_SCHEMA.COLUMNS 
                                                        WHERE TABLE_NAME = 'page_visits' 
                                                        AND COLUMN_NAME LIKE '%.php'";
                                                $th_result = mysqli_query($conn, $query);

                                                if ($th_result === false) {
                                                    echo "Error in SELECT query: " . mysqli_error($conn);
                                                    exit;
                                                }
                                                $table_headings = [];
                                                while ($row = mysqli_fetch_assoc($th_result)) {
                                                    $column_name = $row['COLUMN_NAME'];
                                                    $heading = ucfirst(str_replace(".php", "", $column_name));
                                                    $table_headings[] = $heading;
                                                }
                                                foreach ($table_headings as $heading) {
                                                    echo "<th>$heading</th>";
                                                }

                                            ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($user = mysqli_fetch_assoc($page_result)) : ?>
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

                                                <?php
                                                    foreach ($user as $column => $value) {
                                                        if (substr($column, -4) === ".php") {
                                                            $page_name = str_replace(".php", "", $column); // Remove .php extension
                                                            $page_name = ucfirst($page_name); // Capitalize the first letter
                                                            echo "<td>";
                                                            if ($value == 1) {
                                                                echo "<p class='text-success'><b>Visited</b></p>";
                                                            } else {
                                                                echo "<p class='text-gray'>Not Visited</p>";
                                                            }
                                                            echo "</td>";
                                                        }
                                                    }
                                                    ?>
                                                <!-- <td>
                                                    <a class="modal-with-form" href="#modalHeaderColorPrimary">
                                                        <button class="userinfo btn btn-primary">View</button>
                                                    </a>
                                                </td> -->
                                            </tr>
                                        <?php
                                        endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        </section>
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