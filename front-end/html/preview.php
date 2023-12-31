<?php
session_start();
include("../../back-end/classes/connection.php");
include("../../back-end/classes/etudiant.php");
include("../../back-end/classes/groupe.php");
include("../../back-end/classes/matiere.php");
include("../../back-end/classes/notes.php"); 

$connection = new Connection();
$connection->selectDatabase("project");
$idEtudiant = isset($_GET['id']) ? $_GET['id'] : null;
$_SESSION["idE"] = $idEtudiant;
$noteEtudiants = Etudiant::getNotesForEtudiant($idEtudiant, $connection->conn);

if (isset($_POST["submit"])) {
    $idNote = $_POST['idNote'];
    $note = $_POST['note'];
    Note::editNote($idNote, $note, $connection->conn);
    $idNote=$note="";
    header("Location: preview.php?id=$idEtudiant");
}

if (isset($_POST["add"])) {
    $idNote = $_POST['idNote'];
    $libelle = $_POST['subjectField'];
    $coef = $_POST['coefficientField'];
    $note = $_POST['noteField'];

    Matiere::insertMatiere($connection->conn, $libelle, $coef);

    $idMatiere = mysqli_insert_id($connection->conn);

    Note::insertNote($connection->conn, $idEtudiant, $idMatiere, $note);
    $idNote=$libelle=$coef=$note="";
    header("Location: preview.php?id=$idEtudiant");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/navStyle.css">
    <link rel="stylesheet" href="../css/preview.css">
    <link rel="stylesheet" href="../css/form.css">
    <!-- <link rel="stylesheet" href="../css/popup.css"> -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <title>Your Title Here</title>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>

    <script>
    function downloadAsPDF() {
        const table = document.querySelector('.fl-table');
        const pdfOptions = {
            margin: 10,
            filename: 'note_etudiant.pdf',
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
</head>

<body>
    <?php
    include("newNav.php");
    ?>

    <section class="home-section">
        <div class="text"></div>
        <div class="buttons-div">
            <a href='addNote.php?id=<?php echo $id ?>' onclick="openPopup2()">
                <button class="noselect custom-button3"><span class="text-button">Add note</span><span class="icon"><svg
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            style="fill: rgba(255, 255, 255, 1);">
                            <path d="M19 11h-6V5h-2v6H5v2h6v6h2v-6h6z"></path>
                        </svg></span></button>
            </a>
        </div>



        <div class="table-wrapper">
            <table class="fl-table">
                <thead>
                    <tr>
                        <th>Matieres</th>
                        <th>coefficient</th>
                        <th>Notes</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if ($noteEtudiants) {
                            foreach ($noteEtudiants as $noteEtudiant) {
                                echo " <tr>      
                                        <td>{$noteEtudiant['matiere']}</td>
                                        <td>{$noteEtudiant['coef']}</td>
                                        <td>{$noteEtudiant['note']}</td>
                                        <td>
                                            <a onclick='openPopup(\"{$noteEtudiant['idNote']}\", \"{$noteEtudiant['note']}\")' >
                                            <svg xmlns='http://www.w3.org/2000/svg' width='18' height='18' viewBox='0 0 24 24' style='fill: rgba(22, 26, 48, 1);'>
                                                <path
                                                    d='M8.707 19.707 18 10.414 13.586 6l-9.293 9.293a1.003 1.003 0 0 0-.263.464L3 21l5.242-1.03c.176-.044.337-.135.465-.263zM21 7.414a2 2 0 0 0 0-2.828L19.414 3a2 2 0 0 0-2.828 0L15 4.586 19.414 9 21 7.414z'>
                                                </path>
                                            </svg>
                                            </a>

                                            <a  href='deleteNote.php?id={$noteEtudiant['idNote']}'><svg xmlns='http://www.w3.org/2000/svg' width='18' height='18' viewBox='0 0 24 24' style='fill: rgba(255, 0, 0, 1);'>
                                            <path d='M6 7H5v13a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7H6zm10.618-3L15 2H9L7.382 4H3v2h18V4z'></path>
                                        </svg></a>
                                        </td>
                                    </tr>";
                            }
                        }
                        ?>
                </tbody>
            </table>
        </div>

        <div id="editPopup" class="popup">
            <section class="from_container">
                <section class="container_form">
                    <a href="" onclick="closePopup()" class="close"><i class='bx bx-x'></i></a>
                    <header>edit note</header>
                    <form method='post' class="form">
                        <div class="input-box">
                            <input type='hidden' id='idNote' name='idNote' />
                            <label for='note'>New note :</label>
                            <input type='float' id='note' name='note' />
                        </div>
                        <button type='submit' name='submit'>Save</button>
                    </form>
                </section>
            </section>
        </div>



        <div id="addPopup" class="popup">
            <section class="from_container">
                <section class="container_form">
                    <a href="" onclick="closePopup()" class="close"><i class='bx bx-x'></i></a>
                    <header>Add student</header>
                    <form method='post' action='preview.php?id=<?php echo $idEtudiant; ?>' class="form">
                        <div class="input-box">
                            <label for='subjectField'>Matiere :</label>
                            <input type='text' id='subjectField' name='subjectField' />
                        </div>
                        <div class="input-box">
                            <label for='coefficientField'>Coefficient :</label>
                            <input type='float' id='coefficientField' name='coefficientField' />
                        </div>
                        <div class="input-box">
                            <label for='noteField'>Note :</label>
                            <input type='float' id='noteField' name='noteField' />
                        </div>
                        <button name="add">Submit</button>
                    </form>
                </section>
            </section>

        </div>

        <div class="buttons-div">
            <a href='delete.php?id=<?php echo $idEtudiant ?>'>
                <button class="noselect custom-button1"><span class="text-button">Delete</span><span class="icon"><svg
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path
                                d="M24 20.188l-8.315-8.209 8.2-8.282-3.697-3.697-8.212 8.318-8.31-8.203-3.666 3.666 8.321 8.24-8.206 8.313 3.666 3.666 8.237-8.318 8.285 8.203z">
                            </path>
                        </svg></span></button>
            </a>

            <button class="noselect custom-button2" onclick="downloadAsPDF()"><span
                    class="text-button">Download</span><span class="icon"><svg xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);">
                        <path d="M19 9h-4V3H9v6H5l7 8zM4 19h16v2H4z"></path>
                    </svg></span></button>
        </div>
    </section>

    <script src="../js/popup.js"></script>
</body>

</html>