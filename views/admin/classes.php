<?php
session_start();

if (
    !isset($_SESSION['id']) ||
    $_SESSION['role'] !== 'admin'
) {
    header('Location: ../../index.php');
    exit();
}

require_once '../../controllers/ClasseControllers.php';

$classeController = new ClasseController();

$classeController->handleCreate();
$classeController->handleUpdate();
$classeController->handleDelete();

$classes = $classeController->index();

$message = $_SESSION['success'] ?? '';
$error = $_SESSION['error'] ?? '';

unset($_SESSION['success']);
unset($_SESSION['error']);


include '../layouts/header.php';
include '../layouts/sidebar_admin.php';

?>

<link rel="stylesheet" href="../../assets/css/classe.css">

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

            <form method="POST">
                        <div class="form-group">

                <label>Nom de la classe</label>

                <input
                    type="text"
                    name="nom"
                    required
                >

            </div>

            <div class="modal-buttons">

                <button
                    type="button"
                    id="btnCancel"
                    class="btn-cancel"
                >
                    Annuler
                </button>

                <button
                    type="submit"
                    name="add_classe"
                    class="btn-save"
                >
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
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach($classes as $classe): ?>

                    <tr>

                        <td><?= $classe['id']; ?></td>

                        <td><?= htmlspecialchars($classe['nom']); ?></td>

                        <td class="table-actions">

                            <a
                                href="#"
                                class="action edit btn-edit"
                                data-id="<?= $classe['id']; ?>"
                                data-nom="<?= htmlspecialchars($classe['nom']); ?>"
                            >
                                <i class="fa-solid fa-pen"></i>
                            </a>

                            <a
                                href="#"
                                class="action delete btn-delete"
                                data-id="<?= $classe['id']; ?>"
                            >
                                <i class="fa-solid fa-trash"></i>
                            </a>

                        </td>

                    </tr>

                    <?php endforeach; ?>

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

    <!-- modifier une classe -->

<div class="modal" id="editModal">

    <div class="modal-content">

        <span class="close-btn">&times;</span>
        <br>
        <h2 style="text-align:center;">Modifier la classe</h2>

        <form method="POST">

            <input
                type="hidden"
                name="id"
                id="edit-id"
            >

            <div class="form-group">

                <label>Nom</label>

                <input
                    type="text"
                    name="nom"
                    id="edit-nom"
                    required
                >

            </div>

            <button
                type="submit"
                name="update_classe"
                class="btn-save"
            >
                Modifier
            </button>

        </form>

    </div>

</div>

<!-- supprimer une classe -->

<div class="modal" id="deleteModal">

    <div class="modal-content">

        <span class="close-btn">&times;</span>

        <h2>Supprimer la classe</h2>

        <p>
            Voulez-vous vraiment supprimer cette classe ?
        </p>

        <form method="POST">

            <input
                type="hidden"
                name="id"
                id="delete-id"
            >

            <button
                type="submit"
                name="delete_classe"
                class="btn-confirm-delete"
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


</div>


<script src="../../assets/js/classe.js"></script>

<?php
include '../layouts/footer.php';
?>