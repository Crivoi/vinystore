-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 16, 2019 at 03:31 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vinystore`
--

-- --------------------------------------------------------

--
-- Table structure for table `records`
--

CREATE TABLE `records` (
  `id_record` int(11) NOT NULL,
  `artist` varchar(20) NOT NULL,
  `album` varchar(20) NOT NULL,
  `label` varchar(20) NOT NULL,
  `catalogue` varchar(8) NOT NULL,
  `genre` varchar(100) NOT NULL,
  `cond` varchar(10) NOT NULL,
  `date_added` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `records`
--

INSERT INTO `records` (`id_record`, `artist`, `album`, `label`, `catalogue`, `genre`, `cond`, `date_added`) VALUES
(1, 'A1', 'A1', 'L1', 'C01', 'HOUSE', 'M', '2019-05-16'),
(3, 'ARTIST_TEST_1', 'ALBUM_TEST_1', 'LABEL_TEST_1', 'TEST001', 'HOUSE', 'M', '2019-05-16'),
(4, 'ARTIST_TEST_1', 'ALBUM_TEST_1', 'LABEL_TEST_1', 'TEST001', 'HOUSE', 'M', '2019-05-16'),
(5, 'ARTIST_TEST_1', 'ALBUM_TEST_1', 'LABEL_TEST_1', 'TEST001', 'HOUSE', 'M', '2019-05-16'),
(7, 'ARTIST_TEST_1', 'ALBUM_TEST_1', 'LABEL_TEST_1', 'TEST001', 'HOUSE', 'M', '2019-05-16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `records`
--
ALTER TABLE `records`
  ADD PRIMARY KEY (`id_record`),
  ADD KEY `id_record` (`id_record`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `records`
--
ALTER TABLE `records`
  MODIFY `id_record` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
