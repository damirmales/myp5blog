-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  Dim 19 jan. 2020 à 14:18
-- Version du serveur :  10.1.29-MariaDB
-- Version de PHP :  7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `p5blog`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE `articles` (
  `articles_id` int(11) NOT NULL,
  `titre` varchar(45) NOT NULL,
  `chapo` varchar(45) DEFAULT NULL,
  `auteur` varchar(45) NOT NULL,
  `contenu` varchar(255) NOT NULL,
  `rubrique` varchar(45) DEFAULT NULL,
  `date_creation` datetime NOT NULL,
  `date_mise_a_jour` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`articles_id`, `titre`, `chapo`, `auteur`, `contenu`, `rubrique`, `date_creation`, `date_mise_a_jour`) VALUES
(1, 'La tomme ', 'fromage de montagne', 'admin', 'La tomme ou tome est un fromage de montagne, existant en de multiples variétés', 'fromages', '2019-10-17 22:06:15', '2019-10-04 22:06:15'),
(3, 'Germinal', 'Emile Zola', 'admin', 'Germinal est un roman d\'Émile Zola publié en 1885.', 'livres', '2019-10-07 21:09:19', '2019-10-07 21:09:19');

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

CREATE TABLE `commentaires` (
  `commentaire_id` int(11) NOT NULL,
  `pseudo` varchar(45) NOT NULL,
  `contenu` varchar(255) NOT NULL,
  `date_ajout` datetime NOT NULL,
  `validation` tinyint(1) NOT NULL,
  `date_validation` datetime DEFAULT NULL,
  `Articles_articles_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nom` varchar(45) NOT NULL,
  `prenom` varchar(45) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` varchar(45) NOT NULL,
  `statut` tinyint(2) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `login` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `nom`, `prenom`, `email`, `role`, `statut`, `token`, `login`, `password`) VALUES
(11, 'males', 'damir', 'damir@romandie.com', 'admin', 1, 'null', 'moi', '$2y$10$laNvwvbVC/VyAKBDP6hQ9.TE9QO67IIRGMRMkxhCMqqBp52u1My32');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`articles_id`);

--
-- Index pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD PRIMARY KEY (`commentaire_id`,`Articles_articles_id`),
  ADD KEY `fk_Commentaires_Articles` (`Articles_articles_id`),
  ADD KEY `pseudo` (`pseudo`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `articles`
--
ALTER TABLE `articles`
  MODIFY `articles_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT pour la table `commentaires`
--
ALTER TABLE `commentaires`
  MODIFY `commentaire_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD CONSTRAINT `fk_Commentaires_Articles` FOREIGN KEY (`Articles_articles_id`) REFERENCES `articles` (`articles_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
