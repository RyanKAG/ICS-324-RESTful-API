<?php
class News{
    //connections to the database
    private $conn;
    private $tableName;

    //Table attirbutes
    public $ews_id;
    public $pub_date;
    public $end_date;
    public $content;
    public $sysAdmin_id;

    public function __construct($db){
        $this->connection = $db;
    }
}
?>