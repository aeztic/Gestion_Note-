<?php
include("../../back-end/classes/connection.php");
include("../../back-end/classes/etudiant.php");
//include("../../back-end/configues/DB.php");


if (isset($_REQUEST['search'])) {
    $valueToSearch = $_REQUEST['valueToSearch'];

    $notesEtudiant = Etudiant::getNotesForEtudiant($valueToSearch , $connection->conn);

 header('Location: test.php');
 exit();
}

?>

