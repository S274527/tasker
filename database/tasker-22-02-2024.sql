-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 21, 2024 at 07:03 PM
-- Server version: 8.0.31
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tasker`
--

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

DROP TABLE IF EXISTS `project`;
CREATE TABLE IF NOT EXISTS `project` (
  `project_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `is_active` enum('Y','N') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'Y' COMMENT '''Y''=>''Yes'', ''N''=>''No''',
  PRIMARY KEY (`project_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`project_id`, `name`, `description`, `created_at`, `updated_at`, `is_active`) VALUES
(1, 'Gaming App', 'This project is about creating a gaming app. The game is simple just simple calculations.This project is about creating a gaming app.', '2024-02-21 15:56:43', '2024-02-21 16:00:49', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `role_id` int NOT NULL AUTO_INCREMENT,
  `role` varchar(20) NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `role`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

DROP TABLE IF EXISTS `task`;
CREATE TABLE IF NOT EXISTS `task` (
  `task_id` int NOT NULL AUTO_INCREMENT,
  `project_id` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `due_date` date NOT NULL,
  `priority` enum('High','Low') NOT NULL DEFAULT 'Low',
  `status` enum('Completed','In Progress','Pending') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `is_active` enum('Y','N') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'Y' COMMENT '''Y''=>''Yes'', ''N''=>''No''',
  PRIMARY KEY (`task_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`task_id`, `project_id`, `title`, `description`, `due_date`, `priority`, `status`, `created_at`, `updated_at`, `created_by`, `is_active`) VALUES
(1, 1, 'Design', 'Design phase will take 4 weeks.', '2024-02-28', 'Low', 'Completed', '2024-02-21 16:02:53', '2024-02-21 18:25:56', 1, 'Y'),
(2, 1, 'Media', 'Gathering all media to be used in the app.', '2024-02-24', 'High', 'In Progress', '2024-02-21 18:36:35', '0000-00-00 00:00:00', 5, 'Y'),
(3, 1, 'Research', 'Need to research every detail for the app.', '2024-02-28', 'High', 'Pending', '2024-02-21 18:37:35', '0000-00-00 00:00:00', 5, 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `full_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int NOT NULL COMMENT 'refer ''roles''',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `is_added_by_admin` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` enum('Y','N') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'Y' COMMENT '''Y''=>''Yes'', ''N''=>''No''',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `full_name`, `email`, `password`, `role_id`, `created_at`, `updated_at`, `is_added_by_admin`, `is_active`) VALUES
(1, 'admin', 'admin@tasker.com', '$argon2id$v=19$m=65536,t=4,p=1$cFMxSUlDZFlTczQzLk55eQ$cNwZOiC2GXKYMLKqijirJzLjdRmbNo+XySD93oD0Uac', 1, '2024-02-15 18:37:35', '2024-02-18 15:20:12', 0, 'Y'),
(4, 'diana', 'dianaprince@dc.in', '$argon2id$v=19$m=65536,t=4,p=1$ajUvNUMyRk9FVWUvcnZoMQ$GCOmCsd/gcYB+Egn0a49Jmqwu2b//4DsEEs/bp5iP04', 2, '2024-02-21 16:27:09', '2024-02-21 19:01:11', 0, 'Y'),
(3, 'aman', 'aman2@test.in', '$argon2id$v=19$m=65536,t=4,p=1$N0ExcnVjVS90eVpESnA4Lg$fhS3VFgdtlc7Ns95kGM4HRXOQyA73Q/a+liU5Oii4SE', 2, '2024-02-21 15:44:42', '2024-02-21 19:01:31', 1, 'Y'),
(5, 'Bruce Wayne', 'bruce@wayne.com', '$argon2id$v=19$m=65536,t=4,p=1$c1FROS9PZUVMZ1pVVzBMaA$+NnRaYW3VIwrcMV6RQvSi6SAWQxz88MpJJ4eJH5jl/A', 2, '2024-02-21 16:29:18', '2024-02-21 18:58:40', 0, 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `user_project`
--

DROP TABLE IF EXISTS `user_project`;
CREATE TABLE IF NOT EXISTS `user_project` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `project_id` text NOT NULL,
  `updated_at` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_project`
--

INSERT INTO `user_project` (`id`, `user_id`, `project_id`, `updated_at`) VALUES
(1, 3, '', '0000-00-00 00:00:00'),
(2, 4, '', '0000-00-00 00:00:00'),
(3, 5, '1', '2024-02-21 18:23:30');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
