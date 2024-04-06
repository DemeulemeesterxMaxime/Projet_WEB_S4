-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 21, 2023 at 07:23 PM
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

DROP TABLE IF EXISTS `eleve`;
CREATE TABLE `eleve` (
  `id` int(11) NOT NULL,
  `prenom` varchar(64) DEFAULT NULL,
  `nom` varchar(64) DEFAULT NULL,
  `classe` varchar(64) DEFAULT NULL,
  `email` varchar(64) DEFAULT NULL,
  `password` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `eleve_module`
--

DROP TABLE IF EXISTS `eleve_module`;
CREATE TABLE `eleve_module` (
  `id_eleve` int(11) NOT NULL,
  `id_module` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `eval`
--

DROP TABLE IF EXISTS `eval`;
CREATE TABLE `eval` (
  `id_note` int(11) NOT NULL,
  `Num_eval` int(11) DEFAULT NULL,
  `note` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

DROP TABLE IF EXISTS `module`;
CREATE TABLE `module` (
  `id_module` int(11) NOT NULL,
  `matiere` varchar(64) DEFAULT NULL,
  `moyenne` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `module_eval`
--

DROP TABLE IF EXISTS `module_eval`;
CREATE TABLE `module_eval` (
  `id_module` int(11) NOT NULL,
  `id_note` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `eleve`
--
ALTER TABLE `eleve`
  ADD PRIMARY KEY (`id`),
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
  ADD PRIMARY KEY (`id_note`),
  ADD UNIQUE KEY `Num_eval` (`Num_eval`);

--
-- Indexes for table `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`id_module`);

--
-- Indexes for table `module_eval`
--
ALTER TABLE `module_eval`
  ADD PRIMARY KEY (`id_module`,`id_note`),
  ADD KEY `id_note` (`id_note`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `eleve`
--
ALTER TABLE `eleve`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `eval`
--
ALTER TABLE `eval`
  MODIFY `id_note` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `module`
--
ALTER TABLE `module`
  MODIFY `id_module` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `eleve_module`
--
ALTER TABLE `eleve_module`
  ADD CONSTRAINT `eleve_module_ibfk_1` FOREIGN KEY (`id_eleve`) REFERENCES `eleve` (`id`),
  ADD CONSTRAINT `eleve_module_ibfk_2` FOREIGN KEY (`id_module`) REFERENCES `module` (`id_module`);

--
-- Constraints for table `module_eval`
--
ALTER TABLE `module_eval`
  ADD CONSTRAINT `module_eval_ibfk_1` FOREIGN KEY (`id_module`) REFERENCES `module` (`id_module`),
  ADD CONSTRAINT `module_eval_ibfk_2` FOREIGN KEY (`id_note`) REFERENCES `eval` (`id_note`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
