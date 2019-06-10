-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2019 at 03:57 PM
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
-- Table structure for table `artists`
--

CREATE TABLE `artists` (
  `id_artist` int(11) NOT NULL,
  `artist_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `artists`
--

INSERT INTO `artists` (`id_artist`, `artist_name`) VALUES
(1, '0'),
(2, '0'),
(3, '0'),
(4, '0'),
(5, 'ARTIST_TEST_1'),
(6, 'ARTIST_TEST_1'),
(7, 'ARTIST_TEST_1');

-- --------------------------------------------------------

--
-- Table structure for table `labels`
--

CREATE TABLE `labels` (
  `id_label` int(11) NOT NULL,
  `label_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `labels`
--

INSERT INTO `labels` (`id_label`, `label_name`) VALUES
(1, '0'),
(2, '0'),
(3, '0'),
(4, '0'),
(5, 'ARTIST_TEST_1'),
(6, 'ARTIST_TEST_1');

-- --------------------------------------------------------

--
-- Table structure for table `my_records`
--

CREATE TABLE `my_records` (
  `id_item` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_record` int(11) NOT NULL,
  `date_added` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `my_records`
--

INSERT INTO `my_records` (`id_item`, `id_user`, `id_record`, `date_added`) VALUES
(0, 2, 27, '2019-06-05'),
(0, 2, 27, '2019-06-05'),
(0, 2, 28, '2019-06-05'),
(0, 1, 30, '2019-06-09'),
(0, 24, 31, '2019-06-10'),
(0, 24, 32, '2019-06-10'),
(0, 24, 33, '2019-06-10'),
(0, 24, 34, '2019-06-10'),
(0, 24, 35, '2019-06-10'),
(0, 24, 36, '2019-06-10'),
(0, 24, 37, '2019-06-10'),
(0, 24, 38, '2019-06-10'),
(0, 24, 39, '2019-06-10');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id_order` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_record` int(11) NOT NULL,
  `date_placed` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id_order`, `id_user`, `id_record`, `date_placed`) VALUES
(1, 24, 9, '2019-06-10'),
(2, 24, 10, '2019-06-10'),
(3, 24, 11, '2019-06-10'),
(4, 24, 13, '2019-06-10');

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
(14, 0, 'ARTIST_TEST_1', 'ALBUM_TEST_1', 'LABEL_TEST_1', 'TEST001', 'HOUSE', 'M', 100, '2019-05-23'),
(15, 0, 'ARTIST_TEST_1', 'ALBUM_TEST_1', 'LABEL_TEST_1', 'TEST001', 'HOUSE', 'M', 100, '2019-05-23'),
(16, 0, 'ARTIST_TEST_1', 'ALBUM_TEST_1', 'LABEL_TEST_1', 'TEST001', 'HOUSE', 'M', 100, '2019-05-23'),
(17, 0, 'ARTIST_TEST_1', 'ALBUM_TEST_1', 'LABEL_TEST_1', 'TEST001', 'HOUSE', 'M', 100, '2019-05-23'),
(18, 0, 'ARTIST_TEST_1', 'ALBUM_TEST_1', 'LABEL_TEST_1', 'TEST001', 'HOUSE', 'M', 100, '2019-05-23'),
(20, 0, 'ARTIST_TEST_1', 'ALBUM_TEST_1', 'LABEL_TEST_1', 'TEST001', 'HOUSE', 'M', 100, '2019-05-23'),
(21, 0, 'ARTIST_TEST_1', 'ALBUM_TEST_1', 'LABEL_TEST_1', 'TEST001', 'HOUSE', 'M', 100, '2019-05-23'),
(22, 0, 'ARTIST_TEST_1', 'ALBUM_TEST_1', 'LABEL_TEST_1', 'TEST001', 'HOUSE', 'M', 100, '2019-05-23'),
(23, 0, 'ARTIST_TEST_1', 'ALBUM_TEST_1', 'LABEL_TEST_1', 'TEST001', 'HOUSE', 'M', 100, '2019-05-23'),
(24, 0, 'ARTIST_TEST_1', 'ALBUM_TEST_1', 'LABEL_TEST_1', 'TEST001', 'HOUSE', 'M', 100, '2019-05-23'),
(25, 0, 'ARTIST_TEST_10', 'ALBUM_TEST_1', 'LABEL_TEST_1', 'TEST001', 'HOUSE', 'M', 100, '2019-05-30'),
(27, 0, 'ARTIST_TEST_1', 'ALBUM_TEST_1', 'LABEL_TEST_1', 'TEST001', 'HOUSE', 'M', 100, '2019-06-05'),
(28, 2, 'ARTIST_TEST_1', 'ALBUM_TEST_1', 'LABEL_TEST_1', 'TEST001', 'HOUSE', 'M', 100, '2019-06-05'),
(29, 2, 'ARTIST_TEST_1', 'ALBUM_TEST_1', 'LABEL_TEST_1', 'TEST001', 'HOUSE', 'M', 100, '2019-06-05'),
(30, 1, 'ARTIST_TEST_1', 'ALBUM_TEST_1', 'LABEL_TEST_1', 'TEST001', 'HOUSE', 'M', 100, '2019-06-09'),
(31, 24, 'ARTIST_TEST_1', 'ALBUM_TEST_1', 'LABEL_TEST_1', 'TEST001', 'HOUSE', 'M', 100, '2019-06-10'),
(32, 24, 'mike t', 'ALBUM_TEST_1', 'amphia', 'TEST001', 'HOUSE', 'M', 100, '2019-06-10'),
(33, 24, 'ARTIST_TEST_1', 'ALBUM_TEST_1', 'LABEL_TEST_1', 'TEST001', 'HOUSE', 'M', 100, '2019-06-10'),
(34, 24, 'ARTIST_TEST_1', 'ALBUM_TEST_1', 'LABEL_TEST_1', 'TEST001', 'HOUSE', 'M', 100, '2019-06-10'),
(35, 24, 'asdfasf', 'ALBUM_TEST_1', 'LABEL_TEST_1', 'TEST001', 'HOUSE', 'M', 100, '2019-06-10'),
(36, 24, 'ARTIST_TEST_1', 'ALBUM_TEST_1', 'LABEL_TEST_1', 'TEST001', 'HOUSE', 'M', 100, '2019-06-10'),
(37, 24, 'ARTIST_TEST_1', 'ALBUM_TEST_1', 'LABEL_TEST_1', 'TEST001', 'HOUSE', 'M', 100, '2019-06-10'),
(38, 24, 'ARTIST_TEST_1', 'ALBUM_TEST_1', 'LABEL_TEST_1', 'TEST001', 'HOUSE', 'M', 100, '2019-06-10'),
(39, 24, 'ARTIST_TEST_1', 'ALBUM_TEST_1', 'LABEL_TEST_1', 'TEST001', 'HOUSE', 'M', 100, '2019-06-10');

-- --------------------------------------------------------

--
-- Table structure for table `shopping_cart`
--

CREATE TABLE `shopping_cart` (
  `id_cart` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_record` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tokens`
--

CREATE TABLE `tokens` (
  `username` varchar(30) NOT NULL,
  `token` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tokens`
--

INSERT INTO `tokens` (`username`, `token`) VALUES
('ss', '4848229df9243888f8a70e96ce6f0a4ac0e1a299'),
('ss', 'b5ec28a4fe76d4220f0a4a5f304992ac0cc82cf0');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(33) NOT NULL,
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
(1, 'user1', 'pass1', 'email_test@test.com', 'first', 'last', 20, 'str. garii', '100100', '+40723456789'),
(2, 'mike', '9f9d51bc70ef21ca5c14', 'bob@gmail.com', 'Bob', 'Bobber', 25, 'Bob Str.', '101010', '+40723124123'),
(3, 'bob', '9f9d51bc70ef21ca5c14', 'bob@gmail.com', 'Bob', 'Bobber', 25, 'Bob Str.', '101010', '+40723124123'),
(4, 'bob1', '9f9d51bc70ef21ca5c14', 'bob@gmail.com', 'Bob', 'Bobber', 25, 'Bob Str.', '101010', '+40723124123'),
(5, 'blb', '9f9d51bc70ef21ca5c14', 'bob@gmail.com', 'Bob', 'Bobber', 25, 'Bob Str.', '101010', '+40723124123'),
(6, 'bobber', '9f9d51bc70ef21ca5c14', 'bob@gmail.com', 'Bob', 'Bobber', 25, 'Bob Str.', '101010', '+40723124123'),
(7, 'bobatus', '9f9d51bc70ef21ca5c14', 'bob@gmail.com', 'Bob', 'Bobber', 25, 'Bob Str.', '101010', '+40723124123'),
(8, 'bobafet', '9f9d51bc70ef21ca5c14', 'bob@gmail.com', 'Bob', 'Bobber', 25, 'Bob Str.', '101010', '+40723124123'),
(9, 'bobbenus', '9f9d51bc70ef21ca5c14', 'bob@gmail.com', 'Bob', 'Bobber', 25, 'Bob Str.', '101010', '+40723124123'),
(10, 'boberman', '9f9d51bc70ef21ca5c14', 'bob@gmail.com', 'Bob', 'Bobber', 25, 'Bob Str.', '101010', '+40723124123'),
(11, 'bobitza', '9f9d51bc70ef21ca5c14', 'bob@gmail.com', 'Bob', 'Bobber', 25, 'Bob Str.', '101010', '+40723124123'),
(12, 'bobeanu', '9f9d51bc70ef21ca5c14', 'bob@gmail.com', 'Bob', 'Bobber', 25, 'Bob Str.', '101010', '+40723124123'),
(13, 'bobitza01', '9f9d51bc70ef21ca5c14', 'bob@gmail.com', 'Bob', 'Bobber', 25, 'Bob Str.', '101010', '+40723124123'),
(14, 'bobolo', '9f9d51bc70ef21ca5c14', 'bob@gmail.com', 'Bob', 'Bobber', 25, 'Bob Str.', '101010', '+40723124123'),
(15, 'bobmike', '9f9d51bc70ef21ca5c14', 'bob@gmail.com', 'Bob', 'Bobber', 25, 'Bob Str.', '101010', '+40723124123'),
(16, 'bob11', '9f9d51bc70ef21ca5c14', 'bob@gmail.com', 'Bob', 'Bobber', 25, 'Bob Str.', '101010', '+40723124123'),
(17, 'bob123', '9f9d51bc70ef21ca5c14', 'bob@gmail.com', 'Bob', 'Bobber', 25, 'Bob Str.', '101010', '+40723124123'),
(18, 'bob123141', '9f9d51bc70ef21ca5c14', 'bob@gmail.com', 'Bob', 'Bobber', 25, 'Bob Str.', '101010', '+40723124123'),
(19, 'bobleau', '9f9d51bc70ef21ca5c14', 'bob@gmail.com', 'Bob', 'Bobber', 25, 'Bob Str.', '101010', '+40723124123'),
(20, 'bobeaasfa', '9f9d51bc70ef21ca5c14', 'bob@gmail.com', 'Bob', 'Bobber', 25, 'Bob Str.', '101010', '+40723124123'),
(21, 'bob12415q241123', '9f9d51bc70ef21ca5c14', 'bob@gmail.com', 'Bob', 'Bobber', 25, 'Bob Str.', '101010', '+40723124123'),
(22, 'bobasdfasff', '9f9d51bc70ef21ca5c14', 'bob@gmail.com', 'Bob', 'Bobber', 25, 'Bob Str.', '101010', '+40723124123'),
(23, 'bobasc', '9f9d51bc70ef21ca5c14f307980a29d8', 'bob@gmail.com', 'Bob', 'Bobber', 25, 'Bob Str.', '101010', '+40723124123'),
(24, 'crivu', '26b1bc56dc2bb08c6a7a27984b502ca9', 'crivu@gmail.com', 'Crivu', 'Crivu', 21, 'Crivu Str.', '101010', '+40723124123');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id_wish` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_record` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artists`
--
ALTER TABLE `artists`
  ADD PRIMARY KEY (`id_artist`);

--
-- Indexes for table `labels`
--
ALTER TABLE `labels`
  ADD PRIMARY KEY (`id_label`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_order`);

--
-- Indexes for table `records`
--
ALTER TABLE `records`
  ADD PRIMARY KEY (`id_record`),
  ADD KEY `id_record` (`id_record`);

--
-- Indexes for table `shopping_cart`
--
ALTER TABLE `shopping_cart`
  ADD PRIMARY KEY (`id_cart`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id_wish`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `artists`
--
ALTER TABLE `artists`
  MODIFY `id_artist` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `labels`
--
ALTER TABLE `labels`
  MODIFY `id_label` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `records`
--
ALTER TABLE `records`
  MODIFY `id_record` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `shopping_cart`
--
ALTER TABLE `shopping_cart`
  MODIFY `id_cart` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id_wish` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
