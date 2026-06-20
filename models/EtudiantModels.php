
<?php

class Etudiant
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

     // Dashboard Admin
    public function count()
    {
        $sql = "SELECT COUNT(*) as total FROM etudiant";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    // Afficher tous les étudiants
 public function getAll()
{
    $sql = "SELECT 
                etudiant.id,
                etudiant.id_classe,
                user.prenom,
                user.nom,
                user.email,
                classe.nom AS classe
            FROM etudiant
            INNER JOIN user
                ON etudiant.user_id = user.id
            LEFT JOIN classe
                ON etudiant.id_classe = classe.id
            ORDER BY user.nom ASC";

    $stmt = $this->conn->prepare($sql);

    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

    // Récupérer un étudiant par son ID
    public function getById($id)
{
    $sql = "SELECT 
                e.id,
                u.prenom,
                u.nom,
                u.email,
                e.id_classe
            FROM etudiant e
            INNER JOIN user u
                ON e.user_id = u.id
            WHERE e.id = ?";

    $stmt = $this->conn->prepare($sql);

    $stmt->execute([$id]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}


    public function create($prenom, $nom, $email, $mdp, $id_classe)
{
    try {
        
        // Vérifier si l'email existe déjà
        $sql = "SELECT id FROM user WHERE email = ?";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([$email]);

        if ($stmt->rowCount() > 0) {
            return "❌ Cet email existe déjà.";
        }

        // Début de la transaction
        $this->conn->beginTransaction();

        // Hash du mot de passe
        $password = password_hash($mdp, PASSWORD_DEFAULT);

        // Insertion dans user
        $sql = "INSERT INTO user (prenom, nom, email, mdp, role)
                VALUES (?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([
            $prenom,
            $nom,
            $email,
            $password,
            'etudiant'
        ]);

        // Récupérer l'id du user créé
        $userId = $this->conn->lastInsertId();

        // Insertion dans etudiant
        $sql = "INSERT INTO etudiant (user_id, id_classe)
                VALUES (?, ?)";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([
            $userId,
            $id_classe
        ]);

        // Validation
        $this->conn->commit();

        return true;

    } catch (PDOException $e) {

        // Annulation en cas d'erreur
        $this->conn->rollBack();

        return "Erreur : " . $e->getMessage();
    }
}

public function update($id, $prenom, $nom, $email, $id_classe)
{
    try {

        $this->conn->beginTransaction();

        // Récupérer le user_id
        $sql = "SELECT user_id FROM etudiant WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);

        $etudiant = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$etudiant) {
            return false;
        }

        // Mise à jour utilisateur
        $sql = "UPDATE user
                SET prenom = ?, nom = ?, email = ?
                WHERE id = ?";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([
            $prenom,
            $nom,
            $email,
            $etudiant['user_id']
        ]);

        // Mise à jour classe
        $sql = "UPDATE etudiant
                SET id_classe = ?
                WHERE id = ?";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([
            $id_classe,
            $id
        ]);

        $this->conn->commit();

        return true;

    } catch(PDOException $e) {

        $this->conn->rollBack();

        echo $e->getMessage();

        return false;
    }
}


public function delete($id)
{
    try {

        $this->conn->beginTransaction();

        // Récupérer le user_id associé à l'étudiant
        $sql = "SELECT user_id FROM etudiant WHERE id = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);

        $etudiant = $stmt->fetch(PDO::FETCH_ASSOC);

        // Vérifier si l'étudiant existe
        if (!$etudiant) {
            return false;
        }

        // Supprimer l'utilisateur
        // Grâce au ON DELETE CASCADE,
        // l'enregistrement dans etudiant sera supprimé automatiquement
        $sql = "DELETE FROM user WHERE id = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$etudiant['user_id']]);

        $this->conn->commit();

        return true;

    } catch (PDOException $e) {

        $this->conn->rollBack();

        echo "Erreur : " . $e->getMessage();

        return false;
    }
}

}