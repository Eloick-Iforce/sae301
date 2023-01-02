-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 12 déc. 2022 à 14:28
-- Version du serveur : 10.4.22-MariaDB
-- Version de PHP : 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `facture`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `id_article` bigint(20) UNSIGNED NOT NULL,
  `titre` varchar(255) NOT NULL,
  `chapo` text NOT NULL,
  `auteur` varchar(255) NOT NULL,
  `id_categorie` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id_article`, `titre`, `chapo`, `auteur`, `id_categorie`) VALUES
(15, 'L\'écologie', 'L\'écologie est la science qui étudie les relations des organismes vivants avec leur environnement. Elle vise à comprendre comment les différents éléments de l\'environnement interagissent entre eux et comment ils influencent la vie des organismes qui y vivent.', 'Eloick', 2);

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id_categorie` bigint(20) UNSIGNED NOT NULL,
  `nom_categorie` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id_categorie`, `nom_categorie`) VALUES
(1, 'Consommateurs'),
(2, 'Les états et l\'union Européene'),
(3, 'Acteurs de l\'énergie');

-- --------------------------------------------------------

--
-- Structure de la table `elements`
--

CREATE TABLE `elements` (
  `id_elements` bigint(20) UNSIGNED NOT NULL,
  `id_article` bigint(20) UNSIGNED NOT NULL,
  `balise` varchar(255) NOT NULL,
  `src` text NOT NULL,
  `alt` varchar(255) NOT NULL,
  `contenu` text NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `elements`
--

INSERT INTO `elements` (`id_elements`, `id_article`, `balise`, `src`, `alt`, `contenu`, `type`) VALUES
(31, 15, 'h2', '', '', 'De nos jours', ''),
(32, 15, 'p', '', '', 'De nos jours, l\'écologie est un sujet d\'actualité en raison des défis environnementaux auxquels nous faisons face, tels que le changement climatique, la pollution de l\'air et de l\'eau, la perte de biodiversité et la dégradation des écosystèmes.', ''),
(34, 15, 'img', 'uploads/File-639072eaa3ad28.82395826.jpg', '', '', ''),
(35, 15, 'p', '', '', 'Pour préserver notre environnement et assurer la pérennité de la vie sur Terre, il est important de prendre des mesures pour protéger et restaurer les écosystèmes naturels. Cela peut inclure la mise en place de lois et de réglementations pour protéger les espèces en danger, la restauration des habitats détruits, la gestion durable des ressources naturelles et la promotion de pratiques écologiques au quotidien.', ''),
(36, 15, 'h2', '', '', 'Individu', ''),
(37, 15, 'p', '', '', 'En tant qu\'individus, nous pouvons également contribuer à la protection de l\'environnement en adoptant des comportements écologiques au quotidien, comme réduire notre consommation d\'énergie et de matières premières, trier nos déchets, utiliser des produits écologiques et choisir des modes de transport respectueux de l\'environnement.', ''),
(38, 15, 'p', '', '', 'Il est important de souligner que l\'écologie ne concerne pas seulement les grands écosystèmes naturels, mais également les écosystèmes plus petits que nous pouvons trouver dans nos propres jardins, parcs et espaces verts. En prenant soin de ces écosystèmes, nous pouvons contribuer à la préservation de la biodiversité et offrir un habitat sain aux plantes et aux animaux qui y vivent.', ''),
(39, 15, 'h2', '', '', 'Conclusion', ''),
(40, 15, 'p', '', '', 'En résumé, l\'écologie est une science cruciale pour comprendre et protéger notre environnement. En adoptant des comportements écologiques au quotidien, nous pouvons contribuer à la préservation des écosystèmes naturels et à la pérennité de la vie sur Terre.', ''),
(41, 15, 'h2', '', '', 'Une vidéo sur l\'écologie', ''),
(42, 15, 'video', 'uploads/File-63907357b8a371.50514142.mp4', '', '', ''),
(43, 15, 'audio', 'uploads/File-6390736834f2f8.07438316.mp3', '', '', '');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id_article`),
  ADD UNIQUE KEY `id_article` (`id_article`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD UNIQUE KEY `id_categorie` (`id_categorie`);

--
-- Index pour la table `elements`
--
ALTER TABLE `elements`
  ADD UNIQUE KEY `id_elements` (`id_elements`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `id_article` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id_categorie` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `elements`
--
ALTER TABLE `elements`
  MODIFY `id_elements` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
