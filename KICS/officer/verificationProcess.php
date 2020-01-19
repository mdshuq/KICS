<?php
  session_start();
  include '../dbConfig.php';

  if (isset($_POST["verify"])){
  	$r_id = $_POST['r_id'];
  	$action = $_POST['radios'];
  	$v_note = $_POST['verification_note'];
    $staffID = $_SESSION['id'];

    $sql2 = "UPDATE requisition_detail SET req_quantity_out2 = req_quantity_out WHERE r_id = '$r_id'";
    $result2 = mysqli_query($connection, $sql2);

  	$sql = "UPDATE requisition SET r_status = '$action', r_notification = 'unread', v_note = '$v_note', off_id = '$staffID' WHERE r_id = '$r_id'";	
    $result = mysqli_query($connection,$sql);


    if($result){
        print "<script language=\"javascript\"type=\"text/javascript\">
                            <!--
                                window.setTimeout('window.location=\"applicationList.php\";',0);
                            //-->
                        </script>";

                        echo "<script>alert('Proses pengesahan permohonan berjaya ! ');
                              </script>";
        // header("Location: verificationProcess-Success.php");
        
    }
    else{
         echo("Error description: " . mysqli_error($result2));
    }
  }
  ?>