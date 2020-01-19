<?php
  session_start();
  include '../dbConfig.php';

   $staffID = $_SESSION['id'];

   $sql = "SELECT *
            FROM requisition
            WHERE requisition.app_id =  '{$_SESSION['id']}' && requisition.r_status ='Lulus'";    
   $result = mysqli_query($connection,$sql);
   $row = mysqli_num_rows($result);

   $sql2 = "SELECT *
            FROM requisition
            WHERE requisition.app_id =  '{$_SESSION['id']}' && requisition.r_status ='Gagal'";    
   $result2 = mysqli_query($connection,$sql2);
   $row2 = mysqli_num_rows($result2);

   $sql3 = "SELECT *
            FROM requisition
            WHERE requisition.app_id =  '{$_SESSION['id']}' && requisition.r_status ='Complete'";    
   $result3 = mysqli_query($connection,$sql3);
   $row3 = mysqli_num_rows($result3);

   $sql4 = "SELECT staff.staff_fname FROM staff WHERE staff_role = 'Pegawai'";
   $result4 = mysqli_query($connection,$sql4);
   $pegawai = mysqli_fetch_assoc($result4);

   $sql5 = "SELECT staff.staff_fname FROM staff WHERE staff_role = 'Kerani'";
   $result5 = mysqli_query($connection,$sql5);
   $kerani = mysqli_fetch_assoc($result5);


?>

<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>KICS | Applicant</title>
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

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->

</head>
<body>


        <!-- Left Panel -->
        <!-- style="background-color: #08082d;" theme color -->

    <aside id="left-panel" class="left-panel" >
        <nav class="navbar navbar-expand-sm navbar-default" >

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="applicant.php"><img src="../css-sufee/images/logo applicant.png" alt="Logo"></a>
                <a class="navbar-brand hidden" href="applicant.php"><img src="../css-sufee/images/logo admin2.png" alt="Logo"></a>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="../applicant/applicant.php"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                    </li>

                    <h3 class="menu-title">Pesanan</h3><!-- /.menu-title -->
                    <li>
                        <a href="../applicant/applicationList.php"> <i class="menu-icon fa fa-list-ul"></i>Senarai Permohonan </a>
                    </li>
                    <li>
                        <a href="requisitionAdd.php"> <i class="menu-icon fa fa-plus"></i>Permohonan Baru</a>
                    </li>

                    <!-- tetapan -->
                    <h3 class="menu-title">Tetapan</h3><!-- /.menu-title -->
                    <li>
                        <a href="../applicant/viewProfil.php"> <i class="menu-icon ti-user"></i>Profil </a>
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
                        <?php 
                            $sql8 = "SELECT requisition.r_id, requisition.r_notification, requisition.r_status FROM requisition WHERE requisition.r_notification = 'unread' AND requisition.r_status = 'Complete' ";
                            $result8 = mysqli_query($connection, $sql8);
                            $row8 = mysqli_num_rows($result8);
                        ?>

                        <div class="dropdown for-notification">
                          <button class="btn btn-secondary dropdown-toggle" type="button" id="notification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-bell"></i>
                            <span class="count bg-danger"><?php echo $row8; ?></span>
                          </button>
                          <?php if(mysqli_num_rows($result8)>0){ ?> 
                              <div class="dropdown-menu" aria-labelledby="notification">
                                <p class="red">Terdapat  <?php echo $row8; ?>  Notifikasi</p>
                                <?php 
                                    while ($noti = mysqli_fetch_assoc($result8)) {
                                ?>
                                <a class="dropdown-item media bg-flat-color-3" href="applicationListDetail.php?r_id=<?php echo $noti['r_id']; ?>">
                                    <i class="fa fa-check"></i>
                                    <p>Permohonan Selesai - #<?php echo $noti['r_id'];?></p>
                                </a>
                                <?php } ?>
                              </div>
                          <?php } ?>
                        </div>
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
                    <a class="navbar-brand pull-right"><?php echo $_SESSION['staff_fname'];?></a>

                    

                </div>
            </div>

        </header><!-- /header -->
        <!-- Header-->

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title text-secondary">
                        <h1>Dashboard</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-2">

            <div class="card border-light" style="padding:0;">
                <div class="card-body">
                    <div class="sufee-alert alert with-close alert-warning alert-dismissible fade show">
                            <span class="badge badge-pill badge-warning">Peringatan</span>
                                &nbsp;&nbsp;Pastikan butir - butir maklumat permohonan adalah tepat dan benar !
                                 <button type="button" class="close" data-dismiss="alert" aria-label= "Close">
                                     <span aria-hidden="true">&times;</span>
                                </button>
                    </div>

                    <br>

                    <div class="row">
                        <div class="col-md-6 col-lg-4">
                            <div class="card text-white bg-flat-color-5">
                                <a href="applicationList.php?app_status=Lulus" name="success">
                                    <div class="card-body">
                                        <div class="h1 text-muted text-right mb-4">
                                                <i class="fa fa-check-square-o text-light"></i>
                                            </div>

                                            <div class="h4 mb-0 text-light">PERMOHONAN LULUS</div>
                                            <h4 class="font-weight-bold text-light">Jumlah : <span class="count"><?php echo $row; ?></span></h4>
                                            <div class="progress progress-xs mt-3 mb-0 bg-light" style="width: 40%; height: 5px;"></div>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-4">
                            <div class="card text-white bg-flat-color-4">
                                <a href="applicationList.php?app_status=Gagal" name="fail">
                                    <div class="card-body">
                                        <div class="h1 text-muted text-right mb-4">
                                                <i class="fa fa-times text-light"></i>
                                            </div>

                                            <div class="h4 mb-0 text-light">PERMOHONAN GAGAL</div>
                                            <h4 class="font-weight-bold text-light">Jumlah : <span class="count"><?php echo $row2; ?></span></h4>
                                            <div class="progress progress-xs mt-3 mb-0 bg-light" style="width: 40%; height: 5px;"></div>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-4">
                            <div class="card text-white bg-flat-color-1">
                                <a href="applicationList.php?app_status=Complete" name="complete">
                                    <div class="card-body">
                                        <div class="h1 text-muted text-right mb-4">
                                                <i class="fa fa-folder-o text-light"></i>
                                            </div>

                                            <div class="h4 mb-0 text-light">PERMOHONAN SELESAI</div>
                                            <h4 class="font-weight-bold text-light">Jumlah : <span class="count"><?php echo $row3; ?></span></h4>
                                            <div class="progress progress-xs mt-3 mb-0 bg-light" style="width: 40%; height: 5px;"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="stat-widget-one">
                                        <div class="stat-icon dib"><i class="ti ti-user text-success border-success"></i></div>
                                        <div class="stat-content dib">
                                            <div class="stat-text text-success">PEGAWAI <i class="menu-icon fa fa-check"></i></div>
                                            <div class="stat-digit"><?php echo $pegawai['staff_fname']; ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="stat-widget-one">
                                        <div class="stat-icon dib"><i class="ti ti-user text-primary border-primary"></i></div>
                                        <div class="stat-content dib">
                                            <div class="stat-text text-primary">PENJAGA STOR <i class="menu-icon fa fa-arrow-circle-o-right"></i></div>
                                            <div class="stat-digit"><?php echo $kerani['staff_fname']; ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

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
