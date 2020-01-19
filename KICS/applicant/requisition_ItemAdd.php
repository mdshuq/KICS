<?php
	session_start();
  	include '../dbConfig.php';

  	if(isset($_POST["addItem"])){
  		$itemID = $_POST["itemID"];
	    $quantity = $_POST["quantity"];
	    $last_req_id = $_SESSION['last_req_id'];

	    // select item name that match with item id
	    $selectID = "SELECT item_name FROM item WHERE item_id = '$itemID' ";
	    $result2 = mysqli_query($connection, $selectID);
	    $row    = mysqli_fetch_array($result2);
	    $item = $row['item_name'];

	    $sql = "INSERT INTO requisition_detail (req_item, req_quantity, req_quantity_out, itemID, r_id) VALUES ('$item','$quantity','$quantity','$itemID','$last_req_id')";
   		$result    = mysqli_query($connection, $sql);

   		if($result){
    	    header("Location: requisitionItem.php");
        
   		}
    	else{
   	        echo("Error description: " . mysqli_error($result));
        }
  	}
?>