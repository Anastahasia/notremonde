-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 13 nov. 2023 à 07:26
-- Version du serveur : 8.0.31
-- Version de PHP : 8.1.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `notre_monde`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `id_categorie` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_categorie`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id_categorie`, `nom`, `description`) VALUES
(1, 'brouillon', 'brouillon'),
(2, 'l\'Aventure', 'adventure time'),
(3, 'Farniente', 'plage');

-- --------------------------------------------------------

--
-- Structure de la table `circuit`
--

DROP TABLE IF EXISTS `circuit`;
CREATE TABLE IF NOT EXISTS `circuit` (
  `id_circuit` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duree` int NOT NULL,
  `photo` varchar(2000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alt` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prix_estimatif` decimal(10,0) NOT NULL,
  `visible` tinyint(1) NOT NULL,
  `enfants` tinyint(1) NOT NULL,
  `categorie` int NOT NULL DEFAULT '1',
  `continent` int NOT NULL,
  PRIMARY KEY (`id_circuit`),
  KEY `circuit_fk0` (`categorie`),
  KEY `circuit_fk1` (`continent`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `circuit`
--

INSERT INTO `circuit` (`id_circuit`, `titre`, `description`, `duree`, `photo`, `alt`, `prix_estimatif`, `visible`, `enfants`, `categorie`, `continent`) VALUES
(1, 'Émilie-Romagne : Une Aventure Italienne', 'Explorez les ruelles pavées de Bologne, découvrez les secrets de fabrication du vinaigre balsamique à Modène, et goûtez les délices du Parmesan dans les fromageries locales. Vous serez enchanté par la beauté des villes médiévales, les joyaux artistiques et les traditions gastronomiques uniques de cette région. Une expérience gustative et culturelle qui éveillera tous vos sens.', 10, 'Salita di san benedetto BOLOGNE.jpg', 'Salita di san benedetto BOLOGNE', '1450', 1, 0, 2, 2),
(3, 'Sans titre', 'Ajouter une description', 10, '', 'Ajouter une description de la photo', '500', 1, 1, 1, 0),
(4, 'Exploration du Yucatán : Plages, Ruines Mayas et Charme Colonial', 'Découvrez le Yucatán en 10 jours : des plages de Cancún et Playa del Carmen aux vestiges mayas de Chichén Itzá, Uxmal et Calakmul, en passant par les villes coloniales de Valladolid, Mérida et Campeche. Explorez les sites emblématiques, goûtez à la cuisine locale, profitez de la culture maya et de la beauté naturelle du Yucatán. Un voyage riche en diversité et en histoire.&nbsp;', 15, 'TULUM.jpg', 'Plage de Tulum', '1500', 1, 1, 3, 0),
(5, 'Sans titre', 'Ajouter une description', 10, '', 'Ajouter une description de la photo', '500', 0, 1, 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `continent`
--

DROP TABLE IF EXISTS `continent`;
CREATE TABLE IF NOT EXISTS `continent` (
  `id_continent` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `illustration` varchar(2000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alt` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_continent`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `continent`
--

INSERT INTO `continent` (`id_continent`, `nom`, `description`, `illustration`, `alt`) VALUES
(1, 'Amérique du Nord', 'L\'Amérique du Nord, un continent de diversité époustouflante ! Des gratte-ciel de New York aux vastes parcs nationaux du Canada, en passant par les plages de sable blanc du Mexique, cette destination a tout pour plaire. Explorez des paysages grandioses comme le Grand Canyon, découvrez des cultures v', 'building-new-york.jpg', 'photo d\'une cascade'),
(2, 'Europe', 'Des majestueux châteaux de la France aux canaux romantiques d\'Amsterdam, en passant par les anciennes ruines de Rome, l\'Europe est un véritable trésor culturel. Les montagnes des Alpes offrent des pistes de ski spectaculaires, tandis que les plages de la Méditerranée vous invitent à la détente. Découvrez la gastronomie française avec ses fromages exquis, vins renommés et pâtisseries délicieuses. L\'Europe est un musée à ciel ouvert, des fresques de la Renaissance italienne aux chefs-d\'œuvre impre', 'rue-pave-maison-style-europe.jpg', ''),
(3, 'Afrique', 'L\'Afrique, un continent d\'aventures et de découvertes ! Vous pouvez explorer des réserves naturelles uniques, plonger dans des eaux cristallines à Zanzibar, ou découvrir les mystères de la faune et de la flore au cœur du continent. Rencontrez des cultures variées, dansez au rythme des percussions et', 'girafe.jpg', '');

-- --------------------------------------------------------

--
-- Structure de la table `etape_circuit`
--

DROP TABLE IF EXISTS `etape_circuit`;
CREATE TABLE IF NOT EXISTS `etape_circuit` (
  `id_ec` int NOT NULL AUTO_INCREMENT,
  `jourArrivee` int NOT NULL,
  `jourDepart` int NOT NULL,
  `descriptionEtape` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ordre` int NOT NULL,
  `hebergement` int NOT NULL,
  `circuit` int NOT NULL,
  PRIMARY KEY (`id_ec`),
  KEY `etape_circuit_fk0` (`hebergement`),
  KEY `etape_circuit_fk1` (`circuit`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `etape_circuit`
--

INSERT INTO `etape_circuit` (`id_ec`, `jourArrivee`, `jourDepart`, `descriptionEtape`, `ordre`, `hebergement`, `circuit`) VALUES
(1, 9, 3, 'Ferrare est également célèbre pour son marché couvert, le Mercato Coperto, où vous pouvez acheter des produits locaux frais pour cuisiner chez vous ou déguster des plats préparés par les marchands locaux. Cette ville offre une expérience gastronomique authentique et mémorable pour les amateurs de cuisine italienne.', 1, 3, 1),
(2, 3, 5, 'Bologne est la capitale de l\'Émilie-Romagne et une ville riche en histoire, en culture et en architecture. Vous pouvez explorer la Piazza Maggiore, l\'une des places les plus emblématiques de la ville, et admirer la Basilique San Petronio, une magnifique église gothique. Ne manquez pas non plus la célèbre tour de Bologne, la Torre degli Asinelli, d\'où vous aurez une vue panoramique sur la ville.', 2, 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `favoris`
--

DROP TABLE IF EXISTS `favoris`;
CREATE TABLE IF NOT EXISTS `favoris` (
  `id_favoris` int NOT NULL AUTO_INCREMENT,
  `utilisateur` int NOT NULL,
  `circuit` int NOT NULL,
  PRIMARY KEY (`id_favoris`),
  KEY `favoris_fk0` (`utilisateur`),
  KEY `favoris_fk1` (`circuit`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `favoris`
--

INSERT INTO `favoris` (`id_favoris`, `utilisateur`, `circuit`) VALUES
(4, 19, 4),
(5, 19, 1),
(6, 6, 1);

-- --------------------------------------------------------

--
-- Structure de la table `hebergement`
--

DROP TABLE IF EXISTS `hebergement`;
CREATE TABLE IF NOT EXISTS `hebergement` (
  `id_hebergement` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo1` varchar(2000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo2` varchar(2000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descriptionHebergement` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ville` int NOT NULL,
  PRIMARY KEY (`id_hebergement`),
  KEY `hebergement_fk0` (`ville`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `hebergement`
--

INSERT INTO `hebergement` (`id_hebergement`, `nom`, `photo1`, `photo2`, `descriptionHebergement`, `type`, `adresse`, `telephone`, `ville`) VALUES
(1, 'hotel ferrare', 'FERRARE.jpg', 'FERRARE2.jpg', 'L\'hôtel est un super endroit pour les couples, pour les gourmets, et pour les touristes désirant faire des excursions de ville. Ses chambres élégamment décorées offrent une vue imprenable sur les ruelles médiévales de la ville. Avec son emplacement central, les principales attractions, les restaurants et les boutiques sont à quelques pas.', 'Hotel', 'in ferrare', '0692929292', 5),
(2, 'B&B Bologne', 'bologne.jpg', 'bologne2.jpg', 'Vous pourrez savourer un petit-déjeuner copieux composé de délices locaux dans notre salle à manger pittoresque, et notre emplacement central vous permettra de découvrir facilement les trésors culturels et les saveurs de Bologne à quelques pas de votre porte.', 'B&B', 'IN BOLOGNE', '0693939393', 1),
(3, 'Mi Amor Colibri Boutique Hotel', '', '', '\r\nNiché sur un petit promontoire rocheux surplombant la mer des Caraïbes se trouve l\'Hôtel Mi Amor. Pénétrez dans notre espace de jeu inspiré par l\'Art déco et l\'âge d\'or d\'Acapulco. Notre concept d\'espace ouvert unique révèle l\'équilibre parfait de la nature. Caché dans nos cabanes rayées privées perchées parmi nos jardins luxuriants tout en écoutant les vagues. Balancez-vous depuis les fauteuils-hamacs au-dessus de la piscine à débordement tout en sirotant des cocktails artisanaux dans notre bar Besame Mucho. Dégustez le menu contemporain du chef primé José Luis Hinostroza mettant en avant l\'abondance des produits de la mer au Mexique. Blottissez-vous dans un nid d\'amour comme aucun autre. Profitez d\'un soin spa en couple ou parcourez notre boutique de cadeaux regorgeant de trouvailles sélectionnées. Peu importe où vous regardez, vous découvrirez que l\'amour passe effectivement par les sens.', 'Hotel', 'Carr. Tulum-Boca Paila Km. 4.1,\r\nZona Hotelera Tulum, Zona Costera, 77780\r\nTulum, Q.R, Mexico', '(+52) 984-', 1);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id_utilisateur` int NOT NULL AUTO_INCREMENT,
  `role` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `num` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mot_de_passe` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_utilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_utilisateur`, `role`, `nom`, `prenom`, `num`, `email`, `mot_de_passe`) VALUES
(1, 'admin', 'Doe', 'John', '0692939191', 'john@doe.com', '$argon2id$v=19$m=131072,t=4,p=2$YzhQTmZ1M1V5TGdTTUxobw$EnnOUXv4hCJlGHCo8ZBkD41memQyguXtehk1qPu9bwY'),
(3, 'guest', '&lt;script&gt; alert(\'k\') &lt;/script&gt', 'assani', '0692919191', 'leisha@li.com', '$argon2id$v=19$m=131072,t=4,p=2$NDdUdDFqUEl4SjRYeDZFNg$1S9lAEO+TOxseBV97DebLdqyppnplq6SG3ylbjUvtmY'),
(5, 'client', 'testing', 'testing', '0698989898', 'test@test', 'test'),
(6, 'user', 'Quin', 'Harley', '06597967978', 'harley@quinn', '$2y$10$0xjAxqTlZ3heCn7pAcboB.wnJYWzN7wU7zxFDb5QBNKA4glVFhwTa'),
(7, 'guest', 'anasthasia', 'assani', '0692919191', 'ana@ana', '$argon2id$v=19$m=131072,t=4,p=2$dDBvVS82cVcyM2NLUU5hTA$kdPoaJ2Gd353peckaOPjXLT8POfDqEvrmJvnGWbcA3s'),
(8, 'guest', 'anasthasia', 'assani', '0692919191', 'ana@ana', '$argon2id$v=19$m=131072,t=4,p=2$THBTTjFqbTMzYjVXUFpmMg$vrNc4lkIzmqbM01O6mVukTCi1MeM5Vh442/zozHWxw0'),
(9, 'guest', 'anasthasia', 'assani', '0692919191', 'ana@ana', '$argon2id$v=19$m=131072,t=4,p=2$MVlNeDAvVzkvbGJoTTdQbw$nC8u64bjjOpMKKu/SPVWlLDT+JCtGjQrODUuHQ6aowU'),
(10, 'guest', 'anasthasia', 'assani', '0692919191', 'ana@ana', '$argon2id$v=19$m=131072,t=4,p=2$Y3JUa2RHQi5sb2EuU3JxeQ$zqWaWSgJWdGJrxl8bqc9N0wxF8J8Lw7IUDzh09nJc4I'),
(11, 'guest', 'anasthasia', 'Assani', '0498569796', 'admin@voyage', '$argon2id$v=19$m=131072,t=4,p=2$bHkuRmhYYlBiUUtzYk5pdA$CwDpAcK+t8ZNICCe8Sd22f8y7fbfYxrluRJUEutdykc'),
(12, 'guest', 'anasthasia', 'assani', '692919191', 'p@p', '$argon2id$v=19$m=131072,t=4,p=2$M3FkaHJYTE1PblJPY1Z4Sw$LUoSuX/rsyXEziDDSjvAD7wACXx+SO9I5i+z1vqBpDo'),
(13, 'guest', '<IMG SRC=jAvascript:alert(\'test2\')>', 'assani', '692919191', 'l@l', '$argon2id$v=19$m=131072,t=4,p=2$VUJQc21tcU4wOUpLNzZ1ZQ$I3sJFq7heFTHzIn7AnHYBaBJewWaXbmTdM3VlQL2w94'),
(15, 'guest', 'anasthasia', 'assani', 'l@p', '0692919191', '$argon2id$v=19$m=131072,t=4,p=2$NzMyZEJDM3ZiczRyR2RMag$u0KbOMU2x/UwqbOl2z94fMa1LrYOmIpQ2NRjCRZhRQ0'),
(16, 'guest', 'anasthasia', 'assani', 'l@p', '24049596', '$argon2id$v=19$m=131072,t=4,p=2$WUx5Lzd3OGFNUzZwZEFTaQ$s530EX++4QVPvddu8kYrc0sHfEHxv0GKQ1sUyCwPwbQ'),
(17, 'guest', 'anasthasia', 'assani', 'l@p', '24049596', '$argon2id$v=19$m=131072,t=4,p=2$TU0vZWFZMGIybzNiVmtpYg$Lz3nedpB0Ziyza75b/unYYBy1HARxX87zneg2hVpY08'),
(18, 'guest', 'Assiette', 'Leisha', '06597967978', 'l@p', '$argon2id$v=19$m=131072,t=4,p=2$N2V1YTI0UW5VLnNZZGx1Lg$gL6IXu7jEmzI4Da+4ttr4NY/0EXbGHMUhpa4XxXarUM'),
(19, 'guest', 'anasthasia', 'assani', '6597967978', 'm@m', '$argon2id$v=19$m=131072,t=4,p=2$a29aOXd5dWVNeFRVaWNrNw$HL2T+XwIVtzD2UbohszVIIdzQ5n2IHMDUAoWM3B/tRI'),
(20, 'admin', 'anasthasia; and drop databse notre_monde', 'assani', '0692939393', 'ana@admin.fr', '$argon2id$v=19$m=131072,t=4,p=2$cUZQOGdHR0NVVXhpN2xPbg$eQFTJeTBSs4o17ye3ZMxX4YArY9YVCbNGMNVpmBLNQk'),
(21, 'guest', 'anasthasia;&#039; and drop databse &#039', 'assani', '0692919191', 'bla@bla.com', '$argon2id$v=19$m=131072,t=4,p=2$R2t1UWsyVURjZHUwa1BNRQ$/+SJjU3Krv8winnNX1VL+oIsyjmQSIoCFU0hsS18qW0'),
(22, 'guest', 'anasthasia&#039;; and drop database &#03', 'assani', '0692919191', 'mili@lio.com', '$argon2id$v=19$m=131072,t=4,p=2$eGFXejlzckk3b2pCbHRMZg$BAehRY3Xm5nIu99dI5h70b+MunEi3qCBSvxeeuLbMF0'),
(23, 'guest', 'Mayé', 'lîla', '0498569796', 'li@li.com', '$argon2id$v=19$m=131072,t=4,p=2$TGh6ODFLNXVpREZNVW5EYw$tBRnqbLvYqos1lPzI64lVSiJWu4mMdMGtlXsZ2s2HC4'),
(24, 'guest', 'Anasthasia', 'milie', '0984754769', 'ol@ol.com', '$argon2id$v=19$m=131072,t=4,p=2$VVJKaHV6RFpNWWxKTzFUTw$EG1N4/8ToLjSMsQJd6495HJq4GdZYMnT/++DM8VXpuo');

-- --------------------------------------------------------

--
-- Structure de la table `ville`
--

DROP TABLE IF EXISTS `ville`;
CREATE TABLE IF NOT EXISTS `ville` (
  `id_ville` int NOT NULL AUTO_INCREMENT,
  `ville` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photoVille` varchar(2000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pays` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `continent` int NOT NULL,
  PRIMARY KEY (`id_ville`),
  KEY `ville_fk0` (`continent`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `ville`
--

INSERT INTO `ville` (`id_ville`, `ville`, `photoVille`, `pays`, `continent`) VALUES
(1, 'Bologne', 'bologne.jpg', 'Italie', 2),
(3, 'Yucatan', 'https://media.istockphoto.com/id/1378300154/photo/aerial-view-of-chichen-itza-at-sunrise.jpg?s=612x612&w=0&k=20&c=quBHkkEVhH2nwZ0WuIiewNT2UUtbaDe_t49uBSzGYnI=', 'Mexique', 1),
(4, 'San Miguel De Allende', 'San Miguell di allende MEXICO.jpg', 'Mexique', 1),
(5, 'Ferrare', 'FERRARE.jpg', 'Italie', 2),
(6, 'Livingstone', 'chute victoria.jpg', 'Zambie', 3);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
