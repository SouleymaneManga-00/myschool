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

<link rel="stylesheet" href="../../assets/css/classe.css">

<div class="main-content">

    <div class="topbar">
        <h2>Gestion des Classes</h2>

        <div class="user">
            Bonjour <?= $_SESSION['prenom']; ?>
        </div>
    </div>

   <div class="classes-container">

    <!-- BOUTON AJOUT -->
    <div class="mat-toolbar">
        <button id="btnAddClasse" class="btn-add">
            <i class="fa-solid fa-plus"></i>
            Ajouter une nouvelle classe
        </button>
    </div>

    <!-- MODAL -->
    <div id="classeModal" class="modal">

        <div class="modal-content">

            <div class="modal-header">
                <h2>
                    <i class="fa-solid fa-school"></i>
                    Ajouter une Classe
                </h2>

                <span class="close-modal">&times;</span>
            </div>

            <form>

                <div class="form-group">
                    <label>Nom de la classe</label>
                    <input type="text" placeholder="Ex: L1 Informatique">
                </div>

                <div class="form-group">
                    <label>Niveau</label>
                    <select>
                        <option>Sélectionner</option>
                        <option>L1</option>
                        <option>L2</option>
                        <option>L3</option>
                        <option>M1</option>
                        <option>M2</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Effectif</label>
                    <input type="number" placeholder="Nombre d'étudiants">
                </div>

                <div class="modal-buttons">
                    <button type="button" id="btnCancel" class="btn-cancel">
                        Annuler
                    </button>

                    <button type="submit" class="btn-save">
                        <i class="fa-solid fa-floppy-disk"></i>
                        Enregistrer
                    </button>
                </div>

            </form>

        </div>

    </div>

    <!-- TABLEAU -->
    <div class="table-card">

        <div class="table-header">

            <h3>Liste des Classes</h3>

            <input
                type="text"
                id="searchInput"
                placeholder="Rechercher une classe..."
            >

        </div>

        <div class="table-responsive">

            <table class="classes-table">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom Classe</th>
                        <th>Niveau</th>
                        <th>Effectif</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>

                    <tr>
                        <td>1</td>
                        <td>L1 Informatique</td>
                        <td>L1</td>
                        <td>45</td>

                        <td class="table-actions">

                            <button class="action edit">
                                <i class="fa-solid fa-pen"></i>
                            </button>

                            <button class="action delete">
                                <i class="fa-solid fa-trash"></i>
                            </button>

                        </td>
                    </tr>

                    <tr>
                        <td>2</td>
                        <td>L2 Informatique</td>
                        <td>L2</td>
                        <td>38</td>

                        <td class="table-actions">

                            <button class="action edit">
                                <i class="fa-solid fa-pen"></i>
                            </button>

                            <button class="action delete">
                                <i class="fa-solid fa-trash"></i>
                            </button>

                        </td>
                    </tr>

                </tbody>

            </table>

        </div>

        <!-- Pagination -->
        <div class="pagination">

            <button>
                <i class="fa-solid fa-angle-left"></i>
            </button>

            <button class="active">1</button>
            <button>2</button>

            <button>
                <i class="fa-solid fa-angle-right"></i>

            </button>

        </div>

    </div>

</div>

<script src="../../assets/js/classe.js"></script>

<?php
include '../layouts/footer.php';
?>