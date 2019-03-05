<?php
class Dentist{
    private $con;
    private $tbaleName;

    public $d_id;
    public $fName;
    public $lName;
    public $profile;
    public $website;
    public $email;
    public $rating;
    public $speciality_id;
    public $clinic_id;
    public $clinic_office;
    public $clinic_num;
    public $status_id;

    public function __construct($db){
        $this->con= $db;
    }

}

?>
