
<?php

class Etudiant
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function count()
    {
        $sql = "SELECT COUNT(*) as total FROM etudiant";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }
}