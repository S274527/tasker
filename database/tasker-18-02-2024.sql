-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 18, 2024 at 04:01 PM
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
  `is_active` enum('Y','N') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Y' COMMENT '''Y''=>''Yes'', ''N''=>''No''',
  PRIMARY KEY (`project_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`project_id`, `name`, `description`, `created_at`, `updated_at`, `is_active`) VALUES
(1, 'proj 1', 'lorem', '2024-02-16 17:05:17', '2024-02-16 19:10:53', 'Y'),
(2, 'proj 2', 'lorem', '2024-02-16 17:06:26', '2024-02-16 19:10:53', 'Y'),
(3, 'proj 3', 'lorem', '2024-02-16 17:07:49', '2024-02-16 19:10:53', 'Y'),
(4, 'proj 4', 'lorem', '2024-02-16 17:27:52', '2024-02-16 19:10:53', 'Y'),
(5, 'proj 5', 'lorem', '2024-02-16 17:27:56', '2024-02-16 19:10:53', 'Y'),
(6, 'proj 6', 'lorem', '2024-02-16 17:28:00', '2024-02-16 19:10:53', 'Y'),
(7, 'proj 7', 'lorem', '2024-02-16 17:28:04', '2024-02-16 19:10:53', 'Y'),
(8, 'proj 81', 'lorem', '2024-02-16 17:28:07', '2024-02-17 16:20:05', 'Y'),
(9, 'proj 9', 'lorem', '2024-02-16 17:28:10', '2024-02-17 15:51:53', 'N'),
(10, 'proj 10', 'lorem', '2024-02-16 17:28:14', '2024-02-16 19:11:02', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `role_id` int NOT NULL AUTO_INCREMENT,
  `role` varchar(20) NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `due_date` date NOT NULL,
  `priority` enum('High','Low') NOT NULL DEFAULT 'Low',
  `status` enum('Completed','In Progress','Pending') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `is_active` enum('Y','N') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Y' COMMENT '''Y''=>''Yes'', ''N''=>''No''',
  PRIMARY KEY (`task_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`task_id`, `project_id`, `title`, `description`, `due_date`, `priority`, `status`, `created_at`, `updated_at`, `created_by`, `is_active`) VALUES
(1, 1, 'test', 'lorem', '2024-02-22', 'High', 'In Progress', '2024-02-17 18:20:23', '2024-02-17 19:28:27', 1, 'N'),
(2, 1, 'tests', 'lorem ipsum', '2024-02-27', 'Low', 'Pending', '2024-02-17 19:28:12', '2024-02-17 19:49:01', 1, 'Y'),
(3, 2, 'task 2', 'lll', '2024-02-28', 'High', 'Pending', '2024-02-18 14:22:45', '0000-00-00 00:00:00', 1, 'Y'),
(4, 2, 'test empy', 'fgfgf', '2024-02-19', 'Low', 'Pending', '2024-02-18 14:40:54', '2024-02-18 14:45:23', 3, 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `full_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int NOT NULL COMMENT 'refer ''roles''',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `is_added_by_admin` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` enum('Y','N') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Y' COMMENT '''Y''=>''Yes'', ''N''=>''No''',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `full_name`, `email`, `password`, `role_id`, `created_at`, `updated_at`, `is_added_by_admin`, `is_active`) VALUES
(1, 'admin', 'admin@tasker.com', '$argon2id$v=19$m=65536,t=4,p=1$cFMxSUlDZFlTczQzLk55eQ$cNwZOiC2GXKYMLKqijirJzLjdRmbNo+XySD93oD0Uac', 1, '2024-02-15 18:37:35', '2024-02-18 15:20:12', 0, 'Y'),
(2, 'user', 'test@test.in', '$argon2id$v=19$m=65536,t=4,p=1$bEl5LjBtTlBUSnZGamJxeQ$sH/x1kZCL0/R1tIbuI1I5wEO7kSZmMiF5ZekcudP4ps', 2, '2024-02-15 18:41:59', '2024-02-16 19:10:10', 0, 'Y'),
(3, 'user1', 'test1@test.in', '$argon2id$v=19$m=65536,t=4,p=1$bEl5LjBtTlBUSnZGamJxeQ$sH/x1kZCL0/R1tIbuI1I5wEO7kSZmMiF5ZekcudP4ps', 2, '2024-02-15 18:41:59', '2024-02-18 15:01:26', 0, 'Y'),
(4, 'ad user', 'aduser@test.in', '$argon2id$v=19$m=65536,t=4,p=1$bERKS1BPaHhuMXVoeC4uTA$j8QxhRu8BBQW9Gctctj5NsKNmgQ4U9mCqbFFVI3s4kY', 2, '2024-02-18 15:21:47', '2024-02-18 15:22:25', 1, 'Y'),
(5, 'auser', 'asser@test.in', '$argon2id$v=19$m=65536,t=4,p=1$VVJybXJ5U1BLakF1bzBDbQ$Lf+L7AW0s1OQwA42e5h6HyKb4xlVRsvLIH5WR12g/5Y', 2, '2024-02-18 15:22:47', '2024-02-18 15:43:25', 1, 'Y');

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
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_project`
--

INSERT INTO `user_project` (`id`, `user_id`, `project_id`, `updated_at`) VALUES
(1, 2, '1,2,4,5', '2024-02-18 14:39:43'),
(2, 3, '2', '2024-02-18 14:45:39'),
(3, 4, '', '0000-00-00 00:00:00'),
(4, 5, '', '0000-00-00 00:00:00');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
