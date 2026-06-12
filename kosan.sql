-- MySQL dump 10.13  Distrib 8.0.18, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: kosan
-- ------------------------------------------------------
-- Server version	8.0.30

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
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
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
INSERT INTO `cache` VALUES ('livewire-rate-limiter:056fc329aaaa757d31db450f525da23fde4d1b36','i:1;',1780470829),('livewire-rate-limiter:056fc329aaaa757d31db450f525da23fde4d1b36:timer','i:1780470829;',1780470829),('spatie.permission.cache','a:3:{s:5:\"alias\";a:4:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";s:1:\"r\";s:5:\"roles\";}s:11:\"permissions\";a:25:{i:0;a:4:{s:1:\"a\";i:1;s:1:\"b\";s:9:\"view_room\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:1;a:4:{s:1:\"a\";i:2;s:1:\"b\";s:11:\"create_room\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:2;a:4:{s:1:\"a\";i:3;s:1:\"b\";s:9:\"edit_room\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:3;a:4:{s:1:\"a\";i:4;s:1:\"b\";s:11:\"delete_room\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:4;a:4:{s:1:\"a\";i:5;s:1:\"b\";s:11:\"view_tenant\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:5;a:4:{s:1:\"a\";i:6;s:1:\"b\";s:13:\"create_tenant\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:6;a:4:{s:1:\"a\";i:7;s:1:\"b\";s:11:\"edit_tenant\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:7;a:4:{s:1:\"a\";i:8;s:1:\"b\";s:13:\"delete_tenant\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:8;a:4:{s:1:\"a\";i:9;s:1:\"b\";s:12:\"view_payment\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:9;a:4:{s:1:\"a\";i:10;s:1:\"b\";s:14:\"create_payment\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:10;a:4:{s:1:\"a\";i:11;s:1:\"b\";s:12:\"edit_payment\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:11;a:4:{s:1:\"a\";i:12;s:1:\"b\";s:14:\"delete_payment\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:12;a:4:{s:1:\"a\";i:13;s:1:\"b\";s:17:\"mark_payment_paid\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:13;a:4:{s:1:\"a\";i:14;s:1:\"b\";s:12:\"view_reports\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:14;a:4:{s:1:\"a\";i:15;s:1:\"b\";s:14:\"export_reports\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:15;a:4:{s:1:\"a\";i:16;s:1:\"b\";s:18:\"view_notifications\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:16;a:4:{s:1:\"a\";i:17;s:1:\"b\";s:20:\"manage_notifications\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:17;a:4:{s:1:\"a\";i:18;s:1:\"b\";s:10:\"view_users\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:18;a:4:{s:1:\"a\";i:19;s:1:\"b\";s:12:\"create_users\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:19;a:4:{s:1:\"a\";i:20;s:1:\"b\";s:10:\"edit_users\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:20;a:4:{s:1:\"a\";i:21;s:1:\"b\";s:12:\"delete_users\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:21;a:4:{s:1:\"a\";i:22;s:1:\"b\";s:13:\"view_facility\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:22;a:4:{s:1:\"a\";i:23;s:1:\"b\";s:15:\"create_facility\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:23;a:4:{s:1:\"a\";i:24;s:1:\"b\";s:13:\"edit_facility\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:24;a:4:{s:1:\"a\";i:25;s:1:\"b\";s:15:\"delete_facility\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}}s:5:\"roles\";a:3:{i:0;a:3:{s:1:\"a\";i:1;s:1:\"b\";s:11:\"super_admin\";s:1:\"c\";s:3:\"web\";}i:1;a:3:{s:1:\"a\";i:2;s:1:\"b\";s:5:\"admin\";s:1:\"c\";s:3:\"web\";}i:2;a:3:{s:1:\"a\";i:3;s:1:\"b\";s:5:\"staff\";s:1:\"c\";s:3:\"web\";}}}',1780557171);
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `facilities`
--

DROP TABLE IF EXISTS `facilities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `facilities` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `facilities`
--

LOCK TABLES `facilities` WRITE;
/*!40000 ALTER TABLE `facilities` DISABLE KEYS */;
INSERT INTO `facilities` VALUES (1,'AC','heroicon-o-sun','2026-05-07 08:41:19','2026-05-07 08:41:19'),(2,'WiFi','heroicon-o-wifi','2026-05-07 08:41:19','2026-05-07 08:41:19'),(3,'Lemari','heroicon-o-archive-box','2026-05-07 08:41:19','2026-05-07 08:41:19'),(4,'Meja Belajar','heroicon-o-computer-desktop','2026-05-07 08:41:19','2026-05-07 08:41:19'),(5,'Kamar Mandi Dalam','heroicon-o-home-modern','2026-05-07 08:41:19','2026-05-07 08:41:19');
/*!40000 ALTER TABLE `facilities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kos_notifications`
--

DROP TABLE IF EXISTS `kos_notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kos_notifications` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'info',
  `icon` varchar(255) DEFAULT NULL,
  `related_payment_id` bigint unsigned DEFAULT NULL,
  `related_tenant_id` bigint unsigned DEFAULT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kos_notifications_related_payment_id_foreign` (`related_payment_id`),
  KEY `kos_notifications_related_tenant_id_foreign` (`related_tenant_id`),
  CONSTRAINT `kos_notifications_related_payment_id_foreign` FOREIGN KEY (`related_payment_id`) REFERENCES `payments` (`id`) ON DELETE SET NULL,
  CONSTRAINT `kos_notifications_related_tenant_id_foreign` FOREIGN KEY (`related_tenant_id`) REFERENCES `tenants` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kos_notifications`
--

LOCK TABLES `kos_notifications` WRITE;
/*!40000 ALTER TABLE `kos_notifications` DISABLE KEYS */;
INSERT INTO `kos_notifications` VALUES (1,'Pembayaran Akan Jatuh Tempo','Pembayaran Dimas (Kamar 202) akan jatuh tempo dalam 2 hari pada 15 May 2026.','warning','heroicon-o-exclamation-triangle',4,17,NULL,'2026-05-13 06:42:21','2026-05-14 07:55:53'),(2,'Pembayaran Terlambat','Pembayaran Udin (Kamar 105) sudah terlambat 3 hari sejak 10 May 2026.','danger','heroicon-o-x-circle',9,19,NULL,'2026-05-13 06:42:21','2026-05-14 07:55:53');
/*!40000 ALTER TABLE `kos_notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_05_06_001340_create_facilities_table',1),(5,'2026_05_06_001409_create_rooms_table',1),(6,'2026_05_06_001415_create_room_facility_table',1),(7,'2026_05_06_001425_create_tenants_table',1),(8,'2026_05_06_001436_create_payments_table',1),(9,'2026_05_06_001442_create_kos_notifications_table',1),(10,'2026_05_19_061751_create_permission_tables',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_permissions`
--

LOCK TABLES `model_has_permissions` WRITE;
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_roles`
--

LOCK TABLES `model_has_roles` WRITE;
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` VALUES (1,'App\\Models\\User',1),(2,'App\\Models\\User',3),(3,'App\\Models\\User',4);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tenant_id` bigint unsigned NOT NULL,
  `room_id` bigint unsigned NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `due_date` date NOT NULL,
  `paid_date` date DEFAULT NULL,
  `status` enum('pending','due_soon','overdue','paid') NOT NULL DEFAULT 'pending',
  `payment_method` varchar(255) DEFAULT NULL,
  `proof_image` varchar(255) DEFAULT NULL,
  `notes` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `payments_tenant_id_foreign` (`tenant_id`),
  KEY `payments_room_id_foreign` (`room_id`),
  CONSTRAINT `payments_room_id_foreign` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE RESTRICT,
  CONSTRAINT `payments_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payments`
--

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
INSERT INTO `payments` VALUES (2,15,8,800000.00,'2026-05-20','2026-05-17','paid',NULL,NULL,NULL,'2026-05-09 08:18:56','2026-05-16 22:03:39'),(4,17,9,800000.00,'2026-05-15','2026-05-15','paid',NULL,NULL,NULL,'2026-05-09 08:20:10','2026-05-14 20:58:24'),(8,13,4,600000.00,'2026-05-01','2026-05-01','paid','transfer','payments/proof/01KR6QCVFNH17TSDH57RWZ8TFN.jpeg',NULL,'2026-05-09 08:58:45','2026-05-09 08:58:45'),(9,19,7,600000.00,'2026-05-10','2026-05-13','paid',NULL,NULL,NULL,'2026-05-10 06:31:45','2026-05-13 06:43:56'),(11,18,10,800000.00,'2026-05-01','2026-05-03','paid',NULL,NULL,NULL,'2026-05-13 21:06:14','2026-05-13 21:06:14'),(12,20,3,600000.00,'2026-05-05','2026-05-14','paid',NULL,NULL,NULL,'2026-05-13 21:07:02','2026-05-14 07:57:04'),(13,16,6,600000.00,'2026-05-08','2026-05-14','paid',NULL,NULL,NULL,'2026-05-14 02:46:12','2026-05-14 07:57:07'),(14,18,10,800000.00,'2026-06-01','2026-06-01','paid',NULL,NULL,NULL,'2026-06-03 00:28:32','2026-06-03 00:28:32'),(15,21,4,600000.00,'2026-06-05','2026-06-05','paid',NULL,NULL,NULL,'2026-06-03 00:29:51','2026-06-03 00:29:51'),(16,20,3,600000.00,'2026-06-05',NULL,'pending',NULL,NULL,NULL,'2026-06-03 00:30:33','2026-06-03 00:30:33'),(17,16,6,600000.00,'2026-06-08',NULL,'pending',NULL,NULL,NULL,'2026-06-03 00:31:13','2026-06-03 00:31:13'),(18,19,7,600000.00,'2026-06-10',NULL,'pending',NULL,NULL,NULL,'2026-06-03 00:31:40','2026-06-03 00:31:40'),(19,17,9,800000.00,'2026-06-15',NULL,'pending',NULL,NULL,NULL,'2026-06-03 00:32:38','2026-06-03 00:32:38'),(20,15,8,800000.00,'2026-06-20',NULL,'pending',NULL,NULL,NULL,'2026-06-03 00:32:50','2026-06-03 00:32:50');
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'view_room','web','2026-05-18 23:21:29','2026-05-18 23:21:29'),(2,'create_room','web','2026-05-18 23:21:29','2026-05-18 23:21:29'),(3,'edit_room','web','2026-05-18 23:21:29','2026-05-18 23:21:29'),(4,'delete_room','web','2026-05-18 23:21:29','2026-05-18 23:21:29'),(5,'view_tenant','web','2026-05-18 23:21:29','2026-05-18 23:21:29'),(6,'create_tenant','web','2026-05-18 23:21:29','2026-05-18 23:21:29'),(7,'edit_tenant','web','2026-05-18 23:21:29','2026-05-18 23:21:29'),(8,'delete_tenant','web','2026-05-18 23:21:29','2026-05-18 23:21:29'),(9,'view_payment','web','2026-05-18 23:21:29','2026-05-18 23:21:29'),(10,'create_payment','web','2026-05-18 23:21:29','2026-05-18 23:21:29'),(11,'edit_payment','web','2026-05-18 23:21:29','2026-05-18 23:21:29'),(12,'delete_payment','web','2026-05-18 23:21:29','2026-05-18 23:21:29'),(13,'mark_payment_paid','web','2026-05-18 23:21:29','2026-05-18 23:21:29'),(14,'view_reports','web','2026-05-18 23:21:29','2026-05-18 23:21:29'),(15,'export_reports','web','2026-05-18 23:21:29','2026-05-18 23:21:29'),(16,'view_notifications','web','2026-05-18 23:21:29','2026-05-18 23:21:29'),(17,'manage_notifications','web','2026-05-18 23:21:29','2026-05-18 23:21:29'),(18,'view_users','web','2026-05-18 23:21:29','2026-05-18 23:21:29'),(19,'create_users','web','2026-05-18 23:21:29','2026-05-18 23:21:29'),(20,'edit_users','web','2026-05-18 23:21:29','2026-05-18 23:21:29'),(21,'delete_users','web','2026-05-18 23:21:29','2026-05-18 23:21:29'),(22,'view_facility','web','2026-05-21 00:54:50','2026-05-21 00:54:50'),(23,'create_facility','web','2026-05-21 00:54:50','2026-05-21 00:54:50'),(24,'edit_facility','web','2026-05-21 00:54:50','2026-05-21 00:54:50'),(25,'delete_facility','web','2026-05-21 00:54:50','2026-05-21 00:54:50');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_has_permissions`
--

LOCK TABLES `role_has_permissions` WRITE;
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
INSERT INTO `role_has_permissions` VALUES (1,1),(2,1),(3,1),(4,1),(5,1),(6,1),(7,1),(8,1),(9,1),(10,1),(11,1),(12,1),(13,1),(14,1),(15,1),(16,1),(17,1),(18,1),(19,1),(20,1),(21,1),(22,1),(23,1),(24,1),(25,1),(1,2),(2,2),(3,2),(4,2),(5,2),(6,2),(7,2),(8,2),(9,2),(10,2),(11,2),(12,2),(13,2),(14,2),(15,2),(16,2),(17,2),(22,2),(23,2),(24,2),(25,2),(1,3),(5,3),(6,3),(7,3),(9,3),(10,3),(13,3),(14,3),(16,3);
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'super_admin','web','2026-05-18 23:21:29','2026-05-18 23:21:29'),(2,'admin','web','2026-05-18 23:21:29','2026-05-18 23:21:29'),(3,'staff','web','2026-05-18 23:21:29','2026-05-18 23:21:29');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `room_facility`
--

DROP TABLE IF EXISTS `room_facility`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `room_facility` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `room_id` bigint unsigned NOT NULL,
  `facility_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `room_facility_room_id_foreign` (`room_id`),
  KEY `room_facility_facility_id_foreign` (`facility_id`),
  CONSTRAINT `room_facility_facility_id_foreign` FOREIGN KEY (`facility_id`) REFERENCES `facilities` (`id`) ON DELETE CASCADE,
  CONSTRAINT `room_facility_room_id_foreign` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `room_facility`
--

LOCK TABLES `room_facility` WRITE;
/*!40000 ALTER TABLE `room_facility` DISABLE KEYS */;
INSERT INTO `room_facility` VALUES (1,3,2,NULL,NULL),(2,3,3,NULL,NULL),(3,3,4,NULL,NULL),(4,3,5,NULL,NULL),(5,4,2,NULL,NULL),(6,4,3,NULL,NULL),(7,4,4,NULL,NULL),(8,4,5,NULL,NULL),(9,5,2,NULL,NULL),(10,5,3,NULL,NULL),(11,5,4,NULL,NULL),(12,5,5,NULL,NULL),(13,6,2,NULL,NULL),(14,6,3,NULL,NULL),(15,6,4,NULL,NULL),(16,6,5,NULL,NULL),(17,7,2,NULL,NULL),(18,7,3,NULL,NULL),(19,7,4,NULL,NULL),(20,7,5,NULL,NULL),(21,8,1,NULL,NULL),(22,8,2,NULL,NULL),(23,8,3,NULL,NULL),(24,8,4,NULL,NULL),(25,8,5,NULL,NULL),(26,9,1,NULL,NULL),(27,9,2,NULL,NULL),(28,9,3,NULL,NULL),(29,9,4,NULL,NULL),(30,9,5,NULL,NULL),(31,10,1,NULL,NULL),(32,10,2,NULL,NULL),(33,10,3,NULL,NULL),(34,10,4,NULL,NULL),(35,10,5,NULL,NULL),(36,11,1,NULL,NULL),(37,11,2,NULL,NULL),(38,11,3,NULL,NULL),(39,11,4,NULL,NULL),(40,11,5,NULL,NULL),(41,12,1,NULL,NULL),(42,12,2,NULL,NULL),(43,12,3,NULL,NULL),(44,12,4,NULL,NULL),(45,12,5,NULL,NULL);
/*!40000 ALTER TABLE `room_facility` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rooms`
--

DROP TABLE IF EXISTS `rooms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rooms` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `room_number` varchar(255) NOT NULL,
  `type` enum('standard','premium') NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `status` enum('available','occupied') NOT NULL DEFAULT 'available',
  `description` text,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `rooms_room_number_unique` (`room_number`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rooms`
--

LOCK TABLES `rooms` WRITE;
/*!40000 ALTER TABLE `rooms` DISABLE KEYS */;
INSERT INTO `rooms` VALUES (3,'101','standard',600000.00,'occupied','Kamar standard nyaman dengan fasilitas dasar lengkap. Cocok untuk mahasiswa atau pekerja dengan budget terjangkau.',NULL,'2026-05-07 08:41:19','2026-05-08 01:16:37'),(4,'102','standard',600000.00,'occupied','Kamar standard di lantai 1. Akses mudah dan dekat dengan area parkir.',NULL,'2026-05-07 08:41:19','2026-06-03 00:25:43'),(5,'103','standard',600000.00,'available','Kamar standard dengan pencahayaan alami yang baik. Hadap timur, sejuk di pagi hari.','rooms/01KR352QSKV96JSEHX177YM3NT.jpg','2026-05-07 08:41:19','2026-06-03 00:19:19'),(6,'104','standard',600000.00,'occupied','Kamar standard luas dengan jendela besar. Sirkulasi udara sangat baik.',NULL,'2026-05-07 08:41:19','2026-06-03 00:23:47'),(7,'105','standard',600000.00,'occupied','Kamar standard tenang di pojok gedung. Minim kebisingan, cocok untuk yang butuh fokus.',NULL,'2026-05-07 08:41:19','2026-05-08 01:14:24'),(8,'201','premium',800000.00,'occupied','Kamar premium dengan AC. Suasana nyaman dan modern untuk profesional muda.','rooms/01KR353TC0RY7QVJDD4G2DCA6X.jpg','2026-05-07 08:41:19','2026-05-08 01:10:48'),(9,'202','premium',800000.00,'occupied','Kamar premium terluas di lantai 2. Dilengkapi semua fasilitas termasuk AC.',NULL,'2026-05-07 08:41:19','2026-05-08 01:12:36'),(10,'203','premium',800000.00,'occupied','Kamar premium dengan view taman. Tenang, sejuk, dan dilengkapi AC inverter hemat energi.','rooms/01KR354EM5K2H5T8JXA98RA1K6.jpg','2026-05-07 08:41:19','2026-06-03 00:24:12'),(11,'204','premium',800000.00,'available','Kamar premium corner unit dengan dua jendela besar. Pencahayaan maksimal dan sirkulasi udara optimal.',NULL,'2026-05-07 08:41:19','2026-05-08 01:08:44'),(12,'205','premium',800000.00,'available','Kamar premium paling populer. Fasilitas lengkap, lokasi strategis dekat tangga dan lift.',NULL,'2026-05-07 08:41:19','2026-05-08 01:08:57');
/*!40000 ALTER TABLE `rooms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text,
  `payload` longtext NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('pbqyJVmU2MKz7sLqrS0KmjfKR2bGLGPgGk6WE2y5',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiMVVxRUYxZ2FKMkZmR0Zlb2tSbHNUcG4xWExUaXhlY1k4bFBrcmlBWSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rYW1hciI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1781145807),('XWgCHlHM3W1NKlvHhJ9v3MCmAAUwyp0i24ZOXu27',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiWVREeERwa0IxbUQyOWY3bjdXNkZiVVRMNzlJSFZtUzZPU3BGb3hqbyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MzoidXJsIjthOjE6e3M6ODoiaW50ZW5kZWQiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbiI7fX0=',1781274177);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tenants`
--

DROP TABLE IF EXISTS `tenants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tenants` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `room_id` bigint unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `id_card_number` varchar(255) DEFAULT NULL,
  `id_card_image` varchar(255) DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `notes` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tenants_room_id_foreign` (`room_id`),
  CONSTRAINT `tenants_room_id_foreign` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tenants`
--

LOCK TABLES `tenants` WRITE;
/*!40000 ALTER TABLE `tenants` DISABLE KEYS */;
INSERT INTO `tenants` VALUES (12,3,'Febry',NULL,'081298761234',NULL,NULL,'2026-01-01','2026-05-31','inactive',NULL,'2026-05-08 01:02:18','2026-05-08 01:08:09'),(13,4,'Yono','yono@gmail.com','085657585950','1234987623458765','tenants/ktp/01KR39YVBKT1HY0RCSCP3WHE3G.png','2026-01-01','2026-05-31','inactive',NULL,'2026-05-08 01:06:12','2026-06-03 00:21:23'),(14,5,'Pamungkas',NULL,'089988776655',NULL,NULL,'2026-01-16','2026-05-15','inactive',NULL,'2026-05-08 01:09:50','2026-05-08 01:15:24'),(15,8,'Cintia',NULL,'087788991122',NULL,NULL,'2026-01-20',NULL,'active',NULL,'2026-05-08 01:10:48','2026-05-08 01:10:48'),(16,6,'Teo',NULL,'083833338888',NULL,NULL,'2026-02-08',NULL,'active',NULL,'2026-05-08 01:11:52','2026-05-08 01:11:52'),(17,9,'Dimas',NULL,'089621213434',NULL,NULL,'2026-02-15',NULL,'active',NULL,'2026-05-08 01:12:36','2026-05-08 01:12:36'),(18,10,'Burhan',NULL,'087854556566',NULL,NULL,'2026-03-01',NULL,'active',NULL,'2026-05-08 01:13:36','2026-05-08 01:13:36'),(19,7,'Udin',NULL,'085212123434',NULL,NULL,'2026-04-10',NULL,'active',NULL,'2026-05-08 01:14:24','2026-05-08 01:14:24'),(20,3,'Eka',NULL,'08972323454',NULL,NULL,'2026-05-05',NULL,'active',NULL,'2026-05-08 01:16:37','2026-05-08 01:16:37'),(21,4,'Hary',NULL,'081276754543',NULL,NULL,'2026-06-05',NULL,'active',NULL,'2026-06-03 00:25:43','2026-06-03 00:25:43');
/*!40000 ALTER TABLE `tenants` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'staff',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Super Admin','super.admin@kosan.id',NULL,'$2y$12$EEDapQwFBgG8Hutk5hXmzeSzajFHR7WK3.MlklApqTsWz8/EC4gie','admin',NULL,'2026-05-07 08:26:15','2026-05-19 00:32:22'),(3,'Admin','admin@kosan.id',NULL,'$2y$12$.v.lFRHJbkzkwHUzsMdnAe9QT52F6/.nR43djqraeWWRh6xtl4iS2','admin',NULL,'2026-05-18 23:58:22','2026-05-19 00:03:52'),(4,'Staff','staff@kosan.id',NULL,'$2y$12$Phd/CM1OH6uIvyeXE4ViKu..bNlZyVwdWCPEX/A0vI3b66hAzQOtW','staff',NULL,'2026-05-18 23:58:58','2026-05-18 23:58:58');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'kosan'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-06-12 21:41:43
