-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Nov 29, 2017 at 11:57 PM
-- Server version: 5.5.42
-- PHP Version: 7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `simpplo`
--
CREATE DATABASE IF NOT EXISTS `simpplo` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `simpplo`;

-- --------------------------------------------------------

--
-- Table structure for table `ads`
--

CREATE TABLE `ads` (
  `name` varchar(100) NOT NULL,
  `price` varchar(100) NOT NULL,
  `image` mediumtext NOT NULL,
  `year` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `color` varchar(100) NOT NULL,
  `doors` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
