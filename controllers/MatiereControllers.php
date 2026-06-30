<?php

require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../models/MatiereModels.php';

class MatiereController
{
    private $matiereModel;

    public function __construct()
    {
        global $pdo;

        $this->matiereModel = new Matiere($pdo);
    }

    public function index()
    {
        return $this->matiereModel->getAll();
    }

    public function show($id)
    {
        return $this->matiereModel->getById($id);
    }

    public function handleCreate()
    {
    if(
        $_SERVER['REQUEST_METHOD'] === 'POST'
        && isset($_POST['add_matiere'])
    ){

        $nom = trim($_POST['nom']);
        $coeff = $_POST['coeff'];
        $enseignant_id = $_POST['enseignant_id'];

        $result = $this->matiereModel->create(
            $nom,
            $coeff,
            $enseignant_id
        );

        if($result){

            $_SESSION['success'] =
                "Matière ajoutée avec succès.";

        }else{

            $_SESSION['error'] =
                "Erreur lors de l'ajout.";

        }

        header('Location: matieres.php');
        exit();
    }
}

  public function handleUpdate()
{
    if(
        $_SERVER['REQUEST_METHOD'] === 'POST'
        && isset($_POST['update_matiere'])
    ){

        $result = $this->matiereModel->update(
            $_POST['id'],
            $_POST['nom'],
            $_POST['coeff'],
            $_POST['enseignant_id']
        );

        if($result){

            $_SESSION['success'] =
                "Matière modifiée avec succès.";

        }else{

            $_SESSION['error'] =
                "Erreur lors de la modification.";

        }

        header('Location: matieres.php');
        exit();
    }
}

public function handleDelete()
{
    
var_dump($_POST);
    if(
        $_SERVER['REQUEST_METHOD'] === 'POST'
        && isset($_POST['delete_matiere'])
    ){

        $result =
            $this->matiereModel->delete($_POST['id']);

        if($result){

            $_SESSION['success'] =
                "Matière supprimée avec succès.";

        }else{

            $_SESSION['error'] =
                "Erreur lors de la suppression.";

        }

        header('Location: matieres.php');
        exit();
    }
}

}