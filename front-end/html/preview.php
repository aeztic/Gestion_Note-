<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    include("../../back-end/classes/connection.php");
    include('../../back-end/classes/etudiant.php');
    include('../../back-end/classes/groupe.php');
    include('../../back-end/classes/matiere.php');
    include('../../back-end/configues/configFormNote.php');
    
    $connection = new Connection();
    $connection->selectDatabase('project');
    
    $id = $_GET['id'];
    
    // Fetch student and notes information
    $students = Etudiant::selectEtudiantById("Etudiant", $connection->conn, $id);
    $notesEtudiant = Etudiant::getNotesForEtudiant($id, $connection->conn);
    $matieres = Matiere::selectAllMatieres('Matiere', $connection->conn);
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
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <title>Your Title Here</title>
    <style>
    .edit-input {
        display: none;
        border-radius: 5px;
        color: #161A30;
        box-shadow: inset;
        padding-left: 7px;
    }

    .edit-button {
        display: none;
    }
    </style>
    <style>
    /* Style for the overlay */
    .overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        justify-content: center;
        align-items: center;
    }
    </style>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>

    <script>
    function downloadAsPDF() {
        const table = document.querySelector('.fl-table');
        const pdfOptions = {
            margin: 10,
            filename: 'table_export.pdf',
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
            <a href="#" onclick="showPopup()">
                <button class="noselect custom-button3"><span class="text-button">Add note</span><span class="icon"><svg
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            style="fill: rgba(255, 255, 255, 1);">
                            <path d="M19 11h-6V5h-2v6H5v2h6v6h2v-6h6z"></path>
                        </svg></span></button>
            </a>
        </div>

        <div class="overlay" id="overlay">
            <div class="popup-form">

                <body>
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
                                    <input name="Note-value" type="text" pattern="\d+(\.\d{1,2})?" placeholder=""
                                        value="" />
                                </div>
                                <div class="input-box" hidden>
                                    <label hidden>etudiant</label>
                                    <input name="idEtudiant" type="text" value="<?php echo $id ?>" hidden />
                                </div>
                                <span style="color: red;"><?php echo $error_message; ?></span>
                                <button name="add-student" onclick="hidePopup()">Submit</button>

                            </form>
                        </section>
                    </section>
                </body>
            </div>
        </div>

        <div class="table-wrapper">
            <table class="fl-table">
                <thead>
                    <tr>
                        <th>Matieres</th>
                        <th>coefficient</th>
                        <th>Notes</th>
                        <th>Status</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($notesEtudiant) && $notesEtudiant > 0) {
                        foreach ($notesEtudiant as $note) {
                            echo "<tr>
                                    <th >$note[matiere]</th>
                                    <td>$note[coef]</td>
                                    <td>
                                        $note[note]
                                    </td>
                                    <td><b>$note[status]</b></td>
                                    <td>
                                        <a href='?id=$note[idNote]' class='edit-note'>
                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24'
                                            style='fill: rgba(49, 48, 77, 1);'>
                                            <path
                                                d='M19.045 7.401c.378-.378.586-.88.586-1.414s-.208-1.036-.586-1.414l-1.586-1.586c-.378-.378-.88-.586-1.414-.586s-1.036.208-1.413.585L4 13.585V18h4.413L19.045 7.401zm-3-3 1.587 1.585-1.59 1.584-1.586-1.585 1.589-1.584zM6 16v-1.585l7.04-7.018 1.586 1.586L7.587 16H6zm-2 4h16v2H4z'>
                                            </path>
                                        </svg>
                                    </a>
                                
                                    </td>
                                </tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <div class="buttons-div">
            <a href='delete.php?id=<?php echo $id ?>'>
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