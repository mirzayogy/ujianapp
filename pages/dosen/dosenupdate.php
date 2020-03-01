<?php
require_once('assets/lib/connection.php');

$database = new Database();
$db = $database->getConnection();

if(isset($_POST['simpan'])){
  $pesanError=array();
  $id = isset($_POST["update"]) ? $_POST["update"] : "";
  $nama = isset($_POST["nama"]) ? $_POST["nama"] : "";
  $singkatan = isset($_POST["singkatan"]) ? $_POST["singkatan"] : "";
  $kontak = isset($_POST["kontak"]) ? $_POST["kontak"] : "";

  $nama=htmlspecialchars(strip_tags($nama));
  $singkatan=htmlspecialchars(strip_tags($singkatan));
  $kontak=htmlspecialchars(strip_tags($kontak));

  $database = new Database();
  $db = $database->getConnection();

  $checkQuery = "SELECT * FROM dosen WHERE nama=? AND singkatan=? AND id!=?";
  $stmt = $db->prepare($checkQuery);
  $stmt->bindParam(1, $nama);
  $stmt->bindParam(2, $singkatan);
  $stmt->bindParam(3, $id);
  $stmt->execute();
  if($stmt->rowCount()>0){
    $pesanError[] = "Data <strong>Nama dan Singkatanr</strong> sama sudah ada";
  }

  $checkQuery = "SELECT * FROM dosen WHERE singkatan=? AND id!=?";
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
    $query = "UPDATE dosen SET nama=?, kontak=?, singkatan=? WHERE id=?";
    $stmt = $db->prepare($query);

    $stmt->bindParam(1, $nama);
    $stmt->bindParam(2, $kontak);
    $stmt->bindParam(3, $singkatan);
    $stmt->bindParam(4, $id);

    if($stmt->execute()){
      ?>
      <div class="alert alert-success">
        <span><strong>Sukses!!</strong> Data berhasil disimpan</span>
      </div>
      <?php
    }else{
      ?>
      <div class="alert alert-warning">
        <span><strong>Gagal!!</strong> <?php print_r($db->errorInfo()) ?></span>
      </div>
      <?php
    }
  }
}

$id = $_POST['update'];

$selectQuery = "SELECT * FROM dosen WHERE id=?";
$stmt = $db->prepare($selectQuery);
$stmt->bindParam(1, $id);
$stmt->execute();
if($stmt->rowCount()>0){
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    extract($row);
    ?>
    <div class="block-header">
      <h2><a href="dosen">DOSEN</a> > UPDATE</h2>
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
                    <div class="help-info">Id Dosen</div>
                  </div>
                  <div class="form-group form-float">
                    <div class="form-line">
                      <input type="text" class="form-control" name="nama" pattern="[0-9]{13,16}" maxlength="200" minlength="3" required value="<?php echo $nama ?>">
                      <label class="form-label">Nama Dosen</label>
                    </div>
                    <div class="help-info">Masukkan nama tampa gelar</div>
                  </div>
                  <div class="form-group form-float">
                    <div class="form-line">
                      <input type="text" class="form-control" name="singkatan" maxlength="20" minlength="3" required value="<?php echo $singkatan ?>">
                      <label class="form-label">Singkatan</label>
                    </div>
                    <div class="help-info">Singkatan Nama</div>
                  </div>
                  <div class="form-group form-float">
                    <div class="form-line">
                      <input type="text" class="form-control" name="kontak" required value="<?php echo $kontak ?>">
                      <label class="form-label">Kontak</label>
                    </div>
                    <div class="help-info">No. HP yang bisa dihubungi</div>
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
<script src="assets/js/pages/dosen.js"></script>
