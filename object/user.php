<?php

class User
{
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
        $query = 'SELECT * FROM USERS WHERE UserName= ' . $this->UserName . ' ';

        $stmt = $this->conn->prepare($query);

        $stmt->execute();
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
        $this->FName = htmlspecialchars(strip_tags($this->FName));
        $this->LName = htmlspecialchars(strip_tags($this->LName));
        $this->Hashed_pw = htmlspecialchars(strip_tags($this->Hashed_pw));
        $this->UserName = htmlspecialchars(strip_tags($this->UserName));
        $this->Email = htmlspecialchars(strip_tags($this->Email));
        $this->Reg_Date = htmlspecialchars(strip_tags($this->Reg_Date));
        $this->type_ID = htmlspecialchars(strip_tags($this->type_ID));
        $this->status_ID = htmlspecialchars(strip_tags($this->status_ID));


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
        $query = 'SELECT Hashed_pw FROM USERS WHERE UserName = '. $this->UserName .'';

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_OBJ);

        echo $row;

        return password_verify($password, $this->Hashed_pw) ? True : False;

    }

}

?>
