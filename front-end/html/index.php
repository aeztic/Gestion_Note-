<?php 
session_start();
include_once("../../back-end/classes/connection.php");
$connection = new Connection();
$connection->selectDatabase('project'); 
include_once('../../back-end/classes/etudiant.php');
$students = Etudiant::selectAllEtudiants('Etudiant',$connection->conn);

// if (isset($_POST['search'])) {

//     $valueToSearch = $_POST['valueToSearch'];

//     if($valueToSearch !== ""){
//         $notesEtudiant = Etudiant::getNotesForEtudiant($valueToSearch , $connection->conn); 
//         if ($notesEtudiant) {
//             header("Location: preview.php?id=$valueToSearch");  
//         }
// // exit();
// }
// }
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/navStyle.css">
    <link rel="stylesheet" href="../css/search.css">
    <link rel="stylesheet" href="../css/import-export.css">
    <link rel="stylesheet" href="../css/popup.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <title>Admin Dashboard school</title>
</head>

<body>
    <?php 
    include("newNav.php");
    ?>

    <section class="home-section">
        <div class="text">Dashboard</div>
        <div>
            <form name="search" method="post" class="search-container">
                <input type="text" name="valueToSearch" id="searchInput" placeholder="Search with ID...">
                <button class="btn-search" type="submit" name="search">
                    <i class='bx bx-search'></i>
                </button>
            </form>
        </div>

        <div class="import-export">


            <button class="noselect custom-button1"><span class="text-button">Import</span><span class="icon"><svg
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        style="fill: rgba(255, 255, 255, 1);">
                        <path d="m12 18 4-5h-3V2h-2v11H8z"></path>
                        <path
                            d="M19 9h-4v2h4v9H5v-9h4V9H5c-1.103 0-2 .897-2 2v9c0 1.103.897 2 2 2h14c1.103 0 2-.897 2-2v-9c0-1.103-.897-2-2-2z">
                        </path>
                    </svg></span></button>


            <button class="noselect custom-button2"><span class="text-button">Export</span><span class="icon"><svg
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        style="fill: rgba(255, 255, 255, 1);">
                        <path d="M11 16h2V7h3l-4-5-4 5h3z"></path>
                        <path
                            d="M5 22h14c1.103 0 2-.897 2-2v-9c0-1.103-.897-2-2-2h-4v2h4v9H5v-9h4V9H5c-1.103 0-2 .897-2 2v9c0 1.103.897 2 2 2z">
                        </path>
                    </svg></span></button>


            <button onclick="showPopup()" class="noselect custom-button3"><span class="text-button">Add
                    student</span><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);">
                        <path d="M19 11h-6V5h-2v6H5v2h6v6h2v-6h6z"></path>
                    </svg></span></button>

        </div>

        <div class="overlay" id="overlay">
            <div class="popup-form">
                <!-- Your form content goes here -->
                <?php
                
                include("../../front-end/html/form.php")
                ?>
            </div>
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


    <script src="../js/popup.js"></script>
</body>

</html>