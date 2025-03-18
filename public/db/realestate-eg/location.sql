-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 18, 2025 at 11:23 PM
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
-- Database: `realestateeg-new`
--

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `parent_id`, `slug`, `projects_type`, `photo`, `photo_thumbnail`, `sort_order`, `latitude`, `longitude`, `is_active`, `is_searchable`, `is_home`, `projects_count`, `units_count`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, NULL, 'greater-cairo', 'compound', 'locations/3R7OCNjmcRgBOlPA.jpg', 'locations/3R7OCNjmcRgBOlPA_thumb.jpg', 5, 30.1314718, 31.0581095, 1, 0, NULL, 0, 0, '2018-11-30 18:24:38', '2024-01-23 19:48:47', NULL),
(2, 1, 'greater-cairo/cairo-east', 'compound', 'locations/qx5ZURVstiYldjPq.jpg', 'locations/qx5ZURVstiYldjPq_thumb.jpg', 3, NULL, NULL, 1, 1, NULL, 5, 46, '2018-11-30 18:52:30', '2024-08-22 22:02:19', NULL),
(3, 1, 'greater-cairo/cairo-west', 'compound', 'locations/q0gdpTovthQW8nJV.jpg', 'locations/q0gdpTovthQW8nJV_thumb.jpg', 2, NULL, NULL, 1, 1, NULL, 1, 1, '2018-11-30 18:54:24', '2024-01-23 19:48:47', NULL),
(4, 7, 'north-coast', NULL, 'images/location/north-coast-PeRcgF1ySt.webp', 'images/location/north-coast-eo3oLvKEQ8.webp', 1, 30.946991, 28.762207, 1, 1, 0, 200, 3416, '2018-11-30 19:05:26', '2024-10-06 15:59:41', NULL),
(5, 7, 'egypt/red-sea', 'resort', 'locations/ckql3wQlioWbR2TY.jpg', 'locations/ckql3wQlioWbR2TY_thumb.jpg', 4, NULL, NULL, 1, 1, NULL, 2, 40, '2018-11-30 19:06:22', '2024-01-23 19:48:47', NULL),
(6, 2, 'new-administrative-capital', NULL, 'images/location/new-administrative-capital-clri78Im23.webp', 'images/location/new-administrative-capital-0IUzRf3aS6.webp', 5, 29.9954014, 31.73525, 1, 1, 0, 592, 10632, '2018-11-30 23:11:30', '2024-11-17 07:54:05', NULL),
(7, NULL, 'egypt', NULL, 'locations/GEtxwpoXlUX5twsw.jpg', 'locations/GEtxwpoXlUX5twsw_thumb.jpg', 5, 26.8349117, 26.3810043, 1, 0, 0, 0, 0, '2018-12-01 14:11:52', '2024-02-21 15:02:24', NULL),
(8, 2, 'new-cairo', NULL, 'images/location/new-cairo-NNdslE3RcQ.webp', 'images/location/new-cairo-AX3PFGOTSd.webp', 5, 30.0178476, 31.4174195, 1, 1, 0, 645, 9428, '2018-12-01 16:39:18', '2024-11-17 07:54:05', NULL),
(9, 2, 'mostakbal-city', NULL, 'images/location/mostakbal-city-9ydeFdpPbe.webp', 'images/location/mostakbal-city-bCPQfEvcuV.webp', 5, 30.0681649, 31.6854668, 1, 1, 0, 66, 1336, '2018-12-01 16:57:44', '2024-11-17 07:54:05', NULL),
(10, 2, 'cairo-east-maadi', NULL, 'images/location/cairo-east-maadi-mZhm7PAOla.webp', 'images/location/cairo-east-maadi-TMRCrwT2zY.webp', 5, NULL, NULL, 1, 1, 0, 6, 87, '2018-12-01 16:58:21', '2024-12-24 13:19:55', NULL),
(11, 2, 'cairo-east-nasr-city', NULL, 'images/location/cairo-east-nasr-city-xeMgcoAd7Z.webp', 'images/location/cairo-east-nasr-city-QJN5bUZlxj.webp', 5, NULL, NULL, 1, 1, 0, 8, 98, '2018-12-01 16:59:03', '2024-12-24 13:21:43', NULL),
(12, 2, 'katamya', 'compound', 'locations/EZXdmg2s8KZZxwOq.jpg', 'locations/EZXdmg2s8KZZxwOq_thumb.jpg', 5, NULL, NULL, 1, 1, NULL, 11, 282, '2018-12-01 16:59:48', '2024-05-23 13:42:25', NULL),
(13, 2, 'cairo-east-obour', NULL, 'images/location/cairo-east-obour-WXuyfP2H3o.webp', 'images/location/cairo-east-obour-cWSkbYEhNs.webp', 5, NULL, NULL, 1, 1, 0, 10, 69, '2018-12-01 17:00:37', '2024-12-24 13:23:05', NULL),
(14, 2, 'sherouk', NULL, 'images/location/sherouk-482hAUVknP.webp', 'images/location/sherouk-c0c6Urt2vT.webp', 5, NULL, NULL, 1, 1, 0, 66, 726, '2018-12-01 17:01:26', '2024-11-17 07:54:05', NULL),
(15, 3, 'sixth-october-city', NULL, 'images/location/sixth-october-city-nJpbKFXxzo.webp', 'images/location/sixth-october-city-MVCTwjcYMW.webp', 5, NULL, NULL, 1, 1, 0, 157, 3042, '2018-12-01 17:18:45', '2024-11-17 07:54:05', NULL),
(16, 3, 'sheikh-zayed', NULL, 'images/location/sheikh-zayed-4ZT3OCAPca.webp', 'images/location/sheikh-zayed-9x3eZY5oKf.webp', 5, NULL, NULL, 1, 1, 0, 175, 2623, '2018-12-01 17:19:43', '2024-11-17 07:54:05', NULL),
(17, 3, 'alex-desert-road', 'compound', '', '', 5, NULL, NULL, 1, 1, NULL, 7, 180, '2018-12-01 17:20:23', '2024-01-23 19:48:48', NULL),
(18, 5, 'al-ain-al-sokhna', NULL, 'images/location/al-ain-al-sokhna-ksyt1ayPSG.webp', 'images/location/al-ain-al-sokhna-vAF1JGvmKx.webp', NULL, 29.725924, 32.304611, 1, 1, 0, 68, 2271, '2019-01-05 20:22:32', '2024-10-06 15:59:41', NULL),
(19, 7, 'New-Mansoura-City', 'compound', '', '', NULL, NULL, NULL, 1, 1, NULL, 5, 75, '2019-08-04 20:08:26', '2024-08-22 22:02:19', NULL),
(20, 5, 'hurghada', NULL, 'images/location/hurghada-S63rDbXl7Q.webp', 'images/location/hurghada-XTufiSkK29.webp', NULL, NULL, NULL, 1, 1, 0, 17, 367, '2019-08-04 20:09:28', '2024-01-23 18:33:09', NULL),
(21, 2, 'new-heliopolis-city', 'compound', '', '', NULL, NULL, NULL, 1, 1, NULL, 8, 134, '2019-08-04 20:12:00', '2024-08-22 22:02:19', NULL),
(22, 5, 'ras-sudr', 'resort', '', '', NULL, NULL, NULL, 1, 1, NULL, 2, 32, '2020-04-10 23:58:46', '2024-01-23 19:48:48', NULL),
(23, 7, 'new-alamein', NULL, 'images/location/new-alamein-6GzqSJDP8B.webp', 'images/location/new-alamein-KvY1rcG5ie.webp', NULL, NULL, NULL, 1, 1, 0, 16, 345, '2020-04-14 03:45:35', '2024-05-23 13:42:25', NULL),
(24, 7, 'alexandria', 'compound', '', '', NULL, NULL, NULL, 1, 1, NULL, 8, 155, '2020-05-29 11:45:20', '2024-08-22 22:02:19', NULL),
(25, 7, 'tanta', 'compound', '', '', NULL, NULL, NULL, 1, 0, NULL, 0, 1, '2020-09-14 16:32:45', '2024-01-23 19:48:48', NULL),
(27, 7, '10th-of-ramadan-city', 'residential', 'images/location/10th-of-ramadan-city-lrTTkOeHKD.webp', 'images/location/10th-of-ramadan-city-r5Nk9V2uL5.webp', NULL, 30.2993939, 31.6141789, 1, 0, 0, NULL, NULL, '2024-12-15 12:57:37', '2024-12-24 13:20:37', NULL),
(28, 4, 'ras-el-hikma', 'vacation', 'images/location/ras-el-hikma-ggga9CrXFC.webp', 'images/location/ras-el-hikma-Nvgf3PeFo6.webp', NULL, NULL, NULL, 1, 1, 0, NULL, NULL, '2024-12-24 13:15:46', '2024-12-24 13:20:23', NULL),
(29, 8, 'sixth-settlement', 'residential', 'images/location/sixth-settlement-0lChyPzgs2.webp', 'images/location/sixth-settlement-rGQtXyqSSi.webp', NULL, NULL, NULL, 1, 0, 1, NULL, NULL, '2025-03-05 20:08:27', '2025-03-05 20:08:27', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
