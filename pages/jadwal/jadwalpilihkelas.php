<?php
  include_once("../../assets/lib/connection.php");

  $data = json_decode(file_get_contents("php://input"));
  $id_tahunakademik = $data->id_tahunakademik;
  $id_programstudi = $data->id_programstudi;
  $jenis_kelas = $data->jenis_kelas;

  if(!empty($id_tahunakademik)){

    $database = new Database();
    $db = $database->getConnection();

    $selectQuery = "SELECT k.id, k.nama_kelas FROM kelas k WHERE id_tahunakademik=? AND id_programstudi=? AND jenis_kelas=? ORDER BY k.nama_kelas ";
    $stmt = $db->prepare($selectQuery);
    $stmt->bindParam(1, $id_tahunakademik);
    $stmt->bindParam(2, $id_programstudi);
    $stmt->bindParam(3, $jenis_kelas);
    $stmt->execute();
    $num = $stmt->rowCount();

    if($num>0){
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        echo "<option value='".$row['id']."'>".$row['nama_kelas']."</option>";
      }
    }
  }

?>
