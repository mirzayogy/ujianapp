<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <title>Sign In | Bootstrap Based Admin Template - Material Design</title>
  <link rel="icon" href="favicon.ico" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
  <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
  <link href="plugins/node-waves/waves.css" rel="stylesheet" />
  <link href="plugins/animate-css/animate.css" rel="stylesheet" />
  <link href="assets/css/style.css" rel="stylesheet">
</head>

<body class="login-page">
  <div class="login-box">
    <div class="logo">
      <a href="javascript:void(0);">Twit<b>CRAWLER</b></a>
      <small>Admin BootStrap Based - Material Design</small>
    </div>
    <div class="card">
      <div class="body">
        <form id="sign_in" method="POST">
          <div class="msg">Sign in to start your session</div>
          <div class="input-group">
            <span class="input-group-addon">
              <i class="material-icons">person</i>
            </span>
            <div class="form-line">
              <input type="text" class="form-control" name="username" placeholder="Username" required autofocus>
            </div>
          </div>
          <div class="input-group">
            <span class="input-group-addon">
              <i class="material-icons">lock</i>
            </span>
            <div class="form-line">
              <input type="password" class="form-control" name="password" placeholder="Password" required>
            </div>
          </div>
          <p class="align-center" id="jumlahan"></p>
          <div class="input-group">
            <span class="input-group-addon">
              <i class="material-icons">check_box</i>
            </span>
            <div class="form-line">
              <input type="number" class="form-control" name="hasil" id="hasil" placeholder="Captcha" required>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-8 p-t-5">
              <input type="checkbox" name="rememberme" id="rememberme" class="filled-in chk-col-pink">
              <label for="rememberme">Remember Me</label>
            </div>
            <div class="col-xs-4">
              <button class="btn btn-block bg-pink waves-effect" type="submit">SIGN IN</button>
            </div>
          </div>
          <div class="row m-t-15 m-b--20">
            <div class="col-xs-6">
              <a href="sign-up.html">Register Now!</a>
            </div>
            <div class="col-xs-6 align-right">
              <a href="forgot-password.html">Forgot Password?</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="plugins/jquery/jquery.min.js"></script>
  <script src="plugins/bootstrap/js/bootstrap.js"></script>
  <script src="plugins/node-waves/waves.js"></script>
  <script src="plugins/jquery-validation/jquery.validate.js"></script>
  <script src="assets/js/admin.js"></script>
  <script src="assets/js/lib.js"></script>
  <script src="assets/js/pages/sign-in.js"></script>

  <script src="plugins/bootbox/bootbox.min.js"></script>

</body>

</html>
