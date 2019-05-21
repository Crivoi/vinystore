-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2019 at 01:11 PM
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
  `id_user` int(11) NOT NULL,
  `artist` varchar(20) NOT NULL,
  `album` varchar(20) NOT NULL,
  `label` varchar(20) NOT NULL,
  `catalogue` varchar(8) NOT NULL,
  `genre` varchar(100) NOT NULL,
  `cond` varchar(10) NOT NULL,
  `price` int(11) NOT NULL,
  `date_added` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `records`
--

INSERT INTO `records` (`id_record`, `id_user`, `artist`, `album`, `label`, `catalogue`, `genre`, `cond`, `price`, `date_added`) VALUES
(1, 0, 'ARTIST_TEST_1', 'ALBUM_TEST_1', 'LABEL_TEST_1', 'TEST001', 'HOUSE', 'M', 100, '2019-05-18'),
(2, 0, 'ARTIST_TEST_2', 'ALBUM_TEST_2', 'LABEL_TEST_2', 'TEST001', 'TECHNO', 'VG', 120, '2019-05-18'),
(3, 0, 'ARTIST_TEST_3', 'ALBUM_TEST_3', 'LABEL_TEST_3', 'TEST003', 'HOUSE', 'M', 100, '2019-05-18'),
(4, 0, 'ARTIST_TEST_1', 'ALBUM_TEST_1', 'LABEL_TEST_1', 'TEST001', 'HOUSE', 'M', 100, '2019-05-18'),
(5, 0, 'ARTIST_TEST_1', 'ALBUM_TEST_1', 'LABEL_TEST_1', 'TEST001', 'HOUSE', 'M', 100, '2019-05-18'),
(6, 0, 'ARTIST_TEST_6', 'ALBUM_TEST_6', 'LABEL_TEST_6', 'TEST001', 'HOUSE', 'M', 120, '2019-05-18'),
(7, 1, 'ARTIST_TEST_2', 'ALBUM_TEST_2', 'LABEL_TEST_2', 'TEST002', 'HOUSE', 'M', 120, '2019-05-18'),
(8, 0, 'ARTIST_TEST_1', 'ALBUM_TEST_1', 'LABEL_TEST_1', 'TEST001', 'HOUSE', 'M', 100, '2019-05-21'),
(9, 0, 'ARTIST_TEST_1', 'ALBUM_TEST_1', 'LABEL_TEST_1', 'TEST001', 'HOUSE', 'M', 100, '2019-05-21'),
(10, 0, 'ARTIST_TEST_1', 'ALBUM_TEST_1', 'LABEL_TEST_1', 'TEST001', 'HOUSE', 'M', 100, '2019-05-21'),
(11, 0, 'ARTIST_TEST_1', 'ALBUM_TEST_1', 'LABEL_TEST_1', 'TEST001', 'HOUSE', 'M', 100, '2019-05-21');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `age` int(11) NOT NULL,
  `address` varchar(100) NOT NULL,
  `postal_code` varchar(10) NOT NULL,
  `phone_nr` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `email`, `first_name`, `last_name`, `age`, `address`, `postal_code`, `phone_nr`) VALUES
(1, 'user1', 'pass1', 'email_test@test.com', 'first', 'last', 20, 'str. garii', '100100', '+40723456789');

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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `records`
--
ALTER TABLE `records`
  MODIFY `id_record` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
