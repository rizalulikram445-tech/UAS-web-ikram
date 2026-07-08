-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 01, 2026 at 05:28 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_umkm_produk`
--

-- --------------------------------------------------------

--
-- Table structure for table `kategori_produk`
--

CREATE TABLE `kategori_produk` (
  `id_kategori` int(10) UNSIGNED NOT NULL,
  `nama_kategori` varchar(80) NOT NULL,
  `deskripsi_kategori` varchar(250) DEFAULT NULL,
  `status_kategori` enum('aktif','nonaktif') NOT NULL DEFAULT 'aktif',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategori_produk`
--

INSERT INTO `kategori_produk` (`id_kategori`, `nama_kategori`, `deskripsi_kategori`, `status_kategori`, `created_at`, `updated_at`) VALUES
(1, 'Makanan', 'Produk makanan ringan, kue, dan olahan lokal.', 'aktif', '2026-07-01 01:13:05', '2026-07-01 01:13:05'),
(2, 'Minuman', 'Minuman kemasan, kopi, teh, dan jamu.', 'aktif', '2026-07-01 01:13:05', '2026-07-01 01:13:05'),
(3, 'Kerajinan', 'Produk handmade dan kerajinan lokal.', 'aktif', '2026-07-01 01:13:05', '2026-07-01 01:13:05'),
(4, 'Fashion', 'Pakaian, aksesori, dan produk tekstil.', 'aktif', '2026-07-01 01:13:05', '2026-07-01 01:13:05');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(10) UNSIGNED NOT NULL,
  `id_kategori` int(10) UNSIGNED NOT NULL,
  `nama_produk` varchar(120) NOT NULL,
  `sku` varchar(40) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `harga` decimal(12,2) NOT NULL DEFAULT 0.00,
  `stok` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `gambar_produk` varchar(255) DEFAULT NULL,
  `status_produk` enum('aktif','nonaktif') NOT NULL DEFAULT 'aktif',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `id_kategori`, `nama_produk`, `sku`, `deskripsi`, `harga`, `stok`, `gambar_produk`, `status_produk`, `created_at`, `updated_at`) VALUES
(1, 1, 'Keripik Pisang Manis', 'SKU-UMK-001', 'Camilan pisang renyah kemasan 250 gram.', 18000.00, 45, 'keripik-pisang.jpg', 'aktif', '2026-07-01 01:13:05', '2026-07-01 01:13:05'),
(2, 3, 'Tas Anyaman Lokal', 'SKU-UMK-002', 'Tas anyaman handmade berbahan serat alami.', 125000.00, 16, 'tas-anyaman.jpg', 'aktif', '2026-07-01 01:13:05', '2026-07-01 01:13:05'),
(3, 2, 'Kopi Arabika 200g', 'SKU-UMK-003', 'Biji kopi arabika pilihan dari petani lokal.', 58000.00, 8, 'kopi-arabika.jpg', 'aktif', '2026-07-01 01:13:05', '2026-07-01 01:13:05');

-- --------------------------------------------------------

--
-- Table structure for table `user_login`
--

CREATE TABLE `user_login` (
  `id_user` int(10) UNSIGNED NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `username` varchar(60) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level_user` enum('admin','operator') NOT NULL DEFAULT 'operator',
  `status_user` enum('aktif','nonaktif') NOT NULL DEFAULT 'aktif',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_login`
--

INSERT INTO `user_login` (`id_user`, `nama_lengkap`, `username`, `password`, `level_user`, `status_user`, `created_at`, `updated_at`) VALUES
(1, 'Administrator UMKM', 'admin_umkm', 'password_hash_disimpan_di_backend', 'admin', 'aktif', '2026-07-01 01:13:05', '2026-07-01 01:13:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategori_produk`
--
ALTER TABLE `kategori_produk`
  ADD PRIMARY KEY (`id_kategori`),
  ADD UNIQUE KEY `nama_kategori` (`nama_kategori`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD UNIQUE KEY `sku` (`sku`),
  ADD KEY `idx_produk_nama` (`nama_produk`),
  ADD KEY `idx_produk_kategori` (`id_kategori`),
  ADD KEY `idx_produk_status` (`status_produk`);

--
-- Indexes for table `user_login`
--
ALTER TABLE `user_login`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategori_produk`
--
ALTER TABLE `kategori_produk`
  MODIFY `id_kategori` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_login`
--
ALTER TABLE `user_login`
  MODIFY `id_user` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `fk_produk_kategori` FOREIGN KEY (`id_kategori`) REFERENCES `kategori_produk` (`id_kategori`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;