-- phpMyAdmin SQL Dump
-- version 4.4.14.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 27, 2016 at 06:28 PM
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
  `status` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `client_id` int(10) unsigned NOT NULL,
  `domain_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `advertiser`
--

INSERT INTO `advertiser` (`id`, `name`, `description`, `status`, `client_id`, `domain_name`, `created_at`, `updated_at`) VALUES
(2, 'adv_2', 'adv_descript_2', 'Active', 4, '', '0000-00-00 00:00:00', '2016-01-26 13:12:01'),
(4, 'adv_1111', 'adv_descript_1', 'Active', 3, 'aaaa', '0000-00-00 00:00:00', '2016-01-26 10:20:10'),
(5, 'aaaaaaa', '1111', 'Active', 7, '111', '2015-10-23 10:06:50', '2016-01-26 10:20:10'),
(6, 'test1', 'aaaaa', 'Active', 1, '', '2015-11-07 12:58:57', '2016-01-26 10:20:11'),
(7, 'wwww', '', 'Active', 8, 'aaaa.com', '2015-11-17 06:52:09', '2015-11-17 06:52:09'),
(8, 'adv change', '', 'Active', 1, 'ddd.com', '2015-11-17 09:26:12', '2016-01-26 10:07:31'),
(9, 'asdasdas', '', 'Active', 1, 'adadas', '2015-11-17 12:37:45', '2016-01-26 13:11:59'),
(10, 'aa', '', 'Active', 1, 'aaa', '2015-12-23 12:21:42', '2015-12-23 12:21:42'),
(11, 'asd', '', 'Active', 3, 'sdasd', '2016-01-27 13:08:46', '2016-01-27 13:08:46');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `advertiser_model_map`
--

INSERT INTO `advertiser_model_map` (`id`, `advertiser_id`, `model_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 11, 2, '', '2016-01-27 13:08:46', '2016-01-27 13:08:46');

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
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
(22, 'yyy.com', 4, '2016-01-21 12:23:09', '2016-01-21 12:23:09');

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
) ENGINE=InnoDB AUTO_INCREMENT=269 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `audits`
--

INSERT INTO `audits` (`id`, `user_id`, `entity_type`, `entity_id`, `audit_type`, `field`, `before_value`, `after_value`, `change_key`, `date_change`, `created_at`, `updated_at`) VALUES
(163, 1, 'modelTable', 4, 'edit', 'name', 'test111', 'test1111', '$2y$10$v.4samEGzl3/QaHMRjmXw.6cV4nlgTBlttgAK5JnX7kUb4lA5o/hC', '2016-01-25 13:45:53', '2016-01-25 13:45:53', '2016-01-25 13:45:53'),
(164, 1, 'modelTable', 4, 'edit', 'segment_name_seed', '2341', '23411', '$2y$10$v.4samEGzl3/QaHMRjmXw.6cV4nlgTBlttgAK5JnX7kUb4lA5o/hC', '2016-01-25 13:45:53', '2016-01-25 13:45:53', '2016-01-25 13:45:53'),
(165, 1, 'modelTable', 4, 'edit', 'description', 'axdffs1', 'axdffs12', '$2y$10$v.4samEGzl3/QaHMRjmXw.6cV4nlgTBlttgAK5JnX7kUb4lA5o/hC', '2016-01-25 13:45:53', '2016-01-25 13:45:53', '2016-01-25 13:45:53'),
(166, 1, 'modelTable', 4, 'edit', 'feature_recency_in_sec', '3241', '32411', '$2y$10$v.4samEGzl3/QaHMRjmXw.6cV4nlgTBlttgAK5JnX7kUb4lA5o/hC', '2016-01-25 13:45:53', '2016-01-25 13:45:53', '2016-01-25 13:45:53'),
(167, 1, 'modelTable', 4, 'edit', 'max_num_both_neg_pos_devices', '231', '2312', '$2y$10$v.4samEGzl3/QaHMRjmXw.6cV4nlgTBlttgAK5JnX7kUb4lA5o/hC', '2016-01-25 13:45:53', '2016-01-25 13:45:53', '2016-01-25 13:45:53'),
(168, 1, 'modelTable', 4, 'edit', 'cut_off_score', '1.00', '11.00', '$2y$10$v.4samEGzl3/QaHMRjmXw.6cV4nlgTBlttgAK5JnX7kUb4lA5o/hC', '2016-01-25 13:45:53', '2016-01-25 13:45:53', '2016-01-25 13:45:53'),
(169, 1, 'modelTable', 4, 'edit', 'pixel_hit_recency_in_seconds', '1', '12', '$2y$10$v.4samEGzl3/QaHMRjmXw.6cV4nlgTBlttgAK5JnX7kUb4lA5o/hC', '2016-01-25 13:45:53', '2016-01-25 13:45:53', '2016-01-25 13:45:53'),
(170, 1, 'modelTable', 4, 'edit', 'max_number_of_device_history_per_feature', '1', '12', '$2y$10$v.4samEGzl3/QaHMRjmXw.6cV4nlgTBlttgAK5JnX7kUb4lA5o/hC', '2016-01-25 13:45:53', '2016-01-25 13:45:53', '2016-01-25 13:45:53'),
(171, 1, 'modelTable', 4, 'edit', 'number_of_positive_device_to_be_used_for_modeling', '1', '12', '$2y$10$v.4samEGzl3/QaHMRjmXw.6cV4nlgTBlttgAK5JnX7kUb4lA5o/hC', '2016-01-25 13:45:53', '2016-01-25 13:45:53', '2016-01-25 13:45:53'),
(172, 1, 'modelTable', 4, 'edit', 'number_of_negative_device_to_be_used_for_modeling', '1', '12', '$2y$10$v.4samEGzl3/QaHMRjmXw.6cV4nlgTBlttgAK5JnX7kUb4lA5o/hC', '2016-01-25 13:45:53', '2016-01-25 13:45:53', '2016-01-25 13:45:53'),
(173, 1, 'modelTable', 4, 'edit', 'number_of_both_negative_positive_device_to_be_used', '1', '12', '$2y$10$v.4samEGzl3/QaHMRjmXw.6cV4nlgTBlttgAK5JnX7kUb4lA5o/hC', '2016-01-25 13:45:53', '2016-01-25 13:45:53', '2016-01-25 13:45:53'),
(174, 1, 'positive_offer_model', 1, 'add', '', '', '4', '$2y$10$v.4samEGzl3/QaHMRjmXw.6cV4nlgTBlttgAK5JnX7kUb4lA5o/hC', '2016-01-25 13:45:53', '2016-01-25 13:45:53', '2016-01-25 13:45:53'),
(175, 1, 'negative_offer_model', 1, 'del', '', '', '4', '$2y$10$v.4samEGzl3/QaHMRjmXw.6cV4nlgTBlttgAK5JnX7kUb4lA5o/hC', '2016-01-25 13:45:53', '2016-01-25 13:45:53', '2016-01-25 13:45:53'),
(176, 1, 'negative_offer_model', 1, 'add', '', '', '4', '$2y$10$jbWSnAwjEtV2u0gvZmwTKu78q3CwRdVn1Rk1ZAUr9gvAcVtyLoSyi', '2016-01-25 14:35:34', '2016-01-25 14:35:34', '2016-01-25 14:35:34'),
(177, 1, 'negative_offer_model', 2, 'add', '', '', '4', '$2y$10$jbWSnAwjEtV2u0gvZmwTKu78q3CwRdVn1Rk1ZAUr9gvAcVtyLoSyi', '2016-01-25 14:35:34', '2016-01-25 14:35:34', '2016-01-25 14:35:34'),
(178, 1, 'positive_offer_model', 1, 'del', '', '', '4', '$2y$10$jbWSnAwjEtV2u0gvZmwTKu78q3CwRdVn1Rk1ZAUr9gvAcVtyLoSyi', '2016-01-25 14:35:34', '2016-01-25 14:35:34', '2016-01-25 14:35:34'),
(179, 1, 'positive_offer_model', 2, 'del', '', '', '4', '$2y$10$jbWSnAwjEtV2u0gvZmwTKu78q3CwRdVn1Rk1ZAUr9gvAcVtyLoSyi', '2016-01-25 14:35:34', '2016-01-25 14:35:34', '2016-01-25 14:35:34'),
(180, 1, 'modelTable', 4, 'edit', 'name', 'test1111', 'test11112', '$2y$10$iDLz.7vlfxy0.A6AnQ3LVeqUTHOfoalB4PfOzWqwJrzw1IsqEA7NC', '2016-01-25 15:35:04', '2016-01-25 15:35:04', '2016-01-25 15:35:04'),
(181, 1, 'modelTable', 4, 'edit', 'segment_name_seed', '23411', '234112', '$2y$10$iDLz.7vlfxy0.A6AnQ3LVeqUTHOfoalB4PfOzWqwJrzw1IsqEA7NC', '2016-01-25 15:35:04', '2016-01-25 15:35:04', '2016-01-25 15:35:04'),
(182, 1, 'modelTable', 4, 'edit', 'description', 'axdffs12', 'axdffs122', '$2y$10$iDLz.7vlfxy0.A6AnQ3LVeqUTHOfoalB4PfOzWqwJrzw1IsqEA7NC', '2016-01-25 15:35:04', '2016-01-25 15:35:04', '2016-01-25 15:35:04'),
(183, 1, 'modelTable', 4, 'edit', 'feature_recency_in_sec', '32411', '324112', '$2y$10$iDLz.7vlfxy0.A6AnQ3LVeqUTHOfoalB4PfOzWqwJrzw1IsqEA7NC', '2016-01-25 15:35:04', '2016-01-25 15:35:04', '2016-01-25 15:35:04'),
(184, 1, 'modelTable', 4, 'edit', 'max_num_both_neg_pos_devices', '2312', '23122', '$2y$10$iDLz.7vlfxy0.A6AnQ3LVeqUTHOfoalB4PfOzWqwJrzw1IsqEA7NC', '2016-01-25 15:35:04', '2016-01-25 15:35:04', '2016-01-25 15:35:04'),
(185, 1, 'modelTable', 4, 'edit', 'cut_off_score', '11.00', '11.002', '$2y$10$iDLz.7vlfxy0.A6AnQ3LVeqUTHOfoalB4PfOzWqwJrzw1IsqEA7NC', '2016-01-25 15:35:04', '2016-01-25 15:35:04', '2016-01-25 15:35:04'),
(186, 1, 'modelTable', 4, 'edit', 'pixel_hit_recency_in_seconds', '12', '1223', '$2y$10$iDLz.7vlfxy0.A6AnQ3LVeqUTHOfoalB4PfOzWqwJrzw1IsqEA7NC', '2016-01-25 15:35:04', '2016-01-25 15:35:04', '2016-01-25 15:35:04'),
(187, 1, 'modelTable', 4, 'edit', 'max_number_of_device_history_per_feature', '12', '122', '$2y$10$iDLz.7vlfxy0.A6AnQ3LVeqUTHOfoalB4PfOzWqwJrzw1IsqEA7NC', '2016-01-25 15:35:04', '2016-01-25 15:35:04', '2016-01-25 15:35:04'),
(188, 1, 'modelTable', 4, 'edit', 'number_of_positive_device_to_be_used_for_modeling', '12', '122', '$2y$10$iDLz.7vlfxy0.A6AnQ3LVeqUTHOfoalB4PfOzWqwJrzw1IsqEA7NC', '2016-01-25 15:35:04', '2016-01-25 15:35:04', '2016-01-25 15:35:04'),
(189, 1, 'modelTable', 4, 'edit', 'number_of_negative_device_to_be_used_for_modeling', '12', '122', '$2y$10$iDLz.7vlfxy0.A6AnQ3LVeqUTHOfoalB4PfOzWqwJrzw1IsqEA7NC', '2016-01-25 15:35:04', '2016-01-25 15:35:04', '2016-01-25 15:35:04'),
(190, 1, 'modelTable', 4, 'edit', 'number_of_both_negative_positive_device_to_be_used', '12', '122', '$2y$10$iDLz.7vlfxy0.A6AnQ3LVeqUTHOfoalB4PfOzWqwJrzw1IsqEA7NC', '2016-01-25 15:35:04', '2016-01-25 15:35:04', '2016-01-25 15:35:04'),
(191, 1, 'positive_offer_model', 2, 'add', '', '', '4', '$2y$10$iDLz.7vlfxy0.A6AnQ3LVeqUTHOfoalB4PfOzWqwJrzw1IsqEA7NC', '2016-01-25 15:35:04', '2016-01-25 15:35:04', '2016-01-25 15:35:04'),
(192, 1, 'negative_offer_model', 2, 'del', '', '', '4', '$2y$10$iDLz.7vlfxy0.A6AnQ3LVeqUTHOfoalB4PfOzWqwJrzw1IsqEA7NC', '2016-01-25 15:35:04', '2016-01-25 15:35:04', '2016-01-25 15:35:04'),
(193, 1, 'modelTable', 4, 'edit', 'name', 'test1111', 'test11112', '$2y$10$iDLz.7vlfxy0.A6AnQ3LVeqUTHOfoalB4PfOzWqwJrzw1IsqEA7NC', '2016-01-25 15:35:04', '2016-01-25 15:35:04', '2016-01-25 15:35:04'),
(194, 1, 'modelTable', 4, 'edit', 'segment_name_seed', '23411', '234112', '$2y$10$iDLz.7vlfxy0.A6AnQ3LVeqUTHOfoalB4PfOzWqwJrzw1IsqEA7NC', '2016-01-25 15:35:04', '2016-01-25 15:35:04', '2016-01-25 15:35:04'),
(195, 1, 'modelTable', 4, 'edit', 'description', 'axdffs12', 'axdffs122', '$2y$10$iDLz.7vlfxy0.A6AnQ3LVeqUTHOfoalB4PfOzWqwJrzw1IsqEA7NC', '2016-01-25 15:35:04', '2016-01-25 15:35:04', '2016-01-25 15:35:04'),
(196, 1, 'modelTable', 4, 'edit', 'feature_recency_in_sec', '32411', '324112', '$2y$10$iDLz.7vlfxy0.A6AnQ3LVeqUTHOfoalB4PfOzWqwJrzw1IsqEA7NC', '2016-01-25 15:35:04', '2016-01-25 15:35:04', '2016-01-25 15:35:04'),
(197, 1, 'modelTable', 4, 'edit', 'max_num_both_neg_pos_devices', '2312', '23122', '$2y$10$iDLz.7vlfxy0.A6AnQ3LVeqUTHOfoalB4PfOzWqwJrzw1IsqEA7NC', '2016-01-25 15:35:04', '2016-01-25 15:35:04', '2016-01-25 15:35:04'),
(198, 1, 'modelTable', 4, 'edit', 'cut_off_score', '11.00', '11.002', '$2y$10$iDLz.7vlfxy0.A6AnQ3LVeqUTHOfoalB4PfOzWqwJrzw1IsqEA7NC', '2016-01-25 15:35:04', '2016-01-25 15:35:04', '2016-01-25 15:35:04'),
(199, 1, 'modelTable', 4, 'edit', 'pixel_hit_recency_in_seconds', '12', '1223', '$2y$10$iDLz.7vlfxy0.A6AnQ3LVeqUTHOfoalB4PfOzWqwJrzw1IsqEA7NC', '2016-01-25 15:35:04', '2016-01-25 15:35:04', '2016-01-25 15:35:04'),
(200, 1, 'modelTable', 4, 'edit', 'max_number_of_device_history_per_feature', '12', '122', '$2y$10$iDLz.7vlfxy0.A6AnQ3LVeqUTHOfoalB4PfOzWqwJrzw1IsqEA7NC', '2016-01-25 15:35:04', '2016-01-25 15:35:04', '2016-01-25 15:35:04'),
(201, 1, 'modelTable', 4, 'edit', 'number_of_positive_device_to_be_used_for_modeling', '12', '122', '$2y$10$iDLz.7vlfxy0.A6AnQ3LVeqUTHOfoalB4PfOzWqwJrzw1IsqEA7NC', '2016-01-25 15:35:04', '2016-01-25 15:35:04', '2016-01-25 15:35:04'),
(202, 1, 'modelTable', 4, 'edit', 'number_of_negative_device_to_be_used_for_modeling', '12', '122', '$2y$10$iDLz.7vlfxy0.A6AnQ3LVeqUTHOfoalB4PfOzWqwJrzw1IsqEA7NC', '2016-01-25 15:35:04', '2016-01-25 15:35:04', '2016-01-25 15:35:04'),
(203, 1, 'modelTable', 4, 'edit', 'number_of_both_negative_positive_device_to_be_used', '12', '122', '$2y$10$iDLz.7vlfxy0.A6AnQ3LVeqUTHOfoalB4PfOzWqwJrzw1IsqEA7NC', '2016-01-25 15:35:04', '2016-01-25 15:35:04', '2016-01-25 15:35:04'),
(204, 1, 'advertiser', 4, 'edit', 'status', '1', '0', '$2y$10$GkCCsUlkflN.9FfZQAIYZeQb325wW3rVj4fCxVN.Jv4p33ioB1gZ2', '2016-01-26 09:57:14', '2016-01-26 09:57:14', '2016-01-26 09:57:14'),
(205, 1, 'advertiser', 4, 'edit', 'status', 'Disable', 'Active', '$2y$10$tU5KXZJT5QbCgUXHdUH4UuPgsAzlglJcNMFFmNuIvV3oKi4LTv4DO', '2016-01-26 10:01:29', '2016-01-26 10:01:29', '2016-01-26 10:01:29'),
(206, 1, 'advertiser', 4, 'edit', 'status', 'Active', 'Disable', '$2y$10$nN5Bc6JdqCim6rE6f7Umg.6hdAoo6OUz3nfx6dCSs.bu4Qr3Sfzb2', '2016-01-26 10:05:06', '2016-01-26 10:05:06', '2016-01-26 10:05:06'),
(207, 1, 'advertiser', 4, 'edit', 'status', 'Disable', 'Active', '$2y$10$z67I9eYaZ/45AyTHC6eZ/e2niAE765qGUEsyK9eh5/YSL6reFoh8.', '2016-01-26 10:05:08', '2016-01-26 10:05:08', '2016-01-26 10:05:08'),
(208, 1, 'advertiser', 4, 'edit', 'status', 'Active', 'Disable', '$2y$10$gLdrr0p5YAjgxho.7RyZKuQSC.TJoWdIxRrvehaJc2DRCjCqIc9Ay', '2016-01-26 10:05:13', '2016-01-26 10:05:13', '2016-01-26 10:05:13'),
(209, 1, 'advertiser', 4, 'edit', 'status', 'Disable', 'Active', '$2y$10$QzT.fsTVYYHee.gdy2OQ2.le0ehQv3KPAJ67RupVQeM/FUGcWLepW', '2016-01-26 10:05:15', '2016-01-26 10:05:15', '2016-01-26 10:05:15'),
(210, 1, 'advertiser', 4, 'edit', 'status', 'Active', 'Disable', '$2y$10$MYkkAin6xQ3JNbCuRp.1jubJ4/MwYy.rq.mxEA5.9mV72Lwi8i7Ii', '2016-01-26 10:05:30', '2016-01-26 10:05:30', '2016-01-26 10:05:30'),
(211, 1, 'advertiser', 4, 'edit', 'status', 'Disable', 'Active', '$2y$10$DiXAIPE/L83RFRwLhME9YO0HJf1MWJHP5Some0lZu6biDIzImAyRq', '2016-01-26 10:05:32', '2016-01-26 10:05:32', '2016-01-26 10:05:32'),
(212, 1, 'advertiser', 4, 'edit', 'status', 'Active', 'Disable', '$2y$10$X9Pfb22h/.tN.o7kQOui9.rXV94Bl/YZQ6kTJS2qxJMMaMYHOREsO', '2016-01-26 10:06:24', '2016-01-26 10:06:24', '2016-01-26 10:06:24'),
(213, 1, 'advertiser', 4, 'edit', 'status', 'Disable', 'Active', '$2y$10$EmkfzsZ4eigEpARrtW65Uu50zOK0lvliB.LfuA5YBJ7gn4uY8VdXm', '2016-01-26 10:06:26', '2016-01-26 10:06:26', '2016-01-26 10:06:26'),
(214, 1, 'advertiser', 6, 'edit', 'status', 'Disable', 'Active', '$2y$10$JrAAyFdef1PH/NUTu8rtMOfGjw0z.qH7Qm/2aam8c4P.pxB3K6MYG', '2016-01-26 10:06:29', '2016-01-26 10:06:29', '2016-01-26 10:06:29'),
(215, 1, 'advertiser', 6, 'edit', 'status', 'Active', 'Disable', '$2y$10$OPS4hUyQlCDFUvQXVQV1XOaMxDeA.z8NN7hFfl0QVuq3m8H6B525q', '2016-01-26 10:06:58', '2016-01-26 10:06:58', '2016-01-26 10:06:58'),
(216, 1, 'advertiser', 8, 'edit', 'status', 'Active', 'Disable', '$2y$10$cm3TeRFs5a9U/FhstzT2j.cCQEBz8zZ2ehsELDP9fn43XYei5oQEW', '2016-01-26 10:06:59', '2016-01-26 10:06:59', '2016-01-26 10:06:59'),
(217, 1, 'advertiser', 8, 'edit', 'status', 'Disable', 'Active', '$2y$10$Nocu0a5QeDLftKxEiW2Fm./QQu9zT9eyONQ0JLFWDnVWgw8ux.6Wi', '2016-01-26 10:07:29', '2016-01-26 10:07:29', '2016-01-26 10:07:29'),
(218, 1, 'advertiser', 8, 'edit', 'status', 'Active', 'Disable', '$2y$10$lDOjuA6ENC0UiPb5VAwiBupbPTDKuVOXYSBu0ZZ191/NNaGUHq5/6', '2016-01-26 10:07:31', '2016-01-26 10:07:31', '2016-01-26 10:07:31'),
(219, 1, 'advertiser', 2, 'edit', 'status', 'Active', 'Disable', '$2y$10$UaCYj8tCq4FBuTfFeirZZuZMmaeO.fL2QFbqjVVOjAxDlMy9SOXQm', '2016-01-26 10:07:36', '2016-01-26 10:07:36', '2016-01-26 10:07:36'),
(220, 1, 'advertiser', 2, 'edit', 'status', 'Disable', 'Active', '$2y$10$jHotJ1RK/SRCa54.VGJoMe1041lyqB/BTRXhCTwLc6Dtn9AVEAMd.', '2016-01-26 10:07:37', '2016-01-26 10:07:38', '2016-01-26 10:07:38'),
(221, 1, 'advertiser', 4, 'edit', 'status', 'Active', 'Disable', '$2y$10$7sXniloWOFiu5jnRa1ybHORwHlECdW7L0oF6nEUaRb3F4XTgU8Q9u', '2016-01-26 10:19:55', '2016-01-26 10:19:55', '2016-01-26 10:19:55'),
(222, 1, 'advertiser', 5, 'edit', 'status', 'Active', 'Disable', '$2y$10$oXBumzjKN2kwrv/mQbDY3.no4896psWjR64q07AolSMrERov9me06', '2016-01-26 10:19:55', '2016-01-26 10:19:56', '2016-01-26 10:19:56'),
(223, 1, 'advertiser', 6, 'edit', 'status', 'Disable', 'Active', '$2y$10$jkpqE5RFBRQiN.6tWo9st.VN/6Eu0b3/5ch2ZD/YA4Xzdp4edvxnS', '2016-01-26 10:19:56', '2016-01-26 10:19:56', '2016-01-26 10:19:56'),
(224, 1, 'advertiser', 6, 'edit', 'status', 'Active', 'Disable', '$2y$10$qgRqtpsuksrcqHfW7bfHt.Uch263qg6.Y0a7/xlAkrBNtaOPIH3VS', '2016-01-26 10:20:06', '2016-01-26 10:20:06', '2016-01-26 10:20:06'),
(225, 1, 'advertiser', 4, 'edit', 'status', 'Disable', 'Active', '$2y$10$UMz3pSucgvO0EBHYndkSEeN933YBbq9V90CSC9mScg6RPGllYfKy6', '2016-01-26 10:20:09', '2016-01-26 10:20:10', '2016-01-26 10:20:10'),
(226, 1, 'advertiser', 5, 'edit', 'status', 'Disable', 'Active', '$2y$10$jer0zDJpV.BKib1gOrLqV.wvmtzM5SXeMyyc.MnYv/kNwWUAgixD2', '2016-01-26 10:20:10', '2016-01-26 10:20:10', '2016-01-26 10:20:10'),
(227, 1, 'advertiser', 6, 'edit', 'status', 'Disable', 'Active', '$2y$10$wNeqBnsnmv63cx43zy982.dkcAdG4b2jrsaw79T2kB0b0RP4XZwFW', '2016-01-26 10:20:11', '2016-01-26 10:20:11', '2016-01-26 10:20:11'),
(228, 1, 'creative', 4, 'edit', 'status', 'Active', 'Disable', '$2y$10$.LP.qG84ggbBHXrWlovf2ORVd2ZYYHlfEI7hL310qnzRQRgSiaNSS', '2016-01-26 10:20:42', '2016-01-26 10:20:42', '2016-01-26 10:20:42'),
(229, 1, 'creative', 5, 'edit', 'status', 'Active', 'Disable', '$2y$10$tPnXJL2ffY0Kc6TIbSa20eXjQFgRHAQspB3MFhUALlKNpNyG/7JDO', '2016-01-26 10:20:42', '2016-01-26 10:20:43', '2016-01-26 10:20:43'),
(230, 1, 'creative', 6, 'edit', 'status', 'Active', 'Disable', '$2y$10$Hz6ThzcFBt7w6MmatwxTHOivzsJoT99Z77bjNrcXTeGoDso949Qv.', '2016-01-26 10:20:43', '2016-01-26 10:20:43', '2016-01-26 10:20:43'),
(231, 1, 'creative', 2, 'edit', 'status', 'Active', 'Disable', '$2y$10$NP3gyecKwbu1TTNWwQMnP.ikbiOCvQAjWKgd/q/7knV/CFDjGri1W', '2016-01-26 10:20:44', '2016-01-26 10:20:44', '2016-01-26 10:20:44'),
(232, 1, 'creative', 3, 'edit', 'status', 'Active', 'Disable', '$2y$10$sgjelqqxIXD/DS5T5LtOWOW0DqsyCzH6Go9AMhOV/HERIGqUQV7Ji', '2016-01-26 10:20:44', '2016-01-26 10:20:44', '2016-01-26 10:20:44'),
(233, 1, 'creative', 4, 'edit', 'status', 'Disable', 'Active', '$2y$10$3dcFIIxwdb8IJrO0IW8Js.otcHpCYKEHkkxptNLO8.orHb4eZa9ne', '2016-01-26 10:20:45', '2016-01-26 10:20:46', '2016-01-26 10:20:46'),
(234, 1, 'creative', 5, 'edit', 'status', 'Disable', 'Active', '$2y$10$ra.1Ky/uqt/QJ7emXC8NselrJmN/7N7E17ct4RIGl0GShj1rEPBum', '2016-01-26 10:20:46', '2016-01-26 10:20:46', '2016-01-26 10:20:46'),
(235, 1, 'creative', 6, 'edit', 'status', 'Disable', 'Active', '$2y$10$6NJProX5hsgk5O7uaI98yOIhV7ZQ105plXwR5FMphc39fgIcHSKaO', '2016-01-26 10:20:46', '2016-01-26 10:20:47', '2016-01-26 10:20:47'),
(236, 1, 'offer', 1, 'edit', 'status', 'Active', 'Disable', '$2y$10$9BoiZKGIbzVO6jG0xDWvMeHq6WbCDZRzZmO0SkLqLRyArsM9b.thG', '2016-01-26 10:27:57', '2016-01-26 10:27:57', '2016-01-26 10:27:57'),
(237, 1, 'campaign', 8, 'edit', 'status', '0', 'Disable', '$2y$10$vE.izWnQhQULDOqDfJR0Pe.3wgAdVuX2cV.r8b3aPVIBzP1L0Ubmq', '2016-01-26 10:28:17', '2016-01-26 10:28:17', '2016-01-26 10:28:17'),
(238, 1, 'campaign', 4, 'edit', 'status', 'Active', 'Disable', '$2y$10$02K3HLGJcvbN6Kv2Tm1kcuBLw2VTCLP8kwesELHsh8hqpr6VNKgO.', '2016-01-26 10:29:35', '2016-01-26 10:29:35', '2016-01-26 10:29:35'),
(239, 1, 'campaign', 5, 'edit', 'status', 'Active', 'Disable', '$2y$10$oy0.v2jb/q.R0pcUDLOKduudWEl5evxxINvVAqe3Eqx9f9gGUCuou', '2016-01-26 10:29:35', '2016-01-26 10:29:36', '2016-01-26 10:29:36'),
(240, 1, 'pixel', 1, 'edit', 'status', 'Active', 'Disable', '$2y$10$cnaVHEFqEDpYwu.itgyd/..xJSIowZDYsU4lUiG8YuD8T3MS7I3Dq', '2016-01-26 10:31:21', '2016-01-26 10:31:21', '2016-01-26 10:31:21'),
(241, 1, 'geosegment', 14, 'edit', 'status', 'Active', 'Disable', '$2y$10$Yqc.WSslR0i2B/NQ6G0AneSpTlgw6ga31wdvQFfA5AvGO2r3nTFZW', '2016-01-26 11:04:25', '2016-01-26 11:04:25', '2016-01-26 11:04:25'),
(242, 1, 'geosegment', 13, 'edit', 'status', 'Active', 'Disable', '$2y$10$aEdg8jroWte/K1s78AEXyOzvwaow0N2Zj11CH15Ebj26gotglf4k2', '2016-01-26 11:04:26', '2016-01-26 11:04:26', '2016-01-26 11:04:26'),
(243, 1, 'bwlist', 19, 'edit', 'status', 'Active', 'Disable', '$2y$10$OPSVP17SPfgwGPCC9fwe9OMWqi14MeNIMHZNiFszz/NTZvYHz0h/S', '2016-01-26 11:08:31', '2016-01-26 11:08:31', '2016-01-26 11:08:31'),
(244, 1, 'bwlist', 17, 'edit', 'status', 'Active', 'Disable', '$2y$10$HPdh2Rq0OTlNFOY.MFABwOcAt.C8qCBAdTvm/kqhHnlAlhHlptd92', '2016-01-26 11:08:33', '2016-01-26 11:08:33', '2016-01-26 11:08:33'),
(245, 1, 'advertiser', 9, 'edit', 'status', 'Active', 'Disable', '$2y$10$6AWel60WXtmuIfnIEqTRpeOV3Suy7R5fxRH4NRxExJKdAMf6nO88e', '2016-01-26 13:11:57', '2016-01-26 13:11:57', '2016-01-26 13:11:57'),
(246, 1, 'advertiser', 9, 'edit', 'status', 'Disable', 'Active', '$2y$10$KB7b9MCy7RzUcS9P7WJiUucU9JB4bSlwnvS2jroTe/g9VL3d2lO0O', '2016-01-26 13:11:58', '2016-01-26 13:11:59', '2016-01-26 13:11:59'),
(247, 1, 'advertiser', 2, 'edit', 'status', 'Active', 'Disable', '$2y$10$tJhz/qjAZhWKFZz9wbQVUuKEoiu3jdBHtldL4jaSMF4pSnVY3gQwK', '2016-01-26 13:12:01', '2016-01-26 13:12:01', '2016-01-26 13:12:01'),
(248, 1, 'campaign', 6, 'edit', 'status', 'Active', 'Disable', '$2y$10$.DZIlIcu4Ghg6wGmjK5D9OFWFkNFh/3ABPDMh69lJqlRvFzOc0wtu', '2016-01-26 13:12:08', '2016-01-26 13:12:08', '2016-01-26 13:12:08'),
(249, 1, 'creative', 4, 'edit', 'status', 'Active', 'Disable', '$2y$10$t9g5oLLhSgjnYY3oUipHFuNR6d/EaDFEswui2wUODl3mbT0M4Ucpm', '2016-01-26 13:12:12', '2016-01-26 13:12:12', '2016-01-26 13:12:12'),
(250, 1, 'offer', 2, 'edit', 'status', 'Active', 'Disable', '$2y$10$bGrpfNuh3oAgmhiRl0.ssefryt/ePj9jXc6126Y.CjIRvKV2mUQfa', '2016-01-26 13:12:15', '2016-01-26 13:12:15', '2016-01-26 13:12:15'),
(251, 1, 'offer', 1, 'edit', 'status', 'Disable', 'Active', '$2y$10$EC7t2wpDXG.a94Q4LvdUnedAOJ7cl/BK4HnQJ7TwJ9p3WGKm2hNsO', '2016-01-26 13:12:16', '2016-01-26 13:12:16', '2016-01-26 13:12:16'),
(252, 1, 'offer', 2, 'edit', 'status', 'Disable', 'Active', '$2y$10$XwGeIpiBB38X62SP1ZFo1OrdUES1OOQPBOQKFhrbwhHVXRm0vueJ6', '2016-01-26 13:12:16', '2016-01-26 13:12:16', '2016-01-26 13:12:16'),
(253, 1, 'pixel', 1, 'edit', 'status', 'Disable', 'Active', '$2y$10$7c/QEzYGtuMamAjWAkrOZeBu.jg2e9i4/UHcB81ERMqMfMQTjuV6y', '2016-01-26 13:12:19', '2016-01-26 13:12:19', '2016-01-26 13:12:19'),
(254, 1, 'pixel', 2, 'edit', 'status', 'Active', 'Disable', '$2y$10$.B598HJIDBGjXuPRtvp8CeA2LDooxLDwPs3HTk4J5NlWzPujuiX7a', '2016-01-26 13:12:19', '2016-01-26 13:12:19', '2016-01-26 13:12:19'),
(255, 1, 'bwlistentrie', 149, 'edit', 'domain_name', 'asdaasdasd1231233123s.com', 'asdaasdasd12312313123s.com', '$2y$10$is1oIGMPZOyznuIXy1cmiegl9tm/uHtagnm6pjLxObOrj8pjFd.wS', '2016-01-27 12:34:31', '2016-01-27 12:34:31', '2016-01-27 12:34:31'),
(256, 1, 'bwlistentrie', 149, 'edit', 'domain_name', 'asdaasdasd1231233123s.com', 'asdaasdasd123123s3123s.com', '$2y$10$cZUeUWrXxs2mfoU2GXit3e845COJxH1Ub7BMNCJYZBIzBYM3u63xq', '2016-01-27 12:39:33', '2016-01-27 12:39:34', '2016-01-27 12:39:34'),
(257, 1, 'bwlistentrie', 155, 'add', '', '', '17', '$2y$10$LobD7rCaXs2LGmRB3AV4zuXAbl0pi.eLc8Wbgx8FK77tDL00fQA3G', '2016-01-27 12:41:17', '2016-01-27 12:41:17', '2016-01-27 12:41:17'),
(258, 1, 'adv_mdl_map', 2, 'add', '', '', '11', '$2y$10$7vKCaVyu8lKAz8cikKLiounZjyUIJu0UsYcP2l3VtwJ/MvKNSVLAS', '2016-01-27 13:08:46', '2016-01-27 13:08:46', '2016-01-27 13:08:46'),
(259, 1, 'advertiser', 11, 'add', '', '', '', '$2y$10$7vKCaVyu8lKAz8cikKLiounZjyUIJu0UsYcP2l3VtwJ/MvKNSVLAS', '2016-01-27 13:08:46', '2016-01-27 13:08:46', '2016-01-27 13:08:46'),
(260, 1, 'bwlistentrie', 155, 'edit', 'domain_name', 'asdasd.com', 'as1dasd.com', '$2y$10$/DssdKB9gQHahUC2YYyuneSxB130fHpA4rv8iDyKeZ6b8tFLHKZr6', '2016-01-27 13:19:21', '2016-01-27 13:19:21', '2016-01-27 13:19:21'),
(261, 1, 'bwlistentrie', 156, 'add', '', '', '17', '$2y$10$IGamTMXT5TZ6w06cbhPum.Gtr0NbFi2fAy1S054yNdg37RebrsQ0.', '2016-01-27 13:19:27', '2016-01-27 13:19:27', '2016-01-27 13:19:27'),
(262, 1, 'bwlistentrie', 157, 'add', '', '', '17', '$2y$10$E0dUilppztIdnt7p/ULO4OR0SebKsoL.37S.MRwfImYTtTZ1vL0rm', '2016-01-27 13:20:40', '2016-01-27 13:20:40', '2016-01-27 13:20:40'),
(263, 1, 'bwlistentrie', 158, 'add', '', '', '17', '$2y$10$XWXq50Bzu0jEefHMRXBuvukFO.bhntFE5P4goI9B4S5S2qf53xCMm', '2016-01-27 13:21:42', '2016-01-27 13:21:42', '2016-01-27 13:21:42'),
(264, 1, 'bwlistentrie', 159, 'add', '', '', '17', '$2y$10$X1r4dRwcCL7WnfzM1hFr9OvGsU0Wi3VDxkeMiTCYhk1SL6eMFjWwy', '2016-01-27 13:23:56', '2016-01-27 13:23:56', '2016-01-27 13:23:56'),
(265, 1, 'campaign', 4, 'edit', 'status', 'Inactive', 'Active', '$2y$10$YXTxLn09bm8MgRUJ.0lv2.SYDQF8tK0C.B8GIHX.lZ8giJ/4e/cYC', '2016-01-27 13:56:07', '2016-01-27 13:56:07', '2016-01-27 13:56:07'),
(266, 1, 'campaign', 4, 'edit', 'status', 'Active', 'Inactive', '$2y$10$TwaL4fI0TAhPV6cfjFF/t.ABP90s9hhmcO0dIG3fhDt7yfIAVAOD.', '2016-01-27 13:56:08', '2016-01-27 13:56:08', '2016-01-27 13:56:08'),
(267, 1, 'campaign', 4, 'edit', 'status', 'Inactive', 'Active', '$2y$10$qwuuHLjzhenM2ar75gUSX.1nHMOb37/rxwSAzlbIWRKUgXNonypOy', '2016-01-27 13:56:42', '2016-01-27 13:56:42', '2016-01-27 13:56:42'),
(268, 1, 'campaign', 4, 'edit', 'status', 'Active', 'Inactive', '$2y$10$pU3CLd9x8gNwPEExKwD/reZAZhy/FHhZz6u9Ip36gfWxEOFvgSZlW', '2016-01-27 13:56:42', '2016-01-27 13:56:42', '2016-01-27 13:56:42');

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
) ENGINE=InnoDB AUTO_INCREMENT=160 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
(159, 'asdasdasdas.com', 17, '2016-01-27 13:23:56', '2016-01-27 13:23:56');

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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bwlist`
--

INSERT INTO `bwlist` (`id`, `name`, `status`, `list_type`, `advertiser_id`, `created_at`, `updated_at`) VALUES
(1, 'shomare 1', 'Active', 'black', 4, '2015-11-20 12:37:03', '2015-11-20 12:37:03'),
(2, 'sdafasdf', 'Active', 'black', 4, '2015-11-20 12:38:15', '2015-11-20 12:38:15'),
(3, 'sdafasdf', 'Active', 'white', 4, '2015-11-20 12:43:21', '2015-11-20 12:43:21'),
(4, 'aaaa', 'Active', 'black', 7, '2015-11-20 12:53:50', '2015-11-20 12:53:50'),
(5, 'aa', 'Active', 'black', 8, '2015-11-20 12:54:09', '2015-11-20 12:54:09'),
(6, 'aa', 'Active', 'black', 8, '2015-11-20 12:54:17', '2015-11-20 12:54:17'),
(7, 'aa', 'Active', 'white', 8, '2015-11-20 12:56:12', '2015-11-20 12:56:12'),
(8, 'ali', 'Active', 'white', 8, '2015-11-21 13:12:34', '2015-11-21 13:12:34'),
(17, 'alireza2', 'Active', 'white', 8, '2015-11-28 13:13:17', '2016-01-26 11:08:33'),
(18, 'alio1', 'Active', 'black', 9, '2015-12-05 12:29:45', '2015-12-21 11:16:30'),
(19, 'reza', 'Active', 'black', 6, '2016-01-18 15:25:21', '2016-01-26 11:08:31');

-- --------------------------------------------------------

--
-- Table structure for table `campaign`
--

CREATE TABLE IF NOT EXISTS `campaign` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `advertiser_id` int(10) unsigned NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
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
(3, 'fsdf111121', 4, 'asdas', 'Active', 13123, 2342, 34231, 4234, 234, '', '2015-11-09 14:32:32', '2015-11-25 14:32:32', '234', '2015-10-14 11:38:02', '2015-12-20 11:34:48'),
(4, 'asdasd', 4, 'asd asd a', 'Inactive', 2332, 2323, 2222, 2222, 222, '', '2016-01-06 08:14:25', '2016-01-14 08:14:25', '222', '2015-10-23 10:07:43', '2016-01-27 13:56:42'),
(5, '111111112', 6, 'asdasd3', 'Active', 2223123, 2223123, 2223123, 223123, 22332, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'asdas1', '2015-11-07 13:02:52', '2016-01-26 10:29:36'),
(6, 'aaaaaaaa', 4, '', 'Active', 2147483647, 2147483647, 2234123, 2123, 2147483647, '', '2016-01-18 12:32:38', '2016-01-30 12:32:38', 'aaaaaaa', '2015-11-17 07:42:08', '2016-01-26 13:12:08'),
(7, 'asd', 8, '', 'Active', 123, 123, 123, 123, 123, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '123', '2015-11-17 09:31:34', '2015-11-17 09:31:34'),
(8, 'asd', 7, '', 'Active', 2, 2, 2, 2, 2323, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '2015-11-17 09:35:20', '2016-01-26 10:28:17'),
(9, 'asd asd', 9, '', 'Active', 0, 0, 0, 0, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'as das ', '2015-11-17 12:38:53', '2015-11-17 12:38:53');

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id`, `user_id`, `name`, `company`, `created_at`, `updated_at`) VALUES
(1, 1, 'pepsiasd', 'pepsi company', '0000-00-00 00:00:00', '2016-01-18 10:03:29'),
(2, 1, 'cocacola', 'cocacola company', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 1, 'alireza_pepsi', 'aaa', '2015-10-08 11:47:15', '2015-10-08 11:47:15'),
(4, 2, 'ali', 'ssss', '2015-10-08 11:50:08', '2015-10-08 11:50:08'),
(5, 2, 'aaaa', 'aaaaaaaa', '2015-10-10 12:29:23', '2015-10-10 12:29:23'),
(6, 3, 'aaa', '', '2015-12-20 11:03:10', '2015-12-20 11:03:10'),
(7, 4, 'asdasdasd', '', '2015-12-20 11:09:47', '2015-12-20 11:09:47'),
(8, 5, 'sadasd111', '', '2015-12-20 11:10:19', '2015-12-20 11:13:33'),
(9, 1, 'alisssss111', '', '2015-12-22 14:24:19', '2015-12-22 14:24:51'),
(10, 1, 'asldkuajs55111', 'sss111', '2015-12-22 14:24:31', '2016-01-12 10:09:01'),
(11, 1, 'test1112', 'sadasasdsadsadasd', '2016-01-10 12:40:38', '2016-01-10 12:40:38'),
(12, 1, '321321', 'sdfsdf', '2016-01-10 12:48:47', '2016-01-12 12:13:42');

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
  `status` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
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
(2, 'aaa1s', 8, '', 'Active', 'asd', 'ads1', 'adsa', '23x232', 0, 'asd', 'aaaas', '2015-11-17 10:07:22', '2016-01-26 10:20:44'),
(3, 'asdasd1', 7, '12311', 'Active', '2131', '1231', '1231', '1231x231', 0, '1231', '1231', '2015-10-23 06:15:09', '2016-01-26 10:20:44'),
(4, 'as12312', 7, '31231', 'Active', '2131', '1231', '1231', '1231x231', 0, '1231', '1231', '2015-10-23 06:15:09', '2016-01-26 13:12:12'),
(5, 'as32423d1سیبسی', 4, '12311', 'Active', '2131324', '1231234', '1231234', '1231x231', 0, '1231234', '1231', '2015-10-23 06:15:09', '2016-01-26 10:20:46'),
(6, 'hhhghf', 7, '12311', 'Active', '2131', '1231', '1231', '1231x231', 0, '1231', '1231', '2015-10-23 06:15:09', '2016-01-26 10:20:47');

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
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
(27, 'ali`1', '1234', '1234', 1234, 5, '2015-12-15 07:22:03', '2015-12-15 07:22:21'),
(28, 'ali232', '213', '23', 2, 12, '2015-12-27 15:46:52', '2015-12-27 15:46:52'),
(29, 'asd', '324', '234', 234, 13, '2016-01-18 14:21:49', '2016-01-18 14:21:49'),
(30, 'asdf', '324', '234', 34, 13, '2016-01-18 14:21:49', '2016-01-18 14:21:49'),
(31, 'asd', '324', '324', 32, 13, '2016-01-18 14:21:49', '2016-01-18 14:21:49'),
(40, 'sad', '231', '12', 313, 14, '2016-01-18 16:25:08', '2016-01-18 16:25:08'),
(41, 'asdasd', '21312', '312', 31, 14, '2016-01-18 17:16:50', '2016-01-18 17:16:50');

-- --------------------------------------------------------

--
-- Table structure for table `geosegmentlist`
--

CREATE TABLE IF NOT EXISTS `geosegmentlist` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `advertiser_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `geosegmentlist`
--

INSERT INTO `geosegmentlist` (`id`, `name`, `status`, `advertiser_id`, `created_at`, `updated_at`) VALUES
(5, 'aa', 'Active', 7, '2015-11-24 07:48:26', '2015-11-24 07:48:26'),
(6, 'aaaaaaa', 'Active', 7, '2015-11-28 13:14:23', '2015-11-28 13:14:23'),
(7, 'aaaaaaaasdasdas', 'Active', 4, '2015-11-28 13:14:23', '2015-11-28 13:14:23'),
(8, 'gggggggggggg', 'Active', 4, '2015-11-28 13:14:23', '2015-11-28 13:14:23'),
(9, 'ali', 'Active', 8, '2015-12-05 13:25:30', '2015-12-05 13:25:30'),
(11, 'asdasdasdasd', 'Active', 7, '2015-12-05 13:53:02', '2015-12-05 13:53:02'),
(12, 'aa11a112', 'Active', 9, '2015-12-05 13:57:05', '2016-01-17 11:03:44'),
(13, 'asd', 'Active', 4, '2016-01-18 14:21:49', '2016-01-26 11:04:26'),
(14, 'ali', 'Active', 9, '2016-01-18 14:32:09', '2016-01-26 11:04:25');

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
) ENGINE=InnoDB AUTO_INCREMENT=2147306497 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
('2016_01_27_152941_advertiser_model_map-table', 24);

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `model`
--

INSERT INTO `model` (`id`, `name`, `advertiser_id`, `seed_web_sites`, `algo`, `segment_name_seed`, `process_result`, `description`, `num_neg_devices_used`, `num_pos_devices_used`, `feature_recency_in_sec`, `max_num_both_neg_pos_devices`, `negative_features_requested`, `feature_avg_num_history_used`, `negative_feature_used`, `date_of_request`, `created_at`, `updated_at`, `positive_feature_used`, `feature_score_map`, `top_feature_score_map`, `model_type`, `cut_off_score`, `pixel_hit_recency_in_seconds`, `positive_offer_id`, `negative_offer_id`, `max_number_of_device_history_per_feature`, `max_number_of_negative_feature_to_pick`, `number_of_positive_device_to_be_used_for_modeling`, `number_of_negative_device_to_be_used_for_modeling`, `number_of_both_negative_positive_device_to_be_used`, `date_of_request_completion`) VALUES
(1, 'aaa', 6, '"asd,dd,d"', 'heat', 'aaa', 'asdas', '1111', 1, 1, 1, 1, '"asd,fgsd,fg,df,w"', '', '"asd,ac,zc,sdf,g"', '2016-01-11 07:00:06', '2015-11-12 06:34:38', '2015-11-12 07:06:34', '', '', '', '', '0.00', 0, '', '', 0, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(2, 'sad11', 7, '"sad"', '', 'asdas', '234', 'asdasd', 234, 24, 34324, 234, '"asd,addd"', '', '"aaaa"', '2016-05-12 13:36:09', '2015-11-24 11:25:15', '2015-12-21 11:03:42', '', '', '', '', '0.00', 0, '', '', 0, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(4, 'test11112', 4, 'null', '', '234112', 'submitted', 'axdffs122', 0, 0, 324112, 23122, 'null', '', '', '2016-01-25 13:05:02', '2016-01-25 11:09:18', '2016-01-25 15:35:04', '', '', '', 'pixel_model', '11.00', 1223, '2', '1', 122, 0, 122, 122, 122, '2016-01-25 13:05:02');

-- --------------------------------------------------------

--
-- Table structure for table `offer`
--

CREATE TABLE IF NOT EXISTS `offer` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `advertiser_id` int(10) unsigned NOT NULL,
  `description` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `offer`
--

INSERT INTO `offer` (`id`, `name`, `status`, `advertiser_id`, `description`, `created_at`, `updated_at`) VALUES
(1, 'offer1234', 'Active', 4, '', '2016-01-21 11:13:17', '2016-01-26 13:12:16'),
(2, 'offer4', 'Active', 4, '', '2016-01-21 12:35:00', '2016-01-26 13:12:16');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `offer_pixel_map`
--

INSERT INTO `offer_pixel_map` (`id`, `offer_id`, `pixel_id`, `created_at`, `updated_at`) VALUES
(2, 2, 1, '2016-01-21 13:07:07', '2016-01-21 13:07:07');

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
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
(28, 'VIEW_PIXEL', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `pixel`
--

CREATE TABLE IF NOT EXISTS `pixel` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `advertiser_id` int(10) unsigned NOT NULL,
  `part_a` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `part_b` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `version` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pixel`
--

INSERT INTO `pixel` (`id`, `name`, `status`, `advertiser_id`, `part_a`, `part_b`, `version`, `description`, `created_at`, `updated_at`) VALUES
(1, 'asd233', 'Active', 4, 'wXTXfP2d4ggkmJHwXcUvc80vVuAeuLJUJU1gZoAv7cZlsMl1Q6eeDDLdFmvGhKzQjKxq7QwEy06eVGno', '7SWQs1SOM6N0qBMEgsqtCaPGlGA0MtMDLw0kDhnhgIsdYkmlB2GovmvAwerD08yLM2sGcpfC7dvhSVkU', 'version1', '', '2016-01-21 11:47:51', '2016-01-26 13:12:19'),
(2, 'pixle111', 'Active', 4, 'qIx3eXHRwDlpEexTsGU3htx7YA0LStpgP7mhaYX5L0LmWHSkx1VJUqXLTTBaQTW8AozouQzanfybA3BE', 'ZejhUfLic4AqbbQSJx8nbBz8mmITDhGPPj4HhWXHS8WzUl7vfy5effWZImgs2n9T1hcZ2vvZV3FA0nL0', 'version1', '', '2016-01-21 12:35:31', '2016-01-26 13:12:19');

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
) ENGINE=InnoDB AUTO_INCREMENT=508 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
(488, 1, 1, '2016-01-21 10:55:13', '2016-01-21 10:55:13'),
(489, 3, 1, '2016-01-21 10:55:13', '2016-01-21 10:55:13'),
(490, 4, 1, '2016-01-21 10:55:13', '2016-01-21 10:55:13'),
(491, 6, 1, '2016-01-21 10:55:13', '2016-01-21 10:55:13'),
(492, 7, 1, '2016-01-21 10:55:13', '2016-01-21 10:55:13'),
(493, 9, 1, '2016-01-21 10:55:13', '2016-01-21 10:55:13'),
(494, 10, 1, '2016-01-21 10:55:13', '2016-01-21 10:55:13'),
(495, 12, 1, '2016-01-21 10:55:13', '2016-01-21 10:55:13'),
(496, 13, 1, '2016-01-21 10:55:13', '2016-01-21 10:55:13'),
(497, 15, 1, '2016-01-21 10:55:13', '2016-01-21 10:55:13'),
(498, 16, 1, '2016-01-21 10:55:13', '2016-01-21 10:55:13'),
(499, 18, 1, '2016-01-21 10:55:13', '2016-01-21 10:55:13'),
(500, 19, 1, '2016-01-21 10:55:13', '2016-01-21 10:55:13'),
(501, 21, 1, '2016-01-21 10:55:13', '2016-01-21 10:55:13'),
(502, 22, 1, '2016-01-21 10:55:13', '2016-01-21 10:55:13'),
(503, 24, 1, '2016-01-21 10:55:13', '2016-01-21 10:55:13'),
(504, 25, 1, '2016-01-21 10:55:13', '2016-01-21 10:55:13'),
(505, 26, 1, '2016-01-21 10:55:13', '2016-01-21 10:55:13'),
(506, 27, 1, '2016-01-21 10:55:13', '2016-01-21 10:55:13'),
(507, 28, 1, '2016-01-21 10:55:13', '2016-01-21 10:55:13');

-- --------------------------------------------------------

--
-- Table structure for table `targetgroup`
--

CREATE TABLE IF NOT EXISTS `targetgroup` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `campaign_id` int(10) unsigned NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `targetgroup`
--

INSERT INTO `targetgroup` (`id`, `name`, `campaign_id`, `description`, `status`, `iab_category`, `iab_sub_category`, `max_impression`, `daily_max_impression`, `max_budget`, `daily_max_budget`, `pacing_plan`, `cpm`, `frequency_in_sec`, `start_date`, `end_date`, `advertiser_domain_name`, `created_at`, `updated_at`) VALUES
(1, 'dfsasd222', 3, 'df fsdfs d1', 'Active', 'asd1', 'asd1', 32141, 2342341, 2341, 2341, '2341', 2341, 2341, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '234231', '2015-10-22 05:17:18', '2015-10-22 05:42:47'),
(2, 'sadasd', 3, '4ghh', 'Active', '234', '234', 234234, 234, 2341234, 234234, '234234', 456, 45646, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '456456', '2015-10-23 09:56:19', '2015-10-23 09:56:19'),
(3, 'asdasd', 3, 'fhfgh', 'Active', '5646', '456456', 45645, 645, 6456, 46, '464', 4564, 5646, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '46', '2015-10-23 09:59:06', '2015-10-23 09:59:06'),
(4, 'asdasd1', 7, 'ggggfjfjf g gh jfg ', 'Active', '324', '567', 65, 87, 856756, 7567, '567', 567, 567, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '567', '2015-10-23 10:00:05', '2015-10-23 10:00:05'),
(5, 'ali', 3, '', 'Active', '1', NULL, 1, 2, 3, 4, '7', 6, 5, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'ddd', '2015-11-30 14:13:26', '2015-11-30 14:13:26');

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
(1, 1, 2, 'aaa11', 'alireza', '09364991494@yahoo.com', '$2y$10$q0O2WoGF6tKnk7s638v/wue4N4iSKeZ21JwH7JY0XGyj06MDyfF2K', 1, 'kdBtZGoEuNs5jTz6aHyUwNe6oQrY5h5y4bX6Mwol1FEBwzc6xCFOHbcsPtnH', '2016-01-26 00:28:54', '0000-00-00 00:00:00', '2016-01-26 12:28:54'),
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
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `advertiser_model_map`
--
ALTER TABLE `advertiser_model_map`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `advertiser_publisher`
--
ALTER TABLE `advertiser_publisher`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `audits`
--
ALTER TABLE `audits`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=269;
--
-- AUTO_INCREMENT for table `bwentries`
--
ALTER TABLE `bwentries`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=160;
--
-- AUTO_INCREMENT for table `bwlist`
--
ALTER TABLE `bwlist`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `campaign`
--
ALTER TABLE `campaign`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
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
-- AUTO_INCREMENT for table `geolocation`
--
ALTER TABLE `geolocation`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=60;
--
-- AUTO_INCREMENT for table `geosegment`
--
ALTER TABLE `geosegment`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `geosegmentlist`
--
ALTER TABLE `geosegmentlist`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
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
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2147306497;
--
-- AUTO_INCREMENT for table `model`
--
ALTER TABLE `model`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `offer`
--
ALTER TABLE `offer`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `offer_pixel_map`
--
ALTER TABLE `offer_pixel_map`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `permission`
--
ALTER TABLE `permission`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `pixel`
--
ALTER TABLE `pixel`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `role_permission_mapping`
--
ALTER TABLE `role_permission_mapping`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=508;
--
-- AUTO_INCREMENT for table `targetgroup`
--
ALTER TABLE `targetgroup`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `targetgroup_bidhour_map`
--
ALTER TABLE `targetgroup_bidhour_map`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `targetgroup_bid_advpublisher`
--
ALTER TABLE `targetgroup_bid_advpublisher`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `targetgroup_bwlist_map`
--
ALTER TABLE `targetgroup_bwlist_map`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `targetgroup_creative_map`
--
ALTER TABLE `targetgroup_creative_map`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `targetgroup_geolocation_map`
--
ALTER TABLE `targetgroup_geolocation_map`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `targetgroup_geosegmentlist_map`
--
ALTER TABLE `targetgroup_geosegmentlist_map`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
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
-- Constraints for table `user_role_mapping`
--
ALTER TABLE `user_role_mapping`
  ADD CONSTRAINT `user_role_mapping_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_role_mapping_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
