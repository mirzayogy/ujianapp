<?php
require_once('assets/lib/connection.php');

$database = new Database();
$db = $database->getConnection();

if(isset($_POST['simpan'])){
  $pesanError=array();
  $semester = isset($_POST["semester"]) ? $_POST["semester"] : "";
  $program_studi = isset($_POST["program_studi"]) ? $_POST["program_studi"] : "";
  $mata_kuliah = isset($_POST["mata_kuliah"]) ? $_POST["mata_kuliah"] : "";
  $kode_mata_kuliah = isset($_POST["kode_mata_kuliah"]) ? $_POST["kode_mata_kuliah"] : "";
  $singkatan = isset($_POST["singkatan"]) ? $_POST["singkatan"] : "";

  $program_studi=htmlspecialchars(strip_tags($program_studi));
  $mata_kuliah=htmlspecialchars(strip_tags($mata_kuliah));
  $kode_mata_kuliah=htmlspecialchars(strip_tags($kode_mata_kuliah));
  $singkatan=htmlspecialchars(strip_tags($singkatan));


  $checkQuery = "SELECT * FROM matakuliah WHERE mata_kuliah=? AND id_programstudi=?";
  $stmt = $db->prepare($checkQuery);
  $stmt->bindParam(1, $mata_kuliah);
  $stmt->bindParam(2, $program_studi);
  $stmt->execute();
  if($stmt->rowCount()>0){
    $pesanError[] = "Data <strong>Mata Kuliah Prodi</strong> sama sudah ada";
  }

  $checkQuery = "SELECT * FROM matakuliah WHERE kode_mata_kuliah=?";
  $stmt = $db->prepare($checkQuery);
  $stmt->bindParam(1, $kode_mata_kuliah);
  $stmt->execute();
  if($stmt->rowCount()>0){
    $pesanError[] = "Data <strong>Kode Mata Kuliah</strong> sama sudah ada";
  }

  $checkQuery = "SELECT * FROM matakuliah WHERE singkatan=? AND id_programstudi=?";
  $stmt = $db->prepare($checkQuery);
  $stmt->bindParam(1, $singkatan);
  $stmt->bindParam(2, $program_studi);
  $stmt->execute();
  if($stmt->rowCount()>0){
    $pesanError[] = "Data <strong>singkatan di program studi</strong> sama sudah ada";
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
    $query = "INSERT INTO matakuliah (kode_mata_kuliah,mata_kuliah,singkatan,id_programstudi,semester) VALUES (?,?,?,?,?)";
    $stmt = $db->prepare($query);

    $stmt->bindParam(1, $kode_mata_kuliah);
    $stmt->bindParam(2, $mata_kuliah);
    $stmt->bindParam(3, $singkatan);
    $stmt->bindParam(4, $program_studi);
    $stmt->bindParam(5, $semester);

    if($stmt->execute()){
      ?>
      <div class="alert alert-success">
        <span><strong>Sukses!!</strong> Data berhasil disimpan</span>
      </div>
      <?php
    }
  }
}

$mata_kuliah = isset($_POST["mata_kuliah"]) ? $_POST["mata_kuliah"] : "";
$kode_mata_kuliah = isset($_POST["kode_mata_kuliah"]) ? $_POST["kode_mata_kuliah"] : "";
$program_studi = isset($_POST["program_studi"]) ? $_POST["program_studi"] : "";
$semester = isset($_POST["semester"]) ? $_POST["semester"] : "";
$singkatan = isset($_POST["singkatan"]) ? $_POST["singkatan"] : "";

?>

<div class="block-header">
  <h2><a href="matakuliah">MATA KULIAH</a> > CREATE</h2>
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
            <form id="myForm" method="POST">
              <div class="form-group form-float">
                <div class="form-line">
                  <select class="form-control show-tick" name="program_studi">
                    <option value="">-- Please select --</option>
                    <?php
                    $selectQuery = "SELECT p.id, p.prodi FROM programstudi p ORDER BY p.prodi";
                    $stmt = $db->prepare($selectQuery);
                    $stmt->execute();
                    if($stmt->rowCount()>0){
                      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                        extract($row);
                        ?>
                        <option value="<?php echo $id ?>" <?php if($program_studi==$id) echo "selected" ?>><?php echo $prodi ?></option>
                        <?php
                      }
                    }
                    ?>
                  </select>
                </div>
                <div class="help-info">Program Studi</div>
              </div>
              <div class="form-group form-float">
                <div class="form-line">
                  <input type="radio" name="semester" id="radio_1" class="radio-col-indigo" value="1" <?php echo ($semester=="1")?" checked":"" ?>>
                  <label for="radio_1">1</label>
                  <input type="radio" name="semester" id="radio_2" class="radio-col-indigo" value="2"  <?php echo ($semester=="2")?" checked":"" ?>>
                  <label for="radio_2">2</label>
                  <input type="radio" name="semester" id="radio_3" class="radio-col-indigo" value="3"  <?php echo ($semester=="3")?" checked":"" ?>>
                  <label for="radio_3">3</label>
                  <input type="radio" name="semester" id="radio_4" class="radio-col-indigo" value="4"  <?php echo ($semester=="4")?" checked":"" ?>>
                  <label for="radio_4">4</label>
                  <input type="radio" name="semester" id="radio_5" class="radio-col-indigo" value="5"  <?php echo ($semester=="5")?" checked":"" ?>>
                  <label for="radio_5">5</label>
                  <input type="radio" name="semester" id="radio_6" class="radio-col-indigo" value="6"  <?php echo ($semester=="6")?" checked":"" ?>>
                  <label for="radio_6">6</label>
                  <input type="radio" name="semester" id="radio_7" class="radio-col-indigo" value="7"  <?php echo ($semester=="7")?" checked":"" ?>>
                  <label for="radio_7">7</label>
                  <input type="radio" name="semester" id="radio_8" class="radio-col-indigo" value="8"  <?php echo ($semester=="8")?" checked":"" ?>>
                  <label for="radio_8">8</label>
                </div>
                <div class="help-info">Semester</div>
              </div>
              <div class="form-group form-float">
                <div class="form-line">
                  <input type="text" class="form-control" name="kode_mata_kuliah" maxlength="7" minlength="7" required value="<?php echo $kode_mata_kuliah ?>">
                  <label class="form-label">Kode MK</label>
                </div>
                <div class="help-info">Kode Mata Kuliah</div>
              </div>
              <div class="form-group form-float">
                <div class="form-line">
                  <input type="text" class="form-control" name="mata_kuliah" minlength="3" required value="<?php echo $mata_kuliah ?>">
                  <label class="form-label">Mata Kuliah</label>
                </div>
                <div class="help-info">Nama Mata Kuliah</div>
              </div>
              <div class="form-group form-float">
                <div class="form-line">
                  <input type="text" class="form-control" name="singkatan" maxlength="16" minlength="2" required value="<?php echo $singkatan ?>">
                  <label class="form-label">Singkatan</label>
                </div>
                <div class="help-info">Singkatan Mata Kuliah</div>
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

<script src="plugins/jquery-validation/jquery.validate.js"></script>
<script src="assets/js/pages/matakuliah.js"></script>
