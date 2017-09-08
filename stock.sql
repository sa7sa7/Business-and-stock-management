-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2016 at 02:51 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `stock`
--

-- --------------------------------------------------------

--
-- Table structure for table `categorie`
--

CREATE TABLE IF NOT EXISTS `categorie` (
  `id_categorie` int(11) NOT NULL AUTO_INCREMENT,
  `nom_categorie` varchar(50) NOT NULL,
  `description_categorie` varchar(256) NOT NULL,
  `image_categorie` varchar(50) NOT NULL,
  PRIMARY KEY (`id_categorie`),
  UNIQUE KEY `nom_categorie` (`nom_categorie`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `categorie`
--

INSERT INTO `categorie` (`id_categorie`, `nom_categorie`, `description_categorie`, `image_categorie`) VALUES
(8, 'ok', 'ok', 'ok'),
(9, 'aa', 'aa', 'aa');

-- --------------------------------------------------------

--
-- Table structure for table `commande`
--

CREATE TABLE IF NOT EXISTS `commande` (
  `id_commande` int(11) NOT NULL AUTO_INCREMENT,
  `fournisseur_commande` int(11) NOT NULL,
  `produit_commande` int(11) NOT NULL,
  `date_commande` datetime NOT NULL,
  `quantite_commande` int(11) NOT NULL,
  `user_commande` int(11) NOT NULL,
  `etat_commande` varchar(30) NOT NULL,
  PRIMARY KEY (`id_commande`),
  KEY `fournisseur` (`fournisseur_commande`,`produit_commande`,`user_commande`),
  KEY `user_commande` (`user_commande`),
  KEY `produit` (`produit_commande`),
  KEY `fournisseur_2` (`fournisseur_commande`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `commande`
--

INSERT INTO `commande` (`id_commande`, `fournisseur_commande`, `produit_commande`, `date_commande`, `quantite_commande`, `user_commande`, `etat_commande`) VALUES
(1, 5, 8, '2016-04-29 14:00:16', 77, 1, 'non_achevé');

-- --------------------------------------------------------

--
-- Table structure for table `entrepot`
--

CREATE TABLE IF NOT EXISTS `entrepot` (
  `id_entrepot` int(11) NOT NULL AUTO_INCREMENT,
  `nom_entrepot` varchar(30) NOT NULL,
  `addresse_entrepot` varchar(256) NOT NULL,
  PRIMARY KEY (`id_entrepot`),
  UNIQUE KEY `nom_entrepot` (`nom_entrepot`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `entrepot`
--

INSERT INTO `entrepot` (`id_entrepot`, `nom_entrepot`, `addresse_entrepot`) VALUES
(1, 'aa', 'yyhh'),
(3, 'dda', 'ddaa');

-- --------------------------------------------------------

--
-- Table structure for table `fournisseur`
--

CREATE TABLE IF NOT EXISTS `fournisseur` (
  `id_fournisseur` int(30) NOT NULL AUTO_INCREMENT,
  `nom_fournisseur` varchar(30) NOT NULL,
  `addresse_fournisseur` varchar(256) NOT NULL,
  `num_tel_fournisseur` varchar(30) NOT NULL,
  PRIMARY KEY (`id_fournisseur`),
  UNIQUE KEY `nom_fournisseur` (`nom_fournisseur`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `fournisseur`
--

INSERT INTO `fournisseur` (`id_fournisseur`, `nom_fournisseur`, `addresse_fournisseur`, `num_tel_fournisseur`) VALUES
(3, 'eee', 'eejj', 'eeee'),
(5, 'ee', 'ee', 'eee'),
(6, 'et', 'et', '++++++++'),
(7, 'hh', 'hh', 'hh'),
(21, 'fourn1', 'adr1', 'tel1');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `id_menu` int(2) NOT NULL AUTO_INCREMENT,
  `id_menu_parent` int(30) NOT NULL DEFAULT '0',
  `nom` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `lien` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_menu`),
  UNIQUE KEY `nom` (`nom`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=37 ;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id_menu`, `id_menu_parent`, `nom`, `lien`) VALUES
(1, 0, 'Gérer Les Profils', NULL),
(2, 1, 'Ajouter un Profil', 'profil'),
(3, 1, 'Supprimer un Profil', 'profil/supprimerprofil'),
(4, 1, 'Modifier un Profil', 'profil/modifierprofil'),
(5, 1, 'Modifier les Droits d''Accès', 'profil/modifierdroitacces'),
(6, 0, 'Gérer Les Menu', NULL),
(7, 6, 'Ajouter un Menu', 'menu'),
(8, 6, 'Supprimer un Menu', 'menu/supprimermenu'),
(9, 6, 'Modifier un Menu', 'menu/modifiermenu'),
(10, 0, 'Gérer Les Comptes des Utilisateurs', NULL),
(11, 10, 'Ajouter un Compte', 'user'),
(12, 10, 'Supprimer un Compte', 'user/supprimeruser'),
(13, 10, 'Modifier un Compte', 'user/modifieruser'),
(14, 0, 'Gérer Les Fournisseur', NULL),
(15, 14, 'Ajouter un Fournisseur', 'fournisseur'),
(16, 14, 'Supprimer un Fournisseur', 'fournisseur/supprimerfournisseur'),
(17, 14, 'Modifier un Fournisseur', 'fournisseur/modifierfournisseur'),
(18, 0, 'Gérer Les Catégorie', NULL),
(19, 18, 'Ajouter une Catégorie', 'categorie'),
(20, 18, 'Supprimer une Catégorie', 'categorie/supprimercategorie'),
(21, 18, 'Modifier une Catégorie', 'categorie/modifiercategorie'),
(22, 0, 'Gérer Les Entrepots', NULL),
(23, 22, 'Ajouter un Entrepot', 'entrepot'),
(24, 22, 'Supprimer un Entrepot', 'entrepot/supprimerentrepot'),
(25, 22, 'Modifier un Entrepot', 'entrepot/modifierentrepot'),
(26, 0, 'Gérer Les Produits', NULL),
(27, 26, 'Ajouter un Produit', 'produit'),
(28, 26, 'Supprimer un Produit', 'produit/supprimerproduit'),
(29, 26, 'Modifier un Produit', 'produit/modifierproduit'),
(30, 0, 'Gérer Le Stock', NULL),
(31, 30, 'Liste des Produits', 'stock'),
(32, 30, 'Consulter l''Historique', 'stock/consulterhistorique'),
(33, 0, 'Gérer Les Commandes', NULL),
(34, 33, 'Ajouter une Commande', 'commande'),
(35, 33, 'Supprimer une Commande', 'commande\\supprimercommande'),
(36, 33, 'Modifier une Commade', 'commande\\modifiercommande');

-- --------------------------------------------------------

--
-- Table structure for table `permission menu profil`
--

CREATE TABLE IF NOT EXISTS `permission menu profil` (
  `id_menu` int(2) NOT NULL,
  `id_profil` int(2) NOT NULL,
  PRIMARY KEY (`id_menu`,`id_profil`),
  KEY `fk_permission_menu_profil__profil` (`id_profil`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `permission menu profil`
--

INSERT INTO `permission menu profil` (`id_menu`, `id_profil`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(1, 3),
(2, 3),
(3, 3),
(4, 3),
(5, 3),
(6, 3),
(7, 3),
(8, 3),
(9, 3),
(10, 3),
(11, 3),
(12, 3),
(13, 3),
(14, 3),
(15, 3),
(16, 3),
(17, 3),
(18, 3),
(19, 3),
(20, 3),
(21, 3),
(22, 3),
(23, 3),
(24, 3),
(25, 3),
(26, 3),
(27, 3),
(28, 3),
(29, 3),
(30, 3),
(31, 3);

-- --------------------------------------------------------

--
-- Table structure for table `produit`
--

CREATE TABLE IF NOT EXISTS `produit` (
  `id_produit` int(11) NOT NULL AUTO_INCREMENT,
  `nom_produit` varchar(30) NOT NULL,
  `code_produit` varchar(30) NOT NULL,
  `categorie_produit` int(11) NOT NULL,
  `prix_achat_produit` int(11) NOT NULL,
  `stock_minimal_produit` int(11) NOT NULL,
  `quantite_total_produit` int(11) NOT NULL,
  PRIMARY KEY (`id_produit`),
  UNIQUE KEY `nom_produit` (`nom_produit`,`code_produit`),
  KEY `categorie_produit` (`categorie_produit`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `produit`
--

INSERT INTO `produit` (`id_produit`, `nom_produit`, `code_produit`, `categorie_produit`, `prix_achat_produit`, `stock_minimal_produit`, `quantite_total_produit`) VALUES
(7, 'ok', 'ok', 8, 77, 77, 447038),
(8, 'kk', '7788', 9, 77, 77, 565),
(10, 'zzz', 'ttt', 8, 77, 77, 8066),
(11, 'pc', '1213154', 8, 121, 44, 0);

-- --------------------------------------------------------

--
-- Table structure for table `profil`
--

CREATE TABLE IF NOT EXISTS `profil` (
  `id_profil` int(2) NOT NULL AUTO_INCREMENT,
  `nom` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_profil`),
  UNIQUE KEY `nom` (`nom`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `profil`
--

INSERT INTO `profil` (`id_profil`, `nom`) VALUES
(3, 'aaaa'),
(1, 'Admin'),
(4, 'test'),
(5, 'test1'),
(6, 'test2'),
(2, 'zdaza');

-- --------------------------------------------------------

--
-- Table structure for table `repartition_produit`
--

CREATE TABLE IF NOT EXISTS `repartition_produit` (
  `produit` int(11) NOT NULL,
  `entrepot` int(11) NOT NULL,
  `quantite_reel` int(11) NOT NULL,
  `quantite_theorique` int(11) NOT NULL,
  PRIMARY KEY (`produit`,`entrepot`),
  KEY `produit` (`produit`,`entrepot`),
  KEY `entrepot` (`entrepot`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `repartition_produit`
--

INSERT INTO `repartition_produit` (`produit`, `entrepot`, `quantite_reel`, `quantite_theorique`) VALUES
(7, 1, 854, 0),
(7, 3, 344, 0),
(8, 1, 110, 0),
(8, 3, -13, 0),
(10, 1, 7989, 0),
(10, 3, 77, 0);

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE IF NOT EXISTS `stock` (
  `id_stock` int(11) NOT NULL AUTO_INCREMENT,
  `produit_stock` int(11) NOT NULL,
  `entrepot_stock` int(11) NOT NULL,
  `date_stock` date NOT NULL,
  `quantite_stock` int(11) NOT NULL,
  `user_stock` int(11) NOT NULL,
  `type_mouvement_stock` varchar(30) NOT NULL,
  `type_sortie_stock` varchar(30) NOT NULL,
  PRIMARY KEY (`id_stock`),
  KEY `produit_stock` (`produit_stock`,`entrepot_stock`,`user_stock`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`id_stock`, `produit_stock`, `entrepot_stock`, `date_stock`, `quantite_stock`, `user_stock`, `type_mouvement_stock`, `type_sortie_stock`) VALUES
(1, 8, 1, '0000-00-00', 4, 1, 'approvisionnement', '0'),
(2, 8, 3, '0000-00-00', 4, 1, 'approvisionnement', '0'),
(3, 8, 1, '0000-00-00', 2, 1, 'approvisionnement', '0'),
(4, 8, 1, '0000-00-00', 22, 1, 'approvisionnement', '0'),
(5, 8, 1, '0000-00-00', 77, 1, 'approvisionnement', '0'),
(6, 8, 3, '0000-00-00', 5, 1, 'approvisionnement', '0'),
(7, 8, 1, '0000-00-00', 1, 1, 'approvisionnement', '0'),
(8, 8, 1, '0000-00-00', 1, 1, 'approvisionnement', '0'),
(9, 7, 1, '2012-07-01', 777, 1, 'approvisionnement', '0'),
(10, 7, 3, '2012-07-01', 111, 1, 'approvisionnement', '0'),
(11, 8, 1, '2012-07-01', 3, 1, 'approvisionnement', '0'),
(12, 8, 3, '2012-07-01', 3, 1, 'approvisionnement', '0'),
(13, 10, 3, '2012-07-01', 77, 1, 'approvisionnement', '0'),
(14, 10, 1, '2012-07-01', 112, 1, 'approvisionnement', '0'),
(15, 10, 1, '2012-07-01', 7777, 1, 'approvisionnement', '0'),
(16, 10, 1, '2012-07-01', 1, 1, 'approvisionnement', '0'),
(17, 10, 1, '2012-07-01', 22, 1, 'approvisionnement', '0'),
(18, 10, 1, '2012-07-01', 77, 1, 'approvisionnement', '0'),
(19, 7, 1, '2012-07-01', 77, 1, 'approvisionnement', '0'),
(20, 7, 3, '2012-07-01', 11, 1, 'approvisionnement', '0'),
(21, 7, 3, '2012-07-01', 222, 1, 'approvisionnement', '0'),
(22, 8, 1, '2016-04-27', 112, 1, 'approvisionnement', '0'),
(23, 8, 1, '2016-04-27', 11, 1, 'sortie', 'vente'),
(24, 8, 3, '2016-04-27', 20, 1, 'sortie', 'probleme');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(2) NOT NULL AUTO_INCREMENT,
  `id_profil` int(2) NOT NULL,
  `login` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `nom` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `login` (`login`),
  KEY `fk_user_profil` (`id_profil`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `id_profil`, `login`, `password`, `nom`, `prenom`, `image`) VALUES
(1, 1, 'a', 'a', 'A', 'A', 'image.png'),
(4, 1, 'b', 'b', 'b', 'b', NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `permission menu profil`
--
ALTER TABLE `permission menu profil`
  ADD CONSTRAINT `fk_permission_menu_profil__menu` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id_menu`),
  ADD CONSTRAINT `fk_permission_menu_profil__profil` FOREIGN KEY (`id_profil`) REFERENCES `profil` (`id_profil`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_profil` FOREIGN KEY (`id_profil`) REFERENCES `profil` (`id_profil`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
