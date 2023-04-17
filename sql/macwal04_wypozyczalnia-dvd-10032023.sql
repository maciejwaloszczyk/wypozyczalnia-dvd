-- phpMyAdmin SQL Dump
-- version 4.9.11
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 10, 2023 at 10:15 AM
-- Server version: 10.3.38-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `macwal04_wypozyczalnia-dvd-test`
--

-- --------------------------------------------------------

--
-- Table structure for table `rental_data`
--

CREATE TABLE `rental_data` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_film` int(11) NOT NULL,
  `isReturned` tinyint(1) NOT NULL,
  `date_of_return` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `email` varchar(60) NOT NULL,
  `privileges` varchar(5) NOT NULL,
  `is_banned` tinyint(1) NOT NULL,
  `is_archived` tinyint(1) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `activation_code` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `privileges`, `is_banned`, `is_archived`, `is_active`, `activation_code`) VALUES
(1, 'administrator', 'admin1', 'admin@kns.pl', 'ADMIN', 0, 0, 1, ''),
(2, 'test', 'test', 'test@test.pl', 'USER', 1, 0, 0, '615691'),
(3, 'waloszczykm', 'Sznupi12', 'maciejwaloszczyk04@gmail.com', 'USER', 0, 0, 1, '798445'),
(4, 'Wolin', '1234', 'krzysztofwolinski04@gmail.com', 'USER', 0, 0, 1, '783370'),
(6, 'dhanulewicz', 'testowy', 'd.hanulewicz@gmail.com', 'USER', 1, 0, 1, '432350'),
(7, 'pan_zminkowski', 'elektryczniak', 'pan_zminkowski@kns.pl', 'ADMIN', 0, 0, 1, ''),
(8, 'frequency', 'asd', 'neyiso1395@proexbol.com', 'USER', 0, 0, 1, '927843'),
(9, 'Tego_typu', 'wypozyczalnia123', 'szymon.roman200@o2.pl', 'USER', 0, 0, 1, '631976'),
(10, '13579M', '55555M', 'malkow1@onet.pl', 'USER', 0, 0, 1, '975263');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` int(11) NOT NULL,
  `title` varchar(60) NOT NULL,
  `genre` varchar(30) NOT NULL,
  `releaseYear` date NOT NULL,
  `director` varchar(60) NOT NULL,
  `photoDirectory` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `dateAdded` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `title`, `genre`, `releaseYear`, `director`, `photoDirectory`, `description`, `dateAdded`) VALUES
(1, '123', 'scfi', '1900-01-01', '123', 'https://upload.wikimedia.org/wikipedia/commons/1/18/Venice_-_Statue_of_a_griffin.jpg', '123345', '2023-03-06'),
(2, 'qwe', 'scfi', '1919-01-01', 'sdad', 'https://i.ytimg.com/vi/DRKg78s23Mo/maxresdefault.jpg', 'dasds', '2023-03-06'),
(3, 'qwe', 'scfi', '1919-01-01', 'sdad', 'xzxc', 'dasds', '2023-03-06'),
(4, 'TEST', 'crime', '2345-01-01', 'TEST', 'TEST', 'TEST', '2023-03-06'),
(5, 'TEST2', 'romance', '1922-01-01', 'TEST2', 'TEST2', 'TEST2', '2023-03-06'),
(6, 'sadaasd', 'comedy', '1903-01-01', 'ASD', 'saas', 'cxzczx', '2023-03-06'),
(7, 'fdsfdsafdsa', 'family', '0000-00-00', 'fdssadffds', 'rewrwe', 'sdfew', '2023-03-06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `rental_data`
--
ALTER TABLE `rental_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `rental_data`
--
ALTER TABLE `rental_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
