<?php
  session_start();
  include '../dbConfig.php';

   $staffID = $_SESSION['id'];

   if(isset($_POST["add_item"])){
    $r_store_id = $_POST["r_store_id"];
    $r_date = $_POST["r_date"];
    $r_note = $_POST["r_note"];

    $selectsql  = "SELECT store_name FROM store WHERE store_id = '$r_store_id'";
    $result   = mysqli_query($connection, $selectsql);
    $store = mysqli_fetch_array($result);

    $_SESSION['r_store_id'] = $r_store_id;
    $_SESSION['r_date'] = $r_date;
    $_SESSION['r_note'] = $r_note;

    $sql = "SELECT * FROM item";
    $result2 = mysqli_query($connection, $sql);
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script> <!-- ajax -->

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
                        <a href="applicationList.php"> <i class="menu-icon fa fa-list-ul"></i>Senarai Permohonan </a>
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

                    <li>
                        <a href=""> <i class="menu-icon fa fa-language"></i>Bahasa (Language) </a>
                    </li>

                    <h3 class="menu-title">Hubungi</h3><!-- /.menu-title -->
                    <li>
                        <a><i class="menu-icon fa fa-phone"></i>0145009851 </a>
                    </li>

                    <li>
                        <a><i class="menu-icon ti-email"></i>shuq29@gmail.com </a>
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
                                <!-- <a class="nav-link" href="#"><i class="fa fa- user"></i>My Profile</a> -->

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
                    <div class="page-title">  
                        <h1 style='font-size:12pt;'>Laman Utama&nbsp; / &nbsp;Permohonan Baru&nbsp; / &nbsp;Tambah Item </h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-2"><!-- margin from content and breadcrumbs (spacing)  -->

            <div class="card border-light" style="padding:0;">
                <div class="card-body">
                       <div class="col-sm-12 ">
                            <h4 style="text-transform: uppercase;">Permohonan Baru</h4><br>

                            <div style='border-bottom:2px solid; border-bottom-color:#08082d;'></div><br> <!-- border -->

                            
                                <!-- <form action="workerAdd.php" method="post" enctype="multipart/form-data" class="form-horizontal"> -->
                                   <div class="row form-group">
                                    <div class="col-sm-2 col-xs-6"><label for="select" class="form-control-label pull-right">Kegunaan Dapur</label></div>
                                    <div class="col-sm-3 col-xs-6">
                                      <input type="text" id="text-input" name="w_name" value="<?php echo $store['store_name']; ?>" placeholder="" class="form-control" disabled>
                                    </div>
                                  </div>

                                  <div class="row form-group">
                                    <div class="col-sm-2 col-xs-6"><label for="text-input" class=" form-control-label pull-right">Tarikh Pesanan</label></div>
                                    <div class="col-sm-3 col-xs-6">
                                        <input type="text" id="text-input" name="w_name" value="<?php echo date("d-m-Y", strtotime($r_date)); ?>" placeholder="" class="form-control" disabled>                                        
                                    </div>
                                  </div>

                                  <div class="row form-group">
                                    <div class="col-sm-2 col-xs-6"><label for="text-input" class=" form-control-label pull-right">Nota</label></div>
                                    <div class="col-sm-6 col-xs-6"><textarea type="textarea-input" rows="2" id="textarea-input" name="r_note" placeholder="" class="form-control" disabled><?php echo $r_note; ?></textarea><br>
                                    </div>
                                  </div>

                                  <div class="row form-group">
                                    <div class="col-sm-2 col-xs-6"></div>
                                    <div class="col-sm-10 col-xs-6">

                                        <div class="form-group">
                                            <form name="add_item" id="add_item">
                                                <div class="table-responsive">
                                                    <table class="table" id="dynamic_field">
                                                        <thead>
                                                            <tr>
                                                              <th scope="col">Item</th>
                                                              <th scope="col">Kuantiti</th>
                                                              <th scope="col"></th>
                                                          </tr>
                                                        </thead>

                                                        <tbody>
                                                            <tr>
                                                                <td> 
                                                                    <select name="name[]" id="select" class="form-control" required>
                                                                        <option value="">Sila Pilih</option>
                                                                         <?php 
                                                                            while ($row = mysqli_fetch_assoc($result2)) {
                                                                        ?>
                                                                        <option value="<?php echo $row['item_id']; ?>"><?php echo $row['item_name']; ?></option>
                                                                        <?php } ?>
                                                                      </select>
                                                                    <!-- <input type="text" name="name[]" placeholder="Masukkan Item" class="form-control name_list" /> --></td> 
                                                                <td>
                                                                    <input type="number" name="qty[]" placeholder="Masukkan Kuantiti" class="form-control" required />
                                                                </td>
                                                                <td><button type="button" name="add" id="add" class="btn btn-success">Tambah</button></td>
                                                            </tr>
                                                        </tbody>
                                                        
                                                    </table>
                                                    <br><br>
                                                    <input type="button" name="submit" id="submit"  class="btn btn-primary pull-right" value="HANTAR PERMOHONAN" />
                                                    <a href="requisitionAdd.php" class="btn btn-outline-primary pull-right" style="margin-right: 5px;">KEMBALI</a>  
                                                </div>
                                            </form>
                                        </div>
                                        
                                    </div>
                                  </div>                                  

                                 

                                  <!-- <input type="submit" value="TAMBAH PESANAN" class="btn btn-primary pull-right" name="add_worker">  -->
                                  
                                <!-- </form> -->

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

                            <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-info">
                                            <h5 class="modal-title" id="mediumModalLabel"><i class="menu-icon fa fa-info-circle">&nbsp;</i>INFO</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>
                                                Adakah senarai barang dan kuantiti yang dipilih dalam nilai yang tepat?
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                                            <input type="button" name="submit" id="submit" class="btn btn-primary pull-right" value="YA" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!--  col 12 -->
                </div> <!--  card body -->
            </div> <!-- card border -->

            

        </div> <!-- .content -->
    </div><!-- /#right-panel -->

    <!-- Right Panel -->

    <script>
    $(document).ready(function(){
        var i=1;
        $('#add').click(function(){
            i++;
            $('#dynamic_field').append('<tr id="row'+i+'"><td><select name="name[]" id="select" class="form-control" required><option value="">Sila Pilih</option><?phpwhile($row=mysqli_fetch_assoc($result2)){?><option value="<?php echo $row['item_id']; ?>"><?php echo $row['item_name']; ?></option><?php}?></select></td><td><input type="number" name="qty[]" placeholder="Masukkan Kuantiti" class="form-control" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove"><i class="fa fa-times"></i></button></td></tr>');
        });
        
        $(document).on('click', '.btn_remove', function(){
            var button_id = $(this).attr("id"); 
            $('#row'+button_id+'').remove();
        });
        
        $('#submit').click(function(){      
            $.ajax({
                url:"requisitionProcess.php",
                method:"POST",
                data:$('#add_item').serialize(),
                success:function(data)
                {
                    // alert(data);
                    $('#add_item')[0].reset();
                    window.location = 'requisitionItem-Success.php';
                }
            });
        });
        
    });
    </script>

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
