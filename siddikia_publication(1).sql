-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 02, 2024 at 06:31 AM
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
-- Database: `siddikia_publication`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `book_bangla_name` varchar(255) NOT NULL,
  `book_english_name` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `writer_id` int(11) NOT NULL,
  `short_description` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `publising_date` date DEFAULT NULL,
  `book_of_page` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `book_bangla_name`, `book_english_name`, `category_id`, `writer_id`, `short_description`, `image`, `price`, `publising_date`, `book_of_page`, `status`, `created_at`, `updated_at`) VALUES
(1, 'কন্যে তুমি শেখ হাসিনা', 'Kone tumi Shekh Hasina', 1, 1, 'Life Style nice Book.', '1715511427.jpg', 320, '2017-05-02', 24, 0, '2024-05-12 04:36:38', '2024-05-12 04:57:07'),
(4, 'Bongobondhur Biplobi Chetona', 'Father Of nation brave', 1, 3, 'scrtfgyhbyfuigbyomiy', '1715742648.jpg', 550, '2018-02-21', 320, 0, '2024-05-14 21:10:48', '2024-05-14 21:10:48'),
(5, 'স্বপ্নের ঠিকানা', 'Dream address', 3, 4, 'eafdfvxsdfew', '1716702440.jpg', 150, '2018-02-21', 88, 0, '2024-05-25 23:47:20', '2024-05-25 23:47:20'),
(7, 'fnhdxf5', 'vghum', 1, 1, 'frgbxdfg', NULL, NULL, '2024-05-17', 745, 0, '2024-05-26 00:32:13', '2024-05-26 00:32:13'),
(8, 'b', 'a', 1, 4, 'fsdfsa', NULL, NULL, '2024-05-06', 45, 0, '2024-05-26 01:22:55', '2024-05-26 01:22:55'),
(9, 'f', 'd', 3, 4, 'lkph', NULL, NULL, '2024-05-02', 35, 0, '2024-05-26 01:23:40', '2024-05-26 01:23:40'),
(10, 'নিরাপদ দুরুত্বে থাকি', 'Stay at a safe distance', 4, 7, 'নিরাপদ দুরুত্বে থাকি', '1717083832.jpg', 150, '2024-05-06', 35, 0, '2024-05-30 09:43:52', '2024-05-30 09:43:52');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `short_description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `short_description`, `created_at`, `updated_at`) VALUES
(1, 'Bonghobondhu & Fredom', 'lorem lorem lorem', '2024-05-11 23:39:10', '2024-05-11 23:50:10'),
(3, 'উপন্যাস', 'rxgcvbhjgfyu', '2024-05-25 23:44:25', '2024-05-25 23:44:25'),
(4, 'কবিতা', 'কবিতা কবিতা', '2024-05-30 09:36:56', '2024-05-30 09:36:56');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phone` int(15) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `phone`, `address`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Afra Jahan Aynan', 1326549875, '50,khilgaon Dhaka', 0, 0, '2024-05-21 01:01:30', '2024-05-21 01:01:30'),
(3, 'Mr. Rahim', 1654239874, 'Kakrail, Dhaka-1212', 0, 0, '2024-05-21 08:44:17', '2024-05-21 08:45:19'),
(4, 'Abdul Jabbar', 1987423651, 'Rampura', 0, 0, '2024-05-25 21:19:02', '2024-06-01 09:21:52'),
(13, 'Super Admin', 1784563294, 'kakrail, Dhaka', NULL, 0, '2024-06-01 09:16:09', '2024-06-01 09:16:09'),
(16, 'unknown', 0, 'unknown', 2, 0, '2024-06-01 22:12:05', '2024-06-01 22:12:05');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_05_12_005457_create_writers_table', 1),
(5, '2024_05_12_005516_create_categories_table', 1),
(6, '2024_05_12_060624_create_books_table', 2),
(9, '2024_05_12_090758_add_book_of_page_to_books_table', 3),
(11, '2024_05_12_112343_create_stock_details_table', 4),
(15, '2024_05_12_112323_create_stock_table', 5),
(16, '2024_05_12_060642_create_customers_table', 6),
(19, '2024_05_24_164056_add_price_to_books_table', 7),
(20, '2024_05_12_112413_create_sales_table', 8),
(21, '2024_05_12_112423_create_sale_details_table', 8);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `total_quantity` varchar(255) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `discount` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `customer_id`, `total_quantity`, `total_price`, `user_id`, `discount`, `status`, `created_at`, `updated_at`) VALUES
(11, 1, '10', 4350.00, 2, 0, 0, '2024-05-25 22:13:43', '2024-05-25 22:13:43'),
(12, 3, '8', 1710.00, 2, 0, 0, '2024-05-26 01:57:47', '2024-05-26 01:57:47'),
(13, 4, '8', 2510.00, 2, 0, 0, '2024-05-30 08:38:58', '2024-05-30 08:38:58'),
(14, 13, '19', 6450.00, 2, 0, 0, '2024-05-30 09:48:02', '2024-05-30 09:48:02'),
(15, 16, '13', 4600.00, 2, 0, 0, '2024-05-31 08:48:08', '2024-05-31 08:48:08'),
(16, 13, '11', 3780.00, 2, 0, 0, '2024-05-31 08:54:44', '2024-05-31 08:54:44'),
(17, 13, '8', 3240.00, 2, 0, 0, '2024-05-31 09:27:22', '2024-05-31 09:27:22'),
(18, 4, '7', 2290.00, 2, 0, 0, '2024-05-31 10:18:54', '2024-05-31 10:18:54'),
(19, 16, '6', 2140.00, 2, 0, 0, '2024-05-31 10:48:15', '2024-05-31 10:48:15'),
(20, 4, '5', 2060.00, 2, 0, 0, '2024-05-31 20:14:38', '2024-05-31 20:14:38'),
(21, 3, '4', 1270.00, 2, 0, 0, '2024-06-01 10:48:45', '2024-06-01 10:48:45'),
(22, 16, '1', 550.00, 2, 0, 0, '2024-06-01 10:59:24', '2024-06-01 10:59:24'),
(23, 1, '10', 4600.00, 2, 0, 0, '2024-06-01 22:06:05', '2024-06-01 22:06:05'),
(24, 2, '10', 4160.00, 2, 0, 0, '2024-06-01 22:12:05', '2024-06-01 22:12:05');

-- --------------------------------------------------------

--
-- Table structure for table `sale_details`
--

CREATE TABLE `sale_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `book_id` tinyint(4) NOT NULL,
  `sales_id` tinyint(4) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sale_details`
--

INSERT INTO `sale_details` (`id`, `book_id`, `sales_id`, `quantity`, `price`, `subtotal`, `status`, `created_at`, `updated_at`) VALUES
(6, 4, 11, 5, 550.00, 2750.00, 0, '2024-05-25 22:13:43', '2024-05-25 22:13:43'),
(7, 1, 11, 5, 320.00, 1600.00, 0, '2024-05-25 22:13:43', '2024-05-25 22:13:43'),
(8, 1, 12, 3, 320.00, 960.00, 0, '2024-05-26 01:57:48', '2024-05-26 01:57:48'),
(9, 5, 12, 5, 150.00, 750.00, 0, '2024-05-26 01:57:48', '2024-05-26 01:57:48'),
(10, 5, 13, 3, 150.00, 450.00, 0, '2024-05-30 08:38:58', '2024-05-30 08:38:58'),
(11, 1, 13, 3, 320.00, 960.00, 0, '2024-05-30 08:38:58', '2024-05-30 08:38:58'),
(12, 4, 13, 2, 550.00, 1100.00, 0, '2024-05-30 08:38:58', '2024-05-30 08:38:58'),
(13, 10, 14, 6, 150.00, 900.00, 0, '2024-05-30 09:48:02', '2024-05-30 09:48:02'),
(14, 5, 14, 4, 150.00, 600.00, 0, '2024-05-30 09:48:02', '2024-05-30 09:48:02'),
(15, 4, 14, 9, 550.00, 4950.00, 0, '2024-05-30 09:48:03', '2024-05-30 09:48:03'),
(16, 1, 15, 5, 320.00, 1600.00, 0, '2024-05-31 08:48:08', '2024-05-31 08:48:08'),
(17, 5, 15, 4, 600.00, 2400.00, 0, '2024-05-31 08:48:09', '2024-05-31 08:48:09'),
(18, 5, 15, 4, 150.00, 600.00, 0, '2024-05-31 08:48:09', '2024-05-31 08:48:09'),
(19, 1, 16, 4, 320.00, 1280.00, 0, '2024-05-31 08:54:44', '2024-05-31 08:54:44'),
(20, 5, 16, 3, 600.00, 1800.00, 0, '2024-05-31 08:54:44', '2024-05-31 08:54:44'),
(21, 5, 16, 2, 150.00, 300.00, 0, '2024-05-31 08:54:44', '2024-05-31 08:54:44'),
(22, 10, 16, 2, 200.00, 400.00, 0, '2024-05-31 08:54:44', '2024-05-31 08:54:44'),
(23, 4, 17, 2, 550.00, 1100.00, 0, '2024-05-31 09:27:22', '2024-05-31 09:27:22'),
(24, 1, 17, 2, 320.00, 640.00, 0, '2024-05-31 09:27:22', '2024-05-31 09:27:22'),
(25, 5, 17, 2, 600.00, 1200.00, 0, '2024-05-31 09:27:22', '2024-05-31 09:27:22'),
(26, 5, 17, 2, 150.00, 300.00, 0, '2024-05-31 09:27:22', '2024-05-31 09:27:22'),
(27, 1, 18, 2, 320.00, 640.00, 0, '2024-05-31 10:18:55', '2024-05-31 10:18:55'),
(28, 5, 18, 2, 600.00, 1200.00, 0, '2024-05-31 10:18:55', '2024-05-31 10:18:55'),
(29, 5, 18, 3, 150.00, 450.00, 0, '2024-05-31 10:18:55', '2024-05-31 10:18:55'),
(30, 1, 19, 2, 320.00, 640.00, 0, '2024-05-31 10:48:15', '2024-05-31 10:48:15'),
(31, 5, 19, 2, 600.00, 1200.00, 0, '2024-05-31 10:48:15', '2024-05-31 10:48:15'),
(32, 5, 19, 2, 150.00, 300.00, 0, '2024-05-31 10:48:15', '2024-05-31 10:48:15'),
(33, 1, 20, 3, 320.00, 960.00, 0, '2024-05-31 20:14:38', '2024-05-31 20:14:38'),
(34, 4, 20, 2, 550.00, 1100.00, 0, '2024-05-31 20:14:38', '2024-05-31 20:14:38'),
(35, 1, 21, 1, 320.00, 320.00, 0, '2024-06-01 10:48:45', '2024-06-01 10:48:45'),
(36, 5, 21, 1, 600.00, 600.00, 0, '2024-06-01 10:48:45', '2024-06-01 10:48:45'),
(37, 5, 21, 1, 150.00, 150.00, 0, '2024-06-01 10:48:45', '2024-06-01 10:48:45'),
(38, 10, 21, 1, 200.00, 200.00, 0, '2024-06-01 10:48:45', '2024-06-01 10:48:45'),
(39, 4, 22, 1, 550.00, 550.00, 0, '2024-06-01 10:59:24', '2024-06-01 10:59:24'),
(40, 4, 23, 3, 550.00, 1650.00, 0, '2024-06-01 22:06:05', '2024-06-01 22:06:05'),
(41, 5, 23, 4, 600.00, 2400.00, 0, '2024-06-01 22:06:05', '2024-06-01 22:06:05'),
(42, 10, 23, 2, 200.00, 400.00, 0, '2024-06-01 22:06:05', '2024-06-01 22:06:05'),
(43, 5, 23, 1, 150.00, 150.00, 0, '2024-06-01 22:06:06', '2024-06-01 22:06:06'),
(44, 1, 24, 3, 320.00, 960.00, 0, '2024-06-01 22:12:05', '2024-06-01 22:12:05'),
(45, 4, 24, 2, 550.00, 1100.00, 0, '2024-06-01 22:12:05', '2024-06-01 22:12:05'),
(46, 5, 24, 3, 600.00, 1800.00, 0, '2024-06-01 22:12:06', '2024-06-01 22:12:06'),
(47, 5, 24, 2, 150.00, 300.00, 0, '2024-06-01 22:12:06', '2024-06-01 22:12:06');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('An1tle3vLdfMJWlRLB0T8XxdtcRI3ZyStOr7WkNK', 2, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoicDIzTVVTaW91a0JnR2EzWnFxdW5KWGprNVV4MHdObWc0c2pOWW90aiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6OTM6Imh0dHA6Ly9sb2NhbGhvc3QvU3RvcmVfbWFuYWdlbWVudF9zeXN0ZW0vTmV3JTIwZm9sZGVyL3RvZGF5L2NoZWNrL3NpZGRpa2lhX3B1YmxpY2F0aW9uX3VwZGF0ZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7fQ==', 1717300423),
('K1USpbZqKzRuo7IubAsmLky1g8TRKA3dWtk2sOUQ', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:126.0) Gecko/20100101 Firefox/126.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiemQ2TGloRU9LQ0dyVVE4bU1UVlNFR2pmU0lDYURXVnYxWThGTEZDRiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTEzOiJodHRwOi8vbG9jYWxob3N0L1N0b3JlX21hbmFnZW1lbnRfc3lzdGVtL05ldyUyMGZvbGRlci90b2RheS9jaGVjay9zaWRkaWtpYV9wdWJsaWNhdGlvbl91cGRhdGUvdHJhbnNhY3Rpb25zL2NyZWF0ZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7fQ==', 1717301050),
('pa5CvNbXeUp2CqnHfY1CtxL2CP7Ck0LixiJMRbWr', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:126.0) Gecko/20100101 Firefox/126.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRDdyODdsWlhuamJEZzVORHNpbzRLd1R0ZXhsUndkTFJwVHY1VTlBQyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTcwOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYm9va3Mvc2VhcmNoP3F1ZXJ5PSVFMCVBNiVCOCVFMCVBNyU4RCVFMCVBNiVBQyVFMCVBNiVBQSVFMCVBNyU4RCVFMCVBNiVBOCVFMCVBNyU4NyVFMCVBNiVCMCUyMCVFMCVBNiVBMCVFMCVBNiVCRiVFMCVBNiU5NSVFMCVBNiVCRSVFMCVBNiVBOCVFMCVBNiVCRSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7fQ==', 1717301668),
('UPeel2uFbniDKABua6COmijE4wEYfS3y0q84NVtR', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:126.0) Gecko/20100101 Firefox/126.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoicEoxZUJjaU1rOTE0STJHbW5VNjc5ckM0Ym9mTkhtMVVqcHd2cnFMYiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyO30=', 1717301371);

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `book_id` tinyint(4) NOT NULL,
  `stock_detail_id` tinyint(4) NOT NULL,
  `total_quantity` varchar(255) NOT NULL,
  `total_price` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`id`, `book_id`, `stock_detail_id`, `total_quantity`, `total_price`, `status`, `created_at`, `updated_at`) VALUES
(1, 4, 32, '224', '132000', 0, '2024-05-16 00:15:37', '2024-06-01 22:12:05'),
(2, 1, 33, '122', '44160', 0, '2024-05-16 00:16:58', '2024-06-01 22:12:05'),
(5, 5, 42, '108', '28650', 0, '2024-05-26 00:04:06', '2024-06-01 22:12:06'),
(6, 10, 44, '109', '23000', 0, '2024-05-30 09:44:27', '2024-06-01 22:06:06');

-- --------------------------------------------------------

--
-- Table structure for table `stock_details`
--

CREATE TABLE `stock_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `book_id` tinyint(4) NOT NULL,
  `uni_code` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stock_details`
--

INSERT INTO `stock_details` (`id`, `book_id`, `uni_code`, `quantity`, `price`, `status`, `created_at`, `updated_at`) VALUES
(32, 4, 'IN#0011', '183', '550', 0, '2024-05-16 00:15:37', '2024-06-01 22:12:06'),
(33, 1, 'IN#0012', '71', '320', 0, '2024-05-16 00:16:58', '2024-06-01 22:12:05'),
(34, 4, 'IN#0013', '50', '550', 0, '2024-05-16 00:17:22', '2024-05-16 00:17:22'),
(35, 1, 'IN#0014', '50', '320', 0, '2024-05-16 00:18:23', '2024-05-16 00:18:23'),
(36, 1, 'IN#0015', '5', '320', 0, '2024-05-16 00:20:12', '2024-05-16 00:20:12'),
(42, 5, 'IN#0016', '82', '150', 0, '2024-05-26 00:04:06', '2024-06-01 22:12:06'),
(43, 5, 'IN#0017', '38', '600', 0, '2024-05-30 09:31:31', '2024-05-30 09:31:31'),
(44, 10, 'IN#0018', '55', '200', 0, '2024-05-30 09:44:27', '2024-06-01 22:06:06');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `user_type_id` tinyint(2) NOT NULL DEFAULT 3,
  `image` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `user_type_id`, `image`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', 2, NULL, NULL, '$2y$12$xRRD2UdlbOiE1zUsJ2A/VeVaB.IrPjvd2DHcBCn/gMx3JaFJ9Qp0m', 'mRRHy961Bq2wfprdyETbagg0DXulSBypdxk5AsTIOzi3Rj8nP3', '2024-05-25 20:44:59', '2024-05-25 20:44:59'),
(2, 'Super Admin', 'superadmin@gmail.com', 1, NULL, NULL, '$2y$12$QI8JbSg3Yulr3eWUblM84OyGId3MCewiJoV7WKf87l/2qGg0uy3QW', 'KIhXLvGscKXYibWfYCcKXQkc0X5dD6x8SR7bRav8ZMfO6dYoWTIm7lQGK45p', '2024-05-25 20:52:48', '2024-05-25 20:52:48'),
(3, 'Normal User', 'user@gmail.com', 3, NULL, NULL, '$2y$12$gAWfazSAfFD4h6zUbqtz9eIvrJBHsZBudhCKXbH/a5lhaRt.oE7vW', 'XDig3K1e1WWCEa6c3Y7Uy3TdLRlAM6AfOXZChJO9Srv1a4Mo6Z', '2024-05-26 05:24:00', '2024-05-26 05:24:00');

-- --------------------------------------------------------

--
-- Table structure for table `user_types`
--

CREATE TABLE `user_types` (
  `id` int(11) NOT NULL,
  `type` varchar(12) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_types`
--

INSERT INTO `user_types` (`id`, `type`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', '2024-06-01 23:16:33', '2024-06-01 23:16:33'),
(2, 'Admin', '2024-06-01 23:16:33', '2024-06-01 23:16:33'),
(3, 'User', '2024-06-01 23:17:36', '2024-06-01 23:17:36');

-- --------------------------------------------------------

--
-- Table structure for table `writers`
--

CREATE TABLE `writers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `writer_name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `short_description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `writers`
--

INSERT INTO `writers` (`id`, `writer_name`, `image`, `short_description`, `created_at`, `updated_at`) VALUES
(1, 'khalek Bin Joyenuddin', '1715491016.png', 'He is historical writer . He is famous writer .', '2024-05-11 21:58:55', '2024-05-11 23:16:56'),
(3, 'Milon Sobosachari', '1715742417.png', 'ydgbxyryerdfgjh', '2024-05-14 21:06:57', '2024-05-14 21:06:57'),
(4, 'Omar Faruk Mizi', '1716702321.png', 'sersrxdfd', '2024-05-25 23:45:21', '2024-05-25 23:45:21'),
(6, 'xcsaf', NULL, 'xcvxgerfgs', '2024-05-26 00:53:25', '2024-05-26 00:53:25'),
(7, 'Farid Ahmed Dulal', NULL, 'poety', '2024-05-30 09:35:09', '2024-05-30 09:37:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sale_details`
--
ALTER TABLE `sale_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_details`
--
ALTER TABLE `stock_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_types`
--
ALTER TABLE `user_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `writers`
--
ALTER TABLE `writers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `sale_details`
--
ALTER TABLE `sale_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `stock_details`
--
ALTER TABLE `stock_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_types`
--
ALTER TABLE `user_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `writers`
--
ALTER TABLE `writers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
