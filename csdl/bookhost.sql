-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 22, 2017 at 07:55 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookhost`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(60) CHARACTER SET utf8 NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(120) CHARACTER SET utf8 DEFAULT NULL,
  `role_admin` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `img_path` varchar(120) COLLATE utf8_unicode_ci DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `email`, `phone`, `address`, `role_admin`, `status`, `img_path`, `createdAt`, `updatedAt`) VALUES
(1, 'admin', '25d55ad283aa400af464c76d713c07ad', 'trieunguyenthanh@gmail.com', '0975091304', 'Hà Nội', -1, 1, NULL, '2016-11-29 13:25:10', NULL),
(2, 'aaaaaa', '12345678', '', NULL, NULL, 0, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ansewers`
--

CREATE TABLE `ansewers` (
  `id` int(10) UNSIGNED NOT NULL,
  `question_id` int(10) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL,
  `username` varchar(100) CHARACTER SET utf8 NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `level_user` tinyint(3) NOT NULL,
  `create_time` datetime NOT NULL,
  `like_ansewer` int(10) UNSIGNED DEFAULT NULL,
  `content` text CHARACTER SET utf8 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chitiethoadon`
--

CREATE TABLE `chitiethoadon` (
  `id_hoadon` int(11) NOT NULL,
  `id_dh` int(11) NOT NULL,
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `chitiethoadon`
--

INSERT INTO `chitiethoadon` (`id_hoadon`, `id_dh`, `create_time`, `update_time`) VALUES
(20, 26, '2017-06-14 17:14:16', '0000-00-00 00:00:00'),
(22, 30, '2017-06-15 09:03:55', '0000-00-00 00:00:00'),
(19, 22, '2017-06-14 15:48:29', '0000-00-00 00:00:00'),
(21, 29, '2017-06-15 02:08:51', '0000-00-00 00:00:00'),
(23, 31, '2017-06-18 14:29:56', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `donhang`
--

CREATE TABLE `donhang` (
  `id_hd` int(11) NOT NULL,
  `id_sach` int(10) UNSIGNED NOT NULL,
  `TenKH` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `SDT` int(11) NOT NULL,
  `Email` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `DiaChi` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `GhiChu` text COLLATE utf8_unicode_ci NOT NULL,
  `SoLuong` int(11) NOT NULL,
  `ThanhTien` int(11) NOT NULL,
  `TrangThai` int(11) NOT NULL,
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `donhang`
--

INSERT INTO `donhang` (`id_hd`, `id_sach`, `TenKH`, `SDT`, `Email`, `DiaChi`, `GhiChu`, `SoLuong`, `ThanhTien`, `TrangThai`, `create_time`, `update_time`) VALUES
(26, 15, 'Quang Duc Chung', 966432963, 'trieunguyenthanh@gmail.com', 'HY', '', 1, 30000, 1, '2017-06-14 15:02:27', '2017-06-14 15:02:27'),
(22, 14, 'ffff', 966432963, 'trieunguyenthanh@gmail.com', 'csd', '', 1, 15000, 1, '2017-05-24 11:56:27', '2017-05-24 11:56:27'),
(29, 13, 'qd chung', 1676529879, 'quangducchung2@gmail.com', 'Hà Nội', '', 2, 300000, 0, '2017-06-15 02:07:49', '2017-06-15 02:07:49'),
(30, 13, 'qd chung', 1676529879, 'trieunguyenthanh@gmail.com', 'Hà Nội', '', 1, 150000, 1, '2017-06-15 09:03:27', '2017-06-15 09:03:27'),
(31, 13, 'qd chung', 1676529879, 'trieunguyenthanh@gmail.com', 'Hà Nội', '', 1, 150000, 1, '2017-06-15 09:12:55', '2017-06-15 09:12:55');

-- --------------------------------------------------------

--
-- Table structure for table `loaisach`
--

CREATE TABLE `loaisach` (
  `id_loai` int(11) NOT NULL,
  `TenLoai` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `loaisach`
--

INSERT INTO `loaisach` (`id_loai`, `TenLoai`, `create_time`, `update_time`) VALUES
(8, 'Kiếm Hiệp', '2017-05-16 07:49:45', '0000-00-00 00:00:00'),
(2, 'Ngoại Ngữ', NULL, NULL),
(3, 'Truyện Tranh', NULL, '2017-05-16 00:01:03'),
(4, 'CNTT', NULL, NULL),
(7, 'Tiểu Thuyết', '2017-05-12 15:17:53', '0000-00-00 00:00:00'),
(9, 'Cổ tích', '2017-05-16 08:01:16', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `nhaxuatban`
--

CREATE TABLE `nhaxuatban` (
  `id_nxb` int(11) NOT NULL,
  `TenNXB` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `SDTNXB` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `DiaChiNXB` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `logo_NXB` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `nhaxuatban`
--

INSERT INTO `nhaxuatban` (`id_nxb`, `TenNXB`, `SDTNXB`, `DiaChiNXB`, `logo_NXB`, `create_time`, `update_time`) VALUES
(5, 'Giáo Dục', '01676529879', 'Quảng Ninh', '2012-03-23 17.52.39.jpg', '2016-12-13 19:30:35', '0000-00-00 00:00:00'),
(6, 'Xã Hội', '18001999', 'Hải Dương', '1471875_261646587319601_130124247_n.jpg', '2016-12-13 19:31:21', '0000-00-00 00:00:00'),
(7, 'Thể Thao', '187926649', 'Thanh Hóa', '2013-12-07 19.52.30.jpg', '2016-12-13 19:31:48', '0000-00-00 00:00:00'),
(8, 'Kim Đồng', '0333954566', 'Hoàng Quốc Việt', '2013-10-01 11.06.12.jpg', '2016-12-13 19:32:41', '0000-00-00 00:00:00'),
(9, 'Tuổi Trẻ', '095565632', 'Hà Nội', '2013-10-01 10.07.23.jpg', '2016-12-13 19:33:09', '0000-00-00 00:00:00'),
(10, 'Tiền Phong', '23726372', 'Nam Định', '5292014115111.jpg', '2016-12-13 19:36:27', '0000-00-00 00:00:00'),
(11, 'Đất Việt', '09656566', 'Phạm Hùng', '5302014155832.jpg', '2016-12-13 19:45:36', '0000-00-00 00:00:00'),
(12, 'Lạc Hồng', '0125236656', 'Thái Bình', 'SC20150501-213740.png', '2016-12-13 19:46:44', '0000-00-00 00:00:00'),
(13, 'Điện Lực', '01656208231', 'TP.HCM', 'banner4.jpg', '2016-12-13 19:47:29', '2016-12-14 22:37:37');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(100) CHARACTER SET utf8 NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `create_time` datetime NOT NULL,
  `id_book` int(10) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL,
  `like_comment` int(10) UNSIGNED DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sach`
--

CREATE TABLE `sach` (
  `id` int(11) NOT NULL,
  `TenSach` varchar(200) CHARACTER SET utf8 NOT NULL,
  `id_nxb` int(11) NOT NULL,
  `id_tg` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `HinhAnh` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `GiaCu` int(11) NOT NULL,
  `GiaMoi` int(11) DEFAULT '0',
  `id_loai` int(11) NOT NULL,
  `SoLuong` int(11) NOT NULL,
  `SoTrang` int(11) NOT NULL,
  `SoLuotXem` int(11) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sach`
--

INSERT INTO `sach` (`id`, `TenSach`, `id_nxb`, `id_tg`, `status`, `HinhAnh`, `GiaCu`, `GiaMoi`, `id_loai`, `SoLuong`, `SoTrang`, `SoLuotXem`, `create_time`, `update_time`) VALUES
(12, 'Ngữ Văn Lớp 9', 5, 1, 1, 'image11.jpg', 30000, 0, 1, 10, 300, 11, '2016-12-23 17:55:39', '0000-00-00 00:00:00'),
(13, 'Cửu Âm Chân Kinh', 13, 1, 1, 'image17.jpg', 150000, 0, 4, 6, 1000, 9, '2016-12-23 18:45:19', '0000-00-00 00:00:00'),
(14, 'Harry Potter', 8, 1, 1, 'image03.jpg', 15000, 0, 3, 20, 150, 2, '2016-12-23 18:46:46', '0000-00-00 00:00:00'),
(15, 'Conan', 8, 1, 1, 'image08.jpg', 30000, 0, 3, 14, 60, 3, '2016-12-23 18:47:57', '0000-00-00 00:00:00'),
(16, 'Ngôn Ngữ PHP', 5, 1, 1, 'image21.jpg', 45000, 0, 4, 10, 300, 5, '2016-12-23 18:49:02', '0000-00-00 00:00:00'),
(22, 'dsadsadsa', 5, 1, 1, '5132014125837.jpg', 10000, 1000, 8, 30, 500, NULL, '2017-06-16 23:24:40', '2017-06-17 01:56:10'),
(18, 'Maketting', 6, 3, 1, 'image04.jpg', 100000, 0, 1, 30, 265, 3, '2016-12-26 21:38:11', '0000-00-00 00:00:00'),
(19, 'Huyền thoại', 8, 3, 1, 'image05.jpg', 15000, 0, 3, 78, 100, 3, '2016-12-26 21:41:05', '2017-06-14 23:43:14');

-- --------------------------------------------------------

--
-- Table structure for table `tacgia`
--

CREATE TABLE `tacgia` (
  `id_tg` int(11) NOT NULL,
  `TenTG` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `SDTTG` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `DiaChiTG` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `img_path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `namsinh` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tacgia`
--

INSERT INTO `tacgia` (`id_tg`, `TenTG`, `SDTTG`, `DiaChiTG`, `img_path`, `create_time`, `update_time`, `namsinh`) VALUES
(1, 'Tố Hữu', '016565412', 'HN', 'image28.jpg', NULL, '2017-05-19 22:51:22', '0000-00-00'),
(2, 'Nam Cao', '0132656512', 'HY', 'image19.png', NULL, '2017-05-19 22:53:51', '0000-00-00'),
(6, 'Tom', '966456789', 'HN', 'image16.jpg', '2017-05-18 15:14:28', '2017-05-19 22:49:18', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `taikhoan`
--

CREATE TABLE `taikhoan` (
  `id_tk` int(11) NOT NULL,
  `TenDangNhap` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `MatKhau` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `TenHienThi` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `DiaChi` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `SDT` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `Email` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `Quyen` int(11) NOT NULL,
  `Trang_thai` tinyint(4) NOT NULL,
  `authen_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `taikhoan`
--

INSERT INTO `taikhoan` (`id_tk`, `TenDangNhap`, `MatKhau`, `TenHienThi`, `DiaChi`, `SDT`, `Email`, `Quyen`, `Trang_thai`, `authen_key`, `create_time`, `update_time`) VALUES
(11, 'tham', '25d55ad283aa400af464c76d713c07ad', 'thắm', 'nd', '01656208231', 'tham@gmail.com', 0, 1, '1YsYhEAgrB8xoPoHMJH8uTqiL1KcZr3NsYyysYPyoNU', '2017-01-03 15:37:36', '0000-00-00 00:00:00'),
(12, 'admin', '25d55ad283aa400af464c76d713c07ad', 'qd chung', 'Hà Nội', '01676529879', 'quangducchung1@gmail.com', 0, 1, 'qVhj0M_B3PQjRE5z-ihhQh031tT4Y2Ch4nETV4oYgF4', '2017-01-03 19:08:11', '0000-00-00 00:00:00'),
(13, 'vinh', '25d55ad283aa400af464c76d713c07ad', 'vinh', 'HY', '01676529879', 'phpdemocntt@gmail.com', 0, 1, 'jQ7GmSI-drHPZjIXlgmHS4DHqt8nvP2AJASGHEctuzQ', '2017-01-16 11:08:35', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ansewers`
--
ALTER TABLE `ansewers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chitiethoadon`
--
ALTER TABLE `chitiethoadon`
  ADD PRIMARY KEY (`id_hoadon`);

--
-- Indexes for table `donhang`
--
ALTER TABLE `donhang`
  ADD PRIMARY KEY (`id_hd`);

--
-- Indexes for table `loaisach`
--
ALTER TABLE `loaisach`
  ADD PRIMARY KEY (`id_loai`);

--
-- Indexes for table `nhaxuatban`
--
ALTER TABLE `nhaxuatban`
  ADD PRIMARY KEY (`id_nxb`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sach`
--
ALTER TABLE `sach`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tacgia`
--
ALTER TABLE `tacgia`
  ADD PRIMARY KEY (`id_tg`);

--
-- Indexes for table `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD PRIMARY KEY (`id_tk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ansewers`
--
ALTER TABLE `ansewers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `chitiethoadon`
--
ALTER TABLE `chitiethoadon`
  MODIFY `id_hoadon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `donhang`
--
ALTER TABLE `donhang`
  MODIFY `id_hd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `loaisach`
--
ALTER TABLE `loaisach`
  MODIFY `id_loai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `nhaxuatban`
--
ALTER TABLE `nhaxuatban`
  MODIFY `id_nxb` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sach`
--
ALTER TABLE `sach`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `tacgia`
--
ALTER TABLE `tacgia`
  MODIFY `id_tg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `taikhoan`
--
ALTER TABLE `taikhoan`
  MODIFY `id_tk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
