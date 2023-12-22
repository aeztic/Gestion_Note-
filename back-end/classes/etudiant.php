<?php 
class Etudiant {
    public $id;
    public $firstname;
    public $lastname;
    public $email;
    private $password;
    public $phoneNumber;
    public $regDate;
    public $idGrp;

            public function __construct($firstname, $lastname, $email, $password, $phoneNumber , $idGrp) {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_DEFAULT);
        $this->phoneNumber = $phoneNumber;
        $this->idGrp = $idGrp;
    }

        public function insertEtudiant($tableName ,$conn){
            $sql = "INSERT INTO $tableName (firstname, lastname, email , password, phoneNumber , idGrp ) VALUES ('$this->firstname', '$this->lastname', '$this->email' , '$this->password' , '$this->phoneNumber' , '$this->idGrp')";
            mysqli_query($conn, $sql);
    }
    //selections des etudiants
        public static function  selectAllEtudiants($tableName,$conn){

        $sql = "SELECT id, firstname, lastname,email ,phoneNumber , idGrp   FROM $tableName ";
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

            $sql = "SELECT firstname, lastname,email ,phoneNumber ,  idGrp FROM $tableName  WHERE id='$id'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
            // output data of each row
            $row = mysqli_fetch_assoc($result);
            
            }
            return $row;
        }

        static function updateEtudiant($etudiant,$tableName,$conn,$id){
            
            $sql = "UPDATE $tableName SET lastname='$etudiant->lastname',firstname='$etudiant->firstname',email='$etudiant->email',phoneNumber= '$etudiant->phoneNumber'  , idGrp= '$etudiant->idGrp' WHERE id='$id'";
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

            public static function selectEtudiantByGrpId($tableName,$conn,$idGrp){
    
                $sql = "SELECT id, firstname, lastname, email , phoneNumber , idGrp FROM $tableName  WHERE idGrp='$idGrp'";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                // output data of each row
                $data=[];
                while($row = mysqli_fetch_assoc($result)) {
                
                    $data[]=$row;
                }
                return $data;
            }
        
            }

            public static function getNotesForEtudiant($id , $conn) {
                $etudiantId = $id;
        
                $sql = "
                    SELECT Matiere.libelle AS matiere, Note.note , Matiere.coef
                    FROM Note
                    INNER JOIN Matiere ON Note.idMatiere = Matiere.idMat
                    WHERE Note.idEtudiant = '$etudiantId'
                ";
        
                $result = $conn->query($sql);
        
                $notes = [];
        
                if ($result) {
                    while ($row = $result->fetch_assoc()) {
                        $notes[] = $row;
                    }
                }
        
                return $notes;
            }
            

}
?>