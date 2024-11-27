-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 27, 2024 at 05:57 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hrtech`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendanceerrorreport`
--

CREATE TABLE `attendanceerrorreport` (
  `ErrorReportID` int(11) NOT NULL,
  `EmployeeID` int(11) DEFAULT NULL,
  `ErrorDescription` text DEFAULT NULL,
  `ReportDate` date DEFAULT NULL,
  `ResolvedStatus` enum('approved','pending','rejected') DEFAULT 'pending',
  `ResolvedBy` varchar(50) DEFAULT NULL,
  `Attachment` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendanceerrorreport`
--

INSERT INTO `attendanceerrorreport` (`ErrorReportID`, `EmployeeID`, `ErrorDescription`, `ReportDate`, `ResolvedStatus`, `ResolvedBy`, `Attachment`) VALUES
(22, 2, 'lỗi checkin', '2024-11-26', 'pending', NULL, 'Screenshot (767).png'),
(23, 1, 'lỗi checkin quên ', '2024-11-26', 'pending', NULL, 'Screenshot (768).png'),
(24, 1, 'looix checkin ', '2024-11-26', 'pending', NULL, 'Screenshot (767).png');

-- --------------------------------------------------------

--
-- Table structure for table `checkincheckout`
--

CREATE TABLE `checkincheckout` (
  `CheckinCheckoutID` int(11) NOT NULL,
  `CheckinTime` datetime DEFAULT NULL,
  `CheckoutTime` datetime DEFAULT NULL,
  `WorkUnits` int(11) DEFAULT NULL,
  `EmployeeID` int(11) DEFAULT NULL,
  `OvertimeHours` int(11) DEFAULT NULL,
  `OvertimeRate` decimal(10,2) DEFAULT NULL,
  `GPSLocation` varchar(255) NOT NULL,
  `CheckoutLocation` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `checkincheckout`
--

INSERT INTO `checkincheckout` (`CheckinCheckoutID`, `CheckinTime`, `CheckoutTime`, `WorkUnits`, `EmployeeID`, `OvertimeHours`, `OvertimeRate`, `GPSLocation`, `CheckoutLocation`) VALUES
(18, '2024-11-01 08:00:00', '2024-11-01 17:00:00', 8, 2, 2, 50.00, '15.8674882, 108.2733526', '15.8674882, 108.2733526'),
(19, '2024-11-02 08:00:00', '2024-11-02 17:00:00', 8, 2, 0, 50.00, '15.8674882, 108.2733526', '15.8674882, 108.2733526'),
(20, '2024-11-03 08:00:00', '2024-11-03 17:00:00', 8, 2, 2, 50.00, '15.8674882, 108.2733526', '15.8674882, 108.2733526'),
(21, '2024-11-04 08:00:00', '2024-11-04 17:00:00', 8, 2, 2, 50.00, '15.8674882, 108.2733526', '15.8674882, 108.2733526'),
(22, '2024-11-05 08:00:00', '2024-11-05 17:00:00', 8, 2, 2, 50.00, '15.8674882, 108.2733526', '15.8674882, 108.2733526'),
(23, '2024-11-06 08:00:00', '2024-11-06 17:00:00', 8, 2, 1, 50.00, '15.8674882, 108.2733526', '15.8674882, 108.2733526'),
(24, '2024-11-07 08:00:00', '2024-11-07 17:00:00', 8, 2, 2, 50.00, '15.8674882, 108.2733526', '15.8674882, 108.2733526'),
(25, '2024-11-08 08:00:00', '2024-11-08 17:00:00', 8, 2, 1, 50.00, '15.8674882, 108.2733526', '15.8674882, 108.2733526'),
(26, '2024-11-09 08:00:00', '2024-11-09 17:00:00', 8, 2, 0, 50.00, '15.8674882, 108.2733526', '15.8674882, 108.2733526'),
(27, '2024-11-10 08:00:00', '2024-11-10 17:00:00', 8, 2, 2, 50.00, '15.8674882, 108.2733526', '15.8674882, 108.2733526'),
(28, '2024-11-11 08:00:00', '2024-11-11 17:00:00', 8, 2, 0, 50.00, '15.8674882, 108.2733526', '15.8674882, 108.2733526'),
(29, '2024-11-12 08:00:00', '2024-11-12 17:00:00', 8, 2, 3, 50.00, '15.8674882, 108.2733526', '15.8674882, 108.2733526'),
(30, '2024-11-13 08:00:00', '2024-11-13 17:00:00', 8, 2, 1, 50.00, '15.8674882, 108.2733526', '15.8674882, 108.2733526'),
(31, '2024-11-14 08:00:00', '2024-11-14 17:00:00', 8, 2, 2, 50.00, '15.8674882, 108.2733526', '15.8674882, 108.2733526'),
(32, '2024-11-15 08:00:00', '2024-11-15 17:00:00', 8, 2, 1, 50.00, '15.8674882, 108.2733526', '15.8674882, 108.2733526'),
(33, '2024-11-16 08:00:00', '2024-11-16 17:00:00', 8, 2, 3, 50.00, '15.8674882, 108.2733526', '15.8674882, 108.2733526'),
(34, '2024-11-17 08:00:00', '2024-11-17 17:00:00', 8, 2, 3, 50.00, '15.8674882, 108.2733526', '15.8674882, 108.2733526'),
(35, '2024-11-18 08:00:00', '2024-11-18 17:00:00', 8, 2, 0, 50.00, '15.8674882, 108.2733526', '15.8674882, 108.2733526'),
(36, '2024-11-19 08:00:00', '2024-11-19 17:00:00', 8, 2, 2, 50.00, '15.8674882, 108.2733526', '15.8674882, 108.2733526'),
(37, '2024-11-20 08:00:00', '2024-11-20 17:00:00', 8, 2, 1, 50.00, '15.8674882, 108.2733526', '15.8674882, 108.2733526'),
(38, '2024-11-21 08:00:00', '2024-11-21 17:00:00', 8, 2, 1, 50.00, '15.8674882, 108.2733526', '15.8674882, 108.2733526'),
(39, '2024-11-22 08:00:00', '2024-11-22 17:00:00', 8, 2, 0, 50.00, '15.8674882, 108.2733526', '15.8674882, 108.2733526'),
(40, '2024-11-23 08:00:00', '2024-11-23 17:00:00', 8, 2, 2, 50.00, '15.8674882, 108.2733526', '15.8674882, 108.2733526'),
(41, '2024-11-24 08:00:00', '2024-11-24 17:00:00', 8, 2, 3, 50.00, '15.8674882, 108.2733526', '15.8674882, 108.2733526'),
(42, '2024-11-25 08:00:00', '2024-11-25 17:00:00', 8, 2, 3, 50.00, '15.8674882, 108.2733526', '15.8674882, 108.2733526'),
(43, '2024-11-26 08:00:00', '2024-11-26 17:00:00', 8, 2, 0, 50.00, '15.8674882, 108.2733526', '15.8674882, 108.2733526'),
(44, '2024-11-27 08:00:00', '2024-11-27 17:00:00', 8, 2, 0, 50.00, '15.8674882, 108.2733526', '15.8674882, 108.2733526'),
(45, '2024-11-28 08:00:00', '2024-11-28 17:00:00', 8, 2, 1, 50.00, '15.8674882, 108.2733526', '15.8674882, 108.2733526'),
(46, '2024-11-29 08:00:00', '2024-11-29 17:00:00', 8, 2, 0, 50.00, '15.8674882, 108.2733526', '15.8674882, 108.2733526'),
(47, '2024-11-30 08:00:00', '2024-11-30 17:00:00', 8, 2, 1, 50.00, '15.8674882, 108.2733526', '15.8674882, 108.2733526'),
(48, '2024-11-01 08:00:00', '2024-11-01 17:15:00', 8, 1, 2, 50.00, '15.8674882, 108.2733526', '15.8674882, 108.2733526'),
(49, '2024-11-02 08:00:00', '2024-11-02 17:15:00', 8, 1, 3, 50.00, '15.8674882, 108.2733526', '15.8674882, 108.2733526'),
(50, '2024-11-03 08:00:00', '2024-11-03 17:15:00', 8, 1, 2, 50.00, '15.8674882, 108.2733526', '15.8674882, 108.2733526'),
(51, '2024-11-04 08:00:00', '2024-11-04 17:15:00', 8, 1, 0, 50.00, '15.8674882, 108.2733526', '15.8674882, 108.2733526'),
(52, '2024-11-05 08:00:00', '2024-11-05 17:15:00', 8, 1, 0, 50.00, '15.8674882, 108.2733526', '15.8674882, 108.2733526'),
(53, '2024-11-06 08:00:00', '2024-11-06 17:15:00', 8, 1, 0, 50.00, '15.8674882, 108.2733526', '15.8674882, 108.2733526'),
(54, '2024-11-07 08:00:00', '2024-11-07 17:15:00', 8, 1, 1, 50.00, '15.8674882, 108.2733526', '15.8674882, 108.2733526'),
(55, '2024-11-08 08:00:00', '2024-11-08 17:15:00', 8, 1, 3, 50.00, '15.8674882, 108.2733526', '15.8674882, 108.2733526'),
(56, '2024-11-09 08:00:00', '2024-11-09 17:15:00', 8, 1, 1, 50.00, '15.8674882, 108.2733526', '15.8674882, 108.2733526'),
(57, '2024-11-10 08:00:00', '2024-11-10 17:15:00', 8, 1, 1, 50.00, '15.8674882, 108.2733526', '15.8674882, 108.2733526'),
(58, '2024-11-11 08:00:00', '2024-11-11 17:15:00', 8, 1, 3, 50.00, '15.8674882, 108.2733526', '15.8674882, 108.2733526'),
(59, '2024-11-12 08:00:00', '2024-11-12 17:15:00', 8, 1, 3, 50.00, '15.8674882, 108.2733526', '15.8674882, 108.2733526'),
(60, '2024-11-13 08:00:00', '2024-11-13 17:15:00', 8, 1, 1, 50.00, '15.8674882, 108.2733526', '15.8674882, 108.2733526'),
(61, '2024-11-14 08:00:00', '2024-11-14 17:15:00', 8, 1, 1, 50.00, '15.8674882, 108.2733526', '15.8674882, 108.2733526'),
(62, '2024-11-15 08:00:00', '2024-11-15 17:15:00', 8, 1, 3, 50.00, '15.8674882, 108.2733526', '15.8674882, 108.2733526'),
(63, '2024-11-16 08:00:00', '2024-11-16 17:15:00', 8, 1, 0, 50.00, '15.8674882, 108.2733526', '15.8674882, 108.2733526'),
(64, '2024-11-17 08:00:00', '2024-11-17 17:15:00', 8, 1, 2, 50.00, '15.8674882, 108.2733526', '15.8674882, 108.2733526'),
(65, '2024-11-18 08:00:00', '2024-11-18 17:15:00', 8, 1, 0, 50.00, '15.8674882, 108.2733526', '15.8674882, 108.2733526'),
(66, '2024-11-19 08:00:00', '2024-11-19 17:15:00', 8, 1, 3, 50.00, '15.8674882, 108.2733526', '15.8674882, 108.2733526'),
(67, '2024-11-20 08:00:00', '2024-11-20 17:15:00', 8, 1, 2, 50.00, '15.8674882, 108.2733526', '15.8674882, 108.2733526'),
(68, '2024-11-21 08:00:00', '2024-11-21 17:15:00', 8, 1, 3, 50.00, '15.8674882, 108.2733526', '15.8674882, 108.2733526'),
(69, '2024-11-22 08:00:00', '2024-11-22 17:15:00', 8, 1, 1, 50.00, '15.8674882, 108.2733526', '15.8674882, 108.2733526'),
(70, '2024-11-23 08:00:00', '2024-11-23 17:15:00', 8, 1, 3, 50.00, '15.8674882, 108.2733526', '15.8674882, 108.2733526'),
(71, '2024-11-24 08:00:00', '2024-11-24 17:15:00', 8, 1, 2, 50.00, '15.8674882, 108.2733526', '15.8674882, 108.2733526'),
(72, '2024-11-25 08:00:00', '2024-11-25 17:15:00', 8, 1, 3, 50.00, '15.8674882, 108.2733526', '15.8674882, 108.2733526'),
(73, '2024-11-01 08:00:00', '2024-11-01 17:15:00', 8, 13, 3, 50.00, '15.8674882, 108.2733526', '15.8674882, 108.2733526'),
(74, '2024-11-02 08:00:00', '2024-11-02 17:15:00', 8, 13, 0, 50.00, '15.8674882, 108.2733526', '15.8674882, 108.2733526'),
(75, '2024-11-03 08:00:00', '2024-11-03 17:15:00', 8, 13, 2, 50.00, '15.8674882, 108.2733526', '15.8674882, 108.2733526'),
(76, '2024-11-04 08:00:00', '2024-11-04 17:15:00', 8, 13, 3, 50.00, '15.8674882, 108.2733526', '15.8674882, 108.2733526'),
(77, '2024-11-05 08:00:00', '2024-11-05 17:15:00', 8, 13, 1, 50.00, '15.8674882, 108.2733526', '15.8674882, 108.2733526'),
(78, '2024-11-06 08:00:00', '2024-11-06 17:15:00', 8, 13, 2, 50.00, '15.8674882, 108.2733526', '15.8674882, 108.2733526'),
(79, '2024-11-07 08:00:00', '2024-11-07 17:15:00', 8, 13, 3, 50.00, '15.8674882, 108.2733526', '15.8674882, 108.2733526'),
(80, '2024-11-08 08:00:00', '2024-11-08 17:15:00', 8, 13, 1, 50.00, '15.8674882, 108.2733526', '15.8674882, 108.2733526'),
(81, '2024-11-09 08:00:00', '2024-11-09 17:15:00', 8, 13, 0, 50.00, '15.8674882, 108.2733526', '15.8674882, 108.2733526'),
(82, '2024-11-10 08:00:00', '2024-11-10 17:15:00', 8, 13, 1, 50.00, '15.8674882, 108.2733526', '15.8674882, 108.2733526');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `EmployeeID` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `DateOfBirth` date DEFAULT NULL,
  `Gender` enum('male','female','other') DEFAULT NULL,
  `IdentityNumber` varchar(20) DEFAULT NULL,
  `IdentityIssuedDate` date DEFAULT NULL,
  `IdentityIssuedPlace` varchar(100) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `PhoneNumber` varchar(20) DEFAULT NULL,
  `MaritalStatus` enum('Có gia đình','Độc thân') DEFAULT NULL,
  `Hometown` varchar(100) DEFAULT NULL,
  `PlaceOfBirth` varchar(100) DEFAULT NULL,
  `Nationality` varchar(50) DEFAULT NULL,
  `Role` enum('giam doc','nhan vien','ke toan') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`EmployeeID`, `Username`, `Password`, `FirstName`, `LastName`, `DateOfBirth`, `Gender`, `IdentityNumber`, `IdentityIssuedDate`, `IdentityIssuedPlace`, `Email`, `PhoneNumber`, `MaritalStatus`, `Hometown`, `PlaceOfBirth`, `Nationality`, `Role`) VALUES
(1, 'NguyenDoanNhan', '$2y$10$2FqHyx7f2C1s4oxzRwPZ/.KU5q/PZBHsE8bWmJYMXruB2UpCuZulO', 'Nguyễn Doãn', 'Nhân', '2003-12-13', 'male', '123456789', '2020-11-18', 'Da Nang', 'nhannguyen13072003@gmail.com', '0366010078', 'Độc thân', 'Da Nang', 'Viet Nam', 'Việt Nam', 'nhan vien'),
(2, 'PhanPhuTuan', '$2y$10$.eEzU0GFNB9gpaTWxxW06e3zq9h7Jh5nsr1HN2YhwPxoLZ833KGs6', 'Phan Phu', 'tuan', '2003-11-12', NULL, '0728149212', '2024-11-19', 'Đà nẵng city', 'phutuan@gmail.com', '0366010078', 'Độc thân', NULL, NULL, 'Việt Nam', 'nhan vien'),
(13, 'Khangnguyen', '$2y$10$l8kCydLJ8die4ND38w1zH.IzLGbohC7eOgfVdgTw/0OGcH6bD2L7O', 'Nguyen', 'khang', '2003-12-07', NULL, '049203015584', '2003-12-08', 'điện bàn', 'trieu8845@gmail.com', '0329462933', 'Độc thân', NULL, 'điện bàn quảng nam', 'Việt Nam', 'giam doc');

-- --------------------------------------------------------

--
-- Table structure for table `leaverequest`
--

CREATE TABLE `leaverequest` (
  `LeaveRequestID` int(11) NOT NULL,
  `EmployeeID` int(11) DEFAULT NULL,
  `StartDate` date DEFAULT NULL,
  `EndDate` date DEFAULT NULL,
  `Reason` enum('annual','sick','personal','other') DEFAULT NULL,
  `ApprovedBy` varchar(50) DEFAULT NULL,
  `SubmitDate` timestamp NULL DEFAULT NULL,
  `Status` varchar(20) DEFAULT NULL,
  `Shift` enum('morning','afternoon','full') NOT NULL,
  `Description` varchar(255) NOT NULL,
  `ApprovedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leaverequest`
--

INSERT INTO `leaverequest` (`LeaveRequestID`, `EmployeeID`, `StartDate`, `EndDate`, `Reason`, `ApprovedBy`, `SubmitDate`, `Status`, `Shift`, `Description`, `ApprovedDate`) VALUES
(2, 2, '2024-12-07', '2024-12-23', 'annual', 'Khangnguyen', '2024-11-26 05:14:57', 'approved', 'morning', 'chao', '2024-11-26 21:30:02'),
(3, 2, '2003-12-07', '2003-12-20', 'annual', 'Khangnguyen', '2024-11-26 09:41:23', 'approved', 'morning', 'tiep tuc cong viec tai nha', '2024-11-26 21:30:00'),
(4, 1, '2003-12-07', '2003-12-09', 'sick', 'Khangnguyen', '2024-11-26 10:08:29', 'approved', 'morning', 'sick', '2024-11-26 21:29:58'),
(5, 1, '2003-12-07', '2003-12-09', 'annual', 'Khangnguyen', '2024-11-26 14:29:29', 'approved', 'morning', 'toi xin phep bị ốm vài ngày', '2024-11-26 21:29:58'),
(6, 1, '2024-05-12', '2024-05-15', 'annual', 'Khangnguyen', '2024-11-26 15:06:21', 'rejected', 'morning', 'nghi co viec', '2024-11-26 22:06:47');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `NotificationID` int(11) NOT NULL,
  `EmployeeID` int(11) DEFAULT NULL,
  `Message` text DEFAULT NULL,
  `NotificationDate` datetime DEFAULT NULL,
  `Status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `salary`
--

CREATE TABLE `salary` (
  `SalaryID` int(11) NOT NULL,
  `EmployeeID` int(11) DEFAULT NULL,
  `CheckinCheckoutID` int(11) DEFAULT NULL,
  `BaseSalary` decimal(15,2) DEFAULT NULL,
  `Bonus` decimal(15,2) DEFAULT NULL,
  `Deductions` decimal(15,2) DEFAULT NULL,
  `TotalSalary` decimal(15,2) DEFAULT NULL,
  `OvertimeHours` int(11) DEFAULT NULL,
  `OvertimeRate` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `salary`
--

INSERT INTO `salary` (`SalaryID`, `EmployeeID`, `CheckinCheckoutID`, `BaseSalary`, `Bonus`, `Deductions`, `TotalSalary`, `OvertimeHours`, `OvertimeRate`) VALUES
(31, 2, NULL, 100.00, 10.00, 10.00, 2150.00, 41, 50.00),
(32, 1, NULL, 50.00, 15.00, 5.00, 2210.00, 43, 50.00),
(33, 13, NULL, 2000.00, 1000.00, 100.00, 3700.00, 16, 50.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendanceerrorreport`
--
ALTER TABLE `attendanceerrorreport`
  ADD PRIMARY KEY (`ErrorReportID`),
  ADD KEY `EmployeeID` (`EmployeeID`);

--
-- Indexes for table `checkincheckout`
--
ALTER TABLE `checkincheckout`
  ADD PRIMARY KEY (`CheckinCheckoutID`),
  ADD KEY `EmployeeID` (`EmployeeID`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`EmployeeID`,`Username`);

--
-- Indexes for table `leaverequest`
--
ALTER TABLE `leaverequest`
  ADD PRIMARY KEY (`LeaveRequestID`),
  ADD KEY `EmployeeID` (`EmployeeID`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`NotificationID`),
  ADD KEY `EmployeeID` (`EmployeeID`);

--
-- Indexes for table `salary`
--
ALTER TABLE `salary`
  ADD PRIMARY KEY (`SalaryID`),
  ADD KEY `EmployeeID` (`EmployeeID`),
  ADD KEY `CheckinCheckoutID` (`CheckinCheckoutID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendanceerrorreport`
--
ALTER TABLE `attendanceerrorreport`
  MODIFY `ErrorReportID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `checkincheckout`
--
ALTER TABLE `checkincheckout`
  MODIFY `CheckinCheckoutID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `EmployeeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `leaverequest`
--
ALTER TABLE `leaverequest`
  MODIFY `LeaveRequestID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `salary`
--
ALTER TABLE `salary`
  MODIFY `SalaryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendanceerrorreport`
--
ALTER TABLE `attendanceerrorreport`
  ADD CONSTRAINT `attendanceerrorreport_ibfk_1` FOREIGN KEY (`EmployeeID`) REFERENCES `employee` (`EmployeeID`);

--
-- Constraints for table `checkincheckout`
--
ALTER TABLE `checkincheckout`
  ADD CONSTRAINT `checkincheckout_ibfk_1` FOREIGN KEY (`EmployeeID`) REFERENCES `employee` (`EmployeeID`);

--
-- Constraints for table `leaverequest`
--
ALTER TABLE `leaverequest`
  ADD CONSTRAINT `leaverequest_ibfk_1` FOREIGN KEY (`EmployeeID`) REFERENCES `employee` (`EmployeeID`);

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`EmployeeID`) REFERENCES `employee` (`EmployeeID`);

--
-- Constraints for table `salary`
--
ALTER TABLE `salary`
  ADD CONSTRAINT `salary_ibfk_1` FOREIGN KEY (`EmployeeID`) REFERENCES `employee` (`EmployeeID`),
  ADD CONSTRAINT `salary_ibfk_2` FOREIGN KEY (`CheckinCheckoutID`) REFERENCES `checkincheckout` (`CheckinCheckoutID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
