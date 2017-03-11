-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 11, 2017 at 12:21 PM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `credential`
--

-- --------------------------------------------------------

--
-- Table structure for table `assign`
--

CREATE TABLE IF NOT EXISTS `assign` (
  `id` int(11) NOT NULL,
  `domain_id` int(11) NOT NULL,
  `domain_info_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `assign`
--

INSERT INTO `assign` (`id`, `domain_id`, `domain_info_id`, `user_id`, `status`) VALUES
(1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `domain`
--

CREATE TABLE IF NOT EXISTS `domain` (
  `id` int(11) NOT NULL,
  `domain_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `package` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `package_summery` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `owner` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `contact_person` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `contact_email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `domain`
--

INSERT INTO `domain` (`id`, `domain_name`, `package`, `package_summery`, `start_date`, `end_date`, `owner`, `contact_person`, `phone`, `contact_email`, `status`) VALUES
(1, 'www.hostbrine.com', '100  GB', 'aaaaaaaaaaaaa', '2016-12-02', '2016-12-13', 'aaa', '01733333', '01733333', 'mdsami.diu@gmail.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `domain_info`
--

CREATE TABLE IF NOT EXISTS `domain_info` (
  `id` int(11) NOT NULL,
  `domain_id` int(11) NOT NULL,
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `detail` text COLLATE utf8_unicode_ci NOT NULL,
  `status` int(1) NOT NULL,
  `last_update` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `domain_info`
--

INSERT INTO `domain_info` (`id`, `domain_id`, `title`, `detail`, `status`, `last_update`) VALUES
(1, 1, 'ASHHHHHHHHHHHHHHHHH', 'otemobGQzKnZwMeYps6oyYzO0MfZsrG8zLyotMeQYZXXplxCMjE=', 1, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE IF NOT EXISTS `logs` (
  `id` int(11) NOT NULL,
  `domain_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` varchar(15) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `domain_id`, `user_id`, `date_time`, `status`) VALUES
(12, 9, 1, '2016-05-17 10:45:09', 'Update'),
(13, 3, 17, '2016-05-17 11:37:29', 'Update'),
(14, 4, 17, '2016-05-17 11:45:07', 'Update'),
(15, 6, 17, '2016-05-17 11:47:56', 'Update'),
(16, 7, 17, '2016-05-17 11:54:39', 'Update'),
(17, 6, 34, '2016-05-20 04:37:36', ''),
(18, 9, 34, '2016-05-20 08:20:37', ''),
(19, 9, 17, '2016-05-24 09:39:13', '');

-- --------------------------------------------------------

--
-- Table structure for table `newsletters`
--

CREATE TABLE IF NOT EXISTS `newsletters` (
  `id` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `summary` varchar(256) NOT NULL,
  `contant` text NOT NULL,
  `image` varchar(256) NOT NULL,
  `creation_date` date NOT NULL,
  `sent` date NOT NULL,
  `status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `newsletter_setting`
--

CREATE TABLE IF NOT EXISTS `newsletter_setting` (
  `id` int(11) NOT NULL,
  `smtp_host` varchar(200) NOT NULL,
  `smtp_port` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `newsletter_setting`
--

INSERT INTO `newsletter_setting` (`id`, `smtp_host`, `smtp_port`, `email`, `password`) VALUES
(5, 'mail.isltdbd.com', 25, 'info@isltdbd.com', 'X3{0WnscV(On');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(1) NOT NULL,
  `site_title` varchar(256) NOT NULL,
  `logo` varchar(256) NOT NULL,
  `slogan` varchar(256) NOT NULL,
  `site_offline` int(1) NOT NULL,
  `offline_text` varchar(256) NOT NULL,
  `meta_description` varchar(256) NOT NULL,
  `meta_keyword` varchar(256) NOT NULL,
  `address` varchar(256) NOT NULL,
  `phone_fax` text NOT NULL,
  `email` text NOT NULL,
  `copy_right` varchar(256) NOT NULL,
  `facebook` text NOT NULL,
  `twitter` text NOT NULL,
  `google_plus` text NOT NULL,
  `google_play` text NOT NULL,
  `apple_itunes` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `site_title`, `logo`, `slogan`, `site_offline`, `offline_text`, `meta_description`, `meta_keyword`, `address`, `phone_fax`, `email`, `copy_right`, `facebook`, `twitter`, `google_plus`, `google_play`, `apple_itunes`) VALUES
(4, 'CIMS', 'http://localhost/credential/uploads/settings/default.png', 'CIMS', 1, '', '', '', 'Hos:5 R:silver sreet', '7777', 'info@comapny.com', 'Copyright © - All Rights Reserved', '#', '#', '#', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE IF NOT EXISTS `subscribers` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subscription_date` date NOT NULL,
  `unsubscribe_date` date NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact_no` varchar(100) NOT NULL,
  `address` varchar(256) NOT NULL,
  `orginal_picture` varchar(256) NOT NULL,
  `thumb_picture` varchar(256) NOT NULL,
  `remark` varchar(256) NOT NULL,
  `user_type` varchar(20) NOT NULL,
  `status` int(1) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `username`, `password`, `email`, `contact_no`, `address`, `orginal_picture`, `thumb_picture`, `remark`, `user_type`, `status`, `date`) VALUES
(1, 'super admin', 'admin', '3c93f0c1c70d5835f1f89f9d70ef18a43d2cade485fb1adc17c68c879c1ab622a5849cb4606e205cb6e472bd262591a9633ba32c2934cbe3a7be2e77ea2fc221', 'mdsami.diu@gmail.com', '01738340448', '386 uttarkhan dhaka', '', 'http://localhost/nissebeach/uploads/users/thumbs/default.png', 'test user', 'Master', 1, '2016-03-31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assign`
--
ALTER TABLE `assign`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `domain`
--
ALTER TABLE `domain`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `domain_info`
--
ALTER TABLE `domain_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newsletters`
--
ALTER TABLE `newsletters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newsletter_setting`
--
ALTER TABLE `newsletter_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assign`
--
ALTER TABLE `assign`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `domain`
--
ALTER TABLE `domain`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `domain_info`
--
ALTER TABLE `domain_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `newsletters`
--
ALTER TABLE `newsletters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `newsletter_setting`
--
ALTER TABLE `newsletter_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
