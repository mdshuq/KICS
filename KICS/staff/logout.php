<?php

	//Logout session original
	session_start();
	session_destroy();

	//echo "<script> alert('Succesfully logout'); </script>";
	header("Location: ../index/index.php");
	exit;	
?>

