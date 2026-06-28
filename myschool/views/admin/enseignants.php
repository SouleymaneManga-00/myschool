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

<link rel="stylesheet" href="../../assets/css/enseignants.css">

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
        <br><br>

        <!-- MODAL -->
        <div id="teacher-modal-overlay" class="teacher-modal-overlay hidden">

            <div class="teacher-modal">

                <div class="modal-header">
                    <h2>
                        <strong><i class="fa-solid fa-chalkboard-user"></i></strong>
                    Ajouter un enseignant</h2>
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

                    <tbody id="tableBody">
                        <tr>
                            <td>1</td>
                            <td>Aliou</td>
                            <td>Fall</td>
                            <td>fall@unchk.edu.sn</td>
                            <td>776543000</td>
                            <td>Physique</td>
                            <td>
                                <span><a href="#" class="action edit"><i class="fa-solid fa-pencil"></i></a></span>
                                <br><br>
                                <span><a href="#" class="action delete"><i class="fa-solid fa-trash"></i></a></span>

                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="pagination">
                    <button><i class="fa-solid fa-angle-left"></i></button>
                    <button class="active">1</button>
                    <button>2</button>
                    <button>3</button>
                    <button><i class="fa-solid fa-angle-right"></i></button>
             </div>
            <div id="pagination" class="pagination"></div>

        </div>

    </div>
</div>

<script src="../../assets/js/enseignants.js"></script>

<?php include '../layouts/footer.php'; ?>