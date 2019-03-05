<?php
class Speciality{
    //connections to the database
    private $conn;
    private $tableName;

    //Table attirbutes
    public $speciality_ID;
    public $Spec_Name;
    public $description;

    public function __construct($db){
        $this->connection = $db;
    }
}
?>