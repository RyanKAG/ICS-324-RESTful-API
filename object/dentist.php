<?php
class Dentist{
    private $conn;
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
        $this->conn = $db;
    }


    public function getDentistsIn()
    {
        $query = 'SELECT d.d_id, d.fname, d.lname, d.email, d.clinic_office, s.status_name
                    FROM dentist d
                    LEFT JOIN user_status s ON s.status_id = d.status_id 
                    WHERE clinic_id = ?';

        $stmt = $this->conn->prepare($query);

        $stmt->execute([$this->clinic_id]);
        return $stmt;
    }

    public function getOrigin()
    {
        $query = 'SELECT clinic_id FROM Dentist
                    WHERE d_id = ?';

        $stmt = $this->conn->prepare($query);

        $stmt->execute([$this->d_id]);
        return $stmt;
    }

}

?>
