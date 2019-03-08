<?php
class UserType{
    //connections to the database
    private $conn;
    private $tableName;

    //Table attirbutes
    public $type_id;
    public $Entitlement;
  
    public function __construct($db){
        $this->connection = $db;
    }
}
?>