-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 10 jan. 2024 à 14:09
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

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`categorieID`, `nomCategorie`, `dateCategorie`) VALUES
(2, 'test2 yes ', '2024-01-09 14:30:00'),
(3, 'test3 up', '2024-01-09 11:57:00'),
(5, 'jkqsbhdl qlkdnkq<nmod', '2024-01-10 11:27:00');

-- --------------------------------------------------------

--
-- Structure de la table `tags`
--

CREATE TABLE `tags` (
  `tagID` int(11) NOT NULL,
  `nomTag` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `tags`
--

INSERT INTO `tags` (`tagID`, `nomTag`) VALUES
(2, 'tag2'),
(3, 'tag3'),
(4, 'tag4'),
(6, 'hh'),
(7, 'tag2'),
(8, 'tag11'),
(9, 'tag5'),
(10, 'tag2'),
(11, 'tag3');

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
(10, 'Delaney', 'kujuletyso', 'luxokelob@mailinator.com', '$2y$10$wUmVGICE2AYghX7ylL7gOejna15xljvpOIFVSDVswIDN3uZvpbTZ6', '0666666666', 'auteur'),
(11, 'Walter', 'zupisubiru', 'zazoxykori@mailinator.com', '$2y$10$QY8JjVYs/RLZ3RGOgBf4u.sPsrT3WrTJEo9eg8e0Qa./BMXHFW3HS', '0654125454', 'auteur'),
(12, 'Stephens', 'vawawot', 'cecudyxyzy@mailinator.com', '$2y$10$CrEH9RTzBQZw9Xdg2FIgAuTEFc/mNqEUujAW.e6sRHGLHq4.04BeS', '0654254555', 'auteur'),
(13, 'sahtani', 'soumia', 'soumia123@gmail.com', '$2y$10$T/2lQEwU0nHxb2338gOoCODrEJwQ7v8y19PgvhTV0q62rI31aEtWa', '0654123654', 'auteur');

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

--
-- Déchargement des données de la table `wiki`
--

INSERT INTO `wiki` (`wikiID`, `title`, `content`, `creationDate`, `archive`, `iduser`, `categorieID`) VALUES
(6, 'nn', 'l', '2024-01-09 16:38:45', NULL, 6, 3),
(7, 'pls', 'cc', '2024-01-09 17:02:24', NULL, 6, 2),
(8, 'nn', 'sdfghjk', '2024-01-09 17:07:20', NULL, 6, 2),
(10, 'bb', 'vv', '2024-01-09 17:12:17', NULL, 6, 2),
(11, 'nnnnnnnnnnnn', 'hhhhhhhhhhhhhhhhhhh', '2024-01-09 17:12:28', NULL, 6, 2),
(12, 'jh', 'jtfk', '2024-01-09 17:14:20', NULL, 6, 3),
(14, 'bb', 'jhcgfk', '2024-01-09 17:26:32', NULL, 6, 2),
(15, 'j,hgvl;hg', 'kfuygliu', '2024-01-09 17:30:23', NULL, 6, 3),
(16, 'hello', 'dd', '2024-01-09 18:48:03', NULL, 6, 2),
(17, 'hh', 'kgv', '2024-01-09 18:53:01', NULL, 6, 3),
(18, 'please', 'workk', '2024-01-09 19:00:08', NULL, 6, 2),
(19, 'Anim aliquam repudia', 'Ea at laboris simili', '2024-01-09 19:01:23', NULL, 6, 2),
(20, 'Anim aliquam repudia', 'Ea at laboris simili', '2024-01-09 19:01:55', NULL, 6, 2),
(21, 'Voluptas sed ducimus', 'Non amet ipsa aliq', '2024-01-09 19:02:23', NULL, 6, 2),
(22, 'Optio et adipisci i', 'Non veniam commodi ', '2024-01-09 19:02:35', NULL, 6, 2),
(23, 'Harum perferendis om', 'Incidunt aut nulla ', '2024-01-09 19:02:57', NULL, 6, 2),
(24, 'Harum perferendis om', 'Incidunt aut nulla ', '2024-01-09 19:05:59', NULL, 6, 2),
(25, 'jgvkuyl', 'kuhvoublui', '2024-01-09 19:08:31', NULL, 6, 2),
(26, 'bb', 'kugvlyho', '2024-01-09 19:10:33', NULL, 6, 2),
(27, 'bb', 'kugvlyho', '2024-01-09 19:11:11', NULL, 6, 2),
(29, 'Praesentium velit f', 'Et quas officia cill', '2024-01-09 19:11:43', NULL, 6, 3),
(30, 'kjvlbmkbmjbjkm', 'imhmhmhbmhmh', '2024-01-09 19:12:05', NULL, 6, 2),
(31, 'kjvlbmkbmjbjkm', 'imhmhmhbmhmh', '2024-01-09 19:13:40', NULL, 6, 2),
(32, 'uvlllgbui', 'kvuyglyilu', '2024-01-09 19:13:57', NULL, 6, 3),
(34, 'khvhlvhl', 'vyuyhjuhyl', '2024-01-09 19:16:30', NULL, 6, 3),
(35, 'gvkukug', 'hyukvkhv', '2024-01-09 19:19:27', NULL, 6, 2),
(36, 'Aliquam adipisci tot', 'Laborum dolorum volu', '2024-01-09 19:25:08', NULL, 6, 2),
(39, 'Deserunt consequat ', 'At fuga Amet dolor', '2024-01-09 19:29:36', NULL, 6, 3),
(40, 'Consectetur quia est', 'Labore quasi in cum ', '2024-01-09 19:33:51', NULL, 6, 3),
(41, 'Reiciendis nisi est ', 'Minim nesciunt do a', '2024-01-09 19:40:13', NULL, 6, 2),
(43, 'what', 'why', '2024-01-09 19:55:59', NULL, 6, 2),
(45, 'WAAAAAAAAAAAAA', 'AKHIRANNNNN', '2024-01-09 19:57:57', NULL, 6, 3),
(46, 'hello', 'khbsd fkjqhbdkfqzu fjbdflsdkj jqhsduhsqf kjsbfeh jhdjksqkdbhu hdhdjjdhhh hdhizjdijz djjdhdhjd jhdhdhdjd dhhdjdjdj hddjhdjdh jdhjdhd jdhdhdjjdhd ', '2024-01-10 12:07:47', NULL, 13, 5);

-- --------------------------------------------------------

--
-- Structure de la table `wikitag`
--

CREATE TABLE `wikitag` (
  `wikiID` int(11) NOT NULL,
  `tagID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `wikitag`
--

INSERT INTO `wikitag` (`wikiID`, `tagID`) VALUES
(6, 3),
(7, 3),
(39, 3),
(39, 4),
(40, 6),
(43, 2),
(43, 3),
(45, 2),
(45, 3),
(46, 4),
(46, 6);

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
  ADD KEY `wiki_ibfk_1` (`iduser`),
  ADD KEY `wiki_ibfk_2` (`categorieID`);

--
-- Index pour la table `wikitag`
--
ALTER TABLE `wikitag`
  ADD PRIMARY KEY (`wikiID`,`tagID`),
  ADD KEY `wikitag_ibfk_2` (`tagID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `categorieID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `tags`
--
ALTER TABLE `tags`
  MODIFY `tagID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `iduser` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `wiki`
--
ALTER TABLE `wiki`
  MODIFY `wikiID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `wiki`
--
ALTER TABLE `wiki`
  ADD CONSTRAINT `wiki_ibfk_1` FOREIGN KEY (`iduser`) REFERENCES `user` (`iduser`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `wiki_ibfk_2` FOREIGN KEY (`categorieID`) REFERENCES `categorie` (`categorieID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `wikitag`
--
ALTER TABLE `wikitag`
  ADD CONSTRAINT `wikitag_ibfk_1` FOREIGN KEY (`wikiID`) REFERENCES `wiki` (`wikiID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `wikitag_ibfk_2` FOREIGN KEY (`tagID`) REFERENCES `tags` (`tagID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
