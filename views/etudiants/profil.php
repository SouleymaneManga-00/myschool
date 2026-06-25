<?php 
session_start(); 

  if( 
    !isset($_SESSION['id']) || 
    $_SESSION['role'] !== 'etudiant' 

    ) { 
        header('Location: ../../index.php'); 
        exit(); 
        } 
        
    include '../layouts/header.php'; 
    include '../layouts/sidebar_etudiants.php'; 
    ?> 

    <link rel="stylesheet" href="../../assets/css/profiletudiant.css">
    
   <div class="main-content">

    <div class="topbar">

        <h2>Mon Profil</h2>

        <div class="user">
            Bonjour <?= htmlspecialchars($_SESSION['prenom']); ?>
        </div>

    </div>



    <form id="profileForm"
      action="modifier_profil.php"
      method="POST"
      enctype="multipart/form-data">


    <div class="profile-header">


        <!-- Avatar -->
        <div class="profile-avatar" id="avatarPreview">

            <i class="fa-solid fa-user"></i>

        </div>



        <!-- Informations -->
        <div class="profile-info">

            <h2>

                <?= htmlspecialchars($_SESSION['prenom']); ?>

                <?= htmlspecialchars($_SESSION['nom']); ?>

            </h2>


            <p>

                <?= ucfirst($_SESSION['role']); ?>

            </p>



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



    <!-- Informations utilisateur -->

    <div class="profile-grid">


        <div class="info-card">

            <h4>Prénom</h4>

            <input
                    type="text"
                    name="prenom"
                    value="<?= htmlspecialchars($_SESSION['prenom']); ?>"
                    readonly>

        </div>



        <div class="info-card">

            <h4>Nom</h4>

            <input
                    type="text"
                    name="nom"
                    value="<?= htmlspecialchars($_SESSION['nom']); ?>"
                    readonly>

        </div>



        <div class="info-card">

            <h4>Email</h4>

            <input
                    type="email"
                    name="email"
                    value="<?= htmlspecialchars($_SESSION['email']); ?>"
                    readonly>

        </div>



        <div class="info-card">

            <h4>Rôle</h4>

            <input
                    type="text"
                    value="<?= ucfirst($_SESSION['role']); ?>"
                    readonly>

        </div>


    </div>



    <!-- Boutons -->

    <div class="profile-actions">


        <a href="../../logout.php"
           id="logoutBtn"
           class="btn-logout">

            <i class="fa-solid fa-right-from-bracket"></i>

            Déconnexion

        </a>


    </div>


    </form>


</div>

<script src="../../assets/js/profiletudiant.js"></script>

<?php include '../layouts/footer.php'; ?>