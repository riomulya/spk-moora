-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for spk-moora
CREATE DATABASE IF NOT EXISTS `spk-moora` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `spk-moora`;

-- Dumping structure for table spk-moora.alternatifs
CREATE TABLE IF NOT EXISTS `alternatifs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` tinyint(1) NOT NULL DEFAULT '1',
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table spk-moora.alternatifs: ~4 rows (approximately)
REPLACE INTO `alternatifs` (`id`, `kode`, `name`, `gender`, `phone`, `email`, `address`, `created_at`, `updated_at`) VALUES
	(1, 'A1', 'Membeli mobil box untuk distribusi barang ke gudang', 1, NULL, NULL, NULL, '2024-12-02 00:35:53', '2024-12-02 00:35:53'),
	(2, 'A2', 'Membeli tanah untuk membangun gudang baru', 1, NULL, NULL, NULL, '2024-12-02 00:36:08', '2024-12-02 00:36:08'),
	(3, 'A3', 'Maintenance sarana teknologi informasi', 1, NULL, NULL, NULL, '2024-12-02 00:36:20', '2024-12-02 00:36:20'),
	(4, 'A4', 'Pengembangan produk baru', 1, NULL, NULL, NULL, '2024-12-02 00:36:29', '2024-12-02 00:36:29');

-- Dumping structure for table spk-moora.alternatif_kriteria
CREATE TABLE IF NOT EXISTS `alternatif_kriteria` (
  `alternatif_id` bigint unsigned NOT NULL,
  `kriteria_id` bigint unsigned NOT NULL,
  `nilai` double(8,2) NOT NULL,
  KEY `alternatif_kriteria_alternatif_id_foreign` (`alternatif_id`),
  KEY `alternatif_kriteria_kriteria_id_foreign` (`kriteria_id`),
  CONSTRAINT `alternatif_kriteria_alternatif_id_foreign` FOREIGN KEY (`alternatif_id`) REFERENCES `alternatifs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `alternatif_kriteria_kriteria_id_foreign` FOREIGN KEY (`kriteria_id`) REFERENCES `kriterias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table spk-moora.alternatif_kriteria: ~20 rows (approximately)
REPLACE INTO `alternatif_kriteria` (`alternatif_id`, `kriteria_id`, `nilai`) VALUES
	(1, 1, 150.00),
	(1, 2, 15.00),
	(1, 3, 2.00),
	(1, 4, 2.00),
	(1, 5, 3.00),
	(2, 1, 500.00),
	(2, 2, 200.00),
	(2, 3, 2.00),
	(2, 4, 3.00),
	(2, 5, 2.00),
	(3, 1, 200.00),
	(3, 2, 10.00),
	(3, 3, 3.00),
	(3, 4, 1.00),
	(3, 5, 3.00),
	(4, 1, 350.00),
	(4, 2, 100.00),
	(4, 3, 3.00),
	(4, 4, 1.00),
	(4, 5, 2.00);

-- Dumping structure for table spk-moora.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table spk-moora.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table spk-moora.kriterias
CREATE TABLE IF NOT EXISTS `kriterias` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bobot` double(8,2) NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '1',
  `min` double(8,2) DEFAULT NULL,
  `max` double(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table spk-moora.kriterias: ~5 rows (approximately)
REPLACE INTO `kriterias` (`id`, `kode`, `name`, `bobot`, `type`, `min`, `max`, `created_at`, `updated_at`) VALUES
	(1, 'C1', 'Harga', 0.25, 0, NULL, NULL, '2024-12-02 00:37:07', '2024-12-02 00:46:49'),
	(2, 'C2', 'Nilai investasi 10 tahun ke depan ', 0.15, 1, NULL, NULL, '2024-12-02 00:37:26', '2024-12-02 00:46:58'),
	(3, 'C3', 'Daya dukung terhadap produktivitas perusahaan', 0.30, 1, NULL, NULL, '2024-12-02 00:37:48', '2024-12-02 00:47:03'),
	(4, 'C4', 'Prioritas kebutuhan ', 0.25, 0, NULL, NULL, '2024-12-02 00:38:10', '2024-12-02 00:47:11'),
	(5, 'C5', 'Ketersediaan atau kemudahan ', 0.05, 1, NULL, NULL, '2024-12-02 00:38:26', '2024-12-02 00:47:17');

-- Dumping structure for table spk-moora.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table spk-moora.migrations: ~0 rows (approximately)
REPLACE INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
	(4, '2019_08_19_000000_create_failed_jobs_table', 1),
	(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(6, '2023_01_19_202510_create_alternatifs_table', 1),
	(7, '2023_01_19_203551_create_kriterias_table', 1),
	(8, '2023_01_19_204627_create_alternatif_kriteria_table', 1),
	(9, '2023_01_20_165245_create_sessions_table', 1),
	(10, '2023_02_01_195558_create_sub_kriterias_table', 1);

-- Dumping structure for table spk-moora.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table spk-moora.password_resets: ~0 rows (approximately)

-- Dumping structure for table spk-moora.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table spk-moora.personal_access_tokens: ~0 rows (approximately)

-- Dumping structure for table spk-moora.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table spk-moora.sessions: ~1 rows (approximately)
REPLACE INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('jpBupX9uX7fMhCYq1G9JvVyCSDpKnWwiFf35mA8O', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiRlNIQzFZTWp6NVduQ0dwbk5aR3kyWTdHWUNmaTQyM0l2dmRFMlBxOSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wZW5pbGFpYW4vcHJvc2VzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjIxOiJwYXNzd29yZF9oYXNoX3NhbmN0dW0iO3M6NjA6IiQyeSQxMCRBU1lNRVhKNFdkNEsyamkvMjFhZUYuOVdLbVdTdFJuVjd1WUdhOUVsbzZ0STR1RlluVWVHQyI7fQ==', 1733100498);

-- Dumping structure for table spk-moora.sub_kriterias
CREATE TABLE IF NOT EXISTS `sub_kriterias` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kriteria_id` bigint unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `min` bigint DEFAULT NULL,
  `max` bigint DEFAULT NULL,
  `bobot` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sub_kriterias_kriteria_id_foreign` (`kriteria_id`),
  CONSTRAINT `sub_kriterias_kriteria_id_foreign` FOREIGN KEY (`kriteria_id`) REFERENCES `kriterias` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table spk-moora.sub_kriterias: ~19 rows (approximately)
REPLACE INTO `sub_kriterias` (`id`, `kriteria_id`, `name`, `min`, `max`, `bobot`, `created_at`, `updated_at`) VALUES
	(1, 1, '150', NULL, NULL, 150, '2024-12-02 00:39:59', '2024-12-02 00:39:59'),
	(2, 1, '500', NULL, NULL, 500, '2024-12-02 00:40:07', '2024-12-02 00:40:07'),
	(3, 1, '200', NULL, NULL, 200, '2024-12-02 00:40:13', '2024-12-02 00:40:13'),
	(4, 1, '350', NULL, NULL, 350, '2024-12-02 00:40:21', '2024-12-02 00:40:21'),
	(5, 2, '15', NULL, NULL, 15, '2024-12-02 00:40:49', '2024-12-02 00:40:49'),
	(6, 2, '200', NULL, NULL, 200, '2024-12-02 00:40:55', '2024-12-02 00:40:55'),
	(7, 2, '10', NULL, NULL, 10, '2024-12-02 00:41:03', '2024-12-02 00:41:03'),
	(8, 2, '100', NULL, NULL, 100, '2024-12-02 00:41:09', '2024-12-02 00:41:09'),
	(9, 3, 'Kurang Mendukung', NULL, NULL, 1, '2024-12-02 00:41:46', '2024-12-02 00:41:46'),
	(10, 3, 'Cukup Mendukung', NULL, NULL, 2, '2024-12-02 00:41:53', '2024-12-02 00:41:53'),
	(11, 3, 'Mendukung', NULL, NULL, 3, '2024-12-02 00:42:07', '2024-12-02 00:42:07'),
	(12, 3, 'Sangat Mendukung', NULL, NULL, 4, '2024-12-02 00:42:16', '2024-12-02 00:42:16'),
	(13, 4, 'Kurang Berprioritas', NULL, NULL, 1, '2024-12-02 00:42:39', '2024-12-02 00:42:39'),
	(14, 4, 'Cukup Berprioritas', NULL, NULL, 2, '2024-12-02 00:42:54', '2024-12-02 00:42:54'),
	(15, 4, 'Berprioritas', NULL, NULL, 3, '2024-12-02 00:43:05', '2024-12-02 00:43:05'),
	(16, 4, 'Sangat Berprioritas', NULL, NULL, 4, '2024-12-02 00:43:13', '2024-12-02 00:43:13'),
	(17, 5, 'Sulit Diperoleh', NULL, NULL, 1, '2024-12-02 00:43:38', '2024-12-02 00:43:38'),
	(18, 5, 'Cukup Mudah Diperoleh', NULL, NULL, 2, '2024-12-02 00:43:51', '2024-12-02 00:43:51'),
	(19, 5, 'Sangat Mudah Diperoleh', NULL, NULL, 3, '2024-12-02 00:44:02', '2024-12-02 00:44:02');

-- Dumping structure for table spk-moora.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint unsigned DEFAULT NULL,
  `profile_photo_path` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table spk-moora.users: ~1 rows (approximately)
REPLACE INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
	(1, 'Rio Mulya', 'riomulya75@gmail.com', NULL, '$2y$10$ASYMEXJ4Wd4K2ji/21aeF.9WKmWStRnV7uYGa9Elo6tI4uFYnUeGC', NULL, NULL, NULL, NULL, NULL, NULL, '2024-12-02 00:34:40', '2024-12-02 00:34:40');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
