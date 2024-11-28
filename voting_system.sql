-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2024 at 02:02 PM
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
-- Database: `voting_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `email`) VALUES
(1, 'Aleksandra Jovanovska', 'aleksandra@example.com'),
(2, 'Stojan Stojanovski', 'stojan@example.com'),
(3, 'Jane Janevski', 'jane@example.com'),
(4, 'Sara Sareska', 'sara@example.com'),
(5, 'Teo Teoski', 'Teo@example.com'),
(6, 'Mila Mileska', 'Mila@example.com');

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `id` int(11) NOT NULL,
  `voter_id` int(11) NOT NULL,
  `nominee_id` int(11) NOT NULL,
  `category` enum('Makes Work Fun','Team Player','Culture Champion','Difference Maker') NOT NULL,
  `comment` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`id`, `voter_id`, `nominee_id`, `category`, `comment`, `timestamp`) VALUES
(1, 1, 2, 'Makes Work Fun', 'good developer', '2024-11-28 10:34:34'),
(2, 1, 2, 'Makes Work Fun', 'good developer', '2024-11-28 10:36:59'),
(3, 1, 4, 'Team Player', 'team ', '2024-11-28 10:38:33'),
(4, 1, 4, 'Team Player', 'team ', '2024-11-28 10:43:50'),
(5, 1, 2, 'Makes Work Fun', 'fghfghgf', '2024-11-28 10:44:05'),
(6, 1, 5, 'Team Player', 'teo is good team player\r\n', '2024-11-28 10:51:06'),
(7, 1, 5, 'Team Player', 'teo is good team player\r\n', '2024-11-28 10:56:26'),
(8, 1, 2, 'Makes Work Fun', 'sfdsfsd', '2024-11-28 10:56:43'),
(9, 1, 3, 'Team Player', 'dassad', '2024-11-28 10:58:08'),
(10, 1, 3, 'Team Player', 'dsdad', '2024-11-28 10:59:20'),
(11, 1, 2, 'Difference Maker', 'asdasd', '2024-11-28 11:02:53'),
(12, 1, 2, 'Culture Champion', 'sdfsfds', '2024-11-28 11:03:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `voter_id` (`voter_id`),
  ADD KEY `nominee_id` (`nominee_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `votes`
--
ALTER TABLE `votes`
  ADD CONSTRAINT `votes_ibfk_1` FOREIGN KEY (`voter_id`) REFERENCES `employees` (`id`),
  ADD CONSTRAINT `votes_ibfk_2` FOREIGN KEY (`nominee_id`) REFERENCES `employees` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
