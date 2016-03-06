-- phpMyAdmin SQL Dump
-- version 4.4.14.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 06, 2016 at 07:38 PM
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
  `status` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Inactive',
  `client_id` int(10) unsigned NOT NULL,
  `domain_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `advertiser`
--

INSERT INTO `advertiser` (`id`, `name`, `description`, `status`, `client_id`, `domain_name`, `created_at`, `updated_at`) VALUES
(2, 'adv2', 'adv_descript_21', 'Active', 4, 'asdasd.com', '0000-00-00 00:00:00', '2016-02-22 14:44:12'),
(4, 'adv41', 'adv_descript_1', 'Inactive', 4, 'aaaa.com', '0000-00-00 00:00:00', '2016-02-25 05:10:23'),
(6, 'test1', 'aaaaa', 'Active', 1, '', '2015-11-07 12:58:57', '2016-02-24 12:08:56'),
(8, 'adv change', '', 'Inactive', 3, 'ddd.com', '2015-11-17 09:26:12', '2016-02-13 12:53:59'),
(9, 'asdasdas', '', 'Active', 2, 'adadas', '2015-11-17 12:37:45', '2016-01-26 13:11:59'),
(10, '11111', '', 'Active', 1, 'aaa', '2015-12-23 12:21:42', '2016-02-04 06:46:12'),
(11, 'asd132111', '', 'Active', 4, 'sdasd', '2016-01-27 13:08:46', '2016-02-04 06:46:40'),
(12, 'Active', '', '', 19, 'bing1.com', '2016-02-02 10:57:50', '2016-02-10 13:57:06'),
(13, 'adv 1 abc', '', 'Inactive', 27, 'abc.com', '2016-02-04 09:56:51', '2016-02-04 10:08:41'),
(14, 'adv.2_abc1', '', 'Inactive', 27, 'abc2.com', '2016-02-04 09:57:28', '2016-02-04 10:09:48'),
(15, 'asdasdasd', '', 'Inactive', 27, 'asd.com', '2016-02-04 11:14:03', '2016-02-04 11:14:03');

-- --------------------------------------------------------

--
-- Table structure for table `advertiser_model_map`
--

CREATE TABLE IF NOT EXISTS `advertiser_model_map` (
  `id` int(10) unsigned NOT NULL,
  `advertiser_id` int(10) unsigned NOT NULL,
  `model_id` int(10) unsigned NOT NULL,
  `status` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `advertiser_publisher`
--

CREATE TABLE IF NOT EXISTS `advertiser_publisher` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `advertiser_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `advertiser_publisher`
--

INSERT INTO `advertiser_publisher` (`id`, `name`, `advertiser_id`, `created_at`, `updated_at`) VALUES
(2, 'asd', 4, '2016-01-19 13:05:27', '2016-01-19 13:05:27'),
(3, 'ss', 4, '2016-01-19 13:13:57', '2016-01-19 13:13:57'),
(4, 'aaa', 4, '2016-01-19 13:21:22', '2016-01-19 13:21:22'),
(5, 'sad', 4, '2016-01-19 13:22:33', '2016-01-19 13:22:33'),
(6, 'df', 4, '2016-01-19 13:41:17', '2016-01-19 13:41:17'),
(7, 'sadasd', 4, '2016-01-19 13:45:04', '2016-01-19 13:45:04'),
(8, 'rrr', 4, '2016-01-19 13:46:31', '2016-01-19 13:46:31'),
(9, 'hgg', 4, '2016-01-20 10:53:55', '2016-01-20 10:53:55'),
(10, 'asd', 4, '2016-01-20 14:06:07', '2016-01-20 14:06:07'),
(11, 'asd34', 4, '2016-01-20 14:06:11', '2016-01-20 14:06:11'),
(12, 'alisd23', 4, '2016-01-20 14:38:27', '2016-01-20 14:38:27'),
(13, 'xac', 4, '2016-01-20 14:38:30', '2016-01-20 14:38:30'),
(14, 'wqe', 4, '2016-01-20 14:50:23', '2016-01-20 14:50:23'),
(15, 'asd', 4, '2016-01-20 14:50:26', '2016-01-20 14:50:26'),
(16, 'asd', 4, '2016-01-20 15:42:24', '2016-01-20 15:42:24'),
(17, 'sad', 4, '2016-01-20 15:42:57', '2016-01-20 15:42:57'),
(18, 'sad', 4, '2016-01-20 15:45:26', '2016-01-20 15:45:26'),
(19, 'dsaf', 4, '2016-01-20 15:45:29', '2016-01-20 15:45:29'),
(20, 'asd', 4, '2016-01-21 09:08:30', '2016-01-21 09:08:30'),
(21, 'ali.com', 4, '2016-01-21 12:23:01', '2016-01-21 12:23:01'),
(22, 'yyy.com', 4, '2016-01-21 12:23:09', '2016-01-21 12:23:09'),
(23, 'asdasdas.com', 4, '2016-01-28 09:03:58', '2016-01-28 09:03:58'),
(24, 'asdasd123', 4, '2016-01-28 09:04:03', '2016-01-28 09:04:03'),
(25, 'sad', 4, '2016-01-28 09:35:50', '2016-01-28 09:35:50'),
(26, 'asd', 4, '2016-01-30 14:29:20', '2016-01-30 14:29:20'),
(27, 'asdasd', 4, '2016-01-31 11:56:49', '2016-01-31 11:56:49'),
(28, 'asda', 13, '2016-02-04 11:09:36', '2016-02-04 11:09:36');

-- --------------------------------------------------------

--
-- Table structure for table `audits`
--

CREATE TABLE IF NOT EXISTS `audits` (
  `id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `entity_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `entity_id` int(11) NOT NULL,
  `audit_type` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `field` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `before_value` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `after_value` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Parent ID',
  `change_key` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `date_change` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=325 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `audits`
--

INSERT INTO `audits` (`id`, `user_id`, `entity_type`, `entity_id`, `audit_type`, `field`, `before_value`, `after_value`, `change_key`, `date_change`, `created_at`, `updated_at`) VALUES
(1, 1, 'client', 1, 'edit', 'name', 'pepsiasd1235', 'pepsiasd12351', '$2y$10$wU8kk5RKIoUG9CgPmkbYf.1MTpMgPXQZGPblEozPdqUZmIXIixkoi', '2016-02-10 12:50:34', '2016-02-10 12:50:34', '2016-02-10 12:50:34'),
(2, 1, 'advertiser', 2, 'edit', 'Name', 'adv_23', 'adv_231', '$2y$10$/Czcu5YvsyQ.4Tw9d9FF3eMp/dx4a3Ya.gNX1JbRoivD2J3r45kj6', '2016-02-10 12:51:34', '2016-02-10 12:51:34', '2016-02-10 12:51:34'),
(3, 1, 'advertiser', 2, 'edit', 'Status', 'Inactive', 'Active', '$2y$10$/Czcu5YvsyQ.4Tw9d9FF3eMp/dx4a3Ya.gNX1JbRoivD2J3r45kj6', '2016-02-10 12:51:34', '2016-02-10 12:51:34', '2016-02-10 12:51:34'),
(4, 1, 'advertiser', 2, 'edit', 'Domain Name', '', 'asdasd.com', '$2y$10$/Czcu5YvsyQ.4Tw9d9FF3eMp/dx4a3Ya.gNX1JbRoivD2J3r45kj6', '2016-02-10 12:51:34', '2016-02-10 12:51:34', '2016-02-10 12:51:34'),
(5, 1, 'advertiser', 2, 'edit', 'Description', 'adv_descript_2', 'adv_descript_21', '$2y$10$/Czcu5YvsyQ.4Tw9d9FF3eMp/dx4a3Ya.gNX1JbRoivD2J3r45kj6', '2016-02-10 12:51:34', '2016-02-10 12:51:34', '2016-02-10 12:51:34'),
(6, 1, 'campaign', 3, 'edit', 'Name', 'fsdf111121', 'fsdf1111211', '$2y$10$ZUFp8xr2BfOcSe9zvKJqr.L.N33YSLntylM0NkeW43rRJ.dSbrGLy', '2016-02-10 13:11:21', '2016-02-10 13:11:21', '2016-02-10 13:11:21'),
(7, 1, 'campaign', 3, 'edit', 'Status', 'Active', 'Inactive', '$2y$10$ZUFp8xr2BfOcSe9zvKJqr.L.N33YSLntylM0NkeW43rRJ.dSbrGLy', '2016-02-10 13:11:21', '2016-02-10 13:11:21', '2016-02-10 13:11:21'),
(8, 1, 'campaign', 3, 'edit', 'Max Imps', '13123', '131231', '$2y$10$ZUFp8xr2BfOcSe9zvKJqr.L.N33YSLntylM0NkeW43rRJ.dSbrGLy', '2016-02-10 13:11:21', '2016-02-10 13:11:21', '2016-02-10 13:11:21'),
(9, 1, 'campaign', 3, 'edit', 'Daily Max Imps', '2342', '23421', '$2y$10$ZUFp8xr2BfOcSe9zvKJqr.L.N33YSLntylM0NkeW43rRJ.dSbrGLy', '2016-02-10 13:11:21', '2016-02-10 13:11:21', '2016-02-10 13:11:21'),
(10, 1, 'campaign', 3, 'edit', 'Max Budget', '34231', '342311', '$2y$10$ZUFp8xr2BfOcSe9zvKJqr.L.N33YSLntylM0NkeW43rRJ.dSbrGLy', '2016-02-10 13:11:21', '2016-02-10 13:11:21', '2016-02-10 13:11:21'),
(11, 1, 'campaign', 3, 'edit', 'Daily Max Budget', '4234', '42341', '$2y$10$ZUFp8xr2BfOcSe9zvKJqr.L.N33YSLntylM0NkeW43rRJ.dSbrGLy', '2016-02-10 13:11:21', '2016-02-10 13:11:21', '2016-02-10 13:11:21'),
(12, 1, 'campaign', 3, 'edit', 'CPM', '234', '2341', '$2y$10$ZUFp8xr2BfOcSe9zvKJqr.L.N33YSLntylM0NkeW43rRJ.dSbrGLy', '2016-02-10 13:11:21', '2016-02-10 13:11:21', '2016-02-10 13:11:21'),
(13, 1, 'campaign', 3, 'edit', 'Domain Name', '234', '2341.com', '$2y$10$ZUFp8xr2BfOcSe9zvKJqr.L.N33YSLntylM0NkeW43rRJ.dSbrGLy', '2016-02-10 13:11:21', '2016-02-10 13:11:21', '2016-02-10 13:11:21'),
(14, 1, 'campaign', 3, 'edit', 'Description', 'asdas', 'asdass', '$2y$10$ZUFp8xr2BfOcSe9zvKJqr.L.N33YSLntylM0NkeW43rRJ.dSbrGLy', '2016-02-10 13:11:21', '2016-02-10 13:11:21', '2016-02-10 13:11:21'),
(15, 1, 'campaign', 3, 'edit', 'Start Date', '2015-11-09 18:02:32', '2016-02-17 16:41:21', '$2y$10$ZUFp8xr2BfOcSe9zvKJqr.L.N33YSLntylM0NkeW43rRJ.dSbrGLy', '2016-02-10 13:11:21', '2016-02-10 13:11:21', '2016-02-10 13:11:21'),
(16, 1, 'campaign', 3, 'edit', 'End Date', '2015-11-25 18:02:32', '2016-02-18 16:41:21', '$2y$10$ZUFp8xr2BfOcSe9zvKJqr.L.N33YSLntylM0NkeW43rRJ.dSbrGLy', '2016-02-10 13:11:21', '2016-02-10 13:11:21', '2016-02-10 13:11:21'),
(17, 1, 'creative', 2, 'edit', 'Name', 'aaa1sss3', 'aaa1sss31', '$2y$10$VC.fl6Fk0UmWyJjL0VProu7g2016DIIHv5Gd4u8/sVsd7aOVn21Fy', '2016-02-10 13:12:05', '2016-02-10 13:12:06', '2016-02-10 13:12:06'),
(18, 1, 'creative', 2, 'edit', 'Ad Type', 'IFRAME', 'XHTML_BANNER_AD', '$2y$10$VC.fl6Fk0UmWyJjL0VProu7g2016DIIHv5Gd4u8/sVsd7aOVn21Fy', '2016-02-10 13:12:05', '2016-02-10 13:12:06', '2016-02-10 13:12:06'),
(19, 1, 'creative', 2, 'edit', 'API', '["VPAID_1.0","VPAID_2.0","MRAID-1"]', '["MRAID-1","ORMMA"]', '$2y$10$VC.fl6Fk0UmWyJjL0VProu7g2016DIIHv5Gd4u8/sVsd7aOVn21Fy', '2016-02-10 13:12:05', '2016-02-10 13:12:06', '2016-02-10 13:12:06'),
(20, 1, 'creative', 2, 'edit', 'Domain Name', 'aaaas.com', 'aaaa1s.com', '$2y$10$VC.fl6Fk0UmWyJjL0VProu7g2016DIIHv5Gd4u8/sVsd7aOVn21Fy', '2016-02-10 13:12:05', '2016-02-10 13:12:06', '2016-02-10 13:12:06'),
(21, 1, 'creative', 2, 'edit', 'Description', '', 'asdas', '$2y$10$VC.fl6Fk0UmWyJjL0VProu7g2016DIIHv5Gd4u8/sVsd7aOVn21Fy', '2016-02-10 13:12:05', '2016-02-10 13:12:06', '2016-02-10 13:12:06'),
(22, 1, 'creative', 2, 'edit', 'Landing Page URL', 'ads1', 'ads11', '$2y$10$VC.fl6Fk0UmWyJjL0VProu7g2016DIIHv5Gd4u8/sVsd7aOVn21Fy', '2016-02-10 13:12:05', '2016-02-10 13:12:06', '2016-02-10 13:12:06'),
(23, 1, 'creative', 2, 'edit', 'Preview URL', 'adsa', 'adsa1', '$2y$10$VC.fl6Fk0UmWyJjL0VProu7g2016DIIHv5Gd4u8/sVsd7aOVn21Fy', '2016-02-10 13:12:05', '2016-02-10 13:12:06', '2016-02-10 13:12:06'),
(24, 1, 'creative', 2, 'edit', 'Attributes', 'asd', 'asd1', '$2y$10$VC.fl6Fk0UmWyJjL0VProu7g2016DIIHv5Gd4u8/sVsd7aOVn21Fy', '2016-02-10 13:12:05', '2016-02-10 13:12:06', '2016-02-10 13:12:06'),
(25, 1, 'creative', 2, 'edit', 'AD Tag', '                                                                                                                                asd', '                                                                                                                                                                                                asd', '$2y$10$VC.fl6Fk0UmWyJjL0VProu7g2016DIIHv5Gd4u8/sVsd7aOVn21Fy', '2016-02-10 13:12:05', '2016-02-10 13:12:06', '2016-02-10 13:12:06'),
(26, 1, 'creative', 2, 'edit', 'Size', '23x232', '231x2321', '$2y$10$VC.fl6Fk0UmWyJjL0VProu7g2016DIIHv5Gd4u8/sVsd7aOVn21Fy', '2016-02-10 13:12:05', '2016-02-10 13:12:06', '2016-02-10 13:12:06'),
(29, 1, 'offer', 1, 'edit', 'Name', 'Inactive', 'Inactive1', '$2y$10$QyWwszhoXsRyMA2hb5jvre0cK/lrb3wgAMrRHYpiLMsuepNoxJsG.', '2016-02-10 13:14:09', '2016-02-10 13:14:09', '2016-02-10 13:14:09'),
(30, 1, 'offer', 1, 'edit', 'Status', 'Active', 'Inactive', '$2y$10$QyWwszhoXsRyMA2hb5jvre0cK/lrb3wgAMrRHYpiLMsuepNoxJsG.', '2016-02-10 13:14:09', '2016-02-10 13:14:09', '2016-02-10 13:14:09'),
(33, 1, 'pixel', 1, 'edit', 'Name', 'Inactive', 'pixle1111', '$2y$10$j/Q6fozmi7p6j5xNGzbmje0r7pTQ8PKpz6ji/PkdIovW5LWJWWlz2', '2016-02-10 13:18:44', '2016-02-10 13:18:44', '2016-02-10 13:18:44'),
(34, 1, 'pixel', 1, 'edit', 'Status', 'Active', 'Inactive', '$2y$10$j/Q6fozmi7p6j5xNGzbmje0r7pTQ8PKpz6ji/PkdIovW5LWJWWlz2', '2016-02-10 13:18:44', '2016-02-10 13:18:44', '2016-02-10 13:18:44'),
(37, 1, 'bwlist', 1, 'edit', 'name', 'shomare 11122', 'qweqwe', '$2y$10$w99iOqUdpcbDcG6cSRInTO0dk8pn66N60P9/.q67PEQR4I/67QhPa', '2016-02-10 13:21:52', '2016-02-10 13:21:52', '2016-02-10 13:21:52'),
(38, 1, 'bwlist', 1, 'edit', 'Status', 'Active', 'Inactive', '$2y$10$w99iOqUdpcbDcG6cSRInTO0dk8pn66N60P9/.q67PEQR4I/67QhPa', '2016-02-10 13:21:52', '2016-02-10 13:21:52', '2016-02-10 13:21:52'),
(39, 1, 'bwlist', 1, 'edit', 'list_type', 'white', 'black', '$2y$10$w99iOqUdpcbDcG6cSRInTO0dk8pn66N60P9/.q67PEQR4I/67QhPa', '2016-02-10 13:21:52', '2016-02-10 13:21:52', '2016-02-10 13:21:52'),
(42, 1, 'geosegment', 7, 'edit', 'Name', 'Inactive', 'gsmssss', '$2y$10$L.cRICkSJhdN72yv0XPKlu9RQvE4iLTxIlY1xCjXpUBdP4tdOy8Y2', '2016-02-10 13:24:41', '2016-02-10 13:24:41', '2016-02-10 13:24:41'),
(43, 1, 'geosegment', 7, 'edit', 'Status', 'Active', 'Inactive', '$2y$10$L.cRICkSJhdN72yv0XPKlu9RQvE4iLTxIlY1xCjXpUBdP4tdOy8Y2', '2016-02-10 13:24:41', '2016-02-10 13:24:41', '2016-02-10 13:24:41'),
(98, 1, 'positive_offer_model', 2, 'add', '', '', '4', '$2y$10$bqcANFOs5Ps04IBOxzde1.M7vQiXFRLqURLVgJ1PpW75PkEc0Dzma', '2016-02-10 13:42:08', '2016-02-10 13:42:08', '2016-02-10 13:42:08'),
(99, 1, 'positive_offer_model', 5, 'del', '', '', '4', '$2y$10$bqcANFOs5Ps04IBOxzde1.M7vQiXFRLqURLVgJ1PpW75PkEc0Dzma', '2016-02-10 13:42:08', '2016-02-10 13:42:08', '2016-02-10 13:42:08'),
(100, 1, 'negative_offer_model', 1, 'add', '', '', '4', '$2y$10$bqcANFOs5Ps04IBOxzde1.M7vQiXFRLqURLVgJ1PpW75PkEc0Dzma', '2016-02-10 13:42:08', '2016-02-10 13:42:08', '2016-02-10 13:42:08'),
(101, 1, 'negative_offer_model', 5, 'add', '', '', '4', '$2y$10$bqcANFOs5Ps04IBOxzde1.M7vQiXFRLqURLVgJ1PpW75PkEc0Dzma', '2016-02-10 13:42:08', '2016-02-10 13:42:08', '2016-02-10 13:42:08'),
(102, 1, 'negative_offer_model', 2, 'del', '', '', '4', '$2y$10$bqcANFOs5Ps04IBOxzde1.M7vQiXFRLqURLVgJ1PpW75PkEc0Dzma', '2016-02-10 13:42:08', '2016-02-10 13:42:08', '2016-02-10 13:42:08'),
(103, 1, 'modelTable', 4, 'edit', 'Name', 'test111121', 'test111121s', '$2y$10$bqcANFOs5Ps04IBOxzde1.M7vQiXFRLqURLVgJ1PpW75PkEc0Dzma', '2016-02-10 13:42:08', '2016-02-10 13:42:08', '2016-02-10 13:42:08'),
(104, 1, 'modelTable', 4, 'edit', 'Segment Name Seed', '234112', '2341122', '$2y$10$bqcANFOs5Ps04IBOxzde1.M7vQiXFRLqURLVgJ1PpW75PkEc0Dzma', '2016-02-10 13:42:08', '2016-02-10 13:42:08', '2016-02-10 13:42:08'),
(108, 1, 'offer_pixel_map', 5, 'add', '', '', '1', '$2y$10$08QqL645N0a6FVT70pxu1eZQqYmkiYppuDUIdBkbdHi5SintKxekO', '2016-02-10 13:44:53', '2016-02-10 13:44:53', '2016-02-10 13:44:53'),
(109, 1, 'offer_pixel_map', 4, 'add', '', '', '1', '$2y$10$08QqL645N0a6FVT70pxu1eZQqYmkiYppuDUIdBkbdHi5SintKxekO', '2016-02-10 13:44:53', '2016-02-10 13:44:53', '2016-02-10 13:44:53'),
(110, 1, 'offer_pixel_map', 3, 'add', '', '', '1', '$2y$10$08QqL645N0a6FVT70pxu1eZQqYmkiYppuDUIdBkbdHi5SintKxekO', '2016-02-10 13:44:53', '2016-02-10 13:44:53', '2016-02-10 13:44:53'),
(111, 1, 'offer_pixel_map', 1, 'add', '', '', '1', '$2y$10$G09MX.EUa473UEhApjoCMe5Usad8.Ueo/L0vsn313vXozKvih0ql6', '2016-02-10 13:52:06', '2016-02-10 13:52:06', '2016-02-10 13:52:06'),
(112, 1, 'offer_pixel_map', 2, 'add', '', '', '1', '$2y$10$G09MX.EUa473UEhApjoCMe5Usad8.Ueo/L0vsn313vXozKvih0ql6', '2016-02-10 13:52:06', '2016-02-10 13:52:06', '2016-02-10 13:52:06'),
(113, 1, 'offer_pixel_map', 5, 'del', '', '', '1', '$2y$10$G09MX.EUa473UEhApjoCMe5Usad8.Ueo/L0vsn313vXozKvih0ql6', '2016-02-10 13:52:06', '2016-02-10 13:52:06', '2016-02-10 13:52:06'),
(114, 1, 'offer_pixel_map', 4, 'del', '', '', '1', '$2y$10$G09MX.EUa473UEhApjoCMe5Usad8.Ueo/L0vsn313vXozKvih0ql6', '2016-02-10 13:52:06', '2016-02-10 13:52:06', '2016-02-10 13:52:06'),
(115, 8, 'advertiser', 12, 'edit', 'Name', 'advertiser_1_bing', 'advertiser1_1_bing', '$2y$10$34/h22oi7aeJGZk5hlaA6OJXjzRxxZdKVDrcIdA/PQNLzYpn0h3DC', '2016-02-10 13:57:06', '2016-02-10 13:57:06', '2016-02-10 13:57:06'),
(116, 8, 'advertiser', 12, 'edit', 'Status', '', 'Active', '$2y$10$34/h22oi7aeJGZk5hlaA6OJXjzRxxZdKVDrcIdA/PQNLzYpn0h3DC', '2016-02-10 13:57:06', '2016-02-10 13:57:06', '2016-02-10 13:57:06'),
(117, 8, 'advertiser', 12, 'edit', 'Domain Name', 'bing.com', 'bing1.com', '$2y$10$34/h22oi7aeJGZk5hlaA6OJXjzRxxZdKVDrcIdA/PQNLzYpn0h3DC', '2016-02-10 13:57:06', '2016-02-10 13:57:06', '2016-02-10 13:57:06'),
(119, 1, 'pixel', 7, 'add', '', '', '', '$2y$10$s.KR2IUhRDUXjGd53B3M5uFKSz1hXS6BW0SGX/S7cwrIw7AyShR4q', '2016-02-11 08:06:40', '2016-02-11 08:06:40', '2016-02-11 08:06:40'),
(120, 1, 'bwlistentrie', 174, 'add', '', '', '19', '$2y$10$xoPaSQqQoFkrawlURHd8vO3wpugGRwmL86TZRbBToGw4y7cnmM0wK', '2016-02-13 11:23:52', '2016-02-13 11:23:53', '2016-02-13 11:23:53'),
(121, 1, 'bwlist', 2, 'edit', 'status', 'Active', 'Disable', '$2y$10$UzngxCnuM54LFl3P/5CFZe0/Zp6yA21vQ9XzDE1GKLJsNhXSpEJTW', '2016-02-13 12:15:37', '2016-02-13 12:15:37', '2016-02-13 12:15:37'),
(122, 1, 'advertiser', 8, 'edit', 'status', 'Active', 'Inactive', '$2y$10$YS7gTG9TSatwK3axPJ8nGu4xSBnyPKnD3E.tWX6VIXN7Fl7TiEkLy', '2016-02-13 12:53:59', '2016-02-13 12:53:59', '2016-02-13 12:53:59'),
(123, 1, 'bwlist', 3, 'edit', 'status', 'Active', 'Inactive', '$2y$10$o1iqzz9O8hjplZyHKv46g.euDNs17c0w./mVrlwc.sF7d8YyBPt.W', '2016-02-13 12:55:15', '2016-02-13 12:55:15', '2016-02-13 12:55:15'),
(124, 1, 'bwlist', 5, 'edit', 'status', 'Active', 'Inactive', '$2y$10$TuOysjkae18aBZObPivIRe.4PYrhVvzMFXPthn6PS7cMGOH4eKCQm', '2016-02-13 12:55:30', '2016-02-13 12:55:30', '2016-02-13 12:55:30'),
(128, 1, 'creative', 2, 'edit', 'Attributes', 'asd1', 'asd1s', '$2y$10$YSbY/quaGtz0uYCxyhXZ0.58KW42t1sFINEiLcgUATen/AmmPb2Cy', '2016-02-15 13:19:16', '2016-02-15 13:19:16', '2016-02-15 13:19:16'),
(129, 1, 'creative', 2, 'edit', 'AD Tag', '                                                                                                                                                                                                asd', '                                                                                                                                                                                                                                                               ', '$2y$10$YSbY/quaGtz0uYCxyhXZ0.58KW42t1sFINEiLcgUATen/AmmPb2Cy', '2016-02-15 13:19:16', '2016-02-15 13:19:16', '2016-02-15 13:19:16'),
(133, 1, 'campaign', 5, 'edit', 'status', 'Active', 'Inactive', '$2y$10$D1VV7kOCuHAyBmgqNH9HU.5NMu1mHISx2cR2lpgRkW5BZB7fxLNZC', '2016-02-16 11:24:01', '2016-02-16 11:24:01', '2016-02-16 11:24:01'),
(134, 1, 'campaign', 5, 'edit', 'status', 'Inactive', 'Active', '$2y$10$yWXytW6hCy9X5qraSz3tgeton82j/Qsnh1PJpCmZv0kbdBYc2EU9i', '2016-02-16 11:24:05', '2016-02-16 11:24:05', '2016-02-16 11:24:05'),
(155, 1, 'campaign', 3, 'bulk_edit', 'Name', '', 'aaas', '$2y$10$GQlwYtfQSkcAzoMz6Fn4aeqiRh3z3.pb5b.xVr8SHJZiddC5gGQpW', '2016-02-17 09:38:50', '2016-02-17 09:38:50', '2016-02-17 09:38:50'),
(156, 1, 'campaign', 3, 'bulk_edit', 'Domain Name', '', 'asd.com', '$2y$10$GQlwYtfQSkcAzoMz6Fn4aeqiRh3z3.pb5b.xVr8SHJZiddC5gGQpW', '2016-02-17 09:38:50', '2016-02-17 09:38:50', '2016-02-17 09:38:50'),
(157, 1, 'campaign', 4, 'bulk_edit', 'Name', '', 'aaas', '$2y$10$GQlwYtfQSkcAzoMz6Fn4aeqiRh3z3.pb5b.xVr8SHJZiddC5gGQpW', '2016-02-17 09:38:50', '2016-02-17 09:38:50', '2016-02-17 09:38:50'),
(158, 1, 'campaign', 4, 'bulk_edit', 'Domain Name', '', 'asd.com', '$2y$10$GQlwYtfQSkcAzoMz6Fn4aeqiRh3z3.pb5b.xVr8SHJZiddC5gGQpW', '2016-02-17 09:38:50', '2016-02-17 09:38:50', '2016-02-17 09:38:50'),
(159, 1, 'campaign', 5, 'bulk_edit', 'Name', '', 'aaas', '$2y$10$GQlwYtfQSkcAzoMz6Fn4aeqiRh3z3.pb5b.xVr8SHJZiddC5gGQpW', '2016-02-17 09:38:50', '2016-02-17 09:38:50', '2016-02-17 09:38:50'),
(160, 1, 'campaign', 5, 'bulk_edit', 'Domain Name', '', 'asd.com', '$2y$10$GQlwYtfQSkcAzoMz6Fn4aeqiRh3z3.pb5b.xVr8SHJZiddC5gGQpW', '2016-02-17 09:38:50', '2016-02-17 09:38:50', '2016-02-17 09:38:50'),
(161, 1, 'creative', 2, 'bulk_edit', 'Name', '', 'asd', '$2y$10$YbeB/Jwac909wzABzbRT7uNtQmyQ1nHKkAey3xbEPEWl7gPRVS8v6', '2016-02-17 10:15:18', '2016-02-17 10:15:18', '2016-02-17 10:15:18'),
(162, 1, 'creative', 2, 'bulk_edit', 'AD Tag', '', 'asdd', '$2y$10$YbeB/Jwac909wzABzbRT7uNtQmyQ1nHKkAey3xbEPEWl7gPRVS8v6', '2016-02-17 10:15:18', '2016-02-17 10:15:18', '2016-02-17 10:15:18'),
(163, 1, 'creative', 5, 'bulk_edit', 'Name', '', 'asd', '$2y$10$YbeB/Jwac909wzABzbRT7uNtQmyQ1nHKkAey3xbEPEWl7gPRVS8v6', '2016-02-17 10:15:18', '2016-02-17 10:15:18', '2016-02-17 10:15:18'),
(164, 1, 'creative', 5, 'bulk_edit', 'AD Tag', '', 'asdd', '$2y$10$YbeB/Jwac909wzABzbRT7uNtQmyQ1nHKkAey3xbEPEWl7gPRVS8v6', '2016-02-17 10:15:18', '2016-02-17 10:15:18', '2016-02-17 10:15:18'),
(212, 1, 'campaign', 4, 'bulk_edit', 'Name', '', 'asdd', '$2y$10$/kHE2aweMoSNvfKn/yAdpuppJkr5oEKBlGC9QlGRKtLmMnWoevmKe', '2016-02-21 13:18:52', '2016-02-21 13:18:52', '2016-02-21 13:18:52'),
(213, 1, 'campaign', 3, 'bulk_edit', 'Name', '', 'asdd', '$2y$10$/kHE2aweMoSNvfKn/yAdpuppJkr5oEKBlGC9QlGRKtLmMnWoevmKe', '2016-02-21 13:18:52', '2016-02-21 13:18:52', '2016-02-21 13:18:52'),
(214, 1, 'campaign', 5, 'bulk_edit', 'Name', '', 'asdd', '$2y$10$/kHE2aweMoSNvfKn/yAdpuppJkr5oEKBlGC9QlGRKtLmMnWoevmKe', '2016-02-21 13:18:52', '2016-02-21 13:18:52', '2016-02-21 13:18:52'),
(215, 1, 'campaign', 6, 'bulk_edit', 'Name', '', 'asdd', '$2y$10$/kHE2aweMoSNvfKn/yAdpuppJkr5oEKBlGC9QlGRKtLmMnWoevmKe', '2016-02-21 13:18:52', '2016-02-21 13:18:52', '2016-02-21 13:18:52'),
(227, 1, 'user', 1, 'edit', 'Name', 'alireza', 'alireza1', '$2y$10$saniW.3q4e/TRQoo/z5LpeeuUhIdaFUi1.H5PzZrBL4OTTllySGw2', '2016-02-22 14:42:42', '2016-02-22 14:42:42', '2016-02-22 14:42:42'),
(228, 1, 'advertiser', 2, 'edit', 'status', 'Inactive', 'Active', '$2y$10$smnYrK.mBokoA95xssnT9e1IiTSFPsvbN/Mdv3gG2g8OU9PXZqzg2', '2016-02-22 14:43:20', '2016-02-22 14:43:20', '2016-02-22 14:43:20'),
(229, 1, 'advertiser', 2, 'edit', 'Name', 'Active', 'adv2', '$2y$10$BwbF8N56bb7vh47gRNbenecPFfpTi9u42.UuurtA3N3HWTgvXwl/e', '2016-02-22 14:44:01', '2016-02-22 14:44:01', '2016-02-22 14:44:01'),
(230, 1, 'advertiser', 2, 'edit', 'status', 'Active', 'Inactive', '$2y$10$DOt5chvnNt50bkhILfYziewQUXBFp0yb9/6WCbtNm95UFMydu26QO', '2016-02-22 14:44:07', '2016-02-22 14:44:07', '2016-02-22 14:44:07'),
(231, 1, 'advertiser', 2, 'edit', 'status', 'Inactive', 'Active', '$2y$10$6hHC7OlYZga.0B2h7TjCMu6R7CAl8aA7n/Qf2p0Uo/wbheZhYrk7W', '2016-02-22 14:44:12', '2016-02-22 14:44:12', '2016-02-22 14:44:12'),
(232, 1, 'user', 1, 'edit', 'Name', 'alireza1', 'alireza11', '$2y$10$8oSbQe4VlU8vOtbjuBpJx.zX2hTgxSMdwUEGoja9DxG8LPYWD5MtW', '2016-02-22 14:51:54', '2016-02-22 14:51:55', '2016-02-22 14:51:55'),
(233, 1, 'campaign', 3, 'bulk_edit', 'Name', '', 'asdasd', '$2y$10$8dMmn5FXYPBUPkcgdNBgQeLPI2a7cTyADmW62hw4luTNrucshyb7C', '2016-02-23 13:21:34', '2016-02-23 13:21:34', '2016-02-23 13:21:34'),
(234, 1, 'campaign', 3, 'bulk_edit', 'Max Imps', '', '23', '$2y$10$8dMmn5FXYPBUPkcgdNBgQeLPI2a7cTyADmW62hw4luTNrucshyb7C', '2016-02-23 13:21:34', '2016-02-23 13:21:34', '2016-02-23 13:21:34'),
(235, 1, 'campaign', 3, 'bulk_edit', 'Max Budget', '', '123', '$2y$10$8dMmn5FXYPBUPkcgdNBgQeLPI2a7cTyADmW62hw4luTNrucshyb7C', '2016-02-23 13:21:34', '2016-02-23 13:21:34', '2016-02-23 13:21:34'),
(236, 1, 'campaign', 3, 'bulk_edit', 'Daily Max Budget', '', '213', '$2y$10$8dMmn5FXYPBUPkcgdNBgQeLPI2a7cTyADmW62hw4luTNrucshyb7C', '2016-02-23 13:21:34', '2016-02-23 13:21:34', '2016-02-23 13:21:34'),
(237, 1, 'campaign', 3, 'bulk_edit', 'Domain Name', '', 'asdas.com', '$2y$10$8dMmn5FXYPBUPkcgdNBgQeLPI2a7cTyADmW62hw4luTNrucshyb7C', '2016-02-23 13:21:34', '2016-02-23 13:21:34', '2016-02-23 13:21:34'),
(238, 1, 'campaign', 6, 'bulk_edit', 'Name', '', 'asdasd', '$2y$10$8dMmn5FXYPBUPkcgdNBgQeLPI2a7cTyADmW62hw4luTNrucshyb7C', '2016-02-23 13:21:34', '2016-02-23 13:21:34', '2016-02-23 13:21:34'),
(239, 1, 'campaign', 6, 'bulk_edit', 'Max Imps', '', '23', '$2y$10$8dMmn5FXYPBUPkcgdNBgQeLPI2a7cTyADmW62hw4luTNrucshyb7C', '2016-02-23 13:21:34', '2016-02-23 13:21:34', '2016-02-23 13:21:34'),
(240, 1, 'campaign', 6, 'bulk_edit', 'Max Budget', '', '123', '$2y$10$8dMmn5FXYPBUPkcgdNBgQeLPI2a7cTyADmW62hw4luTNrucshyb7C', '2016-02-23 13:21:34', '2016-02-23 13:21:34', '2016-02-23 13:21:34'),
(241, 1, 'campaign', 6, 'bulk_edit', 'Daily Max Budget', '', '213', '$2y$10$8dMmn5FXYPBUPkcgdNBgQeLPI2a7cTyADmW62hw4luTNrucshyb7C', '2016-02-23 13:21:34', '2016-02-23 13:21:34', '2016-02-23 13:21:34'),
(242, 1, 'campaign', 6, 'bulk_edit', 'Domain Name', '', 'asdas.com', '$2y$10$8dMmn5FXYPBUPkcgdNBgQeLPI2a7cTyADmW62hw4luTNrucshyb7C', '2016-02-23 13:21:34', '2016-02-23 13:21:34', '2016-02-23 13:21:34'),
(243, 1, 'creative', 2, 'bulk_edit', 'Name', '', 'ali', '$2y$10$z8J.krSRg/SN4UWQJx0.2uK/cQkD9/7YUmhx36Qe8eEnk3LC3LeQS', '2016-02-23 13:22:22', '2016-02-23 13:22:22', '2016-02-23 13:22:22'),
(244, 1, 'creative', 9, 'bulk_edit', 'Name', '', 'ali', '$2y$10$z8J.krSRg/SN4UWQJx0.2uK/cQkD9/7YUmhx36Qe8eEnk3LC3LeQS', '2016-02-23 13:22:22', '2016-02-23 13:22:22', '2016-02-23 13:22:22'),
(245, 1, 'creative', 19, 'bulk_edit', 'Name', '', 'ali', '$2y$10$z8J.krSRg/SN4UWQJx0.2uK/cQkD9/7YUmhx36Qe8eEnk3LC3LeQS', '2016-02-23 13:22:22', '2016-02-23 13:22:22', '2016-02-23 13:22:22'),
(246, 1, 'creative', 20, 'bulk_edit', 'Name', '', 'ali', '$2y$10$z8J.krSRg/SN4UWQJx0.2uK/cQkD9/7YUmhx36Qe8eEnk3LC3LeQS', '2016-02-23 13:22:22', '2016-02-23 13:22:22', '2016-02-23 13:22:22'),
(247, 1, 'campaign', 4, 'edit', 'Name', 'asdd', 'asdd1', '$2y$10$hCUX24rEWsM5K2I4mXTbOukHdIaMnkIvSG6jdQas0yE.RTiK9TbaS', '2016-02-24 11:47:34', '2016-02-24 11:47:34', '2016-02-24 11:47:34'),
(248, 1, 'campaign', 5, 'edit', 'Name', 'asdd', 'asdd1', '$2y$10$ohMBcBJH79TR8x3NKbipk.P6eeiwAIEe4iJHt0JAbPAtTJ.nyFF3S', '2016-02-24 11:48:23', '2016-02-24 11:48:24', '2016-02-24 11:48:24'),
(249, 1, 'advertiser', 6, 'edit', 'status', 'Inactive', 'Active', '$2y$10$ftV82RWX4cFs204hHB0.Fu.Y3Y9cdUEyHvYENHK0/wibHRVS3tCmG', '2016-02-24 12:08:56', '2016-02-24 12:08:56', '2016-02-24 12:08:56'),
(250, 1, 'client', 1, 'edit', 'Name', 'pepsiasd12351', 'pepsiasd123511', '$2y$10$ymFIICTJbP9MPg6ixdOgHeDI1n1shPskAcht/GA/NZviyNcb.SXAm', '2016-02-24 12:09:06', '2016-02-24 12:09:06', '2016-02-24 12:09:06'),
(251, 1, 'offer_pixel_map', 5, 'add', '', '', '1', '$2y$10$rIi3WVxXAvUa.o5/1bR93.b/y6R7pcyuSnzn1tNkL8NXdf2LmMvee', '2016-02-24 12:19:18', '2016-02-24 12:19:18', '2016-02-24 12:19:18'),
(252, 1, 'offer_pixel_map', 1, 'del', '', '', '1', '$2y$10$FI2vV.2Vnj51mNIuzLj90ef9k4xQ27y/izdaD8ZElCKeovwL15nmy', '2016-02-24 12:25:35', '2016-02-24 12:25:35', '2016-02-24 12:25:35'),
(253, 1, 'offer_pixel_map', 2, 'del', '', '', '1', '$2y$10$FI2vV.2Vnj51mNIuzLj90ef9k4xQ27y/izdaD8ZElCKeovwL15nmy', '2016-02-24 12:25:35', '2016-02-24 12:25:35', '2016-02-24 12:25:35'),
(254, 1, 'offer_pixel_map', 4, 'add', '', '', '1', '$2y$10$tWQ.RB/iSrkRGYZpdhGd1O.N5ZAa1VoLQMRhoAg7Jd7nF/o3HrrdS', '2016-02-24 12:26:23', '2016-02-24 12:26:23', '2016-02-24 12:26:23'),
(255, 1, 'offer_pixel_map', 7, 'add', '', '', '1', '$2y$10$tWQ.RB/iSrkRGYZpdhGd1O.N5ZAa1VoLQMRhoAg7Jd7nF/o3HrrdS', '2016-02-24 12:26:23', '2016-02-24 12:26:23', '2016-02-24 12:26:23'),
(256, 1, 'offer_pixel_map', 6, 'add', '', '', '1', '$2y$10$tWQ.RB/iSrkRGYZpdhGd1O.N5ZAa1VoLQMRhoAg7Jd7nF/o3HrrdS', '2016-02-24 12:26:23', '2016-02-24 12:26:23', '2016-02-24 12:26:23'),
(257, 1, 'offer_pixel_map', 1, 'add', '', '', '1', '$2y$10$tWQ.RB/iSrkRGYZpdhGd1O.N5ZAa1VoLQMRhoAg7Jd7nF/o3HrrdS', '2016-02-24 12:26:23', '2016-02-24 12:26:23', '2016-02-24 12:26:23'),
(258, 1, 'offer_pixel_map', 2, 'add', '', '', '1', '$2y$10$tWQ.RB/iSrkRGYZpdhGd1O.N5ZAa1VoLQMRhoAg7Jd7nF/o3HrrdS', '2016-02-24 12:26:23', '2016-02-24 12:26:23', '2016-02-24 12:26:23'),
(259, 1, 'advertiser', 4, 'edit', 'Name', 'adv4', 'adv41', '$2y$10$jWH6y3J4g7LMwaSsTmyDe.Tcdo/k0zEzYwimBGJbxaKJe1GImPpvO', '2016-02-25 05:10:23', '2016-02-25 05:10:23', '2016-02-25 05:10:23'),
(260, 1, 'advertiser', 4, 'edit', 'Domain Name', 'aaaa', 'aaaa.com', '$2y$10$jWH6y3J4g7LMwaSsTmyDe.Tcdo/k0zEzYwimBGJbxaKJe1GImPpvO', '2016-02-25 05:10:23', '2016-02-25 05:10:23', '2016-02-25 05:10:23'),
(261, 1, 'advertiser_model_map', 5, 'add', '', '', '4', '$2y$10$COmWhMlJKiJSpL.gICaMpeDwVt0WNelflA9WSIS3NrEfVNf6nq38O', '2016-02-25 11:14:56', '2016-02-25 11:14:56', '2016-02-25 11:14:56'),
(262, 1, 'advertiser_model_map', 4, 'add', '', '', '4', '$2y$10$COmWhMlJKiJSpL.gICaMpeDwVt0WNelflA9WSIS3NrEfVNf6nq38O', '2016-02-25 11:14:56', '2016-02-25 11:14:56', '2016-02-25 11:14:56'),
(263, 1, 'advertiser_model_map', 5, 'del', '', '', '4', '$2y$10$3WYmB.WHcuZqcGxTqCpzZuyT5vmmJxQl8mvzXXot0mvM3Jp4Mti9S', '2016-02-25 11:39:14', '2016-02-25 11:39:14', '2016-02-25 11:39:14'),
(264, 1, 'advertiser_model_map', 4, 'del', '', '', '4', '$2y$10$3WYmB.WHcuZqcGxTqCpzZuyT5vmmJxQl8mvzXXot0mvM3Jp4Mti9S', '2016-02-25 11:39:14', '2016-02-25 11:39:14', '2016-02-25 11:39:14'),
(265, 1, 'modelTable', 5, 'edit', 'Name', 'pixelmodel1', 'pixelm1odel1', '$2y$10$cub2zu4bKNyLXT4wNDn9SOaISXs/t9Bkrtx58/JKyDgqx.o4Bp1lG', '2016-02-25 11:45:21', '2016-02-25 11:45:21', '2016-02-25 11:45:21'),
(266, 1, 'modelTable', 5, 'edit', 'Seed Sites', '["abc.com", "abc1.com"]', 'null', '$2y$10$cub2zu4bKNyLXT4wNDn9SOaISXs/t9Bkrtx58/JKyDgqx.o4Bp1lG', '2016-02-25 11:45:21', '2016-02-25 11:45:21', '2016-02-25 11:45:21'),
(267, 1, 'modelTable', 5, 'edit', 'Segment Name Seed', 'cnn visitors', 'cnn vis`itors', '$2y$10$cub2zu4bKNyLXT4wNDn9SOaISXs/t9Bkrtx58/JKyDgqx.o4Bp1lG', '2016-02-25 11:45:21', '2016-02-25 11:45:21', '2016-02-25 11:45:21'),
(268, 1, 'modelTable', 5, 'edit', 'Negative Features Requested', '["fox.com", "fox1.com"]', 'null', '$2y$10$cub2zu4bKNyLXT4wNDn9SOaISXs/t9Bkrtx58/JKyDgqx.o4Bp1lG', '2016-02-25 11:45:21', '2016-02-25 11:45:21', '2016-02-25 11:45:21'),
(269, 1, 'modelTable', 5, 'edit', 'Name', 'pixelmodel1', 'pixelm1odel1', '$2y$10$nVfVGWp3aGEJs10YwcNrkeMhp1GAOuiinkdqLUeGdHg/UYbjHgHOC', '2016-02-25 11:46:58', '2016-02-25 11:46:58', '2016-02-25 11:46:58'),
(270, 1, 'modelTable', 5, 'edit', 'Seed Sites', '["abc.com", "abc1.com"]', 'null', '$2y$10$nVfVGWp3aGEJs10YwcNrkeMhp1GAOuiinkdqLUeGdHg/UYbjHgHOC', '2016-02-25 11:46:58', '2016-02-25 11:46:58', '2016-02-25 11:46:58'),
(271, 1, 'modelTable', 5, 'edit', 'Segment Name Seed', 'cnn visitors', 'cnn vis`itors', '$2y$10$nVfVGWp3aGEJs10YwcNrkeMhp1GAOuiinkdqLUeGdHg/UYbjHgHOC', '2016-02-25 11:46:58', '2016-02-25 11:46:58', '2016-02-25 11:46:58'),
(272, 1, 'modelTable', 5, 'edit', 'Negative Features Requested', '["fox.com", "fox1.com"]', 'null', '$2y$10$nVfVGWp3aGEJs10YwcNrkeMhp1GAOuiinkdqLUeGdHg/UYbjHgHOC', '2016-02-25 11:46:58', '2016-02-25 11:46:58', '2016-02-25 11:46:58'),
(273, 1, 'positive_offer_model', 1, 'add', '', '', '7', '$2y$10$cJT8oKj3Y7lSm4fu1f6t8.WBVZ34uNU5Nkg/1uGFYhVEF1qYHYpke', '2016-02-25 11:53:42', '2016-02-25 11:53:42', '2016-02-25 11:53:42'),
(274, 1, 'positive_offer_model', 3, 'add', '', '', '7', '$2y$10$cJT8oKj3Y7lSm4fu1f6t8.WBVZ34uNU5Nkg/1uGFYhVEF1qYHYpke', '2016-02-25 11:53:42', '2016-02-25 11:53:42', '2016-02-25 11:53:42'),
(275, 1, 'negative_offer_model', 5, 'add', '', '', '7', '$2y$10$cJT8oKj3Y7lSm4fu1f6t8.WBVZ34uNU5Nkg/1uGFYhVEF1qYHYpke', '2016-02-25 11:53:42', '2016-02-25 11:53:42', '2016-02-25 11:53:42'),
(276, 1, 'modelTable', 7, 'add', '', '', '', '$2y$10$cJT8oKj3Y7lSm4fu1f6t8.WBVZ34uNU5Nkg/1uGFYhVEF1qYHYpke', '2016-02-25 11:53:42', '2016-02-25 11:53:42', '2016-02-25 11:53:42'),
(278, 1, 'modelTable', 7, 'edit', 'Name', 'model test1', 'mode1l test1', '$2y$10$Ii0ujeF24xIqVm44Ai77OupRW.D9sk.N2Yg2Ev/jI6GxPO7ie9Ifm', '2016-02-25 12:11:15', '2016-02-25 12:11:15', '2016-02-25 12:11:15'),
(279, 1, 'modelTable', 7, 'edit', 'Segment Name Seed', 'asdasd', 'asda1sd', '$2y$10$Ii0ujeF24xIqVm44Ai77OupRW.D9sk.N2Yg2Ev/jI6GxPO7ie9Ifm', '2016-02-25 12:11:15', '2016-02-25 12:11:15', '2016-02-25 12:11:15'),
(280, 1, 'modelTable', 7, 'edit', 'Feature Recency In Sec', '234', '2342', '$2y$10$Ii0ujeF24xIqVm44Ai77OupRW.D9sk.N2Yg2Ev/jI6GxPO7ie9Ifm', '2016-02-25 12:11:15', '2016-02-25 12:11:15', '2016-02-25 12:11:15'),
(281, 1, 'bid_profile', 1, 'edit', 'Name', 'test 1 from sql', 'test 1 from1 sql', '$2y$10$rGqzjRmkhV1FIZ7ymKlNEeg7fitZAO2/ppbS9KpGLF5jtn8fqdXOy', '2016-02-25 12:15:47', '2016-02-25 12:15:48', '2016-02-25 12:15:48'),
(282, 1, 'bid_profile_entry', 11, 'add', '', '', '1', '$2y$10$nMw/IZ9U1Dken8KTMtAzeONPOMceDHHw/fCERKYmyIZdGD99ntlPi', '2016-02-25 12:33:24', '2016-02-25 12:33:24', '2016-02-25 12:33:24'),
(283, 1, 'campaign', 3, 'edit', 'Name', 'asdasd', 'dfsd', '$2y$10$f4GAH1MhxagrCB069Al8H.EgXf9c5drJASw3VHDrZNf6nD5M7NLv.', '2016-02-29 12:51:05', '2016-02-29 12:51:06', '2016-02-29 12:51:06'),
(284, 1, 'campaign', 3, 'edit', 'Domain Name', 'asdas.com', 'asdasd.com', '$2y$10$f4GAH1MhxagrCB069Al8H.EgXf9c5drJASw3VHDrZNf6nD5M7NLv.', '2016-02-29 12:51:05', '2016-02-29 12:51:06', '2016-02-29 12:51:06'),
(285, 1, 'campaign', 3, 'edit', 'End Date', '2016-02-18 16:41:21', '0', '$2y$10$f4GAH1MhxagrCB069Al8H.EgXf9c5drJASw3VHDrZNf6nD5M7NLv.', '2016-02-29 12:51:05', '2016-02-29 12:51:06', '2016-02-29 12:51:06'),
(286, 1, 'campaign', 3, 'edit', 'Name', 'dfsd', 'dfsd1', '$2y$10$UE9kGTUYFMkHZCjv2Q/g4.Q7SxYnVxXOkCcGaP/31cvGY3WI2beeq', '2016-02-29 12:58:59', '2016-02-29 12:58:59', '2016-02-29 12:58:59'),
(287, 1, 'campaign', 3, 'edit', 'Name', 'dfsd', 'dfsd1', '$2y$10$NNF02X4X2h4elmpcQoVHC.kC5B49FpMdP7gdBE03k5BLk0eTQOqy2', '2016-02-29 12:59:15', '2016-02-29 12:59:15', '2016-02-29 12:59:15'),
(288, 1, 'modelTable', 4, 'edit', 'Name', 'test111121s', 'te1st111121s', '$2y$10$5NJDk6D7jYABPCHHB7pjlebKtPlHfgMwudxTP4P2.jIy9T/W47dQC', '2016-02-29 13:01:45', '2016-02-29 13:01:45', '2016-02-29 13:01:45'),
(289, 1, 'modelTable', 4, 'edit', 'Algo', 'lakers', 'heat', '$2y$10$S1NvKawxoha9MSowrTWNdeSmu0k7R65K0bRvkh.XNgOO/DDtTY4lC', '2016-02-29 13:02:27', '2016-02-29 13:02:27', '2016-02-29 13:02:27'),
(290, 1, 'modelTable', 4, 'edit', 'Segment Name Seed', '2341122', '23141122', '$2y$10$S1NvKawxoha9MSowrTWNdeSmu0k7R65K0bRvkh.XNgOO/DDtTY4lC', '2016-02-29 13:02:27', '2016-02-29 13:02:27', '2016-02-29 13:02:27'),
(291, 1, 'modelTable', 4, 'edit', 'Feature Recency In Sec', '324112', '3241112', '$2y$10$S1NvKawxoha9MSowrTWNdeSmu0k7R65K0bRvkh.XNgOO/DDtTY4lC', '2016-02-29 13:02:27', '2016-02-29 13:02:27', '2016-02-29 13:02:27'),
(292, 1, 'modelTable', 4, 'edit', 'Cut Off Score', '52.00', '512.00', '$2y$10$S1NvKawxoha9MSowrTWNdeSmu0k7R65K0bRvkh.XNgOO/DDtTY4lC', '2016-02-29 13:02:27', '2016-02-29 13:02:27', '2016-02-29 13:02:27'),
(293, 1, 'campaign', 3, 'edit', 'Name', 'dfsd', 'dfsd1', '$2y$10$WHb8sZzUMVpCpx2.UncQ6efOx2OxO2A/kr2lRfSr1/1Uxa2o4kN5a', '2016-03-01 06:24:15', '2016-03-01 06:24:15', '2016-03-01 06:24:15'),
(294, 1, 'campaign', 3, 'edit', 'Start Date', '2016-02-17 16:41:21', '0', '$2y$10$bM9xIIqTQ88/1sFZkmRjGewDB5pRKEc8cJvGALABboHECGGsPz7Fa', '2016-03-01 08:17:09', '2016-03-01 08:17:09', '2016-03-01 08:17:09'),
(295, 1, 'campaign', 3, 'edit', 'End Date', '2016-02-23 07:22:21', '0', '$2y$10$bM9xIIqTQ88/1sFZkmRjGewDB5pRKEc8cJvGALABboHECGGsPz7Fa', '2016-03-01 08:17:09', '2016-03-01 08:17:09', '2016-03-01 08:17:09'),
(296, 1, 'campaign', 3, 'edit', 'Start Date', '0000-00-00 00:00:00', '0', '$2y$10$iVFte8G/aso7LKvJ9gjPVOF5mJcIIcY3ryyyygAiSH0OzYJYXemtm', '2016-03-01 08:19:04', '2016-03-01 08:19:04', '2016-03-01 08:19:04'),
(297, 1, 'campaign', 3, 'edit', 'End Date', '0000-00-00 00:00:00', '0', '$2y$10$iVFte8G/aso7LKvJ9gjPVOF5mJcIIcY3ryyyygAiSH0OzYJYXemtm', '2016-03-01 08:19:04', '2016-03-01 08:19:04', '2016-03-01 08:19:04'),
(298, 1, 'targetgroup', 20, 'edit', 'Ad Position', '["Above_the_Fold","Below_the_Fold"]', 'null', '$2y$10$/AxWsmo9xVKrzhdJ9nEG7e3V/rtkBGA.t//2CqEAfQaHjytWaH71m', '2016-03-02 11:52:43', '2016-03-02 11:52:43', '2016-03-02 11:52:43'),
(299, 1, 'targetgroup', 20, 'edit', 'Start Date', '2016-01-02 15:20:12', '0', '$2y$10$/AxWsmo9xVKrzhdJ9nEG7e3V/rtkBGA.t//2CqEAfQaHjytWaH71m', '2016-03-02 11:52:43', '2016-03-02 11:52:43', '2016-03-02 11:52:43'),
(300, 1, 'targetgroup', 20, 'edit', 'End Date', '2018-05-02 15:20:12', '0', '$2y$10$/AxWsmo9xVKrzhdJ9nEG7e3V/rtkBGA.t//2CqEAfQaHjytWaH71m', '2016-03-02 11:52:43', '2016-03-02 11:52:43', '2016-03-02 11:52:43'),
(301, 1, 'targetgroup_bwlist_map', 0, 'del', '', '', '20', '$2y$10$/AxWsmo9xVKrzhdJ9nEG7e3V/rtkBGA.t//2CqEAfQaHjytWaH71m', '2016-03-02 11:52:43', '2016-03-02 11:52:43', '2016-03-02 11:52:43'),
(302, 1, 'targetgroup', 20, 'edit', 'Start Date', '0000-00-00 00:00:00', '0', '$2y$10$96BrYZTJ4Ni2k6NA.HiDZexkuE47opICw6ltGQFV1ta9.r28twWVK', '2016-03-02 11:53:06', '2016-03-02 11:53:06', '2016-03-02 11:53:06'),
(303, 1, 'targetgroup', 20, 'edit', 'End Date', '0000-00-00 00:00:00', '0', '$2y$10$96BrYZTJ4Ni2k6NA.HiDZexkuE47opICw6ltGQFV1ta9.r28twWVK', '2016-03-02 11:53:06', '2016-03-02 11:53:06', '2016-03-02 11:53:06'),
(304, 1, 'targetgroup', 20, 'edit', 'Start Date', '0000-00-00 00:00:00', '0', '$2y$10$8U5kFm9G0surEGEg/KmwSuYuWJFNzWJ7Ln62k1JX70PJZyc/X7lXm', '2016-03-02 12:00:18', '2016-03-02 12:00:18', '2016-03-02 12:00:18'),
(305, 1, 'targetgroup', 20, 'edit', 'End Date', '0000-00-00 00:00:00', '0', '$2y$10$8U5kFm9G0surEGEg/KmwSuYuWJFNzWJ7Ln62k1JX70PJZyc/X7lXm', '2016-03-02 12:00:18', '2016-03-02 12:00:18', '2016-03-02 12:00:18'),
(306, 1, 'geosegment', 17, 'edit', 'Name', 'test Upload', 'test Upload1', '$2y$10$MnQh3RY1PRbDtXLFOSv9QeRoB2UJnqYQzkYQclIwJt5.z2IrX.Pl2', '2016-03-02 13:03:32', '2016-03-02 13:03:32', '2016-03-02 13:03:32'),
(307, 1, 'geosegment', 17, 'edit', 'Status', '', 'Inactive', '$2y$10$MnQh3RY1PRbDtXLFOSv9QeRoB2UJnqYQzkYQclIwJt5.z2IrX.Pl2', '2016-03-02 13:03:32', '2016-03-02 13:03:32', '2016-03-02 13:03:32'),
(308, 1, 'campaign', 3, 'edit', 'Start Date', '0000-00-00 00:00:00', '0', '$2y$10$REheO09O3kDwWMMyi1o5Fuzx9e5WPRbCNVDnSI1YELEG9bcIVScLu', '2016-03-06 10:06:03', '2016-03-06 10:06:03', '2016-03-06 10:06:03'),
(309, 1, 'campaign', 3, 'edit', 'End Date', '0000-00-00 00:00:00', '0', '$2y$10$REheO09O3kDwWMMyi1o5Fuzx9e5WPRbCNVDnSI1YELEG9bcIVScLu', '2016-03-06 10:06:03', '2016-03-06 10:06:03', '2016-03-06 10:06:03'),
(310, 1, 'campaign', 3, 'edit', 'Start Date', '0000-00-00 00:00:00', '0', '$2y$10$IOPvfudkgmvKt7J0YmOShuhImbPEfj3ywxz3R7zBUEUlE05Q5TT6G', '2016-03-06 10:06:21', '2016-03-06 10:06:21', '2016-03-06 10:06:21'),
(311, 1, 'campaign', 3, 'edit', 'End Date', '0000-00-00 00:00:00', '0', '$2y$10$IOPvfudkgmvKt7J0YmOShuhImbPEfj3ywxz3R7zBUEUlE05Q5TT6G', '2016-03-06 10:06:21', '2016-03-06 10:06:21', '2016-03-06 10:06:21'),
(312, 1, 'campaign', 3, 'edit', 'Start Date', '0000-00-00 00:00:00', '0', '$2y$10$8cMyE5EpIDg0uPlDzxvgc.CaNigFbVSCo8h9AB/dhBYgEOhcVSDWa', '2016-03-06 10:06:28', '2016-03-06 10:06:28', '2016-03-06 10:06:28'),
(313, 1, 'campaign', 3, 'edit', 'End Date', '0000-00-00 00:00:00', '0', '$2y$10$8cMyE5EpIDg0uPlDzxvgc.CaNigFbVSCo8h9AB/dhBYgEOhcVSDWa', '2016-03-06 10:06:28', '2016-03-06 10:06:28', '2016-03-06 10:06:28'),
(314, 1, 'campaign', 3, 'edit', 'Start Date', '0000-00-00 00:00:00', '0', '$2y$10$sB0aNRF/9BfHhhxxy.D4FebEVyzanBbA9eLYj63lS3IscPFrAOru6', '2016-03-06 10:06:38', '2016-03-06 10:06:38', '2016-03-06 10:06:38'),
(315, 1, 'campaign', 3, 'edit', 'End Date', '0000-00-00 00:00:00', '0', '$2y$10$sB0aNRF/9BfHhhxxy.D4FebEVyzanBbA9eLYj63lS3IscPFrAOru6', '2016-03-06 10:06:38', '2016-03-06 10:06:38', '2016-03-06 10:06:38'),
(316, 1, 'campaign', 3, 'edit', 'status', 'Active', 'Inactive', '$2y$10$Bp.46HQtFIYWLn/.0EGACuXPNej.KA/SqHgGC7uEaKLeW55RXy7b.', '2016-03-06 10:09:11', '2016-03-06 10:09:11', '2016-03-06 10:09:11'),
(317, 1, 'campaign', 3, 'edit', 'status', 'Inactive', 'Active', '$2y$10$SKhYaG2VuzkXcPt9G7nNJeezoed/byr/ZP1BeDBR8YxP3yiP0OCtC', '2016-03-06 10:09:18', '2016-03-06 10:09:18', '2016-03-06 10:09:18'),
(318, 1, 'campaign', 4, 'edit', 'status', 'Inactive', 'Active', '$2y$10$.X60SQDy2JPGHPCjUIYdpe7esaByHq3YsLYTQLGChaBz3OuE7czoG', '2016-03-06 10:09:22', '2016-03-06 10:09:22', '2016-03-06 10:09:22'),
(319, 1, 'campaign', 7, 'edit', 'status', 'Active', 'Inactive', '$2y$10$Epaa3NK.8z.GYQ/FgdXZ2O2N9oUzU6zoFk53UtbXIf/RhJZUilU9y', '2016-03-06 10:09:33', '2016-03-06 10:09:33', '2016-03-06 10:09:33'),
(320, 1, 'campaign', 5, 'edit', 'status', 'Active', 'Inactive', '$2y$10$0/KJLi2gEXs3VUoOXmVSYujHS9S.q53/GmlhC29F57Mw2tD9RFEhi', '2016-03-06 10:09:41', '2016-03-06 10:09:41', '2016-03-06 10:09:41'),
(321, 1, 'campaign', 5, 'edit', 'status', 'Inactive', 'Active', '$2y$10$EEp1DsMPmoV6sLGtoY0f8OexsnrHM4ArEF7iCp2/x85swiH.8zjPi', '2016-03-06 10:09:43', '2016-03-06 10:09:43', '2016-03-06 10:09:43'),
(322, 1, 'client', 1, 'edit', 'status', 'Active', 'Inactive', '$2y$10$4BUmWFTVTheb/7d61q31SuBulBf2RsVLo2sNYlKF0YYFRH7fafxru', '2016-03-06 15:05:49', '2016-03-06 15:05:49', '2016-03-06 15:05:49'),
(323, 1, 'client', 52, 'edit', 'status', 'Inactive', 'Active', '$2y$10$NTIpQ0Z5S1s.vp9/6oZ0m.svpu2CR92KCUdhOtYz9HIYAX8S8f0ma', '2016-03-06 15:07:40', '2016-03-06 15:07:40', '2016-03-06 15:07:40'),
(324, 1, 'client', 52, 'edit', 'status', 'Active', 'Inactive', '$2y$10$mCLwrAAQUKjuBU4W4jQ4Ve/538CVz87bPuyeUFUOTcm2wDZPeqOCe', '2016-03-06 15:07:42', '2016-03-06 15:07:42', '2016-03-06 15:07:42');

-- --------------------------------------------------------

--
-- Table structure for table `bid_profile`
--

CREATE TABLE IF NOT EXISTS `bid_profile` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `advertiser_id` int(10) unsigned NOT NULL,
  `status` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bid_profile`
--

INSERT INTO `bid_profile` (`id`, `name`, `advertiser_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'test 1 from1 sql', 4, 'Active', '0000-00-00 00:00:00', '2016-02-25 12:15:47'),
(2, 'sdaasd1', 2, 'Active', '2016-02-18 09:29:56', '2016-02-18 09:42:18'),
(3, 'ewrtwerwe', 2, 'Inactive', '2016-02-18 09:35:31', '2016-02-18 09:35:31'),
(4, 'dfdd', 2, 'Active', '2016-02-19 10:29:26', '2016-02-19 10:29:26');

-- --------------------------------------------------------

--
-- Table structure for table `bid_profile_entry`
--

CREATE TABLE IF NOT EXISTS `bid_profile_entry` (
  `id` int(10) unsigned NOT NULL,
  `domain` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `bid_strategy` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `bid_value` decimal(8,2) NOT NULL,
  `status` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `bid_profile_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bid_profile_entry`
--

INSERT INTO `bid_profile_entry` (`id`, `domain`, `bid_strategy`, `bid_value`, `status`, `bid_profile_id`, `created_at`, `updated_at`) VALUES
(1, 'asdasd.com', 'Absolute', '5.00', '', 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'sdds.com', 'Absolute', '3.00', '', 1, '2016-02-18 18:16:57', '2016-02-18 18:35:04'),
(4, 'sadasd.com', 'Percentage', '23.00', '', 1, '2016-02-19 10:00:41', '2016-02-19 10:00:41'),
(5, 'abc.com', 'Absolute', '6.12', '', 4, '2016-02-19 10:29:26', '2016-02-19 10:29:26'),
(6, 'add.com', 'Absolute', '2.23', '', 4, '2016-02-19 10:29:26', '2016-02-19 10:29:26'),
(7, 'sdsd.com', 'Percentage', '32.65', '', 4, '2016-02-19 10:29:26', '2016-02-19 10:29:26'),
(8, 'sdsad.com', 'Absolute', '6.12', '', 4, '2016-02-19 10:29:26', '2016-02-19 10:29:26'),
(9, 'sddd.com', 'Percentage', '68.21', '', 4, '2016-02-19 10:29:26', '2016-02-19 10:29:26'),
(10, 'asdasd.com', 'Percentage', '23.00', '', 1, '2016-02-21 12:25:44', '2016-02-21 12:25:44'),
(11, 'asadas.com', 'Percentage', '23.00', '', 1, '2016-02-25 12:33:24', '2016-02-25 12:33:24');

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
) ENGINE=InnoDB AUTO_INCREMENT=175 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bwentries`
--

INSERT INTO `bwentries` (`id`, `domain_name`, `bwlist_id`, `created_at`, `updated_at`) VALUES
(2, 'ssss', 2, '2015-11-20 12:38:15', '2015-11-20 12:38:15'),
(3, 'dddd', 2, '2015-11-20 12:38:15', '2015-11-20 12:38:15'),
(4, 'ffff', 2, '2015-11-20 12:38:15', '2015-11-20 12:38:15'),
(5, 'gggg', 2, '2015-11-20 12:38:15', '2015-11-20 12:38:15'),
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
(149, 'asdaasdasd123123s3123s.com', 17, '2015-12-15 07:21:18', '2016-01-27 12:39:34'),
(150, 'kasjd.com', 19, '2016-01-18 15:25:21', '2016-01-18 15:25:21'),
(151, 'asdasd.com', 19, '2016-01-18 15:25:21', '2016-01-18 15:25:21'),
(152, 'aasdewq.com', 19, '2016-01-18 15:25:21', '2016-01-18 15:25:21'),
(153, 'asdwqeqwe.com', 19, '2016-01-18 15:25:21', '2016-01-18 15:25:21'),
(154, 'asdas.com', 19, '2016-01-18 17:43:37', '2016-01-18 17:43:37'),
(155, 'as1dasd.com', 17, '2016-01-27 12:41:17', '2016-01-27 13:19:21'),
(156, 'asdasd.com', 17, '2016-01-27 13:19:27', '2016-01-27 13:19:27'),
(157, 'asdsadasd.com', 17, '2016-01-27 13:20:40', '2016-01-27 13:20:40'),
(158, 'sadsss.com', 17, '2016-01-27 13:21:42', '2016-01-27 13:21:42'),
(159, 'asdasdasdas.com', 17, '2016-01-27 13:23:56', '2016-01-27 13:23:56'),
(160, 'ab1c.com', 20, '2016-02-04 10:49:27', '2016-02-04 10:49:39'),
(161, 'abc1.com', 20, '2016-02-04 10:49:27', '2016-02-04 10:49:27'),
(162, 'all.com', 20, '2016-02-04 10:50:09', '2016-02-04 10:50:09'),
(163, 'abcw.com', 21, '2016-02-04 10:50:37', '2016-02-04 10:50:37'),
(164, 'abcwq2.com', 21, '2016-02-04 10:50:37', '2016-02-04 10:50:37'),
(165, 'asdas.com', 22, '2016-02-04 11:05:11', '2016-02-04 11:05:11'),
(166, 'asdasd.com', 22, '2016-02-04 11:05:11', '2016-02-04 11:05:11'),
(167, 'ttee.com', 22, '2016-02-04 11:05:11', '2016-02-04 11:05:11'),
(168, 'yutei.com', 23, '2016-02-04 11:05:35', '2016-02-04 11:05:35'),
(169, 'sydtgjas.ir', 23, '2016-02-04 11:05:35', '2016-02-04 11:05:35'),
(170, 'asdgkajd.org', 23, '2016-02-04 11:05:35', '2016-02-04 11:05:35'),
(171, 'cnn.com', 24, '2016-02-04 11:20:01', '2016-02-04 11:20:01'),
(172, 'fff.com', 24, '2016-02-04 11:20:01', '2016-02-04 11:20:01'),
(173, 'ddd.com', 24, '2016-02-04 11:20:01', '2016-02-04 11:20:01'),
(174, 'asdasd.com', 19, '2016-02-13 11:23:52', '2016-02-13 11:23:52');

-- --------------------------------------------------------

--
-- Table structure for table `bwlist`
--

CREATE TABLE IF NOT EXISTS `bwlist` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `list_type` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `advertiser_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bwlist`
--

INSERT INTO `bwlist` (`id`, `name`, `status`, `list_type`, `advertiser_id`, `created_at`, `updated_at`) VALUES
(1, 'qweqwe', 'Inactive', 'black', 4, '2015-11-20 12:37:03', '2016-02-10 13:21:52'),
(2, 'sdafasdf', 'Inactive', 'black', 4, '2015-11-20 12:38:15', '2016-02-13 12:15:37'),
(3, 'ewrtwerwe', 'Active', '', 4, '2015-11-20 12:43:21', '2016-02-18 09:36:46'),
(5, 'aa', 'Inactive', 'black', 8, '2015-11-20 12:54:09', '2016-02-13 12:55:30'),
(6, 'aa', 'Active', 'black', 8, '2015-11-20 12:54:17', '2015-11-20 12:54:17'),
(7, 'aa', 'Active', 'white', 8, '2015-11-20 12:56:12', '2015-11-20 12:56:12'),
(8, 'ali', 'Active', 'white', 8, '2015-11-21 13:12:34', '2015-11-21 13:12:34'),
(17, 'alireza2', 'Active', 'white', 8, '2015-11-28 13:13:17', '2016-01-26 11:08:33'),
(18, 'alio1', 'Inactive', 'black', 9, '2015-12-05 12:29:45', '2016-01-30 12:33:04'),
(19, 'reza', 'Active', 'black', 6, '2016-01-18 15:25:21', '2016-01-26 11:08:31'),
(20, 'bwlist 1 abc', 'Inactive', 'black', 14, '2016-02-04 10:49:27', '2016-02-04 10:52:07'),
(21, 'bwlist 1 abc w', 'Active', 'white', 14, '2016-02-04 10:50:37', '2016-02-04 10:52:08'),
(22, 'bwlist 3 abc', 'Active', 'black', 13, '2016-02-04 11:05:11', '2016-02-04 11:05:11'),
(23, 'bwlist 4 abc', 'Active', 'white', 13, '2016-02-04 11:05:35', '2016-02-04 11:05:35'),
(24, 'alireza', 'Inactive', 'black', 13, '2016-02-04 11:20:01', '2016-02-04 11:20:01');

-- --------------------------------------------------------

--
-- Table structure for table `campaign`
--

CREATE TABLE IF NOT EXISTS `campaign` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `advertiser_id` int(10) unsigned NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Inactive',
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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `campaign`
--

INSERT INTO `campaign` (`id`, `name`, `advertiser_id`, `description`, `status`, `max_impression`, `daily_max_impression`, `max_budget`, `daily_max_budget`, `cpm`, `advertiser_domain`, `start_date`, `end_date`, `advertiser_domain_name`, `created_at`, `updated_at`) VALUES
(3, 'dfsd1', 4, 'asdass', 'Active', 23, 23421, 123, 213, 2341, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'asdasd.com', '2015-10-14 11:38:02', '2016-03-06 10:09:18'),
(4, 'asdd', 4, 'asd asd a', 'Active', 2332, 2323, 2222, 2222, 222, '', '2016-01-06 08:14:25', '2016-01-14 08:14:25', 'asd.com', '2015-10-23 10:07:43', '2016-03-06 10:09:22'),
(5, 'asdd1', 6, 'asdasd3', 'Active', 2223123, 2223123, 2223123, 223123, 22332, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'asd.com', '2015-11-07 13:02:52', '2016-03-06 10:09:43'),
(6, 'asdasd', 4, '', 'Active', 23, 2147483647, 123, 213, 2147483647, '', '2016-01-18 12:32:38', '2016-01-30 12:32:38', 'asdas.com', '2015-11-17 07:42:08', '2016-02-23 13:21:34'),
(7, 'asd', 8, '', 'Inactive', 123, 123, 123, 123, 123, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '123', '2015-11-17 09:31:34', '2016-03-06 10:09:33'),
(9, 'asd asd', 9, '', 'Active', 0, 0, 0, 0, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'as das ', '2015-11-17 12:38:53', '2015-11-17 12:38:53'),
(10, 'CMP_1_bing', 12, '2222', '', 1, 2, 3, 4, 5, '', '2016-02-02 11:46:19', '2016-02-18 11:46:19', 'bing.com', '2016-02-02 11:13:38', '2016-02-02 11:13:38'),
(12, 'camp 1 abc1', 13, '', 'Inactive', 19, 29, 39, 49, 59, '', '2016-02-05 10:18:31', '2016-02-29 10:18:31', 'cmpab1c.com', '2016-02-04 10:17:34', '2016-02-04 10:18:31'),
(13, 'camp3', 4, 'asdass', 'Active', 131231, 23421, 342311, 42341, 2341, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'asd.com', '2016-02-21 13:02:24', '2016-02-21 13:02:24');

-- --------------------------------------------------------

--
-- Table structure for table `campaign_realtime_info`
--

CREATE TABLE IF NOT EXISTS `campaign_realtime_info` (
  `id` int(10) unsigned NOT NULL,
  `campaign_id` int(10) unsigned NOT NULL,
  `today_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `impressions_shown_today_until_now` int(11) NOT NULL,
  `total_impression_show_until_now` int(11) NOT NULL,
  `daily_budget_spent_today_until_now` decimal(8,2) NOT NULL,
  `total_budget_spent_until_now` decimal(8,2) NOT NULL,
  `last_time_ad_shown` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `campaign_realtime_info`
--

INSERT INTO `campaign_realtime_info` (`id`, `campaign_id`, `today_date`, `impressions_shown_today_until_now`, `total_impression_show_until_now`, `daily_budget_spent_today_until_now`, `total_budget_spent_until_now`, `last_time_ad_shown`, `created_at`, `updated_at`) VALUES
(1, 3, '', 12, 32, '654.20', '123.22', '2016-02-08 01:46:22', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE IF NOT EXISTS `client` (
  `id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `company` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id`, `user_id`, `name`, `status`, `company`, `created_at`, `updated_at`) VALUES
(1, 1, 'pepsiasd123511', 'Inactive', 'pepsi company', '0000-00-00 00:00:00', '2016-03-06 15:05:49'),
(2, 1, 'cocacola', 'Active', 'cocacola company', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 7, 'alireza_pepsi', 'Active', 'aaa', '2015-10-08 11:47:15', '2015-10-08 11:47:15'),
(4, 3, 'cln4', 'Active', 'ssss', '2015-10-08 11:50:08', '2016-02-02 08:57:38'),
(19, 8, 'client_bing', 'Active', '', '2016-02-02 10:54:33', '2016-02-02 10:54:33'),
(27, 10, 'clientTestAmir2016JanuaryTest', 'Active', '', '2016-02-04 09:54:10', '2016-02-04 09:54:10'),
(47, 1, 'sadas', 'Active', '', '2016-02-18 12:03:22', '2016-02-18 12:03:22'),
(48, 1, 'sdas', 'Active', '', '2016-02-18 12:07:31', '2016-02-18 12:07:31'),
(49, 1, 'sdas12', 'Active', '', '2016-02-18 12:07:31', '2016-02-18 12:07:31'),
(50, 1, 'sss', '', '', '2016-03-06 13:50:54', '2016-03-06 13:50:54'),
(51, 1, 'asda', 'Inactive', '', '2016-03-06 15:07:23', '2016-03-06 15:07:23'),
(52, 1, '1111', 'Inactive', '', '2016-03-06 15:07:35', '2016-03-06 15:07:42');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE IF NOT EXISTS `company` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Google', '0000-00-00 00:00:00', '2016-02-04 07:59:23'),
(2, 'Apple', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Bing', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'ABC', '2016-02-04 09:49:00', '2016-02-04 09:49:00');

-- --------------------------------------------------------

--
-- Table structure for table `creative`
--

CREATE TABLE IF NOT EXISTS `creative` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `advertiser_id` int(10) unsigned NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Inactive',
  `ad_tag` text COLLATE utf8_unicode_ci NOT NULL,
  `api` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `ad_type` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `landing_page_url` text COLLATE utf8_unicode_ci NOT NULL,
  `preview_url` text COLLATE utf8_unicode_ci NOT NULL,
  `size` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `is_secure` tinyint(1) NOT NULL,
  `attributes` text COLLATE utf8_unicode_ci NOT NULL,
  `advertiser_domain_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `creative`
--

INSERT INTO `creative` (`id`, `name`, `advertiser_id`, `description`, `status`, `ad_tag`, `api`, `ad_type`, `landing_page_url`, `preview_url`, `size`, `is_secure`, `attributes`, `advertiser_domain_name`, `created_at`, `updated_at`) VALUES
(2, 'ali', 8, 'asdas', 'Active', 'asdasd', '["MRAID-1","ORMMA"]', 'XHTML_BANNER_AD', 'dasda', 'adsa1', '231x2321', 0, 'asd1s', 'aaaa1s.com', '2015-11-17 10:07:22', '2016-02-23 13:22:22'),
(5, 'sadasd', 4, '12311', 'Active', 'asdasd', '', '', 'dasda', '1231234', '1231x231', 0, '1231234', '1231', '2015-10-23 06:15:09', '2016-02-18 17:12:23'),
(7, 'sadasd', 12, 'as da', '', 'asdasd', '', '', 'dasda', ' asd as asd', '23x23', 0, 'asdasd', 'bingCrt.com', '2016-02-02 12:03:42', '2016-02-18 17:12:23'),
(8, 'crt 1 abc1', 13, '', 'Inactive', 'jdfg aksjgsjasjkasjasklj  f f f f', '', '', 'sdfas dfs1', 'dsfsd9', '2399x239', 0, 'zsdf9', 'crtab1.com', '2016-02-04 10:24:09', '2016-02-04 10:27:17'),
(9, 'ali', 8, 'asdas', 'Active', '                                                                asdasd', '["MRAID-1","ORMMA"]', 'XHTML_BANNER_AD', 'dasda', 'adsa1', '231x2321', 0, 'asd1s', 'aaaa1s.com', '2016-02-21 12:58:09', '2016-02-23 13:22:22'),
(10, 'sadasd', 8, 'asdas', 'Active', '                                                                asdasd', '["MRAID-1","ORMMA"]', 'XHTML_BANNER_AD', 'dasda', 'adsa1', '231x2321', 0, 'asd1s', 'aaaa1s.com', '2016-02-21 12:58:33', '2016-02-21 12:58:33'),
(19, 'ali', 2, '', 'Active', 'Absolute', '[MRAID-1,ORMMA]', 'XHTML_BANNER_AD', 'asd gdsfg sdf', 'safgasgdf', '25x65', 0, 'fasd', 'asdasssd.com', '2016-02-21 15:46:40', '2016-02-23 13:22:22'),
(20, 'ali', 2, '', 'Active', 'Percentage', '[MRAID-1,ORMMA]', 'XHTML_BANNER_AD', 'dsfgstertg', 'dsgg', '452x321', 0, 'hdfh', 'asdarwer.com', '2016-02-21 15:46:40', '2016-02-23 13:22:22');

-- --------------------------------------------------------

--
-- Table structure for table `geolocation`
--

CREATE TABLE IF NOT EXISTS `geolocation` (
  `id` int(10) unsigned NOT NULL,
  `country` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `state` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `geolocation`
--

INSERT INTO `geolocation` (`id`, `country`, `code`, `state`, `city`, `created_at`, `updated_at`) VALUES
(1, 'United States', 'AL', 'Alabama', '', '2016-01-20 18:37:51', '2016-01-20 18:37:51'),
(2, 'United States', 'AK', 'Alaska', '', '2016-01-20 18:37:51', '2016-01-20 18:37:51'),
(3, 'United States', 'AS', 'American Samoa', '', '2016-01-20 18:37:51', '2016-01-20 18:37:51'),
(4, 'United States', 'AZ', 'Arizona', '', '2016-01-20 18:37:51', '2016-01-20 18:37:51'),
(5, 'United States', 'AR', 'Arkansas', '', '2016-01-20 18:37:51', '2016-01-20 18:37:51'),
(6, 'United States', 'CA', 'California', '', '2016-01-20 18:37:51', '2016-01-20 18:37:51'),
(7, 'United States', 'CO', 'Colorado', '', '2016-01-20 18:37:51', '2016-01-20 18:37:51'),
(8, 'United States', 'CT', 'Connecticut', '', '2016-01-20 18:37:51', '2016-01-20 18:37:51'),
(9, 'United States', 'DE', 'Delaware', '', '2016-01-20 18:37:51', '2016-01-20 18:37:51'),
(10, 'United States', 'DC', 'District of Columbia', '', '2016-01-20 18:37:51', '2016-01-20 18:37:51'),
(11, 'United States', 'FM', 'Federated States of Micronesia', '', '2016-01-20 18:37:51', '2016-01-20 18:37:51'),
(12, 'United States', 'FL', 'Florida', '', '2016-01-20 18:37:51', '2016-01-20 18:37:51'),
(13, 'United States', 'GA', 'Georgia', '', '2016-01-20 18:37:51', '2016-01-20 18:37:51'),
(14, 'United States', 'GU', 'Guam', '', '2016-01-20 18:37:51', '2016-01-20 18:37:51'),
(15, 'United States', 'HI', 'Hawaii', '', '2016-01-20 18:37:51', '2016-01-20 18:37:51'),
(16, 'United States', 'ID', 'Idaho', '', '2016-01-20 18:37:51', '2016-01-20 18:37:51'),
(17, 'United States', 'IL', 'Illinois', '', '2016-01-20 18:37:51', '2016-01-20 18:37:51'),
(18, 'United States', 'IN', 'Indiana', '', '2016-01-20 18:37:51', '2016-01-20 18:37:51'),
(19, 'United States', 'IA', 'Iowa', '', '2016-01-20 18:37:51', '2016-01-20 18:37:51'),
(20, 'United States', 'KS', 'Kansas', '', '2016-01-20 18:37:51', '2016-01-20 18:37:51'),
(21, 'United States', 'KY', 'Kentucky', '', '2016-01-20 18:37:51', '2016-01-20 18:37:51'),
(22, 'United States', 'LA', 'Louisiana', '', '2016-01-20 18:37:51', '2016-01-20 18:37:51'),
(23, 'United States', 'ME', 'Maine', '', '2016-01-20 18:37:51', '2016-01-20 18:37:51'),
(24, 'United States', 'MH', 'Marshall Islands', '', '2016-01-20 18:37:51', '2016-01-20 18:37:51'),
(25, 'United States', 'MD', 'Maryland', '', '2016-01-20 18:37:51', '2016-01-20 18:37:51'),
(26, 'United States', 'MA', 'Massachusetts', '', '2016-01-20 18:37:51', '2016-01-20 18:37:51'),
(27, 'United States', 'MI', 'Michigan', '', '2016-01-20 18:37:51', '2016-01-20 18:37:51'),
(28, 'United States', 'MN', 'Minnesota', '', '2016-01-20 18:37:51', '2016-01-20 18:37:51'),
(29, 'United States', 'MS', 'Mississippi', '', '2016-01-20 18:37:51', '2016-01-20 18:37:51'),
(30, 'United States', 'MO', 'Missouri', '', '2016-01-20 18:37:51', '2016-01-20 18:37:51'),
(31, 'United States', 'MT', 'Montana', '', '2016-01-20 18:37:51', '2016-01-20 18:37:51'),
(32, 'United States', 'NE', 'Nebraska', '', '2016-01-20 18:37:51', '2016-01-20 18:37:51'),
(33, 'United States', 'NV', 'Nevada', '', '2016-01-20 18:37:51', '2016-01-20 18:37:51'),
(34, 'United States', 'NH', 'New Hampshire', '', '2016-01-20 18:37:51', '2016-01-20 18:37:51'),
(35, 'United States', 'NJ', 'New Jersey', '', '2016-01-20 18:37:51', '2016-01-20 18:37:51'),
(36, 'United States', 'NM', 'New Mexico', '', '2016-01-20 18:37:51', '2016-01-20 18:37:51'),
(37, 'United States', 'NY', 'New York', '', '2016-01-20 18:37:51', '2016-01-20 18:37:51'),
(38, 'United States', 'NC', 'North Carolina', '', '2016-01-20 18:37:51', '2016-01-20 18:37:51'),
(39, 'United States', 'ND', 'North Dakota', '', '2016-01-20 18:37:51', '2016-01-20 18:37:51'),
(40, 'United States', 'MP', 'Northern Mariana Islands', '', '2016-01-20 18:37:51', '2016-01-20 18:37:51'),
(41, 'United States', 'OH', 'Ohio', '', '2016-01-20 18:37:51', '2016-01-20 18:37:51'),
(42, 'United States', 'OK', 'Oklahoma', '', '2016-01-20 18:37:51', '2016-01-20 18:37:51'),
(43, 'United States', 'OR', 'Oregon', '', '2016-01-20 18:37:51', '2016-01-20 18:37:51'),
(44, 'United States', 'PW', 'Palau', '', '2016-01-20 18:37:51', '2016-01-20 18:37:51'),
(45, 'United States', 'PA', 'Pennsylvania', '', '2016-01-20 18:37:51', '2016-01-20 18:37:51'),
(46, 'United States', 'PR', 'Puerto Rico', '', '2016-01-20 18:37:51', '2016-01-20 18:37:51'),
(47, 'United States', 'RI', 'Rhode Island', '', '2016-01-20 18:37:51', '2016-01-20 18:37:51'),
(48, 'United States', 'SC', 'South Carolina', '', '2016-01-20 18:37:51', '2016-01-20 18:37:51'),
(49, 'United States', 'SD', 'South Dakota', '', '2016-01-20 18:37:51', '2016-01-20 18:37:51'),
(50, 'United States', 'TN', 'Tennessee', '', '2016-01-20 18:37:51', '2016-01-20 18:37:51'),
(51, 'United States', 'TX', 'Texas', '', '2016-01-20 18:37:51', '2016-01-20 18:37:51'),
(52, 'United States', 'UT', 'Utah', '', '2016-01-20 18:37:51', '2016-01-20 18:37:51'),
(53, 'United States', 'VT', 'Vermont', '', '2016-01-20 18:37:51', '2016-01-20 18:37:51'),
(54, 'United States', 'VI', 'Virgin Islands', '', '2016-01-20 18:37:51', '2016-01-20 18:37:51'),
(55, 'United States', 'VA', 'Virginia', '', '2016-01-20 18:37:51', '2016-01-20 18:37:51'),
(56, 'United States', 'WA', 'Washington', '', '2016-01-20 18:37:51', '2016-01-20 18:37:51'),
(57, 'United States', 'WV', 'West Virginia', '', '2016-01-20 18:37:51', '2016-01-20 18:37:51'),
(58, 'United States', 'WI', 'Wisconsin', '', '2016-01-20 18:37:51', '2016-01-20 18:37:51'),
(59, 'United States', 'WY', 'Wyoming', '', '2016-01-20 18:37:51', '2016-01-20 18:37:51');

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
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `geosegment`
--

INSERT INTO `geosegment` (`id`, `name`, `lat`, `lon`, `segment_radius`, `geosegmentlist_id`, `created_at`, `updated_at`) VALUES
(22, 'alasdghakj', '23', '213', 0, 12, '2015-12-05 13:57:05', '2015-12-05 13:57:05'),
(23, 'hasdgkjag', '213', '32', 0, 12, '2015-12-05 13:57:05', '2015-12-05 13:57:05'),
(24, 'adf', '123', '21', 0, 12, '2015-12-05 13:57:05', '2015-12-05 13:57:05'),
(28, 'ali232', '213', '23', 2, 12, '2015-12-27 15:46:52', '2015-12-27 15:46:52'),
(29, 'asd', '324', '234', 234, 13, '2016-01-18 14:21:49', '2016-01-18 14:21:49'),
(30, 'asdf', '324', '234', 34, 13, '2016-01-18 14:21:49', '2016-01-18 14:21:49'),
(31, 'asd', '324', '324', 32, 13, '2016-01-18 14:21:49', '2016-01-18 14:21:49'),
(40, 'sad', '231', '12', 313, 14, '2016-01-18 16:25:08', '2016-01-18 16:25:08'),
(41, 'asdasd', '21312', '312', 31, 14, '2016-01-18 17:16:50', '2016-01-18 17:16:50'),
(42, 'gsme1 abc', '12', '13', 12, 15, '2016-02-04 10:54:08', '2016-02-04 10:54:08'),
(43, 'sada sdasd', '32', '34', 1, 15, '2016-02-04 10:54:17', '2016-02-04 10:54:17'),
(44, 'asdas', '34', '34', 34, 16, '2016-02-04 11:06:04', '2016-02-04 11:06:04'),
(45, 'asdasd', '4', '3', 4, 16, '2016-02-04 11:06:04', '2016-02-04 11:06:04'),
(46, 'sadasd', '34', '43', 43, 16, '2016-02-04 11:06:04', '2016-02-04 11:06:04'),
(47, 'alireza', '12.233', '6.1234', 12, 17, '2016-02-04 11:22:41', '2016-02-04 11:22:41'),
(48, 'mmm', '32.656', '12.4564', 5, 17, '2016-02-04 11:22:41', '2016-02-04 11:22:41'),
(49, 'asdas', '55.66541', '32.654', 2, 17, '2016-02-04 11:22:41', '2016-02-04 11:22:41'),
(50, 'adada', '12.233', '6.1234', 12, 17, '2016-02-04 11:22:41', '2016-02-04 11:22:41'),
(51, 'fffff', '12.233', '6.1234', 12, 17, '2016-02-04 11:22:41', '2016-02-04 11:22:41');

-- --------------------------------------------------------

--
-- Table structure for table `geosegmentlist`
--

CREATE TABLE IF NOT EXISTS `geosegmentlist` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Inactive',
  `advertiser_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `geosegmentlist`
--

INSERT INTO `geosegmentlist` (`id`, `name`, `status`, `advertiser_id`, `created_at`, `updated_at`) VALUES
(7, 'gsmssss', 'Active', 4, '2015-11-28 13:14:23', '2016-02-16 11:14:20'),
(8, 'gggggggggggg', 'Active', 4, '2015-11-28 13:14:23', '2015-11-28 13:14:23'),
(9, 'ali', 'Active', 8, '2015-12-05 13:25:30', '2015-12-05 13:25:30'),
(12, 'aa11a112', 'Active', 4, '2015-12-05 13:57:05', '2016-01-17 11:03:44'),
(13, 'asd', 'Active', 4, '2016-01-18 14:21:49', '2016-01-26 11:04:26'),
(14, 'ali', 'Active', 9, '2016-01-18 14:32:09', '2016-01-26 11:04:25'),
(15, 'gsm 1 abc', 'Inactive', 13, '2016-02-04 10:53:40', '2016-02-04 11:24:56'),
(16, 'gsm 4 abc', 'Active', 13, '2016-02-04 11:06:04', '2016-02-04 11:24:54'),
(17, 'test Upload1', 'Inactive', 13, '2016-02-04 11:22:41', '2016-03-02 13:03:32');

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
  `event_type` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `targetgroup_id` int(10) unsigned NOT NULL,
  `creative_id` int(10) unsigned NOT NULL,
  `campaign_id` int(10) unsigned NOT NULL,
  `advertiser_id` int(10) unsigned NOT NULL,
  `client_id` int(10) unsigned NOT NULL,
  `geosegment_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=2080991137 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `impression`
--

INSERT INTO `impression` (`id`, `event_type`, `targetgroup_id`, `creative_id`, `campaign_id`, `advertiser_id`, `client_id`, `geosegment_id`, `created_at`, `updated_at`) VALUES
(153288439, 'impression', 12, 5, 3, 4, 3, 7, '2016-01-30 15:13:04', '2016-01-03 23:35:00'),
(215669522, 'impression', 12, 5, 3, 4, 3, 8, '2016-01-30 14:56:04', '2016-01-04 13:47:00'),
(317691996, 'impression', 12, 5, 3, 4, 3, 8, '2016-01-30 15:02:04', '2016-01-04 10:41:00'),
(413181936, 'impression', 12, 5, 3, 4, 3, 7, '2016-01-30 14:20:04', '2016-01-04 09:41:00'),
(452596680, 'impression', 12, 5, 3, 4, 3, 8, '2016-01-30 15:21:04', '2016-01-04 13:42:00'),
(553977792, 'impression', 12, 5, 3, 4, 3, 7, '2016-01-30 14:54:04', '2016-01-03 23:13:00'),
(556388576, 'impression', 12, 5, 3, 4, 3, 8, '2016-01-30 15:19:04', '2016-01-04 12:18:00'),
(685690528, 'impression', 12, 5, 3, 4, 3, 7, '2016-01-30 14:29:04', '2016-01-04 01:20:00'),
(749342224, 'impression', 12, 5, 3, 4, 3, 8, '2016-01-30 15:05:04', '2016-01-04 09:44:00'),
(810120192, 'impression', 12, 5, 3, 4, 3, 7, '2016-01-30 15:04:04', '2016-01-03 23:45:00'),
(817205936, 'impression', 12, 5, 3, 4, 3, 7, '2016-01-30 14:27:04', '2016-01-04 06:39:00'),
(900394624, 'impression', 12, 5, 3, 4, 3, 7, '2016-01-30 15:12:04', '2016-01-04 05:28:00'),
(922185560, 'impression', 12, 5, 3, 4, 3, 7, '2016-01-30 14:16:04', '2016-01-04 02:44:00'),
(992712064, 'impression', 12, 5, 3, 4, 3, 7, '2016-01-30 15:13:04', '2016-01-04 13:06:00'),
(1018066049, 'impression', 12, 5, 3, 4, 3, 7, '2016-01-30 14:25:04', '2016-01-04 00:40:00'),
(1076781624, 'impression', 12, 5, 3, 4, 3, 7, '2016-01-30 15:38:04', '2016-01-04 07:42:00'),
(1199415968, 'impression', 12, 5, 3, 4, 3, 7, '2016-01-30 15:20:04', '2016-01-04 07:51:00'),
(1342002592, 'impression', 12, 5, 3, 4, 3, 7, '2016-01-30 14:26:04', '2016-01-04 01:19:00'),
(1363030720, 'impression', 12, 5, 3, 4, 3, 8, '2016-01-30 15:29:04', '2016-01-03 23:16:00'),
(1369055616, 'impression', 12, 5, 3, 4, 3, 8, '2016-01-30 14:25:04', '2016-01-04 04:05:00'),
(1382131040, 'impression', 12, 5, 3, 4, 3, 7, '2016-01-30 15:19:04', '2016-01-04 08:09:00'),
(1391068416, 'impression', 12, 5, 3, 4, 3, 8, '2016-01-30 15:25:04', '2016-01-04 02:58:00'),
(1434861569, 'impression', 12, 5, 3, 4, 3, 8, '2016-01-30 14:33:04', '2016-01-03 23:44:00'),
(1448657456, 'impression', 12, 5, 3, 4, 3, 7, '2016-01-30 14:32:04', '2016-01-04 00:51:00'),
(1551671296, 'impression', 12, 5, 3, 4, 3, 8, '2016-01-30 14:14:04', '2016-01-04 04:00:00'),
(1557134816, 'impression', 12, 5, 3, 4, 3, 7, '2016-01-30 14:29:04', '2016-01-04 09:29:00'),
(1575119360, 'impression', 12, 5, 3, 4, 3, 7, '2016-01-30 14:11:04', '2016-01-04 06:25:00'),
(1604989776, 'impression', 12, 5, 3, 4, 3, 8, '2016-01-30 15:11:04', '2016-01-04 01:02:00'),
(1781784256, 'impression', 12, 5, 3, 4, 3, 7, '2016-01-30 14:14:04', '2016-01-04 10:19:00'),
(1791854150, 'impression', 12, 5, 3, 4, 3, 7, '2016-01-30 14:54:04', '2016-01-03 22:14:00'),
(1970126228, 'impression', 12, 5, 3, 4, 3, 7, '2016-01-30 14:20:04', '2016-01-04 10:45:00'),
(2041386496, 'impression', 12, 5, 3, 4, 3, 8, '2016-01-30 15:25:04', '2016-01-04 06:32:00'),
(2046296064, 'impression', 12, 5, 3, 4, 3, 8, '2016-01-30 15:33:04', '2016-01-04 03:23:00'),
(2080991136, 'impression', 12, 5, 3, 4, 3, 8, '2016-01-30 14:30:04', '2016-01-04 03:26:00');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE IF NOT EXISTS `inventory` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Inactive',
  `type` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `category` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `daily_limit` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id`, `name`, `status`, `type`, `category`, `daily_limit`, `created_at`, `updated_at`) VALUES
(1, 'inv11', 'Inactive', 'type1', 'cat1', 231, '2016-02-07 10:51:29', '2016-02-07 11:01:12');

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
('2015_12_24_085112_create_impression_table', 16),
('2016_01_10_154927_audit_table', 17),
('2016_01_19_153521_advertiser_publisher-tabale', 18),
('2016_01_19_154226_targetgroup_bid_advpublisher-tabale', 18),
('2016_01_20_141526_targetgroup_bidhour_map', 19),
('2016_01_20_181334_geolocation-table', 20),
('2016_01_20_181400_targetgroup_geolocation_map-table', 20),
('2016_01_21_125141_offer-table', 21),
('2016_01_21_125202_offer_pixel_map-table', 22),
('2016_01_21_125224_pixel-table', 22),
('2016_01_23_173443_fieald_to_model', 23),
('2016_01_27_152941_advertiser_model_map-table', 24),
('2016_02_07_140514_create-inventory-table', 25),
('2016_02_08_143515_create-segment-table', 26),
('2016_02_08_143530_create-targetgroup_segment_map', 26),
('2016_02_08_143547_create-targetgroup_realtime_info', 26),
('2016_02_08_143557_create-campaign_realtime_info', 26),
('2016_02_18_121425_create-bid_profile-table', 27),
('2016_02_18_121441_create-bid_profile_entry-table', 27);

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
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `positive_feature_used` text COLLATE utf8_unicode_ci NOT NULL,
  `feature_score_map` text COLLATE utf8_unicode_ci NOT NULL,
  `top_feature_score_map` text COLLATE utf8_unicode_ci NOT NULL,
  `model_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cut_off_score` decimal(4,2) NOT NULL,
  `pixel_hit_recency_in_seconds` int(11) NOT NULL,
  `positive_offer_id` text COLLATE utf8_unicode_ci NOT NULL,
  `negative_offer_id` text COLLATE utf8_unicode_ci NOT NULL,
  `max_number_of_device_history_per_feature` int(11) NOT NULL,
  `max_number_of_negative_feature_to_pick` int(11) NOT NULL,
  `number_of_positive_device_to_be_used_for_modeling` int(11) NOT NULL,
  `number_of_negative_device_to_be_used_for_modeling` int(11) NOT NULL,
  `number_of_both_negative_positive_device_to_be_used` int(11) NOT NULL,
  `date_of_request_completion` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `model`
--

INSERT INTO `model` (`id`, `name`, `advertiser_id`, `seed_web_sites`, `algo`, `segment_name_seed`, `process_result`, `description`, `num_neg_devices_used`, `num_pos_devices_used`, `feature_recency_in_sec`, `max_num_both_neg_pos_devices`, `negative_features_requested`, `feature_avg_num_history_used`, `negative_feature_used`, `date_of_request`, `created_at`, `updated_at`, `positive_feature_used`, `feature_score_map`, `top_feature_score_map`, `model_type`, `cut_off_score`, `pixel_hit_recency_in_seconds`, `positive_offer_id`, `negative_offer_id`, `max_number_of_device_history_per_feature`, `max_number_of_negative_feature_to_pick`, `number_of_positive_device_to_be_used_for_modeling`, `number_of_negative_device_to_be_used_for_modeling`, `number_of_both_negative_positive_device_to_be_used`, `date_of_request_completion`) VALUES
(4, 'te1st111121s', 4, '', 'heat', '23141122', 'submitted', 'axdffs122', 0, 0, 3241112, 23122, '', '', '', '2016-01-25 13:05:02', '2016-01-25 11:09:18', '2016-02-29 13:02:27', '', '', '', 'pixel_model', '99.99', 1223, '4,2', '1,3,5', 122, 0, 122, 122, 122, '2016-01-25 13:05:02'),
(5, 'pixelmodel1', 4, '', 'lakers', 'cnn visitors', 'requestSubmitted', '', 12, 13, 1400, 120, '', '', '12', '2016-02-19 22:37:02', '2016-02-19 21:45:01', '2016-02-19 23:40:10', '43', '{"soccer.com":23.12, "cooking.com":32.23, "shipping.com":2.32, "booking.com":23.12}', '{"soccer.com":233.12, "cooking.com":432.23, "shipping.com":32.32, "booking.com":26.12}', 'pixel_model', '12.00', 1200, '4,2', '1,3,5', 250, 240, 2000, 300, 300, '2016-02-19 23:35:01'),
(6, 'asdas', 4, '', 'lakers', '123', 'submitted', 'asdasd', 0, 0, 123, 123, '', '', '', '2016-02-22 14:18:01', '2016-02-22 14:18:01', '2016-02-22 14:18:01', '', '', '', 'pixel_model', '99.99', 123, '1,3,4', '5,2', 123, 0, 123, 123, 123, '2016-02-22 14:18:01'),
(7, 'mode1l test1', 4, '', 'heat', 'asda1sd', 'submitted', 'asd asdas as ', 0, 0, 2342, 234, '', '', '', '2016-02-25 11:53:42', '2016-02-25 11:53:42', '2016-02-25 12:11:15', '', '', '', 'pixel_model', '34.00', 234, '1,3', '5', 34, 0, 234, 234, 234, '2016-02-25 11:53:42');

-- --------------------------------------------------------

--
-- Table structure for table `offer`
--

CREATE TABLE IF NOT EXISTS `offer` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Inactive',
  `advertiser_id` int(10) unsigned NOT NULL,
  `description` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `offer`
--

INSERT INTO `offer` (`id`, `name`, `status`, `advertiser_id`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Inactive', 'Active', 4, '', '2016-01-21 11:13:17', '2016-02-10 13:12:45'),
(2, 'offer4', 'Active', 4, '', '2016-01-21 12:35:00', '2016-01-26 13:12:16'),
(3, 'offer 1 Bing', '', 12, '', '2016-02-03 13:37:18', '2016-02-03 13:37:18'),
(4, 'offer 1 abc', 'Inactive', 13, '', '2016-02-04 10:28:33', '2016-02-04 10:30:10'),
(5, 'offer 2 abc', 'Active', 13, '', '2016-02-04 10:28:59', '2016-02-04 10:30:09');

-- --------------------------------------------------------

--
-- Table structure for table `offer_pixel_map`
--

CREATE TABLE IF NOT EXISTS `offer_pixel_map` (
  `id` int(10) unsigned NOT NULL,
  `offer_id` int(10) unsigned NOT NULL,
  `pixel_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `offer_pixel_map`
--

INSERT INTO `offer_pixel_map` (`id`, `offer_id`, `pixel_id`, `created_at`, `updated_at`) VALUES
(2, 2, 1, '2016-01-21 13:07:07', '2016-01-21 13:07:07'),
(7, 4, 5, '2016-02-04 10:48:20', '2016-02-04 10:48:20'),
(10, 1, 3, '2016-02-10 13:44:53', '2016-02-10 13:44:53'),
(13, 1, 5, '2016-02-24 12:19:18', '2016-02-24 12:19:18'),
(14, 1, 4, '2016-02-24 12:26:23', '2016-02-24 12:26:23'),
(15, 1, 7, '2016-02-24 12:26:23', '2016-02-24 12:26:23'),
(16, 1, 6, '2016-02-24 12:26:23', '2016-02-24 12:26:23'),
(17, 1, 1, '2016-02-24 12:26:23', '2016-02-24 12:26:23'),
(18, 1, 2, '2016-02-24 12:26:23', '2016-02-24 12:26:23');

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
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
(24, 'VIEW_GEOSEGMENTLIST', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(25, 'ADD_EDIT_OFFER', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(26, 'ADD_EDIT_PIXEL', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(27, 'VIEW_OFFER', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(28, 'VIEW_PIXEL', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(29, 'VIEW_SEGMENT', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(30, 'ADD_EDIT_USER', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(31, 'VIEW_USER', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(32, 'VIEW_BIDPROFILE', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(33, 'ADD_EDIT_BIDPROFILE', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `pixel`
--

CREATE TABLE IF NOT EXISTS `pixel` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Inactive',
  `advertiser_id` int(10) unsigned NOT NULL,
  `part_a` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `part_b` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `version` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pixel`
--

INSERT INTO `pixel` (`id`, `name`, `status`, `advertiser_id`, `part_a`, `part_b`, `version`, `description`, `created_at`, `updated_at`) VALUES
(1, 'pixle1111', 'Inactive', 4, 'wXTXfP2d4ggkmJHwXcUvc80vVuAeuLJUJU1gZoAv7cZlsMl1Q6eeDDLdFmvGhKzQjKxq7QwEy06eVGno', '7SWQs1SOM6N0qBMEgsqtCaPGlGA0MtMDLw0kDhnhgIsdYkmlB2GovmvAwerD08yLM2sGcpfC7dvhSVkU', 'version1', '', '2016-01-21 11:47:51', '2016-02-10 13:18:44'),
(2, 'pixle11112', 'Active', 4, 'qIx3eXHRwDlpEexTsGU3htx7YA0LStpgP7mhaYX5L0LmWHSkx1VJUqXLTTBaQTW8AozouQzanfybA3BE', 'ZejhUfLic4AqbbQSJx8nbBz8mmITDhGPPj4HhWXHS8WzUl7vfy5effWZImgs2n9T1hcZ2vvZV3FA0nL0', 'version1', '', '2016-01-21 12:35:31', '2016-02-07 14:49:04'),
(3, 'pixle 1 bing1', '', 12, '9tdRmgLnlhu8OTSbYWSayKY9Ma7JmyO0wKZyY49vWoeq83IpMTA3BfisOYNc7pBpLoDDsgp0pTQ5kArZ', 'teajw8u8I9m3LCgbTpa5OPxRKKl8pv3X2VDWjnycuHMihdNkTNyU2Mx7XZHxmMwit0XXZ0uC9C5TFcdR', 'version1', '', '2016-02-03 13:46:26', '2016-02-07 13:43:22'),
(4, 'pixel 1 abc', 'Inactive', 13, 'sHOHt7O6sDYkF5gXMN852DAk9V3LkwvYjLr4juOE235NIie54yIEjGv3915pPppi3cXP2eGzuP3DES3B', 'fG9At6ja3u0rcGb0E1kWClqRPZUQtPLuibtTuUZEOlMQskP48cAr5P2w1wDq9amKd4Fzp5xvsyrCzllw', 'version1', '', '2016-02-04 10:32:13', '2016-02-04 10:33:46'),
(5, 'pexel 2 abc1', 'Active', 13, 'dWvSmRsjCtGccEa7PImaIwfWAphxEerxEkc3MxvFLcQtPab4GMZxyTfu9Po0IrpGW5LC3AroMiT7k35o', 'pdvhhC6pCBmQE1fb7ddxd0fvFLN9HkR512TpRJQHWLd3sYX49IxQeOVYqCAyWYv9ve9Tkdsm8iWD9jxk', 'version1', '', '2016-02-04 10:32:25', '2016-02-04 10:33:45'),
(6, 'pixel new', 'Active', 4, '4mjbs5Bety8sIwflhbMQLh5rf015k5Th5JAX9GqCB9fc0Qpbv0JyEkALy1OMNQK4uZeBeaCS5CJOG3WU', '5G48UftXeWZkEuYJh6f8Gxb0XXAjI8Qw3fMBx2J1hIxKS0zgq6DwvL70cbPF858ZoGRVyIlXIns3uoxG', 'version1', '', '2016-02-11 08:03:11', '2016-02-11 08:03:11'),
(7, 'pixel neeee', 'Active', 4, 'EflbPYu3gAudyOHaMRYSxrDMWNwTyD1EubV1l8CucKU1EHa5OeeDf3ra3oDDQYauIZTJeb7OvLIH8s1S', 'ctSijxDqyR8fwaIdiGdju6Z0bGTgZ6fxZBTOLTcyqcZJyfCOgfVM8Uf4fsrGdCQ48BidA88zFqe6YcUi', 'version1', '', '2016-02-11 08:06:40', '2016-02-11 08:06:40');

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
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=597 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `role_permission_mapping`
--

INSERT INTO `role_permission_mapping` (`id`, `permission_id`, `role_id`, `description`, `created_at`, `updated_at`) VALUES
(15, 7, 3, '', '2015-12-07 13:09:51', '2015-12-07 13:09:51'),
(16, 16, 3, '', '2015-12-07 13:09:51', '2015-12-07 13:09:51'),
(508, 1, 2, '', '2016-02-02 10:57:10', '2016-02-02 10:57:10'),
(509, 3, 2, '', '2016-02-02 10:57:10', '2016-02-02 10:57:10'),
(510, 4, 2, '', '2016-02-02 10:57:10', '2016-02-02 10:57:10'),
(511, 6, 2, '', '2016-02-02 10:57:10', '2016-02-02 10:57:10'),
(512, 7, 2, '', '2016-02-02 10:57:10', '2016-02-02 10:57:10'),
(513, 9, 2, '', '2016-02-02 10:57:10', '2016-02-02 10:57:10'),
(514, 10, 2, '', '2016-02-02 10:57:10', '2016-02-02 10:57:10'),
(515, 12, 2, '', '2016-02-02 10:57:10', '2016-02-02 10:57:10'),
(516, 13, 2, '', '2016-02-02 10:57:10', '2016-02-02 10:57:10'),
(517, 15, 2, '', '2016-02-02 10:57:10', '2016-02-02 10:57:10'),
(518, 16, 2, '', '2016-02-02 10:57:10', '2016-02-02 10:57:10'),
(519, 18, 2, '', '2016-02-02 10:57:10', '2016-02-02 10:57:10'),
(520, 19, 2, '', '2016-02-02 10:57:10', '2016-02-02 10:57:10'),
(521, 21, 2, '', '2016-02-02 10:57:10', '2016-02-02 10:57:10'),
(522, 22, 2, '', '2016-02-02 10:57:10', '2016-02-02 10:57:10'),
(523, 24, 2, '', '2016-02-02 10:57:10', '2016-02-02 10:57:10'),
(524, 25, 2, '', '2016-02-02 10:57:10', '2016-02-02 10:57:10'),
(525, 26, 2, '', '2016-02-02 10:57:10', '2016-02-02 10:57:10'),
(526, 27, 2, '', '2016-02-02 10:57:10', '2016-02-02 10:57:10'),
(527, 28, 2, '', '2016-02-02 10:57:10', '2016-02-02 10:57:10'),
(572, 1, 1, '', '2016-02-18 09:03:32', '2016-02-18 09:03:32'),
(573, 3, 1, '', '2016-02-18 09:03:32', '2016-02-18 09:03:32'),
(574, 4, 1, '', '2016-02-18 09:03:32', '2016-02-18 09:03:32'),
(575, 6, 1, '', '2016-02-18 09:03:32', '2016-02-18 09:03:32'),
(576, 7, 1, '', '2016-02-18 09:03:32', '2016-02-18 09:03:32'),
(577, 9, 1, '', '2016-02-18 09:03:32', '2016-02-18 09:03:32'),
(578, 10, 1, '', '2016-02-18 09:03:32', '2016-02-18 09:03:32'),
(579, 12, 1, '', '2016-02-18 09:03:32', '2016-02-18 09:03:32'),
(580, 13, 1, '', '2016-02-18 09:03:32', '2016-02-18 09:03:32'),
(581, 15, 1, '', '2016-02-18 09:03:32', '2016-02-18 09:03:32'),
(582, 16, 1, '', '2016-02-18 09:03:32', '2016-02-18 09:03:32'),
(583, 18, 1, '', '2016-02-18 09:03:32', '2016-02-18 09:03:32'),
(584, 19, 1, '', '2016-02-18 09:03:32', '2016-02-18 09:03:32'),
(585, 21, 1, '', '2016-02-18 09:03:32', '2016-02-18 09:03:32'),
(586, 22, 1, '', '2016-02-18 09:03:32', '2016-02-18 09:03:32'),
(587, 24, 1, '', '2016-02-18 09:03:32', '2016-02-18 09:03:32'),
(588, 25, 1, '', '2016-02-18 09:03:32', '2016-02-18 09:03:32'),
(589, 26, 1, '', '2016-02-18 09:03:32', '2016-02-18 09:03:32'),
(590, 27, 1, '', '2016-02-18 09:03:32', '2016-02-18 09:03:32'),
(591, 28, 1, '', '2016-02-18 09:03:32', '2016-02-18 09:03:32'),
(592, 29, 1, '', '2016-02-18 09:03:32', '2016-02-18 09:03:32'),
(593, 30, 1, '', '2016-02-18 09:03:32', '2016-02-18 09:03:32'),
(594, 31, 1, '', '2016-02-18 09:03:32', '2016-02-18 09:03:32'),
(595, 32, 1, '', '2016-02-18 09:03:32', '2016-02-18 09:03:32'),
(596, 33, 1, '', '2016-02-18 09:03:32', '2016-02-18 09:03:32');

-- --------------------------------------------------------

--
-- Table structure for table `segment`
--

CREATE TABLE IF NOT EXISTS `segment` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `advertiser_id` int(10) unsigned NOT NULL,
  `model_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `segment`
--

INSERT INTO `segment` (`id`, `name`, `advertiser_id`, `model_id`, `created_at`, `updated_at`) VALUES
(2, 'segment 2', 4, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `targetgroup`
--

CREATE TABLE IF NOT EXISTS `targetgroup` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `campaign_id` int(10) unsigned NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Inactive',
  `iab_category` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `iab_sub_category` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `max_impression` int(11) NOT NULL,
  `daily_max_impression` int(11) NOT NULL,
  `max_budget` int(11) NOT NULL,
  `daily_max_budget` int(11) NOT NULL,
  `pacing_plan` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cpm` int(11) NOT NULL,
  `ad_position` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `frequency_in_sec` int(11) NOT NULL,
  `start_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `end_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `advertiser_domain_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `targetgroup`
--

INSERT INTO `targetgroup` (`id`, `name`, `campaign_id`, `description`, `status`, `iab_category`, `iab_sub_category`, `max_impression`, `daily_max_impression`, `max_budget`, `daily_max_budget`, `pacing_plan`, `cpm`, `ad_position`, `frequency_in_sec`, `start_date`, `end_date`, `advertiser_domain_name`, `created_at`, `updated_at`) VALUES
(1, 'dfsasd2221', 3, 'df fsdfs d1', 'Inactive', 'asd1', 'asd1', 32141, 2342341, 2341, 2341, '2341', 2341, '', 2341, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '234231', '2015-10-22 05:17:18', '2016-02-13 13:09:22'),
(2, 'sadasd', 3, '4ghh', 'Inactive', '234', '234', 234234, 234, 2341234, 234234, '234234', 456, '', 45646, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '456456', '2015-10-23 09:56:19', '2016-02-13 13:04:55'),
(3, 'asdasd', 3, 'fhfgh', 'Active', '5646', '456456', 45645, 645, 6456, 46, '464', 4564, '', 5646, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '46', '2015-10-23 09:59:06', '2015-10-23 09:59:06'),
(4, 'asdasd1', 7, 'ggggfjfjf g gh jfg ', 'Active', '324', '567', 65, 87, 856756, 7567, '567', 567, '', 567, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '567', '2015-10-23 10:00:05', '2015-10-23 10:00:05'),
(13, 'ali', 3, '', 'Active', '1', NULL, 1, 2, 3, 4, '7', 6, '', 5, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'ddd', '2015-11-30 14:13:26', '2015-11-30 14:13:26'),
(20, 'final11', 3, '', '', '2', '6', 21311, 12311, 12311, 12311, '12311', 12311, 'null', 12311, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'http://www.as11d.com', '2016-01-28 09:06:16', '2016-03-02 12:00:18'),
(21, 'fdgdrsd1', 12, '', '', '2', '5', 21, 32, 23, 23, '23', 23, '["Any","Above_the_Fold","Below_the_Fold"]', 32, '2016-09-02 10:15:13', '2017-06-02 10:15:13', 'sad1.com', '2016-02-04 11:10:05', '2016-02-08 16:08:59');

-- --------------------------------------------------------

--
-- Table structure for table `targetgroup_bidhour_map`
--

CREATE TABLE IF NOT EXISTS `targetgroup_bidhour_map` (
  `id` int(10) unsigned NOT NULL,
  `hours` varchar(1024) COLLATE utf8_unicode_ci NOT NULL COMMENT 'first day is monday and array start at 1',
  `targetgroup_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `targetgroup_bidhour_map`
--

INSERT INTO `targetgroup_bidhour_map` (`id`, `hours`, `targetgroup_id`, `created_at`, `updated_at`) VALUES
(10, '{"1":["0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","1","1","1","1","1","1","1"],"2":["0","0","0","0","0","0","0","0","0","0","0","0","0","1","0","0","0","1","1","0","1","0","1","1"],"3":["0","0","0","0","1","0","0","0","0","0","0","0","1","0","0","0","0","1","0","1","1","1","1","1"],"4":["0","0","0","0","0","0","1","0","1","0","0","0","0","0","0","0","0","1","1","1","1","1","0","1"],"5":["0","0","0","0","0","1","0","0","0","0","0","0","1","0","0","0","0","1","1","1","1","1","1","1"],"6":["1","1","1","1","1","1","1","1","1","1","1","1","1","1","1","1","1","1","1","0","1","1","1","1"],"7":["1","1","1","1","1","1","1","1","1","1","1","1","1","1","1","1","1","1","0","1","1","1","1","1"]}', 20, '2016-01-28 10:07:37', '2016-02-20 11:48:55'),
(11, '{"1":["1","1","1","1","1","1","1","1","1","1","1","1","1","1","1","1","1","1","1","1","1","1","1","1"],"2":["0","1","0","0","0","0","0","1","0","0","0","0","0","0","0","0","1","0","0","0","1","0","0","0"],"3":["0","1","0","1","0","0","1","0","0","0","1","0","0","0","1","0","0","0","1","0","0","0","0","1"],"4":["0","0","0","1","0","1","0","0","0","0","0","0","0","1","0","0","0","1","0","0","0","1","0","0"],"5":["0","0","0","0","0","0","1","0","0","0","1","0","1","0","0","0","0","0","0","1","0","0","0","0"],"6":["1","0","0","1","0","0","0","1","0","0","0","0","0","0","0","1","0","1","0","1","0","0","0","0"],"7":["1","0","0","1","0","0","0","1","0","1","0","1","0","0","0","1","0","0","0","1","0","1","0","1"]}', 21, '2016-02-04 11:10:05', '2016-02-04 11:10:05');

-- --------------------------------------------------------

--
-- Table structure for table `targetgroup_bid_advpublisher`
--

CREATE TABLE IF NOT EXISTS `targetgroup_bid_advpublisher` (
  `id` int(10) unsigned NOT NULL,
  `bid_price` int(11) NOT NULL,
  `advertiser_publisher_id` int(10) unsigned NOT NULL,
  `targetgroup_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `targetgroup_bid_advpublisher`
--

INSERT INTO `targetgroup_bid_advpublisher` (`id`, `bid_price`, `advertiser_publisher_id`, `targetgroup_id`, `created_at`, `updated_at`) VALUES
(10, 12, 23, 20, '2016-01-28 09:06:16', '2016-01-28 09:06:16'),
(11, 22, 24, 20, '2016-01-28 09:06:16', '2016-01-28 09:06:16'),
(12, 33, 28, 21, '2016-02-04 11:10:05', '2016-02-04 11:10:05');

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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `targetgroup_bwlist_map`
--

INSERT INTO `targetgroup_bwlist_map` (`id`, `targetgroup_id`, `bwlist_id`, `created_at`, `updated_at`) VALUES
(17, 21, 22, '2016-02-04 11:10:05', '2016-02-04 11:10:05');

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
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `targetgroup_creative_map`
--

INSERT INTO `targetgroup_creative_map` (`id`, `targetgroup_id`, `creative_id`, `created_at`, `updated_at`) VALUES
(22, 21, 8, '2016-02-04 11:10:05', '2016-02-04 11:10:05');

-- --------------------------------------------------------

--
-- Table structure for table `targetgroup_geolocation_map`
--

CREATE TABLE IF NOT EXISTS `targetgroup_geolocation_map` (
  `id` int(10) unsigned NOT NULL,
  `geolocation_id` int(10) unsigned NOT NULL,
  `targetgroup_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `targetgroup_geolocation_map`
--

INSERT INTO `targetgroup_geolocation_map` (`id`, `geolocation_id`, `targetgroup_id`, `created_at`, `updated_at`) VALUES
(32, 1, 21, '2016-02-04 11:10:05', '2016-02-04 11:10:05'),
(33, 2, 21, '2016-02-04 11:10:05', '2016-02-04 11:10:05'),
(34, 5, 21, '2016-02-04 11:10:05', '2016-02-04 11:10:05'),
(35, 6, 21, '2016-02-04 11:10:05', '2016-02-04 11:10:05');

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
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `targetgroup_geosegmentlist_map`
--

INSERT INTO `targetgroup_geosegmentlist_map` (`id`, `targetgroup_id`, `geosegmentlist_id`, `created_at`, `updated_at`) VALUES
(38, 21, 15, '2016-02-04 11:10:05', '2016-02-04 11:10:05'),
(39, 21, 16, '2016-02-04 11:10:05', '2016-02-04 11:10:05');

-- --------------------------------------------------------

--
-- Table structure for table `targetgroup_realtime_info`
--

CREATE TABLE IF NOT EXISTS `targetgroup_realtime_info` (
  `id` int(10) unsigned NOT NULL,
  `targetgroup_id` int(10) unsigned NOT NULL,
  `today_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `impressions_shown_today_until_now` int(11) NOT NULL,
  `total_impression_show_until_now` int(11) NOT NULL,
  `daily_budget_spent_today_until_now` decimal(8,2) NOT NULL,
  `total_budget_spent_until_now` decimal(8,2) NOT NULL,
  `last_time_ad_shown` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `target_group_pacing_status` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `targetgroup_realtime_info`
--

INSERT INTO `targetgroup_realtime_info` (`id`, `targetgroup_id`, `today_date`, `impressions_shown_today_until_now`, `total_impression_show_until_now`, `daily_budget_spent_today_until_now`, `total_budget_spent_until_now`, `last_time_ad_shown`, `target_group_pacing_status`, `created_at`, `updated_at`) VALUES
(2, 20, '2016-10-01', 12, 23, '34.12', '432.23', '2016-02-07 22:41:21', 'Active', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `targetgroup_segment_map`
--

CREATE TABLE IF NOT EXISTS `targetgroup_segment_map` (
  `id` int(10) unsigned NOT NULL,
  `targetgroup_id` int(10) unsigned NOT NULL,
  `segment_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `status` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_login_time` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `company_id`, `company`, `name`, `email`, `password`, `status`, `remember_token`, `last_login_time`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'aaa11', 'alireza11', '09364991494@yahoo.com', '$2y$10$08i8xxH9EYmrBH35RugV7uq6dIZZKghK2idVuXbxi4Tq/EEfiYomu', 'Inactive', 'Ki7kx2LrRWZx0Korla95LCIetICP35e5KLYqq7cuKBofYqhv1hYjjAqHgTxx', '2016-03-05 21:47:30', '0000-00-00 00:00:00', '2016-03-06 09:47:30'),
(2, 2, 2, '', 'alireza11111', 'a@b.com', '$2y$10$7nej63o0f9G.YpQsDqLzgOD78qiXyfXysoR07HN78WrbNFboj1FHe', 'Inactive', 'escgKZLuQi66aB6EvHtgXCw0fiuW1U2ksa2gPmh0KXU2HPVDYn6VMGPTx4cy', '2016-02-01 22:46:05', '0000-00-00 00:00:00', '2016-02-16 11:30:29'),
(3, 2, 1, '', 'asdasd1', 'a@yahoo.com', '$2y$10$7nej63o0f9G.YpQsDqLzgOD78qiXyfXysoR07HN78WrbNFboj1FHe', 'Inactive', 'Ba6wjWdQ9efNaILSuDtLxQLTt7CibJf6Ajw00wMzjqTg9C8lQXFf3IDb39F6', '2016-02-01 22:44:27', '2015-12-06 08:35:25', '2016-02-16 11:30:41'),
(4, 2, 1, '', 'asdasdas222', 'b@yahoo.com', '$2y$10$7nej63o0f9G.YpQsDqLzgOD78qiXyfXysoR07HN78WrbNFboj1FHe', 'Active', '1NGp5eILuC7ZyxXAn5ZyVTvAX8HKoYftF5HQfvDywy8o0vg1nPpGrXWnVm7n', '0000-00-00 00:00:00', '2015-12-06 08:38:53', '2015-12-08 05:53:18'),
(5, 3, 1, '', 'asdas', 'c@yahoo.com', '$2y$10$7nej63o0f9G.YpQsDqLzgOD78qiXyfXysoR07HN78WrbNFboj1FHe', 'Active', NULL, '0000-00-00 00:00:00', '2015-12-06 10:18:58', '2015-12-07 11:57:27'),
(6, 4, 1, '', 'asda111', 'd@yahoo.com', '$2y$10$7nej63o0f9G.YpQsDqLzgOD78qiXyfXysoR07HN78WrbNFboj1FHe', 'Active', NULL, '0000-00-00 00:00:00', '2015-12-15 13:35:09', '2015-12-15 13:40:52'),
(7, 2, 2, '', 'test_apple', 'g@yahoo.com', '$2y$10$TY2jwFS.CVRSkA6GfrNJz.rffHzKn1FD6waYPCDdjyleqPUzknFE2', 'Active', NULL, '0000-00-00 00:00:00', '2016-02-02 10:48:07', '2016-02-02 10:48:07'),
(8, 2, 3, '', 'user_bing', 'bing@yahoo.com', '$2y$10$YqTtfNdmplSOvCtrq4cUm.woKsZh0FmvjahfetW/u8VSUcOiL85Fy', 'Active', 'GkKEJMqbB2hT7jStprUlwq1KAfs97EDX8YpFFRpvVEouyrIGYrm7T4cVrQN5', '2016-02-10 01:56:49', '2016-02-02 10:53:24', '2016-02-10 13:56:49'),
(9, 1, 4, '', 'abd User', 'abc.user@yahoo.com', '$2y$10$PRmqUdfcdfAYKywijL0Aq.jEYkEmqe.AHabPjEsQhOjZ8J3hr5efa', 'Active', 'f8bcbYGUv3qDq4xgCr3S89EOkmAiTapsV85SPtpswKAaZtfThXBl3CN6ZHkY', '2016-02-03 21:51:02', '2016-02-04 09:50:23', '2016-02-04 09:52:24'),
(10, 2, 4, '', 'abc user admin', 'abc.admin@yahoo.com', '$2y$10$m7Vku3vbLjazRsjHBwIsR.c2pWzzKzEBCvnRKQu0zSgjGvA2U7SQ6', 'Active', '1bYnXfC9qAAiOdbFfmu9QqXn2e8d225cI9LxcV6Sr2DsaCNAHrKhC9hGw8v6', '2016-02-03 22:19:58', '2016-02-04 09:52:12', '2016-02-04 11:27:02');

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
-- Indexes for table `advertiser_model_map`
--
ALTER TABLE `advertiser_model_map`
  ADD PRIMARY KEY (`id`),
  ADD KEY `advertiser_model_map_advertiser_id_foreign` (`advertiser_id`),
  ADD KEY `advertiser_model_map_model_id_foreign` (`model_id`);

--
-- Indexes for table `advertiser_publisher`
--
ALTER TABLE `advertiser_publisher`
  ADD PRIMARY KEY (`id`),
  ADD KEY `advertiser_publisher_advertiser_id_foreign` (`advertiser_id`);

--
-- Indexes for table `audits`
--
ALTER TABLE `audits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `audits_user_id_foreign` (`user_id`);

--
-- Indexes for table `bid_profile`
--
ALTER TABLE `bid_profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bid_profile_entry`
--
ALTER TABLE `bid_profile_entry`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bid_profile_entry_bid_profile_id_foreign` (`bid_profile_id`);

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
-- Indexes for table `campaign_realtime_info`
--
ALTER TABLE `campaign_realtime_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `campaign_realtime_info_campaign_id_foreign` (`campaign_id`);

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
-- Indexes for table `geolocation`
--
ALTER TABLE `geolocation`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model`
--
ALTER TABLE `model`
  ADD PRIMARY KEY (`id`),
  ADD KEY `model_advertiser_id_foreign` (`advertiser_id`);

--
-- Indexes for table `offer`
--
ALTER TABLE `offer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `offer_advertiser_id_foreign` (`advertiser_id`);

--
-- Indexes for table `offer_pixel_map`
--
ALTER TABLE `offer_pixel_map`
  ADD PRIMARY KEY (`id`),
  ADD KEY `offer_pixel_mapping_offer_id_foreign` (`offer_id`);

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
-- Indexes for table `pixel`
--
ALTER TABLE `pixel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pixel_advertiser_id_foreign` (`advertiser_id`);

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
-- Indexes for table `segment`
--
ALTER TABLE `segment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `segment_advertiser_id_foreign` (`advertiser_id`),
  ADD KEY `segment_model_id_foreign` (`model_id`);

--
-- Indexes for table `targetgroup`
--
ALTER TABLE `targetgroup`
  ADD PRIMARY KEY (`id`),
  ADD KEY `targetgroup_campaign_id_foreign` (`campaign_id`);

--
-- Indexes for table `targetgroup_bidhour_map`
--
ALTER TABLE `targetgroup_bidhour_map`
  ADD PRIMARY KEY (`id`),
  ADD KEY `targetgroup_bidhour_map_targetgroup_id_foreign` (`targetgroup_id`);

--
-- Indexes for table `targetgroup_bid_advpublisher`
--
ALTER TABLE `targetgroup_bid_advpublisher`
  ADD PRIMARY KEY (`id`),
  ADD KEY `targetgroup_bid_advpublisher_advertiser_publisher_id_foreign` (`advertiser_publisher_id`),
  ADD KEY `targetgroup_bid_advpublisher_targetgroup_id_foreign` (`targetgroup_id`);

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
-- Indexes for table `targetgroup_geolocation_map`
--
ALTER TABLE `targetgroup_geolocation_map`
  ADD PRIMARY KEY (`id`),
  ADD KEY `targetgroup_geolocation_map_geolocation_id_foreign` (`geolocation_id`),
  ADD KEY `targetgroup_geolocation_map_targetgroup_id_foreign` (`targetgroup_id`);

--
-- Indexes for table `targetgroup_geosegmentlist_map`
--
ALTER TABLE `targetgroup_geosegmentlist_map`
  ADD PRIMARY KEY (`id`),
  ADD KEY `targetgroup_geosegmentlist_map_targetgroup_id_foreign` (`targetgroup_id`),
  ADD KEY `targetgroup_geosegmentlist_map_geosegmentlist_id_foreign` (`geosegmentlist_id`);

--
-- Indexes for table `targetgroup_realtime_info`
--
ALTER TABLE `targetgroup_realtime_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `targetgroup_realtime_info_targetgroup_id_foreign` (`targetgroup_id`);

--
-- Indexes for table `targetgroup_segment_map`
--
ALTER TABLE `targetgroup_segment_map`
  ADD PRIMARY KEY (`id`),
  ADD KEY `targetgroup_segment_map_targetgroup_id_foreign` (`targetgroup_id`),
  ADD KEY `targetgroup_segment_map_segment_id_foreign` (`segment_id`);

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
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `advertiser_model_map`
--
ALTER TABLE `advertiser_model_map`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `advertiser_publisher`
--
ALTER TABLE `advertiser_publisher`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `audits`
--
ALTER TABLE `audits`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=325;
--
-- AUTO_INCREMENT for table `bid_profile`
--
ALTER TABLE `bid_profile`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `bid_profile_entry`
--
ALTER TABLE `bid_profile_entry`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `bwentries`
--
ALTER TABLE `bwentries`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=175;
--
-- AUTO_INCREMENT for table `bwlist`
--
ALTER TABLE `bwlist`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `campaign`
--
ALTER TABLE `campaign`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `campaign_realtime_info`
--
ALTER TABLE `campaign_realtime_info`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=53;
--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `creative`
--
ALTER TABLE `creative`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `geolocation`
--
ALTER TABLE `geolocation`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=60;
--
-- AUTO_INCREMENT for table `geosegment`
--
ALTER TABLE `geosegment`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=52;
--
-- AUTO_INCREMENT for table `geosegmentlist`
--
ALTER TABLE `geosegmentlist`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
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
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2080991137;
--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `model`
--
ALTER TABLE `model`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `offer`
--
ALTER TABLE `offer`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `offer_pixel_map`
--
ALTER TABLE `offer_pixel_map`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `permission`
--
ALTER TABLE `permission`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `pixel`
--
ALTER TABLE `pixel`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `role_permission_mapping`
--
ALTER TABLE `role_permission_mapping`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=597;
--
-- AUTO_INCREMENT for table `segment`
--
ALTER TABLE `segment`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `targetgroup`
--
ALTER TABLE `targetgroup`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `targetgroup_bidhour_map`
--
ALTER TABLE `targetgroup_bidhour_map`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `targetgroup_bid_advpublisher`
--
ALTER TABLE `targetgroup_bid_advpublisher`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `targetgroup_bwlist_map`
--
ALTER TABLE `targetgroup_bwlist_map`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `targetgroup_creative_map`
--
ALTER TABLE `targetgroup_creative_map`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `targetgroup_geolocation_map`
--
ALTER TABLE `targetgroup_geolocation_map`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `targetgroup_geosegmentlist_map`
--
ALTER TABLE `targetgroup_geosegmentlist_map`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `targetgroup_realtime_info`
--
ALTER TABLE `targetgroup_realtime_info`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `targetgroup_segment_map`
--
ALTER TABLE `targetgroup_segment_map`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
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
-- Constraints for table `advertiser_model_map`
--
ALTER TABLE `advertiser_model_map`
  ADD CONSTRAINT `advertiser_model_map_advertiser_id_foreign` FOREIGN KEY (`advertiser_id`) REFERENCES `advertiser` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `advertiser_model_map_model_id_foreign` FOREIGN KEY (`model_id`) REFERENCES `model` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `advertiser_publisher`
--
ALTER TABLE `advertiser_publisher`
  ADD CONSTRAINT `advertiser_publisher_advertiser_id_foreign` FOREIGN KEY (`advertiser_id`) REFERENCES `advertiser` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `audits`
--
ALTER TABLE `audits`
  ADD CONSTRAINT `audits_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bid_profile_entry`
--
ALTER TABLE `bid_profile_entry`
  ADD CONSTRAINT `bid_profile_entry_bid_profile_id_foreign` FOREIGN KEY (`bid_profile_id`) REFERENCES `bid_profile` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `campaign_realtime_info`
--
ALTER TABLE `campaign_realtime_info`
  ADD CONSTRAINT `campaign_realtime_info_campaign_id_foreign` FOREIGN KEY (`campaign_id`) REFERENCES `campaign` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `impression_geosegment_id_foreign` FOREIGN KEY (`geosegment_id`) REFERENCES `geosegmentlist` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `impression_targetgroup_id_foreign` FOREIGN KEY (`targetgroup_id`) REFERENCES `targetgroup` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `model`
--
ALTER TABLE `model`
  ADD CONSTRAINT `model_advertiser_id_foreign` FOREIGN KEY (`advertiser_id`) REFERENCES `advertiser` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `offer`
--
ALTER TABLE `offer`
  ADD CONSTRAINT `offer_advertiser_id_foreign` FOREIGN KEY (`advertiser_id`) REFERENCES `advertiser` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `offer_pixel_map`
--
ALTER TABLE `offer_pixel_map`
  ADD CONSTRAINT `offer_pixel_mapping_offer_id_foreign` FOREIGN KEY (`offer_id`) REFERENCES `offer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pixel`
--
ALTER TABLE `pixel`
  ADD CONSTRAINT `pixel_advertiser_id_foreign` FOREIGN KEY (`advertiser_id`) REFERENCES `advertiser` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_permission_mapping`
--
ALTER TABLE `role_permission_mapping`
  ADD CONSTRAINT `role_permission_mapping_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permission` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `role_permission_mapping_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `segment`
--
ALTER TABLE `segment`
  ADD CONSTRAINT `segment_advertiser_id_foreign` FOREIGN KEY (`advertiser_id`) REFERENCES `advertiser` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `segment_model_id_foreign` FOREIGN KEY (`model_id`) REFERENCES `model` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `targetgroup`
--
ALTER TABLE `targetgroup`
  ADD CONSTRAINT `targetgroup_campaign_id_foreign` FOREIGN KEY (`campaign_id`) REFERENCES `campaign` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `targetgroup_bidhour_map`
--
ALTER TABLE `targetgroup_bidhour_map`
  ADD CONSTRAINT `targetgroup_bidhour_map_targetgroup_id_foreign` FOREIGN KEY (`targetgroup_id`) REFERENCES `targetgroup` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `targetgroup_bid_advpublisher`
--
ALTER TABLE `targetgroup_bid_advpublisher`
  ADD CONSTRAINT `targetgroup_bid_advpublisher_advertiser_publisher_id_foreign` FOREIGN KEY (`advertiser_publisher_id`) REFERENCES `advertiser_publisher` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `targetgroup_bid_advpublisher_targetgroup_id_foreign` FOREIGN KEY (`targetgroup_id`) REFERENCES `targetgroup` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `targetgroup_geolocation_map`
--
ALTER TABLE `targetgroup_geolocation_map`
  ADD CONSTRAINT `targetgroup_geolocation_map_geolocation_id_foreign` FOREIGN KEY (`geolocation_id`) REFERENCES `geolocation` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `targetgroup_geolocation_map_targetgroup_id_foreign` FOREIGN KEY (`targetgroup_id`) REFERENCES `targetgroup` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `targetgroup_geosegmentlist_map`
--
ALTER TABLE `targetgroup_geosegmentlist_map`
  ADD CONSTRAINT `targetgroup_geosegmentlist_map_geosegmentlist_id_foreign` FOREIGN KEY (`geosegmentlist_id`) REFERENCES `geosegmentlist` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `targetgroup_geosegmentlist_map_targetgroup_id_foreign` FOREIGN KEY (`targetgroup_id`) REFERENCES `targetgroup` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `targetgroup_realtime_info`
--
ALTER TABLE `targetgroup_realtime_info`
  ADD CONSTRAINT `targetgroup_realtime_info_targetgroup_id_foreign` FOREIGN KEY (`targetgroup_id`) REFERENCES `targetgroup` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `targetgroup_segment_map`
--
ALTER TABLE `targetgroup_segment_map`
  ADD CONSTRAINT `targetgroup_segment_map_segment_id_foreign` FOREIGN KEY (`segment_id`) REFERENCES `segment` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `targetgroup_segment_map_targetgroup_id_foreign` FOREIGN KEY (`targetgroup_id`) REFERENCES `targetgroup` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
