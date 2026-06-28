<?php

require_once __DIR__ . '/../models/EtudiantModels.php';
require_once __DIR__ . '/../models/EnseignantsModels.php';
require_once __DIR__ . '/../models/ClasseModels.php';
require_once __DIR__ . '/../models/MatiereModels.php';

class AdminController
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function dashboard()
    {
        $etudiant = new Etudiant($this->db);
        $enseignant = new Enseignant($this->db);
        $classe = new Classe($this->db);
        $matiere = new Matiere($this->db);

        return [
            'nbEtudiants' => $etudiant->count(),
            'nbEnseignants' => $enseignant->count(),
            'nbClasses' => $classe->count(),
            'nbMatieres' => $matiere->count()
        ];
    }
}