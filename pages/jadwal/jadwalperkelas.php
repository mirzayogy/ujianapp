<?php
require_once('assets/lib/connection.php');

$database = new Database();
$db = $database->getConnection();

$mata_kuliah = isset($_POST["mata_kuliah"]) ? $_POST["mata_kuliah"] : "";
$hari = isset($_POST["hari"]) ? $_POST["hari"] : "";
$jenis_kelas = isset($_POST["jenis_kelas"]) ? $_POST["jenis_kelas"] : "";
$kode_mata_kuliah = isset($_POST["kode_mata_kuliah"]) ? $_POST["kode_mata_kuliah"] : "";
$id_programstudi = isset($_POST["id_programstudi"]) ? $_POST["id_programstudi"] : "";
$semester = isset($_POST["semester"]) ? $_POST["semester"] : "";
$singkatan = isset($_POST["singkatan"]) ? $_POST["singkatan"] : "";

?>

<div class="block-header">
  <h2>JADWAL > PER KELAS</h2>
</div>
<div class="row clearfix">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
      <div class="header">
        <h2>
          Pilih Jadwal
        </h2>
      </div>
      <div class="body">
        <div class="row clearfix">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <form action="jadwalcreate" method="post">
            <!-- <form id="myForm" method="POST"> -->
              <div class="form-group form-float">
                <div class="form-line">
                  <select class="form-control show-tick" name="id_tahunakademik" id="id_tahunakademik" onchange="generateKelas()">
                    <option value="">-- Please select --</option>
                    <?php
                    $selectQuery = "SELECT * FROM tahunakademik ORDER BY id DESC";
                    $stmt = $db->prepare($selectQuery);
                    $stmt->execute();
                    if($stmt->rowCount()>0){
                      $i = 1;
                      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                        extract($row);
                        ?>
                        <option value="<?php echo $id ?>" <?php if($i==1) echo "selected" ?>><?php echo $tahun." ".$semester ?></option>
                        <?php
                        $i++;
                      }
                    }
                    ?>
                  </select>
                </div>
                <div class="help-info">Tahun Akademik</div>
              </div>
              <div class="form-group form-float">
                <div class="form-line">
                  <select class="form-control show-tick" name="id_programstudi" id="id_programstudi" onchange="generateKelas()">
                    <option value="">-- Please select --</option>
                    <?php
                    $selectQuery = "SELECT p.id, p.prodi FROM programstudi p ORDER BY p.prodi";
                    $stmt = $db->prepare($selectQuery);
                    $stmt->execute();
                    if($stmt->rowCount()>0){
                      $i = 1;
                      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                        extract($row);
                        ?>
                        <option value="<?php echo $id ?>" <?php if($i==1) echo "selected" ?>><?php echo $prodi ?></option>
                        <?php
                        $i++;
                      }
                    }
                    ?>
                  </select>
                </div>
                <div class="help-info">Program Studi</div>
              </div>
              <div class="form-group form-float">
                <div class="form-line">
                  <input type="radio" name="jenis_kelas" id="radio_rp" class="radio-col-indigo" value="REG PAGI" checked  onchange="generateKelas()">
                  <label for="radio_rp">REG PAGI</label>
                  <input type="radio" name="jenis_kelas" id="radio_rm" class="radio-col-indigo" value="REG MALAM"  onchange="generateKelas()">
                  <label for="radio_rm">REG MALAM</label>
                  <input type="radio" name="jenis_kelas" id="radio_nr" class="radio-col-indigo" value="NON REG"  onchange="generateKelas()">
                  <label for="radio_nr">NON REG</label>
                </div>
                <div class="help-info">Jenis Kelas</div>
              </div>
              <div class="form-group form-float">
                <div class="form-line">
                  <select class="form-control show-tick" name="id_kelas" id="id_kelas" onchange="generateTable();">
                    <option value="">-- Pilih Jenis Kelas Dulu --</option>
                  </select>
                </div>
                <div class="help-info">Kelas</div>
              </div>
              <!-- <button class="btn bg-indigo btn-circle waves-effect waves-circle waves-float pull-right" type="submit" name="next" >
                <i class="material-icons">navigate_next</i>
              </button> -->
            </form>
          </div>
        </div>
        <div class="row clearfix">
          <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="js-basic-example">
              <thead>
                <tr>
                  <!-- <th width="10%">Opsi</th> -->
                  <th width="10%">Hari</th>
                  <th width="10%">Jam</th>
                  <th width="40%">Mata Kuliah</th>
                  <th width="40%">Pengajar</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <!-- <th width="10%">Opsi</th> -->
                  <th width="10%">Hari</th>
                  <th width="10%">Jam</th>
                  <th width="40%">Mata Kuliah</th>
                  <th width="40%">Pengajar</th>
                </tr>
              </tfoot>
              <tbody>

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="plugins/jquery-validation/jquery.validate.js"></script>
<script src="assets/js/pages/jadwalperkelas.js"></script>
