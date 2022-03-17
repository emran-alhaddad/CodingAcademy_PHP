-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 17, 2022 at 09:06 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `cart_system`
--
CREATE DATABASE IF NOT EXISTS `cart_system` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `cart_system`;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_price` varchar(50) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `qty` int(10) NOT NULL,
  `total_price` varchar(100) NOT NULL,
  `product_code` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `product_name`, `product_price`, `product_image`, `qty`, `total_price`, `product_code`) VALUES
(40, 'MI Note 5 Pro', '15000', 'mi_note_5_pro.jpg', 1, '15000', 'p1003'),
(41, 'Apple iPhone X', '90000', 'iphone_x.jpg', 8, '720000', 'p1000');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `products` varchar(255) NOT NULL,
  `amount_paid` varchar(100) NOT NULL,
  `card_id` varchar(30) NOT NULL,
  `date` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `name`, `email`, `phone`, `address`, `products`, `amount_paid`, `card_id`, `date`) VALUES
(3, 'Emran AlHaddad', 'alhaddademran@gmail.com', '+967770774255', 'Yemen - Taiz', 'Zenfone Max Pro(2)', '30000', '3003170330', '13/03/2022 07:45:55'),
(4, 'Emran AlHaddad', 'alhaddademran@gmail.com', '+967770774255', 'Yemen - Taiz', 'Zenfone Max Pro(1)', '15000', '3003170330', '13/03/2022 08:18:00'),
(5, 'Emran AlHaddad', 'alhaddademran@gmail.com', '+967770774255', 'Yemen - Taiz', 'Zenfone Max Pro(1)', '15000', '3003170330', '13/03/2022 08:27:23'),
(6, 'Emran AlHaddad', 'alhaddademran@gmail.com', '+967770774255', 'Yemen - Taiz', 'Zenfone Max Pro(1)', '15000', '3003170330', '13/03/2022 08:28:33'),
(7, 'Emran AlHaddad', 'alhaddademran@gmail.com', '+967770774255', 'Yemen - Taiz', 'Zenfone Max Pro(1)', '15000', '3003170330', '13/03/2022 08:29:25'),
(8, 'Emran AlHaddad', 'alhaddademran@gmail.com', '+967770774255', 'Yemen - Taiz', 'Samsung A50(1)', '25000', '3003170330', '13/03/2022 09:12:44'),
(9, 'Emran AlHaddad', 'alhaddademran@gmail.com', '+967770774255', 'Yemen - Taiz', 'Apple iPhone X(9)</li><li>Huawei 10 Pro(1)</li><li>LG v30(1)', '950000', '3003170330', '13/03/2022 09:30:05'),
(10, 'Emran AlHaddad', 'alhaddademran@gmail.com', '+967770774255', 'Yemen - Taiz', 'Zenfone Max Pro(1)', '15000', '3003170330', '15/03/2022 13:26:55'),
(11, 'Emran AlHaddad', 'alhaddademran@gmail.com', '+967770774255', 'Yemen - Taiz', 'MI Note 5 Pro(1)</li><li>LG v30(1)</li><li>Huawei 10 Pro(2)', '230000', '3003170330', '17/03/2022 08:38:52');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` varchar(100) NOT NULL,
  `product_qty` int(11) NOT NULL DEFAULT 1,
  `product_image` varchar(255) NOT NULL,
  `product_code` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `product_name`, `product_price`, `product_qty`, `product_image`, `product_code`) VALUES
(1, 'Apple iPhone X', '90000', 1, 'iphone_x.jpg', 'p1000'),
(2, 'Huawei 10 Pro', '75000', 1, 'huawei_mate10_pro.jpg', 'p1001'),
(3, 'LG v30', '65000', 1, 'lg_v30.jpg', 'p1002'),
(4, 'MI Note 5 Pro', '15000', 1, 'mi_note_5_pro.jpg', 'p1003'),
(5, 'Nokia 7 Plus', '25000', 1, 'nokia_7_plus.jpg', 'p1004'),
(6, 'One Plus 6', '35000', 1, 'one_plus_6.jpg', 'p1005'),
(7, 'Zenfone Max Pro', '15000', 1, 'zenfone_m1.jpg', 'p1006'),
(9, 'Samsung A50', '25000', 1, 'samsung_a50.jpg', 'p1007');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) NOT NULL,
  `card_id` varchar(20) NOT NULL,
  `body` varchar(200) NOT NULL,
  `date` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `card_id`, `body`, `date`) VALUES
(4, '3003170330', 'Emran AlHaddad Paid $15000 For By Zenfone Max Pro(1)', '13/03/2022 08:29:25'),
(5, '3003170330', 'Emran AlHaddad Paid $25000 For By Samsung A50(1)', '13/03/2022 09:12:44'),
(6, '3003170330', 'Emran AlHaddad Paid $950000 For By Apple iPhone X(9)</li><li>Huawei 10 Pro(1)</li><li>LG v30(1)', '13/03/2022 09:30:05'),
(7, '3003170330', 'You Deposite ( $50005 ) To Wallet with Number 3003170330', '14/03/2022 22:07:09'),
(8, '3003170330', 'You Deposite ( $20 ) To Wallet with Number (  )    Now You Have ( $50030 ) In Your Wallet', '14/03/2022 22:11:54'),
(9, '3003170330', 'You Deposite ( $13 ) To Wallet with Number ( 3003170330 )    Now You Have ( $50043 ) In Your Wallet', '14/03/2022 22:12:49'),
(10, '3004477394', 'You Deposite ( $5 ) To Wallet with Number ( 3004477394 )    Now You Have ( $100015 ) In Your Wallet', '14/03/2022 22:16:10'),
(11, '3003170330', 'You Deposite ( $1000 ) To Wallet with Number ( 3003170330 )    Now You Have ( $52043 ) In Your Wallet', '15/03/2022 13:13:24'),
(12, '3003170330', 'You Deposite ( $4000 ) To Wallet with Number ( 3003170330 )    Now You Have ( $59043 ) In Your Wallet', '15/03/2022 13:14:35'),
(13, '3003170330', 'Emran AlHaddad Paid $15000 For By Zenfone Max Pro(1)', '15/03/2022 13:26:55'),
(14, '3003170330', 'You Deposite ( $500000 ) To Wallet with Number ( 3003170330 )    Now You Have ( $544043 ) In Your Wallet', '17/03/2022 08:38:01'),
(15, '3003170330', 'Emran AlHaddad Paid ( $230000 ) For Buy This Products: <ul><li>MI Note 5 Pro(1)</li><li>LG v30(1)</li><li>Huawei 10 Pro(2)</li></ul>', '17/03/2022 08:38:52');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `fullName` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `fullName`, `address`, `phone`, `email`) VALUES
(9, 'EmranCo', 'e72ec440e673e26ca36cc20773048fb5', 'Emran AlHaddad', 'Yemen', '+967770774255', 'alhaddademran@gmail.com'),
(10, 'Osama', '81dc9bdb52d04dc20036dbd8313ed055', 'Osama Al-Wafi', 'Taiz', '777777777', 'osama@gmail.com'),
(11, 'Fatima', '81dc9bdb52d04dc20036dbd8313ed055', 'Fatima Al-mashoor', 'Taiz', '77777777', 'fatima@gmail.com'),
(12, 'Admin', 'e3afed0047b08059d0fada10f400c1e5', 'Admin', 'Yemen', '7777777777', 'admin@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `wallet`
--

CREATE TABLE `wallet` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `card_id` varchar(20) NOT NULL,
  `mony` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wallet`
--

INSERT INTO `wallet` (`id`, `user_id`, `card_id`, `mony`) VALUES
(3, 9, '3003170330', '314043'),
(4, 10, '3004422953', '100'),
(5, 11, '3004477394', '100015');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `wallet`
--
ALTER TABLE `wallet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `wallet`
--
ALTER TABLE `wallet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `wallet`
--
ALTER TABLE `wallet`
  ADD CONSTRAINT `wallet_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;
