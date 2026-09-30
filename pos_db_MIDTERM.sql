-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 30, 2026 at 05:12 PM
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
-- Database: `pos_db`
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
(1, 'Karl Olindo', 'olindo.karl@gmail.com', '09171234567', '2026-09-21 18:08:15'),
(2, 'Andrei dionio', 'dionio.andrei@gmail.com', '09182345678', '2026-09-21 18:08:15'),
(3, 'Ana Reyes', 'ana.reyes@example.com', '09193456789', '2026-09-21 18:08:15'),
(4, 'Mark Bautista', 'mark.bautista@example.com', '09204567890', '2026-09-21 18:08:15'),
(5, 'Elena Garcia', 'elena.garcia@example.com', '09215678901', '2026-09-21 18:08:15');

-- --------------------------------------------------------

--
-- Table structure for table `customerss`
--

CREATE TABLE `customerss` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock_quantity` int(11) NOT NULL DEFAULT 0,
  `image` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `stock_quantity`, `image`, `created_at`) VALUES
(1, 'Dior Sauvage EDP', 120.00, 9, '1790773387_d8af8b86fa5cae0b3ed6.jpg', '2026-09-30 13:03:07'),
(2, 'YSL Y EDP', 120.00, 9, '1790773681_a404aecf28039cfb0d53.jpg', '2026-09-30 13:08:01'),
(3, 'HAWAS ICE', 40.00, 19, '1790779023_ae114f51939c9f45cded.jpg', '2026-09-30 14:37:03'),
(4, 'ODYSSEY MEGA', 40.00, 49, '1790779118_40294293b4cd7bd14319.jpg', '2026-09-30 14:38:38'),
(5, 'RAYHAAN LION', 30.00, 95, '1790779174_cdf186190b37e05b79f6.jpg', '2026-09-30 14:39:34'),
(6, 'CDN URBAN MAN ELIXIR EDP', 70.00, 44, '1790779199_6f0a45436e86ebbe843b.jpg', '2026-09-30 14:39:59');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `sold_by` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `product_id`, `customer_id`, `user_id`, `sold_by`, `quantity`, `total_amount`, `total_price`, `created_at`) VALUES
(6, 1, NULL, NULL, 6, 1, 120.00, 0.00, '2026-09-30 14:31:43'),
(7, 2, 1, NULL, 6, 1, 120.00, 0.00, '2026-09-30 14:31:55'),
(8, 3, 3, NULL, 6, 1, 40.00, 0.00, '2026-09-30 14:40:29'),
(9, 6, NULL, NULL, 6, 2, 140.00, 0.00, '2026-09-30 14:40:38'),
(10, 5, 5, NULL, 6, 5, 150.00, 0.00, '2026-09-30 14:41:03'),
(11, 4, NULL, NULL, 6, 1, 40.00, 0.00, '2026-09-30 14:41:14');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `full_name`, `password`, `avatar`, `created_at`) VALUES
(1, 'admin_xielef', 'Xielef Arcelon Ferareza', '', NULL, '2026-09-21 18:08:15'),
(2, 'mgr_santos', 'Maria Santos', '', NULL, '2026-09-21 18:08:15'),
(3, 'cashier_juan', 'Juan Cruz', '', NULL, '2026-09-21 18:08:15'),
(4, 'clerk_ana', 'Ana Reyes', '', NULL, '2026-09-21 18:08:15'),
(5, 'supervisor_mark', 'Mark Bautista', '', NULL, '2026-09-21 18:08:15'),
(6, 'admin', 'Xielef Arcelon Ferareza', '$2y$12$VIkhUlah28nmKDEQv8pr6e3xDvQ1A.eze08HI.i1pvHPMCvxNIyhy', 'default.png', '2026-09-30 12:28:17');

-- --------------------------------------------------------

--
-- Table structure for table `userss`
--

CREATE TABLE `userss` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customerss`
--
ALTER TABLE `customerss`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `sold_by` (`sold_by`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `userss`
--
ALTER TABLE `userss`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customerss`
--
ALTER TABLE `customerss`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `userss`
--
ALTER TABLE `userss`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sales_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `sales_ibfk_3` FOREIGN KEY (`sold_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
