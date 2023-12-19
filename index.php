<?php 
session_start();
include("connection.php");
$connection = new Connection();
$connection->selectDatabase('project'); 
include('etudiant.php');
$students = Etudiant::selectAllEtudiants('Etudiant',$connection->conn);
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="navStyle.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <title>Admin Dashboard school</title>
</head>

<body>
    <?php 
    include("NewNav.php");
    ?>

    <section class="home-section">
        <div class="text">Dashboard</div>
        <div class="table-wrapper">
            <table class="fl-table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>first name</th>
                        <th>last name</th>
                        <th>email</th>
                        <th>phoneNumber</th>
                        <th>Groupe</th>
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
                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' style='fill: rgba(0, 0, 0, 1);'>
    <path
        d='M13.707 2.293A.996.996 0 0 0 13 2H6c-1.103 0-2 .897-2 2v16c0 1.103.897 2 2 2h12c1.103 0 2-.897 2-2V9a.996.996 0 0 0-.293-.707l-6-6zM6 4h6.586L18 9.414l.002 9.174-2.568-2.568c.35-.595.566-1.281.566-2.02 0-2.206-1.794-4-4-4s-4 1.794-4 4 1.794 4 4 4c.739 0 1.425-.216 2.02-.566L16.586 20H6V4zm6 12c-1.103 0-2-.897-2-2s.897-2 2-2 2 .897 2 2-.897 2-2 2z'>
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