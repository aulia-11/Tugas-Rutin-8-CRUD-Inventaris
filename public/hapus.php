<?php

require_once __DIR__ . '/../models/Produk.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = (int) $_GET['id'];

$produkModel = new Produk();

$berhasil = $produkModel->delete($id);

if ($berhasil) {

    header(
        "Location: index.php?status=success&message=Produk berhasil dihapus."
    );
    exit;

} else {

    header(
        "Location: index.php?status=error&message=Produk gagal dihapus."
    );
    exit;
}