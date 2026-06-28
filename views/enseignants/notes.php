<?php

session_start();

if(
    !isset($_SESSION['id']) ||
    $_SESSION['role'] !== 'enseignant'
){
    header('Location: ../../index.php');
    exit();
}

include '../layouts/header.php';
include '../layouts/sidebar_enseignants.php';

?>
 <link rel="stylesheet" href="../../assets/css/note_enseignant.css">
<div class="main-content">

    <div class="topbar">

        <h2>Note etudiant</h2>

        <div class="user">
            Bonjour <?= $_SESSION['prenom']; ?>
        </div>

    </div>

  <div class="content">

    <div class="page-header">
        <div>
            <h2>Gestion des notes</h2>
            <p>Ajoutez, modifiez et consultez les notes des étudiants.</p>
        </div>

        <button class="btn-add" id="btnAddNote">
            <i class="fas fa-plus"></i>
            Ajouter une note
        </button>
    </div>


    <div class="toolbar">

        <div class="search-box">
            <i class="fas fa-search"></i>

            <input
                type="text"
                id="searchInput"
                placeholder="Rechercher un étudiant..."
            >
        </div>

    </div>



    <div class="table-container">

        <table id="notesTable">

            <thead>

            <tr>

                <th>Étudiant</th>

                <th>Matière</th>

                <th>Note</th>

                <th>Semestre</th>

                <th>Actions</th>

            </tr>

            </thead>


            <tbody>

            <tr>

                <td>Amadou Diallo</td>

                <td>Mathématiques</td>

                <td>16/20</td>

                <td>S1</td>

                <td>

                    <button class="edit-btn">

                        <i class="fas fa-edit"></i>

                    </button>

                    <button class="delete-btn">

                        <i class="fas fa-trash"></i>

                    </button>

                </td>

            </tr>


            <tr>

                <td>Fatou Ndiaye</td>

                <td>Français</td>

                <td>18/20</td>

                <td>S1</td>

                <td>

                    <button class="edit-btn">

                        <i class="fas fa-edit"></i>

                    </button>

                    <button class="delete-btn">

                        <i class="fas fa-trash"></i>

                    </button>

                </td>

            </tr>


            <tr>

                <td>Moussa Fall</td>

                <td>Physique</td>

                <td>14/20</td>

                <td>S2</td>

                <td>

                    <button class="edit-btn">

                        <i class="fas fa-edit"></i>

                    </button>

                    <button class="delete-btn">

                        <i class="fas fa-trash"></i>

                    </button>

                </td>

            </tr>

            </tbody>

        </table>

    </div>

</div>



<!-- ================= MODAL ================= -->

<div class="modal" id="noteModal">

    <div class="modal-content">

        <div class="modal-header">

            <h3>Ajouter une note</h3>

            <span class="close" id="closeModal">&times;</span>

        </div>


        <form id="noteForm">

            <div class="form-group">

                <label>Étudiant</label>

                <input
                    type="text"
                    id="student"
                    placeholder="Nom de l'étudiant"
                    required
                >

            </div>


            <div class="form-group">

                <label>Matière</label>

                <input
                    type="text"
                    id="subject"
                    placeholder="Nom de la matière"
                    required
                >

            </div>


            <div class="form-group">

                <label>Note</label>

                <input
                    type="number"
                    id="grade"
                    min="0"
                    max="20"
                    placeholder="0 à 20"
                    required
                >

            </div>


            <div class="form-group">

                <label>Semestre</label>

                <select id="semester">

                    <option>S1</option>

                    <option>S2</option>

                </select>

            </div>


            <div class="modal-buttons">

                <button
                    type="button"
                    class="btn-cancel"
                    id="cancelBtn"
                >
                    Annuler
                </button>

                <button
                    type="submit"
                    class="btn-save"
                >
                    Enregistrer
                </button>

            </div>

        </form>

    </div>

</div>



</div>
<script src="../../assets/js/note_enseignant.js"></script>
<?php include '../layouts/footer.php'; ?>
