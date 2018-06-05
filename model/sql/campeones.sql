-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 05, 2018 at 01:18 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `esports`
--

-- --------------------------------------------------------

--
-- Table structure for table `campeones`
--

CREATE TABLE `campeones` (
  `champ_id` int(4) NOT NULL,
  `champ_name` varchar(20) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `campeones`
--

INSERT INTO `campeones` (`champ_id`, `champ_name`) VALUES
(1, ' Annie'),
(2, ' Olaf'),
(3, ' Galio'),
(4, ' TwistedFate'),
(5, ' XinZhao'),
(6, ' Urgot'),
(7, ' Leblanc'),
(8, ' Vladimir'),
(9, ' Fiddlesticks'),
(10, ' Kayle'),
(11, ' MasterYi'),
(12, ' Alistar'),
(13, ' Ryze'),
(14, ' Sion'),
(15, ' Sivir'),
(16, ' Soraka'),
(17, ' Teemo'),
(18, ' Tristana'),
(19, ' Warwick'),
(20, ' Nunu'),
(21, ' MissFortune'),
(22, ' Ashe'),
(23, ' Tryndamere'),
(24, ' Jax'),
(25, ' Morgana'),
(26, ' Zilean'),
(27, ' Singed'),
(28, ' Evelynn'),
(29, ' Twitch'),
(30, ' Karthus'),
(31, ' Chogath'),
(32, ' Amumu'),
(33, ' Rammus'),
(34, ' Anivia'),
(35, ' Shaco'),
(36, ' DrMundo'),
(37, ' Sona'),
(38, ' Kassadin'),
(39, ' Irelia'),
(40, ' Janna'),
(41, ' Gangplank'),
(42, ' Corki'),
(43, ' Karma'),
(44, ' Taric'),
(45, ' Veigar'),
(48, ' Trundle'),
(50, ' Swain'),
(51, ' Caitlyn'),
(53, ' Blitzcrank'),
(54, ' Malphite'),
(55, ' Katarina'),
(56, ' Nocturne'),
(57, ' Maokai'),
(58, ' Renekton'),
(59, ' JarvanIV'),
(60, ' Elise'),
(61, ' Orianna'),
(62, ' MonkeyKing'),
(63, ' Brand'),
(64, ' LeeSin'),
(67, ' Vayne'),
(68, ' Rumble'),
(69, ' Cassiopeia'),
(72, ' Skarner'),
(74, ' Heimerdinger'),
(75, ' Nasus'),
(76, ' Nidalee'),
(77, ' Udyr'),
(78, ' Poppy'),
(79, ' Gragas'),
(80, ' Pantheon'),
(81, ' Ezreal'),
(82, ' Mordekaiser'),
(83, ' Yorick'),
(84, ' Akali'),
(85, ' Kennen'),
(86, ' Garen'),
(89, ' Leona'),
(90, ' Malzahar'),
(91, ' Talon'),
(92, ' Riven'),
(96, ' KogMaw'),
(98, ' Shen'),
(99, ' Lux'),
(101, ' Xerath'),
(102, ' Shyvana'),
(103, ' Ahri'),
(104, ' Graves'),
(105, ' Fizz'),
(106, ' Volibear'),
(107, ' Rengar'),
(110, ' Varus'),
(111, ' Nautilus'),
(112, ' Viktor'),
(113, ' Sejuani'),
(114, ' Fiora'),
(115, ' Ziggs'),
(117, ' Lulu'),
(119, ' Draven'),
(120, ' Hecarim'),
(121, ' Khazix'),
(122, ' Darius'),
(126, ' Jayce'),
(127, ' Lissandra'),
(131, ' Diana'),
(133, ' Quinn'),
(134, ' Syndra'),
(136, ' AurelionSol'),
(141, ' Kayn'),
(142, ' Zoe'),
(143, ' Zyra'),
(145, ' Kaisa'),
(150, ' Gnar'),
(154, ' Zac'),
(157, ' Yasuo'),
(161, ' Velkoz'),
(163, ' Taliyah'),
(164, ' Camille'),
(201, ' Braum'),
(202, ' Jhin'),
(203, ' Kindred'),
(222, ' Jinx'),
(223, ' TahmKench'),
(236, ' Lucian'),
(238, ' Zed'),
(240, ' Kled'),
(245, ' Ekko'),
(254, ' Vi'),
(266, ' Aatrox'),
(267, ' Nami'),
(268, ' Azir'),
(412, ' Thresh'),
(420, ' Illaoi'),
(421, ' RekSai'),
(427, ' Ivern'),
(429, ' Kalista'),
(432, ' Bard'),
(497, ' Rakan'),
(498, ' Xayah'),
(516, ' Ornn'),
(555, ' Pyke');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
