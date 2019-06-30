<?php

class Appointment
{
    private $conn;

    public $apm_id;
    public $apm_date;
    public $apm_type;
    public $patient_id;
    public $recept_id;
    public $dentist_id;
    public $status_id;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read()
    {
        $query = 'SELECT a.apm_id, a.date_time, a.apm_type, d.fname, d.lname, sp.spec_name, s.status_name, a.dentist_id
                    FROM appointment a
                    LEFT JOIN dentist d ON
                      a.Dentist_ID = d.D_ID
                    LEFT JOIN specialty sp ON
                         sp.Specialty_ID = d.Specialty_ID
                    LEFT JOIN user_status s ON
                    s.Status_ID = a.status_ID
                    WHERE a.Patient_ID = ? ORDER BY a.date_time ASC';

        $stmt = $this->conn->prepare($query);

        $this->sanitise();

        $stmt->execute([$this->patient_id]);
        return $stmt;
    }

    public function readStatus()
    {
        $query = 'SELECT a.apm_id, a.date_time, a.apm_type, d.fname, d.lname, sp.spec_name, s.status_name
                    FROM appointment a
                    LEFT JOIN dentist d ON
                      a.Dentist_ID = d.D_ID
                    LEFT JOIN specialty sp ON
                         sp.Specialty_ID = d.Specialty_ID
                    LEFT JOIN user_status s ON
                    s.Status_ID = a.status_ID
                    WHERE a.Patient_ID = ? AND a.status_id = ? ORDER BY a.date_time ASC';

        $stmt = $this->conn->prepare($query);

        $this->sanitise();

        $stmt->execute([$this->patient_id, $this->status_id]);
        return $stmt;
    }

    public function readOneStatus()
    {
        $query = 'SELECT a.apm_id, a.dentist_id ,a.date_time, a.apm_type, p.username,d.fname, d.lname, sp.spec_name, s.status_name
                    FROM appointment a
                    LEFT JOIN dentist d ON
                      a.Dentist_ID = d.D_ID
                    LEFT JOIN specialty sp ON
                         sp.Specialty_ID = d.Specialty_ID
                    LEFT JOIN user_status s ON
                        s.Status_ID = a.status_ID
                    LEFT JOIN Users p ON
                        p.U_id = a.patient_id
                    WHERE a.status_id = ? ORDER BY a.date_time ASC';

        $stmt = $this->conn->prepare($query);

        $this->sanitise();

        $stmt->execute([$this->status_id]);
        return $stmt;
    }

    public function create()
    {
        $query = 'INSERT INTO APPOINTMENT SET 
                    date_time=?, apm_type=?, Patient_ID=?, dentist_id=?, status_id=4';

        $stmt = $this->conn->prepare($query);


        if ($stmt->execute([$this->apm_date, $this->apm_type,
            $this->patient_id, $this->dentist_id]))
            return true;
        return false;
    }

    private function sanitise()
    {
        $this->status_id = htmlspecialchars(strip_tags($this->status_id));
        $this->apm_type = htmlspecialchars(strip_tags($this->apm_type));
        $this->apm_date = htmlspecialchars(strip_tags($this->apm_date));
        $this->patient_id = htmlspecialchars(strip_tags($this->patient_id));
        $this->dentist_id = htmlspecialchars(strip_tags($this->dentist_id));
    }

    public function delete()
    {
        $query = 'DELETE FROM appointment Where apm_id = ?';

        $stmt = $this->conn->prepare($query);

        $this->sanitise();

        if ($stmt->execute([$this->apm_id]))
            return true;

        return false;
    }

    public function update()
    {
        $query = 'UPDATE Appointment SET ';

        $thereIsComma = false;
        if ($this->dentist_id != null) {
            $query = $query . ' dentist_id = ' . $this->dentist_id . ' ';
            $thereIsComma = true;
        }
        if ($this->apm_date != null) {
            $query = $query . ($thereIsComma ? ' , ' : '') . ' date_time = ' . '\'' .$this->apm_date. '\'' . ' ';
            $thereIsComma = true;

        }

        if ($this->apm_type != null) {
            $query = $query . ($thereIsComma ? ' , ' : '' ). ' apm_type = ' . '\'' . $this->apm_type. '\'' . ' ';
        }
        $query = $query . ', recept_id =? WHERE apm_id = ? ';
        echo $query;
        $stmt = $this->conn->prepare($query);

        if ($stmt->execute([$this->recept_id, $this->apm_id]))
            return true;

        return false;


    }

    public function confirm()
    {
        $query = 'UPDATE Appointment SET status_id = ?, recept_id=? WHERE apm_id = ? ';

        $stmt = $this->conn->prepare($query);

        $this->sanitise();

        if ($stmt->execute([$this->status_id, $this->recept_id, $this->apm_id]))
            return true;

        return false;
    }
}
