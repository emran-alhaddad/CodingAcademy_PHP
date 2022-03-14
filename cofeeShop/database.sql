-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 14, 2022 at 10:38 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `cofeeshope`
--
CREATE DATABASE IF NOT EXISTS `cofeeshope` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `cofeeshope`;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_ID` int(6) UNSIGNED NOT NULL,
  `cat_name` varchar(30) NOT NULL,
  `description` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_ID`, `cat_name`, `description`) VALUES
(1, 'Light', '                        It is essentially brewed coffee from coffee grounds\r\nIt does not contain any added ingredients\r\nsuch as milk, creamer, sugar, or condensed milk.                      '),
(5, 'Category 2', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Earum ad quidem dolores corporis odio beatae laudantium soluta, quo hic incidunt maxime, saepe non perspiciatis facilis tenetur quos necessita'),
(11, 'Category 55', 'ABCD');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `ID` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `logo` varchar(200) NOT NULL,
  `Price` varchar(20) NOT NULL,
  `description` varchar(200) NOT NULL,
  `categoryID` int(6) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`ID`, `name`, `logo`, `Price`, `description`, `categoryID`) VALUES
(5, 'White Coffee Beans', '1637354396_arbiccoffee.jpeg', '1$', '                        It is essentially brewed coffee from coffee grounds\r\nIt does not contain any added ingredients\r\nsuch as milk, creamer, sugar, or condensed milk.                      ', 1),
(19, 'djfhghdfgdh', '1647170540_US Dollar_80px.png', '150', ';lkjrmlkerfldfjnmlkdf', 11);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_ID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `categoryID` (`categoryID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_ID` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`categoryID`) REFERENCES `category` (`cat_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;
