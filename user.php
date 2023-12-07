<?php 
include("connection.php");
class Users {
    private $id;
    private $firstName;
    private $email;
    private $password;
    private $regDate;

    public function __construct($firstname, $email, $password) {
        $this->firstName = $firstname;
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

        public function insertUsers($tableName ,$conn){
            $sql = "INSERT INTO $tableName (firstname, email , password) VALUES ('$this->firstName', '$this->email' , '$this->password')";
            $result = mysqli_query($conn, $sql);
    }


}
?>
