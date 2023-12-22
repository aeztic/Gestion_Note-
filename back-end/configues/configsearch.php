<?php
include("../../back-end/classes/connection.php");
//include("../../back-end/classes/etudiant.php");
//include("../../back-end/configues/DB.php");


if (isset($_POST['search'])) {
    $valueToSearch = $_POST['valueToSearch'];

    $sql = "SELECT * FROM Etudiant  WHERE id='$id'";
    $result = mysqli_query($conn, $sql);}
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
           $row = mysqli_fetch_assoc($result);
           while ($row = $result->fetch_assoc()) {
            echo "ID: " . $row["id"] . "<br>";
            echo "First Name: " . $row["firstname"] . "<br>";
            echo "Last Name: " . $row["lastname"] . "<br>";
        }
    
        }
        else{
            echo "No student found with this ID.";        }
    }
   

?>