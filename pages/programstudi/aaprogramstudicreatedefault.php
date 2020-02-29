<?php
require_once('plugins/twitter-api/config.php');
require_once('assets/lib/connection.php');

$kata_kunci = '';
if (isset($_POST['kata-kunci'])){
  $kata_kunci = $_POST['kata-kunci'];
  $jumlah = $_POST['banyak-data'];
  $no = 0;
  $query = array(
    "q" => $kata_kunci,
    "count" => $jumlah
  );
  $results = search($query);
  // print_r($results);
}
?>

<div class="block-header">
  <h2>PROGRAM STUDI > CREATE</h2>
</div>
<div class="row clearfix">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
      <div class="header">
        <h2>
          Tambah Data
        </h2>
      </div>
      <div class="body">
        <div class="row clearfix">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <form id="create" method="POST">
              <div class="form-group form-float">
                <div class="form-line">
                  <input type="text" class="form-control" name="minmaxlength" maxlength="10" minlength="3" required>
                  <label class="form-label">Min/Max Length</label>
                </div>
                <div class="help-info">Min. 3, Max. 10 characters</div>
              </div>
              <div class="form-group form-float">
                <div class="form-line">
                  <input type="text" class="form-control" name="minmaxvalue" min="10" max="200" required>
                  <label class="form-label">Min/Max Value</label>
                </div>
                <div class="help-info">Min. Value: 10, Max. Value: 200</div>
              </div>
              <div class="form-group form-float">
                <div class="form-line">
                  <input type="url" class="form-control" name="url" required>
                  <label class="form-label">Url</label>
                </div>
                <div class="help-info">Starts with http://, https://, ftp:// etc</div>
              </div>
              <div class="form-group form-float">
                <div class="form-line">
                  <input type="text" class="form-control" name="date" required>
                  <label class="form-label">Date</label>
                </div>
                <div class="help-info">YYYY-MM-DD format</div>
              </div>
              <div class="form-group form-float">
                <div class="form-line">
                  <input type="number" class="form-control" name="number" required>
                  <label class="form-label">Number</label>
                </div>
                <div class="help-info">Numbers only</div>
              </div>
              <div class="form-group form-float">
                <div class="form-line">
                  <input type="text" class="form-control" name="creditcard" pattern="[0-9]{13,16}" required>
                  <label class="form-label">Credit Card</label>
                </div>
                <div class="help-info">Ex: 1234-5678-9012-3456</div>
              </div>
              <button class="btn bg-green waves-effect" type="submit">SUBMIT</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="plugins/jquery-validation/jquery.validate.js"></script>
<script src="assets/js/pages/programstudi.js"></script>
