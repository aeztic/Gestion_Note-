<?php 
$firstNameErrorMsg = "";
$emailErrorMsg = "";
$passwordErrorMsg ="";
$cpasswordErrorMsg= "";
$pattern = '/^(?=.*[A-Za-z0-9])(?=.*[^A-Za-z0-9]).{8,}$/';

include("user.php");
include("connection.php");
$connection = new Connection();



if(isset($_POST["submit"])){
    $firstName = $_POST["firstName"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    if(empty($firstName)){
        $firstNameErrorMsg = "User must be filled out!";
    }

    if(empty($email)){
        $emailErrorMsg ="Email must be filled out!"; 
    }

    if(!preg_match($pattern, $password)){
        $passwordErrorMsg ="password must contain at least 8 characters and 1 special character!";
    }

    if($confirmPassword !== $password){
        $cpasswordErrorMsg = "Password do not match!";
    }

    if (empty($usernameErrorMsg) && empty($passwordErrorMsg) && empty($cpasswordErrorMsg) && empty($emailErrorMsg)) {
        $user = new Users($firstName , $email ,$password);
        $user-> insertUsers("project", $connection->conn);




        //header("Location: index.php");
        //exit();
    }
}


?>