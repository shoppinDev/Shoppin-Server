-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: May 31, 2016 at 08:06 AM
-- Server version: 5.6.26-74.0-log
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ibizsm8j_dealwala`
--

-- --------------------------------------------------------

--
-- Table structure for table `deal_admin_user`
--

CREATE TABLE IF NOT EXISTS `deal_admin_user` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `admin_name` varchar(200) NOT NULL,
  `admin_email` varchar(500) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `admin_mobile` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `added_date` datetime NOT NULL,
  `autogen_status` int(1) NOT NULL,
  PRIMARY KEY (`admin_id`),
  KEY `role_id` (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `deal_admin_user`
--

INSERT INTO `deal_admin_user` (`admin_id`, `role_id`, `admin_name`, `admin_email`, `admin_password`, `admin_mobile`, `status`, `added_date`, `autogen_status`) VALUES
(1, 1, 'admin', 'admin@shoppin.com', 'admin', '9854785874', 1, '2016-02-24 00:00:00', 1),
(3, 3, 'subadmin', 'subadmin@shoppin.com', '123456', '8547874785', 1, '2016-04-16 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `deal_category`
--

CREATE TABLE IF NOT EXISTS `deal_category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(200) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `deal_category`
--

INSERT INTO `deal_category` (`category_id`, `category_name`) VALUES
(7, 'Clothes'),
(8, 'Electronics'),
(9, 'Shoes');

-- --------------------------------------------------------

--
-- Table structure for table `deal_customer`
--

CREATE TABLE IF NOT EXISTS `deal_customer` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(200) NOT NULL,
  `customer_email` varchar(500) NOT NULL,
  `customer_password` varchar(20) NOT NULL,
  `customer_mobile` varchar(20) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `is_mobile_verify` tinyint(1) NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `deal_customer`
--

INSERT INTO `deal_customer` (`customer_id`, `customer_name`, `customer_email`, `customer_password`, `customer_mobile`, `is_active`, `is_mobile_verify`, `added_date`) VALUES
(9, 'Jay Patel', 'jay2@gmail.com', '123456', '8547854785', 0, 0, '2016-04-09 00:00:00'),
(11, 'Raj', 'raj@gmail.com', '123456', '7478587478', 1, 0, '2016-04-14 00:00:00'),
(12, 'dp', 'dipesh3112@gmail.com', '123456', '0123456789', 0, 0, '0000-00-00 00:00:00'),
(13, 'dipesh', 'dipesh31112@gmail.com', '123456', '9662498678', 0, 0, '0000-00-00 00:00:00'),
(14, '', 'dipeshshah1992@yahoo.in', '123456', '', 0, 0, '0000-00-00 00:00:00'),
(15, '', 'admin@gmail.com', '12345', '', 1, 0, '2016-05-21 04:57:19'),
(16, '', 'amvipravin@gmail.com', 'test123', '', 0, 0, '2016-05-20 12:56:52'),
(17, 'Nayan', 'khandornayan@gmail.com', 'creations', '9322279809', 1, 0, '2016-05-21 04:47:09'),
(19, '', 'dipesh3112@gmail.com ', 'sample123', '', 0, 0, '2016-05-20 12:59:37'),
(21, '', 'patelnikul321@gmail.com', '123456', '', 0, 0, '0000-00-00 00:00:00'),
(22, '', 'zmannam@gmail.com', 'zmannam', '', 0, 0, '2016-05-21 04:39:06'),
(23, '', 'pradneshproject@gmail.com', 'tobu1234', '', 1, 0, '2016-05-20 14:46:04'),
(24, '', 'mayank@attoinfotech.com', 'kothari', '', 1, 0, '0000-00-00 00:00:00'),
(25, '', 'rajnikant.patel87@gmail.com', '123456', '', 1, 0, '2016-05-20 14:45:50'),
(26, '', 'predation2000@gmail.com', 'sharvari1', '', 0, 0, '2016-05-21 03:12:06'),
(27, 'name', 'mmm@gmail.com', '123', '999999999', 0, 0, '2016-05-25 07:32:28'),
(28, '', 'sreekarmalyala@gmail.com', 'sreechand17oct1', '', 0, 0, '2016-05-23 12:25:01'),
(29, '', 'sree0024@yahoo.com', 'sreechand17oct1', '', 0, 0, '2016-05-23 15:59:59'),
(30, 'Raj Shah', 'raj123@gmail.com', 'raj123', '7894561230', 0, 0, '2016-05-25 07:46:53');

-- --------------------------------------------------------

--
-- Table structure for table `deal_deals`
--

CREATE TABLE IF NOT EXISTS `deal_deals` (
  `deal_id` int(11) NOT NULL AUTO_INCREMENT,
  `merchant_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `deal_category` int(11) NOT NULL,
  `deal_subcategory` int(11) NOT NULL,
  `deal_title` varchar(200) NOT NULL,
  `deal_description` text NOT NULL,
  `deal_startdate` datetime NOT NULL,
  `deal_enddate` datetime NOT NULL,
  `deal_amount` varchar(255) NOT NULL,
  `all_days` varchar(255) NOT NULL,
  `discount_value` varchar(255) NOT NULL,
  `discount_type` int(1) NOT NULL,
  `location` int(1) NOT NULL,
  `deal_usage` int(1) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `added_date` datetime NOT NULL,
  PRIMARY KEY (`deal_id`),
  KEY `shop_id` (`shop_id`),
  KEY `merchant_id` (`merchant_id`),
  KEY `deal_category` (`deal_category`),
  KEY `deal_subcategory` (`deal_subcategory`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=45 ;

--
-- Dumping data for table `deal_deals`
--

INSERT INTO `deal_deals` (`deal_id`, `merchant_id`, `shop_id`, `deal_category`, `deal_subcategory`, `deal_title`, `deal_description`, `deal_startdate`, `deal_enddate`, `deal_amount`, `all_days`, `discount_value`, `discount_type`, `location`, `deal_usage`, `is_active`, `added_date`) VALUES
(28, 29, 30, 7, 11, 'New Levis Jeans 25 %', 'New levis jeans with black strip', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1200', 'Sunday,Monday,Tuesday', '900', 0, 0, 1, 1, '2016-05-19 00:00:00'),
(29, 29, 30, 7, 9, 'Combo Offer 50%', 'Buy Two Shirt at a price of one', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1500', 'Monday,Tuesday,Wednesday,Thursday,Friday', '750', 0, 0, 1, 1, '2016-05-20 00:00:00'),
(30, 29, 30, 7, 11, 'New Denim Blue Jeans 50%', 'New Light Blue denim Jeans', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1500', 'Tuesday,Wednesday,Thursday', '750', 0, 0, 0, 1, '2016-05-20 00:00:00'),
(31, 29, 30, 7, 11, 'New Denim Blue Jeans 50%', 'New Light Blue denim Jeans', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1500', 'Tuesday,Wednesday,Thursday,', '750', 0, 0, 0, 1, '2016-05-20 00:00:00'),
(32, 7, 23, 7, 9, '30% off on leather shirts', '30% off on leather shirts 30% off on leather shirts 30% off on leather shirts 30% off on leather shirts', '2016-04-30 01:10:00', '2016-06-04 15:35:00', '', 'Sunday,Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,', '141', 0, 0, 0, 1, '2016-05-20 00:00:00'),
(33, 29, 30, 7, 9, 'New Checks Shirt 40%', 'New Cotton Shirt', '2016-04-25 18:30:00', '2016-07-01 06:35:00', '1000', 'Friday,Saturday', '600', 0, 0, 0, 1, '2016-05-20 00:00:00'),
(34, 30, 31, 7, 9, 'jeans sales 20 ', 'jeans on salea', '2016-04-27 18:30:00', '2016-04-29 15:30:00', '', 'Sunday,Monday,Tuesday,', '135', 1, 0, 0, 1, '2016-05-20 00:00:00'),
(35, 29, 33, 7, 11, 'New Jeans Collection 20% off', 'New Jeans with Different color and pattern', '2016-04-27 18:00:00', '2016-05-30 01:05:00', '1600', 'Wednesday,Thursday', '1280', 0, 0, 0, 1, '2016-05-20 00:00:00'),
(36, 33, 35, 8, 10, '20% off on Mobile App Development', '20% off', '2016-05-21 03:15:00', '2016-05-30 05:25:00', '500000', 'Sunday,Monday,Tuesday,Wednesday,Thursday,Friday,Saturday', '20', 1, 0, 1, 1, '2016-05-21 00:00:00'),
(37, 33, 35, 7, 9, '40% off flat', '40% off flat', '2016-05-20 12:00:00', '2016-07-09 07:45:00', '200', 'Sunday,Monday,Tuesday,Wednesday,Thursday,Friday,Saturday', '100', 0, 1, 0, 1, '2016-05-21 00:00:00'),
(38, 29, 30, 7, 9, 'New Shirt 30% off', 'New Branded Shirt of Fabric cotton', '2016-04-22 18:00:00', '2016-04-23 18:00:00', '1200', 'Sunday,Monday,Tuesday,Wednesday,', '840', 0, 0, 0, 0, '2016-05-22 00:00:00'),
(39, 7, 23, 7, 9, 'Flat 50% off On New Shirt', 'New Branded Shirt with', '2016-04-23 18:15:00', '2016-04-27 19:00:00', '', 'Monday,Tuesday,Wednesday,Thursday,Friday,', '600', 0, 0, 0, 1, '2016-05-23 00:00:00'),
(40, 37, 37, 7, 9, 'Hurry ', '50% OFF ON SELECTED MOBILES\r\n\n', '2016-04-30 16:38:00', '2016-04-30 17:38:00', '', 'Sunday,Monday,Wednesday,Thursday,Friday,Saturday,', '4950', 0, 0, 0, 1, '2016-05-23 00:00:00'),
(41, 37, 37, 7, 9, 'best offer ', '55% discount across all shirts', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'Sunday,Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,', '25000', 0, 0, 0, 1, '2016-05-23 00:00:00'),
(42, 39, 38, 7, 9, 'Half Price ', 'Half Price ', '2016-04-24 10:01:00', '2016-04-26 10:01:00', '2000', 'Sunday,Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,', '1000', 0, 0, 0, 1, '2016-05-24 00:00:00'),
(43, 37, 37, 7, 9, 'best offer ', '      ', '2016-04-30 14:52:00', '2016-04-30 00:52:00', '5000', 'Sunday,Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,', '4400', 0, 0, 0, 1, '2016-05-30 00:00:00'),
(44, 37, 37, 7, 9, 'big bash ', 'Bash ', '2016-04-30 13:06:00', '2016-04-30 02:07:00', '45000', 'Monday,', '25200', 0, 0, 0, 1, '2016-05-30 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `deal_merchant`
--

CREATE TABLE IF NOT EXISTS `deal_merchant` (
  `merchant_id` int(11) NOT NULL AUTO_INCREMENT,
  `merchant_name` varchar(500) NOT NULL,
  `merchant_email` varchar(500) NOT NULL,
  `merchant_password` varchar(255) NOT NULL,
  `merchant_mobile` varchar(20) NOT NULL,
  `merchant_vat` varchar(20) NOT NULL,
  `merchant_tax` varchar(20) NOT NULL,
  `merchant_pan` varchar(20) NOT NULL,
  `merchant_add` text NOT NULL,
  `merchant_city` varchar(255) NOT NULL,
  `merchant_State` varchar(255) NOT NULL,
  `merchant_zip` varchar(255) NOT NULL,
  `merchant_country` varchar(255) NOT NULL,
  `is_approve` tinyint(1) NOT NULL,
  `added_date` datetime NOT NULL,
  PRIMARY KEY (`merchant_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `deal_merchant`
--

INSERT INTO `deal_merchant` (`merchant_id`, `merchant_name`, `merchant_email`, `merchant_password`, `merchant_mobile`, `merchant_vat`, `merchant_tax`, `merchant_pan`, `merchant_add`, `merchant_city`, `merchant_State`, `merchant_zip`, `merchant_country`, `is_approve`, `added_date`) VALUES
(7, 'Jayesh S', 'jayesh21@gmail.com', '123456', '9874565854', '4', '10', 'DS1D323435', '', '', '', '', '', 1, '2016-02-13 00:00:00'),
(26, 'Dipesh', 'dipesh3112@gmail.com', '123456', '8547874785', '', '', 'AODP123232', '', '', '', '', '', 0, '2016-05-18 00:00:00'),
(29, '', 'nits@gmail.com', 'nits123', '', '', '', '', '', '', '', '', '', 1, '2016-05-19 00:00:00'),
(30, 'Nikul Patel', 'patelnikul321@gmail.com', '123456', '1234567891', '5', '5', '123456789A', '555', '555', '555', '55555', '555', 1, '2016-05-21 00:00:00'),
(31, '', 'pradneshproject@gmail.com', 'sharvari1', '', '', '', '', '', '', '', '', '', 0, '2016-05-21 00:00:00'),
(33, 'Atto Infotech', 'nayan.khandor@attoinfotech.com', 'creations', '9322279809', '', '', 'ALJPK12345', 'Jasmine Apartment', 'Mumbai', 'MH', '400014', 'IN', 1, '2016-05-21 00:00:00'),
(34, 'Rajesh S', 'rajesh@gmail.com', '123', '8547874785', '', '', 'AA22222222', '', '', '', '', '', 2, '2016-05-21 00:00:00'),
(35, '', 'predation2000@gmail.com', 'sharvari1', '', '', '', '', '', '', '', '', '', 0, '2016-05-21 00:00:00'),
(36, 'mali neha', 'amvipravin@gmail.com', '12345', '9173757784', '', '', '', '', '', '', '', '', 0, '2016-05-23 00:00:00'),
(37, 'Sreekar', 'sreekarmalyala@gmail.com', 'sreechand17oct1', '8688846861', '', '', 'BKWPS12345', '', '', '', '', '', 1, '2016-05-23 00:00:00'),
(38, '', 'zee.mannam@gmail.com', 'Changeme12', '', '', '', '', '', '', '', '', '', 1, '2016-05-24 00:00:00'),
(39, 'Zee', 'merchantone@gmail.com', 'merchantone', '8688846861', '', '', 'BKWPS12345', '', '', '', '', '', 1, '2016-05-24 00:00:00'),
(40, 'roja madala', 'roja.madala@shoppin.co.in', 'Ch@ngeme12', '9845773747', '', '', '', '', '', '', '', '', 0, '2016-05-29 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `deal_merchantshops`
--

CREATE TABLE IF NOT EXISTS `deal_merchantshops` (
  `shop_id` int(11) NOT NULL AUTO_INCREMENT,
  `merchant_id` int(11) NOT NULL,
  `shop_name` varchar(1000) NOT NULL,
  `shop_addres` text NOT NULL,
  `shop_latitude` varchar(20) NOT NULL,
  `shop_longitude` varchar(20) NOT NULL,
  `shop_email` varchar(500) NOT NULL,
  `shop_mobile` varchar(20) NOT NULL,
  `qr_image` varchar(255) NOT NULL,
  `shop_add` text NOT NULL,
  `shop_city` varchar(255) NOT NULL,
  `shop_state` varchar(255) NOT NULL,
  `shop_zip` varchar(255) NOT NULL,
  `shop_country` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `added_date` datetime NOT NULL,
  PRIMARY KEY (`shop_id`),
  KEY `merchant_id` (`merchant_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ;

--
-- Dumping data for table `deal_merchantshops`
--

INSERT INTO `deal_merchantshops` (`shop_id`, `merchant_id`, `shop_name`, `shop_addres`, `shop_latitude`, `shop_longitude`, `shop_email`, `shop_mobile`, `qr_image`, `shop_add`, `shop_city`, `shop_state`, `shop_zip`, `shop_country`, `is_active`, `added_date`) VALUES
(16, 7, 'A one Clothes', 'Uma Complex, Malad East', '72.25', '18.25', 'aone@gmail.com', '9658748587', '716code.png', '', 'Mumbai', 'Maharashtra', '', 'India', 1, '2016-04-11 00:00:00'),
(21, 7, 'name', 'add', '123', '321', 'a@gmail.com', '9638875466', '', '', 'deesa', 'gujarat', '123', 'india', 0, '2016-05-10 00:00:00'),
(22, 7, 'name', 'add', '123', '321', 'a@gmail.com', '9638875466', '722code.png', '', 'deesa', 'gujarat', '123', 'india', 0, '2016-05-12 00:00:00'),
(23, 7, 'Grocery Shop 1', 'Shop 120 , SV road, Goregaon,', '19.1705578', '72.875115', 'test@gmail.com', '9875656562', '723code.png', '', 'Mumbai', 'Maharashtra', '400064', 'India', 1, '2016-05-13 00:00:00'),
(24, 7, 'Demo shop', 'mumbai,mumbai', '', '', 'dipesh3112@gmail.com', '9974246994', '724code.png', '', '', '', '', '', 0, '2016-05-18 00:00:00'),
(25, 7, 'Demo shop', 'mumbai,mumbai', '', '', 'dipesh3112@gmail.com', '9974246994', '725code.png', '', 'mumbai', 'maharastra', '989898', 'india', 0, '2016-05-18 00:00:00'),
(26, 7, 'raj shop', 'malad,mumbai', '', '', 'raj@gmail.com', '8525412525', '726code.png', '', 'mumbai', 'maharastra', '400097', 'india', 1, '2016-05-18 00:00:00'),
(30, 29, 'Loot le Clothes', 'Shop 91,SV Road, Nataraj Mall,Malad west.,', '19.182755', '72.840157', 'nits@gmail.com', '1234567890', '2930code.png', '', 'Mumbai', 'Maharashtra', '400064', 'India ', 1, '2016-05-19 00:00:00'),
(31, 30, 'nikul shop1', 'malad.east,mumbai', '25.223', '-37.3977', 'patelnikul321@gmail.com', '1234567890', '3031code.png', '', 'mumbai', 'maharashtra', '400097', 'india', 1, '2016-05-20 00:00:00'),
(32, 29, 'A K Electronics', 'Shop 103, Malad Shopping Center,,SV Road, Malad West.', '19.182755', '72.840157', 'ak@gmail.com', '1234567890', '2932code.png', '', 'Mumbai', 'Maharashtra', '400064', 'India', 0, '2016-05-20 00:00:00'),
(33, 29, 'Grabbit CLothes', 'Shop 120, Masjid Bunder, Mumbai,', '12.385465', '72.15648', 'grabbit@gmail.com', '1234567890', '2933code.png', '', 'Mumbai', 'Maharashtra', '400064', 'India', 0, '2016-05-20 00:00:00'),
(35, 33, 'Dadar West Office', 'Near Dadar Station', '19.01525', '72.84482', '', '2265610774', '3335code.png', '', 'Mumbai', 'MH', '400014', 'IN', 1, '2016-05-21 00:00:00'),
(36, 26, 'A2Z clothes', 'adarsh nagar,malad east', '', '', 'a2z@gmail.com', '84215451243', '2636code.png', '', 'mumbai', 'maharastra', '400097', 'india', 0, '2016-05-21 00:00:00'),
(37, 37, 'Cafe Coffee Day ', 'Pragathi Nagar main Road,PragathiNagar, Hyderabad', '17.51525441', '78.3269166', 'sreekarmalyala@gmail.com', '8688846861', '3737code.png', '', 'Hyderabad', 'Telangana', '500090', 'India', 1, '2016-05-23 00:00:00'),
(38, 39, 'Fremont Tile & Carpet', '3138 osgood ct,Fremont ,CA ,USA', '37.51571', '-121.948', 'merchantone@gmail.com', '8688846861', '3938code.png', '', 'Fremont', 'CA', '3138', 'US', 0, '2016-05-24 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `deal_module`
--

CREATE TABLE IF NOT EXISTS `deal_module` (
  `module_id` int(11) NOT NULL AUTO_INCREMENT,
  `module_name` varchar(200) NOT NULL,
  PRIMARY KEY (`module_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `deal_module`
--

INSERT INTO `deal_module` (`module_id`, `module_name`) VALUES
(1, 'Subcategory'),
(8, 'Category'),
(9, 'Deals'),
(10, 'Customer'),
(11, 'Merchant'),
(12, 'Role'),
(14, 'Admin User'),
(15, 'Module'),
(16, 'Saved deals'),
(18, 'Shop');

-- --------------------------------------------------------

--
-- Table structure for table `deal_order`
--

CREATE TABLE IF NOT EXISTS `deal_order` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `deal_id` int(11) NOT NULL,
  `amount` double(17,2) NOT NULL,
  `order_date` datetime NOT NULL,
  `order_status` int(2) NOT NULL,
  PRIMARY KEY (`order_id`),
  KEY `customer_id` (`customer_id`),
  KEY `deal_id` (`deal_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43 ;

--
-- Dumping data for table `deal_order`
--

INSERT INTO `deal_order` (`order_id`, `customer_id`, `deal_id`, `amount`, `order_date`, `order_status`) VALUES
(17, 21, 32, 150.00, '2016-05-20 00:00:00', 0),
(18, 9, 32, 150.00, '2016-05-20 00:00:00', 0),
(19, 9, 32, 150.00, '2016-05-21 00:00:00', 0),
(20, 9, 32, 150.00, '2016-05-21 00:00:00', 0),
(21, 9, 33, 1000.00, '2016-05-21 00:00:00', 0),
(22, 17, 32, 150.00, '2016-05-21 00:00:00', 0),
(23, 25, 32, 150.00, '2016-05-21 00:00:00', 0),
(24, 9, 36, 500000.00, '2016-05-21 00:00:00', 0),
(25, 17, 36, 500000.00, '2016-05-21 00:00:00', 0),
(26, 17, 33, 1000.00, '2016-05-21 00:00:00', 0),
(27, 9, 40, 25000.00, '2016-05-23 00:00:00', 0),
(28, 9, 32, 150.00, '2016-05-23 00:00:00', 0),
(29, 28, 40, 25000.00, '2016-05-24 00:00:00', 0),
(30, 28, 40, 25000.00, '2016-05-24 00:00:00', 0),
(31, 21, 33, 1000.00, '2016-05-24 00:00:00', 0),
(32, 17, 37, 200.00, '2016-05-24 00:00:00', 0),
(33, 17, 37, 200.00, '2016-05-24 00:00:00', 0),
(34, 17, 36, 500000.00, '2016-05-24 00:00:00', 0),
(35, 9, 32, 150.00, '2016-05-25 00:00:00', 0),
(36, 9, 40, 0.00, '2016-05-25 00:00:00', 0),
(37, 9, 40, 0.00, '2016-05-25 00:00:00', 0),
(38, 9, 40, 0.00, '2016-05-25 00:00:00', 0),
(39, 9, 40, 0.00, '2016-05-25 00:00:00', 0),
(40, 9, 40, 0.00, '2016-05-25 00:00:00', 0),
(41, 21, 33, 1000.00, '2016-05-26 00:00:00', 0),
(42, 21, 33, 1000.00, '2016-05-26 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `deal_role`
--

CREATE TABLE IF NOT EXISTS `deal_role` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(200) NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `deal_role`
--

INSERT INTO `deal_role` (`role_id`, `role_name`) VALUES
(1, 'admin'),
(3, 'Sub Admin'),
(4, 'Super Admin'),
(10, 'Customer Support'),
(11, 'Subcategory ');

-- --------------------------------------------------------

--
-- Table structure for table `deal_role_module`
--

CREATE TABLE IF NOT EXISTS `deal_role_module` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `role_id` (`role_id`),
  KEY `module_id` (`module_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=161 ;

--
-- Dumping data for table `deal_role_module`
--

INSERT INTO `deal_role_module` (`id`, `role_id`, `module_id`) VALUES
(120, 1, 1),
(121, 1, 8),
(122, 1, 9),
(123, 1, 10),
(124, 1, 11),
(125, 1, 12),
(126, 1, 14),
(127, 1, 15),
(128, 1, 16),
(129, 1, 18),
(140, 3, 1),
(141, 3, 8),
(142, 3, 9),
(143, 3, 10),
(144, 3, 11),
(145, 3, 18),
(146, 10, 1),
(147, 10, 8),
(148, 10, 10),
(158, 4, 11),
(159, 4, 12),
(160, 11, 1);

-- --------------------------------------------------------

--
-- Table structure for table `deal_saveddeals`
--

CREATE TABLE IF NOT EXISTS `deal_saveddeals` (
  `save_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `deal_id` int(11) NOT NULL,
  `added_date` datetime NOT NULL,
  PRIMARY KEY (`save_id`),
  KEY `customer_id` (`customer_id`),
  KEY `deal_id` (`deal_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `deal_saveddeals`
--

INSERT INTO `deal_saveddeals` (`save_id`, `customer_id`, `deal_id`, `added_date`) VALUES
(14, 9, 33, '0000-00-00 00:00:00'),
(15, 9, 33, '0000-00-00 00:00:00'),
(16, 17, 33, '0000-00-00 00:00:00'),
(17, 9, 32, '0000-00-00 00:00:00'),
(20, 9, 32, '0000-00-00 00:00:00'),
(21, 17, 32, '0000-00-00 00:00:00'),
(22, 17, 37, '0000-00-00 00:00:00'),
(23, 17, 37, '0000-00-00 00:00:00'),
(24, 17, 37, '0000-00-00 00:00:00'),
(25, 17, 37, '0000-00-00 00:00:00'),
(26, 9, 40, '0000-00-00 00:00:00'),
(27, 9, 40, '0000-00-00 00:00:00'),
(28, 29, 40, '0000-00-00 00:00:00'),
(29, 29, 40, '0000-00-00 00:00:00'),
(30, 28, 40, '0000-00-00 00:00:00'),
(31, 28, 40, '0000-00-00 00:00:00'),
(32, 28, 40, '0000-00-00 00:00:00'),
(33, 9, 40, '0000-00-00 00:00:00'),
(34, 9, 40, '0000-00-00 00:00:00'),
(35, 21, 33, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `deal_subcategory`
--

CREATE TABLE IF NOT EXISTS `deal_subcategory` (
  `subcategory_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `subcategory_name` varchar(200) NOT NULL,
  PRIMARY KEY (`subcategory_id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `deal_subcategory`
--

INSERT INTO `deal_subcategory` (`subcategory_id`, `category_id`, `subcategory_name`) VALUES
(9, 7, 'Shirts'),
(10, 8, 'Mobile'),
(11, 7, 'Jeans');

-- --------------------------------------------------------

--
-- Table structure for table `deal_user_billing_details`
--

CREATE TABLE IF NOT EXISTS `deal_user_billing_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `address` text NOT NULL,
  `city` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `zipcode` int(11) NOT NULL,
  `added_date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `customer_id` (`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `deal_admin_user`
--
ALTER TABLE `deal_admin_user`
  ADD CONSTRAINT `deal_admin_user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `deal_role` (`role_id`);

--
-- Constraints for table `deal_deals`
--
ALTER TABLE `deal_deals`
  ADD CONSTRAINT `deal_deals_ibfk_1` FOREIGN KEY (`merchant_id`) REFERENCES `deal_merchant` (`merchant_id`),
  ADD CONSTRAINT `deal_deals_ibfk_2` FOREIGN KEY (`shop_id`) REFERENCES `deal_merchantshops` (`shop_id`),
  ADD CONSTRAINT `deal_deals_ibfk_3` FOREIGN KEY (`deal_category`) REFERENCES `deal_category` (`category_id`),
  ADD CONSTRAINT `deal_deals_ibfk_4` FOREIGN KEY (`deal_subcategory`) REFERENCES `deal_subcategory` (`subcategory_id`);

--
-- Constraints for table `deal_merchantshops`
--
ALTER TABLE `deal_merchantshops`
  ADD CONSTRAINT `fk_merchand_id` FOREIGN KEY (`merchant_id`) REFERENCES `deal_merchant` (`merchant_id`);

--
-- Constraints for table `deal_order`
--
ALTER TABLE `deal_order`
  ADD CONSTRAINT `deal_order_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `deal_customer` (`customer_id`),
  ADD CONSTRAINT `deal_order_ibfk_2` FOREIGN KEY (`deal_id`) REFERENCES `deal_deals` (`deal_id`);

--
-- Constraints for table `deal_role_module`
--
ALTER TABLE `deal_role_module`
  ADD CONSTRAINT `deal_role_module_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `deal_role` (`role_id`),
  ADD CONSTRAINT `deal_role_module_ibfk_2` FOREIGN KEY (`module_id`) REFERENCES `deal_module` (`module_id`);

--
-- Constraints for table `deal_saveddeals`
--
ALTER TABLE `deal_saveddeals`
  ADD CONSTRAINT `deal_saveddeals_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `deal_customer` (`customer_id`),
  ADD CONSTRAINT `deal_saveddeals_ibfk_2` FOREIGN KEY (`deal_id`) REFERENCES `deal_deals` (`deal_id`);

--
-- Constraints for table `deal_subcategory`
--
ALTER TABLE `deal_subcategory`
  ADD CONSTRAINT `fk_category_id` FOREIGN KEY (`category_id`) REFERENCES `deal_category` (`category_id`);

--
-- Constraints for table `deal_user_billing_details`
--
ALTER TABLE `deal_user_billing_details`
  ADD CONSTRAINT `deal_user_billing_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `deal_customer` (`customer_id`),
  ADD CONSTRAINT `deal_user_billing_details_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `deal_order` (`order_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
