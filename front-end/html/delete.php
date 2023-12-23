<?php

if($_SERVER['REQUEST_METHOD']=='GET'){

    $id=$_GET['id'];

    include('../../back-end/classes/connection.php');
$connection = new Connection();
$connection->selectDatabase('project');

include('../../back-end/classes/etudiant.php');
Etudiant::deleteEtudiant('Etudiant',$connection->conn,$id);





}
?>