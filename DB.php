<?php 

include("connection.php");
$conn = new Connection ();

$conn->createDatabase("project");
$conn->selectDatabase("project");

$query = "
CREATE TABLE IF NOT EXISTS Etudiant (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
firstname VARCHAR(30) NOT NULL,
lastname VARCHAR(30) NOT NULL,
email VARCHAR(50) UNIQUE,
password VARCHAR(80),
reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)
";

?>