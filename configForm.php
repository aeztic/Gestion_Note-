<?php 
$firstNameErrorMsg = "";
$lastNameErrorMsg = "";
$emailErrorMsg = "";
$phoneErrorMsg = "";
$GrpErrorMsg = "";
// $firstNameErrorMsg = "";
include("etudiant.php");
include("connection.php");
$connection = new Connection();
$connection->selectDatabase('project'); 


if(isset($_POST["submit"])){
    $firstName = $_POST["firstname"];
    $lastName = $_POST["lastname"];
    $email = $_POST["email"];
    $phoneNum = $_POST["phone"];
    $idGrp = $_POST["groupes"];

    if($firstName === ""){
        $firstNameErrorMsg = "field must be filled out";
    }
    if($lastName === ""){
        $lastNameErrorMsg = "field must be filled out";
    }
    if($email === ""){
        $emailErrorMsg = "field must be filled out";
    }
    if($phoneNum === ""){
        $phoneErrorMsg = "field must be filled out";
    }

    if($idGrp === ""){
        $GrpErrorMsg = "You must choose an option";
    }

    if ($firstNameErrorMsg == "" && $lastNameErrorMsg === "" && $emailErrorMsg === "" && $phoneErrorMsg === ""  && $GrpErrorMsg === "") {
        $etudiant = new Etudiant($firstName , $lastName ,$email , "test", $phoneNum ,$idGrp  );
        $etudiant->insertEtudiant("Etudiant",$connection->conn);

        $firstName = "";
        $lastName = "";
        $email = "";
        $phoneNum = "";


        
        //exit();
    }











}











?>