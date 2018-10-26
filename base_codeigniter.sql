-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2017 at 01:31 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `base_codeigniter`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(255) NOT NULL,
  `admin_name` varchar(100) NOT NULL,
  `admin_email` varchar(100) NOT NULL,
  `admin_password` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('0','1') DEFAULT '0',
  `admin_ip` int(39) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `admin_email`, `admin_password`, `created_at`, `updated_at`, `status`, `admin_ip`) VALUES
(1, 'akgarg007', 'admin@demo.com', '123', '2017-11-19 10:56:52', '2017-11-19 10:56:52', '0', 0);

-- --------------------------------------------------------

--
-- Table structure for table `datatabledata`
--

CREATE TABLE `datatabledata` (
  `id` int(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `datatabledata`
--

INSERT INTO `datatabledata` (`id`, `name`, `email`, `phone`, `created_at`) VALUES
(1, 'user1', 'user1@demo.com', '321456798', '2017-12-01 05:56:10'),
(2, 'user2', 'user2@demo.com', '2316456498', '2017-12-01 05:56:29'),
(5, 'ashwani garg', 'ashwani.codesoftic@gmail.com', '9660025446', '2017-12-01 07:08:17'),
(4, 'qwewqe afsdf', 'qkgarg@jfj.com', '9660025446', '2017-12-01 06:37:20'),
(6, 'qwewqe afsdf', 'qkgarg@jfj.com', '123', '2017-12-01 07:15:51'),
(7, 'qwewqe afsdf', 'qkgarg@jfj.com', '123', '2017-12-01 07:15:53'),
(8, 'ashwani garg', 'ashwani.codesoftic@gmail.com', '9660025446', '2017-12-01 07:17:10'),
(9, 'ashwani garg', 'ashwani.codesoftic@gmail.com', '9660025446', '2017-12-01 07:18:03'),
(10, 'ashwani garg', 'ashwani.codesoftic@gmail.com', '9660025446', '2017-12-01 07:18:59');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(255) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('0','1') NOT NULL DEFAULT '0',
  `user_ip` int(39) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_password`, `created_at`, `updated_at`, `status`, `user_ip`) VALUES
(1, 'akgarg', 'user@demo.com', '123', '2017-11-21 15:53:27', '2017-11-21 15:53:27', '0', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `datatabledata`
--
ALTER TABLE `datatabledata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `datatabledata`
--
ALTER TABLE `datatabledata`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
