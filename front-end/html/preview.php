<?php

if($_SERVER['REQUEST_METHOD']=='GET'){
    include("../../back-end/classes/connection.php");
    $connection = new Connection();
    $connection->selectDatabase('project'); 
    include('../../back-end/classes/etudiant.php');
    include('../../back-end/classes/groupe.php');
    include("../../back-end/classes/matiere.php");
    $id=$_GET['id'];
    $students = Etudiant::selectEtudiantById("Etudiant",$connection->conn,$id);
    $notesEtudiant = Etudiant::getNotesForEtudiant($id , $connection->conn);
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/navStyle.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <title>document</title>
</head>



<?php 
    include("newNav.php");
    ?>

<section class="home-section">
    <div class="text"></div>



    <div class="table-wrapper">
        <table class="fl-table">
            <thead>
                <tr>
                    <th>Matieres</th>
                    <th>coefficient</th>
                    <th>Notes</th>
                    <th>Status</th>
                    <th>Email</th>

                </tr>
            </thead>
            <tbody>
                <?php
                        if($notesEtudiant>0){
                            foreach($notesEtudiant as $note){
                                echo "<tbody>
                            <tr>
                                <th >$note[matiere]</th>
                                <td>$note[coef]</td>
                                <td>$note[note]</td>
                                <td>@mdo</td>
                                <td>
                                        <a  href='preview.php?id='>
                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' style='fill: rgba(49, 48, 77, 1);'>
                                        <path
                                            d='M19.045 7.401c.378-.378.586-.88.586-1.414s-.208-1.036-.586-1.414l-1.586-1.586c-.378-.378-.88-.586-1.414-.586s-1.036.208-1.413.585L4 13.585V18h4.413L19.045 7.401zm-3-3 1.587 1.585-1.59 1.584-1.586-1.585 1.589-1.584zM6 16v-1.585l7.04-7.018 1.586 1.586L7.587 16H6zm-2 4h16v2H4z'>
                                        </path>
                                    </svg>
                                        </a>
                                    </td>
                            </tr>";
                            }

                        }
                    ?>
            </tbody>
        </table>
    </div>


</section>


</body>

</html>