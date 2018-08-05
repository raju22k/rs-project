-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 01, 2018 at 06:10 AM
-- Server version: 5.6.36-82.0-log
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `solorixc_properties`
--

-- --------------------------------------------------------

--
-- Stand-in structure for view `all_properties`
-- (See below for the actual view)
--
CREATE TABLE `all_properties` (
`id` int(11)
,`user_name` varchar(250)
,`property_id` varchar(20)
,`title` varchar(250)
,`property_status` varchar(50)
,`property_type` varchar(50)
,`type_id` int(11)
,`price` float
,`area` int(11)
,`rooms` varchar(20)
,`address` varchar(250)
,`landmark` varchar(250)
,`place` varchar(50)
,`description` text
,`bld_age` varchar(20)
,`bed_rooms` varchar(20)
,`furnished` varchar(20)
,`date_modified` datetime
);

-- --------------------------------------------------------

--
-- Table structure for table `property_age`
--

CREATE TABLE `property_age` (
  `id` int(11) NOT NULL,
  `age_list` varchar(20) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `property_age`
--

INSERT INTO `property_age` (`id`, `age_list`, `created`, `modified`) VALUES
(1, '0 - 1 Years', '2017-09-15 11:39:15', '2017-09-15 11:39:15'),
(2, '1 - 5 Years', '2017-09-15 11:39:15', '2017-09-15 11:39:15'),
(3, '5 - 10 Years', '2017-09-15 11:39:15', '2017-09-15 11:39:15'),
(4, '10 - 20 Years', '2017-09-15 11:39:15', '2017-09-15 11:39:15'),
(5, '20 - 50 Years', '2017-09-15 11:39:15', '2017-09-15 11:39:15'),
(6, '50 + Years', '2017-09-15 11:39:15', '2017-09-15 11:39:15'),
(9, 'N/A', '2018-04-07 17:00:51', '2018-04-07 17:00:51');

-- --------------------------------------------------------

--
-- Table structure for table `property_aprv_status`
--

CREATE TABLE `property_aprv_status` (
  `id` int(11) NOT NULL,
  `status` varchar(20) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `property_aprv_status`
--

INSERT INTO `property_aprv_status` (`id`, `status`, `created`, `modified`) VALUES
(1, 'Submitted', '2017-09-15 11:40:21', '2017-09-15 11:40:21'),
(2, 'Approved', '2017-09-15 11:40:21', '2017-09-15 11:40:21'),
(3, 'Rejected', '2017-09-15 11:40:21', '2017-09-15 11:40:21');

-- --------------------------------------------------------

--
-- Table structure for table `property_features`
--

CREATE TABLE `property_features` (
  `id` int(10) NOT NULL,
  `property_id` int(11) NOT NULL,
  `feature_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `property_features`
--

INSERT INTO `property_features` (`id`, `property_id`, `feature_id`, `created`, `modified`) VALUES
(13, 5, 5, '2017-10-03 09:32:02', '2017-10-03 09:32:02'),
(14, 5, 6, '2017-10-03 09:32:02', '2017-10-03 09:32:02'),
(15, 5, 15, '2017-10-03 09:32:03', '2017-10-03 09:32:03'),
(22, 7, 13, '2017-10-26 08:05:48', '2017-10-26 08:05:48'),
(25, 8, 13, '2018-04-07 08:24:17', '2018-04-07 08:24:17'),
(26, 8, 14, '2018-04-07 08:24:17', '2018-04-07 08:24:17'),
(27, 6, 1, '2018-04-13 07:49:46', '2018-04-13 07:49:46'),
(28, 6, 10, '2018-04-13 07:49:46', '2018-04-13 07:49:46'),
(29, 6, 15, '2018-04-13 07:49:46', '2018-04-13 07:49:46'),
(30, 9, 1, '2018-04-13 07:54:02', '2018-04-13 07:54:02'),
(31, 9, 10, '2018-04-13 07:54:02', '2018-04-13 07:54:02'),
(32, 3, 1, '2018-05-04 15:43:42', '2018-05-04 15:43:42'),
(33, 3, 7, '2018-05-04 15:43:42', '2018-05-04 15:43:42');

-- --------------------------------------------------------

--
-- Table structure for table `property_features_list`
--

CREATE TABLE `property_features_list` (
  `id` int(10) NOT NULL,
  `feature_id` varchar(20) DEFAULT NULL,
  `title` varchar(250) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `property_features_list`
--

INSERT INTO `property_features_list` (`id`, `feature_id`, `title`, `created`, `modified`) VALUES
(1, '1', 'Car Parkings', '2017-09-15 11:41:06', '2017-10-21 12:57:18'),
(2, '2', 'Bike Parking', '2017-09-15 11:41:06', '2017-09-15 11:41:06'),
(3, '3', 'Swimming Pool', '2017-09-15 11:41:06', '2017-09-15 11:41:06'),
(4, '4', 'Library', '2017-09-15 11:41:06', '2017-09-15 11:41:06'),
(5, '5', 'Club House', '2017-09-15 11:41:06', '2017-09-15 11:41:06'),
(6, '6', 'Gym', '2017-09-15 11:41:06', '2017-09-15 11:41:06'),
(7, '7', '24 Hrs Water', '2017-09-15 11:41:06', '2017-09-15 11:41:06'),
(8, '8', 'Park', '2017-09-15 11:41:06', '2017-09-15 11:41:06'),
(9, '9', 'Garden', '2017-09-15 11:41:06', '2017-09-15 11:41:06'),
(10, '10', 'Private Terrace', '2017-09-15 11:41:06', '2017-09-15 11:41:06'),
(11, '11', 'Open Terrace', '2017-09-15 11:41:06', '2017-09-15 11:41:06'),
(12, '12', '24/7 Security', '2017-09-15 11:41:06', '2017-09-15 11:41:06'),
(13, '13', 'STP', '2017-09-15 11:41:06', '2017-09-15 11:41:06'),
(14, '14', 'Play Area', '2017-09-15 11:41:06', '2017-09-15 11:41:06'),
(15, '15', 'Games Room', '2017-09-15 11:41:06', '2017-09-15 11:41:06'),
(16, '16', 'Yoga Room', '2017-09-15 11:41:06', '2017-09-15 11:41:06'),
(17, '17', 'Community Hall', '2017-09-15 11:41:06', '2017-09-15 11:41:06'),
(18, '18', 'Theatre', '2017-09-15 11:41:06', '2017-09-15 11:41:06'),
(19, '19', 'Internet', '2017-09-15 11:41:06', '2017-09-15 11:41:06'),
(20, '20', 'Elevator', '2017-09-15 11:41:06', '2017-09-15 11:41:06'),
(21, 'FEAT975621', 'power backup', '2018-06-30 07:36:13', '2018-06-30 07:36:13');

-- --------------------------------------------------------

--
-- Table structure for table `property_furn`
--

CREATE TABLE `property_furn` (
  `id` tinyint(4) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `property_furn`
--

INSERT INTO `property_furn` (`id`, `name`) VALUES
(1, 'N/A'),
(2, 'Fully Furnished'),
(3, 'Semi Furnished'),
(4, 'Unfurnished');

-- --------------------------------------------------------

--
-- Table structure for table `property_images`
--

CREATE TABLE `property_images` (
  `id` int(10) UNSIGNED NOT NULL,
  `property_id` int(11) NOT NULL,
  `image_name` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `property_listings`
--

CREATE TABLE `property_listings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `prop_id` varchar(20) DEFAULT NULL,
  `title` varchar(250) NOT NULL,
  `prop_status` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `price` float DEFAULT NULL,
  `floor_area` int(11) DEFAULT NULL,
  `rooms` int(11) NOT NULL DEFAULT '1',
  `address` varchar(250) DEFAULT NULL,
  `locality` tinyint(4) DEFAULT NULL,
  `landmark` varchar(250) DEFAULT NULL,
  `description` text,
  `build_age` int(10) NOT NULL DEFAULT '1',
  `bedrooms` int(10) NOT NULL DEFAULT '1',
  `bathrooms` int(10) NOT NULL DEFAULT '1',
  `furnished` tinyint(4) NOT NULL DEFAULT '1',
  `owner_show` char(1) DEFAULT NULL,
  `approve_status` int(11) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `property_listings`
--

INSERT INTO `property_listings` (`id`, `user_id`, `prop_id`, `title`, `prop_status`, `type_id`, `price`, `floor_area`, `rooms`, `address`, `locality`, `landmark`, `description`, `build_age`, `bedrooms`, `bathrooms`, `furnished`, `owner_show`, `approve_status`, `created`, `modified`) VALUES
(3, 7, 'PROP52293', 'This is a Test Property. This is a Property', 1, 1, 25000, 1200, 1, 'Chennai', 1, '', '2BHK Flat located at prime location of Nungambakkam,24hrs water,covered car park,wood work,posh area,well connectivity from all areas,etc..', 2, 3, 1, 3, 'N', 1, '2017-10-03 08:11:01', '2018-05-04 15:43:42'),
(5, 7, 'PROP86955', 'This is a Test Property2', 2, 2, 12543800, 1200, 3, 'Test', 2, NULL, 'This is test description.', 1, 1, 1, 2, 'N', 1, '2017-10-03 09:32:02', '2017-10-03 09:32:02'),
(6, 7, 'PROP22176', 'Test Property', 1, 1, 1200, 1200, 1, 'Chennai', 2, '', 'This is a test Description', 1, 2, 1, 1, 'N', 1, '2017-10-17 06:52:32', '2018-04-13 07:49:46'),
(7, 7, 'PROP05097', 'Test without Image', 1, 1, 12, 12, 1, 'Chennai', 3, NULL, 'Test property withoutimage', 1, 1, 1, 3, 'N', 2, '2017-10-26 08:05:47', '2017-10-27 04:22:26'),
(8, 7, 'PROP62968', 'Test Test', 1, 2, 1200000, 2324, 1, 'Test Address', 3, 'nothing', 'Test Description', 2, 3, 1, 3, 'N', 1, '2018-04-07 06:57:10', '2018-04-07 08:24:17'),
(9, 7, 'PROP27489', 'Test', 2, 8, 12334, 234235, 1, 'test', 5, '', 'Test Description', 9, 1, 1, 1, 'N', 1, '2018-04-13 06:56:14', '2018-04-13 07:54:02');

-- --------------------------------------------------------

--
-- Table structure for table `property_locality`
--

CREATE TABLE `property_locality` (
  `id` int(11) NOT NULL,
  `locality` varchar(50) CHARACTER SET utf8 NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `property_locality`
--

INSERT INTO `property_locality` (`id`, `locality`, `created`, `modified`) VALUES
(1, 'Nungambakkam', '2018-04-07 15:32:04', '2018-04-07 15:32:04'),
(2, 'Choolaimedu', '2018-04-07 15:32:04', '2018-04-07 15:32:04'),
(3, 'Nelson Manickam Road', '2018-04-07 15:32:04', '2018-04-07 15:32:04'),
(4, 'Kodambakkam', '2018-04-07 15:32:04', '2018-04-07 15:32:04'),
(5, 'Chetpet', '2018-04-07 15:32:04', '2018-04-07 15:32:04'),
(6, 'Shenoy Nagar', '2018-04-07 15:32:04', '2018-04-07 15:32:04'),
(7, 'Poes Garden', '2018-04-07 15:32:04', '2018-04-07 15:32:04'),
(8, 'Alwarpet', '2018-04-07 15:32:04', '2018-04-07 15:32:04'),
(9, 'Aminjikarai', '2018-04-07 15:32:04', '2018-04-07 15:32:04'),
(10, 'Egmore', '2018-04-07 15:32:04', '2018-04-07 15:32:04'),
(11, 'T. Nagar', '2018-04-13 07:44:34', '2018-04-13 07:45:32'),
(13, 'Mahalingapuram', '2018-06-30 07:38:00', '2018-06-30 07:38:00');

-- --------------------------------------------------------

--
-- Table structure for table `property_rooms`
--

CREATE TABLE `property_rooms` (
  `id` int(11) NOT NULL,
  `rooms` varchar(20) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `property_rooms`
--

INSERT INTO `property_rooms` (`id`, `rooms`, `created`, `modified`) VALUES
(1, 'N/A', '2017-09-15 11:42:44', '2017-09-15 11:42:44'),
(2, '1', '2017-09-15 11:42:44', '2017-09-15 11:42:44'),
(3, '2', '2017-09-15 11:42:44', '2017-09-15 11:42:44'),
(4, '3', '2017-09-15 11:42:44', '2017-09-15 11:42:44'),
(5, '4', '2017-09-15 11:42:44', '2017-09-15 11:42:44'),
(6, 'More than 4', '2017-09-15 11:42:44', '2017-09-15 11:42:44');

-- --------------------------------------------------------

--
-- Table structure for table `property_status`
--

CREATE TABLE `property_status` (
  `id` int(11) NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `property_status`
--

INSERT INTO `property_status` (`id`, `status`, `created`, `modified`) VALUES
(1, 'RENT', '2017-09-15 11:43:17', '2017-09-15 11:43:17'),
(2, 'SALE', '2017-09-15 11:43:17', '2017-09-15 11:43:17');

-- --------------------------------------------------------

--
-- Table structure for table `property_types`
--

CREATE TABLE `property_types` (
  `id` int(10) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `prop_status` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `property_types`
--

INSERT INTO `property_types` (`id`, `title`, `prop_status`, `created`, `modified`) VALUES
(1, 'Flat', 1, '2017-09-15 11:43:56', '2017-09-15 11:43:56'),
(2, 'House', 1, '2017-09-15 11:43:56', '2017-09-15 11:43:56'),
(3, 'Fully Furnished Flats', 1, '2017-09-15 11:43:56', '2017-09-15 11:43:56'),
(4, 'Serviced Apartments', 1, '2017-09-15 11:43:56', '2017-09-15 11:43:56'),
(5, 'Commercial', 1, '2017-09-15 11:43:56', '2017-09-15 11:43:56'),
(6, 'New Flat', 2, '2018-02-14 12:11:57', '2018-02-14 12:11:57'),
(7, 'Independent House', 2, '2018-02-14 12:11:57', '2018-02-14 12:11:57'),
(8, 'Vacant Land', 2, '2018-02-14 12:11:57', '2018-02-14 12:11:57'),
(9, 'Resale Flat', 2, '2018-02-14 12:11:57', '2018-02-14 12:11:57');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `full_name` varchar(250) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `status` enum('T','F') DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `vcode` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `full_name`, `email`, `phone`, `password`, `status`, `created`, `modified`, `vcode`) VALUES
(1, 2, 'qwe', 'r@r.com', '1214325345345', '0cbc6611f5540bd0809a388dc95a615b', 'F', '2017-08-27 13:56:50', '2017-10-26 06:53:00', '9567c2739aa80ab7c4c4c77a07efdf35'),
(7, 1, 'Admin user', 'admin@r.com', '123432451', '5f4dcc3b5aa765d61d8327deb882cf99', 'F', '2017-10-01 14:03:56', '2018-04-13 07:51:26', NULL),
(8, 2, 'New User', 'r1@r.com', '12345678', '0cbc6611f5540bd0809a388dc95a615b', 'F', '2017-10-03 08:08:00', '2017-10-03 08:08:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

CREATE TABLE `user_profile` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `facebook` varchar(100) DEFAULT NULL,
  `twitter` varchar(100) DEFAULT NULL,
  `google` varchar(100) DEFAULT NULL,
  `linkedin` varchar(100) DEFAULT NULL,
  `image` varchar(250) DEFAULT NULL,
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_profile`
--

INSERT INTO `user_profile` (`id`, `user_id`, `title`, `facebook`, `twitter`, `google`, `linkedin`, `image`, `created`, `modified`) VALUES
(1, 7, 'Test Tile', 'facbook.com', 'twitter.com', 'google.com', 'linked.com', 'agent-01.jpg', '2017-09-05 13:45:46', '2018-04-13 07:50:50'),
(3, 2, 'My property', '', '', '', '', 'Agent-710028.jpg', '2017-10-01 14:03:56', '2017-10-03 07:56:05'),
(4, 8, 'My property', NULL, NULL, NULL, NULL, 'Agent-824371jpg', '2017-10-03 08:08:00', '2017-10-03 08:08:00');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` tinyint(3) NOT NULL,
  `role` varchar(10) DEFAULT NULL,
  `status` enum('T','F') NOT NULL DEFAULT 'T',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `role`, `status`, `created`, `modified`) VALUES
(1, 'admin', 'T', '2017-09-15 11:44:42', '2017-09-15 11:44:42'),
(2, 'user', 'T', '2017-09-15 11:44:42', '2017-09-15 11:44:42');

-- --------------------------------------------------------

--
-- Structure for view `all_properties`
--
DROP TABLE IF EXISTS `all_properties`;

CREATE ALGORITHM=UNDEFINED DEFINER=`realestate`@`localhost` SQL SECURITY DEFINER VIEW `all_properties`  AS  select `listing`.`id` AS `id`,`user`.`full_name` AS `user_name`,`listing`.`prop_id` AS `property_id`,`listing`.`title` AS `title`,`pstatus`.`status` AS `property_status`,`ptypes`.`title` AS `property_type`,`listing`.`type_id` AS `type_id`,`listing`.`price` AS `price`,`listing`.`floor_area` AS `area`,`prooms`.`rooms` AS `rooms`,`listing`.`address` AS `address`,`listing`.`landmark` AS `landmark`,`plocality`.`locality` AS `place`,`listing`.`description` AS `description`,`buildingage`.`age_list` AS `bld_age`,`brooms`.`rooms` AS `bed_rooms`,`furn`.`name` AS `furnished`,`listing`.`modified` AS `date_modified` from ((((((((`property_listings` `listing` join `users` `user` on((`listing`.`user_id` = `user`.`id`))) join `property_status` `pstatus` on((`listing`.`prop_status` = `pstatus`.`id`))) join `property_types` `ptypes` on((`listing`.`type_id` = `ptypes`.`id`))) join `property_rooms` `prooms` on((`listing`.`rooms` = `prooms`.`id`))) join `property_locality` `plocality` on((`listing`.`locality` = `plocality`.`id`))) join `property_age` `buildingage` on((`listing`.`build_age` = `buildingage`.`id`))) join `property_rooms` `brooms` on((`listing`.`bedrooms` = `brooms`.`id`))) join `property_furn` `furn` on((`listing`.`furnished` = `furn`.`id`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `property_age`
--
ALTER TABLE `property_age`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property_aprv_status`
--
ALTER TABLE `property_aprv_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property_features`
--
ALTER TABLE `property_features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property_features_list`
--
ALTER TABLE `property_features_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property_furn`
--
ALTER TABLE `property_furn`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property_listings`
--
ALTER TABLE `property_listings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property_locality`
--
ALTER TABLE `property_locality`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property_rooms`
--
ALTER TABLE `property_rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property_status`
--
ALTER TABLE `property_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property_types`
--
ALTER TABLE `property_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `property_age`
--
ALTER TABLE `property_age`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `property_aprv_status`
--
ALTER TABLE `property_aprv_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `property_features`
--
ALTER TABLE `property_features`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `property_features_list`
--
ALTER TABLE `property_features_list`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `property_furn`
--
ALTER TABLE `property_furn`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `property_listings`
--
ALTER TABLE `property_listings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `property_locality`
--
ALTER TABLE `property_locality`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `property_rooms`
--
ALTER TABLE `property_rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `property_status`
--
ALTER TABLE `property_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `property_types`
--
ALTER TABLE `property_types`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `user_profile`
--
ALTER TABLE `user_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` tinyint(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
