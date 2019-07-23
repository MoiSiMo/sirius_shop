-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  mar. 23 juil. 2019 à 11:46
-- Version du serveur :  10.3.16-MariaDB
-- Version de PHP :  7.1.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `stocks`
--

-- --------------------------------------------------------

--
-- Structure de la table `t_achatsproduits`
--

CREATE TABLE `t_achatsproduits` (
  `NumAchProd` int(11) NOT NULL,
  `NumProd` int(11) NOT NULL,
  `QteAch` int(11) NOT NULL,
  `PrixUnitAch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `T_Categories`
--

CREATE TABLE `T_Categories` (
  `NumCat` int(11) NOT NULL,
  `NomCat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `T_Categories`
--

INSERT INTO `T_Categories` (`NumCat`, `NomCat`) VALUES
(1, 'Pièces informatique'),
(2, 'Périphérique PC'),
(3, 'Ordinateur portable'),
(4, 'Ordinateur de bureau'),
(5, 'Tablette'),
(6, 'Réseau'),
(7, 'Logiciels');

-- --------------------------------------------------------

--
-- Structure de la table `t_clients`
--

CREATE TABLE `t_clients` (
  `NumCli` int(11) NOT NULL,
  `NomCli` varchar(50) NOT NULL,
  `PreCli` varchar(50) NOT NULL,
  `AdrCli` varchar(100) NOT NULL,
  `VilleCli` varchar(50) NOT NULL,
  `CdePosCli` int(11) NOT NULL,
  `TelFixCli` varchar(50) NOT NULL,
  `TelPorCli` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `t_factures`
--

CREATE TABLE `t_factures` (
  `NumListFact` int(11) NOT NULL,
  `NumCli` int(11) NOT NULL,
  `NumFact` int(11) NOT NULL,
  `DateFact` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `t_fournisseurs`
--

CREATE TABLE `t_fournisseurs` (
  `NumFour` int(11) NOT NULL,
  `NomFour` varchar(50) NOT NULL,
  `AdrFour` varchar(100) NOT NULL,
  `CdePostFour` int(11) NOT NULL,
  `VilleFour` varchar(50) NOT NULL,
  `TelFixFour` varchar(50) NOT NULL,
  `TelFixFour2` varchar(50) NOT NULL,
  `FaxFour` varchar(50) NOT NULL,
  `EmailFour` varchar(50) NOT NULL,
  `SiteFour` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_fournisseurs`
--

INSERT INTO `t_fournisseurs` (`NumFour`, `NomFour`, `AdrFour`, `CdePostFour`, `VilleFour`, `TelFixFour`, `TelFixFour2`, `FaxFour`, `EmailFour`, `SiteFour`) VALUES
(1, 'Techno', 'Rue d\'Assaut 11', 1000, 'Bruxelles', '025131482', '025133706', '', 'techno-buro@skynet', 'www.technoburo.be'),
(2, 'Lacroix S', 'Avenue des Courtils 9', 4684, 'Haccourt', '043792201', '', '', 'Lacroix.s@skynet.be', 'www.lacroixserge.be'),
(3, 'Marcel Hees Bureautique', 'Rue Trappe 9', 4000, 'Liege', '042208830', '', '042235806', 'admin@hees-bureautique.be', 'www.hees-bureautique.be');

-- --------------------------------------------------------

--
-- Structure de la table `t_produits`
--

CREATE TABLE `t_produits` (
  `NumProd` int(11) NOT NULL,
  `NumFour` int(11) NOT NULL,
  `NomProd` varchar(50) NOT NULL,
  `NumSCat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_produits`
--

INSERT INTO `t_produits` (`NumProd`, `NumFour`, `NomProd`, `NumSCat`) VALUES
(1, 1, 'Zalman i3', 1),
(2, 2, 'Cooler Master MasterBox Q300L', 1),
(3, 1, 'Zalman i3', 1),
(4, 2, 'Cooler Master MasterBox Q300L', 1);

-- --------------------------------------------------------

--
-- Structure de la table `T_s_Categories`
--

CREATE TABLE `T_s_Categories` (
  `NumSCat` int(11) NOT NULL,
  `NomSCat` varchar(50) NOT NULL,
  `NumCat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `T_s_Categories`
--

INSERT INTO `T_s_Categories` (`NumSCat`, `NomSCat`, `NumCat`) VALUES
(1, 'Boîtier', 1),
(2, 'Alimentation PC', 1),
(3, 'Disque dur & SSD', 1),
(4, 'Carte mère', 1),
(5, 'Cartes graphique', 1),
(6, 'Mémoire', 1),
(7, 'Processeur', 1),
(8, 'Refroidissement PC', 1),
(9, 'Lecteur graveur', 1),
(10, 'Carte contrôleur', 1),
(11, 'Carte son', 1),
(12, 'Tuning PC', 1),
(13, 'TV & Acquisition', 1),
(14, 'Carte réseau', 1);

-- --------------------------------------------------------

--
-- Structure de la table `t_ventesproduits`
--

CREATE TABLE `t_ventesproduits` (
  `NumVenProd` int(11) NOT NULL,
  `NumLisFact` int(11) NOT NULL,
  `NumProd` int(11) NOT NULL,
  `NumCli` int(11) NOT NULL,
  `NumAchProd` int(11) NOT NULL,
  `PrixVenUnit` int(11) NOT NULL,
  `TauxTva` int(11) NOT NULL,
  `QteVen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `t_achatsproduits`
--
ALTER TABLE `t_achatsproduits`
  ADD PRIMARY KEY (`NumAchProd`),
  ADD UNIQUE KEY `NumAchProd` (`NumAchProd`),
  ADD KEY `NumProd` (`NumProd`);

--
-- Index pour la table `T_Categories`
--
ALTER TABLE `T_Categories`
  ADD PRIMARY KEY (`NumCat`),
  ADD UNIQUE KEY `NumCat` (`NumCat`);

--
-- Index pour la table `t_clients`
--
ALTER TABLE `t_clients`
  ADD PRIMARY KEY (`NumCli`),
  ADD UNIQUE KEY `NumCli` (`NumCli`);

--
-- Index pour la table `t_factures`
--
ALTER TABLE `t_factures`
  ADD PRIMARY KEY (`NumListFact`),
  ADD UNIQUE KEY `NumListFact` (`NumListFact`),
  ADD KEY `NumCli` (`NumCli`);

--
-- Index pour la table `t_fournisseurs`
--
ALTER TABLE `t_fournisseurs`
  ADD PRIMARY KEY (`NumFour`),
  ADD UNIQUE KEY `NumFour` (`NumFour`);

--
-- Index pour la table `t_produits`
--
ALTER TABLE `t_produits`
  ADD PRIMARY KEY (`NumProd`),
  ADD UNIQUE KEY `NumProd` (`NumProd`),
  ADD KEY `NumFour` (`NumFour`),
  ADD KEY `NumSCat` (`NumSCat`);

--
-- Index pour la table `T_s_Categories`
--
ALTER TABLE `T_s_Categories`
  ADD PRIMARY KEY (`NumSCat`),
  ADD UNIQUE KEY `NumSCat` (`NumSCat`),
  ADD KEY `NumCat` (`NumCat`);

--
-- Index pour la table `t_ventesproduits`
--
ALTER TABLE `t_ventesproduits`
  ADD PRIMARY KEY (`NumVenProd`),
  ADD KEY `NumLisFact` (`NumLisFact`),
  ADD KEY `NumAchProd` (`NumAchProd`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `t_achatsproduits`
--
ALTER TABLE `t_achatsproduits`
  MODIFY `NumAchProd` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `T_Categories`
--
ALTER TABLE `T_Categories`
  MODIFY `NumCat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `t_clients`
--
ALTER TABLE `t_clients`
  MODIFY `NumCli` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `t_factures`
--
ALTER TABLE `t_factures`
  MODIFY `NumListFact` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `t_fournisseurs`
--
ALTER TABLE `t_fournisseurs`
  MODIFY `NumFour` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `t_produits`
--
ALTER TABLE `t_produits`
  MODIFY `NumProd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `T_s_Categories`
--
ALTER TABLE `T_s_Categories`
  MODIFY `NumSCat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `t_ventesproduits`
--
ALTER TABLE `t_ventesproduits`
  MODIFY `NumVenProd` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `t_achatsproduits`
--
ALTER TABLE `t_achatsproduits`
  ADD CONSTRAINT `t_achatsproduits_ibfk_1` FOREIGN KEY (`NumProd`) REFERENCES `t_produits` (`NumProd`);

--
-- Contraintes pour la table `t_factures`
--
ALTER TABLE `t_factures`
  ADD CONSTRAINT `t_factures_ibfk_1` FOREIGN KEY (`NumCli`) REFERENCES `t_clients` (`NumCli`);

--
-- Contraintes pour la table `t_produits`
--
ALTER TABLE `t_produits`
  ADD CONSTRAINT `t_produits_ibfk_1` FOREIGN KEY (`NumFour`) REFERENCES `t_fournisseurs` (`NumFour`),
  ADD CONSTRAINT `t_produits_ibfk_2` FOREIGN KEY (`NumSCat`) REFERENCES `T_s_Categories` (`NumSCat`);

--
-- Contraintes pour la table `T_s_Categories`
--
ALTER TABLE `T_s_Categories`
  ADD CONSTRAINT `t_s_categories_ibfk_1` FOREIGN KEY (`NumCat`) REFERENCES `T_Categories` (`NumCat`);

--
-- Contraintes pour la table `t_ventesproduits`
--
ALTER TABLE `t_ventesproduits`
  ADD CONSTRAINT `t_ventesproduits_ibfk_1` FOREIGN KEY (`NumLisFact`) REFERENCES `t_factures` (`NumListFact`),
  ADD CONSTRAINT `t_ventesproduits_ibfk_2` FOREIGN KEY (`NumAchProd`) REFERENCES `t_achatsproduits` (`NumAchProd`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
