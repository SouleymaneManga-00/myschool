<?php
session_start();

if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'enseignant') {
    header('Location: ../../index.php');
    exit();
}

// Matière de l’enseignant connecté (venant de la base normalement)
$matiere = $_SESSION['matiere'] ?? 'Algorithmique';

include '../layouts/header.php';
include '../layouts/sidebar_enseignants.php';

?>

<link rel="stylesheet" href="../../assets/css/emploi_enseignants.css">

<div class="main-content-enseignants">

    <!-- TOP -->
    <div class="topbar-enseignants">
        <h2>Mon Emploi du Temps</h2>

        <div class="user">
            Bonjour <?= htmlspecialchars($_SESSION['prenom']); ?>
        </div>
    </div>

    <!-- MATIERE -->
    <div class="matiere-prof">
        <h3>Matière enseignée</h3>
        <span><?= htmlspecialchars($matiere); ?></span>
    </div>

    <!-- FILTRE JOUR -->
    <div class="filtre-prof">
        <label>Filtrer par jour</label>

        <select id="filtreJour">
            <option value="all">Toute la semaine</option>
            <option value="1">Lundi</option>
            <option value="2">Mardi</option>
            <option value="3">Mercredi</option>
            <option value="4">Jeudi</option>
            <option value="5">Vendredi</option>
            <option value="6">Samedi</option>
        </select>
    </div>

    <!-- STATS -->
    <div class="stats-enseignant">

        <div class="stat-card">
            <h3 id="total-cours">0</h3>
            <p>Cours</p>
        </div>

        <div class="stat-card">
            <h3 id="total-heures">0h</h3>
            <p>Heures</p>
        </div>

    </div>

    <!-- TABLE -->
    <div class="table-container-enseignants">

        <table class="emploi-table-enseignants">

            <thead>
                <tr>
                    <th>Horaire</th>
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
                    <td><strong>08h-10h</strong></td>
                    <td data-matiere="Algorithmique">Algorithmique</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                </tr>

                <tr>
                    <td><strong>10h15-12h15</strong></td>
                    <td>-</td>
                    <td data-matiere="Algorithmique">Algorithmique</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                </tr>

                <tr>
                    <td><strong>13h-15h</strong></td>
                    <td>-</td>
                    <td>-</td>
                    <td data-matiere="Algorithmique">Algorithmique</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                </tr>

                <tr>
                    <td><strong>15h15-17h15</strong></td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td data-matiere="Algorithmique">Algorithmique</td>
                    <td>-</td>
                    <td>-</td>
                </tr>

            </tbody>

        </table>

    </div>

</div>

<script src="../../assets/js/emploi_enseignants.js"></script>

<?php include '../layouts/footer.php'; ?>