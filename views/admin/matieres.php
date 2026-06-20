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
                <form method="POST" action="../../controllers/MatiereControllers.php">

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
                                        <?= htmlspecialchars($e['prenom'] . ' ' . $e['nom']) ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>

                    <div class="mat-modal-actions">
                        <button type="button" class="btn-annuler" id="btnAnnuler">Annuler</button>
                        <button type="submit" class="btn-sauvegarder">
                            <i class="fa-solid fa-floppy-disk"></i> Enregistrer
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
                    <?php if (!empty($matieres)): ?>
                        <?php foreach ($matieres as $index => $m): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= htmlspecialchars($m['nom']) ?></td>
                            <td>
                                <span class="mat-coeff"><?= $m['coeff'] ?></span>
                            </td>
                            <td><?= htmlspecialchars($m['prenom_enseignant'] . ' ' . $m['nom_enseignant']) ?></td>
                            <td class="mat-actions">
                                <a href="../../controllers/MatiereControllers.php?action=edit&id=<?= $m['id'] ?>"
                                   class="btn-edit" title="Modifier">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <a href="../../controllers/MatiereControllers.php?action=delete&id=<?= $m['id'] ?>"
                                   class="btn-delete"
                                   title="Supprimer"
                                   onclick="return confirm('Supprimer cette matière ?')">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <!-- Données de démonstration (à retirer quand le contrôleur est branché) -->
                        <tr>
                            <td>1</td>
                            <td>Mathématiques</td>
                            <td><span class="mat-coeff">4</span></td>
                            <td>Jean Dupont</td>
                            <td class="mat-actions">
                                <a href="#" class="btn-edit"><i class="fa-solid fa-pen"></i></a>
                                <a href="#" class="btn-delete" onclick="return confirm('Supprimer cette matière ?')"><i class="fa-solid fa-trash"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Physique-Chimie</td>
                            <td><span class="mat-coeff">3</span></td>
                            <td>Marie Diallo</td>
                            <td class="mat-actions">
                                <a href="#" class="btn-edit"><i class="fa-solid fa-pen"></i></a>
                                <a href="#" class="btn-delete" onclick="return confirm('Supprimer cette matière ?')"><i class="fa-solid fa-trash"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Histoire-Géographie</td>
                            <td><span class="mat-coeff">2</span></td>
                            <td>Oumar Ndiaye</td>
                            <td class="mat-actions">
                                <a href="#" class="btn-edit"><i class="fa-solid fa-pen"></i></a>
                                <a href="#" class="btn-delete" onclick="return confirm('Supprimer cette matière ?')"><i class="fa-solid fa-trash"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Français</td>
                            <td><span class="mat-coeff">3</span></td>
                            <td>Fatou Seck</td>
                            <td class="mat-actions">
                                <a href="#" class="btn-edit"><i class="fa-solid fa-pen"></i></a>
                                <a href="#" class="btn-delete" onclick="return confirm('Supprimer cette matière ?')"><i class="fa-solid fa-trash"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Anglais</td>
                            <td><span class="mat-coeff">2</span></td>
                            <td>Ibrahima Fall</td>
                            <td class="mat-actions">
                                <a href="#" class="btn-edit"><i class="fa-solid fa-pen"></i></a>
                                <a href="#" class="btn-delete" onclick="return confirm('Supprimer cette matière ?')"><i class="fa-solid fa-trash"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td>Informatique</td>
                            <td><span class="mat-coeff">4</span></td>
                            <td>Aminata Ba</td>
                            <td class="mat-actions">
                                <a href="#" class="btn-edit"><i class="fa-solid fa-pen"></i></a>
                                <a href="#" class="btn-delete" onclick="return confirm('Supprimer cette matière ?')"><i class="fa-solid fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </div>

</div>

<script src="../../assets/js/matieres.js"></script>

<?php
include '../layouts/footer.php';
?>