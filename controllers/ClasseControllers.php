<?php

require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../models/ClasseModels.php';

class ClasseController
{
    private $classeModel;

    public function __construct()
    {
        global $pdo;

        $this->classeModel = new Classe($pdo);
    }

    // Afficher toutes les classes
    public function index()
    {
        return $this->classeModel->getAll();
    }

    // Afficher une seule classe
    public function show($id)
    {
        return $this->classeModel->getById($id);
    }

    // Ajouter une classe
    public function handleCreate()
    {
        if (
            $_SERVER['REQUEST_METHOD'] === 'POST' &&
            isset($_POST['add_classe'])
        ) {

            $nom = trim($_POST['nom']);

            $result = $this->classeModel->create($nom);

            if ($result === true) {

                $_SESSION['success'] =
                    "Classe ajoutée avec succès.";

            } else {

                $_SESSION['error'] = $result;

            }

            header('Location: classes.php');
            exit();
        }
    }

    // Modifier une classe
    public function handleUpdate()
    {
        if (
            $_SERVER['REQUEST_METHOD'] === 'POST' &&
            isset($_POST['update_classe'])
        ) {

            $id = $_POST['id'];
            $nom = trim($_POST['nom']);

            $result = $this->classeModel->update(
                $id,
                $nom
            );

            if ($result) {

                $_SESSION['success'] =
                    "Classe modifiée avec succès.";

            } else {

                $_SESSION['error'] =
                    "Erreur lors de la modification.";

            }

            header('Location: classes.php');
            exit();
        }
    }

    // Supprimer une classe
    public function handleDelete()
    {
        if (
            $_SERVER['REQUEST_METHOD'] === 'POST' &&
            isset($_POST['delete_classe'])
        ) {

            $id = $_POST['id'];

            $result =
                $this->classeModel->delete($id);

            if ($result === true) {

                $_SESSION['success'] =
                    "Classe supprimée avec succès.";

            } else {

                $_SESSION['error'] = $result;

            }

            header('Location: classes.php');
            exit();
        }
    }
}