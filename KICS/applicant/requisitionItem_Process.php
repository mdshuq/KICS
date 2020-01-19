<?php
    session_start();
    include '../dbConfig.php';

    if (isset($_POST["submit"])) {
        $status = 'Pending';
        $sql = "UPDATE requisition SET r_status = '$status' WHERE r_id = '".$_SESSION['last_req_id']."' ";
        $result = mysqli_query($connection, $sql);
    }

    if($result){
        print "<script language=\"javascript\"type=\"text/javascript\">
                            <!--
                                window.setTimeout('window.location=\"applicationList.php\";',0);
                            //-->
                        </script>";

                        echo "<script>alert('Permohonan Berjaya Dihantar!');
                              </script>";
        // header("Location:applicationList.php");
    }
    
    else{
        echo("Error description: " . mysqli_error($result));
    }
?>
