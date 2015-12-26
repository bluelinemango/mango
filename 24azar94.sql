-- phpMyAdmin SQL Dump
-- version 4.4.14.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 26, 2015 at 05:51 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `new_mango`
--

-- --------------------------------------------------------

--
-- Table structure for table `advertiser`
--

CREATE TABLE IF NOT EXISTS `advertiser` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `client_id` int(10) unsigned NOT NULL,
  `domain_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `advertiser`
--

INSERT INTO `advertiser` (`id`, `name`, `description`, `status`, `client_id`, `domain_name`, `created_at`, `updated_at`) VALUES
(2, 'adv_2', 'adv_descript_2', 1, 4, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'adv_1111', 'adv_descript_1', 1, 3, 'aaaa', '0000-00-00 00:00:00', '2015-12-22 14:25:27'),
(5, 'aaaaaaa', '1111', 0, 7, '111', '2015-10-23 10:06:50', '2015-10-23 10:06:50'),
(6, 'test1', 'aaaaa', 0, 1, '', '2015-11-07 12:58:57', '2015-11-07 12:58:57'),
(7, 'wwww', '', 0, 8, 'aaaa.com', '2015-11-17 06:52:09', '2015-11-17 06:52:09'),
(8, '11223423234', '', 0, 1, '23423', '2015-11-17 09:26:12', '2015-11-17 09:26:12'),
(9, 'asdasdas', '', 0, 1, 'adadas', '2015-11-17 12:37:45', '2015-11-17 12:37:45'),
(10, 'aa', '', 0, 1, 'aaa', '2015-12-23 12:21:42', '2015-12-23 12:21:42');

-- --------------------------------------------------------

--
-- Table structure for table `bwentries`
--

CREATE TABLE IF NOT EXISTS `bwentries` (
  `id` int(10) unsigned NOT NULL,
  `domain_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `bwlist_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=150 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bwentries`
--

INSERT INTO `bwentries` (`id`, `domain_name`, `bwlist_id`, `created_at`, `updated_at`) VALUES
(2, 'ssss', 2, '2015-11-20 12:38:15', '2015-11-20 12:38:15'),
(3, 'dddd', 2, '2015-11-20 12:38:15', '2015-11-20 12:38:15'),
(4, 'ffff', 2, '2015-11-20 12:38:15', '2015-11-20 12:38:15'),
(5, 'gggg', 2, '2015-11-20 12:38:15', '2015-11-20 12:38:15'),
(11, '', 4, '2015-11-20 12:53:50', '2015-11-20 12:53:50'),
(12, '', 5, '2015-11-20 12:54:09', '2015-11-20 12:54:09'),
(13, '', 6, '2015-11-20 12:54:17', '2015-11-20 12:54:17'),
(14, '', 7, '2015-11-20 12:56:12', '2015-11-20 12:56:12'),
(22, 'cnn.com', 8, '2015-11-21 13:12:46', '2015-11-21 13:12:46'),
(23, 'bb.com', 8, '2015-11-21 13:12:46', '2015-11-21 13:12:46'),
(24, 'kk.com', 8, '2015-11-21 13:12:46', '2015-11-21 13:12:46'),
(50, 'fff.com', 17, '2015-11-28 13:13:17', '2015-11-28 13:13:17'),
(51, 'ddd.com', 17, '2015-11-28 13:13:17', '2015-11-28 13:13:17'),
(53, 'asdasdasdas', 17, '2015-11-29 10:42:09', '2015-11-29 10:42:09'),
(54, 'ddd.com', 17, '2015-11-29 10:48:38', '2015-11-29 10:48:38'),
(57, 'asdasdasd.com', 17, '2015-11-29 10:58:10', '2015-11-29 10:58:10'),
(58, 'asdas.com', 17, '2015-11-29 10:58:52', '2015-11-29 10:58:52'),
(59, 'alisss.com', 17, '2015-11-29 10:59:59', '2015-11-29 10:59:59'),
(60, 'asd.com', 17, '2015-11-29 11:03:53', '2015-11-29 11:03:53'),
(61, 'asdsadas.com', 17, '2015-11-29 11:04:46', '2015-11-29 11:04:46'),
(62, 'sssssssss.com', 17, '2015-11-29 11:09:43', '2015-11-29 11:09:43'),
(63, 'alooo.com', 17, '2015-11-29 11:15:21', '2015-11-29 11:15:21'),
(64, 'asdsdas.com', 17, '2015-11-29 11:20:11', '2015-11-29 11:20:11'),
(65, 'aajj.com', 17, '2015-11-29 11:22:14', '2015-11-29 11:22:14'),
(66, 'asd22asd.com', 17, '2015-11-29 11:23:16', '2015-11-29 11:23:16'),
(67, 'asd22asd.com', 17, '2015-11-29 11:23:40', '2015-11-29 11:23:40'),
(68, 'ssss.com', 17, '2015-11-29 11:24:22', '2015-11-29 11:24:22'),
(69, 'sadasd.com', 17, '2015-11-29 11:25:55', '2015-11-29 11:25:55'),
(70, 'aad22.com', 17, '2015-11-29 11:27:19', '2015-11-29 11:27:19'),
(71, 'aa.com', 17, '2015-11-29 11:28:11', '2015-11-29 11:28:11'),
(72, 'aaa.com', 17, '2015-11-29 11:28:45', '2015-11-29 11:28:45'),
(73, 'aaa.com', 17, '2015-11-29 11:28:55', '2015-11-29 11:28:55'),
(74, 'a.com', 17, '2015-11-29 11:30:14', '2015-11-29 11:30:14'),
(75, 'ssss.com', 17, '2015-11-29 11:31:29', '2015-11-29 11:31:29'),
(76, 'aaaa.com', 17, '2015-11-29 11:38:17', '2015-11-29 11:38:17'),
(77, '', 18, '2015-12-05 12:29:45', '2015-12-05 12:29:45'),
(78, 'asdasd.com', 17, '2015-12-06 08:04:08', '2015-12-06 08:04:08'),
(79, 'asd.com', 17, '2015-12-06 10:36:59', '2015-12-06 10:36:59'),
(80, 'asd.com', 17, '2015-12-06 10:37:17', '2015-12-06 10:37:17'),
(81, 'asd.com', 17, '2015-12-06 10:37:56', '2015-12-06 10:37:56'),
(82, 'asdasd.com', 17, '2015-12-06 10:38:51', '2015-12-06 10:38:51'),
(83, 'a123sd.com', 17, '2015-12-06 10:39:07', '2015-12-06 10:39:07'),
(84, 'asdc.com', 17, '2015-12-06 10:47:33', '2015-12-06 10:47:33'),
(85, 'asd.com', 17, '2015-12-06 10:49:11', '2015-12-06 10:49:11'),
(86, 'asd.com', 17, '2015-12-06 10:50:43', '2015-12-06 10:50:43'),
(87, 'asd.com', 17, '2015-12-06 10:51:42', '2015-12-06 10:51:42'),
(88, 'aaa.com', 17, '2015-12-06 10:52:23', '2015-12-06 10:52:23'),
(94, 'asldashdasjkd.com', 3, '2015-12-06 11:48:51', '2015-12-06 11:48:51'),
(95, 'sadasd.com', 3, '2015-12-06 11:49:41', '2015-12-06 11:49:41'),
(96, 'asdasd.com', 3, '2015-12-06 11:50:08', '2015-12-06 11:50:08'),
(97, 'sdasdasd.com', 3, '2015-12-06 11:50:46', '2015-12-06 11:50:46'),
(98, 'asdasd.com', 3, '2015-12-06 11:52:53', '2015-12-06 11:52:53'),
(149, 'asdaasdasd1231233123s.com', 17, '2015-12-15 07:21:18', '2015-12-15 07:21:37');

-- --------------------------------------------------------

--
-- Table structure for table `bwlist`
--

CREATE TABLE IF NOT EXISTS `bwlist` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `list_type` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `advertiser_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bwlist`
--

INSERT INTO `bwlist` (`id`, `name`, `list_type`, `advertiser_id`, `created_at`, `updated_at`) VALUES
(1, 'shomare 1', 'black', 4, '2015-11-20 12:37:03', '2015-11-20 12:37:03'),
(2, 'sdafasdf', 'black', 4, '2015-11-20 12:38:15', '2015-11-20 12:38:15'),
(3, 'sdafasdf', 'white', 4, '2015-11-20 12:43:21', '2015-11-20 12:43:21'),
(4, 'aaaa', 'black', 7, '2015-11-20 12:53:50', '2015-11-20 12:53:50'),
(5, 'aa', 'black', 8, '2015-11-20 12:54:09', '2015-11-20 12:54:09'),
(6, 'aa', 'black', 8, '2015-11-20 12:54:17', '2015-11-20 12:54:17'),
(7, 'aa', 'white', 8, '2015-11-20 12:56:12', '2015-11-20 12:56:12'),
(8, 'ali', 'white', 8, '2015-11-21 13:12:34', '2015-11-21 13:12:34'),
(17, 'alireza', 'black', 8, '2015-11-28 13:13:17', '2015-11-28 13:13:17'),
(18, 'alio1', 'black', 9, '2015-12-05 12:29:45', '2015-12-21 11:16:30');

-- --------------------------------------------------------

--
-- Table structure for table `campaign`
--

CREATE TABLE IF NOT EXISTS `campaign` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `advertiser_id` int(10) unsigned NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `max_impression` int(11) NOT NULL,
  `daily_max_impression` int(11) NOT NULL,
  `max_budget` int(11) NOT NULL,
  `daily_max_budget` int(11) NOT NULL,
  `cpm` int(11) NOT NULL,
  `advertiser_domain` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `start_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `end_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `advertiser_domain_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `campaign`
--

INSERT INTO `campaign` (`id`, `name`, `advertiser_id`, `description`, `status`, `max_impression`, `daily_max_impression`, `max_budget`, `daily_max_budget`, `cpm`, `advertiser_domain`, `start_date`, `end_date`, `advertiser_domain_name`, `created_at`, `updated_at`) VALUES
(3, 'fsdf111121', 4, 'asdas', 0, 13123, 2342, 34231, 4234, 234, '', '2015-11-09 14:32:32', '2015-11-25 14:32:32', '234', '2015-10-14 11:38:02', '2015-12-20 11:34:48'),
(4, 'asdasd', 4, 'asd asd a', 0, 2332, 2323, 2222, 2222, 222, '', '2015-10-22 10:07:43', '2015-10-22 10:07:43', '222', '2015-10-23 10:07:43', '2015-10-23 10:07:43'),
(5, '11111111', 6, 'asdasd', 0, 222, 222, 222, 22, 22, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'asdas', '2015-11-07 13:02:52', '2015-11-07 13:02:52'),
(6, 'aaaaaaaa', 4, '', 0, 2, 2, 2, 2, 2, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'aaaaaaa', '2015-11-17 07:42:08', '2015-11-17 07:42:08'),
(7, 'asd', 8, '', 0, 123, 123, 123, 123, 123, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '123', '2015-11-17 09:31:34', '2015-11-17 09:31:34'),
(8, 'asd', 7, '', 0, 2, 2, 2, 2, 2323, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '2015-11-17 09:35:20', '2015-11-17 09:35:20'),
(9, 'asd asd', 9, '', 0, 0, 0, 0, 0, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'as das ', '2015-11-17 12:38:53', '2015-11-17 12:38:53');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE IF NOT EXISTS `client` (
  `id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `company` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id`, `user_id`, `name`, `company`, `created_at`, `updated_at`) VALUES
(1, 1, 'pepsi', 'pepsi company', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 1, 'cocacola', 'cocacola company', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 1, 'alireza_pepsi', 'aaa', '2015-10-08 11:47:15', '2015-10-08 11:47:15'),
(4, 2, 'ali', 'ssss', '2015-10-08 11:50:08', '2015-10-08 11:50:08'),
(5, 2, 'aaaa', 'aaaaaaaa', '2015-10-10 12:29:23', '2015-10-10 12:29:23'),
(6, 3, 'aaa', '', '2015-12-20 11:03:10', '2015-12-20 11:03:10'),
(7, 4, 'asdasdasd', '', '2015-12-20 11:09:47', '2015-12-20 11:09:47'),
(8, 5, 'sadasd111', '', '2015-12-20 11:10:19', '2015-12-20 11:13:33'),
(9, 1, 'alisssss111', '', '2015-12-22 14:24:19', '2015-12-22 14:24:51'),
(10, 1, 'asldkuajsdkjbaslkdj', '', '2015-12-22 14:24:31', '2015-12-22 14:24:31');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE IF NOT EXISTS `company` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Google', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Apple', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `creative`
--

CREATE TABLE IF NOT EXISTS `creative` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `advertiser_id` int(10) unsigned NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `ad_tag` text COLLATE utf8_unicode_ci NOT NULL,
  `landing_page_url` text COLLATE utf8_unicode_ci NOT NULL,
  `preview_url` text COLLATE utf8_unicode_ci NOT NULL,
  `size` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `is_secure` tinyint(1) NOT NULL,
  `attributes` text COLLATE utf8_unicode_ci NOT NULL,
  `advertiser_domain_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `creative`
--

INSERT INTO `creative` (`id`, `name`, `advertiser_id`, `description`, `status`, `ad_tag`, `landing_page_url`, `preview_url`, `size`, `is_secure`, `attributes`, `advertiser_domain_name`, `created_at`, `updated_at`) VALUES
(2, 'aaa1', 8, '', 0, 'asd', 'ads', 'adsa', '23x232', 0, 'asd', 'aaaa', '2015-11-17 10:07:22', '2015-12-20 11:37:59'),
(3, 'asdasd1', 4, '12311', 0, '2131', '1231', '1231', '1231x231', 0, '1231', '1231', '2015-10-23 06:15:09', '2015-10-23 06:34:23'),
(4, 'as12312', 4, '31231', 0, '2131', '1231', '1231', '1231x231', 0, '1231', '1231', '2015-10-23 06:15:09', '2015-10-23 06:34:23'),
(5, 'as32423d1', 4, '12311', 0, '2131', '1231', '1231', '1231x231', 0, '1231', '1231', '2015-10-23 06:15:09', '2015-10-23 06:34:23'),
(6, 'hhhghf', 7, '12311', 0, '2131', '1231', '1231', '1231x231', 0, '1231', '1231', '2015-10-23 06:15:09', '2015-10-23 06:34:23');

-- --------------------------------------------------------

--
-- Table structure for table `geosegment`
--

CREATE TABLE IF NOT EXISTS `geosegment` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `lat` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `lon` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `segment_radius` int(11) NOT NULL,
  `geosegmentlist_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `geosegment`
--

INSERT INTO `geosegment` (`id`, `name`, `lat`, `lon`, `segment_radius`, `geosegmentlist_id`, `created_at`, `updated_at`) VALUES
(6, 'alireza', '12.233', '6.1234', 12, 5, '2015-11-24 07:48:26', '2015-11-24 07:48:26'),
(7, 'mmm', '32.656', '12.4564', 5, 5, '2015-11-24 07:48:26', '2015-11-24 07:48:26'),
(8, 'asdas', '55.66541', '32.654', 2, 5, '2015-11-24 07:48:26', '2015-11-24 07:48:26'),
(9, 'adada', '12.233', '6.1234', 12, 5, '2015-11-24 07:48:26', '2015-11-24 07:48:26'),
(10, 'fffff', '12.233', '6.1234', 12, 5, '2015-11-24 07:48:26', '2015-11-24 07:48:26'),
(11, 'alireza', '12.233', '6.1234', 12, 6, '2015-11-28 13:14:23', '2015-11-28 13:14:23'),
(12, 'mmm', '32.656', '12.4564', 5, 6, '2015-11-28 13:14:23', '2015-11-28 13:14:23'),
(13, 'asdas', '55.66541', '32.654', 2, 6, '2015-11-28 13:14:23', '2015-11-28 13:14:23'),
(14, 'adada', '12.233', '6.1234', 12, 6, '2015-11-28 13:14:23', '2015-11-28 13:14:23'),
(15, 'fffff', '12.233', '6.1234', 12, 6, '2015-11-28 13:14:23', '2015-11-28 13:14:23'),
(17, 'alasdghakj', '23', '213', 1, 11, '2015-12-05 13:53:02', '2015-12-05 13:53:02'),
(18, 'hasdgkjag', '213', '32', 12, 11, '2015-12-05 13:53:02', '2015-12-05 13:53:02'),
(19, 'adf', '123', '21', 2, 11, '2015-12-05 13:53:02', '2015-12-05 13:53:02'),
(20, '', '', '', 0, 11, '2015-12-05 13:53:02', '2015-12-05 13:53:02'),
(21, '', '', '', 0, 11, '2015-12-05 13:53:02', '2015-12-05 13:53:02'),
(22, 'alasdghakj', '23', '213', 0, 12, '2015-12-05 13:57:05', '2015-12-05 13:57:05'),
(23, 'hasdgkjag', '213', '32', 0, 12, '2015-12-05 13:57:05', '2015-12-05 13:57:05'),
(24, 'adf', '123', '21', 0, 12, '2015-12-05 13:57:05', '2015-12-05 13:57:05'),
(25, 'alioioi', '12', '131', 12, 5, '2015-12-14 14:26:37', '2015-12-14 14:29:22'),
(26, '123', '456', '789', 41, 5, '2015-12-14 14:29:34', '2015-12-14 14:29:34'),
(27, 'ali`1', '1234', '1234', 1234, 5, '2015-12-15 07:22:03', '2015-12-15 07:22:21');

-- --------------------------------------------------------

--
-- Table structure for table `geosegmentlist`
--

CREATE TABLE IF NOT EXISTS `geosegmentlist` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `advertiser_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `geosegmentlist`
--

INSERT INTO `geosegmentlist` (`id`, `name`, `advertiser_id`, `created_at`, `updated_at`) VALUES
(5, 'aa', 4, '2015-11-24 07:48:26', '2015-11-24 07:48:26'),
(6, 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 4, '2015-11-28 13:14:23', '2015-11-28 13:14:23'),
(7, 'aaaaaaaasdasdas', 4, '2015-11-28 13:14:23', '2015-11-28 13:14:23'),
(8, 'gggggggggggg', 4, '2015-11-28 13:14:23', '2015-11-28 13:14:23'),
(9, 'ali', 9, '2015-12-05 13:25:30', '2015-12-05 13:25:30'),
(11, 'asdasdasdasd', 7, '2015-12-05 13:53:02', '2015-12-05 13:53:02'),
(12, 'aa11a1', 9, '2015-12-05 13:57:05', '2015-12-21 11:42:24');

-- --------------------------------------------------------

--
-- Table structure for table `iab_category`
--

CREATE TABLE IF NOT EXISTS `iab_category` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `iab_category`
--

INSERT INTO `iab_category` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'entertainment', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'financial', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'health', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `iab_sub_category`
--

CREATE TABLE IF NOT EXISTS `iab_sub_category` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `iab_category_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `iab_sub_category`
--

INSERT INTO `iab_sub_category` (`id`, `name`, `iab_category_id`, `created_at`, `updated_at`) VALUES
(1, 'movies', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'theater', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'sport', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'banking', 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'insurance', 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'investment', 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'women health', 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'family health', 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 'insurance', 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `impression`
--

CREATE TABLE IF NOT EXISTS `impression` (
  `id` int(10) unsigned NOT NULL,
  `targetgroup_id` int(10) unsigned NOT NULL,
  `creative_id` int(10) unsigned NOT NULL,
  `campaign_id` int(10) unsigned NOT NULL,
  `advertiser_id` int(10) unsigned NOT NULL,
  `client_id` int(10) unsigned NOT NULL,
  `geosegment_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=1999 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2015_10_08_093957_user_table', 1),
('2015_10_08_094227_role_table', 1),
('2015_10_08_094328_user_role_mapping_table', 1),
('2015_10_08_100001_permission_table', 2),
('2015_10_08_122941_client_table', 3),
('2015_10_08_123501_Role_Permission_Mapping_table', 4),
('2015_10_13_132650_Advertiser_table', 5),
('2015_10_14_112638_campaign_table', 6),
('2015_10_17_101229_targetgroup_table', 7),
('2015_10_23_091256_creative_table', 8),
('2015_11_11_174323_table_model', 9),
('2015_11_19_155003_bwlist-table', 10),
('2015_11_19_155310_bwentries-table', 10),
('2015_11_19_161031_geosegmentlist-table', 10),
('2015_11_20_121427_geosegment-table', 10),
('2015_11_30_152024_creat-targetgroup-creative-map-table', 11),
('2015_11_30_160427_creat-iab-category-table', 12),
('2015_11_30_160433_creat-iab-sub-category-table', 12),
('2015_12_01_155625_create-targetgroup-geosegment-map-table', 13),
('2015_12_03_151710_targetgroup-bwlist-map-table', 14),
('2015_12_07_151734_create-company-table', 15),
('2015_12_24_085112_create_impression_table', 16);

-- --------------------------------------------------------

--
-- Table structure for table `model`
--

CREATE TABLE IF NOT EXISTS `model` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `advertiser_id` int(10) unsigned NOT NULL,
  `seed_web_sites` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `algo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `segment_name_seed` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `process_result` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `num_neg_devices_used` int(11) NOT NULL,
  `num_pos_devices_used` int(11) NOT NULL,
  `feature_recency_in_sec` int(11) NOT NULL,
  `max_num_both_neg_pos_devices` int(11) NOT NULL,
  `negative_features_requested` text COLLATE utf8_unicode_ci NOT NULL,
  `feature_avg_num_history_used` text COLLATE utf8_unicode_ci NOT NULL,
  `negative_feature_used` text COLLATE utf8_unicode_ci NOT NULL,
  `date_of_request` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `model`
--

INSERT INTO `model` (`id`, `name`, `advertiser_id`, `seed_web_sites`, `algo`, `segment_name_seed`, `process_result`, `description`, `num_neg_devices_used`, `num_pos_devices_used`, `feature_recency_in_sec`, `max_num_both_neg_pos_devices`, `negative_features_requested`, `feature_avg_num_history_used`, `negative_feature_used`, `date_of_request`, `created_at`, `updated_at`) VALUES
(1, 'aaa', 6, '"asd,dd,d"', 'heat', 'aaa', 'asdas', '1111', 1, 1, 1, 1, '"asd,fgsd,fg,df,w"', '', '"asd,ac,zc,sdf,g"', '2016-01-11 07:00:06', '2015-11-12 06:34:38', '2015-11-12 07:06:34'),
(2, 'sad11', 7, '"sad"', '', 'asdas', '234', 'asdasd', 234, 24, 34324, 234, '"asd,addd"', '', '"aaaa"', '2016-05-12 13:36:09', '2015-11-24 11:25:15', '2015-12-21 11:03:42');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE IF NOT EXISTS `permission` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `permission`
--

INSERT INTO `permission` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'ADD_EDIT_CLIENT', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'VIEW_CLIENT', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'ADD_EDIT_CAMPAIGN', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'VIEW_CAMPAIGN', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'ADD_EDIT_ADVERTISER', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 'VIEW_ADVERTISER', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 'ADD_EDIT_CREATIVE', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 'VIEW_CREATIVE', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 'ADD_EDIT_TARGETGROUP', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 'VIEW_TARGETGROUP', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 'ADD_EDIT_MODEL', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, 'VIEW_MODEL', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, 'ADD_EDIT_BWLIST', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, 'VIEW_BWLIST', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(22, 'ADD_EDIT_GEOSEGMENTLIST', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(24, 'VIEW_GEOSEGMENTLIST', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Admin', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Acount Manager', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'Account Analyst', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'kkkkk1', '', '2015-12-08 04:25:17', '2015-12-08 04:25:29');

-- --------------------------------------------------------

--
-- Table structure for table `role_permission_mapping`
--

CREATE TABLE IF NOT EXISTS `role_permission_mapping` (
  `id` int(10) unsigned NOT NULL,
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=406 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `role_permission_mapping`
--

INSERT INTO `role_permission_mapping` (`id`, `permission_id`, `role_id`, `created_at`, `updated_at`) VALUES
(15, 7, 3, '2015-12-07 13:09:51', '2015-12-07 13:09:51'),
(16, 16, 3, '2015-12-07 13:09:51', '2015-12-07 13:09:51'),
(311, 1, 2, '2015-12-23 12:30:21', '2015-12-23 12:30:21'),
(312, 3, 2, '2015-12-23 12:30:21', '2015-12-23 12:30:21'),
(313, 4, 2, '2015-12-23 12:30:21', '2015-12-23 12:30:21'),
(314, 6, 2, '2015-12-23 12:30:21', '2015-12-23 12:30:21'),
(315, 9, 2, '2015-12-23 12:30:21', '2015-12-23 12:30:21'),
(316, 10, 2, '2015-12-23 12:30:21', '2015-12-23 12:30:21'),
(317, 12, 2, '2015-12-23 12:30:21', '2015-12-23 12:30:21'),
(318, 13, 2, '2015-12-23 12:30:21', '2015-12-23 12:30:21'),
(319, 15, 2, '2015-12-23 12:30:21', '2015-12-23 12:30:21'),
(320, 16, 2, '2015-12-23 12:30:21', '2015-12-23 12:30:21'),
(321, 18, 2, '2015-12-23 12:30:21', '2015-12-23 12:30:21'),
(322, 19, 2, '2015-12-23 12:30:21', '2015-12-23 12:30:21'),
(323, 21, 2, '2015-12-23 12:30:21', '2015-12-23 12:30:21'),
(324, 22, 2, '2015-12-23 12:30:21', '2015-12-23 12:30:21'),
(325, 24, 2, '2015-12-23 12:30:21', '2015-12-23 12:30:21'),
(395, 1, 1, '2015-12-23 12:56:41', '2015-12-23 12:56:41'),
(396, 3, 1, '2015-12-23 12:56:41', '2015-12-23 12:56:41'),
(397, 4, 1, '2015-12-23 12:56:41', '2015-12-23 12:56:41'),
(398, 6, 1, '2015-12-23 12:56:41', '2015-12-23 12:56:41'),
(399, 7, 1, '2015-12-23 12:56:41', '2015-12-23 12:56:41'),
(400, 9, 1, '2015-12-23 12:56:41', '2015-12-23 12:56:41'),
(401, 12, 1, '2015-12-23 12:56:41', '2015-12-23 12:56:41'),
(402, 15, 1, '2015-12-23 12:56:41', '2015-12-23 12:56:41'),
(403, 18, 1, '2015-12-23 12:56:41', '2015-12-23 12:56:41'),
(404, 21, 1, '2015-12-23 12:56:41', '2015-12-23 12:56:41'),
(405, 24, 1, '2015-12-23 12:56:41', '2015-12-23 12:56:41');

-- --------------------------------------------------------

--
-- Table structure for table `targetgroup`
--

CREATE TABLE IF NOT EXISTS `targetgroup` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `campaign_id` int(10) unsigned NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `iab_category` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `iab_sub_category` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `max_impression` int(11) NOT NULL,
  `daily_max_impression` int(11) NOT NULL,
  `max_budget` int(11) NOT NULL,
  `daily_max_budget` int(11) NOT NULL,
  `pacing_plan` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cpm` int(11) NOT NULL,
  `frequency_in_sec` int(11) NOT NULL,
  `start_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `end_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `advertiser_domain_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `targetgroup`
--

INSERT INTO `targetgroup` (`id`, `name`, `campaign_id`, `description`, `status`, `iab_category`, `iab_sub_category`, `max_impression`, `daily_max_impression`, `max_budget`, `daily_max_budget`, `pacing_plan`, `cpm`, `frequency_in_sec`, `start_date`, `end_date`, `advertiser_domain_name`, `created_at`, `updated_at`) VALUES
(1, 'dfsasd222', 3, 'df fsdfs d1', 0, 'asd1', 'asd1', 32141, 2342341, 2341, 2341, '2341', 2341, 2341, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '234231', '2015-10-22 05:17:18', '2015-10-22 05:42:47'),
(2, 'sadasd', 3, '4ghh', 0, '234', '234', 234234, 234, 2341234, 234234, '234234', 456, 45646, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '456456', '2015-10-23 09:56:19', '2015-10-23 09:56:19'),
(3, 'asdasd', 3, 'fhfgh', 0, '5646', '456456', 45645, 645, 6456, 46, '464', 4564, 5646, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '46', '2015-10-23 09:59:06', '2015-10-23 09:59:06'),
(4, 'asdasd1', 3, 'ggggfjfjf g gh jfg ', 0, '324', '567', 65, 87, 856756, 7567, '567', 567, 567, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '567', '2015-10-23 10:00:05', '2015-10-23 10:00:05'),
(5, 'ali', 3, '', 0, '1', NULL, 1, 2, 3, 4, '7', 6, 5, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'ddd', '2015-11-30 14:13:26', '2015-11-30 14:13:26'),
(6, 'aaa', 3, '', 0, '2', '6', 3, 234, 234, 0, '', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'sss', '2015-12-01 12:32:10', '2015-12-01 12:32:10'),
(7, 'aaaaa', 3, '', 0, '1', NULL, 0, 0, 0, 0, '', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '2015-12-01 12:36:49', '2015-12-01 12:36:49'),
(8, 'dsa', 3, '', 0, '1', NULL, 0, 0, 0, 0, '', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '2015-12-01 12:37:14', '2015-12-01 12:37:14'),
(9, 'sadas', 3, '', 0, '1', NULL, 0, 0, 0, 0, '', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '2015-12-01 12:37:34', '2015-12-01 12:37:34'),
(10, 'asdads', 3, '', 0, '1', NULL, 0, 0, 0, 0, '', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '2015-12-01 12:42:18', '2015-12-01 12:42:18'),
(11, 'ali', 3, '', 0, '2', '6', 0, 0, 0, 0, '', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'aaa', '2015-12-01 13:36:24', '2015-12-01 13:36:24'),
(12, 'aaa1', 3, '', 0, '1', '2', 12, 12, 123, 34, '5', 45, 56, '2015-05-12 14:37:06', '2016-11-12 15:37:06', 'aaaaa', '2015-12-03 11:27:16', '2015-12-22 09:45:47'),
(13, 'asdasd', 8, '', 0, '1', NULL, 0, 0, 0, 0, '', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '2015-12-03 11:50:47', '2015-12-03 11:50:47');

-- --------------------------------------------------------

--
-- Table structure for table `targetgroup_bwlist_map`
--

CREATE TABLE IF NOT EXISTS `targetgroup_bwlist_map` (
  `id` int(10) unsigned NOT NULL,
  `targetgroup_id` int(10) unsigned NOT NULL,
  `bwlist_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `targetgroup_bwlist_map`
--

INSERT INTO `targetgroup_bwlist_map` (`id`, `targetgroup_id`, `bwlist_id`, `created_at`, `updated_at`) VALUES
(4, 12, 1, '2015-12-05 15:37:06', '2015-12-05 15:37:06');

-- --------------------------------------------------------

--
-- Table structure for table `targetgroup_creative_map`
--

CREATE TABLE IF NOT EXISTS `targetgroup_creative_map` (
  `id` int(10) unsigned NOT NULL,
  `targetgroup_id` int(10) unsigned NOT NULL,
  `creative_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `targetgroup_creative_map`
--

INSERT INTO `targetgroup_creative_map` (`id`, `targetgroup_id`, `creative_id`, `created_at`, `updated_at`) VALUES
(4, 13, 3, '2015-12-03 11:50:47', '2015-12-03 11:50:47'),
(5, 13, 4, '2015-12-03 11:50:47', '2015-12-03 11:50:47'),
(12, 12, 3, '2015-12-05 15:37:06', '2015-12-05 15:37:06'),
(13, 12, 4, '2015-12-05 15:37:06', '2015-12-05 15:37:06'),
(14, 12, 5, '2015-12-05 15:37:06', '2015-12-05 15:37:06');

-- --------------------------------------------------------

--
-- Table structure for table `targetgroup_geosegmentlist_map`
--

CREATE TABLE IF NOT EXISTS `targetgroup_geosegmentlist_map` (
  `id` int(10) unsigned NOT NULL,
  `targetgroup_id` int(10) unsigned NOT NULL,
  `geosegmentlist_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `targetgroup_geosegmentlist_map`
--

INSERT INTO `targetgroup_geosegmentlist_map` (`id`, `targetgroup_id`, `geosegmentlist_id`, `created_at`, `updated_at`) VALUES
(1, 6, 5, '2015-12-01 12:32:10', '2015-12-01 12:32:10'),
(2, 6, 5, '2015-12-01 12:32:10', '2015-12-01 12:32:10'),
(3, 6, 6, '2015-12-01 12:32:10', '2015-12-01 12:32:10'),
(4, 7, 5, '2015-12-01 12:36:49', '2015-12-01 12:36:49'),
(5, 7, 6, '2015-12-01 12:36:49', '2015-12-01 12:36:49'),
(6, 8, 5, '2015-12-01 12:37:14', '2015-12-01 12:37:14'),
(7, 8, 6, '2015-12-01 12:37:14', '2015-12-01 12:37:14'),
(8, 9, 6, '2015-12-01 12:37:35', '2015-12-01 12:37:35'),
(9, 9, 6, '2015-12-01 12:37:35', '2015-12-01 12:37:35'),
(10, 10, 6, '2015-12-01 12:42:18', '2015-12-01 12:42:18'),
(11, 11, 6, '2015-12-01 13:36:24', '2015-12-01 13:36:24'),
(14, 13, 5, '2015-12-03 11:50:47', '2015-12-03 11:50:47'),
(15, 13, 6, '2015-12-03 11:50:47', '2015-12-03 11:50:47'),
(16, 13, 7, '2015-12-03 11:50:47', '2015-12-03 11:50:47'),
(21, 12, 7, '2015-12-05 15:37:06', '2015-12-05 15:37:06'),
(22, 12, 8, '2015-12-05 15:37:06', '2015-12-05 15:37:06');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `company_id` int(10) unsigned NOT NULL,
  `company` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `active` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_login_time` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `company_id`, `company`, `name`, `email`, `password`, `active`, `remember_token`, `last_login_time`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'aaa11', 'alireza', '09364991494@yahoo.com', '$2y$10$q0O2WoGF6tKnk7s638v/wue4N4iSKeZ21JwH7JY0XGyj06MDyfF2K', 1, 'EVQ26ZwOqzt3iuyjKH5jjRLZxD848RErejJk4BBskR8RHi0kp8qo1ZUJD8iB', '2015-12-21 23:09:50', '0000-00-00 00:00:00', '2015-12-22 11:09:50'),
(2, 2, 2, '', 'alireza11111', 'a@b.com', '$2y$10$q0O2WoGF6tKnk7s638v/wue4N4iSKeZ21JwH7JY0XGyj06MDyfF2K', 0, 'wbEqCaXMvVOVvc2rbjhBh5aeEdqW05qjv85rHERzLV7MuomjOC6jx0VN4Blf', NULL, '0000-00-00 00:00:00', '2015-12-08 04:34:02'),
(3, 2, 1, '', 'asdasd1', '09364sad4@yahoo.com', '$2y$10$Y4lkrHpSphWo6Qgk52xLlOS0lemOrUHjvkfOWY1pLiYrtu.bwNev.', 0, 'czxQnGYoWOHuVBZBxDuqnGGQmdnae8PLzjlaVCzL08GrYY4eqM7zRW1XUXjd', '2015-12-16 00:16:22', '2015-12-06 08:35:25', '2015-12-16 13:33:26'),
(4, 4, 1, '', 'asdasdas222', '123213494@yahoo.com', '$2y$10$q0O2WoGF6tKnk7s638v/wue4N4iSKeZ21JwH7JY0XGyj06MDyfF2K', 1, '1NGp5eILuC7ZyxXAn5ZyVTvAX8HKoYftF5HQfvDywy8o0vg1nPpGrXWnVm7n', '0000-00-00 00:00:00', '2015-12-06 08:38:53', '2015-12-08 05:53:18'),
(5, 3, 1, '', 'asdas', 'asdasdafdsff494@yahoo.com', '$2y$10$Z.GwzLNeDhDF5SFwThGp9Oiey/jA3ea1GLjjVIhZvWtqGlBzDo9Ae', 1, NULL, '0000-00-00 00:00:00', '2015-12-06 10:18:58', '2015-12-07 11:57:27'),
(6, 4, 1, '', 'asda111', 'asdasd94@yahoo.com', '$2y$10$cUHps4amDnsH2j8A7uvOZeOH5n9xrsiCaJ7PTyENe4zWZK.B0SsrS', 1, NULL, '0000-00-00 00:00:00', '2015-12-15 13:35:09', '2015-12-15 13:40:52');

-- --------------------------------------------------------

--
-- Table structure for table `user_role_mapping`
--

CREATE TABLE IF NOT EXISTS `user_role_mapping` (
  `id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `advertiser`
--
ALTER TABLE `advertiser`
  ADD PRIMARY KEY (`id`),
  ADD KEY `advertiser_client_id_foreign` (`client_id`);

--
-- Indexes for table `bwentries`
--
ALTER TABLE `bwentries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bwentries_bwlist_id_foreign` (`bwlist_id`);

--
-- Indexes for table `bwlist`
--
ALTER TABLE `bwlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bwlist_advertiser_id_foreign` (`advertiser_id`);

--
-- Indexes for table `campaign`
--
ALTER TABLE `campaign`
  ADD PRIMARY KEY (`id`),
  ADD KEY `campaign_advertiser_id_foreign` (`advertiser_id`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_user_id_foreign` (`id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `creative`
--
ALTER TABLE `creative`
  ADD PRIMARY KEY (`id`),
  ADD KEY `creative_advertiser_id_foreign` (`advertiser_id`);

--
-- Indexes for table `geosegment`
--
ALTER TABLE `geosegment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `geosegment_geosegmentlist_id_foreign` (`geosegmentlist_id`);

--
-- Indexes for table `geosegmentlist`
--
ALTER TABLE `geosegmentlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `geosegmentlist_advertiser_id_foreign` (`advertiser_id`);

--
-- Indexes for table `iab_category`
--
ALTER TABLE `iab_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `iab_sub_category`
--
ALTER TABLE `iab_sub_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `iab_sub_category_iab_category_id_foreign` (`iab_category_id`);

--
-- Indexes for table `impression`
--
ALTER TABLE `impression`
  ADD PRIMARY KEY (`id`),
  ADD KEY `impression_targetgroup_id_foreign` (`targetgroup_id`),
  ADD KEY `impression_creative_id_foreign` (`creative_id`),
  ADD KEY `impression_campaign_id_foreign` (`campaign_id`),
  ADD KEY `impression_advertiser_id_foreign` (`advertiser_id`),
  ADD KEY `impression_client_id_foreign` (`client_id`),
  ADD KEY `impression_geosegment_id_foreign` (`geosegment_id`);

--
-- Indexes for table `model`
--
ALTER TABLE `model`
  ADD PRIMARY KEY (`id`),
  ADD KEY `model_advertiser_id_foreign` (`advertiser_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_permission_mapping`
--
ALTER TABLE `role_permission_mapping`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_permission_mapping_permission_id_foreign` (`permission_id`),
  ADD KEY `role_permission_mapping_role_id_foreign` (`role_id`);

--
-- Indexes for table `targetgroup`
--
ALTER TABLE `targetgroup`
  ADD PRIMARY KEY (`id`),
  ADD KEY `targetgroup_campaign_id_foreign` (`campaign_id`);

--
-- Indexes for table `targetgroup_bwlist_map`
--
ALTER TABLE `targetgroup_bwlist_map`
  ADD PRIMARY KEY (`id`),
  ADD KEY `targetgroup_bwlist_map_targetgroup_id_foreign` (`targetgroup_id`),
  ADD KEY `targetgroup_bwlist_map_bwlist_id_foreign` (`bwlist_id`);

--
-- Indexes for table `targetgroup_creative_map`
--
ALTER TABLE `targetgroup_creative_map`
  ADD PRIMARY KEY (`id`),
  ADD KEY `targetgroup_creative_map_targetgroup_id_foreign` (`targetgroup_id`),
  ADD KEY `targetgroup_creative_map_creative_id_foreign` (`creative_id`);

--
-- Indexes for table `targetgroup_geosegmentlist_map`
--
ALTER TABLE `targetgroup_geosegmentlist_map`
  ADD PRIMARY KEY (`id`),
  ADD KEY `targetgroup_geosegmentlist_map_targetgroup_id_foreign` (`targetgroup_id`),
  ADD KEY `targetgroup_geosegmentlist_map_geosegmentlist_id_foreign` (`geosegmentlist_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id` (`id`),
  ADD KEY `user_company_id` (`id`);

--
-- Indexes for table `user_role_mapping`
--
ALTER TABLE `user_role_mapping`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_role_mapping_user_id_foreign` (`user_id`),
  ADD KEY `user_role_mapping_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `advertiser`
--
ALTER TABLE `advertiser`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `bwentries`
--
ALTER TABLE `bwentries`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=150;
--
-- AUTO_INCREMENT for table `bwlist`
--
ALTER TABLE `bwlist`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `campaign`
--
ALTER TABLE `campaign`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `creative`
--
ALTER TABLE `creative`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `geosegment`
--
ALTER TABLE `geosegment`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `geosegmentlist`
--
ALTER TABLE `geosegmentlist`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `iab_category`
--
ALTER TABLE `iab_category`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `iab_sub_category`
--
ALTER TABLE `iab_sub_category`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `impression`
--
ALTER TABLE `impression`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1999;
--
-- AUTO_INCREMENT for table `model`
--
ALTER TABLE `model`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `permission`
--
ALTER TABLE `permission`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `role_permission_mapping`
--
ALTER TABLE `role_permission_mapping`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=406;
--
-- AUTO_INCREMENT for table `targetgroup`
--
ALTER TABLE `targetgroup`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `targetgroup_bwlist_map`
--
ALTER TABLE `targetgroup_bwlist_map`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `targetgroup_creative_map`
--
ALTER TABLE `targetgroup_creative_map`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `targetgroup_geosegmentlist_map`
--
ALTER TABLE `targetgroup_geosegmentlist_map`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `user_role_mapping`
--
ALTER TABLE `user_role_mapping`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `advertiser`
--
ALTER TABLE `advertiser`
  ADD CONSTRAINT `advertiser_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bwentries`
--
ALTER TABLE `bwentries`
  ADD CONSTRAINT `bwentries_bwlist_id_foreign` FOREIGN KEY (`bwlist_id`) REFERENCES `bwlist` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bwlist`
--
ALTER TABLE `bwlist`
  ADD CONSTRAINT `bwlist_advertiser_id_foreign` FOREIGN KEY (`advertiser_id`) REFERENCES `advertiser` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `campaign`
--
ALTER TABLE `campaign`
  ADD CONSTRAINT `campaign_advertiser_id_foreign` FOREIGN KEY (`advertiser_id`) REFERENCES `advertiser` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `creative`
--
ALTER TABLE `creative`
  ADD CONSTRAINT `creative_advertiser_id_foreign` FOREIGN KEY (`advertiser_id`) REFERENCES `advertiser` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `geosegment`
--
ALTER TABLE `geosegment`
  ADD CONSTRAINT `geosegment_geosegmentlist_id_foreign` FOREIGN KEY (`geosegmentlist_id`) REFERENCES `geosegmentlist` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `geosegmentlist`
--
ALTER TABLE `geosegmentlist`
  ADD CONSTRAINT `geosegmentlist_advertiser_id_foreign` FOREIGN KEY (`advertiser_id`) REFERENCES `advertiser` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `iab_sub_category`
--
ALTER TABLE `iab_sub_category`
  ADD CONSTRAINT `iab_sub_category_iab_category_id_foreign` FOREIGN KEY (`iab_category_id`) REFERENCES `iab_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `impression`
--
ALTER TABLE `impression`
  ADD CONSTRAINT `impression_advertiser_id_foreign` FOREIGN KEY (`advertiser_id`) REFERENCES `advertiser` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `impression_campaign_id_foreign` FOREIGN KEY (`campaign_id`) REFERENCES `campaign` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `impression_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `impression_creative_id_foreign` FOREIGN KEY (`creative_id`) REFERENCES `creative` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `impression_geosegment_id_foreign` FOREIGN KEY (`geosegment_id`) REFERENCES `geosegment` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `impression_targetgroup_id_foreign` FOREIGN KEY (`targetgroup_id`) REFERENCES `targetgroup` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `model`
--
ALTER TABLE `model`
  ADD CONSTRAINT `model_advertiser_id_foreign` FOREIGN KEY (`advertiser_id`) REFERENCES `advertiser` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_permission_mapping`
--
ALTER TABLE `role_permission_mapping`
  ADD CONSTRAINT `role_permission_mapping_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permission` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `role_permission_mapping_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `targetgroup`
--
ALTER TABLE `targetgroup`
  ADD CONSTRAINT `targetgroup_campaign_id_foreign` FOREIGN KEY (`campaign_id`) REFERENCES `campaign` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `targetgroup_bwlist_map`
--
ALTER TABLE `targetgroup_bwlist_map`
  ADD CONSTRAINT `targetgroup_bwlist_map_bwlist_id_foreign` FOREIGN KEY (`bwlist_id`) REFERENCES `bwlist` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `targetgroup_bwlist_map_targetgroup_id_foreign` FOREIGN KEY (`targetgroup_id`) REFERENCES `targetgroup` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `targetgroup_creative_map`
--
ALTER TABLE `targetgroup_creative_map`
  ADD CONSTRAINT `targetgroup_creative_map_creative_id_foreign` FOREIGN KEY (`creative_id`) REFERENCES `creative` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `targetgroup_creative_map_targetgroup_id_foreign` FOREIGN KEY (`targetgroup_id`) REFERENCES `targetgroup` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `targetgroup_geosegmentlist_map`
--
ALTER TABLE `targetgroup_geosegmentlist_map`
  ADD CONSTRAINT `targetgroup_geosegmentlist_map_geosegmentlist_id_foreign` FOREIGN KEY (`geosegmentlist_id`) REFERENCES `geosegmentlist` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `targetgroup_geosegmentlist_map_targetgroup_id_foreign` FOREIGN KEY (`targetgroup_id`) REFERENCES `targetgroup` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_role_mapping`
--
ALTER TABLE `user_role_mapping`
  ADD CONSTRAINT `user_role_mapping_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_role_mapping_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
