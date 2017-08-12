-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 12, 2017 at 03:29 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `asputra`
--

-- --------------------------------------------------------

--
-- Table structure for table `galeries`
--

CREATE TABLE `galeries` (
  `id` int(10) UNSIGNED NOT NULL,
  `deskripsi` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `galeries`
--

INSERT INTO `galeries` (`id`, `deskripsi`, `foto`, `created_at`, `updated_at`) VALUES
(1, 'Ayam', 'cara budidaya ayam petelur.png', NULL, '2016-10-27 20:41:22'),
(2, 'Ayam Petelur', 'unduhan.jpg', NULL, NULL),
(3, 'Pembersihan Kandang', '1501semprot-kandang.jpg', NULL, NULL),
(4, 'Pengolahan', 'unduhan (1).jpg', NULL, NULL),
(5, 'Pangan', 'unduhan (3).jpg', NULL, NULL),
(8, 'Kandang', 'unduhan (2).jpg', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2016_10_06_015705_pembelian', 1),
('2016_10_06_021352_telur', 1),
('2016_10_06_021359_ayam', 1),
('2016_10_06_060733_create_permission_tables', 1),
('2016_10_10_044458_create_table_stok_telur', 1),
('2016_10_11_043808_create_table_pemesanan', 2),
('2016_10_13_022353_create_pembelians_table', 3),
('2016_10_13_063350_create_stok_ayams_table', 4),
('2013_06_27_143953_create_cronmanager_table', 5),
('2013_06_27_144035_create_cronjob_table', 5),
('2016_10_26_100821_create_galeries_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `id_pembelian` int(10) UNSIGNED NOT NULL,
  `tgl_pembelian` date NOT NULL,
  `tgl_non_produktif` date NOT NULL,
  `nama_barang` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `jml_pembelian` int(11) NOT NULL,
  `harga_satuan` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `konfirmasi_stok` enum('n','y') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'n',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`id_pembelian`, `tgl_pembelian`, `tgl_non_produktif`, `nama_barang`, `jml_pembelian`, `harga_satuan`, `total`, `konfirmasi_stok`, `created_at`, `updated_at`) VALUES
(1, '2016-10-25', '2016-11-28', 'Ayam', 30, 50000, 1500000, 'y', NULL, '2016-10-24 23:42:57'),
(2, '2016-09-14', '2016-10-11', 'Ayam', 50, 50000, 2500000, 'y', NULL, '2016-10-24 23:44:55');

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id_pemesanan` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `tgl_pemesanan` date NOT NULL,
  `jml_pemesanan` int(11) NOT NULL,
  `harga_per_peti` int(11) NOT NULL DEFAULT '200000',
  `total` int(11) NOT NULL,
  `alamat` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `konfirmasi_pemesanan` enum('n','y') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'n',
  `no_hp` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pemesanan`
--

INSERT INTO `pemesanan` (`id_pemesanan`, `user_id`, `tgl_pemesanan`, `jml_pemesanan`, `harga_per_peti`, `total`, `alamat`, `konfirmasi_pemesanan`, `no_hp`, `created_at`, `updated_at`) VALUES
(1, 3, '2016-10-28', 3, 200000, 600000, 'Desa Setianegara', 'y', '089673797344', NULL, '2016-11-24 19:01:14'),
(2, 2, '2016-11-24', 1, 200000, 200000, 'Desa Karangmangu', 'y', '089673797344', NULL, '2016-11-24 00:23:11'),
(3, 2, '2016-11-24', 1, 200000, 200000, 'Desa Karangmangu', 'y', '089673797344', NULL, '2016-11-24 00:22:55'),
(4, 2, '2016-11-24', 1, 200000, 200000, 'Desa Karangmangu', 'y', '089673797344', NULL, '2016-11-24 00:18:48'),
(5, 2, '2016-11-24', 2, 200000, 400000, 'Desa Karangmangu', 'y', '089673797344', NULL, '2016-11-24 00:17:53'),
(6, 2, '2016-11-24', 3, 200000, 600000, 'Desa Karangmangu', 'y', '089673797344', NULL, '2016-11-24 00:12:39'),
(7, 2, '2016-11-24', 10, 200000, 2000000, 'Desa Karangmangu', 'y', '089673797344', NULL, '2016-11-24 00:25:20'),
(8, 2, '2016-11-24', 11, 200000, 2200000, 'Desa Karangmangu', 'y', '089673797344', NULL, '2016-11-24 00:27:14'),
(9, 2, '2016-11-24', 12, 200000, 2400000, 'Desa Karangmangu', 'y', '089673797344', NULL, '2016-11-24 00:29:23'),
(10, 2, '2016-11-24', 13, 200000, 2600000, 'Desa Karangmangu', 'y', '089673797344', NULL, '2016-11-24 00:30:38'),
(11, 2, '2016-11-24', 33, 200000, 6600000, 'Desa Karangmangu', 'y', '089673797344', NULL, '2016-11-24 00:31:48'),
(12, 2, '2016-11-24', 11, 200000, 2200000, 'Desa Karangmangu', 'y', '089673797344', NULL, '2016-11-24 00:33:49'),
(13, 2, '2016-11-24', 2, 200000, 400000, 'Desa Karangmangu', 'y', '089673797344', NULL, '2016-11-24 00:36:21'),
(14, 2, '2016-11-24', 1, 200000, 200000, 'Desa Karangmangu', 'y', '089673797344', NULL, '2016-11-24 00:37:15'),
(15, 2, '2016-11-24', 1, 200000, 200000, 'Desa Karangmangu', 'y', '089673797344', NULL, '2016-11-24 00:39:09'),
(16, 2, '2016-11-24', 1, 200000, 200000, 'Desa Karangmangu', 'y', '089673797344', NULL, '2016-11-24 00:40:42'),
(17, 2, '2016-11-24', 1, 200000, 200000, 'Desa Karangmangu', 'y', '089673797344', NULL, '2016-11-24 00:45:07'),
(21, 2, '2016-11-24', 5, 200000, 1000000, 'Desa Karangmangu', 'y', '089673797344', NULL, '2016-11-24 02:18:35'),
(24, 2, '2016-11-24', 5, 200000, 1000000, 'Desa Karangmangu', 'y', '089673797344', NULL, '2016-11-24 18:56:15'),
(25, 2, '2016-11-25', 5, 200000, 1000000, 'Desa Karangmangu', 'y', '089673797344', NULL, '2016-11-24 18:57:26'),
(26, 2, '2016-11-25', 3, 200000, 600000, 'Desa Karangmangu', 'n', '089673797344', NULL, NULL),
(28, 2, '2016-11-25', 8, 200000, 1600000, 'Desa Karangmangu', 'y', '089673797344', NULL, '2016-11-25 00:05:40'),
(29, 2, '2016-12-20', 1, 200000, 200000, 'Desa Karangmangu', 'n', '089673797344', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `penjualan_ayam`
--

CREATE TABLE `penjualan_ayam` (
  `id_penjualan_ayam` int(10) UNSIGNED NOT NULL,
  `tgl_penjualan_ayam` date NOT NULL,
  `jml_penjualan_ayam` int(11) NOT NULL,
  `harga_per_ayam` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `alamat` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `no_hp` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `penjualan_ayam`
--

INSERT INTO `penjualan_ayam` (`id_penjualan_ayam`, `tgl_penjualan_ayam`, `jml_penjualan_ayam`, `harga_per_ayam`, `total`, `alamat`, `no_hp`, `created_at`, `updated_at`) VALUES
(1, '2016-10-25', 12, 50000, 600000, '', '', NULL, NULL),
(2, '2016-09-14', 12, 50000, 600000, '', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `penjualan_telur`
--

CREATE TABLE `penjualan_telur` (
  `id_penjualan_telur` int(10) UNSIGNED NOT NULL,
  `tgl_penjualan_telur` date NOT NULL,
  `jml_penjualan_telur` int(11) NOT NULL,
  `harga_per_peti` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `alamat` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `no_hp` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `penjualan_telur`
--

INSERT INTO `penjualan_telur` (`id_penjualan_telur`, `tgl_penjualan_telur`, `jml_penjualan_telur`, `harga_per_peti`, `total`, `alamat`, `no_hp`, `created_at`, `updated_at`) VALUES
(46, '2016-10-25', 30, 200000, 6000000, '', '', NULL, NULL),
(47, '2016-09-14', 50, 200000, 10000000, '', '', NULL, NULL),
(48, '2016-11-24', 3, 200000, 600000, 'Desa Karangmangu', '089673797344', NULL, NULL),
(49, '2016-11-24', 2, 200000, 400000, 'Desa Karangmangu', '089673797344', NULL, NULL),
(50, '2016-11-24', 1, 200000, 200000, 'Desa Karangmangu', '089673797344', NULL, NULL),
(51, '2016-11-24', 1, 200000, 200000, 'Desa Karangmangu', '089673797344', NULL, NULL),
(52, '2016-11-24', 1, 200000, 200000, 'Desa Karangmangu', '089673797344', NULL, NULL),
(53, '2016-11-24', 1, 200000, 200000, 'Desa Karangmangu', '089673797344', NULL, NULL),
(54, '2016-11-24', 10, 200000, 2000000, 'Desa Karangmangu', '089673797344', NULL, NULL),
(55, '2016-11-24', 11, 200000, 2200000, 'Desa Karangmangu', '089673797344', NULL, NULL),
(56, '2016-11-24', 12, 200000, 2400000, 'Desa Karangmangu', '089673797344', NULL, NULL),
(57, '2016-11-24', 13, 200000, 2600000, 'Desa Karangmangu', '089673797344', NULL, NULL),
(58, '2016-11-24', 33, 200000, 6600000, 'Desa Karangmangu', '089673797344', NULL, NULL),
(59, '2016-11-24', 11, 200000, 2200000, 'Desa Karangmangu', '089673797344', NULL, NULL),
(60, '2016-11-24', 2, 200000, 400000, 'Desa Karangmangu', '089673797344', NULL, NULL),
(61, '2016-11-24', 1, 200000, 200000, 'Desa Karangmangu', '089673797344', NULL, NULL),
(62, '2016-11-24', 1, 200000, 200000, 'Desa Karangmangu', '089673797344', NULL, NULL),
(63, '2016-11-24', 1, 200000, 200000, 'Desa Karangmangu', '089673797344', NULL, NULL),
(64, '2016-11-24', 1, 200000, 200000, 'Desa Karangmangu', '089673797344', NULL, NULL),
(65, '2016-11-24', 5, 200000, 1000000, 'Desa Karangmangu', '089673797344', NULL, NULL),
(66, '2016-11-25', 5, 200000, 1000000, 'Desa Karangmangu', '089673797344', NULL, NULL),
(67, '2016-11-25', 5, 200000, 1000000, 'Desa Karangmangu', '089673797344', NULL, NULL),
(68, '2016-11-25', 3, 200000, 600000, 'Desa Setianegara', '089673797344', NULL, NULL),
(69, '2016-11-25', 8, 200000, 1600000, 'Desa Karangmangu', '089673797344', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'view_backend', NULL, NULL),
(2, 'view_frontend', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `produksi`
--

CREATE TABLE `produksi` (
  `id_produksi` int(10) UNSIGNED NOT NULL,
  `tgl_produksi` date NOT NULL,
  `jml_produksi` int(11) NOT NULL,
  `konfirmasi_stok` enum('n','y') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'n',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `produksi`
--

INSERT INTO `produksi` (`id_produksi`, `tgl_produksi`, `jml_produksi`, `konfirmasi_stok`, `created_at`, `updated_at`) VALUES
(59, '2016-10-24', 100, 'y', NULL, '2016-10-23 21:08:09'),
(60, '2016-10-23', 120, 'y', NULL, '2016-10-23 22:49:13'),
(61, '2016-09-14', 80, 'y', NULL, '2016-10-23 23:24:14'),
(62, '2016-11-24', 100, 'y', NULL, '2016-11-24 19:44:46'),
(63, '2016-11-24', 100, 'y', NULL, '2016-11-24 19:44:59'),
(64, '2016-11-24', 5, 'y', NULL, '2016-11-24 19:45:13'),
(65, '2016-11-24', 100, 'y', NULL, '2016-11-24 19:45:26'),
(66, '2016-11-24', 100, 'y', NULL, '2016-11-24 19:45:33'),
(67, '2016-11-24', 100, 'y', NULL, '2016-11-24 19:45:44'),
(68, '2016-11-24', 100, 'y', NULL, '2016-11-24 19:45:53'),
(69, '2016-11-24', 100, 'n', NULL, NULL),
(70, '2016-11-23', 100, 'n', NULL, NULL),
(71, '2016-11-22', 100, 'n', NULL, NULL),
(72, '2016-11-20', 5, 'n', NULL, NULL),
(73, '2016-11-14', 3, 'n', NULL, NULL),
(74, '2016-12-07', 100, 'n', NULL, NULL),
(75, '2016-12-07', 200, 'n', NULL, NULL),
(76, '2016-12-07', 1, 'n', NULL, NULL),
(77, '2016-12-07', 12, 'n', NULL, NULL),
(78, '2016-12-07', 11, 'n', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', NULL, NULL),
(2, 'Konsumen', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `stok_ayam`
--

CREATE TABLE `stok_ayam` (
  `id_stok_ayam` int(10) UNSIGNED NOT NULL,
  `pembelian_id` int(10) UNSIGNED DEFAULT NULL,
  `penjualan_ayam_id` int(10) UNSIGNED DEFAULT NULL,
  `tgl_stok_ayam` date NOT NULL,
  `ayam_masuk` int(11) DEFAULT '0',
  `ayam_keluar` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `stok_ayam`
--

INSERT INTO `stok_ayam` (`id_stok_ayam`, `pembelian_id`, `penjualan_ayam_id`, `tgl_stok_ayam`, `ayam_masuk`, `ayam_keluar`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, '2016-10-25', 30, 0, NULL, NULL),
(2, NULL, 1, '2016-10-25', 0, 12, NULL, NULL),
(3, 2, NULL, '2016-09-14', 50, 0, NULL, NULL),
(4, NULL, 2, '2016-09-14', 0, 12, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `stok_telur`
--

CREATE TABLE `stok_telur` (
  `id_stok_telur` int(10) UNSIGNED NOT NULL,
  `produksi_id` int(10) UNSIGNED DEFAULT NULL,
  `penjualan_telur_id` int(10) UNSIGNED DEFAULT NULL,
  `tgl_stok_telur` date NOT NULL,
  `telur_masuk` int(11) DEFAULT '0',
  `telur_keluar` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `stok_telur`
--

INSERT INTO `stok_telur` (`id_stok_telur`, `produksi_id`, `penjualan_telur_id`, `tgl_stok_telur`, `telur_masuk`, `telur_keluar`, `created_at`, `updated_at`) VALUES
(56, 59, NULL, '2016-10-24', 100, 0, NULL, NULL),
(57, 60, NULL, '2016-10-23', 120, 0, NULL, NULL),
(58, 61, NULL, '2016-09-14', 80, 0, NULL, '2016-10-23 23:24:54'),
(59, NULL, 46, '2016-10-25', 0, 30, NULL, NULL),
(60, NULL, 47, '2016-09-14', 0, 50, NULL, NULL),
(61, NULL, 48, '2016-11-24', 0, 3, NULL, NULL),
(62, NULL, 49, '2016-11-24', 0, 2, NULL, NULL),
(63, NULL, 50, '2016-11-24', 0, 1, NULL, NULL),
(64, NULL, 51, '2016-11-24', 0, 1, NULL, NULL),
(65, NULL, 52, '2016-11-24', 0, 1, NULL, NULL),
(66, NULL, 53, '2016-11-24', 0, 1, NULL, NULL),
(67, NULL, 54, '2016-11-24', 0, 10, NULL, NULL),
(68, NULL, 55, '2016-11-24', 0, 11, NULL, NULL),
(69, NULL, 56, '2016-11-24', 0, 12, NULL, NULL),
(70, NULL, 57, '2016-11-24', 0, 13, NULL, NULL),
(71, NULL, 58, '2016-11-24', 0, 33, NULL, NULL),
(72, NULL, 59, '2016-11-24', 0, 11, NULL, NULL),
(73, NULL, 60, '2016-11-24', 0, 2, NULL, NULL),
(74, NULL, 61, '2016-11-24', 0, 1, NULL, NULL),
(75, NULL, 62, '2016-11-24', 0, 1, NULL, NULL),
(76, NULL, 63, '2016-11-24', 0, 1, NULL, NULL),
(77, NULL, 64, '2016-11-24', 0, 1, NULL, NULL),
(78, NULL, 65, '2016-11-24', 0, 5, NULL, NULL),
(79, NULL, 66, '2016-11-25', 0, 5, NULL, NULL),
(80, NULL, 67, '2016-11-25', 0, 5, NULL, NULL),
(81, NULL, 68, '2016-11-25', 0, 3, NULL, NULL),
(82, 62, NULL, '2016-11-24', 100, 0, NULL, NULL),
(83, 63, NULL, '2016-11-24', 100, 0, NULL, NULL),
(84, 64, NULL, '2016-11-24', 5, 0, NULL, NULL),
(85, 65, NULL, '2016-11-24', 100, 0, NULL, NULL),
(86, 66, NULL, '2016-11-24', 100, 0, NULL, NULL),
(87, 67, NULL, '2016-11-24', 100, 0, NULL, NULL),
(88, 68, NULL, '2016-11-24', 100, 0, NULL, NULL),
(89, NULL, 69, '2016-11-25', 0, 8, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Fazri', 'fm.fazri.m@gmail.com', '$2y$10$FbPO7ulhBppj2vf1epNK3uoHtb5SBAQosCEjRG6T6Fc4ZqH9PHBaa', 'TvPdwTgK0OJjTttohPRKWdwDVQwJWlkMzP6zwyqAUMaFQfxRoZzZ95OPdWC5', '2016-10-09 23:21:34', '2017-01-18 02:32:35'),
(2, 'a', 'a@gmail.com', '$2y$10$U0JeJn1WmZ/d.lGWcpswn.Ui3wO2NYtV8kvIX.FNfgVVxUFy3D962', '58Cfizdqzu9vxya67dU1EDeVyvP188rwWVEIJ6AboaegDUo2xohF1Ymbzn3M', '2016-10-09 23:24:15', '2017-01-11 03:35:04'),
(3, 'b', 'b@gmail.com', '$2y$10$.TjBjVOUXHmyLBsVZjF1vOD2Njr4RSZmo5pK3r1rNxP2YYeq9O0gO', 'QEA6wnnJfgfk3GyRTGWEXJ8leg76IgzOCKLk5aaqGwWQtSjuewVKTre4K7QM', '2016-10-11 01:11:43', '2016-10-24 01:33:47');

-- --------------------------------------------------------

--
-- Table structure for table `user_has_permissions`
--

CREATE TABLE `user_has_permissions` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `permission_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_has_permissions`
--

INSERT INTO `user_has_permissions` (`user_id`, `permission_id`) VALUES
(1, 1),
(2, 2),
(3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_has_roles`
--

CREATE TABLE `user_has_roles` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_has_roles`
--

INSERT INTO `user_has_roles` (`role_id`, `user_id`) VALUES
(1, 1),
(2, 2),
(2, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `galeries`
--
ALTER TABLE `galeries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id_pembelian`);

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id_pemesanan`),
  ADD KEY `pemesanan_user_id_foreign` (`user_id`);

--
-- Indexes for table `penjualan_ayam`
--
ALTER TABLE `penjualan_ayam`
  ADD PRIMARY KEY (`id_penjualan_ayam`);

--
-- Indexes for table `penjualan_telur`
--
ALTER TABLE `penjualan_telur`
  ADD PRIMARY KEY (`id_penjualan_telur`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Indexes for table `produksi`
--
ALTER TABLE `produksi`
  ADD PRIMARY KEY (`id_produksi`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `stok_ayam`
--
ALTER TABLE `stok_ayam`
  ADD PRIMARY KEY (`id_stok_ayam`),
  ADD KEY `stok_ayam_pembelian_id_foreign` (`pembelian_id`),
  ADD KEY `stok_ayam_penjualan_ayam_id_foreign` (`penjualan_ayam_id`);

--
-- Indexes for table `stok_telur`
--
ALTER TABLE `stok_telur`
  ADD PRIMARY KEY (`id_stok_telur`),
  ADD KEY `stok_telur_produksi_id_foreign` (`produksi_id`),
  ADD KEY `stok_telur_penjualan_telur_id_foreign` (`penjualan_telur_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_has_permissions`
--
ALTER TABLE `user_has_permissions`
  ADD PRIMARY KEY (`user_id`,`permission_id`),
  ADD KEY `user_has_permissions_permission_id_foreign` (`permission_id`);

--
-- Indexes for table `user_has_roles`
--
ALTER TABLE `user_has_roles`
  ADD PRIMARY KEY (`role_id`,`user_id`),
  ADD KEY `user_has_roles_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `galeries`
--
ALTER TABLE `galeries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id_pembelian` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id_pemesanan` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `penjualan_ayam`
--
ALTER TABLE `penjualan_ayam`
  MODIFY `id_penjualan_ayam` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `penjualan_telur`
--
ALTER TABLE `penjualan_telur`
  MODIFY `id_penjualan_telur` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `produksi`
--
ALTER TABLE `produksi`
  MODIFY `id_produksi` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `stok_ayam`
--
ALTER TABLE `stok_ayam`
  MODIFY `id_stok_ayam` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `stok_telur`
--
ALTER TABLE `stok_telur`
  MODIFY `id_stok_telur` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD CONSTRAINT `pemesanan_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stok_ayam`
--
ALTER TABLE `stok_ayam`
  ADD CONSTRAINT `stok_ayam_pembelian_id_foreign` FOREIGN KEY (`pembelian_id`) REFERENCES `pembelian` (`id_pembelian`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stok_ayam_penjualan_ayam_id_foreign` FOREIGN KEY (`penjualan_ayam_id`) REFERENCES `penjualan_ayam` (`id_penjualan_ayam`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `stok_telur`
--
ALTER TABLE `stok_telur`
  ADD CONSTRAINT `stok_telur_penjualan_telur_id_foreign` FOREIGN KEY (`penjualan_telur_id`) REFERENCES `penjualan_telur` (`id_penjualan_telur`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stok_telur_produksi_id_foreign` FOREIGN KEY (`produksi_id`) REFERENCES `produksi` (`id_produksi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_has_permissions`
--
ALTER TABLE `user_has_permissions`
  ADD CONSTRAINT `user_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_has_permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_has_roles`
--
ALTER TABLE `user_has_roles`
  ADD CONSTRAINT `user_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_has_roles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
