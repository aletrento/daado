-- phpMyAdmin SQL Dump
-- version 4.1.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 14, 2015 alle 15:05
-- Versione del server: 5.1.71-community-log
-- PHP Version: 5.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `my_daado`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `eventi`
--

CREATE TABLE IF NOT EXISTS `eventi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `utente` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `giorno` int(11) NOT NULL,
  `mese` int(11) NOT NULL,
  `anno` int(11) NOT NULL,
  `ora_ini` int(11) NOT NULL,
  `min_ini` int(11) NOT NULL,
  `ora_fine` int(11) NOT NULL,
  `min_fine` int(11) NOT NULL,
  `forfait` int(11) NOT NULL,
  `descrizione` varchar(65) COLLATE utf8_unicode_ci NOT NULL,
  `categoria` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `tipo` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `tag` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=122 ;

--
-- Dump dei dati per la tabella `eventi`
--

INSERT INTO `eventi` (`id`, `utente`, `giorno`, `mese`, `anno`, `ora_ini`, `min_ini`, `ora_fine`, `min_fine`, `forfait`, `descrizione`, `categoria`, `tipo`, `tag`) VALUES
(27, 'vallin', 2, 9, 2015, 10, 20, 12, 0, 0, 'corso di recupero carenze classi 4AFM (1/3)', '70', 'f', 7),
(26, 'vallin', 17, 9, 2015, 14, 20, 16, 0, 0, 'corso di recupero carenze classi 2AFM (3/3)', '70', 'f', 7),
(25, 'vallin', 4, 9, 2015, 8, 20, 10, 0, 0, 'corso di recupero carenze classi 2AFM (2/3)', '70', 'f', 7),
(23, 'vallin', 1, 9, 2015, 10, 0, 12, 0, 0, '1^ Collegio docenti', '80', 'nf', 1),
(24, 'vallin', 2, 9, 2015, 8, 20, 10, 0, 0, 'corso di recupero carenze classi 2AFM (1/3)', '70', 'f', 7),
(28, 'vallin', 4, 9, 2015, 10, 20, 12, 0, 0, 'corso di recupero carenze classi 4AFM (2/3)', '70', 'f', 7),
(29, 'vallin', 24, 9, 2015, 14, 20, 16, 0, 0, 'corso di recupero carenze classi 4AFM (3/3)', '70', 'f', 7),
(30, 'vallin', 1, 9, 2015, 12, 0, 12, 30, 0, '1^ Consiglio di classe (straordinario) 5a AFM', '80', 'nf', 2),
(31, 'vallin', 8, 9, 2015, 12, 0, 12, 30, 0, '2^ Consiglio di classe 5a AFM (scrutinio studentessa)', '80', 'nf', 2),
(32, 'clara', 1, 9, 2015, 9, 30, 11, 30, 0, 'Collegio docenti', '80', 'nf', 1),
(33, 'clara', 4, 9, 2015, 10, 0, 12, 0, 0, 'corso di aggiornamento- distrofia Duchenne', '40', 'nf', 6),
(34, 'clara', 4, 9, 2015, 14, 30, 16, 0, 0, 'corso di aggiornamento-mastercom', 'dubbie', 'nf', 6),
(37, 'forgionep', 8, 9, 2015, 9, 0, 11, 50, 0, 'Esami integrativi', '70', 'f', 7),
(38, 'vallin', 10, 9, 2015, 14, 30, 16, 40, 0, '1^ riunione di dipartimento lingue', '80', 'nf', 3),
(39, 'farruggiafra', 10, 9, 2015, 17, 0, 18, 30, 0, 'riunione area tecnica', 'dubbie', 'nf', 12),
(40, 'farruggiafra', 1, 9, 2015, 9, 0, 10, 30, 0, 'riunione con la Dirigente presentazione istituto', '80', 'nf', 12),
(41, 'farruggiafra', 1, 9, 2015, 15, 30, 18, 0, 0, 'Collegio docenti ', '80', 'nf', 1),
(42, 'farruggiafra', 7, 9, 2015, 10, 30, 12, 30, 0, 'riunione di dipartimento', '80', 'nf', 3),
(43, 'farruggiafra', 7, 9, 2015, 15, 0, 16, 0, 0, 'docenti classi prime e seconde con la Dirigente', '70', 'nf', 12),
(44, 'vallin', 15, 9, 2015, 14, 30, 16, 0, 0, 'programmazione classi AFM con La Grutta', '70', 'nf', 11),
(45, 'vallin', 11, 9, 2015, 11, 25, 12, 15, 0, 'sostituzione di collega assente 5A AFM', '40', 'f', 4),
(46, 'lisaborsato', 9, 9, 2015, 15, 0, 17, 0, 0, 'riunione di dipartimento', 'dubbie', 'nf', 3),
(47, 'lisaborsato', 4, 9, 2015, 10, 0, 11, 30, 0, 'corso di aggiornamento', 'dubbie', 'nf', 6),
(48, 'lisaborsato', 14, 9, 2015, 7, 55, 8, 45, 0, 'sostituzione di collega assente', 'dubbie', 'f', 4),
(49, 'vallin', 22, 9, 2015, 15, 0, 17, 15, 0, '2^ Collegio docenti', '80', 'nf', 1),
(50, 'vallin', 1, 10, 2015, 14, 30, 16, 10, 0, 'prova scritta per saldo carenza formativa', '70', 'f', 7),
(51, 'vallin', 0, 0, 0, 0, 0, 0, 0, 5, 'verbalista classe 5A AFM', 'fondo', 'nf', 15),
(52, 'iperoni', 2, 9, 2015, 8, 20, 10, 0, 0, 'corso di recupero carenze formative', '70', 'f', 7),
(53, 'paolocarli', 1, 9, 2015, 17, 0, 19, 30, 0, 'coill doc', 'dubbie', 'nf', 1),
(54, 'paolocarli', 3, 9, 2015, 16, 0, 18, 30, 0, 'dip', 'dubbie', 'nf', 3),
(55, 'paolocarli', 8, 9, 2015, 10, 0, 12, 0, 0, 'riunione nuovi', 'dubbie', 'nf', 14),
(56, 'paolocarli', 8, 9, 2015, 16, 0, 18, 30, 0, 'dip', 'dubbie', 'nf', 3),
(57, 'paolocarli', 0, 0, 0, 0, 0, 0, 0, 5, 'verbalista 5H', 'dubbie', 'nf', 15),
(58, 'paolocarli', 0, 0, 0, 0, 0, 0, 0, 12, 'sorveglianze intervallo', '70', 'f', 13),
(59, 'vallin', 0, 0, 0, 0, 0, 0, 0, 8, 'inserimento voti in RED', '80', 'nf', 14),
(60, 'vallin', 9, 10, 2015, 14, 15, 16, 5, 0, '1^ Consiglio di classe 3AFM', '80', 'nf', 2),
(61, 'vallin', 9, 10, 2015, 16, 5, 17, 50, 0, '1^ Consiglio di classe 4AFM', '80', 'nf', 2),
(62, 'vallin', 9, 10, 2015, 17, 50, 19, 25, 0, '3^ Consiglio di classe 5AFM', '80', 'nf', 2),
(63, 'vallin', 12, 10, 2015, 14, 15, 15, 15, 0, '2^ Consiglio di classe 3SIA', '80', 'nf', 2),
(64, 'vallin', 6, 10, 2015, 10, 20, 10, 35, 0, '1^ Consiglio di classe (straordinario) 3A SIA', '80', 'nf', 2),
(65, 'danielaceccato', 2, 10, 2015, 14, 30, 16, 30, 0, 'dfsdfa dfsadsadf', '40', 'f', 7),
(67, 'clara', 2, 10, 2015, 14, 20, 16, 0, 0, 'corso di recupero carenze', '70', 'f', 7),
(68, 'clara', 9, 10, 2015, 14, 20, 16, 0, 0, 'corso di recupero carenze', '70', 'f', 7),
(69, 'clara', 0, 0, 0, 0, 0, 0, 0, 15, 'coordinatore di classe', '70', 'nf', 16),
(70, 'vallin', 0, 0, 0, 0, 0, 0, 0, 2, 'referente ambientale 5A AFM', 'dubbie', 'f', 20),
(71, 'vallin', 0, 0, 0, 0, 0, 0, 0, 4, 'aggiornamento - referente ambientale 5A AFM', '40', 'nf', 20),
(72, 'vallin', 0, 0, 0, 0, 0, 0, 0, 2, 'tutor BES in 3A AFM', 'fondo', 'f', 18),
(73, 'vallin', 13, 10, 2015, 16, 0, 17, 0, 0, 'programmazione 5AFM con La Grutta', '70', 'nf', 11),
(74, 'vallin', 21, 10, 2015, 14, 30, 16, 15, 0, 'incontro con referenti alternanza scuola-lavoro', '80', 'nf', 12),
(75, 'vallin', 22, 10, 2015, 14, 15, 16, 30, 0, '2^ riunione di dipartimento (autoconvocato)', '80', 'nf', 3),
(77, 'babinatti', 6, 10, 2015, 14, 30, 16, 0, 0, 'Corso spagnolo 0', '40', 'f', 8),
(78, 'babinatti', 8, 10, 2015, 14, 30, 15, 50, 0, 'Corso spagnolo 0', '40', 'f', 8),
(79, 'babinatti', 13, 10, 2015, 14, 30, 15, 50, 0, 'Corso spagnolo 0', '40', 'f', 8),
(80, 'babinatti', 15, 9, 2015, 14, 0, 15, 30, 0, 'riunione di dipartimento', '80', 'nf', 3),
(81, 'babinatti', 18, 9, 2015, 14, 30, 16, 30, 0, 'Consiglio di classe', '80', 'nf', 2),
(82, 'babinatti', 21, 9, 2015, 14, 30, 16, 30, 0, 'Consiglio di classe', '80', 'nf', 2),
(83, 'babinatti', 22, 9, 2015, 15, 30, 17, 30, 0, 'Consiglio di classe', '80', 'nf', 2),
(84, 'babinatti', 23, 9, 2015, 15, 30, 16, 30, 0, 'Consiglio di classe', '80', 'nf', 2),
(85, 'babinatti', 28, 9, 2015, 14, 30, 17, 30, 0, 'Consiglio di classe', '80', 'nf', 2),
(86, 'babinatti', 30, 9, 2015, 15, 0, 18, 0, 0, 'Collegio docenti', '80', 'nf', 1),
(87, 'lisaborsato', 15, 9, 2015, 9, 35, 10, 25, 0, 'sostituzione di collega assente', 'dubbie', 'f', 4),
(88, 'lisaborsato', 15, 9, 2015, 10, 40, 11, 30, 0, 'sostituzione di collega assente', 'dubbie', 'f', 4),
(89, 'lisaborsato', 16, 9, 2015, 8, 45, 9, 35, 0, 'sostituzione di collega assente', 'dubbie', 'f', 4),
(90, 'lisaborsato', 18, 9, 2015, 16, 0, 18, 0, 0, 'riunione di dipartimento', 'dubbie', 'nf', 3),
(91, 'lisaborsato', 24, 9, 2015, 15, 0, 16, 40, 0, 'incontro studentessa rientrata dall estero', 'dubbie', 'f', 14),
(92, 'lisaborsato', 25, 9, 2015, 7, 55, 8, 45, 0, 'tutoraggio Marta Capraro', 'dubbie', 'f', 14),
(93, 'lisaborsato', 29, 9, 2015, 9, 35, 11, 30, 0, 'tutoraggio Marta Capraro', 'dubbie', 'f', 14),
(94, 'lisaborsato', 30, 9, 2015, 8, 45, 9, 35, 0, 'tutoraggio Marta Capraro', 'dubbie', 'f', 14),
(95, 'lisaborsato', 5, 10, 2015, 7, 55, 9, 35, 0, 'sostituzione Benso', 'dubbie', 'f', 4),
(96, 'lisaborsato', 5, 10, 2015, 16, 0, 18, 0, 0, 'riunione di dipartimento', 'dubbie', 'nf', 3),
(97, 'lisaborsato', 6, 10, 2015, 7, 55, 10, 25, 0, 'campo coni', 'dubbie', 'f', 13),
(98, 'lisaborsato', 16, 10, 2015, 16, 30, 17, 30, 0, 'incontro genitori classe terza', 'dubbie', 'nf', 14),
(99, 'lisaborsato', 19, 10, 2015, 7, 55, 9, 35, 0, 'sostituzione Benso', 'dubbie', 'f', 4),
(100, 'lisaborsato', 20, 10, 2015, 7, 55, 8, 45, 0, 'sostituzione di collega assente', 'dubbie', 'f', 4),
(101, 'lisaborsato', 21, 10, 2015, 12, 20, 13, 10, 0, 'sostituzione di collega assente', 'dubbie', 'f', 4),
(102, 'lisaborsato', 19, 10, 2015, 14, 20, 16, 0, 0, 'corso III', 'dubbie', 'f', 9),
(103, 'lisaborsato', 20, 10, 2015, 16, 0, 17, 40, 0, 'corso III', 'dubbie', 'f', 9),
(104, 'lisaborsato', 21, 10, 2015, 14, 20, 16, 0, 0, 'corso III', 'dubbie', 'f', 9),
(105, 'lisaborsato', 22, 10, 2015, 14, 20, 16, 0, 0, 'corso III', 'dubbie', 'f', 9),
(106, 'vallin', 2, 11, 2015, 14, 0, 15, 40, 0, 'sportello didattico (1/5)', '70', 'f', 8),
(107, 'forgionep', 27, 10, 2015, 11, 25, 12, 30, 0, 'incontro auditorium mart', '70', 'nf', 14),
(108, 'vallin', 19, 11, 2015, 10, 35, 13, 10, 0, 'teatro in inglese con 3A SIA', '70', 'f', 10),
(110, 'vallin', 11, 11, 2015, 15, 0, 16, 45, 0, 'incontro con docenti AFM e SIA (gruppo di lavoro)', '40', 'nf', 12),
(111, 'vallin', 10, 11, 2015, 14, 30, 16, 30, 0, 'corso di aggiornamento su BES - stesura PEP', '40', 'nf', 6),
(118, 'vallin', 17, 11, 2015, 14, 15, 15, 15, 0, '3^ Consiglio di classe 3A SIA', '80', 'nf', 2),
(117, 'vallin', 16, 11, 2015, 14, 30, 16, 30, 0, '3^ Collegio docenti', '80', 'nf', 1),
(119, 'vallin', 20, 11, 2015, 14, 15, 15, 30, 0, '5^ Consiglio di classe 5A AFM', '80', 'nf', 2),
(120, 'vallin', 20, 11, 2015, 15, 30, 16, 45, 0, '3^ Consiglio di classe 3A AFM', '80', 'nf', 2),
(121, 'vallin', 20, 11, 2015, 16, 45, 18, 0, 0, '3^ Consiglio di classe 4A AFM', '80', 'nf', 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
