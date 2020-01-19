<?php
  session_start();
  include '../dbConfig.php';

   $staffID = $_SESSION['id'];

   if (isset($_POST["submit"])) {

        $lastID = $_SESSION['last_req_id'];
        $tcost = $_POST['tcost'];
        $sql2 = "UPDATE item 
                INNER JOIN requisition_detail 
                ON item.item_id = requisition_detail.itemID
                SET item.item_current_quantity = (item.item_current_quantity + requisition_detail.req_quantity) 
                WHERE requisition_detail.r_id = '$lastID'";
        $result2 = mysqli_query($connection,$sql2);

        if($result2){
            $status = 'Complete';
            $sql = "UPDATE requisition SET r_status = '$status', total_cost = '$tcost' WHERE r_id = '".$_SESSION['last_req_id']."' ";
            $result = mysqli_query($connection, $sql);
        } 

        if($result){
            print "<script language=\"javascript\"type=\"text/javascript\">
                            <!--
                                window.setTimeout('window.location=\"stockIn_List.php\";',0);
                            //-->
                        </script>";

                        echo "<script>alert('Proses Rekod Belian Berjaya !');
                              </script>";
        // header("Location:applicationList.php");
        }
    
        else{
            echo("Error description: " . mysqli_error($result));
        }  
    }
    
?>
