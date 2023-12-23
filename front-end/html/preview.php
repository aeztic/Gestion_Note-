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
    <script>
    function editNote(noteId) {
        const noteElement = document.getElementById(`note-${noteId}`);
        const editInput = document.getElementById(`edit-input-${noteId}`);

        if (noteElement && editInput) {
            noteElement.style.display = 'none';
            editInput.style.display = 'inline-block';

            editInput.addEventListener('keydown', function(event) {
                if (event.key === 'Enter') {
                    event.preventDefault();
                    saveEdit(noteId);
                }
            });
        }
    }

    function saveEdit(noteId) {
        const editInput = document.getElementById(`edit-input-${noteId}`);
        const noteElement = document.getElementById(`note-${noteId}`);

        if (editInput && noteElement) {
            const newNoteValue = editInput.value;
            noteElement.innerText = newNoteValue;

            editInput.style.display = 'none';
            noteElement.style.display = 'inline-block';

            // Submit the form
            const form = document.getElementById(`edit-form-${noteId}`);
            form.submit();
        }
    }
    </script>
</head>

<body>
    <?php
    include("newNav.php");
    ?>

    <section class="home-section">
        <div class="text"></div>

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
                                    <form id='edit-form-$note[idNote]' method='post' action='update_note.php'>
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
    </section>
</body>

</html>