<?php
class Clinic{
    private $conn;

    public $c_id;
    public $profile;
    public $services;
    public $location;
    public $website;
    public $email;
    public $rating;
    public $clinicManId;
    public $statusId;

    public function __construct($db){
        $this->conn = $db;
    }

    public function create(){
        $query= 'INSERT INTO clinic 
                    SET profile = ?,
                    services = ?,
                    location = ?,
                    website = ?,
                    email = ?,
                    rating = ?,
                    clinic_ManID = ?,
                    status_ID = ?';
        echo 2;
        $stmt = $this->conn->prepare($query);

        $this->sanitize();

        if($stmt->execute([
            $this->profile,
            $this->services,
            $this->location,
            $this->website,
            $this->email,
            $this->rating,
            $this->clinicManId,
            $this->statusId
            ]))
            return true;

        return false;
    }

    public function readAll(){
        $query= 'SELECT c.c_id, c.services, c.location,  c.email, c.website, c.rating, c.name, s.status_name 
                FROM Clinic c 
                LEFT JOIN user_status s
                    ON s.status_id = c.status_id
                ORDER BY c.rating DESC';
        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;
    }

    public function isClinic()
    {
        $query = 'SELECT * FROM clinic WHERE c_id=?';
        $stmt = $this->conn->prepare($query);

        $this->sanitize();


        $stmt->execute([$this->c_id]);

        return $stmt->rowCount() > 0 ? True : False;
    }

    private function sanitize()
    {
        $this->profile = htmlspecialchars(strip_tags($this->profile));
        $this->c_id = htmlspecialchars(strip_tags($this->c_id));
        $this->services = htmlspecialchars(strip_tags($this->services));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->website = htmlspecialchars(strip_tags($this->website));
        $this->statusId = htmlspecialchars(strip_tags($this->statusId));
        $this->clinicManId = htmlspecialchars(strip_tags($this->clinicManId));
        $this->location = htmlspecialchars(strip_tags($this->location));
        $this->rating = htmlspecialchars(strip_tags($this->rating));
    }

    public function updateStatus()
    {
        
    }
}

?>
