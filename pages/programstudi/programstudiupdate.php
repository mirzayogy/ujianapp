<?php
require_once('assets/lib/connection.php');

$database = new Database();
$db = $database->getConnection();

if(isset($_POST['simpan'])){
  $pesanError=array();
  $id = isset($_POST["update"]) ? $_POST["update"] : "";
  $prodi = isset($_POST["prodi"]) ? $_POST["prodi"] : "";
  $singkatan = isset($_POST["singkatan"]) ? $_POST["singkatan"] : "";

  $prodi=htmlspecialchars(strip_tags($prodi));
  $singkatan=htmlspecialchars(strip_tags($singkatan));

  $database = new Database();
  $db = $database->getConnection();

  $checkQuery = "SELECT * FROM programstudi WHERE prodi=? AND id!=?";
  $stmt = $db->prepare($checkQuery);
  $stmt->bindParam(1, $prodi);
  $stmt->bindParam(2, $id);
  $stmt->execute();
  if($stmt->rowCount()>0){
    $pesanError[] = "Data <strong>prodi</strong> sama sudah ada";
  }

  $checkQuery = "SELECT * FROM programstudi WHERE singkatan=? AND id!=?";
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
    $query = "UPDATE programstudi SET prodi=?, singkatan=? WHERE id=?";
    $stmt = $db->prepare($query);

    $stmt->bindParam(1, $prodi);
    $stmt->bindParam(2, $singkatan);
    $stmt->bindParam(3, $id);

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

$selectQuery = "SELECT * FROM programstudi WHERE id=?";
$stmt = $db->prepare($selectQuery);
$stmt->bindParam(1, $id);
$stmt->execute();
if($stmt->rowCount()>0){
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    extract($row);
    // $prodi = isset($_POST["prodi"]) ? $_POST["prodi"] : "";
    // $singkatan = isset($_POST["singkatan"]) ? $_POST["singkatan"] : "";

    ?>

    <div class="block-header">
      <h2><a href="programstudi">PROGRAM STUDI</a> > UPDATE</h2>
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
                <form id="update" method="POST">
                  <div class="form-group form-float">
                    <div class="form-line">
                      <input type="text" class="form-control" name="update" maxlength="200" minlength="3" required value="<?php echo $id ?>" readonly>
                      <label class="form-label">Id</label>
                    </div>
                    <div class="help-info">Id Program Studi</div>
                  </div>
                  <div class="form-group form-float">
                    <div class="form-line">
                      <input type="text" class="form-control" name="prodi" maxlength="200" minlength="3" required value="<?php echo $prodi ?>">
                      <label class="form-label">Program Studi</label>
                    </div>
                    <div class="help-info">Nama Program Studi</div>
                  </div>
                  <div class="form-group form-float">
                    <div class="form-line">
                      <input type="text" class="form-control" name="singkatan" maxlength="3" minlength="2" required value="<?php echo $singkatan ?>">
                      <label class="form-label">Singkatan</label>
                    </div>
                    <div class="help-info">Singkatan Program Studi, minimal 2 karakter</div>
                  </div>
                  <button class="btn bg-green btn-circle waves-effect waves-circle waves-float" type="submit" name="simpan" >
                    <i class="material-icons">save</i>
                    <!-- <span>SIMPAN</span> -->
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
<script src="assets/js/pages/programstudi.js"></script>
