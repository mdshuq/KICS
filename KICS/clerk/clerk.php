<?php
  session_start();
  include '../dbConfig.php';

   $staffID = $_SESSION['id'];
   $year = date("Y"); 

   //permohonan 
   $sql  = "SELECT * FROM requisition WHERE r_status='Lulus' && r_type='Out'";
   $result   = mysqli_query($connection, $sql);
   $row    = mysqli_num_rows($result); 

   //terengganu residence total item
   $sql2  = "SELECT * FROM item WHERE s_id ='1'";
   $result2   = mysqli_query($connection, $sql2);
   $row2    = mysqli_num_rows($result2); 

   //public kitchen total item
   $sql3  = "SELECT * FROM item WHERE s_id ='2'";
   $result3   = mysqli_query($connection, $sql3);
   $row3    = mysqli_num_rows($result3); 

   //belian
   $sql4  = "SELECT * FROM requisition WHERE r_status='Complete' && r_type='In'";
   $result4   = mysqli_query($connection, $sql4);
   $row4    = mysqli_num_rows($result4); 

   //pemohon
   $sql5  = "SELECT * FROM staff WHERE staff_role='Pemohon'";
   $result5   = mysqli_query($connection, $sql5);
   $row5    = mysqli_num_rows($result5); 

   //kos belian
   $sql6  = "SELECT ROUND(SUM(total_cost),2) AS tcost FROM requisition WHERE (r_type='In' AND r_status = 'Complete' AND r_date LIKE '%$year%')";
   $result6   = mysqli_query($connection, $sql6);
   $tcost = mysqli_fetch_assoc($result6);

   //terengganu residence item status
   $statusTR = 'Tersedia';
   while ($tr = mysqli_fetch_assoc($result2)){
        if ($tr['item_current_quantity'] < $tr['item_ROP']){
            $statusTR = 'Rendah';
        } 
   }

   $statusPK = 'Tersedia';
   while ($pk = mysqli_fetch_assoc($result3)){
        if ($pk['item_current_quantity'] < $pk['item_ROP']){
            $statusPK = 'Rendah';
        } 
   } 

  
   //graph
       // $sql7  = "SELECT month.m_name, ROUND(SUM(requisition.total_cost),2) AS Sum_Month FROM month LEFT JOIN requisition ON month.m_id = MONTH(requisition.r_date) WHERE (r_type='In' AND r_status = 'Complete' AND r_date LIKE '%$year%') GROUP BY month.m_name";
       // $result7   = mysqli_query($connection, $sql7);

?>

<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>KICS | Clerk</title>
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

        <!-- <script src="../chart/jquery.min.js"></script>
        <link rel="stylesheet" href="../chart/jquery-ui.css">
        <script src="../chart/bootstrap.min.js"></script>
        <script src="../chart/jquery.highchartTable.js"></script>
        <script src="../chart/highcharts.js"></script>
        <script src="../chart/jquery-ui.js"></script> -->
    

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
                <a class="navbar-brand" href="clerk.php"><img src="../css-sufee/images/logo clerk.png" alt="Logo"></a>
                <a class="navbar-brand hidden" href="clerk.php"><img src="../css-sufee/images/logo clerk2.png" alt="Logo"></a>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="../clerk/clerk.php"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                    </li>

                    <h3 class="menu-title">Kerani</h3><!-- /.menu-title -->
                    <li class="menu-item-has-children dropdown" >
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-list"></i>Senarai Item</a>
                        <ul class="sub-menu children dropdown-menu" >
                            <li><i class="menu-icon fa fa-book"></i><a href="../clerk/itemList(TR).php">Terengganu Residence</a></li>      
                            <li><i class="menu-icon fa fa-book"></i><a href="../clerk/itemList(PK).php">Public Kitchen </a></li>                       
                        </ul>
                    </li>

                    <h3 class="menu-title">Penjaga Stor</h3><!-- /.menu-title -->
                    <li class="menu-item-has-children dropdown" >
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-file"></i>Permohonan</a>
                        <ul class="sub-menu children dropdown-menu" >
                            <li><i class="menu-icon fa fa-list"></i><a href="stockOut_List.php">Senarai Permohonan </a></li>   
                            <li><i class="menu-icon fa fa-archive"></i><a href="../clerk/recordList.php">Rekod Permohonan</a></li>                 
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown" >
                        <a href="" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-file-text"></i>Belian</a>
                        <ul class="sub-menu children dropdown-menu" >
                            <li><i class="menu-icon fa fa-list"></i><a href="../clerk/stockIn_List.php">Senarai Belian </a></li>    
                            <li><i class="menu-icon fa fa-plus-square"></i><a href="../clerk/stockAdd.php">Stok Masuk </a></li>                    
                        </ul>
                    </li>

                    <!-- tetapan -->
                    <h3 class="menu-title">Tetapan</h3><!-- /.menu-title -->
                    <li>
                        <a href="../clerk/viewProfil.php"> <i class="menu-icon ti-user"></i>Profil </a>
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
                            $sql8 = "SELECT requisition.r_id, requisition.r_notification, requisition.r_status FROM requisition WHERE requisition.r_notification = 'unread' AND requisition.r_status = 'Lulus' ";
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
                                <a class="dropdown-item media bg-flat-color-3" href="stockOut_ListDetail.php?r_id=<?php echo $noti['r_id']; ?>">
                                    <i class="fa fa-check"></i>
                                    <p>Permohonan Diluluskan - #<?php echo $noti['r_id'];?></p>
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

        <div class="content mt-2"><!--  space betweeen card and breadcrumb -->

            <div class="card border-light" style="padding:0;">
                <div class="card-body">

                    <?php if(mysqli_num_rows($result)>0){ ?> 
                        <div class="sufee-alert alert with-close alert-warning alert-dismissible fade show">
                            <span class="badge badge-pill badge-warning">Peringatan</span>
                                &nbsp;&nbsp;Sila pastikan semua permohonan pengeluaran item disahkan !
                                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                     <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                    <?php } else { ?>
                        <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
                            <span class="badge badge-pill badge-success">Peringatan</span>
                                &nbsp;&nbsp;Semua permohonan pengeluaran item telah disahkan !
                                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                     <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                    <?php } ?>

                    <br>

                    <div class="row">
                    <div class="col-md-6 col-lg-3">
                        <div class="card text-white bg-flat-color-4">
                            <div class="card-body">
                                <div class="h1 text-muted text-right mb-4">
                                        <i class="ti ti-layout-grid2 text-light"></i>
                                    </div>

                                    <div class="h4 mb-0 text-light">PERMOHONAN</div>
                                    <h4 class="font-weight-bold text-light">Jumlah : <span class="count"><?php echo $row; ?></span></h4>
                                    <div class="progress progress-xs mt-3 mb-0 bg-light" style="width: 40%; height: 5px;"></div>
                            </div>
                        </div>
                    </div>

                     <div class="col-md-6 col-lg-3">
                        <div class="card text-white bg-flat-color-5">
                            <div class="card-body">
                                <div class="h1 text-muted text-right mb-4">
                                        <i class="fa fa-money text-light"></i>
                                    </div>

                                    <div class="h4 mb-0 text-light">BELIAN</div>
                                    <h4 class="font-weight-bold text-light">Jumlah Rekod : <span class="count"><?php echo $row4; ?></span></h4>
                                    <div class="progress progress-xs mt-3 mb-0 bg-light" style="width: 40%; height: 5px;"></div>
                            </div>
                        </div>
                    </div>

                     <div class="col-md-6 col-lg-3">
                        <div class="card text-white bg-flat-color-1">
                            <div class="card-body">
                                <div class="h1 text-muted text-right mb-4">
                                        <i class="fa fa-book text-light"></i>
                                    </div>

                                    <div class="h4 mb-0 text-light">TRG. RESIDENCE</div>
                                    <h4 class="font-weight-bold text-light">Jumlah Item : <span class="count"><?php echo $row2; ?></span></h4>
                                    <div class="progress progress-xs mt-3 mb-0 bg-light" style="width: 40%; height: 5px;"></div>
                            </div>
                        </div>
                    </div>

                     <div class="col-md-6 col-lg-3">
                        <div class="card text-white bg-flat-color-2">
                            <div class="card-body">
                                <div class="h1 text-muted text-right mb-4">
                                        <i class="fa fa-book text-light"></i>
                                    </div>

                                    <div class="h4 mb-0 text-light">PUBLIC KITCHEN</div>
                                    <h4 class="font-weight-bold text-light">Jumlah Item : <span class="count"><?php echo $row3; ?></span></h4>
                                    <div class="progress progress-xs mt-3 mb-0 bg-light" style="width: 40%; height: 5px;"></div>
                            </div>
                        </div>
                    </div>
                    </div><!-- row -->

                    <br>

                    <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-one">
                                    <div class="stat-icon dib"><i class="ti-user text-danger border-danger"></i></div>
                                    <div class="stat-content dib">
                                        <div class="stat-text">PEMOHON</div>
                                        <div class="stat-digit"><?php echo $row5; ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-one">
                                    <div class="stat-icon dib"><i class="ti-money text-success border-success"></i></div>
                                    <div class="stat-content dib">
                                        <div class="stat-text">KOS BELIAN</div>
                                        <div class="stat-digit" style="font-size:18px; line-height: 2.0;">RM <?php echo $tcost["tcost"]; ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-one">
                                    <div class="stat-icon dib"><i class="ti-pulse text-primary border-primary"></i></div>
                                    <div class="stat-content dib">
                                        <div class="stat-text">ITEM (TR)</div>
                                        <?php 
                                            if ($statusTR == 'Tersedia'){ ?>
                                                <div class='stat-digit text-success'><?php echo $statusTR; ?></div>
                                                <?php } 

                                            else { ?>
                                                <div class='stat-digit text-danger'><?php echo $statusTR; ?></div>
                                            <?php }
                                        ?>
                                        <!-- <div class="stat-digit text-danger"><?php  echo $statusTR; ?></div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-one">
                                    <div class="stat-icon dib"><i class="ti-pulse text-info border-info"></i></div>
                                    <div class="stat-content dib">
                                        <div class="stat-text">ITEM (PK)</div>
                                        <?php 
                                            if ($statusPK == 'Tersedia'){ ?>
                                                <div class='stat-digit text-success'><?php echo $statusPK; ?></div>
                                                <?php } 

                                            else { ?>
                                                <div class='stat-digit text-danger'><?php echo $statusPK; ?></div>
                                            <?php }
                                        ?>     
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div><!-- row -->
                    <br>

                    <!-- <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="for_chart">
                            <thead>
                                <tr>
                                    <th width="40%">Bulan</th>
                                    <th width="60%">Jumlah Kos Belian (RM)</th>
                                </tr>
                            </thead>
                            <?php
                            foreach($result7 as $row)
                            {
                                echo '
                                <tr>
                                    <td>'.$row["m_name"].'</td>
                                    <td>'.$row["Sum_Month"].'</td>
                                    
                                </tr>
                                ';
                            }
                            ?>
                        </table>
                    </div>
                    <br />
                    <div id="chart_area" title="Jumlah Kos Belian Bulanan">
                        
                    </div>
                    <div align="center">
                        <button type="button" name="view_chart" id="view_chart" class="btn btn-info btn-lg">Lihat Carta Bulanan</button>
                    </div> -->


                </div> <!--  card body -->
            </div> <!-- card border -->


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

    <!-- <script>
    $(document).ready(function(){
            
        $('#view_chart').click(function(){
            $('#for_chart').data('graph-container', '#chart_area');
            $('#for_chart').data('graph-type', 'column');
            $("#chart_area").dialog('open');
            $('#for_chart').highchartTable();
            
            $('#remove_chart').attr('disabled', false);
        });
        
        $('#remove_chart').click(function(){
            $('#chart_area').html('');
        });
        
        $("#chart_area").dialog({
            autoOpen:false,
            width: 1000,
            height:500
        });
    });
    </script> -->
  </body>
</html>
