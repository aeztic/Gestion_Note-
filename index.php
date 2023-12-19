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
                                        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-eye'
                                        viewBox='0 0 16 16'>
                                        <path
                                            d='M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z' />
                                        <path d='M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0' />
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