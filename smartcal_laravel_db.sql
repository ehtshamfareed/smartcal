-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 02, 2026 at 04:16 PM
-- Server version: 8.0.30
-- PHP Version: 8.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smartcal_laravel_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `daily_logs`
--

CREATE TABLE `daily_logs` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `food_item_id` bigint UNSIGNED DEFAULT NULL,
  `custom_food_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meal_type` enum('breakfast','lunch','dinner','snacks') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'snacks',
  `calories` double NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `daily_logs`
--

INSERT INTO `daily_logs` (`id`, `user_id`, `date`, `food_item_id`, `custom_food_name`, `meal_type`, `calories`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 3, '2026-03-03', 10, 'Chai (with sugar)', 'snacks', 120, 0, '2026-03-05 23:56:44', '2026-03-05 23:56:44'),
(2, 3, '2026-03-03', NULL, 'Pizza', 'lunch', 1500, 0, '2026-03-05 23:56:44', '2026-03-05 23:56:44'),
(3, 3, '2026-03-03', NULL, 'zinger burger', 'dinner', 1800, 0, '2026-03-05 23:56:44', '2026-03-05 23:56:44'),
(4, 3, '2026-03-03', NULL, 'Yogurt', 'snacks', 100, 0, '2026-03-05 23:56:44', '2026-03-05 23:56:44'),
(5, 3, '2026-02-24', 9, 'Paratha', 'breakfast', 290, 0, '2026-03-05 23:56:44', '2026-03-05 23:56:44'),
(6, 3, '2026-02-24', 5, 'Apple', 'lunch', 95, 0, '2026-03-05 23:56:44', '2026-03-05 23:56:44'),
(7, 3, '2026-02-24', 9, 'Paratha', 'snacks', 290, 0, '2026-03-05 23:56:44', '2026-03-05 23:56:44'),
(8, 3, '2026-02-25', NULL, 'Greek Yogurt', 'breakfast', 188, 0, '2026-03-05 23:56:44', '2026-03-05 23:56:44'),
(9, 3, '2026-02-25', NULL, 'Chicken Breast (200g)', 'lunch', 233, 0, '2026-03-05 23:56:44', '2026-03-05 23:56:44'),
(10, 3, '2026-02-25', 4, 'Daal (Lentils)', 'snacks', 150, 0, '2026-03-05 23:56:44', '2026-03-05 23:56:44'),
(11, 3, '2026-02-25', 2, 'Rice (Boiled)', 'dinner', 205, 0, '2026-03-05 23:56:44', '2026-03-05 23:56:44'),
(12, 3, '2026-02-25', NULL, 'Whey Protein Shake', 'snacks', 410, 0, '2026-03-05 23:56:44', '2026-03-05 23:56:44'),
(13, 3, '2026-02-26', 6, 'Banana', 'breakfast', 105, 0, '2026-03-05 23:56:44', '2026-03-05 23:56:44'),
(14, 3, '2026-02-26', 5, 'Apple', 'lunch', 95, 0, '2026-03-05 23:56:44', '2026-03-05 23:56:44'),
(15, 3, '2026-02-26', 4, 'Daal (Lentils)', 'snacks', 150, 0, '2026-03-05 23:56:44', '2026-03-05 23:56:44'),
(16, 3, '2026-02-27', 4, 'Daal (Lentils)', 'breakfast', 150, 0, '2026-03-05 23:56:44', '2026-03-05 23:56:44'),
(17, 3, '2026-02-27', NULL, 'Chicken Breast (200g)', 'lunch', 269, 0, '2026-03-05 23:56:44', '2026-03-05 23:56:44'),
(18, 3, '2026-02-27', 2, 'Rice (Boiled)', 'snacks', 205, 0, '2026-03-05 23:56:44', '2026-03-05 23:56:44'),
(19, 3, '2026-02-28', 3, 'Chicken Biryani', 'breakfast', 500, 0, '2026-03-05 23:56:44', '2026-03-05 23:56:44'),
(20, 3, '2026-02-28', 3, 'Chicken Biryani', 'lunch', 500, 0, '2026-03-05 23:56:44', '2026-03-05 23:56:44'),
(21, 3, '2026-02-28', 10, 'Chai (with sugar)', 'snacks', 120, 0, '2026-03-05 23:56:44', '2026-03-05 23:56:44'),
(22, 3, '2026-03-01', 5, 'Apple', 'breakfast', 95, 0, '2026-03-05 23:56:44', '2026-03-05 23:56:44'),
(23, 3, '2026-03-01', 3, 'Chicken Biryani', 'lunch', 500, 0, '2026-03-05 23:56:44', '2026-03-05 23:56:44'),
(24, 3, '2026-03-01', 1, 'Roti', 'snacks', 120, 0, '2026-03-05 23:56:44', '2026-03-05 23:56:44'),
(25, 3, '2026-03-01', 8, 'Egg (Boiled)', 'dinner', 78, 0, '2026-03-05 23:56:44', '2026-03-05 23:56:44'),
(26, 3, '2026-03-01', 3, 'Chicken Biryani', 'snacks', 500, 0, '2026-03-05 23:56:44', '2026-03-05 23:56:44'),
(27, 3, '2026-03-02', 1, 'Roti', 'breakfast', 120, 0, '2026-03-05 23:56:44', '2026-03-05 23:56:44'),
(28, 3, '2026-03-02', NULL, 'Black Coffee', 'lunch', 204, 0, '2026-03-05 23:56:44', '2026-03-05 23:56:44'),
(29, 3, '2026-03-02', 3, 'Chicken Biryani', 'snacks', 500, 0, '2026-03-05 23:56:44', '2026-03-05 23:56:44'),
(30, 3, '2026-03-02', 9, 'Paratha', 'dinner', 290, 0, '2026-03-05 23:56:44', '2026-03-05 23:56:44'),
(31, 3, '2026-03-02', NULL, 'Oats & Berries', 'snacks', 252, 0, '2026-03-05 23:56:44', '2026-03-05 23:56:44'),
(32, 6, '2026-06-01', 8, 'Egg (Boiled)', 'breakfast', 78, 0, '2026-06-01 14:18:28', '2026-06-01 14:18:28'),
(33, 6, '2026-06-01', 1, 'Roti', 'snacks', 120, 0, '2026-06-01 14:32:50', '2026-06-01 14:32:50'),
(34, 6, '2026-06-01', 9, 'Paratha', 'snacks', 290, 0, '2026-06-01 15:33:45', '2026-06-01 15:33:45'),
(35, 7, '2026-06-01', 11, 'Brown Bread', 'snacks', 120, 0, '2026-06-01 17:12:18', '2026-06-01 17:12:18'),
(36, 7, '2026-06-01', 3, 'Chicken Biryani', 'snacks', 500, 0, '2026-06-01 17:12:30', '2026-06-01 17:12:30'),
(37, 7, '2026-06-01', 9, 'Paratha', 'breakfast', 290, 0, '2026-06-01 17:12:43', '2026-06-01 17:12:43'),
(38, 7, '2026-06-01', 11, 'Brown Bread', 'dinner', 120, 0, '2026-06-01 17:15:15', '2026-06-01 17:15:15'),
(39, 7, '2026-06-01', 4, 'Daal (Lentils)', 'lunch', 150, 0, '2026-06-01 17:16:00', '2026-06-01 17:16:00'),
(40, 7, '2026-06-01', 10, 'Chai (with sugar)', 'breakfast', 120, 0, '2026-06-01 17:16:56', '2026-06-01 17:16:56'),
(41, 7, '2026-06-01', 1, 'Roti', 'breakfast', 120, 0, '2026-06-01 17:17:56', '2026-06-01 17:17:56'),
(42, 7, '2026-06-01', 10, 'Chai (with sugar)', 'breakfast', 120, 0, '2026-06-01 17:19:41', '2026-06-01 17:19:41'),
(43, 7, '2026-06-01', 9, 'Paratha', 'dinner', 290, 0, '2026-06-01 17:20:11', '2026-06-01 17:20:11');

-- --------------------------------------------------------

--
-- Table structure for table `exercises`
--

CREATE TABLE `exercises` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` enum('Cardio','Strength','Flexibility','Sports') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Cardio',
  `met_value` double NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exercises`
--

INSERT INTO `exercises` (`id`, `name`, `category`, `met_value`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'Walking (Brisk)', 'Cardio', 4.3, 0, '2026-03-05 18:46:28', '2026-03-05 18:46:28'),
(2, 'Running (Jogging)', 'Cardio', 7, 0, '2026-03-05 18:46:28', '2026-03-05 18:46:28'),
(3, 'Running (Fast)', 'Cardio', 11.5, 0, '2026-03-05 18:46:28', '2026-03-05 18:46:28'),
(4, 'Cycling (Moderate)', 'Cardio', 8, 0, '2026-03-05 18:46:28', '2026-03-05 18:46:28'),
(5, 'Weight Lifting (General)', 'Strength', 3, 0, '2026-03-05 18:46:28', '2026-03-05 18:46:28'),
(6, 'Weight Lifting (Vigorous)', 'Strength', 6, 0, '2026-03-05 18:46:28', '2026-03-05 18:46:28'),
(7, 'Yoga', 'Flexibility', 2.5, 0, '2026-03-05 18:46:28', '2026-03-05 18:46:28'),
(8, 'Swimming', 'Cardio', 6, 0, '2026-03-05 18:46:28', '2026-03-05 18:46:28'),
(9, 'HIIT', 'Cardio', 8, 0, '2026-03-05 18:46:28', '2026-03-05 18:46:28'),
(10, 'Football (Soccer)', 'Sports', 7, 0, '2026-03-05 18:46:28', '2026-03-05 18:46:28');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `food_items`
--

CREATE TABLE `food_items` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `suitability` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'universal',
  `serving_size` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `calories` double NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `food_items`
--

INSERT INTO `food_items` (`id`, `name`, `category`, `suitability`, `serving_size`, `calories`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'Roti', 'Staple', 'universal', '1 piece (Medium)', 120, 0, '2026-03-05 18:46:28', '2026-03-05 18:46:28'),
(2, 'Rice (Boiled)', 'Staple', 'universal', '1 cup', 205, 0, '2026-03-05 18:46:28', '2026-03-05 18:46:28'),
(3, 'Chicken Biryani', 'Main Course', 'universal', '1 plate', 500, 0, '2026-03-05 18:46:28', '2026-03-05 18:46:28'),
(4, 'Daal (Lentils)', 'Main Course', 'universal', '1 bowl', 150, 0, '2026-03-05 18:46:28', '2026-03-05 18:46:28'),
(5, 'Apple', 'Fruit', 'universal', '1 medium', 95, 0, '2026-03-05 18:46:28', '2026-03-05 18:46:28'),
(6, 'Banana', 'Fruit', 'universal', '1 medium', 105, 0, '2026-03-05 18:46:28', '2026-03-05 18:46:28'),
(7, 'Milk', 'Dairy', 'universal', '1 glass', 150, 0, '2026-03-05 18:46:28', '2026-03-05 18:46:28'),
(8, 'Egg (Boiled)', 'Protein', 'universal', '1 large', 78, 0, '2026-03-05 18:46:28', '2026-03-05 18:46:28'),
(9, 'Paratha', 'Staple', 'universal', '1 piece', 290, 0, '2026-03-05 18:46:28', '2026-03-05 18:46:28'),
(10, 'Chai (with sugar)', 'Beverage', 'universal', '1 cup', 120, 0, '2026-03-05 18:46:28', '2026-03-05 18:46:28'),
(11, 'Brown Bread', 'Dairy', 'loss', '2 slices', 120, 0, '2026-06-01 17:11:01', '2026-06-01 17:11:01'),
(12, 'Burger', 'Fast Food', 'gain', '6 slices', 999.8, 0, '2026-06-01 17:22:58', '2026-06-01 17:22:58');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(28, '0001_01_01_000000_create_users_table', 1),
(29, '0001_01_01_000001_create_cache_table', 1),
(30, '0001_01_01_000002_create_jobs_table', 1),
(31, '2026_03_05_230330_create_daily_logs_table', 1),
(32, '2026_03_05_230330_create_food_items_table', 1),
(33, '2026_03_05_230331_create_exercises_table', 1),
(34, '2026_03_05_230331_create_weight_logs_table', 1),
(35, '2026_03_05_230332_create_water_logs_table', 1),
(36, '2026_03_05_230332_create_workout_logs_table', 1),
(37, '2026_06_02_120000_add_suitability_to_food_items_table', 2),
(38, '2026_06_02_130000_create_reviews_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `rating` int NOT NULL,
  `review_text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_approved` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `rating`, `review_text`, `is_approved`, `created_at`, `updated_at`) VALUES
(1, 8, 5, 'Before SmartCal, I was just eating healthily but had no idea my portions were too big. Seeing my actual calories helped me build a better relationship with my food.', 1, '2026-06-02 05:57:21', '2026-06-02 10:39:50'),
(2, 9, 4, 'Tracking what I eat shouldn\'t feel like a punishment. SmartCal\'s interface makes it feel like self-care. It\'s so easy to log my breakfast smoothies and dinner salads.', 1, '2026-06-02 05:57:21', '2026-06-02 10:39:50'),
(3, 10, 5, 'Cleanest UI I\'ve ever used. The dashboard layout with the subtle aesthetics makes managing my daily hydration and nutrition inputs feel incredibly calming.', 1, '2026-06-02 05:57:21', '2026-06-02 10:39:50'),
(4, 7, 5, 'I have lost weight so much impressed', 1, '2026-06-02 10:37:45', '2026-06-02 10:41:05');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('dZrGMQxyuNvmyGqogWFcaiD1GAFbajSZg7YZcFpm', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoic3l4VnJUVFBJMHBlYkpxZ243WUYxNWVXN2Q3N0xRTklSdjJZMDBvOCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo1OiJpbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1780416986);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('user','admin') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `age` int NOT NULL DEFAULT '25',
  `gender` enum('male','female') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'male',
  `height_cm` int NOT NULL DEFAULT '170',
  `weight_kg` double NOT NULL DEFAULT '70',
  `activity_level` enum('sedentary','light','moderate','active','very_active') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'light',
  `weight_goal` enum('lose','maintain','gain') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'maintain',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `age`, `gender`, `height_cm`, `weight_kg`, `activity_level`, `weight_goal`, `is_deleted`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'System Admin', 'admin@smartcal.com', NULL, '$2y$12$LM7I6mdJLe4yVz1Wg.ULFu6QE2nBpwLUF4NM1FXQ7i.W8u8EvrYpC', 'admin', 25, 'male', 170, 70, 'light', 'maintain', 0, NULL, '2026-03-05 18:46:28', '2026-03-05 18:46:28'),
(2, 'John Doe', 'johndoe@example.com', NULL, '$2y$12$ZfqpE2X5Xf.U7LvrOjJdn.ipRoh6rMvuDZkWwCFSF2p5U2KEUwlHW', 'user', 28, 'male', 175, 75, 'moderate', 'maintain', 0, NULL, '2026-03-05 18:46:28', '2026-03-05 18:46:28'),
(3, 'Sara', 'Sara@example.com', NULL, '$2y$10$D8E1ZmX.7fcXgc1YjgP3lOnC4a4FW0wt0eP7ON9K1N4lkZ4SwVT7K', 'user', 27, 'female', 160, 90, 'moderate', 'maintain', 0, NULL, '2026-03-05 23:56:44', '2026-03-05 23:56:44'),
(4, 'System Admin', 'admin@fitcalc.com', NULL, '$2y$12$saGY46Z481V.pEOuwSxxQOnzMPJ44..FQWuBdQwBczoU8o8ERbxHC', 'admin', 25, 'male', 170, 70, 'light', 'maintain', 0, NULL, '2026-03-05 23:56:44', '2026-06-01 05:36:32'),
(5, 'Aiman', 'aiman@smartcal.com', NULL, '$2y$12$9peZ3xqhSDNyIaXkaZOtaexMbe3h6k6miK4QR3k2M.ifDSxysdOj6', 'user', 25, 'male', 170, 70, 'light', 'maintain', 1, NULL, '2026-06-01 13:46:52', '2026-06-01 16:38:08'),
(6, 'Aiman', 'user@remarket.com', NULL, '$2y$12$FA1M0FD54abXFcKG8Gc/O.2EQGtw8azWHcD3xOUN.VLDONylu2si6', 'user', 27, 'female', 174, 50, 'light', 'maintain', 0, NULL, '2026-06-01 13:59:51', '2026-06-01 13:59:51'),
(7, 'Saboor', 'Saboor@smartcal.com', NULL, '$2y$12$25Uwh83flkgIYzywhrqMA.d2h3mzTg.7MkyoYka.VI/NiFWjEVgAa', 'user', 25, 'female', 175, 55, 'active', 'lose', 0, NULL, '2026-06-01 17:12:05', '2026-06-01 17:12:05'),
(8, 'Ayesha Khan', 'ayesha@dummy.com', NULL, '$2y$12$9YdKHT7saeaicvb/NOlt.uG3qQghhJjE9geGAkLVDUVNwrU0Dqk4m', 'user', 25, 'female', 160, 60, 'moderate', 'maintain', 0, NULL, '2026-06-02 10:37:51', '2026-06-02 10:37:51'),
(9, 'Bilal Ahmed', 'bilal@dummy.com', NULL, '$2y$12$efg53Bqx/WqDO.wJ9ryJe.4qoJnKoWkYEhFCV/KAErxnHQmKrYNpO', 'user', 28, 'male', 175, 75, 'active', 'lose', 0, NULL, '2026-06-02 10:39:49', '2026-06-02 10:39:49'),
(10, 'Fatima Sheikh', 'fatima@dummy.com', NULL, '$2y$12$fSJ4OpUPMhHnWdeicfEmXOjYnRzO2tehfOi1PslpunXAL9IZWQj4S', 'user', 26, 'female', 165, 62, 'sedentary', 'maintain', 0, NULL, '2026-06-02 10:39:50', '2026-06-02 10:39:50');

-- --------------------------------------------------------

--
-- Table structure for table `water_logs`
--

CREATE TABLE `water_logs` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `glasses` int NOT NULL DEFAULT '0',
  `daily_goal` int NOT NULL DEFAULT '8',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `water_logs`
--

INSERT INTO `water_logs` (`id`, `user_id`, `date`, `glasses`, `daily_goal`, `created_at`, `updated_at`) VALUES
(1, 3, '2026-03-03', 3, 8, '2026-03-05 23:56:44', '2026-03-05 23:56:44'),
(2, 3, '2026-03-04', 0, 8, '2026-03-05 23:56:44', '2026-03-05 23:56:44'),
(3, 6, '2026-06-01', 6, 8, '2026-06-01 14:04:53', '2026-06-01 16:01:53'),
(4, 7, '2026-06-01', 1, 8, '2026-06-01 17:20:19', '2026-06-01 17:20:19');

-- --------------------------------------------------------

--
-- Table structure for table `weight_logs`
--

CREATE TABLE `weight_logs` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `weight_kg` double NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `weight_logs`
--

INSERT INTO `weight_logs` (`id`, `user_id`, `date`, `weight_kg`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 3, '2026-02-24', 90.3, 0, '2026-03-05 23:56:44', '2026-03-05 23:56:44'),
(2, 3, '2026-02-25', 90.4, 0, '2026-03-05 23:56:44', '2026-03-05 23:56:44'),
(3, 3, '2026-02-26', 90.2, 0, '2026-03-05 23:56:44', '2026-03-05 23:56:44'),
(4, 3, '2026-02-27', 90.5, 0, '2026-03-05 23:56:44', '2026-03-05 23:56:44'),
(5, 3, '2026-02-28', 89.7, 0, '2026-03-05 23:56:44', '2026-03-05 23:56:44'),
(6, 3, '2026-03-01', 89.7, 0, '2026-03-05 23:56:44', '2026-03-05 23:56:44'),
(7, 3, '2026-03-02', 90.4, 0, '2026-03-05 23:56:44', '2026-03-05 23:56:44'),
(8, 3, '2026-03-03', 90, 0, '2026-03-05 23:56:44', '2026-03-05 23:56:44'),
(9, 7, '2026-06-02', 55, 0, '2026-06-02 10:36:23', '2026-06-02 10:36:23');

-- --------------------------------------------------------

--
-- Table structure for table `workout_logs`
--

CREATE TABLE `workout_logs` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `exercise_id` bigint UNSIGNED DEFAULT NULL,
  `custom_exercise_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duration_minutes` int NOT NULL,
  `calories_burned` double NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `workout_logs`
--

INSERT INTO `workout_logs` (`id`, `user_id`, `date`, `exercise_id`, `custom_exercise_name`, `duration_minutes`, `calories_burned`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 7, '2026-06-01', NULL, 'Gym', 30, 200, 0, '2026-06-01 17:28:22', '2026-06-01 17:28:22'),
(2, 7, '2026-06-01', NULL, 'Individual Sport', 35, 263, 0, '2026-06-01 17:28:32', '2026-06-01 17:28:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `daily_logs`
--
ALTER TABLE `daily_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `daily_logs_user_id_foreign` (`user_id`);

--
-- Indexes for table `exercises`
--
ALTER TABLE `exercises`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `food_items`
--
ALTER TABLE `food_items`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `water_logs`
--
ALTER TABLE `water_logs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `water_logs_user_id_date_unique` (`user_id`,`date`);

--
-- Indexes for table `weight_logs`
--
ALTER TABLE `weight_logs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `weight_logs_user_id_date_unique` (`user_id`,`date`);

--
-- Indexes for table `workout_logs`
--
ALTER TABLE `workout_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `workout_logs_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `daily_logs`
--
ALTER TABLE `daily_logs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `exercises`
--
ALTER TABLE `exercises`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `food_items`
--
ALTER TABLE `food_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `water_logs`
--
ALTER TABLE `water_logs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `weight_logs`
--
ALTER TABLE `weight_logs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `workout_logs`
--
ALTER TABLE `workout_logs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `daily_logs`
--
ALTER TABLE `daily_logs`
  ADD CONSTRAINT `daily_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `water_logs`
--
ALTER TABLE `water_logs`
  ADD CONSTRAINT `water_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `weight_logs`
--
ALTER TABLE `weight_logs`
  ADD CONSTRAINT `weight_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `workout_logs`
--
ALTER TABLE `workout_logs`
  ADD CONSTRAINT `workout_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
