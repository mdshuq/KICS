<?php
  session_start();
  include '../dbConfig.php';

   $staffID = $_SESSION['id'];

    // find store name base on user click
    $selectsql  = "SELECT store_name FROM store WHERE store_id = '".$_SESSION['r_store_id']."'";
    $result   = mysqli_query($connection, $selectsql);
    $store = mysqli_fetch_array($result);

    // list item query
    $last_req_id = $_SESSION['last_req_id'];
    $storeID = $_SESSION['r_store_id'];
    $sql = "SELECT * FROM item where item.s_id = '$storeID' AND item.item_id NOT IN(SELECT requisition_detail.itemID FROM requisition_detail WHERE requisition_detail.r_id='$last_req_id') ORDER BY item_name";
    $result2    = mysqli_query($connection, $sql);

    $sql2 = "SELECT requisition_detail.req_id, requisition_detail.req_item, requisition_detail.req_quantity,requisition_detail.item_cost, item.item_unit, item.item_current_quantity
             FROM requisition_detail
             INNER JOIN item
             ON requisition_detail.itemID = item.item_id
             WHERE r_id = '".$_SESSION['last_req_id']."'";
    $result = mysqli_query($connection, $sql2);

    $sql4 = "SELECT SUM(item_cost) AS Total_Cost FROM requisition_detail WHERE r_id = '$last_req_id'";
    $result4 = mysqli_query($connection,$sql4);
    $tcost = mysqli_fetch_array($result4);

    // delete item
    if (isset($_POST["deleteItem"])) {
        $itemID = $_POST["itemID"];
        $sql3 = "DELETE FROM requisition_detail WHERE req_id = '$itemID' ";
        $result3 = mysqli_query($connection,$sql3);

        if($result3){
            header("Refresh:0.5");
        }

        else{
            echo("Error description: " . mysqli_error($result3));
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
    <style>
        input[type="text"]:disabled{background-color:white;}
        textarea[type="textarea-input"]:disabled{background-color:white;}
    </style>

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
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-file-text"></i>Belian</a>
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
            <div class="col-sm-6">
                <div class="page-header float-left">
                    <div class="page-title text-secondary">  
                        <h1 style='font-size:12pt;'>Laman Utama&nbsp; / &nbsp;Belian&nbsp; / &nbsp;Tambah Item</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-2"><!-- margin from content and breadcrumbs (spacing)  -->

            <div class="card border-light" style="padding:0;">
                <div class="card-body">
                       <div class="col-sm-12 ">
                            <h4 style="text-transform: uppercase;">Belian / Tambah Item</h4><br>

                             <div style='border-bottom:2px solid; border-bottom-color:#08082d;'></div><br> <!-- border -->

                                   <div class="row form-group">
                                    <div class="col-sm-2 col-xs-6"><label for="select" class="form-control-label pull-right">Stor</label></div>
                                    <div class="col-sm-3 col-xs-6">
                                        : &nbsp;&nbsp;&nbsp;<?php echo $store['store_name']; ?>
                                    </div>
                                  </div>

                                  <div class="row form-group">
                                    <div class="col-sm-2 col-xs-6"><label for="text-input" class=" form-control-label pull-right">Tarikh Pesanan</label></div>
                                    <div class="col-sm-3 col-xs-6">
                                        : &nbsp;&nbsp;&nbsp;<?php echo date("d-m-Y", strtotime($_SESSION['r_date'])); ?>                                     
                                    </div>
                                  </div>

                                  <div class="row form-group">
                                    <div class="col-sm-2 col-xs-6"><label for="text-input" class=" form-control-label pull-right">Catatan</label></div>
                                    <div class="col-sm-6 col-xs-6">
                                        : &nbsp;&nbsp;&nbsp;<?php echo $_SESSION['r_note']; ?>
                                    </div>
                                  </div>

                                  <!-- Border gray -->
                                  <div class="row form-group">
                                    <div class="col-sm-2 col-xs-6"></div>
                                    <div class="col-sm-10 col-xs-6"><div style='border-bottom:2px solid; border-bottom-color:#D3D3D3;'></div><br>
                                    </div>
                                  </div>

                                  <!-- item form -->
                                  <form action="stock_ItemAdd.php" method="post" enctype="multipart/form-data" class="form-horizontal">
                                    <div class="row form-group">
                                        <div class="col-sm-2 col-xs-6"><label for="text-input" class="form-control-label pull-right">Item</label></div>
                                        <div class="col-sm-4 col-xs-6">
                                            <select class="form-control" name="itemID" required>
                                                <option value="">Pilih Item</option>
                                                <?php 
                                                    while ($row = mysqli_fetch_assoc($result2)) {
                                                ?>
                                                    <option value="<?php echo $row['item_id']; ?> "><?php echo $row['item_name']; ?>&nbsp; - &nbsp;[<?php echo $row['item_unit']; ?>]&nbsp;[<?php echo $row['item_current_quantity']; ?>]</option>
                                                <?php } ?>
                                            </select>                                    
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col-sm-2 col-xs-6"><label for="text-input" class="form-control-label pull-right">Kuantiti</label></div>
                                        <div class="col-sm-3 col-xs-6">
                                            <input type="number" min="1" name="quantity" placeholder="Masukkan Kuantiti" class="form-control" required />              
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col-sm-2 col-xs-6"><label for="text-input" class="form-control-label pull-right">Kos Barang (RM)</label></div>
                                        <div class="col-sm-3 col-xs-6">
                                            <input type="number" min="1" step="0.01" name="cost" placeholder="125.00" class="form-control" required />              
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col-sm-2 col-xs-6"></div>
                                            <div class="col-sm-3 col-xs-6">
                                                <button type="submit" name="addItem" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp; Tambah Item</button>               
                                            </div>
                                    </div>
                                  </form>

                                  <?php if(mysqli_num_rows($result)>0){ ?> 

                                     <!-- Border gray -->
                                  <div class="row form-group">
                                    <div class="col-sm-2 col-xs-6"></div>
                                    <div class="col-sm-10 col-xs-6"><div style='border-bottom:2px solid; border-bottom-color:#D3D3D3;'></div><br>
                                    </div>
                                  </div>

                                  <div class="row form-group">
                                    <div class="col-sm-2 col-xs-6"></div>
                                    <div class="col-sm-10 col-xs-6">

                                        <div class="form-group">
                                                <div class="table-responsive">
                                                    <table class="table" id="dynamic_field">
                                                        <thead>
                                                            <tr>
                                                              <th scope="col">Item</th>
                                                              <th scope="col" class="text-center">Unit</th>
                                                              <th scope="col" class="text-center">Kuantiti Semasa</th>
                                                              <th scope="col" class="text-center">Kuantiti Belian</th>
                                                              <th scope="col" class="text-center">Kos Barang</th>
                                                              <th scope="col"></th>
                                                          </tr>
                                                        </thead>

                                                        <tbody>
                                                                <?php 
                                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                                ?>
                                                                <tr>
                                                                    <td> 
                                                                        <?php echo $row['req_item']; ?>
                                                                    </td> 
                                                                    <td align="center">
                                                                        <?php echo $row['item_unit']; ?>
                                                                    </td>
                                                                    <td align="center">
                                                                        <?php echo $row['item_current_quantity']; ?>
                                                                    </td>
                                                                    <td align="center">
                                                                        <?php echo $row['req_quantity']; ?>
                                                                    </td>
                                                                    <td align="center">
                                                                        RM <?php echo $row['item_cost']; ?>
                                                                    </td>
                                                                    <td>
                                                                        <form action="" onsubmit="return confirm('Padam item ini ?');" method="post" enctype="multipart/form-data" class="form-horizontal">
                                                                        <input type="hidden" name="itemID" value="<?php echo $row["req_id"];?>" />  
                                                                        <button type="submit" name="deleteItem" class="btn btn-danger"><i class="fa fa-close"></i>&nbsp; Padam</button>
                                                                        </form>
                                                                    </td>
                                                                </tr>
                                                                <?php
                                                                    }
                                                                ?>
                                                        </tbody>
                                                    </table>
                                                     
                                                </div>
                                        </div>

                                        <div class="pull-right">
                                            <div class="col-sm-12"><h4 style="text-transform: uppercase;">JUMLAH KOS BELIAN :  RM <?php echo $tcost['Total_Cost']; ?> </h4></div>
                                        </div>
                                                                    
                                                      
                                                  
                                        
                                    </div>
                                  </div>  

                                  <form action="stockItem-Success.php" onsubmit="return confirm('Adakah butiran item yand diisi tepat ?');" method="post" enctype="multipart/form-data" class="form-horizontal"> 
                                      <div class="row form-group">
                                        <div class="col-sm-12 col-xs-6">
                                            <input type="hidden" name="tcost" value="<?php echo $tcost['Total_Cost']; ?>" />
                                            <input type="submit" name="submit" class="btn btn-primary pull-right" value="HANTAR REKOD BELIAN" />
                                            <a href="stockAdd.php" onclick="return confirm('Anda belum hantar permohonan ini, kembali ke halaman sebelum ?');" class="btn btn-outline-primary pull-right" style="margin-right: 5px;">KEMBALI</a>  
                                            <br><br>
                                        </div>
                                      </div>  
                                  </form>      
                                  <?php } ?>                       

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
                        </div> <!--  col 12 -->
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
