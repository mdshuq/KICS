<?php 
   session_start();
   require "../dbConfig.php";

   if(isset($_POST['submit']))
   {
          //STEP 3 : SQL Statement
      $username   = $_POST['username'];
      $password   = $_POST['password'];
      $encrypt    = md5($password);
      
      $selectsql  = "SELECT * from staff where staff_username='$username' && staff_password='$encrypt';      ";
      $result   = mysqli_query($connection, $selectsql);
      $numRows  = mysqli_num_rows($result);   //to know the number of rows
      $row    = mysqli_fetch_array($result);  //to pass the recordset in array, so that $row will read as array $row[]
      $id   = $row['staffID'];
      $_SESSION['staff_fname'] = $row['staff_fname'];

      if($numRows > 0)
      {
        /*print "Welcome Back $row[name]<br/>";//NAME is taken from the db attribute name
        print "What to do Next?<br> <a href=logout.php?id=$id>Log Out </a>|<a href=update.php?id=$id>Update Profile</a> | <a href=delete.php?id=$id>Delete Account</a>";*/
        
        //set Session
        $_SESSION['id'] = $id; 
        if($row['staff_status'] =="0"){
          $_SESSION['errMsg'] = "ID Pengguna Tidak Aktif";
          header('Location: ../staff/login.php'); 
        }

        else if($row['staff_role'] =="Admin"){
          header('Location: ../admin/admin.php');  
        }

        else if($row['staff_role'] =="Pegawai"){
          header('Location: ../officer/officer.php'); 
        }

        else if($row['staff_role'] =="Pemohon"){
          header('Location: ../applicant/applicant.php'); 
        }

        else if($row['staff_role'] =="Kerani"){
          header('Location: ../clerk/clerk.php'); 
        }

        else{
          echo("Error description: " . mysqli_error($result));
        }
        // print "<br /> Your Session ID is ".$_SESSION['id'];
        
      }
      else
      {

        //print "Opps! Login Unsuccessful. Please Relogin or Register a new account <a href=registerCustomer.php>HERE</a>";
        $_SESSION['errMsg'] = "Salah ID Pengguna / Kata Laluan";
        header('Location: ../staff/login.php');
      }
  
   } 
?>