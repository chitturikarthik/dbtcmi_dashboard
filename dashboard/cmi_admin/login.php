<?php
session_start();

include("../../conn.php");




if(isset($_POST['submit'])){
	$username = $_POST['user'];
	$password = $_POST['pass'];

	$sql = " select * from  admintable where user='$username' and pass='$password' ";
	$query = mysqli_query($conn,$sql);

	$row = mysqli_num_rows($query);
		if($row == 1){
			echo "login successful";
			$_SESSION['user'] = $username;
			header('location:adminmainpage.php');
		}else{
			echo "login failed";
			header('location:adminlogin.php');
		}

}


?>