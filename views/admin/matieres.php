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

<!-- ===== CSS SPÉCIFIQUE MATIERES ===== -->
<style>

/* ----- TOOLBAR ----- */
.mat-toolbar {
    display: flex;
    justify-content: flex-end;
    margin-bottom: 20px;
}

.btn-ajouter {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: #4FA3E3;
    color: white;
    border: none;
    padding: 12px 22px;
    border-radius: 10px;
    font-size: 15px;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.2s, transform 0.15s;
}

.btn-ajouter:hover {
    background: #3a8fd1;
    transform: translateY(-2px);
}

/* ----- OVERLAY & MODAL ----- */
.mat-overlay {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.45);
    z-index: 1000;
    align-items: center;
    justify-content: center;
}

.mat-overlay.active {
    display: flex;
}

.mat-modal {
    background: white;
    border-radius: 16px;
    width: 100%;
    max-width: 480px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.18);
    animation: slideIn 0.25s ease;
    overflow: hidden;
}

@keyframes slideIn {
    from { opacity: 0; transform: translateY(-20px); }
    to   { opacity: 1; transform: translateY(0); }
}

.mat-modal-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 20px 24px;
    background: #4FA3E3;
    color: white;
}

.mat-modal-header h3 {
    font-size: 18px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.mat-close {
    background: transparent;
    border: none;
    color: white;
    font-size: 18px;
    cursor: pointer;
    padding: 4px 8px;
    border-radius: 6px;
    transition: background 0.2s;
}

.mat-close:hover {
    background: rgba(255,255,255,0.2);
}

.mat-modal-body {
    padding: 28px 24px;
}

/* ----- CHAMPS ----- */
.mat-field {
    margin-bottom: 18px;
}

.mat-field label {
    display: block;
    font-size: 13px;
    font-weight: 600;
    color: #555;
    margin-bottom: 6px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.mat-field input,
.mat-field select {
    width: 100%;
    padding: 12px 14px;
    border: 1px solid #dde1e7;
    border-radius: 10px;
    font-size: 15px;
    outline: none;
    transition: border-color 0.2s, box-shadow 0.2s;
    background: #fafbfc;
    color: #333;
}

.mat-field input:focus,
.mat-field select:focus {
    border-color: #4FA3E3;
    box-shadow: 0 0 0 3px rgba(79, 163, 227, 0.15);
    background: white;
}

/* ----- BOUTONS MODAL ----- */
.mat-modal-actions {
    display: flex;
    justify-content: flex-end;
    gap: 12px;
    margin-top: 26px;
}

.btn-annuler {
    padding: 11px 22px;
    border: 1px solid #ddd;
    border-radius: 10px;
    background: white;
    color: #666;
    font-size: 14px;
    cursor: pointer;
    transition: background 0.2s;
}

.btn-annuler:hover {
    background: #f5f5f5;
}

.btn-sauvegarder {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 11px 22px;
    border: none;
    border-radius: 10px;
    background: #4FA3E3;
    color: white;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.2s;
}

.btn-sauvegarder:hover {
    background: #3a8fd1;
}

/* ----- TABLEAU ----- */
.mat-table-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    gap: 16px;
}

.mat-table-header h3 {
    font-size: 18px;
    color: #1e293b;
    font-weight: 700;
}

.mat-table-header input {
    padding: 10px 16px;
    border: 1px solid #dde1e7;
    border-radius: 10px;
    font-size: 14px;
    outline: none;
    width: 260px;
    transition: border-color 0.2s;
}

.mat-table-header input:focus {
    border-color: #4FA3E3;
}

/* Badge coefficient */
.mat-coeff {
    display: inline-block;
    background: #e0f0ff;
    color: #1d6fa4;
    font-weight: 700;
    padding: 4px 14px;
    border-radius: 20px;
    font-size: 14px;
}

/* Boutons actions */
.mat-actions {
    display: flex;
    gap: 8px;
}

.btn-edit,
.btn-delete {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 34px;
    height: 34px;
    border-radius: 8px;
    font-size: 14px;
    text-decoration: none;
    transition: background 0.2s, transform 0.15s;
}

.btn-edit {
    background: #e0f0ff;
    color: #2563eb;
}

.btn-edit:hover {
    background: #bfdbfe;
    transform: scale(1.1);
}

.btn-delete {
    background: #fee2e2;
    color: #dc2626;
}

.btn-delete:hover {
    background: #fecaca;
    transform: scale(1.1);
}

/* ----- RESPONSIVE ----- */
@media (max-width: 600px) {
    .mat-table-header {
        flex-direction: column;
        align-items: stretch;
    }

    .mat-table-header input {
        width: 100%;
    }

    .mat-modal {
        margin: 16px;
    }
}

</style>

<!-- ===== JS SPÉCIFIQUE MATIERES ===== -->
<script>

// --- Ouverture / fermeture du modal ---
const overlay       = document.getElementById('modalOverlay');
const btnOuvrir     = document.getElementById('btnOuvrirModal');
const btnFermer     = document.getElementById('btnFermerModal');
const btnAnnuler    = document.getElementById('btnAnnuler');

function ouvrirModal() {
    overlay.classList.add('active');
    document.body.style.overflow = 'hidden';
}

function fermerModal() {
    overlay.classList.remove('active');
    document.body.style.overflow = '';
}

btnOuvrir.addEventListener('click', ouvrirModal);
btnFermer.addEventListener('click', fermerModal);
btnAnnuler.addEventListener('click', fermerModal);

// Clic en dehors du modal pour fermer
overlay.addEventListener('click', function (e) {
    if (e.target === overlay) fermerModal();
});

// Touche Échap
document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') fermerModal();
});

// --- Recherche dans le tableau ---
const searchInput = document.getElementById('searchInput');

searchInput.addEventListener('keyup', function () {
    const valeur = this.value.toLowerCase();
    const lignes = document.querySelectorAll('#matieresTable tr');

    lignes.forEach(function (ligne) {
        const nom = ligne.children[1].textContent.toLowerCase();
        ligne.style.display = nom.includes(valeur) ? '' : 'none';
    });
});

</script>

<?php
include '../layouts/footer.php';
?>