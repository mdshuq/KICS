<?php 
//database connection $connection
	session_start();
 	include '../dbConfig.php';

 	$staffID = $_GET["staffID"];

 	$sql = "DELETE * FROM staff WHERE staffID = '$staffID'";
 	$result = mysqli_query($connection,$sql);

 	if($result){
 		header("Location:workerList.php");
 	}

 	else{
 		echo("Error description: " . mysqli_error($result));
 	}
?>