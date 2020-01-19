<?php
session_start();
require "../dbConfig.php";
?>
<html>
<title>Staff Login Page</title>
<body>
<?php
		
	//STEP 3 : SQL Statement
	$username 	= $_POST['username'];
	$password 	= $_POST['password'];
	$encrypt    = md5($password);
	
	$selectsql	= "SELECT * from staff where staff_username='$username' && staff_password='$encrypt';      ";
	$result 	= mysqli_query($connection, $selectsql);
	$numRows	= mysqli_num_rows($result);		//to know the number of rows
	$row		= mysqli_fetch_array($result); 	//to pass the recordset in array, so that $row will read as array $row[]
	$id		= $row['staffID'];
	
	if($numRows > 0)
	{
		/*print "Welcome Back $row[name]<br/>";//NAME is taken from the db attribute name
		print "What to do Next?<br> <a href=logout.php?id=$id>Log Out </a>|<a href=update.php?id=$id>Update Profile</a> | <a href=delete.php?id=$id>Delete Account</a>";*/
		
		//set Session
		$_SESSION['id'] = $id; 
		print "<br /> Your Session ID is ".$_SESSION['id'];
		header('Location: sakai.php'); 
	}
	else
	{

			//print "Opps! Login Unsuccessful. Please Relogin or Register a new account <a href=registerCustomer.php>HERE</a>";
		$_SESSION['errMsg'] = "Invalid username or password";
		header('Location: ../index/index.php');
	}
	
?>
</body>
</html> 

