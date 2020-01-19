<?php
//STEP 1: Open DB Connection by using mysql_connect
	$host			="localhost";
	$dbusername		="root";
	$dbpassword		= "";
	$dbname 		= "kics";
	
	$connection	= mysqli_connect($host, $dbusername, $dbpassword, $dbname);
			
	
	
	if (!$connection)
	{
		die("Cannot make db connection: ".mysqli_connect_error());
	}
	else
	{
		 // echo "DB OK! <br/>";
	}
?>