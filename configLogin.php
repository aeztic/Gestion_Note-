<?php
include("DB.php");
include("user.php");
$emailErrorMsg ="";
$passwordErrorMsg ="" ;


if (isset($_POST['submit'])) {
    
    $emailValue = $_POST['email'];
    $passwordValue = $_POST['password'];

    
    if (empty($emailValue)) {
        $emailErrorMsg = "Email must be filled out!";
    }


    if (empty($passwordValue)) {
        $passwordErrorMsg = "Password must be filled out!";
    }

        if (empty($emailErrorMsg) && empty($passwordErrorMsg)) {
            $sql = "SELECT email , password , username FROM Users WHERE email = '$emailValue'";  
        
        //$result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result)>0){
            $row =mysqli_fetch_assoc($result);
            if (password_verify($passwordValue,$row['password'])) {
                session_start();
                $_SESSION['username'] = $row['username'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['password'] = $row['password'];
                header("Location: myDayTasks.php");
            }
            else{
                $passwordErrorMsg = "Invalid password!";    
            }
        }
        else{
            $emailErrorMsg = "Invalid email!";
        }
    


        }
}
?>