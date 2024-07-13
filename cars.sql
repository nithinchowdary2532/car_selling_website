-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 11, 2024 at 09:53 PM
-- Server version: 10.11.7-MariaDB
-- PHP Version: 8.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_nithin`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `password`) VALUES
(1, 'admin', '6216f8a75fd5bb3d5f22b6f9958cdede3fc086c2');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `pid`, `name`, `price`, `quantity`, `image`) VALUES
(1, 1, 5, '\\874', 784516, 1, 'images/register_background.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category` varchar(50) NOT NULL,
  `variant` varchar(50) NOT NULL,
  `fuel` varchar(50) NOT NULL,
  `condition` varchar(220) NOT NULL,
  `year` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category`, `variant`, `fuel`, `condition`, `year`, `price`, `image`, `user_id`) VALUES
(8, 'McLaren F1', 'Ferrari', 'Luxury', 'Diesel', '84878', 2019, 1300000.00, 'images/car3.webp', 2),
(9, 'Swift', 'Suzuki', 'Hybrid', 'Diesel', '12452', 2020, 120000.00, 'images/car4.webp', 2),
(10, 'CRETA', 'Hyundai', 'Hybrid', 'Diesel', '124758', 2016, 99998.00, 'images/car1.jpg', 2),
(13, 'Thar', 'Mahindra', 'sedan', 'Diesel', '26158', 2020, 1700000.00, 'images/thar1.webp', 2),
(14, 'Fortuner', 'SUV', 'SUV', 'Petrol', '15515', 2022, 200000.00, 'images/fort.jpg', 2),
(16, 'Polo GT', 'sedan', 'sedan', 'Petrol', '151487', 2016, 551000.00, 'images/polo.webp', 2),
(17, 'Q5', 'Audi', 'Luxury', 'Diesel', '10224', 2022, 3199998.00, 'images/audi1.webp', 2),
(18, 'Q7', 'Audi', 'Luxury', 'Diesel', '15158', 2021, 3500000.00, 'images/audi2.webp', 2),
(19, 'city', 'Honda', 'sedan', 'Petrol', '812892', 2008, 5000000.00, 'images/download.jpg', 5),
(20, 'Dzire', 'Suzuki', 'hatchback', 'Diesel', '25248', 2016, 400000.00, 'dzire.jpgdzire.jpg', 8);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `number` varchar(10) NOT NULL,
  `password` varchar(50) NOT NULL,
  `STATUS` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `number`, `password`, `STATUS`) VALUES
(1, 'chowdary', 'chowdarynithin95@gmail.com', '6304992532', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', NULL),
(2, 'Nithin Chowdary Vaka', 'ns5625@srmist.edu.in', '86521', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 1),
(3, 'Biryani', 'anirudhnaidu41@gmail.com', '74632413', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 1),
(4, '85', '854@gmail.com', '748512', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 1),
(5, 'Meghanand', 'meghs@gmail.com', '9398421099', '4e17a448e043206801b95de317e07c839770c8b8', 1),
(6, 'chandu', 'chandu@gmail.com', '65465465', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 1),
(7, 'Nithin Chowdary', 'nithinchowdary171@gmail.com', '6303209828', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 1),
(8, 'Halekya', 'halekya@gmail.com', '6305248895', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 1),
(9, 'vanangamudi', 'vanangamudii@gmail.com', '9381043367', 'fa70a49cb85c79da77d7f900db3bf527e84d1729', 1),
(10, 'nithin', '123456@gmail.com', '123456', '7c4a8d09ca3762af61e59520943dc26494f8941b', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
