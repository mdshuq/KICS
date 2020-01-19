-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 16, 2019 at 03:57 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 5.6.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kics`
--

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `item_id` int(11) NOT NULL,
  `item_name` varchar(50) NOT NULL,
  `item_unit` varchar(50) NOT NULL,
  `item_demand_perYear` int(11) NOT NULL,
  `item_ROP` int(11) NOT NULL,
  `item_current_quantity` int(11) NOT NULL,
  `s_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`item_id`, `item_name`, `item_unit`, `item_demand_perYear`, `item_ROP`, `item_current_quantity`, `s_id`) VALUES
(1, 'Susu Pekat Gold Coin', 'Tin', 1000, 11, 30, '1'),
(2, 'Gula Kasar', 'Paket', 2000, 22, 33, '1'),
(3, 'Gula Kastor', 'Paket', 2000, 22, 25, '1'),
(4, 'Teh Boh', 'Paket', 200, 2, 18, '1'),
(5, 'Fullcream Dutch Lady ', 'Kotak', 300, 3, 40, '1'),
(6, 'Essen Vanilla', 'Botol', 20, 0, 19, '1'),
(7, 'Sos Tomato Life', 'Botol', 300, 3, 22, '1'),
(8, 'Rempah Kari Ikan Adabi ', 'Paket', 215, 2, 16, '1'),
(9, 'Perencah Sup Adabi', 'Paket', 200, 2, 19, '2'),
(10, 'Rempah Kurma Adabi ', 'Paket', 200, 2, 22, '2'),
(11, 'Tepung Beras', 'Paket', 200, 2, 100, '2'),
(12, 'Sardin Ayam Brand', 'Tin', 200, 2, 50, '2'),
(13, 'Minyak Masak Cap Buruh', 'Botol', 250, 3, 28, '2'),
(14, 'Minyak Mazola ', 'Botol', 200, 2, 43, '2'),
(15, 'Ajinomoto', 'Paket', 400, 4, 49, '2'),
(16, 'Tepung Ayam Goreng', 'Paket', 50, 1, 3, '2');

-- --------------------------------------------------------

--
-- Table structure for table `month`
--

CREATE TABLE `month` (
  `m_id` int(11) NOT NULL,
  `m_name` varchar(20) NOT NULL,
  `m_purchase` decimal(13,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `month`
--

INSERT INTO `month` (`m_id`, `m_name`, `m_purchase`) VALUES
(1, 'Januari', '0.00'),
(2, 'Februari', '0.00'),
(3, 'Mac', '0.00'),
(4, 'April', '0.00'),
(5, 'Mei', '0.00'),
(6, 'Jun', '0.00'),
(7, 'July', '0.00'),
(8, 'Ogos', '0.00'),
(9, 'September', '0.00'),
(10, 'Oktober', '0.00'),
(11, 'November', '0.00'),
(12, 'Disember', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `requisition`
--

CREATE TABLE `requisition` (
  `r_id` int(11) NOT NULL,
  `r_date_use` date NOT NULL,
  `r_purpose` varchar(500) NOT NULL,
  `r_date` date NOT NULL,
  `r_status` varchar(50) NOT NULL,
  `r_type` varchar(50) DEFAULT NULL,
  `r_notification` varchar(20) NOT NULL,
  `app_id` int(11) NOT NULL,
  `off_id` varchar(11) NOT NULL,
  `s_id` int(50) NOT NULL,
  `v_note` varchar(500) DEFAULT NULL,
  `v_note2` varchar(500) DEFAULT NULL,
  `total_cost` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `requisition`
--

INSERT INTO `requisition` (`r_id`, `r_date_use`, `r_purpose`, `r_date`, `r_status`, `r_type`, `r_notification`, `app_id`, `off_id`, `s_id`, `v_note`, `v_note2`, `total_cost`) VALUES
(1, '2019-02-02', 'Majlis Menghadap', '2019-01-08', 'Complete', 'IN', '', 2, '', 2, NULL, NULL, '115.00'),
(1000, '2019-01-30', 'Kegunaan Dapur Harian', '2019-01-17', 'Complete', 'IN', '', 2, '', 2, NULL, NULL, '105.00'),
(1001, '2019-01-10', 'Keperluan Harian', '2019-01-08', 'Complete', 'OUT', 'unread', 4, '3', 2, 'Permohonan Diluluskan', '', NULL),
(1002, '2019-01-09', '', '2019-02-08', 'Complete', 'IN', '', 2, '', 2, NULL, NULL, '10.00'),
(1005, '2019-01-10', 'Majlis Syura', '2019-01-08', 'Lulus', 'OUT', 'unread', 4, '3', 2, 'Diluluskan', NULL, NULL),
(1006, '2019-01-10', 'Majlis ', '2019-01-08', 'Complete', 'OUT', 'read', 4, '3', 1, '', 'Permohonan Selesai', NULL),
(1007, '2019-01-16', 'Majlis Sambutan Bulanan', '2019-01-08', 'Pending', 'OUT', 'read', 4, '', 2, NULL, NULL, NULL),
(1008, '2019-01-10', 'Penggunaan Harian', '2019-01-08', 'Gagal', 'OUT', 'read', 4, '3', 1, 'Kuantiti Terlampau Banyak', NULL, NULL),
(1009, '2019-02-06', 'Majlis Amal', '2019-03-06', 'Complete', 'IN', '', 2, '', 1, NULL, NULL, '16.00'),
(1010, '2019-03-21', '', '2019-03-21', 'Complete', 'IN', '', 2, '', 2, NULL, NULL, '85.00'),
(1011, '2019-04-22', 'Majlis Cukur Jambul', '2019-04-22', 'Complete', 'IN', '', 2, '', 1, NULL, NULL, '80.90'),
(1012, '2019-05-27', 'Majlis Menghadap', '2019-05-27', 'Complete', 'IN', '', 2, '', 2, NULL, NULL, '95.60'),
(1013, '2019-01-10', 'Majlis Makan Malam', '2019-01-08', 'Lulus', 'OUT', 'read', 4, '3', 2, 'Permohonan Lulus', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `requisition_detail`
--

CREATE TABLE `requisition_detail` (
  `req_id` int(11) NOT NULL,
  `req_item` varchar(50) NOT NULL,
  `req_quantity` int(50) NOT NULL,
  `req_quantity_out` int(50) DEFAULT NULL,
  `req_quantity_out2` int(50) DEFAULT NULL,
  `item_cost` decimal(13,2) DEFAULT NULL,
  `itemID` varchar(11) NOT NULL,
  `r_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `requisition_detail`
--

INSERT INTO `requisition_detail` (`req_id`, `req_item`, `req_quantity`, `req_quantity_out`, `req_quantity_out2`, `item_cost`, `itemID`, `r_id`) VALUES
(1, 'Ajinomoto', 20, NULL, NULL, '25.00', '15 ', 1),
(2, 'Minyak Masak Cap Buruh', 5, NULL, NULL, '50.00', '13 ', 1),
(3, 'Tepung Beras', 30, NULL, NULL, '40.00', '11 ', 1),
(4, 'Sardin Ayam Brand', 20, NULL, NULL, '25.00', '12 ', 1000),
(5, 'Tepung Beras', 30, NULL, NULL, '35.00', '11 ', 1000),
(6, 'Minyak Mazola ', 20, NULL, NULL, '45.00', '14 ', 1000),
(8, 'Perencah Sup Adabi', 3, 2, 1, NULL, '9', 1001),
(9, 'Tepung Beras', 3, 2, 2, NULL, '11', 1001),
(10, 'Rempah Kurma Adabi ', 3, 3, 3, NULL, '10', 1001),
(11, 'Ajinomoto', 4, NULL, NULL, '5.00', '15 ', 1002),
(12, 'Tepung Beras', 2, NULL, NULL, '5.00', '11 ', 1002),
(15, 'Ajinomoto', 3, 2, 2, NULL, '15', 1005),
(16, 'Tepung Beras', 4, 3, 3, NULL, '11', 1005),
(17, 'Sardin Ayam Brand', 5, 5, 5, NULL, '12', 1005),
(18, 'Rempah Kurma Adabi ', 4, 4, 4, NULL, '10', 1005),
(19, 'Essen Vanilla', 3, 3, 3, NULL, '6', 1006),
(20, 'Sos Tomato Life', 3, 3, 3, NULL, '7', 1006),
(21, 'Teh Boh', 2, 2, 2, NULL, '4', 1006),
(22, 'Gula Kastor', 5, 5, 5, NULL, '3', 1006),
(23, 'Rempah Kari Ikan Adabi ', 4, 4, 4, NULL, '8', 1006),
(24, 'Rempah Kurma Adabi ', 4, 4, NULL, NULL, '10', 1007),
(25, 'Tepung Beras', 4, 4, NULL, NULL, '11', 1007),
(26, 'Sardin Ayam Brand', 5, 5, NULL, NULL, '12', 1007),
(27, 'Minyak Mazola ', 2, 2, NULL, NULL, '14', 1007),
(28, 'Minyak Masak Cap Buruh', 5, 5, NULL, NULL, '13', 1007),
(29, 'Essen Vanilla', 50, 50, 50, NULL, '6', 1008),
(30, 'Gula Kasar', 10, 10, 10, NULL, '2', 1008),
(31, 'Susu Pekat Gold Coin', 13, 13, 13, NULL, '1', 1008),
(32, 'Sos Tomato Life', 20, 20, 20, NULL, '7', 1008),
(33, 'Gula Kasar', 3, NULL, NULL, '4.00', '2 ', 1009),
(34, 'Susu Pekat Gold Coin', 5, NULL, NULL, '7.50', '1 ', 1009),
(35, 'Essen Vanilla', 3, NULL, NULL, '4.50', '6 ', 1009),
(36, 'Tepung Beras', 10, NULL, NULL, '30.00', '11 ', 1010),
(37, 'Sardin Ayam Brand', 10, NULL, NULL, '35.00', '12 ', 1010),
(38, 'Rempah Kurma Adabi ', 5, NULL, NULL, '20.00', '10 ', 1010),
(39, 'Gula Kasar', 10, NULL, NULL, '25.00', '2 ', 1011),
(40, 'Fullcream Dutch Lady ', 10, NULL, NULL, '32.50', '5 ', 1011),
(41, 'Sos Tomato Life', 5, NULL, NULL, '13.40', '7 ', 1011),
(42, 'Susu Pekat Gold Coin', 5, NULL, NULL, '10.00', '1 ', 1011),
(43, 'Tepung Beras', 10, NULL, NULL, '24.60', '11 ', 1012),
(44, 'Minyak Masak Cap Buruh', 3, NULL, NULL, '36.00', '13 ', 1012),
(45, 'Minyak Mazola ', 3, NULL, NULL, '35.00', '14 ', 1012),
(46, 'Perencah Sup Adabi', 3, 2, 1, NULL, '9', 1013),
(47, 'Rempah Kurma Adabi ', 3, 3, 3, NULL, '10', 1013),
(48, 'Tepung Beras', 3, 3, 3, NULL, '11', 1013);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staffID` int(11) NOT NULL,
  `staff_username` varchar(50) NOT NULL,
  `staff_password` varchar(100) NOT NULL,
  `staff_fname` varchar(60) NOT NULL,
  `staff_ic` varchar(15) NOT NULL,
  `staff_email` varchar(50) NOT NULL,
  `staff_contact` varchar(20) NOT NULL,
  `staff_role` varchar(20) NOT NULL,
  `staff_position` varchar(50) NOT NULL,
  `staff_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staffID`, `staff_username`, `staff_password`, `staff_fname`, `staff_ic`, `staff_email`, `staff_contact`, `staff_role`, `staff_position`, `staff_status`) VALUES
(1, 'shuq29', '827ccb0eea8a706c4c34a16891f84e7b', 'MOHAMAD SHUKRI BIN SALEH HUDIN', '960429115141', 'shuq29@yahoo.com', '0145009851', 'Admin', 'Admin', '1'),
(2, 'ira', '827ccb0eea8a706c4c34a16891f84e7b', 'NUR SHAHIRA BINTI JALIL', '790825115638', 'shahira@gmail.com', '0186666252', 'Kerani', 'Kerani', '1'),
(3, 'zaki', '827ccb0eea8a706c4c34a16891f84e7b', 'ZAKI BIN ENDUT', '702536253625', 'zaki@gmail.com', '0122223650', 'Pegawai', 'Pegawai', '1'),
(4, 'siti', '827ccb0eea8a706c4c34a16891f84e7b', 'SITI NOR SHAHIDAH BINTI ZALI', '940206105822', 'siti@gmail.com', '022225632', 'Pemohon', 'Pelayan', '1'),
(5, 'afiqah', '827ccb0eea8a706c4c34a16891f84e7b', 'AFIQAH NAJIHAH BINTI SUHAIMI', '740205333625', 'AFIQAH@GMAIL.COM', '01215456533', 'Pemohon', 'Ketua Chef', '1'),
(6, 'shuq299', 'e10adc3949ba59abbe56e057f20f883e', 'MOHAMAD SHUKRI BIN SALEH HUDIN', '960429115141', 'shuq29@yahoo.com', '0145009851', 'Pemohon', 'Pelayan', '1');

-- --------------------------------------------------------

--
-- Table structure for table `store`
--

CREATE TABLE `store` (
  `store_id` int(11) NOT NULL,
  `store_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `store`
--

INSERT INTO `store` (`store_id`, `store_name`) VALUES
(1, 'Terengganu Residence (TR)'),
(2, 'Public Kitchen (PK)');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `month`
--
ALTER TABLE `month`
  ADD PRIMARY KEY (`m_id`);

--
-- Indexes for table `requisition`
--
ALTER TABLE `requisition`
  ADD PRIMARY KEY (`r_id`);

--
-- Indexes for table `requisition_detail`
--
ALTER TABLE `requisition_detail`
  ADD PRIMARY KEY (`req_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staffID`);

--
-- Indexes for table `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`store_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `month`
--
ALTER TABLE `month`
  MODIFY `m_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `requisition`
--
ALTER TABLE `requisition`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1014;

--
-- AUTO_INCREMENT for table `requisition_detail`
--
ALTER TABLE `requisition_detail`
  MODIFY `req_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staffID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `store`
--
ALTER TABLE `store`
  MODIFY `store_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
