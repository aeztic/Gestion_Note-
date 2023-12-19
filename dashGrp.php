<?php 
session_start();
include("connection.php");
$connection = new Connection();
$connection->selectDatabase('project'); 
include('etudiant.php');
include('groupe.php');
$students = Etudiant::selectAllEtudiants('Etudiant',$connection->conn);
$groupes = Groupe::selectAllgroupes('groupe' , $connection->conn);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="dashGrp.css">
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

        <div class="dash-content1">
            <br>

            <?php 
                foreach ($groupes as $groupe){
                    echo " 
                    <a href='StudentsList.php?id=$groupe[idGrp]'>
                    <div class='card'>
                        <div class='card-img'></div>
                        <div class='card-info'>
                            <div class='card-text'>
                                <p class='text-title'>$groupe[GrpName]</p>
                            </div>
                            <div class='card-icon'>
                                
                                    
                                    <svg class='icon' viewBox='0 0 28 25'>
                                        <path d='M13.145 2.13l1.94-1.867 12.178 12-12.178 12-1.94-1.867 8.931-8.8H.737V10.93h21.339z'>
                                        </path>
                                    </svg>
                                    
                                
                            </div>
                        </div>
                    </div>
                </a> 
                    ";
                
                
                }
                ?>


        </div>
    </section>

    <body>

    </body>
    <script src="script.js"></script>
</body>

</html>