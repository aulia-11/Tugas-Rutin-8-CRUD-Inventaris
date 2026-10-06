<?php

require_once __DIR__ . '/../config/Database.php';

class Supplier
{
    private $db;

    public function __construct()
    {
        $database = Database::getInstance();
        $this->db = $database->getConnection();
    }

    public function getAll()
    {
        $query = "SELECT * FROM supplier ORDER BY nama_supplier ASC";

        $stmt = $this->db->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll();
    }
}