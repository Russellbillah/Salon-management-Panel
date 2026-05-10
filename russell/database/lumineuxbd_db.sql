-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2026 at 01:36 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lumineuxdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

CREATE TABLE `tbladmin` (
  `ID` int(10) NOT NULL,
  `AdminName` char(50) DEFAULT NULL,
  `UserName` char(50) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `Password` varchar(200) DEFAULT NULL,
  `Role` varchar(50) DEFAULT 'admin',
  `AdminRegdate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`ID`, `AdminName`, `UserName`, `MobileNumber`, `Email`, `Password`, `Role`, `AdminRegdate`) VALUES
(1, 'Admin', 'admin', 7898799798, 'tester1@gmail.com', 'f925916e2754e5e03f75dd58a5733251', 'admin', '2019-07-25 06:21:50'),
(2, 'Russell Billah', 'russell', 1814438989, 'rbillah01@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'barber', '2026-05-09 17:46:38');

-- --------------------------------------------------------

--
-- Table structure for table `tblappointment`
--

CREATE TABLE `tblappointment` (
  `ID` int(10) NOT NULL,
  `AptNumber` varchar(80) DEFAULT NULL,
  `Name` varchar(120) DEFAULT NULL,
  `Email` varchar(120) DEFAULT NULL,
  `PhoneNumber` bigint(11) DEFAULT NULL,
  `AptDate` varchar(120) DEFAULT NULL,
  `AptTime` varchar(120) DEFAULT NULL,
  `Services` varchar(120) DEFAULT NULL,
  `BarberId` int(11) DEFAULT NULL,
  `ApplyDate` timestamp NULL DEFAULT current_timestamp(),
  `Remark` varchar(250) NOT NULL,
  `Status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblappointment`
--

INSERT INTO `tblappointment` (`ID`, `AptNumber`, `Name`, `Email`, `PhoneNumber`, `AptDate`, `AptTime`, `Services`, `BarberId`, `ApplyDate`, `Remark`, `Status`) VALUES
(4, '578797544', 'Anuj Kumar', 'phpgurukulofficial@gmail.com', 123456789, '8/30/2019', '1:30am', 'Test', NULL, '2019-08-21 16:13:13', 'Selected', '1'),
(5, '899118550', 'bb', 'bgfdh@fdfdsf.com', 4234235423, '8/27/2019', '1:30am', 'Loreal Hair Color(Full)', NULL, '2019-08-21 16:14:14', '', ''),
(6, '621107928', 'ABC', 'abc@gmail.com', 1234567890, '8/27/2019', '1:30am', 'Rebonding', NULL, '2019-08-21 16:22:25', 'Testing', '2'),
(7, '184242778', 'Harish', 'har@gmail.com', 4654646546, '2021-07-23', '10:38', 'MUSTACHE TRIM', NULL, '2021-07-20 06:40:43', 'selected', '1'),
(8, '777343097', 'Manish', 'manish@gmail.com', 2678979789, '2021-07-24', '13:23', 'Hair Cut', NULL, '2021-07-20 06:52:33', 'selected', '1'),
(9, '290594099', 'Yash', 'yash@gmail.com', 4654654654, '2021-07-24', '14:36', 'Hair Cut', NULL, '2021-07-21 08:05:47', '', ''),
(10, '128617343', 'Dinesh', 'dinesh@gmail.com', 6876876868, '2021-07-25', '15:30', 'Hair Cut', NULL, '2021-07-23 04:56:47', '', ''),
(11, '600991456', 'Test', 'test@gmail.com', 7987987897, '2021-07-24', '15:40', 'Hair Cut', NULL, '2021-07-23 05:10:56', 'Selected', '1'),
(12, '336388269', 'Anuj', 'ak@gmail.com', 1234569870, '2021-07-30', '15:52', 'Hair Cut', NULL, '2021-07-25 17:22:37', 'Confirmed', '1'),
(13, '352336400', 'billah', 'test@gmail.com', 111111111, '2026-05-19', '00:41', 'spa', 2, '2026-05-09 18:41:11', 'russell', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tblcustomers`
--

CREATE TABLE `tblcustomers` (
  `ID` int(10) NOT NULL,
  `Name` varchar(120) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `MobileNumber` bigint(11) DEFAULT NULL,
  `Gender` enum('Female','Male','Transgender') DEFAULT NULL,
  `Details` mediumtext DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblcustomers`
--

INSERT INTO `tblcustomers` (`ID`, `Name`, `Email`, `MobileNumber`, `Gender`, `Details`, `CreationDate`, `UpdationDate`) VALUES
(2, 'Rahul Singh', 'singh@gmail.com', 5565565656, 'Male', 'Taken haircut by him', '2019-07-26 11:10:02', NULL),
(5, 'Test user', 'testuser@gmail.com', 1234567890, 'Female', 'Test', '2019-08-21 16:24:53', '2019-08-21 16:25:11'),
(6, 'Manish', 'manish@gmail.com', 9879879798, 'Male', 'vjhgjhghg;lk;lklnhfjkhkjfnkl\r\nlkjklfjlkjlkc jjlkj\r\nl;ljlkj lkcjtkrjkjne', '2021-07-21 07:42:54', NULL),
(7, 'Anuj kumar', 'ak@gmail.com', 1234567899, 'Transgender', 'Test', '2021-07-25 17:25:54', '2021-07-25 17:26:31');

-- --------------------------------------------------------

--
-- Table structure for table `tblinvoice`
--

CREATE TABLE `tblinvoice` (
  `id` int(11) NOT NULL,
  `Userid` int(11) DEFAULT NULL,
  `ServiceId` int(11) DEFAULT NULL,
  `BarberId` int(11) DEFAULT NULL,
  `BillingId` int(11) DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblinvoice`
--

INSERT INTO `tblinvoice` (`id`, `Userid`, `ServiceId`, `BarberId`, `BillingId`, `PostingDate`) VALUES
(1, 2, 7, NULL, 600922156, '2021-07-21 07:48:58'),
(2, 2, 9, NULL, 600922156, '2021-07-21 07:48:58'),
(3, 5, 7, NULL, 777590972, '2021-07-23 05:16:41'),
(4, 5, 9, NULL, 777590972, '2021-07-23 05:16:41'),
(6, 7, 9, NULL, 631074383, '2021-07-25 17:26:51'),
(7, 7, 15, NULL, 631074383, '2021-07-25 17:26:51'),
(8, 2, 1, NULL, 468067107, '2026-05-09 17:47:02'),
(9, 2, 1, NULL, 496171623, '2026-05-09 17:49:19'),
(10, 2, 18, NULL, 646034038, '2026-05-09 17:52:45'),
(11, 2, 1, 0, 779407860, '2026-05-09 18:02:06'),
(12, 2, 1, 2, 266614364, '2026-05-09 18:08:55'),
(13, 2, 1, 2, 181151770, '2026-05-09 18:17:39'),
(14, 2, 2, 2, 690109742, '2026-05-09 18:26:04'),
(15, 2, 1, 2, 327687157, '2026-05-09 18:28:25'),
(16, 2, 1, 2, 287576132, '2026-05-09 18:43:10'),
(17, 2, 18, 2, 148875629, '2026-05-09 19:24:50'),
(18, 2, 1, 2, 746605320, '2026-05-09 20:24:48');

-- --------------------------------------------------------

--
-- Table structure for table `tblpage`
--

CREATE TABLE `tblpage` (
  `ID` int(10) NOT NULL,
  `PageType` varchar(200) DEFAULT NULL,
  `PageTitle` mediumtext DEFAULT NULL,
  `PageDescription` mediumtext DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `UpdationDate` date DEFAULT NULL,
  `Timing` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblpage`
--

INSERT INTO `tblpage` (`ID`, `PageType`, `PageTitle`, `PageDescription`, `Email`, `MobileNumber`, `UpdationDate`, `Timing`) VALUES
(1, 'aboutus', 'About Us', '        Our main focus is on quality and hygiene. Our Parlour is well equipped with advanced technology equipments and provides best quality services. Our staff is well trained and experienced, offering advanced services in Skin, Hair and Body Shaping that will provide you with a luxurious experience that leave you feeling relaxed and stress free. The specialities in the parlour are, apart from regular bleachings and Facials, many types of hairstyles, Bridal and cine make-up and different types of Facials & fashion hair colourings.', NULL, NULL, NULL, ''),
(2, 'contactus', 'Contact Us', '        890,Sector 62, Gyan Sarovar, GAIL Noida(Delhi/NCR)', 'info@gmail.com', 7896541236, NULL, '10:30 am to 8:30 pm');

-- --------------------------------------------------------

--
-- Table structure for table `tblservices`
--

CREATE TABLE `tblservices` (
  `ID` int(10) NOT NULL,
  `ServiceName` varchar(200) DEFAULT NULL,
  `Description` mediumtext DEFAULT NULL,
  `Cost` int(10) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblservices`
--

INSERT INTO `tblservices` (`ID`, `ServiceName`, `Description`, `Cost`, `CreationDate`) VALUES
(1, 'O3 Facial', 'Activated charcoal draws bacteria, toxins, dirt and oil from the skin.', 120, '2019-07-25 11:22:38'),
(2, 'Fruit Facial', 'If its a peel-off mask, it also works as an excellent exfoliator, ridding the skin of dead cells.', 500, '2019-07-25 11:22:53'),
(3, 'Charcol Facial', 'The end result is skin that is clean and clear. When used as a powder, charcoal masks can reach deep in your pores and suck out impurities with them.', 1000, '2019-07-25 11:23:10'),
(4, 'Deluxe Menicure', 'The end result is skin that is clean and clear. When used as a powder, charcoal masks can reach deep in your pores and suck out impurities with them.', 500, '2019-07-25 11:23:34'),
(5, 'Deluxe Pedicure', 'A pedicure is a therapeutic treatment for your feet that removes dead skin, softens hard skin and shapes and treats your toenails.', 600, '2019-07-25 11:23:47'),
(6, 'Normal Menicure', 'A pedicure is a therapeutic treatment for your feet that removes dead skin, softens hard skin and shapes and treats your toenails.', 300, '2019-07-25 11:24:01'),
(7, 'Normal Pedicure', 'A pedicure is a therapeutic treatment for your feet that removes dead skin, softens hard skin and shapes and treats your toenails.', 400, '2019-07-25 11:24:19'),
(8, 'Hair Cut', 'A hairstyle, hairdo, or haircut refers to the styling of hair, usually on the human scalp. Sometimes, this could also mean an editing of facial or body hair', 250, '2019-07-25 11:24:38'),
(9, 'Style Haircut', 'A hairstyle, hairdo, or haircut refers to the styling of hair, usually on the human scalp. Sometimes, this could also mean an editing of facial or body hair', 550, '2019-07-25 11:24:53'),
(10, 'Hair Wash', 'A hairstyle, hairdo, or haircut refers to the styling of hair, usually on the human scalp. Sometimes, this could also mean an editing of facial or body hair', 3999, '2019-07-25 11:25:08'),
(11, 'Loreal Hair Color(Full)', 'hgfhgj', 1200, '2019-07-25 11:25:35'),
(12, 'Body Spa', 'It is full body spa including hair wash', 1500, '2019-08-19 13:36:27'),
(14, 'Test', 'test test', 100, '2019-08-21 15:45:50'),
(15, 'ABC', 'gjhgjhgbkhhioljhoioi', 200, '2019-08-21 16:23:23'),
(16, 'Tradinational Cut', 'khghkhlkjlkjlkjflkrjnvoireyviutyouopyiuiosueoibvjmyruopo kjhkjhkhk kjh nkhu k iuyhiu kjhihiur', 45, '2021-07-19 07:37:40'),
(17, 'MUSTACHE TRIM', 'Trim Trim Trim', 85, '2021-07-19 07:38:02'),
(18, 'Beard Trim', 'Beard Trim', 10, '2021-07-19 07:38:20');

-- --------------------------------------------------------

--
-- Table structure for table `tblsubscriber`
--

CREATE TABLE `tblsubscriber` (
  `ID` int(5) NOT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `DateofSub` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblsubscriber`
--

INSERT INTO `tblsubscriber` (`ID`, `Email`, `DateofSub`) VALUES
(1, 'ani@gmail.com', '2021-07-16 07:32:33'),
(2, 'rahul@gmail.com', '2021-07-16 07:32:33'),
(3, 'ganesh@gmail.com', '2021-07-21 07:36:46'),
(4, 'ak@gmail.com', '2021-07-25 17:25:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbladmin`
--
ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblappointment`
--
ALTER TABLE `tblappointment`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblcustomers`
--
ALTER TABLE `tblcustomers`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblinvoice`
--
ALTER TABLE `tblinvoice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `tblpage`
--
ALTER TABLE `tblpage`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblservices`
--
ALTER TABLE `tblservices`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblsubscriber`
--
ALTER TABLE `tblsubscriber`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblappointment`
--
ALTER TABLE `tblappointment`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tblcustomers`
--
ALTER TABLE `tblcustomers`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tblinvoice`
--
ALTER TABLE `tblinvoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tblpage`
--
ALTER TABLE `tblpage`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblservices`
--
ALTER TABLE `tblservices`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tblsubscriber`
--
ALTER TABLE `tblsubscriber`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
