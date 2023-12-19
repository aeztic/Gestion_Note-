<?php

if($_SERVER['REQUEST_METHOD']=='GET'){
    include("connection.php");
    $connection = new Connection();
    $connection->selectDatabase('project'); 
    include('etudiant.php');
    include('groupe.php');
    $id=$_GET['id'];
    $students = Etudiant::selectEtudiantById("etudiant",$connection->conn,$id);

}


?>

<!DOCTYPE html>
<html lang="en">

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

            <table>
                <thead>
                    <tr>
                        <th scope="col">les matieres</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Handle</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row"> matiere 1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                    </tr>
                    <tr>
                        <th scope="row">matiere 2</th>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                    </tr>
                    <tr>
                        <th scope="row">matier 3 </th>
                        <td>Larry</td>
                        <td>the Bird</td>
                        <td>@twitter</td>
                    </tr>
                    <tr>
                        <th scope="row">matiere 4</th>
                        <td>Larry</td>
                        <td>the Bird</td>
                        <td>@twitter</td>
                    </tr>
                    <tr>
                        <th scope="row">matiere 5</th>
                        <td>Larry</td>
                        <td>the Bird</td>
                        <td>@twitter</td>
                    </tr>
                </tbody>
            </table>


        </div>
    </section>
    <script src="script.js"></script>
</body>

</html>