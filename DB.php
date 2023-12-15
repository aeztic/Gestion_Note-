<?php 

include("connection.php");
$conn = new Connection ();

$conn->createDatabase("project");

$queryGroupes = "
CREATE TABLE IF NOT EXISTS Groupe (
idGrp varchar(5) NOT NULL PRIMARY KEY,
GrpName varchar(50) NOT NULL
)
";

$queryEtudiant = "
CREATE TABLE IF NOT EXISTS Etudiant (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
firstname VARCHAR(30) NOT NULL,
lastname VARCHAR(30) NOT NULL,
email VARCHAR(50) UNIQUE,
password VARCHAR(80),
phoneNumber VARCHAR(20) UNIQUE,
reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
idGrp VARCHAR(5) NOT NULL ,
FOREIGN KEY (idGrp) REFERENCES Groupe(idGrp)

)";

$queryUsers = "
CREATE TABLE IF NOT EXISTS Users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    firsName VARCHAR(30) NOT NULL,
    email VARCHAR(50) UNIQUE,
    password VARCHAR(80),
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)
";



$conn->selectDatabase("project");
$conn->createTable($queryGroupes);
$conn->createTable($queryEtudiant);
$conn->createTable($queryUsers);

?>