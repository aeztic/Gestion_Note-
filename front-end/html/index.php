<?php 
session_start();
include("../../back-end/classes/connection.php");
$connection = new Connection();
$connection->selectDatabase('project'); 
include('../../back-end/classes/etudiant.php');
$students = Etudiant::selectAllEtudiants('Etudiant',$connection->conn);
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/navStyle.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <title>Admin Dashboard school</title>
</head>

<body>
    <?php 
    include("newNav.php");
    ?>

    <section class="home-section">
        <div class="text">Dashboard</div>
        <div>
            <form class="search-container">
                <input type="text" id="search-bar" placeholder="What can I help you with today?">
                <a href=""></a>
            </form>
        </div>
        <div class="table-wrapper">
            <table class="fl-table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Groupe</th>
                        <th>Email</th>
                        <th>PhoneNumber</th>
                        <th>Preview</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if ($students > 0) {
                            foreach ($students as $student) {
                                echo " <tr>
                                    <td>$student[id]</td>
                                    <td>$student[firstname]</td>
                                    <td>$student[lastname]</td>
                                    <td>$student[idGrp]</td>
                                    <td>$student[email]</td>
                                    <td>$student[phoneNumber]</td>
                                    <td>
                                        <a style='color:red;' href='preview.php?id=$student[id]'>
                                            <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' style='fill: rgba(49, 48, 77, 1);'>
                                    <path
                                        d='M14 12c-1.095 0-2-.905-2-2 0-.354.103-.683.268-.973C12.178 9.02 12.092 9 12 9a3.02 3.02 0 0 0-3 3c0 1.642 1.358 3 3 3 1.641 0 3-1.358 3-3 0-.092-.02-.178-.027-.268-.29.165-.619.268-.973.268z'>
                                    </path>
                                    <path
                                        d='M12 5c-7.633 0-9.927 6.617-9.948 6.684L1.946 12l.105.316C2.073 12.383 4.367 19 12 19s9.927-6.617 9.948-6.684l.106-.316-.105-.316C21.927 11.617 19.633 5 12 5zm0 12c-5.351 0-7.424-3.846-7.926-5C4.578 10.842 6.652 7 12 7c5.351 0 7.424 3.846 7.926 5-.504 1.158-2.578 5-7.926 5z'>
                                    </path>
                                            </svg>
                                        </a>
                                        
                                    </td>
                                </tr>";
                            }
                        }
                        ?>
                <tbody>
            </table>
        </div>
    </section>

</body>

</html>