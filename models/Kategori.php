<?php

require_once __DIR__ . '/../config/Database.php';

class Kategori
{
    private $db;

    public function __construct()
    {
        $database = Database::getInstance();
        $this->db = $database->getConnection();
    }

    public function getAll()
    {
        $query = "SELECT * FROM kategori ORDER BY nama_kategori ASC";

        $stmt = $this->db->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll();
    }
}