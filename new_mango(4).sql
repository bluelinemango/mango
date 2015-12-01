-- phpMyAdmin SQL Dump
-- version 4.4.14.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2015 at 05:59 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELATIONS FOR TABLE `advertiser`:
--   `client_id`
--       `client` -> `id`
--

--
-- Dumping data for table `advertiser`
--

INSERT INTO `advertiser` (`id`, `name`, `description`, `status`, `client_id`, `domain_name`, `created_at`, `updated_at`) VALUES
(2, 'adv_2', 'adv_descript_2', 1, 4, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'adv_1', 'adv_descript_1', 1, 3, 'aaaa', '0000-00-00 00:00:00', '2015-11-17 07:26:19'),
(5, 'aaaaaaa', '1111', 0, 1, '111', '2015-10-23 10:06:50', '2015-10-23 10:06:50'),
(6, 'test1', 'aaaaa', 0, 1, '', '2015-11-07 12:58:57', '2015-11-07 12:58:57'),
(7, 'wwww', '', 0, 1, 'aaaa.com', '2015-11-17 06:52:09', '2015-11-17 06:52:09'),
(8, '11223423234', '', 0, 1, '23423', '2015-11-17 09:26:12', '2015-11-17 09:26:12'),
(9, 'asdasdas', '', 0, 1, 'adadas', '2015-11-17 12:37:45', '2015-11-17 12:37:45');

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
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELATIONS FOR TABLE `bwentries`:
--   `bwlist_id`
--       `bwlist` -> `id`
--

--
-- Dumping data for table `bwentries`
--

INSERT INTO `bwentries` (`id`, `domain_name`, `bwlist_id`, `created_at`, `updated_at`) VALUES
(1, 'cnn.com', 17, '2015-11-28 13:13:17', '2015-11-28 13:13:17'),
(2, 'ssss', 2, '2015-11-20 12:38:15', '2015-11-20 12:38:15'),
(3, 'dddd', 2, '2015-11-20 12:38:15', '2015-11-20 12:38:15'),
(4, 'ffff', 2, '2015-11-20 12:38:15', '2015-11-20 12:38:15'),
(5, 'gggg', 2, '2015-11-20 12:38:15', '2015-11-20 12:38:15'),
(11, '', 4, '2015-11-20 12:53:50', '2015-11-20 12:53:50'),
(12, '', 5, '2015-11-20 12:54:09', '2015-11-20 12:54:09'),
(13, '', 6, '2015-11-20 12:54:17', '2015-11-20 12:54:17'),
(14, '', 7, '2015-11-20 12:56:12', '2015-11-20 12:56:12'),
(15, 'aaa', 3, '2015-11-20 13:23:39', '2015-11-20 13:23:39'),
(16, 'ssss', 3, '2015-11-20 13:23:39', '2015-11-20 13:23:39'),
(17, 'dddd', 3, '2015-11-20 13:23:39', '2015-11-20 13:23:39'),
(22, 'cnn.com', 8, '2015-11-21 13:12:46', '2015-11-21 13:12:46'),
(23, 'bb.com', 8, '2015-11-21 13:12:46', '2015-11-21 13:12:46'),
(24, 'kk.com', 8, '2015-11-21 13:12:46', '2015-11-21 13:12:46'),
(50, 'fff.com', 17, '2015-11-28 13:13:17', '2015-11-28 13:13:17'),
(51, 'ddd.com', 17, '2015-11-28 13:13:17', '2015-11-28 13:13:17'),
(53, 'asdasdasdas', 17, '2015-11-29 10:42:09', '2015-11-29 10:42:09'),
(54, 'ddd.com', 17, '2015-11-29 10:48:38', '2015-11-29 10:48:38'),
(55, 'asdasdas.com', 17, '2015-11-29 10:54:47', '2015-11-29 10:54:47'),
(56, 'asd.com', 17, '2015-11-29 10:55:26', '2015-11-29 10:55:26'),
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
(76, 'aaaa.com', 17, '2015-11-29 11:38:17', '2015-11-29 11:38:17');

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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELATIONS FOR TABLE `bwlist`:
--   `advertiser_id`
--       `advertiser` -> `id`
--

--
-- Dumping data for table `bwlist`
--

INSERT INTO `bwlist` (`id`, `name`, `list_type`, `advertiser_id`, `created_at`, `updated_at`) VALUES
(1, 'shomare 1', 'black', 4, '2015-11-20 12:37:03', '2015-11-20 12:37:03'),
(2, 'sdafasdf', 'black', 4, '2015-11-20 12:38:15', '2015-11-20 12:38:15'),
(3, 'sdafasdf', 'white', 4, '2015-11-20 12:43:21', '2015-11-20 12:43:21'),
(4, 'aaaa', 'black', 8, '2015-11-20 12:53:50', '2015-11-20 12:53:50'),
(5, 'aa', 'black', 8, '2015-11-20 12:54:09', '2015-11-20 12:54:09'),
(6, 'aa', 'black', 8, '2015-11-20 12:54:17', '2015-11-20 12:54:17'),
(7, 'aa', 'white', 8, '2015-11-20 12:56:12', '2015-11-20 12:56:12'),
(8, 'ali', 'white', 8, '2015-11-21 13:12:34', '2015-11-21 13:12:34'),
(17, 'alireza', 'black', 8, '2015-11-28 13:13:17', '2015-11-28 13:13:17');

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
-- RELATIONS FOR TABLE `campaign`:
--   `advertiser_id`
--       `advertiser` -> `id`
--

--
-- Dumping data for table `campaign`
--

INSERT INTO `campaign` (`id`, `name`, `advertiser_id`, `description`, `status`, `max_impression`, `daily_max_impression`, `max_budget`, `daily_max_budget`, `cpm`, `advertiser_domain`, `start_date`, `end_date`, `advertiser_domain_name`, `created_at`, `updated_at`) VALUES
(3, 'fsdf11112', 4, 'asdas', 0, 234, 2342, 3423, 4234, 234, '', '2015-11-09 14:32:32', '2015-11-25 14:32:32', '234', '2015-10-14 11:38:02', '2015-11-05 14:32:32'),
(4, 'asdasd', 4, 'asd asd a', 0, 2332, 2323, 2222, 2222, 222, '', '2015-10-22 10:07:43', '2015-10-22 10:07:43', '222', '2015-10-23 10:07:43', '2015-10-23 10:07:43'),
(5, '11111111', 6, 'asdasd', 0, 222, 222, 222, 22, 22, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'asdas', '2015-11-07 13:02:52', '2015-11-07 13:02:52'),
(6, 'aaaaaaaa', 4, '', 0, 2, 2, 2, 2, 2, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'aaaaaaa', '2015-11-17 07:42:08', '2015-11-17 07:42:08'),
(7, 'asd', 8, '', 0, 123, 123, 123, 123, 123, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '123', '2015-11-17 09:31:34', '2015-11-17 09:31:34'),
(8, 'asd', 8, '', 0, 2, 2, 2, 2, 2323, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '2015-11-17 09:35:20', '2015-11-17 09:35:20'),
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELATIONS FOR TABLE `client`:
--   `user_id`
--       `users` -> `id`
--

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id`, `user_id`, `name`, `company`, `created_at`, `updated_at`) VALUES
(1, 1, 'pepsi', 'pepsi company', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 1, 'cocacola', 'cocacola company', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 1, 'alireza_pepsi', 'aaa', '2015-10-08 11:47:15', '2015-10-08 11:47:15'),
(4, 2, 'ali', 'ssss', '2015-10-08 11:50:08', '2015-10-08 11:50:08'),
(5, 2, 'aaaa', 'aaaaaaaa', '2015-10-10 12:29:23', '2015-10-10 12:29:23');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELATIONS FOR TABLE `creative`:
--   `advertiser_id`
--       `advertiser` -> `id`
--

--
-- Dumping data for table `creative`
--

INSERT INTO `creative` (`id`, `name`, `advertiser_id`, `description`, `status`, `ad_tag`, `landing_page_url`, `preview_url`, `size`, `is_secure`, `attributes`, `advertiser_domain_name`, `created_at`, `updated_at`) VALUES
(1, 'asdasd1', 4, '12311', 0, '2131', '1231', '1231', '1231x231', 0, '1231', '1231', '2015-10-23 06:15:09', '2015-10-23 06:34:23'),
(2, 'aaa', 8, '', 0, 'asd', 'ads', 'adsa', '23x23', 0, 'asd', 'aaaa', '2015-11-17 10:07:22', '2015-11-17 10:07:22');

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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELATIONS FOR TABLE `geosegment`:
--   `geosegmentlist_id`
--       `geosegmentlist` -> `id`
--

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
(15, 'fffff', '12.233', '6.1234', 12, 6, '2015-11-28 13:14:23', '2015-11-28 13:14:23');

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELATIONS FOR TABLE `geosegmentlist`:
--   `advertiser_id`
--       `advertiser` -> `id`
--

--
-- Dumping data for table `geosegmentlist`
--

INSERT INTO `geosegmentlist` (`id`, `name`, `advertiser_id`, `created_at`, `updated_at`) VALUES
(5, 'aa', 4, '2015-11-24 07:48:26', '2015-11-24 07:48:26'),
(6, 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 4, '2015-11-28 13:14:23', '2015-11-28 13:14:23');

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
-- RELATIONS FOR TABLE `iab_category`:
--

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
-- RELATIONS FOR TABLE `iab_sub_category`:
--   `iab_category_id`
--       `iab_category` -> `id`
--

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
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELATIONS FOR TABLE `migrations`:
--

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
('2015_12_01_155625_create-targetgroup-geosegment-map-table', 13);

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
-- RELATIONS FOR TABLE `model`:
--   `advertiser_id`
--       `advertiser` -> `id`
--

--
-- Dumping data for table `model`
--

INSERT INTO `model` (`id`, `name`, `advertiser_id`, `seed_web_sites`, `algo`, `segment_name_seed`, `process_result`, `description`, `num_neg_devices_used`, `num_pos_devices_used`, `feature_recency_in_sec`, `max_num_both_neg_pos_devices`, `negative_features_requested`, `feature_avg_num_history_used`, `negative_feature_used`, `date_of_request`, `created_at`, `updated_at`) VALUES
(1, 'aaa', 6, '"asd,dd,d"', 'heat', 'aaa', 'asdas', '1111', 1, 1, 1, 1, '"asd,fgsd,fg,df,w"', '', '"asd,ac,zc,sdf,g"', '2016-01-11 07:00:06', '2015-11-12 06:34:38', '2015-11-12 07:06:34'),
(2, 'sad', 8, '"sad"', 'heat', 'asdas', '234', 'asdasd', 234, 24, 34324, 234, '"asd,addd"', '', '"aaaa"', '2016-07-11 10:25:15', '2015-11-24 11:25:15', '2015-11-24 11:25:15');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELATIONS FOR TABLE `password_resets`:
--

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELATIONS FOR TABLE `permission`:
--

--
-- Dumping data for table `permission`
--

INSERT INTO `permission` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'ADD_CLIENT', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'EDIT_CLIENT', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'VIEW_CLIENT', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELATIONS FOR TABLE `role`:
--

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'super_admin', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'admin', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'acount_manager', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'guest', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELATIONS FOR TABLE `role_permission_mapping`:
--   `permission_id`
--       `permission` -> `id`
--   `role_id`
--       `role` -> `id`
--

--
-- Dumping data for table `role_permission_mapping`
--

INSERT INTO `role_permission_mapping` (`id`, `permission_id`, `role_id`, `created_at`, `updated_at`) VALUES
(3, 1, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 2, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELATIONS FOR TABLE `targetgroup`:
--   `campaign_id`
--       `campaign` -> `id`
--

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
(10, 'asdads', 3, '', 0, '1', NULL, 0, 0, 0, 0, '', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '2015-12-01 12:42:18', '2015-12-01 12:42:18');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELATIONS FOR TABLE `targetgroup_creative_map`:
--   `creative_id`
--       `creative` -> `id`
--   `targetgroup_id`
--       `targetgroup` -> `id`
--

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELATIONS FOR TABLE `targetgroup_geosegmentlist_map`:
--   `geosegmentlist_id`
--       `geosegmentlist` -> `id`
--   `targetgroup_id`
--       `targetgroup` -> `id`
--

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
(10, 10, 6, '2015-12-01 12:42:18', '2015-12-01 12:42:18');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `company` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELATIONS FOR TABLE `users`:
--   `role_id`
--       `role` -> `id`
--

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `company`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'aaa11', 'alireza', '09364991494@yahoo.com', '$2y$10$eLI/.WWqZAkuL8zEJkgOeuncPWv42Fhn7yDwmDdH7SoUKVns3Ac5q', 'gYeNTvlaVHgu7cT7s7bpbOqZW1Ur6VdyCkcGFg6PGGa8Z476rjTRqE6fbKvN', '0000-00-00 00:00:00', '2015-10-31 13:35:45'),
(2, 1, '', 'alireza11111', 'a@b.com', '$2y$10$eLI/.WWqZAkuL8zEJkgOeuncPWv42Fhn7yDwmDdH7SoUKVns3Ac5q', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

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
-- RELATIONS FOR TABLE `user_role_mapping`:
--   `role_id`
--       `role` -> `id`
--   `user_id`
--       `users` -> `id`
--

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
  ADD KEY `users_role_id` (`id`);

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
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `bwentries`
--
ALTER TABLE `bwentries`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=77;
--
-- AUTO_INCREMENT for table `bwlist`
--
ALTER TABLE `bwlist`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `campaign`
--
ALTER TABLE `campaign`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `creative`
--
ALTER TABLE `creative`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `geosegment`
--
ALTER TABLE `geosegment`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `geosegmentlist`
--
ALTER TABLE `geosegmentlist`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
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
-- AUTO_INCREMENT for table `model`
--
ALTER TABLE `model`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `permission`
--
ALTER TABLE `permission`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `role_permission_mapping`
--
ALTER TABLE `role_permission_mapping`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `targetgroup`
--
ALTER TABLE `targetgroup`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `targetgroup_creative_map`
--
ALTER TABLE `targetgroup_creative_map`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `targetgroup_geosegmentlist_map`
--
ALTER TABLE `targetgroup_geosegmentlist_map`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
