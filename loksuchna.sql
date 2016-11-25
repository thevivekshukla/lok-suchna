-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 19, 2016 at 09:03 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `loksuchna`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `aid` int(11) NOT NULL,
  `firstName` varchar(30) NOT NULL,
  `lastName` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL,
  `registration_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`aid`, `firstName`, `lastName`, `username`, `email`, `password`, `registration_date`) VALUES
(1, 'Vivek', 'Shukla', 'admin', 'viv3kshukla@gmail.com', '$2y$12$3FPu8joBtLeRIpUcXiU76OYp5kH5zPaEX6oSSGCSx4sndDGYevUQi', '2016-04-09 06:47:20');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `pid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `image_name` varchar(150) NOT NULL,
  `title` varchar(80) NOT NULL,
  `description` varchar(500) NOT NULL,
  `city` varchar(60) NOT NULL,
  `upload_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`pid`, `uid`, `image_name`, `title`, `description`, `city`, `upload_date`) VALUES
(13, 1, '1460154168a40204210cd5e2537947d2b32f798909.jpg', 'new', 'ok this is new', 'raipur', '2016-04-08 22:22:48');

-- --------------------------------------------------------

--
-- Table structure for table `temp_posts`
--

CREATE TABLE `temp_posts` (
  `pid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `image_name` varchar(150) NOT NULL,
  `title` varchar(80) NOT NULL,
  `description` varchar(500) NOT NULL,
  `city` varchar(60) NOT NULL,
  `upload_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `temp_posts`
--

INSERT INTO `temp_posts` (`pid`, `uid`, `image_name`, `title`, `description`, `city`, `upload_date`) VALUES
(15, 1, '1460186123Apariencia_de_Itachi_Uchiha.png', 'sdkfl', 'djfs', 'raipur', '2016-04-09 07:15:23'),
(16, 1, '1460186133284122.jpg', 'vivksdjl', 'dsfkjsl', 'raipur', '2016-04-09 07:15:33');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` int(11) NOT NULL,
  `firstName` varchar(30) NOT NULL,
  `lastName` varchar(30) NOT NULL,
  `gender` text NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(60) NOT NULL,
  `registration_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `firstName`, `lastName`, `gender`, `email`, `password`, `registration_date`) VALUES
(1, 'vivek', 'shukla', 'Male', 'viv3kshukla@gmail.com', '$2y$10$4jG8rfQ2GQVsIxTH6eXrtu7vVbEeH7cmW5b4J7.ZIYI4lxrl0TP4m', '2016-04-08 06:28:57'),
(2, 'Vivek', 'Shukla', 'Male', 'viv3kshukla@g.com', '$2y$10$KfSqw8V3yHoqCePyTjQ3hOuGesCTv95xV6Fv8iLzANp8BeKH3ntwG', '2016-06-08 01:53:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD UNIQUE KEY `pid` (`pid`);

--
-- Indexes for table `temp_posts`
--
ALTER TABLE `temp_posts`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `aid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `temp_posts`
--
ALTER TABLE `temp_posts`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
