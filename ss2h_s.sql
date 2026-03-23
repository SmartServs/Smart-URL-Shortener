-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 23, 2025 at 01:24 PM
-- Server version: 8.0.37
-- PHP Version: 8.3.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ss2h_s`
--

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int NOT NULL,
  `setting_key` varchar(100) NOT NULL,
  `setting_value` varchar(255) NOT NULL,
  `site_name` varchar(255) DEFAULT NULL,
  `meta_description` text,
  `meta_keywords` text,
  `site_status` enum('active','inactive') DEFAULT 'active',
  `about_page` text,
  `privacy_policy` text,
  `footer_rights` text,
  `redirect_delay` int DEFAULT '5'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `setting_key`, `setting_value`, `site_name`, `meta_description`, `meta_keywords`, `site_status`, `about_page`, `privacy_policy`, `footer_rights`, `redirect_delay`) VALUES
(1, 'redirect_delay', '1', 'SS2H', 'SS2H', 'SS2H', 'active', NULL, NULL, NULL, 5);

-- --------------------------------------------------------

--
-- Table structure for table `urls`
--

CREATE TABLE `urls` (
  `id` int NOT NULL,
  `original_url` text NOT NULL,
  `short_code` varchar(10) NOT NULL,
  `user_id` int DEFAULT NULL,
  `visits` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `urls`
--

INSERT INTO `urls` (`id`, `original_url`, `short_code`, `user_id`, `visits`) VALUES
(91, 'https://ss2h.com////', 'ImPgMG', NULL, 0),
(92, 'https://ss2h.com////', 'EjM4Lb', NULL, 0),
(93, 'https://ss2h.com////', 'cT2IVs', NULL, 0),
(94, 'https://ss2h.com////', 'D6nd2O', NULL, 0),
(95, 'https://google.com', 'QYVoud', NULL, 0),
(96, 'https://google.com', 'kaEnV3', NULL, 0),
(97, 'https://ss2h.com/pvXw5B', 'ZsBlkg', NULL, 0),
(98, 'https://www.youm7.com/story/2025/4/22/تخفيف-الأعباء-عن-المستثمرين-رسالة-طمأنة-تعزز-تنافسية-الاقتصاد/6962598', '5oVHP3', NULL, 1),
(99, 'https://ss2h.com////', 'RC9luf', NULL, 0),
(100, 'https://ss2h.com////', 'm9F08Y', NULL, 11),
(101, 'https://www.youm7.com/story/2025/4/22/تخفيف-الأعباء-عن-المستثمرين-رسالة-طمأنة-تعزز-تنافسية-الاقتصاد/6962598', 'OpioBE', NULL, 0),
(102, 'https://www.youm7.com/story/2025/4/22/تخفيف-الأعباء-عن-المستثمرين-رسالة-طمأنة-تعزز-تنافسية-الاقتصاد/6962598', 'cwPDY4', NULL, 1),
(103, 'https://ss2h.com////', 'eQSk0B', NULL, 0),
(104, 'https://www.youm7.com/story/2025/4/22/تخفيف-الأعباء-عن-المستثمرين-رسالة-طمأنة-تعزز-تنافسية-الاقتصاد/6962598', 'QY0ghz', NULL, 0),
(105, 'https://ss2h.com////', 'aKBPZL', NULL, 0),
(106, 'https://ss2h.com////', 'zqT02h', NULL, 1),
(107, 'https://ss2h.com////', 'kWfL0w', NULL, 0),
(108, 'https://ss2h.com////', 'IhOX8j', NULL, 0),
(109, 'https://www.youm7.com/story/2025/4/22/تخفيف-الأعباء-عن-المستثمرين-رسالة-طمأنة-تعزز-تنافسية-الاقتصاد/6962598', 'PRqwCr', NULL, 0),
(110, 'https://ss2h.com////', 'nJR4TL', NULL, 21),
(112, 'https://ss2h.com////', 'pNFLU1', NULL, 0),
(113, 'https://cp.zomro.com/support/requests/1268431', 'Kw4ktz', NULL, 3),
(114, 'https://ss2h.com/', 'veyPJV', NULL, 0),
(115, 'https://ss2h.com/', 'hzXU3M', NULL, 1),
(116, 'https://ss2h.com/index.php', 'idoExl', NULL, 1),
(117, 'https://ss2h.com/index.php', 'Gu1YTz', NULL, 2),
(118, 'https://ss2h.com/', 'hHIBRy', NULL, 0),
(119, 'https://ss2h.com/', '8Zr7vB', NULL, 1),
(120, 'https://ss2h.com/', 'GVpNMu', NULL, 2),
(121, 'https://smartservs.com/%d8%b9%d8%b1%d8%b6-%d8%a7%d9%84%d8%b9%d9%8a%d8%af-1-%d8%ae%d8%b5%d9%85-50-%d8%b9%d9%84%d9%89-%d8%ac%d9%85%d9%8a%d8%b9-%d8%ae%d8%b7%d8%b7-%d8%a7%d8%b3%d8%aa%d8%b6%d8%a7%d9%81%d8%a9-%d8%a7%d9%84/', 'ILShKa', NULL, 24),
(122, 'https://smartservs.com/%d8%b9%d8%b1%d8%b6-%d8%a7%d9%84%d8%b9%d9%8a%d8%af-2-%d8%ae%d8%b5%d9%85-50-%d8%b9%d9%84%d9%89-%d8%ac%d9%85%d9%8a%d8%b9-%d8%ae%d8%b7%d8%b7-%d8%a7%d9%84%d8%b1%d9%8a%d8%b3%d9%84%d8%b1/', '3UqOVS', NULL, 11),
(123, 'https://smartservs.com/%d8%b9%d8%b1%d8%b6-%d8%a7%d9%84%d8%b9%d9%8a%d8%af-3-%d8%ae%d8%b5%d9%85-50-%d8%b9%d9%84%d9%89-%d8%ac%d9%85%d9%8a%d8%b9-%d8%ae%d8%b7%d8%b7-%d8%a7%d9%84%d8%b3%d9%8a%d8%b1%d9%81%d8%b1%d8%a7%d8%aa-vps/', 'HIEWmz', NULL, 7),
(124, 'https://smartservs.com/%d8%b9%d8%b1%d8%b6-%d8%a7%d9%84%d8%b9%d9%8a%d8%af-4-%d8%ae%d8%b5%d9%85-50-%d8%b9%d9%84%d9%89-%d8%ac%d9%85%d9%8a%d8%b9-%d8%ae%d8%b7%d8%b7-%d8%ad%d8%b1%d8%a8-%d8%a7%d9%84%d8%aa%d8%aa%d8%a7%d8%b1/', 'f2KzIl', NULL, 18),
(125, 'https://smartservs.com/%d8%b9%d8%b1%d8%b6-%d8%a7%d9%84%d8%b9%d9%8a%d8%af-5-%d8%ae%d8%b5%d9%85-50-%d8%b9%d9%84%d9%89-%d8%ac%d9%85%d9%8a%d8%b9-%d8%ae%d8%b7%d8%b7-%d8%a7%d8%b9%d8%af%d8%a7%d8%af-%d9%88%d8%a7%d8%af%d8%a7/', 'm5i7Mb', NULL, 6),
(126, 'https://smartservs.com/%d8%b9%d8%b1%d8%b6-%d8%a7%d9%84%d8%b9%d9%8a%d8%af-6-%d8%ae%d8%b5%d9%85-50-%d8%b9%d9%84%d9%89-%d8%ac%d9%85%d9%8a%d8%b9-%d8%ae%d8%b7%d8%b7-%d8%a7%d9%86%d8%b4%d8%a7%d8%a1-%d8%a7%d9%84%d9%85%d8%aa/', 'jGZUNB', NULL, 10);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'admin', 'admin@ss2h.com', '$2y$10$JlDuhIqiACMKn7zTlDj/Ru5mg/h16C/NNb2KHx1R1J2wdha0ewTNG', 'admin', '2025-04-21 22:29:22'),
(2, 'smart', 'smartservs.com@gmail.com', '$2y$10$a21eVhJ1K9JVZ/JgvK0pJeydlMDRgzGRfSmPWXEr63sE4NQdXSO1C', 'user', '2025-04-21 22:38:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `setting_key` (`setting_key`);

--
-- Indexes for table `urls`
--
ALTER TABLE `urls`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `short_code` (`short_code`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `urls`
--
ALTER TABLE `urls`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
