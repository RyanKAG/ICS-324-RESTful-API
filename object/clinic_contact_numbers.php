<?php
class Clinic{
    private $con;
    private $tbaleName;

    public $cNumber;
    public $clinic_id;
    public $tyoe;
    public $CCNOrder;

    public function __construct($db){
        $this->con= $db;
    }

}

?>
