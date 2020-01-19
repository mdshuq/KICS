<?php
  session_start();
  include '../dbConfig.php';

   $staffID = $_SESSION['id'];

   if (isset($_POST["submit"])) {

        $r_id = $_POST['r_id'];
        $verification_note2 = $_POST['verification_note2'];
        $sql2 = "UPDATE item 
                INNER JOIN requisition_detail 
                ON item.item_id = requisition_detail.itemID
                SET item.item_current_quantity = (item.item_current_quantity - requisition_detail.req_quantity_out2) 
                WHERE requisition_detail.r_id = '$r_id'";
        $result2 = mysqli_query($connection,$sql2);

        if($result2){
            $status = 'Complete';
            $sql = "UPDATE requisition SET r_status = '$status', r_notification = 'unread', v_note2 = '$verification_note2' WHERE r_id = '$r_id' ";
            $result = mysqli_query($connection, $sql);
        }   
    }

    if($result){
         print "<script language=\"javascript\"type=\"text/javascript\">
                            <!--
                                window.setTimeout('window.location=\"stockOut_List.php\";',0);
                            //-->
                        </script>";

                        echo "<script>alert('Proses pengesahan pengeluaran barang berjaya ! ');
                              </script>";
        // header("Refresh:3; url=stockOut_List.php");
    }
    
    else{
        echo("Error description: " . mysqli_error($result));
    }
?>

