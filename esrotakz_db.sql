-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 10, 2019 at 07:57 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `esrotakz_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_us`
--

CREATE TABLE `about_us` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `nickname` varchar(191) NOT NULL,
  `about` varchar(191) NOT NULL,
  `profile` varchar(191) NOT NULL,
  `cover` varchar(191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `about_us`
--

INSERT INTO `about_us` (`id`, `name`, `nickname`, `about`, `profile`, `cover`) VALUES
(1, 'Erwin de Jesus', 'Wenog', 'Something about wenog', 'wenog.png', 'esrotakz_cover.png'),
(2, 'Sancho Cabral', 'Cheng', 'Something about Cheng', 'cheng.png', 'esrotakz_cover.png'),
(3, 'Neil Masangkay', 'Oman', 'Something about Oman', 'oman.png', 'esrotakz_cover.png'),
(4, 'Leonard Atajar', 'Dondi', 'Something about Dondi', 'dondi.png', 'esrotakz_cover.png'),
(5, 'Gian Punla', 'Itoy', 'Something about Itoy', 'carlo.png', 'esrotakz_cover.png'),
(6, 'Nelson Panganiban', 'Kuto', 'Something about Kuto', 'kuto.png', 'esrotakz_cover.png'),
(7, 'Melvin Bawit', 'Nivlem', 'Something about Nivlem', 'melvin.png', 'esrotakz_cover.png'),
(8, 'Zeaus Bugay', 'Tebot', 'Something about Tebot', 'tebot.png', 'esrotakz_cover.png'),
(9, 'Jeffrey de Jesus', 'Epoy', 'something about Epoy', 'epoy.png', 'esrotakz_cover.png'),
(10, 'Endrian Atajar', 'Hapon', 'Something about Hapon', 'hapon.png', 'esrotakz_cover.png'),
(11, 'Kevin Holgado', 'Brizkand', 'Something about Brizkand', 'kevin.png', 'esrotakz_cover.png'),
(12, 'Juan Valeros', 'Bong', 'Something about Bong', 'bong.png', 'esrotakz_cover.png'),
(13, 'Ralph Demafelix', 'RR', 'Something about RR', 'rr.png', 'esrotakz_cover.png'),
(14, 'Christian Borromeo', 'Ano', 'Something about Ano', 'ano.png', 'esrotakz_cover.png');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `body` mediumtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(11) UNSIGNED NOT NULL,
  `image` varchar(191) NOT NULL DEFAULT 'no_image.png'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `body`, `created_at`, `updated_at`, `user_id`, `image`) VALUES
(10, 'fdsfdsfsd', 'sdfdsfd', '2018-10-15 08:52:37', '2018-10-15 08:52:37', 0, '5bc45555a72d05.96516979.jpg'),
(11, 'Post Five', 'sdfsdfsd', '2018-10-24 06:46:18', '2018-10-24 06:46:18', 1, '5bd0153a6a5fe4.57310129.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `first_name` varchar(191) NOT NULL,
  `last_name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `username` varchar(191) NOT NULL,
  `password` varchar(191) NOT NULL,
  `profile` varchar(191) NOT NULL DEFAULT 'avatar.png',
  `cover` varchar(191) NOT NULL DEFAULT 'esrotakz_cover.png',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `username`, `password`, `profile`, `cover`, `created_at`, `updated_at`) VALUES
(1, 'Kevin', 'Holgado', 'kevin@genserv-ph.com', 'brizkand', 'e66b30e3823e7e430148c07979a603b0', '5bc96a63161b19.58114072.jpg', 'esrotakz_cover.png', '2018-10-23 02:48:08', '2018-10-23 02:48:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_us`
--
ALTER TABLE `about_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `password` (`password`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
