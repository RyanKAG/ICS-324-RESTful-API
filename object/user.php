<?php

class User
{
    public $u_id;
    public $FName;
    public $LName;
    public $UserName;
    public $Hashed_pw;
    public $Email;
    public $Reg_Date;
    public $type_ID;
    public $status_ID;

    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function isUser()
    {
//        $query = 'SELECT * FROM USERS WHERE ' . !empty($this->UserName) ? "UserName=:UserName" : "Email=:Email";
        $query = 'SELECT * FROM USERS WHERE UserName=? OR Email=?';
        $stmt = $this->conn->prepare($query);

        $this->sanitize();


        $stmt->execute([$this->UserName, $this->Email]);

        return $stmt->rowCount() > 0 ? True : False;
    }

    public function create()
    {
        $query = 'INSERT INTO USERS 
                    SET FName=:FName, 
                        LName=:LName, 
                        Hashed_pw=:Hashed_pw,
                        UserName=:UserName,
                        Email=:Email,
                        Reg_Date=:Reg_Date,
                        Type_ID=:Type_ID,
                        status_ID=:status_ID';
        $stmt = $this->conn->prepare($query);

        //Sanitizing
        $this->sanitize();


        $stmt->bindParam(":FName", $this->FName);
        $stmt->bindParam(":LName", $this->LName);
        $stmt->bindParam(":Hashed_pw", $this->Hashed_pw);
        $stmt->bindParam(":UserName", $this->UserName);
        $stmt->bindParam(":Email", $this->Email);
        $stmt->bindParam(":Reg_Date", $this->Reg_Date);
        $stmt->bindParam(":Type_ID", $this->type_ID);
        $stmt->bindParam(":status_ID", $this->status_ID);

        if ($stmt->execute())
            return true;

        return false;
    }

    public function login($password)
    {
        $query = 'SELECT * FROM USERS WHERE UserName=? OR Email=?';

        $isLoggedIn = 1;

        $stmt = $this->conn->prepare($query);

        //Sanitize
        $this->sanitize();

        $stmt->execute([$this->UserName, $this->Email]);

        $row = $stmt->fetch(PDO::FETCH_OBJ);

        if (password_verify($password, $row->Hashed_pw)) {
            echo json_encode(array(
                "id" => (int)$row->U_ID,
                "username:" => $row->UserName,
                "fname" => $row->FName,
                "lanme" => $row->LName,
                "email" => $row->Email,
                "regDate" => $row->Reg_Date,
                "typeId" => (int)$row->Type_ID,
                'statusId' => (int)$row->status_ID));
            $query = 'UPDATE USERS SET isLoggedIn = ? WHERE UserName = ? OR Email = ?';

            $stmt = $this->conn->prepare($query);

            $stmt->execute([$isLoggedIn, $this->UserName, $this->Email]);
            return true;
        }

        return false;

    }

    public function logout()
    {
        $query = 'UPDATE USERS SET isLoggedIN = ? WHERE UserName = ? OR Email = ?';

        $stmt = $this->conn->prepare($query);

        $this->sanitize();

        return $stmt->execute([0, $this->UserName, $this->Email]) ? true : false;
    }

    private function sanitize()
    {
        $this->FName = htmlspecialchars(strip_tags($this->FName));
        $this->LName = htmlspecialchars(strip_tags($this->LName));
        $this->Hashed_pw = htmlspecialchars(strip_tags($this->Hashed_pw));
        $this->UserName = htmlspecialchars(strip_tags($this->UserName));
        $this->Email = htmlspecialchars(strip_tags($this->Email));
        $this->Reg_Date = htmlspecialchars(strip_tags($this->Reg_Date));
        $this->type_ID = htmlspecialchars(strip_tags($this->type_ID));
        $this->status_ID = htmlspecialchars(strip_tags($this->status_ID));
    }

    public function nullifyConnection(){
        $this->conn = null;
    }
}
