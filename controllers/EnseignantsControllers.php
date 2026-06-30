<?php

require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../models/EnseignantsModels.php';

class EnseignantController
{
    private $enseignant;

    public function __construct()
    {
        global $pdo;

        $this->enseignant = new Enseignant($pdo);
    }

    // Afficher tous les enseignants
    public function index()
    {
        return $this->enseignant->getAll();
    }

    // Afficher un enseignant
    public function show($id)
    {
        return $this->enseignant->getById($id);
    }

    // Ajouter un enseignant
    public function handleCreate()
    {
        if (
            $_SERVER['REQUEST_METHOD'] === 'POST'
            && isset($_POST['add_enseignant'])
        ) {

            $resultat = $this->enseignant->create(
                trim($_POST['prenom']),
                trim($_POST['nom']),
                trim($_POST['email']),
                $_POST['mdp'],
                trim($_POST['specialite'])
            );

            if ($resultat === true) {

                $_SESSION['success'] =
                    "Enseignant ajouté avec succès.";

            } else {

                $_SESSION['error'] = $resultat;
            }

            header('Location: enseignants.php');
            exit();
        }
    }

    // Modifier un enseignant
    public function handleUpdate()
    {
        if (
            $_SERVER['REQUEST_METHOD'] === 'POST'
            && isset($_POST['update_enseignant'])
        ) {

            $resultat = $this->enseignant->update(
                $_POST['id'],
                trim($_POST['prenom']),
                trim($_POST['nom']),
                trim($_POST['email']),
                trim($_POST['specialite'])
            );

            if ($resultat) {

                $_SESSION['success'] =
                    "Enseignant modifié avec succès.";

            } else {

                $_SESSION['error'] =
                    "Erreur lors de la modification.";
            }

            header('Location: enseignants.php');
            exit();
        }
    }

    // Supprimer un enseignant
   public function handleDelete()
{
    if (
        $_SERVER['REQUEST_METHOD'] === 'POST'
        && isset($_POST['delete_enseignant'])
    ) {

        $resultat =
            $this->enseignant->delete($_POST['id']);

        if ($resultat === true) {

            $_SESSION['success'] =
                "Enseignant supprimé avec succès.";

        } elseif ($resultat === "matiere_exist") {

            $_SESSION['error'] =
                "Impossible de supprimer cet enseignant car il est associé à une ou plusieurs matières.";

        } else {

            $_SESSION['error'] =
                "Erreur lors de la suppression.";
        }

        header('Location: enseignants.php');
        exit();
    }
}

}