<?php

define("host","localhost");
define("db_name","ST40212022");
define("username", "root");
define("password", getenv('MYSQLPASS') ? getenv('MYSQLPASS') : "mysql");



class Database{
  
 
    // specify your own database credentials

    public $conn;

  
   
    // get the database connection
    public function getConnection(){
 
        $this->conn = null;
 
        try{
            $this->conn = new PDO("mysql:host=" . constant('host') . ";dbname=" . constant('db_name'), constant('username'), constant('password'));
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
 
        return $this->conn;
    }
}
?>