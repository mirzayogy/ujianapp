<?php
require_once('assets/lib/connection.php');

$database = new Database();
$db = $database->getConnection();

if(isset($_POST['simpan'])){
  $pesanError=array();
  $id = isset($_POST["update"]) ? $_POST["update"] : "";
  $tahunakademik = isset($_POST["tahunakademik"]) ? $_POST["tahunakademik"] : "";
  $semester = isset($_POST["semester"]) ? $_POST["semester"] : "";
  $singkatan = isset($_POST["singkatan"]) ? $_POST["singkatan"] : "";

  $tahunakademik=htmlspecialchars(strip_tags($tahunakademik));
  $semester=htmlspecialchars(strip_tags($semester));
  $singkatan=htmlspecialchars(strip_tags($singkatan));

  $database = new Database();
  $db = $database->getConnection();

  $checkQuery = "SELECT * FROM tahunakademik WHERE tahun=? AND semester=? AND id!=?";
  $stmt = $db->prepare($checkQuery);
  $stmt->bindParam(1, $tahunakademik);
  $stmt->bindParam(2, $semester);
  $stmt->bindParam(3, $id);
  $stmt->execute();
  if($stmt->rowCount()>0){
    $pesanError[] = "Data <strong>Tahun Akademik Semester</strong> sama sudah ada";
  }

  $checkQuery = "SELECT * FROM tahunakademik WHERE singkatan=? AND id!=?";
  $stmt = $db->prepare($checkQuery);
  $stmt->bindParam(1, $singkatan);
  $stmt->bindParam(2, $id);
  $stmt->execute();
  if($stmt->rowCount()>0){
    $pesanError[] = "Data <strong>singkatan</strong> sama sudah ada";
  }

  if (count($pesanError)>=1 ){
    $noPesan=0;
    foreach ($pesanError as $indeks=>$pesan_tampil) {
      $noPesan++;
      ?>
      <div class="alert alert-warning">
        <span><strong>Gagal!!</strong> <?php echo $pesan_tampil ?></span>
      </div>
      <?php
    }
  }else{
    $query = "UPDATE tahunakademik SET tahun=?, semester=?, singkatan=? WHERE id=?";
    $stmt = $db->prepare($query);

    $stmt->bindParam(1, $tahunakademik);
    $stmt->bindParam(2, $semester);
    $stmt->bindParam(3, $singkatan);
    $stmt->bindParam(4, $id);

    if($stmt->execute()){
      ?>
      <div class="alert alert-success">
        <span><strong>Sukses!!</strong> Data berhasil disimpan</span>
      </div>
      <?php
    }
  }
}

$id = $_POST['update'];

$selectQuery = "SELECT * FROM tahunakademik WHERE id=?";
$stmt = $db->prepare($selectQuery);
$stmt->bindParam(1, $id);
$stmt->execute();
if($stmt->rowCount()>0){
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    extract($row);
    // $tahunakademik = isset($_POST["tahunakademik"]) ? $_POST["tahunakademik"] : "";
    // $singkatan = isset($_POST["singkatan"]) ? $_POST["singkatan"] : "";

    ?>

    <div class="block-header">
      <h2><a href="tahunakademik">TAHUN AKADEMIK</a> > UPDATE</h2>
    </div>
    <div class="row clearfix">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
          <div class="header">
            <h2>
              Ubah Data
            </h2>
          </div>
          <div class="body">
            <div class="row clearfix">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <form id="myForm" method="POST">
                  <div class="form-group form-float">
                    <div class="form-line">
                      <input type="text" class="form-control" name="update" maxlength="200" required value="<?php echo $id ?>" readonly>
                      <label class="form-label">Id</label>
                    </div>
                    <div class="help-info">Id Program Studi</div>
                  </div>
                  <div class="form-group form-float">
                    <div class="form-line">
                      <input type="text" class="form-control" name="tahunakademik" pattern="[0-9]{13,16}" maxlength="200" minlength="3" required value="<?php echo $tahun ?>">
                      <label class="form-label">Tahun</label>
                    </div>
                    <div class="help-info">Tahun akademik</div>
                  </div>
                  <div class="form-group form-float">
                    <div class="form-line">
                      <input type="radio" name="semester" id="radio_ganjil" class="radio-col-indigo" value="GANJIL" <?php echo ($semester=="GANJIL")?" checked":"" ?>>
                      <label for="radio_ganjil">GANJIL</label>
                      <input type="radio" name="semester" id="radio_genap" class="radio-col-indigo" value="GENAP"  <?php echo ($semester=="GENAP")?" checked":"" ?>>
                      <label for="radio_genap">GENAP</label>
                    </div>
                    <div class="help-info">Semester</div>
                  </div>
                  <div class="form-group form-float">
                    <div class="form-line">
                      <input type="text" class="form-control" name="singkatan" maxlength="3" minlength="3" required value="<?php echo $singkatan ?>">
                      <label class="form-label">Singkatan</label>
                    </div>
                    <div class="help-info">Singkatan Program Studi, minimal 3 karakter</div>
                  </div>
                  <button class="btn bg-indigo btn-circle waves-effect waves-circle waves-float pull-right" type="submit" name="simpan" >
                    <i class="material-icons">save</i>
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php
  }
}

?>
<script src="plugins/jquery-validation/jquery.validate.js"></script>
<script src="assets/js/pages/tahunakademik.js"></script>
