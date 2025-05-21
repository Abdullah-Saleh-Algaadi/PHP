-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 15, 2024 at 05:50 PM
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
-- Database: `my_project_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_ID` int(11) NOT NULL,
  `user_ID` int(11) NOT NULL,
  `product_ID` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_description` text NOT NULL,
  `product_price` decimal(10,2) NOT NULL,
  `product_picture` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_ID`, `user_ID`, `product_ID`, `product_name`, `product_description`, `product_price`, `product_picture`) VALUES
(22, 7, 22, 'Dell XPS 13', 'Sleek and Powerful', 1900.00, '../uploads/Dell XPS 13.png'),
(50, 2, 24, 'HP Spectre x360', 'Versatile and Efficient', 1549.00, '../uploads/HP Spectre x360.png'),
(52, 25, 22, 'Dell XPS 13', 'Sleek and Powerful', 1900.00, '../uploads/Dell XPS 13.png'),
(55, 23, 26, 'Asus ROG Zephyrus', 'High Performance Gaming', 2000.00, '../uploads/Asus ROG Zephyrus.png'),
(57, 6, 25, 'HP Spectre x360', 'LAPTOP 30', 1500.00, '../uploads/Lenovo ThinkPad X1 Carbon.png');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `Product_id` int(11) NOT NULL,
  `Product_name` varchar(255) NOT NULL,
  `Product_description` text DEFAULT NULL,
  `Product_price` decimal(10,2) NOT NULL,
  `Product_picture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`Product_id`, `Product_name`, `Product_description`, `Product_price`, `Product_picture`) VALUES
(22, 'Dell XPS 13', 'Sleek and Powerful', 1900.00, '../uploads/Dell XPS 13.png'),
(23, 'MacBook Air', 'Lightweight and Portable', 2200.00, '../uploads/MacBook Air.png'),
(24, 'HP Spectre x360', 'Versatile and Efficient', 1549.00, '../uploads/HP Spectre x360.png'),
(25, 'HP Spectre x360', 'LAPTOP 30', 1500.00, '../uploads/Lenovo ThinkPad X1 Carbon.png'),
(26, 'Asus ROG Zephyrus', 'High Performance Gaming', 2000.00, '../uploads/Asus ROG Zephyrus.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(50) DEFAULT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(100) DEFAULT NULL,
  `user_type` enum('admin','customer') DEFAULT 'customer'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_password`, `user_type`) VALUES
(1, 'a', 'a', '$2y$10$smbhTY8tSkn8Yym86KKI.OV5OwaTGfIjRzct/h56z49Ii/sh.76ky', 'admin'),
(2, 'Abdullah ALgaadi', 'abdullahsalehali46@gmail.com', '$2y$10$lR7vMv80.fK5BACtnuAZg.oAOKc6QCsnsGsqNQmZ4.smAuyLscM3e', 'customer'),
(4, 'Abdullah', 'Abdullah@gmail.com', '$2y$10$026jH.GV0SobR2sQ3JQp1OQ6nrbuj6.wh6abHF2Gy8wBn00PEs2Ju', 'admin'),
(6, 'saleh', 'saleh46@gmail.com', '$2y$10$5emQQ./BkDrCXCC3SzmAyOvFePvcFdl1.BW8tWbMXa.M2qmiMyO.m', 'customer'),
(7, 'Ahmed', 'ahmed@gmail.com', '$2y$10$gd.6CB3AbrQPR3ABwb2rwu9U5yA/QHKCo33HIOBxCOTdkkogMr4Ee', 'customer'),
(23, 'c', 'c', '$2y$10$XjlkuyNt74/BXEVGLVHBcuSiZL5yhjXwrMcGHoVgR8N0p4fIin0EO', 'customer'),
(24, 'Abdullah', 'AbdullahALgaadi@gmail.com', '$2y$10$UkFM8FFomCZHRLrObpczYup0oNQPjcO9IQKmxIFsUoc0VElxnjEhi', 'admin'),
(25, 'Mohammed', 'mohammed', '$2y$10$tSXqZxRgvDvuP9gsApG1SO2TJVf9aPwRIl511rZYSW6buDGtEcEKi', 'customer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_ID`),
  ADD KEY `user_ID` (`user_ID`),
  ADD KEY `product_ID` (`product_ID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`Product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `Product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`product_ID`) REFERENCES `products` (`Product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
