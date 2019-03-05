<?php
class UserStatus{
    //connections to the database
    private $conn;
    private $tableName;

    //Table attirbutes
    public $Status_id;
    public $stauts_name;
    public $status_type;
    public $describtion;

    public function __construct($db){
        $this->connection = $db;
    }
}
?>