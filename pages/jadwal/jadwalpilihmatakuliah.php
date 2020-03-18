<?php
  include_once("../../assets/lib/connection.php");

  $data = json_decode(file_get_contents("php://input"));
  $semester = $data->semester;
  $id_programstudi = $data->id_programstudi;
  $id_kelas = $data->id_kelas;

  if(!empty($semester)){
    $semester=htmlspecialchars(strip_tags($semester));

    $database = new Database();
    $db = $database->getConnection();

    $query = "SELECT * FROM matakuliah WHERE semester=? AND id_programstudi = ? ORDER BY mata_kuliah";
    $stmt = $db->prepare($query);

    $stmt->bindParam(1, $semester);
    $stmt->bindParam(2, $id_programstudi);
    $stmt->execute();
    $num = $stmt->rowCount();

    if($num>0){
      $jam_arr=array();
      $jam_arr["records"]=array();

      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        $query = "SELECT * FROM kuliah WHERE id_kelas=? AND id_matakuliah = ?";
        $stmt2 = $db->prepare($query);

        $stmt2->bindParam(1, $id_kelas);
        $stmt2->bindParam(2, $row['id']);
        $stmt2->execute();
        $num2 = $stmt2->rowCount();

        if($num2==0)
        echo "<option value='".$row['id']."'>".$row['mata_kuliah']."</option>";
      }
    }
  }

?>
