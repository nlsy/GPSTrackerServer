-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 16. Mai 2021 um 15:35
-- Server-Version: 10.4.11-MariaDB
-- PHP-Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `trackerdata`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `trackerdata_test`
--

CREATE TABLE `trackerdata_test` (
  `id` int(11) UNSIGNED NOT NULL,
  `serial` int(11) UNSIGNED DEFAULT NULL,
  `datetime` datetime NOT NULL,
  `gpstime` time NOT NULL,
  `lat` double NOT NULL,
  `lon` double NOT NULL,
  `gsm` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `trackerdata_test`
--

INSERT INTO `trackerdata_test` (`id`, `serial`, `datetime`, `gpstime`, `lat`, `lon`, `gsm`) VALUES
(1, NULL, '2021-05-13 08:58:07', '16:58:08', 43, 23, NULL),
(2, NULL, '2021-05-12 11:23:36', '11:14:18', 47.808166666667, 9.6455, 'Array'),
(3, NULL, '2021-05-12 11:39:00', '21:54:18', 50.808166666667, 10.6455, 'Array'),
(4, NULL, '2021-05-14 13:51:55', '21:54:18', 50.808166666667, 10.6455, '\"5 45 1 0\"'),
(5, NULL, '2021-05-14 13:54:17', '21:54:18', 50.808166666667, 10.6455, '\"5 45 1 0\"');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `trackerdata_test`
--
ALTER TABLE `trackerdata_test`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `trackerdata_test`
--
ALTER TABLE `trackerdata_test`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;



CREATE TABLE  `trackerdata`(
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `serial` int(11) UNSIGNED NULL,
  `datetime` DATETIME NOT NULL,
  `gpstime` TIME NOT NULL,
  `lat` DOUBLE NULL,
  `lon` DOUBLE NULL,
  `gsm` TEXT NULL,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB;

CREATE TABLE `trackerdata`.`trackerdata_test` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `serial` INT(11) UNSIGNED NOT NULL ,
  `datetime` DATETIME NOT NULL ,
  `gpstime` TIME NOT NULL ,
  `lat` DOUBLE NOT NULL ,
  `lon` DOUBLE NOT NULL ,
  `gsm` TEXT NULL ,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB;