<?php
session_start();

if (
    !isset($_SESSION['id']) ||
    $_SESSION['role'] !== 'admin'
) {
    header('Location: ../../index.php');
    exit();
}


require_once '../../controllers/EnseignantsControllers.php';

$enseignantController = new EnseignantController();

$enseignantController->handleCreate();
$enseignantController->handleUpdate();
$enseignantController->handleDelete();

$enseignants = $enseignantController->index();

$message = $_SESSION['success'] ?? '';
$error = $_SESSION['error'] ?? '';


unset($_SESSION['success']);
unset($_SESSION['error']);


include '../layouts/header.php';
include '../layouts/sidebar_admin.php';
?>

<link rel="stylesheet" href="../../assets/css/enseignants.css">

<div class="main-content">

<?php if($message): ?>
    <div class="alert success">
        <?= $message ?>
    </div>
<?php endif; ?>

<?php if($error): ?>
    <div class="alert error">
        <?= $error ?>
    </div>
<?php endif; ?>

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

                <form id="teacherForm" class="form"  method="POST">

                    <div class="form-row">

                        <div class="form-group">
                            <label>Prénom</label>
                            <input
                                    type="text"
                                    id="prenom"
                                    name="prenom"
                                    required
                                >
                        </div>

                        <div class="form-group">
                            <label>Nom</label>
                            <input
                                    type="text"
                                    id="nom"
                                    name="enom"
                                    required
                                >
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    required
                                >
                        </div>
                        <div class="form-group">

                        <label>Mot de passe</label>

                        <input
                            type="password"
                            id="mdp"
                            name="mdp"
                            required
                        >

                        </div>

                        <div class="form-group">
                            <label>Spécialité</label>
                            <input
                                type="text"
                                id="specialite"
                                name="specialite"
                                required
                            >
                        </div>

                       

                    </div>

                    <div class="form-actions">
                        <button
                            type="submit"
                            name="add_enseignant"
                            class="btn-primary"
                        >
                            Ajouter
                        </button>

                        <button type="button" 
                        id="cancelBtn" 
                        class="btn-delete">
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
                            <th>Spécialité</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody id="tableBody">
                        <?php foreach($enseignants as $enseignant): ?>

                                <tr>

                                    <td><?= $enseignant['id']; ?></td>

                                    <td><?= htmlspecialchars($enseignant['prenom']); ?></td>

                                    <td><?= htmlspecialchars($enseignant['nom']); ?></td>

                                    <td><?= htmlspecialchars($enseignant['email']); ?></td>

                                    <td><?= htmlspecialchars($enseignant['specialite']); ?></td>
                            <td>
                                    <span>
                                    <a
                                        href="#"
                                        class="action edit btn-edit"
                                        data-id="<?= $enseignant['id']; ?>"
                                        data-prenom="<?= htmlspecialchars($enseignant['prenom']); ?>"
                                        data-nom="<?= htmlspecialchars($enseignant['nom']); ?>"
                                        data-email="<?= htmlspecialchars($enseignant['email']); ?>"
                                        data-specialite="<?= htmlspecialchars($enseignant['specialite']); ?>"
                                    >
                                        <i class="fa-solid fa-pencil"></i>
                                    </a>
                                   </span>
                                <br><br>
                                <span>
                                    <a
                                        href="#"
                                        class="action delete open-delete-modal"
                                        data-id="<?= $enseignant['id']; ?>"
                                    >
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                                </span>

                            </td>
                        </tr>
                        <?php endforeach; ?>
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

<!--modal modifier un etudiant -->

<div class="modal" id="editModal">

    <div class="modal-content">

        <span class="close-btn">&times;</span>

        <h2>Modifier un enseignant</h2>

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

                <label>Spécialité</label>

                <input
                    type="text"
                    name="specialite"
                    id="edit-specialite"
                    required
                >

            </div>

            <button
                type="submit"
                name="update_enseignant"
                class="btn-primary"
            >
                Enregistrer
            </button>

        </form>

    </div>

</div>

<!--modal supprimer un etudiant -->

<div class="modal" id="deleteModal">

    <div class="modal-content">

        <span class="close-btn">&times;</span>

        <h2>Supprimer l'enseignant</h2>

        <p>
            Êtes-vous sûr de vouloir supprimer cet enseignant ?
        </p>

        <form method="POST">

            <input
                type="hidden"
                name="id"
                id="delete-id"
            >

            <button
                type="submit"
                name="delete_enseignant"
                class="btn-supprimer"
            >
                Supprimer
            </button>

            <button
                type="button"
                class="btn-cancel"
            >
                Annuler
            </button>

        </form>

    </div>

</div>


<script src="../../assets/js/enseignants.js"></script>

<?php include '../layouts/footer.php'; ?>