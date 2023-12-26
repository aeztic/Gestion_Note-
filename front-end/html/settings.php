<?php
session_start();

include("../../front-end/html/newNav.php");
include("../../back-end/classes/user.php");


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assuming you have a Users object with a method to verify the current password
    $currentPassword = $_POST['current_password'];
    $newPassword = $_POST['new_password'];
    $confirmNewPassword = $_POST['confirm_new_password'];

    // Perform validation, e.g., checking if new password matches confirmation
    if ($newPassword !== $confirmNewPassword) {
        echo "New password and confirm password do not match.";
        exit();
    }

    $user = Users::selectUserByEmail($tableName, $conn, $_SESSION['email']); // Adjust parameters as needed

    if ($user && $user instanceof Users) {
        // if ($user->verifyCurrentPassword($currentPassword)) {
        //     // Current password is correct, update the password
        //     $user->updatePassword($newPassword);

            // Assuming you have a Users object with a method to update the user
            Users::updateUser($user,$tableName,$conn,$id); // Adjust parameters as needed

            echo "Password updated successfully!";
        } else {
            echo "Current password is incorrect.";
        }
    } else {
        echo "User not found.";
    }
}



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

            <form method="post">
                <p>Username :</p>
                <input type="text" class="fname" name="fname" placeholder="New first name"
                    value="<?php echo $_SESSION['firsName'] ?>">
                <!-- <a for="username" href="#" onclick="enableField('username')">Change Username</a> -->

                <input type="email" class="email" name="email" placeholder="New Email"
                    value="<?php echo $_SESSION['email'] ?>">
                <!-- <a for="email" href="#">Change Email</a> -->

                <input type="password" class="password" name="password" placeholder="●●●●●●●●●●">
                <a for="password" href="#">Change Password</a>

                <button type="submit" class="save">Save Changes</button>
                <button type="button" class="delete" onclick="deleteAccount()">Delete Account</button>
            </form>

        </section>
    </section>





    <script>
    function enablePassword() {
        var passwordInput = document.getElementById('password');
        passwordInput.disabled = !passwordInput.disabled;
    }

    function deleteAccount() {
        // Implement your delete account functionality here
    }
    </script>

</body>

</html>

<?php
// Close the database connection
$conn->close();
?>