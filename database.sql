-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Jeu 26 Octobre 2017 à 13:53
-- Version du serveur :  5.7.19-0ubuntu0.16.04.1
-- Version de PHP :  7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
--
--

CREATE DATABASE whereismyband;
USE whereismyband;
-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
`password` varchar(20),
email VARCHAR(255),
nickname VARCHAR(80)
);

-- Structure de la table `localisation`
--

CREATE TABLE localisation (
id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
region varchar(100),
department VARCHAR(100),
);

-- Structure de la table `band`
--

CREATE TABLE band (
id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
name varchar(80) NOT NULL,
`description` TEXT NOT NULL,
picture VARCHAR(255);
CONSTRAINT fk_band_localisation
FOREIGN KEY (localisation_id)
REFERENCES localisation(id)
);

-- SELECT region, department name
-- FROM localisation
-- INNER JOIN band ON band.id=localisation.band_id;
-- -- Structure de la table `search_instrument`
-- --

CREATE TABLE search_instrument (
id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
created_at DATETIME,
`description` TEXT,
CONSTRAINT fk_instrument_searchinstrument
FOREIGN KEY (instrument_id)
REFERENCES instrument(id)
);

-- Structure de la table `instrument`
--

CREATE TABLE instrument (
id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
`name` VARCHAR(255),
CONSTRAINT fk_instrument_category
FOREIGN KEY (category_id)
REFERENCES category(id)
);

-- Structure de la table `category`
--

CREATE TABLE category (
id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
`name` VARCHAR(100),
);
--

-- Structure de la table `musicians`
--

CREATE TABLE musicians (
id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
firstname varchar(80),
lastname varchar(80),
adress VARCHAR(255);
CONSTRAINT fk_musicians_instrument FOREIGN KEY (instrument_id) REFERENCES instrument(id),
CONSTRAINT fk_musicians_localisation FOREIGN KEY (localisation_id) REFERENCES localisation(id),
);
-- Contenu de la table `item`
--

INSERT INTO `user` (id, password, email, nickname) VALUES
(1, 'Stuff'),
(2, 'password'),
(3, `test@gmail.com`),
(4, 'Stuff');


--
-- Index pour les tables exportées
--

--
-- Index pour la table `item`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `item`
--
ALTER TABLE `item`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
