<?php
session_start();

if (
    !isset($_SESSION['id']) ||
    $_SESSION['role'] !== 'admin'
) {
    header('Location: ../../index.php');
    exit();
}

require_once '../../controllers/EmploiTempsControllers.php';
require_once '../../controllers/ClasseControllers.php';
require_once '../../controllers/MatiereControllers.php';
require_once '../../controllers/EnseignantsControllers.php';

$emploiController = new EmploiDuTempsController();
$classeController = new ClasseController();
$matiereController = new MatiereController();
$enseignantController = new EnseignantController();

$emploiController->handleCreate();
$emploiController->handleUpdate();
$emploiController->handleDelete();

$emplois = $emploiController->index();
$classes = $classeController->index();
$matieres = $matiereController->index();
$enseignants = $enseignantController->index();

$message = $_SESSION['success'] ?? '';
$error   = $_SESSION['error'] ?? '';

unset($_SESSION['success']);
unset($_SESSION['error']);

include '../layouts/header.php';
include '../layouts/sidebar_admin.php';
?>

<link rel="stylesheet" href="../../assets/css/emploi_temps.css">

<div class="main-content">

    <div class="topbar">

        <div>

            <h2>
                Gestion des Emplois du Temps
            </h2>

        </div>

        <div class="user">

            Bonjour
            <?= htmlspecialchars($_SESSION['prenom']); ?>

        </div>

    </div>

    <?php if($message): ?>

<div class="alert success">

    <?= $message; ?>

</div>

<?php endif; ?>

<?php if($error): ?>

<div class="alert error">

    <?= $error; ?>

</div>

<?php endif; ?>

<div class="toolbar">

    <button
        class="btn-ajouter"
        id="btnOpenAdd"
    >

        <i class="fa-solid fa-plus"></i>

        Ajouter un cours

    </button>

    <br>

    <input
        type="text"
        id="searchInput"
        placeholder="Rechercher un cours..."
    >

</div>
<br>

<div class="table-container">

    <div class="table-header">

        <h3>

            Liste des cours

        </h3>

    </div>

    <div class="table-responsive">

        <table>

            <thead>

                <tr>

                    <th>Jour</th>

                    <th>Début</th>

                    <th>Fin</th>

                    <th>Classe</th>

                    <th>Matière</th>

                    <th>Enseignant</th>

                    <th>Actions</th>

                </tr>

            </thead>

            <tbody id="emploiTable">

            <?php foreach($emplois as $emploi): ?>

            <tr>

                <td>

                    <span class="badge badge-jour">

                        <?= htmlspecialchars($emploi['jour']); ?>

                    </span>

                </td>

                <td>

                    <?= htmlspecialchars($emploi['heure_debut']); ?>

                </td>

                <td>

                    <?= htmlspecialchars($emploi['heure_fin']); ?>

                </td>

                <td>

                    <span class="badge badge-classe">

                        <?= htmlspecialchars($emploi['classe']); ?>

                    </span>

                </td>

                <td>

                    <?= htmlspecialchars($emploi['matiere']); ?>

                </td>

                <td>

                    <?= htmlspecialchars(
                        $emploi['prenom']
                        . ' ' .
                        $emploi['enseignant']
                    ); ?>

                </td>

                <td class="actions">

                    <button

                        class="btn-edit"

                        data-id="<?= $emploi['id']; ?>"

                        data-jour="<?= $emploi['jour']; ?>"

                        data-debut="<?= $emploi['heure_debut']; ?>"

                        data-fin="<?= $emploi['heure_fin']; ?>"

                        data-classe="<?= $emploi['id_classe']; ?>"

                        data-matiere="<?= $emploi['id_matiere']; ?>"

                        data-enseignant="<?= $emploi['id_enseignant']; ?>"

                    >

                        <i class="fa-solid fa-pen"></i>

                    </button>

                    <button

                        class="btn-delete"

                        data-id="<?= $emploi['id']; ?>"

                    >

                        <i class="fa-solid fa-trash"></i>

                    </button>

                </td>

            </tr>

            <?php endforeach; ?>


             </tbody>

            </table>

            </div>

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

    <!-- ===========================
      MODAL AJOUT
=========================== -->

<div class="modal" id="addModal">

    <div class="modal-content">

        <div class="modal-header">

            <h3>
                <i class="fa-solid fa-calendar-plus"></i>
                Ajouter un cours
            </h3>

        </div>
        
        <form method="POST">

    <div class="form-grid">

        <div class="form-group">

            <label>Jour</label>

            <select name="jour" required>
                <option value="">Choisir</option>
                <option>Lundi</option>
                <option>Mardi</option>
                <option>Mercredi</option>
                <option>Jeudi</option>
                <option>Vendredi</option>
                <option>Samedi</option>
            </select>

        </div>

        <div class="form-group">

            <label>Classe</label>

            <select name="id_classe" required>

                <option value="">Classe</option>

                <!-- tes classes -->
             <option value="">Choisir...</option>

                <?php foreach($classes as $classe): ?>

                    <option value="<?= $classe['id']; ?>">

                      <?= htmlspecialchars($classe['nom']); ?>

                        </option>

                <?php endforeach; ?>

            </select>

        </div>

        <div class="form-group">

            <label>Heure début</label>

            <input
                type="time"
                name="heure_debut"
                required
            >

        </div>

        <div class="form-group">

            <label>Heure fin</label>

            <input
                type="time"
                name="heure_fin"
                required
            >

        </div>

        <div class="form-group">

            <label>Matière</label>

            <select name="id_matiere" required>

                <!-- matières -->
            
                 <option value="">Choisir...</option>

                <?php foreach($matieres as $matiere): ?>

                <option value="<?= $matiere['id']; ?>">

                    <?= htmlspecialchars($matiere['nom']); ?>

                 </option>

                <?php endforeach; ?>

            </select>

        </div>

        <div class="form-group">

            <label>Enseignant</label>

            <select
                name="id_enseignant"
                required
            >

                <!-- enseignants -->

                <option value="">Choisir...</option>

            <?php foreach($enseignants as $enseignant): ?>

                <option value="<?= $enseignant['id']; ?>">

                <?= htmlspecialchars(
                 $enseignant['prenom']
                        . ' '
                         . $enseignant['nom']
                     ); ?>

                </option>

             <?php endforeach; ?>

            </select>

        </div>

        <div class="form-group full">

            <button
                type="submit"
                name="add_emploi"
                class="btn-save"
            >
                Enregistrer
            </button>

            <button
                type="button"
                class="btn-cancel"
            >
                Annuler
            </button>

        </div>

    </div>

</form>
    </div>

    

</div>



<!-- ===========================
      MODAL MODIFIER
=========================== -->

<div class="modal" id="editModal">

    <div class="modal-content">

        <div class="modal-header">

            <h3>

                <i class="fa-solid fa-pen"></i>

                Modifier le cours

            </h3>

            <span class="close-btn">&times;</span>

        </div>

        <form method="POST">

            <input
                type="hidden"
                name="id"
                id="edit-id"
            >

            <div class="modal-body">

                <div class="form-grid">

                    <div class="form-group">

                        <label>Jour</label>

                        <select
                            name="jour"
                            id="edit-jour"
                            required
                        >

                            <option>Lundi</option>
                            <option>Mardi</option>
                            <option>Mercredi</option>
                            <option>Jeudi</option>
                            <option>Vendredi</option>
                            <option>Samedi</option>

                        </select>

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

                    <div class="form-group">

                        <label>Matière</label>

                        <select
                            name="id_matiere"
                            id="edit-matiere"
                            required
                        >

                            <?php foreach($matieres as $matiere): ?>

                                <option value="<?= $matiere['id']; ?>">

                                    <?= htmlspecialchars($matiere['nom']); ?>

                                </option>

                            <?php endforeach; ?>

                        </select>

                    </div>

                    <div class="form-group">

                        <label>Enseignant</label>

                        <select
                            name="id_enseignant"
                            id="edit-enseignant"
                            required
                        >

                            <?php foreach($enseignants as $enseignant): ?>

                                <option value="<?= $enseignant['id']; ?>">

                                    <?= htmlspecialchars(
                                        $enseignant['prenom']
                                        . ' '
                                        . $enseignant['nom']
                                    ); ?>

                                </option>

                            <?php endforeach; ?>

                        </select>

                    </div>

                    <div class="form-group">

                        <label>Heure début</label>

                        <input
                            type="time"
                            name="heure_debut"
                            id="edit-heure-debut"
                            required
                        >

                    </div>

                    <div class="form-group">

                        <label>Heure fin</label>

                        <input
                            type="time"
                            name="heure_fin"
                            id="edit-heure-fin"
                            required
                        >

                    </div>

                </div>

            </div>

            <div class="modal-footer">

                <button
                    type="button"
                    class="btn-cancel"
                >
                    Annuler
                </button>

                <button
                    type="submit"
                    name="update_emploi"
                    class="btn-save"
                >
                    Modifier
                </button>

            </div>

        </form>

    </div>

</div>



<!-- ===========================
      MODAL SUPPRESSION
=========================== -->

<div class="modal" id="deleteModal">

    <div class="modal-content delete-box">

        <div class="modal-header danger">

            <h3>

                <i class="fa-solid fa-trash"></i>

                Confirmation

            </h3>

            <span class="close-btn">&times;</span>

        </div>

        <form method="POST">

            <input
                type="hidden"
                name="id"
                id="delete-id"
            >

            <div class="modal-body center">

                <i class="fa-solid fa-circle-exclamation warning-icon"></i>

                <p>

                    Voulez-vous vraiment supprimer ce cours ?

                </p>

            </div>

            <div class="modal-footer">

                <button
                    type="button"
                    class="btn-cancel"
                >
                    Annuler
                </button>

                <button
                    type="submit"
                    name="delete_emploi"
                    class="btn-danger"
                >
                    Supprimer
                </button>

            </div>

        </form>

    </div>

</div>

<script src="../../assets/js/emploi_temps.js"></script>


<?php
include '../layouts/footer.php';
?>