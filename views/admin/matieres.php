<?php
session_start();

if (
    !isset($_SESSION['id']) ||
    $_SESSION['role'] !== 'admin'
) {
    header('Location: ../../index.php');
    exit();
}


require_once '../../controllers/MatiereControllers.php';
require_once '../../controllers/EnseignantsControllers.php';

$matiereController = new MatiereController();
$enseignantController = new EnseignantController();

$matiereController->handleCreate();
$matiereController->handleUpdate();
$matiereController->handleDelete();

$matieres = $matiereController->index();
$enseignants = $enseignantController->index();

$message = $_SESSION['success'] ?? '';
$error = $_SESSION['error'] ?? '';

unset($_SESSION['success']);
unset($_SESSION['error']);


include '../layouts/header.php';
include '../layouts/sidebar_admin.php';

?>

<link rel="stylesheet" href="../../assets/css/matieres.css">

<div class="main-content">

    <div class="topbar">
        <h2>Gestion des Matières</h2>
        <div class="user">
            Bonjour <?= $_SESSION['prenom']; ?>
        </div>
    </div>

    <!-- ===== BOUTON AJOUTER ===== -->
    <div class="mat-toolbar">
        <button class="btn-ajouter" id="btnOuvrirModal">
            <i class="fa-solid fa-plus"></i> Ajouter une matière
        </button>
    </div>

    <!-- ===== MODAL FORMULAIRE ===== -->
    <div class="mat-overlay" id="modalOverlay">
        <div class="mat-modal">

            <div class="mat-modal-header">
                <h3><i class="fa-solid fa-book"></i> Nouvelle matière</h3>
                <button class="mat-close" id="btnFermerModal" title="Fermer">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <div class="mat-modal-body">
                <form method="POST">

                    <div class="mat-field">
                        <label for="nom">Nom de la matière</label>
                        <input type="text" id="nom" name="nom" placeholder="Ex : Mathématiques" required>
                    </div>

                    <div class="mat-field">
                        <label for="coeff">Coefficient</label>
                        <input type="number" id="coeff" name="coeff" min="1" max="10" placeholder="Ex : 3" required>
                    </div>

                    <div class="mat-field">
                        <label for="enseignant_id">Enseignant responsable</label>
                        <select id="enseignant_id" name="enseignant_id" required>
                            <option value="" disabled selected>— Choisir un enseignant —</option>
                            <?php if (!empty($enseignants)): ?>
                            <?php foreach ($enseignants as $e): ?>
                                    <option value="<?= $e['id'] ?>">
                                        <?= htmlspecialchars(
                                            $e['prenom'] . ' ' . $e['nom']
                                        ) ?>
                                    </option>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>

                    <div class="mat-modal-actions">

                        <button type="button" class="btn-annuler" id="btnAnnuler">
                            Annuler 
                        </button>

                        <button type="submit" name="add_matiere" class="btn-sauvegarder">
                            <i class="fa-solid fa-floppy-disk"></i>
                             Enregistrer
                            </button>
                    </div>

                </form>
            </div>

        </div>
    </div>

    <!-- ===== TABLEAU DES MATIÈRES ===== -->
    <div class="table-container">

        <div class="mat-table-header">
            <h3>Liste des matières</h3>
            <input type="text" id="searchInput" placeholder="Rechercher une matière…">
        </div>

        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nom</th>
                        <th>Coefficient</th>
                        <th>Enseignant</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="matieresTable">
                        <?php foreach ($matieres as $index => $m): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= htmlspecialchars($m['nom']) ?></td>
                            <td>
                                <span class="mat-coeff"><?= $m['coeff'] ?></span>
                            </td>
                            <td><?= htmlspecialchars($m['prenom'] . ' ' . $m['nom_enseignant']) ?></td>
                            <td class="mat-actions">

                                <a
                                    href="#"
                                    class="btn-edit"
                                    data-id="<?= $m['id']; ?>"
                                    data-nom="<?= htmlspecialchars($m['nom']); ?>"
                                    data-coeff="<?= $m['coeff']; ?>"
                                    data-enseignant="<?= $m['enseignant_id']; ?>"
                                >
                                    <i class="fa-solid fa-pen"></i>
                                </a>

                                <a
                                    href="#"
                                    class="open-delete-modal"
                                    data-id="<?= $m['id']; ?>"
                                >
                                    <i class="fa-solid fa-trash"></i>
                                </a>

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
    
<!-- modifier une matiere -->

    <div class="modal" id="editModal">

    <div class="modal-content">

        <span class="close-btn">&times;</span>

        <h2>Modifier la matière</h2>

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

            <div class="form-group">

                <label>Coefficient</label>

                <input
                    type="number"
                    name="coeff"
                    id="edit-coeff"
                    required
                >

            </div>

            <div class="form-group">

                <label>Enseignant</label>

                <select
                    name="enseignant_id"
                    id="edit-enseignant"
                    required
                >

                    <?php foreach($enseignants as $enseignant): ?>

                        <option
                            value="<?= $enseignant['id']; ?>"
                        >

                            <?= htmlspecialchars(
                                $enseignant['prenom']
                                . ' ' .
                                $enseignant['nom']
                            ); ?>

                        </option>

                    <?php endforeach; ?>

                </select>

            </div>

            <button
                type="submit"
                name="update_matiere"
                class="btn-sauvegarder"
            >
                Modifier
            </button>

        </form>

    </div>

</div>

<!-- supprimer une matiere -->

<div class="modal" id="deleteModal">

    <div class="modal-content">

        <span class="close-btn">&times;</span>

        <h2>Supprimer la matière</h2>

        <p>
            Voulez-vous vraiment supprimer cette matière ?
        </p>

        <form method="POST">

            <input
                type="hidden"
                name="id"
                id="delete-id"
            >

            <button
                type="submit"
                name="delete_matiere"
                class="btn-delete"
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

<script src="../../assets/js/matieres.js"></script>

<?php
include '../layouts/footer.php';
?>