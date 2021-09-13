-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 05 Octobre 2015 à 02:49
-- Version du serveur :  5.6.21
-- Version de PHP :  5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `trocnc`
--
CREATE DATABASE IF NOT EXISTS `trocnc` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `trocnc`;

-- --------------------------------------------------------

--
-- Structure de la table `annonce`
--

CREATE TABLE IF NOT EXISTS `annonce` (
`id` int(10) NOT NULL,
  `description` text NOT NULL,
  `titre` varchar(10) NOT NULL,
  `etat` text NOT NULL,
  `preference` varchar(10) NOT NULL,
  `categorie` varchar(20) NOT NULL,
  `date_creation` datetime NOT NULL,
  `email_user` varchar(40) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `annonce`
--

INSERT INTO `annonce` (`id`, `description`, `titre`, `etat`, `preference`, `categorie`, `date_creation`, `email_user`) VALUES
(2, 'roule encore', 'Kia', 'neuf', 'objet', 'automobile', '2015-09-29 14:54:32', 'tesh@live.fr'),
(3, 'roule encore', 'Kia', 'neuf', 'objet', 'automobile', '2015-09-29 14:55:31', 'tesh@live.fr'),
(10, 'jsais pas', 'essai1', 'vieu', 'objet', 'velo', '2015-10-02 08:41:06', 'tesh@live.fr'),
(11, 'jsais pas', 'essai1', 'vieu', 'objet', 'velo', '2015-10-02 10:19:18', 'tesh@live.fr'),
(12, 'neuf', 'Moto', 'neuf', 'service', 'automobile', '2015-10-02 14:26:47', 'tesh@live.fr');

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE IF NOT EXISTS `commentaire` (
`id` int(20) NOT NULL,
  `contenu` text NOT NULL,
  `date` date NOT NULL,
  `id_annonce` int(10) NOT NULL,
  `email_user` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `email` varchar(40) NOT NULL COMMENT '@mail de l''user',
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `password` varchar(40) NOT NULL COMMENT 'mot de passe de l''user',
  `date_naissance` date DEFAULT NULL COMMENT 'date de naidssance de l''user',
  `telephone` varchar(6) DEFAULT NULL COMMENT 'telephone de l''user',
  `niveau` varchar(1) NOT NULL,
  `image` blob
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`email`, `nom`, `prenom`, `password`, `date_naissance`, `telephone`, `niveau`, `image`) VALUES
('', '', '', 'azer', '0000-00-00', '', '', NULL),
('johntchen@gmail.com', 'tchen', 'john', '00d70c561892a94980befd12a400e26aeb4b8599', '2015-12-12', '454545', '1', ''),
('tesh@live.fr', 'teich', 'azert', '55af2c368008102899bebf2248379e0263fa692b', '2014-02-03', '125362', '1', NULL),
('toto@live.fr', 'teich', 'azert', 'tetu', '2014-02-03', '125362', '', 0x4e554c4c);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `annonce`
--
ALTER TABLE `annonce`
 ADD PRIMARY KEY (`id`), ADD KEY `email_user` (`email_user`);

--
-- Index pour la table `commentaire`
--
ALTER TABLE `commentaire`
 ADD PRIMARY KEY (`id`), ADD KEY `id_annonce` (`id_annonce`), ADD KEY `email_user` (`email_user`), ADD KEY `id_annonce_2` (`id_annonce`,`email_user`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `annonce`
--
ALTER TABLE `annonce`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT pour la table `commentaire`
--
ALTER TABLE `commentaire`
MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `annonce`
--
ALTER TABLE `annonce`
ADD CONSTRAINT `annonce_ibfk_1` FOREIGN KEY (`email_user`) REFERENCES `user` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `commentaire`
--
ALTER TABLE `commentaire`
ADD CONSTRAINT `commentaire_ibfk_1` FOREIGN KEY (`id_annonce`) REFERENCES `annonce` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `commentaire_ibfk_2` FOREIGN KEY (`email_user`) REFERENCES `user` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
