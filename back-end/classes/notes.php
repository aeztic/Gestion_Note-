<?php

class Note {
    public $idNote;
    public $idEtudiant;
    public $idMatiere;
    public $note;

    public function __construct( $idEtudiant, $idMatiere, $note) {
        $this->idEtudiant = $idEtudiant;
        $this->idMatiere = $idMatiere;
        $this->note = $note;
    }

    public function insertNote($tableName, $conn) {
        $sql = "INSERT INTO $tableName (idEtudiant, idMatiere, note) VALUES ('$this->idEtudiant', '$this->idMatiere', '$this->note')";
        mysqli_query($conn, $sql);
    }

    public static function updateNote($note, $tableName, $conn, $id) {
        $sql = "UPDATE $tableName SET note='$note->note' WHERE idNote='$id'";
        
        if (mysqli_query($conn, $sql)) {
    
            // header("Location:read.php");
        } 
    }
}
    


?>