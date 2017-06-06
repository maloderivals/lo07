-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Mar 06 Juin 2017 à 13:24
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
  `id` int(11) NOT NULL,
  `label` varchar(20) NOT NULL,
  `numeroEtu` int(5) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `elementcursus`
--

CREATE TABLE `elementcursus` (
  `id` int(11) NOT NULL,
  `num_semestre` varchar(2) NOT NULL,
  `label_semestre` varchar(4) NOT NULL,
  `sigle` varchar(4) NOT NULL,
  `categorie` varchar(2) NOT NULL,
  `affectation` varchar(4) NOT NULL,
  `utt` varchar(1) NOT NULL,
  `profil` varchar(1) NOT NULL,
  `credit` int(2) NOT NULL,
  `resultat` varchar(3) NOT NULL,
  `idCursus` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

CREATE TABLE `etudiant` (
  `nom` varchar(25) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `numero` int(5) NOT NULL,
  `filliere` varchar(3) NOT NULL,
  `admission` varchar(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `regle`
--

CREATE TABLE `regle` (
  `label` varchar(3) NOT NULL,
  `agregat` varchar(5) NOT NULL,
  `cible` varchar(10) NOT NULL,
  `affectation` float NOT NULL,
  `seuil` int(11) NOT NULL,
  `idReglement` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `reglement`
--

CREATE TABLE `reglement` (
  `id` int(11) NOT NULL,
  `label` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `cursus`
--
ALTER TABLE `cursus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `numeroEtu` (`numeroEtu`);

--
-- Index pour la table `elementcursus`
--
ALTER TABLE `elementcursus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idCursus` (`idCursus`);

--
-- Index pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD PRIMARY KEY (`numero`);

--
-- Index pour la table `regle`
--
ALTER TABLE `regle`
  ADD PRIMARY KEY (`label`),
  ADD KEY `idReglement` (`idReglement`);

--
-- Index pour la table `reglement`
--
ALTER TABLE `reglement`
  ADD PRIMARY KEY (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
