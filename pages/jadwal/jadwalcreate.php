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


  $checkQuery = "SELECT * FROM matakuliah WHERE mata_kuliah=? AND id_prodi=?";
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

  $checkQuery = "SELECT * FROM matakuliah WHERE singkatan=? AND id_prodi=?";
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
    $query = "INSERT INTO matakuliah (kode_mata_kuliah,mata_kuliah,singkatan,id_prodi,semester) VALUES (?,?,?,?,?)";
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

$id_tahunakademik = isset($_POST["id_tahunakademik"]) ? $_POST["id_tahunakademik"] : "";
$id_programstudi = isset($_POST["id_programstudi"]) ? $_POST["id_programstudi"] : "";
$jenis_kelas = isset($_POST["jenis_kelas"]) ? $_POST["jenis_kelas"] : "";
$hari = isset($_POST["hari"]) ? $_POST["hari"] : "";
$jam = isset($_POST["jam"]) ? $_POST["jam"] : "";

$kelas = isset($_POST["kelas"]) ? $_POST["kelas"] : "";

?>

<div class="block-header">
  <h2><a href="matakuliah">JADWAL</a> > CREATE</h2>
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
          <div class="col-sm-6">
            <div class="form-group">
              <div class="form-line disabled">
                <input type="text" class="form-control" name="singkatan" maxlength="16" minlength="2" required placeholder="<?php echo $id_tahunakademik ?>" disabled/>
                <!-- <label class="form-label">Hari</label> -->
              </div>
              <div class="help-info">Tahun Akademik</div>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <div class="form-line disabled">
                <input type="text" class="form-control" name="singkatan" maxlength="16" minlength="2" required placeholder="<?php echo $id_programstudi ?>" disabled/>
                <!-- <label class="form-label">Hari</label> -->
              </div>
              <div class="help-info">Program Studi</div>
            </div>
          </div>
        </div>
        <div class="row clearfix">
          <div class="col-sm-4">
            <div class="form-group">
              <div class="form-line disabled">
                <input type="text" class="form-control" name="singkatan" placeholder="<?php echo $jenis_kelas ?>" disabled/>
                <!-- <label class="form-label">Jenis Kelas</label> -->
              </div>
              <div class="help-info">Jenis Kelas</div>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group">
              <div class="form-line disabled">
                <input type="text" class="form-control" name="singkatan" maxlength="16" minlength="2" required placeholder="<?php echo $hari ?>" disabled/>
                <!-- <label class="form-label">Hari</label> -->
              </div>
              <div class="help-info">Hari</div>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group">
              <div class="form-line disabled">
                <input type="text" class="form-control" name="singkatan" maxlength="16" minlength="2" required placeholder="<?php echo $hari ?>" disabled/>
                <!-- <label class="form-label">Hari</label> -->
              </div>
              <div class="help-info">Jam</div>
            </div>
          </div>
        </div>
<?php // TODO: mata kuliah filter prodi ?>
        <div class="row clearfix">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <form id="myForm" method="POST">
              <div class="form-group form-float">
                <div class="form-line">
                  <select class="form-control show-tick" name="program_studi">
                    <option value="">-- Please select --</option>
                    <?php
                    $selectQuery = "SELECT k.id, k.nama_kelas FROM kelas k WHERE id_tahunakademik=? AND id_programstudi=? AND jenis_kelas=? ORDER BY k.nama_kelas ";
                    $stmt = $db->prepare($selectQuery);
                    $stmt->bindParam(1, $id_tahunakademik);
                    $stmt->bindParam(2, $id_programstudi);
                    $stmt->bindParam(3, $jenis_kelas);
                    $stmt->execute();
                    if($stmt->rowCount()>0){
                      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                        extract($row);
                        ?>
                        <option value="<?php echo $id ?>" <?php if($kelas==$id) echo "selected" ?>><?php echo $nama_kelas ?></option>
                        <?php
                      }
                    }
                    ?>
                  </select>
                </div>
                <div class="help-info">Kelas</div>
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
