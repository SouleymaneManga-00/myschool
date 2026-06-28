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

<div class="main-content">

    <div class="topbar">

        <h2>Dashboard Étudiant</h2>

        <div class="user">
            Bonjour <?= $_SESSION['prenom']; ?>
        </div>

    </div>

    <div class="cards">

        <div class="card">
            <h3>Moyenne Générale</h3>
            <p>--</p>
        </div>

        <div class="card">
            <h3>Absences</h3>
            <p>--</p>
        </div>

        <div class="card">
            <h3>Matières</h3>
            <p>--</p>
        </div>

        <div class="card">
            <h3>Cours aujourd'hui</h3>
            <p>--</p>
        </div>

    </div>

</div>

<?php
include '../layouts/footer.php';
?>