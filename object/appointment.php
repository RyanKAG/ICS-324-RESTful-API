<?php
class Appointment{
    private $conn;

    public $apm_id;
    public $apm_date;
    public $apm_type;
    public $patient_id;
    public $recept_id;
    public $dentist_id;
    public $status_id;

    public function __construct($db){
        $this->conn = $db;
    }

    public function read()
    {
        $query= 'SELECT a.apm_id, a.apm_date, a.apm_type, d.fname, d.lname, s.status_name
                    FROM appointment a
                    LEFT JOIN Dentist d ON
                      a.Dentist_ID = d.D_ID
                    LEFT JOIN user_status s ON
                    s.Status_ID = a.Apm_ID
                    WHERE a.Patient_ID = ?';

        $stmt = $this->conn->prepare($query);

        $this->sanitise();

        $stmt->execute([$this->patient_id]);
        return $stmt;
    }

    public function create()
    {
        $query = 'INSERT INTO APPOINTMENT SET 
                    apm_date=?, apm_type=?, patient_id=?, dentist_id=?, status_id=?';

        $stmt = $this->conn->prepare($query);

        if($stmt->execute([$this->apm_date, $this->apm_type,
                        $this->patient_id,$this->dentist_id, $this->status_id]))
            return true;
        return false;
    }

    private function sanitise(){
        $this->status_id = htmlspecialchars(strip_tags($this->status_id));
        $this->apm_type = htmlspecialchars(strip_tags($this->apm_type));
        $this->apm_date = htmlspecialchars(strip_tags($this->apm_date));
        $this->patient_id = htmlspecialchars(strip_tags($this->patient_id));
        $this->dentist_id = htmlspecialchars(strip_tags($this->dentist_id));
    }
}
