-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th10 05, 2021 lúc 10:57 PM
-- Phiên bản máy phục vụ: 5.7.35-cll-lve
-- Phiên bản PHP: 7.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `bookstor_bookstore`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `banners`
--

CREATE TABLE `banners` (
  `ba_id` int(11) NOT NULL,
  `ba_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ba_link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ba_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `banners`
--

INSERT INTO `banners` (`ba_id`, `ba_title`, `ba_link`, `ba_image`) VALUES
(11, 'Beautifully Designed', 'http://hkstore.tk/product-details.php?idsp=86', 'banner/NCQQagNh.banner1.png'),
(12, 'I Love This Idea!', 'http://hkstore.tk/product-details.php?idsp=85', 'banner/1Wtv5QmY.banner2.png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `carts`
--

CREATE TABLE `carts` (
  `pr_id` int(11) NOT NULL,
  `cus_id` int(11) NOT NULL,
  `cart_quatity` int(11) NOT NULL DEFAULT '1',
  `cart_price` mediumint(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `carts`
--

INSERT INTO `carts` (`pr_id`, `cus_id`, `cart_quatity`, `cart_price`) VALUES
(39, 114, 13, 20000),
(40, 114, 14, 40000),
(51, 114, 25, 40000),
(52, 114, 1, 40000),
(60, 11, 1, 20000),
(60, 114, 1, 20000),
(61, 11, 1, 65000),
(61, 114, 1, 65000),
(62, 114, 1, 15001),
(63, 11, 1, 75000),
(63, 114, 1, 75000),
(64, 11, 1, 69000),
(69, 11, 1, 53000),
(70, 11, 1, 53000),
(74, 11, 1, 230000),
(77, 114, 1, 100000),
(78, 0, 1, 150002),
(120, 114, 1, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `c_id` int(11) NOT NULL,
  `c_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`c_id`, `c_name`) VALUES
(1, 'Kỹ năng sống'),
(2, 'Truyện tranh'),
(3, 'Khoa học'),
(4, 'Sách ngoại ngữ'),
(5, 'Sách văn học'),
(6, 'Sách lịch sử');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customers`
--

CREATE TABLE `customers` (
  `cus_id` int(11) NOT NULL,
  `cus_username` varchar(255) NOT NULL,
  `cus_password` varchar(255) NOT NULL,
  `cus_mail` varchar(255) NOT NULL,
  `cus_tel` varchar(15) NOT NULL,
  `cus_name` varchar(255) NOT NULL,
  `cus_add` varchar(255) NOT NULL,
  `activation_code` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `cus_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `customers`
--

INSERT INTO `customers` (`cus_id`, `cus_username`, `cus_password`, `cus_mail`, `cus_tel`, `cus_name`, `cus_add`, `activation_code`, `status`, `cus_create`) VALUES
(1, 'Hieu', '$2y$10$/KHxTWNxUWlkX00MOiyupuuPkARv2wwz0bQ/UTyc3l/GYe4ESXldK', '', '', 'Nguyễn Minh Hiếu', '', '', 1, '2021-10-19 10:00:00'),
(11, '', '$2y$10$/KHxTWNxUWlkX00MOiyupuuPkARv2wwz0bQ/UTyc3l/GYe4ESXldK', 'cus1@gmail.com', '', 'Nguyễn Minh Hiếu', '', '', 1, '2021-10-18 10:00:00'),
(12, '', '$2y$10$/KHxTWNxUWlkX00MOiyupuuPkARv2wwz0bQ/UTyc3l/GYe4ESXldK', 'cus2@gmail.com', '', 'Nguyễn Minh Hiếu', '', '', 1, '2021-10-28 10:00:00'),
(13, '', '$2y$10$/KHxTWNxUWlkX00MOiyupuuPkARv2wwz0bQ/UTyc3l/GYe4ESXldK', 'cus3@gmail.com', '', 'Nguyễn Minh Hiếu', '', '', 1, '2021-10-28 10:00:00'),
(14, '', '$2y$10$/KHxTWNxUWlkX00MOiyupuuPkARv2wwz0bQ/UTyc3l/GYe4ESXldK', 'cus4@gmail.com', '', 'Nguyễn Minh Hiếu', '', '', 1, '2021-10-28 10:00:00'),
(15, '', '$2y$10$/KHxTWNxUWlkX00MOiyupuuPkARv2wwz0bQ/UTyc3l/GYe4ESXldK', 'cus5@gmail.com', '', 'Nguyễn Minh Hiếu', '', '', 1, '2021-10-28 10:00:00'),
(16, '', '$2y$10$/KHxTWNxUWlkX00MOiyupuuPkARv2wwz0bQ/UTyc3l/GYe4ESXldK', 'cus6@gmail.com', '', 'Nguyễn Minh Hiếu', '', '', 1, '2021-10-28 10:00:00'),
(17, '', '$2y$10$/KHxTWNxUWlkX00MOiyupuuPkARv2wwz0bQ/UTyc3l/GYe4ESXldK', 'cus7@gmail.com', '', 'Nguyễn Minh Hiếu', '', '', 1, '2021-10-28 10:00:00'),
(18, '', '$2y$10$/KHxTWNxUWlkX00MOiyupuuPkARv2wwz0bQ/UTyc3l/GYe4ESXldK', 'cus9@gmail.com', '', 'Nguyễn Minh Hiếu', '', '', 1, '2021-10-28 10:00:00'),
(19, '', '$2y$10$/KHxTWNxUWlkX00MOiyupuuPkARv2wwz0bQ/UTyc3l/GYe4ESXldK', 'cus10@gmail.com', '', 'Nguyễn Minh Hiếu', '', '', 1, '2021-10-28 10:00:00'),
(20, '', '$2y$10$/KHxTWNxUWlkX00MOiyupuuPkARv2wwz0bQ/UTyc3l/GYe4ESXldK', 'cus11@gmail.com', '', 'Nguyễn Minh Hiếu', '', '', 1, '2021-10-28 10:00:00'),
(21, '', '$2y$10$/KHxTWNxUWlkX00MOiyupuuPkARv2wwz0bQ/UTyc3l/GYe4ESXldK', 'cus12@gmail.com', '', 'Nguyễn Minh Hiếu', '', '', 1, '2021-10-28 10:00:00'),
(22, '', '$2y$10$/KHxTWNxUWlkX00MOiyupuuPkARv2wwz0bQ/UTyc3l/GYe4ESXldK', 'cus13@gmail.com', '', 'Nguyễn Minh Hiếu', '', '', 1, '2021-10-28 10:00:00'),
(23, '', '$2y$10$/KHxTWNxUWlkX00MOiyupuuPkARv2wwz0bQ/UTyc3l/GYe4ESXldK', 'cus14@gmail.com', '', 'Nguyễn Minh Hiếu', '', '', 1, '2021-10-28 10:00:00'),
(24, '', '$2y$10$/KHxTWNxUWlkX00MOiyupuuPkARv2wwz0bQ/UTyc3l/GYe4ESXldK', 'cus15@gmail.com', '', 'Nguyễn Minh Hiếu', '', '', 1, '2021-10-31 10:00:00'),
(100, '', '1', 'cus50@gmail.com', '', '', '', '', 0, '2021-11-01 23:56:46'),
(101, '', '1', 'cus55@gmail.com', '', '', '', '', 0, '2021-11-01 23:56:46'),
(104, '', '$2y$10$T4UdSiVQRBR9WtHlQIxh8uDI0gyRsgT62GGoBwwGq7hoF0bPRM16O', 'nguyenthuphuong741@gmail.com', '024 3852 2201', 'Nguyễn Thu Phương', 'kjo', 'dd111a74f4ff9cf2cbf198cef2579800', 1, '2021-11-05 08:47:02'),
(105, '', '$2y$10$eVxJBv1Joa8bFxy8BXJpQOmRSMDBed69yHkaJShKE36Iz9xeLJqmS', 'tuyetnhung01062001@gmail.com', '0375556173', 'Nhung xinh gái', 'Hà Lội', 'a7bf3f5462cc82062e41b3a2262e1a21', 1, '2021-11-05 08:49:27'),
(106, '', '$2y$10$EJ0Ve6jHVMCeuZxVggKANu.meGhQvl3u1hlW84bCzH8uOTx9iITnm', 'ngoduykhanh2001@gmail.com', '0382403631', 'Khánh Duy Ngô', 'Hà Nội', '991de292e76f74f3c285b3f6d57958d5', 1, '2021-11-05 08:50:05'),
(107, '', '$2y$10$bUuODuRa.sRXWImIgx0C5.b4t3T2i1jBeqj82BRSG0Kb0gGD7JEJK', 'meo@gmail.com', '0123456789', 'mèo méo meo', 'chuồng mèo', '19e901474bd32d47931f0219992ff889', 0, '2021-11-05 09:15:10'),
(108, '', '$2y$10$MPJDXrgYV.b8P1S6no23VerUEjj4G4JkmbHcpMUjRy5UyYieXw75i', 'nhuhoang.afk3@gmail.com', '012345678912030', 'Vu Linh', '12321312', 'c81e155d85dae5430a8cee6f2242e82c', 0, '2021-11-05 09:36:00'),
(109, '', '$2y$10$glU4SZXOqC6CxIQcrYgp/e.xmYEc4jupDx6Rrl4YmTPhubamAcrN.', 'nhuhoang.afk4@gmail.com', '012345678912030', 'Vu LInh', '12321312', '351869bde8b9d6ad1e3090bd173f600d', 0, '2021-11-05 09:37:40'),
(110, '', '$2y$10$XbAQDZgo6R1CpgACxXXneO2srlvwooEoRrYGKejbJ9KOTiTqJ8Rx6', 'tuanxsokoh@gmail.com', '098888888888', 'Tuan Minh', '3 Wall', 'c494d9524143b2ebe567475e985c19f7', 1, '2021-11-05 09:40:27'),
(111, '', '$2y$10$elUj0uxkIR3zi5.wO6KE5O8rysbC6tKQjXPdT12/OK.9u5VsiHYbq', 'abc@gmail.com', '123456799', 'chiendeptrai', 'mars', '8f6242793017047d373f29f270388ba9', 0, '2021-11-05 09:55:26'),
(112, '', '$2y$10$pBYPQWz4o5CmMg1UnWCUteC4U3ogITTKTW0PDYIwlKsi2RbsuDUyq', 'iamromanc2501@gmail.com', '1010010101', 'chienratdeptrai', 'nhà', '07c4b1fdd1ef8da2d7e9393071204b71', 1, '2021-11-05 09:58:06'),
(113, '', '$2y$10$sSU.ImBZPwdzbVmOj8uUz.4kowooz6Rd3gJjvo5UdRj4kAtUW.6rK', 'hathu12hi@gmail.com', '0383754011', 'Đỗ Thị Hồng Nhung', 'Hà Nội', '2b8eba3cb0d0f1d761cb74d94a5ace36', 1, '2021-11-05 10:00:28'),
(114, '', '$2y$10$i4dz9Nsz13dCRnUb3cL07uQaKpxTQCbzdglBoUf1VaRcwSy1GTZMi', '1851061489@e.tlu.edu.vn', '222', 'Đạt', '111', 'e17a886efc21fa45b9dc49a17c29dcf1', 1, '2021-11-05 10:22:13'),
(115, '', '$2y$10$q.9W9xpmlGAgGfYEHtpLxu96FhGep0VvA3C68RjkvlVsjBFCWphsm', 'ngoduykhanhdz@gmail.com', '0382403631', 'Khánh Ngô', 'Hà Nội', '58c2ac6f92a1c369e00bcb3a28af2d18', 1, '2021-11-05 13:35:40');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orderdetail`
--

CREATE TABLE `orderdetail` (
  `or_id` varchar(11) NOT NULL,
  `pr_id` int(11) NOT NULL,
  `od_price` mediumint(9) NOT NULL,
  `od_quatity` int(11) NOT NULL,
  `od_total` mediumint(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `orderdetail`
--

INSERT INTO `orderdetail` (`or_id`, `pr_id`, `od_price`, `od_quatity`, `od_total`) VALUES
('2208201', 38, 20000, 1, 20000),
('3306043', 38, 20000, 2, 40000),
('4106404', 38, 20000, 1, 20000),
('4195043', 38, 20000, 1, 20000),
('4226689', 38, 20000, 1, 20000),
('5154480', 38, 20000, 3, 60000),
('6172143', 38, 20000, 1, 20000),
('6590716', 38, 20000, 1, 20000),
('7024719', 38, 20000, 5, 100000),
('8338009', 38, 20000, 1, 20000),
('8358642', 38, 20000, 1, 20000),
('8975893', 38, 20000, 1, 20000),
('9426113', 38, 20000, 1, 20000),
('9778415', 38, 20000, 1, 20000),
('9836692', 38, 20000, 1, 20000),
('2022446', 39, 20000, 1, 20000),
('2469077', 39, 20000, 1, 20000),
('2723744', 39, 20000, 1, 20000),
('2922549', 39, 20000, 1, 20000),
('2964887', 39, 20000, 1, 20000),
('3083883', 39, 20000, 1, 20000),
('3607945', 39, 20000, 1, 20000),
('3675579', 39, 20000, 2, 40000),
('400936', 39, 20000, 20, 400000),
('4059606', 39, 20000, 1, 20000),
('4879519', 39, 20000, 1, 20000),
('5109489', 39, 20000, 4, 80000),
('6569467', 39, 20000, 1, 20000),
('6762211', 39, 20000, 1, 20000),
('8337388', 39, 20000, 1, 20000),
('8896956', 39, 20000, 1, 20000),
('9049060', 39, 20000, 1, 20000),
('9167433', 39, 20000, 2, 40000),
('9829579', 39, 20000, 3, 60000),
('1297605', 40, 40000, 1, 40000),
('2231280', 40, 40000, 1, 40000),
('2469077', 40, 40000, 2, 80000),
('400936', 40, 40000, 1, 40000),
('4059606', 40, 40000, 3, 120000),
('4816125', 40, 40000, 3, 120000),
('5109489', 40, 40000, 1, 40000),
('5223888', 40, 40000, 2, 80000),
('6569467', 40, 40000, 1, 40000),
('6762211', 40, 40000, 1, 40000),
('8358642', 40, 40000, 1, 40000),
('8745565', 40, 40000, 1, 40000),
('8800383', 40, 40000, 4, 160000),
('8897558', 40, 40000, 28, 1120000),
('9095777', 40, 40000, 1, 40000),
('956642', 40, 40000, 1, 40000),
('9829579', 40, 40000, 1, 40000),
('2926267', 41, 480000, 1, 480000),
('3306043', 41, 480000, 1, 480000),
('400936', 41, 480000, 1, 480000),
('6172143', 41, 480000, 1, 480000),
('6541187', 41, 480000, 30, 8388607),
('6762211', 41, 480000, 1, 480000),
('7024719', 41, 480000, 1, 480000),
('8112471', 41, 480000, 88, 8388607),
('8337388', 41, 480000, 4, 1920000),
('9049060', 41, 480000, 1, 480000),
('9758189', 41, 480000, 10, 4800000),
('1791080', 42, 25000, 1, 25000),
('2231280', 42, 25000, 1, 25000),
('2999870', 42, 25000, 1, 25000),
('3275576', 42, 25000, 1, 25000),
('3306043', 42, 25000, 3, 75000),
('3492986', 42, 25000, 29, 725000),
('6172143', 42, 25000, 2, 50000),
('6569467', 42, 25000, 1, 25000),
('6590716', 42, 25000, 1, 25000),
('7179649', 42, 25000, 50, 1250000),
('7445684', 42, 25000, 14, 350000),
('9049060', 42, 25000, 1, 25000),
('9483768', 42, 25000, 16, 400000),
('400936', 43, 40000, 1, 40000),
('4338848', 43, 40000, 2, 80000),
('5223888', 43, 40000, 1, 40000),
('8849903', 43, 40000, 1, 40000),
('1297605', 44, 34000, 1, 34000),
('3746945', 44, 34000, 1, 34000),
('3814617', 44, 34000, 1, 34000),
('4059606', 44, 34000, 1, 34000),
('4816125', 44, 34000, 1, 34000),
('5223888', 44, 34000, 1, 34000),
('6035049', 44, 34000, 1, 34000),
('6172143', 44, 34000, 1, 34000),
('6819189', 44, 34000, 24, 816000),
('8017611', 44, 34000, 2, 68000),
('8192259', 44, 34000, 38, 1292000),
('2231280', 45, 30000, 1, 30000),
('2774573', 45, 30000, 1, 30000),
('3490945', 45, 30000, 1, 30000),
('3980904', 45, 30000, 1, 30000),
('5237140', 45, 30000, 1, 30000),
('5530055', 45, 30000, 1, 30000),
('7024719', 45, 30000, 3, 90000),
('7305626', 45, 30000, 1, 30000),
('7309290', 45, 30000, 10, 300000),
('8123285', 45, 30000, 1, 30000),
('9723301', 45, 30000, 4, 120000),
('1883795', 46, 70000, 1, 70000),
('241418', 46, 70000, 1, 70000),
('3080251', 46, 70000, 1, 70000),
('3306043', 46, 70000, 1, 70000),
('4924507', 46, 70000, 1, 70000),
('617180', 46, 70000, 1, 70000),
('742770', 46, 70000, 1, 70000),
('9049060', 46, 70000, 1, 70000),
('9653047', 46, 70000, 30, 2100000),
('400936', 47, 35000, 1, 35000),
('4059606', 47, 35000, 1, 35000),
('6569467', 47, 35000, 1, 35000),
('7024719', 47, 35000, 2, 70000),
('8849903', 47, 35000, 1, 35000),
('9653047', 47, 35000, 1, 35000),
('1405818', 48, 40000, 1, 40000),
('2524627', 48, 40000, 2, 80000),
('3306043', 48, 40000, 2, 80000),
('3716853', 48, 40000, 1, 40000),
('4059606', 48, 40000, 1, 40000),
('5109489', 48, 40000, 5, 200000),
('6590716', 48, 40000, 1, 40000),
('8414361', 48, 40000, 1, 40000),
('9653047', 48, 40000, 1, 40000),
('1883795', 49, 40000, 1, 40000),
('400936', 49, 40000, 1, 40000),
('4816125', 49, 40000, 1, 40000),
('5279070', 49, 40000, 10, 400000),
('7024719', 49, 40000, 1, 40000),
('8283078', 49, 40000, 9, 360000),
('9049060', 49, 40000, 1, 40000),
('9653047', 49, 40000, 1, 40000),
('4059606', 51, 40000, 1, 40000),
('4816125', 51, 40000, 1, 40000),
('5223888', 51, 40000, 1, 40000),
('5279070', 51, 40000, 1, 40000),
('5661471', 51, 40000, 10, 400000),
('9653047', 51, 40000, 1, 40000),
('2524627', 52, 40000, 1, 40000),
('5279070', 52, 40000, 1, 40000),
('3192033', 53, 40000, 1, 40000),
('4746667', 53, 40000, 1, 40000),
('3192033', 54, 40000, 1, 40000),
('4543062', 54, 40000, 1, 40000),
('6735543', 54, 40000, 15, 600000),
('1297605', 55, 40000, 1, 40000),
('132848', 55, 40000, 1, 40000),
('1711015', 55, 40000, 17, 680000),
('2208201', 55, 40000, 1, 40000),
('256157', 55, 40000, 1, 40000),
('2715860', 55, 40000, 1, 40000),
('2999870', 55, 40000, 1, 40000),
('3343699', 55, 40000, 1, 40000),
('400936', 55, 40000, 1, 40000),
('4059606', 55, 40000, 1, 40000),
('4816125', 55, 40000, 1, 40000),
('7210349', 55, 40000, 23, 920000),
('787633', 55, 40000, 2, 80000),
('8358642', 55, 40000, 1, 40000),
('8745565', 55, 40000, 1, 40000),
('9049060', 55, 40000, 1, 40000),
('9586706', 55, 40000, 2, 80000),
('9723301', 55, 40000, 1, 40000),
('9836692', 55, 40000, 1, 40000),
('1883795', 56, 40000, 1, 40000),
('2833334', 56, 40000, 1, 40000),
('400936', 56, 40000, 1, 40000),
('8017611', 56, 40000, 1, 40000),
('8358642', 56, 40000, 1, 40000),
('8978897', 56, 40000, 1, 40000),
('400936', 57, 40000, 1, 40000),
('4059606', 57, 40000, 1, 40000),
('4543062', 57, 40000, 1, 40000),
('4924507', 57, 40000, 1, 40000),
('8745565', 57, 40000, 1, 40000),
('2380172', 58, 40000, 19, 760000),
('400936', 58, 40000, 1, 40000),
('5223888', 58, 40000, 1, 40000),
('3652995', 61, 65000, 1, 65000),
('8337388', 61, 65000, 8, 520000),
('8017611', 63, 75000, 1, 75000),
('400936', 64, 69000, 1, 69000),
('4543062', 64, 69000, 1, 69000),
('9049060', 64, 69000, 1, 69000),
('4681099', 66, 70002, 1, 70002),
('2964887', 68, 53000, 1, 53000),
('742770', 68, 53000, 1, 53000),
('8017611', 68, 53000, 1, 53000),
('8745565', 69, 53000, 1, 53000),
('1883795', 70, 53000, 1, 53000),
('4681099', 70, 53000, 1, 53000),
('8414361', 70, 53000, 2, 106000),
('8978897', 70, 53000, 1, 53000),
('4681099', 71, 100000, 1, 100000),
('4543062', 73, 83003, 1, 83003),
('5485302', 73, 83003, 9, 747027),
('2121805', 74, 230000, 2, 460000),
('2524627', 74, 230000, 1, 230000),
('3675579', 74, 230000, 1, 230000),
('4059606', 74, 230000, 1, 230000),
('4816125', 74, 230000, 1, 230000),
('5919730', 74, 230000, 1, 230000),
('6172143', 74, 230000, 1, 230000),
('6880291', 74, 230000, 5, 1150000),
('8017611', 74, 230000, 1, 230000),
('9407898', 74, 230000, 2, 460000),
('6172143', 75, 90000, 1, 90000),
('7573940', 75, 90000, 1, 90000),
('9049060', 75, 90000, 1, 90000),
('2121805', 76, 139000, 1, 139000),
('2524627', 76, 139000, 1, 139000),
('3565132', 76, 139000, 1, 139000),
('8017611', 76, 139000, 1, 139000),
('2121805', 77, 100000, 1, 100000),
('3652995', 77, 100000, 3, 300000),
('7573940', 77, 100000, 1, 100000),
('2524627', 78, 150002, 1, 150002),
('2964887', 78, 150002, 1, 150002),
('3746945', 78, 150002, 1, 150002),
('4059606', 78, 150002, 1, 150002),
('4571255', 78, 150002, 1, 150002),
('8017611', 78, 150002, 1, 150002),
('9049060', 78, 150002, 1, 150002),
('9163292', 78, 150002, 1, 150002),
('9407898', 78, 150002, 1, 150002),
('9829579', 78, 150002, 1, 150002),
('4048057', 80, 140002, 9, 1260018),
('7573940', 80, 140002, 1, 140002),
('1930770', 81, 168000, 16, 2688000),
('9049060', 82, 75000, 1, 75000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `or_id` varchar(11) NOT NULL,
  `cus_id` int(11) NOT NULL,
  `or_pay` varchar(255) NOT NULL,
  `or_total` mediumint(9) NOT NULL,
  `or_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `or_status` int(11) NOT NULL DEFAULT '0',
  `or_ship` mediumint(9) NOT NULL,
  `u_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`or_id`, `cus_id`, `or_pay`, `or_total`, `or_date`, `or_status`, `or_ship`, `u_id`) VALUES
('1225691', 17, 'ship code', 0, '2021-11-03 22:36:13', 0, 0, 0),
('1244343', 11, 'ship code', 0, '2021-11-03 22:39:27', 0, 0, 0),
('1297605', 11, 'ship code', 134000, '2021-11-04 20:00:11', 0, 20000, 0),
('132848', 0, 'ship code', 60000, '2021-11-04 16:52:18', 1, 20000, 6),
('1405818', 112, 'ship code', 60000, '2021-11-05 17:00:28', 0, 20000, 0),
('1711015', 17, 'ship code', 680020, '2021-11-03 22:22:32', 0, 20, 0),
('1711661', 17, 'ship code', 0, '2021-11-03 22:24:37', 0, 0, 0),
('1791080', 0, 'ship code', 25020, '2021-10-28 16:17:51', 1, 20, 6),
('1798547', 11, 'ship code', 60, '2021-11-03 22:18:50', 0, 20, 0),
('1883795', 14, 'ship code', 203020, '2021-10-28 14:33:58', 0, 20, 0),
('1930770', 17, 'ship code', 2708, '2021-11-03 23:15:21', 0, 20, 0),
('1936353', 0, 'ship code', 120000, '2021-11-04 16:42:22', 0, 20000, 0),
('2022446', 0, 'ship code', 20020, '2021-11-02 14:43:47', 1, 20, 6),
('2032312', 11, 'ship code', 0, '2021-11-03 22:38:39', 0, 0, 0),
('2103725', 17, 'ship code', 0, '2021-11-03 23:19:36', 0, 0, 0),
('2121805', 0, 'ship code', 719000, '2021-11-03 23:23:03', 0, 20000, 0),
('2154060', 11, 'ship code', 0, '2021-11-03 22:17:11', 0, 0, 0),
('2208201', 14, 'ship code', 60020, '2021-10-29 14:34:35', 0, 20, 0),
('2231280', 11, 'ship code', 95020, '2021-10-30 01:26:00', 0, 20, 0),
('2380172', 17, 'ship code', 780, '2021-11-03 22:47:09', 0, 20, 0),
('241418', 0, 'ship code', 70020, '2021-10-26 16:17:27', 0, 20, 0),
('2442296', 11, 'ship code', 0, '2021-11-03 19:46:12', 0, 0, 0),
('2460500', 11, 'ship code', 0, '2021-11-03 22:17:04', 0, 0, 0),
('2469077', 0, 'ship code', 120000, '2021-11-04 16:42:15', 0, 20000, 0),
('2524627', 11, 'ship code', 659, '2021-11-04 00:06:58', 0, 20, 0),
('256157', 17, 'ship code', 60000, '2021-11-04 16:38:53', 0, 20000, 0),
('2649390', 17, 'ship code', 0, '2021-11-03 23:19:26', 0, 0, 0),
('2715860', 0, 'ship code', 60, '2021-11-03 18:28:52', 0, 20, 0),
('2723744', 0, 'ship code', 20020, '2021-10-30 14:44:52', 0, 20, 0),
('2761551', 17, 'ship code', 0, '2021-11-03 23:21:48', 0, 0, 0),
('2774573', 0, 'ship code', 30020, '2021-10-30 14:41:52', 0, 20, 0),
('2833334', 17, 'ship code', 60000, '2021-11-03 23:21:33', 0, 20000, 0),
('2922549', 0, 'ship code', 20020, '2021-10-30 14:43:00', 1, 20, 6),
('2926267', 13, 'ship code', 480020, '2021-10-29 14:17:11', 0, 20, 0),
('2964887', 104, 'ship code', 243002, '2021-11-05 16:03:08', 0, 20000, 0),
('2980390', 11, 'ship code', 0, '2021-11-03 22:38:51', 0, 0, 0),
('2999870', 11, 'ship code', 65020, '2021-10-29 14:09:43', 0, 20, 0),
('3080251', 0, 'ship code', 70020, '2021-10-28 16:17:13', 0, 20, 0),
('3083883', 104, 'ship code', 40000, '2021-11-05 15:47:48', 0, 20000, 0),
('3192033', 13, 'ship code', 80020, '2021-10-29 14:14:15', 0, 20, 0),
('3275576', 13, 'ship code', 25020, '2021-10-29 14:14:58', 0, 20, 0),
('3306043', 0, 'ship code', 745020, '2021-10-25 16:02:54', 0, 20, 0),
('3343699', 0, 'ship code', 40020, '2021-10-28 16:16:41', 1, 20, 6),
('34862', 17, 'ship code', 0, '2021-11-03 22:35:34', 0, 0, 0),
('3490945', 0, 'ship code', 30020, '2021-10-30 14:34:08', 0, 20, 0),
('3492986', 17, 'ship code', 745000, '2021-11-04 14:26:04', 0, 20000, 0),
('3565132', 11, 'ship code', 159, '2021-11-03 22:50:22', 0, 20, 0),
('3607945', 114, 'ship code', 40000, '2021-11-05 17:23:08', 0, 20000, 0),
('3652995', 13, 'ship code', 365020, '2021-10-29 14:29:34', 0, 20, 0),
('3675579', 114, 'ship code', 290000, '2021-11-05 17:26:58', 0, 20000, 0),
('3716853', 105, 'ship code', 60000, '2021-11-05 15:52:32', 0, 20000, 0),
('3746945', 17, 'ship code', 204, '2021-11-03 23:19:12', 0, 20, 0),
('3814617', 17, 'ship code', 54, '2021-11-03 23:20:16', 0, 20, 0),
('3980904', 11, 'ship code', 30020, '2021-10-30 01:26:10', 0, 20, 0),
('3996567', 17, 'ship code', 0, '2021-11-03 22:36:11', 0, 0, 0),
('400936', 11, 'ship code', 1264020, '2021-11-02 13:59:32', 0, 20, 0),
('4048057', 17, 'ship code', 1280, '2021-11-03 22:57:29', 0, 20, 0),
('4059606', 11, 'ship code', 769002, '2021-11-04 19:52:18', 0, 20000, 0),
('4106404', 0, 'ship code', 20020, '2021-10-30 14:43:27', 0, 20, 0),
('4171583', 17, 'ship code', 0, '2021-11-03 23:20:18', 0, 0, 0),
('4195043', 11, 'ship code', 20020, '2021-11-01 01:40:34', 0, 20, 0),
('4226689', 0, 'ship code', 20020, '2021-10-30 14:42:19', 0, 20, 0),
('4338848', 11, 'ship code', 100000, '2021-11-05 15:43:10', 0, 20000, 0),
('4543062', 13, 'ship code', 232023, '2021-10-29 14:28:07', 0, 20, 0),
('4571255', 17, 'ship code', 170002, '2021-11-03 23:21:04', 0, 20000, 0),
('4612406', 11, 'ship code', 0, '2021-11-03 19:46:14', 0, 0, 0),
('4681099', 13, 'ship code', 223022, '2021-10-29 14:26:17', 0, 20, 0),
('4746667', 113, 'ship code', 60000, '2021-11-05 17:01:51', 0, 20000, 0),
('4816125', 11, 'ship code', 524000, '2021-11-04 21:30:50', 0, 20000, 0),
('4879519', 17, 'ship code', 40000, '2021-11-04 16:37:23', 0, 20000, 0),
('4924507', 13, 'ship code', 110020, '2021-10-29 14:14:40', 0, 20, 0),
('4939727', 17, 'ship code', 0, '2021-11-03 22:24:32', 0, 0, 0),
('5109489', 110, 'ship code', 340000, '2021-11-05 16:43:47', 0, 20000, 0),
('5154480', 0, 'ship code', 60020, '2021-10-31 22:26:03', 0, 20, 0),
('5223888', 11, 'ship code', 254000, '2021-11-04 23:26:20', 0, 20000, 0),
('5237140', 11, 'ship code', 30020, '2021-10-30 01:27:27', 0, 20, 0),
('5279070', 106, 'ship code', 500000, '2021-11-05 15:51:06', 0, 20000, 0),
('5370766', 17, 'ship code', 0, '2021-11-03 22:24:34', 0, 0, 0),
('5485302', 17, 'ship code', 767027, '2021-11-03 23:40:01', 0, 20000, 0),
('5530055', 11, 'ship code', 30020, '2021-10-30 01:33:31', 0, 20, 0),
('5661471', 0, 'ship code', 420, '2021-11-03 19:47:02', 0, 20, 0),
('5919730', 0, 'ship code', 250000, '2021-11-04 16:47:58', 0, 20000, 0),
('6035049', 11, 'ship code', 34020, '2021-11-01 01:44:23', 0, 20, 0),
('6104777', 17, 'ship code', 0, '2021-11-03 23:19:28', 0, 0, 0),
('617180', 0, 'ship code', 70020, '2021-10-28 16:16:59', 0, 20, 0),
('6172143', 11, 'ship code', 904020, '2021-11-03 00:52:27', 0, 20, 0),
('6176287', 11, 'ship code', 0, '2021-11-03 22:17:17', 0, 0, 0),
('6541187', 11, 'ship code', 14420, '2021-11-04 14:16:08', 0, 20000, 0),
('6569467', 11, 'ship code', 140000, '2021-11-04 14:24:36', 0, 20000, 0),
('6590716', 13, 'ship code', 85020, '2021-10-29 14:16:27', 0, 20, 0),
('6606988', 17, 'ship code', 0, '2021-11-03 23:19:18', 0, 0, 0),
('6735543', 11, 'ship code', 600020, '2021-11-01 02:09:19', 0, 20, 0),
('6762211', 0, 'ship code', 540020, '2021-10-28 16:01:04', 0, 20, 0),
('6819189', 17, 'ship code', 836000, '2021-11-04 23:29:21', 0, 20000, 0),
('6872994', 11, 'ship code', 0, '2021-11-03 22:39:05', 0, 0, 0),
('6880291', 17, 'ship code', 1170, '2021-11-04 00:08:25', 0, 20000, 0),
('7024719', 11, 'ship code', 780020, '2021-10-29 14:09:26', 0, 20, 0),
('7147345', 17, 'ship code', 0, '2021-11-03 23:19:30', 0, 0, 0),
('7179649', 0, 'ship code', 1250020, '2021-10-28 16:13:11', 0, 20, 0),
('7210349', 17, 'ship code', 940000, '2021-11-04 21:31:45', 0, 20000, 0),
('7305626', 0, 'ship code', 30020, '2021-10-30 14:39:04', 0, 20, 0),
('7309290', 11, 'ship code', 300020, '2021-11-01 01:43:42', 0, 20, 0),
('742770', 13, 'ship code', 123020, '2021-10-29 14:26:41', 0, 20, 0),
('7445684', 0, 'ship code', 350020, '2021-10-28 16:15:22', 0, 20, 0),
('7573940', 11, 'ship code', 350, '2021-11-03 22:48:59', 0, 20, 0),
('7669762', 17, 'ship code', 0, '2021-11-03 23:19:38', 0, 0, 0),
('787633', 0, 'ship code', 80020, '2021-10-28 16:03:16', 0, 20, 0),
('7945213', 17, 'ship code', 0, '2021-11-03 22:24:35', 0, 0, 0),
('8017611', 11, 'ship code', 775002, '2021-11-04 14:15:16', 0, 20000, 0),
('8065651', 17, 'ship code', 0, '2021-11-03 22:36:04', 0, 0, 0),
('8112471', 17, 'ship code', 42260, '2021-11-03 19:44:24', 0, 20, 0),
('8123285', 0, 'ship code', 30020, '2021-10-30 14:35:41', 0, 20, 0),
('8134082', 11, 'ship code', 0, '2021-11-03 22:17:13', 0, 0, 0),
('8192259', 11, 'ship code', 1292020, '2021-11-01 01:48:57', 0, 20, 0),
('8283078', 0, 'ship code', 380, '2021-11-03 19:45:49', 0, 20, 0),
('8337388', 13, 'ship code', 2460020, '2021-10-29 14:29:07', 0, 20, 0),
('8338009', 0, 'ship code', 20020, '2021-10-30 14:42:25', 0, 20, 0),
('8358642', 11, 'ship code', 140020, '2021-10-29 14:13:05', 0, 20, 0),
('8414361', 14, 'ship code', 146020, '2021-10-29 14:31:33', 0, 20, 0),
('8681863', 17, 'ship code', 0, '2021-11-03 23:19:32', 0, 0, 0),
('8745565', 11, 'ship code', 193, '2021-11-03 16:15:35', 0, 20, 0),
('8748028', 11, 'ship code', 0, '2021-11-03 22:17:20', 0, 0, 0),
('8800383', 0, 'ship code', 160020, '2021-10-28 23:18:57', 0, 20, 0),
('8849903', 13, 'ship code', 75020, '2021-10-29 14:13:56', 0, 20, 0),
('889191', 17, 'ship code', 0, '2021-11-03 22:24:39', 0, 0, 0),
('8896956', 0, 'ship code', 40000, '2021-11-04 16:47:29', 0, 20000, 0),
('8897558', 17, 'ship code', 1140, '2021-11-03 22:18:38', 0, 20, 0),
('8962946', 11, 'ship code', 0, '2021-11-03 22:17:14', 0, 0, 0),
('8975893', 0, 'ship code', 20020, '2021-10-30 14:43:58', 0, 20, 0),
('8978897', 14, 'ship code', 93020, '2021-10-29 14:32:04', 0, 20, 0),
('9011588', 11, 'ship code', 60, '2021-11-03 19:47:08', 0, 20, 0),
('9049060', 17, 'ship code', 1059022, '2021-10-29 20:49:36', 0, 20, 0),
('9095777', 17, 'ship code', 60000, '2021-11-04 16:46:16', 0, 20000, 0),
('9163292', 17, 'ship code', 170002, '2021-11-04 16:39:35', 0, 20000, 0),
('9167433', 0, 'ship code', 40020, '2021-10-28 23:31:34', 0, 20, 0),
('9340855', 17, 'ship code', 0, '2021-11-03 22:36:06', 0, 0, 0),
('9407898', 11, 'ship code', 630002, '2021-11-03 23:35:52', 0, 20000, 0),
('9426113', 0, 'ship code', 20020, '2021-10-30 14:45:09', 0, 20, 0),
('9483768', 17, 'ship code', 420, '2021-11-03 19:43:30', 0, 20, 0),
('956642', 17, 'ship code', 60000, '2021-11-04 16:39:20', 0, 20000, 0),
('9586706', 17, 'ship code', 100000, '2021-11-04 16:47:05', 0, 20000, 0),
('9647638', 17, 'ship code', 0, '2021-11-03 23:19:34', 0, 0, 0),
('9653047', 0, 'ship code', 2275, '2021-11-04 00:52:16', 0, 20000, 0),
('9723301', 0, 'ship code', 160020, '2021-10-31 19:31:18', 0, 20, 0),
('9737639', 11, 'ship code', 0, '2021-11-03 22:17:18', 0, 0, 0),
('9744190', 17, 'ship code', 0, '2021-11-03 23:19:16', 0, 0, 0),
('9748683', 11, 'ship code', 0, '2021-11-03 22:37:00', 0, 0, 0),
('9758189', 0, 'ship code', 4820, '2021-11-03 18:29:23', 0, 20, 0),
('9778415', 11, 'ship code', 20020, '2021-11-01 01:40:19', 0, 20, 0),
('9829579', 11, 'ship code', 270002, '2021-11-04 20:01:17', 0, 20000, 0),
('9836692', 13, 'ship code', 60020, '2021-10-29 14:13:34', 0, 20, 0),
('992142', 11, 'ship code', 0, '2021-11-03 22:36:32', 0, 0, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `pr_id` int(11) NOT NULL,
  `pr_name` varchar(255) NOT NULL,
  `pr_author` varchar(255) NOT NULL,
  `pr_pub` varchar(255) NOT NULL,
  `pr_status` int(11) NOT NULL,
  `pr_category` int(11) NOT NULL,
  `pr_code` varchar(11) NOT NULL,
  `pr_number` int(11) NOT NULL,
  `pr_price` bigint(15) NOT NULL,
  `pr_discount` bigint(15) NOT NULL,
  `pr_img` text NOT NULL,
  `pr_date` date DEFAULT NULL,
  `pr_desc` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`pr_id`, `pr_name`, `pr_author`, `pr_pub`, `pr_status`, `pr_category`, `pr_code`, `pr_number`, `pr_price`, `pr_discount`, `pr_img`, `pr_date`, `pr_desc`) VALUES
(38, 'Tranh Truyện Màu Đồng Hành Với Phim Hoạt Hình - Frozen Công Chúa Băng Tuyết', 'Nhóm hoạ sĩ truyện tranh Disney, Lisa Marsoli', 'Nhà Xuất Bản Kim Đồng', 1, 2, 'congchua', 30, 30000, 10000, 'img/congchua/uY9vIfOe.jpg,img/congchua/6zDMrqqq.jpg,img/congchua/nMDLJsBC.jpg,img/congchua/T1OTUjvM.jpg,img/congchua/DevmThMQ.jpg', '2021-10-28', 'Công chúa Elsa sở hữu quyền năng tạo ra băng tuyết và giá lạnh, nhưng lại không biết cách kiểm soát quyền năng này. Chính vì vậy Elsa phải chấp nhận sống xa mọi người, kể cả em gái Anna yêu thương. Tuy nhiên, vào ngày Elsa lên ngôi nữ hoàng, một sự cố kinh khủng đã xảy ra khiến cô phải rời bỏ kinh thành lên đỉnh núi cao xa lánh toàn vương quốc. Không chấp nhận điều đó và cũng để cứu dân chúng trong thành khỏi tai họa Elsa gây ra, Anna xông pha đi tìm chị…\r\n\r\nLIỆU NHỮNG YÊU THƯƠNG CÓ THỂ LÀM TAN CHẢY TRÁI TIM BĂNG GIÁ CỦA ELSA? “Frozen – Công chúa băng tuyết” được lấy cảm hứng từ truyện cổ tích nổi tiếng của Andersen. Các nhà làm phim và truyện tranh mới thổi thêm vào nó những hơi thở hiện đại, và các nàng công chúa mới hẳn sẽ đem đến những điều thú vị!                                        '),
(39, 'Tranh Truyện Màu Đồng Hành Với Phim Hoạt Hình: Toy Story - Câu Chuyện Đồ Chơi', 'Nguyễn Phương Lan', 'NXB Kim Đồng', 2, 2, 'toystory', 13, 25000, 5000, 'img/toystory/fa6QZWDy.jpg,img/toystory/qzHoJS56.jpg,img/toystory/A8gno6Dm.jpg,img/toystory/V4ecR53x.jpg,img/toystory/Cyw20QC1.jpg', '2021-10-28', 'Tranh Truyện Màu Đồng Hành Với Phim Hoạt Hình: Toy Story - Câu Chuyện Đồ Chơi\n\nCao bồi Woody vốn là món đồ chơi thân thiết nhất của cậu bé Andy. Nhưng sự xuất hiện của chàng chiến binh không gian mang tên Buzz Lightyear đã thay đổi tất cả! Quá ghen tị, Woody bày trò chơi xấu anh bạn mới đến. Cậu không ngờ hành động nông nổi ấy là khởi đầu cho một loạt những sự cố.\n\nBị các bạn đồ chơi khác tẩy chay, bị anh bạn mới đến xa lánh, và tự đẩy mình vào bao cảnh hiểm nguy, hẳn Woody sẽ nhận ra nhiều điều thấm thía.\n\nNhưng trước hết, cậu phải tìm đường để giải cứu mình và đưa anh chàng Buzz về với cậu chủ Andy cái đã…\n\nMã hàng	9786042106481\nTên Nhà Cung Cấp	Nhà Xuất Bản Kim Đồng\nTác giả	Nhóm tác giả và họa sĩ Disney-Pixar\nNgười Dịch	Nguyễn Phương Lan\nNXB	NXB Kim Đồng\nNăm XB	2018\nTrọng lượng (gr)	100\nKích Thước Bao Bì	17.5 x 24\nSố trang	64\nHình thức	Bìa Mềm\nSản phẩm hiển thị trong	\nDisney Frozen\nSản phẩm bán chạy nhất	Top 100 sản phẩm Truyện Tranh Thiếu Nhi bán chạy của tháng\nTranh Truyện Màu Đồng Hành Với Phim Hoạt Hình: Toy Story - Câu Chuyện Đồ Chơi\n\nCao bồi Woody vốn là món đồ chơi thân thiết nhất của cậu bé Andy. Nhưng sự xuất hiện của chàng chiến binh không gian mang tên Buzz Lightyear đã thay đổi tất cả! Quá ghen tị, Woody bày trò chơi xấu anh bạn mới đến. Cậu không ngờ hành động nông nổi ấy là khởi đầu cho một loạt những sự cố.\n\nBị các bạn đồ chơi khác tẩy chay, bị anh bạn mới đến xa lánh, và tự đẩy mình vào bao cảnh hiểm nguy, hẳn Woody sẽ nhận ra nhiều điều thấm thía.\n\nNhưng trước hết, cậu phải tìm đường để giải cứu mình và đưa anh chàng Buzz về với cậu chủ Andy cái đã…'),
(40, 'Tranh Truyện Màu Đồng Hành Với Phim Hoạt Hình: Frozen 2 - Khu Rừng Phép Thuật', 'Nguyễn Minh Hiếu', 'NXB Kim Đồng', 2, 2, 'frozen2', 14, 50000, 10000, 'img/frozen2/OxqwTZN3.jpg,img/frozen2/CXRI1W9F.jpg,img/frozen2/qVVGLWzW.jpg,img/frozen2/HNhjAUNJ.jpg,img/frozen2/8PPEumYJ.jpg', '2021-10-28', 'Tranh Truyện Màu Đồng Hành Với Phim Hoạt Hình: Frozen 2 - Khu Rừng Phép Thuật\n\nFrozen 2 - Khu rừng Phép thuật là cuốn sách tiếp theo trong tủ sách Tranh truyện màu đồng hành với phim hoạt hình. Nội dung sách bám sát câu chuyện trong phim Frozen 2 (tựa Việt là Nữ hoàng Băng giá 2) của hãng Disney. Đó là hành trình tìm đến Khu rừng Phép thuật để khám phá những bí ẩn trong quá khứ cũng như cội nguồn sức mạnh băng tuyết của nàng Elsa. Đồng hành với Elsa là em gái Anna và những người bạn thân thiết từ phần một. Trải qua bao gian khó và hiểm nguy, một lần nữa, tình cảm chị em giữa hai nàng công chúa xứ Arendelle lại càng khăng khít và bền chặt, mang đến cho độc giả nhỏ nhiều khoảnh khắc xúc động.\n\nKhác với những hình ảnh 3D mượt mà và trau chuốt trên phim, cuốn sách Frozen 2 - Khu rừng Phép thuật mang nét vẽ khỏe khoắn nhưng không kém phần lôi cuốn, hứa hẹn là món quà tuyệt đẹp dành tặng các độc giả nhí yêu thích tựa phim Frozen.\n\nĐôi nét về bộ phim:\n\nFrozen 2 là phần kế tiếp của bộ phim Frozen ra mắt từ năm 2013 từng được nhiều bạn nhỏ, đặc biệt là các bé gái, vô cùng yêu thích. Phần phim thứ hai này tiếp tục được đánh giá cao về mặt hình ảnh đồ họa và âm thanh. Chuyến phiêu lưu mới nhất của chị em Elsa và Anna đã gây nên cơn sốt lớn và liên tiếp lập kỉ lục phòng vé trên toàn cầu.\n\nMã hàng	8935244842272\nĐộ Tuổi	7+\nTên Nhà Cung Cấp	Nhà Xuất Bản Kim Đồng\nTác giả	Nhóm Tác Giả Và Hoạ Sĩ Disney\nNXB	NXB Kim Đồng\nNăm XB	2020\nNgôn Ngữ	Tiếng Việt\nTrọng lượng (gr)	150\nKích Thước Bao Bì	24 x 17.5 x 0.5 cm\nSố trang	132\nHình thức	Bìa Mềm\nSản phẩm bán chạy nhất	Top 100 sản phẩm Truyện Tranh Thiếu Nhi bán chạy của tháng\nTranh Truyện Màu Đồng Hành Với Phim Hoạt Hình: Frozen 2 - Khu Rừng Phép Thuật\n\nFrozen 2 - Khu rừng Phép thuật là cuốn sách tiếp theo trong tủ sách Tranh truyện màu đồng hành với phim hoạt hình. Nội dung sách bám sát câu chuyện trong phim Frozen 2 (tựa Việt là Nữ hoàng Băng giá 2) của hãng Disney. Đó là hành trình tìm đến Khu rừng Phép thuật để khám phá những bí ẩn trong quá khứ cũng như cội nguồn sức mạnh băng tuyết của nàng Elsa. Đồng hành với Elsa là em gái Anna và những người bạn thân thiết từ phần một. Trải qua bao gian khó và hiểm nguy, một lần nữa, tình cảm chị em giữa hai nàng công chúa xứ Arendelle lại càng khăng khít và bền chặt, mang đến cho độc giả nhỏ nhiều khoảnh khắc xúc động.\n\nKhác với những hình ảnh 3D mượt mà và trau chuốt trên phim, cuốn sách Frozen 2 - Khu rừng Phép thuật mang nét vẽ khỏe khoắn nhưng không kém phần lôi cuốn, hứa hẹn là món quà tuyệt đẹp dành tặng các độc giả nhí yêu thích tựa phim Frozen.\n\nĐôi nét về bộ phim:\n\nFrozen 2 là phần kế tiếp của bộ phim Frozen ra mắt từ năm 2013 từng được nhiều bạn nhỏ, đặc biệt là các bé gái, vô cùng yêu thích. Phần phim thứ hai này tiếp tục được đánh giá cao về mặt hình ảnh đồ họa và âm thanh. Chuyến phiêu lưu mới nhất của chị em Elsa và Anna đã gây nên cơn sốt lớn và liên tiếp lập kỉ lục phòng vé trên toàn cầu.'),
(41, 'Tranh Truyện Màu Đồng Hành Với Phim Hoạt Hình: Frozen Combo Frozen  (Bộ 7 Cuốn)', 'Nguyễn Minh Hiếu', 'Kim Đồng', 2, 2, 'frozen3', 0, 500000, 20000, 'img/frozen3/hpy4zBmV.jpg,img/frozen3/plcVhQ3S.jpg,img/frozen3/q2YJJcfh.jpg,img/frozen3/k1KtHEOT.jpg,img/frozen3/HfnpvcQo.jpg,img/frozen3/l8a5dZnA.jpg,img/frozen3/7FeMOT5b.jpg', '2021-10-28', 'Combo Frozen Thoả Sức Sáng Tạo (Bộ 7 Cuốn)\n\nBộ sách Frozen Tô màu cùng Công chúa Băng Tuyết gồm 6 cuốn. Mỗi cuốn có rất nhiều trang tô màu.\n\nHãy tự trang trí phòng mình bằng những bức tô màu rực rỡ!\n\nTranh Truyện Màu Đồng Hành Với Phim Hoạt Hình: Frozen 2 - Khu Rừng Phép Thuật\n\nFrozen 2 - Khu rừng Phép thuật là cuốn sách tiếp theo trong tủ sách Tranh truyện màu đồng hành với phim hoạt hình. Nội dung sách bám sát câu chuyện trong phim Frozen 2 (tựa Việt là Nữ hoàng Băng giá 2) của hãng Disney. Đó là hành trình tìm đến Khu rừng Phép thuật để khám phá những bí ẩn trong quá khứ cũng như cội nguồn sức mạnh băng tuyết của nàng Elsa. Đồng hành với Elsa là em gái Anna và những người bạn thân thiết từ phần một. Trải qua bao gian khó và hiểm nguy, một lần nữa, tình cảm chị em giữa hai nàng công chúa xứ Arendelle lại càng khăng khít và bền chặt, mang đến cho độc giả nhỏ nhiều khoảnh khắc xúc động.\n\nKhác với những hình ảnh 3D mượt mà và trau chuốt trên phim, cuốn sách Frozen 2 - Khu rừng Phép thuật mang nét vẽ khỏe khoắn nhưng không kém phần lôi cuốn, hứa hẹn là món quà tuyệt đẹp dành tặng các độc giả nhí yêu thích tựa phim Frozen.\n\nĐôi nét về bộ phim:\n\nFrozen 2 là phần kế tiếp của bộ phim Frozen ra mắt từ năm 2013 từng được nhiều bạn nhỏ, đặc biệt là các bé gái, vô cùng yêu thích. Phần phim thứ hai này tiếp tục được đánh giá cao về mặt hình ảnh đồ họa và âm thanh. Chuyến phiêu lưu mới nhất của chị em Elsa và Anna đã gây nên cơn sốt lớn và liên tiếp lập kỉ lục phòng vé trên toàn cầu.\n\n1. Frozen - Tô Màu Cùng Công Chúa Băng Tuyết (Quyển 1) (Tái Bản 2019)\n\n2. Frozen - Tô Màu Cùng Công Chúa Băng Tuyết (Quyển 2) (Tái Bản 2019)\n\n3. Frozen - Tô Màu Cùng Công Chúa Băng Tuyết (Quyển 3) (Tái Bản 2019)\n\n4. Frozen - Tô Màu Cùng Công Chúa Băng Tuyết (Quyển 4) (Tái Bản 2019)\n\n5. Frozen - Tô Màu Cùng Công Chúa Băng Tuyết (Quyển 5) (Tái Bản 2019)\n\n6. Frozen - Tô Màu Cùng Công Chúa Băng Tuyết (Quyển 6) (Tái Bản 2019)\n\n7. Tranh Truyện Màu Đồng Hành Với Phim Hoạt Hình: Frozen 2 - Khu Rừng Phép Thuật\n\nMã hàng	combo-1604202013\nTên Nhà Cung Cấp	Nhà Xuất Bản Kim Đồng\nTác giả	Nhóm Tác Giả Và Hoạ Sĩ Disney\nNXB	NXB Kim Đồng\nNăm XB	2020\nTrọng lượng (gr)	750\nKích Thước Bao Bì	24 x 17.5 cm\nHình thức	Bìa Mềm\nSản phẩm bán chạy nhất	Top 100 sản phẩm Tô màu, luyện chữ bán chạy của tháng\nCombo Frozen Thoả Sức Sáng Tạo (Bộ 7 Cuốn)\n\nBộ sách Frozen Tô màu cùng Công chúa Băng Tuyết gồm 6 cuốn. Mỗi cuốn có rất nhiều trang tô màu.\n\nHãy tự trang trí phòng mình bằng những bức tô màu rực rỡ!\n\nTranh Truyện Màu Đồng Hành Với Phim Hoạt Hình: Frozen 2 - Khu Rừng Phép Thuật\n\nFrozen 2 - Khu rừng Phép thuật là cuốn sách tiếp theo trong tủ sách Tranh truyện màu đồng hành với phim hoạt hình. Nội dung sách bám sát câu chuyện trong phim Frozen 2 (tựa Việt là Nữ hoàng Băng giá 2) của hãng Disney. Đó là hành trình tìm đến Khu rừng Phép thuật để khám phá những bí ẩn trong quá khứ cũng như cội nguồn sức mạnh băng tuyết của nàng Elsa. Đồng hành với Elsa là em gái Anna và những người bạn thân thiết từ phần một. Trải qua bao gian khó và hiểm nguy, một lần nữa, tình cảm chị em giữa hai nàng công chúa xứ Arendelle lại càng khăng khít và bền chặt, mang đến cho độc giả nhỏ nhiều khoảnh khắc xúc động.\n\nKhác với những hình ảnh 3D mượt mà và trau chuốt trên phim, cuốn sách Frozen 2 - Khu rừng Phép thuật mang nét vẽ khỏe khoắn nhưng không kém phần lôi cuốn, hứa hẹn là món quà tuyệt đẹp dành tặng các độc giả nhí yêu thích tựa phim Frozen.\n\nĐôi nét về bộ phim:\n\nFrozen 2 là phần kế tiếp của bộ phim Frozen ra mắt từ năm 2013 từng được nhiều bạn nhỏ, đặc biệt là các bé gái, vô cùng yêu thích. Phần phim thứ hai này tiếp tục được đánh giá cao về mặt hình ảnh đồ họa và âm thanh. Chuyến phiêu lưu mới nhất của chị em Elsa và Anna đã gây nên cơn sốt lớn và liên tiếp lập kỉ lục phòng vé trên toàn cầu.\n\n1. Frozen - Tô Màu Cùng Công Chúa Băng Tuyết (Quyển 1) (Tái Bản 2019)\n\n2. Frozen - Tô Màu Cùng Công Chúa Băng Tuyết (Quyển 2) (Tái Bản 2019)\n\n3. Frozen - Tô Màu Cùng Công Chúa Băng Tuyết (Quyển 3) (Tái Bản 2019)\n\n4. Frozen - Tô Màu Cùng Công Chúa Băng Tuyết (Quyển 4) (Tái Bản 2019)\n\n5. Frozen - Tô Màu Cùng Công Chúa Băng Tuyết (Quyển 5) (Tái Bản 2019)\n\n6. Frozen - Tô Màu Cùng Công Chúa Băng Tuyết (Quyển 6) (Tái Bản 2019)\n\n7. Tranh Truyện Màu Đồng Hành Với Phim Hoạt Hình: Frozen 2 - Khu Rừng Phép Thuật'),
(42, 'Tranh Truyện Màu Đồng Hành Với Phim Hoạt Hình: Monster, Inc. - Công Ty Quái Vật', 'Ngô Duy Khánh', 'Kim Đồng', 2, 2, 'monster1', 0, 30000, 5000, 'img/monster1/VlNYQj7L.jpg,img/monster1/a8zQWyTE.jpg', '2021-10-28', 'Monstropolis là nơi cư ngụ của hàng vạn con quái vật đủ mọi hình dạng. Nguồn năng lượng chính để thành phố hoạt động chính là tiếng hét của các em bé loài người. Trong thế giới quái vật có một nơi chịu trách nhiệm thu thập nguồn “tài nguyên” quý giá ấy. Đó chính là công ty Quái vật, nơi các hù dọa viên như hai anh chàng Sulley lông lá và Mike một mắt chăm chỉ làm việc. Bỗng một hôm, công ty náo loạn cả lên vì một sai sót không ai ngờ tới!'),
(43, 'Tranh Truyện Đồng Hành Cùng Phim Hoạt Hình - Người Đẹp Và Quái Thú (Tái Bản 2018)', 'Hoạ sĩ Disney', 'NXB Kim Đồng', 2, 2, 'quaivat1', 27, 50000, 10000, 'img/quaivat1/YhxfpNTT.jpg,img/quaivat1/0hLp8jJU.jpg,img/quaivat1/tfOwZr6b.jpg,img/quaivat1/nrH2UNKR.jpg,img/quaivat1/4v4fUpjL.jpg,img/quaivat1/gCS3LsaM.jpg', '2021-10-28', 'Ngày xửa ngày xưa, trong lâu đài nọ có một chàng hoàng tử vô cùng hư hỏng và ích kỉ. Chàng bị một bà tiên trừng phạt và biến thành quái thú. Chỉ khi nào chàng học được cách yêu thương và được đáp lại, lời nguyền mới bị phá bỏ. Không chỉ riêng chàng, tất cả những người hầu cận trong lâu đài cũng bị biến thành các đồ vật biết nói.\n\nCon quái thú đau khổ lẫn đám đồ vật bị phù phép không còn cách nào khác ngoài mòn mỏi chờ đợi một người sẽ đến giải cứu họ. Nhưng ai có thể yêu được một gã quái thú xấu xí đây?'),
(44, 'Tranh Truyện Màu Đồng Hành Với Phim Hoạt Hình: Bolt - Chú Chó Tia Chớp', 'Họa sĩ Disney-Pixar', 'NXB Kim Đồng', 2, 2, 'bolt', 0, 35000, 1000, 'img/bolt/NAhPcDx7.jpg', '2021-10-28', 'Tranh Truyện Màu Đồng Hành Với Phim Hoạt Hình: Bolt - Chú Chó Tia Chớp\n\nÁnh mắt với sức mạnh siêu nhiên, có thể nung chảy mọi vật. Tiếng sủa siêu thanh khiến đường sá rung chuyển, xe cộ lật nhào… Đó là những năng lực đặc biệt của chú chó mang tên Bolt, nghĩa là Tia Chớp! Cùng cô chủ nhỏ Penny, Bolt xông xáo đi khắp nơi, khuất phục những kẻ gian ác!\n\nTưởng chừng những ngày sôi nổi, rực rỡ ấy chẳng bao giờ chấm dứt… Thế mà ngày nọ, cô chủ Penny bỗng nhiên biến mất, còn Bolt thì phát hiện ra một sự thật đáng buồn về bản thân mình. Bolt buộc phải bắt đầu một hành trình mới đểtìm kiếm những điều quan trọng nhất với cậu, thật may, cậu gặp được hai bạn đồng hành mới là chuột Rhino và mèo Mittens…'),
(45, 'Kỹ Năng Sống Cho Trẻ - Xử Lý Khi Bị Côn Trùng Đốt', 'ThS. Nguyễn Thu Hương', 'NXB Phụ Nữ', 1, 1, 'kynang1', 30, 35000, 5000, 'img/kynang1/wzQdH6RI.jpg,img/kynang1/baWKPU1K.jpg,img/kynang1/O5a7CPa7.jpg,img/kynang1/sVeyQIiN.jpg', '2021-10-28', 'Tính năng mới!                                                                                                                                                                                                        '),
(46, 'Kỹ Năng Sống - Cách Để Về Hưu An Nhàn', 'Lê Quang', 'NXB Hồng Đức', 2, 1, 'kynang2', 0, 90000, 20000, 'img/kynang2/32D1ug2L.jpg', '2021-10-28', 'pr_desc                                                                                                                        '),
(47, 'Kỹ Năng Sống - Cách Để Trở Thành Người Yêu Lí Tưởng', 'Lê Quang', 'NXB Hồng Đức', 2, 1, 'kynang3', 27, 45000, 10000, 'img/kynang3/tLXEiDby.jpg,img/kynang3/09B5zsPS.jpg', '2021-10-28', 'Là bộ sách độc quyền Cách Để Trở Thành của Nhân Văn nói về những khía cạnh đa dạng của cuộc sống để có thể giúp chúng ta làm đẹp tâm hồn, tính cách con người không những cho chúng ta mà con những người xung quanh. '),
(48, 'Kỹ Năng Sống - Cách Để Trở Thành Con Ngoan', 'Lê Quang', 'NXB Hồng Đức', 2, 1, 'kynang4', 21, 45000, 5000, 'img/kynang4/tBUXe48I.jpg', '2021-10-28', 'Là bộ sách độc quyền Cách Để Trở Thành của Nhân Văn nói về những khía cạnh đa dạng của cuộc sống để có thể giúp chúng ta làm đẹp tâm hồn, tính cách con người không những cho chúng ta mà con những người xung quanh.'),
(49, 'Bài Học Vô Giá Từ Những Điều Bình Dị (Tái Bản 2019)', 'Lê Quang', 'NXB Hồng Đức', 2, 1, 'kynang5', 18, 45000, 5000, 'img/kynang5/m1l0yHI1.jpg,img/kynang5/nt1htHbp.jpg,img/kynang5/8o2yvwMz.jpg', '2021-10-28', 'Là bộ sách độc quyền Cách Để Trở Thành của Nhân Văn nói về những khía cạnh đa dạng của cuộc sống để có thể giúp chúng ta làm đẹp tâm hồn, tính cách con người không những cho chúng ta mà con những người xung quanh.'),
(51, 'Kỹ Năng Sống - Cách Để Trở Thành Người Bạn Tốt', 'Lê Quang', 'NXB Hồng Đức', 2, 1, 'kynang6', 25, 45000, 5000, 'img/kynang6/sJrTJt7C.jpg', '2021-10-28', 'Là bộ sách độc quyền Cách Để Trở Thành của Nhân Văn nói về những khía cạnh đa dạng của cuộc sống để có thể giúp chúng ta làm đẹp tâm hồn, tính cách con người không những cho chúng ta mà con những người xung quanh.'),
(52, 'Kỹ Năng Sống - Cách Để Trở Thành - Cách Để Tự Bảo Vệ Mình', 'Lê Quang', 'NXB Hồng Đức', 2, 1, 'kynang7', 29, 45000, 5000, 'img/kynang7/o0Y5wtJG.jpg', '2021-10-28', 'Là bộ sách độc quyền Cách Để Trở Thành của Nhân Văn nói về những khía cạnh đa dạng của cuộc sống để có thể giúp chúng ta làm đẹp tâm hồn, tính cách con người không những cho chúng ta mà con những người xung quanh.'),
(53, 'Khoa Học Thật Là Vui - Bật Mí Chuyện Sâu Hóa Bướm', 'Nguyễn Đức Vịnh', 'NXB Thanh Niên', 1, 3, 'kh1', 29, 50000, 10000, 'img/kh1/2VpeERTa.jpg,img/kh1/JAUgXI4J.jpg,img/kh1/ZGQiggSA.jpg,img/kh1/pG0SaoIl.jpg,img/kh1/xdoga7Wc.jpg', '2021-10-28', 'Không còn là kiến thức hàn lâm, khó hiểu hay nhàm chán, thế giới khoa học sẽ mở ra trước mắt bé thật vui thật hấp dẫn với bộ sách Khoa học thật là vui này.                                        '),
(54, 'Khoa Học Thật Là Vui -Tuyệt Chiêu Thoát Thân Của Động Vật', 'Nguyễn Đức Vịnh', 'NXB Thanh Niên', 1, 3, 'kh2', 30, 50000, 10000, 'img/kh2/5LFfGyzz.jpg,img/kh2/BGiPEgwB.jpg,img/kh2/HUX0ylE3.jpg,img/kh2/iWLBJit2.jpg,img/kh2/XFe1MFMD.jpg', '2021-10-28', 'Không còn là kiến thức hàn lâm, khó hiểu hay nhàm chán, thế giới khoa học sẽ mở ra trước mắt bé thật vui thật hấp dẫn với bộ sách Khoa học thật là vui này.                                        '),
(55, 'Khoa Học Thật Là Vui - Bí Ẩn Của Bầu Trời Thiên Hà', 'Nguyễn Đức Vịnh', 'NXB Thanh Niên', 2, 3, 'kh3', 0, 50000, 10000, 'img/kh3/SgC5lDLL.jpg,img/kh3/Wr4HxP5d.jpg,img/kh3/CVc49jiA.jpg,img/kh3/EWCFfbdx.jpg,img/kh3/5B2ln9j3.jpg', '2021-10-28', 'Không còn là kiến thức hàn lâm, khó hiểu hay nhàm chán, thế giới khoa học sẽ mở ra trước mắt bé thật vui thật hấp dẫn với bộ sách Khoa học thật là vui này.'),
(56, 'Khoa Học Thật Là Vui - Cuộc Sống Của Một Nhà Du Hành Vũ Trụ', 'Nguyễn Đức Vịnh', 'NXB Thanh Niên', 2, 3, 'kh4', 29, 50000, 10000, 'img/kh4/7imDTct2.jpg,img/kh4/ab4pzFvZ.jpg,img/kh4/EZMn6A88.jpg,img/kh4/IeBLPNmS.jpg,img/kh4/ZGjj61u7.jpg', '2021-10-28', 'Không còn là kiến thức hàn lâm, khó hiểu hay nhàm chán, thế giới khoa học sẽ mở ra trước mắt bé thật vui thật hấp dẫn với bộ sách Khoa học thật là vui này.'),
(57, 'Khoa Học Thật Là Vui - Khám Phá Làn Da Của Loài Người', 'Nguyễn Đức Vịnh', 'NXB Thanh Niên', 2, 3, 'kh5', 29, 50000, 10000, 'img/kh5/wkODCeF2.jpg,img/kh5/Qxm7JuNt.jpg,img/kh5/j4TLaDG2.jpg,img/kh5/vHq7oFW3.jpg,img/kh5/Bp8WMkaw.jpg', '2021-10-28', 'Không còn là kiến thức hàn lâm, khó hiểu hay nhàm chán, thế giới khoa học sẽ mở ra trước mắt bé thật vui thật hấp dẫn với bộ sách Khoa học thật là vui này.                                        '),
(58, 'Khoa Học Thật Là Vui - Các Loại Vi Khuẩn Trong Thế Giới Tự Nhiên', 'Nguyễn Đức Vịnh', 'NXB Thanh Niên', 2, 3, 'kh6', 29, 50000, 10000, 'img/kh6/SKYpXOJO.jpg,img/kh6/okZXelVC.jpg,img/kh6/gCvl4K9G.jpg,img/kh6/rAwNRX6j.jpg,img/kh6/HuDedwVS.jpg,img/kh6/iPL0KN19.jpg', '2021-10-28', 'Không còn là kiến thức hàn lâm, khó hiểu hay nhàm chán, thế giới khoa học sẽ mở ra trước mắt bé thật vui thật hấp dẫn với bộ sách Khoa học thật là vui này.'),
(59, 'Điều Kỳ Diệu Của Tiệm Tạp Hóa Namiya (Tái Bản 2018)', 'Higashino Keigo', 'NXB Hội Nhà Văn', 2, 5, '89352352175', 30, 105000, 20000, 'img/8935235217508/vPimSm3H.jpg,img/8935235217508/ekeZALYX.jpg,img/8935235217508/aEByya4v.jpg', '2021-10-28', 'Một đêm vội vã lẩn trốn sau phi vụ khoắng đồ nhà người, Atsuya, Shota và Kouhei đã rẽ vào lánh tạm trong một căn nhà hoang bên con dốc vắng người qua lại. Căn nhà có vẻ khi xưa là một tiệm tạp hóa với biển hiệu cũ kỹ bám đầy bồ hóng, khiến người ta khó lòng đọc được trên đó viết gì. Định bụng nghỉ tạm một đêm rồi sáng hôm sau chuồn sớm, cả ba không ngờ chờ đợi cả bọn sẽ là một đêm không ngủ, với bao điều kỳ bí bắt đầu từ một phong thư bất ngờ gửi đến…\n\nTài kể chuyện hơn người đã giúp Keigo khéo léo thay đổi các mốc dấu thời gian và không gian, chắp nối những câu chuyện tưởng chừng hoàn toàn riêng rẽ thành một kết cấu chặt chẽ, gây bất ngờ từ đầu tới cuối.'),
(60, 'Khu Vườn Ngôn Từ', 'Shinkai Makoto', 'IPM', 2, 5, '89360481234', 30, 95000, 75000, 'img/8936048123431/b6XioDCb.jpg,img/8936048123431/VVJXeESO.jpg,img/8936048123431/HdXqYfbR.jpg,img/8936048123431/9SE7L2Li.jpg', '2021-10-28', 'Khu vườn ngôn từ kể về một tình yêu còn xa xưa hơn cả tình yêu.\nKhái niệm tình yêu trong tiếng Nhật hiện đại là luyến hoặc ái, nhưng vào thời xưa nó được viết là cô bi, nghĩa là nỗi buồn một mình. Shinkai Makoto đã cấu tứ Khu vườn ngôn từ theo ý nghĩa cổ điển này, miêu tả tình yêu theo khái niệm ban sơ của nó, tức là cô bi - nỗi buồn khi một mình thương nhớ một người.'),
(61, 'Cho Tôi Xin Một Vé Đi Tuổi Thơ (Bìa Mềm) (Tái Bản 2018)', 'Nguyễn Nhật Ánh', 'NXB Trẻ', 2, 5, '89349741590', 30, 80000, 15000, 'img/8934974159087/W63MH27G.jpg,img/8934974159087/fFqrqDrb.jpg,img/8934974159087/1noR4PaW.jpg,img/8934974159087/ZABPHpdW.jpg', '2021-10-28', 'Trong Cho tôi xin một vé đi tuổi thơ, nhà văn Nguyễn Nhật Ánh mời người đọc lên chuyến tàu quay ngược trở lại thăm tuổi thơ và tình bạn dễ thương của 4 bạn nhỏ. Những trò chơi dễ thương thời bé, tính cách thật thà, thẳng thắn một cách thông minh và dại dột, những ước mơ tự do trong lòng… khiến cuốn sách có thể làm các bậc phụ huynh lo lắng rồi thở phào. Không chỉ thích hợp với người đọc trẻ, cuốn sách còn có thể hấp dẫn và thực sự có ích cho người lớn trong quan hệ với con mình.'),
(62, 'Đứa Con Của Thời Tiết - Bản Thường - Tặng Kèm Postcard Màu Chất Liệu Giấy Ivory', 'SHINKAI MAKOTO', 'NXB Hà Nội', 2, 5, '89352507037', 30, 85000, 69999, 'img/8935250703741/uOcb5wiE.jpg,img/8935250703741/SLIBAyEL.jpg', '2021-10-28', 'Đứa Con Của Thời Tiết\n\nTình thơ, gặp gỡ và chia ly là những vòng sóng đồng tâm trong thế giới Shinkai Makoto.'),
(63, 'Bước Chậm Lại Giữa Thế Gian Vội Vã (Tái Bản 2018)', 'Hae Min', 'NXB Hội Nhà Văn', 2, 5, '89352352177', 29, 95000, 20000, 'img/8935235217737/D9PWT1Vu.jpg,img/8935235217737/LYBkkUJs.jpg,img/8935235217737/7MYr0n7q.jpg,img/8935235217737/oS5Qo2Ye.jpg', '2021-10-28', 'Chen vai thích cánh để có một chỗ bám trên xe buýt giờ đi làm, nhích từng xentimét bánh xe trên đường lúc tan sở, quay cuồng với thi cử và tiến độ công việc, lu bù vướng mắc trong những mối quan hệ cả thân lẫn sơ… bạn có luôn cảm thấy thế gian xung quanh mình đang xoay chuyển quá vội vàng?'),
(64, 'Nhà Giả Kim (Tái Bản 2020)', 'Paulo Coelho', 'NXB Hội Nhà Văn', 2, 5, '89352352262', 30, 79000, 10000, 'img/8935235226272/X3fe8tp7.jpg,img/8935235226272/9koCp0gS.jpg,img/8935235226272/k6YQgCbf.jpg', '2021-10-28', 'Tiểu thuyết Nhà giả kim của Paulo Coelho như một câu chuyện cổ tích giản dị, nhân ái, giàu chất thơ, thấm đẫm những minh triết huyền bí của phương Đông. Trong lần xuất bản đầu tiên tại Brazil vào năm 1988, sách chỉ bán được 900 bản. Nhưng, với số phận đặc biệt của cuốn sách dành cho toàn nhân loại, vượt ra ngoài biên giới quốc gia, Nhà giả kim đã làm rung động hàng triệu tâm hồn, trở thành một trong những cuốn sách bán chạy nhất mọi thời đại, và có thể làm thay đổi cuộc đời người đọc.\n\n“Nhưng nhà luyện kim đan không quan tâm mấy đến những điều ấy. Ông đã từng thấy nhiều người đến rồi đi, trong khi ốc đảo và sa mạc vẫn là ốc đảo và sa mạc. Ông đã thấy vua chúa và kẻ ăn xin đi qua biển cát này, cái biển cát thường xuyên thay hình đổi dạng vì gió thổi nhưng vẫn mãi mãi là biển cát mà ông đã biết từ thuở nhỏ. Tuy vậy, tự đáy lòng mình, ông không thể không cảm thấy vui trước hạnh phúc của mỗi người lữ khách, sau bao ngày chỉ có cát vàng với trời xanh nay được thấy chà là xanh tươi hiện ra trước mắt. ‘Có thể Thượng đế tạo ra sa mạc chỉ để cho con người biết quý trọng cây chà là,’ ông nghĩ.”\n\n- Trích Nhà giả kim\n\nNhận định\n\n“Sau Garcia Márquez, đây là nhà văn Mỹ Latinh được đọc nhiều nhất thế giới.” - The Economist, London, Anh\n\n \n\n“Santiago có khả năng cảm nhận bằng trái tim như Hoàng tử bé của Saint-Exupéry.” - Frankfurter Allgemeine Zeitung, Đức\n\nMã hàng	8935235226272\nTên Nhà Cung Cấp	Nhã Nam\nTác giả	Paulo Coelho\nNgười Dịch	Lê Chu Cầu\nNXB	NXB Hội Nhà Văn\nNăm XB	2020\nTrọng lượng (gr)	220\nKích Thước Bao Bì	20.5 x 13 cm\nSố trang	227\nHình thức	Bìa Mềm\nSản phẩm hiển thị trong	\nĐồ Chơi Cho Bé - Giá Cực Tốt\nNhã Nam\nTop sách được phiên dịch nhiều nhất\nVí VNPAY hoàn 50K\nZaloPay\nSản phẩm bán chạy nhất	Top 100 sản phẩm Tiểu thuyết bán chạy của tháng\nTất cả những trải nghiệm trong chuyến phiêu du theo đuổi vận mệnh của mình đã giúp Santiago thấu hiểu được ý nghĩa sâu xa nhất của hạnh phúc, hòa hợp với vũ trụ và con người. \n\nTiểu thuyết Nhà giả kim của Paulo Coelho như một câu chuyện cổ tích giản dị, nhân ái, giàu chất thơ, thấm đẫm những minh triết huyền bí của phương Đông. Trong lần xuất bản đầu tiên tại Brazil vào năm 1988, sách chỉ bán được 900 bản. Nhưng, với số phận đặc biệt của cuốn sách dành cho toàn nhân loại, vượt ra ngoài biên giới quốc gia, Nhà giả kim đã làm rung động hàng triệu tâm hồn, trở thành một trong những cuốn sách bán chạy nhất mọi thời đại, và có thể làm thay đổi cuộc đời người đọc.'),
(65, 'Tuổi Trẻ Đáng Giá Bao Nhiêu (Tái Bản 2021)', 'Rosie Nguyễn', 'NXB Hội Nhà Văn', 2, 5, '89352352262', 30, 90000, 19999, 'img/8935235226272/Tbc5Reyn.jpg,img/8935235226272/lMHQ6aof.jpg,img/8935235226272/Ing1U6oe.jpg,img/8935235226272/vXnDyC0U.jpg', '2021-10-28', '“Bạn hối tiếc vì không nắm bắt lấy một cơ hội nào đó, chẳng có ai phải mất ngủ.\n\nBạn trải qua những ngày tháng nhạt nhẽo với công việc bạn căm ghét, người ta chẳng hề bận lòng.\n\nBạn có chết mòn nơi xó tường với những ước mơ dang dở, đó không phải là việc của họ.\n\nSuy cho cùng, quyết định là ở bạn. Muốn có điều gì hay không là tùy bạn.\n\nNên hãy làm những điều bạn thích. Hãy đi theo tiếng nói trái tim. Hãy sống theo cách bạn cho là mình nên sống.\n\nVì sau tất cả, chẳng ai quan tâm.”'),
(66, 'Nam Phương - Hoàng Hậu Cuối Cùng (Tái Bản 2020)', 'Lý Nhân Phan Thứ Lang', 'NXB Thế Giới', 2, 6, '89352786053', 30, 100000, 29998, 'img/8935278605348/nUlmNv64.jpg,img/8935278605348/lJArVmhJ.jpg,img/8935278605348/LihJLs23.jpg,img/8935278605348/TtzMcoQN.jpg', '2021-10-28', 'Nam Phương - Hoàng hậu cuối cùng là cuốn sách tập hợp những câu chuyện về Hoàng hậu Nam Phương, người con gái tài sắc vẹn toàn của đất Gò Công - Tiền Giang, người đã chinh phục hoàn toàn trái tim của Hoàng đế Bảo Đại để bước lên ngôi Hoàng hậu của triều Nguyễn vào năm 1934.'),
(67, 'Đại Việt Sử Ký Toàn Thư Trọn Bộ (Tái Bản 2020)', 'Sử quán triều Hậu Lê', 'NXB Hồng Đức', 2, 6, '89352364193', 30, 235000, 39998, 'img/8935236419338/IB603AD6.jpg,img/8935236419338/6WnzDepI.jpg,img/8935236419338/wHe9iWiU.jpg,img/8935236419338/sM0Rdzf5.jpg', '2021-10-28', 'Trong các sách lịch sử cũ của ta , thì \" Đại Việt sử ký toàn thư \" là một bộ sử lớn chép từ Hồng Bàng đến Ất Mão ( 1675) đời vua Gia Tôn nhà Lê. \" Đại Việt sử ký toàn thư \" là bộ sách lịch sử quý báu trong tủ sách sử cũ của nước Việt Nam , rất cần thiết cho những người nghiên cứu lịch sử dân tộc '),
(68, 'Muốn An Được An (Tái Bản 2021)', 'Sử quán triều Hậu Lê', 'NXB Lao Động', 2, 6, '89352809079', 28, 63000, 10000, 'img/8935280907973/hEnFjaSk.jpg', '2021-10-28', 'Ngày chủ nhật và cũng là ngày cuối cùng của tháng 11 năm 2014 tôi nhận được bản thảo cuốn sách Muốn an được an của thiền sư Thích Nhất Hạnh đã được sư cô Hội Nghiêm dịch ra tiếng Việt từ bản nguyên gốc tiếng anh Being peace. Tôi ngồi vào bàn rồi đọc ngay tức khắc. Và tôi giật mình.\n\nGiật mình bởi mình quá may mắn mà không biết đến điều đó. May mắn vì tính đến năm 2015 này tôi được biết đến thiền sư Thích Nhất Hạnh đúng 10 năm. Quá may mắn bởi đêm hôm qua tôi vừa từ Myanmar bay về Việt Nam và trên máy bay có đọc báo thấy tình trạng đói, bệnh ở châu Phi đang vẫn rất cao, rằng ở Ucraina vừa có thêm những dân thường thiệt mạng, tình hình chính trị xã hội bất ổn ở nhiều nơi trên thế giới. Quá may mắn bởi bản thân tôi và rất nhiều đồng nghiệp đã và đang làm việc ở Thái Hà Books của tôi đều là Phật tử.'),
(69, 'Việt Nam Sử Lược (Tái Bản)', 'Trần Trọng Kim', 'NXB Văn Học', 2, 6, '89352364129', 30, 63000, 10000, 'img/8935236412919/zkJbb0AH.png,img/8935236412919/VpKSENH0.png,img/8935236412919/GxChPQmt.png,img/8935236412919/kczuHSla.png', '2021-10-28', 'Ngày chủ nhật và cũng là ngày cuối cùng của tháng 11 năm 2014 tôi nhận được bản thảo cuốn sách Muốn an được an của thiền sư Thích Nhất Hạnh đã được sư cô Hội Nghiêm dịch ra tiếng Việt từ bản nguyên gốc tiếng anh Being peace. Tôi ngồi vào bàn rồi đọc ngay tức khắc. Và tôi giật mình.\n\nGiật mình bởi mình quá may mắn mà không biết đến điều đó. May mắn vì tính đến năm 2015 này tôi được biết đến thiền sư Thích Nhất Hạnh đúng 10 năm. Quá may mắn bởi đêm hôm qua tôi vừa từ Myanmar bay về Việt Nam và trên máy bay có đọc báo thấy tình trạng đói, bệnh ở châu Phi đang vẫn rất cao, rằng ở Ucraina vừa có thêm những dân thường thiệt mạng, tình hình chính trị xã hội bất ổn ở nhiều nơi trên thế giới. Quá may mắn bởi bản thân tôi và rất nhiều đồng nghiệp đã và đang làm việc ở Thái Hà Books của tôi đều là Phật tử.'),
(70, 'Lịch Sử Do Thái', 'Paul Johnson', 'NXB Dân Trí', 2, 6, '89352707015', 30, 63000, 10000, 'img/8935270701512/jsFGYAOc.jpg,img/8935270701512/aHutTHEz.jpg', '2021-10-28', 'Lịch sử Do Thái của Paul Johnson bắt đầu bằng những sự kiện được viết trong Kinh Thánh và kết thúc khi thành lập Nhà nước Israel. Cuốn sách không chỉ giới thiệu về lịch sử 4.000 năm tồn tại của người Do Thái mà còn đề cập đến những tác động, ảnh hưởng cũng như những đóng góp của họ cho nhân loại.   '),
(71, 'Vua Minh Mạng', 'Marcel Gaultier', 'NXB Hà Nội', 2, 6, '89352707030', 30, 120000, 20000, 'img/8935270703042/feeWUaF7.jpg,img/8935270703042/mLyDhjE1.jpg,img/8935270703042/3QJem1N6.jpg', '2021-10-28', 'Trên tay bạn đọc là Vua Minh Mạng (tên gốc tiếng Pháp: Minh-Mang), cuốn sách tiếp theo về đề tài chân dung các vị vua triều Nguyễn của tác giả Marcel Gaultier (1900-1960) – nhà văn và từng là biên tập viên của Ban Dân sự Đông Dương thời Pháp thuộc. Đây là công trình thứ hai của ông, với nội dung viết về vị vua kế tục sự nghiệp xây dựng đất nước của vua Gia Long. Trong tác phẩm này, Marcel Gaultier đã trình bày khái quát bối cảnh lịch sử, sự ra đời và trưởng thành của vua Minh Mạng, và quá trình kế nghiệp vua cha của ông.'),
(72, 'Vua Gia Long', 'Marcel Gaultie', 'NXB Thế Giới', 2, 6, '89352707022', 30, 110000, 20000, 'img/8935270702267/RXK2xduL.jpg,img/8935270702267/rpzaTCtN.jpg,img/8935270702267/frQDaAyj.jpg', '2021-10-28', 'Cuốn sách là công trình biên khảo bằng tiếng Pháp của Marcel Gaultier được xuất bản lần đầu tại Sài Gòn vào năm 1933.\nMarcel Gaultier (1900-1960) là nhà văn đồng thời là biên tập viên cho Ban Dân sự của Đông Dương. Ông để lại cho đời hơn mười tác phẩm, trong đó có ba tiểu thuyết, còn lại là hồi ký và những nghiên cứu sử học về các vị vua triều Nguyễn: Gia Long, Minh Mạng và Hàm Nghi. Trong số đó, Gia-Long (Vua Gia Long, 1933) là tác phẩm đầu tay về nghiên cứu sử học với đề tựa của Pierre Pasquier, Toàn quyền Đông Dương.'),
(73, 'Cẩm Nang Cấu Trúc Tiếng Anh', 'Trang Anh', 'NXB Đại Học Sư Phạm', 2, 4, '89350956277', 30, 97999, 14996, 'img/8935095627752/e8wtveHo.jpg,img/8935095627752/gz4AZ2Xg.jpg,img/8935095627752/CzeOlZe6.jpg', '2021-10-28', 'Cuốn sách CẨM NANG CẤU TRÚC TIẾNG ANH gồm 25 phần, mỗi phần là một phạm trù kiến thức trong tiếng Anh được trình bày một cách ngắn gọn, đơn giản, cô đọng và hệ thống hoá dưới dạng sơ đồ, bảng biểu nhằm phát triển khả năng tư duy của người học và từ đó giúp người học nhớ kiến thức nhanh hơn và sâu hơn.'),
(74, 'Hackers Ielts: Reading', 'Viện ngôn ngữ Hackers', 'NXB Thế Giới', 2, 4, '89352514106', 25, 250000, 20000, 'img/8935251410679/tzI8hq5J.jpg,img/8935251410679/naKhVyIa.png,img/8935251410679/HIWSvsFG.png,img/8935251410679/zjheCOu9.png,img/8935251410679/kAqgY0yQ.png,img/8935251410679/pOYCNa1d.png', '2021-10-28', 'Bộ sách luyện thi IELTS đầu tiên có kèm giải thích đáp án chi tiết và hướng dẫn cách tự nâng band điểm.\n\nIELTS là cánh cửa giúp các bạn thí sinh hiện thực hóa ước mơ vươn ra thế giới. Chính vì vậy, ngay từ bây giờ, hãy nỗ lực luyện tập và chuẩn bị cho bài thi quan trọng này. Viện Ngôn ngữ Hackers đã biên soạn bộ sách HACKERS IELTS gồm 4 cuốn tương đương với 4 kỹ năng nhằm giới thiệu tới các bạn phương pháp luyện thi phù hợp nhất để có thể đạt điểm cao trong bài thi này.'),
(75, '25 Chuyên Đề Ngữ Pháp Tiếng Anh Trọng Tâm - Tập 1', 'Trang Anh', 'NXB Đại Học Sư Phạm', 2, 4, '89350956266', 30, 110000, 20000, 'img/8935095626632/Q3WT4O5B.jpg,img/8935095626632/4tZp0flR.jpg,img/8935095626632/SJeBVkg3.jpg', '2021-10-28', 'Các chuyên đề ngữ pháp trọng tâm được trình bày đơn giản, dễ hiểu cùng với hệ thống bài tập và từ vựng phong phú. Có tất cả 25 chuyên đề trong 2 tập sách, là tài liệu hữu ích cho học sinh, sinh viên, người đi làm, luyện thi cho các kỳ thi quốc gia, ôn luyện các chứng chỉ quốc tế và là tài liệu tham khảo cho giáo viên.\n\nHuy Hoàng Bookstore hân hạnh giới thiệu!'),
(76, 'Cambridge Ielts 11 Academic With Answers (Savina)', 'Cambridge University', 'NXB Cambridge University', 2, 4, '97811084138', 29, 159000, 20000, 'img/9781108413879/caOLox6m.jpg,img/9781108413879/UkLPEdyT.jpg,img/9781108413879/X2rVgh87.jpg', '2021-10-28', 'Cambridge Ielts 11 Academic With Answers (Savina)'),
(77, '25 Chuyên Đề Ngữ Pháp Tiếng Anh Trọng Tâm - Tập 2', 'Trang Anh', 'NXB Đại học sư phạm', 2, 4, '89350956266', 30, 120000, 20000, 'img/8935095626649/LRrQaC4N.jpg', '2021-10-28', 'Các chuyên đề ngữ pháp trọng tâm được trình bày đơn giản, dễ hiểu cùng với hệ thống bài tập và từ vựng phong phú. Có tất cả 25 chuyên đề trong 2 tập sách, là tài liệu hữu ích cho học sinh, sinh viên, người đi làm, luyện thi cho các kỳ thi quốc gia, ôn luyện các chứng chỉ quốc tế và là tài liệu tham khảo cho giáo viên.'),
(78, 'Hackers Ielts: Listening', 'Viện ngôn ngữ Hackers', 'NXB Thế Giới', 2, 4, '89352514106', 25, 180000, 29998, 'img/8935251410686/zLZ0NGg4.jpg,img/8935251410686/gUYGTUOt.png,img/8935251410686/wFvS4sX0.png,img/8935251410686/bfKbnaOP.png,img/8935251410686/Wr6CNWPh.png,img/8935251410686/reWXj7Ar.png', '2021-10-28', 'Bộ sách luyện thi IELTS đầu tiên có kèm giải thích đáp án chi tiết và hướng dẫn cách tự nâng band điểm.\n\nIELTS là cánh cửa giúp các bạn thí sinh hiện thực hóa ước mơ vươn ra thế giới. Chính vì vậy, ngay từ bây giờ, hãy nỗ lực luyện tập và chuẩn bị cho bài thi quan trọng này. Viện Ngôn ngữ Hackers đã biên soạn bộ sách HACKERS IELTS gồm 4 cuốn tương đương với 4 kỹ năng nhằm giới thiệu tới các bạn phương pháp luyện thi phù hợp nhất để có thể đạt điểm cao trong bài thi này.'),
(79, 'Luyện Thi Toeic 750 Listening (Tái Bản 2018)', 'Jo Gang Soo', 'NXB Khoa Học Xã Hội', 2, 4, '89352514096', 30, 115000, 20000, 'img/8935251409611/ieJtBXZy.jpg,img/8935251409611/mVevSSuT.jpg,img/8935251409611/KB4ma1Mz.jpg', '2021-10-28', 'Luyện Thi Toeic 750 Listening (Tái Bản 2018)'),
(80, 'Essential Words For The IELTS 3rd Edition (Tái Bản)', 'Dr Lin Lougheed', 'NXB Tổng Hợp TPHCM', 2, 4, '89350868467', 30, 170000, 29998, 'img/8935086846780/tJq2yrZv.jpg,img/8935086846780/bM0TUmj2.jpg', '2021-10-28', 'Extensive practice in vocabulary building and correct English usage, with emphasis on 600 words that appear frequently on the IELTS.'),
(81, 'Đứa Con Gái Hoang Đàng - The Prodigal Daughter', 'Jeffrey Archer', 'NXB Lao Động', 2, 4, '97860432096', 30, 190000, 22000, 'img/9786043209679/UDlmlsRQ.jpg', '2021-10-28', '\"Tiếp nối cuốn tiểu thuyết nổi tiếng HAI SỐ PHẬN về William Kane và Abel Rosnovski, Đứa con gái hoang đàng là một câu chuyện được chắp bút của thế hệ tiếp theo. Câu chuyện đầy trớ trêu, trắc trở nhưng đầy nhân văn.'),
(82, 'Khu Vườn Ngôn Từ', 'Shinkai Makoto', 'IPM', 2, 5, '89360481234', 30, 95000, 20000, 'img/8936048123468/IDj5lmLB.jpg,img/8936048123468/72W7UChZ.jpg', '2021-10-28', 'Khu vườn ngôn từ kể về một tình yêu còn xa xưa hơn cả tình yêu.\nKhái niệm tình yêu trong tiếng Nhật hiện đại là luyến hoặc ái, nhưng vào thời xưa nó được viết là cô bi, nghĩa là nỗi buồn một mình. Shinkai Makoto đã cấu tứ Khu vườn ngôn từ theo ý nghĩa cổ điển này, miêu tả tình yêu theo khái niệm ban sơ của nó, tức là cô bi - nỗi buồn khi một mình thương nhớ một người.'),
(83, 'Chiến Binh Cầu Vồng (Tái Bản 2020)', 'Andrea Hirata', 'NXB Hội Nhà Văn', 2, 5, '89352352262', 30, 92000, 10000, 'img/8935235226289/UW3fVZyT.jpg,img/8935235226289/JVAt8U58.jpg', '2021-10-28', '“Thầy Harfan và cô Mus nghèo khổ đã mang đến cho tôi tuổi thơ đẹp nhất, tình bạn đẹp nhất, và tâm hồn phong phú, một thứ gì đó vô giá, thậm chí còn có giá trị hơn những khao khát mơ ước. Có thể tôi lầm, nhưng theo ý tôi, đây thật sự là hơi thở của giáo dục và linh hồn của một chốn được gọi là trường học.” - (Trích tác phẩm)\n\n***'),
(89, 'Nguyễn Minh Hiếu', '1', '2', 2, 4, '281922', 30, 2, 2, 'img/281922/TD61zmYW.jpg,img/281922/19GbuO2e.jpg,img/281922/bkSTRdLu.jpg', '2021-10-28', '221fasf'),
(106, '2', '2', '2', 2, 4, '2', 30, 1, 1, 'img/2/kWIBkZAb.jpg,img/2/Pi2an10j.jpg,img/2/debiqEni.jpg,img/2/Km7mfzN1.jpg,img/2/5QFBIO3P.png', '2021-11-02', '2'),
(107, '3', '2', '2', 2, 4, '3', 30, 1, 1, 'img/3/eHVP8TQc.jpg', '2021-11-02', '2'),
(108, '4', '2', '2', 2, 4, '3', 30, 1, 1, 'img/3/NZCulgpq.jpg', '2021-11-02', '2'),
(109, '5', '2', '2', 2, 4, '3', 30, 1, 1, 'img/3/F7ogaBMJ.jpg', '2021-11-02', '2'),
(110, '6', '2', '2', 2, 4, '3', 30, 1, 1, 'img/3/Dci3vOmU.jpg', '2021-11-02', '2'),
(111, '7', '2', '2', 2, 4, '3', 30, 1, 1, 'img/3/IDKt0Pue.jpg', '2021-11-02', '2'),
(112, '8', '2', '2', 2, 4, '3', 30, 1, 1, 'img/3/j086hBgl.jpg', '2021-11-02', '2'),
(113, '9', '2', '2', 2, 4, '3', 30, 1, 1, 'img/3/rdYU1oCN.jpg', '2021-11-02', '2'),
(114, '10', '2', '2', 2, 4, '3', 30, 1, 1, 'img/3/MdDbeP56.jpg', '2021-11-02', '2'),
(115, '11', '2', '2', 2, 4, '3', 30, 1, 1, 'img/3/xnDzFO5b.jpg', '2021-11-02', '2'),
(116, '13', '2', '2', 2, 4, '3', 30, 1, 1, 'img/3/F4WDCtKw.jpg', '2021-11-02', '2'),
(117, '15', '2', '2', 2, 4, '3', 30, 1, 1, 'img/3/1YkzLwmh.jpg', '2021-11-02', '2'),
(120, 'Doraemon', 'Duy Khánh', 'NXB Kim Đồng', 1, 2, 'D123', 12, 12, 12, 'img/D123/y7JRqPJs.png,img/D123/SLmYSXKB.png,img/D123/P9aKcgcx.jpg', NULL, '12                                        ');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `request`
--

CREATE TABLE `request` (
  `re_id` int(11) NOT NULL,
  `re_book` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `cus_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `request`
--

INSERT INTO `request` (`re_id`, `re_book`, `cus_id`) VALUES
(10, 'Truyện Connan, 7 viên ngọc rồng', 11),
(13, 'Sách giáo khoa lớp 10', 104),
(14, 'abc', 114);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `u_id` int(11) NOT NULL,
  `u_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `u_fullname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`u_id`, `u_name`, `u_fullname`, `password`, `level`) VALUES
(1, 'ngoduykhanh', 'Khánh Duy Ngô', '$2y$10$7671FmwTETic2pfGeMvDQ.D1PsPLEvAIewu7TdjWczRhDigOAVjNO', 2),
(3, 'ngoduykhanh123', 'Ngô Duy Khánh', '$2y$10$xKfFI.TnoLeR/07m134Ice9jZB59Ll99qn3eD5liSFDf9SpBfsh6K', 1),
(6, 'wind', 'Nguyễn Minh Hiếu', '$2y$10$EuxhqvJb/PUTvMMXzk3q7elcsl/M81SZBnaKzNPZo53k/H9ljBv3.', 2);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`ba_id`);

--
-- Chỉ mục cho bảng `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`pr_id`,`cus_id`),
  ADD KEY `carts_ibfk_2` (`cus_id`);

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`c_id`);

--
-- Chỉ mục cho bảng `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`cus_id`);

--
-- Chỉ mục cho bảng `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD PRIMARY KEY (`pr_id`,`or_id`),
  ADD KEY `or_id` (`or_id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`or_id`),
  ADD KEY `cus_id` (`cus_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pr_id`),
  ADD KEY `pr_category` (`pr_category`);

--
-- Chỉ mục cho bảng `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`re_id`),
  ADD KEY `cus_id` (`cus_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `banners`
--
ALTER TABLE `banners`
  MODIFY `ba_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `customers`
--
ALTER TABLE `customers`
  MODIFY `cus_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `pr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT cho bảng `request`
--
ALTER TABLE `request`
  MODIFY `re_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `fk13` FOREIGN KEY (`pr_id`) REFERENCES `products` (`pr_id`);

--
-- Các ràng buộc cho bảng `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD CONSTRAINT `fk10` FOREIGN KEY (`or_id`) REFERENCES `orders` (`or_id`),
  ADD CONSTRAINT `fk11` FOREIGN KEY (`pr_id`) REFERENCES `products` (`pr_id`);

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`pr_category`) REFERENCES `category` (`c_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
