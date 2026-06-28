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
        <h2>Mon Emploi du Temps</h2>

        <div class="user">
            Bonjour <?= $_SESSION['prenom']; ?>
        </div>
    </div>

    <div class="table-container">
        <h2>Emploi du temps</h2>
        <p>L'emploi du temps sera affiché ici.</p>
    </div>

</div>

<?php include '../layouts/footer.php'; ?>