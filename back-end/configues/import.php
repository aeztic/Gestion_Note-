<?php

include_once("../../back-end/classes/connection.php");
$connection = new Connection();
$connection->selectDatabase('project');
include_once('../../back-end/classes/etudiant.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['csvFile']) && $_FILES['csvFile']['error'] == UPLOAD_ERR_OK) {
        // Get the uploaded CSV file
        $csvFile = $_FILES['csvFile']['tmp_name'];

        // Read the CSV content
        $csvData = file_get_contents($csvFile);

        // Parse CSV data and insert into the database
        insertCSVData($csvData, $connection->conn);
    } else {
        echo "Error uploading the CSV file.";
    }
}

function insertCSVData($csvData, $dbConnection)
{
    // Parse CSV data (assuming it's comma-separated)
    $rows = explode("\n", $csvData);

    foreach ($rows as $row) {
        $rowData = str_getcsv($row);

        // Use the $rowData array to insert into the database
        // Modify this part based on your database structure
        $idGrp = $rowData[0];
        $firstname = $rowData[1];
        $lastname = $rowData[2];
        $email = $rowData[3];
        $password = password_hash($rowData[4], PASSWORD_DEFAULT);
        $phoneNumber = $rowData[5];

        // Use the Etudiant class method to insert into the database
        $etudiant = new Etudiant( $firstname, $lastname, $email, $password, $phoneNumber ,$idGrp);
        $etudiant->insertEtudiant("Etudiant",$dbConnection);
    }
}
?>