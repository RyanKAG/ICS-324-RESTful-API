<?php
class UserContact{
    //connections to the database
    private $conn;
    private $tableName;

    //Table attirbutes
    public $cNumber;
    public $u_id;
    public $type;
    public $COrder;

    public function __construct($db){
        $this->connection = $db;
    }
}
?>