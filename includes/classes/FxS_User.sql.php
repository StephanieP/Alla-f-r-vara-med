<?php
// Kan enbart köras som FxS_core.php är inkluderad före.
if (!defined("_EXECUTE")) {
	echo "Not allowed";
	exit;
}
?>

-- phpMyAdmin SQL Dump
-- version 3.3.9.2
-- http://www.phpmyadmin.net
--
-- Värd: 127.0.0.1
-- Skapad: 20 juni 2011 kl 23:42
-- Serverversion: 5.5.10
-- PHP-version: 5.3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databas: `fxs_database`
--

-- --------------------------------------------------------

--
-- Struktur för tabell `fxs_login_accounts`
--

CREATE TABLE IF NOT EXISTS `fxs_login_accounts` (
  `login_ID` int(11) NOT NULL AUTO_INCREMENT,
  `login_username` varchar(30) COLLATE utf8_swedish_ci NOT NULL,
  `login_password` binary(20) NOT NULL,
  `last_login` int(11) NOT NULL,
  `last_login_ip` varchar(16) COLLATE utf8_swedish_ci NOT NULL,
  `register_date` int(11) NOT NULL,
  `register_ip` varchar(16) COLLATE utf8_swedish_ci NOT NULL,
  `login_activated` tinyint(1) NOT NULL DEFAULT '0',
  `login_locked` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`login_ID`),
  UNIQUE KEY `login_ID` (`login_ID`,`login_username`),
  UNIQUE KEY `login_username` (`login_username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- Struktur för tabell `fxs_login_privileges`
--

CREATE TABLE IF NOT EXISTS `fxs_login_privileges` (
  `login_id` int(11) NOT NULL,
  `privilege_value` varchar(20) COLLATE utf8_swedish_ci NOT NULL,
  KEY `login_id` (`login_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;
