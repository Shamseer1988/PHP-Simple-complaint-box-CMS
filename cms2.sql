-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2022 at 12:32 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms2`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `adminName` varchar(252) CHARACTER SET latin1 NOT NULL,
  `adminEmail` varchar(252) CHARACTER SET latin1 NOT NULL,
  `password` varchar(252) CHARACTER SET latin1 NOT NULL,
  `creationDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `updationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `adminName`, `adminEmail`, `password`, `creationDate`, `updationDate`, `status`) VALUES
(101, 'Admin', 'admin@gmail.com', 'Master123', '2022-01-15 18:21:34', '2022-01-15 18:32:55', 1);

-- --------------------------------------------------------

--
-- Table structure for table `complaintremark`
--

CREATE TABLE `complaintremark` (
  `id` int(11) NOT NULL,
  `compNum` int(11) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `remark` mediumtext NOT NULL,
  `remarkDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `rmUser` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `prductId` int(6) UNSIGNED NOT NULL,
  `productName` varchar(30) NOT NULL,
  `productDescription` varchar(250) NOT NULL,
  `productRegDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `lastUpdationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`prductId`, `productName`, `productDescription`, `productRegDate`, `lastUpdationDate`) VALUES
(1, 'SAMSUNG A8', ' from samsung family', '2022-01-20 11:20:07', '2022-01-20 11:20:07');

-- --------------------------------------------------------

--
-- Table structure for table `tblcomplaints`
--

CREATE TABLE `tblcomplaints` (
  `complaintNumber` int(6) NOT NULL,
  `userId` int(6) NOT NULL,
  `product` int(6) NOT NULL,
  `complaintType` varchar(30) NOT NULL,
  `complaintDetails` mediumtext NOT NULL,
  `complaintFile` varchar(250) DEFAULT NULL,
  `regDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(50) DEFAULT NULL,
  `replay` int(1) NOT NULL,
  `lastUpdationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblcomplaints`
--

INSERT INTO `tblcomplaints` (`complaintNumber`, `userId`, `product`, `complaintType`, `complaintDetails`, `complaintFile`, `regDate`, `status`, `replay`, `lastUpdationDate`) VALUES
(1, 1, 1, 'General Query', ' test complaint', '', '2022-01-20 11:21:14', NULL, 0, '2022-01-20 11:21:14');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(225) CHARACTER SET latin1 DEFAULT NULL,
  `userFName` varchar(250) CHARACTER SET swe7 NOT NULL,
  `userSName` varchar(250) CHARACTER SET latin1 NOT NULL,
  `userEmail` varchar(225) CHARACTER SET latin1 DEFAULT NULL,
  `userMobile` varchar(250) CHARACTER SET latin1 NOT NULL,
  `userDist` varchar(250) CHARACTER SET latin1 NOT NULL,
  `userState` varchar(250) CHARACTER SET latin1 NOT NULL,
  `userCountry` varchar(250) CHARACTER SET latin1 NOT NULL,
  `password` varchar(225) CHARACTER SET latin1 DEFAULT NULL,
  `userImg` varchar(250) DEFAULT NULL,
  `CreatedDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `lastUpdationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `userFName`, `userSName`, `userEmail`, `userMobile`, `userDist`, `userState`, `userCountry`, `password`, `userImg`, `CreatedDate`, `lastUpdationDate`, `status`) VALUES
(1, 'SHAMSEER', 'Shamseer', 'Makkanamchery', 'shamsee2011@live.com', '77022011', 'Kozhikode', 'Kerala', 'India', 'ead491c29678b63ef95f67d0f331bbe8', 'SHAMSEER_PHOTO.jpg', '2022-01-20 11:20:45', '2022-01-20 11:29:55', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `complaintremark`
--
ALTER TABLE `complaintremark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`prductId`);

--
-- Indexes for table `tblcomplaints`
--
ALTER TABLE `tblcomplaints`
  ADD PRIMARY KEY (`complaintNumber`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `complaintremark`
--
ALTER TABLE `complaintremark`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `prductId` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblcomplaints`
--
ALTER TABLE `tblcomplaints`
  MODIFY `complaintNumber` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
