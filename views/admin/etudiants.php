<?php

session_start();

if (
    !isset($_SESSION['id']) ||
    $_SESSION['role'] !== 'admin'
) {
    header('Location: ../../index.php');
    exit();
}

require_once '../../controllers/EtudiantControllers.php';
require_once '../../controllers/ClasseControllers.php';

$etudiantController = new EtudiantController();
$classeController   = new ClasseController();

/*
|--------------------------------------------------------------------------
| TRAITEMENTS MVC
|--------------------------------------------------------------------------
*/

$etudiantController->handleCreate();
$etudiantController->handleUpdate();
$etudiantController->handleDelete();

/*
|--------------------------------------------------------------------------
| DONNÉES
|--------------------------------------------------------------------------
*/

$etudiants = $etudiantController->index();
$classes   = $classeController->index();

/*
|--------------------------------------------------------------------------
| MESSAGES FLASH
|--------------------------------------------------------------------------
*/

$message = $_SESSION['success'] ?? '';
$error   = $_SESSION['error'] ?? '';

unset($_SESSION['success']);
unset($_SESSION['error']);

include '../layouts/header.php';
include '../layouts/sidebar_admin.php';
?>


<link rel="stylesheet" href="../../assets/css/etudiants.css">

<div class="main-content">

<?php if($message): ?>
    <div id="flash-message" class="alert success">
        <?= htmlspecialchars($message); ?>
    </div>
<?php endif; ?>

 <?php if($error): ?>

 <small class="error-message">
<?= htmlspecialchars($error); ?>
</small>

<?php endif; ?>


<!-- formulaire d'ajout  -->

<div class="modal" id="studentModal">

    <div class="modal-content">

        <span class="close-btn">&times;</span>

        <h2>Ajouter un étudiant</h2>

        <form method="POST">

            <div class="form-group">

                <label>Prénom</label>

                <input
                    type="text"
                    name="prenom"
                    required
                >

            </div>

            <div class="form-group">

                <label>Nom</label>

                <input
                    type="text"
                    name="nom"
                    required
                >

            </div>

            <div class="form-group">

                <label>Email</label>

                <input
                    type="email"
                    name="email"
                    required
                >

            </div>

            <div class="form-group">

                <label>Mot de passe</label>

                <input
                    type="password"
                    name="mdp"
                    required
                >

            </div>

            <div class="form-group">

                <label>Classe</label>

                <select
                    name="id_classe"
                    required
                >

                    <option value="">
                        Choisir une classe
                    </option>

                     <?php foreach ($classes as $classe): ?>

                        <option value="<?= $classe['id']; ?>">

                            <?= htmlspecialchars($classe['nom']); ?>

                        </option>

                    <?php endforeach; ?>

                </select>

            </div>
                <button
                    type="submit"
                    name="add_etudiant"
                    class="btn-submit"
                >
                    Ajouter
                </button>
        </form>

    </div>

</div>


    <div class="topbar">
        <h2>Étudiants</h2>

        <div class="topbar-actions">
            <input type="text" placeholder="Rechercher..." class="search-box">

            <button class="btn-add" id="openModal">
                + Ajouter
            </button>
        </div>
    </div>

    <div class="table-card">

        <table class="students-table">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom complet</th>
                    <th>Email</th>
                    <th>Classe</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>

                <?php if (!empty($etudiants)): ?>

                    <?php foreach ($etudiants as $etudiant): ?>

                        <tr>

                            <td><?= $etudiant['id']; ?></td>

                            <td>
                                <div class="student-info">

                                    <div class="avatar">
                                        <?= strtoupper(substr($etudiant['prenom'], 0, 1)); ?>
                                    </div>

                                    <div>
                                        <strong>
                                            <?= htmlspecialchars($etudiant['prenom'] . ' ' . $etudiant['nom']); ?>
                                        </strong>
                                    </div>

                                </div>
                            </td>

                            <td><?= htmlspecialchars($etudiant['email']); ?></td>

                            <td>
                                <span class="badge">
                                    <?= htmlspecialchars($etudiant['classe']); ?>
                                </span>
                            </td>

                            <td class="actions">

                    <span>
                        <a
                            href="#"
                            class="action edit btn-edit"
                            data-id="<?= $etudiant['id']; ?>"
                            data-prenom="<?= htmlspecialchars($etudiant['prenom']); ?>"
                            data-nom="<?= htmlspecialchars($etudiant['nom']); ?>"
                            data-email="<?= htmlspecialchars($etudiant['email']); ?>"
                            data-classe="<?= $etudiant['id_classe']; ?>"
                        >
                            <i class="fa-solid fa-pencil"></i>
                        </a>
                    </span>

                    <br><br>

                    <span>
                        <a
                            href="#"
                            class="action delete btn-delete"
                            data-id="<?= $etudiant['id']; ?>"
                        >
                            <i class="fa-solid fa-trash"></i>
                        </a>
                    </span>

                </td>

                        </tr>

                    <?php endforeach; ?>

                <?php else: ?>

                    <tr>
                        <td colspan="5" class="empty">
                            Aucun étudiant trouvé.
                        </td>
                    </tr>

                <?php endif; ?>

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

<!-- Modal modifier Etudiant -->

<div class="modal" id="editModal">

    <div class="modal-content">

        <span class="close-btn">&times;</span>

        <h2>Modifier un étudiant</h2>

        <form method="POST">

            <input
                type="hidden"
                name="id"
                id="edit-id"
            >

            <div class="form-group">
                <label>Prénom</label>

                <input
                    type="text"
                    name="prenom"
                    id="edit-prenom"
                    required
                >
            </div>

            <div class="form-group">
                <label>Nom</label>

                <input
                    type="text"
                    name="nom"
                    id="edit-nom"
                    required
                >
            </div>

            <div class="form-group">
                <label>Email</label>

                <input
                    type="email"
                    name="email"
                    id="edit-email"
                    required
                >
            </div>

            <div class="form-group">

                <label>Classe</label>

                <select
                    name="id_classe"
                    id="edit-classe"
                    required
                >

                    <?php foreach($classes as $classe): ?>

                        <option value="<?= $classe['id']; ?>">

                            <?= htmlspecialchars($classe['nom']); ?>

                        </option>

                    <?php endforeach; ?>

                </select>

            </div>

            <button
                type="submit"
                name="update_etudiant"
                class="btn-submit"
            >
                Enregistrer
            </button>

        </form>

    </div>

</div>

<!-- Modal SUPPRIMER Etudiant -->

<div class="modal" id="deleteModal">

    <div class="modal-content">

        <span class="close-btn">&times;</span>

        <h2>Supprimer un étudiant</h2>

        <p>
            Êtes-vous sûr de vouloir supprimer cet étudiant ?
        </p>

        <form method="POST">

            <input
                type="hidden"
                name="id"
                id="delete-id"
            >

            <div class="delete-actions">

                <button
                    type="button"
                    class="btn-cancel"
                >
                    Annuler
                </button>

                <button
                    type="submit"
                    name="delete_etudiant"
                    class="btn-delete-confirm"
                >
                    Supprimer
                </button>

            </div>

        </form>

    </div>

</div>


<script src="../../assets/js/etudiants.js"></script>


<?php
include '../layouts/footer.php';
?>