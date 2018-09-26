-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 26, 2018 at 12:11 PM
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
-- Database: `kajal_ci`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `br_id` int(11) NOT NULL,
  `br_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`br_id`, `br_name`) VALUES
(1, 'killer jeans'),
(2, 'puma'),
(3, 'addidas'),
(4, 'fasttract\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `ca_id` int(11) NOT NULL,
  `ca_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`ca_id`, `ca_name`) VALUES
(1, 'kids wear'),
(2, 'mens wear'),
(3, 'womens wear'),
(4, 'Accessories');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `login_id` int(11) NOT NULL,
  `login_name` varchar(100) NOT NULL,
  `login_mobile` bigint(100) NOT NULL,
  `login_email` varchar(100) NOT NULL,
  `login_password` varchar(100) NOT NULL,
  `login_status` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`login_id`, `login_name`, `login_mobile`, `login_email`, `login_password`, `login_status`) VALUES
(1, 'dsfdsf', 9987119945, 'kajalyerunkar11@gmail.com', '', 1),
(2, 'vaishali', 7045216888, 'vaishali11@gmail.com', '244eae073ac4d35fecd9b2bb820c9db2e3239e94', 1),
(3, 'neelam', 7045216888, 'neelamsoni11@gmail.com', '3acd0be86de7dcccdbf91b20f94a68cea535922d', 1),
(4, 'kajal', 9987119945, 'kajalyerunkar10@gmail.com', '00fd4b4549a1094aae926ef62e9dbd3cdcc2e456', 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `p_id` int(11) NOT NULL,
  `p_name` varchar(100) NOT NULL,
  `p_amt` int(11) NOT NULL,
  `p_discount` int(11) NOT NULL,
  `p_caid` int(11) NOT NULL,
  `p_brid` int(11) NOT NULL,
  `p_desc` varchar(100) NOT NULL,
  `p_imgpath` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`p_id`, `p_name`, `p_amt`, `p_discount`, `p_caid`, `p_brid`, `p_desc`, `p_imgpath`) VALUES
(1, 'mens wear', 5000, 2500, 2, 2, 'mens wear from puma', 'uploads/product2.jpg'),
(3, 'womens wear', 4000, 1000, 3, 3, 'womens wear from addidas', 'uploads/product3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `uemail` varchar(200) NOT NULL,
  `upass` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `uemail`, `upass`) VALUES
(2, 'kajalyerunkar12@gmail.in', '77bce9fb18f977ea576bbcd143b2b521073f0cd6'),
(5, 'kajalyerunkar132@gmail.com', 'e35c40fa93058307ebf2a177fa96472589e34b14'),
(6, 'kajalyerunkar122@gmail.in', '0674ee05e3e05232a0fe7e9fe12100c72561fb8d'),
(7, 'kajalyerunkar000@gmail.com', '04f081741466827161bede82a374af0ec9a39e31'),
(8, 'kajalyerunkar00099@gmail.com', '42cfe854913594fe572cb9712a188e829830291f');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`br_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`ca_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`login_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `br_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `ca_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
