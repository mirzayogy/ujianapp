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

$mata_kuliah = isset($_POST["mata_kuliah"]) ? $_POST["mata_kuliah"] : "";
$hari = isset($_POST["hari"]) ? $_POST["hari"] : "";
$jenis_kelas = isset($_POST["jenis_kelas"]) ? $_POST["jenis_kelas"] : "";
$kode_mata_kuliah = isset($_POST["kode_mata_kuliah"]) ? $_POST["kode_mata_kuliah"] : "";
$id_programstudi = isset($_POST["id_programstudi"]) ? $_POST["id_programstudi"] : "";
$semester = isset($_POST["semester"]) ? $_POST["semester"] : "";
$singkatan = isset($_POST["singkatan"]) ? $_POST["singkatan"] : "";

?>

<div class="block-header">
  <h2>JADWAL > FILTER</h2>
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
                  <select class="form-control show-tick" name="id_tahunakademik">
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
                  <select class="form-control show-tick" name="id_programstudi">
                    <option value="">-- Please select --</option>
                    <?php
                    $selectQuery = "SELECT p.id, p.prodi FROM programstudi p ORDER BY p.prodi";
                    $stmt = $db->prepare($selectQuery);
                    $stmt->execute();
                    if($stmt->rowCount()>0){
                      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                        extract($row);
                        ?>
                        <option value="<?php echo $id ?>" <?php if($id_programstudi==$id) echo "selected" ?>><?php echo $prodi ?></option>
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
                  <input type="radio" name="jenis_kelas" id="radio_rp" class="radio-col-indigo" value="REG PAGI" <?php echo ($jenis_kelas=="REG PAGI")?" checked":"" ?> onchange="generateJam()">
                  <label for="radio_rp">REG PAGI</label>
                  <input type="radio" name="jenis_kelas" id="radio_rm" class="radio-col-indigo" value="REG MALAM"  <?php echo ($jenis_kelas=="REG MALAM")?" checked":"" ?> onchange="generateJam()">
                  <label for="radio_rm">REG MALAM</label>
                  <input type="radio" name="jenis_kelas" id="radio_nr" class="radio-col-indigo" value="NON REG"  <?php echo ($jenis_kelas=="NON REG")?" checked":"" ?> onchange="generateJam()">
                  <label for="radio_nr">NON REG</label>
                </div>
                <div class="help-info">Jenis Kelas</div>
              </div>
              <div class="form-group form-float">
                <div class="form-line">
                  <input type="radio" name="hari" id="radio_senin" class="radio-col-indigo reg" value="senin" <?php echo ($hari=="senin")?" checked":"" ?>>
                  <label for="radio_senin">Senin</label>
                  <input type="radio" name="hari" id="radio_selasa" class="radio-col-indigo reg" value="selasa"  <?php echo ($hari=="selasa")?" checked":"" ?>>
                  <label for="radio_selasa">Selasa</label>
                  <input type="radio" name="hari" id="radio_rabu" class="radio-col-indigo reg" value="rabu"  <?php echo ($hari=="rabu")?" checked":"" ?>>
                  <label for="radio_rabu">Rabu</label>
                  <input type="radio" name="hari" id="radio_kamis" class="radio-col-indigo reg" value="kamis"  <?php echo ($hari=="kamis")?" checked":"" ?>>
                  <label for="radio_kamis">Kamis</label>
                  <input type="radio" name="hari" id="radio_jumat" class="radio-col-indigo reg" value="jumat"  <?php echo ($hari=="jumat")?" checked":"" ?>>
                  <label for="radio_jumat">Jumat</label>
                  <input type="radio" name="hari" id="radio_sabtu" class="radio-col-indigo nonreg" value="sabtu"  <?php echo ($hari=="sabtu")?" checked":"" ?>>
                  <label for="radio_sabtu">Sabtu</label>
                </div>
                <div class="help-info">Hari</div>
              </div>
              <div class="form-group form-float">
                <div class="form-line">
                  <select class="form-control show-tick" name="jam" id="jam" onchange="cekJam()">
                    <option value="">-- Pilih Jenis Kelas Dulu --</option>
                  </select>
                </div>
                <div class="help-info">Jam</div>
              </div>
              <!-- <div class="row clearfix">
                <div class="col-sm-6">
                  <div class="form-group">
                    <div class="form-line">
                      <input type="text" class="timepicker form-control" placeholder="Please choose a time..." data-dtp="dtp_B42mb" name="time1" id="time1">
                    </div>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <div class="form-line">
                      <input type="text" class="timepicker form-control" placeholder="Please choose a time..." data-dtp="dtp_B42mb" name="time2" id="time2">
                    </div>
                  </div>
                </div>
              </div> -->
              <button class="btn bg-indigo btn-circle waves-effect waves-circle waves-float pull-right" type="submit" name="simpan" >
                <i class="material-icons">navigate_next</i>
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="plugins/jquery-validation/jquery.validate.js"></script>
<script src="assets/js/pages/jadwal.js"></script>
