-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 10, 2023 at 09:04 AM
-- Server version: 5.7.24
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my_recipes`
--

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `recipe_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `recipe_id`) VALUES
(22, 15, 5),
(18, 15, 14),
(26, 15, 22),
(30, 15, 102),
(29, 15, 114),
(28, 15, 115),
(38, 15, 120),
(23, 16, 5),
(24, 16, 14),
(25, 16, 94),
(40, 16, 101),
(39, 16, 117),
(33, 17, 101),
(32, 17, 113),
(34, 17, 114),
(31, 17, 115),
(35, 17, 117);

-- --------------------------------------------------------

--
-- Table structure for table `recipes`
--

CREATE TABLE `recipes` (
  `id` int(11) NOT NULL,
  `user_id` int(10) NOT NULL,
  `title` varchar(128) NOT NULL,
  `recipe` text NOT NULL,
  `author` varchar(512) NOT NULL,
  `image` blob
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `recipes`
--

INSERT INTO `recipes` (`id`, `user_id`, `title`, `recipe`, `author`, `image`) VALUES
(101, 15, 'Almond Apple Pie', '9 cl. Amaretto\r\n1,5 cl. Vodka\r\nUne pincée de cannelle\r\nJus de pomme très frais', 'Morgane', NULL),
(3, 15, 'Ginger Fire', '6 cl. Rhum ambré \r\n4,5 cl. Rhum blanc \r\n3 cl. Jus d\'ananas \r\n3 cl. Jus de pamplemousse \r\nGinger ale (Canady Dry)\r\n', 'Morgane', NULL),
(120, 17, 'Piña Colada', '4 cl. Rhum blanc\r\n2 cl. Rhum ambré\r\n10 cl. Jus d\'ananas\r\n6 cl. Crème de coco\r\nOption :  Lait concentré', 'Arthur', 0x70696e615f636f6c6164612e706e67),
(116, 15, 'Ginger in the breeze', '6 cl. Rhum blanc\r\n1,5 cl. Liqueur de cerise\r\n12 cl. Jus d\'orange frais\r\nGinger ale (Canada Dry)', 'Morgane', 0x67696e6765725f696e5f7468655f627265657a652e706e67),
(117, 15, 'Mojito', '4 cl. Rhum blanc\r\n2 cl. Sirop de canne\r\n1/2 citron vert\r\n8 feuilles de menthe fraîche\r\nEau gazeuse & Glace pilée', 'Morgane', 0x6d6f6a69746f2e706e67),
(113, 16, 'Mimosa', '8 cl. Champagne\r\n4 cl. jus d\'orange\r\n1 cl. Grand Marnier', 'Anna', 0x6d696d6f73612e706e67),
(114, 16, 'Kir royal', '9 cl. Champagne\r\n2 cl. Crème de cassis', 'Anna', 0x6b69725f726f79616c2e706e67),
(115, 16, 'Soupe champenoise', '1 bouteille de Champagne\r\n1 louche de Cointreau\r\n1 louche de jus de citron\r\n1 louche de sirop de canne', 'Anna', 0x736f7570655f6368616d70656e6f6973652e706e67),
(133, 16, 'La Sorel', 'Vodka\r\nPurée de fruits rouges\r\nCrème de pêche\r\nFeuilles de menthe fraîche\r\nProsecco', 'Anna', 0x736f72656c2e706e67);

-- --------------------------------------------------------

--
-- Table structure for table `recipes_tags`
--

CREATE TABLE `recipes_tags` (
  `id` int(10) NOT NULL,
  `recipe_id` int(10) NOT NULL,
  `tag_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `recipes_tags`
--

INSERT INTO `recipes_tags` (`id`, `recipe_id`, `tag_id`) VALUES
(419, 1, 30),
(420, 1, 47),
(421, 1, 52),
(422, 1, 65),
(423, 1, 68),
(424, 2, 30),
(425, 2, 57),
(426, 3, 43),
(427, 3, 52),
(428, 3, 60),
(429, 3, 69),
(430, 5, 43),
(431, 5, 47),
(432, 5, 52),
(433, 5, 63),
(434, 5, 68),
(435, 14, 35),
(436, 22, 52),
(437, 22, 67),
(443, 94, 38),
(444, 94, 64),
(445, 101, 30),
(446, 101, 57),
(447, 101, 75),
(448, 102, 50),
(449, 102, 70),
(450, 112, 35),
(451, 112, 68),
(452, 113, 35),
(453, 113, 68),
(454, 114, 35),
(455, 115, 38),
(456, 115, 64),
(457, 116, 43),
(458, 116, 47),
(459, 116, 52),
(460, 116, 63),
(461, 116, 68),
(462, 117, 52),
(463, 117, 64),
(464, 117, 67),
(465, 120, 52),
(466, 120, 60),
(467, 120, 78),
(468, 121, 52),
(469, 121, 60),
(470, 121, 78),
(471, 122, 52),
(472, 122, 60),
(473, 122, 78),
(474, 123, 52),
(475, 123, 60),
(476, 123, 78),
(477, 131, 50),
(478, 131, 67),
(479, 131, 70),
(480, 132, 50),
(481, 132, 67),
(482, 132, 70),
(483, 133, 50),
(484, 133, 67),
(485, 133, 70);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(10) NOT NULL,
  `label` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `label`, `type`) VALUES
(30, 'Amaretto', 'Alcool'),
(31, 'Aperol', 'Alcool'),
(32, 'Armagnac', 'Alcool'),
(33, 'Baileys', 'Alcool'),
(34, 'Bière', 'Alcool'),
(35, 'Champagne', 'Alcool'),
(36, 'Cidre', 'Alcool'),
(37, 'Coco', 'Alcool'),
(38, 'Cointreau', 'Alcool'),
(39, 'Cognac', 'Alcool'),
(40, 'Crémant', 'Alcool'),
(41, 'Curaçao', 'Alcool'),
(42, 'Floc', 'Alcool'),
(43, 'Gin', 'Alcool'),
(44, 'Jagermeister', 'Alcool'),
(45, 'Kahlua', 'Alcool'),
(46, 'Limoncello', 'Alcool'),
(48, 'Malibu', 'Alcool'),
(49, 'Porto', 'Alcool'),
(50, 'Prosecco', 'Alcool'),
(51, 'Ricard', 'Alcool'),
(52, 'Rhum', 'Alcool'),
(53, 'Saké', 'Alcool'),
(54, 'Sangria', 'Alcool'),
(55, 'Tequila', 'Alcool'),
(56, 'Vin', 'Alcool'),
(57, 'Vodka', 'Alcool'),
(58, 'Whisky', 'Alcool'),
(59, 'abricot', 'Jus'),
(60, 'ananas', 'Jus'),
(61, 'banane', 'Jus'),
(62, 'canneberge', 'Jus'),
(63, 'cerise', 'Jus'),
(64, 'citron', 'Autre'),
(65, 'fraise', 'Jus'),
(66, 'ginger', 'Autre'),
(67, 'menthe', 'Autre'),
(68, 'orange', 'Jus'),
(69, 'pamplemousse', 'Jus'),
(70, 'pêche', 'Jus'),
(71, 'poire', 'Jus'),
(72, 'raisin', 'Jus'),
(73, 'tomate', 'Jus'),
(74, 'sirop', 'Autre'),
(75, 'pomme', 'Jus'),
(77, 'cannelle', 'Autre'),
(78, 'coco', 'Alcool'),
(79, 'cassis', 'Alcool');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_name` varchar(64) NOT NULL,
  `email` varchar(512) NOT NULL,
  `password` varchar(512) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_name`, `email`, `password`) VALUES
(17, 'Arthur', 'arthur@gmail.com', '68830aef4dbfad181162f9251a1da51b'),
(16, 'Anna', 'anna@gmail.com', 'a70f9e38ff015afaa9ab0aacabee2e13'),
(15, 'Morgane', 'm.lepineutter@gmail.com', '098f6bcd4621d373cade4e832627b4f6');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `recipe_id_user_id_unique_idx` (`user_id`,`recipe_id`) USING BTREE;

--
-- Indexes for table `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recipes_tags`
--
ALTER TABLE `recipes_tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `recipe_id_tag_id_unique_idx` (`recipe_id`,`tag_id`) USING BTREE;

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT for table `recipes_tags`
--
ALTER TABLE `recipes_tags`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=486;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
