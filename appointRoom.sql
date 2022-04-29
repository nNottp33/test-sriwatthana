-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Apr 29, 2022 at 09:13 AM
-- Server version: 5.7.34
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `appointRoom`
--

-- --------------------------------------------------------

--
-- Table structure for table `appoint`
--

CREATE TABLE `appoint` (
  `id` int(11) UNSIGNED NOT NULL,
  `roomId` int(3) NOT NULL,
  `booker` varchar(45) NOT NULL,
  `createAt` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `appoint`
--

INSERT INTO `appoint` (`id`, `roomId`, `booker`, `createAt`) VALUES
(2, 1, 'ttttttttt', '1'),
(3, 3, 'd', '1'),
(4, 2, 'd', '1'),
(5, 2, 'd', '1'),
(7, 2, 'd', '1'),
(8, 2, 'd', '1'),
(9, 2, 'd', '1'),
(10, 2, 'd', '1'),
(11, 2, 'test', ''),
(12, 2, 'test', ''),
(13, 2, 'test', ''),
(14, 2, 'test', ''),
(15, 1, 'test', ''),
(16, 1, 'test', ''),
(17, 1, 'test', ''),
(18, 1, 'test', '1651221403');

-- --------------------------------------------------------

--
-- Table structure for table `meetingRoom`
--

CREATE TABLE `meetingRoom` (
  `id` int(11) UNSIGNED NOT NULL,
  `roomName` varchar(45) NOT NULL,
  `roomCapacity` int(3) NOT NULL,
  `createAt` varchar(10) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `meetingRoom`
--

INSERT INTO `meetingRoom` (`id`, `roomName`, `roomCapacity`, `createAt`, `status`) VALUES
(1, 'ห้อง P', 8, '1651075219', 0),
(2, 'ห้อง I', 6, '1651075219', 1),
(3, 'ห้อง E', 30, '1651075219', 0);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2022-04-27-152538', 'App\\Database\\Migrations\\MeetingRoom', 'default', 'App', 1651074585, 1),
(2, '2022-04-27-153037', 'App\\Database\\Migrations\\Appoint', 'default', 'App', 1651074585, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appoint`
--
ALTER TABLE `appoint`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meetingRoom`
--
ALTER TABLE `meetingRoom`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appoint`
--
ALTER TABLE `appoint`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `meetingRoom`
--
ALTER TABLE `meetingRoom`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
