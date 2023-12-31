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
    <link rel="stylesheet" href="../css/analytics.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <title>Admin Dashboard school</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<body>
    <?php 
    include("newNav.php");
    ?>

    <section class="home-section">
        <div class="text">Analytics</div>


        <div class="analytics">
            <canvas id="groupPieChart" width="300" height="300"></canvas>
        </div>

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
                    position: 'center',
                    labels: {
                        fontSize: 12, // Adjust font size as needed
                    },
                },
            },
        });
    });
    </script>
</body>

</html>