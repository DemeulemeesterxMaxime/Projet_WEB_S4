-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 17, 2023 at 02:23 PM
-- Server version: 5.7.24
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jreuttus_projet_web_s4`
--
CREATE DATABASE IF NOT EXISTS `jreuttus_projet_web_s4` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `jreuttus_projet_web_s4`;

-- --------------------------------------------------------

--
-- Table structure for table `eleve`
--
-- Creation: Apr 15, 2023 at 01:42 PM
--

CREATE TABLE `eleve` (
  `id_eleve` int(11) NOT NULL,
  `prenom` varchar(64) DEFAULT NULL,
  `nom` varchar(64) DEFAULT NULL,
  `classe` varchar(64) DEFAULT NULL,
  `email` varchar(64) DEFAULT NULL,
  `password` varchar(64) DEFAULT NULL,
  `confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `photo_profil` TEXT NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `eleve`
--

INSERT INTO `eleve` (`id_eleve`, `prenom`, `nom`, `classe`, `email`, `password`, `confirmed`) VALUES
(1, 'Maxime', 'demeulemeester', 'CIR1', 'blbalbla@gmail.com', '1234', 0),
(2, 'Jerem', 'lam', 'CIR1 ', 'test@gmail.com', '1234', 0),
(3, 'Clement', 'leboss', 'CIR1', 'LaMI@gmail.com', '1234', 0);


-- --------------------------------------------------------

--
-- Table structure for table `eleve_module`
--
-- Creation: Apr 15, 2023 at 01:42 PM
--

CREATE TABLE `eleve_module` (
  `id_eleve` int(11) NOT NULL,
  `id_module` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `eleve_module`
--

INSERT INTO `eleve_module` (`id_eleve`, `id_module`) VALUES
(1, 1),
(2, 1),
(3, 1),
(1, 2),
(2, 2),
(3, 2),
(1, 3),
(2, 3),
(3, 3),
(1, 4),
(2, 4),
(3, 4);

-- --------------------------------------------------------

--
-- Table structure for table `eval`
--
-- Creation: Apr 15, 2023 at 01:42 PM
--

CREATE TABLE `eval` (
  `id_eval` int(11) NOT NULL,
  `date_eval` date DEFAULT NULL,
  `code` varchar(64) DEFAULT NULL,
  `epreuve` varchar(64) DEFAULT NULL,
  `note` float DEFAULT NULL,
  `coef_eval` float DEFAULT NULL,
  `id_matiere` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `eval`
--

INSERT INTO `eval` (`id_eval`, `date_eval`, `code`, `epreuve`, `note`, `coef_eval`, `id_matiere`) VALUES
(5, '2023-03-10', '2223_ISEN_CIR1_CNB1_S2_MATH3_P1	', 'Partiel de Mathématiques 3	', 3, 100, 4),
(7, '2023-02-11', '2223_ISEN_CIR1_CNB1_S1_MATH2_P2	', '2nde session de Mathématiques 2	', 3, 1, 2),
(18, '2023-01-03', '2223_ISEN_CIR1_CNB1_S1_MATH2_P1	', 'Partiel de Mathématiques 2', 4.5, 100, 2),
(26, '2022-10-18', '2223_ISEN_CIR1_S1_MATH_TP3_2	', 'Evaluation du TP3	', 18.5, 1, 3),
(28, '2022-10-14', '2223_ISEN_CIR1_CNB1_S1_MATH1_P1	', 'Partiel de Mathématiques 1	', 4.1, 100, 1),
(30, '2022-10-07', '2223_ISEN_CIR1_CNB1_S1_OPTIQUE_P1	', 'Partiel d\' Optique géométrique	', 3.5, 100, 7),
(31, '2022-10-04', '2223_ISEN_CIR1_S1_COMM_ORAL	', 'Exposé or al	', 14, 1, 21),
(32, '2022-09-30', '2223_ISEN_CIR1_CNB1_S1_MATH1_CC2	', 'Contrôle Continu de Mathématiques n °2	', 6, 1, 1),
(33, '2022-09-30', '2223_ISEN_CIR1_S1_WEB_CC	', 'Contrôle Continu de T echnologies Web	', 13.5, 1, 14),
(35, '2022-09-23', '2223_ISEN_CIR1_CNB1_S1_OPTIQUE_CC	', 'Contrôle Continu d\' Optique Géométrique	', 5, 100, 7),
(36, '2022-09-23', '2223_ISEN_CIR1_S1_PROG1_CC1	', 'Contrôle Continu Prog1 n °1	', 15.59, 1, 12),
(37, '2022-09-16', '2223_ISEN_CIR1_CNB1_S1_MATH1_CC1	', 'Contrôle Continu de Mathématiques n °1	', 9.1, 1, 1),
(53, '2022-12-09', '2223_ISEN_CIR1_CNB1_S1_MATH2_CC3	', 'Contrôle Continu de Mathématiques n °3	', 13.5, 1, 2),
(54, '2022-12-06', '2223_ISEN_CIR1_CNB1_S1_ANGLAIS_1_NOTE	', 'Moyenne d\' Anglais (groupe 1)	', 13, 30, 20),
(55, '2022-12-06', '2223_ISEN_CIR1_CNB1_S1_ANGLAIS_GLOBAL_EXAM	', 'Global Exam S1	', 17, 20, 20),
(56, '2022-12-06', '2223_ISEN_CIR1_CNB1_S1_ANGLAIS_TOEIC	', 'Mock T OEIC listening	', 12.2, 50, 20),
(57, '2022-12-06', '2223_ISEN_CIR1_S1_ELEC_TP4_2	', 'Evaluation du TP4	', 16, 1, 9),
(58, '2022-12-06', '2223_ISEN_CIR1_S1_WEB_PROJ	', 'Projet de T echnologies W eb	', 19.5, 100, 14),
(60, '2022-12-02', '2223_ISEN_CIR1_CNB1_S1_ELEC_DS	', 'DS d\'Électronique	', 14.5, 100, 8),
(61, '2022-11-29', '2223_ISEN_CIR1_S1_INFO_PRAT_TP_C_Q2	', 'Tra vaux pr atiques de C	', 19.7, 1, 13),
(62, '2022-11-29', '2223_ISEN_CIR1_S1_MATH_TP5_2	', 'Evaluation du TP5	', 15, 1, 3),
(63, '2022-11-25', '2223_ISEN_CIR1_CNB1_S1_MATH2_CC2	', 'Contrôle Continu de Mathématiques n °2	', 8.3, 1, 2),
(64, '2022-11-25', '2223_ISEN_CIR1_S1_PROG1_CC2	', 'Contrôle Continu Prog1 n °2	', 8.4, 1, 12),
(65, '2022-11-22', '2223_ISEN_CIR1_S1_ELEC_TP3_2	', 'Evaluation du TP3	', 18, 1, 9),
(66, '2022-11-19', '2223_ISEN_CIR1_CNB1_S1_MATH1_P2	', '2nde session de Mathématiques 1	', 5.5, 1, 1),
(67, '2022-11-19', '2223_ISEN_CIR1_CNB1_S1_OPTIQUE_P2	', '2nde session d\' Optique géométrique	', 8, 1, 7),
(68, '2022-11-18', '2223_ISEN_CIR1_S1_WEB_DS	', 'DS de T echnologies W eb	', 19.06, 1, 14),
(69, '2022-11-10', '2223_ISEN_CIR1_CNB1_S1_ELEC_CC	', 'Contrôle Continu d\'Électronique	', 16, 1, 8),
(70, '2022-11-10', '2223_ISEN_CIR1_CNB1_S1_MATH2_CC1	', 'Contrôle Continu de Mathématiques n °1	', 7.6, 1, 2),
(71, '2022-11-08', '2223_ISEN_CIR1_S1_ELEC_TP2_2	', 'Evaluation du TP2', 16.5, 1, 9),
(72, '2022-10-21', '2223_ISEN_CIR1_S1_PROG1_DS	', 'DS de Progr ammation	', 13, 20, 12),
(113, '2023-04-03', '2223_ISEN_CIR1_CNB1_S2_ANGLAIS_TOEIC_1	', 'Mock T OEIC Reading ( Group 1)	', 8.4, 50, 23),
(114, '2023-03-27', '2223_ISEN_CIR1_S2_EPISTEMO_ORAL	', 'Communication or ale	', 15, 1, 24),
(117, '2023-03-03', '2223_ISEN_CIR1_S2_PROG2_DS	', 'DS de Progr ammation 2	', 11.5, 100, 15),
(119, '2023-02-10', '2223_ISEN_CIR1_CNB1_S2_MATH3_CC2	', 'Contrôle Continu de Mathématiques n °2	', 2, 1, 4),
(120, '2023-02-10', '2223_ISEN_CIR1_CNB1_S2_MECA_INT2	', 'Contrôle Continu de Mécanique n °2	', 1, 1, 10),
(121, '2023-02-03', '2223_ISEN_CIR1_S2_INFO_WEB_CC	', 'Contrôle Continu de T echnologies Web	', 18.13, 100, 17),
(122, '2023-02-03', '2223_ISEN_CIR1_S2_PROG2_CC1	', 'Contrôle Continu de Progr ammation 2  n°1	', 13, 50, 15),
(123, '2023-01-31', '2223_ISEN_CIR1_S2_ELEC_TP5_2	', 'Evaluation du TP5	', 19, 1, 9),
(124, '2023-01-27', '2223_ISEN_CIR1_CNB1_S2_MATH3_CC1	', 'Contrôle Continu de Mathématiques n °1	', 5, 1, 4),
(125, '2023-01-27', '2223_ISEN_CIR1_CNB1_S2_MECA_INT1	', 'Contrôle Continu de Mécanique n °1	', 4, 1, 10),
(126, '2023-01-06', '2223_ISEN_CIR1_S1_COMM_P1	', 'Partiel de Communication	', 16, 1, 21),
(127, '2023-01-04', '2223_ISEN_CIR1_S1_PROG1_P1	', 'Partiel de Progr ammation	', 16.5, 40, 12),
(130, '2022-12-13', '2223_ISEN_CIR1_S1_MATH_TP6_2	', 'Evaluation du TP6	', 14, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `eval_eleve`
--
-- Creation: Apr 15, 2023 at 01:42 PM
--

CREATE TABLE `eval_eleve` (
  `id_eval` int(11) NOT NULL,
  `id_eleve` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `eval_eleve`
--

INSERT INTO `eval_eleve` (`id_eval`, `id_eleve`) VALUES
(5, 1),
(7, 1),
(18, 1),
(26, 1),
(28, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(35, 1),
(36, 1),
(37, 1),
(53, 1),
(54, 1),
(55, 1),
(56, 1),
(57, 1),
(58, 1),
(60, 1),
(61, 1),
(62, 1),
(63, 1),
(64, 1),
(65, 1),
(66, 1),
(67, 1),
(68, 1),
(69, 1),
(70, 1),
(71, 1),
(72, 1),
(113, 1),
(114, 1),
(117, 1),
(119, 1),
(120, 1),
(121, 1),
(122, 1),
(123, 1),
(124, 1),
(125, 1),
(126, 1),
(127, 1),
(130, 1);

-- --------------------------------------------------------

--
-- Table structure for table `matiere`
--
-- Creation: Apr 15, 2023 at 01:42 PM
--

CREATE TABLE `matiere` (
  `id_matiere` int(11) NOT NULL,
  `matiere` varchar(64) DEFAULT NULL,
  `moyenne` float DEFAULT NULL,
  `id_module` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `matiere`
--

INSERT INTO `matiere` (`id_matiere`, `matiere`, `moyenne`, `id_module`) VALUES
(1, 'Fondamentaux', NULL, 1),
(2, 'Analyse', NULL, 1),
(3, 'TP Maths', NULL, 1),
(4, 'Algèbre linéaire', NULL, 1),
(5, 'Arithmétique', NULL, 1),
(6, 'TP Maths', NULL, 1),
(7, 'Optique', NULL, 2),
(8, 'Electronique', NULL, 2),
(9, 'TP Electronique', NULL, 2),
(10, 'Mécanique de point', NULL, 2),
(11, 'Thermodynamique', NULL, 2),
(12, 'Fondamentaux', NULL, 3),
(13, 'TP Programmation', NULL, 3),
(14, 'Technologies Web', NULL, 3),
(15, 'Approfondissement', NULL, 3),
(16, 'TP Programmation', NULL, 3),
(17, 'Technologies Web', NULL, 3),
(18, 'Informatique Embarquée', NULL, 3),
(19, 'Projet de fin d\'année', NULL, 3),
(20, 'Anglais', NULL, 4),
(21, 'Compétences Relationnelles', NULL, 4),
(22, 'Sport', NULL, 4),
(23, 'Anglais', NULL, 4),
(24, 'Epistémologie', NULL, 4),
(25, 'Sport', NULL, 4),
(26, 'Voltaire', NULL, 4);

-- --------------------------------------------------------

--
-- Table structure for table `module`
--
-- Creation: Apr 15, 2023 at 01:42 PM
--

CREATE TABLE `module` (
  `id_module` int(11) NOT NULL,
  `matiere` varchar(64) DEFAULT NULL,
  `moyenne` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`id_module`, `matiere`, `moyenne`) VALUES
(1, 'Mathématique', NULL),
(2, 'Physique', NULL),
(3, 'Informatique', NULL),
(4, 'Management et Développement Personnel', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `eleve`
--
ALTER TABLE `eleve`
  ADD PRIMARY KEY (`id_eleve`),
  ADD UNIQUE KEY `id_eleve_UNIQUE` (`id_eleve`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `eleve_module`
--
ALTER TABLE `eleve_module`
  ADD PRIMARY KEY (`id_eleve`,`id_module`),
  ADD KEY `id_module` (`id_module`);

--
-- Indexes for table `eval`
--
ALTER TABLE `eval`
  ADD PRIMARY KEY (`id_eval`),
  ADD UNIQUE KEY `if_eval` (`id_eval`),
  ADD KEY `id_matiere` (`id_matiere`);

--
-- Indexes for table `eval_eleve`
--
ALTER TABLE `eval_eleve`
  ADD PRIMARY KEY (`id_eval`,`id_eleve`),
  ADD KEY `id_eleve` (`id_eleve`);

--
-- Indexes for table `matiere`
--
ALTER TABLE `matiere`
  ADD PRIMARY KEY (`id_matiere`),
  ADD KEY `id_module` (`id_module`);

--
-- Indexes for table `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`id_module`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `eleve`
--
ALTER TABLE `eleve`
  MODIFY `id_eleve` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `eval`
--
ALTER TABLE `eval`
  MODIFY `id_eval` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT for table `matiere`
--
ALTER TABLE `matiere`
  MODIFY `id_matiere` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `module`
--
ALTER TABLE `module`
  MODIFY `id_module` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `eleve_module`
--
ALTER TABLE `eleve_module`
  ADD CONSTRAINT `fk_eleve_module_eleve` FOREIGN KEY (`id_eleve`) REFERENCES `eleve` (`id_eleve`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_eleve_module_module` FOREIGN KEY (`id_module`) REFERENCES `module` (`id_module`);

--
-- Constraints for table `eval`
--
ALTER TABLE `eval`
  ADD CONSTRAINT `eval_ibfk_1` FOREIGN KEY (`id_matiere`) REFERENCES `matiere` (`id_matiere`) ON DELETE CASCADE;

--
-- Constraints for table `eval_eleve`
--
ALTER TABLE `eval_eleve`
  ADD CONSTRAINT `eval_eleve_ibfk_1` FOREIGN KEY (`id_eval`) REFERENCES `eval` (`id_eval`) ON DELETE CASCADE,
  ADD CONSTRAINT `eval_eleve_ibfk_2` FOREIGN KEY (`id_eleve`) REFERENCES `eleve` (`id_eleve`) ON DELETE CASCADE;

--
-- Constraints for table `matiere`
--
ALTER TABLE `matiere`
  ADD CONSTRAINT `matiere_ibfk_1` FOREIGN KEY (`id_module`) REFERENCES `module` (`id_module`);

--
-- Triggers `eleve`
--
DELIMITER $$
CREATE TRIGGER `add_modules` AFTER INSERT ON `eleve` FOR EACH ROW INSERT INTO eleve_module (id_eleve, id_module)
VALUES (NEW.id_eleve, 1), (NEW.id_eleve, 2), (NEW.id_eleve, 3), (NEW.id_eleve, 4);
$$
DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
