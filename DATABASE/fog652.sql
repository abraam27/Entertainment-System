-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2020 at 07:54 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fog652`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cartID` int(10) NOT NULL,
  `productID` int(10) NOT NULL,
  `qty` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `categoryID` int(10) NOT NULL,
  `categoryName` varchar(100) NOT NULL,
  `categoryType` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `document`
--

CREATE TABLE `document` (
  `documentID` int(10) NOT NULL,
  `documentName` varchar(200) NOT NULL,
  `documentNameTmp` varchar(200) NOT NULL,
  `date` varchar(50) NOT NULL,
  `time` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `fitness`
--

CREATE TABLE `fitness` (
  `fitnessID` int(10) NOT NULL,
  `date` varchar(50) NOT NULL,
  `day` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `fitnessresult`
--

CREATE TABLE `fitnessresult` (
  `fitnessResultID` int(10) NOT NULL,
  `pushupScore` int(5) NOT NULL,
  `bellyScore` int(5) NOT NULL,
  `runningRateScore` int(5) NOT NULL,
  `pullupScore` int(5) NOT NULL,
  `soldierID` int(10) NOT NULL,
  `fitnessID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `holiday`
--

CREATE TABLE `holiday` (
  `holidayID` int(11) NOT NULL,
  `dateOfReturn` varchar(50) NOT NULL,
  `dateOfLastReturn` varchar(50) NOT NULL,
  `timeOfLastReturn` varchar(50) NOT NULL,
  `noOfAwards` int(5) NOT NULL,
  `noOfPenalties` int(5) NOT NULL,
  `soldierID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `orderID` int(50) NOT NULL,
  `orderCode` int(15) NOT NULL,
  `date` varchar(20) NOT NULL,
  `time` varchar(20) NOT NULL,
  `noOfItems` int(10) NOT NULL,
  `totalPrice` double(10,2) NOT NULL,
  `orderType` int(5) NOT NULL,
  `soldierID` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `orderdetails`
--

CREATE TABLE `orderdetails` (
  `orderdetailsID` int(100) NOT NULL,
  `productID` int(10) NOT NULL,
  `qty` int(10) NOT NULL,
  `orderID` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `paymentID` int(10) NOT NULL,
  `soldierID` int(10) NOT NULL,
  `ta2reshaAmount` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productID` int(10) NOT NULL,
  `productCode` int(10) NOT NULL,
  `productName` varchar(50) NOT NULL,
  `qty` int(10) NOT NULL,
  `price` double(10,2) NOT NULL,
  `dateInStock` varchar(20) NOT NULL,
  `categoryID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `serviceID` int(10) NOT NULL,
  `Day` varchar(50) NOT NULL,
  `Date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `servicedetails`
--

CREATE TABLE `servicedetails` (
  `serviceDetailsID` int(10) NOT NULL,
  `type` int(5) NOT NULL,
  `soldierID` int(10) NOT NULL,
  `serviceID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `shooting`
--

CREATE TABLE `shooting` (
  `shootingID` int(11) NOT NULL,
  `date` varchar(50) NOT NULL,
  `day` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `shootingresult`
--

CREATE TABLE `shootingresult` (
  `shootingDetailsID` int(10) NOT NULL,
  `soldierID` int(10) NOT NULL,
  `score` int(5) NOT NULL,
  `shootingID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `soldier`
--

CREATE TABLE `soldier` (
  `soldierID` int(20) NOT NULL,
  `SSN` int(20) NOT NULL,
  `militaryNo` int(20) NOT NULL,
  `soldierName` varchar(20) NOT NULL,
  `address` varchar(100) NOT NULL,
  `district` varchar(20) NOT NULL,
  `city` varchar(20) NOT NULL,
  `phoneNo1` int(15) NOT NULL,
  `phoneNo2` int(15) NOT NULL,
  `maritalStatus` varchar(20) NOT NULL,
  `bloodGroup` varchar(5) NOT NULL,
  `religion` varchar(10) NOT NULL,
  `degree` varchar(10) NOT NULL,
  `battalionNo` int(5) NOT NULL,
  `dateOfBirth` varchar(15) NOT NULL,
  `dateOfRecruitment` varchar(15) NOT NULL,
  `dateOfLayoffs` varchar(15) NOT NULL,
  `code` int(5) NOT NULL,
  `tmam` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userID` int(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `type` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cartID`),
  ADD KEY `productID` (`productID`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryID`);

--
-- Indexes for table `document`
--
ALTER TABLE `document`
  ADD PRIMARY KEY (`documentID`);

--
-- Indexes for table `fitness`
--
ALTER TABLE `fitness`
  ADD PRIMARY KEY (`fitnessID`);

--
-- Indexes for table `fitnessresult`
--
ALTER TABLE `fitnessresult`
  ADD PRIMARY KEY (`fitnessResultID`),
  ADD KEY `soldierID` (`soldierID`),
  ADD KEY `fitnessID` (`fitnessID`);

--
-- Indexes for table `holiday`
--
ALTER TABLE `holiday`
  ADD PRIMARY KEY (`holidayID`),
  ADD KEY `soldierID` (`soldierID`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`orderID`),
  ADD UNIQUE KEY `orderCode` (`orderCode`),
  ADD KEY `soldierID` (`soldierID`);

--
-- Indexes for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD PRIMARY KEY (`orderdetailsID`),
  ADD KEY `orderID` (`orderID`),
  ADD KEY `productID` (`productID`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`paymentID`),
  ADD KEY `soldierID` (`soldierID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productID`),
  ADD UNIQUE KEY `productCode` (`productCode`),
  ADD KEY `categoryID` (`categoryID`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`serviceID`);

--
-- Indexes for table `servicedetails`
--
ALTER TABLE `servicedetails`
  ADD PRIMARY KEY (`serviceDetailsID`),
  ADD KEY `serviceID` (`serviceID`),
  ADD KEY `soldierID` (`soldierID`);

--
-- Indexes for table `shooting`
--
ALTER TABLE `shooting`
  ADD PRIMARY KEY (`shootingID`);

--
-- Indexes for table `shootingresult`
--
ALTER TABLE `shootingresult`
  ADD PRIMARY KEY (`shootingDetailsID`),
  ADD KEY `shootingID` (`shootingID`),
  ADD KEY `soldierID` (`soldierID`);

--
-- Indexes for table `soldier`
--
ALTER TABLE `soldier`
  ADD PRIMARY KEY (`soldierID`),
  ADD UNIQUE KEY `SSN` (`SSN`),
  ADD UNIQUE KEY `militaryNo` (`militaryNo`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cartID` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `categoryID` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `document`
--
ALTER TABLE `document`
  MODIFY `documentID` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `fitness`
--
ALTER TABLE `fitness`
  MODIFY `fitnessID` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `fitnessresult`
--
ALTER TABLE `fitnessresult`
  MODIFY `fitnessResultID` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `holiday`
--
ALTER TABLE `holiday`
  MODIFY `holidayID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `orderID` int(50) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `orderdetails`
--
ALTER TABLE `orderdetails`
  MODIFY `orderdetailsID` int(100) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `paymentID` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productID` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `serviceID` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `servicedetails`
--
ALTER TABLE `servicedetails`
  MODIFY `serviceDetailsID` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `shooting`
--
ALTER TABLE `shooting`
  MODIFY `shootingID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `shootingresult`
--
ALTER TABLE `shootingresult`
  MODIFY `shootingDetailsID` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `soldier`
--
ALTER TABLE `soldier`
  MODIFY `soldierID` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`productID`) REFERENCES `product` (`productID`);

--
-- Constraints for table `fitnessresult`
--
ALTER TABLE `fitnessresult`
  ADD CONSTRAINT `fitnessresult_ibfk_1` FOREIGN KEY (`soldierID`) REFERENCES `soldier` (`soldierID`),
  ADD CONSTRAINT `fitnessresult_ibfk_2` FOREIGN KEY (`fitnessID`) REFERENCES `fitness` (`fitnessID`);

--
-- Constraints for table `holiday`
--
ALTER TABLE `holiday`
  ADD CONSTRAINT `holiday_ibfk_1` FOREIGN KEY (`soldierID`) REFERENCES `soldier` (`soldierID`);

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`soldierID`) REFERENCES `soldier` (`soldierID`);

--
-- Constraints for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD CONSTRAINT `orderdetails_ibfk_1` FOREIGN KEY (`orderID`) REFERENCES `order` (`orderID`),
  ADD CONSTRAINT `orderdetails_ibfk_2` FOREIGN KEY (`productID`) REFERENCES `product` (`productID`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`soldierID`) REFERENCES `soldier` (`soldierID`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`categoryID`) REFERENCES `category` (`categoryID`);

--
-- Constraints for table `servicedetails`
--
ALTER TABLE `servicedetails`
  ADD CONSTRAINT `servicedetails_ibfk_1` FOREIGN KEY (`serviceID`) REFERENCES `service` (`serviceID`),
  ADD CONSTRAINT `servicedetails_ibfk_2` FOREIGN KEY (`soldierID`) REFERENCES `soldier` (`soldierID`);

--
-- Constraints for table `shootingresult`
--
ALTER TABLE `shootingresult`
  ADD CONSTRAINT `shootingresult_ibfk_1` FOREIGN KEY (`shootingID`) REFERENCES `shooting` (`shootingID`),
  ADD CONSTRAINT `shootingresult_ibfk_2` FOREIGN KEY (`soldierID`) REFERENCES `soldier` (`soldierID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
