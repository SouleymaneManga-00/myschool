<?php

require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../models/ProfilModels.php';

class ProfilController
{
    private $profil;

    public function __construct()
    {
        global $pdo;

        $this->profil = new Profil($pdo);
    }

    /*
    =====================================
        Afficher le profil connecté
    =====================================
    */

    public function index()
    {
        if (!isset($_SESSION['id'])) {
            return null;
        }

        return $this->profil->getById($_SESSION['id']);
    }

    /*
    =====================================
        Modifier les informations
    =====================================
    */

    public function handleUpdateInformations()
    {
        if (!isset($_POST['update_profil'])) {
            return;
        }

        $id = $_SESSION['id'];

        $prenom = trim($_POST['prenom']);
        $nom = trim($_POST['nom']);
        $email = trim($_POST['email']);

        if (empty($prenom) || empty($nom) || empty($email)) {

            $_SESSION['error'] = "Tous les champs sont obligatoires.";

            return;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

            $_SESSION['error'] = "Adresse email invalide.";

            header("Location: profil.php");
            exit();

            return;
        }

        if ($this->profil->updateInformations($id, $prenom, $nom, $email)) {

            // Mise à jour de la session
            $_SESSION['prenom'] = $prenom;
            $_SESSION['nom'] = $nom;
            $_SESSION['email'] = $email;

            $_SESSION['success'] = "Profil mis à jour avec succès.";
            
            header("Location: profil.php");
            exit();

        } else {

            $_SESSION['error'] = "Erreur lors de la modification.";
            
            header("Location: profil.php");
            exit();

        }
    }

    /*
    =====================================
        Modifier le mot de passe
    =====================================
    */

    public function handleUpdatePassword()
    {
        if (!isset($_POST['update_password'])) {
            return;
        }

        $id = $_SESSION['id'];

        $password = $_POST['password'];
        $confirm = $_POST['confirm_password'];

        if (empty($password) || empty($confirm)) {

            $_SESSION['error'] = "Veuillez remplir tous les champs.";
            
            header("Location: profil.php");
            exit();

            return;
        }

        if ($password !== $confirm) {

            $_SESSION['error'] = "Les mots de passe sont différents.";
            
            header("Location: profil.php");
            exit();

            return;
        }

        if (strlen($password) < 6) {

            $_SESSION['error'] = "Le mot de passe doit contenir au moins 6 caractères.";
            
            header("Location: profil.php");
            exit();

            return;
        }

        if ($this->profil->updatePassword($id, $password)) {

            $_SESSION['success'] = "Mot de passe modifié avec succès.";
            
            header("Location: profil.php");
            exit();

        } else {

            $_SESSION['error'] = "Impossible de modifier le mot de passe.";
            
            header("Location: profil.php");
            exit();

        }
    }

/*
=====================================
    Modifier la photo
=====================================
*/

public function handleUpdatePhoto()
{
    if (!isset($_POST['update_photo'])) {
        return;
    }

    if (!isset($_FILES['photo'])) {
        return;
    }

    $id = $_SESSION['id'];

    if ($_FILES['photo']['error'] !== UPLOAD_ERR_OK) {

        $_SESSION['error'] = "Erreur lors du téléchargement.";
        
        header("Location: profil.php");
        exit();

        return;
    }

    $extensions = [
        'jpg',
        'jpeg',
        'png',
        'webp'
    ];

    $extension = strtolower(
        pathinfo(
            $_FILES['photo']['name'],
            PATHINFO_EXTENSION
        )
    );

    if (!in_array($extension, $extensions)) {

        $_SESSION['error'] = "Format de fichier non autorisé.";
        
        header("Location: profil.php");
        exit();

        return;
    }

    if ($_FILES['photo']['size'] > 2 * 1024 * 1024) {

        $_SESSION['error'] = "La photo ne doit pas dépasser 2 Mo.";
        
        header("Location: profil.php");
        exit();

        return;
    }

    /*
    =====================================
        Récupérer l'utilisateur
    =====================================
    */

    $user = $this->profil->getById($id);

    /*
    =====================================
        Dossier des photos
    =====================================
    */

    $dossier = __DIR__ . '/../assets/images/profils/';

    if (!is_dir($dossier)) {

        mkdir($dossier, 0777, true);

    }

    /*
    =====================================
        Nouveau nom
    =====================================
    */

    $nomPhoto = uniqid('profil_') . '.' . $extension;

    $chemin = $dossier . $nomPhoto;

    /*
    =====================================
        Déplacer la nouvelle photo
    =====================================
    */

    if (!move_uploaded_file($_FILES['photo']['tmp_name'], $chemin)) {

        $_SESSION['error'] = "Impossible d'enregistrer la photo.";
        header("Location: profil.php");
        exit();

        return;
    }

    /*
    =====================================
        Supprimer l'ancienne photo
    =====================================
    */

    if (!empty($user['photo'])) {

        $anciennePhoto = __DIR__ . '/../' . $user['photo'];

        if (file_exists($anciennePhoto)) {

            unlink($anciennePhoto);

        }

    }

    /*
    =====================================
        Enregistrer dans la base
    =====================================
    */

    $photoBDD = "assets/images/profils/" . $nomPhoto;

    if ($this->profil->updatePhoto($id, $photoBDD)) {

        $_SESSION['success'] = "Photo de profil mise à jour avec succès.";
        
        header("Location: profil.php");
        exit();

    } else {

        $_SESSION['error'] = "Erreur lors de la mise à jour de la photo.";
        
        header("Location: profil.php");
        exit();

    }
}


}
