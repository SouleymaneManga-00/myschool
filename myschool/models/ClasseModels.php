<?php

class Classe
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function count()
    {
        $sql = "SELECT COUNT(*) as total FROM classe";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public function getAll()
    {
        $sql = "SELECT * FROM classe ORDER BY nom ASC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
