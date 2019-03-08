<?php
class Advertisment{
    //connections to the database
    private $conn;
    private $tableName = 'advertisement';

    //Table attirbutes
    public $AD_id;
    public $start_date;
    public $end_date;
    public $content;
    public $sysAdmin_id;

    public function __construct($db){
        $this->connection = $db;
    }

    public function read(){
        $query = 'SELECT * FROM ' .$this->tableName . ' ';
        
        $stmt = $this->conn->prepare($query);

        $stmt->execute();
        return $stmt;
    }
}
?>