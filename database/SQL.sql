-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 19, 2017 at 02:28 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hasanthe_hy`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `username`, `image`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'thesoftking', 'admin', '1498665028.png', 'admin@thesoftking.com', '$2y$10$rsDrYhqnerYVEKNfZXa8yO4Q0Rx.FKBsW6a9XlPts2fDBVZa/hhFe', '4RQzHke0gJsIojV7iDKQHVNwwH7USsOP9cv3IsnotBQdv5Wj4jA1wvbY5Zy4', NULL, '2017-06-29 02:50:48');

-- --------------------------------------------------------

--
-- Table structure for table `admin_balances`
--

CREATE TABLE `admin_balances` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `balance_type` tinyint(4) NOT NULL,
  `balance` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `charge` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `new_balance` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `old_balance` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `basic_settings`
--

CREATE TABLE `basic_settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `admin_total` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference_bonus` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `withdraw_status` tinyint(4) NOT NULL DEFAULT '0',
  `reference` double(8,2) NOT NULL,
  `reference_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `registration_status` tinyint(4) NOT NULL DEFAULT '0',
  `verify_status` tinyint(4) NOT NULL DEFAULT '0',
  `reCaptcha_status` tinyint(4) NOT NULL DEFAULT '0',
  `site_key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret_key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `symbol` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `m_driver` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `m_host` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `m_port` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `m_username` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `m_password` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `m_enc` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `basic_settings`
--

INSERT INTO `basic_settings` (`id`, `admin_total`, `reference_bonus`, `withdraw_status`, `reference`, `reference_id`, `registration_status`, `verify_status`, `reCaptcha_status`, `site_key`, `secret_key`, `currency`, `symbol`, `m_driver`, `m_host`, `m_port`, `m_username`, `m_password`, `m_enc`, `created_at`, `updated_at`) VALUES
(1, '5183', '0', 1, 0.00, 'GPseDxW8C7Mu', 1, 0, 0, '6LdFKSYUAAAAAJJfjbcLkq4YZVU9mJKZR9KRkakU', '6LdFKSYUAAAAAM0mPnEJFkfjj8G2TmTd-fg2D4dI', 'NGN', '₦', 'smtp', 'smtp.gmail.com', '465', 'hascmrpi@gmail.com', 'lrowxemhrmjarcon', 'ssl', NULL, '2017-09-09 04:02:21');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'World', '2017-06-06 15:00:08', '2017-06-06 15:00:08'),
(2, 'International', '2017-06-06 15:00:42', '2017-06-06 15:00:42'),
(3, 'Local', '2017-06-06 15:02:15', '2017-06-06 15:02:15'),
(4, 'Demo Category', '2017-06-06 15:02:36', '2017-06-06 15:02:36'),
(5, 'Current News', '2017-06-06 15:03:19', '2017-06-06 15:05:49');

-- --------------------------------------------------------

--
-- Table structure for table `choses`
--

CREATE TABLE `choses` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `s_text` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `choses`
--

INSERT INTO `choses` (`id`, `title`, `s_text`, `icon`, `created_at`, `updated_at`) VALUES
(1, 'Fast Approval', 'Established sed fact will that sed tracted by sed the readable of a when looking when layout finish on time.', '<i class=\"fa fa-dashboard\" aria-hidden=\"true\"></i>', '2017-06-22 08:20:36', '2017-06-22 08:20:36'),
(2, 'Refinancing', 'Fact will that sed tracted by sed the readable on a looking when layout will becollections.', '<i class=\"fa fa-send\" aria-hidden=\"true\"></i>', '2017-06-22 08:22:13', '2017-06-22 08:22:28'),
(3, 'Free Documention', 'Tracted by sed the readable on contents of a layout will be collections well documented.', '<i class=\"fa fa-bars\" aria-hidden=\"true\"></i>', '2017-06-22 08:23:39', '2017-06-22 08:33:44');

-- --------------------------------------------------------

--
-- Table structure for table `compounds`
--

CREATE TABLE `compounds` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `compound` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `compounds`
--

INSERT INTO `compounds` (`id`, `name`, `compound`, `created_at`, `updated_at`) VALUES
(1, 'Hourly', '1', '2017-06-12 18:25:25', '2017-06-12 18:25:25'),
(2, 'Daily', '24', '2017-06-12 18:31:33', '2017-06-12 18:33:14'),
(3, 'Weekly', '168', '2017-06-12 18:33:30', '2017-06-12 18:33:30'),
(4, 'Monthly', '720', '2017-06-12 18:35:58', '2017-06-12 18:36:30');

-- --------------------------------------------------------

--
-- Table structure for table `deposits`
--

CREATE TABLE `deposits` (
  `id` int(10) UNSIGNED NOT NULL,
  `deposit_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `percent` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time` int(11) NOT NULL,
  `compound_id` int(11) NOT NULL,
  `amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `funds`
--

CREATE TABLE `funds` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `payment_type` int(11) NOT NULL,
  `transaction_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rate` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `charge` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fund_logs`
--

CREATE TABLE `fund_logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `payment_type` int(11) NOT NULL,
  `transaction_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rate` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fix` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `percent` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `btc_amo` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `btc_acc` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `general_settings`
--

CREATE TABLE `general_settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `logo` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `color` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `favicon` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `top_one` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `top_two` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `facebook` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `twitter` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `linkedin` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `google_plus` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `youtube` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `about_text` text COLLATE utf8_unicode_ci NOT NULL,
  `footer_bottom_text` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `general_settings`
--

INSERT INTO `general_settings` (`id`, `title`, `logo`, `color`, `favicon`, `address`, `email`, `number`, `top_one`, `top_two`, `facebook`, `twitter`, `linkedin`, `google_plus`, `youtube`, `about_text`, `footer_bottom_text`, `created_at`, `updated_at`) VALUES
(1, 'Softking HYIP', 'logo.png', '2c3e50', '1496686053.png', '11/3 Garden Street, Ring Road, Shyamoli, Dhaka', 'admin@rexbd.net', '+88-01716-441700', 'INNOVATIVE TRADE TOOLS', 'ARE ALREADY HERE AT YOUR FINGERTIPS', 'http://www.facebook.com/thesoftking', 'http://www.twitter/thesoftking', 'http://linkdin.com/thesoftking', 'http://plus.google.com/thesoftking', 'http://youtube.com/thesoftking', '<span open=\"\" sans\",=\"\" sans-serif;=\"\" font-size:=\"\" 14px;\"=\"\" style=\"color: rgb(155, 155, 155); font-family: \">Pursue pleasure rationally encounter se consequencess that are extremely painful or again is there anyone who loves or pursues or desires to obtain seds pain of itself because it is pain consequence seedpain of it itself then becausee is painfull agin and agin ut consequences that are itself ut extremely painful or agains it is there are or anyone wil get good finance.</span><span style=\"color: rgb(155, 155, 155); font-family: \" open=\"\" sans\",=\"\" sans-serif;=\"\" font-size:=\"\" 14px;\"=\"\">Pursue pleasure rationally encounter se consequencess that are extremely painful or again is there anyone who loves or pursues or desires to obtain seds pain of itself because it is pain consequence seedpain of it itself then becausee is painfull agin and agin ut consequences that are itself ut extremely painful or agains it is there are or anyone wil get good finance.</span><br>', '© All copyright Reserved.', NULL, '2017-06-22 22:49:30');

-- --------------------------------------------------------

--
-- Table structure for table `latter_user`
--

CREATE TABLE `latter_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `latter_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `letters`
--

CREATE TABLE `letters` (
  `id` int(10) UNSIGNED NOT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `letter_user`
--

CREATE TABLE `letter_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `letter_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `manual_banks`
--

CREATE TABLE `manual_banks` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `acc_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `acc_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `acc_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `minimum` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `maximum` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fix` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `percent` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `manual_banks`
--

INSERT INTO `manual_banks` (`id`, `name`, `acc_name`, `acc_number`, `acc_code`, `minimum`, `maximum`, `fix`, `percent`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Sonali bank', 'Hasan Rahmnan', '54542121233256554454', '5585965825412522', '2000', '200000', '200', '2.5', 1, '2017-06-23 08:06:34', '2017-06-26 05:32:43'),
(2, 'first bank', 'Fast Bank', '3088154504', '0', '20000', '200000', '200', '3.0', 0, '2017-06-23 08:14:03', '2017-06-27 02:37:38'),
(3, 'Agroni Bank', 'Abir Khan', '7412589632541', '456236598521452', '2000', '100000', '500', '2.5', 1, '2017-06-23 08:18:44', '2017-06-26 05:33:02'),
(4, 'Naira Bank', 'Naira Rahman', '4522365241252', '5214225365212253', '2000', '500000', '400', '2.5', 1, '2017-06-24 18:40:23', '2017-06-26 05:32:52');

-- --------------------------------------------------------

--
-- Table structure for table `manual_funds`
--

CREATE TABLE `manual_funds` (
  `id` int(10) UNSIGNED NOT NULL,
  `manual_fund_log_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci,
  `made_time` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `manual_fund_logs`
--

CREATE TABLE `manual_fund_logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `transaction_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `charge` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `manual_payments`
--

CREATE TABLE `manual_payments` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `method_time` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `method_fix` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `method_percent` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `method_min` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `method_max` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `manual_payments`
--

INSERT INTO `manual_payments` (`id`, `title`, `method_time`, `method_fix`, `method_percent`, `method_min`, `method_max`, `status`, `created_at`, `updated_at`) VALUES
(16, 'Bank payment', '2', '500', '0', '10000', '100000', 1, '2017-06-14 22:55:29', '2017-07-01 19:16:21'),
(17, 'Mobile Bnking', '1', '0', '2.5', '200', '2000', 1, '2017-06-14 23:12:05', '2017-07-01 19:16:26'),
(18, 'Bitcoin', '1', '0', '5', '5000', '50000', 1, '2017-06-24 18:52:16', '2017-07-01 19:16:31'),
(19, 'Perfect Money', '1', '200', '3', '32000', '320000', 1, '2017-06-27 02:54:47', '2017-07-01 19:14:28');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` blob NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Menu1', 0x3c6469763e3c68323e57686174206973204c6f72656d20497073756d3f3c2f68323e4c6f72656d20497073756d266e6273703b69732073696d706c792064756d6d792074657874206f6620746865207072696e74696e6720616e64207479706573657474696e6720696e6475737472792e204c6f72656d20497073756d20686173206265656e2074686520696e6475737472792773207374616e646172642064756d6d79207465787420657665722073696e6365207468652031353030732c207768656e20616e20756e6b6e6f776e207072696e74657220746f6f6b20612067616c6c6579206f66207479706520616e6420736372616d626c656420697420746f206d616b65206120747970652073706563696d656e20626f6f6b2e20497420686173207375727669766564206e6f74206f6e6c7920666976652063656e7475726965732c2062757420616c736f20746865206c65617020696e746f20656c656374726f6e6963207479706573657474696e672c2072656d61696e696e6720657373656e7469616c6c7920756e6368616e6765642e2049742077617320706f70756c61726973656420696e207468652031393630732077697468207468652072656c65617365206f66204c657472617365742073686565747320636f6e7461696e696e67204c6f72656d20497073756d2070617373616765732c20616e64206d6f726520726563656e746c792077697468206465736b746f70207075626c697368696e6720736f667477617265206c696b6520416c64757320506167654d616b657220696e636c7564696e672076657273696f6e73206f66204c6f72656d20497073756d2e3c2f6469763e3c6469763e3c68323e57687920646f207765207573652069743f3c2f68323e49742069732061206c6f6e672065737461626c6973686564206661637420746861742061207265616465722077696c6c206265206469737472616374656420627920746865207265616461626c6520636f6e74656e74206f6620612070616765207768656e206c6f6f6b696e6720617420697473206c61796f75742e2054686520706f696e74206f66207573696e67204c6f72656d20497073756d2069732074686174206974206861732061206d6f72652d6f722d6c657373206e6f726d616c20646973747269627574696f6e206f66206c6574746572732c206173206f70706f73656420746f207573696e672027436f6e74656e7420686572652c20636f6e74656e742068657265272c206d616b696e67206974206c6f6f6b206c696b65207265616461626c6520456e676c6973682e204d616e79206465736b746f70207075626c697368696e67207061636b6167657320616e6420776562207061676520656469746f7273206e6f7720757365204c6f72656d20497073756d2061732074686569722064656661756c74206d6f64656c20746578742c20616e6420612073656172636820666f7220276c6f72656d20697073756d272077696c6c20756e636f766572206d616e7920776562207369746573207374696c6c20696e20746865697220696e66616e63792e20566172696f75732076657273696f6e7320686176652065766f6c766564206f766572207468652079656172732c20736f6d6574696d6573206279206163636964656e742c20736f6d6574696d6573206f6e20707572706f73652028696e6a65637465642068756d6f757220616e6420746865206c696b65292e3c2f6469763e3c6469763e3c68323e3c62723e3c2f68323e436f6e747261727920746f20706f70756c61722062656c6965662c204c6f72656d20497073756d206973206e6f742073696d706c792072616e646f6d20746578742e2049742068617320726f6f747320696e2061207069656365206f6620636c6173736963616c204c6174696e206c6974657261747572652066726f6d2034352042432c206d616b696e67206974206f7665722032303030207965617273206f6c642e2052696368617264204d63436c696e746f636b2c2061204c6174696e2070726f666573736f722061742048616d7064656e2d5379646e657920436f6c6c65676520696e2056697267696e69612c206c6f6f6b6564207570206f6e65206f6620746865206d6f7265206f627363757265204c6174696e20776f7264732c20636f6e73656374657475722c2066726f6d2061204c6f72656d20497073756d20706173736167652c20616e6420676f696e67207468726f75676820746865206369746573206f662074686520776f726420696e20636c6173736963616c206c6974657261747572652c20646973636f76657265642074686520756e646f75627461626c6520736f757263652e204c6f72656d20497073756d20636f6d65732066726f6d2073656374696f6e7320312e31302e333220616e6420312e31302e3333206f66202264652046696e6962757320426f6e6f72756d206574204d616c6f72756d2220285468652045787472656d6573206f6620476f6f6420616e64204576696c292062792043696365726f2c207772697474656e20696e2034352042432e205468697320626f6f6b2069732061207472656174697365206f6e20746865207468656f7279206f66206574686963732c207665727920706f70756c617220647572696e67207468652052656e61697373616e63652e20546865206669727374206c696e65206f66204c6f72656d20497073756d2c20224c6f72656d20697073756d20646f6c6f722073697420616d65742e2e222c20636f6d65732066726f6d2061206c696e6520696e2073656374696f6e20312e31302e33322e546865207374616e64617264206368756e6b206f66204c6f72656d20497073756d20757365642073696e63652074686520313530307320697320726570726f64756365642062656c6f7720666f722074686f736520696e74657265737465642e2053656374696f6e7320312e31302e333220616e6420312e31302e33332066726f6d202264652046696e6962757320426f6e6f72756d206574204d616c6f72756d222062792043696365726f2061726520616c736f20726570726f647563656420696e207468656972206578616374206f726967696e79757579616c20666f726d2c206163636f6d70616e69656420627920456e676c6973682076657273696f6e732066726f6d207468652031393134207472616e736c6174696f6e20627920482e205261636b68616d2e3c2f6469763e, '2017-01-11 08:28:02', '2017-06-22 15:35:54'),
(3, 'Menu2', 0x3c6469763e3c68323e57686174206973204c6f72656d20497073756d3f3c2f68323e4c6f72656d20497073756d266e6273703b69732073696d706c792064756d6d792074657874206f6620746865207072696e74696e6720616e64207479706573657474696e6720696e6475737472792e204c6f72656d20497073756d20686173206265656e2074686520696e6475737472792773207374616e646172642064756d6d79207465787420657665722073696e6365207468652031353030732c207768656e20616e20756e6b6e6f776e207072696e74657220746f6f6b20612067616c6c6579206f66207479706520616e6420736372616d626c656420697420746f206d616b65206120747970652073706563696d656e20626f6f6b2e20497420686173207375727669766564206e6f74206f6e6c7920666976652063656e7475726965732c2062757420616c736f20746865206c65617020696e746f20656c656374726f6e6963207479706573657474696e672c2072656d61696e696e6720657373656e7469616c6c7920756e6368616e6765642e2049742077617320706f70756c61726973656420696e207468652031393630732077697468207468652072656c65617365206f66204c657472617365742073686565747320636f6e7461696e696e67204c6f72656d20497073756d2070617373616765732c20616e64206d6f726520726563656e746c792077697468206465736b746f70207075626c697368696e6720736f667477617265206c696b6520416c64757320506167654d616b657220696e636c7564696e672076657273696f6e73206f66204c6f72656d20497073756d2e3c2f6469763e3c6469763e3c68323e57687920646f207765207573652069743f3c2f68323e49742069732061206c6f6e672065737461626c6973686564206661637420746861742061207265616465722077696c6c206265206469737472616374656420627920746865207265616461626c6520636f6e74656e74206f6620612070616765207768656e206c6f6f6b696e6720617420697473206c61796f75742e2054686520706f696e74206f66207573696e67204c6f72656d20497073756d2069732074686174206974206861732061206d6f72652d6f722d6c657373206e6f726d616c20646973747269627574696f6e206f66206c6574746572732c206173206f70706f73656420746f207573696e672027436f6e74656e7420686572652c20636f6e74656e742068657265272c206d616b696e67206974206c6f6f6b206c696b65207265616461626c6520456e676c6973682e204d616e79206465736b746f70207075626c697368696e67207061636b6167657320616e6420776562207061676520656469746f7273206e6f7720757365204c6f72656d20497073756d2061732074686569722064656661756c74206d6f64656c20746578742c20616e6420612073656172636820666f7220276c6f72656d20697073756d272077696c6c20756e636f766572206d616e7920776562207369746573207374696c6c20696e20746865697220696e66616e63792e20566172696f75732076657273696f6e7320686176652065766f6c766564206f766572207468652079656172732c20736f6d6574696d6573206279206163636964656e742c20736f6d6574696d6573206f6e20707572706f73652028696e6a65637465642068756d6f757220616e6420746865206c696b65292e3c2f6469763e3c62723e3c6469763e3c68323e576865726520646f657320697420636f6d652066726f6d3f3c2f68323e436f6e747261727920746f20706f70756c61722062656c6965662c204c6f72656d20497073756d206973206e6f742073696d706c792072616e646f6d20746578742e2049742068617320726f6f747320696e2061207069656365206f6620636c6173736963616c204c6174696e206c6974657261747572652066726f6d2034352042432c206d616b696e67206974206f7665722032303030207965617273206f6c642e2052696368617264204d63436c696e746f636b2c2061204c6174696e2070726f666573736f722061742048616d7064656e2d5379646e657920436f6c6c65676520696e2056697267696e69612c206c6f6f6b6564207570206f6e65206f6620746865206d6f7265206f627363757265204c6174696e20776f7264732c20636f6e73656374657475722c2066726f6d2061204c6f72656d20497073756d20706173736167652c20616e6420676f696e67207468726f75676820746865206369746573206f662074686520776f726420696e20636c6173736963616c206c6974657261747572652c20646973636f76657265642074686520756e646f75627461626c6520736f757263652e204c6f72656d20497073756d20636f6d65732066726f6d2073656374696f6e7320312e31302e333220616e6420312e31302e3333206f66202264652046696e6962757320426f6e6f72756d206574204d616c6f72756d2220285468652045787472656d6573206f6620476f6f6420616e64204576696c292062792043696365726f2c207772697474656e20696e2034352042432e205468697320626f6f6b2069732061207472656174697365206f6e20746865207468656f7279206f66206574686963732c207665727920706f70756c617220647572696e67207468652052656e61697373616e63652e20546865206669727374206c696e65206f66204c6f72656d20497073756d2c20224c6f72656d20697073756d20646f6c6f722073697420616d65742e2e222c20636f6d65732066726f6d2061206c696e6520696e2073656374696f6e20312e31302e33322e546865207374616e64617264206368756e6b206f66204c6f72656d20497073756d20757365642073696e63652074686520313530307320697320726570726f64756365642062656c6f7720666f722074686f736520696e74657265737465642e2053656374696f6e7320312e31302e333220616e6420312e31302e33332066726f6d202264652046696e6962757320426f6e6f72756d206574204d616c6f72756d222062792043696365726f2061726520616c736f20726570726f647563656420696e207468656972206578616374206f726967696e616c20666f726d2c206163636f6d70616e69656420627920456e676c6973682076657273696f6e732066726f6d207468652031393134207472616e736c6174696f6e20627920482e205261636b68616d2e3c2f6469763e, '2017-01-11 09:04:39', '2017-01-11 09:04:39');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(4, '2014_10_12_000000_create_users_table', 1),
(5, '2014_10_12_100000_create_password_resets_table', 1),
(6, '2017_06_04_164918_create_admins_table', 1),
(7, '2017_06_05_181303_create_basic_settings_table', 1),
(8, '2017_06_06_190932_create_manual_payments_table', 2),
(9, '2017_06_06_204542_create_categories_table', 3),
(10, '2017_06_08_091312_create_news_table', 4),
(12, '2017_06_09_204311_create_payments_table', 5),
(13, '2017_06_10_004145_create_plans_table', 6),
(15, '2017_06_12_181403_create_funds_table', 7),
(16, '2017_06_12_235725_create_compounds_table', 8),
(22, '2017_06_13_103236_create_deposits_table', 9),
(23, '2017_06_13_114907_create_repeats_table', 9),
(25, '2017_06_14_044451_create_user_balances_table', 10),
(26, '2017_06_14_151819_create_rebeat_logs_table', 11),
(28, '2017_06_14_165531_create_fund_logs_table', 12),
(29, '2017_06_15_171929_create_withdraws_table', 13),
(30, '2017_06_16_045611_create_references_table', 14),
(32, '2017_06_16_050737_create_admin_balances_table', 15),
(33, '2017_06_18_071547_create_letters_table', 16),
(34, '2017_06_18_071731_create_letter_user_table', 16),
(35, '2017_06_19_072304_create_strategies_table', 17),
(36, '2017_06_19_140553_create_pages_table', 18);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `view` int(11) NOT NULL DEFAULT '0',
  `image` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `view`, `image`, `category_id`, `description`, `created_at`, `updated_at`) VALUES
(3, 'Softking Online Survey11', 5, '1498123250.jpg', 3, '<div style=\"color: rgb(0, 0, 0); font-family: \" times=\"\" new=\"\" roman\";=\"\" font-size:=\"\" medium;\"=\"\"><h2>What is Lorem Ipsum?</h2><p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p></div><div style=\"color: rgb(0, 0, 0); font-family: \" times=\"\" new=\"\" roman\";=\"\" font-size:=\"\" medium;\"=\"\"><h2>Why do we use it?</h2><p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p></div><br style=\"color: rgb(0, 0, 0); font-family: \" times=\"\" new=\"\" roman\";=\"\" font-size:=\"\" medium;\"=\"\"><div style=\"color: rgb(0, 0, 0); font-family: \" times=\"\" new=\"\" roman\";=\"\" font-size:=\"\" medium;\"=\"\"><h2>Where does it come from?</h2><p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.</p><p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p></div><div style=\"color: rgb(0, 0, 0); font-family: \" times=\"\" new=\"\" roman\";=\"\" font-size:=\"\" medium;\"=\"\"><h2>Where can I get some?</h2></div>', '2017-06-08 12:41:36', '2017-06-25 03:06:54'),
(4, 'Softking Online Survey', 4, '1498123261.jpg', 5, '<div style=\"color: rgb(0, 0, 0); font-family: \" times=\"\" new=\"\" roman\";=\"\" font-size:=\"\" medium;\"=\"\"><h2>What is Lorem Ipsum?</h2><p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p></div><div style=\"color: rgb(0, 0, 0); font-family: \" times=\"\" new=\"\" roman\";=\"\" font-size:=\"\" medium;\"=\"\"><h2>Why do we use it?</h2><p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p></div><br style=\"color: rgb(0, 0, 0); font-family: \" times=\"\" new=\"\" roman\";=\"\" font-size:=\"\" medium;\"=\"\"><div style=\"color: rgb(0, 0, 0); font-family: \" times=\"\" new=\"\" roman\";=\"\" font-size:=\"\" medium;\"=\"\"><h2>Where does it come from?</h2><p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.</p><p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p></div><div style=\"color: rgb(0, 0, 0); font-family: \" times=\"\" new=\"\" roman\";=\"\" font-size:=\"\" medium;\"=\"\"><h2>Where can I get some?</h2></div>', '2017-06-08 12:41:48', '2017-08-09 08:53:38'),
(5, 'Letraset sheets containing', 9, '1498123152.jpg', 3, '<div style=\"color: rgb(0, 0, 0); font-family: \" times=\"\" new=\"\" roman\";=\"\" font-size:=\"\" medium;\"=\"\"><h2>What is Lorem Ipsum?</h2><p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p></div><div style=\"color: rgb(0, 0, 0); font-family: \" times=\"\" new=\"\" roman\";=\"\" font-size:=\"\" medium;\"=\"\"><h2>Why do we use it?</h2><p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p></div><br style=\"color: rgb(0, 0, 0); font-family: \" times=\"\" new=\"\" roman\";=\"\" font-size:=\"\" medium;\"=\"\"><div style=\"color: rgb(0, 0, 0); font-family: \" times=\"\" new=\"\" roman\";=\"\" font-size:=\"\" medium;\"=\"\"><h2>Where does it come from?</h2><p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.</p><p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p></div><div style=\"color: rgb(0, 0, 0); font-family: \" times=\"\" new=\"\" roman\";=\"\" font-size:=\"\" medium;\"=\"\"><h2>Where can I get some?</h2></div>', '2017-06-08 12:41:56', '2017-08-08 21:31:59'),
(6, 'About Investment Management', 21, '1498123213.jpg', 4, '<div style=\"margin: 0px 14.3906px 0px 28.7969px; padding: 0px; width: 436.797px; float: left;\"><h2 style=\"margin: 0px 0px 10px; padding: 0px; line-height: 24px; font-family: DauphinPlain; font-size: 24px;\">What is Lorem Ipsum?</h2><p style=\"margin-bottom: 15px; padding: 0px; text-align: justify;\"><strong style=\"margin: 0px; padding: 0px;\">Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p></div><div style=\"margin: 0px 28.7969px 0px 14.3906px; padding: 0px; width: 436.797px; float: right;\"><h2 style=\"margin: 0px 0px 10px; padding: 0px; line-height: 24px; font-family: DauphinPlain; font-size: 24px;\">Why do we use it?</h2><p style=\"margin-bottom: 15px; padding: 0px; text-align: justify;\">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p></div><br style=\"margin: 0px; padding: 0px; clear: both;\"><div style=\"margin: 0px 14.3906px 0px 28.7969px; padding: 0px; width: 436.797px; float: left;\"><h2 style=\"margin: 0px 0px 10px; padding: 0px; line-height: 24px; font-family: DauphinPlain; font-size: 24px;\">Where does it come from?</h2><p style=\"margin-bottom: 15px; padding: 0px; text-align: justify;\">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.</p><p style=\"margin-bottom: 15px; padding: 0px; text-align: justify;\">The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p></div><div style=\"margin: 0px 28.7969px 0px 14.3906px; padding: 0px; width: 436.797px; float: right;\"><h2 style=\"margin: 0px 0px 10px; padding: 0px; line-height: 24px; font-family: DauphinPlain; font-size: 24px; color: rgb(0, 0, 0);\">Where can I get some?</h2><p style=\"margin-bottom: 15px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;\"=\"\">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p><table style=\"margin: 0px; padding: 0px; border: 0px; width: 436px;\"><tbody style=\"margin: 0px; padding: 0px;\"><tr style=\"margin: 0px; padding: 0px;\"></tr></tbody></table></div>', '2017-06-22 09:19:54', '2017-08-08 21:33:00');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `about` longblob NOT NULL,
  `faq` blob NOT NULL,
  `document` blob NOT NULL,
  `bankbook` blob NOT NULL,
  `terms` blob NOT NULL,
  `privacy` blob NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `about`, `faq`, `document`, `bankbook`, `terms`, `privacy`, `created_at`, `updated_at`) VALUES
(1, 0x3c646976207374796c653d226d617267696e3a203070782031342e333930367078203070782032382e3739363970783b2070616464696e673a203070783b2077696474683a203433362e37393770783b20666c6f61743a206c6566743b20636f6c6f723a2072676228302c20302c2030293b20666f6e742d66616d696c793a202671756f743b4f70656e2053616e732671756f743b2c20417269616c2c2073616e732d73657269663b20666f6e742d73697a653a20313470783b223e3c6832207374796c653d226d617267696e3a203070782030707820313070783b2070616464696e673a203070783b206c696e652d6865696768743a20323470783b20666f6e742d66616d696c793a204461757068696e506c61696e3b20666f6e742d73697a653a20323470783b223e57686174206973204c6f72656d20497073756d3f3c2f68323e3c70207374796c653d226d617267696e2d626f74746f6d3a20313570783b2070616464696e673a203070783b20746578742d616c69676e3a206a7573746966793b223e3c7374726f6e67207374796c653d226d617267696e3a203070783b2070616464696e673a203070783b223e4c6f72656d20497073756d3c2f7374726f6e673e266e6273703b69732073696d706c792064756d6d792074657874206f6620746865207072696e74696e6720616e64207479706573657474696e6720696e6475737472792e204c6f72656d20497073756d20686173206265656e2074686520696e6475737472792773207374616e646172642064756d6d79207465787420657665722073696e6365207468652031353030732c207768656e20616e20756e6b6e6f776e207072696e74657220746f6f6b20612067616c6c6579206f66207479706520616e6420736372616d626c656420697420746f206d616b65206120747970652073706563696d656e20626f6f6b2e20497420686173207375727669766564206e6f74206f6e6c7920666976652063656e7475726965732c2062757420616c736f20746865206c65617020696e746f20656c656374726f6e6963207479706573657474696e672c2072656d61696e696e6720657373656e7469616c6c7920756e6368616e6765642e2049742077617320706f70756c61726973656420696e207468652031393630732077697468207468652072656c65617365206f66204c657472617365742073686565747320636f6e7461696e696e67204c6f72656d20497073756d2070617373616765732c20616e64206d6f726520726563656e746c792077697468206465736b746f70207075626c697368696e6720736f667477617265206c696b6520416c64757320506167654d616b657220696e636c7564696e672076657273696f6e73206f66204c6f72656d20497073756d2e3c2f703e3c2f6469763e3c646976207374796c653d226d617267696e3a203070782032382e373936397078203070782031342e3339303670783b2070616464696e673a203070783b2077696474683a203433362e37393770783b20666c6f61743a2072696768743b20636f6c6f723a2072676228302c20302c2030293b20666f6e742d66616d696c793a202671756f743b4f70656e2053616e732671756f743b2c20417269616c2c2073616e732d73657269663b20666f6e742d73697a653a20313470783b223e3c6832207374796c653d226d617267696e3a203070782030707820313070783b2070616464696e673a203070783b206c696e652d6865696768743a20323470783b20666f6e742d66616d696c793a204461757068696e506c61696e3b20666f6e742d73697a653a20323470783b223e57687920646f207765207573652069743f3c2f68323e3c70207374796c653d226d617267696e2d626f74746f6d3a20313570783b2070616464696e673a203070783b20746578742d616c69676e3a206a7573746966793b223e49742069732061206c6f6e672065737461626c6973686564206661637420746861742061207265616465722077696c6c206265206469737472616374656420627920746865207265616461626c6520636f6e74656e74206f6620612070616765207768656e206c6f6f6b696e6720617420697473206c61796f75742e2054686520706f696e74206f66207573696e67204c6f72656d20497073756d2069732074686174206974206861732061206d6f72652d6f722d6c657373206e6f726d616c20646973747269627574696f6e206f66206c6574746572732c206173206f70706f73656420746f207573696e672027436f6e74656e7420686572652c20636f6e74656e742068657265272c206d616b696e67206974206c6f6f6b206c696b65207265616461626c6520456e676c6973682e204d616e79206465736b746f70207075626c697368696e67207061636b6167657320616e6420776562207061676520656469746f7273206e6f7720757365204c6f72656d20497073756d2061732074686569722064656661756c74206d6f64656c20746578742c20616e6420612073656172636820666f7220276c6f72656d20697073756d272077696c6c20756e636f766572206d616e7920776562207369746573207374696c6c20696e20746865697220696e66616e63792e20566172696f75732076657273696f6e7320686176652065766f6c766564206f766572207468652079656172732c20736f6d6574696d6573206279206163636964656e742c20736f6d6574696d6573206f6e20707572706f73652028696e6a65637465642068756d6f757220616e6420746865206c696b65292e3c2f703e3c2f6469763e3c6272207374796c653d226d617267696e3a203070783b2070616464696e673a203070783b20636c6561723a20626f74683b20636f6c6f723a2072676228302c20302c2030293b20666f6e742d66616d696c793a202671756f743b4f70656e2053616e732671756f743b2c20417269616c2c2073616e732d73657269663b20666f6e742d73697a653a20313470783b20746578742d616c69676e3a2063656e7465723b223e3c646976207374796c653d226d617267696e3a203070782031342e333930367078203070782032382e3739363970783b2070616464696e673a203070783b2077696474683a203433362e37393770783b20666c6f61743a206c6566743b20636f6c6f723a2072676228302c20302c2030293b20666f6e742d66616d696c793a202671756f743b4f70656e2053616e732671756f743b2c20417269616c2c2073616e732d73657269663b20666f6e742d73697a653a20313470783b223e3c6832207374796c653d226d617267696e3a203070782030707820313070783b2070616464696e673a203070783b206c696e652d6865696768743a20323470783b20666f6e742d66616d696c793a204461757068696e506c61696e3b20666f6e742d73697a653a20323470783b223e576865726520646f657320697420636f6d652066726f6d3f3c2f68323e3c70207374796c653d226d617267696e2d626f74746f6d3a20313570783b2070616464696e673a203070783b20746578742d616c69676e3a206a7573746966793b223e436f6e747261727920746f20706f70756c61722062656c6965662c204c6f72656d20497073756d206973206e6f742073696d706c792072616e646f6d20746578742e2049742068617320726f6f747320696e2061207069656365206f6620636c6173736963616c204c6174696e206c6974657261747572652066726f6d2034352042432c206d616b696e67206974206f7665722032303030207965617273206f6c642e2052696368617264204d63436c696e746f636b2c2061204c6174696e2070726f666573736f722061742048616d7064656e2d5379646e657920436f6c6c65676520696e2056697267696e69612c206c6f6f6b6564207570206f6e65206f6620746865206d6f7265206f627363757265204c6174696e20776f7264732c20636f6e73656374657475722c2066726f6d2061204c6f72656d20497073756d20706173736167652c20616e6420676f696e67207468726f75676820746865206369746573206f662074686520776f726420696e20636c6173736963616c206c6974657261747572652c20646973636f76657265642074686520756e646f75627461626c6520736f757263652e204c6f72656d20497073756d20636f6d65732066726f6d2073656374696f6e7320312e31302e333220616e6420312e31302e3333206f66202264652046696e6962757320426f6e6f72756d206574204d616c6f72756d2220285468652045787472656d6573206f6620476f6f6420616e64204576696c292062792043696365726f2c207772697474656e20696e2034352042432e205468697320626f6f6b2069732061207472656174697365206f6e20746865207468656f7279206f66206574686963732c207665727920706f70756c617220647572696e67207468652052656e61697373616e63652e20546865206669727374206c696e65206f66204c6f72656d20497073756d2c20224c6f72656d20697073756d20646f6c6f722073697420616d65742e2e222c20636f6d65732066726f6d2061206c696e6520696e2073656374696f6e20312e31302e33322e3c2f703e3c70207374796c653d226d617267696e2d626f74746f6d3a20313570783b2070616464696e673a203070783b20746578742d616c69676e3a206a7573746966793b223e546865207374616e64617264206368756e6b206f66204c6f72656d20497073756d20757365642073696e63652074686520313530307320697320726570726f64756365642062656c6f7720666f722074686f736520696e74657265737465642e2053656374696f6e7320312e31302e333220616e6420312e31302e33332066726f6d202264652046696e6962757320426f6e6f72756d206574204d616c6f72756d222062792043696365726f2061726520616c736f20726570726f647563656420696e207468656972206578616374206f726967696e616c20666f726d2c206163636f6d70616e69656420627920456e676c6973682076657273696f6e732066726f6d207468652031393134207472616e736c6174696f6e20627920482e205261636b68616d2e3c2f703e3c2f6469763e3c646976207374796c653d226d617267696e3a203070782032382e373936397078203070782031342e3339303670783b2070616464696e673a203070783b2077696474683a203433362e37393770783b20666c6f61743a2072696768743b20636f6c6f723a2072676228302c20302c2030293b20666f6e742d66616d696c793a202671756f743b4f70656e2053616e732671756f743b2c20417269616c2c2073616e732d73657269663b20666f6e742d73697a653a20313470783b223e3c6832207374796c653d226d617267696e3a203070782030707820313070783b2070616464696e673a203070783b206c696e652d6865696768743a20323470783b20666f6e742d66616d696c793a204461757068696e506c61696e3b20666f6e742d73697a653a20323470783b223e57686572652063616e20492067657420736f6d653f3c2f68323e3c70207374796c653d226d617267696e2d626f74746f6d3a20313570783b2070616464696e673a203070783b20746578742d616c69676e3a206a7573746966793b223e546865726520617265206d616e7920766172696174696f6e73206f66207061737361676573206f66204c6f72656d20497073756d20617661696c61626c652c2062757420746865206d616a6f72697479206861766520737566666572656420616c7465726174696f6e20696e20736f6d6520666f726d2c20627920696e6a65637465642068756d6f75722c206f722072616e646f6d6973656420776f72647320776869636820646f6e2774206c6f6f6b206576656e20736c696768746c792062656c69657661626c652e20496620796f752061726520676f696e6720746f2075736520612070617373616765206f66204c6f72656d20497073756d2c20796f75206e65656420746f20626520737572652074686572652069736e277420616e797468696e6720656d62617272617373696e672068696464656e20696e20746865206d6964646c65206f6620746578742e20416c6c20746865204c6f72656d20497073756d2067656e657261746f7273206f6e2074686520496e7465726e65742074656e6420746f2072657065617420707265646566696e6564206368756e6b73206173206e65636573736172792c206d616b696e6720746869732074686520666972737420747275652067656e657261746f72206f6e2074686520496e7465726e65742e204974207573657320612064696374696f6e617279206f66206f76657220323030204c6174696e20776f7264732c20636f6d62696e6564207769746820612068616e6466756c206f66206d6f64656c2073656e74656e636520737472756374757265732c20746f2067656e6572617465204c6f72656d20497073756d207768696368206c6f6f6b7320726561736f6e61626c652e205468652067656e657261746564204c6f72656d20497073756d206973207468657265666f726520616c7761797320667265652066726f6d2072657065746974696f6e2c20696e6a65637465642068756d6f75722c206f72206e6f6e2d636861726163746572697374696320776f726473206574632e3c2f703e3c2f6469763e, 0x3c646976207374796c653d226d617267696e3a203070782031342e333930367078203070782032382e3739363970783b2070616464696e673a203070783b2077696474683a203433362e37393770783b20666c6f61743a206c6566743b20636f6c6f723a2072676228302c20302c2030293b20666f6e742d66616d696c793a202671756f743b4f70656e2053616e732671756f743b2c20417269616c2c2073616e732d73657269663b20666f6e742d73697a653a20313470783b223e3c6832207374796c653d226d617267696e3a203070782030707820313070783b2070616464696e673a203070783b206c696e652d6865696768743a20323470783b20666f6e742d66616d696c793a204461757068696e506c61696e3b20666f6e742d73697a653a20323470783b223e57686174206973204c6f72656d20497073756d3f3c2f68323e3c70207374796c653d226d617267696e2d626f74746f6d3a20313570783b2070616464696e673a203070783b20746578742d616c69676e3a206a7573746966793b223e3c7374726f6e67207374796c653d226d617267696e3a203070783b2070616464696e673a203070783b223e4c6f72656d20497073756d3c2f7374726f6e673e266e6273703b69732073696d706c792064756d6d792074657874206f6620746865207072696e74696e6720616e64207479706573657474696e6720696e6475737472792e204c6f72656d20497073756d20686173206265656e2074686520696e6475737472792773207374616e646172642064756d6d79207465787420657665722073696e6365207468652031353030732c207768656e20616e20756e6b6e6f776e207072696e74657220746f6f6b20612067616c6c6579206f66207479706520616e6420736372616d626c656420697420746f206d616b65206120747970652073706563696d656e20626f6f6b2e20497420686173207375727669766564206e6f74206f6e6c7920666976652063656e7475726965732c2062757420616c736f20746865206c65617020696e746f20656c656374726f6e6963207479706573657474696e672c2072656d61696e696e6720657373656e7469616c6c7920756e6368616e6765642e2049742077617320706f70756c61726973656420696e207468652031393630732077697468207468652072656c65617365206f66204c657472617365742073686565747320636f6e7461696e696e67204c6f72656d20497073756d2070617373616765732c20616e64206d6f726520726563656e746c792077697468206465736b746f70207075626c697368696e6720736f667477617265206c696b6520416c64757320506167654d616b657220696e636c7564696e672076657273696f6e73206f66204c6f72656d20497073756d2e3c2f703e3c2f6469763e3c646976207374796c653d226d617267696e3a203070782032382e373936397078203070782031342e3339303670783b2070616464696e673a203070783b2077696474683a203433362e37393770783b20666c6f61743a2072696768743b20636f6c6f723a2072676228302c20302c2030293b20666f6e742d66616d696c793a202671756f743b4f70656e2053616e732671756f743b2c20417269616c2c2073616e732d73657269663b20666f6e742d73697a653a20313470783b223e3c6832207374796c653d226d617267696e3a203070782030707820313070783b2070616464696e673a203070783b206c696e652d6865696768743a20323470783b20666f6e742d66616d696c793a204461757068696e506c61696e3b20666f6e742d73697a653a20323470783b223e57687920646f207765207573652069743f3c2f68323e3c70207374796c653d226d617267696e2d626f74746f6d3a20313570783b2070616464696e673a203070783b20746578742d616c69676e3a206a7573746966793b223e49742069732061206c6f6e672065737461626c6973686564206661637420746861742061207265616465722077696c6c206265206469737472616374656420627920746865207265616461626c6520636f6e74656e74206f6620612070616765207768656e206c6f6f6b696e6720617420697473206c61796f75742e2054686520706f696e74206f66207573696e67204c6f72656d20497073756d2069732074686174206974206861732061206d6f72652d6f722d6c657373206e6f726d616c20646973747269627574696f6e206f66206c6574746572732c206173206f70706f73656420746f207573696e672027436f6e74656e7420686572652c20636f6e74656e742068657265272c206d616b696e67206974206c6f6f6b206c696b65207265616461626c6520456e676c6973682e204d616e79206465736b746f70207075626c697368696e67207061636b6167657320616e6420776562207061676520656469746f7273206e6f7720757365204c6f72656d20497073756d2061732074686569722064656661756c74206d6f64656c20746578742c20616e6420612073656172636820666f7220276c6f72656d20697073756d272077696c6c20756e636f766572206d616e7920776562207369746573207374696c6c20696e20746865697220696e66616e63792e20566172696f75732076657273696f6e7320686176652065766f6c766564206f766572207468652079656172732c20736f6d6574696d6573206279206163636964656e742c20736f6d6574696d6573206f6e20707572706f73652028696e6a65637465642068756d6f757220616e6420746865206c696b65292e3c2f703e3c2f6469763e3c6272207374796c653d226d617267696e3a203070783b2070616464696e673a203070783b20636c6561723a20626f74683b20636f6c6f723a2072676228302c20302c2030293b20666f6e742d66616d696c793a202671756f743b4f70656e2053616e732671756f743b2c20417269616c2c2073616e732d73657269663b20666f6e742d73697a653a20313470783b20746578742d616c69676e3a2063656e7465723b223e3c646976207374796c653d226d617267696e3a203070782031342e333930367078203070782032382e3739363970783b2070616464696e673a203070783b2077696474683a203433362e37393770783b20666c6f61743a206c6566743b20636f6c6f723a2072676228302c20302c2030293b20666f6e742d66616d696c793a202671756f743b4f70656e2053616e732671756f743b2c20417269616c2c2073616e732d73657269663b20666f6e742d73697a653a20313470783b223e3c6832207374796c653d226d617267696e3a203070782030707820313070783b2070616464696e673a203070783b206c696e652d6865696768743a20323470783b20666f6e742d66616d696c793a204461757068696e506c61696e3b20666f6e742d73697a653a20323470783b223e576865726520646f657320697420636f6d652066726f6d3f3c2f68323e3c70207374796c653d226d617267696e2d626f74746f6d3a20313570783b2070616464696e673a203070783b20746578742d616c69676e3a206a7573746966793b223e436f6e747261727920746f20706f70756c61722062656c6965662c204c6f72656d20497073756d206973206e6f742073696d706c792072616e646f6d20746578742e2049742068617320726f6f747320696e2061207069656365206f6620636c6173736963616c204c6174696e206c6974657261747572652066726f6d2034352042432c206d616b696e67206974206f7665722032303030207965617273206f6c642e2052696368617264204d63436c696e746f636b2c2061204c6174696e2070726f666573736f722061742048616d7064656e2d5379646e657920436f6c6c65676520696e2056697267696e69612c206c6f6f6b6564207570206f6e65206f6620746865206d6f7265206f627363757265204c6174696e20776f7264732c20636f6e73656374657475722c2066726f6d2061204c6f72656d20497073756d20706173736167652c20616e6420676f696e67207468726f75676820746865206369746573206f662074686520776f726420696e20636c6173736963616c206c6974657261747572652c20646973636f76657265642074686520756e646f75627461626c6520736f757263652e204c6f72656d20497073756d20636f6d65732066726f6d2073656374696f6e7320312e31302e333220616e6420312e31302e3333206f66202264652046696e6962757320426f6e6f72756d206574204d616c6f72756d2220285468652045787472656d6573206f6620476f6f6420616e64204576696c292062792043696365726f2c207772697474656e20696e2034352042432e205468697320626f6f6b2069732061207472656174697365206f6e20746865207468656f7279206f66206574686963732c207665727920706f70756c617220647572696e67207468652052656e61697373616e63652e20546865206669727374206c696e65206f66204c6f72656d20497073756d2c20224c6f72656d20697073756d20646f6c6f722073697420616d65742e2e222c20636f6d65732066726f6d2061206c696e6520696e2073656374696f6e20312e31302e33322e3c2f703e3c70207374796c653d226d617267696e2d626f74746f6d3a20313570783b2070616464696e673a203070783b20746578742d616c69676e3a206a7573746966793b223e546865207374616e64617264206368756e6b206f66204c6f72656d20497073756d20757365642073696e63652074686520313530307320697320726570726f64756365642062656c6f7720666f722074686f736520696e74657265737465642e2053656374696f6e7320312e31302e333220616e6420312e31302e33332066726f6d202264652046696e6962757320426f6e6f72756d206574204d616c6f72756d222062792043696365726f2061726520616c736f20726570726f647563656420696e207468656972206578616374206f726967696e616c20666f726d2c206163636f6d70616e69656420627920456e676c6973682076657273696f6e732066726f6d207468652031393134207472616e736c6174696f6e20627920482e205261636b68616d2e3c2f703e3c2f6469763e3c646976207374796c653d226d617267696e3a203070782032382e373936397078203070782031342e3339303670783b2070616464696e673a203070783b2077696474683a203433362e37393770783b20666c6f61743a2072696768743b20636f6c6f723a2072676228302c20302c2030293b20666f6e742d66616d696c793a202671756f743b4f70656e2053616e732671756f743b2c20417269616c2c2073616e732d73657269663b20666f6e742d73697a653a20313470783b223e3c6832207374796c653d226d617267696e3a203070782030707820313070783b2070616464696e673a203070783b206c696e652d6865696768743a20323470783b20666f6e742d66616d696c793a204461757068696e506c61696e3b20666f6e742d73697a653a20323470783b223e57686572652063616e20492067657420736f6d653f3c2f68323e3c70207374796c653d226d617267696e2d626f74746f6d3a20313570783b2070616464696e673a203070783b20746578742d616c69676e3a206a7573746966793b223e546865726520617265206d616e7920766172696174696f6e73206f66207061737361676573206f66204c6f72656d20497073756d20617661696c61626c652c2062757420746865206d616a6f72697479206861766520737566666572656420616c7465726174696f6e20696e20736f6d6520666f726d2c20627920696e6a65637465642068756d6f75722c206f722072616e646f6d6973656420776f72647320776869636820646f6e2774206c6f6f6b206576656e20736c696768746c792062656c69657661626c652e20496620796f752061726520676f696e6720746f2075736520612070617373616765206f66204c6f72656d20497073756d2c20796f75206e65656420746f20626520737572652074686572652069736e277420616e797468696e6720656d62617272617373696e672068696464656e20696e20746865206d6964646c65206f6620746578742e20416c6c20746865204c6f72656d20497073756d2067656e657261746f7273206f6e2074686520496e7465726e65742074656e6420746f2072657065617420707265646566696e6564206368756e6b73206173206e65636573736172792c206d616b696e6720746869732074686520666972737420747275652067656e657261746f72206f6e2074686520496e7465726e65742e204974207573657320612064696374696f6e617279206f66206f76657220323030204c6174696e20776f7264732c20636f6d62696e6564207769746820612068616e6466756c206f66206d6f64656c2073656e74656e636520737472756374757265732c20746f2067656e6572617465204c6f72656d20497073756d207768696368206c6f6f6b7320726561736f6e61626c652e205468652067656e657261746564204c6f72656d20497073756d206973207468657265666f726520616c7761797320667265652066726f6d2072657065746974696f6e2c20696e6a65637465642068756d6f75722c206f72206e6f6e2d636861726163746572697374696320776f726473206574632e3c2f703e3c2f6469763e, 0x3c646976207374796c653d226d617267696e3a203070782031342e333930367078203070782032382e3739363970783b2070616464696e673a203070783b2077696474683a203433362e37393770783b20666c6f61743a206c6566743b20636f6c6f723a2072676228302c20302c2030293b20666f6e742d66616d696c793a202671756f743b4f70656e2053616e732671756f743b2c20417269616c2c2073616e732d73657269663b20666f6e742d73697a653a20313470783b223e3c6832207374796c653d226d617267696e3a203070782030707820313070783b2070616464696e673a203070783b206c696e652d6865696768743a20323470783b20666f6e742d66616d696c793a204461757068696e506c61696e3b20666f6e742d73697a653a20323470783b223e57686174206973204c6f72656d20497073756d3f3c2f68323e3c70207374796c653d226d617267696e2d626f74746f6d3a20313570783b2070616464696e673a203070783b20746578742d616c69676e3a206a7573746966793b223e3c7374726f6e67207374796c653d226d617267696e3a203070783b2070616464696e673a203070783b223e4c6f72656d20497073756d3c2f7374726f6e673e266e6273703b69732073696d706c792064756d6d792074657874206f6620746865207072696e74696e6720616e64207479706573657474696e6720696e6475737472792e204c6f72656d20497073756d20686173206265656e2074686520696e6475737472792773207374616e646172642064756d6d79207465787420657665722073696e6365207468652031353030732c207768656e20616e20756e6b6e6f776e207072696e74657220746f6f6b20612067616c6c6579206f66207479706520616e6420736372616d626c656420697420746f206d616b65206120747970652073706563696d656e20626f6f6b2e20497420686173207375727669766564206e6f74206f6e6c7920666976652063656e7475726965732c2062757420616c736f20746865206c65617020696e746f20656c656374726f6e6963207479706573657474696e672c2072656d61696e696e6720657373656e7469616c6c7920756e6368616e6765642e2049742077617320706f70756c61726973656420696e207468652031393630732077697468207468652072656c65617365206f66204c657472617365742073686565747320636f6e7461696e696e67204c6f72656d20497073756d2070617373616765732c20616e64206d6f726520726563656e746c792077697468206465736b746f70207075626c697368696e6720736f667477617265206c696b6520416c64757320506167654d616b657220696e636c7564696e672076657273696f6e73206f66204c6f72656d20497073756d2e3c2f703e3c2f6469763e3c646976207374796c653d226d617267696e3a203070782032382e373936397078203070782031342e3339303670783b2070616464696e673a203070783b2077696474683a203433362e37393770783b20666c6f61743a2072696768743b20636f6c6f723a2072676228302c20302c2030293b20666f6e742d66616d696c793a202671756f743b4f70656e2053616e732671756f743b2c20417269616c2c2073616e732d73657269663b20666f6e742d73697a653a20313470783b223e3c6832207374796c653d226d617267696e3a203070782030707820313070783b2070616464696e673a203070783b206c696e652d6865696768743a20323470783b20666f6e742d66616d696c793a204461757068696e506c61696e3b20666f6e742d73697a653a20323470783b223e57687920646f207765207573652069743f3c2f68323e3c70207374796c653d226d617267696e2d626f74746f6d3a20313570783b2070616464696e673a203070783b20746578742d616c69676e3a206a7573746966793b223e49742069732061206c6f6e672065737461626c6973686564206661637420746861742061207265616465722077696c6c206265206469737472616374656420627920746865207265616461626c6520636f6e74656e74206f6620612070616765207768656e206c6f6f6b696e6720617420697473206c61796f75742e2054686520706f696e74206f66207573696e67204c6f72656d20497073756d2069732074686174206974206861732061206d6f72652d6f722d6c657373206e6f726d616c20646973747269627574696f6e206f66206c6574746572732c206173206f70706f73656420746f207573696e672027436f6e74656e7420686572652c20636f6e74656e742068657265272c206d616b696e67206974206c6f6f6b206c696b65207265616461626c6520456e676c6973682e204d616e79206465736b746f70207075626c697368696e67207061636b6167657320616e6420776562207061676520656469746f7273206e6f7720757365204c6f72656d20497073756d2061732074686569722064656661756c74206d6f64656c20746578742c20616e6420612073656172636820666f7220276c6f72656d20697073756d272077696c6c20756e636f766572206d616e7920776562207369746573207374696c6c20696e20746865697220696e66616e63792e20566172696f75732076657273696f6e7320686176652065766f6c766564206f766572207468652079656172732c20736f6d6574696d6573206279206163636964656e742c20736f6d6574696d6573206f6e20707572706f73652028696e6a65637465642068756d6f757220616e6420746865206c696b65292e3c2f703e3c2f6469763e3c6272207374796c653d226d617267696e3a203070783b2070616464696e673a203070783b20636c6561723a20626f74683b20636f6c6f723a2072676228302c20302c2030293b20666f6e742d66616d696c793a202671756f743b4f70656e2053616e732671756f743b2c20417269616c2c2073616e732d73657269663b20666f6e742d73697a653a20313470783b20746578742d616c69676e3a2063656e7465723b223e3c646976207374796c653d226d617267696e3a203070782031342e333930367078203070782032382e3739363970783b2070616464696e673a203070783b2077696474683a203433362e37393770783b20666c6f61743a206c6566743b20636f6c6f723a2072676228302c20302c2030293b20666f6e742d66616d696c793a202671756f743b4f70656e2053616e732671756f743b2c20417269616c2c2073616e732d73657269663b20666f6e742d73697a653a20313470783b223e3c6832207374796c653d226d617267696e3a203070782030707820313070783b2070616464696e673a203070783b206c696e652d6865696768743a20323470783b20666f6e742d66616d696c793a204461757068696e506c61696e3b20666f6e742d73697a653a20323470783b223e576865726520646f657320697420636f6d652066726f6d3f3c2f68323e3c70207374796c653d226d617267696e2d626f74746f6d3a20313570783b2070616464696e673a203070783b20746578742d616c69676e3a206a7573746966793b223e436f6e747261727920746f20706f70756c61722062656c6965662c204c6f72656d20497073756d206973206e6f742073696d706c792072616e646f6d20746578742e2049742068617320726f6f747320696e2061207069656365206f6620636c6173736963616c204c6174696e206c6974657261747572652066726f6d2034352042432c206d616b696e67206974206f7665722032303030207965617273206f6c642e2052696368617264204d63436c696e746f636b2c2061204c6174696e2070726f666573736f722061742048616d7064656e2d5379646e657920436f6c6c65676520696e2056697267696e69612c206c6f6f6b6564207570206f6e65206f6620746865206d6f7265206f627363757265204c6174696e20776f7264732c20636f6e73656374657475722c2066726f6d2061204c6f72656d20497073756d20706173736167652c20616e6420676f696e67207468726f75676820746865206369746573206f662074686520776f726420696e20636c6173736963616c206c6974657261747572652c20646973636f76657265642074686520756e646f75627461626c6520736f757263652e204c6f72656d20497073756d20636f6d65732066726f6d2073656374696f6e7320312e31302e333220616e6420312e31302e3333206f66202264652046696e6962757320426f6e6f72756d206574204d616c6f72756d2220285468652045787472656d6573206f6620476f6f6420616e64204576696c292062792043696365726f2c207772697474656e20696e2034352042432e205468697320626f6f6b2069732061207472656174697365206f6e20746865207468656f7279206f66206574686963732c207665727920706f70756c617220647572696e67207468652052656e61697373616e63652e20546865206669727374206c696e65206f66204c6f72656d20497073756d2c20224c6f72656d20697073756d20646f6c6f722073697420616d65742e2e222c20636f6d65732066726f6d2061206c696e6520696e2073656374696f6e20312e31302e33322e3c2f703e3c70207374796c653d226d617267696e2d626f74746f6d3a20313570783b2070616464696e673a203070783b20746578742d616c69676e3a206a7573746966793b223e546865207374616e64617264206368756e6b206f66204c6f72656d20497073756d20757365642073696e63652074686520313530307320697320726570726f64756365642062656c6f7720666f722074686f736520696e74657265737465642e2053656374696f6e7320312e31302e333220616e6420312e31302e33332066726f6d202264652046696e6962757320426f6e6f72756d206574204d616c6f72756d222062792043696365726f2061726520616c736f20726570726f647563656420696e207468656972206578616374206f726967696e616c20666f726d2c206163636f6d70616e69656420627920456e676c6973682076657273696f6e732066726f6d207468652031393134207472616e736c6174696f6e20627920482e205261636b68616d2e3c2f703e3c2f6469763e3c646976207374796c653d226d617267696e3a203070782032382e373936397078203070782031342e3339303670783b2070616464696e673a203070783b2077696474683a203433362e37393770783b20666c6f61743a2072696768743b20636f6c6f723a2072676228302c20302c2030293b20666f6e742d66616d696c793a202671756f743b4f70656e2053616e732671756f743b2c20417269616c2c2073616e732d73657269663b20666f6e742d73697a653a20313470783b223e3c6832207374796c653d226d617267696e3a203070782030707820313070783b2070616464696e673a203070783b206c696e652d6865696768743a20323470783b20666f6e742d66616d696c793a204461757068696e506c61696e3b20666f6e742d73697a653a20323470783b223e57686572652063616e20492067657420736f6d653f3c2f68323e3c70207374796c653d226d617267696e2d626f74746f6d3a20313570783b2070616464696e673a203070783b20746578742d616c69676e3a206a7573746966793b223e546865726520617265206d616e7920766172696174696f6e73206f66207061737361676573206f66204c6f72656d20497073756d20617661696c61626c652c2062757420746865206d616a6f72697479206861766520737566666572656420616c7465726174696f6e20696e20736f6d6520666f726d2c20627920696e6a65637465642068756d6f75722c206f722072616e646f6d6973656420776f72647320776869636820646f6e2774206c6f6f6b206576656e20736c696768746c792062656c69657661626c652e20496620796f752061726520676f696e6720746f2075736520612070617373616765206f66204c6f72656d20497073756d2c20796f75206e65656420746f20626520737572652074686572652069736e277420616e797468696e6720656d62617272617373696e672068696464656e20696e20746865206d6964646c65206f6620746578742e20416c6c20746865204c6f72656d20497073756d2067656e657261746f7273206f6e2074686520496e7465726e65742074656e6420746f2072657065617420707265646566696e6564206368756e6b73206173206e65636573736172792c206d616b696e6720746869732074686520666972737420747275652067656e657261746f72206f6e2074686520496e7465726e65742e204974207573657320612064696374696f6e617279206f66206f76657220323030204c6174696e20776f7264732c20636f6d62696e6564207769746820612068616e6466756c206f66206d6f64656c2073656e74656e636520737472756374757265732c20746f2067656e6572617465204c6f72656d20497073756d207768696368206c6f6f6b7320726561736f6e61626c652e205468652067656e657261746564204c6f72656d20497073756d206973207468657265666f726520616c7761797320667265652066726f6d2072657065746974696f6e2c20696e6a65637465642068756d6f75722c206f72206e6f6e2d636861726163746572697374696320776f726473206574632e3c2f703e3c2f6469763e, 0x3c646976207374796c653d226d617267696e3a203070782031342e333930367078203070782032382e3739363970783b2070616464696e673a203070783b2077696474683a203433362e37393770783b20666c6f61743a206c6566743b20636f6c6f723a2072676228302c20302c2030293b20666f6e742d66616d696c793a202671756f743b4f70656e2053616e732671756f743b2c20417269616c2c2073616e732d73657269663b20666f6e742d73697a653a20313470783b223e3c6832207374796c653d226d617267696e3a203070782030707820313070783b2070616464696e673a203070783b206c696e652d6865696768743a20323470783b20666f6e742d66616d696c793a204461757068696e506c61696e3b20666f6e742d73697a653a20323470783b223e57686174206973204c6f72656d20497073756d3f3c2f68323e3c70207374796c653d226d617267696e2d626f74746f6d3a20313570783b2070616464696e673a203070783b20746578742d616c69676e3a206a7573746966793b223e3c7374726f6e67207374796c653d226d617267696e3a203070783b2070616464696e673a203070783b223e4c6f72656d20497073756d3c2f7374726f6e673e266e6273703b69732073696d706c792064756d6d792074657874206f6620746865207072696e74696e6720616e64207479706573657474696e6720696e6475737472792e204c6f72656d20497073756d20686173206265656e2074686520696e6475737472792773207374616e646172642064756d6d79207465787420657665722073696e6365207468652031353030732c207768656e20616e20756e6b6e6f776e207072696e74657220746f6f6b20612067616c6c6579206f66207479706520616e6420736372616d626c656420697420746f206d616b65206120747970652073706563696d656e20626f6f6b2e20497420686173207375727669766564206e6f74206f6e6c7920666976652063656e7475726965732c2062757420616c736f20746865206c65617020696e746f20656c656374726f6e6963207479706573657474696e672c2072656d61696e696e6720657373656e7469616c6c7920756e6368616e6765642e2049742077617320706f70756c61726973656420696e207468652031393630732077697468207468652072656c65617365206f66204c657472617365742073686565747320636f6e7461696e696e67204c6f72656d20497073756d2070617373616765732c20616e64206d6f726520726563656e746c792077697468206465736b746f70207075626c697368696e6720736f667477617265206c696b6520416c64757320506167654d616b657220696e636c7564696e672076657273696f6e73206f66204c6f72656d20497073756d2e3c2f703e3c2f6469763e3c646976207374796c653d226d617267696e3a203070782032382e373936397078203070782031342e3339303670783b2070616464696e673a203070783b2077696474683a203433362e37393770783b20666c6f61743a2072696768743b20636f6c6f723a2072676228302c20302c2030293b20666f6e742d66616d696c793a202671756f743b4f70656e2053616e732671756f743b2c20417269616c2c2073616e732d73657269663b20666f6e742d73697a653a20313470783b223e3c6832207374796c653d226d617267696e3a203070782030707820313070783b2070616464696e673a203070783b206c696e652d6865696768743a20323470783b20666f6e742d66616d696c793a204461757068696e506c61696e3b20666f6e742d73697a653a20323470783b223e57687920646f207765207573652069743f3c2f68323e3c70207374796c653d226d617267696e2d626f74746f6d3a20313570783b2070616464696e673a203070783b20746578742d616c69676e3a206a7573746966793b223e49742069732061206c6f6e672065737461626c6973686564206661637420746861742061207265616465722077696c6c206265206469737472616374656420627920746865207265616461626c6520636f6e74656e74206f6620612070616765207768656e206c6f6f6b696e6720617420697473206c61796f75742e2054686520706f696e74206f66207573696e67204c6f72656d20497073756d2069732074686174206974206861732061206d6f72652d6f722d6c657373206e6f726d616c20646973747269627574696f6e206f66206c6574746572732c206173206f70706f73656420746f207573696e672027436f6e74656e7420686572652c20636f6e74656e742068657265272c206d616b696e67206974206c6f6f6b206c696b65207265616461626c6520456e676c6973682e204d616e79206465736b746f70207075626c697368696e67207061636b6167657320616e6420776562207061676520656469746f7273206e6f7720757365204c6f72656d20497073756d2061732074686569722064656661756c74206d6f64656c20746578742c20616e6420612073656172636820666f7220276c6f72656d20697073756d272077696c6c20756e636f766572206d616e7920776562207369746573207374696c6c20696e20746865697220696e66616e63792e20566172696f75732076657273696f6e7320686176652065766f6c766564206f766572207468652079656172732c20736f6d6574696d6573206279206163636964656e742c20736f6d6574696d6573206f6e20707572706f73652028696e6a65637465642068756d6f757220616e6420746865206c696b65292e3c2f703e3c2f6469763e3c6272207374796c653d226d617267696e3a203070783b2070616464696e673a203070783b20636c6561723a20626f74683b20636f6c6f723a2072676228302c20302c2030293b20666f6e742d66616d696c793a202671756f743b4f70656e2053616e732671756f743b2c20417269616c2c2073616e732d73657269663b20666f6e742d73697a653a20313470783b20746578742d616c69676e3a2063656e7465723b223e3c646976207374796c653d226d617267696e3a203070782031342e333930367078203070782032382e3739363970783b2070616464696e673a203070783b2077696474683a203433362e37393770783b20666c6f61743a206c6566743b20636f6c6f723a2072676228302c20302c2030293b20666f6e742d66616d696c793a202671756f743b4f70656e2053616e732671756f743b2c20417269616c2c2073616e732d73657269663b20666f6e742d73697a653a20313470783b223e3c6832207374796c653d226d617267696e3a203070782030707820313070783b2070616464696e673a203070783b206c696e652d6865696768743a20323470783b20666f6e742d66616d696c793a204461757068696e506c61696e3b20666f6e742d73697a653a20323470783b223e576865726520646f657320697420636f6d652066726f6d3f3c2f68323e3c70207374796c653d226d617267696e2d626f74746f6d3a20313570783b2070616464696e673a203070783b20746578742d616c69676e3a206a7573746966793b223e436f6e747261727920746f20706f70756c61722062656c6965662c204c6f72656d20497073756d206973206e6f742073696d706c792072616e646f6d20746578742e2049742068617320726f6f747320696e2061207069656365206f6620636c6173736963616c204c6174696e206c6974657261747572652066726f6d2034352042432c206d616b696e67206974206f7665722032303030207965617273206f6c642e2052696368617264204d63436c696e746f636b2c2061204c6174696e2070726f666573736f722061742048616d7064656e2d5379646e657920436f6c6c65676520696e2056697267696e69612c206c6f6f6b6564207570206f6e65206f6620746865206d6f7265206f627363757265204c6174696e20776f7264732c20636f6e73656374657475722c2066726f6d2061204c6f72656d20497073756d20706173736167652c20616e6420676f696e67207468726f75676820746865206369746573206f662074686520776f726420696e20636c6173736963616c206c6974657261747572652c20646973636f76657265642074686520756e646f75627461626c6520736f757263652e204c6f72656d20497073756d20636f6d65732066726f6d2073656374696f6e7320312e31302e333220616e6420312e31302e3333206f66202264652046696e6962757320426f6e6f72756d206574204d616c6f72756d2220285468652045787472656d6573206f6620476f6f6420616e64204576696c292062792043696365726f2c207772697474656e20696e2034352042432e205468697320626f6f6b2069732061207472656174697365206f6e20746865207468656f7279206f66206574686963732c207665727920706f70756c617220647572696e67207468652052656e61697373616e63652e20546865206669727374206c696e65206f66204c6f72656d20497073756d2c20224c6f72656d20697073756d20646f6c6f722073697420616d65742e2e222c20636f6d65732066726f6d2061206c696e6520696e2073656374696f6e20312e31302e33322e3c2f703e3c70207374796c653d226d617267696e2d626f74746f6d3a20313570783b2070616464696e673a203070783b20746578742d616c69676e3a206a7573746966793b223e546865207374616e64617264206368756e6b206f66204c6f72656d20497073756d20757365642073696e63652074686520313530307320697320726570726f64756365642062656c6f7720666f722074686f736520696e74657265737465642e2053656374696f6e7320312e31302e333220616e6420312e31302e33332066726f6d202264652046696e6962757320426f6e6f72756d206574204d616c6f72756d222062792043696365726f2061726520616c736f20726570726f647563656420696e207468656972206578616374206f726967696e616c20666f726d2c206163636f6d70616e69656420627920456e676c6973682076657273696f6e732066726f6d207468652031393134207472616e736c6174696f6e20627920482e205261636b68616d2e3c2f703e3c2f6469763e3c646976207374796c653d226d617267696e3a203070782032382e373936397078203070782031342e3339303670783b2070616464696e673a203070783b2077696474683a203433362e37393770783b20666c6f61743a2072696768743b20636f6c6f723a2072676228302c20302c2030293b20666f6e742d66616d696c793a202671756f743b4f70656e2053616e732671756f743b2c20417269616c2c2073616e732d73657269663b20666f6e742d73697a653a20313470783b223e3c6832207374796c653d226d617267696e3a203070782030707820313070783b2070616464696e673a203070783b206c696e652d6865696768743a20323470783b20666f6e742d66616d696c793a204461757068696e506c61696e3b20666f6e742d73697a653a20323470783b223e57686572652063616e20492067657420736f6d653f3c2f68323e3c70207374796c653d226d617267696e2d626f74746f6d3a20313570783b2070616464696e673a203070783b20746578742d616c69676e3a206a7573746966793b223e546865726520617265206d616e7920766172696174696f6e73206f66207061737361676573206f66204c6f72656d20497073756d20617661696c61626c652c2062757420746865206d616a6f72697479206861766520737566666572656420616c7465726174696f6e20696e20736f6d6520666f726d2c20627920696e6a65637465642068756d6f75722c206f722072616e646f6d6973656420776f72647320776869636820646f6e2774206c6f6f6b206576656e20736c696768746c792062656c69657661626c652e20496620796f752061726520676f696e6720746f2075736520612070617373616765206f66204c6f72656d20497073756d2c20796f75206e65656420746f20626520737572652074686572652069736e277420616e797468696e6720656d62617272617373696e672068696464656e20696e20746865206d6964646c65206f6620746578742e20416c6c20746865204c6f72656d20497073756d2067656e657261746f7273206f6e2074686520496e7465726e65742074656e6420746f2072657065617420707265646566696e6564206368756e6b73206173206e65636573736172792c206d616b696e6720746869732074686520666972737420747275652067656e657261746f72206f6e2074686520496e7465726e65742e204974207573657320612064696374696f6e617279206f66206f76657220323030204c6174696e20776f7264732c20636f6d62696e6564207769746820612068616e6466756c206f66206d6f64656c2073656e74656e636520737472756374757265732c20746f2067656e6572617465204c6f72656d20497073756d207768696368206c6f6f6b7320726561736f6e61626c652e205468652067656e657261746564204c6f72656d20497073756d206973207468657265666f726520616c7761797320667265652066726f6d2072657065746974696f6e2c20696e6a65637465642068756d6f75722c206f72206e6f6e2d636861726163746572697374696320776f726473206574632e3c2f703e3c2f6469763e, 0x3c646976207374796c653d226d617267696e3a203070782031342e333930367078203070782032382e3739363970783b2070616464696e673a203070783b2077696474683a203433362e37393770783b20666c6f61743a206c6566743b20636f6c6f723a2072676228302c20302c2030293b20666f6e742d66616d696c793a202671756f743b4f70656e2053616e732671756f743b2c20417269616c2c2073616e732d73657269663b20666f6e742d73697a653a20313470783b223e3c6832207374796c653d226d617267696e3a203070782030707820313070783b2070616464696e673a203070783b206c696e652d6865696768743a20323470783b20666f6e742d66616d696c793a204461757068696e506c61696e3b20666f6e742d73697a653a20323470783b223e57686174206973204c6f72656d20497073756d3f3c2f68323e3c70207374796c653d226d617267696e2d626f74746f6d3a20313570783b2070616464696e673a203070783b20746578742d616c69676e3a206a7573746966793b223e3c7374726f6e67207374796c653d226d617267696e3a203070783b2070616464696e673a203070783b223e4c6f72656d20497073756d3c2f7374726f6e673e266e6273703b69732073696d706c792064756d6d792074657874206f6620746865207072696e74696e6720616e64207479706573657474696e6720696e6475737472792e204c6f72656d20497073756d20686173206265656e2074686520696e6475737472792773207374616e646172642064756d6d79207465787420657665722073696e6365207468652031353030732c207768656e20616e20756e6b6e6f776e207072696e74657220746f6f6b20612067616c6c6579206f66207479706520616e6420736372616d626c656420697420746f206d616b65206120747970652073706563696d656e20626f6f6b2e20497420686173207375727669766564206e6f74206f6e6c7920666976652063656e7475726965732c2062757420616c736f20746865206c65617020696e746f20656c656374726f6e6963207479706573657474696e672c2072656d61696e696e6720657373656e7469616c6c7920756e6368616e6765642e2049742077617320706f70756c61726973656420696e207468652031393630732077697468207468652072656c65617365206f66204c657472617365742073686565747320636f6e7461696e696e67204c6f72656d20497073756d2070617373616765732c20616e64206d6f726520726563656e746c792077697468206465736b746f70207075626c697368696e6720736f667477617265206c696b6520416c64757320506167654d616b657220696e636c7564696e672076657273696f6e73206f66204c6f72656d20497073756d2e3c2f703e3c2f6469763e3c646976207374796c653d226d617267696e3a203070782032382e373936397078203070782031342e3339303670783b2070616464696e673a203070783b2077696474683a203433362e37393770783b20666c6f61743a2072696768743b20636f6c6f723a2072676228302c20302c2030293b20666f6e742d66616d696c793a202671756f743b4f70656e2053616e732671756f743b2c20417269616c2c2073616e732d73657269663b20666f6e742d73697a653a20313470783b223e3c6832207374796c653d226d617267696e3a203070782030707820313070783b2070616464696e673a203070783b206c696e652d6865696768743a20323470783b20666f6e742d66616d696c793a204461757068696e506c61696e3b20666f6e742d73697a653a20323470783b223e57687920646f207765207573652069743f3c2f68323e3c70207374796c653d226d617267696e2d626f74746f6d3a20313570783b2070616464696e673a203070783b20746578742d616c69676e3a206a7573746966793b223e49742069732061206c6f6e672065737461626c6973686564206661637420746861742061207265616465722077696c6c206265206469737472616374656420627920746865207265616461626c6520636f6e74656e74206f6620612070616765207768656e206c6f6f6b696e6720617420697473206c61796f75742e2054686520706f696e74206f66207573696e67204c6f72656d20497073756d2069732074686174206974206861732061206d6f72652d6f722d6c657373206e6f726d616c20646973747269627574696f6e206f66206c6574746572732c206173206f70706f73656420746f207573696e672027436f6e74656e7420686572652c20636f6e74656e742068657265272c206d616b696e67206974206c6f6f6b206c696b65207265616461626c6520456e676c6973682e204d616e79206465736b746f70207075626c697368696e67207061636b6167657320616e6420776562207061676520656469746f7273206e6f7720757365204c6f72656d20497073756d2061732074686569722064656661756c74206d6f64656c20746578742c20616e6420612073656172636820666f7220276c6f72656d20697073756d272077696c6c20756e636f766572206d616e7920776562207369746573207374696c6c20696e20746865697220696e66616e63792e20566172696f75732076657273696f6e7320686176652065766f6c766564206f766572207468652079656172732c20736f6d6574696d6573206279206163636964656e742c20736f6d6574696d6573206f6e20707572706f73652028696e6a65637465642068756d6f757220616e6420746865206c696b65292e3c2f703e3c2f6469763e3c6272207374796c653d226d617267696e3a203070783b2070616464696e673a203070783b20636c6561723a20626f74683b20636f6c6f723a2072676228302c20302c2030293b20666f6e742d66616d696c793a202671756f743b4f70656e2053616e732671756f743b2c20417269616c2c2073616e732d73657269663b20666f6e742d73697a653a20313470783b20746578742d616c69676e3a2063656e7465723b223e3c646976207374796c653d226d617267696e3a203070782031342e333930367078203070782032382e3739363970783b2070616464696e673a203070783b2077696474683a203433362e37393770783b20666c6f61743a206c6566743b20636f6c6f723a2072676228302c20302c2030293b20666f6e742d66616d696c793a202671756f743b4f70656e2053616e732671756f743b2c20417269616c2c2073616e732d73657269663b20666f6e742d73697a653a20313470783b223e3c6832207374796c653d226d617267696e3a203070782030707820313070783b2070616464696e673a203070783b206c696e652d6865696768743a20323470783b20666f6e742d66616d696c793a204461757068696e506c61696e3b20666f6e742d73697a653a20323470783b223e576865726520646f657320697420636f6d652066726f6d3f3c2f68323e3c70207374796c653d226d617267696e2d626f74746f6d3a20313570783b2070616464696e673a203070783b20746578742d616c69676e3a206a7573746966793b223e436f6e747261727920746f20706f70756c61722062656c6965662c204c6f72656d20497073756d206973206e6f742073696d706c792072616e646f6d20746578742e2049742068617320726f6f747320696e2061207069656365206f6620636c6173736963616c204c6174696e206c6974657261747572652066726f6d2034352042432c206d616b696e67206974206f7665722032303030207965617273206f6c642e2052696368617264204d63436c696e746f636b2c2061204c6174696e2070726f666573736f722061742048616d7064656e2d5379646e657920436f6c6c65676520696e2056697267696e69612c206c6f6f6b6564207570206f6e65206f6620746865206d6f7265206f627363757265204c6174696e20776f7264732c20636f6e73656374657475722c2066726f6d2061204c6f72656d20497073756d20706173736167652c20616e6420676f696e67207468726f75676820746865206369746573206f662074686520776f726420696e20636c6173736963616c206c6974657261747572652c20646973636f76657265642074686520756e646f75627461626c6520736f757263652e204c6f72656d20497073756d20636f6d65732066726f6d2073656374696f6e7320312e31302e333220616e6420312e31302e3333206f66202264652046696e6962757320426f6e6f72756d206574204d616c6f72756d2220285468652045787472656d6573206f6620476f6f6420616e64204576696c292062792043696365726f2c207772697474656e20696e2034352042432e205468697320626f6f6b2069732061207472656174697365206f6e20746865207468656f7279206f66206574686963732c207665727920706f70756c617220647572696e67207468652052656e61697373616e63652e20546865206669727374206c696e65206f66204c6f72656d20497073756d2c20224c6f72656d20697073756d20646f6c6f722073697420616d65742e2e222c20636f6d65732066726f6d2061206c696e6520696e2073656374696f6e20312e31302e33322e3c2f703e3c70207374796c653d226d617267696e2d626f74746f6d3a20313570783b2070616464696e673a203070783b20746578742d616c69676e3a206a7573746966793b223e546865207374616e64617264206368756e6b206f66204c6f72656d20497073756d20757365642073696e63652074686520313530307320697320726570726f64756365642062656c6f7720666f722074686f736520696e74657265737465642e2053656374696f6e7320312e31302e333220616e6420312e31302e33332066726f6d202264652046696e6962757320426f6e6f72756d206574204d616c6f72756d222062792043696365726f2061726520616c736f20726570726f647563656420696e207468656972206578616374206f726967696e616c20666f726d2c206163636f6d70616e69656420627920456e676c6973682076657273696f6e732066726f6d207468652031393134207472616e736c6174696f6e20627920482e205261636b68616d2e3c2f703e3c2f6469763e3c646976207374796c653d226d617267696e3a203070782032382e373936397078203070782031342e3339303670783b2070616464696e673a203070783b2077696474683a203433362e37393770783b20666c6f61743a2072696768743b20636f6c6f723a2072676228302c20302c2030293b20666f6e742d66616d696c793a202671756f743b4f70656e2053616e732671756f743b2c20417269616c2c2073616e732d73657269663b20666f6e742d73697a653a20313470783b223e3c6832207374796c653d226d617267696e3a203070782030707820313070783b2070616464696e673a203070783b206c696e652d6865696768743a20323470783b20666f6e742d66616d696c793a204461757068696e506c61696e3b20666f6e742d73697a653a20323470783b223e57686572652063616e20492067657420736f6d653f3c2f68323e3c70207374796c653d226d617267696e2d626f74746f6d3a20313570783b2070616464696e673a203070783b20746578742d616c69676e3a206a7573746966793b223e546865726520617265206d616e7920766172696174696f6e73206f66207061737361676573206f66204c6f72656d20497073756d20617661696c61626c652c2062757420746865206d616a6f72697479206861766520737566666572656420616c7465726174696f6e20696e20736f6d6520666f726d2c20627920696e6a65637465642068756d6f75722c206f722072616e646f6d6973656420776f72647320776869636820646f6e2774206c6f6f6b206576656e20736c696768746c792062656c69657661626c652e20496620796f752061726520676f696e6720746f2075736520612070617373616765206f66204c6f72656d20497073756d2c20796f75206e65656420746f20626520737572652074686572652069736e277420616e797468696e6720656d62617272617373696e672068696464656e20696e20746865206d6964646c65206f6620746578742e20416c6c20746865204c6f72656d20497073756d2067656e657261746f7273206f6e2074686520496e7465726e65742074656e6420746f2072657065617420707265646566696e6564206368756e6b73206173206e65636573736172792c206d616b696e6720746869732074686520666972737420747275652067656e657261746f72206f6e2074686520496e7465726e65742e204974207573657320612064696374696f6e617279206f66206f76657220323030204c6174696e20776f7264732c20636f6d62696e6564207769746820612068616e6466756c206f66206d6f64656c2073656e74656e636520737472756374757265732c20746f2067656e6572617465204c6f72656d20497073756d207768696368206c6f6f6b7320726561736f6e61626c652e205468652067656e657261746564204c6f72656d20497073756d206973207468657265666f726520616c7761797320667265652066726f6d2072657065746974696f6e2c20696e6a65637465642068756d6f75722c206f72206e6f6e2d636861726163746572697374696320776f726473206574632e3c2f703e3c2f6469763e, 0x3c646976207374796c653d226d617267696e3a203070782031342e333930367078203070782032382e3739363970783b2070616464696e673a203070783b2077696474683a203433362e37393770783b20666c6f61743a206c6566743b20636f6c6f723a2072676228302c20302c2030293b20666f6e742d66616d696c793a202671756f743b4f70656e2053616e732671756f743b2c20417269616c2c2073616e732d73657269663b20666f6e742d73697a653a20313470783b223e3c6832207374796c653d226d617267696e3a203070782030707820313070783b2070616464696e673a203070783b206c696e652d6865696768743a20323470783b20666f6e742d66616d696c793a204461757068696e506c61696e3b20666f6e742d73697a653a20323470783b223e57686174206973204c6f72656d20497073756d3f3c2f68323e3c70207374796c653d226d617267696e2d626f74746f6d3a20313570783b2070616464696e673a203070783b20746578742d616c69676e3a206a7573746966793b223e3c7374726f6e67207374796c653d226d617267696e3a203070783b2070616464696e673a203070783b223e4c6f72656d20497073756d3c2f7374726f6e673e266e6273703b69732073696d706c792064756d6d792074657874206f6620746865207072696e74696e6720616e64207479706573657474696e6720696e6475737472792e204c6f72656d20497073756d20686173206265656e2074686520696e6475737472792773207374616e646172642064756d6d79207465787420657665722073696e6365207468652031353030732c207768656e20616e20756e6b6e6f776e207072696e74657220746f6f6b20612067616c6c6579206f66207479706520616e6420736372616d626c656420697420746f206d616b65206120747970652073706563696d656e20626f6f6b2e20497420686173207375727669766564206e6f74206f6e6c7920666976652063656e7475726965732c2062757420616c736f20746865206c65617020696e746f20656c656374726f6e6963207479706573657474696e672c2072656d61696e696e6720657373656e7469616c6c7920756e6368616e6765642e2049742077617320706f70756c61726973656420696e207468652031393630732077697468207468652072656c65617365206f66204c657472617365742073686565747320636f6e7461696e696e67204c6f72656d20497073756d2070617373616765732c20616e64206d6f726520726563656e746c792077697468206465736b746f70207075626c697368696e6720736f667477617265206c696b6520416c64757320506167654d616b657220696e636c7564696e672076657273696f6e73206f66204c6f72656d20497073756d2e3c2f703e3c2f6469763e3c646976207374796c653d226d617267696e3a203070782032382e373936397078203070782031342e3339303670783b2070616464696e673a203070783b2077696474683a203433362e37393770783b20666c6f61743a2072696768743b20636f6c6f723a2072676228302c20302c2030293b20666f6e742d66616d696c793a202671756f743b4f70656e2053616e732671756f743b2c20417269616c2c2073616e732d73657269663b20666f6e742d73697a653a20313470783b223e3c6832207374796c653d226d617267696e3a203070782030707820313070783b2070616464696e673a203070783b206c696e652d6865696768743a20323470783b20666f6e742d66616d696c793a204461757068696e506c61696e3b20666f6e742d73697a653a20323470783b223e57687920646f207765207573652069743f3c2f68323e3c70207374796c653d226d617267696e2d626f74746f6d3a20313570783b2070616464696e673a203070783b20746578742d616c69676e3a206a7573746966793b223e49742069732061206c6f6e672065737461626c6973686564206661637420746861742061207265616465722077696c6c206265206469737472616374656420627920746865207265616461626c6520636f6e74656e74206f6620612070616765207768656e206c6f6f6b696e6720617420697473206c61796f75742e2054686520706f696e74206f66207573696e67204c6f72656d20497073756d2069732074686174206974206861732061206d6f72652d6f722d6c657373206e6f726d616c20646973747269627574696f6e206f66206c6574746572732c206173206f70706f73656420746f207573696e672027436f6e74656e7420686572652c20636f6e74656e742068657265272c206d616b696e67206974206c6f6f6b206c696b65207265616461626c6520456e676c6973682e204d616e79206465736b746f70207075626c697368696e67207061636b6167657320616e6420776562207061676520656469746f7273206e6f7720757365204c6f72656d20497073756d2061732074686569722064656661756c74206d6f64656c20746578742c20616e6420612073656172636820666f7220276c6f72656d20697073756d272077696c6c20756e636f766572206d616e7920776562207369746573207374696c6c20696e20746865697220696e66616e63792e20566172696f75732076657273696f6e7320686176652065766f6c766564206f766572207468652079656172732c20736f6d6574696d6573206279206163636964656e742c20736f6d6574696d6573206f6e20707572706f73652028696e6a65637465642068756d6f757220616e6420746865206c696b65292e3c2f703e3c2f6469763e3c6272207374796c653d226d617267696e3a203070783b2070616464696e673a203070783b20636c6561723a20626f74683b20636f6c6f723a2072676228302c20302c2030293b20666f6e742d66616d696c793a202671756f743b4f70656e2053616e732671756f743b2c20417269616c2c2073616e732d73657269663b20666f6e742d73697a653a20313470783b20746578742d616c69676e3a2063656e7465723b223e3c646976207374796c653d226d617267696e3a203070782031342e333930367078203070782032382e3739363970783b2070616464696e673a203070783b2077696474683a203433362e37393770783b20666c6f61743a206c6566743b20636f6c6f723a2072676228302c20302c2030293b20666f6e742d66616d696c793a202671756f743b4f70656e2053616e732671756f743b2c20417269616c2c2073616e732d73657269663b20666f6e742d73697a653a20313470783b223e3c6832207374796c653d226d617267696e3a203070782030707820313070783b2070616464696e673a203070783b206c696e652d6865696768743a20323470783b20666f6e742d66616d696c793a204461757068696e506c61696e3b20666f6e742d73697a653a20323470783b223e576865726520646f657320697420636f6d652066726f6d3f3c2f68323e3c70207374796c653d226d617267696e2d626f74746f6d3a20313570783b2070616464696e673a203070783b20746578742d616c69676e3a206a7573746966793b223e436f6e747261727920746f20706f70756c61722062656c6965662c204c6f72656d20497073756d206973206e6f742073696d706c792072616e646f6d20746578742e2049742068617320726f6f747320696e2061207069656365206f6620636c6173736963616c204c6174696e206c6974657261747572652066726f6d2034352042432c206d616b696e67206974206f7665722032303030207965617273206f6c642e2052696368617264204d63436c696e746f636b2c2061204c6174696e2070726f666573736f722061742048616d7064656e2d5379646e657920436f6c6c65676520696e2056697267696e69612c206c6f6f6b6564207570206f6e65206f6620746865206d6f7265206f627363757265204c6174696e20776f7264732c20636f6e73656374657475722c2066726f6d2061204c6f72656d20497073756d20706173736167652c20616e6420676f696e67207468726f75676820746865206369746573206f662074686520776f726420696e20636c6173736963616c206c6974657261747572652c20646973636f76657265642074686520756e646f75627461626c6520736f757263652e204c6f72656d20497073756d20636f6d65732066726f6d2073656374696f6e7320312e31302e333220616e6420312e31302e3333206f66202264652046696e6962757320426f6e6f72756d206574204d616c6f72756d2220285468652045787472656d6573206f6620476f6f6420616e64204576696c292062792043696365726f2c207772697474656e20696e2034352042432e205468697320626f6f6b2069732061207472656174697365206f6e20746865207468656f7279206f66206574686963732c207665727920706f70756c617220647572696e67207468652052656e61697373616e63652e20546865206669727374206c696e65206f66204c6f72656d20497073756d2c20224c6f72656d20697073756d20646f6c6f722073697420616d65742e2e222c20636f6d65732066726f6d2061206c696e6520696e2073656374696f6e20312e31302e33322e3c2f703e3c70207374796c653d226d617267696e2d626f74746f6d3a20313570783b2070616464696e673a203070783b20746578742d616c69676e3a206a7573746966793b223e546865207374616e64617264206368756e6b206f66204c6f72656d20497073756d20757365642073696e63652074686520313530307320697320726570726f64756365642062656c6f7720666f722074686f736520696e74657265737465642e2053656374696f6e7320312e31302e333220616e6420312e31302e33332066726f6d202264652046696e6962757320426f6e6f72756d206574204d616c6f72756d222062792043696365726f2061726520616c736f20726570726f647563656420696e207468656972206578616374206f726967696e616c20666f726d2c206163636f6d70616e69656420627920456e676c6973682076657273696f6e732066726f6d207468652031393134207472616e736c6174696f6e20627920482e205261636b68616d2e3c2f703e3c2f6469763e3c646976207374796c653d226d617267696e3a203070782032382e373936397078203070782031342e3339303670783b2070616464696e673a203070783b2077696474683a203433362e37393770783b20666c6f61743a2072696768743b20636f6c6f723a2072676228302c20302c2030293b20666f6e742d66616d696c793a202671756f743b4f70656e2053616e732671756f743b2c20417269616c2c2073616e732d73657269663b20666f6e742d73697a653a20313470783b223e3c6832207374796c653d226d617267696e3a203070782030707820313070783b2070616464696e673a203070783b206c696e652d6865696768743a20323470783b20666f6e742d66616d696c793a204461757068696e506c61696e3b20666f6e742d73697a653a20323470783b223e57686572652063616e20492067657420736f6d653f3c2f68323e3c70207374796c653d226d617267696e2d626f74746f6d3a20313570783b2070616464696e673a203070783b20746578742d616c69676e3a206a7573746966793b223e546865726520617265206d616e7920766172696174696f6e73206f66207061737361676573206f66204c6f72656d20497073756d20617661696c61626c652c2062757420746865206d616a6f72697479206861766520737566666572656420616c7465726174696f6e20696e20736f6d6520666f726d2c20627920696e6a65637465642068756d6f75722c206f722072616e646f6d6973656420776f72647320776869636820646f6e2774206c6f6f6b206576656e20736c696768746c792062656c69657661626c652e20496620796f752061726520676f696e6720746f2075736520612070617373616765206f66204c6f72656d20497073756d2c20796f75206e65656420746f20626520737572652074686572652069736e277420616e797468696e6720656d62617272617373696e672068696464656e20696e20746865206d6964646c65206f6620746578742e20416c6c20746865204c6f72656d20497073756d2067656e657261746f7273206f6e2074686520496e7465726e65742074656e6420746f2072657065617420707265646566696e6564206368756e6b73206173206e65636573736172792c206d616b696e6720746869732074686520666972737420747275652067656e657261746f72206f6e2074686520496e7465726e65742e204974207573657320612064696374696f6e617279206f66206f76657220323030204c6174696e20776f7264732c20636f6d62696e6564207769746820612068616e6466756c206f66206d6f64656c2073656e74656e636520737472756374757265732c20746f2067656e6572617465204c6f72656d20497073756d207768696368206c6f6f6b7320726561736f6e61626c652e205468652067656e657261746564204c6f72656d20497073756d206973207468657265666f726520616c7761797320667265652066726f6d2072657065746974696f6e2c20696e6a65637465642068756d6f75722c206f72206e6f6e2d636861726163746572697374696320776f726473206574632e3c2f703e3c2f6469763e, NULL, '2017-06-29 03:05:24');

-- --------------------------------------------------------

--
-- Table structure for table `partners`
--

CREATE TABLE `partners` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `partners`
--

INSERT INTO `partners` (`id`, `name`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Habiba Himu', '1502226051.png', '2017-06-22 10:35:08', '2017-08-08 21:00:51'),
(2, 'DMCa', '1502226061.png', '2017-06-22 10:40:28', '2017-08-08 21:01:01'),
(3, 'Empty Poweer', '1502226075.png', '2017-06-22 10:40:38', '2017-08-08 21:01:15'),
(4, 'BDT', '1502226086.png', '2017-06-22 10:40:48', '2017-08-08 21:01:26'),
(5, 'Admin Rahman', '1502226094.png', '2017-06-22 10:40:59', '2017-08-08 21:01:34'),
(7, 'Hasan Rahman', '1502226144.png', '2017-06-22 10:46:53', '2017-08-08 21:02:24');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('hellomrhasan@gmail.com', '$2y$10$0B71gzhd6hcjoW9cKu3Cl..iuFtUT1o4xlsTVjM3dc/K5pwN6DMGW', '2017-06-22 03:29:08'),
('abirkhan75@gmail.com', '$2y$10$gzSIPUl7owx...LGwmU5i.sA8QJpoBKPpYc3TbO5SEBMeuDFN7Vg2', '2017-07-03 05:46:04'),
('admin@thesoftking.com', '$2y$10$YpD7jLN1ZgDFAkzgVg7N/u.RpniMMKGVF14s2flZG7WRMwmFqksQu', '2017-07-26 04:22:28'),
('hasan02@gmail.com', '$2y$10$DMiLA/9WavO982FvzyCpeOcrqXjJD.gAcJWSuDeCQf5I1mjm3AVm6', '2017-08-08 20:24:08'),
('hellomrhasan@gmail.com', '$2y$10$0B71gzhd6hcjoW9cKu3Cl..iuFtUT1o4xlsTVjM3dc/K5pwN6DMGW', '2017-06-22 03:29:08'),
('abirkhan75@gmail.com', '$2y$10$gzSIPUl7owx...LGwmU5i.sA8QJpoBKPpYc3TbO5SEBMeuDFN7Vg2', '2017-07-03 05:46:04'),
('admin@thesoftking.com', '$2y$10$YpD7jLN1ZgDFAkzgVg7N/u.RpniMMKGVF14s2flZG7WRMwmFqksQu', '2017-07-26 04:22:28'),
('hasan02@gmail.com', '$2y$10$DMiLA/9WavO982FvzyCpeOcrqXjJD.gAcJWSuDeCQf5I1mjm3AVm6', '2017-08-08 20:24:08');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(10) UNSIGNED NOT NULL,
  `paypal_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paypal_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paypal_rate` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paypal_min` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paypal_max` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paypal_fix` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paypal_percent` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paypal_email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paypal_status` tinyint(4) NOT NULL,
  `perfect_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `perfect_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `perfect_rate` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `perfect_min` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `perfect_max` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `perfect_fix` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `perfect_percent` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `perfect_account` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `perfect_alternate` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `perfect_status` tinyint(4) NOT NULL,
  `btc_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `btc_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `btc_rate` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `btc_min` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `btc_max` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `btc_fix` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `btc_percent` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `btc_api` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `btc_xpub` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `btc_status` tinyint(4) NOT NULL,
  `stripe_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_rate` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_min` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_max` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_fix` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_percent` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_secret` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_publisher` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `paypal_name`, `paypal_image`, `paypal_rate`, `paypal_min`, `paypal_max`, `paypal_fix`, `paypal_percent`, `paypal_email`, `paypal_status`, `perfect_name`, `perfect_image`, `perfect_rate`, `perfect_min`, `perfect_max`, `perfect_fix`, `perfect_percent`, `perfect_account`, `perfect_alternate`, `perfect_status`, `btc_name`, `btc_image`, `btc_rate`, `btc_min`, `btc_max`, `btc_fix`, `btc_percent`, `btc_api`, `btc_xpub`, `btc_status`, `stripe_name`, `stripe_image`, `stripe_rate`, `stripe_min`, `stripe_max`, `stripe_fix`, `stripe_percent`, `stripe_secret`, `stripe_publisher`, `stripe_status`, `created_at`, `updated_at`) VALUES
(1, 'PayPal', '1497051637h3.png', '74', '50', '50000', '3', '2.36', 'thesoftking@gmail.com', 1, 'Perfect Money', '1497051638h2.png', '85', '250', '360000', '3', '1.75', 'U5220203', 'reg4e54h1grt1j', 1, 'BITCOIN', '1497051638h1.png', '78', '50', '78000', '3', '2.75', '29da9229-8084-4313-ba46-bbb056b69fd7', 'xpub6BtpKpaLGimLEkJ13nPKXzAbDidxowb4nmLWDLoA2vWJaxNb55Ba4oHnpizaMfXkTJyh9V2HdnENrAUCKB4DNGiZchBUJumjhphyKUMqws3', 1, 'CARD', '1497051638h4.png', '500', '250', '36000', '3', '3.6', 'sk_test_YjWBdtTXv4xTh1Ri1CglDqMH', 'pk_test_F9V6UfKuCq0ij4jEE64uqjWF', 1, NULL, '2017-08-26 19:40:53');

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE `photos` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `fund_id` int(11) NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`id`, `user_id`, `fund_id`, `image`, `created_at`, `updated_at`) VALUES
(1, NULL, 2, '1502260616598aad885b4f6.jpg', '2017-08-09 06:36:56', '2017-08-09 06:36:56'),
(2, NULL, 2, '1502260616598aad888e254.jpg', '2017-08-09 06:36:56', '2017-08-09 06:36:56');

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `minimum` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `maximum` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `percent` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time` int(11) NOT NULL,
  `compound_id` int(5) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`id`, `name`, `image`, `minimum`, `maximum`, `percent`, `time`, `compound_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Starter', '1497870966.png', '500', '75000', '150', 1, 3, 1, '2017-06-13 22:25:33', '2017-08-26 18:50:03'),
(2, 'Silver', '1497871022.png', '75000', '100000', '200', 1, 3, 1, '2017-06-13 22:37:42', '2017-06-29 02:56:57'),
(3, 'Gold', '1497871033.png', '100000', '1250000', '3', 100, 1, 1, '2017-06-13 22:41:00', '2017-07-01 19:05:54'),
(4, 'Platinum', '1498497137.png', '1250000', '1500000', '160', 1, 4, 0, '2017-06-13 22:41:54', '2017-06-29 02:54:03');

-- --------------------------------------------------------

--
-- Table structure for table `promos`
--

CREATE TABLE `promos` (
  `id` int(10) UNSIGNED NOT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `s_text` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `promos`
--

INSERT INTO `promos` (`id`, `icon`, `title`, `s_text`, `number`, `created_at`, `updated_at`) VALUES
(1, '<i class=\"fa fa-paper-plane\" aria-hidden=\"true\"></i>', 'Advisors', 'Smart and Hard Workers', 6000, '2017-06-21 23:38:40', '2017-06-21 23:43:58'),
(2, '<i class=\"fa fa-refresh\" aria-hidden=\"true\"></i>', 'Loan Processed', '100 % Customer Satisfaction', 2000, '2017-06-21 23:42:35', '2017-06-22 07:28:05'),
(3, '<i class=\"fa fa-map-marker\" aria-hidden=\"true\"></i>', 'Locations', 'Find Us All Over The World', 70, '2017-06-21 23:45:10', '2017-08-08 21:05:31');

-- --------------------------------------------------------

--
-- Table structure for table `rebeat_logs`
--

CREATE TABLE `rebeat_logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `balance` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deposit_id` int(11) NOT NULL,
  `made_time` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `references`
--

CREATE TABLE `references` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `old_balance` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `new_balance` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `under_reference` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `balance` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `repeats`
--

CREATE TABLE `repeats` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `deposit_id` int(11) NOT NULL,
  `repeat_time` datetime NOT NULL,
  `made_time` datetime DEFAULT NULL,
  `rebeat` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `title`, `description`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Best HYIP Platform', 'Free registration. To open an account Invest and get Profit.', '1502260757h3.jpg', '2017-06-21 22:42:40', '2017-08-09 06:39:18'),
(2, 'What is HYIP', 'Invest HYIP To open an account Invest and get Profit.', '1498085005h3.jpg', '2017-06-21 22:43:25', '2017-06-21 22:43:25');

-- --------------------------------------------------------

--
-- Table structure for table `strategies`
--

CREATE TABLE `strategies` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `strategies`
--

INSERT INTO `strategies` (`id`, `title`, `image`, `description`, `created_at`, `updated_at`) VALUES
(2, 'Registered company', '1497857432.png', 'ULTRACONCEPT NETWORK is a registered Nigerian company that provides profit for investors.', '2017-06-19 07:30:32', '2017-06-25 00:42:22'),
(3, 'Automatic processes', '1497857603.png', 'Automated platform of the company allows our clients to make deposits and receive timely payments.', '2017-06-19 07:33:23', '2017-06-19 07:33:23'),
(4, 'Technology', '1497857691.png', 'Technical engineers and analysts of our company developed a unique and more importantly comfortable platform.', '2017-06-19 07:34:51', '2017-06-19 07:34:51'),
(5, 'Profitable strategies', '1497857725.png', 'The company offers three types of investments.', '2017-06-19 07:35:25', '2017-06-19 07:35:25'),
(6, 'Support service', '1497857758.png', 'Customer support service is available 24/7 and ready to answer any your questions and solve any your problem.', '2017-06-19 07:35:58', '2017-06-19 07:35:58'),
(7, 'Career program', '1497857777.png', 'In addition to this, the company has developed special marketing solutions.', '2017-06-19 07:36:17', '2017-06-19 07:36:17');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `name`, `position`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Hasan Rahman', 'Jr. Laravel developer, at Thesoftking IT Solution.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic.', '2017-06-22 07:46:57', '2017-06-22 07:58:54'),
(2, 'Abir Khan', 'Lead Developer At Thesoftking IT Solution', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting.', '2017-06-22 07:50:18', '2017-06-22 07:58:43'),
(3, 'Rex Rifat', 'Head of Ideas at Thesoftking IT Solution', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting,', '2017-06-22 07:50:59', '2017-06-22 07:58:01');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zip` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `reference` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `under_reference` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verifyToken` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `block_status` tinyint(1) NOT NULL DEFAULT '0',
  `block_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_balances`
--

CREATE TABLE `user_balances` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `balance_type` tinyint(4) NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `balance` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `charge` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `new_balance` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `old_balance` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `withdraws`
--

CREATE TABLE `withdraws` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `method_id` int(11) NOT NULL,
  `withdraw_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `charge` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `acc_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `acc_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `acc_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `new_balance` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `old_balance` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci,
  `made_date` datetime DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `admin_balances`
--
ALTER TABLE `admin_balances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `basic_settings`
--
ALTER TABLE `basic_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `choses`
--
ALTER TABLE `choses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `compounds`
--
ALTER TABLE `compounds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deposits`
--
ALTER TABLE `deposits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `funds`
--
ALTER TABLE `funds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fund_logs`
--
ALTER TABLE `fund_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `general_settings`
--
ALTER TABLE `general_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `latter_user`
--
ALTER TABLE `latter_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `letters`
--
ALTER TABLE `letters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `letter_user`
--
ALTER TABLE `letter_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `letter_user_letter_id_foreign` (`letter_id`),
  ADD KEY `letter_user_user_id_foreign` (`user_id`);

--
-- Indexes for table `manual_banks`
--
ALTER TABLE `manual_banks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manual_funds`
--
ALTER TABLE `manual_funds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manual_fund_logs`
--
ALTER TABLE `manual_fund_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manual_payments`
--
ALTER TABLE `manual_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `partners`
--
ALTER TABLE `partners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promos`
--
ALTER TABLE `promos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rebeat_logs`
--
ALTER TABLE `rebeat_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `references`
--
ALTER TABLE `references`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `repeats`
--
ALTER TABLE `repeats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `strategies`
--
ALTER TABLE `strategies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_balances`
--
ALTER TABLE `user_balances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdraws`
--
ALTER TABLE `withdraws`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_balances`
--
ALTER TABLE `admin_balances`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `basic_settings`
--
ALTER TABLE `basic_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `choses`
--
ALTER TABLE `choses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `compounds`
--
ALTER TABLE `compounds`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `deposits`
--
ALTER TABLE `deposits`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `funds`
--
ALTER TABLE `funds`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `fund_logs`
--
ALTER TABLE `fund_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `general_settings`
--
ALTER TABLE `general_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `latter_user`
--
ALTER TABLE `latter_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `letters`
--
ALTER TABLE `letters`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `letter_user`
--
ALTER TABLE `letter_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `manual_banks`
--
ALTER TABLE `manual_banks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `manual_funds`
--
ALTER TABLE `manual_funds`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `manual_fund_logs`
--
ALTER TABLE `manual_fund_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `manual_payments`
--
ALTER TABLE `manual_payments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `partners`
--
ALTER TABLE `partners`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `promos`
--
ALTER TABLE `promos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rebeat_logs`
--
ALTER TABLE `rebeat_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `references`
--
ALTER TABLE `references`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `repeats`
--
ALTER TABLE `repeats`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `strategies`
--
ALTER TABLE `strategies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_balances`
--
ALTER TABLE `user_balances`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `withdraws`
--
ALTER TABLE `withdraws`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `letter_user`
--
ALTER TABLE `letter_user`
  ADD CONSTRAINT `letter_user_letter_id_foreign` FOREIGN KEY (`letter_id`) REFERENCES `letters` (`id`),
  ADD CONSTRAINT `letter_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
