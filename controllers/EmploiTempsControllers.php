<?php

require_once '../../config/db.php';
require_once '../../models/EmploiTempsModels.php';

class EmploiDuTempsController
{
    private $emploiModel;

    public function __construct()
    {
        global $pdo;

        $this->emploiModel = new EmploiDuTemps($pdo);
    }

    // Afficher tous les emplois du temps
    public function index()
    {
        return $this->emploiModel->getAll();
    }

    // Ajouter un emploi du temps
    public function handleCreate()
    {
        if (
            $_SERVER['REQUEST_METHOD'] === 'POST'
            && isset($_POST['add_emploi'])
        ) {

            $resultat = $this->emploiModel->create(
                $_POST['jour'],
                $_POST['heure_debut'],
                $_POST['heure_fin'],
                $_POST['id_classe'],
                $_POST['id_matiere'],
                $_POST['id_enseignant']
            );

            if ($resultat) {

                $_SESSION['success'] =
                    "Emploi du temps ajouté avec succès.";

            } else {

                $_SESSION['error'] =
                    "Erreur lors de l'ajout.";
            }

            header('Location: emploi_temps.php');
            exit();
        }
    }

    // Modifier un emploi du temps
    public function handleUpdate()
    {
        if (
            $_SERVER['REQUEST_METHOD'] === 'POST'
            && isset($_POST['update_emploi'])
        ) {

            $resultat = $this->emploiModel->update(
                $_POST['id'],
                $_POST['jour'],
                $_POST['heure_debut'],
                $_POST['heure_fin'],
                $_POST['id_classe'],
                $_POST['id_matiere'],
                $_POST['id_enseignant']
            );

            if ($resultat) {

                $_SESSION['success'] =
                    "Emploi du temps modifié avec succès.";

            } else {

                $_SESSION['error'] =
                    "Erreur lors de la modification.";
            }

            header('Location: emploi_temps.php');
            exit();
        }
    }

    // Supprimer un emploi du temps
    public function handleDelete()
    {
        if (
            $_SERVER['REQUEST_METHOD'] === 'POST'
            && isset($_POST['delete_emploi'])
        ) {

            $resultat =
                $this->emploiModel->delete($_POST['id']);

            if ($resultat) {

                $_SESSION['success'] =
                    "Emploi du temps supprimé avec succès.";

            } else {

                $_SESSION['error'] =
                    "Erreur lors de la suppression.";
            }

            header('Location: emploi_temps.php');
            exit();
        }
    }

    // Récupérer un emploi du temps par ID
    public function getById($id)
    {
        return $this->emploiModel->getById($id);
    }
}