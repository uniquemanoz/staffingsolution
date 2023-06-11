-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 08, 2018 at 08:13 PM
-- Server version: 10.1.35-MariaDB-cll-lve
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stafqqmn_staffing`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `aid` int(11) NOT NULL,
  `invoicerefid` int(11) NOT NULL,
  `subtotal` varchar(11) NOT NULL,
  `total` varchar(11) NOT NULL,
  `tax` varchar(11) NOT NULL,
  `confirmedBY` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`aid`, `invoicerefid`, `subtotal`, `total`, `tax`, `confirmedBY`) VALUES
(1, 1, '25', '27.33', '2.33', 1),
(2, 2, '27', '29.51', '2.51', 1),
(3, 3, '54', '59.02', '5.02', 1),
(4, 4, '41.5', '45.36', '3.86', 1),
(5, 5, '306.25', '334.73', '28.48', 10);

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `companyid` int(11) NOT NULL,
  `companyname` varchar(50) NOT NULL,
  `abn` varchar(30) NOT NULL,
  `street` varchar(30) NOT NULL,
  `suburb` varchar(20) NOT NULL,
  `stateid` int(2) NOT NULL,
  `postcode` varchar(10) NOT NULL,
  `company_profile` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`companyid`, `companyname`, `abn`, `street`, `suburb`, `stateid`, `postcode`, `company_profile`) VALUES
(1, 'Staffing Solution', '', '', '', 1, '', 'very big company'),
(2, 'C_com', '', '', '', 1, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `invoicerecord`
--

CREATE TABLE `invoicerecord` (
  `invrecid` int(11) NOT NULL,
  `invoicerefid` int(11) NOT NULL,
  `invoicesuffix` varchar(6) NOT NULL,
  `clientid` int(11) NOT NULL,
  `employeeid` int(11) NOT NULL,
  `rosterid` int(11) NOT NULL,
  `createddate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoicerecord`
--

INSERT INTO `invoicerecord` (`invrecid`, `invoicerefid`, `invoicesuffix`, `clientid`, `employeeid`, `rosterid`, `createddate`) VALUES
(1, 1, '#INV', 5, 3, 1, '2018-09-20 01:09:14'),
(2, 2, '#INV', 6, 4, 5, '2018-09-20 11:30:47'),
(3, 3, '#INV', 6, 4, 5, '2018-09-20 11:40:05'),
(4, 3, '#INV', 6, 3, 6, '2018-09-20 11:40:05'),
(5, 4, '#INV', 5, 2, 2, '2018-09-26 20:16:30'),
(6, 4, '#INV', 5, 4, 3, '2018-09-26 20:16:30'),
(7, 4, '#INV', 5, 3, 4, '2018-09-26 20:16:30'),
(8, 5, '#INV', 5, 2, 9, '2018-10-03 18:42:16'),
(9, 5, '#INV', 5, 4, 12, '2018-10-03 18:42:16'),
(10, 5, '#INV', 5, 3, 13, '2018-10-03 18:42:16');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_ref`
--

CREATE TABLE `invoice_ref` (
  `invoicerefid` int(11) NOT NULL,
  `suffix` varchar(6) NOT NULL,
  `clientid` int(11) NOT NULL,
  `createddate` datetime NOT NULL,
  `paymentdate` datetime NOT NULL,
  `isReceptUploaded` int(11) NOT NULL,
  `isPaymentDone` int(11) NOT NULL,
  `invoiceBY` int(11) NOT NULL,
  `duedate` date NOT NULL,
  `accountid` int(11) NOT NULL,
  `receiptpic` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice_ref`
--

INSERT INTO `invoice_ref` (`invoicerefid`, `suffix`, `clientid`, `createddate`, `paymentdate`, `isReceptUploaded`, `isPaymentDone`, `invoiceBY`, `duedate`, `accountid`, `receiptpic`) VALUES
(1, '#INV', 5, '2018-09-20 01:09:14', '2018-09-26 00:00:00', 1, 1, 1, '2018-09-26', 0, 'manoj25.jpg'),
(2, '#INV', 6, '2018-09-20 11:30:47', '0000-00-00 00:00:00', 0, 0, 1, '2018-09-27', 0, ''),
(3, '#INV', 6, '2018-09-20 11:40:05', '0000-00-00 00:00:00', 0, 0, 1, '2018-09-27', 0, ''),
(4, '#INV', 5, '2018-09-26 20:16:30', '0000-00-00 00:00:00', 1, 1, 1, '2018-10-03', 0, 'NF_P1.jpg'),
(5, '#INV', 5, '2018-10-03 18:42:16', '0000-00-00 00:00:00', 0, 0, 10, '2018-10-10', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_type`
--

CREATE TABLE `invoice_type` (
  `invoicetypeid` int(11) NOT NULL,
  `invoicetypename` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice_type`
--

INSERT INTO `invoice_type` (`invoicetypeid`, `invoicetypename`) VALUES
(1, 'Monthly');

-- --------------------------------------------------------

--
-- Table structure for table `rate`
--

CREATE TABLE `rate` (
  `rateid` int(11) NOT NULL,
  `rate` double NOT NULL,
  `currency` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rate`
--

INSERT INTO `rate` (`rateid`, `rate`, `currency`) VALUES
(1, 25, 'AUD'),
(2, 30, 'AUD');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `roleid` int(11) NOT NULL,
  `rolename` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`roleid`, `rolename`) VALUES
(1, 'Employee'),
(2, 'Client'),
(3, 'Administrator'),
(4, 'accountant');

-- --------------------------------------------------------

--
-- Table structure for table `roster`
--

CREATE TABLE `roster` (
  `rosterid` int(11) NOT NULL,
  `employeeid` int(11) NOT NULL,
  `clientid` int(11) NOT NULL,
  `startdatetime` datetime NOT NULL,
  `enddatetime` datetime NOT NULL,
  `assignedBy` int(11) NOT NULL,
  `isCancelled` int(11) NOT NULL,
  `cancelledBy` int(11) NOT NULL,
  `cancelledDate` datetime NOT NULL,
  `assignedDate` datetime NOT NULL,
  `isJobDone` int(1) NOT NULL,
  `jobdonedate` int(11) NOT NULL,
  `comment` text NOT NULL,
  `isInvoiceSent` int(1) NOT NULL,
  `invoicerefid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roster`
--

INSERT INTO `roster` (`rosterid`, `employeeid`, `clientid`, `startdatetime`, `enddatetime`, `assignedBy`, `isCancelled`, `cancelledBy`, `cancelledDate`, `assignedDate`, `isJobDone`, `jobdonedate`, `comment`, `isInvoiceSent`, `invoicerefid`) VALUES
(1, 3, 5, '2018-09-20 01:05:00', '2018-09-20 02:05:00', 1, 0, 0, '0000-00-00 00:00:00', '2018-09-20 01:05:58', 0, 0, '', 1, 1),
(2, 2, 5, '2018-09-20 01:05:00', '2018-09-20 02:05:00', 1, 0, 0, '0000-00-00 00:00:00', '2018-09-20 01:05:58', 0, 0, '', 1, 4),
(3, 4, 5, '2018-09-20 03:05:00', '2018-09-20 03:25:00', 1, 0, 0, '0000-00-00 00:00:00', '2018-09-20 01:07:41', 0, 0, '', 1, 4),
(4, 3, 5, '2018-09-20 03:05:00', '2018-09-20 03:25:00', 1, 0, 0, '0000-00-00 00:00:00', '2018-09-20 01:07:41', 0, 0, '', 1, 4),
(5, 4, 6, '2018-09-20 08:05:00', '2018-09-20 09:10:00', 1, 0, 0, '0000-00-00 00:00:00', '2018-09-20 01:08:02', 0, 0, '', 1, 3),
(6, 3, 6, '2018-09-20 08:05:00', '2018-09-20 09:10:00', 1, 0, 0, '0000-00-00 00:00:00', '2018-09-20 01:08:02', 0, 0, '', 1, 3),
(7, 4, 7, '2018-09-20 13:05:00', '2018-09-20 15:10:00', 1, 0, 0, '0000-00-00 00:00:00', '2018-09-20 01:08:27', 0, 0, '', 0, 0),
(8, 3, 7, '2018-09-20 13:05:00', '2018-09-20 15:10:00', 1, 0, 0, '0000-00-00 00:00:00', '2018-09-20 01:08:27', 0, 0, '', 0, 0),
(9, 2, 5, '2018-09-26 20:15:00', '2018-09-26 23:00:00', 1, 0, 0, '0000-00-00 00:00:00', '2018-09-26 20:14:53', 0, 0, '', 1, 5),
(10, 3, 6, '2018-09-26 21:10:00', '2018-09-26 23:00:00', 1, 0, 0, '0000-00-00 00:00:00', '2018-09-26 20:15:33', 0, 0, '', 0, 0),
(11, 4, 6, '2018-09-26 21:10:00', '2018-09-26 23:00:00', 1, 0, 0, '0000-00-00 00:00:00', '2018-09-26 20:15:33', 0, 0, '', 0, 0),
(12, 4, 5, '2018-10-03 18:15:00', '2018-10-03 23:00:00', 10, 0, 0, '0000-00-00 00:00:00', '2018-10-03 18:40:58', 0, 0, '', 1, 5),
(13, 3, 5, '2018-10-03 18:15:00', '2018-10-03 23:00:00', 10, 0, 0, '0000-00-00 00:00:00', '2018-10-03 18:40:58', 0, 0, '', 1, 5),
(14, 9, 11, '2018-10-04 01:05:00', '2018-10-05 03:15:00', 1, 0, 0, '0000-00-00 00:00:00', '2018-10-04 19:06:17', 0, 0, '', 0, 0),
(15, 4, 11, '2018-10-04 01:05:00', '2018-10-05 03:15:00', 1, 0, 0, '0000-00-00 00:00:00', '2018-10-04 19:06:17', 0, 0, '', 0, 0),
(16, 3, 11, '2018-10-04 01:05:00', '2018-10-05 03:15:00', 1, 0, 0, '0000-00-00 00:00:00', '2018-10-04 19:06:17', 0, 0, '', 0, 0),
(17, 2, 11, '2018-10-04 01:05:00', '2018-10-05 03:15:00', 1, 0, 0, '0000-00-00 00:00:00', '2018-10-04 19:06:17', 0, 0, '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `stateid` int(11) NOT NULL,
  `statename` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`stateid`, `statename`) VALUES
(1, 'NSW');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` int(11) NOT NULL,
  `block_status` int(11) NOT NULL,
  `isActive` int(1) NOT NULL,
  `isSuper` int(1) NOT NULL,
  `isDeleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `username`, `password`, `user_type`, `block_status`, `isActive`, `isSuper`, `isDeleted`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 2, 0, 1, 1, 0),
(2, 'employeeone@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 2, 0, 1, 0, 0),
(3, 'employeetwo@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 2, 0, 1, 0, 0),
(4, 'employeethree@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 2, 0, 1, 0, 0),
(5, 'bhaprakash@gmail.com', '62608e08adc29a8d6dbc9754e659f125', 2, 0, 1, 0, 0),
(6, 'clienttwo@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 2, 0, 1, 0, 0),
(7, 'clientthree@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 2, 0, 1, 0, 0),
(8, 'bhaprakash1@gmail.com', '5dd6f8bdd7dd6fcc734434a4634ce430', 2, 0, 1, 0, 0),
(9, 'lochanjoshi79@gmail.com', '332ca561d9efdf50babb84d11091471c', 2, 0, 1, 0, 0),
(10, 'nahidevan@gmail.com', 'cdc102bb030ccbc303730e7067fcd02f', 2, 0, 1, 0, 0),
(11, 'prakasbhattarai@gmail.com', 'a19d15ec0b3a3a08d00dee5d36c99419', 2, 0, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_details`
--

CREATE TABLE `tbl_user_details` (
  `ud_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `middle_name` varchar(30) NOT NULL,
  `gender` varchar(7) NOT NULL,
  `birthday` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `companyid` int(7) NOT NULL,
  `roleid` int(2) NOT NULL,
  `profilepic` varchar(50) NOT NULL,
  `user_street` varchar(30) NOT NULL,
  `user_state` varchar(5) NOT NULL,
  `user_suburb` varchar(30) NOT NULL,
  `user_country` varchar(30) NOT NULL,
  `position` varchar(30) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `invoicetypeid` int(11) NOT NULL,
  `rateid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user_details`
--

INSERT INTO `tbl_user_details` (`ud_id`, `user_id`, `first_name`, `last_name`, `middle_name`, `gender`, `birthday`, `email`, `companyid`, `roleid`, `profilepic`, `user_street`, `user_state`, `user_suburb`, `user_country`, `position`, `phone`, `invoicetypeid`, `rateid`) VALUES
(1, 1, 'manoj', 'pok', '', 'female', '2121', 'uniquemanoz@gmail.com', 2, 3, '', '', '', '', '', '', '424', 1, 1),
(2, 2, 'employee', 'one', '', 'male', '323', 'employeeone@gmail.com', 1, 1, '', '', '', '', '', '', '423', 1, 1),
(3, 3, 'employee', 'two', '', 'male', '66', 'employeetwo@gmail.com', 1, 1, '', '', '', '', '', '', '23124', 1, 1),
(4, 4, 'employee ', 'three', '', 'male', '342', 'employeethree@gmail.com', 1, 1, '', '', '', '', '', '', '234', 1, 1),
(5, 5, 'Client', 'one', '', 'male', '4324', 'bhaprakash@gmail.com', 2, 2, '', '', '', '', '', '', '312', 1, 1),
(6, 6, 'client', 'two', 'eq', 'male', '3124', 'clienttwo@gmail.com', 2, 2, '', '', '', '', '', '', '21', 1, 1),
(7, 7, 'client', 'three', '43', 'male', '31243', 'clientthree@gmail.com', 2, 2, '', '', '', '', '', '', '3123', 1, 1),
(8, 8, 'bijay', 'ji', '', 'male', '1990/02/12', 'bhaprakash1@gmail.com', 1, 2, '', '', '', '', '', '', '03242', 1, 1),
(9, 9, 'lochan', 'jsjd', 'h', 'male', '1999', 'lochanjoshi79@gmail.com', 2, 1, '', '', '', '', '', '', '12', 1, 1),
(10, 10, 'ahmed', 'saeed', 'midle', 'male', '1900', 'nahidevan@gmail.com', 1, 4, 'nahid.jpg', '61 b koarag', 'nsw', 'kogarh', 'Australia', 'employee', 'w54', 1, 2),
(11, 11, 'prakash', 'bhatrrain', 'faf', 'male', '4324', 'prakasbhattarai@gmail.com', 1, 2, '', '', '', '', '', '', '343', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_type`
--

CREATE TABLE `tbl_user_type` (
  `user_type_id` int(11) NOT NULL,
  `user_type_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user_type`
--

INSERT INTO `tbl_user_type` (`user_type_id`, `user_type_name`) VALUES
(1, 'super'),
(2, 'user'),
(3, 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`companyid`);

--
-- Indexes for table `invoicerecord`
--
ALTER TABLE `invoicerecord`
  ADD PRIMARY KEY (`invrecid`);

--
-- Indexes for table `invoice_ref`
--
ALTER TABLE `invoice_ref`
  ADD PRIMARY KEY (`invoicerefid`);

--
-- Indexes for table `invoice_type`
--
ALTER TABLE `invoice_type`
  ADD PRIMARY KEY (`invoicetypeid`);

--
-- Indexes for table `rate`
--
ALTER TABLE `rate`
  ADD PRIMARY KEY (`rateid`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`roleid`);

--
-- Indexes for table `roster`
--
ALTER TABLE `roster`
  ADD PRIMARY KEY (`rosterid`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`stateid`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `tbl_user_details`
--
ALTER TABLE `tbl_user_details`
  ADD PRIMARY KEY (`ud_id`);

--
-- Indexes for table `tbl_user_type`
--
ALTER TABLE `tbl_user_type`
  ADD PRIMARY KEY (`user_type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `aid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `companyid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `invoicerecord`
--
ALTER TABLE `invoicerecord`
  MODIFY `invrecid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `invoice_ref`
--
ALTER TABLE `invoice_ref`
  MODIFY `invoicerefid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `invoice_type`
--
ALTER TABLE `invoice_type`
  MODIFY `invoicetypeid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rate`
--
ALTER TABLE `rate`
  MODIFY `rateid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `roleid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `roster`
--
ALTER TABLE `roster`
  MODIFY `rosterid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `stateid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_user_details`
--
ALTER TABLE `tbl_user_details`
  MODIFY `ud_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_user_type`
--
ALTER TABLE `tbl_user_type`
  MODIFY `user_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
