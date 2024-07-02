<?php
session_start();
//echo session_id();
if(!isset($_SESSION['username'])){
	header('location:index.php');
}

//$_SESSION['username'] = 'dbtcmi';


?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<?php include_once '../../head_links.php'; ?> 
</head>
<body>

<div class="container center-div shadow">
		<div class="heading text-center text-uppercase text-black mb-5"> 
			<h1>Welcome to DBT-CMI admin </h1>
			<a href="submited_data.php" class="btn btn-danger">Fresh Submited Data</a>
			<a href="missing_submited_data.php" class="btn btn-danger">Missing Submited Data</a>
			<a href="logout.php" class="btn btn-danger">Logout</a>

		</div>
</div>



</body>
</html>