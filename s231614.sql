-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generato il: Giu 15, 2016 alle 12:14
-- Versione del server: 5.5.49
-- Versione PHP: 5.3.10-1ubuntu3.22

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `s231614`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `reservations`
--

CREATE TABLE IF NOT EXISTS `reservations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `hour_s` time NOT NULL,
  `duration` int(11) NOT NULL,
  `machine` int(11) NOT NULL,
  `res_time` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=84 ;

--
-- Dump dei dati per la tabella `reservations`
--

INSERT INTO `reservations` (`id`, `username`, `hour_s`, `duration`, `machine`, `res_time`) VALUES
(77, 'u2@p.it', '14:30:00', 60, 2, '07:00:00'),
(75, 'u3@p.it', '10:30:00', 30, 1, '07:00:00'),
(71, 'u2@p.it', '09:00:00', 30, 1, '07:00:00'),
(72, 'u2@p.it', '09:30:00', 30, 2, '07:00:00'),
(76, 'u1@p.it', '14:00:00', 60, 1, '07:00:00'),
(74, 'u3@p.it', '10:00:00', 30, 2, '07:00:00'),
(70, 'u1@p.it', '08:30:00', 30, 2, '07:00:00'),
(69, 'u1@p.it', '08:00:00', 30, 1, '07:00:00');

-- --------------------------------------------------------

--
-- Struttura della tabella `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(32) NOT NULL,
  `firstname` varchar(32) NOT NULL,
  `lastname` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `users`
--

INSERT INTO `users` (`username`, `firstname`, `lastname`, `password`) VALUES
('u3@p.it', 'u3', 'u3', '7bc3ca68769437ce986455407dab2a1f'),
('u2@p.it', 'u2', 'u2', '1d665b9b1467944c128a5575119d1cfd'),
('u1@p.it', 'u1', 'u1', '83878c91171338902e0fe0fb97a8c47a');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
