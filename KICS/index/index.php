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
      
      if($numRows > 0)
      {
        /*print "Welcome Back $row[name]<br/>";//NAME is taken from the db attribute name
        print "What to do Next?<br> <a href=logout.php?id=$id>Log Out </a>|<a href=update.php?id=$id>Update Profile</a> | <a href=delete.php?id=$id>Delete Account</a>";*/
        
        //set Session
        $_SESSION['id'] = $id; 
        print "<br /> Your Session ID is ".$_SESSION['id'];
        header('Location: sakai.php'); 
      }
      else
      {

          //print "Opps! Login Unsuccessful. Please Relogin or Register a new account <a href=registerCustomer.php>HERE</a>";
        $_SESSION['errMsg'] = "Invalid username or password";
        header('Location: ../index/index.php#contact');
      }
  
   } 
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Theme Made By www.w3schools.com - No Copyright -->
  <title>KICS Homepage</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
  body {
      font: 400 15px/1.8 Lato, sans-serif;
      color: #777;
  }
  h3, h4 {
      margin: 10px 0 30px 0;
      letter-spacing: 10px;      
      font-size: 35px;
      color: #111;
      font-weight: 900;
  }
  .container {
      padding: 80px 120px;
  }
  .carousel-inner img {
      width: 100%; /* Set width to 100% */
      margin: auto;
      min-width: 100%;
  }
  .carousel-caption h3 {
      color: #fff !important;
  }
  @media (max-width: 600px) {
    .carousel-caption {
      display: none; /* Hide the carousel text when the screen is less than 600 pixels wide */
    }
  }
  .bg-1 {
      background: #08082d;
      color: #bdbdbd;
  }
  .bg-1 h3 {color: #fff;}
  .bg-1 p {font-style: italic;}
  .list-group-item:first-child {
      border-top-right-radius: 0;
      border-top-left-radius: 0;
  }
  .list-group-item:last-child {
      border-bottom-right-radius: 0;
      border-bottom-left-radius: 0;
  }
  .thumbnail {
      padding: 0 0 15px 0;
      border: none;
      border-radius: 0;
  }
  .thumbnail p {
      margin-top: 15px;
      color: #555;
  }
  .btn {
      padding: 10px 20px;
      background-color: #08082d;
      color: #f1f1f1;
      border-radius: 0;
      transition: .2s;
  }
  .btn:hover, .btn:focus {
      border: 1px solid #333;
      background-color: #fff;
      color: #000;
  }
  .modal-header, h4, .close {
      background-color: #08082d;
      color: #fff !important;
      text-align: center;
      font-size: 30px;
  }
  .modal-header, .modal-body {
      padding: 40px 50px;
  }
  .nav-tabs li a {
      color: #777;
  }
  
  .navbar {
      font-family: Montserrat, sans-serif;
      margin-bottom: 0;
      background-color: #08082d; /*tema color sistem */
      border: 0;
      font-size: 11px !important;
      letter-spacing: 4px;
      opacity: 0.9;
  }
  .navbar li a, .navbar .navbar-brand { 
      color: #d5d5d5 !important;
  }
  .navbar-nav li a:hover {
      color: #fff !important;
  }
  .navbar-nav li.active a {
      color: #fff !important;
      background-color: #15157c !important;
  }
  .navbar-default .navbar-toggle {
      border-color: transparent;
  }
  .open .dropdown-toggle {
      color: #fff;
      background-color: #555 !important;
  }
  .dropdown-menu li a {
      color: #000 !important;
  }
  .dropdown-menu li a:hover {
      background-color: red !important;
  }
  footer {
      background-color: #08082d;
      color: #f5f5f5;
      padding: 32px;
  }
  footer a {
      color: #f5f5f5;
  }
  footer a:hover {
      color: #777;
      text-decoration: none;
  }  
  .form-control {
      border-radius: 0;
  }
  textarea {
      resize: none;
  }
  </style>
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="50">

<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#myPage">KICS</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#myPage">HOME</a></li>
        <li><a href="#contact">CONTACT</a></li>
        <li><a href="../staff/login.php"  data-toggle="modal" >LOGIN</a></li>
        <!-- <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">MORE
          <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Merchandise</a></li>
            <li><a href="#">Extras</a></li>
            <li><a href="#">Media</a></li> 
          </ul>
        </li> -->

        <!-- <li><a href="#"><span class="glyphicon glyphicon-search"></span></a></li> -->
      </ul>
    </div>
  </div>
</nav>

<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
      <div class="item active">
        <img src="background-img/background 3.jpg" alt="New York" style="height:800px;" width="1200" height="700">
        <div class="carousel-caption">
          <h3>PEJABAT KEBAWAH DULI YANG MAHA MULIA SULTAN TERENGGANU</h3>
          <p style="font-size: 20px;">Kitchen Inventory Control System</p>
        </div>      
      </div>

      <!-- <div class="item">
        <img src="background-img/background 2.jpg" alt="Chicago" style="height:800px;" width="1200" height="700">
        <div class="carousel-caption">
          <h3>Chicago</h3>
          <p>Thank you, Chicago - A night we won't forget.</p>
        </div>      
      </div> -->
    
      <!-- <div class="item">
        <img src="la.jpg" alt="Los Angeles" width="1200" height="700">
        <div class="carousel-caption">
          <h3>LA</h3>
          <p>Even though the traffic was a mess, we had the best time playing at Venice Beach!</p>
        </div>      
      </div> -->
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
</div>

  <!-- Login Modal -->
  <div class="modal fade" id="loginModal" role="dialog"><a name="loginModal"></a>
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">×</button>
          <h4><span class="glyphicon glyphicon-lock"></span> Borang Log Masuk </h4>
        </div>

        <!-- Login Form -->
        <div class="modal-body">
          <form role="form" method="post" action="../index/index.php"> 
            <div class="form-group">

              <?php if(!empty($_SESSION['errMsg'])) { echo $_SESSION['errMsg']; } ?>

              <label for="psw"><span class="glyphicon glyphicon-user"></span> ID Pengguna </label>
              <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan ID Pengguna" required />
            </div>
            <div class="form-group">
              <label for="usrname"><span class="glyphicon glyphicon-lock"></span> Kata Laluan </label>
              <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Kata Laluan" required />
            </div>
              <button type="submit" name="submit" id="login_button" class="btn btn-block">Log Masuk</button>
                      
          </form>
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal">
            <span class="glyphicon glyphicon-remove"></span> Batal
          </button>
            <a href="#">
              <p> <i class="glyphicon glyphicon-user"></i> Daftar Akaun?</p> 
            </a>
          
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<!-- Container (Contact Section) -->
<div id="contact" class="container">
  <h3 class="text-center">Hubungi Kami</h3>
  <p class="text-center"><em>OFFICE OF HIS ROYAL HIGHNESS THE SULTAN OF TERENGGANU</em></p>

  <div class="row">
    <div class="col-md-4">
      <p><span class="glyphicon glyphicon-map-marker"></span>&nbsp;Istana Syarqiyyah<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;20500 Kuala Terengganu<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Terengganu Darul Iman</p>
      <p><span class="glyphicon glyphicon-phone"></span>&nbsp;Phone: +609-621 6000</p>
      <p><span class="glyphicon glyphicon-print"></span>&nbsp;Phone: +609-621 6116</p>
      <p><span class="glyphicon glyphicon-envelope"></span>&nbsp;Email  : pejdymm@terengganu.gov.my</p>
    </div>

    <form action="mailto:pejdymm@terengganu.gov.my" method="post" enctype="text/plain">
      <div class="col-md-8">
        <div class="row">
          <div class="col-sm-6 form-group">
            <input class="form-control" id="name" name="name" placeholder="Name" type="text" required>
          </div>
          <div class="col-sm-6 form-group">
            <input class="form-control" id="email" name="email" placeholder="Email" type="email" required>
          </div>
        </div>
        <textarea class="form-control" id="comments" name="comments" placeholder="Comment" rows="5"></textarea>
        <br>
        <div class="row">
          <div class="col-md-12 form-group">
            <button class="btn pull-right" type="submit">Send</button>
          </div>
        </div>
      </div>
    </form>
  </div>
  <br>
 
</div>


<!-- Footer -->
<footer class="text-center">
  <a class="up-arrow" href="#myPage" data-toggle="tooltip" title="TO TOP">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </a><br><br>
  <p>Copyright&nbsp; © &nbsp;   @mdshuq | Paparan terbaik dalam Google Chrome, Mozilla Firefox. Resolusi 1440 x 900 </p> 
</footer>


<script>
$(document).ready(function(){
  // Initialize Tooltip
  $('[data-toggle="tooltip"]').tooltip(); 
  
  // Add smooth scrolling to all links in navbar + footer link
  $(".navbar a, footer a[href='#myPage']").on('click', function(event) {

    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {

      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 900, function(){
   
        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    } // End if
  });
})
</script>

</body>
</html>
