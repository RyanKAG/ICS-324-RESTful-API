<?php
class User{
    private $con;
    private $tbaleName;

    public $u_id;
    public $fName;
    public $lName;
    public $userName;
    public $hashed_pw;
    public $Email;
    public $reg_Date;
    public $type_id;
    public $status_id;


    public function __construct($db){
        $this->con= $db;
    }

}

?>
