-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 07, 2024 lúc 09:06 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `hrtech1`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `attendanceerrorreport`
--

CREATE TABLE `attendanceerrorreport` (
  `ErrorReportID` int(11) NOT NULL,
  `EmployeeID` int(11) DEFAULT NULL,
  `ErrorDescription` text DEFAULT NULL,
  `ReportDate` date DEFAULT NULL,
  `ResolvedStatus` enum('approved','pending','rejected') DEFAULT 'pending',
  `ResolvedBy` varchar(50) DEFAULT NULL,
  `Attachment` varchar(255) DEFAULT NULL,
  `ApprovedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `attendanceerrorreport`
--

INSERT INTO `attendanceerrorreport` (`ErrorReportID`, `EmployeeID`, `ErrorDescription`, `ReportDate`, `ResolvedStatus`, `ResolvedBy`, `Attachment`, `ApprovedDate`) VALUES
(22, 2, 'lỗi checkin', '2024-11-26', 'approved', 'NguyenDoanminh', 'Screenshot (767).png', '2024-12-04 11:10:16'),
(23, 1, 'lỗi checkin quên ', '2024-11-26', 'approved', 'NguyenDoanminh', 'Screenshot (768).png', '2024-12-04 11:10:14'),
(24, 1, 'looix checkin ', '2024-11-26', 'rejected', 'NguyenDoanminh', 'Screenshot (767).png', '2024-12-04 11:10:15'),
(25, 1, '121212', '2024-12-04', 'approved', 'NguyenDoanminh', 'Screenshot (768).png', '2024-12-04 11:10:12'),
(26, 1, 'ssas', '2024-12-04', 'approved', 'NguyenDoanminh', 'Screenshot (768).png', '2024-12-04 11:10:56'),
(27, 1, '212121', '2024-12-04', 'approved', 'NguyenDoanminh', 'Screenshot (770).png', '2024-12-04 13:18:50'),
(28, 1, '11111', '2024-12-06', 'approved', 'NguyenDoanminh', 'Screenshot (767).png', '2024-12-06 22:53:36');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `attendancerule`
--

CREATE TABLE `attendancerule` (
  `RuleID` int(11) NOT NULL,
  `EarlyCheckinThreshold` time NOT NULL,
  `LateCheckinThreshold` time NOT NULL,
  `EarlyCheckoutThreshold` time NOT NULL,
  `LateCheckoutThreshold` time NOT NULL,
  `BaseOvertimeRate` decimal(10,2) NOT NULL,
  `LatePenaltyRate` decimal(10,2) NOT NULL,
  `EarlyLeavePenaltyRate` decimal(10,2) NOT NULL,
  `Formula` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `attendancerule`
--

INSERT INTO `attendancerule` (`RuleID`, `EarlyCheckinThreshold`, `LateCheckinThreshold`, `EarlyCheckoutThreshold`, `LateCheckoutThreshold`, `BaseOvertimeRate`, `LatePenaltyRate`, `EarlyLeavePenaltyRate`, `Formula`) VALUES
(1, '07:00:00', '08:15:00', '16:30:00', '06:00:00', 1.50, 0.10, 0.10, 'BaseSalary + (OvertimeHours * OvertimeRate) - (LatePenaltyRate + EarlyLeavePenaltyRate)');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `checkincheckout`
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
-- Đang đổ dữ liệu cho bảng `checkincheckout`
--

INSERT INTO `checkincheckout` (`CheckinCheckoutID`, `CheckinTime`, `CheckoutTime`, `WorkUnits`, `EmployeeID`, `OvertimeHours`, `OvertimeRate`, `GPSLocation`, `CheckoutLocation`) VALUES
(92, '2024-12-04 08:00:00', '2024-12-04 17:32:16', NULL, 1, NULL, NULL, '15.9514624, 108.2753024', '15.9514624, 108.2753024'),
(93, '2024-12-06 22:51:30', '2024-12-06 22:51:30', NULL, 1, NULL, NULL, '15.8728192, 108.3080704', '15.8728192, 108.3080704'),
(94, '2024-12-07 08:37:42', '2024-12-07 08:37:42', NULL, 1, NULL, NULL, '15.8728192, 108.3080704', '15.8728192, 108.3080704');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `employee`
--

CREATE TABLE `employee` (
  `EmployeeID` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `FirstName` varchar(50) DEFAULT NULL,
  `LastName` varchar(50) DEFAULT NULL,
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
-- Đang đổ dữ liệu cho bảng `employee`
--

INSERT INTO `employee` (`EmployeeID`, `Username`, `Password`, `FirstName`, `LastName`, `DateOfBirth`, `Gender`, `IdentityNumber`, `IdentityIssuedDate`, `IdentityIssuedPlace`, `Email`, `PhoneNumber`, `MaritalStatus`, `Hometown`, `PlaceOfBirth`, `Nationality`, `Role`) VALUES
(1, 'NguyenDoanNhan', '$2y$10$2FqHyx7f2C1s4oxzRwPZ/.KU5q/PZBHsE8bWmJYMXruB2UpCuZulO', 'Nguyễn Doãn', 'Nhân', '2003-12-13', 'male', '123456789', '2020-11-18', 'Da Nang', 'nhannguyen13072003@gmail.com', '0366010078', 'Độc thân', 'Da Nang', 'Viet Nam', 'Việt Nam', 'nhan vien'),
(2, 'PhanPhuTuan', '$2y$10$.eEzU0GFNB9gpaTWxxW06e3zq9h7Jh5nsr1HN2YhwPxoLZ833KGs6', 'Phan Phu', 'tuan', '2003-11-12', NULL, '0728149212', '2024-11-19', 'Đà nẵng city', 'phutuan@gmail.com', '0366010078', 'Độc thân', NULL, NULL, 'Việt Nam', 'nhan vien'),
(13, 'Khangnguyen', '$2y$10$l8kCydLJ8die4ND38w1zH.IzLGbohC7eOgfVdgTw/0OGcH6bD2L7O', 'Nguyen', 'khang', '2003-12-07', NULL, '049203015584', '2003-12-08', 'điện bàn', 'trieu8845@gmail.com', '0329462933', 'Độc thân', NULL, 'điện bàn quảng nam', 'Việt Nam', 'giam doc'),
(17, 'NguyenDoanminh', '$2y$10$P9g4uMiYfLaAA89rIe2hFes.3b6bFluEAnMWi5jOdA.kbxCTyjKbS', 'Nguyen', 'Nghia', '2003-12-12', 'male', '049203015584', '2021-11-11', 'điện bàn', 'trieu8845@gmail.com', '0329462933', 'Độc thân', 'quảng nam ', 'điện bàn quảng nam', 'Việt Nam', 'ke toan');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `leaverequest`
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
-- Đang đổ dữ liệu cho bảng `leaverequest`
--

INSERT INTO `leaverequest` (`LeaveRequestID`, `EmployeeID`, `StartDate`, `EndDate`, `Reason`, `ApprovedBy`, `SubmitDate`, `Status`, `Shift`, `Description`, `ApprovedDate`) VALUES
(2, 2, '2024-12-07', '2024-12-23', 'annual', 'Khangnguyen', '2024-11-26 05:14:57', 'approved', 'morning', 'chao', '2024-11-26 21:30:02'),
(3, 2, '2003-12-07', '2003-12-20', 'annual', 'Khangnguyen', '2024-11-26 09:41:23', 'approved', 'morning', 'tiep tuc cong viec tai nha', '2024-11-26 21:30:00'),
(4, 1, '2003-12-07', '2003-12-09', 'sick', 'Khangnguyen', '2024-11-26 10:08:29', 'approved', 'morning', 'sick', '2024-11-26 21:29:58'),
(5, 1, '2003-12-07', '2003-12-09', 'annual', 'Khangnguyen', '2024-11-26 14:29:29', 'approved', 'morning', 'toi xin phep bị ốm vài ngày', '2024-11-26 21:29:58'),
(6, 1, '2024-05-12', '2024-05-15', 'annual', 'Khangnguyen', '2024-11-26 15:06:21', 'rejected', 'morning', 'nghi co viec', '2024-11-26 22:06:47'),
(7, 1, '0011-11-11', '0011-11-01', 'annual', 'Khangnguyen', '2024-12-06 15:52:38', 'approved', 'afternoon', 'sssss', '2024-12-06 22:53:14');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `notifications`
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
-- Cấu trúc bảng cho bảng `ot`
--

CREATE TABLE `ot` (
  `overtimeID` int(11) NOT NULL,
  `employeeID` int(11) NOT NULL,
  `date` date NOT NULL,
  `shift` enum('Weekend','Night','Holiday') NOT NULL,
  `time` time DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status` enum('Pending','Approved','Rejected') NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `ot`
--

INSERT INTO `ot` (`overtimeID`, `employeeID`, `date`, `shift`, `time`, `description`, `status`) VALUES
(1, 16, '2024-12-01', 'Weekend', '05:22:00', '123', 'Pending'),
(2, 16, '2024-11-30', 'Weekend', '05:28:00', 'ádasd', 'Pending'),
(3, 16, '2024-11-30', 'Weekend', '05:28:00', 'ádasd', 'Pending'),
(4, 16, '2024-12-07', 'Weekend', '10:29:00', 'zxc', 'Pending'),
(5, 16, '2024-12-04', 'Holiday', '05:36:00', 'zxc', 'Pending'),
(6, 16, '2024-12-04', 'Holiday', '05:36:00', 'zxc', 'Pending'),
(7, 16, '2024-12-04', 'Holiday', '05:36:00', 'zxc', 'Pending'),
(8, 16, '2024-12-07', 'Night', '00:32:00', 'assssssssssssssss', 'Pending'),
(9, 16, '2024-12-07', 'Night', '00:32:00', 'assssssssssssssss', 'Pending'),
(10, 16, '2024-12-07', 'Night', '00:32:00', 'assssssssssssssss', 'Pending'),
(11, 16, '2024-12-07', 'Night', '00:32:00', 'assssssssssssssss', 'Pending'),
(13, 16, '2024-12-07', 'Weekend', '07:23:00', 'ghj', 'Pending'),
(14, 16, '2024-11-16', 'Weekend', '08:27:00', 'a', 'Rejected'),
(15, 16, '2024-11-30', 'Weekend', '06:33:00', 'a', 'Approved'),
(16, 16, '2024-12-07', 'Holiday', '14:10:00', '321', 'Pending'),
(17, 1, '2024-12-01', 'Night', '02:00:00', 'Support for server maintenance', 'Approved'),
(18, 1, '2024-12-02', 'Weekend', '01:00:00', 'Urgent task completion', 'Rejected'),
(19, 2, '2024-12-03', 'Holiday', '02:00:00', 'Extra reporting work', 'Approved'),
(20, 3, '2024-12-04', 'Night', '03:00:00', 'Database migration', 'Rejected'),
(21, 2, '2024-12-01', 'Night', '02:00:00', 'Support for server maintenance', 'Approved'),
(22, 2, '2024-12-02', 'Weekend', '01:00:00', 'Urgent task completion', 'Approved'),
(23, 2, '2024-12-03', 'Holiday', '02:00:00', 'Extra reporting work', 'Approved'),
(24, 2, '2024-12-04', 'Night', '03:00:00', 'Database migration', 'Rejected'),
(25, 1, '0000-00-00', 'Night', '12:12:00', 'asasasas', 'Rejected'),
(26, 1, '2024-11-11', 'Weekend', '00:11:00', 'ssssas', 'Approved'),
(27, 1, '2222-02-22', 'Weekend', '14:22:00', '22222', 'Approved');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `salary`
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
-- Đang đổ dữ liệu cho bảng `salary`
--

INSERT INTO `salary` (`SalaryID`, `EmployeeID`, `CheckinCheckoutID`, `BaseSalary`, `Bonus`, `Deductions`, `TotalSalary`, `OvertimeHours`, `OvertimeRate`) VALUES
(36, 2, NULL, 1000.00, 0.00, 10.00, 1008.60, 6, 1.50),
(37, 1, NULL, 200.00, 2.00, -0.11, 199.60, 0, 1.50),
(38, 17, NULL, 0.04, 0.05, -0.01, -0.36, 0, 1.50),
(39, 13, NULL, 0.09, 0.09, 0.03, -0.31, 0, 1.50),
(40, 13, NULL, 0.09, 0.09, 0.03, -0.31, 0, 1.50),
(41, 1, NULL, 2.01, 15.00, 3.00, 1.61, 0, 1.50),
(42, 13, NULL, 5.00, 1.00, 2.00, 4.60, 0, 1.50),
(43, 1, NULL, 10.00, 2.00, 4.00, 9.60, 0, 1.50),
(44, 1, NULL, 0.02, -0.02, 22222.00, -0.38, 0, 1.50),
(45, 1, NULL, 0.02, -0.02, 22222.00, -0.38, 0, 1.50),
(46, 1, NULL, 0.02, 222.00, 22.00, -0.38, 0, 1.50);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `attendanceerrorreport`
--
ALTER TABLE `attendanceerrorreport`
  ADD PRIMARY KEY (`ErrorReportID`),
  ADD KEY `EmployeeID` (`EmployeeID`);

--
-- Chỉ mục cho bảng `attendancerule`
--
ALTER TABLE `attendancerule`
  ADD PRIMARY KEY (`RuleID`);

--
-- Chỉ mục cho bảng `checkincheckout`
--
ALTER TABLE `checkincheckout`
  ADD PRIMARY KEY (`CheckinCheckoutID`),
  ADD KEY `EmployeeID` (`EmployeeID`);

--
-- Chỉ mục cho bảng `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`EmployeeID`,`Username`);

--
-- Chỉ mục cho bảng `leaverequest`
--
ALTER TABLE `leaverequest`
  ADD PRIMARY KEY (`LeaveRequestID`),
  ADD KEY `EmployeeID` (`EmployeeID`);

--
-- Chỉ mục cho bảng `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`NotificationID`),
  ADD KEY `EmployeeID` (`EmployeeID`);

--
-- Chỉ mục cho bảng `ot`
--
ALTER TABLE `ot`
  ADD PRIMARY KEY (`overtimeID`),
  ADD KEY `employeeID` (`employeeID`);

--
-- Chỉ mục cho bảng `salary`
--
ALTER TABLE `salary`
  ADD PRIMARY KEY (`SalaryID`),
  ADD KEY `EmployeeID` (`EmployeeID`),
  ADD KEY `CheckinCheckoutID` (`CheckinCheckoutID`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `attendanceerrorreport`
--
ALTER TABLE `attendanceerrorreport`
  MODIFY `ErrorReportID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT cho bảng `attendancerule`
--
ALTER TABLE `attendancerule`
  MODIFY `RuleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `checkincheckout`
--
ALTER TABLE `checkincheckout`
  MODIFY `CheckinCheckoutID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT cho bảng `employee`
--
ALTER TABLE `employee`
  MODIFY `EmployeeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `leaverequest`
--
ALTER TABLE `leaverequest`
  MODIFY `LeaveRequestID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `ot`
--
ALTER TABLE `ot`
  MODIFY `overtimeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT cho bảng `salary`
--
ALTER TABLE `salary`
  MODIFY `SalaryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `attendanceerrorreport`
--
ALTER TABLE `attendanceerrorreport`
  ADD CONSTRAINT `attendanceerrorreport_ibfk_1` FOREIGN KEY (`EmployeeID`) REFERENCES `employee` (`EmployeeID`);

--
-- Các ràng buộc cho bảng `checkincheckout`
--
ALTER TABLE `checkincheckout`
  ADD CONSTRAINT `checkincheckout_ibfk_1` FOREIGN KEY (`EmployeeID`) REFERENCES `employee` (`EmployeeID`);

--
-- Các ràng buộc cho bảng `leaverequest`
--
ALTER TABLE `leaverequest`
  ADD CONSTRAINT `leaverequest_ibfk_1` FOREIGN KEY (`EmployeeID`) REFERENCES `employee` (`EmployeeID`);

--
-- Các ràng buộc cho bảng `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`EmployeeID`) REFERENCES `employee` (`EmployeeID`);

--
-- Các ràng buộc cho bảng `salary`
--
ALTER TABLE `salary`
  ADD CONSTRAINT `salary_ibfk_1` FOREIGN KEY (`EmployeeID`) REFERENCES `employee` (`EmployeeID`),
  ADD CONSTRAINT `salary_ibfk_2` FOREIGN KEY (`CheckinCheckoutID`) REFERENCES `checkincheckout` (`CheckinCheckoutID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
