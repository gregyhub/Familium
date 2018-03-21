-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mer. 21 mars 2018 à 17:48
-- Version du serveur :  10.1.28-MariaDB
-- Version de PHP :  7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `familium`
--

-- --------------------------------------------------------

--
-- Structure de la table `album`
--

CREATE TABLE `album` (
  `id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dateupdate` datetime NOT NULL,
  `visibility` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `album`
--

INSERT INTO `album` (`id`, `author_id`, `title`, `dateupdate`, `visibility`) VALUES
(1, 4, 'Mes vacances 2017', '2018-03-21 10:49:51', 'public'),
(2, 2, 'Mon Bébé d\'amour', '2018-03-21 11:04:30', 'public');

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`) VALUES
(1),
(2),
(3);

-- --------------------------------------------------------

--
-- Structure de la table `birth`
--

CREATE TABLE `birth` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gender` enum('m','f') COLLATE utf8_unicode_ci DEFAULT NULL,
  `weight` double DEFAULT NULL,
  `height` double DEFAULT NULL,
  `birthdate` date NOT NULL,
  `birthhour` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `birth`
--

INSERT INTO `birth` (`id`, `firstname`, `gender`, `weight`, `height`, `birthdate`, `birthhour`) VALUES
(4, 'Liza', 'f', 3.45, 45, '2017-12-25', '00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Anecdote'),
(5, 'Annonce'),
(2, 'Bon plan'),
(7, 'décès'),
(3, 'Evenement'),
(8, 'Histoire de famille'),
(6, 'Mariage'),
(4, 'Naissance'),
(9, 'News');

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `datecomment` datetime NOT NULL,
  `comment` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id`, `author_id`, `article_id`, `datecomment`, `comment`) VALUES
(1, 3, 1, '2018-03-21 10:43:47', 'Super !!!!\r\nMerci à toi Greg, et bienvenue à tous !'),
(2, 2, 2, '2018-03-21 11:02:32', 'Mauris ut rhoncus odio. Vestibulum vel commodo lacus, imperdiet mollis velit. Vivamus placerat facilisis diam quis aliquam. Pellentesque pellentesque ultrices iaculis. Donec pellentesque sem vel mi sagittis mollis ut id justo. Cras maximus dictum tortor at blandit. Nunc facilisis sapien nec neque congue maximus. Duis ut ex vitae mi laoreet tristique ut efficitur sapien. Sed at accumsan felis. Aenean id nibh mauris. Integer odio nisl, ullamcorper vel neque in, bibendum viverra nisl. Quisque blandit dapibus leo a porttitor. Nam pharetra ullamcorper iaculis.'),
(3, 2, 3, '2018-03-21 11:11:22', 'Tres belle histoire Maiwenn !'),
(4, 2, 1, '2018-03-21 11:14:27', 'Bravo à tous pour le travail réalisé !'),
(5, 5, 4, '2018-03-21 12:44:18', 'Tres belle ta Liza !!\r\nFélicitations !!!!!'),
(6, 5, 3, '2018-03-21 12:44:42', 'J\'adore !!\r\nEncore d\'autres histoires comme ça !');

-- --------------------------------------------------------

--
-- Structure de la table `event`
--

CREATE TABLE `event` (
  `id` int(11) NOT NULL,
  `localisation` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dateevent` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `event`
--

INSERT INTO `event` (`id`, `localisation`, `dateevent`) VALUES
(5, '101 AVENUE LA FRATERNITE 75000 PARIS', '2018-03-25');

-- --------------------------------------------------------

--
-- Structure de la table `messaging`
--

CREATE TABLE `messaging` (
  `id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `recipient_id` int(11) NOT NULL,
  `date_message` datetime NOT NULL,
  `message` longtext COLLATE utf8_unicode_ci NOT NULL,
  `newmessage` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `messaging`
--

INSERT INTO `messaging` (`id`, `author_id`, `recipient_id`, `date_message`, `message`, `newmessage`) VALUES
(1, 3, 1, '2018-03-21 10:45:08', '<p>Salut Greg !</p>\r\n\r\n<p>donne moi ton Github s&#39;il te plait !</p>', 'old'),
(2, 1, 3, '2018-03-21 10:58:28', '<p>Bien sur Walid,</p>\r\n\r\n<p>voila le lien : www.github.com/gregyhub<br />\r\n___________________________________________________<br />\r\nle 2018-03-21 10:45:08, Walid ISMIEL &agrave; &eacute;crit :</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Salut Greg !</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>donne moi ton Github s&#39;il te plait !</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>', 'new'),
(3, 2, 7, '2018-03-21 11:06:52', '<p>Salut Maiwenn,<br />\r\ntu veux venir manger &agrave; la maison avec ma femme et moi ?&nbsp;<br />\r\nnous serions ravis de te recevoir !</p>', 'old'),
(4, 7, 2, '2018-03-21 11:08:58', '<p>Bonjour mon cher Hamid,</p>\r\n\r\n<p>Oui avec plaisir !<br />\r\nQuand veux tu que je vienne ?<br />\r\n___________________________________________________<br />\r\nle 2018-03-21 11:06:52, Hamid KEZZAL &agrave; &eacute;crit :</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Salut Maiwenn,<br />\r\n<br />\r\ntu veux venir manger &agrave; la maison avec ma femme et moi ?&nbsp;<br />\r\n<br />\r\nnous serions ravis de te recevoir !</p>\r\n\r\n<p>&nbsp;</p>', 'old'),
(5, 2, 7, '2018-03-21 11:11:50', '<p>disons jeudi 22 mars &agrave; 19h ??<br />\r\n___________________________________________________<br />\r\nle 2018-03-21 11:08:58, Maiwenn VALLEE &agrave; &eacute;crit :</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Bonjour mon cher Hamid,</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Oui avec plaisir !<br />\r\n<br />\r\nQuand veux tu que je vienne ?<br />\r\n<br />\r\n___________________________________________________<br />\r\n<br />\r\nle 2018-03-21 11:06:52, Hamid KEZZAL &agrave; &eacute;crit :</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Salut Maiwenn,<br />\r\n<br />\r\n<br />\r\n<br />\r\ntu veux venir manger &agrave; la maison avec ma femme et moi ?&nbsp;<br />\r\n<br />\r\n<br />\r\n<br />\r\nnous serions ravis de te recevoir !</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>', 'new'),
(6, 5, 6, '2018-03-21 12:47:23', '<p>Salut Capucine,</p>\r\n\r\n<p>Mauris a felis a ipsum scelerisque elementum. Nunc quis finibus magna. Vestibulum convallis tincidunt ante, a tincidunt tellus euismod sit amet. Cras pulvinar tortor diam, eget porttitor urna fringilla eu. Sed vel hendrerit ligula. Donec eget <a href=\"http://www.google.com\">google</a></p>\r\n\r\n<p>Fusce dapibus, nisl at posuere luctus, est tortor ultricies justo, sed egestas tellus quam nec odio. Donec ultrices vehicula arcu, a facilisis nulla faucibus non. Nam ut erat eget urna egestas efficitur. Praesent vitae ex sodales, vulputate nulla ac, porttitor ex. Etiam ullamcorper massa purus, in pretium nibh cursus vitae. Pellentesque nec turpis vel turpis ultricies luctus. Proin ex odio, volutpat eu risus quis, euismod scelerisque sem. Aenean mollis dui neque, sed aliquet mauris porttitor non. Fusce vel iaculis quam, a rutrum eros. Nulla congue ante vel condimentum posuere.</p>', 'new'),
(7, 1, 10, '2018-03-21 16:54:46', '<p><strong>Coucou mon amour</strong><br />\r\nJe t&#39;aimeuuuuu</p>', 'new');

-- --------------------------------------------------------

--
-- Structure de la table `photo`
--

CREATE TABLE `photo` (
  `id` int(11) NOT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `photo`
--

INSERT INTO `photo` (`id`, `photo`) VALUES
(1, '5ab22b0b1f532.jpeg'),
(2, '5ab22b31141c7.jpeg'),
(3, '5ab22b394899e.jpeg'),
(4, '5ab22b4016d45.jpeg'),
(5, '5ab22c33aba57.jpeg'),
(6, '5ab22e3d47528.jpeg'),
(7, '5ab22e43f0bf0.jpeg'),
(8, '5ab22e4a785a9.jpeg'),
(9, '5ab22e534e9ee.jpeg'),
(10, '5ab22e5966595.jpeg');

-- --------------------------------------------------------

--
-- Structure de la table `photo_album`
--

CREATE TABLE `photo_album` (
  `photo_id` int(11) NOT NULL,
  `album_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `photo_album`
--

INSERT INTO `photo_album` (`photo_id`, `album_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 2),
(7, 2),
(8, 2),
(9, 2),
(10, 2);

-- --------------------------------------------------------

--
-- Structure de la table `super_article`
--

CREATE TABLE `super_article` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `datearticle` datetime NOT NULL,
  `picture` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `discriminator_column` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `super_article`
--

INSERT INTO `super_article` (`id`, `category_id`, `author_id`, `title`, `content`, `datearticle`, `picture`, `discriminator_column`) VALUES
(1, 5, 1, 'Bienvenue sur FAMILIUM', '<p>Bonjour &agrave; toute la <strong>famille</strong>&nbsp;et bienvenue sur FAMILIUM !!</p>\r\n\r\n<p>Familium est un r&eacute;seau priv&eacute; <strong>rien que pour nous</strong> !!</p>\r\n\r\n<p>Via Familium nous pouvons :</p>\r\n\r\n<ul>\r\n	<li>R&eacute;diger des articles sur la famille</li>\r\n	<li>Organiser des evenement</li>\r\n	<li>annoncer des naissances</li>\r\n	<li>Partager des albums photos</li>\r\n	<li>nous &eacute;crire via une mesagerie priv&eacute;e.</li>\r\n</ul>\r\n\r\n<p>Il reste beaucoup &agrave; accomplir sur le site, mais les &eacute;volutions seront apport&eacute;es ulterieurement.</p>\r\n\r\n<p>Bisous &agrave; tous,<br />\r\nGreg</p>', '2018-03-21 10:41:48', NULL, 'Article'),
(2, 2, 4, 'In porta non ante id maximus', '<p>Nunc sodales nisi lectus, vel tempus diam commodo in. Sed sed ipsum efficitur, dictum est at, aliquam sem. Duis quis nulla eget urna auctor hendrerit in a elit. Vivamus sagittis mollis mauris sit amet finibus. Curabitur a lacus tellus. Nam eget neque vitae lectus luctus tincidunt id nec erat. Nullam non tempor augue. Nam vel purus id est ultricies commodo. Pellentesque diam dui, porttitor in aliquet non, aliquet vel magna. Suspendisse augue mi, placerat ut elementum vel, iaculis sit amet sem. Vestibulum sed sodales sapien. Donec eu diam lorem.</p>\r\n\r\n<p>Proin enim sapien, sollicitudin aliquam consequat laoreet, varius at massa. Sed quis erat dictum, bibendum elit at, venenatis risus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Duis rutrum, massa at feugiat commodo, nulla justo laoreet tellus, fringilla interdum magna sapien gravida sem. Fusce sem magna, rutrum sit amet suscipit in, luctus id metus. Ut sed mi at neque elementum pharetra nec ut nibh. Nunc laoreet porta auctor. Aliquam dictum fermentum condimentum. Curabitur nulla augue, mattis a congue at, consectetur sed nisl. Curabitur vulputate ultrices massa, nec tristique turpis feugiat sit amet. Vestibulum porta in lorem vitae facilisis.</p>', '2018-03-21 11:00:03', '5ab22d241f384.jpeg', 'Article'),
(3, 8, 7, 'Donec nec purus in ex viverra porttitor', '<p>Maecenas consectetur, dui nec pretium lobortis, leo metus porta ante, non tincidunt risus justo hendrerit nisl. Nam quis ligula vel nulla sodales sagittis vitae eu est. Sed volutpat interdum est, egestas posuere purus blandit nec. Nulla sem purus, rhoncus sit amet eros in, imperdiet eleifend ligula. Nam condimentum eros eu sapien faucibus, nec mattis purus pellentesque. Nulla fermentum, lorem eget aliquam tempor, sem nisl ornare lacus, nec pretium dolor tellus eget magna. In ultricies efficitur eros, eget pretium eros vestibulum a. Morbi convallis libero quis posuere sollicitudin. Proin suscipit augue vel lorem eleifend, sit amet ultrices lectus porttitor. Nam laoreet non lectus ac scelerisque.</p>\r\n\r\n<p>Sed blandit quam quis lectus ultrices ultricies. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Maecenas aliquet a lectus sodales laoreet. Aliquam sed nibh odio. Duis blandit lectus at neque convallis placerat. Phasellus eget mauris vestibulum velit lobortis placerat non ut justo. Maecenas pellentesque ligula ac elit maximus rutrum. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nunc vitae elit eget tellus sodales facilisis. In dictum dolor odio, quis accumsan massa vestibulum ut. Maecenas cursus consequat fringilla. Aenean congue tellus vel tortor mattis, vel volutpat nisi elementum. Vestibulum tristique quis odio sit amet dignissim.</p>\r\n\r\n<p>Integer ultrices lorem accumsan mauris bibendum, consequat egestas augue tempor. Donec dignissim pretium enim sit amet sollicitudin. Quisque feugiat ante eu diam mattis, et semper mi scelerisque. Nulla massa nisi, interdum vel faucibus eu, vulputate ac leo. Nullam nunc nisl, imperdiet ac tempor quis, semper vel purus. Suspendisse condimentum malesuada aliquam. Etiam sed quam vel nunc rutrum tempor vel aliquet turpis. Suspendisse mollis enim quis magna gravida, sed vehicula nibh rhoncus. Nam non justo vitae massa consectetur maximus. Mauris aliquam et turpis id malesuada.</p>', '2018-03-21 11:10:25', '5ab22f9149f37.jpeg', 'Article'),
(4, 4, 2, 'Naissance de ma Liza', '<p>Ma belle Liza est n&eacute;e !!! et je voulais vous en faire part !</p>', '2018-03-21 11:16:36', '5ab231055fc53.jpeg', 'Birth'),
(5, 3, 5, 'BBQ', '<p>Salut &agrave; tous !!</p>\r\n\r\n<p>J&#39;organise un BBQ Dimanche chez moi !<br />\r\nplus on est de fou plus on rit !</p>', '2018-03-21 12:56:47', NULL, 'Event');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `birthdate` date NOT NULL,
  `gender` enum('m','f') COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `adress` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cp` int(11) NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `email`, `password`, `role`, `birthdate`, `gender`, `phone`, `avatar`, `adress`, `cp`, `city`, `country`, `is_active`) VALUES
(1, 'greg', 'malaud', 'greg@malaud.com', '$2y$13$Wj9fumk/RjM6MBri5Lfkqu4oj3HOiV6NIrDuyRHkQZiDkO01uHgA.', 'ROLE_ADMIN', '1983-09-06', 'm', '0600010203', '5ab227879f260.jpeg', '60 rue haxo', 75015, 'PARIS', 'FR', 1),
(2, 'Hamid', 'KEZZAL', 'hamid@kezzal.com', '$2y$13$incyYLd991bNeRjru5HMr.VRZdtJdmQ.4juBNoYOg4jrfbe12E1w.', 'ROLE_ADMIN', '1980-08-07', 'm', '0600010203', '5ab22dccc908a.jpeg', '21 RUE DE LA LIBERTE', 33000, 'BORDEAUX', 'FR', 1),
(3, 'Walid', 'ISMIEL', 'walid@ismiel.com', '$2y$13$AheracbfNatLDCdf7SplMetsB3zRPVOlB/YbJFSDD35PHzACh1tkq', 'ROLE_ADMIN', '1981-04-29', 'm', '0600020203', '5ab2297ab60cd.jpeg', '56 RUE DE LA republique', 31000, 'TOULOUSE', 'FR', 1),
(4, 'Moundir', 'salmi', 'moundir@salmi.com', '$2y$13$z47lh33kD7bZIuw6eICnNeRKZiNkoLKWcXyDbv/Syb0dRbFYEr28y', 'ROLE_ADMIN', '1983-06-07', 'm', '404040404', '5ab229c9361c0.jpeg', '60 rue du chien', 75020, 'PARIS', 'FR', 1),
(5, 'Julien', 'Favier', 'julien@favier.com', '$2y$13$sRqrq8RPjR7HPM275gCir.yPXxZegtdsa.TcxWv4I.FQ4/HWjF8iO', 'ROLE_USER', '1966-05-16', 'm', '0600015599', '5ab246a5e6727.jpeg', '101 AVENUE LA FRATERNITE', 75000, 'paris', 'FR', 1),
(6, 'Capucine', 'MOULIN', 'capucine@moulin.com', '$2y$13$0n/w7tpzELz2GIoi6v1F1enMpC2sycjLfOV8/llYp21QAP0PXYK1W', 'ROLE_USER', '1990-02-06', 'f', '0600010203', 'default_avatar_woman.jpg', '295 Rue Bassompierre', 48500, 'Jausiers', 'FR', 1),
(7, 'maiwenn', 'Vallee', 'maiwenn@valeee.com', '$2y$13$En2xPHSuQiJ4mx/Ljp9s/OumDWXTgjwAyPi574HUwlXg78Cqo2Pp6', 'ROLE_USER', '1972-11-27', 'f', '0600010203', '5ab22f022d66f.jpeg', '117 Avenue Ernest-Reyer', 33000, 'BORDEAUX', 'FR', 1),
(8, 'Guillaume', 'Lefort', 'guillaume@lefort.com', '$2y$13$8Pyc/HfUp.HhOEwCprj0vueih//gr5siCclo9NVLAFWMkf.qxVzFK', 'ROLE_USER', '1976-04-16', 'm', '0600010203', 'default_avatar_man.jpg', '88 Rue du Dahomey', 12500, 'Villereversure', 'FR', 0),
(9, 'Amelie', 'Colin', 'amelie@Colin.com', '$2y$13$IJouAyqHW4mR4IgrfUecUOSGCcKDWRnA8zydaaIoshRr93zbnhKBW', 'ROLE_USER', '1959-03-22', 'f', '0600010203', 'default_avatar_woman.jpg', '25 Place du 18 Juin-1940', 68910, 'Labaroche', 'FR', 1),
(10, 'Mélanie', 'malaud', 'melanie@malaud.com', '$2y$13$Wf4//SAoqQhUOgH2Va59xel7DSlcxMhYyJjhaOPuFQoJ/k6T4d5BK', 'ROLE_USER', '1980-09-20', 'f', '0686858483', 'default_avatar_woman.jpg', '60 rue haxo', 75020, 'paris', 'FR', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_39986E43F675F31B` (`author_id`);

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `birth`
--
ALTER TABLE `birth`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_64C19C15E237E06` (`name`);

--
-- Index pour la table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_9474526CF675F31B` (`author_id`),
  ADD KEY `IDX_9474526C7294869C` (`article_id`);

--
-- Index pour la table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `messaging`
--
ALTER TABLE `messaging`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_EE15BA61F675F31B` (`author_id`),
  ADD KEY `IDX_EE15BA61E92F8F78` (`recipient_id`);

--
-- Index pour la table `photo`
--
ALTER TABLE `photo`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `photo_album`
--
ALTER TABLE `photo_album`
  ADD PRIMARY KEY (`photo_id`,`album_id`),
  ADD KEY `IDX_83C969F47E9E4C8C` (`photo_id`),
  ADD KEY `IDX_83C969F41137ABCF` (`album_id`);

--
-- Index pour la table `super_article`
--
ALTER TABLE `super_article`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_B04AE6CA12469DE2` (`category_id`),
  ADD KEY `IDX_B04AE6CAF675F31B` (`author_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `album`
--
ALTER TABLE `album`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `messaging`
--
ALTER TABLE `messaging`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `photo`
--
ALTER TABLE `photo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `super_article`
--
ALTER TABLE `super_article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `album`
--
ALTER TABLE `album`
  ADD CONSTRAINT `FK_39986E43F675F31B` FOREIGN KEY (`author_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `FK_23A0E66BF396750` FOREIGN KEY (`id`) REFERENCES `super_article` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `birth`
--
ALTER TABLE `birth`
  ADD CONSTRAINT `FK_3CB1821FBF396750` FOREIGN KEY (`id`) REFERENCES `super_article` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `FK_9474526C7294869C` FOREIGN KEY (`article_id`) REFERENCES `super_article` (`id`),
  ADD CONSTRAINT `FK_9474526CF675F31B` FOREIGN KEY (`author_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `FK_3BAE0AA7BF396750` FOREIGN KEY (`id`) REFERENCES `super_article` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `messaging`
--
ALTER TABLE `messaging`
  ADD CONSTRAINT `FK_EE15BA61E92F8F78` FOREIGN KEY (`recipient_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_EE15BA61F675F31B` FOREIGN KEY (`author_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `photo_album`
--
ALTER TABLE `photo_album`
  ADD CONSTRAINT `FK_83C969F41137ABCF` FOREIGN KEY (`album_id`) REFERENCES `album` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_83C969F47E9E4C8C` FOREIGN KEY (`photo_id`) REFERENCES `photo` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `super_article`
--
ALTER TABLE `super_article`
  ADD CONSTRAINT `FK_B04AE6CA12469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `FK_B04AE6CAF675F31B` FOREIGN KEY (`author_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
