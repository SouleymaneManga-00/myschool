<?php
session_start();

if (!isset($_SESSION['id']) || $_SESSION['role'] != 'admin') {
    header('Location: ../../index.php');
    exit();
}

require_once '../../config/db.php';
require_once '../../controllers/AdminControllers.php';

$adminController = new AdminController($pdo);

$stats = $adminController->dashboard();

include('../layouts/header.php');
include('../layouts/sidebar_admin.php');
?>

<div class="main-content">

    <div class="topbar">

        <h2>Dashboard Admin</h2>

        <div class="user">
            Bonjour <?= $_SESSION['prenom']; ?>
        </div>

    </div>

    <div class="cards">

        <div class="card">
            <p><i class="fa-solid fa-user-graduate"></i></p>
            <h3>Étudiants</h3>
            <p><?= $stats['nbEtudiants']; ?></p>
        </div>

        <div class="card">
            <p><i class="fa-solid fa-chalkboard-user"></i></p>
            <h3>Enseignants</h3>
            <p><?= $stats['nbEnseignants']; ?></p>
        </div>

        <div class="card">
            <p><i class="fa-solid fa-school"></i></p>
            <h3>Classes</h3>
            <p><?= $stats['nbClasses']; ?></p>
        </div>

        <div class="card">
            <p><i class="fa-solid fa-book"></i></p>
            <h3>Matières</h3>
            <p><?= $stats['nbMatieres']; ?></p>
        </div>

    </div>

</div>

<?php
include('../layouts/footer.php');
?>