<?php
if ($_SERVER['REQUEST_URI'] == "/" || strpos($_SERVER['REQUEST_URI'], "index") !== false) {
    $uri = "index";
} elseif (strpos($_SERVER['REQUEST_URI'], "fund") !== false) {
    $uri = "fund";
} elseif (strpos($_SERVER['REQUEST_URI'], "admin") !== false) {
    $uri = "admin";
}
?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <!-- Twitter meta-->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:site" content="@nottdev.com">
    <meta property="twitter:creator" content="@NottDev">
    <!-- Open Graph Meta-->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Noob Bank">
    <meta property="og:title" content="Noob Bank with PHP OOP">
    <meta property="og:url" content="https://noobbank.nottdev.com/">
    <meta property="og:image" content="https://noobbank.nottdev.com/img/banner-show.jpg">
    <meta property="og:description" content="Web application for learning about basic web security. ">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Noob Bank</title>
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <!-- Bootstrap Core CSS -->
    <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Menu CSS -->
    <link href="plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
    <!-- toast CSS -->
    <link href="plugins/bower_components/toast-master/css/jquery.toast.css" rel="stylesheet">
    <!-- animation CSS -->
    <link href="css/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="assets/css/noobbank.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/dataTable.css" rel="stylesheet">
    <!-- <link href="css/main.css" rel="stylesheet"> -->
    <!--fontawesome-->
    <link href="assets/css/font-awesome.min.css" rel="stylesheet" />

    <!-- color CSS -->
    <link href="css/colors/blue-dark.css" id="theme" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <!-- Preloader -->
    <div class="preloader">
      <div class="cssload-speeding-wheel"></div>
    </div>
    <div id="wrapper">
      <!-- Navigation -->
      <nav class="navbar navbar-default navbar-static-top m-b-0">
        <div class="navbar-header" style="box-shadow:-7px 3px 12px 0px rgba(100, 100, 100,0.8);">
          <a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse">
            <i class="fa fa-bars"></i>
          </a>
          <div class="top-left-part">
            <a class="logo" href="./">
              <b>
                <img src="img/logo2.png" alt="home" />
              </b>
              <span class="hidden-xs">Noob Bank</span>
            </a>
          </div>
          <ul class="nav navbar-top-links navbar-left m-l-20 hidden-xs">
            <li>
              <form role="search" class="app-search hidden-xs">
                <input type="text" placeholder="Search..." class="form-control">
                <a href="">
                  <i class="fa fa-search"></i>
                </a>
              </form>
            </li>
          </ul>
          <ul class="nav navbar-top-links navbar-right pull-right">
            <li>
              <a class="profile-pic" data-toggle="dropdown" aria-expanded="false">
                <img src="plugins/images/users/avatar.png" alt="user-img" width="36" class="img-circle">
                <b class="hidden-xs">
                  <?=$_SESSION['firstname'] . ' ' . $_SESSION['lastname']?>
                </b>
              </a>
              <ul class="dropdown-menu">
                <!-- <li class="">
								<a href="">
									Setting
								</a>
							</li> -->
                <li class="dropdown-footer">
                  <!-- <a href="#">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit profile
                  </a> -->
                  <a href="javascript:logout()">
                    <i class="fa fa-sign-out" aria-hidden="true"></i> Sign out
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
        <!-- /.navbar-header -->
        <!-- /.navbar-top-links -->
        <!-- /.navbar-static-side -->
      </nav>
      <!-- Left navbar-header -->
      <!-- Page Content -->
      <div id="page-wrapper">
        <div class="container-fluid">
          <div class="row bg-title">
            <div class="col-lg-1 col-md-2 col-sm-2 col-xs-4 center <?php if ($uri == 'index') {
    echo " active-menu ";
}
?>">
              <h4 class="page-title" style="cursor:pointer;">
                <a href="./">หน้าหลัก</a>
              </h4>
            </div>
            <div class="col-lg-1 col-md-2 col-sm-2 col-xs-4 center <?php if ($uri == 'fund') {
    echo " active-menu ";
}
?>">
              <h4 class="page-title" style="cursor:pointer;">
                <a href="fund.php">กองทุน</a>
              </h4>
            </div>
            <?php if ($_SESSION['role'] == 1) {?>
            <div class="col-lg-1 col-md-2 col-sm-2 col-xs-4 center <?php if ($uri == 'admin') {
    echo " active-menu ";
}
    ?>">
              <h4 class="page-title" style="cursor:pointer;">
                <a href="admin.php">Admin</a>
              </h4>
            </div>
            <?php }?>
            <!-- /.col-lg-12 -->
          </div>
          <!-- /.row -->