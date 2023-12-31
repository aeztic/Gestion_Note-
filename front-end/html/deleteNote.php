<?php
session_start();

$id = isset($_GET['id']) ? $_GET['id'] : null;
include('../../back-end/classes/connection.php');

$connection = new Connection();
$connection->selectDatabase('project');

include('../../back-end/classes/notes.php');

Note::deleteNote('Note',$connection->conn,$id);
header("Location: preview.php?id=" . $_SESSION["idE"]);

?>