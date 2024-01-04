-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2023 at 11:42 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `votingfull`
--

-- --------------------------------------------------------

--
-- Table structure for table `category_list`
--

CREATE TABLE `category_list` (
  `id` int(30) NOT NULL,
  `category` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category_list`
--

INSERT INTO `category_list` (`id`, `category`) VALUES
(6, 'President'),
(11, 'Vice President - Internal Affairs'),
(12, 'Vice President - External Affairs'),
(13, 'Executive Secretary'),
(14, 'Associate Secretary'),
(15, 'Executive Treasurer'),
(16, 'Associate Treasurer'),
(17, 'Auditors'),
(18, 'Business Managers'),
(19, 'Public Relation - Internal Affairs'),
(20, 'Public Relation - External Affairs'),
(21, 'Representative from every Year'),
(22, 'Cabinet Members');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(30) NOT NULL,
  `name` varchar(200) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 2 COMMENT '1+admin , 2 = users',
  `has_voted` tinyint(1) DEFAULT 0,
  `picture_path` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `type`, `has_voted`, `picture_path`) VALUES
(1, 'Administrator', '01-2359-235', 'admin', 1, 0, 'image/3.png'),
(23, 'Daruis Perez', '20-1251-151', '', 2, 0, ''),
(24, 'Jennybie Jacoba', '20-8733-317', '', 2, 1, ''),
(30, 'sample', '01-1111-111', '', 2, 1, 'image/7.png'),
(53, 'markjonas', '123', '', 2, 1, 'image/perps logo.png'),
(55, 'sample2', '412', '', 2, 1, ''),
(58, 'markjonas', '77', '', 2, 1, ''),
(59, 'mark jonas21', '88', '', 2, 1, ''),
(60, 'sample6', '11', '', 2, 1, 'image/123.PNG'),
(61, 'markjonas', '66', '', 2, 1, 'image/admin1.PNG'),
(62, 'jon', '55', '', 2, 1, 'image/ki1.PNG'),
(63, 'Administrator', '10-2300-411', 'administrator', 1, 0, 'image/3.png');

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `id` int(255) NOT NULL,
  `voting_id` int(255) NOT NULL,
  `category_id` int(255) NOT NULL,
  `voting_opt_id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`id`, `voting_id`, `category_id`, `voting_opt_id`, `user_id`) VALUES
(1, 1, 1, 1, 3),
(2, 1, 3, 5, 3),
(3, 1, 4, 6, 3),
(4, 1, 4, 7, 3),
(5, 1, 4, 8, 3),
(6, 1, 4, 9, 3),
(7, 1, 1, 3, 4),
(8, 1, 3, 12, 4),
(9, 1, 4, 6, 4),
(10, 1, 4, 8, 4),
(11, 1, 4, 10, 4),
(12, 1, 4, 11, 4),
(13, 1, 1, 3, 5),
(14, 1, 3, 5, 5),
(15, 1, 4, 6, 5),
(16, 1, 4, 7, 5),
(17, 1, 4, 8, 5),
(18, 1, 4, 9, 5),
(19, 6, 6, 20, 6),
(20, 6, 6, 20, 11),
(21, 9, 6, 26, 14),
(22, 9, 6, 26, 16),
(23, 9, 6, 26, 15),
(24, 9, 6, 26, 17),
(25, 9, 6, 26, 18),
(26, 9, 6, 26, 13),
(27, 9, 6, 27, 19),
(28, 9, 6, 27, 20),
(29, 9, 6, 27, 21),
(30, 11, 6, 33, 22),
(31, 11, 6, 33, 22),
(32, 11, 6, 33, 22),
(33, 10, 6, 35, 24),
(34, 17, 6, 47, 13),
(35, 17, 6, 47, 25),
(36, 17, 6, 47, 11),
(37, 17, 6, 47, 28),
(38, 17, 6, 47, 29),
(39, 17, 6, 47, 31),
(40, 16, 6, 45, 32),
(41, 17, 6, 47, 33),
(42, 17, 7, 49, 33),
(43, 17, 9, 52, 33),
(44, 17, 6, 47, 33),
(45, 17, 7, 50, 33),
(46, 17, 9, 51, 33),
(47, 17, 6, 48, 32),
(48, 17, 7, 50, 32),
(49, 17, 9, 51, 32),
(50, 16, 6, 45, 33),
(51, 16, 6, 46, 33),
(52, 16, 6, 46, 32),
(53, 16, 6, 45, 24),
(54, 16, 6, 45, 34),
(55, 19, 6, 61, 38),
(56, 19, 6, 61, 39),
(57, 19, 6, 61, 40),
(58, 19, 6, 61, 45),
(59, 19, 6, 61, 46),
(60, 16, 6, 45, 53),
(61, 16, 11, 66, 53),
(62, 16, 12, 67, 53),
(63, 16, 6, 65, 54),
(64, 16, 11, 66, 54),
(65, 16, 12, 67, 54),
(66, 16, 6, 65, 55),
(67, 16, 11, 66, 55),
(68, 16, 12, 67, 55),
(69, 16, 6, 45, 59),
(70, 16, 11, 66, 59),
(71, 16, 12, 67, 59),
(72, 16, 6, 65, 60),
(73, 16, 11, 66, 60),
(74, 16, 12, 67, 60),
(75, 16, 6, 65, 61),
(76, 16, 11, 66, 61),
(77, 16, 12, 67, 61),
(78, 16, 6, 65, 62),
(79, 16, 11, 66, 62),
(80, 16, 12, 67, 62);

-- --------------------------------------------------------

--
-- Table structure for table `voting_cat_settings`
--

CREATE TABLE `voting_cat_settings` (
  `id` int(30) NOT NULL,
  `voting_id` int(30) NOT NULL,
  `category_id` int(30) NOT NULL,
  `max_selection` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `voting_cat_settings`
--

INSERT INTO `voting_cat_settings` (`id`, `voting_id`, `category_id`, `max_selection`) VALUES
(1, 1, 1, 1),
(2, 1, 3, 1),
(3, 1, 4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `voting_list`
--

CREATE TABLE `voting_list` (
  `id` int(30) NOT NULL,
  `title` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `time_duration` time NOT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `voting_list`
--

INSERT INTO `voting_list` (`id`, `title`, `description`, `time_duration`, `is_default`) VALUES
(16, 'Homeroom for CSS', 'for css', '24:00:00', 1),
(17, 'Supreme Student Council', 'for Perpetual help college of Pangasinan', '00:00:00', 0),
(18, 'Sample', 'sample', '00:00:00', 0),
(21, 'Circuit Builder Student Council', 'For CCS only ', '24:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `voting_logs`
--

CREATE TABLE `voting_logs` (
  `id` int(11) NOT NULL,
  `voter_id` int(11) DEFAULT NULL,
  `candidate_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `voting_opt`
--

CREATE TABLE `voting_opt` (
  `id` int(30) NOT NULL,
  `voting_id` int(30) NOT NULL,
  `category_id` int(30) NOT NULL,
  `image_path` text NOT NULL,
  `opt_txt` text NOT NULL,
  `motto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `voting_opt`
--

INSERT INTO `voting_opt` (`id`, `voting_id`, `category_id`, `image_path`, `opt_txt`, `motto`) VALUES
(18, 5, 7, '1661957820_1.jpg', 'victor', ''),
(19, 5, 7, '1661957820_2.jpg', 'sam', ''),
(20, 6, 6, '1699425000_dark-theme-16.jpg', 'jonas', ''),
(21, 6, 6, '1699425000_dark-theme-16.jpg', 'angelica', ''),
(23, 8, 6, '1700134980_dark-theme-16.jpg', 'jonas', ''),
(24, 8, 6, '1700135040_dark-theme-16.jpg', 'admin admin admin', ''),
(25, 8, 7, '1700135040_dark-theme-16.jpg', '1', ''),
(26, 9, 6, '1700207040_dark-theme-16.jpg', 'jonas', ''),
(27, 9, 6, '1700207100_dark-theme-16.jpg', 'Mark jonas Macasieb', ''),
(33, 11, 6, '1700217480_dark-theme-16.jpg', 'jonas panoringan macasieb', ''),
(35, 10, 6, '1700356020_1.png', 'Mary', ''),
(36, 10, 6, '1700356080_2.png', 'Janet', ''),
(37, 10, 7, '1700356080_3.png', 'Harold', ''),
(39, 10, 7, '1700356200_4.png', 'John', ''),
(40, 10, 9, '1700356260_5.png', 'Kath', ''),
(41, 10, 9, '1700356260_6.png', 'Kate', ''),
(42, 0, 0, '', '', ''),
(43, 0, 0, '', '', ''),
(44, 0, 0, '', '', ''),
(45, 16, 6, '1700529960_dark-theme-16.jpg', 'joas', ''),
(47, 17, 6, '1700530800_1.png', 'kate', ''),
(48, 17, 6, '1700530800_6.png', 'mary', ''),
(49, 17, 7, '1700530860_3.png', 'harold', ''),
(50, 17, 7, '1700530860_4.png', 'jake', ''),
(51, 17, 9, '1700530920_7.png', 'jane', ''),
(52, 17, 9, '1700530980_5.png', 'joan', ''),
(54, 18, 6, '1700535780_2.png', 'jennybie', ''),
(55, 18, 6, '1700535780_6.png', 'Angelica', ''),
(56, 18, 7, '1700535840_3.png', 'jonas', ''),
(57, 18, 7, '1700535840_4.png', 'Daruis', ''),
(58, 18, 9, '1700535960_7.png', 'Franciene', ''),
(60, 18, 9, '1700536020_4.png', 'Albert', ''),
(61, 19, 6, '1701476700_sample krizza.jpg', 'harold', ''),
(62, 19, 6, '1701476700_krizza1.jpg', 'Albert', ''),
(64, 16, 7, '1701485100_krizza.jpg', 'harold', ''),
(65, 16, 6, '1701485100_krizza full.jpg', 'Albert', ''),
(66, 16, 11, '1701651360_123.PNG', 'dada', ''),
(67, 16, 12, '1701651420_1.PNG', 'Albert', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category_list`
--
ALTER TABLE `category_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `voting_cat_settings`
--
ALTER TABLE `voting_cat_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `voting_list`
--
ALTER TABLE `voting_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `voting_logs`
--
ALTER TABLE `voting_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `voting_opt`
--
ALTER TABLE `voting_opt`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category_list`
--
ALTER TABLE `category_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `voting_cat_settings`
--
ALTER TABLE `voting_cat_settings`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `voting_list`
--
ALTER TABLE `voting_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `voting_logs`
--
ALTER TABLE `voting_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `voting_opt`
--
ALTER TABLE `voting_opt`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
