-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 19, 2023 at 03:35 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sewa_kendaraan`
--

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE `banks` (
  `id` int NOT NULL,
  `nama` varchar(255) NOT NULL,
  `bank` varchar(255) NOT NULL,
  `no_rek` bigint NOT NULL,
  `updated_at` timestamp NOT NULL,
  `created_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `banks`
--

INSERT INTO `banks` (`id`, `nama`, `bank`, `no_rek`, `updated_at`, `created_at`) VALUES
(1, 'I GEDE ADI WARSA LIMITHA', 'Bank Mandiri', 1450013801317, '2023-02-08 06:08:30', '2022-11-28 05:14:15');

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `id` bigint UNSIGNED NOT NULL,
  `vendor_id` bigint UNSIGNED NOT NULL,
  `nama_mobil` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `harga_sewa` double NOT NULL,
  `denda` double NOT NULL,
  `samsat` date NOT NULL,
  `gambar` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `bahan_bakar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_kursi` tinyint NOT NULL,
  `transmisi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Tersedia',
  `deskripsi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remind` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`id`, `vendor_id`, `nama_mobil`, `slug`, `harga_sewa`, `denda`, `samsat`, `gambar`, `bahan_bakar`, `jumlah_kursi`, `transmisi`, `status`, `deskripsi`, `remind`, `created_at`, `updated_at`) VALUES
(1, 8, 'Carrera', 'carrera', 20000, 200, '2023-02-11', 'Carrera-1675903423.jpeg', 'solar', 3, 'manual', 'tersedia', 'yows', 1, NULL, '2023-02-19 03:55:13'),
(9, 7, 'Porsche', 'porsche', 20000, 20000, '2023-02-24', 'Porsche-1675899553.jpg', 'Pertamax', 4, 'manual', 'tidak tersedia', 'Wow', 0, '2022-11-29 08:10:24', '2023-02-19 03:57:07'),
(10, 2, 'Lamborghini', 'lamborghini', 150000, 150000, '2022-12-30', 'Lamborghini-1675899590.jpg', 'pertamini', 4, 'otomatis', 'tidak tersedia', 'test', 1, '2022-11-29 09:47:10', '2023-02-17 18:45:48'),
(13, 2, 'Alphard', 'alphard', 100000, 50000, '2023-02-22', 'Alphard-1675899607.jpeg', 'Pertamax', 4, 'otomatis', 'tidak tersedia', 'Tes', 0, '2023-02-08 15:36:55', '2023-02-18 23:27:08');

-- --------------------------------------------------------

--
-- Table structure for table `car_category`
--

CREATE TABLE `car_category` (
  `id` bigint UNSIGNED NOT NULL,
  `car_id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `car_category`
--

INSERT INTO `car_category` (`id`, `car_id`, `category_id`, `created_at`, `updated_at`) VALUES
(4, 1, 5, NULL, NULL),
(7, 9, 5, NULL, NULL),
(8, 9, 6, NULL, NULL),
(9, 10, 5, NULL, NULL),
(15, 13, 4, NULL, NULL),
(16, 13, 5, NULL, NULL),
(17, 13, 6, NULL, NULL),
(18, 9, 10, NULL, NULL),
(19, 10, 6, NULL, NULL),
(20, 1, 6, NULL, NULL),
(21, 1, 10, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `type`, `created_at`, `updated_at`) VALUES
(4, 'P3K', 'p3k', 1, '2022-11-23 20:45:53', '2022-12-03 23:01:25'),
(5, 'ac', 'ac', 1, '2022-11-26 18:23:45', '2022-11-26 18:23:45'),
(6, 'charger', 'charger', 1, '2022-11-26 18:23:49', '2022-11-26 18:23:49'),
(10, 'Wifi', 'wifi', 1, '2023-02-07 03:58:13', '2023-02-07 03:58:13'),
(14, 'Bensin', 'bensin', 2, '2023-02-07 04:30:01', '2023-02-09 17:05:54'),
(15, 'Sound', 'sound', 2, '2023-02-07 04:34:10', '2023-02-08 15:47:54');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(7, '2014_10_12_000000_create_users_table', 1),
(8, '2014_10_12_100000_create_password_resets_table', 1),
(9, '2019_08_19_000000_create_failed_jobs_table', 1),
(10, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(11, '2022_11_21_112931_create_roles_table', 1),
(12, '2022_11_21_113106_add_role_id_column_to_users_table', 1),
(16, '2022_11_21_113901_create_vendors_table', 2),
(17, '2022_11_21_114001_create_cars_table', 2),
(18, '2022_11_21_114943_add_vendor_id_column_to_cars_table', 2),
(19, '2022_11_21_115404_create_rent_logs_table', 3),
(20, '2022_11_23_145338_add_slug_column_to_vendors_table', 4),
(21, '2022_11_24_021902_create_categories_table', 5),
(22, '2022_11_24_022010_create_car_category_table', 5),
(25, '2022_11_24_023100_create_car_category_table', 6),
(26, '2022_11_24_023123_create_rent_logs_table', 6),
(27, '2022_11_24_023739_add_slug_column_to_categories_table', 7),
(28, '2023_02_07_131405_create_motor_table', 8),
(29, '2023_02_07_131600_create_motor_category_table', 8),
(30, '2023_02_07_131758_create_motor_category_table', 9),
(31, '2023_02_07_134006_add_vendor_id_column_to_motors_table', 10);

-- --------------------------------------------------------

--
-- Table structure for table `motors`
--

CREATE TABLE `motors` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_motor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_sewa` double NOT NULL,
  `denda` double NOT NULL,
  `samsat` date NOT NULL,
  `gambar` text COLLATE utf8mb4_unicode_ci,
  `bahan_bakar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transmisi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Tersedia',
  `deskripsi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remind` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `vendor_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `motors`
--

INSERT INTO `motors` (`id`, `nama_motor`, `slug`, `harga_sewa`, `denda`, `samsat`, `gambar`, `bahan_bakar`, `transmisi`, `status`, `deskripsi`, `remind`, `created_at`, `updated_at`, `vendor_id`) VALUES
(2, 'NMAX', 'tessaario', 100000, 50000, '2023-02-23', '-1675900167.png', 'Pertamax', 'otomatis', 'tidak tersedia', 'wew', 1, '2023-02-07 05:43:02', '2023-02-19 04:44:59', 20),
(3, 'Filano', 'terapoo', 100000, 50000, '2023-02-08', '-1675900226.png', 'Pertamax', 'otomatis', 'tidak tersedia', '123', 1, '2023-02-07 06:08:37', '2023-02-19 04:00:25', 20);

-- --------------------------------------------------------

--
-- Table structure for table `motor_category`
--

CREATE TABLE `motor_category` (
  `id` bigint UNSIGNED NOT NULL,
  `motor_id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `motor_category`
--

INSERT INTO `motor_category` (`id`, `motor_id`, `category_id`, `created_at`, `updated_at`) VALUES
(2, 3, 15, NULL, NULL),
(3, 2, 14, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rent_logs`
--

CREATE TABLE `rent_logs` (
  `id` bigint UNSIGNED NOT NULL,
  `no_invoice` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `car_id` bigint UNSIGNED DEFAULT NULL,
  `motor_id` bigint UNSIGNED DEFAULT NULL,
  `rent_date` date NOT NULL,
  `delivery` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `return_date` date NOT NULL,
  `actual_return_date` date DEFAULT NULL,
  `return_at` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pay` double DEFAULT NULL,
  `fine` double DEFAULT NULL,
  `status` int NOT NULL,
  `proof` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rent_logs`
--

INSERT INTO `rent_logs` (`id`, `no_invoice`, `user_id`, `car_id`, `motor_id`, `rent_date`, `delivery`, `return_date`, `actual_return_date`, `return_at`, `pay`, `fine`, `status`, `proof`, `created_at`, `updated_at`) VALUES
(24, NULL, 20, 9, NULL, '2023-02-06', 'Airport Ngurah Rai', '2023-02-08', NULL, NULL, 40000, NULL, 0, NULL, '2023-02-09 06:11:17', '2023-02-16 06:32:50'),
(25, NULL, 3, 1, NULL, '2023-02-18', 'Airport Ngurah Rai', '2023-02-18', NULL, NULL, 0, NULL, 1, NULL, '2023-02-17 18:44:58', '2023-02-19 04:28:29'),
(26, NULL, 19, 9, NULL, '2023-02-17', 'Jl.Nusa Kambangan', '2023-02-18', '2023-02-20', NULL, 20000, 20000, 1, NULL, '2023-02-17 18:45:27', '2023-02-19 06:56:03'),
(33, 'PSEAUU20230219', 19, 9, NULL, '2023-02-13', 'Jl.Nusa Kambangan', '2023-02-17', '2023-02-20', NULL, 140000, 0, 1, NULL, '2023-02-19 03:57:07', '2023-02-19 06:49:55'),
(34, 'FAOCID20230219', 18, NULL, 3, '2023-02-14', 'teraaaa', '2023-02-23', NULL, NULL, 900000, NULL, 1, NULL, '2023-02-19 04:00:25', '2023-02-19 04:00:25');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'admin', NULL, NULL),
(2, 'pegawai', NULL, NULL),
(3, 'customer', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `samsats`
--

CREATE TABLE `samsats` (
  `id` int NOT NULL,
  `code_samsat` varchar(25) NOT NULL,
  `car_id` int DEFAULT NULL,
  `motor_id` int DEFAULT NULL,
  `old_samsat` date DEFAULT NULL,
  `renew_samsat` date DEFAULT NULL,
  `new_samsat` date DEFAULT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `username`, `email`, `password`, `gambar`, `phone`, `address`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'Last OF US', 'admin@gmail.com', '$2y$10$zvelZaf19RD81ogTuG7qTOGOY..ZNn4GrXblNhlQYGJzUi2M1XnTi', NULL, '08577732123', 'badak agung sopp', 'active', NULL, NULL, '2023-02-09 17:13:18'),
(2, 2, 'Pegawai', 'pegawai@gmail.com', '$2y$10$yc5cE03ZK4pGvmV8F9NHg.STfgw3JcGcpt8MNGqz5.k2/eCEnAzfy', 'Pegawai-1675903302.png', '089765423123', 'Gianyar', 'active', NULL, NULL, '2023-02-09 17:14:13'),
(3, 3, 'customer', 'customer@gmail.com', '$2y$10$9Yry5XtrOafiY3LC70eO1.6Brh2B4zwYqS2.fb/jTuq/pOkbEm2IC', NULL, '08976543212', 'Tabanan', 'active', NULL, NULL, '2023-02-08 16:47:19'),
(18, 3, 'Caid', 'hadeuh@gmail.com', '$2y$10$T37PQ7/Y0kPB/hNnyffMUu39laO9DlXfRZaXZ8ExUvcLkIBpFV4ha', 'Caid-1675903565.png', '087664532718', 'Denpasar', 'active', NULL, '2022-11-27 08:20:52', '2023-02-08 16:47:29'),
(19, 3, 'adudu', 'adudu@gmail.com', '$2y$10$nG3pckHyDh8tzdbPvMh2eeHeIXs2gizk2VkMXN3ojoBYEJg3RXAKO', NULL, '08967674232', 'Denpasar', 'active', NULL, '2022-11-27 09:41:06', '2023-02-08 16:47:46'),
(20, 3, 'tesa', 'tesa@gmail.com', '$2y$10$P/aUxglOGymh8t1RdHPRQuJBCNqgr3W0rGV.0X7rlj7C1A6RuG4Pq', NULL, '0897421321', 'Denpasar', 'active', NULL, '2022-11-29 03:14:09', '2023-02-08 16:47:38'),
(21, 3, 'kastemer', 'kastemer@gmail.com', '$2y$10$994y5pxqHYY.xKmbn9MN4uGkLWwfbmf4/7RB.rCk.TDP05saJ2E2K', NULL, '08977564543', 'Denpasar', 'active', NULL, '2022-11-30 05:46:39', '2023-02-08 16:47:58'),
(23, 3, 'Tampi', 'tampi@gmail.com', '$2y$10$.YlOGgTzuCIOXOIuvJUrA.5jXsccCa1Xmjg1/5QasgrswVapW5vNO', 'Tampi-1675951562.png', '08976542421', 'Tabanan', 'active', NULL, '2023-02-09 06:06:02', '2023-02-09 06:06:02'),
(24, 3, 'Resa', 'resa@gmail.com', '$2y$10$d3KjcrrzFulPelz5iU2WI.OELJznKX/FIpaXoRyqg0RFYV0sPLGAe', '', '0897654235566', 'Denpasar', 'active', NULL, '2023-02-09 06:06:33', '2023-02-09 06:06:33');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `name`, `slug`, `type`, `created_at`, `updated_at`) VALUES
(1, 'Toyota Avanza', 'toyota-avanza', 1, NULL, '2023-02-05 21:53:51'),
(2, 'Honda', 'honda', 1, NULL, NULL),
(3, 'Suzuki', 'suzuki', 1, NULL, NULL),
(4, 'Kijang', 'kijang', 1, '2022-11-21 18:14:10', '2022-11-21 18:14:10'),
(5, 'Ferrari', 'ferrari', 1, '2022-11-21 18:14:54', '2022-11-21 18:14:54'),
(7, 'Porsche', 'porsche', 1, '2022-11-21 18:17:04', '2022-11-21 18:17:04'),
(8, 'Carrera GT', 'carrera-gt', 1, '2022-11-21 18:17:43', '2022-11-21 18:17:43'),
(19, 'Supra', 'supra', 1, '2023-02-07 03:58:40', '2023-02-07 03:58:40'),
(20, 'Yamaha', 'yamaha', 2, '2023-02-07 04:41:48', '2023-02-08 15:46:27'),
(21, 'Hondaa', 'hondaa', 2, '2023-02-07 19:47:40', '2023-02-08 15:46:36'),
(22, 'Suuzuki', 'suuzuki', 2, '2023-02-08 15:46:45', '2023-02-08 15:46:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cars_vendor_id_foreign` (`vendor_id`);

--
-- Indexes for table `car_category`
--
ALTER TABLE `car_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `car_category_car_id_foreign` (`car_id`),
  ADD KEY `car_category_category_id_foreign` (`category_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `motors`
--
ALTER TABLE `motors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `motors_vendor_id_foreign` (`vendor_id`);

--
-- Indexes for table `motor_category`
--
ALTER TABLE `motor_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `motor_category_car_id_foreign` (`motor_id`),
  ADD KEY `motor_category_category_id_foreign` (`category_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `rent_logs`
--
ALTER TABLE `rent_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rent_logs_user_id_foreign` (`user_id`),
  ADD KEY `rent_logs_car_id_foreign` (`car_id`),
  ADD KEY `rent_logs_motor_id_foreign` (`motor_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `samsats`
--
ALTER TABLE `samsats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `car_category`
--
ALTER TABLE `car_category`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `motors`
--
ALTER TABLE `motors`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `motor_category`
--
ALTER TABLE `motor_category`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rent_logs`
--
ALTER TABLE `rent_logs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `samsats`
--
ALTER TABLE `samsats`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cars`
--
ALTER TABLE `cars`
  ADD CONSTRAINT `cars_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `car_category`
--
ALTER TABLE `car_category`
  ADD CONSTRAINT `car_category_car_id_foreign` FOREIGN KEY (`car_id`) REFERENCES `cars` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `car_category_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `motors`
--
ALTER TABLE `motors`
  ADD CONSTRAINT `motors_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `motor_category`
--
ALTER TABLE `motor_category`
  ADD CONSTRAINT `motor_category_car_id_foreign` FOREIGN KEY (`motor_id`) REFERENCES `motors` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `motor_category_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `rent_logs`
--
ALTER TABLE `rent_logs`
  ADD CONSTRAINT `rent_logs_car_id_foreign` FOREIGN KEY (`car_id`) REFERENCES `cars` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `rent_logs_motor_id_foreign` FOREIGN KEY (`motor_id`) REFERENCES `motors` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `rent_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
