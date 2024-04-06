-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 12, 2023 at 09:57 AM
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
-- Database: `jreuttus_projet_web`
--
CREATE DATABASE IF NOT EXISTS `jreuttus_projet_web` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `jreuttus_projet_web`;

-- --------------------------------------------------------

--
-- Table structure for table `eleve`
--

CREATE TABLE `eleve` (
  `id_eleve` int(11) NOT NULL,
  `prenom` varchar(64) DEFAULT NULL,
  `nom` varchar(64) DEFAULT NULL,
  `classe` varchar(64) DEFAULT NULL,
  `email` varchar(64) DEFAULT NULL,
  `password` varchar(64) DEFAULT NULL,
  `confirmed` BOOLEAN NOT NULL DEFAULT FALSE,
  `photo_profil` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `eleve`
--

INSERT INTO `eleve` (`id_eleve`, `prenom`, `nom`, `classe`, `email`, `password`) VALUES
(1, 'Maxime', 'demeulemeester', 'CIR1', 'blbalbla@gmail.com', '1234'),
(2, 'Jerem', 'lam', 'CIR1 ', 'test@gmail.com', '1234'),
(3, 'Clement', 'leboss', 'CIR1', 'LaMI@gmail.com', '1234');

--
-- Triggers `eleve`
--
CREATE TRIGGER `add_modules` AFTER INSERT ON `eleve` FOR EACH ROW INSERT INTO eleve_module (id_eleve, id_module)
VALUES (NEW.id_eleve, 1), (NEW.id_eleve, 2), (NEW.id_eleve, 3), (NEW.id_eleve, 4);


-- --------------------------------------------------------

--
-- Table structure for table `eleve_module`
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
(4, '2023-03-10', '2223_ISEN_CIR1_CNB1_S2_MATH3_P1	', 'Partiel de Mathématiques 3	', 3, 1, 4),
(5, '2023-03-10', '2223_ISEN_CIR1_CNB1_S2_MATH3_P1	', 'Partiel de Mathématiques 3	', 3, 100, 4),
(7, '2023-02-11', '2223_ISEN_CIR1_CNB1_S1_MATH2_P2	', '2nde session de Mathématiques 2	', 3, 1, 2),
(17, '2023-01-03', '2223_ISEN_CIR1_CNB1_S1_MATH2_P1	', 'Partiel de Mathématiques 2	', 4.5, 1, 2),
(18, '2023-01-03', '2223_ISEN_CIR1_CNB1_S1_MATH2_P1	', 'Partiel de Mathématiques 2', 4.5, 100, 2),
(20, '2023-03-10', '2223_ISEN_CIR1_CNB1_S2_MATH3_P1	', 'Partiel de Mathématiques 3	', 3, 1, 4),
(21, '2023-03-10', '2223_ISEN_CIR1_CNB1_S2_MATH3_P1	', 'Partiel de Mathématiques 3	', 3, 100, 4),
(22, '2023-01-03', '2223_ISEN_CIR1_CNB1_S1_MATH2_P1	', 'Partiel de Mathématiques 2	', 4.5, 1, 2),
(23, '2023-01-03', '2223_ISEN_CIR1_CNB1_S1_MATH2_P1	', 'Partiel de Mathématiques 2', 4.5, 100, 2);

-- --------------------------------------------------------

--
-- Table structure for table `eval_eleve`
--

CREATE TABLE `eval_eleve` (
  `id_eval` int(11) NOT NULL,
  `id_eleve` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `eval_eleve`
--

INSERT INTO `eval_eleve` (`id_eval`, `id_eleve`) VALUES
(4, 1),
(5, 1),
(7, 1),
(17, 1),
(18, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1);

-- --------------------------------------------------------

--
-- Table structure for table `matiere`
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
  MODIFY `id_eleve` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `eval`
--
ALTER TABLE `eval`
  MODIFY `id_eval` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `matiere`
--
ALTER TABLE `matiere`
  MODIFY `id_matiere` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
