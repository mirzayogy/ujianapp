<?php
//OFFLINE ONLY
class Database{

    private $host = "localhost";
    private $db_name = "api_db";
    private $username = "root";
    private $password = "";
    public $conn;

    function __construct() {
        $ippengguna=$_SERVER['REMOTE_ADDR'];
        if(($ippengguna=="::1")||($ippengguna=="127.0.0.1")) {
          $this->host     ='localhost';
          $this->username = 'root';
          $this->password = '';
          $this->db_name    = 'db_ujian';
        }else{
          $this->host     ='localhost';
          $this->username = '	u713260332_twapi';
          $this->password = 'kurniawan86';
          $this->db_name    = 'u713260332_crawler';
        }
    }
    // get the database connection
    public function getConnection(){

        $this->conn = null;

        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
?>
