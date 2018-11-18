-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Mer 11 Avril 2018 à 14:34
-- Version du serveur :  10.1.26-MariaDB-0+deb9u1
-- Version de PHP :  7.0.27-0+deb9u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `prj_android_s4`
--

-- --------------------------------------------------------

--
-- Structure de la table `est_ami_de`
--

CREATE TABLE `est_ami_de` (
  `NumUtilisateur` int(11) NOT NULL,
  `NumUtilisateur_1` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `est_ami_de`
--

INSERT INTO `est_ami_de` (`NumUtilisateur`, `NumUtilisateur_1`) VALUES
(1, 2),
(1, 22),
(1, 37),
(1, 39),
(2, 24),
(21, 23),
(23, 2);

-- --------------------------------------------------------

--
-- Structure de la table `Evenement`
--

CREATE TABLE `Evenement` (
  `NumEvenement` int(11) NOT NULL,
  `NomEvenement` varchar(100) DEFAULT NULL,
  `DateEvenement` date DEFAULT NULL,
  `HeureEvenement` time DEFAULT NULL,
  `CapaciteEvenement` int(11) DEFAULT NULL,
  `NumUtilisateur` int(11) DEFAULT NULL,
  `NumTypeEvenement` int(11) DEFAULT NULL,
  `IdLocalisation` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `Evenement`
--

INSERT INTO `Evenement` (`NumEvenement`, `NomEvenement`, `DateEvenement`, `HeureEvenement`, `CapaciteEvenement`, `NumUtilisateur`, `NumTypeEvenement`, `IdLocalisation`) VALUES
(1, 'soiree tour eiffel', '2018-03-06', '15:30:00', 20, 1, 22, 2),
(7, 'event1', '2018-09-24', '00:00:00', 15, 1, 5, 26),
(8, 'event2', '2018-09-24', '00:00:00', 15, 1, 5, 27),
(9, 'event3', '2018-09-24', '00:00:00', 15, 1, 5, 28),
(10, 'event4', '2018-09-24', '00:00:00', 15, 1, 5, 29),
(44, 'eventTestDelete', '2019-11-15', '15:15:35', 50, 2, 8, 68),
(48, 'event12', '2019-11-15', '15:15:35', 50, 2, 8, 72),
(50, 'test', '0000-00-00', '04:03:02', 0, 1, 1, 86),
(51, '', '0000-00-00', '04:04:44', 0, 1, 1, 87),
(52, 'aa', '0000-00-00', '04:15:46', 0, 1, 6, 88),
(53, 'wwwww', '0000-00-00', '04:37:49', 0, 1, 6, 89),
(54, 'mmdeir', '0000-00-00', '21:38:42', 0, 1, 19, 90),
(55, 'hdhdhg', '0000-00-00', '14:57:57', 0, 1, 1, 92),
(56, 'tuktuk', '0000-00-00', '02:57:12', 0, 1, 10, 95),
(57, 'teteet9tdfgggttt', '0000-00-00', '08:22:37', 0, 43, 1, 97),
(58, 'vyjgyuguffydtdtdtdrdrdr', '0000-00-00', '08:35:12', 0, 43, 1, 98),
(59, 'Jeremy_jvais_tenculer', '0000-00-00', '03:11:31', 0, 1, 4, 102),
(60, 'Rko', '0000-00-00', '03:13:45', 0, 1, 1, 103),
(61, 'trash', '0000-00-00', '01:39:49', 0, 1, 15, 104),
(62, 'noon\n', '0000-00-00', '01:47:22', 0, 1, 21, 105),
(63, 'fzegzegzegz', '0000-00-00', '02:02:57', 0, 1, 17, 106),
(64, 'vvvvv', '0000-00-00', '02:03:25', 0, 1, 1, 107),
(65, 'asdad\n', '0000-00-00', '08:02:27', 0, 44, 11, 109),
(66, '11111', '0000-00-00', '08:16:41', 0, 44, 1, 110),
(67, 'gsgrwher', '0000-00-00', '20:49:06', 0, 1, 10, 111),
(68, 'suchEvent', '0000-00-00', '20:50:15', 0, 1, 1, 112),
(69, 'zzzzzzzzzzzzzzzz', '0000-00-00', '20:51:38', 0, 1, 1, 113),
(70, 'qwerty', '0000-00-00', '20:53:48', 0, 1, 5, 114),
(71, 'suchBretagne', '0000-00-00', '20:57:42', 0, 1, 1, 115),
(72, 'ttttt', '0000-00-00', '20:59:36', 0, 1, 15, 116),
(73, 'thinking', '0000-00-00', '21:04:25', 0, 1, 4, 117),
(74, 'Yuuug', '0000-00-00', '12:02:27', 0, 1, 1, 118),
(76, 'hhhhhhhhh', '0000-00-00', '04:47:53', 0, 1, 1, 120),
(77, 'SoireeMoussante', '0000-00-00', '05:24:56', 0, 1, 22, 121);

-- --------------------------------------------------------

--
-- Structure de la table `EvenementJO`
--

CREATE TABLE `EvenementJO` (
  `DateEvenementJO` date DEFAULT NULL,
  `HeureEvenementJO` time DEFAULT NULL,
  `IdLocalisationJO` int(11) DEFAULT NULL,
  `NomEvenementJO` varchar(100) DEFAULT NULL,
  `NumTypeEvenementJO` int(11) DEFAULT NULL,
  `NumEvenementJO` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `EvenementJO`
--

INSERT INTO `EvenementJO` (`DateEvenementJO`, `HeureEvenementJO`, `IdLocalisationJO`, `NomEvenementJO`, `NumTypeEvenementJO`, `NumEvenementJO`) VALUES
('2018-09-24', '22:30:00', 44, 'Mddeir first KO', 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `Localisation`
--

CREATE TABLE `Localisation` (
  `IdLocalisation` int(11) NOT NULL,
  `longitude` double DEFAULT NULL,
  `latitude` double DEFAULT NULL,
  `CommentaireLieu` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `Localisation`
--

INSERT INTO `Localisation` (`IdLocalisation`, `longitude`, `latitude`, `CommentaireLieu`) VALUES
(1, -122.084, 37.4219983, 'Tour Eiffel'),
(2, 2.2945, 48.8599614, 'Musée d\'Orsay'),
(18, 2.222, 2.22222, NULL),
(19, 14.55748848, 12.31222222, NULL),
(20, 20, 20, 'testDelete'),
(21, 14.55748848, 12.31222222, NULL),
(22, 2.2945, 2.2945, 'Chez moi'),
(23, 2.2945, 2.2945, ''),
(24, 2.2945, 2.2945, ''),
(25, 17.8883, 45.325, 'oui et non mmdeir'),
(26, 17.8883, 45.325, 'oui et non mmdeir'),
(27, 17.8883, 45.325, 'oui et non mmdeir'),
(28, 17.8883, 45.325, 'oui et non mmdeir'),
(29, 17.8883, 45.325, 'oui et non mmdeir'),
(30, 17.8883, 45.325, 'oui et non mmdeir'),
(31, 17.8883, 45.325, 'oui et non mmdeir'),
(33, 2.2945, 2.2945, ''),
(34, 17.8883, 45.325, 'oui et non mmdeir'),
(35, 1756616, 45.2255, 'lebron'),
(36, 1756616, 45.2255, 'lebron'),
(37, 1756616, 45.2255, 'lebron'),
(38, 1756616, 45.2255, 'lebron'),
(39, 1756616, 45.2255, 'lebron'),
(40, 1756616, 45.2255, 'lebron'),
(41, 1756616, 45.2255, 'lebron'),
(42, 1756616, 45.2255, 'Football'),
(43, 1756616, 45.2255, 'Football'),
(44, 17.56616, 45.2255, 'Football1'),
(45, 1756616, 45.2255, 'Football'),
(46, 1756616, 45.2255, 'Football'),
(47, 1756616, 45.2255, 'Football'),
(48, 1756616, 45.2255, 'Football'),
(49, 1756616, 45.2255, 'Football'),
(50, 1756616, 45.2255, 'mmdeir balek '),
(51, 1756616, 45.2255, 'mmdeir balek '),
(52, 3.33333, 3.33333, NULL),
(53, 5.65, 1.25, 'com 50'),
(54, 5.65, 1.25, 'com 50'),
(55, 5.65, 1.25, 'com 50'),
(56, 14.55748848, 12.31222222, NULL),
(57, 14.55748848, 12.31222222, NULL),
(58, 14.55748848, 12.31222222, NULL),
(59, 5.65, 1.25, 'com 50'),
(60, 5.65, 1.25, 'com 50'),
(61, 5.65, 1.25, 'com 50'),
(62, 14.55, 12.312224456, NULL),
(63, 5.65, 1.25, 'com 50'),
(66, 5.65, 1.25, 'com 50'),
(68, 5.65, 1.25, 'com 50'),
(69, 5.65, 1.25, 'com 50'),
(70, 5.65, 1.25, 'com 50'),
(72, 5.65, 1.25, 'com 50'),
(73, 14.55, 12.312224456, NULL),
(74, 0, 0, NULL),
(75, 12.6566, 2.235565, NULL),
(76, 0, 0, NULL),
(77, 0, 0, NULL),
(78, 0, 0, NULL),
(79, 0, 0, NULL),
(80, 0, 0, NULL),
(81, 0, 0, NULL),
(82, 0, 0, NULL),
(83, 0, 0, NULL),
(84, 0, 0, NULL),
(85, 0, 0, ''),
(86, 0, 0, 'tezgrherhehe'),
(87, 0, 0, 'aa'),
(88, 0, 0, 'aa'),
(89, 0, 0, 'wwwwwww'),
(90, 0, 0, 'mmdeir'),
(91, 0, 0, NULL),
(92, 0, 0, 'xhxhdhd'),
(93, 0, 0, NULL),
(94, 0, 0, NULL),
(95, 0, 0, 'ttutu'),
(96, -122.084, 37.4219983, NULL),
(97, 0, 0, 'gttrrrrhyjuhy);lwc kjncgtpx%uoct9hn;to%i blvgnruid'),
(98, 0, 0, 'trjtjetjrtjrtjrj'),
(99, 0, 0, 'Fait pas le fou jeremy'),
(100, 0, 0, 'Fait pas le fou jeremy'),
(101, 0, 0, 'Fait pas le fou jeremy'),
(102, 0, 0, 'Test mort jeremy'),
(103, 0, 0, 'Wola'),
(104, 0, 0, 'non'),
(105, 0, 0, 'wwwwww'),
(106, 0, 0, 'egegegegeg'),
(107, 0, 0, 'sfsdfsfds'),
(108, -122.084, 37.4219983, NULL),
(109, 0, 0, 'asdada\n'),
(110, 0, 0, 'qwe'),
(111, 37, 37, 'test\n'),
(112, 37, 37, 'eeee'),
(113, 39, 39, 'ff'),
(114, 49, 49, 'q'),
(115, 1, 49, 'wegwegw'),
(116, -122, 37, 'q'),
(117, 3.057256, 50.62925, 'hi'),
(118, 2.3001888, 48.8264801, 'Ig'),
(120, -122.08399609375, 37.4219975, ''),
(121, -122.08399609375, 37.4219975, '');

-- --------------------------------------------------------

--
-- Structure de la table `Participe_a`
--

CREATE TABLE `Participe_a` (
  `NumUtilisateur` int(11) NOT NULL,
  `NumEvenement` int(11) NOT NULL,
  `NomEvenement` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `Participe_a`
--

INSERT INTO `Participe_a` (`NumUtilisateur`, `NumEvenement`, `NomEvenement`) VALUES
(1, 1, 'soiree tour eiffel'),
(1, 7, 'event1'),
(1, 8, 'event2'),
(1, 48, 'event12'),
(1, 60, 'Rko'),
(2, 1, 'Mddeir first KO'),
(2, 9, 'event3'),
(19, 9, 'event3'),
(20, 1, 'Mddeir first KO'),
(25, 44, 'eventTestDelete'),
(26, 9, 'event3'),
(27, 9, 'event3');

-- --------------------------------------------------------

--
-- Structure de la table `TypeEvenement`
--

CREATE TABLE `TypeEvenement` (
  `NumTypeEvenement` int(11) NOT NULL,
  `NomTypeEvenement` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `TypeEvenement`
--

INSERT INTO `TypeEvenement` (`NumTypeEvenement`, `NomTypeEvenement`) VALUES
(1, 'Athlétisme'),
(2, 'Badminton'),
(3, 'BasketBall'),
(4, 'Boxe'),
(5, 'Cyclisme sur piste'),
(6, 'Escrime'),
(7, 'Football'),
(8, 'Gymnastique'),
(9, 'HandBall'),
(10, 'Judo'),
(11, 'Hockey'),
(12, 'Natation'),
(13, 'Rugby'),
(14, 'Tennis'),
(15, 'Tennis de table'),
(16, 'VolleyBall'),
(17, 'Water-Polo'),
(18, 'Remise de médailles'),
(19, 'Criterium'),
(20, 'Ouverture'),
(21, 'Fermeture et remise des coupes'),
(22, 'Autre');

-- --------------------------------------------------------

--
-- Structure de la table `Utilisateur`
--

CREATE TABLE `Utilisateur` (
  `NumUtilisateur` int(11) NOT NULL,
  `Pseudo` varchar(100) DEFAULT NULL,
  `MDPUtilisateur` varchar(100) DEFAULT NULL,
  `MailUtilisateur` varchar(100) DEFAULT NULL,
  `Commentaire` varchar(200) DEFAULT NULL,
  `IdLocalisation` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `Utilisateur`
--

INSERT INTO `Utilisateur` (`NumUtilisateur`, `Pseudo`, `MDPUtilisateur`, `MailUtilisateur`, `Commentaire`, `IdLocalisation`) VALUES
(1, 'test', 'test', 'test@test.fr', 'testCommentaire', 1),
(2, 'test2', 'test2', 'test2@test.fr', 'test2Commentaire', 18),
(19, 'pseudo', 'mdpasse', 'mail', 'commentaire', 41),
(20, 'pseudo2', 'mdpasse2', 'mail2', 'commentaire2', 19),
(21, 'pseudo3', 'mdpasse3', 'mail3', 'commentaire2', 20),
(22, 'pseudo4', 'mdpasse4', 'mail4', 'commentaire2', 21),
(23, 'pseudo5', 'mdpasse10', 'mail10', 'commentaire2', 52),
(24, 'pseudo6', 'mdpasse55', 'mail11', 'commentaire2', 56),
(25, 'pseudo7', 'mdpasse4531', 'mail515', 'commentaire2', 57),
(26, 'pseudo65', 'mdpasse99', 'mail99', 'commentaire7', 58),
(27, 'pseudoMdeir', 'mmdeirmdp', 'mmdeir', 'commentairoraj', 62),
(28, 'pseudoMdeir', 'mmdeirmdp', 'mmdeirDEUX', 'commentairoraj', 73),
(29, 'pseudoMdeir', 'mmdeirmdp', 'testLOCVIDE', 'commentairoraj', 74),
(30, 'aa', 'aa', 'aa', 'erher', 75),
(31, 'bb', 'bb', 'bb', '', 76),
(32, 'ccc', 'cccc', 'ccc', '', 77),
(33, 'thrtjr', 'erhjtjet', 'tjrtjrtjrtj', '', 78),
(34, 'aaaa', 'aaaa', 'aaaa', '', 79),
(35, 'zzz', 'zzz', 'zzz', '', 80),
(36, 'aaa', 'mmdeir', 'allah.allah@orange.fr', '', 81),
(37, 'Liece ', 'wola', 'Liece886@gmail.com', '', 82),
(38, 'toto', 'wty123456', 'toto@gamil.com', '', 83),
(39, 'testazerty', 'test', 'test@testazerty.fr', '', 84),
(40, 'hfjfvfjf', 'aaaaa', 'bfkdnd@test.fr', '', 91),
(41, 'gazegzz', 'zegzeg', 'egzegz@test.fr', '', 93),
(42, 'fdnrene', 'aaaa', 'zrgerherheh@tzehr.fr', '', 94),
(43, 'tyryrr', 'ee', 'gegeehhe@ft.fr', '', 96),
(44, 'wty', 'wty123456', 'tianyu.wang97@gmail.com', '', 108);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `est_ami_de`
--
ALTER TABLE `est_ami_de`
  ADD PRIMARY KEY (`NumUtilisateur`,`NumUtilisateur_1`),
  ADD KEY `FK_est_ami_de_NumUtilisateur_1` (`NumUtilisateur_1`);

--
-- Index pour la table `Evenement`
--
ALTER TABLE `Evenement`
  ADD PRIMARY KEY (`NumEvenement`),
  ADD KEY `FK_Evenement_NumUtilisateur` (`NumUtilisateur`),
  ADD KEY `FK_Evenement_NumTypeEvenement` (`NumTypeEvenement`),
  ADD KEY `FK_LocUserEvent` (`IdLocalisation`);

--
-- Index pour la table `EvenementJO`
--
ALTER TABLE `EvenementJO`
  ADD PRIMARY KEY (`NumEvenementJO`),
  ADD KEY `NumTypeEvenement` (`NumTypeEvenementJO`),
  ADD KEY `FK_LocJO` (`IdLocalisationJO`);

--
-- Index pour la table `Localisation`
--
ALTER TABLE `Localisation`
  ADD PRIMARY KEY (`IdLocalisation`);

--
-- Index pour la table `Participe_a`
--
ALTER TABLE `Participe_a`
  ADD PRIMARY KEY (`NumUtilisateur`,`NumEvenement`),
  ADD KEY `FK_Participe_a_NumEvenement` (`NumEvenement`);

--
-- Index pour la table `TypeEvenement`
--
ALTER TABLE `TypeEvenement`
  ADD PRIMARY KEY (`NumTypeEvenement`);

--
-- Index pour la table `Utilisateur`
--
ALTER TABLE `Utilisateur`
  ADD PRIMARY KEY (`NumUtilisateur`),
  ADD KEY `FK_IdLoc` (`IdLocalisation`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `Evenement`
--
ALTER TABLE `Evenement`
  MODIFY `NumEvenement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;
--
-- AUTO_INCREMENT pour la table `EvenementJO`
--
ALTER TABLE `EvenementJO`
  MODIFY `NumEvenementJO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `Localisation`
--
ALTER TABLE `Localisation`
  MODIFY `IdLocalisation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;
--
-- AUTO_INCREMENT pour la table `TypeEvenement`
--
ALTER TABLE `TypeEvenement`
  MODIFY `NumTypeEvenement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT pour la table `Utilisateur`
--
ALTER TABLE `Utilisateur`
  MODIFY `NumUtilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `est_ami_de`
--
ALTER TABLE `est_ami_de`
  ADD CONSTRAINT `FK_est_ami_de_NumUtilisateur` FOREIGN KEY (`NumUtilisateur`) REFERENCES `Utilisateur` (`NumUtilisateur`),
  ADD CONSTRAINT `FK_est_ami_de_NumUtilisateur_1` FOREIGN KEY (`NumUtilisateur_1`) REFERENCES `Utilisateur` (`NumUtilisateur`);

--
-- Contraintes pour la table `Evenement`
--
ALTER TABLE `Evenement`
  ADD CONSTRAINT `FK_Evenement_NumTypeEvenement` FOREIGN KEY (`NumTypeEvenement`) REFERENCES `TypeEvenement` (`NumTypeEvenement`),
  ADD CONSTRAINT `FK_Evenement_NumUtilisateur` FOREIGN KEY (`NumUtilisateur`) REFERENCES `Utilisateur` (`NumUtilisateur`),
  ADD CONSTRAINT `FK_LocUserEvent` FOREIGN KEY (`IdLocalisation`) REFERENCES `Localisation` (`IdLocalisation`);

--
-- Contraintes pour la table `EvenementJO`
--
ALTER TABLE `EvenementJO`
  ADD CONSTRAINT `EvenementJO_ibfk_1` FOREIGN KEY (`NumTypeEvenementJO`) REFERENCES `TypeEvenement` (`NumTypeEvenement`),
  ADD CONSTRAINT `FK_LocJO` FOREIGN KEY (`IdLocalisationJO`) REFERENCES `Localisation` (`IdLocalisation`) ON DELETE CASCADE;

--
-- Contraintes pour la table `Participe_a`
--
ALTER TABLE `Participe_a`
  ADD CONSTRAINT `FK_Participe_a_NumEvenement` FOREIGN KEY (`NumEvenement`) REFERENCES `Evenement` (`NumEvenement`),
  ADD CONSTRAINT `FK_Participe_a_NumUtilisateur` FOREIGN KEY (`NumUtilisateur`) REFERENCES `Utilisateur` (`NumUtilisateur`);

--
-- Contraintes pour la table `Utilisateur`
--
ALTER TABLE `Utilisateur`
  ADD CONSTRAINT `FK_IdLoc` FOREIGN KEY (`IdLocalisation`) REFERENCES `Localisation` (`IdLocalisation`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
