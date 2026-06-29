<?php 
session_start(); 

  if( 
    !isset($_SESSION['id']) || 
    $_SESSION['role'] !== 'etudiant' 

    ) { 
        header('Location: ../../index.php'); 
        exit(); 
        } 

    
require_once '../../controllers/ProfilControllers.php';

$profilController = new ProfilController();

$profilController->handleUpdateInformations();
$profilController->handleUpdatePassword();
$profilController->handleUpdatePhoto();

$profil = $profilController->index();
        
    include '../layouts/header.php'; 
    include '../layouts/sidebar_etudiants.php'; 
    ?> 

    <link rel="stylesheet" href="../../assets/css/profiletudiant.css">
    
 <div class="main-content">

    <?php if(isset($_SESSION['success'])): ?>

<div class="toast toast-success" id="toast">

    <i class="fa-solid fa-circle-check"></i>

    <span>
        <?= $_SESSION['success']; ?>
    </span>

</div>

<?php unset($_SESSION['success']); ?>

<?php endif; ?>

<?php if(isset($_SESSION['error'])): ?>

<div class="toast toast-error" id="toast">

    <i class="fa-solid fa-circle-xmark"></i>

    <span>
        <?= $_SESSION['error']; ?>
    </span>

</div>

<?php unset($_SESSION['error']); ?>

<?php endif; ?>


    <div class="topbar">

        <h2>Mon Profil</h2>

        <div class="user">
            Bonjour <?= $_SESSION['prenom']; ?>
        </div>

    </div>

   <div class="profile-container">

    <div class="profile-header">

        <?php if(!empty($profil['photo'])): ?>

            <img
                src="../../<?= htmlspecialchars($profil['photo']); ?>"
                class="profile-image"
                alt="Photo de profil"
            >

        <?php else: ?>

            <div class="profile-avatar">

                <?= strtoupper(
                    substr($profil['prenom'],0,1)
                    .
                    substr($profil['nom'],0,1)
                ); ?>

            </div>

        <?php endif; ?>

        <div class="profile-info">

            <h2>

                <?= htmlspecialchars(
                    $profil['prenom']
                    . ' '
                    . $profil['nom']
                ); ?>

            </h2>

            <span class="role-badge">

                <?= ucfirst($profil['role']); ?>

            </span>

            <div class="profile-actions">

                <button
                    class="btn-primary"
                    id="btnPhoto"
                >

                    <i class="fa-solid fa-camera"></i>

                    Changer la photo

                </button>

                <a
                    href="../../logout.php"
                    class="btn-danger"
                    onclick="return confirm('Voulez-vous vraiment vous déconnecter ?');"
                >
                    <i class="fa-solid fa-right-from-bracket"></i>
                    Déconnexion
                </a>

            </div>

        </div>

    </div>

    <div class="profile-grid">

        <div class="info-card">

            <span>Prénom</span>

            <strong>

                <?= htmlspecialchars($profil['prenom']); ?>

            </strong>

        </div>

        <div class="info-card">

            <span>Nom</span>

            <strong>

                <?= htmlspecialchars($profil['nom']); ?>

            </strong>

        </div>

        <div class="info-card">

            <span>Email</span>

            <strong>

                <?= htmlspecialchars($profil['email']); ?>

            </strong>

        </div>

        <div class="info-card">

            <span>Rôle</span>

            <strong>

                <?= ucfirst($profil['role']); ?>

            </strong>

        </div>

    </div>

</div>

</div>

<!-- ==========================================================
     MODAL PHOTO
========================================================== -->

<div class="modal" id="photoModal">

    <div class="modal-content small-modal">

        <div class="modal-header">

            <h3>
                <i class="fa-solid fa-camera"></i>
                Changer la photo
            </h3>

            <span class="close-btn">&times;</span>

        </div>

        <form
            method="POST"
            enctype="multipart/form-data"
        >

            <div class="modal-body">

                <div class="photo-preview">

                    <?php if(!empty($profil['photo'])): ?>

                        <img
                            src="../../<?= htmlspecialchars($profil['photo']); ?>"
                            id="previewPhoto"
                        >

                    <?php else: ?>

                        <div
                            class="profile-avatar"
                            id="previewAvatar"
                        >

                            <?= strtoupper(
                                substr($profil['prenom'],0,1)
                                .
                                substr($profil['nom'],0,1)
                            ); ?>

                        </div>

                        <img
                            id="previewPhoto"
                            style="display:none;"
                        >

                    <?php endif; ?>

                </div>

                <input
                    type="file"
                    name="photo"
                    id="photoInput"
                    accept="image/png,image/jpeg,image/webp"
                >

            </div>

            <div class="modal-footer">

                <button
                    type="button"
                    class="btn-cancel"
                >
                    Annuler
                </button>

                <button
                    type="submit"
                    name="update_photo"
                    class="btn-save"
                >
                    Enregistrer
                </button>

            </div>

        </form>

    </div>

</div>



<script src="../../assets/js/profiletudiant.js"></script>

<?php include '../layouts/footer.php'; ?>