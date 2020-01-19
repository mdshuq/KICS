<?php 
   session_start();
?>

<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>KICS | Login</title>
    <meta name="description" content="Kitchen Inventory Control System">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <!-- <link rel="shortcut icon" href="favicon.ico"> 
        Title icon-->

    <link rel="stylesheet" href="../css-sufee/assets/css/normalize.css">
    <link rel="stylesheet" href="../css-sufee/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css-sufee/assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css-sufee/assets/css/themify-icons.css">
    <link rel="stylesheet" href="../css-sufee/assets/css/flag-icon.min.css">
    <link rel="stylesheet" href="../css-sufee/assets/css/cs-skin-elastic.css">
    <!-- <link rel="stylesheet" href="assets/css/bootstrap-select.less"> -->
    <link rel="stylesheet" href="../css-sufee/assets/scss/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->

</head>
<body class="bg-dark">


    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                        <img class="align-content" src="../css-sufee/images/logo login.png" alt="">
                </div>
                <div class="login-form">
                    <form action="loginProcess.php" method="POST" enctype="multipart/form-data" class="form-horizontal">
                        <?php if(isset($_SESSION["errMsg"])){ ?>
                            <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                            <span class="badge badge-pill badge-danger">Ralat</span>
                                &nbsp; &nbsp;<?php echo $_SESSION["errMsg"]; ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php
                            }
                            unset($_SESSION["errMsg"]);
                        ?>
                        

                        <div class="form-group">
                            <label><i class="fa fa-user"></i>&nbsp;  ID Pengguna</label>
                            <input type="text" name="username" class="form-control" placeholder="ID Pengguna" required>
                        </div>
                        <div class="form-group">
                            <label><i class="fa fa-lock"></i>&nbsp;  KATA LALUAN</label>
                            <input type="password" name="password" class="form-control" placeholder="Kata Laluan" required>
                        </div>
                        <div class="checkbox">
                            <!-- function ni x buat lagi -->
                            <label>
                                <input type="checkbox"> Remember Me</label>
                            </label>
                            <label class="pull-right" style="font-weight:450; font-style: oblique;">
                                <a href="../staff/forgetPassword.php">Lupa Kata Laluan?</a>
                            </label>

                        </div>
                        <button type="submit" name="submit" class="btn btn-primary btn-flat m-b-30 m-t-30"><i class="fa fa-sign-in"></i>&nbsp; LOG MASUK</button>
                        <br>

                        <a href="../index/index.php" class="btn btn-link m-b-30 m-t-30 "><i class="fa fa-home"></i>&nbsp; LAMAN UTAMA</a>

                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="../css-sufee/assets/js/vendor/jquery-2.1.4.min.js"></script>
    <script src="../css-sufee/assets/js/popper.min.js"></script>
    <script src="../css-sufee/assets/js/plugins.js"></script>
    <script src="../css-sufee/assets/js/main.js"></script>


</body>
</html>
