<?php

class Profil
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    /*
    ================================
        Récupérer le profil
    ================================
    */

    public function getById($id)
    {
        $sql = "SELECT
                    id,
                    prenom,
                    nom,
                    email,
                    role,
                    photo,
                    updated_at
                FROM user
                WHERE id = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /*
    ================================
        Modifier les informations
    ================================
    */

    public function updateInformations($id, $prenom, $nom, $email)
    {
        try {

            $sql = "UPDATE user
                    SET
                        prenom = ?,
                        nom = ?,
                        email = ?
                    WHERE id = ?";

            $stmt = $this->conn->prepare($sql);

            return $stmt->execute([
                $prenom,
                $nom,
                $email,
                $id
            ]);

        } catch (PDOException $e) {

            return false;

        }
    }

    /*
    ================================
        Modifier le mot de passe
    ================================
    */

    public function updatePassword($id, $password)
    {
        try {

            $password = password_hash($password, PASSWORD_DEFAULT);

            $sql = "UPDATE user
                    SET mdp = ?
                    WHERE id = ?";

            $stmt = $this->conn->prepare($sql);

            return $stmt->execute([
                $password,
                $id
            ]);

        } catch (PDOException $e) {

            return false;

        }
    }

    /*
    ================================
        Modifier la photo
    ================================
    */

    public function updatePhoto($id, $photo)
    {
        try {

            $sql = "UPDATE user
                    SET photo = ?
                    WHERE id = ?";

            $stmt = $this->conn->prepare($sql);

            return $stmt->execute([
                $photo,
                $id
            ]);

        } catch (PDOException $e) {

            return false;

        }
    }
}