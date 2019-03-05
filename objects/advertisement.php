<?php
class Advertisment{
    //connections to the database
    private $connection;
    private $tableName;

    //Table attirbutes
    public $AD_id;
    public $start_date;
    public $end_date;
    public $content;
    public $sysAdmin_id;

    public function __construct($db){
        $this->connection = $db;
    }
}
?>