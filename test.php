<?php

if($_SERVER['REQUEST_METHOD']=='GET'){
    include("connection.php");
    $connection = new Connection();
    $connection->selectDatabase('project'); 
    include('etudiant.php');
    include('groupe.php');
    $id=$_GET['id'];
    $students = Etudiant::selectEtudiantByGrpId('Etudiant',$connection->conn ,$id);

}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
        <title>document</title>
    </head>

<body>
    <?php 
    include("nav.php");
    ?>
    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>



            <img src="2.png" alt="">
        </div>

        <div class="dash-content">


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
            if($students > 0){
                foreach($students as $student) {
            

                    echo " <tr>
                    <td>$student[id]</td>
                    <td>$student[firstname]</td>
                    <td>$student[lastname]</td>
                    <td>$student[email]</td>
                    <td>$student[phoneNumber]</td>
                    <td>$student[idGrp]</td>
                    <td>
                    <a class ='btn btn-success btn-sm' href='update.php?id=$student[id]'>edit</a>
                    <a class ='btn btn-danger btn-sm' href='delete.php?id=$student[id]'>delete</a>
                    </td>
                </tr>";
                }
                
            }
        ?>
                    <tbody>
                </table>
            </div>




        </div>
    </section>
    <script src="script.js"></script>
</body>


</html>