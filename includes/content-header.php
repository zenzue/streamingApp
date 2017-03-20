<?php
session_start();

if(!isset($_SESSION['user_session']))
{
  header("Location: ../logout.php");
}

include_once '../config/dbconfig.php';
$basepath = '139.59.250.169/';

$stmt = $db_con->prepare("SELECT * FROM users WHERE user_id=:uid");
$stmt->execute(array(":uid"=>$_SESSION['user_session']));
$row=$stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>MPT Music Streaming</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jvectormap/2.0.4/jquery-jvectormap.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.3.11/css/AdminLTE.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.3.11/css/skins/_all-skins.min.css">

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.1/css/star-rating.css" media="all" rel="stylesheet" type="text/css"/>
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">;

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <style>
      
      .skin-blue .main-header .logo {
          background-color: #222d32;
      }

      .skin-blue .main-header .navbar {
          background-color: #222d32;   
      }

      .skin-blue .main-header li.user-header {
          background-color: #222d32;   
      }

      .skin-blue .main-header .navbar .sidebar-toggle:hover {
          background-color: #000000;
      }

      .skin-blue .main-header .logo:hover {
          background-color: #000000;
      }

  </style>

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">

    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>M</b>PT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>MPT</b>Streaming</span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <span class="hidden-xs"><?php echo $row['user_name'];?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="../dist/img/mptlogo160px160px.png" class="img-circle" alt="User Image">

                <p>
                  <?php echo $row['user_name'];?>
                </p>
              </li>
             
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-right">
                  <a href="../logout.php" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>

    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="../dist/img/ic_launcher.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $row['user_name'];?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <ul class="sidebar-menu">
  
        <li><a href="../artist/artist.php"><i class="glyphicon glyphicon-user"></i> <span>Artist</span></a></li>
        <li><a href="../album/album.php"><i class="glyphicon glyphicon-film"></i> <span>Album</span></a></li>
        <li><a href="../song/song.php"><i class="glyphicon glyphicon-music"></i> <span>Song</span></a></li>
        <li><a href="../publisher/publisher.php"><i class="glyphicon glyphicon-music"></i> <span>Publisher</span></a></li>
        <li><a href="../bigupload/bigupload.php"><i class="glyphicon glyphicon-music"></i> <span>Big Data Upload </span></a></li>
        <li><a href="../playlist/main-playlist.php"><i class="glyphicon glyphicon-music"></i> <span>Playlist</span></a></li>
        <li><a href="../genere/genere.php"><i class="glyphicon glyphicon-music"></i> <span>Genere</span></a></li>
        <?php if ($row['user_role_id'] == 1) {?>
        <li><a href="../users/user.php"><i class="glyphicon glyphicon-user"></i> <span>User</span></a></li>
        <?php } ?>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-laptop"></i>
            <span>Report</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../report/playlog.php"><i class="fa fa-circle-o"></i> Playlog</a></li>
          </ul>
        </li>

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>