-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 08 jan. 2024 à 21:14
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `wiki`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `categorieID` int(11) NOT NULL,
  `nomCategorie` varchar(255) NOT NULL,
  `dateCategorie` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `tags`
--

CREATE TABLE `tags` (
  `tagID` int(11) NOT NULL,
  `nomTag` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `iduser` int(10) NOT NULL,
  `nom` varchar(100) DEFAULT NULL,
  `prenom` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `pass` varchar(100) DEFAULT NULL,
  `tel` varchar(20) DEFAULT NULL,
  `role` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`iduser`, `nom`, `prenom`, `email`, `pass`, `tel`, `role`) VALUES
(3, 'Barton', 'lynub', 'qohitilapy@mailinator.com', '$2y$10$39tOKRmiTiqto/yFjEfCeeAYp39cQ0OV9.EK2GRZsHyn2180ABGuu', '0654215485', 'auteur'),
(4, 'Wallace', 'juzahis', 'xojypomoz@mailinator.com', '$2y$10$bxqaAvjU0PyJzXE4L/fqd.UL5bs7HO8ffMBa0a61v6LNi/XG7cp.i', '0654875421', 'auteur'),
(5, 'sebti', 'douae', 'douae123@gmail.com', '$2y$10$3eeyRl3eQgW3kNwSq7wbKO4sjFdqUnoFOsivHfKu9ThTPdG1U04qi', '0654871254', 'admin'),
(6, 'idelkadi', 'radia', 'radia123@gmail.com', '$2y$10$fTW9oXip3.mO93.HRMIzP.2SlKQwCXsMGmvuXCIslT.7TlE7.WLDy', '0645789461', 'auteur'),
(7, 'Hawkins', 'popocy', 'tuxoz@mailinator.com', '$2y$10$fpdqXleC2ryPobPMp8P3pOSFRriUlZt57lNRJaXa03kZMIxezBOge', '0654871542', 'auteur'),
(8, 'Murphy', 'wacup', 'wagiva@mailinator.com', '$2y$10$TDuseZ4UvGsPVCqcuQSGve0ErPmC0XQUllHgj88noUWUvwvJOJkfC', '0215454454', 'auteur');

-- --------------------------------------------------------

--
-- Structure de la table `wiki`
--

CREATE TABLE `wiki` (
  `wikiID` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `creationDate` datetime NOT NULL,
  `archive` int(11) DEFAULT NULL,
  `iduser` int(11) DEFAULT NULL,
  `categorieID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `wikitag`
--

CREATE TABLE `wikitag` (
  `wikiID` int(11) NOT NULL,
  `tagID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`categorieID`);

--
-- Index pour la table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`tagID`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`iduser`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Index pour la table `wiki`
--
ALTER TABLE `wiki`
  ADD PRIMARY KEY (`wikiID`),
  ADD KEY `iduser` (`iduser`),
  ADD KEY `categorieID` (`categorieID`);

--
-- Index pour la table `wikitag`
--
ALTER TABLE `wikitag`
  ADD PRIMARY KEY (`wikiID`,`tagID`),
  ADD KEY `tagID` (`tagID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `categorieID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `tags`
--
ALTER TABLE `tags`
  MODIFY `tagID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `iduser` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `wiki`
--
ALTER TABLE `wiki`
  MODIFY `wikiID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `wiki`
--
ALTER TABLE `wiki`
  ADD CONSTRAINT `wiki_ibfk_1` FOREIGN KEY (`iduser`) REFERENCES `user` (`iduser`),
  ADD CONSTRAINT `wiki_ibfk_2` FOREIGN KEY (`categorieID`) REFERENCES `categorie` (`categorieID`);

--
-- Contraintes pour la table `wikitag`
--
ALTER TABLE `wikitag`
  ADD CONSTRAINT `wikitag_ibfk_1` FOREIGN KEY (`wikiID`) REFERENCES `wiki` (`wikiID`),
  ADD CONSTRAINT `wikitag_ibfk_2` FOREIGN KEY (`tagID`) REFERENCES `tags` (`tagID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
