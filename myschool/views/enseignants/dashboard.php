<?php
session_start();

if (
    !isset($_SESSION['id']) ||
    $_SESSION['role'] !== 'enseignant'
) {
    header('Location: ../../index.php');
    exit();
}

include '../layouts/header.php';
include '../layouts/sidebar_enseignants.php';
?>

<div class="main-content">

    <div class="topbar">

        <h2>Dashboard Enseignant</h2>

        <div class="user">
            Bonjour <?= $_SESSION['prenom']; ?>
        </div>

    </div>

    <div class="cards">

        <div class="card">
            <h3>Notes Saisies</h3>
            <p>--</p>
        </div>

        <div class="card">
            <h3>Absences Enregistrées</h3>
            <p>--</p>
        </div>

        <div class="card">
            <h3>Classes Assignées</h3>
            <p>--</p>
        </div>

        <div class="card">
            <h3>Cours Aujourd'hui</h3>
            <p>--</p>
        </div>

    </div>

</div>

<?php
include '../layouts/footer.php';
?>