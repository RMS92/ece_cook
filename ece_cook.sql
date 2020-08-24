-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 24 août 2020 à 16:39
-- Version du serveur :  5.7.26
-- Version de PHP :  7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `ece_cook`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `caption` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`, `title`, `caption`, `description`, `created_at`, `updated_at`, `active`) VALUES
(1, 'Air Jordan WMNS x Off-White 4 \'Sail\'', 'Although the terms flavoring and flavorant in common language denote the combined chemical sensations of taste and smell, the same terms are used in the fragrance and flavors industry to refer to edible chemicals and extracts that alter the flavor of food and food products through the sense of smell.', 'WordPress is software designed for everyone, emphasizing accessibility, performance, security, and ease of use. We believe great software should work with minimum set up, so you can focus on sharing your story, product, or services freely. The basic WordPress software is simple and predictable so you can easily get started. It also offers powerful features for growth and success.\r\n\r\nWordPress provides the opportunity for anyone to create and share, from handcrafted personal anecdotes to world-changing movements. People with a limited tech experience can use it “out of the box”, and more tech-savvy folks can customize it in remarkable ways.', '2020-08-19 18:18:43', '2020-08-23 08:49:43', 0),
(2, 'Adidas Yeezy Boost 350 V2 \'Black\'', 'Although the terms flavoring and flavorant in common language denote the combined chemical sensations of taste and smell, the same terms are used in the fragrance and flavors industry to refer to edible chemicals and extracts that alter the flavor of food and food products through the sense of smell.', 'WordPress is software designed for everyone, emphasizing accessibility, performance, security, and ease of use. We believe great software should work with minimum set up, so you can focus on sharing your story, product, or services freely. The basic WordPress software is simple and predictable so you can easily get started. It also offers powerful features for growth and success.\r\n\r\nWordPress provides the opportunity for anyone to create and share, from handcrafted personal anecdotes to world-changing movements. People with a limited tech experience can use it “out of the box”, and more tech-savvy folks can customize it in remarkable ways.', '2020-08-19 18:26:38', '2020-08-24 15:58:54', 1);

-- --------------------------------------------------------

--
-- Structure de la table `article_picture`
--

DROP TABLE IF EXISTS `article_picture`;
CREATE TABLE IF NOT EXISTS `article_picture` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_FB090B3E7294869C` (`article_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `article_picture`
--

INSERT INTO `article_picture` (`id`, `article_id`, `filename`) VALUES
(1, 1, '5f3d6d03d341a175990665.jpg'),
(2, 1, '5f3d6db815dc3917462497.jpg'),
(3, 1, '5f3d6dc5dbcb3930819575.jpg'),
(4, 2, '5f3d6ede72c34387350670.jpg'),
(5, 2, '5f3d6f12d76ea269132888.jpg'),
(6, 2, '5f3d6f219af98075461483.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `title`, `filename`, `created_at`, `updated_at`) VALUES
(1, 'Food', '5f3d71222946c025390914.jpg', '2020-08-19 08:55:22', '2020-08-19 18:36:18'),
(2, 'Seafood', '5f3d712f87f79969529692.jpg', '2020-08-19 08:55:51', '2020-08-19 18:36:31'),
(3, 'Dessert', '5f3d7215c59e1485065090.jpg', '2020-08-19 08:56:11', '2020-08-19 18:40:21'),
(4, 'Drinks', '5f3d72278dee7504250473.jpg', '2020-08-19 08:56:28', '2020-08-19 18:40:39');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20200731162158', '2020-07-31 16:22:10', 977),
('DoctrineMigrations\\Version20200731165415', '2020-07-31 16:54:37', 100),
('DoctrineMigrations\\Version20200731172434', '2020-07-31 17:24:42', 66),
('DoctrineMigrations\\Version20200731181806', '2020-07-31 18:18:33', 95),
('DoctrineMigrations\\Version20200731183605', '2020-07-31 18:36:26', 109),
('DoctrineMigrations\\Version20200801093349', '2020-08-01 09:34:02', 256),
('DoctrineMigrations\\Version20200805083223', '2020-08-05 08:32:32', 1112),
('DoctrineMigrations\\Version20200805083748', '2020-08-05 08:37:54', 144),
('DoctrineMigrations\\Version20200805161718', '2020-08-05 16:17:28', 1199),
('DoctrineMigrations\\Version20200805180348', '2020-08-05 18:14:48', 173),
('DoctrineMigrations\\Version20200806083911', '2020-08-06 08:39:19', 1237);

-- --------------------------------------------------------

--
-- Structure de la table `event`
--

DROP TABLE IF EXISTS `event`;
CREATE TABLE IF NOT EXISTS `event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `caption` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postal_code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lat` double NOT NULL,
  `lng` double NOT NULL,
  `takes_place_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `event`
--

INSERT INTO `event` (`id`, `title`, `caption`, `description`, `city`, `address`, `postal_code`, `lat`, `lng`, `takes_place_at`, `created_at`, `updated_at`, `active`) VALUES
(1, 'We Make Food', 'Although the terms flavoring and flavorant in common language denote the combined chemical sensations of taste and smell, the same terms are used in the fragrance and flavors industry to refer to edible chemicals and extracts that alter the flavor of food and food products through the sense of smell.', 'WordPress is software designed for everyone, emphasizing accessibility, performance, security, and ease of use. We believe great software should work with minimum set up, so you can focus on sharing your story, product, or services freely. The basic WordPress software is simple and predictable so you can easily get started. It also offers powerful features for growth and success.\r\n\r\nWordPress provides the opportunity for anyone to create and share, from handcrafted personal anecdotes to world-changing movements. People with a limited tech experience can use it “out of the box”, and more tech-savvy folks can customize it in remarkable ways.', 'Paris 15e Arrondissement', '75 Rue Beaugrenelle, Paris 15e Arrondissement, Île-de-France, France', '75015', 48.8476, 2.28533, '2020-09-11 17:30:00', '2020-08-19 16:15:04', '2020-08-19 16:46:11', 1),
(2, 'Best Happy Hours', 'Happy hour is a marketing term for a time when a venue offers discounts on alcoholic drinks. Free appetizers and discounted menu items are often served during happy hour. The use of the phrase “happy hour,” to refer to a scheduled period of entertainment is, however, of much more recent vintage.', 'Happy hour is a marketing term for a time when a venue offers discounts on alcoholic drinks. Free appetizers and discounted menu items are often served during happy hour. The use of the phrase “happy hour,” to refer to a scheduled period of entertainment is, however, of much more recent vintage. WordPress is software designed for everyone, emphasizing accessibility, performance, security, and ease of use. We believe great software should work with minimum set up, so you can focus on sharing your story, product, or services freely. The basic WordPress software is simple and predictable so you can easily get started. It also offers powerful features for growth and success.', 'Colmar', '24 Champ de mars, Colmar, Grand-Est, France', '68000', 48.0758, 7.35344, '2020-10-03 20:00:00', '2020-08-19 16:45:49', '2020-08-24 16:09:22', 1),
(3, 'Dinners', 'The core software is built by hundreds of community volunteers, and when you’re ready for more there are thousands of plugins and themes available to transform your site into almost anything you can imagine. The core software is built by hundreds of community volunteers, and when you’re ready for more there are', 'The core software is built by hundreds of community volunteers, and when you’re ready for more there are thousands of plugins and themes available to transform your site into almost anything you can imagine. WordPress started in 2003 with a single bit of code to enhance the typography of everyday writing and with fewer users than you can count on your fingers and toes. Since then it has grown to be the largest self-hosted blogging tool in the world, used on millions of sites and seen by tens of millions of people every day.', 'Raleigh', '75 Grenelle Street, Raleigh, North Carolina, États-Unis d\'Amérique', '27603', 35.7313, -78.6538, '2020-10-18 12:15:00', '2020-08-19 18:02:30', '2020-08-19 18:03:25', 1),
(4, 'Best Winter Coffee', 'Coffee is a brewed drink with a distinct aroma and flavor, prepared from roasted coffee beans, which are the seeds found inside “berries” of the Coffea plant.\r\n\r\nThe traditional method of planting coffee is to place 20 seeds in each hole at the beginning of the rainy season. This method loses about 50% of the seeds’ potential, as about half fail to sprout. A more effective method of growing coffee, used in Brazil, is to raise seedlings in nurseries that are then planted outside at six to twelve months.', 'Put your recipe here. Tip: use ordered and unordered lists, headings, images, and links to improve the look of your recipe. The talk took the form of mostly discussion, code tours, and demos; below are links to the examples, code, tools, and resources that were mentioned or came up in chats afterwards.\r\nPut your recipe here. Tip: use ordered and unordered lists, headings, images, and links to improve the look of your recipe. The talk took the form of mostly discussion, code tours, and demos; below are links to the examples, code, tools, and resources that were mentioned or came up in chats afterwards.', 'Fréjus', '23 Rue de la Juiverie, Fréjus, Provence-Alpes-Côte d\'Azur, France', '83600', 43.4324, 6.7362, '2020-11-10 15:15:00', '2020-08-19 18:06:28', '2020-08-19 18:06:28', 1),
(5, 'Delicious Dishes', 'The type of meal served or eaten at any given time varies by custom and location. In most modern cultures, three main meals are eaten: in the morning, early afternoon, and evening. Further, the names of meals are often interchangeable by custom as well.\r\n\r\nThis is required when, for example, the final text is not yet available. It is said that song composers of the past used dummy texts as lyrics when writing melodies in order to have a ‘ready-made’ text to sing with the melody. Dummy text is text that is used in the publishing industry or by web designers to occupy the space which will later be filled with ‘real’ content.', 'WordPress started in 2003 with a single bit of code to enhance the typography of everyday writing and with fewer users than you can count on your fingers and toes. Since then it has grown to be the largest self-hosted blogging tool in the world, used on millions of sites and seen by tens of millions of people every day.\r\n\r\nThis is required when, for example, the final text is not yet available. It is said that song composers of the past used dummy texts as lyrics when writing melodies in order to have a ‘ready-made’ text to sing with the melody. Dummy text is text that is used in the publishing industry or by web designers to occupy the space which will later be filled with ‘real’ content.', 'Fréjus', '45 Avenue de l\'Agachon, Fréjus, Provence-Alpes-Côte d\'Azur, France', '83600', 43.4383, 6.732, '2020-12-10 15:15:00', '2020-08-19 18:09:25', '2020-08-21 09:40:46', 1);

-- --------------------------------------------------------

--
-- Structure de la table `event_picture`
--

DROP TABLE IF EXISTS `event_picture`;
CREATE TABLE IF NOT EXISTS `event_picture` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) NOT NULL,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_938CE62671F7E88B` (`event_id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `event_picture`
--

INSERT INTO `event_picture` (`id`, `event_id`, `filename`) VALUES
(22, 1, '5f3d541189f47630286260.jpg'),
(23, 1, '5f3d54118b9c0016673032.jpg'),
(24, 1, '5f3d54118c6ca177635527.jpg'),
(25, 1, '5f3d54118ceba804983183.jpg'),
(26, 1, '5f3d54118d7a9490479685.jpg'),
(27, 2, '5f3d573dcdf73714023705.jpg'),
(28, 2, '5f3d573dce8a3299250804.jpg'),
(29, 2, '5f3d573dcf02d728655580.jpg'),
(30, 3, '5f3d6936e8d1d256840186.jpg'),
(31, 4, '5f3d6a250a061198603794.jpg'),
(32, 4, '5f3d6a250a90b442643456.jpg'),
(33, 4, '5f3d6a250b048750626748.jpg'),
(41, 5, '5f3f9681db5be923807986.jpg'),
(42, 5, '5f3f969e06cd1474311514.jpg'),
(43, 5, '5f3f969e076c7974500244.jpg'),
(44, 5, '5f3f969e090cf221567439.jpg'),
(45, 5, '5f3f969e0aed2851802509.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `ingredient`
--

DROP TABLE IF EXISTS `ingredient`;
CREATE TABLE IF NOT EXISTS `ingredient` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `recipe_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_6BAF787059D8A214` (`recipe_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `ingredient`
--

INSERT INTO `ingredient` (`id`, `recipe_id`, `name`) VALUES
(6, 2, '300g de riz vinaigré'),
(7, 2, '200g de saumon'),
(8, 2, '3 feuilles d\'algues séchées'),
(9, 2, 'Un peu de wasabi'),
(12, 2, 'Une natte de bambou'),
(13, 3, '3 tranches de bacon'),
(14, 3, '2 oeufs cuit à point'),
(15, 3, '200g de flocon d\'avoine'),
(16, 3, '100ml de jus d\'orange'),
(17, 4, '3 tomates'),
(18, 4, '300g de fromage rappé'),
(19, 4, '2 tranches de jambon'),
(20, 4, '1 oeuf'),
(21, 5, '5 bières'),
(22, 5, '3 tranches de saucisson'),
(23, 5, 'Un peu de vodka');

-- --------------------------------------------------------

--
-- Structure de la table `recipe`
--

DROP TABLE IF EXISTS `recipe`;
CREATE TABLE IF NOT EXISTS `recipe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `caption` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `difficulty` double NOT NULL,
  `duration` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_DA88B13712469DE2` (`category_id`),
  KEY `IDX_DA88B137F675F31B` (`author_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `recipe`
--

INSERT INTO `recipe` (`id`, `author_id`, `category_id`, `title`, `caption`, `description`, `difficulty`, `duration`, `created_at`, `updated_at`, `active`) VALUES
(2, 1, 1, 'How To Make Sushi', 'Sushi is a Japanese food consisting of cooked vinegared rice combined with other ingredients, seafood, vegetables and sometimes tropical fruits. Sushi can be prepared with either brown or white rice. Sushi is often prepared with raw seafood, but some common varieties of sushi use cooked ingredients or are vegetarian.', 'Food is any substance consumed to provide nutritional support for the body. It is usually of plant or animal origin, and contains essential nutrients, such as fats, proteins, vitamins, or minerals. The substance is ingested by an organism and assimilated by the organism’s cells to provide energy, maintain life, or stimulate growth. Sushi is a Japanese food consisting of cooked vinegared rice combined with other ingredients, seafood, vegetables and sometimes tropical fruits. Sushi can be prepared with either brown or white rice. Sushi is often prepared with raw seafood, but some common varieties of sushi use cooked ingredients or are vegetarian.', 4, 55, '2020-08-20 09:07:09', '2020-08-20 09:38:13', 1),
(3, 2, 3, '5-Minute Breakfasts', 'Breakfast is the first meal taken after rising from a night’s sleep, most often eaten in the early morning before undertaking the day’s work. The term first appeared in 997 AD, “in a Latin text from the southern Italian town of Gaeta”, in Lazio, Central Italy. The modern pizza was invented in Naples, Italy, and the dish and its variants have since become popular in many areas of the world.', 'Food is any substance consumed to provide nutritional support for the body. It is usually of plant or animal origin, and contains essential nutrients, such as fats, proteins, vitamins, or minerals. The substance is ingested by an organism and assimilated by the organism’s cells to provide energy, maintain life, or stimulate growth. Animals, specifically humans, have five different types of tastes: sweet, sour, salty, bitter, and umami. As animals have evolved, the tastes that provide the most energy (sugar and fats) are the most pleasant to eat while others, such as bitter, are not enjoyable. Water, while important for survival, has no taste. Fats, on the other hand, especially saturated fats, are thicker and rich and are thus considered more enjoyable to eat.', 3, 25, '2020-08-21 08:22:09', '2020-08-21 09:11:32', 1),
(4, 1, 1, 'Everything to know about pizza', 'Pizza is an oven-baked flat bread generally topped with tomato sauce and cheese. It is commonly supplemented with a selection of meats, vegetables and condiments. The term first appeared in 997 AD, “in a Latin text from the southern Italian town of Gaeta”, in Lazio, Central Italy. The modern pizza was invented in Naples, Italy, and the dish and its variants have since become popular in many areas of the world.', 'Food is any substance consumed to provide nutritional support for the body. It is usually of plant or animal origin, and contains essential nutrients, such as fats, proteins, vitamins, or minerals. The substance is ingested by an organism and assimilated by the organism’s cells to provide energy, maintain life, or stimulate growth. Most food has its origin in plants. Some food is obtained directly from plants; but even animals that are used as food sources are raised by feeding them food derived from plants. Cereal grain is a staple food that provides more food energy worldwide than any other type of crop. Maize, wheat, and rice – in all of their varieties – account for 87% of all grain production worldwide.', 4, 30, '2020-08-21 08:27:44', '2020-08-21 08:27:44', 1),
(5, 4, 4, 'Beer On Tap Or In A Bottle?', 'Beer is an alcoholic beverage produced by the saccharification of starch and fermentation of the resulting sugar. The starch and saccharification enzymes are often derived from malted cereal grains. The term first appeared in 997 AD, “in a Latin text from the southern Italian town of Gaeta”, in Lazio, Central Italy. The modern pizza was invented in Naples, Italy, and the dish and its variants have since become popular in many areas of the world', 'Food is any substance consumed to provide nutritional support for the body. It is usually of plant or animal origin, and contains essential nutrients, such as fats, proteins, vitamins, or minerals. The substance is ingested by an organism and assimilated by the organism’s cells to provide energy, maintain life, or stimulate growth. Most food has its origin in plants. Some food is obtained directly from plants; but even animals that are used as food sources are raised by feeding them food derived from plants. Cereal grain is a staple food that provides more food energy worldwide than any other type of crop. Maize, wheat, and rice – in all of their varieties – account for 87% of all grain production worldwide.', 5, 45, '2020-08-21 08:31:58', '2020-08-21 09:11:45', 1);

-- --------------------------------------------------------

--
-- Structure de la table `recipe_picture`
--

DROP TABLE IF EXISTS `recipe_picture`;
CREATE TABLE IF NOT EXISTS `recipe_picture` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `recipe_id` int(11) NOT NULL,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5A3F41C959D8A214` (`recipe_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `recipe_picture`
--

INSERT INTO `recipe_picture` (`id`, `recipe_id`, `filename`) VALUES
(7, 2, '5f3e3dd10f9f3834540573.jpg'),
(8, 2, '5f3e44855f5dc395061547.jpg'),
(9, 2, '5f3e44856078a147728188.jpg'),
(10, 2, '5f3e448561ba0487862217.jpg'),
(11, 2, '5f3e4485624a8716305546.jpg'),
(12, 3, '5f3f843877f58250237271.jpg'),
(14, 3, '5f3f843879dfe855937999.jpg'),
(15, 3, '5f3f84387a72d407568606.jpg'),
(18, 4, '5f3f8580ec1b6649806799.jpg'),
(19, 4, '5f3f8580ed602131308642.jpg'),
(20, 4, '5f3f8580ee029272854832.jpg'),
(24, 5, '5f3f867e66498318146783.jpg'),
(25, 5, '5f3f867e66e9d932061239.jpg'),
(26, 5, '5f3f86995d923770887354.jpg'),
(27, 5, '5f3f86995e34e612488660.jpg'),
(28, 5, '5f3f86995eb73570471588.jpg'),
(29, 3, '5f3f8aca27d12990507024.jpg'),
(30, 3, '5f3f8aca289af027401827.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `reset_password_request`
--

DROP TABLE IF EXISTS `reset_password_request`;
CREATE TABLE IF NOT EXISTS `reset_password_request` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `selector` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hashed_token` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `requested_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `expires_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_7CE748AA76ED395` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `function` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `is_verified` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`),
  UNIQUE KEY `UNIQ_8D93D649F85E0677` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `username`, `lastname`, `firstname`, `description`, `function`, `roles`, `password`, `filename`, `created_at`, `updated_at`, `is_verified`) VALUES
(1, 'rom1ain92@gmail.com', 'rms92', 'Bernard', 'Romain', 'A chef is a trained professional cook and tradesman who is proficient in all aspects of food preparation, often focusing on a particular cuisine. Chefs can receive formal training from an institution as well as by apprenticing with an experienced chef.', 'Vp Influenceur', '[\"ROLE_ADMIN\"]', '$argon2id$v=19$m=65536,t=4,p=1$MFZVbXRVT1RoTGFsVVYyMw$RWYFC3B7QAb1BFrILWnsTpU1WsvLMT/7qG7FA9XT2HI', '5f3f8b236ba69944746089.jpg', '2020-08-19 08:26:00', '2020-08-21 08:56:26', 1),
(2, 'gabriel.attal@gmail.com', 'gab75', 'Attal', 'Gabriel', 'A chef is a trained professional cook and tradesman who is proficient in all aspects of food preparation, often focusing on a particular cuisine. Chefs can receive formal training from an institution as well as by apprenticing with an experienced chef.', 'Président', '[\"ROLE_ADMIN\"]', '$argon2id$v=19$m=65536,t=4,p=1$Yng4ZlpJMURZUUVpRlNVRw$YUxpUaTN5Ix3US8JyQOK/mf4i/6k7gqHIDmz1HmzEsM', '5f3ce4b435a7f924818881.jpg', '2020-08-19 08:28:33', '2020-08-21 08:56:42', 1),
(3, 'emilien.delahegue@gmail.com', 'milou', 'Delahegue', 'Emilien', 'A chef is a trained professional cook and tradesman who is proficient in all aspects of food preparation, often focusing on a particular cuisine. Chefs can receive formal training from an institution as well as by apprenticing with an experienced chef.', 'Vp logistique', '[\"ROLE_ADMIN\"]', '$argon2id$v=19$m=65536,t=4,p=1$ZHd6RVpacmI0aGtodEVmVQ$tI6qwBmP1dAwH8Ref2GwOXVge/cIhwaA0wN82Ggd0jo', '5f3ce4bfddb50528312872.jpg', '2020-08-19 08:30:31', '2020-08-21 08:57:07', 1),
(4, 'jade.anbari@gmail.com', 'jadou', 'Anbari', 'Jade', 'A chef is a trained professional cook and tradesman who is proficient in all aspects of food preparation, often focusing on a particular cuisine. Chefs can receive formal training from an institution as well as by apprenticing with an experienced chef.', 'Vp com', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$VjYyOWxTUjJqTnVrcG9GNw$zH7AdBtLnhvcVJA3Tem49xoqngpYZd2PTSBb8WPdq2A', '5f3ce4cba1b34949522611.jpg', '2020-08-19 08:34:12', '2020-08-21 08:57:19', 1),
(7, 'louis.thivant@gmail.com', 'loulou', 'Thivant', 'Louis', NULL, NULL, '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$c0FzanZidXBmRFNnLi9xbQ$wBwn3gzvGmlrZsp+IFh0OicPrkxFYRpRiCg5KS2QQak', NULL, '2020-08-24 16:32:46', '2020-08-24 16:32:46', 1);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `article_picture`
--
ALTER TABLE `article_picture`
  ADD CONSTRAINT `FK_FB090B3E7294869C` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`);

--
-- Contraintes pour la table `event_picture`
--
ALTER TABLE `event_picture`
  ADD CONSTRAINT `FK_938CE62671F7E88B` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`);

--
-- Contraintes pour la table `ingredient`
--
ALTER TABLE `ingredient`
  ADD CONSTRAINT `FK_6BAF787059D8A214` FOREIGN KEY (`recipe_id`) REFERENCES `recipe` (`id`);

--
-- Contraintes pour la table `recipe`
--
ALTER TABLE `recipe`
  ADD CONSTRAINT `FK_DA88B13712469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `FK_DA88B137F675F31B` FOREIGN KEY (`author_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `recipe_picture`
--
ALTER TABLE `recipe_picture`
  ADD CONSTRAINT `FK_5A3F41C959D8A214` FOREIGN KEY (`recipe_id`) REFERENCES `recipe` (`id`);

--
-- Contraintes pour la table `reset_password_request`
--
ALTER TABLE `reset_password_request`
  ADD CONSTRAINT `FK_7CE748AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
