-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 12. Nov 2012 um 11:59
-- Server Version: 5.5.25a
-- PHP-Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `doku`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `changelog`
--

CREATE TABLE IF NOT EXISTS `changelog` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `version` int(8) NOT NULL,
  `action` varchar(500) NOT NULL,
  `autor` varchar(500) NOT NULL,
  `date` int(13) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `classes`
--

CREATE TABLE IF NOT EXISTS `classes` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `functions-id` int(8) NOT NULL,
  `name` varchar(500) NOT NULL,
  `args` text NOT NULL,
  `changelog-id` int(8) NOT NULL,
  `version` int(8) NOT NULL,
  `date` int(13) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `functions`
--

CREATE TABLE IF NOT EXISTS `functions` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `name` varchar(500) NOT NULL,
  `changelog-id` int(8) NOT NULL,
  `args` text NOT NULL,
  `kurz-beschreibung` varchar(500) NOT NULL,
  `return-wert` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
