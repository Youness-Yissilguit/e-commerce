-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2021 at 02:24 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `techshopbd`
--

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `clientID` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `autori` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`clientID`, `nom`, `prenom`, `address`, `email`, `mdp`, `autori`) VALUES
(1, 'admin', 'utlime', '---', 'techshop@gmail.com', '123456', 1),
(3, 'younes', 'tissilguit', '38 LOT CASABLANCA', 'younes@gmail.com', '123456', 0),
(14, 'test', 'sdsd', 'rabat maroc', 'test@gmail.com', '123456', 0),
(15, 'ghali', 'benani', 'casablanca', 'ghali@gmail.com', '123456', 0);

-- --------------------------------------------------------

--
-- Table structure for table `commandde`
--

CREATE TABLE `commandde` (
  `clientRef` int(11) NOT NULL,
  `produitRef` int(255) NOT NULL,
  `quantite_D` varchar(255) DEFAULT NULL,
  `date_cmd` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `commandde`
--

INSERT INTO `commandde` (`clientRef`, `produitRef`, `quantite_D`, `date_cmd`) VALUES
(3, 3, '4', '2021-04-29'),
(3, 12, '1', '2021-04-29'),
(3, 1, '2', '2021-04-29'),
(14, 5, '1', '2021-04-30'),
(15, 4, '2', '2021-04-30');

-- --------------------------------------------------------

--
-- Table structure for table `produit`
--

CREATE TABLE `produit` (
  `prod_id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prix` int(6) NOT NULL,
  `libelle` varchar(255) NOT NULL,
  `note` int(1) NOT NULL,
  `categorie` varchar(255) NOT NULL,
  `stock` int(6) NOT NULL,
  `src` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produit`
--

INSERT INTO `produit` (`prod_id`, `nom`, `prix`, `libelle`, `note`, `categorie`, `stock`, `src`) VALUES
(1, 'BRIO STREAM 3', 168, 'La meilleure webcam pour la diffusion, l\'enregistrement et les appels vid??o en 4K HDR .', 1, 'Camera', 60, 'cam1'),
(2, 'AUKEY Webcam', 400, 'AUKEY Webcam 1080P Full HD avec Microphone St??r??o, Cam??ra Web pour Chat Vid??o et Enregistrement, Compatible avec Windows, Mac et Android', 1, 'Camera', 16, 'cam2'),
(3, 'Casque Apple AirPods Max', 600, ' Transducteur dynamique con??u par Apple, R??duction active du bruit, Mode Transparence, ??galisation adaptative, Audio spatial avec suivi dynamique des mouvements de la t??te ;', 4, 'Casque', 96, 'csq1'),
(4, 'Logitech G213 Prodigy', 500, 'Logitech G213 Prodigy, Clavier Gaming, Eclairage RVB LIGHTSYNC, R??sistant aux ??claboussures, Personnalisable, Commandes Multim??dia D??di??es, Clavier Fran??ais AZERTY - Noir', 1, 'Clavier', 95, 'clv1'),
(5, 'Souris Gaming Logitech G502 Hero Noir\r\n', 589, 'Capteur HERO - La souris gaming G502 poss??de notre capteur optique le plus avanc?? et le capteur HERO nouvelle g??n??ration.', 1, 'Souris', 66, 'sour1'),
(6, 'Casque Gaming HyperX Cloud', 390, 'Micro casque filaire pour : console de jeux, dispositifs ??lectroniques portables, ordinateur, Boitier de commande USB avec carte son DSP int??gr??e, Son Surround virtuel 7.', 1, 'Casque', 98, 'csq2'),
(7, 'KLIM Aim Souris Gamer RGB 7000 DPI', 450, 'KLIM Aim Souris Gamer RGB 7000 DPI - Souris Ambidextre Ergonomique RGB Chroma pour Ordinateur - Souris PS4, PC Portable et de Bureau + Souris ?? Laser Optique Haute Pr??cision - Noir', 1, 'Souris', 99, 'sour2'),
(8, 'Clavier Gaming filaire Razer', 690, 'Le clavier gamer Razer Cynosa Lite dispose de touches AZERTY avec enregistrement de macros ?? la vol??e. Choisissez parmi 16,8 millions de couleurs.', 1, 'Clavier', 99, 'clv2'),
(9, 'AverMedia Live Streamer CAM 513', 352, 'AverMedia Live Streamer CAM 513 Webcam Ultra Grand Angle 4K avec Couverture Webcam, Microphone int??gr??, Plug & Play pour Jeu, Stream, Appel vid??o ??? PW513\r\n', 1, 'Camera', 100, 'cam3'),
(10, 'Casque hi-fi ferm?? circum-aural', 344, 'Vivre en toute intimit?? une ??coute d???exception, sans craindre qu???un environnement bruyant ne perturbe ce moment de plaisir.', 1, 'Casque', 100, 'csq3'),
(11, 'FELiCON AK33', 600, 'FELiCON AK33 Clavier de Jeu m??canique c??bl??, Clavier Blanc ?? r??tro??clairage LED 82 Touches E-Sport Gamer pour dactylographes au Bureau Jouant ?? des Jeux (commutateur Bleu, Blanc)', 1, 'Clavier', 97, 'clv3'),
(12, 'Logitech Streamcam Webcam', 253, 'Logitech Streamcam Webcam avec USB-C Pour Le Streaming Et La Cr??ation De Contenu, Vid??o Verticale Full HD 1080p, Double Fixation De La Cam??ra, pour YouTube, Gaming Twitch, PC/Mac - Noir', 1, 'Camera', 100, 'cam4'),
(13, 'Casque audio Focal Celestee', 845, 'Casque ferm?? haut de gamme, fabriqu?? en France par focal, pour un usage domestique et nomade.Design, mat??riaux nobles et finitions Navy Blue, avec des d??tails en Soft Copper.', 1, 'Casque', 100, 'csq4'),
(14, 'Souris sans fil Logitech M220 Silent Noir', 844, 'Connexion sans fil ?? 2.4 GHz, Port??e sans fil: 10 m??tres, Autonomie: 18 mois, Roulette de d??filement: Oui, 2D, optique, Boutons standard et sp??ciaux: Clic central\r\n', 1, 'Souris', 100, 'sour3'),
(15, 'Corsair K68 Red LED ', 142, 'Corsair K68 Red LED Clavier M??canique Gaming (Cherry MX Red: Lisse et rapide, R??tro-??clairage Rouge, ??tanche et R??sistant ?? la Poussi??re, AZERTY FR Layout) - Noir', 1, 'Clavier', 100, 'clv4'),
(16, 'Souris Logitech M236 Argent', 242, 'Simple ?? installer, efficace cette petite souris se manie du bout des doigts. Elle est parfaite pour une utilisation de tous les jours en bureautique et internet.', 1, 'Souris', 100, 'sour4');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`clientID`);

--
-- Indexes for table `commandde`
--
ALTER TABLE `commandde`
  ADD KEY `fk_com_pro` (`produitRef`);

--
-- Indexes for table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`prod_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `clientID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `produit`
--
ALTER TABLE `produit`
  MODIFY `prod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
