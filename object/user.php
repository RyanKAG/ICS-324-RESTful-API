<?php
class User{
    private $con;

    public $U_ID;
    public $FName;
    public $LName;
    public $UserName;
    public $Hashed_pw;
    public $Email;
    public $Reg_Date;
    public $type_IDs;
    public $status_ID;


    public function __construct($db){
        $this->con = $db;
    }

    public function create(){
        $query = 'INSERT INTO USER 
                    SET FName=:FName, 
                        LName=:LName, 
                        U_ID=:U_ID, 
                        Hashed_pw=:Hashed_pw,
                        UserName =:UserName,
                        Email=:Email,
                        Reg_Date=:Reg_Date,
                        type_IDs=:type_IDs,
                        status_ID=:status_IDs;';
        $stmt = $this->conn->prepare($query);

        //Sanitizing
        $this->$FName = htmlspecialchars(strip_tags($this->FName));
        $this->$LName = htmlspecialchars(strip_tags($this->LName));
        $this->$U_ID = htmlspecialchars(strip_tags($this->U_ID));
        $this->$Hashed_pw = htmlspecialchars(strip_tags($this->Hashed_pw));
        $this->$UserName = htmlspecialchars(strip_tags($this->UserName));
        $this->$Email = htmlspecialchars(strip_tags($this->Email));
        $this->$Reg_Date = htmlspecialchars(strip_tags($this->Reg_Date));
        $this->$type_IDs = htmlspecialchars(strip_tags($this->type_IDs));
        $this->$status_ID = htmlspecialchars(strip_tags($this->status_ID));
        
        $stmt->bindParam(":FName",$this->FName);
        $stmt->bindParam(":LName",$this->LName);
        $stmt->bindParam(":U_ID",$this->U_ID);
        $stmt->bindParam(":Hashed_pw",$this->Hashed_pw);
        $stmt->bindParam(":UserName",$this->UserName);
        $stmt->bindParam(":Email",$this->Email);
        $stmt->bindParam(":Reg_Date",$this->Reg_Date);
        $stmt->bindParam(":type_IDs",$this->type_IDs);
        $stmt->bindParam(":status_ID",$this->status_ID);

        if($stmt->execute())
            return true;

        return false;             
    }

}

?>
