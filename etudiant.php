<?php 
include("connection.php");
class Etudiant {
    private $id;
    private $firstName;
    private $lastName;
    private $email;
    private $password;
    private $phoneNumber;
    private $regDate;

    public function __construct($firstname, $lastname, $email, $password, $phoneNumber) {
        $this->firstName = $firstname;
        $this->lastName = $lastname;
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_DEFAULT);
        $this->phoneNumber = $phoneNumber;
    }

        public function insertEtudiant($tableName ,$conn){
            $sql = "INSERT INTO $tableName (firstname, lastname, email , password,phoneNumber) VALUES ('$this->firstName', $this->lastName', '$this->email' , '$this->password' , '$this->phoneNumber')";
            $result = mysqli_query($conn, $sql);
    }


}
?>
