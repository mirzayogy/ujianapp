<?php
  include_once("../../assets/lib/connection.php");

  header("Access-Control-Allow-Origin:*");
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Methods: POST");
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

  $data = json_decode(file_get_contents("php://input"));
  $id_kelas = $data->id_kelas;

  if(!empty($id_kelas)){

    $database = new Database();
    $db = $database->getConnection();

    $selectQuery = "SELECT K.id,K.hari,J.jam_mulai,J.jam_selesai,M.mata_kuliah,D.nama nama_dosen,P.nama nama_pengajar,P.kontak kontak_pengajar,M.singkatan singkatan_mata_kuliah,D.singkatan singkatan_dosen,P.singkatan singkatan_pengajar FROM kuliah K
INNER JOIN jam J ON K.id_jam = J.id
INNER JOIN matakuliah M ON K.id_matakuliah = M.id
INNER JOIN dosen P ON K.id_pengajar = P.id
INNER JOIN dosen D ON K.id_dosen = D.id
WHERE K.id_kelas=? ORDER BY hari,jam_mulai";
    $stmt = $db->prepare($selectQuery);
    $stmt->bindParam(1, $id_kelas);
    $stmt->execute();
    $num = $stmt->rowCount();

    if($num>0){
      $table_array=array();
      $table_array["records"]=array();
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // echo "<option value='".$row['id']."'>".$row['nama_kelas']."</option>";
        extract($row);
        $table_item=array(
          "id" => $id,
          "hari" => $hari,
          "mata_kuliah" => $mata_kuliah,
          "nama_dosen" => $nama_dosen,
          "nama_pengajar" => $nama_pengajar,
          "kontak_pengajar" => $kontak_pengajar,
          "singkatan_mata_kuliah" => $singkatan_mata_kuliah,
          "singkatan_dosen" => $singkatan_dosen,
          "singkatan_pengajar" => $singkatan_pengajar,
          "jam_mulai" => $jam_mulai,
          "jam_selesai" => $jam_selesai
        );
        array_push($table_array["records"], $table_item);
      }
      http_response_code(200);
      echo json_encode($table_array);
    }
  }

?>
