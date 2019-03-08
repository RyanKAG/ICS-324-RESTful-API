<?php
class Clinic{
    private $con;
    private $tbaleName;

    public $c_id;
    public $profile;
    public $services;
    public $location;
    public $website;
    public $email;
    public $rating;
    public $clinic_manId;
    public $status_id;

    public function __construct($db){
        $this->con= $db;
    }

}

?>
