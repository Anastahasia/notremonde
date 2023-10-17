-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 17 oct. 2023 à 07:30
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
-- Structure de la table `circuit`
--

DROP TABLE IF EXISTS `circuit`;
CREATE TABLE IF NOT EXISTS `circuit` (
  `id_circuit` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `description` varchar(1000) NOT NULL,
  `duree` int NOT NULL,
  `photo` varchar(2000) NOT NULL,
  `alt` varchar(100) NOT NULL,
  `prix_estimatif` decimal(10,0) NOT NULL,
  `visible` tinyint(1) NOT NULL,
  `enfants` tinyint(1) NOT NULL,
  `categorie` int NOT NULL,
  PRIMARY KEY (`id_circuit`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `circuit`
--

INSERT INTO `circuit` (`id_circuit`, `titre`, `description`, `duree`, `photo`, `alt`, `prix_estimatif`, `visible`, `enfants`, `categorie`) VALUES
(1, 'Émilie-Romagne : Une Aventure Italienne', 'Explorez les ruelles pavées de Bologne, découvrez les secrets de fabrication du vinaigre balsamique à Modène, et goûtez les délices du Parmesan dans les fromageries locales. Vous serez enchanté par la beauté des villes médiévales, les trésors artistiques et les traditions gastronomiques uniques de cette région. Une expérience gustative et culturelle qui éveillera tous vos sens.', 10, 'images/Salita di san benedetto BOLOGNE.jpg', 'Salita di san benedetto BOLOGNE', '850', 1, 0, 0),
(2, 'Émilie-Romagne : Une Aventure Italienne', 'Explorez les ruelles pavées de Bologne, découvrez les secrets de fabrication du vinaigre balsamique à Modène, et goûtez les délices du Parmesan dans les fromageries locales. Vous serez enchanté par la beauté des villes médiévales, les trésors artistiques et les traditions gastronomiques uniques de cette région. Une expérience gustative et culturelle qui éveillera tous vos sens.', 10, 'images/Salita di san benedetto BOLOGNE.jpg', 'Salita di san benedetto BOLOGNE', '850', 1, 0, 0),
(3, 'Sans titre', 'Ajouter une description', 10, '', 'Ajouter un résumé ici.', '500', 0, 1, 4),
(4, 'Sans titre', 'Ajouter une description', 10, '', 'Ajouter un résumé ici.', '500', 0, 1, 4);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
