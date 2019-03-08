<?php
class Review{
    //connections to the database
    private $conn;
    private $tableName;

    //Table attirbutes
    public $apmID;
    public $startDate;
    public $Clinic_Rating;
    public $Review;

    public function __construct($db){
        $this->connection = $db;
    }
}
?>