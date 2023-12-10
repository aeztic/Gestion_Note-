<?php 
include("configForm.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Registration Form in HTML CSS</title>
    
    <link rel="stylesheet" href="form.css" />
</head>

<body>
    <section class="container_form">
        <header>Add student</header>
        <form action="" class="form" method="post">
            <div class="input-box">
                <label>First Name</label>
                <input name="firstname" type="text" placeholder="Enter First name"   value="<?php if(isset($firstName)) echo $firstName; ?>"/>
            </div>
            <span style="color: red;"><?php echo $firstNameErrorMsg; ?></span>
            <div class="input-box">
                <label>Last Name</label>
                <input name="lastname" type="text" placeholder="Enter Last name"  value="<?php if(isset($lastName)) echo $lastName; ?>"/>
            </div>
            <span style="color: red;"><?php echo $lastNameErrorMsg; ?></span>
            <div class="input-box">
                <label>Email Address</label>
                <input name="email" type="email" placeholder="Enter email address"  value="<?php if(isset($email)) echo $email; ?>" />
            </div>
            <span style="color: red;"><?php echo $emailErrorMsg; ?></span>
            <div class="column">
                <div class="input-box">
                    <label>Phone Number</label>
                    <input name="phone" type="number" placeholder="Enter phone number"  value="<?php if(isset($phoneNum)) echo $phoneNum; ?>"/>
                </div>
                <!-- <div class="input-box">
                    <label>Birth Date</label>
                    <input type="date" placeholder="Enter birth date"  />
                </div> -->
            </div>
            <span style="color: red;"><?php echo $phoneErrorMsg; ?></span>
            <!-- <div class="gender-box">
                <h3>Gender</h3>
                <div class="gender-option">
                    <div class="gender">
                        <input type="radio" id="check-male" name="gender" checked />
                        <label for="check-male">male</label>
                    </div>
                    <div class="gender">
                        <input type="radio" id="check-female" name="gender" />
                        <label for="check-female">Female</label>
                    </div>
                </div>
            </div> -->
            <!-- <div class="input-box address">
                <label>Address</label>
                <input type="text" placeholder="Enter street address"  />
                <input type="text" placeholder="Enter street address line 2"  />
                <div class="column">
                    <input type="text" placeholder="Enter your region"  />
                    <input type="number" placeholder="Enter postal code"  />
                </div>
            </div> -->
            <button name="submit">Submit</button>
        </form>
    </section>
</body>

</html>
