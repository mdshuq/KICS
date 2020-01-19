<?php
  session_start();
  include '../dbConfig.php';

  $selectsql  = "SELECT * from staff where staffID!='1' ";
  $result   = mysqli_query($connection, $selectsql);

  if (isset($_POST["add_worker"])){

    $w_name = $_POST["w_name"];
    $w_ic = $_POST["w_ic"];
    $w_phone = $_POST["w_phone"];
    $w_position = $_POST["w_position"];
    $w_status = '1';
    $w_email = $_POST["w_email"];
    $w_username = $_POST["w_username"];
    $w_password = md5($_POST["w_password"]);

    if($w_position == "Pegawai"){
        $w_role = "Pegawai";
    }

    else if($w_position == "Kerani"){
        $w_role = "Kerani";
    }

    else if($w_position == "Ketua Chef"){
        $w_role = "Pemohon";
    }

    else{
        $w_role = "Pemohon";
    }

    if ($w_role == "Pegawai"){
        //check pegawai
        $sql3  = "SELECT * FROM staff WHERE staff_role='Pegawai'";
        $result3   = mysqli_query($connection, $sql3);
        $row3    = mysqli_num_rows($result3); 

        if($row3 >= '1'){

                echo "<script>alert('Pendaftaran Tidak Berjaya!\\nHanya (1) Satu Kerani / Pegawai sahaja boleh didaftarkan.');
                      </script>";
                      header("Refresh:0;");
                      exit();
        }
    }

    if ($w_role == "Kerani"){
        //check kerani
        $sql4  = "SELECT * FROM staff WHERE staff_role='Kerani'";
        $result4   = mysqli_query($connection, $sql4);
        $row4    = mysqli_num_rows($result4); 

        if($row4 >= '1'){

                echo "<script>alert('Pendaftaran Tidak Berjaya! Hanya (1) Satu Kerani / Pegawai sahaja boleh didaftarkan');
                      </script>";
                      header("Refresh:0;");
                      exit();
        }
    }

    $sql = "INSERT INTO staff (staffID, staff_username, staff_password, staff_fname, staff_ic, staff_email, staff_contact, staff_role, staff_position, staff_status) VALUES ('','$w_username','$w_password','$w_name','$w_ic','$w_email','$w_phone','$w_role','$w_position','$w_status')";

            $result2 = mysqli_query($connection,$sql);
            if($result2){
                print "<script language=\"javascript\"type=\"text/javascript\">
                            <!--
                                window.setTimeout('window.location=\"workerList.php\";',0);
                            //-->
                        </script>";

                        echo "<script>alert('Pendaftaran Pekerja Berjaya!');
                              </script>";
            }
            else{
                 echo("Error description: " . mysqli_error($result2));
            }
  }
?>

<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>KICS | Admin</title>
    <meta name="description" content="Kitchen Inventory Control System">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <!-- <link rel="shortcut icon" href="favicon.ico"> 
           This one is the title icon -->

    <link rel="stylesheet" href="../css-sufee/assets/css/normalize.css">
    <link rel="stylesheet" href="../css-sufee/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css-sufee/assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css-sufee/assets/css/themify-icons.css">
    <link rel="stylesheet" href="../css-sufee/assets/css/flag-icon.min.css">
    <link rel="stylesheet" href="../css-sufee/assets/css/cs-skin-elastic.css">
    <!-- <link rel="stylesheet" href="assets/css/bootstrap-select.less"> -->
    <link rel="stylesheet" href="../css-sufee/assets/scss/style.css">
    <link href="../css-sufee/assets/css/lib/vector-map/jqvmap.min.css" rel="stylesheet">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
 

    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>  -->  


   
</head>
<body>


        <!-- Left Panel -->

    <aside id="left-panel" class="left-panel" >
        <nav class="navbar navbar-expand-sm navbar-default" >

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="admin.php"><img src="../css-sufee/images/logo admin1.png" alt="Logo"></a>
                <a class="navbar-brand hidden" href="admin.php"><img src="../css-sufee/images/logo admin2.png" alt="Logo"></a>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="../admin/admin.php"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                    </li>

                    <h3 class="menu-title">Organisasi</h3><!-- /.menu-title -->
                    <li class="menu-item-has-children dropdown" >
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-users"></i>Pekerja</a>
                        <ul class="sub-menu children dropdown-menu" >
                            <li><i class="menu-icon fa fa-list"></i><a href="../admin/workerList.php">Senarai Pekerja </a></li>                           
                        </ul>
                    </li>

                    <!-- tetapan -->
                    <h3 class="menu-title">Tetapan</h3><!-- /.menu-title -->
                    <li>
                        <a href="../admin/viewProfil.php"> <i class="menu-icon ti-user"></i>Profil </a>
                    </li>

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon ti ti-settings"></i>Pengurusan</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-edit"></i><a href="changePassword.php">Tukar Kata Laluan </a></li>
                            <li><i class="menu-icon fa fa-edit"></i><a href="changeEmail.php">Tukar Emel</a></li>
                            <li><i class="menu-icon fa fa-edit"></i><a href="changePhone.php">Tukar No Telefon</a></li>
                        </ul>
                    </li>


                    <h3 class="menu-title">Hubungi</h3><!-- /.menu-title -->
                    <li>
                        <a><i class="menu-icon fa fa-phone"></i>+609-621 6000</a>
                    </li>

                    <li>
                        <a href="" data-toggle="modal" data-target="#logoutModal"><i class="menu-icon fa fa-sign-out"></i>Log Keluar </a>
                    </li>       
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->

    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <header id="header" class="header">

            <div class="header-menu">

                <div class="col-sm-7">
                    <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
                    <div class="header-left">
                        
                        
                    </div>
                </div>

                <div class="col-sm-5">
                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="../css-sufee/images/admin 2.jpg" alt="User Avatar">
                        </a>

                        <div class="user-menu dropdown-menu">

                                <a class="nav-link" href="changePassword.php"><i class="fa fa -cog"></i>Tukar Kata Laluan </a>

                                <a class="nav-link" href="changeEmail.php"><i class="fa fa -cog"></i>Tukar E-mel </a>

                                <a class="nav-link" href="changePhone.php"><i class="fa fa -cog"></i>Tukar No Telefon </a>

                                <a class="nav-link" href="" data-toggle="modal" data-target="#logoutModal"><i class="fa fa-power -off"></i>Log Keluar</a>
                        </div>
                    </div>

                  
                    <!-- This one letak nama user -->
                    <a class="navbar-brand pull-right"><?php echo $_SESSION['staff_fname']?></a>

                    

                </div>
            </div>

        </header><!-- /header --> 
        <!-- Header-->

        <div class="breadcrumbs">
            <div class="col-sm-6">
                <div class="page-header float-left">
                    <div class="page-title text-secondary">  
                        <h1 style='font-size:12pt;'>Laman Utama&nbsp; / &nbsp;Senarai Pekerja&nbsp; / &nbsp;Tambah Pekerja </h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-2"><!-- margin from content and breadcrumbs (spacing)  -->

            <div class="card border-light" style="padding:0;">
                <div class="card-body">
                       <div class="col-sm-12 ">
                            <h4 style="text-transform: uppercase;">Tambah Pekerja</h4><br>

                            <div style='border-bottom:2px solid; border-bottom-color:#08082d;'></div><br> <!-- border -->                              

                                <form action="workerAdd.php" onSubmit="return confirm('Adakah maklumat pekerja yang diisi adalah benar ?');" method="post" enctype="multipart/form-data" class="form-horizontal">
                                  <div class="row form-group">
                                    <div class="col-sm-2 col-xs-6"><label for="text-input" class=" form-control-label pull-right">Nama</label></div>
                                    <div class="col-sm-8 col-xs-6"><input type="text" id="text-input" name="w_name" placeholder="" class="form-control" required></div>
                                  </div>

                                  <div class="row form-group">
                                    <div class="col-sm-2 col-xs-6"><label for="text-input" class=" form-control-label pull-right">MyKad</label></div>
                                    <div class="col-sm-5 col-xs-6"><input type="text" id="text-input" name="w_ic" placeholder="eg. 790811087654" class="form-control" required></div>
                                  </div>

                                  <div class="row form-group">
                                    <div class="col-sm-2 col-xs-6"><label for="text-input" class=" form-control-label pull-right">No Telefon</label></div>
                                    <div class="col-sm-5 col-xs-6"><input type="text" id="text-input" name="w_phone" placeholder="eg. 60182392919" class="form-control" required></div>
                                  </div>

                                  <div class="row form-group">
                                    <div class="col-sm-2 col-xs-6"><label for="select" class="form-control-label pull-right">Jawatan</label></div>
                                    <div class="col-sm-3 col-xs-6">
                                      <select name="w_position" id="select" class="form-control" required>
                                        <option value="">Sila Pilih</option>
                                        <option value="Kerani">Kerani</option>
                                        <option value="Pegawai">Pegawai</option>
                                        <option value="Ketua Chef">Ketua Chef</option>
                                        <option value="Pelayan">Pelayan</option>
                                      </select>
                                    </div>
                                  </div>

                                  <div class="row form-group">
                                    <div class="col-sm-2 col-xs-6"><label for="text-input" class=" form-control-label pull-right">Emel</label></div>
                                        <div class="col-sm-5 col-xs-6">
                                            <div class="input-group">
                                              <div class="input-group-addon"><i class="fa fa-envelope"></i></div>
                                              <input type="email" id="email" name="w_email" placeholder="eg. admin@admin.com" class="form-control" required>
                                            </div>
                                        </div>
                                  </div>

                                  <div class="row form-group">
                                    <div class="col-sm-2 col-xs-6"><label for="text-input" class=" form-control-label pull-right">ID Pengguna</label></div>
                                        <div class="col-sm-5 col-xs-6">
                                            <div class="input-group">
                                              <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                              <input type="text" id="username" name="w_username" placeholder="" class="form-control" required>
                                            </div>
                                        </div>
                                  </div>

                                  <div class="row form-group">
                                    <div class="col-sm-2 col-xs-6"><label for="text-input" class=" form-control-label pull-right">Kata Laluan</label></div>
                                        <div class="col-sm-5 col-xs-6">
                                            <div class="input-group">
                                              <div class="input-group-addon"><i class="fa fa-asterisk"></i></div>
                                              <input type="password" id="password" name="w_password" placeholder="" class="form-control" required>
                                            </div>
                                        </div>
                                  </div>

                                  <input type="submit" value="DAFTAR PEKERJA" class="btn btn-primary pull-right" name="add_worker"> 
                                  <a href="workerList.php" class="btn btn-outline-primary pull-right" style="margin-right: 5px;">KEMBALI</a>  
                                   

                                </form>

                                <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-sm" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary">
                                            <h5 class="modal-title text-light" id="smallmodalLabel"><i class="menu-icon fa fa-sign-out">&nbsp;</i>LOG KELUAR</h5>
                                            <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Adakah anda pasti ?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-secondary text-dark" data-dismiss="modal">Kembali</button>
                                            <a href="../staff/logout.php" class="btn btn-primary">Log Keluar</a>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- Modal -->
                        </div> <!--  col-sm-12 -->

                </div> <!--  card body -->
            </div> <!-- card border -->

            

        </div> <!-- .content -->
    </div><!-- /#right-panel -->

    <!-- Right Panel -->

    <script src="../css-sufee/assets/js/vendor/jquery-2.1.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
    <script src="../css-sufee/assets/js/plugins.js"></script>
    <script src="../css-sufee/assets/js/main.js"></script>


    <script src="../css-sufee/assets/js/lib/chart-js/Chart.bundle.js"></script>
    <script src="../css-sufee/assets/js/dashboard.js"></script>
    <script src="../css-sufee/assets/js/widgets.js"></script>
    <script src="../css-sufee/assets/js/lib/vector-map/jquery.vmap.js"></script>
    <script src="../css-sufee/assets/js/lib/vector-map/jquery.vmap.min.js"></script>
    <script src="../css-sufee/assets/js/lib/vector-map/jquery.vmap.sampledata.js"></script>
    <script src="../css-sufee/assets/js/lib/vector-map/country/jquery.vmap.world.js"></script>


</body>
</html>
