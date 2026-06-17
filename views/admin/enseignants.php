<?php
session_start();

if (
    !isset($_SESSION['id']) ||
    $_SESSION['role'] !== 'admin'
) {
    header('Location: ../../index.php');
    exit();
}

include '../layouts/header.php';
include '../layouts/sidebar_admin.php';
?>

<div class="main-content">

    <div class="topbar">
        <h2>Gestion des Enseignants</h2>
        <div class="user">
            Bonjour <?= $_SESSION['prenom']; ?>
        </div>
    </div>

    <div class="page-container">

        <!-- BOUTON OUVRIR MODAL -->
        <button id="showFormBtn" class="btn-primary">
            + Ajouter un enseignant
        </button>

        <!-- MODAL -->
        <div id="modalOverlay" class="modal-overlay hidden">

            <div class="modal">

                <div class="modal-header">
                    <h3>Ajouter un enseignant</h3>
                    <button id="closeModalBtn" class="close-btn">×</button>
                </div>

                <form id="teacherForm" class="form">

                    <div class="form-row">

                        <div class="form-group">
                            <label>Prénom</label>
                            <input type="text" id="prenom" required>
                        </div>

                        <div class="form-group">
                            <label>Nom</label>
                            <input type="text" id="nom" required>
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" id="email" required>
                        </div>

                        <div class="form-group">
                            <label>Téléphone</label>
                            <input type="text" id="telephone">
                        </div>

                        <div class="form-group">
                            <label>Matière</label>
                            <input type="text" id="matiere">
                        </div>

                       

                    </div>

                    <div class="form-actions">

                        <button type="submit" class="btn-primary">
                            Ajouter
                        </button>

                        <button type="button" id="cancelBtn" class="btn-delete">
                            Annuler
                        </button>

                    </div>

                </form>

            </div>
        </div>

        <!-- CARDS -->
        <div id="cardsContainer" class="cards-container"></div>

        <!-- TABLE -->
        <div class="card">

            <div class="card-header">
                <h3>Liste des enseignants</h3>
            </div>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Prénom</th>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Téléphone</th>
                            <th>Matière</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody id="tableBody"></tbody>
                </table>
            </div>

            <div id="pagination" class="pagination"></div>

        </div>

    </div>
</div>


<?php include '../layouts/footer.php'; ?>