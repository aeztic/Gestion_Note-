<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    include("../../back-end/classes/connection.php");
    $connection = new Connection();
    $connection->selectDatabase('project');
    include('../../back-end/classes/etudiant.php');
    include('../../back-end/classes/groupe.php');
    include("../../back-end/classes/matiere.php");
    $id = $_GET['id'];
    $students = Etudiant::selectEtudiantById("Etudiant", $connection->conn, $id);
    $notesEtudiant = Etudiant::getNotesForEtudiant($id, $connection->conn);
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

    /* Style for the popup form */
    .popup-form {
        background: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
    }
    </style>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>

    <script>
    function editNote(noteId) {
        const noteElement = document.getElementById(`note-${noteId}`);
        const editInput = document.getElementById(`edit-input-${noteId}`);

        if (noteElement && editInput) {
            noteElement.style.display = 'none';
            editInput.style.display = 'inline-block';
            editInput.value = noteElement.innerText; // Set input value to current note text
            editInput.focus(); // Focus on the input field
        }
    }

    function saveEdit(noteId) {
        const editInput = document.getElementById(`edit-input-${noteId}`);
        const noteElement = document.getElementById(`note-${noteId}`);
        const form = document.getElementById(`edit-form-${noteId}`);

        if (editInput && noteElement && form) {
            const newNoteValue = editInput.value;
            noteElement.innerText = newNoteValue;

            editInput.style.display = 'none';
            noteElement.style.display = 'inline-block';

            // Submit the form
            form.submit();
        }
    }

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
                <!-- Your form content goes here -->
                <form>
                    <label for="note">Note:</label>
                    <textarea id="note" name="note" rows="4" cols="50"></textarea>
                    <br>
                    <button type="button" onclick="hidePopup()">Close</button>
                    <!-- You can add a submit button or additional form elements as needed -->
                </form>
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
                    if ($notesEtudiant > 0) {
                        foreach ($notesEtudiant as $note) {
                            echo "<tr>
                                <th >$note[matiere]</th>
                                <td>$note[coef]</td>
                                <td>
                                    <form id='edit-form-$note[idNote]' method='post' >
                                        <span id='note-$note[idNote]'>$note[note]</span>
                                        <input type='text' class='edit-input' name='note' value='$note[note]' />
                                        <input type='hidden' name='id' value='$note[idNote]' />
                                    </form>
                                </td>
                                <td>@mdo</td>
                                <td>
                                    <a href='javascript:void(0);' onclick='editNote($note[idNote])'>
                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' style='fill: rgba(49, 48, 77, 1);'>
                                            <path d='M19.045 7.401c.378-.378.586-.88.586-1.414s-.208-1.036-.586-1.414l-1.586-1.586c-.378-.378-.88-.586-1.414-.586s-1.036.208-1.413.585L4 13.585V18h4.413L19.045 7.401zm-3-3 1.587 1.585-1.59 1.584-1.586-1.585 1.589-1.584zM6 16v-1.585l7.04-7.018 1.586 1.586L7.587 16H6zm-2 4h16v2H4z'></path>
                                        </svg>
                                    </a>
                                    <button class='edit-button' onclick='saveEdit($note[idNote])'>Save</button>
                                </td>
                            </tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="buttons-div">
            <a href='delete.php?id=<?php echo $id?>'>
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