<?php
Class Database
{
    private $host = 'localhost:3307';
    private $user = 'root';
    private $pass = 'root';
    private $dbName = 'PASM';
    public $conn;
    public function getConnection(){
       try{
           $this->conn = new PDO('mysql:host='.$this->host.';dbname='.$this->dbName.'', $this->user, $this->pass);
           $this->conn->exec('SET NAMES UTF8');
       }catch(PDOException $e){
           echo 'Error' . $e->getMessage();
           die();
       }
        return $this->conn;
    }

}