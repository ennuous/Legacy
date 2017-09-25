-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 25, 2017 at 02:03 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lbpserver`
--

-- --------------------------------------------------------

--
-- Table structure for table `usercomments`
--

CREATE TABLE `usercomments` (
  `id` int(64) NOT NULL,
  `npHandle` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `timestamp` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `message` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `thumbsup` int(64) NOT NULL,
  `thumbsdown` int(64) NOT NULL,
  `yourthumb` int(64) NOT NULL,
  `deleted` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `deletedBy` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `deletedType` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `index_id` int(11) NOT NULL,
  `foruser` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usercomments`
--

INSERT INTO `usercomments` (`id`, `npHandle`, `timestamp`, `message`, `thumbsup`, `thumbsdown`, `yourthumb`, `deleted`, `deletedBy`, `deletedType`, `index_id`, `foruser`) VALUES
(1, 'Infrnyl', '1506286802382', 'g', 0, 0, 0, 'true', 'moderator', 'moderator', 1, 'Infrnyl'),
(2, 'Infrnyl', '1506286946806', 'gggg', 0, 0, 0, 'true', 'Infrnyl', 'user', 2, 'Infrnyl');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `npHandle` tinytext CHARACTER SET utf8 COLLATE utf8_bin,
  `biography` text CHARACTER SET utf8 COLLATE utf8_bin,
  `heartCount` mediumint(9) DEFAULT NULL,
  `commentCount` int(11) NOT NULL,
  `favouriteUserCount` int(11) NOT NULL,
  `Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`npHandle`, `biography`, `heartCount`, `commentCount`, `favouriteUserCount`, `Id`) VALUES
('SackO_oBoy-_-', 'It\'s all fair game.', 0, 0, 0, 3),
('Zynweis', '', 0, 0, 0, 5),
('Infrnyl', 'BB', 34, 2, 0, 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `usercomments`
--
ALTER TABLE `usercomments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_2` (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Id` (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `usercomments`
--
ALTER TABLE `usercomments`
  MODIFY `id` int(64) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
