<?php
require_once('assets/lib/connection.php');

$database = new Database();
$db = $database->getConnection();

if(isset($_POST['simpan'])){
  $pesanError=array();
  $id_tahunakademik = isset($_POST["id_tahunakademik"]) ? $_POST["id_tahunakademik"] : "";
  $id_programstudi = isset($_POST["id_programstudi"]) ? $_POST["id_programstudi"] : "";
  $jenis_kelas = isset($_POST["jenis_kelas"]) ? $_POST["jenis_kelas"] : "";
  $hari = isset($_POST["hari"]) ? $_POST["hari"] : "";
  $id_jam = isset($_POST["id_jam"]) ? $_POST["id_jam"] : "";
  $id_kelas = isset($_POST["id_kelas"]) ? $_POST["id_kelas"] : "";
  $id_matakuliah = isset($_POST["id_matakuliah"]) ? $_POST["id_matakuliah"] : "";
  $id_dosen = isset($_POST["id_dosen"]) ? $_POST["id_dosen"] : "";
  $id_pengajar = isset($_POST["id_dosen"]) ? $_POST["id_dosen"] : "";
  // $id_pengajar = isset($_POST["id_pengajar"]) ? $_POST["id_pengajar"] : "";

  if($id_tahunakademik=="")
  $pesanError[]="tahunakademik kosong";
  if($id_programstudi=="")
  $pesanError[]="programstudi kosong";
  if($jenis_kelas=="")
  $pesanError[]="jenis_kelas kosong";
  if($hari=="")
  $pesanError[]="hari kosong";
  if($id_jam=="")
  $pesanError[]="jam kosong";
  if($id_kelas=="")
  $pesanError[]="kelas kosong";
  if($id_matakuliah=="")
  $pesanError[]="matakuliah kosong";
  if($id_dosen=="")
  $pesanError[]="dosen kosong";
  if($id_pengajar=="")
  $pesanError[]="pengajar kosong";


  $id_tahunakademik=htmlspecialchars(strip_tags($id_tahunakademik));
  $id_programstudi=htmlspecialchars(strip_tags($id_programstudi));
  $jenis_kelas=htmlspecialchars(strip_tags($jenis_kelas));
  $hari=htmlspecialchars(strip_tags($hari));
  $id_jam=htmlspecialchars(strip_tags($id_jam));
  $id_kelas=htmlspecialchars(strip_tags($id_kelas));
  $id_matakuliah=htmlspecialchars(strip_tags($id_matakuliah));
  $id_dosen=htmlspecialchars(strip_tags($id_dosen));
  $id_pengajar=htmlspecialchars(strip_tags($id_pengajar));


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
    $query = "INSERT INTO kuliah (id_tahunakademik,id_programstudi,jenis_kelas,hari,id_jam,id_kelas,id_matakuliah,id_dosen,id_pengajar) VALUES (?,?,?,?,?,?,?,?,?)";
    $stmt = $db->prepare($query);

    $stmt->bindParam(1, $id_tahunakademik);
    $stmt->bindParam(2, $id_programstudi);
    $stmt->bindParam(3, $jenis_kelas);
    $stmt->bindParam(4, $hari);
    $stmt->bindParam(5, $id_jam);
    $stmt->bindParam(6, $id_kelas);
    $stmt->bindParam(7, $id_matakuliah);
    $stmt->bindParam(8, $id_dosen);
    $stmt->bindParam(9, $id_pengajar);

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
$hari = strtoupper($hari);
$id_jam = isset($_POST["id_jam"]) ? $_POST["id_jam"] : "";

$id_kelas = isset($_POST["id_kelas"]) ? $_POST["id_kelas"] : "";
$id_matakuliah = isset($_POST["id_matakuliah"]) ? $_POST["id_matakuliah"] : "";
$id_dosen = isset($_POST["id_dosen"]) ? $_POST["id_dosen"] : "";
$id_pengajar = isset($_POST["id_pengajar"]) ? $_POST["id_pengajar"] : "";

$tahunakademik = "";
$singkatan_tahun_akademik = "";
$selectQuery = "SELECT * FROM tahunakademik WHERE id=?";
$stmt = $db->prepare($selectQuery);
$stmt->bindParam(1, $id_tahunakademik);
$stmt->execute();
if($stmt->rowCount()>0){
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    extract($row);
    $tahunakademik = $tahun." ".$semester;
    $singkatan_tahun_akademik = $singkatan;
  }
}

$semester_pilih = "";
if(substr($singkatan_tahun_akademik,2)==1)
$semester_pilih = "('1','3','5','7')";
else
$semester_pilih = "('2','4','6')";

$programstudi = "";
$selectQuery = "SELECT * FROM programstudi WHERE id=?";
$stmt = $db->prepare($selectQuery);
$stmt->bindParam(1, $id_programstudi);
$stmt->execute();
if($stmt->rowCount()>0){
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    extract($row);
    $programstudi = $prodi;
  }
}

$jam = "";
$selectQuery = "SELECT * FROM jam WHERE id=?";
$stmt = $db->prepare($selectQuery);
$stmt->bindParam(1, $id_jam);
$stmt->execute();
if($stmt->rowCount()>0){
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    extract($row);
    $jam = $jam_mulai." - ".$jam_selesai;
  }
}

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
        <form id="myForm" method="POST">
          <div class="row clearfix">
            <div class="col-sm-6">
              <div class="form-group">
                <div class="form-line disabled">
                  <input type="text" class="form-control" name="singkatan" maxlength="16" minlength="2" required placeholder="<?php echo $tahunakademik ?>" disabled/>
                  <input type="hidden" name="id_tahunakademik" id="id_tahunakademik" value="<?php echo $id_tahunakademik ?>">
                  <input type="hidden" name="jenis_kelas" id="jenis_kelas" value="<?php echo $jenis_kelas ?>">
                  <input type="hidden" name="posted_hari" id="posted_hari" value="<?php echo $hari ?>">
                  <!-- <input type="hidden" name="id_jam" id="id_jam" value="<?php echo $id_jam ?>"> -->
                  <label class="form-label">Hari</label>
                </div>
                <div class="help-info">Tahun Akademik</div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <div class="form-line disabled">
                  <input type="text" class="form-control" name="singkatan" maxlength="16" minlength="2" required placeholder="<?php echo $programstudi ?>" disabled/>
                  <input type="hidden" name="id_programstudi" id="id_programstudi" value="<?php echo $id_programstudi ?>">
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
                  <input type="text" class="form-control" name="jenis_kelas" id="jenis_kelas" placeholder="<?php echo $jenis_kelas ?>" disabled/>
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
                  <input type="text" class="form-control" name="singkatan" maxlength="16" minlength="2" required placeholder="<?php echo $jam ?>" disabled/>
                  <!-- <label class="form-label">Hari</label> -->
                </div>
                <div class="help-info">Jam</div>
              </div>
            </div>
          </div>
          <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
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
                  <input type="radio" name="hari" id="radio_sabtu2" class="radio-col-indigo nonreg" value="sabtu ii"  <?php echo ($hari=="sabtu ii")?" checked":"" ?>>
                  <label for="radio_sabtu">Sabtu II</label>
                </div>
                <div class="help-info">Hari</div>
              </div>
              <div class="form-group form-float">
                <div class="form-line">
                  <select class="form-control show-tick" name="id_jam" id="id_jam">
                    <option value="">-- Pilih Jenis Kelas Dulu --</option>
                  </select>
                </div>
                <div class="help-info">Jam</div>
              </div>
              <div class="form-group form-float">
                <div class="form-line">
                  <select class="form-control show-tick" name="id_kelas" id="id_kelas" onchange="generateMatakuliah();">
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
                        <option value="<?php echo $id ?>" <?php if($id_kelas==$id) echo "selected" ?>><?php echo $nama_kelas ?></option>
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
                  <select class="form-control show-tick" name="id_matakuliah" id="id_matakuliah">

                  </select>
                </div>
                <div class="help-info">Mata Kuliah</div>
              </div>
              <div class="form-group form-float">
                <div class="form-line">
                  <select class="form-control show-tick" name="id_dosen">
                    <option value="">-- Please select --</option>
                    <?php
                    $selectQuery = "SELECT * FROM dosen ORDER BY nama";
                    $stmt = $db->prepare($selectQuery);
                    $stmt->execute();
                    if($stmt->rowCount()>0){
                      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                        extract($row);
                        ?>
                        <option value="<?php echo $id ?>" <?php if($id_dosen==$id) echo "selected" ?>><?php echo $nama ?></option>
                        <?php
                      }
                    }
                    ?>
                  </select>
                </div>
                <div class="help-info">Dosen</div>
              </div>
              <div class="form-group form-float">
                <div class="form-line">
                  <select class="form-control show-tick" name="id_pengajar">
                    <option value="">-- Please select --</option>
                    <?php
                    $selectQuery = "SELECT * FROM dosen ORDER BY nama";
                    $stmt = $db->prepare($selectQuery);
                    $stmt->execute();
                    if($stmt->rowCount()>0){
                      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                        extract($row);
                        ?>
                        <option value="<?php echo $id ?>" <?php if($id_dosen==$id) echo "selected" ?>><?php echo $nama ?></option>
                        <?php
                      }
                    }
                    ?>
                  </select>
                </div>
                <div class="help-info">Pengajar</div>
              </div>
              <button class="btn bg-indigo btn-circle waves-effect waves-circle waves-float pull-right" type="submit" name="simpan" >
                <i class="material-icons">save</i>
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="plugins/jquery-validation/jquery.validate.js"></script>
<script src="assets/js/pages/jadwal.js"></script>
