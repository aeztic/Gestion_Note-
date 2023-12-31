<?php 
$error_message = "";
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    include("../../back-end/classes/connection.php");
    
    include('../../back-end/classes/groupe.php');
    include('../../back-end/classes/matiere.php');
    
    $connection = new Connection();
    $connection->selectDatabase('project');
    
    $id = $_GET['id'];
    $matieres = Matiere::selectAllMatieres('Matiere', $connection->conn);

    

}

if(isset($_POST["add-student"])){
    $idMatiere = $_POST["matieres"];
    $idEtudiant = $id;
    $note_value = $_POST["Note-value"];

    if($idEtudiant == "" || $idMatiere == "" || $note_value == ""){
        $error_message = "all fields must be filled out";
    }

    else{
        $note = new Note($idEtudiant, $idMatiere, $note_value);
        $note->insertNote("Note" , $connection->conn);
        $note_value = '';
        $idMatiere = '';
        header("Location: preview.php?id=$idEtudiant");
        exit();
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
    <link rel="stylesheet" href="../css/form.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <title>add note</title>
</head>

<body>
    <?php
    include("newNav.php");
    ?>

    <section class="home-section">
        <div class="text"></div>
        <section class="from_container">
            <section class="container_form">
                <header>Add note</header>
                <form action="" class="form" method="post">
                    <div class="select-box">
                        <select name="matieres">
                            <option hidden>Matieres</option>
                            <?php
                                        foreach ($matieres as $matiere) {
                                            echo "<option value='$matiere[idMat]' >$matiere[libelle]</option>";
                                        }
                                        ?>
                        </select>
                    </div>
                    <div class="input-box">
                        <label>Note</label>
                        <input name="Note-value" type="text" pattern="\d+(\.\d{1,2})?" placeholder="" value="" />
                    </div>

                    <span style="color: red;"><?php echo $error_message; ?></span>
                    <button name="add-student">Submit</button>
                </form>
            </section>
        </section>
    </section>
</body>

</html>