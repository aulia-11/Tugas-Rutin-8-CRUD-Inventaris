<?php

require_once __DIR__ . '/../config/Database.php';

class Produk
{
    private $db;

    public function __construct()
    {
        $database = Database::getInstance();
        $this->db = $database->getConnection();
    }

    public function getAll()
    {
        $query = "
           SELECT
                produk.id_produk,
                produk.nama_produk,
                produk.harga,
                produk.stok,
                kategori.nama_kategori,
                supplier.nama_supplier
            FROM produk
            INNER JOIN kategori
                ON produk.id_kategori = kategori.id_kategori
            INNER JOIN supplier
                ON produk.id_supplier = supplier.id_supplier
            ORDER BY produk.id_produk DESC
        ";

        $stmt = $this->db->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function create($nama_produk, $harga, $stok, $id_kategori, $id_supplier)
{
    $query = "
        INSERT INTO produk
        (nama_produk, harga, stok, id_kategori, id_supplier)
        VALUES
        (:nama_produk, :harga, :stok, :id_kategori, :id_supplier)
    ";

    $stmt = $this->db->prepare($query);

    return $stmt->execute([
        ':nama_produk' => $nama_produk,
        ':harga' => $harga,
        ':stok' => $stok,
        ':id_kategori' => $id_kategori,
        ':id_supplier' => $id_supplier
    ]);
}

public function getById($id)
{
    $query = "
        SELECT *
        FROM produk
        WHERE id_produk = :id
    ";

    $stmt = $this->db->prepare($query);
    $stmt->execute([
        ':id' => $id
    ]);

    return $stmt->fetch();
}

public function update(
    $id,
    $nama_produk,
    $harga,
    $stok,
    $id_kategori,
    $id_supplier
) {
    $query = "
        UPDATE produk
        SET
            nama_produk = :nama_produk,
            harga = :harga,
            stok = :stok,
            id_kategori = :id_kategori,
            id_supplier = :id_supplier
        WHERE id_produk = :id
    ";

    $stmt = $this->db->prepare($query);

    return $stmt->execute([
        ':nama_produk' => $nama_produk,
        ':harga' => $harga,
        ':stok' => $stok,
        ':id_kategori' => $id_kategori,
        ':id_supplier' => $id_supplier,
        ':id' => $id
    ]);
}

public function delete($id)
{
    $query = "
        DELETE FROM produk
        WHERE id_produk = :id
    ";

    $stmt = $this->db->prepare($query);

    return $stmt->execute([
        ':id' => $id
    ]);
}
}