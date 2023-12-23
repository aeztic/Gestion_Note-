<?php
include("../../back-end/classes/connection.php");
include("../../back-end/classes/etudiant.php");
$connection1 = new Connection();
$connection1->selectDatabase('project'); 


if (isset($_REQUEST['search'])) {

    $valueToSearch = $_REQUEST['valueToSearch'];

    if($valueToSearch !== ""){
        $notesEtudiant = Etudiant::getNotesForEtudiant($valueToSearch , $connection1->conn); 
        header('Location: test.php');
    }
// exit();
}

?>