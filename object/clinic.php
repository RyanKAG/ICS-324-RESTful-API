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
                    SET c_id = ?,
                    profile = ?,
                    services = ?,
                    location = ?,
                    website = ?,
                    email = ?,
                    rating = ?,
                    clinic_ManID = ?,
                    status_ID = ?';

        $stmt = $this->conn->prepare($query);

        $this->sanitize();

        if($stmt->execute([
            $this->c_id,
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

    public function isUser()
    {
//        $query = 'SELECT * FROM USERS WHERE ' . !empty($this->UserName) ? "UserName=:UserName" : "Email=:Email";
        $query = 'SELECT * FROM clinic WHERE profile=? OR Email=?';
        $stmt = $this->conn->prepare($query);

        $this->sanitize();


        $stmt->execute([$this->UserName, $this->Email]);

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
}

?>
