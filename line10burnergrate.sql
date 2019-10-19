-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Czas generowania: 28 Sie 2019, 18:53
-- Wersja serwera: 5.7.26
-- Wersja PHP: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `line10burnergrate`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `grate10`
--

DROP TABLE IF EXISTS `grate10`;
CREATE TABLE IF NOT EXISTS `grate10` (
  `Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Code` int(10) UNSIGNED NOT NULL,
  `Short` varchar(3) CHARACTER SET utf8 NOT NULL,
  `One` int(11) UNSIGNED NOT NULL,
  `Two` int(11) UNSIGNED NOT NULL,
  `Red` int(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=58 DEFAULT CHARSET=ucs2 COLLATE=ucs2_polish_ci;

--
-- Zrzut danych tabeli `grate10`
--

INSERT INTO `grate10` (`Id`, `Code`, `Short`, `One`, `Two`, `Red`) VALUES
(1, 551031, 'C', 0, 0, 0),
(2, 551081, 'C', 0, 0, 0),
(3, 554644, 'C', 0, 0, 0),
(4, 551621, '*61', 258427, 258427, 0),
(5, 551630, '*61', 258427, 258427, 0),
(6, 551661, '*59', 113201, 113201, 130300),
(7, 551640, 'C', 0, 0, 0),
(8, 551691, '*53', 256080, 256080, 73902),
(9, 551701, '*61', 258427, 258427, 0),
(10, 554251, '*52', 255892, 258812, 130300),
(11, 554271, '*54', 255892, 255892, 130300),
(12, 554291, 'C', 0, 0, 0),
(13, 554321, '*59', 113201, 113201, 130300),
(14, 554331, 'C', 0, 0, 0),
(15, 554341, '*59', 113201, 113201, 130300),
(16, 554371, 'C', 0, 0, 0),
(17, 554401, 'C', 0, 0, 0),
(18, 551411, '*53', 256080, 256080, 73902),
(19, 551431, '*53', 256080, 256080, 73902),
(20, 554461, 'C', 0, 0, 0),
(21, 554481, 'C', 0, 0, 0),
(22, 551490, '*58', 120200, 120200, 130300),
(23, 554511, 'C', 0, 0, 0),
(24, 554521, 'C', 0, 0, 0),
(25, 554531, 'C', 0, 0, 0),
(26, 554551, '', 113201, 113201, 0),
(27, 554560, '', 113201, 113201, 0),
(28, 554571, '*58', 120200, 120200, 130300),
(29, 554581, 'C', 0, 0, 0),
(30, 554591, '*52', 255892, 258812, 130300),
(31, 554611, '*59', 113201, 113201, 130300),
(32, 554621, 'C', 0, 0, 0),
(33, 554641, 'C', 0, 0, 0),
(34, 554651, 'C', 0, 0, 0),
(35, 554681, 'C', 0, 0, 0),
(36, 554691, 'C', 0, 0, 0),
(37, 554701, '*58', 120200, 120200, 130300),
(38, 554711, '*57', 120200, 120300, 130300),
(39, 554741, 'C', 0, 0, 0),
(40, 554801, '*52', 255892, 258812, 130300),
(41, 554901, '*57', 120200, 120300, 130300),
(42, 570100, '*53', 256080, 256080, 73902),
(43, 579851, 'C', 0, 0, 0),
(44, 688570, '*53', 256080, 256080, 73902),
(45, 809960, '*59', 113201, 113201, 130300),
(46, 810200, '*54', 255892, 255892, 130300),
(47, 837870, '*54', 255892, 255892, 130300),
(48, 837950, '*53', 256080, 256080, 73902),
(49, 838030, '*57', 120200, 120300, 130300),
(50, 838080, '', 113201, 113201, 0),
(51, 839450, '*58', 120200, 120200, 130300),
(52, 843810, '*54', 255892, 255892, 130300),
(53, 844090, '*58', 120200, 120200, 130300),
(54, 845700, '*58', 120200, 120200, 130300),
(55, 876060, 'C', 0, 0, 0),
(56, 890000, '*52', 255892, 258812, 130300),
(57, 967100, '*58', 120200, 120200, 130300);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` text COLLATE utf8_polish_ci NOT NULL,
  `pass` text COLLATE utf8_polish_ci NOT NULL,
  `email` text COLLATE utf8_polish_ci NOT NULL,
  `drewno` int(11) NOT NULL,
  `kamien` int(11) NOT NULL,
  `zboze` int(11) NOT NULL,
  `dnipremium` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `user`, `pass`, `email`, `drewno`, `kamien`, `zboze`, `dnipremium`) VALUES
(1, 'adam', 'qwerty', 'adam@gmail.com', 213, 5675, 342, 0),
(2, 'marek', 'asdfg', 'marek@gmail.com', 324, 1123, 4325, 15),
(3, 'anna', 'zxcvb', 'anna@gmail.com', 4536, 17, 120, 25),
(4, 'andrzej', 'asdfg', 'andrzej@gmail.com', 5465, 132, 189, 0),
(5, 'justyna', 'yuiop', 'justyna@gmail.com', 245, 890, 554, 0),
(6, 'kasia', 'hjkkl', 'kasia@gmail.com', 267, 980, 109, 12),
(7, 'beata', 'fgthj', 'beata@gmail.com', 565, 356, 447, 77),
(8, 'jakub', 'ertyu', 'jakub@gmail.com', 2467, 557, 876, 0),
(9, 'janusz', 'cvbnm', 'janusz@gmail.com', 65, 456, 2467, 0),
(10, 'roman', 'dfghj', 'roman@gmail.com', 97, 226, 245, 23);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
