-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:8889
-- Généré le :  Mer 21 Juin 2017 à 01:15
-- Version du serveur :  5.6.35
-- Version de PHP :  7.1.1

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
  `label` varchar(25) NOT NULL,
  `etudiant` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `element_formation`
--

CREATE TABLE `element_formation` (
  `id` varchar(25) NOT NULL,
  `sem_seq` int(2) NOT NULL,
  `sem_label` varchar(6) NOT NULL,
  `sigle` varchar(6) NOT NULL,
  `categorie` varchar(6) NOT NULL,
  `affectation` varchar(6) NOT NULL,
  `utt` varchar(1) NOT NULL,
  `profil` varchar(1) NOT NULL,
  `credit` int(2) NOT NULL,
  `resultat` varchar(6) NOT NULL,
  `cursus` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

CREATE TABLE `etudiant` (
  `id` int(6) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(25) NOT NULL,
  `admission` varchar(4) NOT NULL,
  `filiere` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `regle`
--

CREATE TABLE `regle` (
  `id_regle` varchar(50) NOT NULL,
  `num_regle` int(4) NOT NULL,
  `action` varchar(10) NOT NULL,
  `type` varchar(20) NOT NULL,
  `temps_cursus` varchar(10) NOT NULL,
  `credits` int(4) NOT NULL,
  `id_reglement` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `reglement`
--

CREATE TABLE `reglement` (
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
  ADD KEY `etudiant` (`etudiant`);

--
-- Index pour la table `element_formation`
--
ALTER TABLE `element_formation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sigle` (`sigle`),
  ADD KEY `id` (`id`),
  ADD KEY `cursus` (`cursus`);

--
-- Index pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `regle`
--
ALTER TABLE `regle`
  ADD PRIMARY KEY (`id_regle`),
  ADD KEY `num_regle` (`num_regle`),
  ADD KEY `idReglement` (`id_reglement`);

--
-- Index pour la table `reglement`
--
ALTER TABLE `reglement`
  ADD PRIMARY KEY (`nom_reglement`);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `cursus`
--
ALTER TABLE `cursus`
  ADD CONSTRAINT `fk_etu` FOREIGN KEY (`etudiant`) REFERENCES `etudiant` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `element_formation`
--
ALTER TABLE `element_formation`
  ADD CONSTRAINT `fk_cursus` FOREIGN KEY (`cursus`) REFERENCES `cursus` (`label`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `regle`
--
ALTER TABLE `regle`
  ADD CONSTRAINT `fk_reglement` FOREIGN KEY (`id_reglement`) REFERENCES `reglement` (`nom_reglement`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
