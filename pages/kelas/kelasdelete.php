<?php
  include_once("../../assets/lib/connection.php");
  $data = json_decode(file_get_contents("php://input"));
  $id = $data->id;

  if(!empty($id)){
    $id=htmlspecialchars(strip_tags($id));

    $database = new Database();
    $db = $database->getConnection();

    $query = "DELETE FROM kelas WHERE id=?";
    $stmt = $db->prepare($query);

    $stmt->bindParam(1, $id);

    if($stmt->execute()){
      http_response_code(200);
      echo json_encode(array("message" => "Data sudah dihapus."));
    }
  }

?>
