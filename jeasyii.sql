-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 28, 2012 at 03:04 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `yiicustom.v.1`
--

-- --------------------------------------------------------

--
-- Table structure for table `sys_action`
--

CREATE TABLE IF NOT EXISTS `sys_action` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `menu_id` int(10) NOT NULL,
  `name` varchar(64) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `menu_id` (`menu_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `sys_action`
--

INSERT INTO `sys_action` (`id`, `menu_id`, `name`) VALUES
(1, 7, 'index'),
(2, 7, 'create'),
(3, 7, 'delete'),
(5, 7, 'getData'),
(6, 31, 'index'),
(7, 31, 'save'),
(8, 31, 'delete'),
(9, 31, 'getData'),
(10, 5, 'index');

-- --------------------------------------------------------

--
-- Table structure for table `sys_action_assignment`
--

CREATE TABLE IF NOT EXISTS `sys_action_assignment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `action_id` int(11) NOT NULL,
  `menu_user_assignment_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `action_id` (`action_id`,`menu_user_assignment_id`),
  KEY `sys_action_assignment_ibfk_2` (`menu_user_assignment_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `sys_action_assignment`
--

INSERT INTO `sys_action_assignment` (`id`, `action_id`, `menu_user_assignment_id`) VALUES
(7, 1, 5),
(8, 2, 5),
(6, 3, 5),
(9, 5, 5),
(10, 6, 7),
(11, 7, 7),
(12, 8, 7),
(13, 9, 7),
(14, 10, 2);

-- --------------------------------------------------------

--
-- Table structure for table `sys_menu`
--

CREATE TABLE IF NOT EXISTS `sys_menu` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `label` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `visible` varchar(128) NOT NULL,
  `parent_id` int(10) DEFAULT NULL,
  `template` varchar(128) DEFAULT NULL,
  `linkOptions` varchar(128) DEFAULT NULL,
  `ItemOptions` varchar(128) DEFAULT NULL,
  `submenuOptions` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `parent_id_fk` (`parent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `sys_menu`
--

INSERT INTO `sys_menu` (`id`, `label`, `url`, `visible`, `parent_id`, `template`, `linkOptions`, `ItemOptions`, `submenuOptions`) VALUES
(5, 'Home', 'admin/index/index', '1', 6, '', '', '', ''),
(6, 'root back end', '#', '1', NULL, '', '', '', ''),
(7, 'User', 'admin/user', '1', 6, '', '', '', ''),
(27, 'Logout', 'admin/login/logout', '1', 6, '', '', '', ''),
(28, 'Home', 'site/index', '1', 30, '', '', '', ''),
(29, 'Contact1', 'site/contact', '1', 30, '', '', '', ''),
(30, 'root front end', '#', '1', 5, '', '', '', ''),
(31, 'Menu', 'admin/menu', '1', 6, '', '', '', ''),
(32, 'Sub12', 'admin/subasd/asd', '1', 31, NULL, NULL, NULL, NULL),
(33, 'Sub1', '#', '1', 32, NULL, NULL, NULL, NULL),
(34, 'Sub23', 'site/contact', '1', 33, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sys_menu_user_assignment`
--

CREATE TABLE IF NOT EXISTS `sys_menu_user_assignment` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `menu_id` int(10) NOT NULL DEFAULT '0',
  `user_id` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `menu_id_fk` (`menu_id`),
  KEY `user_id_fk` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `sys_menu_user_assignment`
--

INSERT INTO `sys_menu_user_assignment` (`id`, `menu_id`, `user_id`) VALUES
(2, 5, 2),
(5, 7, 2),
(6, 27, 2),
(7, 31, 2),
(8, 32, 2),
(10, 33, 2),
(12, 34, 2),
(14, 30, 2),
(15, 29, 2),
(16, 28, 2);

-- --------------------------------------------------------

--
-- Table structure for table `sys_user`
--

CREATE TABLE IF NOT EXISTS `sys_user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL,
  `password` varchar(128) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `sys_user`
--

INSERT INTO `sys_user` (`id`, `username`, `password`) VALUES
(2, 'a', '86f7e437faa5a7fce15d1ddcb9eaeaea377667b80cc175b9c0f1b6a831c399e269772661'),
(34, 'c', '7a38d8cbd20d9932ba948efaa364bb62651d5ad49e3669d19b675bd57058fd4664205d2a'),
(35, 'n', 'd1854cae891ec7b29161ccaf79a24b00c274bdaa7b8b965ad4bca0e41ab51de7b31363a1'),
(36, 'm', '6b0d31c0d563223024da45691584643ac78c96e86f8f57715090da2632453988d9a1501b');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sys_action`
--
ALTER TABLE `sys_action`
  ADD CONSTRAINT `sys_action_ibfk_1` FOREIGN KEY (`menu_id`) REFERENCES `sys_menu` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `sys_action_assignment`
--
ALTER TABLE `sys_action_assignment`
  ADD CONSTRAINT `sys_action_assignment_ibfk_1` FOREIGN KEY (`action_id`) REFERENCES `sys_action` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `sys_action_assignment_ibfk_2` FOREIGN KEY (`menu_user_assignment_id`) REFERENCES `sys_menu_user_assignment` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `sys_menu`
--
ALTER TABLE `sys_menu`
  ADD CONSTRAINT `parent_id_fk` FOREIGN KEY (`parent_id`) REFERENCES `sys_menu` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `sys_menu_user_assignment`
--
ALTER TABLE `sys_menu_user_assignment`
  ADD CONSTRAINT `menu_id_fk` FOREIGN KEY (`menu_id`) REFERENCES `sys_menu` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `sys_user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
