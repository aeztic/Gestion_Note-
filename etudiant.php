<?php 
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
            mysqli_query($conn, $sql);
    }
    //selections des etudiants
        public static function  selectAllEtudiants($tableName,$conn){

        $sql = "SELECT id, firstname, lastname,email ,phoneNumber    FROM $tableName ";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                $data=[];
                while($row = mysqli_fetch_assoc($result)) {
                
                    $data[]=$row;
                }
                return $data;
            }
        
        }

        static function selectEtudiantById($tableName,$conn,$id){

            $sql = "SELECT firstname, lastname,email ,phoneNumber FROM $tableName  WHERE id='$id'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
            // output data of each row
            $row = mysqli_fetch_assoc($result);
            
            }
            return $row;
        }

        static function updateEtudiant($etudiant,$tableName,$conn,$id){
            
            $sql = "UPDATE $tableName SET lastname='$etudiant->lastname',firstname='$etudiant->firstname',email='$etudiant->email',phoneNumber= '$etudiant->phoneNumber' WHERE id='$id'";
                if (mysqli_query($conn, $sql)) {
                   //header("Location:read.php");
                }
        
        }

        static function deleteEtudiant($tableName,$conn,$id){
            
            $sql = "DELETE FROM $tableName WHERE id='$id'";
        
        if (mysqli_query($conn, $sql)) {
            
            //header("Location:read.php");
        }
            }


}
?>
