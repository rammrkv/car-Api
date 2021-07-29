-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 30, 2021 at 01:23 AM
-- Server version: 5.7.33-0ubuntu0.16.04.1
-- PHP Version: 7.2.27-6+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `car_api_task`
--

-- --------------------------------------------------------

--
-- Table structure for table `car_details`
--

CREATE TABLE `car_details` (
  `car_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `brand` varchar(100) NOT NULL,
  `model` varchar(100) NOT NULL,
  `model_year` int(11) NOT NULL,
  `colour` varchar(50) NOT NULL,
  `registration_no` varchar(20) NOT NULL,
  `mileage_drove` int(11) NOT NULL,
  `status` enum('A','IA','D') NOT NULL,
  `is_published` enum('Y','N') NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `car_details`
--

INSERT INTO `car_details` (`car_id`, `user_id`, `brand`, `model`, `model_year`, `colour`, `registration_no`, `mileage_drove`, `status`, `is_published`, `created_at`, `updated_at`) VALUES
(2, 1, 'Hundai', 'Santro', 2012, 'red', 'TN57S1235', 1256, 'A', 'Y', '2021-07-27 20:22:29', '2021-07-27 20:22:29'),
(3, 5, 'Honda', 'city', 2010, 'silver', 'TN57S1234', 1256, 'A', 'Y', '2021-07-27 20:59:28', '2021-07-27 20:59:28'),
(4, 1, 'Toyota', 'Etios', 2008, 'balck', 'TN57S2344', 1256, 'IA', 'Y', '2021-07-27 21:07:08', '2021-07-27 21:07:08'),
(5, 5, 'Toyota', 'Etios', 2008, 'balck', 'TN57S2144', 1256, 'A', 'Y', '2021-07-27 21:08:20', '2021-07-27 21:08:20'),
(6, 1, 'Honda', 'Fortuner', 2010, 'silver', 'TN57S1239', 1256, 'A', 'Y', '2021-07-27 21:10:00', '2021-07-27 21:11:16'),
(7, 6, 'Maruthi', 'Swift', 2018, 'balck', 'TN57S1144', 1256, 'A', 'Y', '2021-07-28 09:11:13', '2021-07-28 09:12:26');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `user_id` int(11) NOT NULL,
  `fisrt_name` varchar(150) NOT NULL,
  `last_name` varchar(150) NOT NULL,
  `email_id` varchar(150) NOT NULL,
  `password` varchar(250) NOT NULL,
  `user_status` enum('A','IA','D') NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`user_id`, `fisrt_name`, `last_name`, `email_id`, `password`, `user_status`, `created_at`, `updated_at`) VALUES
(1, 'sam', 'anderson', 'rammrkv@gmail.com', '$2y$10$Hc9J3.5Z828khTqjzphumerWSxjyOTydwsZXphEO.jtm4dGZ5fWBu', 'A', '2021-07-27 18:29:17', '2021-07-27 18:29:17'),
(5, 'jhon', 'mick', 'test@test.com', '$2y$10$DXj6RvmgWSM3R/e3sq5dDe4/BrWJu0srUSOJOMPaGDVqCTRG0k9Em', 'A', '2021-07-27 19:05:59', '2021-07-27 19:05:59'),
(6, 'steve', 'smith', 'test123@gmail.com', '$2y$10$EpgYupbh7/A1SeTwwkWHTe8D6FA6ggu0g1lnCV4LkJgH08c593E0C', 'A', '2021-07-27 20:14:47', '2021-07-27 20:14:47'),
(7, 'jhon', 'mick', 'rammrkv3@gmail.com', '$2y$10$XbIex8P7zAIzZ03O27n3F.Y/sBAZUZqWynhMBx1FrUU7enljUSt.a', 'A', '2021-07-29 19:39:58', '2021-07-29 19:39:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `car_details`
--
ALTER TABLE `car_details`
  ADD PRIMARY KEY (`car_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `registration_no` (`registration_no`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `car_details`
--
ALTER TABLE `car_details`
  MODIFY `car_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
