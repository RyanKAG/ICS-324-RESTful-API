<?php
class Appointment{
    private $conn;

    public $apm_id;
    public $apm_date;
    public $apm_type;
    public $patient_id;
    public $recept_id;
    public $dentist_id;
    public $status_id;

    public function __construct($db){
        $this->conn = $db;
    }
}

?>