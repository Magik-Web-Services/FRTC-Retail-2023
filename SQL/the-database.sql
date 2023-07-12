-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 11, 2023 at 07:11 PM
-- Server version: 10.5.21-MariaDB
-- PHP Version: 8.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `candycoder_newchat`
--

-- --------------------------------------------------------

--
-- Table structure for table `blockedcountry`
--

CREATE TABLE `blockedcountry` (
  `id` int(10) UNSIGNED ZEROFILL NOT NULL,
  `model` varchar(35) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `cc` varchar(256) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `name` varchar(256) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blockedstates`
--

CREATE TABLE `blockedstates` (
  `id` int(10) UNSIGNED ZEROFILL NOT NULL,
  `model` varchar(35) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `cc` varchar(256) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `states_code` varchar(256) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` tinytext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(124, 'Friends'),
(119, 'Certified'),
(118, 'Exclusive'),
(147, 'Late Night Chat');

-- --------------------------------------------------------

--
-- Table structure for table `category_top`
--

CREATE TABLE `category_top` (
  `id` int(11) NOT NULL,
  `name` tinytext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category_top`
--

INSERT INTO `category_top` (`id`, `name`) VALUES
(119, 'Boys'),
(118, 'Girls');

-- --------------------------------------------------------

--
-- Table structure for table `chatmodels`
--

CREATE TABLE `chatmodels` (
  `id` varchar(32) NOT NULL DEFAULT '',
  `user` varchar(32) NOT NULL DEFAULT '',
  `password` varchar(32) NOT NULL DEFAULT '',
  `email` varchar(256) NOT NULL DEFAULT '',
  `language1` varchar(12) NOT NULL DEFAULT '',
  `language2` varchar(12) DEFAULT NULL,
  `language3` varchar(12) DEFAULT NULL,
  `language4` varchar(32) DEFAULT NULL,
  `birthDate` varchar(11) DEFAULT NULL,
  `gender` varchar(256) NOT NULL,
  `braSize` varchar(12) DEFAULT NULL,
  `birthSign` varchar(12) DEFAULT NULL,
  `weight` varchar(12) DEFAULT '0',
  `weightMeasure` varchar(12) DEFAULT NULL,
  `height` varchar(12) DEFAULT '0',
  `heightMeasure` varchar(12) DEFAULT NULL,
  `eyeColor` varchar(12) DEFAULT NULL,
  `ethnicity` varchar(32) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `fantasies` varchar(255) DEFAULT NULL,
  `hobby` varchar(255) DEFAULT NULL,
  `hairColor` varchar(32) DEFAULT NULL,
  `hairLength` varchar(32) DEFAULT NULL,
  `pubicHair` varchar(32) DEFAULT NULL,
  `tImage` varchar(32) NOT NULL DEFAULT '',
  `cpm` smallint(6) NOT NULL DEFAULT 0,
  `scpm` tinyint(4) NOT NULL,
  `epercentage` tinyint(4) NOT NULL DEFAULT 0,
  `pay_per_mint_script` varchar(550) NOT NULL,
  `pay_per_script_html` varchar(256) NOT NULL,
  `minimum` int(11) NOT NULL DEFAULT 500,
  `category` varchar(32) NOT NULL DEFAULT '',
  `race_ethnicity` varchar(256) NOT NULL,
  `native_language` varchar(256) NOT NULL,
  `name` varchar(32) NOT NULL DEFAULT '',
  `country` varchar(32) NOT NULL DEFAULT '',
  `state` varchar(32) NOT NULL DEFAULT '',
  `city` varchar(32) NOT NULL DEFAULT '',
  `zip` varchar(12) NOT NULL DEFAULT '',
  `adress` varchar(32) NOT NULL DEFAULT '',
  `actImage` varchar(32) NOT NULL DEFAULT '',
  `pMethod` varchar(12) DEFAULT NULL,
  `pInfo` varchar(255) DEFAULT NULL,
  `dateRegistered` int(11) NOT NULL DEFAULT 0,
  `owner` varchar(32) DEFAULT NULL,
  `lastLogIn` int(11) NOT NULL DEFAULT 0,
  `phone` varchar(16) NOT NULL DEFAULT '',
  `fax` varchar(16) DEFAULT NULL,
  `idtype` varchar(32) NOT NULL DEFAULT '',
  `idmonth` varchar(32) NOT NULL DEFAULT '',
  `idyear` varchar(4) NOT NULL DEFAULT '',
  `idnumber` varchar(32) NOT NULL DEFAULT '',
  `birthplace` varchar(32) NOT NULL DEFAULT '',
  `ssnumber` varchar(32) DEFAULT NULL,
  `msn` varchar(32) DEFAULT NULL,
  `yahoo` varchar(32) DEFAULT NULL,
  `icq` varchar(32) DEFAULT NULL,
  `broadcastplace` varchar(32) DEFAULT NULL,
  `emailtype` enum('text','html') NOT NULL DEFAULT 'text',
  `status` varchar(8) NOT NULL DEFAULT '',
  `lastupdate` int(11) DEFAULT NULL,
  `onlinemembers` tinyint(4) NOT NULL DEFAULT 0,
  `monday` varchar(12) DEFAULT NULL,
  `tuesday` varchar(12) DEFAULT NULL,
  `wednesday` varchar(12) DEFAULT NULL,
  `thursday` varchar(12) DEFAULT NULL,
  `friday` varchar(12) DEFAULT NULL,
  `sunday` varchar(12) DEFAULT NULL,
  `saturday` varchar(12) DEFAULT NULL,
  `gmt` varchar(5) NOT NULL DEFAULT '+0',
  `forcedOnline` tinyint(1) NOT NULL DEFAULT 0,
  `views` int(11) NOT NULL,
  `phonechat` varchar(256) NOT NULL,
  `whocanchat` varchar(256) NOT NULL,
  `Spy_Shows` varchar(256) NOT NULL,
  `loginkey` int(20) NOT NULL,
  `makmyloc` varchar(10) NOT NULL,
  `forced_logout` varchar(256) NOT NULL,
  `tipgoal` varchar(256) NOT NULL,
  `lovense` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `chatmodels`
--

INSERT INTO `chatmodels` (`id`, `user`, `password`, `email`, `language1`, `language2`, `language3`, `language4`, `birthDate`, `gender`, `braSize`, `birthSign`, `weight`, `weightMeasure`, `height`, `heightMeasure`, `eyeColor`, `ethnicity`, `message`, `position`, `fantasies`, `hobby`, `hairColor`, `hairLength`, `pubicHair`, `tImage`, `cpm`, `scpm`, `epercentage`, `pay_per_mint_script`, `pay_per_script_html`, `minimum`, `category`, `race_ethnicity`, `native_language`, `name`, `country`, `state`, `city`, `zip`, `adress`, `actImage`, `pMethod`, `pInfo`, `dateRegistered`, `owner`, `lastLogIn`, `phone`, `fax`, `idtype`, `idmonth`, `idyear`, `idnumber`, `birthplace`, `ssnumber`, `msn`, `yahoo`, `icq`, `broadcastplace`, `emailtype`, `status`, `lastupdate`, `onlinemembers`, `monday`, `tuesday`, `wednesday`, `thursday`, `friday`, `sunday`, `saturday`, `gmt`, `forcedOnline`, `views`, `phonechat`, `whocanchat`, `Spy_Shows`, `loginkey`, `makmyloc`, `forced_logout`, `tipgoal`, `lovense`) VALUES
('7d984c6071a4bea13ea4371e39f9935c', 'Jenny', 'e10adc3949ba59abbe56e057f20f883e', 'support@camscripts.com', '', NULL, NULL, NULL, '01/Jan/1950', 'Female', NULL, NULL, '0', NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 10, 5, 50, '', '', 500, '', 'European', 'English', 'Jane Doe', '1', 'Alabama', 'aaaaaaaaaaaaaaaa', 'aaaaaaaaaaaa', 'aaaaaaaaaaaaaaaa', '', NULL, NULL, 1603934940, NULL, 1607804975, 'aaaaaaaaaaaaaaaa', NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, 'text', 'online', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '+0', 1, 10681, 'yes', '', 'no', 5907, '', 'yes', '', NULL),
('15eef923471b37345ae9718e82b143a4', 'Craig', '19b991ed42f2df77d1ca51c1db2f2bbc', 'support@camscripts.com', '', '', '', '', '14/May/1995', 'Male', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 10, 5, 40, '', '', 100, '', 'European, Latin', 'Dutch', 'Jim Smith', '235', 'CA', 'CA', '90046', '1234 Easy Street', '', 'pp', '', 1511055121, NULL, 1523140567, '123-345-7654', '', '', '', '', '', '', '', '', '', '', 'USA', 'text', 'online', NULL, 0, 'off-off', 'off-off', 'off-off', 'off-off', 'off-off', 'off-off', 'off-off', '+0', 1, 9847, 'yes', 'yes', 'no', 5629, 'yes', 'yes', '0', NULL),
('fc33e8234d0c56bc8587ea6b3e15444c', 'Laura', 'b19ecf9e9416e914a6230a07baf38648', 'support@camscripts.com', '', '', '', '', '01/Jan/1950', 'Female', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 10, 0, 50, '', '', 500, '', '', '', 'Model', '4', 'CA', 'LA', '90046', '1234 Easy Street', '', 'pp', '', 1517458675, NULL, 1518215225, '1234567', '', '', '', '', '', '', '', '', '', '', '', 'text', 'online', NULL, 0, 'off-off', 'off-off', 'off-off', 'off-off', 'off-off', 'off-off', 'off-off', '+0', 1, 90296, 'no', '', 'no', 0, '', '', '', NULL),
('2997c2bde49bde757af3fc915caa18c2', 'Jason', 'e10adc3949ba59abbe56e057f20f883e', 'support@camscripts.com', '', '', '', '', '08/Jun/1965', 'Male', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 10, 0, 0, '', '', 500, '', '', '', 'rajkumar', '102', 'Punjab', 'Mohali', '160058', '185', '', 'pp', '', 1517556449, NULL, 1627267573, '01234567890', '', '', '', '', '', '', '', '', '', '', '', 'text', 'online', NULL, 0, 'off-off', 'off-off', 'off-off', 'off-off', 'off-off', 'off-off', 'off-off', '+0', 1, 193586, 'yes', 'no', 'no', 1484, 'no', 'no', '', NULL),
('f109d4fe520ae8d229264a0952fd8126', 'Jane', 'e10adc3949ba59abbe56e057f20f883e', 'support@camscripts.com', '', '', '', '', '01/Jan/2000', 'Female', '', '', '', '', '', '', '', '', 'This is an about me section...', '', '', '', '', '', '', '', 20, 10, 0, '', '', 500, 'Certified', 'European', '', 'some person', '12', 'Armenia', 'Armem', 'HGt5fr', '23014 Easy Street', '', 'pp', '', 1517904097, NULL, 1689119817, '1234567', '', '', '', '', '', '', '', '', '', '', '', 'text', 'online', NULL, 0, 'off-off', 'off-off', 'off-off', 'off-off', 'off-off', 'off-off', 'off-off', '+0', 1, 399643, 'no', 'no', 'no', 6002, 'no', 'no', '2500', 'b85fe3cd2bf8f1008896dcd072588920'),
('c57eb52362c84c30ebb39bca357b75b4', 'Tera', 'e10adc3949ba59abbe56e057f20f883e', 'support@camscripts.com', '', '', '', '', '01/Jan/2000', 'Female', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1, 5, 50, '', '			  			 ', 100, '', 'European', '', 'another person', '236', 'California', 'Los Angeles', '90020', '2345 Easy Street', '', 'pp', '', 1518065927, NULL, 1520686211, '1234567', '', '', '', '', '', '', '', '', '', '', '', 'text', 'online', NULL, 0, 'off-off', 'off-off', 'off-off', 'off-off', 'off-off', 'off-off', 'off-off', '+0', 1, 33926, '', 'no', 'no', 1123, '', '', '', NULL),
('8bfc9f2ae1430b627abf4f9fff2e7e6c', 'Trevor', 'e10adc3949ba59abbe56e057f20f883e', 'support@camscripts.com', '', '', '', '', '01/Jan/1999', 'Male', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 10, 0, 60, '', '', 500, '', 'Pacific Islander', 'English, Spanish', 'Crazy person', '236', 'Georgia', 'Atlanta', '75222', '1234 Easy Street', '', 'pp', '', 1519511431, NULL, 1519812465, '123-456-7890', '', '', '', '', '', '', '', '', '', '', '', 'text', 'online', NULL, 0, 'off-off', 'off-off', 'off-off', 'off-off', 'off-off', 'off-off', 'off-off', '+0', 1, 78711, '', 'no', 'no', 0, '', '', '', NULL),
('c447816106c248bbfcf070d137dff268', 'Becky', 'e10adc3949ba59abbe56e057f20f883e', 'support@camscripts.com', '', '', '', '', '01/Jan/2000', 'Female', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1, 0, 50, '', '', 100, '', '', 'English', 'Hello there', '236', 'Delaware', 'Washington', '90221', '123 Easy Street', '', 'pp', '', 1519805976, NULL, 1664244125, '123-122-1111', '', '', '', '', '', '', '', '', '', '', 'Dont ask', 'text', 'online', NULL, 0, 'off-off', 'off-off', 'off-off', 'off-off', 'off-off', 'off-off', 'off-off', '+0', 1, 9941, '', 'no', 'no', 3796, 'yes', 'no', '0', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `chatoperators`
--

CREATE TABLE `chatoperators` (
  `id` varchar(32) NOT NULL DEFAULT '',
  `user` varchar(32) NOT NULL DEFAULT '',
  `password` varchar(32) NOT NULL DEFAULT '',
  `email` varchar(32) NOT NULL DEFAULT '',
  `name` varchar(32) NOT NULL DEFAULT '',
  `country` varchar(32) NOT NULL DEFAULT '',
  `state` varchar(32) NOT NULL DEFAULT '',
  `city` varchar(32) NOT NULL DEFAULT '',
  `zip` varchar(12) NOT NULL DEFAULT '',
  `phone` varchar(12) NOT NULL DEFAULT '',
  `adress` varchar(32) NOT NULL DEFAULT '',
  `pMethod` varchar(12) DEFAULT NULL,
  `pInfo` varchar(255) DEFAULT NULL,
  `dateRegistered` int(11) NOT NULL DEFAULT 0,
  `lastLogIn` int(11) NOT NULL DEFAULT 0,
  `moneyEarned` varchar(24) NOT NULL DEFAULT '',
  `moneySent` varchar(24) NOT NULL DEFAULT '',
  `minimum` mediumint(9) NOT NULL DEFAULT 0,
  `status` varchar(12) NOT NULL DEFAULT '',
  `epercentage` tinyint(4) NOT NULL DEFAULT 0,
  `emailtype` enum('text','html') NOT NULL DEFAULT 'text',
  `company` varchar(32) DEFAULT NULL,
  `idtax` varchar(32) DEFAULT NULL,
  `loginkey` int(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chatusers`
--

CREATE TABLE `chatusers` (
  `id` varchar(32) NOT NULL DEFAULT '',
  `user` varchar(32) NOT NULL DEFAULT '',
  `password` varchar(32) NOT NULL DEFAULT '',
  `email` varchar(256) NOT NULL DEFAULT '',
  `name` varchar(32) NOT NULL DEFAULT '',
  `birthDate` varchar(11) NOT NULL,
  `gender` varchar(256) NOT NULL,
  `country` varchar(32) NOT NULL DEFAULT '',
  `state` varchar(32) NOT NULL DEFAULT '',
  `city` varchar(32) NOT NULL DEFAULT '',
  `phone` varchar(16) NOT NULL DEFAULT '',
  `zip` varchar(12) NOT NULL DEFAULT '',
  `adress` varchar(255) NOT NULL DEFAULT '',
  `dateRegistered` int(11) NOT NULL DEFAULT 0,
  `lastLogIn` int(11) NOT NULL DEFAULT 0,
  `money` mediumint(8) UNSIGNED NOT NULL DEFAULT 1,
  `emailnotify` char(1) NOT NULL DEFAULT '0',
  `smsnotify` char(1) NOT NULL DEFAULT '0',
  `status` varchar(12) NOT NULL DEFAULT '',
  `emailtype` enum('html','text') DEFAULT 'text',
  `freetime` smallint(6) NOT NULL DEFAULT 120,
  `freetimeexpired` int(11) NOT NULL DEFAULT 0,
  `loginkey` int(20) NOT NULL,
  `forced_logout` varchar(256) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `chatusers`
--

INSERT INTO `chatusers` (`id`, `user`, `password`, `email`, `name`, `birthDate`, `gender`, `country`, `state`, `city`, `phone`, `zip`, `adress`, `dateRegistered`, `lastLogIn`, `money`, `emailnotify`, `smsnotify`, `status`, `emailtype`, `freetime`, `freetimeexpired`, `loginkey`, `forced_logout`) VALUES
('3cd6147373a1b173f1560a1f8a94789d', 'Member', 'e10adc3949ba59abbe56e057f20f883e', 'support@camscripts.com', 'Member', '01/Jan/1950', 'Male', '236', 'Nevada', 'Bahama City', '123456789', '12345', '123 some rd.', 1517460039, 1688244030, 782, '0', '0', 'active', 'text', 120, 0, 9300, 'no'),
('f288961b0b8ba5171ae2377c0ddeea26', 'Tester', 'e10adc3949ba59abbe56e057f20f883e', 'randy@motorsoul.us', 'xxx', '01/Jan/1950', 'Male', '236', 'Alabama', 'Las Vegas', '123456789', '12345', '111 some rd.', 1529046712, 1663961295, 4650, '0', '0', 'active', 'text', 120, 0, 2812, 'no');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) NOT NULL,
  `name` varchar(24) DEFAULT NULL,
  `code` bigint(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `code`) VALUES
(33, 'British Indian Ocean Ter', 246),
(32, 'Brazil', 55),
(31, 'Bouvet Island', 0),
(30, 'Botswana', 267),
(29, 'Bosnia and Herzegovina', 387),
(28, 'Bonaire, Sint Eustatius ', 599),
(27, 'Bolivia', 591),
(26, 'Bhutan', 975),
(25, 'Bermuda', 1),
(24, 'Benin', 229),
(23, 'Belize', 501),
(22, 'Belgium', 32),
(21, 'Belarus', 375),
(20, 'Barbados', 1),
(19, 'Bangladesh', 880),
(18, 'Bahrain', 973),
(17, 'Bahamas', 1),
(16, 'Azerbaijan', 994),
(15, 'Austria', 43),
(14, 'Australia', 61),
(13, 'Aruba', 297),
(12, 'Armenia', 374),
(11, 'Argentina', 54),
(10, 'Antigua and Barbuda', 1),
(9, 'Antarctica', 672),
(8, 'Anguilla', 1),
(7, 'Angola', 244),
(6, 'Andorra', 376),
(5, 'American Samoa', 1),
(4, 'Algeria', 213),
(3, 'Albania', 355),
(2, 'Aland Islands', 358),
(1, 'Afghanistan', 93),
(34, 'Brunei', 673),
(35, 'Bulgaria', 359),
(36, 'Burkina Faso', 226),
(37, 'Burundi', 257),
(38, 'Cambodia', 855),
(39, 'Cameroon', 237),
(40, 'Canada', 1),
(41, 'Cape Verde', 238),
(42, 'Cayman Islands', 1),
(43, 'Central African Republic', 236),
(44, 'Chad', 235),
(45, 'Chile', 56),
(46, 'China', 86),
(47, 'Christmas Island', 61),
(48, 'Cocos (Keeling) Islands', 61),
(49, 'Colombia', 57),
(50, 'Comoros', 269),
(51, 'Congo', 242),
(52, 'Cook Islands', 682),
(53, 'Costa Rica', 506),
(54, 'Cote d\'ivoire (Ivory Coa', 225),
(55, 'Croatia', 385),
(56, 'Cuba', 53),
(57, 'Curacao', 599),
(58, 'Cyprus', 357),
(59, 'Czech Republic', 420),
(60, 'Democratic Republic of t', 243),
(61, 'Denmark', 45),
(62, 'Djibouti', 253),
(63, 'Dominica', 1),
(64, 'Dominican Republic', 1),
(65, 'Ecuador', 593),
(66, 'Egypt', 20),
(67, 'El Salvador', 503),
(68, 'Equatorial Guinea', 240),
(69, 'Eritrea', 291),
(70, 'Estonia', 372),
(71, 'Ethiopia', 251),
(72, 'Falkland Islands (Malvin', 500),
(73, 'Faroe Islands', 298),
(74, 'Fiji', 679),
(75, 'Finland', 358),
(76, 'France', 33),
(77, 'French Guiana', 594),
(78, 'French Polynesia', 689),
(79, 'French Southern Territor', NULL),
(80, 'Gabon', 241),
(81, 'Gambia', 220),
(82, 'Georgia', 995),
(83, 'Germany', 49),
(84, 'Ghana', 233),
(85, 'Gibraltar', 350),
(86, 'Greece', 30),
(87, 'Greenland', 299),
(88, 'Grenada', 1),
(89, 'Guadaloupe', 590),
(90, 'Guam', 1),
(91, 'Guatemala', 502),
(92, 'Guernsey', 44),
(93, 'Guinea', 224),
(94, 'Guinea-Bissau', 245),
(95, 'Guyana', 592),
(96, 'Haiti', 509),
(97, 'Heard Island and McDonal', 0),
(98, 'Honduras', 504),
(99, 'Hong Kong', 852),
(100, 'Hungary', 36),
(101, 'Iceland', 354),
(102, 'India', 91),
(103, 'Indonesia', 62),
(104, 'Iran', 98),
(105, 'Iraq', 964),
(106, 'Ireland', 353),
(107, 'Isle of Man', 44),
(108, 'Israel', 972),
(109, 'Italy', 39),
(110, 'Jamaica', 1),
(111, 'Japan', 81),
(112, 'Jersey', 44),
(113, 'Jordan', 962),
(114, 'Kazakhstan', 7),
(115, 'Kenya', 254),
(116, 'Kiribati', 686),
(117, 'Kosovo', 381),
(118, 'Kuwait', 965),
(119, 'Kyrgyzstan', 996),
(120, 'Laos', 856),
(121, 'Latvia', 371),
(122, 'Lebanon', 961),
(123, 'Lesotho', 266),
(124, 'Liberia', 231),
(125, 'Libya', 218),
(126, 'Liechtenstein', 423),
(127, 'Lithuania', 370),
(128, 'Luxembourg', 352),
(129, 'Macao', 853),
(130, 'Macedonia', 389),
(131, 'Madagascar', 261),
(132, 'Malawi', 265),
(133, 'Malaysia', 60),
(134, 'Maldives', 960),
(135, 'Mali', 223),
(136, 'Malta', 356),
(137, 'Marshall Islands', 692),
(138, 'Martinique', 596),
(139, 'Mauritania', 222),
(140, 'Mauritius', 230),
(141, 'Mayotte', 262),
(142, 'Mexico', 52),
(143, 'Micronesia', 691),
(144, 'Moldava', 373),
(145, 'Monaco', 377),
(146, 'Mongolia', 976),
(147, 'Montenegro', 382),
(148, 'Montserrat', 1),
(149, 'Morocco', 212),
(150, 'Mozambique', 258),
(151, 'Myanmar (Burma)', 95),
(152, 'Namibia', 264),
(153, 'Nauru', 674),
(154, 'Nepal', 977),
(155, 'Netherlands', 31),
(156, 'New Caledonia', 687),
(157, 'New Zealand', 64),
(158, 'Nicaragua', 505),
(159, 'Niger', 227),
(160, 'Nigeria', 234),
(161, 'Niue', 683),
(162, 'Norfolk Island', 672),
(163, 'North Korea', 850),
(164, 'Northern Mariana Islands', 1),
(165, 'Norway', 47),
(166, 'Oman', 968),
(167, 'Pakistan', 92),
(168, 'Palau', 680),
(169, 'Palestine', 970),
(170, 'Panama', 507),
(171, 'Papua New Guinea', 675),
(172, 'Paraguay', 595),
(173, 'Peru', 51),
(174, 'Phillipines', 63),
(175, 'Pitcairn', 0),
(176, 'Poland', 48),
(177, 'Portugal', 351),
(178, 'Puerto Rico', 1),
(179, 'Qatar', 974),
(180, 'Reunion', 262),
(181, 'Romania', 40),
(182, 'Russia', 7),
(183, 'Rwanda', 250),
(184, 'Saint Barthelemy', 590),
(185, 'Saint Helena', 290),
(186, 'Saint Kitts and Nevis', 1),
(187, 'Saint Lucia', 1),
(188, 'Saint Martin', 590),
(189, 'Saint Pierre and Miquelo', 508),
(190, 'Saint Vincent and the Gr', 1),
(191, 'Samoa', 685),
(192, 'San Marino', 378),
(193, 'Sao Tome and Principe', 239),
(194, 'Saudi Arabia', 966),
(195, 'Senegal', 221),
(196, 'Serbia', 381),
(197, 'Seychelles', 248),
(198, 'Sierra Leone', 232),
(199, 'Singapore', 65),
(200, 'Sint Maarten', 1),
(201, 'Slovakia', 421),
(202, 'Slovenia', 386),
(203, 'Solomon Islands', 677),
(204, 'Somalia', 252),
(205, 'South Africa', 27),
(206, 'South Georgia and the So', 500),
(207, 'South Korea', 82),
(208, 'South Sudan', 211),
(209, 'Spain', 34),
(210, 'Sri Lanka', 94),
(211, 'Sudan', 249),
(212, 'Suriname', 597),
(213, 'Svalbard and Jan Mayen', 47),
(214, 'Swaziland', 268),
(215, 'Sweden', 46),
(216, 'Switzerland', 41),
(217, 'Syria', 963),
(218, 'Taiwan', 886),
(219, 'Tajikistan', 992),
(220, 'Tanzania', 255),
(221, 'Thailand', 66),
(222, 'Timor-Leste (East Timor)', 670),
(223, 'Togo', 228),
(224, 'Tokelau', 690),
(225, 'Tonga', 676),
(226, 'Trinidad and Tobago', 1),
(227, 'Tunisia', 216),
(228, 'Turkey', 90),
(229, 'Turkmenistan', 993),
(230, 'Turks and Caicos Islands', 1),
(231, 'Tuvalu', 688),
(232, 'Uganda', 256),
(233, 'Ukraine', 380),
(234, 'United Arab Emirates', 971),
(235, 'United Kingdom', 44),
(236, 'United States', 1),
(237, 'United States Minor Outl', 0),
(238, 'Uruguay', 598),
(239, 'Uzbekistan', 998),
(240, 'Vanuatu', 678),
(241, 'Vatican City', 39),
(242, 'Venezuela', 58),
(243, 'Vietnam', 84),
(244, 'Virgin Islands, British', 1),
(245, 'Virgin Islands, US', 1),
(246, 'Wallis and Futuna', 681),
(247, 'Western Sahara', 212),
(248, 'Yemen', 967),
(249, 'Zambia', 260),
(250, 'Zimbabwe', 263);

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `id` int(11) NOT NULL,
  `country_code` varchar(2) NOT NULL DEFAULT '',
  `country_name` varchar(100) NOT NULL DEFAULT '',
  `hits` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `last_hits` int(10) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `country_code`, `country_name`, `hits`, `last_hits`) VALUES
(1, 'US', 'United States', 911, 0),
(2, 'CA', 'Canada', 45, 0),
(3, 'AF', 'Afghanistan', 50, 0),
(4, 'AL', 'Albania', 8, 0),
(5, 'DZ', 'Algeria', 106, 0),
(6, 'DS', 'American Samoa', 0, 0),
(7, 'AD', 'Andorra', 0, 0),
(8, 'AO', 'Angola', 23, 0),
(9, 'AI', 'Anguilla', 0, 0),
(10, 'AQ', 'Antarctica', 0, 0),
(11, 'AG', 'Antigua and/or Barbuda', 0, 0),
(12, 'AR', 'Argentina', 18, 0),
(13, 'AM', 'Armenia', 24, 0),
(14, 'AW', 'Aruba', 0, 0),
(15, 'AU', 'Australia', 60, 0),
(16, 'AT', 'Austria', 1, 0),
(17, 'AZ', 'Azerbaijan', 25, 0),
(18, 'BS', 'Bahamas', 0, 0),
(19, 'BH', 'Bahrain', 337, 0),
(20, 'BD', 'Bangladesh', 11915, 0),
(21, 'BB', 'Barbados', 0, 0),
(22, 'BY', 'Belarus', 0, 0),
(23, 'BE', 'Belgium', 11, 0),
(24, 'BZ', 'Belize', 0, 0),
(25, 'BJ', 'Benin', 2, 0),
(26, 'BM', 'Bermuda', 0, 0),
(27, 'BT', 'Bhutan', 24, 0),
(28, 'BO', 'Bolivia', 5, 0),
(29, 'BA', 'Bosnia and Herzegovina', 0, 0),
(30, 'BW', 'Botswana', 2, 0),
(31, 'BV', 'Bouvet Island', 0, 0),
(32, 'BR', 'Brazil', 105, 0),
(33, 'IO', 'British lndian Ocean Territory', 0, 0),
(34, 'BN', 'Brunei Darussalam', 68, 0),
(35, 'BG', 'Bulgaria', 5, 0),
(36, 'BF', 'Burkina Faso', 1, 0),
(37, 'BI', 'Burundi', 2, 0),
(38, 'KH', 'Cambodia', 43, 0),
(39, 'CM', 'Cameroon', 1, 0),
(40, 'CV', 'Cape Verde', 3, 0),
(41, 'KY', 'Cayman Islands', 0, 0),
(42, 'CF', 'Central African Republic', 0, 0),
(43, 'TD', 'Chad', 1, 0),
(44, 'CL', 'Chile', 4, 0),
(45, 'CN', 'China', 817, 0),
(46, 'CX', 'Christmas Island', 0, 0),
(47, 'CC', 'Cocos (Keeling) Islands', 0, 0),
(48, 'CO', 'Colombia', 11, 0),
(49, 'KM', 'Comoros', 0, 0),
(50, 'CG', 'Congo', 1, 0),
(51, 'CK', 'Cook Islands', 0, 0),
(52, 'CR', 'Costa Rica', 10, 0),
(53, 'HR', 'Croatia (Hrvatska)', 2, 0),
(54, 'CU', 'Cuba', 0, 0),
(55, 'CY', 'Cyprus', 6, 0),
(56, 'CZ', 'Czech Republic', 0, 0),
(57, 'DK', 'Denmark', 0, 0),
(58, 'DJ', 'Djibouti', 11, 0),
(59, 'DM', 'Dominica', 0, 0),
(60, 'DO', 'Dominican Republic', 1, 0),
(61, 'TP', 'East Timor', 0, 0),
(62, 'EC', 'Ecuador', 1, 0),
(63, 'EG', 'Egypt', 165, 0),
(64, 'SV', 'El Salvador', 1, 0),
(65, 'GQ', 'Equatorial Guinea', 0, 0),
(66, 'ER', 'Eritrea', 0, 0),
(67, 'EE', 'Estonia', 0, 0),
(68, 'ET', 'Ethiopia', 122, 0),
(69, 'FK', 'Falkland Islands (Malvinas)', 0, 0),
(70, 'FO', 'Faroe Islands', 0, 0),
(71, 'FJ', 'Fiji', 0, 0),
(72, 'FI', 'Finland', 0, 0),
(73, 'FR', 'France', 71, 0),
(74, 'FX', 'France, Metropolitan', 0, 0),
(75, 'GF', 'French Guiana', 0, 0),
(76, 'PF', 'French Polynesia', 0, 0),
(77, 'TF', 'French Southern Territories', 0, 0),
(78, 'GA', 'Gabon', 0, 0),
(79, 'GM', 'Gambia', 0, 0),
(80, 'GE', 'Georgia', 13, 0),
(81, 'DE', 'Germany', 122, 0),
(82, 'GH', 'Ghana', 79, 0),
(83, 'GI', 'Gibraltar', 0, 0),
(84, 'GR', 'Greece', 12, 0),
(85, 'GL', 'Greenland', 0, 0),
(86, 'GD', 'Grenada', 0, 0),
(87, 'GP', 'Guadeloupe', 0, 0),
(88, 'GU', 'Guam', 0, 0),
(89, 'GT', 'Guatemala', 4, 0),
(90, 'GN', 'Guinea', 1, 0),
(91, 'GW', 'Guinea-Bissau', 0, 0),
(92, 'GY', 'Guyana', 5, 0),
(93, 'HT', 'Haiti', 7, 0),
(94, 'HM', 'Heard and Mc Donald Islands', 0, 0),
(95, 'HN', 'Honduras', 6, 0),
(96, 'HK', 'Hong Kong', 513, 0),
(97, 'HU', 'Hungary', 1, 0),
(98, 'IS', 'Iceland', 0, 0),
(99, 'IN', 'India', 430804, 0),
(100, 'ID', 'Indonesia', 9820, 0),
(101, 'IR', 'Iran (Islamic Republic of)', 625, 0),
(102, 'IQ', 'Iraq', 42, 0),
(103, 'IE', 'Ireland', 1, 0),
(104, 'IL', 'Israel', 364, 0),
(105, 'IT', 'Italy', 58, 0),
(106, 'CI', 'Ivory Coast', 7, 0),
(107, 'JM', 'Jamaica', 12, 0),
(108, 'JP', 'Japan', 15, 0),
(109, 'JO', 'Jordan', 40, 0),
(110, 'KZ', 'Kazakhstan', 16, 0),
(111, 'KE', 'Kenya', 48, 0),
(112, 'KI', 'Kiribati', 0, 0),
(113, 'KP', 'Korea, Democratic People\'s Republic of', 0, 0),
(114, 'KR', 'Korea, Republic of', 25, 0),
(115, 'XK', 'Kosovo', 0, 0),
(116, 'KW', 'Kuwait', 759, 0),
(117, 'KG', 'Kyrgyzstan', 14, 0),
(118, 'LA', 'Lao People\'s Democratic Republic', 6, 0),
(119, 'LV', 'Latvia', 1, 0),
(120, 'LB', 'Lebanon', 11, 0),
(121, 'LS', 'Lesotho', 0, 0),
(122, 'LR', 'Liberia', 0, 0),
(123, 'LY', 'Libyan Arab Jamahiriya', 16, 0),
(124, 'LI', 'Liechtenstein', 0, 0),
(125, 'LT', 'Lithuania', 2, 0),
(126, 'LU', 'Luxembourg', 3, 0),
(127, 'MO', 'Macau', 0, 0),
(128, 'MK', 'Macedonia', 1, 0),
(129, 'MG', 'Madagascar', 2, 0),
(130, 'MW', 'Malawi', 0, 0),
(131, 'MY', 'Malaysia', 2230, 0),
(132, 'MV', 'Maldives', 105, 0),
(133, 'ML', 'Mali', 1, 0),
(134, 'MT', 'Malta', 0, 0),
(135, 'MH', 'Marshall Islands', 0, 0),
(136, 'MQ', 'Martinique', 0, 0),
(137, 'MR', 'Mauritania', 4, 0),
(138, 'MU', 'Mauritius', 29, 0),
(139, 'TY', 'Mayotte', 0, 0),
(140, 'MX', 'Mexico', 25, 0),
(141, 'FM', 'Micronesia, Federated States of', 0, 0),
(142, 'MD', 'Moldova, Republic of', 0, 0),
(143, 'MC', 'Monaco', 12, 0),
(144, 'MN', 'Mongolia', 0, 0),
(145, 'ME', 'Montenegro', 0, 0),
(146, 'MS', 'Montserrat', 0, 0),
(147, 'MA', 'Morocco', 44, 0),
(148, 'MZ', 'Mozambique', 5, 0),
(149, 'MM', 'Myanmar', 13, 0),
(150, 'NA', 'Namibia', 4, 0),
(151, 'NR', 'Nauru', 0, 0),
(152, 'NP', 'Nepal', 500, 0),
(153, 'NL', 'Netherlands', 40, 0),
(154, 'AN', 'Netherlands Antilles', 0, 0),
(155, 'NC', 'New Caledonia', 0, 0),
(156, 'NZ', 'New Zealand', 8, 0),
(157, 'NI', 'Nicaragua', 1, 0),
(158, 'NE', 'Niger', 12, 0),
(159, 'NG', 'Nigeria', 298, 0),
(160, 'NU', 'Niue', 0, 0),
(161, 'NF', 'Norfork Island', 0, 0),
(162, 'MP', 'Northern Mariana Islands', 0, 0),
(163, 'NO', 'Norway', 1, 0),
(164, 'OM', 'Oman', 1222, 0),
(165, 'PK', 'Pakistan', 32862, 0),
(166, 'PW', 'Palau', 0, 0),
(167, 'PA', 'Panama', 4, 0),
(168, 'PG', 'Papua New Guinea', 31, 0),
(169, 'PY', 'Paraguay', 9, 0),
(170, 'PE', 'Peru', 72, 0),
(171, 'PH', 'Philippines', 133, 0),
(172, 'PN', 'Pitcairn', 0, 0),
(173, 'PL', 'Poland', 22, 0),
(174, 'PT', 'Portugal', 3, 0),
(175, 'PR', 'Puerto Rico', 0, 0),
(176, 'QA', 'Qatar', 837, 0),
(177, 'RE', 'Reunion', 0, 0),
(178, 'RO', 'Romania', 35, 0),
(179, 'RU', 'Russian Federation', 103, 0),
(180, 'RW', 'Rwanda', 3, 0),
(181, 'KN', 'Saint Kitts and Nevis', 0, 0),
(182, 'LC', 'Saint Lucia', 0, 0),
(183, 'VC', 'Saint Vincent and the Grenadines', 0, 0),
(184, 'WS', 'Samoa', 0, 0),
(185, 'SM', 'San Marino', 0, 0),
(186, 'ST', 'Sao Tome and Principe', 0, 0),
(187, 'SA', 'Saudi Arabia', 4469, 0),
(188, 'SN', 'Senegal', 10, 0),
(189, 'RS', 'Serbia', 1, 0),
(190, 'SC', 'Seychelles', 7, 0),
(191, 'SL', 'Sierra Leone', 0, 0),
(192, 'SG', 'Singapore', 177, 0),
(193, 'SK', 'Slovakia', 14, 0),
(194, 'SI', 'Slovenia', 0, 0),
(195, 'SB', 'Solomon Islands', 0, 0),
(196, 'SO', 'Somalia', 1, 0),
(197, 'ZA', 'South Africa', 368, 0),
(198, 'GS', 'South Georgia South Sandwich Islands', 0, 0),
(199, 'ES', 'Spain', 25, 0),
(200, 'LK', 'Sri Lanka', 970, 0),
(201, 'SH', 'St. Helena', 0, 0),
(202, 'PM', 'St. Pierre and Miquelon', 0, 0),
(203, 'SD', 'Sudan', 160, 0),
(204, 'SR', 'Suriname', 1, 0),
(205, 'SJ', 'Svalbarn and Jan Mayen Islands', 0, 0),
(206, 'SZ', 'Swaziland', 0, 0),
(207, 'SE', 'Sweden', 295, 0),
(208, 'CH', 'Switzerland', 3, 0),
(209, 'SY', 'Syrian Arab Republic', 17, 0),
(210, 'TW', 'Taiwan', 3, 0),
(211, 'TJ', 'Tajikistan', 3, 0),
(212, 'TZ', 'Tanzania, United Republic of', 99, 0),
(213, 'TH', 'Thailand', 114, 0),
(214, 'TG', 'Togo', 1, 0),
(215, 'TK', 'Tokelau', 0, 0),
(216, 'TO', 'Tonga', 0, 0),
(217, 'TT', 'Trinidad and Tobago', 9, 0),
(218, 'TN', 'Tunisia', 25, 0),
(219, 'TR', 'Turkey', 445, 0),
(220, 'TM', 'Turkmenistan', 0, 0),
(221, 'TC', 'Turks and Caicos Islands', 0, 0),
(222, 'TV', 'Tuvalu', 0, 0),
(223, 'UG', 'Uganda', 28, 0),
(224, 'UA', 'Ukraine', 30, 0),
(225, 'AE', 'United Arab Emirates', 4517, 0),
(226, 'GB', 'United Kingdom', 987, 0),
(227, 'UM', 'United States minor outlying islands', 0, 0),
(228, 'UY', 'Uruguay', 4, 0),
(229, 'UZ', 'Uzbekistan', 103, 0),
(230, 'VU', 'Vanuatu', 0, 0),
(231, 'VA', 'Vatican City State', 0, 0),
(232, 'VE', 'Venezuela', 3, 0),
(233, 'VN', 'Vietnam', 33, 0),
(234, 'VG', 'Virigan Islands (British)', 0, 0),
(235, 'VI', 'Virgin Islands (U.S.)', 0, 0),
(236, 'WF', 'Wallis and Futuna Islands', 0, 0),
(237, 'EH', 'Western Sahara', 0, 0),
(238, 'YE', 'Yemen', 100, 0),
(239, 'YU', 'Yugoslavia', 0, 0),
(240, 'ZR', 'Zaire', 0, 0),
(241, 'ZM', 'Zambia', 11, 0),
(242, 'ZW', 'Zimbabwe', 8, 0);

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `member` varchar(32) NOT NULL DEFAULT '',
  `model` varchar(32) NOT NULL DEFAULT '',
  `dateadded` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `modelpictures`
--

CREATE TABLE `modelpictures` (
  `ID` int(25) NOT NULL,
  `user` varchar(32) NOT NULL DEFAULT '',
  `name` varchar(32) NOT NULL DEFAULT '',
  `dateuploaded` bigint(20) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `modelpictures`
--

INSERT INTO `modelpictures` (`ID`, `user`, `name`, `dateuploaded`) VALUES
(111300, 'Therese', '076aa47bfb288a06402491c0296f79d7', 1517815573),
(111296, 'Therese', '93048d870b96c87b6c7263ae82111b83', 1517370057),
(111297, 'gagantha', '48a450de57f4dca402ab4f656c6e808f', 1517483823),
(111298, 'gagantha', '818f71da74ae408aa268e1dae503d73b', 1517483844),
(111299, 'gagantha', '05b5578cedf1adffb7aeaf2324944d45', 1517483859),
(111301, 'Hotgirl123', '824ac654ee3215a19eb5fae05dcc2dee', 1518753452),
(111303, 'Therese', 'ef1aeee17e4f642ab3138488ae3944fc', 1518759016),
(111305, 'Therese', '451112fec34a439a2b59527a31b29105', 1518763868),
(111306, 'Therese', 'df3225ec835b4d84d72a9ff3c4b00039', 1518763876),
(111307, 'Therese', 'a08c663c16bce5dfef6383bb89ed7cce', 1518764693),
(111309, 'SexySexy123', '655ce43ac7b4469a81e3d8980dfeddb4', 1519512657),
(111317, 'model3', '8224ed0f9fcd135ddc927005f0d4d3fc', 1603935361),
(111340, 'Model', '8cf291b29fddab836efc16e6682959b7', 1687295538),
(111319, 'Madmax', '9570ecc836ee09bf387ebabc59ad807d', 1611677085),
(111320, 'Madmax', 'acb2d9f3fc31cd874eff7f25feb279ac', 1611709490),
(111341, 'Jane', '0a07acfb0489756c0abe172082b29144', 1689119857),
(111344, 'Jane', '2bba1b39aa8f4a326bb1fb4f48f13f90', 1689119904);

-- --------------------------------------------------------

--
-- Table structure for table `modelshows`
--

CREATE TABLE `modelshows` (
  `user` varchar(32) NOT NULL DEFAULT '',
  `name` varchar(24) NOT NULL DEFAULT '',
  `string` varchar(32) NOT NULL DEFAULT '',
  `previewtime` bigint(20) NOT NULL DEFAULT 0,
  `movietime` bigint(20) NOT NULL DEFAULT 0,
  `price` mediumint(9) NOT NULL DEFAULT 300
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `package`
--

CREATE TABLE `package` (
  `id` int(11) NOT NULL,
  `name` tinytext NOT NULL,
  `price` decimal(5,2) NOT NULL,
  `tokens` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `package`
--

INSERT INTO `package` (`id`, `name`, `price`, `tokens`) VALUES
(78, 'Platinum', 150.00, 180),
(91, 'Crazy Package', 200.00, 230),
(69, 'Gold	', 80.00, 100),
(86, 'Royal', 125.00, 140),
(71, 'Regal', 100.00, 125),
(92, 'Psychic Package', 250.00, 300),
(93, 'Expensive Stuff', 300.00, 340),
(94, 'Big Money', 400.00, 450),
(95, 'Lots of Tokens', 500.00, 580),
(96, 'Break da Bank', 999.99, 1200);

-- --------------------------------------------------------

--
-- Table structure for table `pagseguro`
--

CREATE TABLE `pagseguro` (
  `id` int(11) NOT NULL,
  `referencia` varchar(15) NOT NULL,
  `fecha` datetime NOT NULL,
  `usuario` varchar(32) NOT NULL,
  `item` varchar(20) NOT NULL,
  `descrip` varchar(50) NOT NULL,
  `valor` int(11) NOT NULL,
  `moneda` varchar(10) NOT NULL,
  `estado` varchar(20) NOT NULL,
  `id_transac` varchar(32) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payccbill`
--

CREATE TABLE `payccbill` (
  `code` int(11) NOT NULL,
  `act` varchar(255) NOT NULL,
  `subact` varchar(255) NOT NULL,
  `frmname` varchar(255) NOT NULL,
  `codtxt` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `payccbill`
--

INSERT INTO `payccbill` (`code`, `act`, `subact`, `frmname`, `codtxt`) VALUES
(1, '0', '0', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `paymentgate`
--

CREATE TABLE `paymentgate` (
  `code` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `paymentgate`
--

INSERT INTO `paymentgate` (`code`, `email`, `url`) VALUES
(1, 'dfg', 'dfg');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` varchar(32) NOT NULL DEFAULT '',
  `date` bigint(24) NOT NULL DEFAULT 0,
  `ammount` varchar(24) NOT NULL DEFAULT '',
  `taxes` varchar(24) NOT NULL DEFAULT '',
  `method` varchar(12) NOT NULL DEFAULT '',
  `details` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `date`, `ammount`, `taxes`, `method`, `details`) VALUES
('', 1403982450, '', '0', '', ''),
('', 1403956227, '', '0', '', ''),
('13247bf0825aa3a12dab0072400ab4dd', 1403982446, '195', '0', 'pp', 'support@camscripts.com'),
('13247bf0825aa3a12dab0072400ab4dd', 1403956226, '150', '0', 'pp', 'support@camscripts.com'),
('13247bf0825aa3a12dab0072400ab4dd', 1403983492, '195', '0', 'pp', 'support@camscripts.com'),
('13247bf0825aa3a12dab0072400ab4dd', 1403983251, '195', '0', 'pp', 'support@camscripts.com'),
('', 1403982985, '', '0', '', ''),
('', 1403982885, '', '0', '', ''),
('13247bf0825aa3a12dab0072400ab4dd', 1403982981, '195', '0', 'pp', 'support@camscripts.com'),
('13247bf0825aa3a12dab0072400ab4dd', 1403982882, '195', '0', 'pp', 'support@camscripts.com'),
('0117321502000000016', 1510909938, '10', '', 'ccbill', 'username'),
('0117322602000000010', 1510991454, '50', '', 'ccbill', 'username'),
('15eef923471b37345ae9718e82b143a4', 1518253385, '117.6', '0', 'pp', ''),
('0e4a6e0aff50d2615423ffcce9a21821', 1518280020, '283', '0', 'pp', ''),
('15eef923471b37345ae9718e82b143a4', 1518299855, '500', '0', 'pp', ''),
('15eef923471b37345ae9718e82b143a4', 1519501985, '186', '0', 'pp', ''),
('0e4a6e0aff50d2615423ffcce9a21821', 1519501993, '110', '0', 'pp', 'support@liveplayhouse.com'),
('c57eb52362c84c30ebb39bca357b75b4', 1519503830, '102.5', '0', 'pp', ''),
('145cbcd306adae868e189cf6af7d89f1', 1519703760, '126', '0', 'pp', ''),
('c57eb52362c84c30ebb39bca357b75b4', 1519810188, '140', '0', 'pp', ''),
('c447816106c248bbfcf070d137dff268', 1519814872, '157.5', '0', 'pp', ''),
('15eef923471b37345ae9718e82b143a4', 1521179360, '2890', '0', 'pp', ''),
('c447816106c248bbfcf070d137dff268', 1521179365, '480.5', '0', 'pp', ''),
('bcc9d7e57aa244f0f23054d5abd5dd00', 1607188402, '560.5', '0', 'pp', 'me@me.com'),
('c57eb52362c84c30ebb39bca357b75b4', 1668793536, '525', '0', 'pp', ''),
('bcc9d7e57aa244f0f23054d5abd5dd00', 1683573700, '903', '0', 'pp', 'me@me.com');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `type` varchar(50) NOT NULL,
  `value` varchar(128) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`type`, `value`) VALUES
('license_key', 'db4a24791741a39eb62645b915924dc0'),
('media_server', 'https://stunlink.com:9001/');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` int(11) NOT NULL,
  `country` varchar(256) NOT NULL,
  `states` varchar(256) NOT NULL,
  `states_code` varchar(256) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `country`, `states`, `states_code`) VALUES
(1, '236', 'Alabama', 'AL'),
(2, '236', 'Alaska', 'AK'),
(3, '236', 'Arizona', 'AZ'),
(4, '236', 'Arkansas', 'AR'),
(6, '236', 'California', 'CA'),
(8, '236', 'Colorado', 'CO'),
(9, '236', 'Connecticut', 'CT'),
(10, '236', 'Delaware', 'DE'),
(11, '236', 'District of Columbia', 'DC'),
(12, '236', 'Florida', 'FL'),
(13, '236', 'Georgia', 'GA'),
(14, '236', 'Hawaii', 'HI'),
(15, '236', 'Idaho', 'ID'),
(16, '236', 'Illinois', 'IL'),
(17, '236', 'Indiana', 'IN'),
(18, '236', 'Iowa', 'IA'),
(19, '236', 'Kansas', 'KS'),
(20, '236', 'Kentucky', 'KY'),
(21, '236', 'Louisiana', 'LA'),
(23, '236', 'Maine', 'ME'),
(24, '236', 'Maryland', 'MD'),
(25, '236', 'Massachusetts', 'MA'),
(27, '236', 'Michigan', 'MI'),
(28, '236', 'Minnesota', 'MN'),
(29, '236', 'Mississippi', 'MS'),
(30, '236', 'Missouri', 'MO'),
(31, '236', 'Montana', 'MT'),
(32, '236', 'Nebraska', 'NE'),
(33, '236', 'Nevada', 'NV'),
(34, '236', 'New Hampshire', 'NH'),
(35, '236', 'New Jersey', 'NJ'),
(37, '236', 'New Mexico', 'NM'),
(38, '236', 'New York', 'NY'),
(39, '236', 'North Carolina', 'NC'),
(40, '236', 'North Dakota', 'ND'),
(41, '236', 'Ohio', 'OH'),
(42, '236', 'Oklahoma', 'OK'),
(44, '236', 'Oregon', 'OR'),
(45, '236', 'Pennsylvania', 'PA'),
(47, '236', 'Rhode Island', 'RI'),
(48, '236', 'South Carolina', 'SC'),
(49, '236', 'South Dakota', 'SD'),
(51, '236', 'Tennessee', 'TN'),
(52, '236', 'Texas', 'TX'),
(54, '236', 'Utah', 'UT'),
(55, '236', 'Vermont', 'VT'),
(56, '236', 'Virginia', 'VA'),
(57, '236', 'Washington', 'WA'),
(58, '236', 'West Virginia', 'WV'),
(59, '236', 'Wisconsin', 'WI'),
(60, '236', 'Wyoming', 'WY');

-- --------------------------------------------------------

--
-- Table structure for table `users_models_message`
--

CREATE TABLE `users_models_message` (
  `id` int(11) NOT NULL,
  `member_id` varchar(256) NOT NULL,
  `broadcast_id` varchar(256) NOT NULL,
  `message` longtext NOT NULL,
  `sender_id` varchar(250) NOT NULL,
  `send_time` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_kick`
--

CREATE TABLE `user_kick` (
  `id` int(11) NOT NULL,
  `member_id` varchar(256) NOT NULL,
  `broadcast_id` varchar(256) NOT NULL,
  `kick_time` datetime NOT NULL,
  `status` varchar(256) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_logged_in`
--

CREATE TABLE `user_logged_in` (
  `id` int(11) NOT NULL,
  `user` varchar(256) NOT NULL,
  `logged_in` varchar(256) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_states`
--

CREATE TABLE `user_states` (
  `id` int(11) NOT NULL,
  `idd` varchar(256) NOT NULL,
  `user_state` varchar(256) NOT NULL,
  `statess` varchar(256) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `videosessions`
--

CREATE TABLE `videosessions` (
  `sessionid` varchar(32) NOT NULL DEFAULT '',
  `member` varchar(32) NOT NULL DEFAULT '',
  `model` varchar(32) NOT NULL DEFAULT '',
  `sop` varchar(32) NOT NULL DEFAULT '',
  `cpm` mediumint(9) NOT NULL DEFAULT 0,
  `epercentage` smallint(6) NOT NULL DEFAULT 0,
  `date` int(11) NOT NULL DEFAULT 0,
  `duration` mediumint(9) NOT NULL DEFAULT 0,
  `paid` char(1) NOT NULL DEFAULT '',
  `soppaid` char(1) NOT NULL DEFAULT '0',
  `type` varchar(12) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `videosessions1`
--

CREATE TABLE `videosessions1` (
  `sessionid` varchar(32) NOT NULL DEFAULT '',
  `member` varchar(32) NOT NULL DEFAULT '',
  `model` varchar(32) NOT NULL DEFAULT '',
  `sop` varchar(32) NOT NULL DEFAULT '',
  `cpm` mediumint(9) NOT NULL DEFAULT 0,
  `epercentage` smallint(6) NOT NULL DEFAULT 0,
  `date` int(11) NOT NULL DEFAULT 0,
  `duration` mediumint(9) NOT NULL DEFAULT 0,
  `paid` char(1) NOT NULL DEFAULT '',
  `soppaid` char(1) NOT NULL DEFAULT '0',
  `type` varchar(12) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `videosessions_copy`
--

CREATE TABLE `videosessions_copy` (
  `sessionid` varchar(32) NOT NULL DEFAULT '',
  `member` varchar(32) NOT NULL DEFAULT '',
  `model` varchar(32) NOT NULL DEFAULT '',
  `sop` varchar(32) NOT NULL DEFAULT '',
  `cpm` mediumint(9) NOT NULL DEFAULT 0,
  `epercentage` smallint(6) NOT NULL DEFAULT 0,
  `date` int(11) NOT NULL DEFAULT 0,
  `duration` mediumint(9) NOT NULL DEFAULT 0,
  `paid` char(1) NOT NULL DEFAULT '',
  `soppaid` char(1) NOT NULL DEFAULT '0',
  `type` varchar(12) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `welcome`
--

CREATE TABLE `welcome` (
  `members` text DEFAULT NULL,
  `models` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `welcome`
--

INSERT INTO `welcome` (`members`, `models`) VALUES
('<html><h1>Welcome Members</h1></html> dfgdfgdfgdfgdgdfgdgdfgdfgdfgdfgdfgdfgdfgdfgdfdffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff	            ', 'Test message...		');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blockedcountry`
--
ALTER TABLE `blockedcountry`
  ADD PRIMARY KEY (`id`),
  ADD KEY `model` (`model`,`cc`);

--
-- Indexes for table `blockedstates`
--
ALTER TABLE `blockedstates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `model` (`model`,`cc`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_top`
--
ALTER TABLE `category_top`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chatmodels`
--
ALTER TABLE `chatmodels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`,`user`);

--
-- Indexes for table `chatoperators`
--
ALTER TABLE `chatoperators`
  ADD PRIMARY KEY (`id`,`user`);

--
-- Indexes for table `chatusers`
--
ALTER TABLE `chatusers`
  ADD PRIMARY KEY (`id`,`user`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`),
  ADD KEY `country_code` (`country_code`);

--
-- Indexes for table `modelpictures`
--
ALTER TABLE `modelpictures`
  ADD KEY `ID` (`ID`);

--
-- Indexes for table `modelshows`
--
ALTER TABLE `modelshows`
  ADD PRIMARY KEY (`user`,`string`);

--
-- Indexes for table `package`
--
ALTER TABLE `package`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pagseguro`
--
ALTER TABLE `pagseguro`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `referencia` (`referencia`);

--
-- Indexes for table `paymentgate`
--
ALTER TABLE `paymentgate`
  ADD PRIMARY KEY (`code`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`,`date`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`type`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_models_message`
--
ALTER TABLE `users_models_message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_kick`
--
ALTER TABLE `user_kick`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_logged_in`
--
ALTER TABLE `user_logged_in`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_states`
--
ALTER TABLE `user_states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `videosessions`
--
ALTER TABLE `videosessions`
  ADD KEY `sessionid` (`sessionid`,`member`,`model`);

--
-- Indexes for table `videosessions1`
--
ALTER TABLE `videosessions1`
  ADD KEY `sessionid` (`sessionid`,`member`,`model`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blockedcountry`
--
ALTER TABLE `blockedcountry`
  MODIFY `id` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `blockedstates`
--
ALTER TABLE `blockedstates`
  MODIFY `id` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- AUTO_INCREMENT for table `category_top`
--
ALTER TABLE `category_top`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=251;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=243;

--
-- AUTO_INCREMENT for table `modelpictures`
--
ALTER TABLE `modelpictures`
  MODIFY `ID` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111345;

--
-- AUTO_INCREMENT for table `package`
--
ALTER TABLE `package`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `pagseguro`
--
ALTER TABLE `pagseguro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `paymentgate`
--
ALTER TABLE `paymentgate`
  MODIFY `code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `users_models_message`
--
ALTER TABLE `users_models_message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=275;

--
-- AUTO_INCREMENT for table `user_kick`
--
ALTER TABLE `user_kick`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `user_logged_in`
--
ALTER TABLE `user_logged_in`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_states`
--
ALTER TABLE `user_states`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
