<?php
  session_start();
  include '../dbConfig.php';

   if (isset($_GET["id"])){
    $r_id = $_GET["id"];

    $sql = "SELECT item.item_name, requisition_detail.req_quantity, requisition_detail.req_quantity_out, requisition_detail.req_quantity_out2
            FROM requisition_detail
            INNER JOIN item
            ON requisition_detail.itemID = item.item_id
            WHERE requisition_detail.r_id = '$r_id'";    
    $result = mysqli_query($connection,$sql);

    $sql2 = "SELECT staff.staff_fname, staff.staff_position, store.store_name, requisition.r_date, requisition.r_date_use, requisition.r_purpose 
             FROM requisition 
             INNER JOIN staff 
             ON requisition.app_id = staff.staffID 
             INNER JOIN store 
             ON requisition.s_id = store.store_id 
             WHERE requisition.r_id = '$r_id'";
    $result2 = mysqli_query($connection,$sql2);
    $row2    = mysqli_fetch_array($result2);  //to pass the recordset in array, so that $row will read as array $row[]

    echo "<script>
            window.onload= function () {
                 window.print();window.close();  
                  }           
          </script>"; 
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

   <!--  <style type="text/css">
    @media print
    {
    body * { visibility: hidden; }
    #print * { visibility: visible; }
    #print { position: absolute; top: 40px; left: 30px; }
    }
    </style> -->
</head>
<body>
        <div class="content mt-2"><!-- margin from content and breadcrumbs (spacing)  -->

            <div class="card border-light" style="padding:0;">
                <div class="card-body">
                       <div id="print" class="col-sm-12 ">
                            <h4 style="text-transform: uppercase;">Butiran Rekod Permohonan - #<?php echo $r_id; ?></h4><br>

                           <div style='border-bottom:2px solid; border-bottom-color:#08082d;'></div><br> <!-- border -->

                           <table class="table table-bordered">
                              <thead>
                                <tr>
                                  <th scope="col">Nama Pemohon</th>
                                  <th scope="col"><?php echo $row2['staff_fname']; ?></th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td>Jawatan</td>
                                  <td><?php echo $row2['staff_position']; ?></td>
                                </tr>
                                <tr>
                                  <td>Dapur</td>
                                  <td><?php echo $row2['store_name']; ?></td>
                                </tr>
                                <tr>
                                  <td>Tarikh Permohonan</td>
                                  <td><?php echo date("d-m-Y", strtotime($row2['r_date'])); ?></td>
                                </tr>
                                <tr>
                                  <td>Tarikh Penggunaan</td>
                                  <td><?php echo date("d-m-Y", strtotime($row2['r_date_use'])); ?></td>
                                </tr>
                                <tr>
                                  <td>Catatan</td>
                                  <td><?php echo $row2['r_purpose']; ?></td>
                                </tr>
                              </tbody>
                            </table>

                            <div style='border-bottom:2px solid; border-bottom-color:#D3D3D3;'></div><br><br>
                            <h4 style="text-transform: uppercase;">Senarai Item</h4><br>
                            

                            <form action="" method="POST">
                                <?php if(mysqli_num_rows($result)>0){ ?> 
                                    <!-- Execute Fetch Data and display -->
                                    <table class="table table-striped">
                                      <thead>
                                        <tr>
                                          <th scope="col">No</th>
                                          <th scope="col">Item</th>
                                          <th scope="col" class="text-center">Kuantiti Permohonan</th>
                                          <th scope="col" class="text-center">Kuantiti Diluluskan</th>
                                          <th scope="col" class="text-center">Kuantiti Pengeluaran</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                            <?php 
                                                $i = 1;
                                                while ($row = mysqli_fetch_assoc($result)) {
                                            ?>
                                        <tr>
                                          <th scope="row">
                                            <?php echo $i; ?>
                                          </th>
                                          <td><?php echo $row['item_name']; ?></td>
                                          <td align="center"><?php echo $row['req_quantity']; ?></td>
                                          <td align="center"><?php echo $row['req_quantity_out']; ?></td>
                                          <td align="center"><?php echo $row['req_quantity_out2']; ?></td>
                                        </tr>
                                            <?php $i = $i + 1; } ?>
                                      </tbody>
                                    </table>

                                    
                                <?php }

                                else{ ?> 
                                    <h4 class="text-danger"  style="font-style: italic;">&nbsp;Tiada rekod dijumpai</h4>
                                    <?php
                                    } 
                                ?>

                                <br>
                                <a href="recordList.php" class="btn btn-primary pull-right" style="margin-right: 5px;">CETAK</a>                         
                            </form>
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
