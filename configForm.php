<?php 
$firstNameErrorMsg = "";
$lastNameErrorMsg = "";
$emailErrorMsg = "";
$phoneErrorMsg = "";
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

    if ($firstNameErrorMsg == "" && $lastNameErrorMsg === "" && $emailErrorMsg === "" && $phoneErrorMsg === "") {
        $etudiant = new Etudiant($firstName , $lastName ,$email , "test", $phoneNum);
        $etudiant->insertEtudiant("Etudiant",$connection->conn);

        $firstName = "";
        $lastName = "";
        $email = "";
        $phoneNum = "";


        
        //exit();
    }











}











?>