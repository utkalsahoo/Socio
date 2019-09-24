-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 02, 2018 at 11:19 AM
-- Server version: 5.7.21
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `socio`
--

-- --------------------------------------------------------

--
-- Table structure for table `friendrqst`
--

DROP TABLE IF EXISTS `friendrqst`;
CREATE TABLE IF NOT EXISTS `friendrqst` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `senderid` int(11) NOT NULL,
  `receiverid` int(11) NOT NULL,
  `reqdate` date NOT NULL,
  `accept` tinyint(1) DEFAULT NULL,
  `acceptdate` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `friendrqst`
--

INSERT INTO `friendrqst` (`id`, `senderid`, `receiverid`, `reqdate`, `accept`, `acceptdate`) VALUES
(35, 52, 49, '2018-06-02', 1, NULL),
(34, 52, 48, '2018-06-02', 1, NULL),
(33, 51, 48, '2018-06-02', 1, NULL),
(32, 51, 50, '2018-06-02', 1, NULL),
(31, 51, 49, '2018-06-02', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `textmsg` varchar(3000) NOT NULL,
  `userid` int(20) NOT NULL,
  `img` varchar(50) DEFAULT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `title`, `textmsg`, `userid`, `img`, `date`) VALUES
(15, 'First Experience #Socio', 'I am Loving this website.', 52, NULL, '2018-06-02'),
(14, 'First Day at SOCIO', 'Thanx utkal', 50, NULL, '2018-06-02'),
(13, 'My fav quote', 'Dream dream dream                                                                                                     \r\nturn your dream into thoughts                                                                                                      \r\nthought will transfer into action.', 48, NULL, '2018-06-02'),
(12, 'My First Post', 'Optimism is the faith that leads to achievement. ', 48, NULL, '2018-06-02'),
(16, 'My Fav', 'Infuse your life with action. Dont wait for it to happen. Make it happen. Make your own future. Make your own hope. Make your own love. And whatever your beliefs, honor your creator, not by passively waiting for grace to come down from upon high, but by doing what you can to make grace happen... yourself, right now, right down here on Earth.', 52, NULL, '2018-06-02');

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

DROP TABLE IF EXISTS `profile`;
CREATE TABLE IF NOT EXISTS `profile` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `profilepic` varchar(50) DEFAULT NULL,
  `aboutme` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `userid`, `phone`, `profilepic`, `aboutme`) VALUES
(35, 53, NULL, NULL, NULL),
(34, 52, NULL, NULL, NULL),
(33, 51, NULL, NULL, NULL),
(32, 50, '1234567890', NULL, ''),
(31, 49, NULL, NULL, NULL),
(30, 48, '8280588820', NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(10) NOT NULL,
  `regdate` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=54 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `email`, `password`, `dob`, `gender`, `regdate`) VALUES
(49, 'Urbashi', 'Panda', 'urbashipanda95@gmail.com', '202cb962ac59075b964b07152d234b70', '1995-01-15', 'Female', '2018-06-02'),
(48, 'Utkal Kumar', 'Sahoo', 'utkalsahoo987@gmail.com', 'aef4f3a4943ebdc9534df6301e1cc446', '1997-11-03', 'Male', '2018-06-02'),
(50, 'Gce', 'Keonjhar', 'gce.keonjhar@gmail.com', '202cb962ac59075b964b07152d234b70', '2018-12-31', 'Other', '2018-06-02'),
(51, 'smruti', 'keshari', 'kesharismrutirekha645@gmail.com', '202cb962ac59075b964b07152d234b70', '1996-01-17', 'Female', '2018-06-02'),
(52, 'Madhusmita', 'sahu', 'madhusmita.sahu@gmail.com', '202cb962ac59075b964b07152d234b70', '1996-12-21', 'Female', '2018-06-02'),
(53, 'Kalinga Kumar', 'Sahoo', 'kalingasahoo987@gmail.com', '202cb962ac59075b964b07152d234b70', '2000-06-02', 'Male', '2018-06-02');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
