-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 08 déc. 2023 à 22:16
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
-- Base de données : `gestion_cadeau`
--

-- --------------------------------------------------------

--
-- Structure de la table `cadeaux`
--

CREATE TABLE `cadeaux` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) DEFAULT NULL,
  `resume` text DEFAULT NULL,
  `prix` decimal(10,2) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `date_creation` timestamp NOT NULL DEFAULT current_timestamp(),
  `auteur` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `cadeaux`
--

INSERT INTO `cadeaux` (`id`, `nom`, `resume`, `prix`, `image_url`, `date_creation`, `auteur`) VALUES
(1, 'Jouet voiture télécommandée', 'Voiture télécommandée pour enfants', 29.99, 'url_image_voiture_telecommandee.jpg', '2023-12-08 21:09:19', 'ToyCo'),
(2, 'Livre de recettes', 'Livre de cuisine avec des recettes variées', 19.99, 'url_image_livre_recettes.jpg', '2023-12-08 21:09:19', 'ChefCook'),
(3, 'Ensemble de théière en porcelaine', 'Théière et tasses assorties', 49.99, 'url_image_theiere_porcelaine.jpg', '2023-12-08 21:09:19', 'TeaEmporium');

-- --------------------------------------------------------

--
-- Structure de la table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `cadeau_id` int(11) DEFAULT NULL,
  `personne_reservant` varchar(50) DEFAULT NULL,
  `prix_reel` decimal(10,2) DEFAULT NULL,
  `date_reservation` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_debut_reservation` timestamp NOT NULL DEFAULT '2023-12-07 23:00:00',
  `date_fin_reservation` timestamp NOT NULL DEFAULT '2023-12-08 22:59:59'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reservations`
--

INSERT INTO `reservations` (`id`, `cadeau_id`, `personne_reservant`, `prix_reel`, `date_reservation`, `date_debut_reservation`, `date_fin_reservation`) VALUES
(1, 1, 'Alice', 25.99, '2023-12-08 21:11:15', '2023-12-08 09:00:00', '2023-12-08 14:00:00'),
(2, 2, 'Bob', 39.50, '2023-12-08 21:11:45', '2023-12-08 11:00:00', '2023-12-08 17:00:00'),
(3, 3, 'Eve', 15.75, '2023-12-08 21:11:45', '2023-12-08 13:00:00', '2023-12-08 19:00:00');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `cadeaux`
--
ALTER TABLE `cadeaux`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cadeau_id` (`cadeau_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `cadeaux`
--
ALTER TABLE `cadeaux`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`cadeau_id`) REFERENCES `cadeaux` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
