-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 08, 2021 at 08:03 PM
-- Server version: 5.7.28-0ubuntu0.19.04.2
-- PHP Version: 7.2.24-0ubuntu0.19.04.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inv_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bulans`
--

CREATE TABLE `bulans` (
  `id` int(10) UNSIGNED NOT NULL,
  `nm_bulan` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bulans`
--

INSERT INTO `bulans` (`id`, `nm_bulan`) VALUES
(1, 'Januari'),
(2, 'Februari'),
(3, 'Maret'),
(4, 'April'),
(5, 'Mei'),
(6, 'Juni'),
(7, 'Juli'),
(8, 'Agustus'),
(9, 'September'),
(10, 'Oktober'),
(11, 'November'),
(12, 'Desember');

-- --------------------------------------------------------

--
-- Table structure for table `categoris`
--

CREATE TABLE `categoris` (
  `id` int(10) UNSIGNED NOT NULL,
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categoris`
--

INSERT INTO `categoris` (`id`, `kategori`, `created_at`, `updated_at`) VALUES
(5, 'Pakingan', '2021-06-06 08:17:40', '2021-06-21 08:50:45'),
(6, 'bvcd', '2021-06-09 18:58:11', '2021-06-09 18:58:11');

-- --------------------------------------------------------

--
-- Table structure for table `charts`
--

CREATE TABLE `charts` (
  `id` int(10) NOT NULL,
  `bulan` int(10) UNSIGNED NOT NULL,
  `brg_id` int(10) UNSIGNED NOT NULL,
  `jumlah` varchar(55) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `charts`
--

INSERT INTO `charts` (`id`, `bulan`, `brg_id`, `jumlah`, `created_at`, `updated_at`) VALUES
(12, 2, 1, '186', '2021-07-15 11:18:34', '2021-08-05 06:00:35'),
(13, 3, 1, '474', '2021-07-15 11:18:50', '2021-08-05 06:01:36'),
(14, 4, 1, '163', '2021-07-15 11:19:25', '2021-08-05 06:01:58'),
(15, 5, 1, '524', '2021-07-15 11:19:25', '2021-07-15 11:19:25'),
(16, 6, 1, '315', '2021-07-15 11:19:55', '2021-07-15 11:19:55'),
(17, 7, 1, '279', '2021-07-15 11:19:55', '2021-07-15 11:19:55'),
(23, 1, 2, '322', '2021-07-15 11:22:29', '2021-07-15 11:22:29'),
(24, 2, 2, '203', '2021-07-15 11:22:29', '2021-08-05 12:40:21'),
(25, 3, 2, '97', '2021-07-15 11:23:01', '2021-07-15 11:23:01'),
(26, 4, 2, '351', '2021-07-15 11:23:01', '2021-07-15 11:23:01'),
(27, 5, 2, '241', '2021-07-15 11:23:41', '2021-07-15 11:23:41'),
(28, 6, 2, '179', '2021-07-15 11:23:41', '2021-07-15 11:23:41'),
(29, 7, 2, '203', '2021-07-15 11:24:10', '2021-07-15 11:24:10'),
(30, 1, 1, '135', '2021-08-05 07:58:56', '2021-08-05 12:38:48'),
(31, 1, 3, '221', '2021-08-05 12:42:37', '2021-08-05 12:42:37'),
(34, 8, 2, '23', '2021-08-07 22:23:29', '2021-08-07 22:23:29');

-- --------------------------------------------------------

--
-- Table structure for table `eoqs`
--

CREATE TABLE `eoqs` (
  `id` int(10) UNSIGNED NOT NULL,
  `periode` varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL,
  `items_id` int(10) UNSIGNED NOT NULL,
  `types_id` int(10) UNSIGNED NOT NULL,
  `hrg_item` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `by_pesan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `by_simpan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permintaan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `eoq` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `frekuensi` varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL,
  `leadtime` varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hasilmetodes`
--

CREATE TABLE `hasilmetodes` (
  `id` int(11) NOT NULL,
  `tanggal` varchar(50) NOT NULL,
  `barang_id` int(10) UNSIGNED NOT NULL,
  `jenis_id` int(10) UNSIGNED NOT NULL,
  `periode` varchar(50) NOT NULL,
  `permintaan` varchar(50) NOT NULL,
  `eoq` varchar(50) NOT NULL,
  `frekuensi` varchar(50) NOT NULL,
  `leadtime` varchar(50) NOT NULL,
  `rop` varchar(50) DEFAULT '-',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ins`
--

CREATE TABLE `ins` (
  `id` int(10) UNSIGNED NOT NULL,
  `stoks_id` int(10) UNSIGNED NOT NULL,
  `nm_brg1` int(10) UNSIGNED NOT NULL,
  `jns_brg1` int(10) UNSIGNED NOT NULL,
  `awal` varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int(10) NOT NULL,
  `tanggal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hrg_item` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ins`
--

INSERT INTO `ins` (`id`, `stoks_id`, `nm_brg1`, `jns_brg1`, `awal`, `jumlah`, `tanggal`, `hrg_item`, `total`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 4, '7250', 50, '2021-08-08', '40700', '2035000', '2021-08-07 21:53:16', '2021-08-07 21:53:16');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(10) UNSIGNED NOT NULL,
  `nm_brg` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `by_simpan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `by_pesan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `nm_brg`, `by_simpan`, `by_pesan`, `created_at`, `updated_at`) VALUES
(1, 'Cumi', '20', '250000', '2021-06-08 22:09:56', '2021-07-25 01:38:22'),
(2, 'Bekutak', '23', '150000', '2021-06-08 22:10:57', '2021-07-25 01:38:33'),
(3, 'Cendol', '20', '170000', '2021-06-08 22:11:46', '2021-07-25 01:38:49');

-- --------------------------------------------------------

--
-- Table structure for table `kapasitas`
--

CREATE TABLE `kapasitas` (
  `id` int(11) NOT NULL,
  `qty` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kapasitas`
--

INSERT INTO `kapasitas` (`id`, `qty`) VALUES
(1, '30000');

-- --------------------------------------------------------

--
-- Table structure for table `lapstoks`
--

CREATE TABLE `lapstoks` (
  `id` int(10) UNSIGNED NOT NULL,
  `tanggal` varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_barang` int(10) UNSIGNED NOT NULL,
  `id_jenis` int(10) UNSIGNED NOT NULL,
  `awal` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stok_masuk` varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '-',
  `stok_keluar` varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '-',
  `akhir` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lapstoks`
--

INSERT INTO `lapstoks` (`id`, `tanggal`, `id_barang`, `id_jenis`, `awal`, `stok_masuk`, `stok_keluar`, `akhir`, `created_at`, `updated_at`) VALUES
(30, '2021-08-08', 1, 4, '7250', '50', '123', '7167', '2021-08-07 21:53:16', '2021-08-07 23:11:35'),
(31, '2021-08-08', 2, 7, '8123', '-', '23', '8100', '2021-08-07 22:23:29', '2021-08-07 22:23:29');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_05_20_090800_create_barang_table', 1),
(5, '2021_05_20_093300_create_items_table', 1),
(6, '2021_05_22_065851_create_types_table', 1),
(7, '2021_05_22_073038_create_categoris_table', 1),
(8, '2021_05_24_040605_create_ins_table', 1),
(9, '2021_05_24_063530_create_outs_table', 1),
(10, '2021_05_27_133513_create_admins_table', 1),
(11, '2021_05_29_121137_create_stoks_table', 1),
(12, '2021_06_03_154923_create_eoqs_table', 1),
(13, '2021_06_04_152929_create_lapstoks_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `outs`
--

CREATE TABLE `outs` (
  `id` int(10) UNSIGNED NOT NULL,
  `stoks_id` int(10) UNSIGNED NOT NULL,
  `tanggal` varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_bulan` int(10) UNSIGNED NOT NULL,
  `id_brg` int(10) UNSIGNED NOT NULL,
  `jns_id` int(10) UNSIGNED NOT NULL,
  `jumlah` int(10) NOT NULL,
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `status` int(2) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pemakaians`
--

CREATE TABLE `pemakaians` (
  `id` int(10) UNSIGNED NOT NULL,
  `bulan_id` int(10) UNSIGNED NOT NULL,
  `items_id` int(10) UNSIGNED NOT NULL,
  `types_id` int(10) UNSIGNED NOT NULL,
  `jumlah` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pemakaians`
--

INSERT INTO `pemakaians` (`id`, `bulan_id`, `items_id`, `types_id`, `jumlah`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 3, '115', NULL, '2021-07-15 03:52:02'),
(2, 1, 1, 4, '241', NULL, '2021-07-15 03:52:48'),
(4, 1, 2, 2, '190', NULL, '2021-07-15 03:53:33'),
(5, 1, 3, 5, '78', NULL, '2021-07-15 03:54:27'),
(6, 1, 3, 6, '126', NULL, '2021-07-15 03:54:04'),
(7, 2, 1, 3, '123', NULL, '2021-07-15 03:54:57'),
(8, 2, 1, 4, '76', NULL, '2021-07-15 04:04:36'),
(10, 2, 2, 2, '211', NULL, '2021-07-15 03:58:44'),
(11, 3, 3, 5, '0', NULL, NULL),
(12, 3, 3, 6, '0', NULL, NULL),
(13, 3, 1, 3, '0', NULL, NULL),
(14, 3, 1, 4, '182', NULL, '2021-07-15 03:56:22'),
(16, 3, 2, 2, '0', NULL, NULL),
(17, 3, 3, 5, '0', NULL, NULL),
(18, 3, 3, 6, '0', NULL, NULL),
(19, 4, 1, 3, '131', NULL, '2021-07-15 03:57:05'),
(20, 4, 1, 4, '0', NULL, NULL),
(22, 4, 2, 2, '91', NULL, '2021-07-15 03:59:24'),
(23, 4, 3, 5, '0', NULL, NULL),
(24, 4, 3, 6, '0', NULL, NULL),
(25, 5, 1, 3, '0', NULL, NULL),
(26, 5, 1, 4, '0', NULL, NULL),
(28, 5, 2, 2, '0', NULL, NULL),
(29, 5, 3, 5, '0', NULL, NULL),
(30, 5, 3, 6, '0', NULL, NULL),
(31, 6, 1, 3, '0', NULL, '2021-06-23 01:42:06'),
(32, 6, 1, 4, '0', NULL, '2021-06-22 21:17:47'),
(34, 6, 2, 2, '0', NULL, '2021-06-22 00:24:02'),
(35, 6, 3, 5, '0', NULL, NULL),
(36, 6, 3, 6, '0', NULL, NULL),
(37, 7, 1, 3, '0', NULL, '2021-07-13 05:16:03'),
(38, 7, 1, 4, '0', NULL, '2021-07-01 13:56:31'),
(40, 7, 2, 2, '0', NULL, '2021-07-01 13:57:18'),
(41, 7, 3, 5, '0', NULL, NULL),
(42, 7, 3, 6, '0', NULL, NULL),
(43, 8, 1, 3, '0', NULL, NULL),
(44, 8, 1, 4, '0', NULL, NULL),
(46, 8, 2, 2, '0', NULL, NULL),
(47, 8, 3, 5, '0', NULL, NULL),
(48, 8, 3, 6, '0', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `periodes`
--

CREATE TABLE `periodes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `periode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jml_hari` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `periodes`
--

INSERT INTO `periodes` (`id`, `periode`, `jml_hari`, `created_at`, `updated_at`) VALUES
(3, 'Tahun', '365', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `requeststoks`
--

CREATE TABLE `requeststoks` (
  `id` int(10) NOT NULL,
  `tanggal` varchar(55) NOT NULL,
  `idbarang` int(10) UNSIGNED NOT NULL,
  `idjenis` int(10) UNSIGNED NOT NULL,
  `jumlah` varchar(55) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `frekuensi` varchar(55) NOT NULL,
  `waktu_pemesanan` varchar(55) NOT NULL,
  `status` varchar(55) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `requeststoks`
--

INSERT INTO `requeststoks` (`id`, `tanggal`, `idbarang`, `idjenis`, `jumlah`, `created_at`, `updated_at`, `frekuensi`, `waktu_pemesanan`, `status`) VALUES
(2, '2021-08-08', 1, 3, '450', '2021-08-07 20:11:06', '2021-08-07 20:11:06', '5', '2', '0');

-- --------------------------------------------------------

--
-- Table structure for table `rops`
--

CREATE TABLE `rops` (
  `id` int(10) NOT NULL,
  `eoq_id` int(10) UNSIGNED NOT NULL,
  `rop` varchar(55) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stoks`
--

CREATE TABLE `stoks` (
  `id` int(10) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `items_id` int(10) UNSIGNED NOT NULL,
  `types_id` int(10) UNSIGNED NOT NULL,
  `stok` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stoks`
--

INSERT INTO `stoks` (`id`, `tanggal`, `items_id`, `types_id`, `stok`, `created_at`, `updated_at`) VALUES
(1, '2021-06-11', 1, 3, '4525', '2021-06-11 08:58:06', '2021-08-05 06:01:58'),
(2, '2021-06-11', 1, 4, '7275', '2021-06-11 08:58:38', '2021-08-08 00:06:53'),
(4, '2021-06-11', 2, 2, '8279', '2021-06-11 08:59:08', '2021-08-05 12:40:21'),
(5, '2021-06-11', 3, 5, '6250', '2021-06-11 08:59:20', '2021-07-15 03:54:27'),
(6, '2021-06-11', 3, 6, '5603', '2021-06-11 08:59:33', '2021-08-05 12:42:37'),
(7, '2021-08-07', 2, 7, '8100', '2021-08-07 05:09:54', '2021-08-07 22:23:29');

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `id` int(10) UNSIGNED NOT NULL,
  `items_id` int(10) UNSIGNED NOT NULL,
  `hrg_item` varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jns_brg` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`id`, `items_id`, `hrg_item`, `jns_brg`, `created_at`, `updated_at`) VALUES
(2, 2, '33500', 'BK-2', '2021-06-09 04:18:45', '2021-07-15 05:58:49'),
(3, 1, '43000', 'BG-1', '2021-06-09 04:17:26', '2021-07-15 05:50:34'),
(4, 1, '40700', 'BG-2', '2021-06-09 04:18:15', '2021-08-07 21:53:16'),
(5, 3, '35600', 'CD-1', '2021-06-11 07:51:44', '2021-07-15 03:44:21'),
(6, 3, '121', 'CD-2', '2021-06-11 07:52:06', '2021-07-15 06:02:45'),
(7, 2, '36750', 'BK-1', '2021-08-07 04:56:11', '2021-08-07 04:56:11');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `level`, `username`, `user_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Staff Gudang', '1', 'admin@multi-auth.test', NULL, '$2y$10$iAF.MeQNscZZn.oE7x3aAuLzMRrqid6Z3ahCkV32Rr.PiO1nBuLCu', NULL, '2021-07-25 01:00:12', '2021-07-25 01:07:00'),
(2, 'Staff Purchase', '2', 'user@multi-auth.test', NULL, '$2y$10$ods99pQkTD9kukIdR9l2UuWtq0PafS0Px1EwMH97HKz7L82JVPiFa', NULL, '2021-06-07 00:59:26', '2021-06-07 00:59:26'),
(3, 'manager', '3', 'manager@multi-auth.test', NULL, '$2y$10$v3f4SkTAwiyWoaHYjO3jIubkOJn09gK7M6rnYaRz3xyQEzwlZj4Q6', NULL, '2021-06-17 05:28:57', '2021-06-17 05:28:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `bulans`
--
ALTER TABLE `bulans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categoris`
--
ALTER TABLE `categoris`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `charts`
--
ALTER TABLE `charts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bln_foreign` (`bulan`),
  ADD KEY `brg_foreign` (`brg_id`);

--
-- Indexes for table `eoqs`
--
ALTER TABLE `eoqs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `eoqs_items_id_foreign` (`items_id`),
  ADD KEY `eoqs_types_id_foreign` (`types_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hasilmetodes`
--
ALTER TABLE `hasilmetodes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `barang_foreign` (`barang_id`),
  ADD KEY `jenis_foreign` (`jenis_id`);

--
-- Indexes for table `ins`
--
ALTER TABLE `ins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ins_items_id_foreign` (`stoks_id`),
  ADD KEY `ins_foreign` (`nm_brg1`),
  ADD KEY `jnis_foreign` (`jns_brg1`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kapasitas`
--
ALTER TABLE `kapasitas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lapstoks`
--
ALTER TABLE `lapstoks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brg_b_foreign` (`id_barang`),
  ADD KEY `jns_j_foreign` (`id_jenis`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `outs`
--
ALTER TABLE `outs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `out_items_id_foreign` (`stoks_id`),
  ADD KEY `nm_brg_id_foreign` (`id_brg`),
  ADD KEY `jns_brg_id_foreign` (`jns_id`),
  ADD KEY `pkn_brg_id_foreign` (`tanggal`),
  ADD KEY `bulan_id_foreign` (`id_bulan`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pemakaians`
--
ALTER TABLE `pemakaians`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brg_id_foreign` (`items_id`),
  ADD KEY `jns_id_foreign` (`types_id`),
  ADD KEY `id_bulan_foreign` (`bulan_id`);

--
-- Indexes for table `periodes`
--
ALTER TABLE `periodes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requeststoks`
--
ALTER TABLE `requeststoks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brgid_foreign` (`idbarang`),
  ADD KEY `jnsid_foreign` (`idjenis`);

--
-- Indexes for table `rops`
--
ALTER TABLE `rops`
  ADD PRIMARY KEY (`id`),
  ADD KEY `eoq_id_foreign` (`eoq_id`);

--
-- Indexes for table `stoks`
--
ALTER TABLE `stoks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stoks_items_id_foreign` (`items_id`),
  ADD KEY `stoks_types_id_foreign` (`types_id`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `items_id_foreign` (`items_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bulans`
--
ALTER TABLE `bulans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `categoris`
--
ALTER TABLE `categoris`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `charts`
--
ALTER TABLE `charts`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `eoqs`
--
ALTER TABLE `eoqs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hasilmetodes`
--
ALTER TABLE `hasilmetodes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ins`
--
ALTER TABLE `ins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `kapasitas`
--
ALTER TABLE `kapasitas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `lapstoks`
--
ALTER TABLE `lapstoks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `outs`
--
ALTER TABLE `outs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pemakaians`
--
ALTER TABLE `pemakaians`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT for table `periodes`
--
ALTER TABLE `periodes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `requeststoks`
--
ALTER TABLE `requeststoks`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `rops`
--
ALTER TABLE `rops`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `stoks`
--
ALTER TABLE `stoks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `charts`
--
ALTER TABLE `charts`
  ADD CONSTRAINT `bln_foreign` FOREIGN KEY (`bulan`) REFERENCES `bulans` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `brg_foreign` FOREIGN KEY (`brg_id`) REFERENCES `items` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `eoqs`
--
ALTER TABLE `eoqs`
  ADD CONSTRAINT `eoqs_items_id_foreign` FOREIGN KEY (`items_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `eoqs_types_id_foreign` FOREIGN KEY (`types_id`) REFERENCES `types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `hasilmetodes`
--
ALTER TABLE `hasilmetodes`
  ADD CONSTRAINT `barang_foreign` FOREIGN KEY (`barang_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jenis_foreign` FOREIGN KEY (`jenis_id`) REFERENCES `types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ins`
--
ALTER TABLE `ins`
  ADD CONSTRAINT `ins_foreign` FOREIGN KEY (`nm_brg1`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ins_items_id_foreign` FOREIGN KEY (`stoks_id`) REFERENCES `stoks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jnis_foreign` FOREIGN KEY (`jns_brg1`) REFERENCES `types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lapstoks`
--
ALTER TABLE `lapstoks`
  ADD CONSTRAINT `brg_b_foreign` FOREIGN KEY (`id_barang`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jns_j_foreign` FOREIGN KEY (`id_jenis`) REFERENCES `types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `outs`
--
ALTER TABLE `outs`
  ADD CONSTRAINT `bulan_id_foreign` FOREIGN KEY (`id_bulan`) REFERENCES `bulans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jns_brg_id_foreign` FOREIGN KEY (`jns_id`) REFERENCES `types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nm_brg_id_foreign` FOREIGN KEY (`id_brg`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `out_items_id_foreign` FOREIGN KEY (`stoks_id`) REFERENCES `stoks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pemakaians`
--
ALTER TABLE `pemakaians`
  ADD CONSTRAINT `brg_id_foreign` FOREIGN KEY (`items_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_bulan_foreign` FOREIGN KEY (`bulan_id`) REFERENCES `bulans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jns_id_foreign` FOREIGN KEY (`types_id`) REFERENCES `types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `requeststoks`
--
ALTER TABLE `requeststoks`
  ADD CONSTRAINT `brgid_foreign` FOREIGN KEY (`idbarang`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jnsid_foreign` FOREIGN KEY (`idjenis`) REFERENCES `types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rops`
--
ALTER TABLE `rops`
  ADD CONSTRAINT `eoq_id_foreign` FOREIGN KEY (`eoq_id`) REFERENCES `eoqs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `stoks`
--
ALTER TABLE `stoks`
  ADD CONSTRAINT `stoks_items_id_foreign` FOREIGN KEY (`items_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stoks_types_id_foreign` FOREIGN KEY (`types_id`) REFERENCES `types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `types`
--
ALTER TABLE `types`
  ADD CONSTRAINT `items_id_foreign` FOREIGN KEY (`items_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
