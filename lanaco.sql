-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 20, 2023 at 07:31 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lanaco`
--

-- --------------------------------------------------------

--
-- Table structure for table `artikl`
--

CREATE TABLE `artikl` (
  `artikl_id` int(11) NOT NULL,
  `sifra_art` varchar(50) NOT NULL,
  `naziv_art` varchar(50) NOT NULL,
  `jedinica_mjere` varchar(3) NOT NULL,
  `bar_kod` char(13) NOT NULL,
  `plu_kod` char(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `artikl`
--

INSERT INTO `artikl` (`artikl_id`, `sifra_art`, `naziv_art`, `jedinica_mjere`, `bar_kod`, `plu_kod`) VALUES
(1, '', 'd', 'kg', '1211111111111', '21111'),
(5, '', 'ee', 'dd', '33', '33'),
(8, '', 'new', 'dd', '3333', '333'),
(9, '', 'lpj', 'd', '33', '333'),
(10, '', 'rbb', 'rt', '444', '333');

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `korisnikID` int(11) NOT NULL,
  `korisnicko_ime` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(40) NOT NULL,
  `rolaID` int(11) NOT NULL DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`korisnikID`, `korisnicko_ime`, `password`, `email`, `rolaID`) VALUES
(6, '', '', '', 2),
(7, '', '', '', 2),
(12, 'ee', '$argon2i$v=19$m=65536,t=4,p=1$RmpBSC5wVGJ4ZXRhQzBQdw$6i2nR96vZfrgCLlhTOmAUL4VLHeU+4dM10nbme9uYZs', '', 2),
(13, 'rr', 'rr', '', 1),
(14, 'tt', '$argon2i$v=19$m=65536,t=4,p=1$b0dnTDhtdjR5NXRsVFJSQw$vpxCPMKCMyIFPCxejSgQuWdEmvj4PY7SHfGsTGB15mk', '', 1),
(15, 'nn', '$argon2i$v=19$m=65536,t=4,p=1$dHA0RFU5NVdYS3pCT1ZyNw$bprHRL1m0/nhmdY3+lk7BOxfMXzPUg02avfsuApodUY', '', 2),
(16, 'bb', '$argon2i$v=19$m=65536,t=4,p=1$a0VTTDNLZzlFcWE2WkZSUg$ZygwPa9gYn5/zxsOpZmz19IKrIlTkLf7PWu2LlvEfBc', '', 2),
(17, 'eee', '$argon2i$v=19$m=65536,t=4,p=1$VDVlRzFsNm1oQVI5aUFJOA$bu900K6bEa9qZ+MtB2Wgd7j3bUoXJxc9tcpmqyJSxOM', '', 2),
(18, 'vvv', '$argon2i$v=19$m=65536,t=4,p=1$LjNjbGNrVTBSSG9NME9ZSg$90HR7Yb7mAKfB63j6dFGsuXiOBP8CAoyIOD2TEAxers', 'v@v', 2),
(20, 'zz', '$argon2i$v=19$m=65536,t=4,p=1$dkhMbXQ5OG9KR2JtVVlzTw$u6LKY5xqL8ZUkSmENm6qgUmzHlpkl48ENCt8GYrhdhs', 'z@z', 2),
(21, 'qq', '$argon2i$v=19$m=65536,t=4,p=1$UGZRZEd4N1dacGNKQ3dHbg$yvGuqpdffmUYBbgl8AyLYZbjk++donveqpjCUrhyvqQ', 'q@q', 1),
(22, 'cc', '$argon2i$v=19$m=65536,t=4,p=1$emI1M3pBZG9UTUt0UEU1Rg$v9eS8PpF9aubLHN9Zjl8g/ZxwZ6eYkML6yW3QPOIMEA', 'c@c', 2),
(23, 'jjj', '$argon2i$v=19$m=65536,t=4,p=1$MlFsWkE0b2l2d0k2RnVrYQ$1hDi2D4GvFuF9SzeaQFe65G0LvhqsLdZufm0Y7XAgqw', 'j@j', 2),
(24, 'user', '$argon2i$v=19$m=65536,t=4,p=1$WmlhbnN5eFNHUmlnazdLTQ$gpWkqBSMDWgGnUF0xtCB6nl4UzPcA935OBfbbs9zhw0', 'pas@pas', 2),
(25, 'ho', '$argon2i$v=19$m=65536,t=4,p=1$TUpINndHYi9pWmtzLms4NQ$nyI39Jbq4EWWARPknxY0Ww8lMljj2ADUJhR0JIqyi0o', 'h@h', 2);

-- --------------------------------------------------------

--
-- Table structure for table `lager`
--

CREATE TABLE `lager` (
  `lager_id` int(11) NOT NULL,
  `artikl_id` int(11) NOT NULL,
  `raspolozivaKolicina` decimal(18,2) NOT NULL,
  `lokacija` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lager`
--

INSERT INTO `lager` (`lager_id`, `artikl_id`, `raspolozivaKolicina`, `lokacija`) VALUES
(20, 1, '995093.79', 'tt'),
(22, 5, '99338.00', 'ggg'),
(23, 8, '99999999998054.00', 'ddd'),
(24, 9, '39999999606.00', 'd');

-- --------------------------------------------------------

--
-- Table structure for table `racun`
--

CREATE TABLE `racun` (
  `racun_id` int(11) NOT NULL,
  `radnikIDizdao` int(11) NOT NULL,
  `datumRacuna` date NOT NULL,
  `brojRacuna` varchar(30) NOT NULL,
  `ukupniIznos` decimal(18,2) DEFAULT NULL,
  `iznosPDV` decimal(18,2) DEFAULT NULL,
  `iznosBezPDV` decimal(18,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `racun`
--

INSERT INTO `racun` (`racun_id`, `radnikIDizdao`, `datumRacuna`, `brojRacuna`, `ukupniIznos`, `iznosPDV`, `iznosBezPDV`) VALUES
(1, 6, '2023-02-13', '2', '2222.00', '2222.00', '222.00'),
(6, 14, '2023-02-18', 'R-20230218025733', '0.00', '0.00', '0.00'),
(8, 17, '2023-02-18', 'R-1676725676', '0.00', '0.00', '0.00'),
(9, 17, '2023-02-18', 'R-1676726478', '0.00', '0.00', '0.00'),
(10, 17, '2023-02-18', 'R-1676726534', '0.00', '0.00', '0.00'),
(11, 17, '2023-02-18', 'R-1676726603', '0.00', '0.00', '0.00'),
(12, 16, '2023-02-18', 'R-1676726612', '0.00', '0.00', '0.00'),
(13, 16, '2023-02-18', 'R-1676727184', '0.00', '0.00', '0.00'),
(14, 16, '2023-02-18', 'R-1676727188', '0.00', '0.00', '0.00'),
(15, 16, '2023-02-18', 'R-1676727189', '0.00', '0.00', '0.00'),
(16, 16, '2023-02-18', 'R-1676727195', '0.00', '0.00', '0.00'),
(17, 17, '2023-02-18', 'R-1676727212', '0.00', '0.00', '0.00'),
(18, 17, '2023-02-18', 'R-1676733555', '0.00', '0.00', '0.00'),
(19, 15, '2023-02-18', 'R-1676734950', '0.00', '0.00', '0.00'),
(20, 15, '2023-02-18', 'R-1676735194', '0.00', '0.00', '0.00'),
(21, 17, '2023-02-18', 'R-1676735208', '0.00', '0.00', '0.00'),
(22, 17, '2023-02-18', 'R-1676735303', '0.00', '0.00', '0.00'),
(23, 15, '2023-02-18', 'R-1676735374', '0.00', '0.00', '0.00'),
(24, 15, '2023-02-18', 'R-1676736436', '0.00', '0.00', '0.00'),
(25, 17, '2023-02-18', 'R-1676736460', '0.00', '0.00', '0.00'),
(26, 17, '2023-02-18', 'R-1676736529', '0.00', '0.00', '0.00'),
(27, 17, '2023-02-18', 'R-1676736583', '0.00', '0.00', '0.00'),
(28, 17, '2023-02-18', 'R-1676737256', '0.00', '0.00', '0.00'),
(29, 16, '2023-02-18', 'R-1676737443', '0.00', '0.00', '0.00'),
(30, 16, '2023-02-18', 'R-1676737742', '0.00', '0.00', '0.00'),
(31, 6, '2023-02-18', 'R-1676738602', '0.00', '0.00', '0.00'),
(32, 6, '2023-02-18', 'R-1676739278', '0.00', '0.00', '0.00'),
(33, 14, '2023-02-18', 'R-1676739788', '0.00', '0.00', '0.00'),
(34, 14, '2023-02-18', 'R-1676740509', '0.00', '0.00', '0.00'),
(35, 14, '2023-02-18', 'R-1676741052', '0.00', '0.00', '0.00'),
(36, 6, '2023-02-18', 'R-1676741227', '0.00', '0.00', '0.00'),
(37, 6, '2023-02-18', 'R-1676741377', '0.00', '0.00', '0.00'),
(38, 6, '2023-02-18', 'R-1676741408', '0.00', '0.00', '0.00'),
(39, 6, '2023-02-18', 'R-1676741419', '0.00', '0.00', '0.00'),
(40, 6, '2023-02-18', 'R-1676741608', '0.00', '0.00', '0.00'),
(41, 15, '2023-02-18', 'R-1676742073', '0.00', '0.00', '0.00'),
(42, 6, '2023-02-18', 'R-1676742527', '0.00', '0.00', '0.00'),
(43, 15, '2023-02-15', 'R-1676742633', '0.00', '0.00', '0.00'),
(44, 16, '2023-02-18', 'R-1676743096', '0.00', '0.00', '0.00'),
(45, 16, '2023-02-18', 'R-1676743246', '0.00', '0.00', '0.00'),
(46, 17, '2023-02-18', 'R-1676744119', '0.00', '0.00', '0.00'),
(47, 15, '2023-02-15', 'R-1676744292', '0.00', '0.00', '0.00'),
(48, 15, '2023-02-15', 'R-1676744606', '0.00', '0.00', '0.00'),
(49, 6, '2023-02-18', 'R-1676744624', '0.00', '0.00', '0.00'),
(50, 17, '2023-02-18', 'R-1676744863', '0.00', '0.00', '0.00'),
(51, 17, '2023-02-18', 'R-1676745191', '0.00', '0.00', '0.00'),
(52, 15, '2023-02-18', 'R-1676745243', '0.00', '0.00', '0.00'),
(53, 14, '2023-02-18', 'R-1676745447', '0.00', '0.00', '0.00'),
(54, 14, '2023-02-18', 'R-1676745612', '0.00', '0.00', '0.00'),
(55, 15, '2023-02-18', 'R-1676746092', '0.00', '0.00', '0.00'),
(56, 14, '2023-02-18', 'R-', '0.00', '0.00', '0.00'),
(57, 14, '2023-02-18', 'R-1676746205', '0.00', '0.00', '0.00'),
(58, 16, '2023-02-18', 'R-1676746214', '0.00', '0.00', '0.00'),
(59, 15, '2023-02-18', 'R-1676746531', '0.00', '0.00', '0.00'),
(60, 15, '2023-02-18', 'R-1676746884', '0.00', '0.00', '0.00'),
(61, 16, '2023-02-18', 'R-1676746893', '0.00', '0.00', '0.00'),
(62, 14, '2023-02-18', 'R-1676747551', '0.00', '0.00', '0.00'),
(63, 15, '2023-02-18', 'R-1676747685', '0.00', '0.00', '0.00'),
(64, 15, '2023-02-18', 'R-1676747764', '0.00', '0.00', '0.00'),
(65, 16, '2023-02-18', 'R-1676747918', '0.00', '0.00', '0.00'),
(66, 17, '2023-02-18', 'R-1676748065', '0.00', '0.00', '0.00'),
(67, 6, '2023-02-18', 'R-1676748138', '0.00', '0.00', '0.00'),
(68, 6, '2023-02-18', 'R-1676748533', '0.00', '0.00', '0.00'),
(69, 15, '2023-02-18', 'R-1676748545', '0.00', '0.00', '0.00'),
(70, 6, '2023-02-18', 'R-1676749092', '0.00', '0.00', '0.00'),
(71, 6, '2023-02-18', 'R-1676749558', '0.00', '0.00', '0.00'),
(72, 6, '2023-02-18', 'R-1676750201', '0.00', '0.00', '0.00'),
(73, 6, '2023-02-18', 'R-1676750256', '0.00', '0.00', '0.00'),
(74, 14, '2023-02-16', 'R-1676750264', '0.00', '0.00', '0.00'),
(75, 6, '2023-02-18', 'R-1676751371', '0.00', '0.00', '0.00'),
(76, 6, '2023-02-18', 'R-1676751626', '0.00', '0.00', '0.00'),
(77, 15, '2023-02-18', 'R-1676751632', '0.00', '0.00', '0.00'),
(78, 14, '2023-02-18', 'R-1676751821', '0.00', '0.00', '0.00'),
(79, 14, '2023-02-18', 'R-1676752253', '0.00', '0.00', '0.00'),
(80, 15, '2023-02-18', 'R-1676752262', '0.00', '0.00', '0.00'),
(81, 15, '2023-02-18', 'R-1676752359', '0.00', '0.00', '0.00'),
(82, 14, '2023-02-18', 'R-1676752368', '0.00', '0.00', '0.00'),
(83, 14, '2023-02-18', 'R-1676752403', '0.00', '0.00', '0.00'),
(86, 15, '2023-02-18', 'R-1676752490', '0.00', '0.00', '0.00'),
(87, 16, '2023-02-18', 'R-1676752750', '0.00', '0.00', '0.00'),
(88, 16, '2023-02-18', 'R-1676752829', '0.00', '0.00', '0.00'),
(89, 16, '2023-02-18', 'R-1676752838', '0.00', '0.00', '0.00'),
(90, 16, '2023-02-18', 'R-1676752875', '0.00', '0.00', '0.00'),
(91, 16, '2023-02-18', 'R-1676752882', '0.00', '0.00', '0.00'),
(92, 16, '2023-02-18', 'R-1676752923', '0.00', '0.00', '0.00'),
(93, 17, '2023-02-18', 'R-1676753162', '0.00', '0.00', '0.00'),
(94, 17, '2023-02-18', 'R-1676753310', '0.00', '0.00', '0.00'),
(95, 16, '2023-02-18', 'R-1676753317', '0.00', '0.00', '0.00'),
(96, 16, '2023-02-18', 'R-1676753951', '0.00', '0.00', '0.00'),
(97, 15, '2023-02-18', 'R-1676754735', '0.00', '0.00', '0.00'),
(98, 16, '2023-02-18', 'R-1676754928', '0.00', '0.00', '0.00'),
(99, 16, '2023-02-18', 'R-1676755247', '0.00', '0.00', '0.00'),
(100, 16, '2023-02-18', 'R-1676755628', '0.00', '0.00', '0.00'),
(101, 16, '2023-02-18', 'R-1676755723', '0.00', '0.00', '0.00'),
(102, 17, '2023-02-18', 'R-1676755942', '0.00', '0.00', '0.00'),
(103, 17, '2023-02-18', 'R-1676757589', '0.00', '0.00', '0.00'),
(104, 17, '2023-02-18', 'R-1676758672', '0.00', '0.00', '0.00'),
(105, 17, '2023-02-18', 'R-1676758808', '0.00', '0.00', '0.00'),
(106, 17, '2023-02-18', 'R-1676759402', '0.00', '0.00', '0.00'),
(107, 17, '2023-02-18', 'R-1676759553', '0.00', '0.00', '0.00'),
(108, 17, '2023-02-18', 'R-1676759560', '0.00', '0.00', '0.00'),
(109, 17, '2023-02-18', 'R-1676760357', '0.00', '0.00', '0.00'),
(110, 16, '2023-02-18', 'R-1676760372', '0.00', '0.00', '0.00'),
(111, 16, '2023-02-19', 'R-1676762149', '0.00', '0.00', '0.00'),
(112, 15, '2023-02-19', 'R-1676763208', '0.00', '0.00', '0.00'),
(113, 17, '2023-02-19', 'R-1676763257', '0.00', '0.00', '0.00'),
(114, 16, '2023-02-19', 'R-1676763499', '0.00', '0.00', '0.00'),
(115, 16, '2023-02-19', 'R-1676763769', '0.00', '0.00', '0.00'),
(116, 16, '2023-02-19', 'R-1676764023', '0.00', '0.00', '0.00'),
(117, 16, '2023-02-19', 'R-1676764359', '0.00', '0.00', '0.00'),
(118, 16, '2023-02-19', 'R-1676764359', '0.00', '0.00', '0.00'),
(119, 15, '2023-02-19', 'R-1676765800', '0.00', '0.00', '0.00'),
(120, 16, '2023-02-19', 'R-1676766316', '0.00', '0.00', '0.00'),
(121, 15, '2023-02-19', 'R-1676766554', '0.00', '0.00', '0.00'),
(122, 16, '2023-02-19', 'R-1676768182', '0.00', '0.00', '0.00'),
(123, 15, '2023-02-19', 'R-1676793898', '0.00', '0.00', '0.00'),
(124, 16, '2023-02-19', 'R-1676794627', '0.00', '0.00', '0.00'),
(125, 16, '2023-02-19', 'R-1676794985', '0.00', '0.00', '0.00'),
(126, 16, '2023-02-19', 'R-1676794995', '0.00', '0.00', '0.00'),
(127, 16, '2023-02-19', 'R-1676795114', '0.00', '0.00', '0.00'),
(129, 16, '2023-02-19', 'R-1676795291', '0.00', '0.00', '0.00'),
(130, 16, '2023-02-19', 'R-1676795427', '0.00', '0.00', '0.00'),
(131, 16, '2023-02-19', 'R-1676795727', '0.00', '0.00', '0.00'),
(132, 16, '2023-02-19', 'R-1676795728', '0.00', '0.00', '0.00'),
(133, 15, '2023-02-19', 'R-1676795802', '0.00', '0.00', '0.00'),
(134, 15, '2023-02-19', 'R-1676795949', '0.00', '0.00', '0.00'),
(135, 15, '2023-02-19', 'R-1676796034', '0.00', '0.00', '0.00'),
(136, 17, '2023-02-19', 'R-1676796044', '0.00', '0.00', '0.00'),
(137, 17, '2023-02-19', 'R-1676796155', '0.00', '0.00', '0.00'),
(138, 17, '2023-02-19', 'R-1676796165', '0.00', '0.00', '0.00'),
(139, 17, '2023-02-19', 'R-1676796229', '0.00', '0.00', '0.00'),
(140, 16, '2023-02-19', 'R-1676796242', '0.00', '0.00', '0.00'),
(141, 17, '2023-02-19', 'R-1676798261', '0.00', '0.00', '0.00'),
(142, 15, '2023-02-19', 'R-1676798304', '0.00', '0.00', '0.00'),
(143, 15, '2023-02-19', 'R-1676800535', '0.00', '0.00', '0.00'),
(144, 17, '2023-02-19', 'R-1676800762', '0.00', '0.00', '0.00'),
(145, 17, '2023-02-19', 'R-1676801917', '0.00', '0.00', '0.00'),
(146, 17, '2023-02-19', 'R-1676802167', '0.00', '0.00', '0.00'),
(147, 16, '2023-02-19', 'R-1676802266', '0.00', '0.00', '0.00'),
(148, 17, '2023-02-19', 'R-1676802322', '0.00', '0.00', '0.00'),
(149, 17, '2023-02-19', 'R-1676802443', '0.00', '0.00', '0.00'),
(150, 17, '2023-02-19', 'R-1676804853', '0.00', '0.00', '0.00'),
(151, 17, '2023-02-19', 'R-1676805399', '0.00', '0.00', '0.00'),
(152, 17, '2023-02-19', 'R-1676805565', '0.00', '0.00', '0.00'),
(153, 6, '2023-02-19', 'R-1676813725', '0.00', '0.00', '0.00'),
(154, 16, '2023-02-19', 'R-1676815618', '0.00', '0.00', '0.00'),
(155, 16, '2023-02-19', 'R-1676828093', '0.00', '0.00', '0.00'),
(156, 16, '2023-02-19', 'R-1676830975', '0.00', '0.00', '0.00'),
(157, 16, '2023-02-19', 'R-1676831094', '16.00', '2.72', '13.28'),
(158, 17, '2023-02-19', 'R-1676831415', '9.00', '1.53', '7.47'),
(159, 14, '2023-02-19', 'R-1676835587', '726.00', '123.42', '602.58'),
(160, 15, '2023-02-19', 'R-1676836946', '1089.00', '185.13', '903.87'),
(161, 17, '2023-02-19', 'R-1676837065', '4433.00', '753.61', '3679.39'),
(162, 16, '2023-02-19', 'R-1676838514', '12015.00', '2042.55', '9972.45'),
(163, 15, '2023-02-19', 'R-1676839238', '2.00', '0.34', '1.66'),
(164, 16, '2023-02-19', 'R-1676839503', '4.00', '0.68', '3.32'),
(166, 16, '2023-02-19', 'R-1676840126', '36.00', '6.12', '29.88'),
(168, 6, '2023-02-19', 'R-1676840819', '1620000.00', '275400.00', '1344600.00'),
(169, 6, '2023-02-19', 'R-1676840977', '16.00', '2.72', '13.28'),
(170, 6, '2023-02-19', 'R-1676841051', '9.00', '1.53', '7.47'),
(172, 6, '2023-02-19', 'R-1676842414', '1.00', '0.17', '0.83'),
(173, 15, '2023-02-19', 'R-1676842814', '1.00', '0.17', '0.83'),
(176, 16, '2023-02-19', 'R-1676843131', '4.00', '0.68', '3.32'),
(179, 16, '2023-02-20', 'R-1676856846', '8.00', '1.36', '6.64'),
(180, 15, '2023-02-20', 'R-1676874177', '460545.00', '78292.65', '382252.35');

-- --------------------------------------------------------

--
-- Table structure for table `racunstavka`
--

CREATE TABLE `racunstavka` (
  `stavka_id` int(11) NOT NULL,
  `racun_id` int(11) NOT NULL,
  `artikl_id` int(11) NOT NULL,
  `kolicina` decimal(18,2) NOT NULL,
  `cijena` decimal(18,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `racunstavka`
--

INSERT INTO `racunstavka` (`stavka_id`, `racun_id`, `artikl_id`, `kolicina`, `cijena`) VALUES
(1, 1, 1, '3.00', '3.00'),
(2, 1, 5, '1.00', '2.00'),
(3, 1, 1, '6.00', '3.00'),
(4, 1, 1, '6.00', '3.00'),
(5, 1, 1, '2.00', '3.00'),
(6, 1, 1, '2.00', '3.00'),
(7, 1, 1, '2.00', '3.00'),
(8, 1, 1, '5.00', '234.00'),
(9, 1, 1, '5.00', '234.00'),
(10, 1, 1, '1.00', '1.00'),
(11, 1, 1, '1.00', '10.00'),
(12, 1, 1, '1.00', '10.00'),
(13, 1, 1, '2.00', '20.00'),
(14, 1, 1, '3.00', '3.00'),
(15, 1, 1, '3.00', '300.00'),
(16, 1, 1, '2.00', '3.00'),
(17, 1, 1, '2.00', '5.00'),
(21, 6, 1, '100.00', '2.00'),
(22, 1, 1, '233.00', '233.00'),
(48, 120, 1, '1.00', '1.00'),
(49, 120, 9, '1.00', '1.00'),
(50, 121, 1, '34.00', '43.00'),
(51, 121, 1, '34.00', '355.00'),
(52, 121, 1, '34.00', '355.00'),
(53, 122, 1, '1.00', '2.00'),
(54, 123, 1, '347.00', '8.00'),
(55, 123, 1, '3.00', '3.00'),
(56, 123, 1, '3.00', '3.00'),
(57, 140, 1, '55.00', '55.00'),
(58, 141, 1, '33.00', '44.00'),
(59, 142, 1, '55.00', '999.00'),
(60, 143, 8, '10.00', '10.00'),
(61, 144, 8, '50.00', '50.00'),
(62, 145, 1, '44.00', '44.00'),
(63, 145, 1, '5.00', '5.00'),
(64, 145, 1, '55.00', '89.00'),
(65, 149, 1, '66.00', '66.00'),
(66, 149, 9, '1.00', '1.00'),
(67, 149, 1, '56.00', '90.00'),
(68, 150, 1, '22.00', '22.00'),
(69, 150, 1, '33.00', '33.00'),
(70, 151, 1, '33.00', '44.00'),
(71, 151, 1, '66.00', '77.00'),
(72, 151, 1, '55.55', '59.00'),
(73, 152, 1, '44.44', '44.44'),
(74, 152, 1, '11.11', '77.77'),
(75, 152, 1, '11.11', '77.77'),
(76, 153, 1, '4.00', '4.00'),
(77, 154, 1, '356.00', '444.00'),
(78, 154, 5, '455.00', '777.00'),
(79, 154, 9, '44.00', '3.00'),
(80, 154, 8, '555.00', '4.22'),
(81, 155, 8, '776.00', '776.00'),
(82, 156, 9, '43.00', '10000.00'),
(83, 157, 8, '4.00', '4.00'),
(84, 158, 5, '3.00', '3.00'),
(85, 159, 1, '22.00', '33.00'),
(86, 160, 5, '33.00', '33.00'),
(87, 161, 8, '43.00', '44.00'),
(88, 161, 5, '44.00', '33.00'),
(89, 161, 5, '33.00', '33.00'),
(90, 162, 9, '66.00', '66.00'),
(91, 162, 5, '77.00', '99.00'),
(92, 162, 9, '6.00', '6.00'),
(93, 163, 8, '1.00', '1.00'),
(94, 163, 5, '1.00', '1.00'),
(95, 164, 5, '2.00', '2.00'),
(97, 166, 1, '6.00', '6.00'),
(99, 168, 1, '900.00', '900.00'),
(100, 168, 1, '900.00', '900.00'),
(101, 169, 1, '4.00', '4.00'),
(102, 170, 5, '3.00', '3.00'),
(106, 172, 5, '1.00', '1.00'),
(107, 173, 8, '1.00', '1.00'),
(110, 176, 5, '2.00', '2.00'),
(113, 179, 8, '2.00', '2.00'),
(114, 179, 5, '2.00', '2.00'),
(115, 180, 8, '2.00', '3.00'),
(116, 180, 8, '555.00', '777.00'),
(117, 180, 1, '66.00', '444.00');

-- --------------------------------------------------------

--
-- Table structure for table `radnik`
--

CREATE TABLE `radnik` (
  `radnikID` int(11) NOT NULL,
  `ime` varchar(50) NOT NULL,
  `prezime` varchar(50) NOT NULL,
  `brojTelefona` varchar(50) NOT NULL,
  `adresa` varchar(80) NOT NULL,
  `grad` varchar(40) NOT NULL,
  `email` varchar(50) NOT NULL,
  `jmbg` char(13) NOT NULL,
  `korisnikID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `radnik`
--

INSERT INTO `radnik` (`radnikID`, `ime`, `prezime`, `brojTelefona`, `adresa`, `grad`, `email`, `jmbg`, `korisnikID`) VALUES
(6, 'ddd', 'd', '4444', 'ffff', 'fff', 'a@a', '5555', 21),
(14, 'dd', 'dd', '444', 'ddd', 'dd', '4@f', '444444444', 6),
(15, 'Ime', 'Prezim', '333', 'ddd', 'fff', 'v@v', '3333', 18),
(16, 'User', 'Userić', '987654', 'Ulica Ulica 5', 'New York', 'pas@pas', '222222222222', 24),
(17, 'QQ', 'QQ', '33325544', 'Lica Ulica 9', 'Chicago', 'q@q', '33333333', 21),
(19, 'hu', 'hu', '4444', 'gggg', 'gggg', 'h@h', '44444', 25);

-- --------------------------------------------------------

--
-- Table structure for table `rola`
--

CREATE TABLE `rola` (
  `rolaID` int(11) NOT NULL,
  `nazivRole` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rola`
--

INSERT INTO `rola` (`rolaID`, `nazivRole`) VALUES
(1, 'admin'),
(2, 'radnik');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artikl`
--
ALTER TABLE `artikl`
  ADD PRIMARY KEY (`artikl_id`);

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`korisnikID`),
  ADD KEY `rola_korisnika` (`rolaID`);

--
-- Indexes for table `lager`
--
ALTER TABLE `lager`
  ADD PRIMARY KEY (`lager_id`),
  ADD KEY `artikl-lager` (`artikl_id`);

--
-- Indexes for table `racun`
--
ALTER TABLE `racun`
  ADD PRIMARY KEY (`racun_id`),
  ADD KEY `radnikIzdao - radnik` (`radnikIDizdao`);

--
-- Indexes for table `racunstavka`
--
ALTER TABLE `racunstavka`
  ADD PRIMARY KEY (`stavka_id`),
  ADD KEY `racun-stavka` (`racun_id`),
  ADD KEY `artikl-stavka` (`artikl_id`);

--
-- Indexes for table `radnik`
--
ALTER TABLE `radnik`
  ADD PRIMARY KEY (`radnikID`),
  ADD KEY `radnik_korisnik` (`korisnikID`);

--
-- Indexes for table `rola`
--
ALTER TABLE `rola`
  ADD PRIMARY KEY (`rolaID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `artikl`
--
ALTER TABLE `artikl`
  MODIFY `artikl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `korisnikID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `lager`
--
ALTER TABLE `lager`
  MODIFY `lager_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `racun`
--
ALTER TABLE `racun`
  MODIFY `racun_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=181;

--
-- AUTO_INCREMENT for table `racunstavka`
--
ALTER TABLE `racunstavka`
  MODIFY `stavka_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT for table `radnik`
--
ALTER TABLE `radnik`
  MODIFY `radnikID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `rola`
--
ALTER TABLE `rola`
  MODIFY `rolaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD CONSTRAINT `rola_korisnika` FOREIGN KEY (`rolaID`) REFERENCES `rola` (`rolaID`) ON UPDATE NO ACTION;

--
-- Constraints for table `lager`
--
ALTER TABLE `lager`
  ADD CONSTRAINT `artikl-lager` FOREIGN KEY (`artikl_id`) REFERENCES `artikl` (`artikl_id`);

--
-- Constraints for table `racun`
--
ALTER TABLE `racun`
  ADD CONSTRAINT `radnikIzdao - radnik` FOREIGN KEY (`radnikIDizdao`) REFERENCES `radnik` (`radnikID`);

--
-- Constraints for table `racunstavka`
--
ALTER TABLE `racunstavka`
  ADD CONSTRAINT `artikl-stavka` FOREIGN KEY (`artikl_id`) REFERENCES `artikl` (`artikl_id`),
  ADD CONSTRAINT `racun-stavka` FOREIGN KEY (`racun_id`) REFERENCES `racun` (`racun_id`);

--
-- Constraints for table `radnik`
--
ALTER TABLE `radnik`
  ADD CONSTRAINT `radnik_korisnik` FOREIGN KEY (`korisnikID`) REFERENCES `korisnik` (`korisnikID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;