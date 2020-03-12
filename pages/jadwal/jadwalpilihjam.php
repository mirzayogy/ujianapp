<?php
  include_once("../../assets/lib/connection.php");

  // header("Access-Control-Allow-Origin:*");
  // header("Content-Type: application/json; charset=UTF-8");
  // header("Access-Control-Allow-Methods: POST");
  // header("Access-Control-Max-Age: 3600");
  // header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

  $data = json_decode(file_get_contents("php://input"));
  $jenis_kelas = $data->jenis_kelas;

  if(!empty($jenis_kelas)){
    $jenis_kelas=htmlspecialchars(strip_tags($jenis_kelas));

    $database = new Database();
    $db = $database->getConnection();

    $query = "SELECT * FROM jam WHERE jenis_kelas=? ORDER BY id";
    $stmt = $db->prepare($query);

    $stmt->bindParam(1, $jenis_kelas);
    $stmt->execute();
    $num = $stmt->rowCount();

    if($num>0){
      $jam_arr=array();
      $jam_arr["records"]=array();

      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        echo "<option value='".$row['id']."'>".$row['jam_mulai']." - ".$row['jam_selesai']."</option>";
        // extract($row);
        // $jam_item=array(
        //   "id" => $id,
        //   "jam_mulai" => $jam_mulai,
        //   "jam_selesai" => $jam_selesai
        // );
        // array_push($jam_arr["records"], $jam_item);
      }
      // http_response_code(200);
      // echo json_encode($jam_arr);
    }
  }

?>
