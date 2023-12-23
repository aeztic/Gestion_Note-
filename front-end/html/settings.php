<?php

session_start();

 include("../../front-end/html/newNav.php");
include("../../back-end/classes/user.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/settings.css">
    <title>Settings</title>
</head>
<body>
    
<section class="from_container">
<section class="container_form">

            <h1 class="h1">Settings</h1>
<form>
            <input type="text" class="fname" name="fname" placeholder="New first name" value="<?php echo $_SESSION['firstname'] ?>" disabled>
            <a for="username" href="#">Change Username</a>

            <input type="text" class="lname" name="lname" placeholder="New last name" value="<?php echo $_SESSION['lastname'] ?>" disabled>
            <a for="username" href="#">Change Username</a>

            <input type="email" class="email" name="email" placeholder="New Email">
            <a for="email" href="#">Change Email</a>

            <input type="password" class="password" name="password" placeholder="New Password">
            <a for="password" href="#">Change Password</a>

            <a href="#" class="delete" onclick="deleteAccount()">Delete Account</a>
        </form>

</section>
</section>
</body>
</html>