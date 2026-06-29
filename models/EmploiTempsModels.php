<?php

class EmploiDuTemps
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Afficher tous les emplois du temps
    public function getAll()
    {
        $sql = "
            SELECT
                edt.id,
                edt.jour,
                edt.heure_debut,
                edt.heure_fin,

                c.id AS id_classe,
                c.nom AS classe,

                m.id AS id_matiere,
                m.nom AS matiere,

                e.id AS id_enseignant,
                u.prenom,
                u.nom AS enseignant

            FROM emploi_du_temps edt

            INNER JOIN classe c
                ON edt.id_classe = c.id

            INNER JOIN matiere m
                ON edt.id_matiere = m.id

            INNER JOIN enseignant e
                ON edt.id_enseignant = e.id

            INNER JOIN user u
                ON e.user_id = u.id

            ORDER BY
                FIELD(
                    edt.jour,
                    'Lundi',
                    'Mardi',
                    'Mercredi',
                    'Jeudi',
                    'Vendredi',
                    'Samedi'
                ),
                edt.heure_debut
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupérer un emploi du temps par ID
    public function getById($id)
    {
        $sql = "
            SELECT *
            FROM emploi_du_temps
            WHERE id = ?
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Ajouter
    public function create(
        $jour,
        $heure_debut,
        $heure_fin,
        $id_classe,
        $id_matiere,
        $id_enseignant
    ) {

        try {

            $sql = "
                INSERT INTO emploi_du_temps(
                    jour,
                    heure_debut,
                    heure_fin,
                    id_classe,
                    id_matiere,
                    id_enseignant
                )
                VALUES (?, ?, ?, ?, ?, ?)
            ";

            $stmt = $this->conn->prepare($sql);

            return $stmt->execute([
                $jour,
                $heure_debut,
                $heure_fin,
                $id_classe,
                $id_matiere,
                $id_enseignant
            ]);

        } catch(PDOException $e) {

            return false;

        }
    }

    // Modifier
    public function update(
        $id,
        $jour,
        $heure_debut,
        $heure_fin,
        $id_classe,
        $id_matiere,
        $id_enseignant
    ) {

        try {

            $sql = "
                UPDATE emploi_du_temps
                SET
                    jour = ?,
                    heure_debut = ?,
                    heure_fin = ?,
                    id_classe = ?,
                    id_matiere = ?,
                    id_enseignant = ?
                WHERE id = ?
            ";

            $stmt = $this->conn->prepare($sql);

            return $stmt->execute([
                $jour,
                $heure_debut,
                $heure_fin,
                $id_classe,
                $id_matiere,
                $id_enseignant,
                $id
            ]);

        } catch(PDOException $e) {

            return false;

        }
    }

    // Supprimer
    public function delete($id)
    {
        try {

            $sql = "
                DELETE FROM emploi_du_temps
                WHERE id = ?
            ";

            $stmt = $this->conn->prepare($sql);

            return $stmt->execute([$id]);

        } catch(PDOException $e) {

            return false;

        }
    }

    // Compter les emplois du temps
    public function count()
    {
        $sql = "
            SELECT COUNT(*) AS total
            FROM emploi_du_temps
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result['total'];
    }
}