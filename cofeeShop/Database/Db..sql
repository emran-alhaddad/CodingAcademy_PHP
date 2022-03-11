-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 11, 2022 at 02:24 AM
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
(2, 'Dark2', 'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA\r\nBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBB\r\nCCCCCCCCCCCCCCCCCCCCC\r\n\r\nDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDD\r\n\r\nEEEEEEEEEEEEEEE\r\n               '),
(4, 'Category 1', '                                                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Earum ad quidem dolores corporis odio beatae laudantium soluta, quo hi'),
(5, 'Category 2', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Earum ad quidem dolores corporis odio beatae laudantium soluta, quo hic incidunt maxime, saepe non perspiciatis facilis tenetur quos necessita');

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
(4, 'Black Coffee Beans', '1637335757_blackcoffee.jpeg', '45 SR', 'It is essentially brewed coffee from coffee grounds\r\nIt does not contain any added ingredients\r\nsuch as milk, creamer, sugar, or condensed milk.', 2),
(5, 'White Coffee Beans', '1637354396_arbiccoffee.jpeg', '1$', '                        It is essentially brewed coffee from coffee grounds\r\nIt does not contain any added ingredients\r\nsuch as milk, creamer, sugar, or condensed milk.                      ', 1),
(7, 'Book', '1646781065_book.jpg', '5$', 'It is essentially brewed coffee from coffee grounds\r\nIt does not contain any added ingredients\r\nsuch as milk, creamer, sugar, or condensed milk.                      ', 1),
(8, 'Book', '1646781092_book.jpg', '5SR', 'big book', 1),
(9, 'Book', '1646961209_1638574248_University_96px.png', '5SR', '                        big book                      ', 2);

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
  MODIFY `cat_ID` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`categoryID`) REFERENCES `category` (`cat_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;
