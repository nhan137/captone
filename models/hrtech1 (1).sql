-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 17, 2024 lúc 04:26 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

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
(28, 1, '11111', '2024-12-06', 'approved', 'NguyenDoanminh', 'Screenshot (767).png', '2024-12-06 22:53:36'),
(29, 1, 'lỗi checkin', '2024-12-09', 'approved', 'NguyenDoanminh', 'Screenshot (769).png', '2024-12-09 22:33:17'),
(30, 1, 'lỗi checkin ', '2024-12-11', 'approved', 'NguyenDoanminh', 'Screenshot (769).png', '2024-12-11 13:20:49'),
(31, 1, 'queen checkin', '2024-12-11', 'approved', 'NguyenDoanminh', 'Screenshot (767).png', '2024-12-11 15:22:40');

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
  `EmployeeID` int(11) DEFAULT NULL,
  `GPSLocation` varchar(255) NOT NULL,
  `CheckoutLocation` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `checkincheckout`
--

INSERT INTO `checkincheckout` (`CheckinCheckoutID`, `CheckinTime`, `CheckoutTime`, `EmployeeID`, `GPSLocation`, `CheckoutLocation`) VALUES
(153, '2024-11-06 08:10:00', '2024-11-06 17:15:00', 18, '15.8695424,108.2294272', '15.8695424,108.2294272'),
(154, '2024-11-07 08:00:00', '2024-11-07 17:00:00', 19, '15.8695424,108.2294272', '15.8695424,108.2294272'),
(155, '2024-11-08 08:30:00', '2024-11-08 17:25:00', 19, '15.8695424,108.2294272', '15.8695424,108.2294272'),
(156, '2024-11-09 08:20:00', '2024-11-09 17:10:00', 20, '15.8695424,108.2294272', '15.8695424,108.2294272'),
(157, '2024-11-10 08:10:00', '2024-11-10 17:15:00', 20, '15.8695424,108.2294272', '15.8695424,108.2294272'),
(158, '2024-11-11 08:00:00', '2024-11-11 17:00:00', 1, '15.8695424,108.2294272', '15.8695424,108.2294272'),
(159, '2024-11-12 08:15:00', '2024-11-12 17:10:00', 1, '15.8695424,108.2294272', '15.8695424,108.2294272'),
(160, '2024-11-13 08:05:00', '2024-11-13 16:55:00', 2, '15.8695424,108.2294272', '15.8695424,108.2294272'),
(161, '2024-11-14 08:00:00', '2024-11-14 17:20:00', 2, '15.8695424,108.2294272', '15.8695424,108.2294272'),
(162, '2024-11-15 07:55:00', '2024-11-15 17:05:00', 18, '15.8695424,108.2294272', '15.8695424,108.2294272'),
(163, '2024-11-16 08:10:00', '2024-11-16 17:15:00', 18, '15.8695424,108.2294272', '15.8695424,108.2294272'),
(164, '2024-11-17 08:00:00', '2024-11-17 17:00:00', 19, '15.8695424,108.2294272', '15.8695424,108.2294272'),
(165, '2024-11-18 08:30:00', '2024-11-18 17:25:00', 19, '15.8695424,108.2294272', '15.8695424,108.2294272'),
(166, '2024-11-19 08:20:00', '2024-11-19 17:10:00', 20, '15.8695424,108.2294272', '15.8695424,108.2294272'),
(167, '2024-11-20 08:10:00', '2024-11-20 17:15:00', 20, '15.8695424,108.2294272', '15.8695424,108.2294272'),
(168, '2024-11-21 08:00:00', '2024-11-21 17:30:00', 1, '15.8695424,108.2294272', '15.8695424,108.2294272'),
(169, '2024-11-22 08:00:00', '2024-11-22 17:30:00', 1, '15.8695424,108.2294272', '15.8695424,108.2294272'),
(173, '2024-11-26 08:00:00', '2024-11-26 17:30:00', 18, '15.8695424,108.2294272', '15.8695424,108.2294272'),
(174, '2024-11-27 08:00:00', '2024-11-27 17:30:00', 19, '15.8695424,108.2294272', '15.8695424,108.2294272'),
(175, '2024-11-28 08:00:00', '2024-11-28 17:30:00', 19, '15.8695424,108.2294272', '15.8695424,108.2294272'),
(176, '2024-11-29 08:00:00', '2024-11-29 17:30:00', 20, '15.8695424,108.2294272', '15.8695424,108.2294272'),
(177, '2024-11-30 08:00:00', '2024-11-30 17:30:00', 20, '15.8695424,108.2294272', '15.8695424,108.2294272'),
(180, '2024-12-11 15:15:12', '2024-12-11 15:15:12', 1, '16.0315263, 108.2251599', '16.0315263, 108.2251599'),
(181, '2024-12-14 14:16:42', '2024-12-14 14:17:22', 1, '16.057122, 108.1858697', '16.057122, 108.1858697');

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
  `Role` enum('giam doc','nhan vien','ke toan') DEFAULT NULL,
  `HourlyRate` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `employee`
--

INSERT INTO `employee` (`EmployeeID`, `Username`, `Password`, `FirstName`, `LastName`, `DateOfBirth`, `Gender`, `IdentityNumber`, `IdentityIssuedDate`, `IdentityIssuedPlace`, `Email`, `PhoneNumber`, `MaritalStatus`, `Hometown`, `PlaceOfBirth`, `Nationality`, `Role`, `HourlyRate`) VALUES
(1, 'NguyenDoanNhan', '$2y$10$OM49cMvvGJN5YPyOMjER6.joVY0tV2XWdtynK83XyH0PNoJ6FWK3m', 'Nguyễn Doãn', 'Nhân', '2003-12-13', NULL, '123456789', '2020-11-18', 'Da Nang', 'nhannguyen13072003@gmail.com', '0366010078', 'Có gia đình', 'Da Nang', 'Viet Nam', 'Việt Nam', 'nhan vien', 20.00),
(2, 'PhanPhuTuan', '$2y$10$.eEzU0GFNB9gpaTWxxW06e3zq9h7Jh5nsr1HN2YhwPxoLZ833KGs6', 'Phan Phu', 'tuan', '2003-11-12', 'male', '0728149212', '2024-11-19', 'Đà nẵng city', 'phutuan@gmail.com', '0366010078', 'Độc thân', 'đà nẵng', 'việt nam', 'Việt Nam', 'nhan vien', 0.00),
(13, 'Khangnguyen', '$2y$10$l8kCydLJ8die4ND38w1zH.IzLGbohC7eOgfVdgTw/0OGcH6bD2L7O', 'Nguyen', 'khang', '2003-12-07', NULL, '049203015584', '2003-12-08', 'điện bàn', 'trieu8845@gmail.com', '0329462933', 'Độc thân', NULL, 'điện bàn quảng nam', 'Việt Nam', 'giam doc', 0.00),
(17, 'NguyenDoanminh', '$2y$10$P9g4uMiYfLaAA89rIe2hFes.3b6bFluEAnMWi5jOdA.kbxCTyjKbS', 'Nguyen', 'Nghia', '2003-12-12', 'male', '049203015584', '2021-11-11', 'điện bàn', 'trieu8845@gmail.com', '0329462933', 'Độc thân', 'quảng nam ', 'điện bàn quảng nam', 'Việt Nam', 'ke toan', 0.00),
(18, 'TranThiHong', '$2y$10$2FqHyx7f2C1s4oxzRwPZ/.KU5q/PZBHsE8bWmJYMXruB2UpCuZulO', 'Trần Thị', 'Hồng', '1995-05-15', 'female', '123789456', '2019-03-20', 'Da Nang', 'hong.tran@gmail.com', '0905123456', 'Độc thân', 'Da Nang', 'Da Nang', 'Việt Nam', 'nhan vien', 0.00),
(19, 'LeVanThanh', '$2y$10$2FqHyx7f2C1s4oxzRwPZ/.KU5q/PZBHsE8bWmJYMXruB2UpCuZulO', 'Lê Văn', 'Thành', '1990-08-22', 'male', '987654321', '2018-06-15', 'Quang Nam', 'thanh.le@gmail.com', '0935789123', 'Có gia đình', 'Quang Nam', 'Quang Nam', 'Việt Nam', 'nhan vien', 0.00),
(20, 'NguyenThiLan', '$2y$10$2FqHyx7f2C1s4oxzRwPZ/.KU5q/PZBHsE8bWmJYMXruB2UpCuZulO', 'Nguyễn Thị', 'Lan', '1993-12-10', 'female', '456123789', '2020-01-10', 'Hue', 'lan.nguyen@gmail.com', '0978456123', 'Độc thân', 'Hue', 'Hue', 'Việt Nam', 'nhan vien', 0.00),
(21, 'PhamVanHai', '$2y$10$2FqHyx7f2C1s4oxzRwPZ/.KU5q/PZBHsE8bWmJYMXruB2UpCuZulO', 'Phạm Văn', 'Hải', '1988-04-25', 'male', '789456123', '2017-09-30', 'Da Nang', 'hai.pham@gmail.com', '0912345678', 'Có gia đình', 'Da Nang', 'Da Nang', 'Việt Nam', 'nhan vien', 0.00),
(22, 'HoangThiMai', '$2y$10$2FqHyx7f2C1s4oxzRwPZ/.KU5q/PZBHsE8bWmJYMXruB2UpCuZulO', 'Hoàng Thị', 'Mai', '1992-07-18', 'female', '321654987', '2019-11-25', 'Quang Nam', 'mai.hoang@gmail.com', '0945678123', 'Độc thân', 'Quang Nam', 'Quang Nam', 'Việt Nam', 'nhan vien', 0.00),
(23, 'VoVanDuc', '$2y$10$2FqHyx7f2C1s4oxzRwPZ/.KU5q/PZBHsE8bWmJYMXruB2UpCuZulO', 'Võ Văn', 'Đức', '1991-03-30', 'male', '654987321', '2018-12-05', 'Da Nang', 'duc.vo@gmail.com', '0923456789', 'Có gia đình', 'Da Nang', 'Da Nang', 'Việt Nam', 'nhan vien', 0.00),
(24, 'TranVanNam', '$2y$10$2FqHyx7f2C1s4oxzRwPZ/.KU5q/PZBHsE8bWmJYMXruB2UpCuZulO', 'Trần Văn', 'Nam', '1994-09-12', 'male', '147258369', '2020-04-15', 'Hue', 'nam.tran@gmail.com', '0967891234', 'Độc thân', 'Hue', 'Hue', 'Việt Nam', 'nhan vien', 0.00),
(25, 'NguyenThiThu', '$2y$10$2FqHyx7f2C1s4oxzRwPZ/.KU5q/PZBHsE8bWmJYMXruB2UpCuZulO', 'Nguyễn Thị', 'Thu', '1989-11-05', 'female', '258369147', '2017-07-20', 'Da Nang', 'thu.nguyen@gmail.com', '0934567891', 'Có gia đình', 'Da Nang', 'Da Nang', 'Việt Nam', 'nhan vien', 0.00),
(26, 'LeThiHuong', '$2y$10$2FqHyx7f2C1s4oxzRwPZ/.KU5q/PZBHsE8bWmJYMXruB2UpCuZulO', 'Lê Thị', 'Hương', '1996-02-28', 'female', '369147258', '2021-02-10', 'Quang Nam', 'huong.le@gmail.com', '0956789123', 'Độc thân', 'Quang Nam', 'Quang Nam', 'Việt Nam', 'nhan vien', 0.00),
(27, 'PhamVanTuan', '$2y$10$2FqHyx7f2C1s4oxzRwPZ/.KU5q/PZBHsE8bWmJYMXruB2UpCuZulO', 'Phạm Văn', 'Tuấn', '1987-06-15', 'male', '741852963', '2016-08-25', 'Da Nang', 'tuan.pham@gmail.com', '0989123456', 'Có gia đình', 'Da Nang', 'Da Nang', 'Việt Nam', 'nhan vien', 0.00),
(28, 'HoangVanLong', '$2y$10$2FqHyx7f2C1s4oxzRwPZ/.KU5q/PZBHsE8bWmJYMXruB2UpCuZulO', 'Hoàng Văn', 'Long', '1993-01-20', 'male', '852963741', '2019-05-30', 'Hue', 'long.hoang@gmail.com', '0912789456', 'Độc thân', 'Hue', 'Hue', 'Việt Nam', 'nhan vien', 0.00),
(29, 'VoThiLien', '$2y$10$2FqHyx7f2C1s4oxzRwPZ/.KU5q/PZBHsE8bWmJYMXruB2UpCuZulO', 'Võ Thị', 'Liên', '1990-10-08', 'female', '963741852', '2018-03-15', 'Da Nang', 'lien.vo@gmail.com', '0945123789', 'Có gia đình', 'Da Nang', 'Da Nang', 'Việt Nam', 'nhan vien', 0.00),
(30, 'TranThiHa', '$2y$10$2FqHyx7f2C1s4oxzRwPZ/.KU5q/PZBHsE8bWmJYMXruB2UpCuZulO', 'Trần Thị', 'Hà', '1995-12-25', 'female', '159357486', '2020-09-20', 'Quang Nam', 'ha.tran@gmail.com', '0978456123', 'Độc thân', 'Quang Nam', 'Quang Nam', 'Việt Nam', 'nhan vien', 0.00),
(31, 'NguyenVanHung', '$2y$10$2FqHyx7f2C1s4oxzRwPZ/.KU5q/PZBHsE8bWmJYMXruB2UpCuZulO', 'Nguyễn Văn', 'Hùng', '1988-07-14', 'male', '357159486', '2017-11-30', 'Da Nang', 'hung.nguyen@gmail.com', '0934789123', 'Có gia đình', 'Da Nang', 'Da Nang', 'Việt Nam', 'nhan vien', 0.00),
(32, 'LeVanDat', '$2y$10$2FqHyx7f2C1s4oxzRwPZ/.KU5q/PZBHsE8bWmJYMXruB2UpCuZulO', 'Lê Văn', 'Đạt', '1992-04-03', 'male', '486159357', '2019-01-25', 'Hue', 'dat.le@gmail.com', '0967123456', 'Độc thân', 'Hue', 'Hue', 'Việt Nam', 'nhan vien', 0.00),
(33, 'PhamThiThao', '$2y$10$2FqHyx7f2C1s4oxzRwPZ/.KU5q/PZBHsE8bWmJYMXruB2UpCuZulO', 'Phạm Thị', 'Thảo', '1991-08-17', 'female', '753951486', '2018-10-15', 'Da Nang', 'thao.pham@gmail.com', '0923789456', 'Có gia đình', 'Da Nang', 'Da Nang', 'Việt Nam', 'nhan vien', 0.00),
(34, 'HoangThiLoan', '$2y$10$2FqHyx7f2C1s4oxzRwPZ/.KU5q/PZBHsE8bWmJYMXruB2UpCuZulO', 'Hoàng Thị', 'Loan', '1994-05-22', 'female', '951753486', '2020-07-10', 'Quang Nam', 'loan.hoang@gmail.com', '0945678912', 'Độc thân', 'Quang Nam', 'Quang Nam', 'Việt Nam', 'nhan vien', 0.00),
(35, 'VoVanThanh', '$2y$10$2FqHyx7f2C1s4oxzRwPZ/.KU5q/PZBHsE8bWmJYMXruB2UpCuZulO', 'Võ Văn', 'Thành', '1989-03-11', 'male', '486753951', '2017-04-20', 'Da Nang', 'thanh.vo@gmail.com', '0989456123', 'Có gia đình', 'Da Nang', 'Da Nang', 'Việt Nam', 'nhan vien', 0.00);

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
(7, 1, '0011-11-11', '0011-11-01', 'annual', 'Khangnguyen', '2024-12-06 15:52:38', 'approved', 'afternoon', 'sssss', '2024-12-06 22:53:14'),
(8, 1, '2003-12-07', '2222-12-22', 'sick', 'Khangnguyen', '2024-12-07 16:26:49', 'approved', 'morning', '22222', '2024-12-08 00:13:54'),
(9, 2, '1111-11-11', '0000-00-00', 'annual', 'Khangnguyen', '2024-12-07 16:51:08', 'approved', 'morning', '1111', '2024-12-08 00:13:53'),
(10, 1, '0011-11-11', '0111-11-11', 'sick', 'Khangnguyen', '2024-12-07 17:31:50', 'approved', 'morning', '1111', '2024-12-08 00:40:36'),
(11, 1, '1111-11-11', '0000-00-00', 'annual', 'Khangnguyen', '2024-12-07 17:44:31', 'approved', 'morning', '11111', '2024-12-08 00:46:32'),
(12, 1, '1111-11-11', '1111-11-11', 'annual', 'Khangnguyen', '2024-12-07 17:44:42', 'approved', 'morning', '1111', '2024-12-08 00:45:48'),
(13, 1, '0111-11-11', '0011-01-11', 'sick', 'Khangnguyen', '2024-12-07 18:02:28', 'approved', 'morning', '1111', '2024-12-08 14:58:16'),
(14, 1, '0000-00-00', '0011-11-11', 'annual', 'Khangnguyen', '2024-12-08 08:37:53', 'approved', 'morning', '1111', '2024-12-09 11:40:31'),
(15, 1, '1111-11-11', '1111-11-11', 'sick', 'Khangnguyen', '2024-12-09 04:40:48', 'approved', 'afternoon', '11111', '2024-12-09 11:41:23'),
(16, 2, '0111-01-11', '1111-01-11', 'annual', 'Khangnguyen', '2024-12-09 04:43:55', 'approved', 'morning', '1111', '2024-12-09 11:45:14'),
(17, 1, '0000-00-00', '1222-12-12', 'annual', 'Khangnguyen', '2024-12-09 04:44:59', 'approved', 'morning', '22121212', '2024-12-09 11:45:13'),
(18, 1, '2222-12-22', '2222-02-22', 'annual', 'Khangnguyen', '2024-12-09 04:48:01', 'approved', 'afternoon', '2222', '2024-12-09 11:48:18'),
(19, 1, '2121-11-21', '2121-02-21', 'annual', 'Khangnguyen', '2024-12-09 05:01:09', 'approved', 'morning', '212121', '2024-12-09 12:01:19'),
(20, 1, '0001-01-02', '0001-11-11', 'annual', 'Khangnguyen', '2024-12-09 05:05:44', 'approved', 'morning', '1111', '2024-12-09 12:05:54'),
(21, 1, '1111-11-11', '1111-11-11', 'sick', 'Khangnguyen', '2024-12-09 05:30:02', 'approved', 'afternoon', '11111', '2024-12-09 12:30:58'),
(22, 2, '2222-02-22', '0222-02-22', 'annual', 'Khangnguyen', '2024-12-09 05:30:24', 'approved', 'morning', '2222', '2024-12-09 12:31:02'),
(23, 1, '0111-11-11', '0111-11-11', 'annual', 'Khangnguyen', '2024-12-09 05:41:13', 'approved', 'morning', '111', '2024-12-09 12:41:34'),
(24, 1, '1111-01-11', '1111-11-11', 'sick', 'Khangnguyen', '2024-12-09 05:50:12', 'approved', 'morning', '1111', '2024-12-09 12:55:06'),
(25, 1, '2022-12-21', '2022-12-22', 'annual', 'Khangnguyen', '2024-12-09 15:31:32', 'approved', 'morning', 'sick ', '2024-12-09 22:52:35'),
(26, 1, '2222-02-22', '0022-02-22', 'sick', 'Khangnguyen', '2024-12-09 15:57:17', 'approved', 'morning', '2222', '2024-12-09 22:57:43'),
(27, 1, '0000-00-00', '0000-00-00', 'annual', 'Khangnguyen', '2024-12-09 16:24:34', 'approved', 'morning', 'ssdsdsdssdsds', '2024-12-09 23:25:29'),
(28, 1, '1111-11-11', '1111-11-11', 'annual', 'Khangnguyen', '2024-12-09 18:20:58', 'approved', 'morning', '11111', '2024-12-10 01:21:12'),
(29, 1, '2222-02-22', '2222-11-23', 'annual', 'Khangnguyen', '2024-12-09 18:25:38', 'approved', 'morning', 'v ', '2024-12-10 01:28:48'),
(30, 1, '2024-12-12', '2024-12-13', 'annual', 'Khangnguyen', '2024-12-10 17:58:03', 'approved', 'morning', 'dd', '2024-12-11 00:58:12'),
(31, 1, '2003-12-07', '2024-12-12', 'sick', 'Khangnguyen', '2024-12-11 06:18:14', 'approved', 'morning', 'nghĩ phép', '2024-12-11 13:19:25'),
(32, 1, '2024-12-12', '2024-12-13', 'sick', 'Khangnguyen', '2024-12-11 08:18:41', 'approved', 'morning', 'sick', '2024-12-11 15:20:08'),
(33, 1, '2024-12-12', '2024-12-13', 'sick', 'Khangnguyen', '2024-12-13 06:40:04', 'approved', 'morning', 'sick', '2024-12-13 13:41:00');

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
(27, 1, '2222-02-22', 'Weekend', '14:22:00', '22222', 'Approved'),
(28, 1, '0111-11-11', 'Weekend', '02:21:00', '1111', 'Approved'),
(29, 1, '0011-11-11', 'Weekend', '11:11:00', '111', 'Approved'),
(30, 1, '0000-00-00', 'Night', '11:11:00', '1111', 'Approved'),
(31, 1, '1111-11-11', 'Weekend', '11:11:00', '111111', 'Approved'),
(32, 1, '1111-11-11', 'Weekend', '11:11:00', '1111', 'Approved'),
(33, 1, '0011-11-11', 'Weekend', '11:11:00', '1111', 'Approved'),
(34, 2, '0000-00-00', 'Weekend', '23:12:00', '11111', 'Approved'),
(35, 1, '0002-01-21', 'Weekend', '02:22:00', '22222', 'Approved'),
(36, 2, '0002-02-22', 'Weekend', '14:22:00', '22222', 'Approved'),
(37, 2, '0022-02-22', 'Weekend', '14:22:00', '22', 'Approved'),
(38, 1, '0000-00-00', 'Weekend', '11:11:00', '111', 'Approved'),
(39, 1, '2024-12-02', 'Night', '02:00:00', 'ot work', 'Approved'),
(40, 1, '0222-02-22', 'Weekend', '14:22:00', '2222', 'Approved'),
(41, 1, '2222-02-22', 'Weekend', '14:22:00', 'sasasdsdsdad', 'Approved'),
(42, 1, '1111-11-11', 'Weekend', '11:11:00', '12121', 'Approved'),
(43, 1, '0001-11-09', 'Night', '02:13:00', 'OT', 'Approved'),
(44, 1, '2024-01-11', 'Weekend', '11:11:00', 'ot thêm giờ\r\n', 'Approved'),
(45, 1, '2024-12-13', 'Weekend', '00:02:00', 'ot', 'Approved');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `payroll`
--

CREATE TABLE `payroll` (
  `PayrollID` int(11) NOT NULL,
  `EmployeeID` int(11) NOT NULL,
  `Month` int(2) NOT NULL,
  `Year` int(4) NOT NULL,
  `TotalHours` decimal(10,2) NOT NULL,
  `TotalSalary` decimal(12,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Chỉ mục cho bảng `payroll`
--
ALTER TABLE `payroll`
  ADD PRIMARY KEY (`PayrollID`),
  ADD KEY `EmployeeID` (`EmployeeID`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `attendanceerrorreport`
--
ALTER TABLE `attendanceerrorreport`
  MODIFY `ErrorReportID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT cho bảng `attendancerule`
--
ALTER TABLE `attendancerule`
  MODIFY `RuleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `checkincheckout`
--
ALTER TABLE `checkincheckout`
  MODIFY `CheckinCheckoutID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=182;

--
-- AUTO_INCREMENT cho bảng `employee`
--
ALTER TABLE `employee`
  MODIFY `EmployeeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT cho bảng `leaverequest`
--
ALTER TABLE `leaverequest`
  MODIFY `LeaveRequestID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT cho bảng `ot`
--
ALTER TABLE `ot`
  MODIFY `overtimeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT cho bảng `payroll`
--
ALTER TABLE `payroll`
  MODIFY `PayrollID` int(11) NOT NULL AUTO_INCREMENT;

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
-- Các ràng buộc cho bảng `payroll`
--
ALTER TABLE `payroll`
  ADD CONSTRAINT `payroll_ibfk_1` FOREIGN KEY (`EmployeeID`) REFERENCES `employee` (`EmployeeID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
