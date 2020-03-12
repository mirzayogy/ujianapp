<?php
  if(empty($_COOKIE['jwt'])){
    echo "<meta http-equiv='refresh' content='1; url=sign-in.php'> ";
  }else{

?>
<!DOCTYPE html>
<html>

<head>
  <?php include_once("partials/header.php") ?>
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->

</head>

<body class="theme-light-green">
  <!-- Page Loader -->
  <div class="page-loader-wrapper">
    <div class="loader">
      <div class="preloader">
        <div class="spinner-layer pl-light-green">
          <div class="circle-clipper left">
            <div class="circle"></div>
          </div>
          <div class="circle-clipper right">
            <div class="circle"></div>
          </div>
        </div>
      </div>
      <p>Please wait...</p>
    </div>
  </div>
  <!-- #END# Page Loader -->
  <!-- Overlay For Sidebars -->
  <div class="overlay"></div>
  <!-- #END# Overlay For Sidebars -->
  <!-- Search Bar -->
  <div class="search-bar">
    <?php include_once("partials/searchbar.php") ?>
  </div>
  <!-- #END# Search Bar -->
  <!-- Top Bar -->
  <nav class="navbar">
    <?php include_once("partials/navbar.php") ?>
  </nav>
  <!-- #Top Bar -->
  <section>
    <?php include_once("partials/leftbar.php") ?>
    <?php include_once("partials/rightbar.php") ?>
  </section>

  <section class="content">
    <div class="container-fluid">
      <?php include_once("route.php") ?>
    </div>
  </section>



  <script src="plugins/momentjs/moment.js"></script>
  <script src="plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
  <script src="plugins/bootstrap/js/bootstrap.js"></script>
  <script src="plugins/bootstrap-select/js/bootstrap-select.js"></script>
  <script src="plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
  <script src="plugins/node-waves/waves.js"></script>
  <script src="assets/js/admin.js"></script>
  <script src="assets/js/lib.js"></script>
  <script src="assets/js/demo.js"></script>
  <script src="assets/js/pages/index.js"></script>
  <!-- <script src="js/route.js"></script>
  <script src="js/router.js"></script> -->
  <script src="assets/js/app.js"></script>
  <script src="plugins/jquery-datatable/jquery.dataTables.js"></script>
  <script src="plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>

  <script src="plugins/jquery-validation/jquery.validate.js"></script>
  <script src="plugins/jquery-steps/jquery.steps.js"></script>
  <script src="plugins/sweetalert/sweetalert.min.js"></script>

  <script src="plugins/jquery-countto/jquery.countTo.js"></script>
  <script src="plugins/raphael/raphael.min.js"></script>
  <script src="plugins/jquery-sparkline/jquery.sparkline.js"></script>

  <script src="plugins/bootbox/bootbox.min.js"></script>

  <script type="text/javascript">
  $('.js-basic-example').DataTable({
    "lengthChange": false
  });
  $('.js-exportable').DataTable();
  </script>




</body>

</html>
<?php
}
?>
