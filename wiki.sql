-- Création de la base de données
CREATE DATABASE wiki;

-- Utilisation de la base de données
USE wiki;

-- Création de la table User
CREATE TABLE `user` (
  `iduser` int(10) PRIMARY KEY AUTO_INCREMENT,
  `nom` varchar(100),
  `prenom` varchar(100),
  `email` varchar(100) UNIQUE,
  `pass` varchar(100),
  `tel` varchar(20),
  `role` varchar(100)
);

-- Création de la table Category
CREATE TABLE Categorie (
    categorieID INT PRIMARY KEY AUTO_INCREMENT,
    nomCategorie VARCHAR(255) NOT NULL
);

-- Création de la table Tag
CREATE TABLE Tags (
    tagID INT PRIMARY KEY AUTO_INCREMENT,
    nomTag VARCHAR(255) NOT NULL
);

-- Création de la table Wiki
CREATE TABLE Wiki (
    wikiID INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    creationDate DATE NOT NULL,
    iduser INT,
    categorieID INT,
    FOREIGN KEY (iduser) REFERENCES User(iduser),
    FOREIGN KEY (categorieID) REFERENCES categorie(categorieID)
);

-- Table de liaison entre Wiki et Tag pour gérer la relation many-to-many
CREATE TABLE WikiTag (
    wikiID INT,
    tagID INT,
    PRIMARY KEY (wikiID, tagID),
    FOREIGN KEY (wikiID) REFERENCES Wiki(wikiID),
    FOREIGN KEY (tagID) REFERENCES Tags(tagID)
);
