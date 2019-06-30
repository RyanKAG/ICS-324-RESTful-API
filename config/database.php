<?php
Class Database
{
    private $host = 'localhost:3306';
    private $user = 'ryank_admin';
    private $pass = 'Rn212121!@#';
    private $dbName = 'ryankhal_users';
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
