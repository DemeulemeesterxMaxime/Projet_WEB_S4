-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : sam. 06 mai 2023 à 12:06
-- Version du serveur : 5.7.24
-- Version de PHP : 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Base de données : `jreuttus_projet_web_s4`
--
CREATE DATABASE IF NOT EXISTS `jreuttus_projet_web_s4` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `jreuttus_projet_web_s4`;

-- --------------------------------------------------------

--
-- Structure de la table `eleve`
--

DROP TABLE IF EXISTS `eleve`;
CREATE TABLE `eleve` (
  `id_eleve` int(11) NOT NULL COMMENT 'Numéro assigné à un élève',
  `prenom` varchar(64) DEFAULT NULL COMMENT 'Prénom de l''élève',
  `nom` varchar(64) DEFAULT NULL COMMENT 'Nom de l''élève',
  `classe` varchar(64) DEFAULT NULL COMMENT 'Classe de l''élève',
  `email` varchar(64) DEFAULT NULL COMMENT 'Adresse email de l''élève',
  `password` varchar(64) DEFAULT NULL COMMENT 'Mot de passe hasher de l''élève ',
  `confirmed` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Etat d''inscription de l''élève',
  `photo_profil` text COMMENT 'Photo de profil de l''élève',
  `moyenne_generale` float DEFAULT NULL COMMENT 'Moyenne générale de l''élève',
  `profil_mode` tinyint(1) DEFAULT '1' COMMENT 'Permet d''afficher ou non le profil de l''utilisateur dans le classement'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `eleve`
--

INSERT INTO `eleve` (`id_eleve`, `prenom`, `nom`, `classe`, `email`, `password`, `confirmed`, `photo_profil`, `moyenne_generale`, `profil_mode`) VALUES
(0, 'admin', 'admin', NULL, 'admin.admin@student.junia.com', '$2y$10$bsv.AoWqlM7NPfQ4BEBP1O9kUt4gk5xcKbyhm0qD6Ox59bPVLBmxK', 1, '../../public/Images/Images_profile/default_photo.png', NULL, 1),
(1, 'maxime', 'demeulemeester', 'CIR1', 'maxime.demeulemeester@student.junia.com', '$2y$10$1uFHZVZCJXCzDKCkMyEbGe34W8W8wkquBt/N/H0tKWfxZcnxPJ4tO', 1, '../../public/Images/Images_profile/default_photo.png', NULL, 1),
(2, 'clement', 'tassin', 'CIR1', 'clement.tassin@student.junia.com', '$2y$10$WLkQiXYNj0BHcXj0dHGisuX9tVytXNgpUS.p3Pp/jgQAzw.c3YkzC', 1, '../../public/Images/Images_profile/default_photo.png', NULL, 1),
(3, 'jeremy', 'lamour', 'CIR1', 'jeremy.lamour@student.junia.com', '$2y$10$c8.4A7ceRPwQVtV4X9piKOXPm5R7xoUbFu2tl2pbIJRVjqYWbe6F.', 1, '../../public/Images/Images_profile/default_photo.png', NULL, 1);


-- --------------------------------------------------------

--
-- Structure de la table `eleve_matiere`
--

DROP TABLE IF EXISTS `eleve_matiere`;
CREATE TABLE `eleve_matiere` (
  `id_eleve` int(11) NOT NULL COMMENT 'Numéro de l''élève',
  `id_matiere` int(11) NOT NULL COMMENT 'Numéro d''une matière',
  `moyenne_matiere` float DEFAULT NULL COMMENT 'Moyenne de l''élève dans la matière'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `eleve_matiere`
--

INSERT INTO `eleve_matiere` (`id_eleve`, `id_matiere`, `moyenne_matiere`) VALUES
(1, 1, NULL),
(1, 2, NULL),
(1, 3, NULL),
(1, 4, NULL),
(1, 5, NULL),
(1, 6, NULL),
(1, 7, NULL),
(1, 8, NULL),
(1, 9, NULL),
(1, 10, NULL),
(1, 11, NULL),
(1, 12, NULL),
(1, 13, NULL),
(1, 14, NULL),
(1, 15, NULL),
(1, 16, NULL),
(1, 17, NULL),
(1, 18, NULL),
(1, 19, NULL),
(1, 20, NULL),
(1, 21, NULL),
(1, 22, NULL),
(1, 23, NULL),
(1, 24, NULL),
(1, 25, NULL),
(1, 26, NULL),
(2, 1, NULL),
(2, 2, NULL),
(2, 3, NULL),
(2, 4, NULL),
(2, 5, NULL),
(2, 6, NULL),
(2, 7, NULL),
(2, 8, NULL),
(2, 9, NULL),
(2, 10, NULL),
(2, 11, NULL),
(2, 12, NULL),
(2, 13, NULL),
(2, 14, NULL),
(2, 15, NULL),
(2, 16, NULL),
(2, 17, NULL),
(2, 18, NULL),
(2, 19, NULL),
(2, 20, NULL),
(2, 21, NULL),
(2, 22, NULL),
(2, 23, NULL),
(2, 24, NULL),
(2, 25, NULL),
(2, 26, NULL),
(3, 1, NULL),
(3, 2, NULL),
(3, 3, NULL),
(3, 4, NULL),
(3, 5, NULL),
(3, 6, NULL),
(3, 7, NULL),
(3, 8, NULL),
(3, 9, NULL),
(3, 10, NULL),
(3, 11, NULL),
(3, 12, NULL),
(3, 13, NULL),
(3, 14, NULL),
(3, 15, NULL),
(3, 16, NULL),
(3, 17, NULL),
(3, 18, NULL),
(3, 19, NULL),
(3, 20, NULL),
(3, 21, NULL),
(3, 22, NULL),
(3, 23, NULL),
(3, 24, NULL),
(3, 25, NULL),
(3, 26, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `eleve_module`
--

DROP TABLE IF EXISTS `eleve_module`;
CREATE TABLE `eleve_module` (
  `id_eleve` int(11) NOT NULL COMMENT 'Numéro de l''élève',
  `id_module` int(11) NOT NULL COMMENT 'Numéro du module',
  `moyenne_module` float DEFAULT NULL COMMENT 'Moyenne de l''élève du Module '
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `eleve_module`
--

INSERT INTO `eleve_module` (`id_eleve`, `id_module`, `moyenne_module`) VALUES
(1, 1, NULL),
(1, 2, NULL),
(1, 3, NULL),
(1, 4, NULL),
(2, 1, NULL),
(2, 2, NULL),
(2, 3, NULL),
(2, 4, NULL),
(3, 1, NULL),
(3, 2, NULL),
(3, 3, NULL),
(3, 4, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `eval`
--

DROP TABLE IF EXISTS `eval`;
CREATE TABLE `eval` (
  `id_eval` int(11) NOT NULL COMMENT 'Numéro de l''évaluation',
  `date_eval` date DEFAULT NULL COMMENT 'Date d''évaluation',
  `code` varchar(64) DEFAULT NULL COMMENT 'Code de l''évaluation',
  `epreuve` varchar(64) DEFAULT NULL COMMENT 'Nom de l''évaluation',
  `note` float DEFAULT NULL COMMENT 'Note de l''évaluation',
  `coef_eval` float DEFAULT NULL COMMENT 'Coef de l''évaluation',
  `id_matiere` int(11) DEFAULT NULL COMMENT 'Numéro de la matière de l''évaluation'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `eval_eleve`
--

DROP TABLE IF EXISTS `eval_eleve`;
CREATE TABLE `eval_eleve` (
  `id_eval` int(11) NOT NULL COMMENT 'Numéro de l''évaluation',
  `id_eleve` int(11) NOT NULL COMMENT 'Numéro de l''élève'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `matiere`
--

DROP TABLE IF EXISTS `matiere`;
CREATE TABLE `matiere` (
  `id_matiere` int(11) NOT NULL COMMENT 'Numéro de la matière',
  `matiere` varchar(64) DEFAULT NULL COMMENT 'Nom de la matière',
  `moyenne` float DEFAULT NULL COMMENT 'Moyenne de classe de la matière',
  `id_module` int(11) DEFAULT NULL COMMENT 'Numéro du module qui correspond à la matière'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `matiere`
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
-- Structure de la table `module`
--

DROP TABLE IF EXISTS `module`;
CREATE TABLE `module` (
  `id_module` int(11) NOT NULL COMMENT 'Numéro du module',
  `matiere` varchar(64) DEFAULT NULL COMMENT 'Nom du module',
  `moyenne` float DEFAULT NULL COMMENT 'Moyenne de classe du module'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `module`
--

INSERT INTO `module` (`id_module`, `matiere`, `moyenne`) VALUES
(1, 'Mathématique', NULL),
(2, 'Physique', NULL),
(3, 'Informatique', NULL),
(4, 'Management et Développement Personnel', NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `eleve`
--
ALTER TABLE `eleve`
  ADD PRIMARY KEY (`id_eleve`),
  ADD UNIQUE KEY `id_eleve_UNIQUE` (`id_eleve`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Index pour la table `eleve_matiere`
--
ALTER TABLE `eleve_matiere`
  ADD PRIMARY KEY (`id_eleve`,`id_matiere`),
  ADD KEY `fk_eleve_matiere_matiere` (`id_matiere`);

--
-- Index pour la table `eleve_module`
--
ALTER TABLE `eleve_module`
  ADD PRIMARY KEY (`id_eleve`,`id_module`),
  ADD KEY `id_module` (`id_module`);

--
-- Index pour la table `eval`
--
ALTER TABLE `eval`
  ADD PRIMARY KEY (`id_eval`),
  ADD UNIQUE KEY `if_eval` (`id_eval`),
  ADD KEY `id_matiere` (`id_matiere`);

--
-- Index pour la table `eval_eleve`
--
ALTER TABLE `eval_eleve`
  ADD PRIMARY KEY (`id_eval`,`id_eleve`),
  ADD KEY `id_eleve` (`id_eleve`);

--
-- Index pour la table `matiere`
--
ALTER TABLE `matiere`
  ADD PRIMARY KEY (`id_matiere`),
  ADD KEY `id_module` (`id_module`);

--
-- Index pour la table `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`id_module`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `eleve`
--
ALTER TABLE `eleve`
  MODIFY `id_eleve` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Numéro assigné à un élève', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `eval`
--
ALTER TABLE `eval`
  MODIFY `id_eval` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Numéro de l''évaluation', AUTO_INCREMENT=0;

--
-- AUTO_INCREMENT pour la table `matiere`
--
ALTER TABLE `matiere`
  MODIFY `id_matiere` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Numéro de la matière', AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT pour la table `module`
--
ALTER TABLE `module`
  MODIFY `id_module` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Numéro du module', AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `eleve_matiere`
--
ALTER TABLE `eleve_matiere`
  ADD CONSTRAINT `fk_eleve_matiere_eleve` FOREIGN KEY (`id_eleve`) REFERENCES `eleve` (`id_eleve`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_eleve_matiere_matiere` FOREIGN KEY (`id_matiere`) REFERENCES `matiere` (`id_matiere`) ON DELETE CASCADE;

--
-- Contraintes pour la table `eleve_module`
--
ALTER TABLE `eleve_module`
  ADD CONSTRAINT `fk_eleve_module_eleve` FOREIGN KEY (`id_eleve`) REFERENCES `eleve` (`id_eleve`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_eleve_module_module` FOREIGN KEY (`id_module`) REFERENCES `module` (`id_module`);

--
-- Contraintes pour la table `eval`
--
ALTER TABLE `eval`
  ADD CONSTRAINT `eval_ibfk_1` FOREIGN KEY (`id_matiere`) REFERENCES `matiere` (`id_matiere`) ON DELETE CASCADE;

--
-- Contraintes pour la table `eval_eleve`
--
ALTER TABLE `eval_eleve`
  ADD CONSTRAINT `eval_eleve_ibfk_1` FOREIGN KEY (`id_eval`) REFERENCES `eval` (`id_eval`) ON DELETE CASCADE,
  ADD CONSTRAINT `eval_eleve_ibfk_2` FOREIGN KEY (`id_eleve`) REFERENCES `eleve` (`id_eleve`) ON DELETE CASCADE;

--
-- Contraintes pour la table `matiere`
--
ALTER TABLE `matiere`
  ADD CONSTRAINT `matiere_ibfk_1` FOREIGN KEY (`id_module`) REFERENCES `module` (`id_module`);


--
-- Déclencheurs `eleve`
--

DELIMITER $$
CREATE TRIGGER `add_modules_and_matieres` AFTER INSERT ON `eleve` FOR EACH ROW BEGIN
    INSERT INTO eleve_module (id_eleve, id_module)
    VALUES (NEW.id_eleve, 1), (NEW.id_eleve, 2), (NEW.id_eleve, 3), (NEW.id_eleve, 4);

    INSERT INTO Eleve_Matiere (id_eleve, id_matiere)
    SELECT NEW.id_eleve, id_matiere FROM Matiere;
END$$
DELIMITER ;
COMMIT;
