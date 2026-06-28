<?php

require_once __DIR__ . '/../models/UtilisateursModels.php';

class AuthController
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            
            $email = $_POST['email'];
            $mdp   = $_POST['mdp'];

            $utilisateur = new Utilisateur($this->db);

            $user = $utilisateur->login($email, $mdp);

            if ($user)
            {
                session_start();

                $_SESSION['id'] = $user['id'];
                $_SESSION['nom'] = $user['nom'];
                $_SESSION['prenom'] = $user['prenom'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['role'] = $user['role'];

                if ($user['role'] == 'admin')
                {
                    header('Location: views/admin/dashboard.php');
                }

                elseif ($user['role'] == 'enseignant')
                {
                    header('Location: views/enseignants/dashboard.php');
                }

                elseif ($user['role'] == 'etudiant')
                {
                    header('Location: views/etudiants/dashboard.php');
                }

                exit();
            }
            else
            {
                echo "Email ou mot de passe incorrect.";
            }
        }
    }
}