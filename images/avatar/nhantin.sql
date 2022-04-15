-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2022 at 08:28 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nhantin`
--

-- --------------------------------------------------------

--
-- Table structure for table `chatfriend`
--

CREATE TABLE `chatfriend` (
  `no` int(4) NOT NULL,
  `me` varchar(50) NOT NULL,
  `friend` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chatfriend`
--

INSERT INTO `chatfriend` (`no`, `me`, `friend`) VALUES
(1, 'hoainguyen.010901@gmail.com', 'Vu2@gmail.com'),
(2, 'hoainguyen.010901@gmail.com', 'yuri@gmail.com'),
(3, 'Vu2@gmail.com', 'hoainguyen.010901@gmail.com'),
(4, 'yuri@gmail.com', 'hoainguyen.010901@gmail.com'),
(5, 'admin@chitchat.com', 'gaialime@gmail.com'),
(6, 'gaialime@gmail.com', 'admin@chitchat.com'),
(7, 'hoainguyen@gmail.com', 'admin@chitchat.com'),
(8, 'admin@chitchat.com', 'hoainguyen@gmail.com'),
(9, 'hoainguyen@gmail.com', 'hoainguyen.010901@gmail.com'),
(10, 'hoainguyen.010901@gmail.com', 'hoainguyen@gmail.com'),
(11, 'hoainguyen@gmail.com', 'Vu2@gmail.com'),
(12, 'Vu2@gmail.com', 'hoainguyen@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `tinnhan`
--

CREATE TABLE `tinnhan` (
  `no` int(4) NOT NULL,
  `sendmail` varchar(50) NOT NULL,
  `sendtext` varchar(255) NOT NULL,
  `getmail` varchar(50) NOT NULL,
  `seen` varchar(50) NOT NULL,
  `timesend` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tinnhan`
--

INSERT INTO `tinnhan` (`no`, `sendmail`, `sendtext`, `getmail`, `seen`, `timesend`) VALUES
(1, 'hoainguyen.010901@gmail.com', 'Chào cc', 'Vu2@gmail.com', 'unread', 'now'),
(2, 'Vu2@gmail.com', 'CC chào bố cái cc', 'hoainguyen.010901@gmail.com', 'unread', 'now'),
(3, 'hoainguyen.010901@gmail.com', '', 'Vu2@gmail.com', 'unread', '2022-04-14 05:16:02am'),
(4, 'hoainguyen.010901@gmail.com', '', 'Vu2@gmail.com', 'unread', '2022-04-14 05:16:10am'),
(5, 'hoainguyen.010901@gmail.com', 'sadsd', 'Vu2@gmail.com', 'unread', '2022-04-14 05:16:40am'),
(6, 'hoainguyen.010901@gmail.com', 'có cái lz\r\n', 'Vu2@gmail.com', 'unread', '2022-04-14 05:16:47am'),
(7, 'Vu2@gmail.com', 'dsfdfdf', 'hoainguyen.010901@gmail.com', 'unread', '2022-04-14 05:18:43am'),
(8, 'Vu2@gmail.com', 'dffđf', 'hoainguyen.010901@gmail.com', 'unread', '2022-04-14 05:19:58am'),
(9, 'Vu2@gmail.com', 'sdfdfdsfdsfdf', 'hoainguyen.010901@gmail.com', 'unread', '2022-04-14 05:20:16am'),
(10, 'Vu2@gmail.com', 'sdadasdadadadasđá·', 'hoainguyen.010901@gmail.com', 'unread', '2022-04-14 05:20:22am'),
(11, 'hoainguyen.010901@gmail.com', 'c', 'Vu2@gmail.com', 'unread', '2022-04-14 05:32:57am'),
(12, 'hoainguyen.010901@gmail.com', '', 'Vu2@gmail.com', 'unread', '2022-04-14 05:57:07am'),
(13, 'hoainguyen.010901@gmail.com', 'ccccccc', 'Vu2@gmail.com', 'unread', '2022-04-14 05:57:12am'),
(14, 'hoainguyen.010901@gmail.com', 'd', 'Vu2@gmail.com', 'unread', '2022-04-14 06:06:13am'),
(15, 'hoainguyen.010901@gmail.com', 'sd', 'yuri@gmail.com', 'unread', '2022-04-14 06:11:21am'),
(16, 'hoainguyen.010901@gmail.com', 'd', 'Vu2@gmail.com', 'unread', '2022-04-14 06:11:24am'),
(17, 'hoainguyen.010901@gmail.com', 'ádsadd', 'yuri@gmail.com', 'unread', '2022-04-14 06:11:27am'),
(18, 'hoainguyen.010901@gmail.com', '', 'yuri@gmail.com', 'unread', '2022-04-14 06:11:34am'),
(19, 'hoainguyen.010901@gmail.com', '', 'yuri@gmail.com', 'unread', '2022-04-14 06:11:38am'),
(20, 'hoainguyen.010901@gmail.com', 'sad', 'yuri@gmail.com', 'unread', '2022-04-14 06:11:54am'),
(21, 'hoainguyen.010901@gmail.com', 'sd', 'yuri@gmail.com', 'unread', '2022-04-14 06:13:28am'),
(22, 'hoainguyen.010901@gmail.com', 'sdfdgfgdg', 'yuri@gmail.com', 'unread', '2022-04-14 06:13:39am'),
(23, 'hoainguyen.010901@gmail.com', 'sdfdgfgdg', 'yuri@gmail.com', 'unread', '2022-04-14 06:14:35am'),
(24, 'hoainguyen.010901@gmail.com', 'sdfdgfgdg', 'yuri@gmail.com', 'unread', '2022-04-14 06:14:37am'),
(25, 'hoainguyen.010901@gmail.com', 'cc\r\n', 'Vu2@gmail.com', 'unread', '2022-04-14 06:15:03am'),
(26, 'hoainguyen.010901@gmail.com', 'cc\r\n', 'Vu2@gmail.com', 'unread', '2022-04-14 06:16:42am'),
(27, 'hoainguyen.010901@gmail.com', 'cc\r\n', 'Vu2@gmail.com', 'unread', '2022-04-14 06:16:44am'),
(28, 'hoainguyen.010901@gmail.com', 'ew', 'yuri@gmail.com', 'unread', '2022-04-14 06:17:16am'),
(29, 'hoainguyen.010901@gmail.com', 'ưee', 'yuri@gmail.com', 'unread', '2022-04-14 06:17:20am'),
(30, 'hoainguyen.010901@gmail.com', 'ưe', 'Vu2@gmail.com', 'unread', '2022-04-14 06:17:29am'),
(31, 'hoainguyen.010901@gmail.com', 'dsdsdasd', '', 'unread', '2022-04-14 06:21:58am'),
(32, 'hoainguyen.010901@gmail.com', 'ád', '', 'unread', '2022-04-14 06:22:02am'),
(33, 'yuri@gmail.com', 'cc', 'hoainguyen.010901@gmail.com', 'unread', '2022-04-14 06:30:17am'),
(34, 'yuri@gmail.com', 'cc', 'hoainguyen.010901@gmail.com', 'unread', '2022-04-14 06:30:23am'),
(35, 'hoainguyen@gmail.com', 'hello', 'hoainguyen.010901@gmail.com', 'unread', '2022-04-14 08:12:52am'),
(36, 'hoainguyen@gmail.com', 'Hêlo', 'Vu2@gmail.com', 'unread', '2022-04-14 08:21:35am'),
(37, 'hoainguyen@gmail.com', 'konichiwa\r\nd', 'Vu2@gmail.com', 'unread', '2022-04-14 08:23:09am'),
(38, 'hoainguyen@gmail.com', 'alo\r\n', 'hoainguyen.010901@gmail.com', 'unread', '2022-04-14 08:26:07am'),
(39, 'hoainguyen@gmail.com', 'alo\r\n', 'hoainguyen.010901@gmail.com', 'unread', '2022-04-14 08:26:59am'),
(40, 'hoainguyen@gmail.com', 'alo\r\n', 'hoainguyen.010901@gmail.com', 'unread', '2022-04-14 08:27:15am'),
(41, 'hoainguyen@gmail.com', 'alllllo', 'hoainguyen.010901@gmail.com', 'unread', '2022-04-14 08:27:22am'),
(42, 'hoainguyen@gmail.com', 'Hello', 'Vu2@gmail.com', 'unread', '2022-04-14 08:27:30am');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `no` int(4) NOT NULL,
  `name` varchar(50) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `avatar` varchar(50) NOT NULL,
  `online` varchar(50) NOT NULL,
  `diachi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`no`, `name`, `mail`, `pass`, `avatar`, `online`, `diachi`) VALUES
(1, 'Admin', 'admin@chitchat.com', 'Xhoai2001', 'images/avatar/Admin_avt.jpg', '0', ''),
(2, 'Hoai', 'hoainguyen.010901@gmail.com', 'Xhoai2001', 'images/avatar/Hoai_avt.jpg', '1', ''),
(3, 'Vu2', 'Vu2@gmail.com', '11111111', 'images/avatar/Vu2_avt.jpg', '1', ''),
(4, 'Hoai2', 'yuri@gmail.com', 'Xhoai2001', 'images/avatar/Hoai2_avt.jpg', '1', ''),
(5, 'Alime girl', 'gaialime@gmail.com', '11111111', 'images/avatar/Alime girl_avt.jpg', '1', ''),
(6, 'Hoi', 'hoainguyen@gmail.com', 'Xhoai2001', 'images/avatar/Alime girl_avt.jpg', '1', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chatfriend`
--
ALTER TABLE `chatfriend`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `tinnhan`
--
ALTER TABLE `tinnhan`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`no`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
