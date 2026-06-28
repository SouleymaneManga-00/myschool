<?php

session_start();

if(
    !isset($_SESSION['id']) ||
    $_SESSION['role'] !== 'admin'
){
    header('Location: ../../index.php');
    exit();
}

include '../layouts/header.php';
include '../layouts/sidebar_admin.php';

?>

<div class="main-content">

    <div class="topbar">

        <h2>Mon Profil</h2>

        <div class="user">
            Bonjour <?= $_SESSION['prenom']; ?>
        </div>

    </div>

    <div class="profile-container">

        <div class="profile-header">

            <div class="profile-avatar">

                <i class="fa-solid fa-user"></i>

            </div>

            <div class="profile-info">

                <h2>
                    <?= $_SESSION['prenom'] . ' ' . $_SESSION['nom']; ?>
                </h2>

                <p>Administrateur</p>

            </div>

        </div>

        <div class="profile-grid">

            <div class="info-card">

                <h4>Prénom</h4>

                <p><?= $_SESSION['prenom']; ?></p>

            </div>

            <div class="info-card">

                <h4>Nom</h4>

                <p><?= $_SESSION['nom']; ?></p>

            </div>

            <div class="info-card">

                <h4>Email</h4>

                <p><?= $_SESSION['email']; ?></p>

            </div>

            <div class="info-card">

                <h4>Rôle</h4>

                <p><?= ucfirst($_SESSION['role']); ?></p>

            </div>

        </div>

    </div>

</div>

<?php include '../layouts/footer.php'; ?>