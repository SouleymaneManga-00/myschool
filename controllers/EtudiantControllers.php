<?php

require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../models/EtudiantModels.php';

class EtudiantController
{
    private $etudiant;

    public function __construct()
    {
        global $pdo;

        $this->etudiant = new Etudiant($pdo);
    }

    // Afficher tous les étudiants
    public function index()
    {
        return $this->etudiant->getAll();
    }

    // Ajouter un étudiant
    public function store($prenom, $nom, $email, $mdp, $id_classe)
    {
        return $this->etudiant->create(
            $prenom,
            $nom,
            $email,
            $mdp,
            $id_classe
        );
    }

    // Modifier un étudiant
    public function update($id, $prenom, $nom, $email, $id_classe)
    {
        return $this->etudiant->update(
            $id,
            $prenom,
            $nom,
            $email,
            $id_classe
        );
    }

    // Supprimer un étudiant
    public function delete($id)
    {
        return $this->etudiant->delete($id);
    }

    // Récupérer un étudiant
    public function show($id)
    {
        return $this->etudiant->getById($id);
    }

    // Compter les étudiants
    public function count()
    {
        return $this->etudiant->count();
    }

 public function handleCreate()
{
    if (
        $_SERVER['REQUEST_METHOD'] === 'POST'
        && isset($_POST['add_etudiant'])
    ) {

        $resultat = $this->etudiant->create(
            trim($_POST['prenom']),
            trim($_POST['nom']),
            trim($_POST['email']),
            $_POST['mdp'],
            $_POST['id_classe']
        );

        if ($resultat === true) {

            $_SESSION['success'] =
                "Étudiant ajouté avec succès.";

        } else {

            $_SESSION['error'] = $resultat;
        }

        header('Location: etudiants.php');
        exit();
    }
}


public function handleUpdate()
{
    if (
        $_SERVER['REQUEST_METHOD'] === 'POST'
        && isset($_POST['update_etudiant'])
    ) {

        $resultat = $this->etudiant->update(
            $_POST['id'],
            trim($_POST['prenom']),
            trim($_POST['nom']),
            trim($_POST['email']),
            $_POST['id_classe']
        );

        if ($resultat) {

            $_SESSION['success'] =
                "Étudiant modifié avec succès.";

        } else {

            $_SESSION['error'] =
                "Erreur lors de la modification.";
        }

        header('Location: etudiants.php');
        exit();
    }
}


public function handleDelete()
{
    if (
        $_SERVER['REQUEST_METHOD'] === 'POST'
        && isset($_POST['delete_etudiant'])
    ) {

        $resultat =
            $this->etudiant->delete($_POST['id']);

        if ($resultat) {

            $_SESSION['success'] =
                "Étudiant supprimé avec succès.";

        } else {

            $_SESSION['error'] =
                "Erreur lors de la suppression.";
        }

        header('Location: etudiants.php');
        exit();
    }
}

}