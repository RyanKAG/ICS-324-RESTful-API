<?php
class ClinicContactNumbers{
    private $conn;
    private $tbaleName;

    public $cNumber;
    public $clinic_id;
    public $tyoe;
    public $CCNOrder;

    public function __construct($db){
        $this->conn= $db;
    }

}

?>
