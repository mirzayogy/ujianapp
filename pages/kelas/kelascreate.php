<?php
require_once('assets/lib/connection.php');

$database = new Database();
$db = $database->getConnection();

if(isset($_POST['simpan'])){
  $pesanError=array();

  $tahun_akademik = isset($_POST["tahun_akademik"]) ? $_POST["tahun_akademik"] : "";
  $program_studi = isset($_POST["program_studi"]) ? $_POST["program_studi"] : "";
  $semester = isset($_POST["semester"]) ? $_POST["semester"] : "";
  $huruf_kelas = isset($_POST["huruf_kelas"]) ? $_POST["huruf_kelas"] : "";
  $nama_kelas = isset($_POST["nama_kelas"]) ? $_POST["nama_kelas"] : "";
  $jenis_kelas = isset($_POST["jenis_kelas"]) ? $_POST["jenis_kelas"] : "";

  $tahun_akademik=htmlspecialchars(strip_tags($tahun_akademik));
  $program_studi=htmlspecialchars(strip_tags($program_studi));
  $semester=htmlspecialchars(strip_tags($semester));
  $huruf_kelas=htmlspecialchars(strip_tags($huruf_kelas));
  $nama_kelas=htmlspecialchars(strip_tags($nama_kelas));
  $jenis_kelas=htmlspecialchars(strip_tags($jenis_kelas));

  $checkQuery = "SELECT * FROM kelas WHERE nama_kelas=?";
  $stmt = $db->prepare($checkQuery);
  $stmt->bindParam(1, $nama_kelas);
  $stmt->execute();
  if($stmt->rowCount()>0){
    $pesanError[] = "Data <strong>Nama kelas</strong> sama sudah ada";
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
    $query = "INSERT INTO kelas (id_tahunakademik,id_programstudi,jenis_kelas,semester,huruf,nama_kelas) VALUES (?,?,?,?,?,?)";
    $stmt = $db->prepare($query);

    $stmt->bindParam(1, $tahun_akademik);
    $stmt->bindParam(2, $program_studi);
    $stmt->bindParam(3, $jenis_kelas);
    $stmt->bindParam(4, $semester);
    $stmt->bindParam(5, $huruf_kelas);
    $stmt->bindParam(6, $nama_kelas);

    if($stmt->execute()){
      ?>
      <div class="alert alert-success">
        <span><strong>Sukses!!</strong> Data berhasil disimpan</span>
      </div>
      <?php
    }else{
      ?>
      <div class="alert alert-warning">
        <span><strong>Gagal!!</strong> <?php echo $nama_kelas; ?></span>
      </div>
      <?php
    }
  }
}

$tahun_akademik = isset($_POST["tahun_akademik"]) ? $_POST["tahun_akademik"] : "";
$program_studi = isset($_POST["program_studi"]) ? $_POST["program_studi"] : "";
$semester = isset($_POST["semester"]) ? $_POST["semester"] : "";
$huruf_kelas = isset($_POST["huruf_kelas"]) ? $_POST["huruf_kelas"] : "";
$nama_kelas = isset($_POST["nama_kelas"]) ? $_POST["nama_kelas"] : "GENERATED";
$jenis_kelas = isset($_POST["jenis_kelas"]) ? $_POST["jenis_kelas"] : "";

?>

<div class="block-header">
  <h2><a href="kelas">KELAS</a> > CREATE</h2>
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
                  <select class="form-control show-tick" name="tahun_akademik" id="tahun_akademik" onchange="generateNamaKelas()">
                    <option value="">-- Please select --</option>
                    <?php
                    $selectQuery = "SELECT t.id AS id_tahunakademik, t.singkatan AS singkatan_tahunakademik FROM tahunakademik t ORDER BY t.id DESC";
                    $stmt = $db->prepare($selectQuery);
                    $stmt->execute();
                    if($stmt->rowCount()>0){
                      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                        extract($row);
                        ?>
                        <option value="<?php echo $id_tahunakademik ?>" <?php if($tahun_akademik==$id_tahunakademik) echo "selected" ?>><?php echo $singkatan_tahunakademik ?></option>
                        <?php
                      }
                    }
                    ?>
                  </select>
                </div>
                <div class="help-info">Singkatan Tahun Akademik</div>
              </div>
              <div class="form-group form-float">
                <div class="form-line">
                  <select class="form-control show-tick" name="program_studi" id="program_studi" onchange="generateNamaKelas()">
                    <option value="">-- Please select --</option>
                    <?php
                    $selectQuery = "SELECT p.id AS id_programstudi, p.singkatan AS singkatan_prodi FROM programstudi p ORDER BY p.prodi";
                    $stmt = $db->prepare($selectQuery);
                    $stmt->execute();
                    if($stmt->rowCount()>0){
                      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                        extract($row);
                        ?>
                        <option value="<?php echo $id_programstudi ?>" <?php if($program_studi==$id_programstudi) echo "selected" ?>><?php echo $singkatan_prodi ?></option>
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
                  <input type="radio" name="semester" id="radio_1" class="radio-col-indigo" value="1" <?php echo ($semester=="1")?" checked":"" ?> onchange="generateNamaKelas()">
                  <label for="radio_1">1</label>
                  <input type="radio" name="semester" id="radio_2" class="radio-col-indigo" value="2"  <?php echo ($semester=="2")?" checked":"" ?> onchange="generateNamaKelas()">
                  <label for="radio_2">2</label>
                  <input type="radio" name="semester" id="radio_3" class="radio-col-indigo" value="3"  <?php echo ($semester=="3")?" checked":"" ?> onchange="generateNamaKelas()">
                  <label for="radio_3">3</label>
                  <input type="radio" name="semester" id="radio_4" class="radio-col-indigo" value="4"  <?php echo ($semester=="4")?" checked":"" ?> onchange="generateNamaKelas()">
                  <label for="radio_4">4</label>
                  <input type="radio" name="semester" id="radio_5" class="radio-col-indigo" value="5"  <?php echo ($semester=="5")?" checked":"" ?> onchange="generateNamaKelas()">
                  <label for="radio_5">5</label>
                  <input type="radio" name="semester" id="radio_6" class="radio-col-indigo" value="6"  <?php echo ($semester=="6")?" checked":"" ?> onchange="generateNamaKelas()">
                  <label for="radio_6">6</label>
                  <input type="radio" name="semester" id="radio_7" class="radio-col-indigo" value="7"  <?php echo ($semester=="7")?" checked":"" ?> onchange="generateNamaKelas()">
                  <label for="radio_7">7</label>
                  <input type="radio" name="semester" id="radio_8" class="radio-col-indigo" value="8"  <?php echo ($semester=="8")?" checked":"" ?> onchange="generateNamaKelas()">
                  <label for="radio_8">8</label>
                </div>
                <div class="help-info">Semester</div>
              </div>
              <div class="form-group form-float">
                <div class="form-line">
                  <input type="radio" name="huruf_kelas" id="radio_A" class="radio-col-indigo" value="A" <?php echo ($huruf_kelas=="A")?" checked":"" ?> onchange="generateNamaKelas()">
                  <label for="radio_A">A</label>
                  <input type="radio" name="huruf_kelas" id="radio_B" class="radio-col-indigo" value="B" <?php echo ($huruf_kelas=="B")?" checked":"" ?> onchange="generateNamaKelas()">
                  <label for="radio_B">B</label>
                  <input type="radio" name="huruf_kelas" id="radio_C" class="radio-col-indigo" value="C" <?php echo ($huruf_kelas=="C")?" checked":"" ?> onchange="generateNamaKelas()">
                  <label for="radio_C">C</label>
                  <input type="radio" name="huruf_kelas" id="radio_D" class="radio-col-indigo" value="D" <?php echo ($huruf_kelas=="D")?" checked":"" ?> onchange="generateNamaKelas()">
                  <label for="radio_D">D</label>
                  <input type="radio" name="huruf_kelas" id="radio_E" class="radio-col-indigo" value="E" <?php echo ($huruf_kelas=="E")?" checked":"" ?> onchange="generateNamaKelas()">
                  <label for="radio_E">E</label>
                  <input type="radio" name="huruf_kelas" id="radio_F" class="radio-col-indigo" value="F" <?php echo ($huruf_kelas=="F")?" checked":"" ?> onchange="generateNamaKelas()">
                  <label for="radio_F">F</label>
                  <input type="radio" name="huruf_kelas" id="radio_G" class="radio-col-indigo" value="G" <?php echo ($huruf_kelas=="G")?" checked":"" ?> onchange="generateNamaKelas()">
                  <label for="radio_G">G</label>
                  <input type="radio" name="huruf_kelas" id="radio_M" class="radio-col-indigo" value="M" <?php echo ($huruf_kelas=="M")?" checked":"" ?> onchange="generateNamaKelas()">
                  <label for="radio_M">M</label>
                </div>
                <div class="help-info">Huruf Kelas, 1 karakter</div>
              </div>
              <div class="form-group form-float">
                <div class="form-line">
                  <input type="radio" name="jenis_kelas" id="radio_rp" class="radio-col-indigo" value="REG PAGI" <?php echo ($jenis_kelas=="REG PAGI")?" checked":"" ?> onchange="generateNamaKelas()">
                  <label for="radio_rp">REG PAGI</label>
                  <input type="radio" name="jenis_kelas" id="radio_rm" class="radio-col-indigo" value="REG MALAM"  <?php echo ($jenis_kelas=="REG MALAM")?" checked":"" ?> onchange="generateNamaKelas()">
                  <label for="radio_rm">REG MALAM</label>
                  <input type="radio" name="jenis_kelas" id="radio_nr" class="radio-col-indigo" value="NON REG"  <?php echo ($jenis_kelas=="NON REG")?" checked":"" ?> onchange="generateNamaKelas()">
                  <label for="radio_nr">NON REG</label>
                </div>
                <div class="help-info">Jenis Kelas</div>
              </div>
              <div class="form-group form-float">
                <div class="form-line">
                  <input type="text" class="form-control" name="nama_kelas" id="nama_kelas" required value="<?php echo $nama_kelas ?>" readonly>
                  <label class="form-label">Nama Kelas</label>
                </div>
                <div class="help-info">Nama Kelas</div>
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
<script src="assets/js/pages/kelas.js"></script>
