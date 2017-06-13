-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 08 Juin 2017 à 11:33
-- Version du serveur :  5.7.14
-- Version de PHP :  7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `projet_lo07`
--

-- --------------------------------------------------------

--
-- Structure de la table `cursus`
--

CREATE TABLE `cursus` (
  `label` varchar(10) NOT NULL,
  `etudiant` int(6) NOT NULL,
  `element_formation` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `element_formation`
--

CREATE TABLE `element_formation` (
  `sem_seq` int(2) NOT NULL,
  `sem_label` varchar(6) NOT NULL,
  `sigle` varchar(6) NOT NULL,
  `categorie` varchar(6) NOT NULL,
  `affectation` varchar(6) NOT NULL,
  `utt` tinyint(1) NOT NULL,
  `profil` tinyint(1) NOT NULL,
  `credit` int(2) NOT NULL,
  `resultat` varchar(6) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

CREATE TABLE `etudiant` (
  `id` int(6) NOT NULL,
  `prenom` varchar(25) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `admission` varchar(4) NOT NULL,
  `filiere` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `regle`
--

CREATE TABLE `regle` (
  `num_regle` int(4) NOT NULL,
  `action` varchar(10) NOT NULL,
  `type` varchar(6) NOT NULL,
  `temps_cursus` varchar(10) NOT NULL,
  `credits` int(4) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `reglement`
--

CREATE TABLE `reglement` (
  `num_regle` int(4) NOT NULL,
  `nom_reglement` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `cursus`
--
ALTER TABLE `cursus`
  ADD PRIMARY KEY (`label`),
  ADD KEY `etudiant` (`etudiant`),
  ADD KEY `element_formation` (`element_formation`);

--
-- Index pour la table `element_formation`
--
ALTER TABLE `element_formation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sigle` (`sigle`);

--
-- Index pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `regle`
--
ALTER TABLE `regle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `num_regle` (`num_regle`);

--
-- Index pour la table `reglement`
--
ALTER TABLE `reglement`
  ADD PRIMARY KEY (`nom_reglement`),
  ADD KEY `num_regle` (`num_regle`);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `cursus`
--
ALTER TABLE `cursus`
  ADD CONSTRAINT `cursus_ibfk_1` FOREIGN KEY (`element_formation`) REFERENCES `element_formation` (`sigle`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD CONSTRAINT `etudiant_ibfk_1` FOREIGN KEY (`id`) REFERENCES `cursus` (`etudiant`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `reglement`
--
ALTER TABLE `reglement`
  ADD CONSTRAINT `reglement_ibfk_1` FOREIGN KEY (`num_regle`) REFERENCES `regle` (`num_regle`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
