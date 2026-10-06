CREATE DATABASE IF NOT EXISTS inventaris_db;

USE inventaris_db;

-- =========================
-- TABEL KATEGORI
-- =========================
CREATE TABLE kategori (
    id_kategori INT AUTO_INCREMENT PRIMARY KEY,
    nama_kategori VARCHAR(100) NOT NULL
);

-- =========================
-- TABEL SUPPLIER
-- =========================
CREATE TABLE supplier (
    id_supplier INT AUTO_INCREMENT PRIMARY KEY,
    nama_supplier VARCHAR(100) NOT NULL,
    kontak VARCHAR(100),
    alamat TEXT
);

-- =========================
-- TABEL PRODUK
-- =========================
CREATE TABLE produk (
    id_produk INT AUTO_INCREMENT PRIMARY KEY,
    nama_produk VARCHAR(150) NOT NULL,
    harga DECIMAL(12,2) NOT NULL,
    stok INT NOT NULL DEFAULT 0,
    id_kategori INT NOT NULL,
    id_supplier INT NOT NULL,

    CONSTRAINT fk_produk_kategori
        FOREIGN KEY (id_kategori)
        REFERENCES kategori(id_kategori)
        ON UPDATE CASCADE
        ON DELETE RESTRICT,

    CONSTRAINT fk_produk_supplier
        FOREIGN KEY (id_supplier)
        REFERENCES supplier(id_supplier)
        ON UPDATE CASCADE
        ON DELETE RESTRICT
);

-- =========================
-- DATA KATEGORI
-- =========================
INSERT INTO kategori (nama_kategori) VALUES
('Laptop'),
('Aksesoris'),
('Smartphone'),
('Peralatan Kantor'),
('Komponen Komputer');

-- =========================
-- DATA SUPPLIER
-- =========================
INSERT INTO supplier (nama_supplier, kontak, alamat) VALUES
('PT Teknologi Nusantara', '081234567890', 'Medan'),
('CV Komputer Jaya', '081298765432', 'Medan'),
('PT Digital Indonesia', '082112223333', 'Jakarta'),
('CV Sumber Elektronik', '085677889900', 'Bandung'),
('PT Mitra Komputer', '081355667788', 'Surabaya');

-- =========================
-- DATA PRODUK
-- =========================
INSERT INTO produk
(nama_produk, harga, stok, id_kategori, id_supplier)
VALUES
('Acer Aspire Go 14', 6399000, 10, 1, 1),
('Mouse Wireless Logitech', 250000, 25, 2, 2),
('Keyboard Mechanical', 750000, 15, 2, 2),
('Samsung Galaxy A56', 5999000, 8, 3, 3),
('RAM DDR4 8GB', 450000, 20, 5, 5);