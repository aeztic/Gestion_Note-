<?php 
class Etudiant {
    public $id;
    public $firstname;
    public $lastname;
    public $email;
    private $password;
    public $phoneNumber;
    public $regDate;
    //foreign key dial group 
    public $idGrp;

            public function __construct($firstname, $lastname, $email, $password, $phoneNumber , $idGrp) {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_DEFAULT);
        $this->phoneNumber = $phoneNumber;
        $this->idGrp = $idGrp;
    }
        //add student form
        public function insertEtudiant($tableName ,$conn){
            $sql = "INSERT INTO $tableName (firstname, lastname, email , password, phoneNumber , idGrp ) VALUES ('$this->firstname', '$this->lastname', '$this->email' , '$this->password' , '$this->phoneNumber' , '$this->idGrp')";
            mysqli_query($conn, $sql);
    }
    //selections des etudiants
    //dashboard liste des etudiants
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
        //page preview , search bar , delete 
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

        public static function deleteEtudiant($tableName, $conn, $id) {
            
            $deleteNotesSql = "DELETE FROM note WHERE idEtudiant = '$id'";
            if (!mysqli_query($conn, $deleteNotesSql)) {
                
                echo "Error deleting related notes: " . mysqli_error($conn);
                return;
            }
    
            // Now, delete the record from the 'etudiant' table
            $deleteEtudiantSql = "DELETE FROM $tableName WHERE id = '$id'";
            if (mysqli_query($conn, $deleteEtudiantSql)) {
                header("Location:../../front-end/html/index.php");
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
                    SELECT Matiere.libelle AS matiere, Note.note , Matiere.coef , Note.idNote 
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