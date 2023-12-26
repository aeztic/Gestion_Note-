<?php 
$error_message = "";
if(isset($_POST["add-student"])){
    $idMatiere = $_POST["matieres"];
    $idEtudiant = $_POST["idEtudiant"];
    $note_value = $_POST["Note-value"];

    if($idEtudiant == "" || $idMatiere == "" || $note_value == ""){
        $error_message = "all fields must be filled out";
    }
    else{
        $note = new Note($idEtudiant, $idMatiere, $note_value);
        $note->insertNote("Note" , $connection->conn);
        $note_value = '';
        $idMatiere = '';
        header("Location: ".$_SERVER['PHP_SELF']);
    }


}
?>