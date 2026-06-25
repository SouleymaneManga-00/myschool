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

<link rel="stylesheet" href="../../assets/css/profil.css">

<div class="main-content">

    <div class="topbar">

        <h2>Profil Enseignant</h2>

        <div class="user">
            Bonjour <?= htmlspecialchars($_SESSION['prenom']); ?>
        </div>

    </div>

    <div class="profile-container">

        <div id="profileForm">

            <div class="profile-header">

                <div class="profile-avatar">

                    <i class="fa-solid fa-chalkboard-user"></i>

                </div>

                <div class="profile-info">

                    <h2>
                        <?= htmlspecialchars($_SESSION['prenom']); ?>
                        <?= htmlspecialchars($_SESSION['nom']); ?>
                    </h2>

                    <p>Enseignant</p>

                   <!-- Bouton Photo -->

            <label for="photoInput"
                   class="btn-photo">

                <i class="fa-solid fa-camera"></i>

                Ajouter une photo

            </label>


            <input type="file"
                   id="photoInput"
                   name="photo"
                   accept="image/*"
                   hidden>
                </div>

            </div>

            <div class="profile-grid">

                <div class="info-card">
                    <h4>Prénom</h4>
                    <input
                        type="text"
                        value="<?= htmlspecialchars($_SESSION['prenom']); ?>"
                        readonly>
                </div>

                <div class="info-card">
                    <h4>Nom</h4>
                    <input
                        type="text"
                        value="<?= htmlspecialchars($_SESSION['nom']); ?>"
                        readonly>
                </div>

                <div class="info-card">
                    <h4>Email</h4>
                    <input
                        type="email"
                        value="<?= htmlspecialchars($_SESSION['email']); ?>"
                        readonly>
                </div>

                <div class="info-card">
                    <h4>Rôle</h4>
                    <input
                        type="text"
                        value="Enseignant"
                        readonly>
                </div>

            </div>

            <div class="profile-actions">

                <a href="../../logout.php" class="btn-logout">

                    <i class="fa-solid fa-right-from-bracket"></i>

                    Déconnexion

                </a>

            </div>

        </div>

    </div>

</div>

<?php include '../layouts/footer.php'; ?>