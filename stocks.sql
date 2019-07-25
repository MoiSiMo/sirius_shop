-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  jeu. 25 juil. 2019 à 06:15
-- Version du serveur :  10.1.38-MariaDB
-- Version de PHP :  7.3.4

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

--
-- Déchargement des données de la table `t_achatsproduits`
--

INSERT INTO `t_achatsproduits` (`NumAchProd`, `NumProd`, `QteAch`, `PrixUnitAch`) VALUES
(1, 5, 10, 80),
(2, 2, 5, 100),
(3, 4, 15, 120),
(4, 6, 20, 130);

-- --------------------------------------------------------

--
-- Structure de la table `t_categories`
--

CREATE TABLE `t_categories` (
  `NumCat` int(11) NOT NULL,
  `NomCat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_categories`
--

INSERT INTO `t_categories` (`NumCat`, `NomCat`) VALUES
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
  `AdrCli` varchar(100) NOT NULL,
  `VilleCli` varchar(50) NOT NULL,
  `CdePosCli` varchar(50) NOT NULL,
  `TelFixCli` varchar(50) NOT NULL,
  `TelPorCli` varchar(50) NOT NULL,
  `NumTVA` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_clients`
--

INSERT INTO `t_clients` (`NumCli`, `NomCli`, `AdrCli`, `VilleCli`, `CdePosCli`, `TelFixCli`, `TelPorCli`, `NumTVA`) VALUES
(1, 'Spitaels Rene', 'Rue de Thys 37', 'Marche-en-Famenne', '6900', '084214209', '', ''),
(2, 'Quisquater Muriel', 'Rue de Pondire 24A\r\n', 'Ciney', '5590', ' 083 21 77 75', '0478 97 67 55', ''),
(3, 'Lepage Stephane', 'Route de Cortil-Wodon 33', 'Eghezée', '5310', '081512138', '', ''),
(4, 'Eraly Marc', 'Berkenboslaan 4\r\n', 'Tremelo', '3120', '', '0496869645', ''),
(5, 'Jean Voets, Dhr.', 'Baversstraat 41', 'Tongres', '3700', '012230583', '', ''),
(6, 'Lion Laurence', 'Rue de Leuze 31', 'Beloeil', '7972', ' 069 55 33 58', '0498 57 04 21', '');

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

--
-- Déchargement des données de la table `t_factures`
--

INSERT INTO `t_factures` (`NumListFact`, `NumCli`, `NumFact`, `DateFact`) VALUES
(1, 5, 1907190001, '2019-07-19'),
(2, 4, 1907010002, '2019-07-01'),
(3, 6, 1907150003, '2019-07-15'),
(4, 3, 190710004, '2019-07-10');

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
(3, 'Marcel Hees Bureautique', 'Rue Trappe 9', 4000, 'Liege', '042208830', '', '042235806', 'admin@hees-bureautique.be', 'www.hees-bureautique.be'),
(4, 'Lister Genius', 'Avenue Georges Henri', 1200, 'Woluwe-Saint-Lambert', '023473597', '081980098', '', 'listergenis@skype.be', 'www.mistergenius.be');

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
(4, 2, 'Cooler Master MasterBox Q300L', 1),
(5, 2, 'Cooler Master MasterBox E500L Argent', 1),
(6, 3, 'Cooler Master MasterCase H500', 1),
(7, 1, 'Corsair Builder Series VS450 80PLUS V2', 2),
(8, 2, 'Corsair Builder Series VS550 80PLUS V2', 2),
(9, 3, 'Corsair Builder Series VS650 80PLUS V2', 2),
(10, 2, 'Corsair RM650x V2 80PLUS Gold', 2),
(11, 3, 'Seagate BarraCuda 2 To (ST2000DM008)', 3),
(12, 1, 'Seagate BarraCuda 1 To (ST1000DM010)', 3),
(13, 3, 'Samsung SSD 860 QVO 1 To', 3),
(14, 1, 'Samsung SSD 860 EVO 500 Go', 3);

-- --------------------------------------------------------

--
-- Structure de la table `t_s_categories`
--

CREATE TABLE `t_s_categories` (
  `NumSCat` int(11) NOT NULL,
  `NomSCat` varchar(50) NOT NULL,
  `NumCat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_s_categories`
--

INSERT INTO `t_s_categories` (`NumSCat`, `NomSCat`, `NumCat`) VALUES
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
-- Déchargement des données de la table `t_ventesproduits`
--

INSERT INTO `t_ventesproduits` (`NumVenProd`, `NumLisFact`, `NumProd`, `NumCli`, `NumAchProd`, `PrixVenUnit`, `TauxTva`, `QteVen`) VALUES
(1, 1, 5, 5, 1, 100, 21, 1),
(2, 2, 2, 4, 2, 120, 21, 1),
(3, 3, 4, 6, 3, 140, 21, 1),
(4, 4, 6, 3, 4, 150, 21, 1);

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
-- Index pour la table `t_categories`
--
ALTER TABLE `t_categories`
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
-- Index pour la table `t_s_categories`
--
ALTER TABLE `t_s_categories`
  ADD PRIMARY KEY (`NumSCat`),
  ADD UNIQUE KEY `NumSCat` (`NumSCat`),
  ADD KEY `NumCat` (`NumCat`);

--
-- Index pour la table `t_ventesproduits`
--
ALTER TABLE `t_ventesproduits`
  ADD PRIMARY KEY (`NumVenProd`),
  ADD KEY `NumLisFact` (`NumLisFact`),
  ADD KEY `NumAchProd` (`NumAchProd`),
  ADD KEY `NumCli` (`NumCli`),
  ADD KEY `NumProd` (`NumProd`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `t_achatsproduits`
--
ALTER TABLE `t_achatsproduits`
  MODIFY `NumAchProd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `t_categories`
--
ALTER TABLE `t_categories`
  MODIFY `NumCat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `t_clients`
--
ALTER TABLE `t_clients`
  MODIFY `NumCli` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `t_factures`
--
ALTER TABLE `t_factures`
  MODIFY `NumListFact` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `t_fournisseurs`
--
ALTER TABLE `t_fournisseurs`
  MODIFY `NumFour` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `t_produits`
--
ALTER TABLE `t_produits`
  MODIFY `NumProd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `t_s_categories`
--
ALTER TABLE `t_s_categories`
  MODIFY `NumSCat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `t_ventesproduits`
--
ALTER TABLE `t_ventesproduits`
  MODIFY `NumVenProd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  ADD CONSTRAINT `t_produits_ibfk_2` FOREIGN KEY (`NumSCat`) REFERENCES `t_s_categories` (`NumSCat`);

--
-- Contraintes pour la table `t_s_categories`
--
ALTER TABLE `t_s_categories`
  ADD CONSTRAINT `t_s_categories_ibfk_1` FOREIGN KEY (`NumCat`) REFERENCES `t_categories` (`NumCat`);

--
-- Contraintes pour la table `t_ventesproduits`
--
ALTER TABLE `t_ventesproduits`
  ADD CONSTRAINT `t_ventesproduits_ibfk_1` FOREIGN KEY (`NumLisFact`) REFERENCES `t_factures` (`NumListFact`),
  ADD CONSTRAINT `t_ventesproduits_ibfk_2` FOREIGN KEY (`NumAchProd`) REFERENCES `t_achatsproduits` (`NumAchProd`),
  ADD CONSTRAINT `t_ventesproduits_ibfk_3` FOREIGN KEY (`NumCli`) REFERENCES `t_clients` (`NumCli`),
  ADD CONSTRAINT `t_ventesproduits_ibfk_4` FOREIGN KEY (`NumProd`) REFERENCES `t_produits` (`NumProd`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
