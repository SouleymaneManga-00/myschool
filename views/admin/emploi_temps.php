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

$niveau = $_GET['niveau'] ?? 'L1';
?>

<div class="main-content">

    <div class="topbar">
        <h2>Gestion de l'Emploi du Temps (<?= htmlspecialchars($niveau); ?>)</h2>

        <div class="user">
            Bonjour <?= htmlspecialchars($_SESSION['prenom']); ?>
        </div>
    </div>

    <div class="emploi-header">
        <div class="filtres">

            <select id="select-classe"
                onchange="window.location.href='?niveau=' + this.value;">

                <option value="L1" <?= $niveau === 'L1' ? 'selected' : ''; ?>>
                    Licence 1 (L1)
                </option>

                <option value="L2" <?= $niveau === 'L2' ? 'selected' : ''; ?>>
                    Licence 2 (L2)
                </option>

            </select>

            <button class="btn-ajouter" onclick="ouvrirFormulaireCours()">
                + Ajouter un cours
            </button>

        </div>
    </div>

    <!-- TABLEAU -->
    <div class="table-container">

        <?php if ($niveau === 'L1'): ?>

            <table class="emploi-table">
                <thead>
                    <tr>
                        <th>Heure</th>
                        <th>Lundi</th>
                        <th>Mardi</th>
                        <th>Mercredi</th>
                        <th>Jeudi</th>
                        <th>Vendredi</th>
                        <th>Samedi</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td><strong>08h00 - 10h00</strong></td>
                        <td>Algorithmique L1<br><small>Amphi A</small></td>
                        <td>Architecture L1<br><small>Salle 102</small></td>
                        <td>Base de Données L1<br><small>Amphi B</small></td>
                        <td>Systèmes d’Exploitation L1<br><small>Labo Info 1</small></td>
                        <td>Développement Web L1<br><small>Salle 204</small></td>
                        <td>-</td>
                    </tr>

                    <tr>
                        <td><strong>10h15 - 12h15</strong></td>
                        <td>Mathématiques Discrètes</td>
                        <td>Algorithmique TD</td>
                        <td>Réseaux Informatiques</td>
                        <td>Anglais Technique</td>
                        <td>Base de Données TP</td>
                        <td>-</td>
                    </tr>

                    <tr>
                        <td><strong>13h00 - 15h00</strong></td>
                        <td>Programmation Web</td>
                        <td>Mathématiques Appliquées</td>
                        <td>Analyse Algorithmique</td>
                        <td>Réseaux Informatiques</td>
                        <td>Projet Tutoré</td>
                        <td>-</td>
                    </tr>

                    <tr>
                        <td><strong>15h15 - 17h15</strong></td>
                        <td>Développement Mobile</td>
                        <td>Base de Données TD</td>
                        <td>Culture Numérique</td>
                        <td>Linux</td>
                        <td>TP Général</td>
                        <td>-</td>
                    </tr>
                </tbody>
            </table>

        <?php else: ?>

            <table class="emploi-table">
                <thead>
                    <tr>
                        <th>Heure</th>
                        <th>Lundi</th>
                        <th>Mardi</th>
                        <th>Mercredi</th>
                        <th>Jeudi</th>
                        <th>Vendredi</th>
                        <th>Samedi</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td><strong>08h00 - 10h00</strong></td>
                        <td>Java Avancé</td>
                        <td>Graphes & RO</td>
                        <td>Systèmes d’Information</td>
                        <td>Génie Logiciel</td>
                        <td>Applications Mobiles</td>
                        <td>-</td>
                    </tr>

                    <tr>
                        <td><strong>10h15 - 12h15</strong></td>
                        <td>Routage IP</td>
                        <td>Java TP</td>
                        <td>SQL Avancé</td>
                        <td>Management</td>
                        <td>Sécurité Systèmes</td>
                        <td>-</td>
                    </tr>

                    <tr>
                        <td><strong>13h00 - 15h00</strong></td>
                        <td>Web Avancé</td>
                        <td>Réseaux</td>
                        <td>UML</td>
                        <td>Gestion Projet</td>
                        <td>Cloud</td>
                        <td>-</td>
                    </tr>

                    <tr>
                        <td><strong>15h15 - 17h15</strong></td>
                        <td>Framework Java</td>
                        <td>Projet Groupe</td>
                        <td>Big Data</td>
                        <td>Cybersécurité</td>
                        <td>Veille Tech</td>
                        <td>-</td>
                    </tr>
                </tbody>
            </table>

        <?php endif; ?>

    </div>

</div>

<!-- ================= MODAL MODERNE ================= -->
<div class="modal" id="modalCours">
    <div class="modal-content">

        <div class="modal-header">
            <h3>Ajouter un cours</h3>
            <p>Remplissez les informations du cours</p>
        </div>

        <div class="modal-body">

            <div class="input-group">
                <label>Matière</label>
                <input type="text" id="matiere" placeholder="Ex: Algorithmique">
            </div>

            <div class="input-group">
                <label>Salle</label>
                <input type="text" id="salle" placeholder="Ex: Amphi A">
            </div>

            <div class="input-group">
                <label>Jour</label>
                <select id="jour">
                    <option value="">Sélectionner un jour</option>
                    <option>Lundi</option>
                    <option>Mardi</option>
                    <option>Mercredi</option>
                    <option>Jeudi</option>
                    <option>Vendredi</option>
                    <option>Samedi</option>
                </select>
            </div>

            <div class="input-group">
                <label>Horaire</label>
                <input type="text" id="heure" placeholder="08h00 - 10h00">
            </div>

        </div>

        <div class="modal-footer">
            <button class="btn-cancel" onclick="fermerModal()">Annuler</button>
            <button class="btn-save" onclick="ajouterCoursModal()">Ajouter</button>
        </div>

    </div>
</div>

<?php include '../layouts/footer.php'; ?>