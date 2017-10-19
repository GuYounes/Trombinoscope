-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Sam 10 Décembre 2016 à 22:33
-- Version du serveur :  10.1.19-MariaDB
-- Version de PHP :  7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `trombi`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nom_admin` varchar(55) NOT NULL,
  `mdp_admin` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `admin`
--

INSERT INTO `admin` (`id_admin`, `nom_admin`, `mdp_admin`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

CREATE TABLE `etudiant` (
  `id_etu` int(11) NOT NULL,
  `nom_etu` varchar(40) NOT NULL,
  `prenom_etu` varchar(30) NOT NULL,
  `no_groupe` int(20) NOT NULL,
  `photo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `etudiant`
--

INSERT INTO `etudiant` (`id_etu`, `nom_etu`, `prenom_etu`, `no_groupe`, `photo`) VALUES
(75, 'alex', 'alex', 1, 'images/image.png'),
(76, 'Cena', 'John', 1, 'images/Image.png'),
(77, 'Anderson', 'Tom', 2, 'images/Image.png'),
(78, 'Edouard', 'Jean', 3, 'images/Image.png'),
(79, 'Ginoux', 'Nicolas', 4, 'images/Image.png'),
(80, 'Cena', 'John', 1, 'images/Image.png'),
(81, 'Anderson', 'Tom', 2, 'images/Image.png'),
(82, 'Edouard', 'Jean', 3, 'images/Image.png'),
(83, 'Ginoux', 'Nicolas', 4, 'images/Image.png'),
(84, 'Cena', 'John', 1, 'images/Image.png'),
(85, 'Anderson', 'Tom', 2, 'images/Image.png'),
(86, 'Edouard', 'Jean', 3, 'images/Image.png'),
(87, 'Ginoux', 'Nicolas', 4, 'images/Image.png');

-- --------------------------------------------------------

--
-- Structure de la table `groupe`
--

CREATE TABLE `groupe` (
  `no_groupe` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `groupe`
--

INSERT INTO `groupe` (`no_groupe`) VALUES
(1),
(2),
(3),
(4);

-- --------------------------------------------------------

--
-- Structure de la table `log_etu`
--

CREATE TABLE `log_etu` (
  `id_etu` int(11) NOT NULL,
  `log` varchar(15) NOT NULL,
  `mdp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `log_etu`
--

INSERT INTO `log_etu` (`id_etu`, `log`, `mdp`) VALUES
(75, 'alex', 'alex'),
(76, 'CenaJohn', 'avxUV0s$maRO'),
(77, 'AndeTom', '8k5PwPdnuog6'),
(78, 'EdouJean', 'bUoGR&NPFgZP'),
(79, 'GinoNico', '?p+ndeskq9cF'),
(80, 'CenaJohn1', 'H49rEMn$BKN9'),
(81, 'AndeTom1', 'hesEM6JjhcGD'),
(82, 'EdouJean1', 'C?A5uT&eSWrv'),
(83, 'GinoNico1', '!JFBWX%24CZA'),
(84, 'CenaJohn2', 'Ra5oCVwA!mPZ'),
(85, 'AndeTom2', '1Lo$w3krxn!d'),
(86, 'EdouJean2', '1$OTA4wC?soS'),
(87, 'GinoNico2', 'Q&x4L%W%tQBp');

-- --------------------------------------------------------

--
-- Structure de la table `log_prof`
--

CREATE TABLE `log_prof` (
  `id_prof` int(5) NOT NULL,
  `log` varchar(20) NOT NULL,
  `mdp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `log_prof`
--

INSERT INTO `log_prof` (`id_prof`, `log`, `mdp`) VALUES
(1, 'LaroPier', 'Laroche');

-- --------------------------------------------------------

--
-- Structure de la table `professeur`
--

CREATE TABLE `professeur` (
  `id_prof` int(5) NOT NULL,
  `nom_prof` text NOT NULL,
  `prenom_prof` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `professeur`
--

INSERT INTO `professeur` (`id_prof`, `nom_prof`, `prenom_prof`) VALUES
(1, 'Laroche', 'Pierre');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Index pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD PRIMARY KEY (`id_etu`),
  ADD KEY `no_groupe` (`no_groupe`);

--
-- Index pour la table `groupe`
--
ALTER TABLE `groupe`
  ADD PRIMARY KEY (`no_groupe`);

--
-- Index pour la table `log_etu`
--
ALTER TABLE `log_etu`
  ADD PRIMARY KEY (`id_etu`),
  ADD KEY `id_etu` (`id_etu`);

--
-- Index pour la table `log_prof`
--
ALTER TABLE `log_prof`
  ADD PRIMARY KEY (`id_prof`),
  ADD KEY `id_prof` (`id_prof`);

--
-- Index pour la table `professeur`
--
ALTER TABLE `professeur`
  ADD PRIMARY KEY (`id_prof`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `etudiant`
--
ALTER TABLE `etudiant`
  MODIFY `id_etu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;
--
-- AUTO_INCREMENT pour la table `professeur`
--
ALTER TABLE `professeur`
  MODIFY `id_prof` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `log_etu`
--
ALTER TABLE `log_etu`
  ADD CONSTRAINT `log_etu_ibfk_1` FOREIGN KEY (`id_etu`) REFERENCES `etudiant` (`id_etu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `log_prof`
--
ALTER TABLE `log_prof`
  ADD CONSTRAINT `log_prof_ibfk_1` FOREIGN KEY (`id_prof`) REFERENCES `professeur` (`id_prof`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
