<?php

class Enseignant
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function count()
    {
        $sql = "SELECT COUNT(*) as total FROM enseignant";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    // Afficher tous les enseignants
public function getAll()
{
    $sql = "SELECT
                enseignant.id,
                user.prenom,
                user.nom,
                user.email,
                enseignant.specialite
            FROM enseignant
            INNER JOIN user
                ON enseignant.user_id = user.id
            ORDER BY user.nom ASC";

    $stmt = $this->conn->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Recupérer un enseignant

public function getById($id)
{
    $sql = "SELECT
                e.id,
                u.prenom,
                u.nom,
                u.email,
                e.specialite
            FROM enseignant e
            INNER JOIN user u
                ON e.user_id = u.id
            WHERE e.id = ?";

    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$id]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

//Ajouter un enseignant

public function create(
    $prenom,
    $nom,
    $email,
    $mdp,
    $specialite
)
{
    try {

        $sql = "SELECT id
                FROM user
                WHERE email = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$email]);

        if ($stmt->rowCount() > 0) {
            return "❌ Cet email existe déjà.";
        }

        $this->conn->beginTransaction();

        $password = password_hash(
            $mdp,
            PASSWORD_DEFAULT
        );

        $sql = "INSERT INTO user
                (prenom, nom, email, mdp, role)
                VALUES (?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([
            $prenom,
            $nom,
            $email,
            $password,
            'enseignant'
        ]);

        $userId =
            $this->conn->lastInsertId();

        $sql = "INSERT INTO enseignant
                (user_id, specialite)
                VALUES (?, ?)";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([
            $userId,
            $specialite
        ]);

        $this->conn->commit();

        return true;

    } catch(PDOException $e) {

        $this->conn->rollBack();

        return $e->getMessage();
    }
}

//Modifier un enseignant

public function update(
    $id,
    $prenom,
    $nom,
    $email,
    $specialite
)
{
    try {

        $this->conn->beginTransaction();

        $sql = "SELECT user_id
                FROM enseignant
                WHERE id = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);

        $enseignant =
            $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$enseignant) {
            return false;
        }

        $sql = "UPDATE user
                SET prenom = ?,
                    nom = ?,
                    email = ?
                WHERE id = ?";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([
            $prenom,
            $nom,
            $email,
            $enseignant['user_id']
        ]);

        $sql = "UPDATE enseignant
                SET specialite = ?
                WHERE id = ?";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([
            $specialite,
            $id
        ]);

        $this->conn->commit();

        return true;

    } catch(PDOException $e) {

        $this->conn->rollBack();

        return false;
    }
}

// Supprimer un enseignant

public function delete($id)
{
    try {

        // Vérifier si l'enseignant possède des matières
        $sql = "SELECT COUNT(*) AS total
                FROM matiere
                WHERE enseignant_id = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result['total'] > 0) {
            return "matiere_exist";
        }

        $this->conn->beginTransaction();

        // Récupérer le user_id
        $sql = "SELECT user_id
                FROM enseignant
                WHERE id = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);

        $enseignant = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$enseignant) {
            return false;
        }

        // Supprimer l'enseignant
        $sql = "DELETE FROM enseignant
                WHERE id = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);

        // Supprimer l'utilisateur associé
        $sql = "DELETE FROM user
                WHERE id = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$enseignant['user_id']]);

        $this->conn->commit();

        return true;

    } catch(PDOException $e) {

        $this->conn->rollBack();
        return false;
    }
}

}