<?php

require_once __DIR__ . '/../models/Produk.php';

$produkModel = new Produk();
$dataProduk = $produkModel->getAll();

$status = $_GET['status'] ?? '';
$message = $_GET['message'] ?? '';

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Inventaris Barang</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="container">

        <h1>📦 Sistem Inventaris Barang</h1>

        <p class="subtitle">
            Daftar produk yang tersedia
        </p>

        <?php if ($message): ?>

            <div class="alert <?= $status === 'success' ? 'success' : 'error'; ?>">
                <?= htmlspecialchars($message); ?>
            </div>

        <?php endif; ?>

        <a href="tambah.php" class="btn-tambah">
            + Tambah Produk
        </a>

        <div class="table-container">

            <table>

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Supplier</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    <?php if (count($dataProduk) > 0): ?>

                        <?php $no = 1; ?>

                        <?php foreach ($dataProduk as $produk): ?>

                            <tr>

                                <td>
                                    <?= $no++; ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($produk['nama_produk']); ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($produk['nama_kategori']); ?>
                                </td>

                                <td>
                                    Rp <?= number_format($produk['harga'], 0, ',', '.'); ?>
                                </td>

                                <td>
                                    <?= $produk['stok']; ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($produk['nama_supplier']); ?>
                                </td>

                                <td>
                                    <a href="edit.php?id=<?= $produk['id_produk']; ?>">
                                        Edit
                                    </a>

                                    <a href="hapus.php?id=<?= $produk['id_produk']; ?>"
                                       onclick="return confirm('Yakin ingin menghapus produk ini?');">
                                        Hapus
                                    </a>
                                </td>

                            </tr>

                        <?php endforeach; ?>

                    <?php else: ?>

                        <tr>
                            <td colspan="7">
                                Belum ada data produk.
                            </td>
                        </tr>

                    <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>

</body>

</html>