<?php
class Advertisement{
    //connections to the database
    private $conn;
    private $tableName = 'advertisement';

    //Table attirbutes
    public $AD_ID;
    public $start_date;
    public $end_date;
    public $content;
    public $sysAdmin_ID;

    public function __construct($db){
        $this->conn = $db;
    }

    public function read(){
        $query = 'SELECT * FROM advertisement ';
        
        $stmt = $this->conn->prepare($query);

        $stmt->execute();
        return $stmt;
    }
}
?>