<?php

class Classe
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Compter les classes
    public function count()
    {
        $sql = "SELECT COUNT(*) AS total FROM classe";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    // Afficher toutes les classes
    public function getAll()
    {
        $sql = "SELECT * FROM classe
                ORDER BY nom ASC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupérer une classe par ID
    public function getById($id)
    {
        $sql = "SELECT *
                FROM classe
                WHERE id = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Ajouter une classe
    public function create($nom)
    {
        try {

            // Vérifier si la classe existe déjà
            $sql = "SELECT id
                    FROM classe
                    WHERE nom = ?";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$nom]);

            if ($stmt->rowCount() > 0) {

                return "❌ Cette classe existe déjà.";

            }

            $sql = "INSERT INTO classe(nom)
                    VALUES(?)";

            $stmt = $this->conn->prepare($sql);

            return $stmt->execute([$nom]);

        } catch(PDOException $e) {

            return "Erreur : " . $e->getMessage();

        }
    }

    // Modifier une classe
    public function update($id, $nom)
    {
        try {

            $sql = "UPDATE classe
                    SET nom = ?
                    WHERE id = ?";

            $stmt = $this->conn->prepare($sql);

            return $stmt->execute([
                $nom,
                $id
            ]);

        } catch(PDOException $e) {

            return false;

        }
    }

    // Supprimer une classe
    public function delete($id)
    {
        try {

            // Vérifier si des étudiants utilisent cette classe
            $sql = "SELECT COUNT(*) AS total
                    FROM etudiant
                    WHERE id_classe = ?";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$id]);

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result['total'] > 0) {

                return "❌ Impossible de supprimer cette classe car elle contient des étudiants.";

            }

            $sql = "DELETE FROM classe
                    WHERE id = ?";

            $stmt = $this->conn->prepare($sql);

            return $stmt->execute([$id]);

        } catch(PDOException $e) {

            return "Erreur : " . $e->getMessage();

        }
    }
}