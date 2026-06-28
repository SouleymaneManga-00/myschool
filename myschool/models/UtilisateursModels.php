<?php

class Utilisateur
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function login($email, $mdp)
    {
        $sql = "SELECT * FROM user WHERE email = ? AND mdp = ?";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([$email, $mdp]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}