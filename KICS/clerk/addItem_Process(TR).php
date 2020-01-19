<?php
	session_start();
  	include '../dbConfig.php';

  	if(isset($_POST["add_item"])){
  		$item_name = $_POST["item_name"];
      $item_unit = $_POST["item_unit"];
      $item_demandYear = $_POST["item_demandYear"];
      $item_currentQty = $_POST["item_currentQty"];    
	    $storeID = '1';

      $item_demandDay = round(($item_demandYear / 365),2);
      $item_ROP = round($item_demandDay * 4);

	    $sql = "INSERT INTO item (item_name, item_unit, item_demand_perYear, item_ROP, item_current_quantity, s_id) VALUES ('$item_name','$item_unit','$item_demandYear','$item_ROP','$item_currentQty','$storeID')";
   		$result    = mysqli_query($connection, $sql);

   		if($result){
          print "<script language=\"javascript\"type=\"text/javascript\">
                            <!--
                                window.setTimeout('window.location=\"itemList(TR).php\";',0);
                            //-->
                        </script>";

                        echo "<script>alert('Proses Tambah Item Berjaya !');
                              </script>";
        
   		}
    	else{
   	        echo("Error description: " . mysqli_error($result));
        }
  	}
?>

