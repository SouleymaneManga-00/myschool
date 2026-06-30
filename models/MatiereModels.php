<?php

class Matiere
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function count()
    {
        $sql = "SELECT COUNT(*) as total FROM matiere";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public function getAll()
    {
        $sql = "SELECT
                    m.id,
                    m.nom,
                    m.coeff,
                    e.id as enseignant_id,
                    u.prenom,
                    u.nom as nom_enseignant
                FROM matiere m
                LEFT JOIN enseignant e
                    ON m.enseignant_id = e.id
                LEFT JOIN user u
                    ON e.user_id = u.id
                ORDER BY m.nom ASC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $sql = "SELECT *
                FROM matiere
                WHERE id = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($nom, $coeff, $enseignant_id)
{
    try {

        $sql = "INSERT INTO matiere(nom, coeff, enseignant_id)
                VALUES(?, ?, ?)";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            $nom,
            $coeff,
            $enseignant_id
        ]);

    } catch(PDOException $e) {

        return "Erreur : " . $e->getMessage();

    }
}

public function update($id, $nom, $coeff, $enseignant_id)
{
    try {

        $sql = "UPDATE matiere
                SET nom = ?, coeff = ?, enseignant_id = ?
                WHERE id = ?";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            $nom,
            $coeff,
            $enseignant_id,
            $id
        ]);

    } catch(PDOException $e) {

        return false;

    }
}

public function delete($id)
{
    try {

        $sql = "DELETE FROM matiere
                WHERE id = ?";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([$id]);

    } catch(PDOException $e) {

        return false;

    }
}
}