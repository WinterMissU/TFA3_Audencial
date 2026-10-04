-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 04, 2026 at 07:20 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tfa3`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `full_name`, `email`, `phone`, `created_at`) VALUES
(1, 'Alex Rivera', 'alex.rivera@example.com', '09170000001', '2026-09-30 09:00:00'),
(2, 'Sam Cruz', 'sam.cruz@example.com', '09170000002', '2026-09-30 09:15:00'),
(3, 'Jamie Santos', 'jamie.santos@example.com', '09170000003', '2026-09-30 09:30:00'),
(4, 'Pat Reyes', 'pat.reyes@example.com', '09170000004', '2026-09-30 09:45:00'),
(5, 'Taylor Lim', 'taylor.lim@example.com', '09170000005', '2026-09-30 10:00:00'),
(6, 'Fuji Nangungulila', 'studyantengromantiko@gmail.com', '0945613280', '0000-00-00 00:00:00'),
(7, 'Jean Vilouge', 'balagbagnastudyante@yahoo.com', '0912345678', '0000-00-00 00:00:00'),
(8, 'Rene Todd', 'mabaitnastudyante@gmail.com', '0923456789', '2026-10-04 04:01:20');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `avatar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `full_name`, `created_at`, `avatar`) VALUES
(1, 'arivera', 'Alex Rivera', '2026-09-30 09:00:00', NULL),
(2, 'scruz', 'Sam Cruz', '2026-09-30 09:15:00', NULL),
(3, 'jsantos', 'Jamie Santos', '2026-09-30 09:30:00', NULL),
(4, 'preyes', 'Pat Reyes', '2026-09-30 09:45:00', NULL),
(5, 'tlim', 'Taylor Lim', '2026-09-30 10:00:00', '8a4be6f50a044c11362697940eed57fb.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
