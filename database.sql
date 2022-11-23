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

-- SELECT region, department name
-- FROM localisation
-- INNER JOIN band ON band.id=localisation.band_id;
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
REFERENCES band(id) ON DELETE CASCADE
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
`message` TEXT
);

-- Structure de la table `message_band`
--

CREATE TABLE message_band (
id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
lastname VARCHAR(80),
firstname VARCHAR(80),
instrument VARCHAR(80),
`level` VARCHAR(80),
style VARCHAR(80),
localisation VARCHAR(100),
email VARCHAR(80),
phone VARCHAR(80),
`message` TEXT
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

-- Insertion des instrument sur la table instrument
INSERT INTO category
VALUES (1, 'Clavier'),
       (2, 'Cordes'),
       (3, 'Vents'),
       (4, 'Percussion'),
       (5, 'Musiques amplifiées'),
       (6, 'Voix');

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

-- Insertion des catégories sur la table category
    INSERT INTO band
    VALUES
    (1, 'Nirvana', 'Nirvana est un groupe de grunge américain, originaire d\'Aberdeen, dans l\'État de Washington, formé en 1987 par le chanteur-guitariste Kurt Cobain et le bassiste Krist Novoselic.', 'nirvana.jpg', 1, 4, 'kurt.cobain@RIP.com', 'Rock'),
    (2, 'ACDC', 'ACDC est un groupe de hard rock australo-britannique, originaire de Sydney. Il est formé en 1973 par les frères écossais Angus et Malcolm Young.', 'acdc.jpg', 1, 5, 'angus.young@petit-ecolier.com', 'Rock'),
    (3, 'WHISPER NOTE', 'Whisper Note vous transporte dans un univers à la fois unique et résolument rétro en se réappropriant les classiques de la musique jazz. Du swing des années vingt aux standards de la pop moderne, chaque morceau de leur répertoire se teinte d’une couleur jazzy, évoquant l’ambiance feutrée des clubs new-yorkais.', 'whisper-note.jpg', 1, 4, 'contact@whispernote.com', 'Jazz'),
    (4, 'BE COMBO', 'En proposant des répertoires travaillés, des choix tranchés, des artistes qui ont une actualité foisonnante et qui accompagnent les plus grands.Be combo est un groupe jeune, passionné, fuyant le mauvais goût, avec une énorme envie de partager avec vous son amour de la musique.', 'be-combo.jpg', 1, 6, 'contact@becombo.com', 'Soul'),
    (5, 'XY MUSIC', 'En duo, trio ou quatuor, en acoustique (strolling) ou électrique, cette formation possède un répertoire très varié. Pop, rock, funk, dance, soul, quels que soient vos goûts musicaux, XY Music répondra à vos demandes.', 'xy-music.jpeg', 13, 4, 'contact@xymusic.com', 'Pop'),
    (6, 'Metallica', 'Metallica est un groupe de heavy metal américain originaire de Californie et considéré comme le plus grand groupe de metal de tous les temps.', 'metallica.jpg', 1, 4, 'metallica@best-band-ever.com', 'Heavy Metal'),
    (7, 'System of a Down', 'System of a Down (parfois abrégé en SOAD ou System) est un groupe de rock américain, originaire de Californie.', 'soad.jpg', 1, 4, 'SOAD@toxicity.com', 'Heavy Metal'),
    (8, 'Slipknot', "Slipknot est un groupe de nu metal américain, originaire de Des Moines, dans l'Iowa. Il est formé par le percussionniste Shawn Crahan, le batteur Joey Jordison, le bassiste Paul Gray et les guitaristes Kun Nong et Donnie Steele en 1995.", 'slipknot.jpg', 1, 9, 'Psychosocial@soignez-moi.com', 'Heavy Metal'),
    (9, 'Panda Banditt', "Panda Banditt, c'est le duo pop-électro à la formation originale piano/chant + batterie/SPD-SX. Depuis 2016, menée par deux jeunes musiciens. L'énergie est véhiculée par le choix de reprises actuelles mais aussi par le travail du son avec en plus de la batterie, des claviers et du chant, des machines électroniques ( Sampleur, looper, harmoniseur... ).",'panda-banditt.jpg', 11, 2, 'contact@pand-banditt.com', 'Pop'),
    (10, 'AMANDE ET MIEL', 'Amande et Miel est un groupe de musique aux multiples facettes spécialisé dans les animations musicales des événements privés et de mariages. Soft pop, jazzy groove, swing et touches latines, le groupe navigue avec finesse et aisance entre les genres musicaux choisis avec soin.', 'amandeetmiel.jpg', 11, 2, 'contact@amandeetmiel.com', 'Jazz'),
    (11, 'Pastel', 'Harmonisé à 2 voix, le répertoire revisite un large champ de variétés françaises et anglophones. De Juliette Armanet à Clara Luciani, Pastel srevisite les grandes chansons de Serge Gainsbourg et des Ritas Mitsouko, ou encore Janis Joplin', 'pastel.jpeg', 8, 2, 'contact@pastel.com', 'Variété française'),
    (12, 'Alice April', 'DJ Open format, Latin house / tech house, elle début sa carrière de Dj en 2018 et joue rapidement dans les soirée privées, club et palaces les plus branchés de la capitale', 'aliceapril.jpeg', 8, 1, 'contact@aliceapril.com', 'Musique électronique'),
    (13, 'Cover Club', 'Cover Club écume les scènes sans relâche et avec succès depuis 2013, à grand coup de reprises bien senties, de groove tenace et de refrains à reprendre en chœur.', 'coverclub.jpeg', 1, 4, 'contact@coverclub.com', 'Rock'),
    (14, 'Echo', 'Fondé en 2014, ECHO est spécialisé dans les arrangements de tubes intemporels en jouant avec les contrastes de styles et des atmosphères pour apporter une touche personnelle à leur répertoire multi-influencé.', 'echo.jpeg', 1, 2, 'contact@echo.com', 'Blues'),
    (15, 'Chill', 'Chill est un duo bordelais de musiciens auteurs, compositeurs, et interprètes, avec Yadicone Bassène au chant et Raphaël Bérésina à la guitare.', 'chill.jpeg', 10, 2, 'contact@chill.com', 'Blues'),
    (16, 'Fuzz', 'Notre répertoire est vaste, du rock, de la pop, du RnB, et de la funk notre but est avant tout de créer une vraie dynamique de soirée pour enflammer le dancefloor.', 'fuzz.jpeg', 11, 3, 'contact@fuzz.com', 'Pop'),
    (17, 'The Majestics', 'The Majestics est un cocktail doux et festif de sonorités latino-américaines, de rythmes swing, jazz, pop et de chansons françaises revisitées.', 'themajestics.jpeg', 13, 3, 'contact@themajestics.com', 'Pop'),
    (18, 'The Station Kaameleon', 'Leur univers acoustique oscille entre jazz, soul et country, entre énergie et douceur, toujours avec émotions !', 'thestationkaameleon.jpeg', 12, 2, 'contact@thestationkaameleon.com', 'Folk'),
    (19, 'Chris Cadillac', 'Chris Cadillac est un groupe de strolling (déambulant) mais aussi un groupe fixe, branché sur une source de sonorisation.', 'chriscadillac.jpeg', 13, 4, 'contact@chriscadillac.com', 'Musique du monde'),
    (20, 'Pepper Club', 'Pepper Club, est une formation de musiciens professionnels adaptée aux événements : concerts, accompagnement des artistes, réceptions, galas, enregistrements studio, animations artistiques...', 'pepperclub.jpeg', 6, 3, 'contact@pepperclub.com', 'Soul');

INSERT INTO search_instrument
(created_at, instrument_id, band_id, level)
VALUES
(NOW(), 1, 1, 'professionnel'),
(NOW(), 1, 2, 'professionnel'),
(NOW(), 1, 3, 'professionnel'),
(NOW(), 6, 4, 'débutant'),
(NOW(), 8, 6, 'initié'),
(NOW(), 12, 5, 'professionnel'),
(NOW(), 15, 7, 'professionnel'),
(NOW(), 19, 8, 'professionnel'),
(NOW(), 20, 9, 'débutant'),
(NOW(), 22, 10, 'initié'),
(NOW(), 23, 11, 'initié');

INSERT INTO message_band
VALUES (1, 'Axel', 'Crozier', 'Triangle', 'Professionel', 'Heavy Metal', 'Auvergne-Rhône-Alpes', 'acrozier15@icloud.com', '06 46 86 72 36', 'Youhouu je suis un message et je rentre en BDD');

INSERT INTO message_contact
VALUES (1, 'Axel', 'Crozier', 'acrozier15@icloud.com', '06 46 86 72 36', 'Youhouu je suis un message et je rentre en BDD');


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
