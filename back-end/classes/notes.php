<?php

class Note {
    public $idNote;
    public $idEtudiant;
    public $idMatiere;
    public $note;
    public $status;

    public function __construct( $idEtudiant, $idMatiere, $note ) {
        $this->idEtudiant = $idEtudiant;
        $this->idMatiere = $idMatiere;
        $this->note = $note;
        if( $this->note <10){
            $this->status="NV";
        }
        else{
            $this->status="V";
        }
    }

    public function insertNote($tableName, $conn) {
        $sql = "INSERT INTO $tableName (idEtudiant, idMatiere, note ,status ) VALUES ('$this->idEtudiant', '$this->idMatiere', '$this->note' , '$this->status')";
        mysqli_query($conn, $sql);
    }

    public static function updateNote($note, $tableName, $conn, $id) {
        if( $note <10){
            $status="NV";
        }
        else{
            $status="V";
        }
        $sql = "UPDATE $tableName SET note='$note->note' , status = '$status' WHERE idNote='$id'";
        
        if (mysqli_query($conn, $sql)) {
    
            // header("Location:read.php");
        } 
    }
    static function selectNoteById($tableName,$conn,$id){

    $sql = "SELECT note,status  FROM $tableName  WHERE idNote='$id' ";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
    // output data of each row
    $row = mysqli_fetch_assoc($result);
    
    }
    return $row;
}
}
  

  


?>