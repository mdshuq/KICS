<?php
	session_start();
 	include '../dbConfig.php';

    $staffID = $_SESSION['id'];

    if(isset($_POST["add_item"])){
	    $r_store_id = $_POST["r_store_id"];
	    $r_date = $_POST["r_date"];
	    $r_note = $_POST["r_note"];
	    $r_noti = 'unread';

	    //find store name base on user click
	    $selectsql  = "SELECT store_name FROM store WHERE store_id = '$r_store_id'";
	    $result   = mysqli_query($connection, $selectsql);
	    $store = mysqli_fetch_array($result);

	    //check pakai ke tak
	    $_SESSION['r_store_id'] = $r_store_id;
	    $_SESSION['r_date'] = $r_date;
	    $_SESSION['r_note'] = $r_note;

	    // insert requisition to database
	    $date = date("Y-m-d");
	    $status = 'In Process';
	    $r_type = 'OUT';
	    $sql2 = "INSERT INTO requisition(r_date_use,r_purpose,r_date,r_status,r_type,r_notification,app_id,s_id) VALUES ('$r_date','$r_note','$date','$status','$r_type','$r_noti','{$_SESSION['id']}','$r_store_id')";

	    if (mysqli_query($connection, $sql2)) {
	            $last_id = mysqli_insert_id($connection);
	            $_SESSION['last_req_id'] = $last_id;
	            header("Location: requisitionItem.php");
	        }

	    else{
	            echo("Error description: " . mysqli_error($sql2));
	        }

	}
?>