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

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE user (
id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
`password` varchar(20),
email VARCHAR(255),
nickname VARCHAR(80)
);

-- Structure de la table `localisation`
--

CREATE TABLE localisation (
`id` INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
`region` varchar(100)
);

-- Structure de la table `band`
--

CREATE TABLE band (
`id` INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
`name` varchar(80),
`description` TEXT,
`picture` VARCHAR(255),
`localisation_id` INT NOT NULL,
`number` INT NOT NULL,
`email` VARCHAR(255),
`style` VARCHAR(255),
CONSTRAINT fk_band_localisation
FOREIGN KEY (localisation_id)
REFERENCES localisation(id)
);


-- Structure de la table `category`
--

CREATE TABLE category (
id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
`name` VARCHAR(100)
);

-- Structure de la table `instrument`
--

CREATE TABLE instrument (
id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
`name` VARCHAR(255),
`category_id` INT NOT NULL,
CONSTRAINT fk_instrument_category
FOREIGN KEY (category_id)
REFERENCES category(id)
);

-- -- Structure de la table `search_instrument`
-- --

CREATE TABLE search_instrument (
`id` INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
`created_at` DATETIME,
`description` TEXT,
`instrument_id`INT NOT NULL,
`band_id`INT NOT NULL,
`level` VARCHAR(50),
CONSTRAINT fk_instrument_search_instrument
FOREIGN KEY (instrument_id)
REFERENCES instrument(id),
CONSTRAINT fk_band_band_id
FOREIGN KEY (band_id)
REFERENCES band(id)
);

-- Structure de la table `musicians`
--

CREATE TABLE musicians (
id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
firstname varchar(80),
lastname varchar(80),
adress VARCHAR(255),
`instrument_id` INT NOT NULL,
`localisation_id` INT NOT NULL,
CONSTRAINT fk_musicians_instrument FOREIGN KEY (instrument_id) REFERENCES instrument(id),
CONSTRAINT fk_musicians_localisation FOREIGN KEY (localisation_id) REFERENCES localisation(id)
);

-- Structure de la table `message_contact`
--

CREATE TABLE message_contact (
id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
lastname VARCHAR(80),
firstname VARCHAR(80),
email VARCHAR(80),
phone VARCHAR(80),
'message' TEXT,
);

-- Structure de la table `message_band`
--

CREATE TABLE message_band (
id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
lastname VARCHAR(80),
firstname VARCHAR(80),
instrument VARCHAR(80),
'level' VARCHAR(80),
style VARCHAR(80),
localisation VARCHAR(100),
email VARCHAR(80),
phone VARCHAR(80),
`message` TEXT,
);

-- Insertion des régions sur la table localisation
INSERT INTO localisation
VALUES (1, 'Auvergne-Rhône-Alpes'),
       (2, 'Bourgogne-Franche-Comté'),
       (3, 'Bretagne'),
       (4, 'Centre-Val de Loire'),
       (5, 'Corse'),
       (6, 'Grand Est'),
       (7, 'Hauts-de-France'),
       (8, 'Ile-de-France'),
       (9, 'Normandie'),
       (10, 'Nouvelle-Aquitaine'),
       (11, 'Occitanie'),
       (12, 'Pays de la Loire'),
       (13, "Provence-Alpes-Côte d'Azur");

-- Insertion des catégories sur la table category
INSERT INTO category
VALUES (1, 'Clavier'),
       (2, 'Cordes'),
       (3, 'Vents'),
       (4, 'Percussion'),
       (5, 'Musiques amplifiées'),
       (6, 'Voix');

-- Insertion des instrument sur la table instrument
INSERT INTO instrument
VALUES (1, 'Piano', 2),
       (2, 'Clavecin', 1),
       (3, 'Accordéon', 1),
       (4, 'Violon', 2),
       (5, 'Violon Alto', 2),
       (6, 'Violoncelle', 2),
       (7, 'Contrebasse', 2),
       (8, 'Guitare', 2),
       (9, 'Flûte à bec', 3),
       (10, 'Flûte traversière', 3),
       (11, 'Clarinette', 3),
       (12, 'Trombone', 3),
       (13, 'Saxophone', 3),
       (14, 'Trompette', 3),
       (15, 'Tuba', 3),
       (16, 'Batterie', 4),
       (17, 'Djembé', 4),
       (18, 'Tambour', 4),
       (19, 'Guitare électrique', 2),
       (20, 'Guitare basse', 2),
       (21, 'Piano musiques amplifiées', 5),
       (22, 'Musique assistée par ordinateur (MAO)', 5),
       (23, 'Chant choral', 6),
       (24, 'Chant musiques amplifiées', 6),
       (25, 'Tambourin', 4);

-- Insertion des bands sur la table band
    INSERT INTO band
    VALUES (1, 'Nirvana', 'Nirvana est un groupe de grunge américain, originaire d\'Aberdeen, dans l\'État de Washington, formé en 1987 par le chanteur-guitariste Kurt Cobain et le bassiste Krist Novoselic.', 'Image de Kurt', 1, 4, 'kurt.cobain@RIP.com', 'professionnel'),
    (2, 'ACDC', 'ACDC est un groupe de hard rock australo-britannique, originaire de Sydney. Il est formé en 1973 par les frères écossais Angus et Malcolm Young.', 'Image de Angus', 2, 5, 'angus.young@petit-ecolier.com', 'professionnel');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `item`
--

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `item`
--
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
