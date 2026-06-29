<?php
session_start();

if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'etudiant') {
    header('Location: ../../index.php');
    exit();
}

include '../layouts/header.php';
include '../layouts/sidebar_etudiants.php';
?>

<div class="main-content">

    <!-- TOPBAR -->
    <div class="topbar">
        <h2>Mon Emploi du Temps</h2>

        <div class="user">
            Bonjour <?= htmlspecialchars($_SESSION['prenom']); ?>
        </div>
    </div>

    <!-- FILTRE -->
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
                    <td><strong>08h - 10h</strong></td>
                    <td data-jour="1">Algorithmique</td>
                    <td data-jour="2">Maths</td>
                    <td data-jour="3">Base de Données</td>
                    <td data-jour="4">Réseaux</td>
                    <td data-jour="5">Développement Web</td>
                    <td>-</td>
                </tr>

                <tr>
                    <td><strong>10h15 - 12h15</strong></td>
                    <td>-</td>
                    <td data-jour="2">Algorithmique</td>
                    <td>-</td>
                    <td data-jour="4">Java</td>
                    <td>-</td>
                    <td>-</td>
                </tr>

                <tr>
                    <td><strong>13h - 15h</strong></td>
                    <td data-jour="1">Réseaux</td>
                    <td>-</td>
                    <td data-jour="3">SQL</td>
                    <td>-</td>
                    <td data-jour="5">Cloud Computing</td>
                    <td>-</td>
                </tr>

                <tr>
                    <td><strong>15h15 - 17h15</strong></td>
                    <td>-</td>
                    <td data-jour="2">Projet</td>
                    <td>-</td>
                    <td data-jour="4">Sécurité</td>
                    <td>-</td>
                    <td>-</td>
                </tr>

            </tbody>

        </table>

    </div>

</div>

<script src="../../assets/js/emploi_etudiants.js"></script>

<?php include '../layouts/footer.php'; ?>