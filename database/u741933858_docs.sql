/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19  Distrib 10.11.10-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: u741933858_docs
-- ------------------------------------------------------
-- Server version	10.11.10-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
INSERT INTO `cache` VALUES
('laravel_cache_356a192b7913b04c54574d18c28d46e6395428ab','i:1;',1753905795),
('laravel_cache_356a192b7913b04c54574d18c28d46e6395428ab:timer','i:1753905795;',1753905795),
('laravel_cache_590b8f124542856f31b92b84bad60d566025f816','i:1;',1745701956),
('laravel_cache_590b8f124542856f31b92b84bad60d566025f816:timer','i:1745701956;',1745701956),
('laravel_cache_74ce1c14c4dc2000cafdbf9a69da423ce14c7519','i:1;',1746127936),
('laravel_cache_74ce1c14c4dc2000cafdbf9a69da423ce14c7519:timer','i:1746127936;',1746127936),
('laravel_cache_97cb34b526eb0ec01e4d7105edc69bbc522c62d2','i:1;',1745856662),
('laravel_cache_97cb34b526eb0ec01e4d7105edc69bbc522c62d2:timer','i:1745856662;',1745856662),
('laravel_cache_a15de8988effc0e4bcb7f3675abc933a119b71c4','i:1;',1745780530),
('laravel_cache_a15de8988effc0e4bcb7f3675abc933a119b71c4:timer','i:1745780530;',1745780530),
('laravel_cache_b10ce233b91892aff02ae408a1216e1055965e64','i:1;',1745448627),
('laravel_cache_b10ce233b91892aff02ae408a1216e1055965e64:timer','i:1745448627;',1745448627),
('laravel_cache_c6f1e533e144e5895b6b12410c3012265553dc6c','i:1;',1745613828),
('laravel_cache_c6f1e533e144e5895b6b12410c3012265553dc6c:timer','i:1745613828;',1745613828),
('laravel_cache_dwadwdwa@live.se|146.70.204.181','i:1;',1747389179),
('laravel_cache_dwadwdwa@live.se|146.70.204.181:timer','i:1747389179;',1747389179);
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES
(7,'Gaming','2025-04-22 23:34:27','2025-04-22 23:34:27'),
(8,'Movies','2025-04-22 23:38:43','2025-04-22 23:38:43'),
(9,'Stories','2025-04-22 23:51:00','2025-04-22 23:51:00'),
(10,'History','2025-04-22 23:51:35','2025-04-22 23:51:35'),
(11,'Aliens','2025-04-22 23:55:34','2025-04-22 23:55:34'),
(14,'Music','2025-04-23 01:47:29','2025-04-23 01:47:29'),
(15,'Cyberspace','2025-05-01 21:30:08','2025-05-01 21:30:08');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `images`
--

/*!40000 ALTER TABLE `images` DISABLE KEYS */;
INSERT INTO `images` VALUES
(8,'JDLVq9cF0c.webp',5,'2025-04-21 23:12:38','2025-04-21 23:12:38'),
(9,'SpIkqyPsfp.webp',21,'2025-04-22 00:46:31','2025-04-22 00:46:31'),
(10,'rROH0maT9p.webp',42,'2025-04-23 00:29:47','2025-04-23 00:29:47'),
(12,'Kmiu7KhaDy.webp',153,'2025-07-30 20:02:15','2025-07-30 20:02:15');
/*!40000 ALTER TABLE `images` ENABLE KEYS */;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES
(1,'0001_01_01_000000_create_users_table',1),
(2,'0001_01_01_000001_create_cache_table',1),
(3,'0001_01_01_000002_create_jobs_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES
('5JdWMz2lvB46GZQVFXXy1L9XEpRD2V1JDEOkoGS3',1,'188.240.57.244','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoieEgxRHNtazBhaGlnbTZrMlh2U210bHFqSWpMbHVMM1dReDhmZDRqaCI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozOToiaHR0cHM6Ly9uZXJkc3BhY2UuY3liZXJsYWQuY29tL3RvcGljLzI4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1755073697),
('cW1Z0OkJAON7md7LHJDULLe4GGzc48fKYhp9eIxp',1,'146.70.237.136','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiUGtIa1RuNmlKMjJxdU4yWHlaMkhrdnQ5aHBBUDRNRGVNNE1JN2N2ZiI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozOToiaHR0cHM6Ly9uZXJkc3BhY2UuY3liZXJsYWQuY29tL3RvcGljLzI4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1755168064),
('DjmyI0q4R8Dg7hVPUSge41CVnwuGLLMtzo5YHvSk',1,'146.70.237.148','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoidGlaNGpwemVkZG02NzFVN2ZXOVFkdU1oUElZTVRiY0c0ZlJkYm0zSCI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo0MDoiaHR0cHM6Ly9uZXJkc3BhY2UuY3liZXJsYWQuY29tL3RvcGljLzEzNCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1754674945),
('gAUfwN0JsBdDXUV2FjtQiQD9fMEx6iBAVUMGu8Cp',NULL,'185.177.72.108','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRmJjQlFoOUdEVDJlTzJJRUJxV0xoREpnaGNYQzBKM1VmZlNBZGQ3NSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0NzoiaHR0cHM6Ly9uZXJkc3BhY2UuY3liZXJsYWQuY29tL3B1YmxpYy9pbmRleC5waHAiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo0NzoiaHR0cHM6Ly9uZXJkc3BhY2UuY3liZXJsYWQuY29tL3B1YmxpYy9pbmRleC5waHAiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1754928475),
('gUHELFoSw1OKnM4Q2TDmaMot608yyNcLCaYIAPhF',1,'31.13.191.94','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSmR5WGhKWVFtaW1jSWFpU3A5ZDJsYmY3MzJlQnBmbWdsNHdNQWZxcSI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozNzoiaHR0cHM6Ly9uZXJkc3BhY2UuY3liZXJsYWQuY29tL3B1YmxpYyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1754845301),
('jMmZuJi5OUg1S6HBNPXDkzOrHQoIqWXxDyyHZs2I',1,'169.150.208.209','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiazYyU2tpcTV0SG5RbnN3dEI2eHdQQk1kSXNySEg2WlhqZmo1cVVkSCI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozOToiaHR0cHM6Ly9uZXJkc3BhY2UuY3liZXJsYWQuY29tL3RvcGljLzI4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1755249711),
('mnQ3dz6blXPtM8HoN3WIs0HOmFyevlZdLAlewLOe',1,'169.150.208.235','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiNUpIa2l3T3NmM01lYXN1ZXV4cTZvQklDMHB5cHRhSUtUQWtRZEV6MSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjM5OiJodHRwczovL25lcmRzcGFjZS5jeWJlcmxhZC5jb20vdG9waWMvMjgiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=',1754732711),
('tEQQXoQV84DdOJJD5wCf9AjMxY8toCl6vLkj7NSE',1,'169.150.208.208','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiYWw5RzJRM1lyTERiZDhsb0FCQTI4VFczR3F0TzJ2VWdtOE5GbFM2QiI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozNzoiaHR0cHM6Ly9uZXJkc3BhY2UuY3liZXJsYWQuY29tL3B1YmxpYyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1754918007),
('vyZ0o9EExay1SXVLsG6dzSBzSZFhPbWQ7lfVWusL',1,'146.70.237.148','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRnRGdXFkRDU2QkE1bzdEQVVpNHlXS0g1UzFTYklVaWF6MGg5Znk1NCI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozNzoiaHR0cHM6Ly9uZXJkc3BhY2UuY3liZXJsYWQuY29tL3B1YmxpYyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1754667539),
('yH3tM79D6w06UvuOfjv8I4pDQvKqWvtoZgkDi6yy',NULL,'185.177.72.108','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiZ1hIRnNSd0FTNTRtZ1J1ODFGSVQzZHRoWENNTThDa2VNeUllTlVHdiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTk6Imh0dHBzOi8vbmVyZHNwYWNlLmN5YmVybGFkLmNvbS9wdWJsaWMvaW5kZXgucGhwL2FkbWluL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1754928475),
('ZAoIYi5V4gAjHy5kn9HEJkssNucqFrRPqACSFY3W',1,'149.50.209.136','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMHJ2VnBseWIzeU51eDJoNjU2TFVIU1g1Wmo3cE9hbEVObGkwNUZxbSI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozNzoiaHR0cHM6Ly9uZXJkc3BhY2UuY3liZXJsYWQuY29tL3B1YmxpYyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1755241702);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tags`
--

/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
INSERT INTO `tags` VALUES
(8,'KCDII','2025-04-22 23:34:35','2025-04-22 23:34:35'),
(9,'Kingcome Come: Delivance II','2025-04-22 23:34:52','2025-04-22 23:34:52'),
(10,'Henry','2025-04-22 23:34:57','2025-04-22 23:34:57'),
(11,'Da Vinci','2025-04-22 23:56:08','2025-04-22 23:56:08'),
(12,'Sketches','2025-04-22 23:56:42','2025-04-22 23:56:42'),
(13,'Eldhjerta','2025-04-22 23:57:05','2025-04-22 23:57:05'),
(15,'Ghost','2025-04-25 19:08:39','2025-04-25 19:08:39'),
(16,'Tobias Forge','2025-04-26 20:37:14','2025-04-26 20:37:14'),
(17,'David Fravor','2025-04-27 19:38:04','2025-04-27 19:38:04'),
(18,'alex Dietrich','2025-04-27 19:38:14','2025-04-27 19:38:14'),
(19,'Ryan Graves','2025-04-27 20:20:55','2025-04-27 20:20:55'),
(20,'Aliens','2025-05-01 15:35:53','2025-05-01 15:35:53'),
(21,'UFO','2025-05-01 15:36:10','2025-05-01 15:36:10'),
(22,'UAP','2025-05-01 15:36:18','2025-05-01 15:36:18'),
(23,'Earth','2025-05-01 15:47:50','2025-05-01 15:47:50'),
(24,'Mars','2025-05-01 15:47:56','2025-05-01 15:47:56'),
(25,'sun','2025-05-01 15:48:00','2025-05-01 15:48:00'),
(26,'jupiter','2025-05-01 15:48:06','2025-05-01 15:48:06'),
(27,'pluto','2025-05-01 15:48:09','2025-05-01 15:48:09'),
(28,'moon','2025-05-01 15:48:13','2025-05-01 15:48:13'),
(29,'Kristoffer','2025-05-01 19:35:19','2025-05-01 19:35:19'),
(30,'Rebecka','2025-05-01 19:35:25','2025-05-01 19:35:25'),
(31,'ambience','2025-05-01 21:30:15','2025-05-01 21:30:15'),
(32,'asmr','2025-05-01 21:30:20','2025-05-01 21:30:20'),
(33,'Lilium','2025-05-01 21:53:21','2025-05-01 21:53:21'),
(34,'Jonas','2025-05-01 21:53:25','2025-05-01 21:53:25');
/*!40000 ALTER TABLE `tags` ENABLE KEYS */;

--
-- Table structure for table `topics`
--

DROP TABLE IF EXISTS `topics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `topics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) NOT NULL,
  `text` longtext NOT NULL,
  `pinned` int(10) NOT NULL,
  `thumb` varchar(255) DEFAULT NULL,
  `parent_id` int(11) NOT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `visited_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=154 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `topics`
--

/*!40000 ALTER TABLE `topics` DISABLE KEYS */;
INSERT INTO `topics` VALUES
(21,'Kingdom Come: Deliverance II','Are you yanking my pizzle?!','<p><img src=\"https://nerdspace.cyberlad.com/public/media/images/SpIkqyPsfp.webp\"></p><p><br></p><p>Released by Warhorse Studios in 2025.</p><p>Uses the CryEngine</p><p>Something</p><p><br></p>',0,'68093d0e5028b.webp',0,0,'2025-07-19 21:54:21','2025-04-22 00:38:46','2025-07-19 21:54:21'),
(22,'Henry of Skalitz',' Bohemian; Born c. 1383 (1403) roughly 20','<p>Note text</p>',0,'680940bd8fde0.webp',21,1,'0000-00-00 00:00:00','2025-04-22 00:39:29','2025-04-26 20:36:09'),
(23,'Hans Capon of Pirkstein',' Bohemian; Born c. 1383 (1403) roughly 20','<p>Note text here</p>',0,'6809493bc4d10.webp',21,2,'0000-00-00 00:00:00','2025-04-22 00:39:52','2025-04-26 20:36:09'),
(24,'Markvart von Aulitz','German; Born 1370 (1403) is 33','<p>Note text here</p>',0,'',21,3,'0000-00-00 00:00:00','2025-04-22 00:40:49','2025-04-23 02:11:44'),
(25,'Katherine','Bohemian;','<p>Note text here</p>',0,'',21,4,'0000-00-00 00:00:00','2025-04-22 00:41:43','2025-04-23 20:17:48'),
(27,'Jan Zizka',' Bohemian; Knight; Lower nobility; Born c. 1360 (1403) roughly 43','<p>Note text here</p>',0,'680949f95ebae.webp',21,5,'0000-00-00 00:00:00','2025-04-22 00:42:32','2025-04-23 20:13:45'),
(28,'R-rated.','Subtitle','<p>https://www.xnxx.com/video-15pnad99/mypervmommy.com_-_a_milf_makes_up_for_her_stepson_after_selling_his_console.she_blowjobs_his_big_cock.the_guy_fingers_his_stepmom_before_fucking_her_hairy_pussy.</p><p><br></p><p>https://www.pornhub.com/view_video.php?viewkey=68611487e4696</p><p><br></p><p>https://www.xnxx.com/video-18ws7v2f/guy_joins_the_swingers_party.the_big_tits_wife_blowjobs_her_husbands_friend.the_dude_licks_her_shaved_pussy_pinches_her_clit_while_fucking_her.</p><p><br></p><p>https://www.pornhub.com/view_video.php?viewkey=68535112ca299</p><p><br></p><p>https://www.pornhub.com/view_video.php?viewkey=688048d01cc35</p><p><br></p><p>https://www.pornhub.com/view_video.php?viewkey=6879c95a255c3</p><p><br></p><p>https://www.pornhub.com/view_video.php?viewkey=685d3891a0963</p><p><br></p><p>https://www.pornhub.com/view_video.php?viewkey=686a49d93e6fb</p><p><br></p><p><a href=\"https://www.pornhub.com/view_video.php?viewkey=ph5ebc07e4c8e36\" rel=\"noopener noreferrer\" target=\"_blank\">https://www.pornhub.com/view_video.php?viewkey=ph5ebc07e4c8e36</a></p><p><br></p><p>https://www.xnxx.com/video-lc1sbc7/curious_teenie_going_black_via_gloryhole</p><p><br></p><p>https://anysex.com/video/448320/robber-roughly-fucked-teen-blonde-in-her-house/</p><p><br></p><p>https://www.pornhub.com/view_video.php?viewkey=65dee7ae52b72</p><p><br></p><p>https://www.pornhub.com/model/marcy-abadir</p><p><br></p><p>https://www.xvideos.com/video.bakabvcd2d/mofos_-_young_couple_fuck_in_cafe_in_public</p><p><br></p><p>https://pornzog.com/video/22598046/serena-hill-cooking-class-tits-and-ass/</p><p><br></p><p><a href=\"https://www.pornoxo.com/videos/2690511/willow-ryder-and-crystal-clark/?mid=2392585&amp;hash=5592&amp;f=3gp&amp;tn=6&amp;ct=0--1737036034\" rel=\"noopener noreferrer\" target=\"_blank\">https://www.pornoxo.com/videos/2690511/willow-ryder-and-crystal-clark/?mid=2392585&amp;hash=5592&amp;f=3gp&amp;tn=6&amp;ct=0--1737036034</a></p><p><br></p><p><a href=\"https://www.tnaflix.com/big-cock/SEXYSMALL-Petite-Laundromat-Slut-Cali-Hayes-video-1/video2724607\" rel=\"noopener noreferrer\" target=\"_blank\">https://www.tnaflix.com/big-cock/SEXYSMALL-Petite-Laundromat-Slut-Cali-Hayes-video-1/video2724607</a></p><p><br></p><p><a href=\"https://www.reddit.com/user/Plucky_Peach/submitted/?sort=top\" rel=\"noopener noreferrer\" target=\"_blank\">https://www.reddit.com/user/Plucky_Peach/submitted/?sort=to</a></p><p><br></p><p><a href=\"https://www.reddit.com/user/impossiblepig666/\" rel=\"noopener noreferrer\" target=\"_blank\">https://www.reddit.com/user/impossiblepig666/</a></p><p><br></p><p><a href=\"https://www.reddit.com/user/honeytxxx_/submitted/\" rel=\"noopener noreferrer\" target=\"_blank\">https://www.reddit.com/user/honeytxxx_/submitted/</a></p><p><br></p><p><a href=\"https://www.reddit.com/user/LoveNaike99/submitted/?sort=top\" rel=\"noopener noreferrer\" target=\"_blank\">https://www.reddit.com/user/LoveNaike99/submitted/?sort=top</a></p><p><br></p><p><a href=\"https://www.pornhub.com/view_video.php?viewkey=ph5f1dda13c7837\" rel=\"noopener noreferrer\" target=\"_blank\">https://www.pornhub.com/view_video.php?viewkey=ph5f1dda13c7837</a></p><p><br></p><p>https://www.xvideos.com/video.uloicoo1823/miiiawallace</p><p><br></p><p>https://www.xvideos.com/video.ohumtpmd56d/41098549/0/innocent_girl_becomes_sex_ed_prop_-_teamskeet_singles</p><p><br></p><p>https://www.pornhub.com/view_video.php?viewkey=680a28e061078</p><p><br></p><p>https://www.xnxx.com/video-6kuwjc2/young_euro_nurse_fucks_mature_couple</p><p><br></p><p>https://www.pornhub.com/view_video.php?viewkey=1559319004</p><p><br></p><p>https://www.pornhub.com/view_video.php?viewkey=67d7e5ac27ec1</p><p><br></p><p>https://www.eporner.com/video-BtBatnEUUL9/harriet-sugarcookie-distracts-zoe-doll-while-she-plays-video-games/</p><p><br></p><p>https://www.xnxx.com/video-1dj69za4/sleazy_teen_cowgirls_her_big_stepbrother_after_getting_in_home_from_school</p><p><br></p><p>https://www.pornhub.com/view_video.php?viewkey=659cba05c15aa</p><p><br></p><p>https://www.xvideos.com/video.kdkahlf1f0e/riding_the_boyfriend_in_the_car</p><p><br></p><p>https://www.pornhub.com/view_video.php?viewkey=ph61ea33e3c8a2b</p><p><br></p><p>https://www.pornhub.com/view_video.php?viewkey=ph637ab13a787e9</p><p><br></p><p>https://www.xnxx.com/video-1c4lezaa/teen_pays_the_lp_officer_by_means_of_a_blowjob_and_so_much_more_-_myshopfuck</p><p><br></p><p>https://www.xnxx.com/video-1d1nl789/teen_accepts_the_condition_of_the_guard_for_freedom_-_myshopfuck</p><p><br></p><p>https://www.xnxx.com/video-s6kjn2b/teen_fucks_in_the_street</p><p><br></p><p>https://www.pornhub.com/view_video.php?viewkey=671bb9f011541</p><p><br></p><p>https://www.pornhub.com/view_video.php?viewkey=66a339bcbf04e</p><p><br></p><p>https://www.pornhub.com/view_video.php?viewkey=659fbfeaae31a</p><p><br></p><p>https://www.pornhub.com/view_video.php?viewkey=ph6201d18e27da1</p><p><br></p><p>https://www.fapnado.com/videos/26528/today-i-want-to-get-fucked-by-a-homeless-gia-derza/</p><p><br></p><p>https://www.xvideos.com/video.hcavbmk8d80/public_agent_alessa_savage_gets_creampied_outdoors</p><p><br></p><p>https://www.xvideos.com/video.udfbiem1bdf/nice_anal_creampie_for_dominica_phoenix</p><p><br></p><p>https://www.youjizz.com/videos/blonde-flight-attendant-and-asian-guy-2154753.html</p><p><br></p><p>https://www.xnxx.com/video-fz4nvb3/gym_loving_blonde_megan_fenox_picked_up_her_personal_trainer_and_brought_him_home_for_the_day</p><p><br></p><p>https://tubesafari.com/video?id=ph5f6bbc5e5aebb</p><p><br></p><p>https://www.xvideos.com/video.kimbimh8a4c/pay_debts</p><p><br></p><p>https://www.xvideos.com/video.ubadevk9ed7/tight_and_wet_pussy_gets_creampied_with_her_panties_she_loves_to_feel_the_hot_cum_on_her_lips._real_home_video_hd_</p><p><br></p><p>https://www.pornhub.com/view_video.php?viewkey=65c923041161e</p><p><br></p><p>https://www.xvideos.com/video.bofftk365d/german_girl_fucks_in_a_restroom</p><p><br></p>',1,'',0,0,'2025-08-15 09:21:51','2025-04-22 00:43:56','2025-08-15 09:21:51'),
(42,'The World of Leonardo Da Vinci','1452-1519 - 67; ','<p><br></p>',0,'68094244a19da.webp',0,0,'2025-07-30 19:30:46','2025-04-22 02:43:30','2025-07-30 19:30:46'),
(43,'Erik','Moravian;','<p>Possibly lover to Istvan Toth.</p>',0,'',21,6,'0000-00-00 00:00:00','2025-04-22 02:45:21','2025-04-23 20:18:08'),
(44,'Facts About Legendary Rockers','Blast that guitar!','<h2><strong>Brian May</strong></h2><p>Queen</p><p>Build his own guitar with his father</p><p>Has a PhD in astrophysics</p><p><br></p><h2><strong>John Deacon</strong></h2><p>Original songs: Another Bites the Dust,</p><p><br></p><p><strong>The Deacy Amp; </strong>dsa</p><p><br></p><h2><strong>Bruce Dickinson</strong></h2><p>Is a licensed airplane pilot and has piloted Ed-Force-One, which is Iron Maiden\'s own band plane.</p><p><br></p><p>2006; Bruce flies down to Lebanon to get about 200 UK citizens back home due to the Israel/Hezbollah conflict;</p><p><br></p><p>After XL Airlines went bankrupt, left some tens of thousands of passengers to be stranded across Europe and the Middle East. He was a pilot of the charter airline company Astraeus at the time;</p><p><br></p><p>After Maiden\'s <strong>Somewhere in Time </strong>tour, Dickinson jumps on aviation duty to save stranded passengers after XL Airplanes goes bankrupt, and leaves thousands of passengers stranded across Europe and Middle East.</p><ol><li data-list=\"bullet\"><span class=\"ql-ui\" contenteditable=\"false\"></span><strong>Egypt </strong>(Sharm El Sheikh -&gt; Manchester) with roughly 221 passengers onboard.</li><li data-list=\"bullet\"><span class=\"ql-ui\" contenteditable=\"false\"></span><strong>Greece </strong>(Kos -&gt; London Gatwick) with roughly 200 passengers onboard.</li></ol><p>He gets about 5 hours of sleep between these two flights.</p><p><strong>These flights did NOT use Iron Maiden Ed-Force-One.</strong></p><p><br></p><p>Is a professional fencer.</p>',0,'6813cc0486acf.webp',0,0,'2025-07-24 23:42:43','2025-04-23 01:44:31','2025-07-24 23:42:43'),
(50,'Dry Devil','Sir Hynek of Kunstadt and Jaispitz','<p>Note text here</p>',0,'',21,7,'0000-00-00 00:00:00','2025-04-23 02:06:28','2025-04-23 02:06:42'),
(51,'Rosa Ruthard','Bohemian; Noblewoman; Age unknown.','<p>Note text here</p>',0,'',21,8,'0000-00-00 00:00:00','2025-04-23 02:07:06','2025-04-23 02:18:36'),
(52,'Istvan Toth','Hungarian; Nobleman; Age unknown.','<p>Note text here</p>',0,'',21,9,'0000-00-00 00:00:00','2025-04-23 02:11:07','2025-04-23 02:17:00'),
(53,'Radzig Kobyla','Bohemian; Nobleman; Henry\'s father; Age unknown','<p>Note text here</p>',0,'',21,10,'0000-00-00 00:00:00','2025-04-23 02:14:30','2025-04-23 02:14:59'),
(61,'Godwin','Bohemian; Noble; Parish priest; Age unknown','<p>Note text here</p>',0,'68094a89f4032.webp',21,11,'0000-00-00 00:00:00','2025-04-23 20:14:06','2025-04-23 20:17:28'),
(64,'Ghost Discography','You have sinned, and not even a riff can save you now.','<p>Started with a just 4 demos uploaded to MySpace. Really became an over-night sensation. Even Papa James Hetfield stood with the Opus Eponymous t-shirt on him, live on Swedish television, even further skyrocketing Ghost into the stratosphere.</p><p><br></p><p>From Infestissumam and forward, all artwork for Ghost has been created by Zbigniew Bielak from Poland.</p><p><br></p><div class=\"quill-iframe\"><iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/UCt-p81kBDI?si=C5Smnzr3677PfhMm\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen=\"\"></iframe></div><p><br></p>',0,'680969c649aed.webp',0,0,'2025-07-24 20:04:39','2025-04-23 22:23:28','2025-07-24 20:04:39'),
(65,'Opus Eponymous','October 18th, 2010; Full-length; Rise Above records; Self-produced;','<p>Contained a cover of Here Comes the Sun (org. auth. George Harrison)</p><p>Features Ludvig Kennberg on drums (also drumming on Meliora)</p><p>Runtime at 34:41</p><p>Artwork by Basilevs 254</p><p><br></p><p><a href=\"https://www.youtube.com/watch?v=ddbR69BPqHM\" rel=\"noopener noreferrer\" target=\"_blank\">The demo\'s uploaded to MySpace -&gt;</a></p><p><br></p><p><a href=\"https://www.youtube.com/watch?v=8pIM-aV4kWQ\" rel=\"noopener noreferrer\" target=\"_blank\">Live performance from the very early days -&gt; </a></p><p><br></p><p><br></p>',0,'68096cbeecfe6.webp',64,1,'0000-00-00 00:00:00','2025-04-23 22:35:47','2025-04-26 20:39:28'),
(67,'Infestissumam','April 10th, 2013; Full-length; Loma Vista; Prod. Nick Raskulinecz;','<p><strong>Recording took place in various places</strong></p><ol><li data-list=\"bullet\"><span class=\"ql-ui\" contenteditable=\"false\"></span>Blackbird Studios, Nashville, Tennessee</li><li data-list=\"bullet\"><span class=\"ql-ui\" contenteditable=\"false\"></span>The Bridge Recording Studios, Glendale, California</li><li data-list=\"bullet\"><span class=\"ql-ui\" contenteditable=\"false\"></span>Mayfire Studio, Linköping, Sweden</li><li data-list=\"bullet\"><span class=\"ql-ui\" contenteditable=\"false\"></span>Hufvudstaden, Söderköping, Sweden</li></ol><p><br></p><p><strong>Singles</strong></p><p>Secular Haze - Dec. 15, 2012.</p><p>Year Zero - April 19, 2013.</p><p><br></p><p>Playtime original: <strong>47:43</strong></p><p>Playtime Deluxe: <strong>62:31</strong></p><p>Playtime Redux: <strong>77:47</strong></p><p><br></p><p>Has several versions: Deluxe Edition; Japanese Edition; Redux.</p><p><br></p><p>Mixing was done by Nick Raskulinecz.</p><p><br></p><p>Redux version of the album contains bonus tracks:</p><p><strong>La Mantra Mori</strong> - Forge.</p><p><strong>I\'m A Marionette</strong> - Ulveus and Andersson of ABBA.</p><p><strong>Waiting for the Night</strong> - Martin L. Gore of Depeche Mode.</p><p><strong>Crucified</strong> - Alexander Bard, Anders Wollbeck, Jean-Pierre Barda of Army of Lovers.</p><p><strong>If You Have Ghosts</strong> - Roky Erickson cover.</p><p><br></p><h2><strong>Random facts</strong></h2><p><br></p><p>Contains multiple songs co-written by Martin Persner: Year Zero, Body and Blood, Monstrance Clock.</p><p><br></p><p>Dave Grohl was did <strong>drums, percussions and production</strong> on the covers <strong>I\'m a Marionette</strong> and <strong>Waiting for the Night</strong></p><p><br></p><p>Topped Swedish charts on release (Sverigetopplistan).</p><p><br></p><p>According to Simon Söderberg, this album was actually recorded in it\'s entirety in a basement in Linköping before the label interfered, and said that the album needed to be more \"granios\".</p><p><br></p><p>According to Simon Söderberg from prodpodden, the mixing for this album was done on distance, and Simon had to oversee the production process.</p><p><br></p><p><a href=\"https://web.archive.org/web/20130525185739/http://social.entertainment.msn.com/music/blogs/blog--an-interview-with-ghost-bc\" rel=\"noopener noreferrer\" target=\"_blank\">Some interesting points from an interview:</a></p><p><br></p><p><strong>Why did you decide to to team up with a producer as well known as Nick Raskulinecz?</strong></p><p><br></p><p>The most obvious reason was that we’d come to the point where we were able to work with a producer in terms of funding. Also, every record label feels better about lavishing a record if there’s someone in charge. Obviously we wanted to take the chance to work with a producer, but we don’t want to work with any producer, because there are a lot of producers out there that have a very stigmatizing effect on bands. They make any band that they work with sound like they just worked with that producer. Nick was someone we knew from before, not personally, but we knew about his work. We also knew he had the ability to make Rush sound like Rush and Alice in Chains sound like Alice in Chains. He’s good at working with a band without transforming the band into something else, rather than make them just flower as the band they are. Upon talking to him about the record and showing him all the demoed material, we sort of took his temperature by seeing how much he wanted to change. It turned out he didn’t want to change much at all, and that’s why he got the job. He’s very talented and is a nice guy; we got on very well.</p><p><br></p><p><br></p><p><strong>Did you have any differences of opinion with any guest musicians or studio people with regards to your Satanic subject matter?</strong></p><p><br></p><p>Initially we meant to have the choir parts recorded in Nashville as well, which didn’t work out. There wasn’t one professional coir that would accept doing what we do. They didn’t want to lend their voices to that. Then we tried another idea, that was to get a few choir-interested people into the studio, three at a time maybe. Sort of make a choir that way. Upon hearing what they were supposed to do on the phone, they were turning it down. Finally we had three guys come into the studio that were willing. Somehow the communication had been broken down because they were, “Okay, what are we doing?” “Oh, you don’t know? Okay, it’s a theatrical performance, sort of like The Omen.” Then we told them what they were supposed to sing, and one of the guys almost cried, he took offense; it was really weird. But it comes from the fact that we’re a rock band, and when you’re a rock band there’s no difference between what you say, what you do, and what you are. Whereas nobody would go into the studio in 1976 and ask Jerry Goldsmith if he believed in Satan or not. But that’s how it is. So we ended up recording the choir in Hollywood, where people have no problem with worshipping the Devil. [<em>laughs</em>]</p><p><br></p><p><br></p><p><br></p>',0,'68096e77f1e42.webp',64,2,'0000-00-00 00:00:00','2025-04-23 22:47:24','2025-04-26 21:10:28'),
(68,'Untitled Note','Subtitle','Note text here',0,NULL,28,0,'0000-00-00 00:00:00','2025-04-23 22:58:34','2025-04-23 22:58:34'),
(69,'Untitled Note','Subtitle','Note text here',0,NULL,68,0,'0000-00-00 00:00:00','2025-04-23 22:58:34','2025-04-23 22:58:34'),
(81,'Meliora','August 21st, 2015; Full-length; Loma Vista; Prod. Klas Åhlund','<p>Writer(s): Tobias Forge (a nameless ghoul), Martin Persner (Marcato Indio), Klas Åhlund.</p>',0,'680be855ef73c.webp',64,4,'0000-00-00 00:00:00','2025-04-25 19:44:24','2025-04-28 14:30:07'),
(82,'Popestar','September 16th 2016; EP; Loma Vista; Prod. Tom Dalgety','<p>Note text here</p>',0,'680be9442ed8d.webp',64,5,'0000-00-00 00:00:00','2025-04-25 19:54:33','2025-04-26 21:10:15'),
(83,'Elizabeth','18 October, 2010; Single; Iron Pegasus Records; Self-produced.','<p>Note text here</p>',0,'680be9d00c45c.webp',65,1,'0000-00-00 00:00:00','2025-04-25 19:58:07','2025-04-26 20:36:31'),
(84,'Here Comes the Sun','April 6th, 2011; Cover; Opus Eponymous Japanese Edition; Trooper Entertainment','<p>Cover of The Beatle\'s <strong>Here Comes the Sun </strong>written by George Harrison.</p>',0,'680d37c0dccd4.webp',65,2,'0000-00-00 00:00:00','2025-04-25 20:01:08','2025-04-26 20:36:31'),
(85,'Secular Haze','December 15, 2012; Leading single; Loma Vista; Prod. Nick Raskulinecz; Music video;','<p>Note text here</p>',0,'680bf3c872094.webp',67,1,'0000-00-00 00:00:00','2025-04-25 20:41:37','2025-04-28 15:00:29'),
(86,'I\'m a Marionette','December 15th, 2012; Cover; Loma Vista; Prod. Dave Grohl','<p>On the B-side of Infestissumam\'s leading stand-alone single. Was produced by Dave Grohl, who also played drums on the track.</p>',0,'680fa7e9efc07.webp',85,0,'0000-00-00 00:00:00','2025-04-26 17:11:00','2025-04-28 16:08:09'),
(87,'Year Zero','April 19th, 2013; Single ; Loma Vista; Prod. Nick Raskulinecz; Music video;','<p><strong>Writer(s):</strong> Tobias Forge (A Ghoul Writer), Martin Persner (Marcato Indio)</p><p><br></p><p>One of only 2 songs in Ghost\'s biography that was originated from someone other than Tobias Forge himself; While Tobias wrote the lyrics and arranged the song as a whole, Martin Persner is credited as co-writer, and is apparently the one who came up with the idea.</p>',0,'680d18c324497.webp',67,2,'0000-00-00 00:00:00','2025-04-26 17:19:42','2025-04-28 15:00:05'),
(88,'Orez Raey','Literally just Year Zero but played backwards.','<p>Note text here</p>',0,'680d372c82867.webp',87,0,'0000-00-00 00:00:00','2025-04-26 17:46:48','2025-04-26 19:42:36'),
(89,'Cirice','May 30, 2015; Lead single; Loma Vista; Prod. Klas Åhlund; Music video;','<p>Writer(s): Tobias Forge, Klas Åhlund.</p>',0,'680d2be87d331.webp',81,1,'0000-00-00 00:00:00','2025-04-26 17:49:46','2025-04-28 14:57:15'),
(90,'Prequelle (sucks asshole)','June 1st, 2018; Full-length; Loma Vista; Prod. Tom Dalgety','<p>Note text here</p>',0,'680d328f81393.webp',64,6,'0000-00-00 00:00:00','2025-04-26 19:21:39','2025-04-26 21:10:14'),
(91,'Seven Inches of Satan Panic','September 13th, 2019; EP; Loma Vista; Self-Produced','<p>Note text here</p>',0,'680d3356d8a76.webp',64,7,'0000-00-00 00:00:00','2025-04-26 19:24:36','2025-04-26 21:10:13'),
(92,'Impera','March 11th, 2022; Full-length; Loma Vista; Prod. Klas Åhlund','<p>Note text here</p>',0,'680d340157e49.webp',64,8,'0000-00-00 00:00:00','2025-04-26 19:27:54','2025-04-26 21:10:10'),
(102,'If You Have Ghost','20 November, 2013; EP; Republic & Loma Vista; Prod. Dave Grohl','<ol><li data-list=\"ordered\"><span class=\"ql-ui\" contenteditable=\"false\"></span>If You Have Ghost - Cover of Roky Erickson.</li><li data-list=\"ordered\"><span class=\"ql-ui\" contenteditable=\"false\"></span>I\'m a Marionette - Cover of ABBA</li><li data-list=\"ordered\"><span class=\"ql-ui\" contenteditable=\"false\"></span>Crucified - Cover of Army of Lovers</li><li data-list=\"ordered\"><span class=\"ql-ui\" contenteditable=\"false\"></span>Waiting for the Night - Cover of Depeche Mode</li><li data-list=\"ordered\"><span class=\"ql-ui\" contenteditable=\"false\"></span>Secular Haze - Live performance, Music Hall of Williamsburg.</li></ol><p><br></p><p>Total length <strong>24:43</strong></p><p><br></p><p>Dave Grohl produced the album, played drums track 1, 2 and 4.</p>',0,'680d4c08302b0.webp',64,3,'0000-00-00 00:00:00','2025-04-26 21:09:36','2025-04-28 14:27:31'),
(103,'UFO','Subtitle','<p>Test</p>',0,'680e7ef691ee2.webp',0,0,'2025-07-24 23:42:26','2025-04-27 16:41:36','2025-07-24 23:42:26'),
(104,'Carrier Strike Group 11','USS Princeton; USS Nimitz; Does NOT have footage;','<p>The incident of USS Nimitz happened in 2004 and was the result of USS Princeton picking up unidentified flying objects on their highly advanced radar - AN/SPY-1B.</p><p><br></p><p>Commander Fravor describes the UFO as a \"tic-tac\" which is how the object, and also further objects within the UFO community got it\'s name.</p><p><br></p><p>Neither Fravor nor Dietrich had a gag order put on them, or anyone say that they couldn\'t talk about what they\'d witnessed. It is probable that they both would\'ve come out earlier to talk about it publicly had they been asked sooner.</p><p><br></p><p>No wings; No exhaust;</p><p><br></p><p>\"Moving very abruptly over the water, like a pingpong-ball. There were not rotors, no rotor wash, or any sign of visible control surfaces like wings.\"</p><p><br></p><p>It wasn\'t until 2009 when J. Stratton contacted Fravor, to investigate, who was part of the ATIP program in the Pentagon, led by Luis Elizondo. Dietrich later contacted Fravor to ask if he had been approached. Fravor said he had not — but was willing to talk. Luis Elizondo and Fravor spoke for a short period of time (~3:29 timestamp reference), agreeing to remain in contact.</p><p><br></p><p>A few weeks after that, Fravor learned that Luis had left Pentagon in protest, and joined forces with Tom DeLonge, Chris Mellon, Steve Justice and other to form To The Stars Inc.</p><p><br></p><p>\"The tic-tak object we engaged in 2004 was far superior to anything we had on time, have today, or are looking to develop in the next 10 years.\"</p><p><br></p><p>The New York Times published a major article in December 2017 titled \'Glowing Auras and \'Black Money\': The Pentagon’s Mysterious U.F.O. Program,\' which brought the 2004 encounter to public attention.</p><p><br></p><ol><li data-list=\"bullet\"><span class=\"ql-ui\" contenteditable=\"false\"></span>ATIP (Advanced Aerospace Threat Identification Program)  was an unclassified but unpublicized investigatory effort funded by the United States Government to study unidentified flying objects (UFOs) or unexplained aerial phenomena (UAP).</li><li data-list=\"bullet\"><span class=\"ql-ui\" contenteditable=\"false\"></span><a href=\"https://archive.li/h0JHe\" rel=\"noopener noreferrer\" target=\"_blank\">NYT Article</a></li><li data-list=\"bullet\"><span class=\"ql-ui\" contenteditable=\"false\"></span><a href=\"https://www.secnav.navy.mil/donhr/About/Senior-Executives/Biographies/Stratton,%20J.pdf\" rel=\"noopener noreferrer\" target=\"_blank\">John F Stratton</a></li><li data-list=\"bullet\"><span class=\"ql-ui\" contenteditable=\"false\"></span><a href=\"https://en.wikipedia.org/wiki/Advanced_Aerospace_Threat_Identification_Program\" rel=\"noopener noreferrer\" target=\"_blank\">ATIP</a></li></ol><p><br></p><p><br></p><p><br></p>',0,'680e7923db858.webp',103,1,'0000-00-00 00:00:00','2025-04-27 16:49:31','2025-04-27 20:12:01'),
(105,'USS Princeton','Was the ship that picked up the UFO','<p>Note text here</p>',0,'680e78e3df6ba.webp',104,1,'0000-00-00 00:00:00','2025-04-27 18:04:18','2025-04-27 18:38:08'),
(106,'USS Nimitz','2 F/A-18F Super Hornets were sent to investigate the UFOs','<p>Note text here</p>',0,'680e798a63e00.webp',104,2,'0000-00-00 00:00:00','2025-04-27 18:36:33','2025-04-27 18:41:29'),
(107,'Cmdr. David Fravor','Retired in 2006; Career lasted 24 years; 18 of which as a Navy pilot;','<p>Note text here</p>',0,'680e7d199ba67.webp',106,1,'0000-00-00 00:00:00','2025-04-27 18:38:28','2025-04-27 19:06:23'),
(108,'Lt. Alex Dietrich','Retired; 20 Years of service in the US Navy;','<p>Note text here</p>',0,'680e7cda0760e.webp',106,2,'2025-07-23 12:41:38','2025-04-27 18:51:33','2025-07-23 12:41:38'),
(109,'AN/SPY-1B Radar System','Initially detected the UFOs','<p>Note text here</p>',0,'680e7e15f3dae.webp',105,1,'0000-00-00 00:00:00','2025-04-27 18:54:27','2025-04-27 18:57:26'),
(110,'Paintings','Subtitle','<p>Note text here</p>',0,NULL,42,1,'2025-07-30 19:44:39','2025-04-27 20:37:05','2025-07-30 19:44:39'),
(111,'Skeletá','April 25th, 2025. Full-length; Loma Vista; Prod. Self-produced','<p>Note text here</p>',0,'680f98e915f00.webp',64,10,'0000-00-00 00:00:00','2025-04-28 14:28:35','2025-04-28 15:04:45'),
(112,'From the Pinnacle to the Pit','July 17, 2015; Single; Loma Vista; Prod. Klas Åhlund; Music video;','<p>Written by: Tobias Forge, Klas Åhlund.</p>',0,'680f96c142cc8.webp',81,2,'0000-00-00 00:00:00','2025-04-28 14:53:41','2025-04-28 14:57:24'),
(113,'Phantomime','May 19th, 2019; EP (covers only); Loma Vista; Prod. Rich Costey;','<p>Note text here</p>',0,'680f998e905cc.webp',64,9,'0000-00-00 00:00:00','2025-04-28 15:04:42','2025-04-28 15:06:54'),
(114,'Square Hammer','Subtitle','<p>Note text here</p>',0,'680f9b017b642.webp',82,1,'0000-00-00 00:00:00','2025-04-28 15:10:26','2025-04-28 15:13:05'),
(115,'Majesty','August 15, 2015; Single; Loma Vista; Prod. Klas Åhlund;','<p>Note text here</p>',0,'680f9db0be3f8.webp',81,3,'0000-00-00 00:00:00','2025-04-28 15:23:43','2025-04-28 15:25:33'),
(116,'Rats','June 1st, 2018; Single; Loma Vista; Prod. Tom Dalgety','<p>Note text here</p>',0,'680f9fb02114f.webp',90,1,'0000-00-00 00:00:00','2025-04-28 15:29:56','2025-04-28 15:33:04'),
(117,'Dance Macabre','May 18th, 2018; Single; Loma Vista; Prod. Tom Dalgety;','<p>Note text here</p>',0,'680fa4fddf18a.webp',90,2,'0000-00-00 00:00:00','2025-04-28 15:35:08','2025-04-28 15:55:41'),
(118,'Faith','Subtitle','<p>Note text here</p>',0,'680fa6406f61e.webp',90,3,'0000-00-00 00:00:00','2025-04-28 15:36:15','2025-04-28 16:01:04'),
(119,'Hunter\'s Moon','September 30th, 2021; Single; Loma Vista; Prod. Klas Åhlund','<p>Note text here</p>',0,'680fa71e71d50.webp',92,1,'0000-00-00 00:00:00','2025-04-28 16:02:59','2025-04-28 16:04:46'),
(120,'Call Me Little Sunshine','January 20th, 2022; Single; Loma Vista; Prod. Klas Åhlund','<p>Note text here</p>',0,'680fa7e2cafc6.webp',92,2,'0000-00-00 00:00:00','2025-04-28 16:04:54','2025-04-28 16:08:02'),
(121,'Twenties','March 2th, 2022; Single; Loma Vista; Prod. Klas Åhlund','<p>Note text here</p>',0,'680fa813c1935.webp',92,3,'0000-00-00 00:00:00','2025-04-28 16:08:22','2025-04-28 16:10:59'),
(122,'Spillways','July 27th, 2022 (post-album); Single; Loma Vista; Prod. Klas Åhlund;','<p>Note text here</p>',0,'680fa85b166c3.webp',92,4,'0000-00-00 00:00:00','2025-04-28 16:09:09','2025-04-28 16:10:26'),
(124,'Planets','Subtitle','<p>Test</p>',1,'6813c88be0138.webp',0,0,'2025-07-23 12:41:07','2025-05-01 15:47:33','2025-07-23 12:41:07'),
(125,'Earth','Where you live.','<p>Note text here</p>',0,NULL,124,1,'0000-00-00 00:00:00','2025-05-01 19:06:55','2025-05-01 19:07:05'),
(126,'Pluto','Subtitle','<p>Note text here</p>',0,NULL,124,2,'0000-00-00 00:00:00','2025-05-01 19:07:17','2025-05-01 19:07:29'),
(127,'Jupiter','Subtitle','<p>Note text here</p>',0,NULL,124,3,'0000-00-00 00:00:00','2025-05-01 19:07:33','2025-05-01 19:07:40'),
(128,'Moon','Subtitle','<p>Note text here</p>',0,NULL,124,4,'0000-00-00 00:00:00','2025-05-01 19:07:45','2025-05-01 19:07:52'),
(129,'The Sun','Subtitle','<p>Note text here</p>',0,NULL,124,5,'0000-00-00 00:00:00','2025-05-01 19:07:57','2025-05-01 19:08:07'),
(130,'Mars','Subtitle','<p>Note text here</p>',0,NULL,124,6,'0000-00-00 00:00:00','2025-05-01 19:08:14','2025-05-01 19:08:18'),
(131,'Uranus','Subtitle','<p>Note text here</p>',0,NULL,124,7,'0000-00-00 00:00:00','2025-05-01 19:08:28','2025-05-01 19:08:35'),
(132,'Anatomy','Subtitle','<p>Note text here</p>',0,NULL,42,2,'0000-00-00 00:00:00','2025-05-01 19:10:20','2025-05-01 19:10:57'),
(133,'Kristoffer & Rebecka','Subtitle','<p>Test</p>',0,NULL,0,0,'2025-05-01 21:50:29','2025-05-01 19:34:50','2025-05-01 21:50:29'),
(134,'YouTube','Subtitle','<p><a href=\"https://www.youtube.com/watch?v=IOsvMFgvZZo\" rel=\"noopener noreferrer\" target=\"_blank\">Abandoned Mid-Century Hospital - Found Morgue and Bone Stretcher</a></p><p><br></p><p><a href=\"https://www.youtube.com/watch?v=taY66NjOAwo\" rel=\"noopener noreferrer\" target=\"_blank\">1950s. You sit by a rainy window, listening to jazz playing from another room. (Mafia 2 Ambience)</a></p><p><br></p><p><a href=\"https://www.youtube.com/watch?v=jB8pf4X-foA&amp;t=136s\" rel=\"noopener noreferrer\" target=\"_blank\">Funny Phone Calls and Other Moments - Art Bell</a></p><p><br></p><p><a href=\"https://www.youtube.com/watch?v=VHEPwcF0F7M&amp;t=2813s\" rel=\"noopener noreferrer\" target=\"_blank\">Art Bell again</a></p><p><br></p><p><a href=\"https://www.youtube.com/watch?v=UnaXM6ceHks\" rel=\"noopener noreferrer\" target=\"_blank\">ALONE: The Empty Outpost [Dark Ambient Focus Music</a></p><p><br></p><p><a href=\"https://www.youtube.com/watch?v=GGw3axV7IGs\" rel=\"noopener noreferrer\" target=\"_blank\">NEVER Leave | Dark Ambient Focus Music 4K [ALONE]</a></p><p><br></p><p><a href=\"https://www.youtube.com/watch?v=jrrr7w4wz18\" rel=\"noopener noreferrer\" target=\"_blank\">Age of Empires 2 - Soundtrack</a></p><p><br></p><p><a href=\"https://www.youtube.com/watch?v=0vsvWkzFZ-I\" rel=\"noopener noreferrer\" target=\"_blank\">The Proper People</a></p><p><br></p><p><br></p><p><br></p>',1,NULL,0,0,'2025-08-10 17:00:58','2025-05-01 21:27:41','2025-08-10 17:01:31'),
(135,'Ambience & ASMR','Subtitle','<p><a href=\"https://www.youtube.com/watch?v=2i84OuFJs78\" rel=\"noopener noreferrer\" target=\"_blank\">Calming snowy street</a></p><p><br></p><p><a href=\"https://www.youtube.com/watch?v=nGLq4EZSnec&amp;t=1324s\" rel=\"noopener noreferrer\" target=\"_blank\">Amnesia ambience</a></p><p><br></p><p><a href=\"https://www.youtube.com/watch?v=sAWbyulWbVo\" rel=\"noopener noreferrer\" target=\"_blank\">Tape Tech // System Failure Retro Sci-Fi Electronic Ambient Mix</a></p><p><br></p><p><br></p>',0,NULL,134,1,'2025-08-08 17:42:22','2025-05-01 21:29:38','2025-08-08 17:42:22'),
(136,'Watchlist','Subtitle','<p><a href=\"https://www.youtube.com/watch?v=gxSgGTVIFFc\" rel=\"noopener noreferrer\" target=\"_blank\">The JFK Files</a></p><p><br></p><p><br></p><p><br></p><p><br></p><p><br></p><p><br></p>',0,NULL,134,2,'0000-00-00 00:00:00','2025-05-01 21:30:50','2025-05-01 21:31:40'),
(137,'Kristoffer Strandberg','Subtitle','<p>Note text here</p>',0,NULL,133,1,'2025-05-01 21:46:51','2025-05-01 21:46:51','2025-05-01 21:49:19'),
(138,'Rebecka Nyström','Subtitle','<p>Note text here</p>',0,NULL,133,2,'2025-05-01 21:47:11','2025-05-01 21:47:11','2025-05-01 21:49:19'),
(139,'Josefin Nilsson','Subtitle','<p>Note text here</p>',0,NULL,133,3,'2025-05-01 21:47:23','2025-05-01 21:47:23','2025-05-01 21:47:38'),
(140,'Sara Strandberg','Subtitle','<p>Note text here</p>',0,NULL,133,4,'2025-05-01 21:47:49','2025-05-01 21:47:49','2025-05-01 21:48:00'),
(141,'Emma Strandberg','Subtitle','<p>Note text here</p>',0,NULL,133,5,'2025-05-01 21:48:07','2025-05-01 21:48:06','2025-05-01 21:48:17'),
(142,'Tindra Strandberg','Subtitle','<p>Note text here</p>',0,NULL,133,6,'2025-05-01 21:48:34','2025-05-01 21:48:34','2025-05-01 21:48:44'),
(143,'Hans-Olof Strandberg','Subtitle','<p>Note text here</p>',0,NULL,133,7,'2025-05-01 21:49:29','2025-05-01 21:49:29','2025-05-01 21:49:40'),
(144,'Helena Fors','Subtitle','<p>Note text here</p>',0,NULL,133,8,'2025-05-01 21:49:52','2025-05-01 21:49:52','2025-05-01 21:50:07'),
(145,'Bengt-Åke Strandberg','Subtitle','<p>Note text here</p>',0,NULL,133,9,'2025-05-01 21:50:31','2025-05-01 21:50:31','2025-05-01 21:50:41'),
(150,'Commands','Subtitle','<p>✅ Check status of Reverb</p><p>sudo supervisorctl status reverb</p><p><br></p><p>ps aux | grep reverb</p><p><br></p><p>🛑 Stop (shut down) Reverb</p><p>sudo supervisorctl stop reverb</p><p><br></p><p>🔁 Start (bring back up) Reverb</p><p>sudo supervisorctl start reverb</p><p><br></p><p>📋 Check status of Supervisor (the supervisor service itself)</p><p>sudo systemctl status supervisor</p><p><br></p><p><br></p><p><span style=\"background-color: rgb(31, 31, 31); color: rgb(86, 156, 214);\">use</span><span style=\"background-color: rgb(31, 31, 31); color: rgb(212, 212, 212);\"> Illuminate\\Support\\Facades\\</span><span style=\"background-color: rgb(31, 31, 31); color: rgb(78, 201, 176);\">Log</span><span style=\"background-color: rgb(31, 31, 31); color: rgb(212, 212, 212);\">;</span></p>',1,NULL,0,0,'2025-08-04 09:19:07','2025-07-02 21:28:42','2025-08-04 09:19:07'),
(151,'Mona Lisa','Subtitle','<p>Note text here</p>',0,NULL,110,2,'2025-07-30 19:36:32','2025-07-30 19:36:32','2025-07-30 19:44:47'),
(152,'The Last Supper','Subtitle','<p>Note text here</p>',0,NULL,110,3,'2025-07-30 19:36:45','2025-07-30 19:36:44','2025-07-30 19:44:43'),
(153,'Annunciation','Thought to be the earliest of Da Vinci\'s works; Roughly 1472 - 1476','<p><img src=\"https://nerdspace.cyberlad.com/public/media/images/Kmiu7KhaDy.webp\"></p><p><br></p><p>The Annunciation it thought to be the first works painted by Da Vinci\'s own hand. It is speculated that certain additions, such as Gabriel\'s wings, has been extended by another painter.</p><p><br></p><p>The depiction in this painting, is that of Gabriel coming to the Virgin Mary, to lay on the information that she will bare the son of god, which in itself is of course just complete ridiculous nonsense since there is no god.</p><p><br></p><p><br></p>',0,'688a786fe2ba5.webp',110,1,'2025-07-30 19:44:44','2025-07-30 19:44:41','2025-07-30 20:06:24');
/*!40000 ALTER TABLE `topics` ENABLE KEYS */;

--
-- Table structure for table `topics_categories`
--

DROP TABLE IF EXISTS `topics_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `topics_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `topics_categories`
--

/*!40000 ALTER TABLE `topics_categories` DISABLE KEYS */;
INSERT INTO `topics_categories` VALUES
(28,9,1,'2025-04-22 23:51:06','2025-04-22 23:51:06'),
(35,10,42,'2025-04-23 00:20:41','2025-04-23 00:20:41'),
(37,7,21,'2025-04-23 00:35:24','2025-04-23 00:35:24'),
(38,14,44,'2025-04-23 01:47:29','2025-04-23 01:47:29'),
(39,14,55,'2025-04-23 14:08:01','2025-04-23 14:08:01'),
(40,14,64,'2025-04-25 17:39:00','2025-04-25 17:39:00'),
(41,11,103,'2025-04-27 19:38:27','2025-04-27 19:38:27'),
(42,7,123,'2025-05-01 15:22:16','2025-05-01 15:22:16'),
(43,9,133,'2025-05-01 19:35:12','2025-05-01 19:35:12'),
(44,15,134,'2025-05-01 21:30:08','2025-05-01 21:30:08');
/*!40000 ALTER TABLE `topics_categories` ENABLE KEYS */;

--
-- Table structure for table `topics_tags`
--

DROP TABLE IF EXISTS `topics_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `topics_tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tag_id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `topics_tags`
--

/*!40000 ALTER TABLE `topics_tags` DISABLE KEYS */;
INSERT INTO `topics_tags` VALUES
(16,10,21,'2025-04-22 23:35:07','2025-04-22 23:35:07'),
(17,9,21,'2025-04-22 23:49:37','2025-04-22 23:49:37'),
(18,8,21,'2025-04-22 23:49:38','2025-04-22 23:49:38'),
(19,11,42,'2025-04-22 23:56:32','2025-04-22 23:56:32'),
(20,12,42,'2025-04-22 23:56:42','2025-04-22 23:56:42'),
(21,13,1,'2025-04-22 23:57:05','2025-04-22 23:57:05'),
(25,15,64,'2025-04-25 19:08:39','2025-04-25 19:08:39'),
(26,16,64,'2025-04-26 20:37:14','2025-04-26 20:37:14'),
(27,17,103,'2025-04-27 19:38:04','2025-04-27 19:38:04'),
(28,18,103,'2025-04-27 19:38:14','2025-04-27 19:38:14'),
(29,19,103,'2025-04-27 20:20:55','2025-04-27 20:20:55'),
(30,20,103,'2025-05-01 15:35:53','2025-05-01 15:35:53'),
(31,21,103,'2025-05-01 15:36:10','2025-05-01 15:36:10'),
(32,22,103,'2025-05-01 15:36:18','2025-05-01 15:36:18'),
(33,23,124,'2025-05-01 15:47:50','2025-05-01 15:47:50'),
(34,24,124,'2025-05-01 15:47:56','2025-05-01 15:47:56'),
(35,25,124,'2025-05-01 15:48:00','2025-05-01 15:48:00'),
(36,26,124,'2025-05-01 15:48:06','2025-05-01 15:48:06'),
(37,27,124,'2025-05-01 15:48:09','2025-05-01 15:48:09'),
(38,28,124,'2025-05-01 15:48:13','2025-05-01 15:48:13'),
(39,29,133,'2025-05-01 19:35:19','2025-05-01 19:35:19'),
(40,30,133,'2025-05-01 19:35:25','2025-05-01 19:35:25'),
(41,31,134,'2025-05-01 21:30:15','2025-05-01 21:30:15'),
(42,32,134,'2025-05-01 21:30:20','2025-05-01 21:30:20'),
(43,33,1,'2025-05-01 21:53:21','2025-05-01 21:53:21'),
(44,34,1,'2025-05-01 21:53:25','2025-05-01 21:53:25');
/*!40000 ALTER TABLE `topics_tags` ENABLE KEYS */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES
(1,'Admin','ljungqvist1993@proton.me',NULL,'$2y$12$Xs1qo3nzsuZmJC5TiFPLh.jIf/nXwPeTgrnPOkOyOg4y4Jr00Yx1e','TAXe2i1lIhaPfopR0iF6drH74DANsiGRLjboRPjlwm3WDCrmRaMF73pEKKTV','2025-05-16 09:47:25','2025-05-16 09:47:25');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

--
-- Dumping routines for database 'u741933858_docs'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-08-17 20:50:57
