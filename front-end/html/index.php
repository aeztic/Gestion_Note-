<?php 
session_start();
include_once("../../back-end/classes/connection.php");
$connection = new Connection();
$connection->selectDatabase('project'); 
include_once('../../back-end/classes/etudiant.php');
$students = Etudiant::selectAllEtudiants('Etudiant',$connection->conn);

if (isset($_POST['search'])) {

    $valueToSearch = $_POST['valueToSearch'];

    if($valueToSearch !== ""){
        $notesEtudiant = Etudiant::getNotesForEtudiant($valueToSearch , $connection->conn); 
        
            header("Location: preview.php?id=$valueToSearch"); 
            $valueToSearch = ""; 
        
// exit();
}
}
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
    <link rel="stylesheet" href="../css/analytics.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <title>Admin Dashboard school</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>

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

        <div class="analytics">
            <canvas id="groupPieChart" width="300" height="300"></canvas>
        </div>
        <div class="import-export">


            <button class="noselect custom-button1" onclick="importCSV()">
                <span class="text-button">Import</span>
                <span class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        style="fill: rgba(255, 255, 255, 1);">
                        <path d="m12 18 4-5h-3V2h-2v11H8z"></path>
                        <path
                            d="M19 9h-4v2h4v9H5v-9h4V9H5c-1.103 0-2 .897-2 2v9c0 1.103.897 2 2 2h14c1.103 0 2-.897 2-2v-9c0-1.103-.897-2-2-2z">
                        </path>
                    </svg>
                </span>
            </button>


            <button class="noselect custom-button2"><span class="text-button">Export</span><span class="icon"><svg
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        style="fill: rgba(255, 255, 255, 1);">
                        <path d="M11 16h2V7h3l-4-5-4 5h3z"></path>
                        <path
                            d="M5 22h14c1.103 0 2-.897 2-2v-9c0-1.103-.897-2-2-2h-4v2h4v9H5v-9h4V9H5c-1.103 0-2 .897-2 2v9c0 1.103.897 2 2 2z">
                        </path>
                    </svg></span></button>


            <a href="addStudents.php">
                <button class="noselect custom-button3"><span class="text-button">Add
                        student</span><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);">
                            <path d="M19 11h-6V5h-2v6H5v2h6v6h2v-6h6z"></path>
                        </svg></span></button>
            </a>

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
                                        <a ' href='preview.php?id=$student[id]'>
                                            <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' style='fill: rgba(49, 48, 77, 1);'>
                                    <path
                                        d='M14 12c-1.095 0-2-.905-2-2 0-.354.103-.683.268-.973C12.178 9.02 12.092 9 12 9a3.02 3.02 0 0 0-3 3c0 1.642 1.358 3 3 3 1.641 0 3-1.358 3-3 0-.092-.02-.178-.027-.268-.29.165-.619.268-.973.268z'>
                                    </path>
                                    <path
                                        d='M12 5c-7.633 0-9.927 6.617-9.948 6.684L1.946 12l.105.316C2.073 12.383 4.367 19 12 19s9.927-6.617 9.948-6.684l.106-.316-.105-.316C21.927 11.617 19.633 5 12 5zm0 12c-5.351 0-7.424-3.846-7.926-5C4.578 10.842 6.652 7 12 7c5.351 0 7.424 3.846 7.926 5-.504 1.158-2.578 5-7.926 5z'>
                                    </path>
                                            </svg>
                                        </a>
                                        <a ' href='delete.php?id=$student[id]'>
                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' style='fill: rgba(252, 0, 0, 1);;'>
                                            <path
                                                d='m16.192 6.344-4.243 4.242-4.242-4.242-1.414 1.414L10.535 12l-4.242 4.242 1.414 1.414 4.242-4.242 4.243 4.242 1.414-1.414L13.364 12l4.242-4.242z'>
                                            </path>
                                        </svg>
                                        </a>
                    </a>

                    </td>
                    </tr>";
                    }
                    }
                    ?>
                <tbody>
            </table>
        </div>
        <div class="import-export">
            <button class="noselect custom-button2" onclick="downloadAsPDF()"><span
                    class="text-button">Download</span><span class="icon"><svg xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);">
                        <path d="M19 9h-4V3H9v6H5l7 8zM4 19h16v2H4z"></path>
                    </svg></span></button>
        </div>
    </section>
    </section>



    <script>
    function importCSV() {
        // Create an input element of type 'file'
        const input = document.createElement('input');
        input.type = 'file';

        // Set accept attribute to only accept CSV files
        input.accept = '.csv';

        // Add event listener for the change event
        input.addEventListener('change', handleFileSelect);

        // Trigger a click on the input element to open the file dialog
        input.click();
    }

    function handleFileSelect(event) {
        const file = event.target.files[0];

        if (file) {
            const reader = new FileReader();

            reader.onload = function(e) {
                // Parse the CSV content
                const csvContent = e.target.result;

                // You can now process the CSV content as needed
                console.log('CSV Content:', csvContent);
            };

            // Read the file as text
            reader.readAsText(file);
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Get the student data from PHP and convert it to a JavaScript array
        var students = <?php echo json_encode($students); ?>;

        // Count the number of students in each group
        var groupCounts = {};
        students.forEach(function(student) {
            if (!groupCounts.hasOwnProperty(student.idGrp)) {
                groupCounts[student.idGrp] = 0;
            }
            groupCounts[student.idGrp]++;
        });

        // Extract data for the pie chart
        var groupLabels = Object.keys(groupCounts);
        var groupData = Object.values(groupCounts);

        // Create a pie chart using Chart.js
        var ctx = document.getElementById('groupPieChart').getContext('2d');
        var groupPieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: groupLabels,
                datasets: [{
                    data: groupData,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.8)',
                        'rgba(54, 162, 235, 0.8)',
                        'rgba(255, 206, 86, 0.8)',
                        'rgba(75, 192, 192, 0.8)',
                        'rgba(153, 102, 255, 0.8)',
                        'rgba(223, 202, 255, 0.8)',
                    ],
                }],
            },
            options: {
                responsive: false,
                maintainAspectRatio: true, // Set to false to control the aspect ratio
                legend: {
                    position: 'right',
                    labels: {
                        fontSize: 12, // Adjust font size as needed
                    },
                },
            },
        });
    });



    function downloadAsPDF() {
        const table = document.querySelector('.fl-table');
        const pdfOptions = {
            margin: 10,
            filename: 'listes_etudiant.pdf',
            image: {
                type: 'jpeg',
                quality: 0.98
            },
            html2canvas: {
                scale: 2
            }
        };

        // Use html2pdf to create the PDF
        html2pdf().from(table).set(pdfOptions).save();
    }
    </script>
</body>

</html>