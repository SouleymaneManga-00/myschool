<?php
session_start();

if (
    !isset($_SESSION['id']) ||
    $_SESSION['role'] !== 'etudiant'
) {
    header('Location: ../../index.php');
    exit();
}

include '../layouts/header.php';
include '../layouts/sidebar_etudiants.php';
?>

<link rel="stylesheet" href="../../assets/css/abscence_etudiant.css">

<div class="main-content">

    <div class="topbar">

        <h2>Dashboard Étudiant</h2>

        <div class="user">
            Bonjour <?= $_SESSION['prenom']; ?>
        </div>

    </div>
      <div class="absence-page">

    <div class="page-header">
        <h2>Mes Absences</h2>
        <p>Consultez l'historique de vos absences.</p>
    </div>

    <!-- Cartes statistiques -->

    <div class="stats-container">

        <div class="stat-card blue">
            <div class="icon">
                📅
            </div>

            <div class="details">
                <h3 id="totalAbsences">12</h3>
                <span>Total Absences</span>
            </div>

        </div>

        <div class="stat-card red">

            <div class="icon">
                ⏰
            </div>

            <div class="details">
                <h3 id="totalHeures">28 h</h3>
                <span>Heures d'absence</span>
            </div>

        </div>

    </div>

    <!-- Recherche -->

    <div class="search-box">

        <input
            type="text"
            id="searchInput"
            placeholder="Rechercher une matière..."
        >

    </div>

    <!-- Tableau -->

    <div class="table-responsive">

        <table id="absenceTable">

            <thead>

            <tr>

                <th>Date</th>
                <th>Matière</th>
                <th>Heures</th>
                <th>Motif</th>
                <th>Statut</th>

            </tr>

            </thead>

            <tbody>

            <tr>

                <td>05/09/2026</td>
                <td>Mathématiques</td>
                <td>2 h</td>
                <td>Maladie</td>
                <td><span class="badge success">Justifiée</span></td>

            </tr>

            <tr>

                <td>09/09/2026</td>
                <td>Physique</td>
                <td>4 h</td>
                <td>Absence</td>
                <td><span class="badge danger">Non justifiée</span></td>

            </tr>

            <tr>

                <td>15/09/2026</td>
                <td>Français</td>
                <td>2 h</td>
                <td>Retard</td>
                <td><span class="badge warning">En attente</span></td>

            </tr>

            <tr>

                <td>20/09/2026</td>
                <td>Informatique</td>
                <td>6 h</td>
                <td>Maladie</td>
                <td><span class="badge success">Justifiée</span></td>

            </tr>

            <tr>

                <td>24/09/2026</td>
                <td>Anglais</td>
                <td>3 h</td>
                <td>Absence</td>
                <td><span class="badge danger">Non justifiée</span></td>

            </tr>

            </tbody>

        </table>

    </div>

</div>

</div>
<script src="../../assets/js/abscence_etudiant.js"></script>

<?php include '../layouts/footer.php'; ?>