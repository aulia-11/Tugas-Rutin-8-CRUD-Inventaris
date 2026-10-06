<?php

require_once __DIR__ . '/../models/Produk.php';
require_once __DIR__ . '/../models/Kategori.php';
require_once __DIR__ . '/../models/Supplier.php';

$produkModel = new Produk();
$kategoriModel = new Kategori();
$supplierModel = new Supplier();

$kategori = $kategoriModel->getAll();
$supplier = $supplierModel->getAll();

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nama_produk = trim($_POST['nama_produk']);
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $id_kategori = $_POST['id_kategori'];
    $id_supplier = $_POST['id_supplier'];

    if (
        empty($nama_produk) ||
        empty($harga) ||
        $stok === '' ||
        empty($id_kategori) ||
        empty($id_supplier)
    ) {
        $error = "Semua data harus diisi.";
    } elseif ($harga < 0 || $stok < 0) {
        $error = "Harga dan stok tidak boleh bernilai negatif.";
    } else {

        $berhasil = $produkModel->create(
            $nama_produk,
            $harga,
            $stok,
            $id_kategori,
            $id_supplier
        );

        if ($berhasil) {
            header("Location: index.php?status=success&message=Produk berhasil ditambahkan.");
            exit;
        } else {
            $error = "Produk gagal ditambahkan.";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tambah Produk</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

    <div class="container">

        <h1>➕ Tambah Produk</h1>

        <p class="subtitle">
            Tambahkan produk baru ke dalam inventaris.
        </p>

        <?php if ($error): ?>

            <div class="alert error">
                <?= htmlspecialchars($error); ?>
            </div>

        <?php endif; ?>

        <form method="POST">

            <div class="form-group">

                <label for="nama_produk">
                    Nama Produk
                </label>

                <input
                    type="text"
                    id="nama_produk"
                    name="nama_produk"
                    placeholder="Masukkan nama produk"
                    value="<?= isset($_POST['nama_produk']) ? htmlspecialchars($_POST['nama_produk']) : ''; ?>"
                    required
                >

            </div>

            <div class="form-group">

                <label for="harga">
                    Harga
                </label>

                <input
                    type="number"
                    id="harga"
                    name="harga"
                    min="0"
                    placeholder="Contoh: 500000"
                    value="<?= isset($_POST['harga']) ? htmlspecialchars($_POST['harga']) : ''; ?>"
                    required
                >

            </div>

            <div class="form-group">

                <label for="stok">
                    Stok
                </label>

                <input
                    type="number"
                    id="stok"
                    name="stok"
                    min="0"
                    placeholder="Contoh: 10"
                    value="<?= isset($_POST['stok']) ? htmlspecialchars($_POST['stok']) : ''; ?>"
                    required
                >

            </div>

            <div class="form-group">

                <label for="id_kategori">
                    Kategori
                </label>

                <select id="id_kategori" name="id_kategori" required>

                    <option value="">
                        -- Pilih Kategori --
                    </option>

                    <?php foreach ($kategori as $item): ?>

                        <option
                            value="<?= $item['id_kategori']; ?>"
                            <?= (isset($_POST['id_kategori']) && $_POST['id_kategori'] == $item['id_kategori']) ? 'selected' : ''; ?>
                        >
                            <?= htmlspecialchars($item['nama_kategori']); ?>
                        </option>

                    <?php endforeach; ?>

                </select>

            </div>

            <div class="form-group">

                <label for="id_supplier">
                    Supplier
                </label>

                <select id="id_supplier" name="id_supplier" required>

                    <option value="">
                        -- Pilih Supplier --
                    </option>

                    <?php foreach ($supplier as $item): ?>

                        <option
                            value="<?= $item['id_supplier']; ?>"
                            <?= (isset($_POST['id_supplier']) && $_POST['id_supplier'] == $item['id_supplier']) ? 'selected' : ''; ?>
                        >
                            <?= htmlspecialchars($item['nama_supplier']); ?>
                        </option>

                    <?php endforeach; ?>

                </select>

            </div>

            <div class="form-actions">

                <button type="submit" class="btn-simpan">
                    Simpan Produk
                </button>

                <a href="index.php" class="btn-kembali">
                    Kembali
                </a>

            </div>

        </form>

    </div>

</body>

</html>