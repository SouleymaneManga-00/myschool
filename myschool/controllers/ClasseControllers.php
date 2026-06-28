<?php

require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../models/ClasseModels.php';

class ClasseController
{
    private $classe;

    public function __construct()
    {
        global $pdo;

        $this->classe = new Classe($pdo);
    }

    public function index()
    {
        return $this->classe->getAll();
    }
}