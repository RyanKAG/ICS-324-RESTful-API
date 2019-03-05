<?php
class DentistContact{
    private $con;
    private $tbaleName;

    public $numbers;
    public $dentist_id;
    public $typeNAme;
    public $order;

    public function __construct($db){
        $this->con= $db;
    }

}

?>
