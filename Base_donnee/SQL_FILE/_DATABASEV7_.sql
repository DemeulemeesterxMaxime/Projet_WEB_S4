-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 20, 2023 at 11:56 PM
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
-- Creation: Apr 20, 2023 at 10:59 PM
-- Last update: Apr 20, 2023 at 11:51 PM
--

DROP TABLE IF EXISTS `eleve`;
CREATE TABLE `eleve` (
  `id_eleve` int(11) NOT NULL,
  `prenom` varchar(64) DEFAULT NULL,
  `nom` varchar(64) DEFAULT NULL,
  `classe` varchar(64) DEFAULT NULL,
  `email` varchar(64) DEFAULT NULL,
  `password` varchar(64) DEFAULT NULL,
  `confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `photo_profil` text NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `eleve` (`id_eleve`, `prenom`, `nom`, `classe`, `email`, `password`, `confirmed`, `photo_profil`) VALUES
(0, 'Admin', 'Admin', NULL, 'admin.admin@student.junia.com', '$2y$10$bsv.AoWqlM7NPfQ4BEBP1O9kUt4gk5xcKbyhm0qD6Ox59bPVLBmxK', 1, '../../public/Images/Images_profile/default_photo.png'),
(1, 'Maxime', 'Demeulemeester', 'CIR1', 'maxime.demeulemeester@student.junia.com', '$2y$10$1uFHZVZCJXCzDKCkMyEbGe34W8W8wkquBt/N/H0tKWfxZcnxPJ4tO', 1, '../../public/Images/Images_profile/default_photo.png'),
(2, 'Clement', 'Tassin', 'CIR1', 'clement.tassin@student.junia.com', '$2y$10$WLkQiXYNj0BHcXj0dHGisuX9tVytXNgpUS.p3Pp/jgQAzw.c3YkzC', 1, '../../public/Images/Images_profile/default_photo.png'),
(3, 'Jeremy', 'Lamour', 'CIR1', 'jeremy.lamour@student.junia.com', '$2y$10$c8.4A7ceRPwQVtV4X9piKOXPm5R7xoUbFu2tl2pbIJRVjqYWbe6F.', 1, '../../public/Images/Images_profile/default_photo.png');

-- --------------------------------------------------------

--
-- Table structure for table `eleve_matiere`
--
-- Creation: Apr 20, 2023 at 11:47 PM
-- Last update: Apr 20, 2023 at 11:50 PM
--

DROP TABLE IF EXISTS `eleve_matiere`;
CREATE TABLE `eleve_matiere` (
  `id_eleve` int(11) NOT NULL,
  `id_matiere` int(11) NOT NULL,
  `moyenne_matiere` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `eleve_module`
--
-- Creation: Apr 20, 2023 at 11:47 PM
-- Last update: Apr 20, 2023 at 11:51 PM
--

DROP TABLE IF EXISTS `eleve_module`;
CREATE TABLE `eleve_module` (
  `id_eleve` int(11) NOT NULL,
  `id_module` int(11) NOT NULL,
  `moyenne_module` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `eval`
--
-- Creation: Apr 20, 2023 at 10:59 PM
-- Last update: Apr 20, 2023 at 11:50 PM
--

DROP TABLE IF EXISTS `eval`;
CREATE TABLE `eval` (
  `id_eval` int(11) NOT NULL,
  `date_eval` date DEFAULT NULL,
  `code` varchar(64) DEFAULT NULL,
  `epreuve` varchar(64) DEFAULT NULL,
  `note` float DEFAULT NULL,
  `coef_eval` float DEFAULT NULL,
  `id_matiere` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `eval_eleve`
--
-- Creation: Apr 20, 2023 at 10:59 PM
-- Last update: Apr 20, 2023 at 11:37 PM
--

DROP TABLE IF EXISTS `eval_eleve`;
CREATE TABLE `eval_eleve` (
  `id_eval` int(11) NOT NULL,
  `id_eleve` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `matiere`
--
-- Creation: Apr 20, 2023 at 10:59 PM
-- Last update: Apr 20, 2023 at 10:59 PM
--

DROP TABLE IF EXISTS `matiere`;
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
-- Creation: Apr 20, 2023 at 10:59 PM
-- Last update: Apr 20, 2023 at 10:59 PM
--

DROP TABLE IF EXISTS `module`;
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
-- Indexes for table `eleve_matiere`
--
ALTER TABLE `eleve_matiere`
  ADD PRIMARY KEY (`id_eleve`,`id_matiere`),
  ADD KEY `fk_eleve_matiere_matiere` (`id_matiere`);

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
  MODIFY `id_eleve` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `eval`
--
ALTER TABLE `eval`
  MODIFY `id_eval` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

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
-- Constraints for table `eleve_matiere`
--
ALTER TABLE `eleve_matiere`
  ADD CONSTRAINT `fk_eleve_matiere_eleve` FOREIGN KEY (`id_eleve`) REFERENCES `eleve` (`id_eleve`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_eleve_matiere_matiere` FOREIGN KEY (`id_matiere`) REFERENCES `matiere` (`id_matiere`) ON DELETE CASCADE;

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

CREATE TRIGGER `add_modules_and_matieres` AFTER INSERT ON `eleve`
FOR EACH ROW
BEGIN
    INSERT INTO eleve_module (id_eleve, id_module)
    VALUES (NEW.id_eleve, 1), (NEW.id_eleve, 2), (NEW.id_eleve, 3), (NEW.id_eleve, 4);

    INSERT INTO Eleve_Matiere (id_eleve, id_matiere)
    SELECT NEW.id_eleve, id_matiere FROM Matiere;
END;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
