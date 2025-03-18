-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 18, 2025 at 08:07 PM
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
-- Dumping data for table `amenity`
--

INSERT INTO `amenity` (`id`, `icon`, `photo`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'fas fa-gavel', '', '2023-10-15 10:42:56', '2023-10-17 09:53:07', NULL),
(2, 'fas fa-volleyball-ball', 'images/amenity/playgrounds.webp', '2023-10-15 10:42:56', '2023-10-15 10:42:56', NULL),
(3, 'fas fa-swimming-pool', 'images/amenity/swimming-pools.webp', '2023-10-15 10:42:56', '2023-10-15 10:42:56', NULL),
(4, 'fas fa-shopping-cart', 'images/amenity/shopping-center.webp', '2023-10-15 10:42:56', '2023-10-15 10:42:56', NULL),
(5, 'far fa-address-book', '', '2023-10-15 10:42:56', '2023-10-17 09:53:25', NULL),
(6, 'fas fa-mosque', '', '2023-10-15 10:42:56', '2023-10-17 09:54:31', NULL),
(7, 'fas fa-football-ball', 'images/amenity/social-club.webp', '2023-10-15 10:42:56', '2023-10-17 09:54:59', NULL),
(8, 'fas fa-hospital', '', '2023-10-15 10:42:56', '2023-10-17 09:55:16', NULL),
(9, 'fas fa-swatchbook', '', '2023-10-15 10:42:56', '2023-10-17 09:59:03', NULL),
(10, 'fas fa-hotel', '', '2023-10-15 10:42:56', '2023-10-17 09:55:47', NULL),
(11, 'fas fa-coffee', '', '2023-10-15 10:42:56', '2023-10-17 09:59:35', NULL),
(12, 'fas fa-apple-alt', '', '2023-10-15 10:42:56', '2023-10-17 09:59:50', NULL),
(13, 'fas fa-bed', '', '2023-10-15 10:42:56', '2023-10-17 09:59:57', NULL),
(14, 'fas fa-bath', '', '2023-10-15 10:42:56', '2023-10-17 10:00:05', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
