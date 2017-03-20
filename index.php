<?php

session_start();

if(isset($_SESSION['user_session'])!="")
{
  header("Location: songs/song.php");
}

?>
<?php include('includes/header.php');?>
<style type="text/css">
  
    .head {
        color : #FF0000;
    }

    .login-box {
        border-style: solid;
        border-color: #ffffff;
    }

    .login-page {
        background: #222d32;   
    }

    .login-box-body {
        background: #222d32;
    }

    b {
        color : blue;
    }

</style>
<body class="hold-transition login-page">
<div class="login-logo">
  <b>MPT</b><i class="head">Music Streaming</i>
</div>
<div class="login-box">
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

    <form id="login-form" method="post">
      <div class="form-group has-feedback">
        <input type="text" id="username" name="username" class="form-control" placeholder="Enter Name">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" id="password" name="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" id="btn-login" name="btn-login" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
    <!-- /.social-auth-links -->

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<?php include('includes/footer.php');?>
<script type="text/javascript" src="includes/validation.min.js"></script>
<script type="text/javascript" src="./login/login.js"></script>
</body>
</html>
