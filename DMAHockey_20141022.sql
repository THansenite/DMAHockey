-- phpMyAdmin SQL Dump
-- version 2.11.11.3
-- http://www.phpmyadmin.net
--
-- Host: 10.8.6.153
-- Generation Time: Oct 22, 2014 at 10:35 PM
-- Server version: 5.5.33
-- PHP Version: 5.3.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `DMAHockey`
--

-- --------------------------------------------------------

--
-- Table structure for table `game`
--

DROP TABLE IF EXISTS `game`;
CREATE TABLE `game` (
  `id` int(4) NOT NULL,
  `home_score` int(2) NOT NULL,
  `away_score` int(2) NOT NULL,
  `special_case` enum('NONE','H_SOL','A_SOL','H_FOR','A_FOR','OTHER') CHARACTER SET armscii8 NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `game`
--

INSERT INTO `game` VALUES(1, 4, 4, 'H_SOL');
INSERT INTO `game` VALUES(2, 7, 2, 'NONE');
INSERT INTO `game` VALUES(3, 6, 3, 'NONE');
INSERT INTO `game` VALUES(4, 0, 0, 'A_FOR');
INSERT INTO `game` VALUES(5, 7, 5, 'NONE');
INSERT INTO `game` VALUES(6, 6, 1, 'NONE');
INSERT INTO `game` VALUES(7, 3, 9, 'NONE');
INSERT INTO `game` VALUES(8, 9, 7, 'NONE');
INSERT INTO `game` VALUES(9, 2, 5, 'NONE');
INSERT INTO `game` VALUES(10, 5, 2, 'NONE');
INSERT INTO `game` VALUES(11, 4, 4, 'A_SOL');
INSERT INTO `game` VALUES(12, 4, 4, 'H_SOL');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

DROP TABLE IF EXISTS `schedule`;
CREATE TABLE `schedule` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `home` int(3) NOT NULL,
  `away` int(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=armscii8 AUTO_INCREMENT=113 ;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` VALUES(1, '2014-10-01', '18:45:00', 1, 7);
INSERT INTO `schedule` VALUES(2, '2014-10-01', '20:05:00', 5, 6);
INSERT INTO `schedule` VALUES(3, '2014-10-01', '21:25:00', 2, 3);
INSERT INTO `schedule` VALUES(4, '2014-10-01', '22:45:00', 4, 8);
INSERT INTO `schedule` VALUES(5, '2014-10-08', '18:45:00', 5, 8);
INSERT INTO `schedule` VALUES(6, '2014-10-08', '20:05:00', 7, 3);
INSERT INTO `schedule` VALUES(7, '2014-10-08', '21:25:00', 6, 1);
INSERT INTO `schedule` VALUES(8, '2014-10-08', '22:45:00', 2, 4);
INSERT INTO `schedule` VALUES(9, '2014-10-15', '18:45:00', 6, 8);
INSERT INTO `schedule` VALUES(10, '2014-10-15', '20:05:00', 5, 2);
INSERT INTO `schedule` VALUES(11, '2014-10-15', '21:25:00', 7, 4);
INSERT INTO `schedule` VALUES(12, '2014-10-15', '22:45:00', 1, 3);
INSERT INTO `schedule` VALUES(13, '2014-10-22', '18:45:00', 3, 4);
INSERT INTO `schedule` VALUES(14, '2014-10-22', '20:05:00', 8, 1);
INSERT INTO `schedule` VALUES(15, '2014-10-22', '21:25:00', 7, 5);
INSERT INTO `schedule` VALUES(16, '2014-10-22', '22:45:00', 6, 2);
INSERT INTO `schedule` VALUES(17, '2014-10-29', '18:45:00', 6, 7);
INSERT INTO `schedule` VALUES(18, '2014-10-29', '20:05:00', 1, 4);
INSERT INTO `schedule` VALUES(19, '2014-10-29', '21:25:00', 8, 2);
INSERT INTO `schedule` VALUES(20, '2014-10-29', '22:45:00', 3, 5);
INSERT INTO `schedule` VALUES(21, '2014-11-05', '18:45:00', 2, 1);
INSERT INTO `schedule` VALUES(22, '2014-11-05', '20:05:00', 3, 6);
INSERT INTO `schedule` VALUES(23, '2014-11-05', '21:25:00', 4, 5);
INSERT INTO `schedule` VALUES(24, '2014-11-05', '22:45:00', 8, 7);
INSERT INTO `schedule` VALUES(25, '2014-11-12', '18:45:00', 4, 6);
INSERT INTO `schedule` VALUES(26, '2014-11-12', '20:05:00', 2, 7);
INSERT INTO `schedule` VALUES(27, '2014-11-12', '21:25:00', 8, 3);
INSERT INTO `schedule` VALUES(28, '2014-11-12', '22:45:00', 5, 1);
INSERT INTO `schedule` VALUES(29, '2014-11-19', '18:45:00', 5, 6);
INSERT INTO `schedule` VALUES(30, '2014-11-19', '20:05:00', 2, 3);
INSERT INTO `schedule` VALUES(31, '2014-11-19', '21:25:00', 4, 8);
INSERT INTO `schedule` VALUES(32, '2014-11-19', '22:45:00', 1, 7);
INSERT INTO `schedule` VALUES(33, '2014-12-03', '18:45:00', 7, 3);
INSERT INTO `schedule` VALUES(34, '2014-12-03', '20:05:00', 6, 1);
INSERT INTO `schedule` VALUES(35, '2014-12-03', '21:25:00', 4, 2);
INSERT INTO `schedule` VALUES(36, '2014-12-03', '22:45:00', 5, 8);
INSERT INTO `schedule` VALUES(37, '2014-12-10', '18:45:00', 5, 2);
INSERT INTO `schedule` VALUES(38, '2014-12-10', '20:05:00', 7, 4);
INSERT INTO `schedule` VALUES(39, '2014-12-10', '21:25:00', 1, 3);
INSERT INTO `schedule` VALUES(40, '2014-12-10', '22:45:00', 6, 8);
INSERT INTO `schedule` VALUES(41, '2014-12-17', '18:45:00', 8, 1);
INSERT INTO `schedule` VALUES(42, '2014-12-17', '20:05:00', 7, 5);
INSERT INTO `schedule` VALUES(43, '2014-12-17', '21:25:00', 6, 2);
INSERT INTO `schedule` VALUES(44, '2014-12-17', '22:45:00', 3, 4);
INSERT INTO `schedule` VALUES(45, '2015-01-07', '18:45:00', 4, 1);
INSERT INTO `schedule` VALUES(46, '2015-01-07', '20:05:00', 8, 2);
INSERT INTO `schedule` VALUES(47, '2015-01-07', '21:25:00', 3, 5);
INSERT INTO `schedule` VALUES(48, '2015-01-07', '22:45:00', 7, 6);
INSERT INTO `schedule` VALUES(49, '2015-01-14', '18:45:00', 3, 6);
INSERT INTO `schedule` VALUES(50, '2015-01-14', '20:05:00', 5, 4);
INSERT INTO `schedule` VALUES(51, '2015-01-14', '21:25:00', 8, 7);
INSERT INTO `schedule` VALUES(52, '2015-01-14', '22:45:00', 2, 1);
INSERT INTO `schedule` VALUES(53, '2015-01-21', '18:45:00', 2, 7);
INSERT INTO `schedule` VALUES(54, '2015-01-21', '20:05:00', 3, 8);
INSERT INTO `schedule` VALUES(55, '2015-01-21', '21:25:00', 1, 5);
INSERT INTO `schedule` VALUES(56, '2015-01-21', '22:45:00', 4, 6);
INSERT INTO `schedule` VALUES(57, '2015-01-28', '18:45:00', 2, 3);
INSERT INTO `schedule` VALUES(58, '2015-01-28', '20:05:00', 4, 8);
INSERT INTO `schedule` VALUES(59, '2015-01-28', '21:25:00', 1, 7);
INSERT INTO `schedule` VALUES(60, '2015-01-28', '22:45:00', 5, 6);
INSERT INTO `schedule` VALUES(61, '2015-02-04', '18:45:00', 6, 1);
INSERT INTO `schedule` VALUES(62, '2015-02-04', '20:05:00', 4, 2);
INSERT INTO `schedule` VALUES(63, '2015-02-04', '21:25:00', 5, 8);
INSERT INTO `schedule` VALUES(64, '2015-02-04', '22:45:00', 7, 3);
INSERT INTO `schedule` VALUES(65, '2015-02-11', '18:45:00', 7, 4);
INSERT INTO `schedule` VALUES(66, '2015-02-11', '20:05:00', 1, 3);
INSERT INTO `schedule` VALUES(67, '2015-02-11', '21:25:00', 6, 8);
INSERT INTO `schedule` VALUES(68, '2015-02-11', '22:45:00', 5, 2);
INSERT INTO `schedule` VALUES(69, '2015-02-18', '18:45:00', 7, 5);
INSERT INTO `schedule` VALUES(70, '2015-02-18', '20:05:00', 6, 2);
INSERT INTO `schedule` VALUES(71, '2015-02-18', '21:25:00', 3, 4);
INSERT INTO `schedule` VALUES(72, '2015-02-18', '22:45:00', 8, 1);
INSERT INTO `schedule` VALUES(73, '2015-02-25', '18:45:00', 8, 2);
INSERT INTO `schedule` VALUES(74, '2015-02-25', '20:05:00', 3, 5);
INSERT INTO `schedule` VALUES(75, '2015-02-25', '21:25:00', 6, 7);
INSERT INTO `schedule` VALUES(76, '2015-02-25', '22:45:00', 1, 4);
INSERT INTO `schedule` VALUES(77, '2015-03-04', '18:45:00', 4, 5);
INSERT INTO `schedule` VALUES(78, '2015-03-04', '20:05:00', 8, 7);
INSERT INTO `schedule` VALUES(79, '2015-03-04', '21:25:00', 2, 1);
INSERT INTO `schedule` VALUES(80, '2015-03-04', '22:45:00', 3, 6);
INSERT INTO `schedule` VALUES(81, '2015-03-11', '18:45:00', 3, 8);
INSERT INTO `schedule` VALUES(82, '2015-03-11', '20:05:00', 1, 5);
INSERT INTO `schedule` VALUES(83, '2015-03-11', '21:25:00', 4, 6);
INSERT INTO `schedule` VALUES(84, '2015-03-11', '22:45:00', 2, 7);
INSERT INTO `schedule` VALUES(85, '2015-03-25', '18:45:00', 4, 8);
INSERT INTO `schedule` VALUES(86, '2015-03-25', '20:05:00', 1, 7);
INSERT INTO `schedule` VALUES(87, '2015-03-25', '21:25:00', 5, 6);
INSERT INTO `schedule` VALUES(88, '2015-03-25', '22:45:00', 2, 3);
INSERT INTO `schedule` VALUES(89, '2015-04-01', '18:45:00', 2, 4);
INSERT INTO `schedule` VALUES(90, '2015-04-01', '20:05:00', 5, 8);
INSERT INTO `schedule` VALUES(91, '2015-04-01', '21:25:00', 7, 3);
INSERT INTO `schedule` VALUES(92, '2015-04-01', '22:45:00', 6, 1);
INSERT INTO `schedule` VALUES(93, '2015-04-08', '18:45:00', 1, 3);
INSERT INTO `schedule` VALUES(94, '2015-04-08', '20:05:00', 6, 8);
INSERT INTO `schedule` VALUES(95, '2015-04-08', '21:25:00', 5, 2);
INSERT INTO `schedule` VALUES(96, '2015-04-08', '22:45:00', 7, 4);
INSERT INTO `schedule` VALUES(97, '2015-04-15', '18:45:00', 6, 2);
INSERT INTO `schedule` VALUES(98, '2015-04-15', '20:05:00', 3, 4);
INSERT INTO `schedule` VALUES(99, '2015-04-15', '21:25:00', 8, 1);
INSERT INTO `schedule` VALUES(100, '2015-04-15', '22:45:00', 7, 5);
INSERT INTO `schedule` VALUES(101, '2015-04-22', '18:45:00', 3, 5);
INSERT INTO `schedule` VALUES(102, '2015-04-22', '20:05:00', 7, 6);
INSERT INTO `schedule` VALUES(103, '2015-04-22', '21:25:00', 1, 4);
INSERT INTO `schedule` VALUES(104, '2015-04-22', '22:45:00', 8, 2);
INSERT INTO `schedule` VALUES(105, '2015-04-29', '18:45:00', 8, 7);
INSERT INTO `schedule` VALUES(106, '2015-04-29', '20:05:00', 2, 1);
INSERT INTO `schedule` VALUES(107, '2015-04-29', '21:25:00', 3, 6);
INSERT INTO `schedule` VALUES(108, '2015-04-29', '22:45:00', 4, 5);
INSERT INTO `schedule` VALUES(109, '2015-05-06', '18:45:00', 1, 5);
INSERT INTO `schedule` VALUES(110, '2015-05-06', '20:05:00', 4, 6);
INSERT INTO `schedule` VALUES(111, '2015-05-06', '21:25:00', 2, 7);
INSERT INTO `schedule` VALUES(112, '2015-05-06', '22:45:00', 8, 3);

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

DROP TABLE IF EXISTS `team`;
CREATE TABLE `team` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `season` int(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=armscii8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `team`
--

INSERT INTO `team` VALUES(1, 'Red Alert', 1);
INSERT INTO `team` VALUES(2, 'Alien', 1);
INSERT INTO `team` VALUES(3, 'Kryptonite', 1);
INSERT INTO `team` VALUES(4, 'FoDM/KB', 1);
INSERT INTO `team` VALUES(5, 'Rink Rats', 1);
INSERT INTO `team` VALUES(6, 'Flying Moose', 1);
INSERT INTO `team` VALUES(7, 'Victors', 1);
INSERT INTO `team` VALUES(8, 'Ichi Bike', 1);
