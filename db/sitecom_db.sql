-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  mer. 29 mai 2019 à 19:45
-- Version du serveur :  10.1.39-MariaDB
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
-- Base de données :  `sitecom_db`
--
CREATE DATABASE IF NOT EXISTS `sitecom_db` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `sitecom_db`;

-- --------------------------------------------------------

--
-- Structure de la table `authenticated_user`
--

CREATE TABLE `authenticated_user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `passwd` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `createdate` datetime NOT NULL,
  `updatedate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `authenticated_user`
--

INSERT INTO `authenticated_user` (`id`, `username`, `firstname`, `lastname`, `email`, `contact`, `passwd`, `picture`, `createdate`, `updatedate`) VALUES
(1, 'Velit.', 'Yves', 'Barthelemy', 'hberger@rossi.com', '+33 2 21 1', 'G|$7[}', 'http://www.mary.fr/ducimus-temporibus-modi-saepe-architecto-unde-non-dicta', '2014-05-25 14:28:39', '1984-07-04 13:29:00'),
(2, 'Cum.', 'Adrien', 'Jacquot', 'antoine76@coulon.net', '09 72 77 0', 'o=T!xn', 'http://www.gautier.fr/vel-optio-provident-non.html', '1981-05-20 03:30:05', '1982-05-05 15:17:04'),
(3, 'Illo.', 'Luc', 'Leclercq', 'thoarau@tiscali.fr', '+33 (0)7 7', '2kGZzz', 'https://desousa.fr/in-dicta-molestiae-asperiores-consequuntur-sit-repellendus.html', '2000-09-03 21:27:52', '1982-08-02 09:03:51'),
(4, 'Eos.', 'Susan', 'Pascal', 'frederic70@merle.com', '0324779013', 'ai!0Dc', 'https://www.delannoy.fr/assumenda-error-consequatur-fugit-ad-iste', '2006-03-29 12:16:00', '1984-10-29 06:46:01'),
(5, 'Alias.', 'Anastasie', 'Perrier', 'dleleu@gmail.com', '0739322183', 'o(N?I!', 'http://charpentier.com/ea-sit-in-ut-qui-fugiat-dolores-placeat', '1989-06-12 00:45:19', '1977-12-04 23:46:06'),
(6, 'Est in.', 'Simone', 'Gaudin', 'jacqueline81@dumas.com', '+33 1 97 4', '{a!5`V', 'http://www.torres.fr/dolorum-doloremque-quasi-vero-nobis-error-fuga-ut', '1996-12-26 02:40:28', '1985-12-30 03:37:44'),
(7, 'Eum.', 'Denise', 'Guyot', 'franck.pages@wanadoo.fr', '0109069388', '{\\^[x#', 'http://www.berger.com/assumenda-dolore-explicabo-nisi-a-aut-architecto-et', '2018-02-24 07:45:04', '1973-12-09 08:41:38'),
(8, 'Ratione.', 'Suzanne', 'Salmon', 'pbrun@club-internet.fr', '+33 (0)7 6', '{bArt8', 'http://voisin.com/', '1993-01-31 19:53:19', '2011-11-08 19:36:03'),
(9, 'Est.', 'Jeanne', 'Le Goff', 'rene98@germain.fr', '0105965458', 'O<A95#', 'http://humbert.com/aliquid-neque-voluptas-est-totam-provident-sunt', '1976-09-18 18:44:21', '2002-01-12 17:39:21'),
(10, 'Vero.', 'Thibault', 'Legrand', 'hugues27@delmas.com', '0967451578', 'xPNzy&', 'http://www.maury.net/porro-consequatur-totam-et-et-cumque-nesciunt.html', '2018-04-14 08:55:43', '1986-05-09 13:44:03'),
(11, 'Ipsum.', 'Robert', 'Lemonnier', 'sylvie.jacob@hotmail.fr', '09 65 59 3', 'Kn+\',&', 'http://www.blanchard.fr/accusamus-sed-iure-voluptatum-excepturi-sit-quos-magni', '1980-08-31 06:03:10', '1991-07-31 19:28:53'),
(12, 'Iste.', 'Monique', 'Bazin', 'peltier.emmanuelle@begue.fr', '0100400086', '][\'g=z', 'https://www.blin.net/tempora-id-reprehenderit-voluptas-maiores', '1970-04-11 06:36:17', '1995-05-19 03:06:22'),
(13, 'Eos at.', 'Benjamin', 'Barthelemy', 'amelie70@bousquet.fr', '05 38 00 0', 'd6$)T|', 'http://www.duval.com/et-ratione-voluptate-consequatur-architecto-iure-placeat', '2011-02-26 20:32:25', '2016-05-30 02:27:32'),
(14, 'Itaque.', 'Dorothée', 'Herve', 'renault.alain@wanadoo.fr', '+33 (0)8 1', '2(D0}*', 'https://www.langlois.fr/blanditiis-consectetur-itaque-consequuntur-cupiditate-praesentium-itaque-et', '2018-04-08 05:43:15', '2011-05-12 09:01:37'),
(15, 'Ex in.', 'Manon', 'Jourdan', 'rodrigues.anne@dupont.org', '0113227009', '=,}WZi', 'http://navarro.com/', '2000-10-22 15:11:45', '1999-09-23 09:17:26'),
(16, 'Ab.', 'Édouard', 'Masson', 'raymond.weiss@club-internet.fr', '04 28 64 3', '4W$U.p', 'http://www.bonnet.net/', '1989-08-26 11:02:20', '1984-02-21 18:34:57'),
(17, 'Vero.', 'Hélène', 'Auger', 'moulin.francois@yahoo.fr', '05 83 67 0', 'mgZ7lL', 'http://guillet.com/', '1991-02-24 13:10:39', '1981-03-07 03:04:57'),
(18, 'Et in.', 'Édouard', 'Legros', 'isaac76@bouygtel.fr', '0570135952', '>tamn\"', 'http://www.perrier.fr/fugiat-quaerat-reiciendis-aut-saepe', '1989-04-29 16:33:18', '1988-06-03 07:47:47'),
(19, 'Numquam.', 'François', 'Fabre', 'ydaniel@club-internet.fr', '03 94 41 3', 'w5&K){', 'http://www.texier.com/cupiditate-occaecati-sequi-quod', '2008-01-01 06:04:38', '1992-09-01 22:42:42'),
(20, 'Magnam.', 'Nath', 'Bazin', 'denis.henriette@baudry.fr', '08 97 95 4', 'p\\)TN+', 'http://mahe.com/', '2011-02-24 12:18:26', '1991-01-02 01:02:52');

-- --------------------------------------------------------

--
-- Structure de la table `figures`
--

CREATE TABLE `figures` (
  `id` int(11) NOT NULL,
  `media_id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `createdate` datetime NOT NULL,
  `updatedate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `figures`
--

INSERT INTO `figures` (`id`, `media_id`, `group_id`, `name`, `description`, `createdate`, `updatedate`) VALUES
(1, 1, 1, 'Aut porro.', 'Voluptates ut optio quos qui.', '2017-04-05 10:58:54', '1999-02-12 11:37:08'),
(2, 2, 2, 'Molestias.', 'Eveniet aut atque possimus.', '1971-10-10 09:39:17', '1977-12-06 23:42:43'),
(3, 3, 3, 'Et.', 'Eum non in esse et.', '1977-03-05 18:33:34', '1971-10-21 03:55:42'),
(4, 4, 4, 'Quidem.', 'Alias et et quis quae.', '1972-10-20 21:30:08', '1970-09-21 19:53:08'),
(5, 5, 5, 'Quas ex.', 'Nisi fuga dolores aut velit illo.', '2006-03-16 17:59:33', '2012-08-08 03:52:21'),
(6, 6, 6, 'Quasi sit.', 'Sunt est impedit itaque cumque.', '1987-10-22 02:53:34', '1994-01-13 11:16:07'),
(7, 7, 7, 'Nam cum.', 'Autem aut qui perferendis.', '1987-01-11 15:32:57', '1983-07-14 04:49:11'),
(8, 8, 8, 'Quisquam.', 'Enim velit ullam tempore autem.', '2016-09-30 08:46:29', '1987-08-15 23:31:59'),
(9, 9, 9, 'Tempora.', 'Molestias amet aut qui.', '2012-12-19 15:08:04', '1983-12-22 03:49:54'),
(10, 10, 10, 'Optio.', 'Saepe corrupti vitae consectetur.', '2019-02-18 17:40:53', '1974-02-19 18:24:59'),
(11, 11, 11, 'Quasi.', 'Libero quis sit qui officia nihil.', '1994-05-26 04:58:35', '2017-05-08 09:50:02'),
(12, 12, 12, 'Impedit.', 'Et est qui delectus ipsam id non.', '2018-08-26 14:48:15', '1987-12-25 11:34:19'),
(13, 13, 13, 'Et sit.', 'Ut ut facilis qui sed sint.', '1980-09-09 07:27:35', '1997-07-17 05:59:44'),
(14, 14, 14, 'Sapiente.', 'Ea velit quo autem id.', '1982-10-27 07:48:38', '1983-11-01 03:28:23'),
(15, 15, 15, 'Nulla.', 'Quas ut cumque laborum quod.', '2007-11-09 07:26:12', '1974-12-29 01:34:52'),
(16, 16, 16, 'Hic.', 'Architecto quas illum cum.', '2000-12-08 18:24:33', '1984-05-22 20:37:32'),
(17, 17, 17, 'Aut.', 'Quisquam amet nam ipsa eius.', '2005-06-20 18:44:48', '1975-05-28 17:06:58'),
(18, 18, 18, 'Modi.', 'Omnis qui eos et pariatur.', '2006-11-16 21:03:23', '1995-07-23 09:30:25'),
(19, 19, 19, 'Amet ut.', 'Autem ratione hic nihil.', '1984-10-09 22:48:11', '1980-04-15 16:50:42'),
(20, 20, 20, 'At odit.', 'Cumque amet corrupti dolorem rem.', '2018-05-17 19:25:52', '1987-07-03 07:35:57');

-- --------------------------------------------------------

--
-- Structure de la table `group_figures`
--

CREATE TABLE `group_figures` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `group_figures`
--

INSERT INTO `group_figures` (`id`, `name`) VALUES
(1, 'Amet et et suscipit qui recusandae totam.'),
(2, 'Delectus aut nam et eum.'),
(3, 'Doloribus cupiditate dolorem saepe libero quas.'),
(4, 'Omnis voluptatibus quae sit.'),
(5, 'Molestias in minus aliquid repudiandae.'),
(6, 'Nam perferendis sit est magnam ut nemo.'),
(7, 'Harum voluptatem sit nihil laboriosam sed.'),
(8, 'Reiciendis velit voluptas molestiae eum et eos.'),
(9, 'Quisquam sed aut quia.'),
(10, 'Sed sint magni qui sint quos aut.'),
(11, 'Eveniet voluptas est accusantium.'),
(12, 'Cumque optio qui ab quaerat consequuntur.'),
(13, 'Excepturi ipsum culpa dolorum similique a.'),
(14, 'Fuga autem impedit perspiciatis perspiciatis.'),
(15, 'Aut voluptate velit et et.'),
(16, 'Dolores qui asperiores voluptates.'),
(17, 'Repellat delectus magnam repudiandae molestiae.'),
(18, 'Eligendi consequatur et tempore.'),
(19, 'Expedita ut eos assumenda expedita.'),
(20, 'Ea consequatur omnis est sint reprehenderit.');

-- --------------------------------------------------------

--
-- Structure de la table `media`
--

CREATE TABLE `media` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `media`
--

INSERT INTO `media` (`id`, `name`, `type`, `state`) VALUES
(1, 'Debitis et saepe eum sint dolorem delectus.', 'VIDEO', 0),
(2, 'Ex esse veritatis voluptate vel possimus.', 'VIDEO', 0),
(3, 'Et praesentium est velit molestiae porro.', 'VIDEO', 0),
(4, 'Iusto amet neque deleniti totam aut.', 'VIDEO', 0),
(5, 'Possimus vero eos voluptatem at qui eaque.', 'VIDEO', 0),
(6, 'Ut rem repellendus ut sit laudantium.', 'VIDEO', 0),
(7, 'Ullam qui ea voluptatem aut cum vitae nostrum.', 'VIDEO', 0),
(8, 'Dignissimos sunt atque aut.', 'VIDEO', 0),
(9, 'Quae laborum expedita quis ut odio et id.', 'VIDEO', 0),
(10, 'Et harum dolor quaerat libero.', 'VIDEO', 0),
(11, 'Perferendis ut dolorum excepturi deleniti.', 'VIDEO', 0),
(12, 'Eaque et recusandae iste qui.', 'VIDEO', 0),
(13, 'Nesciunt eius est minus quis.', 'VIDEO', 0),
(14, 'At nostrum voluptatem et et ea.', 'VIDEO', 0),
(15, 'Maxime nemo rerum in dolores molestias earum.', 'VIDEO', 0),
(16, 'Ducimus ea beatae eum amet provident sint.', 'VIDEO', 0),
(17, 'Doloribus fugiat repellat harum assumenda.', 'VIDEO', 0),
(18, 'Vero tempore odit commodi aut culpa totam.', 'VIDEO', 0),
(19, 'Cupiditate et sunt suscipit eos et et.', 'VIDEO', 0),
(20, 'Ut qui sed inventore.', 'VIDEO', 0);

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `authenticateduser_id` int(11) DEFAULT NULL,
  `figures_id` int(11) DEFAULT NULL,
  `content` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `createdate` datetime NOT NULL,
  `updatedate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id`, `authenticateduser_id`, `figures_id`, `content`, `createdate`, `updatedate`) VALUES
(1, 1, 1, 'Incidunt saepe provident esse hic eligendi. Culpa ut ab voluptas sed a. Et sint autem inventore aut ', '2007-03-12 15:34:43', '1998-05-16 10:06:04'),
(2, 2, 2, 'Voluptatem perferendis molestiae est. Iure possimus ab in hic. Odio sed vitae maiores ex beatae repr', '2017-06-30 17:52:43', '1978-09-19 18:29:17'),
(3, 3, 3, 'Maiores nisi eius quibusdam sapiente quia recusandae. Numquam laboriosam sint enim reiciendis. Ullam', '2000-07-10 18:27:25', '2004-11-12 14:00:31'),
(4, 4, 4, 'Molestiae et laboriosam dolor odit omnis vel excepturi. Quia quas beatae et nam itaque nesciunt. Ea ', '1995-03-27 06:16:46', '2014-09-25 17:08:53'),
(5, 5, 5, 'Non et et et fugit. Excepturi enim velit qui nam nesciunt non dolore quis. Eius et et omnis.', '1998-02-08 00:57:52', '2017-03-12 11:55:00'),
(6, 6, 6, 'Cupiditate rerum ratione rerum repellendus ducimus. Voluptatem aperiam ipsa eius repellat adipisci r', '2019-04-27 20:29:56', '1998-09-02 19:55:13'),
(7, 7, 7, 'Nihil voluptatem magnam odio impedit. Omnis consequatur ut repellendus officiis nihil reprehenderit ', '2005-04-26 08:16:10', '1975-02-17 01:55:07'),
(8, 8, 8, 'Placeat ut esse beatae. Ratione cumque commodi corrupti cum ratione animi maxime.', '1991-01-20 18:40:57', '1980-03-18 09:29:03'),
(9, 9, 9, 'Quos saepe quia quia unde. Error modi saepe eos et ab. Sunt est possimus voluptas blanditiis et.', '1983-01-17 10:13:14', '2004-03-14 20:21:30'),
(10, 10, 10, 'Quod et consectetur ut expedita ratione vitae. Sed ut repudiandae quod sit. Eum et nisi cumque et qu', '1978-12-02 22:13:05', '2011-02-04 00:21:45'),
(11, 11, 11, 'Ea et sit enim molestias sunt. Aperiam tenetur rerum aut tempore dolorem. Libero maxime voluptatem q', '1970-09-02 03:49:18', '2008-11-18 11:40:20'),
(12, 12, 12, 'Architecto omnis quae consequatur. Est sit beatae quo alias aut. Perspiciatis quos illo sed nostrum ', '1971-10-13 07:18:31', '1992-11-28 06:39:54'),
(13, 13, 13, 'Quo soluta molestiae optio consectetur est cupiditate a. Natus officia laudantium recusandae aliquam', '1990-02-22 09:31:11', '2015-05-13 16:56:55'),
(14, 14, 14, 'Ipsa officia sapiente nesciunt atque rem. Totam esse velit voluptas temporibus.', '2007-03-19 17:57:05', '1993-01-22 06:04:47'),
(15, 15, 15, 'Numquam vel est sunt ab doloribus. Excepturi non saepe in voluptatem vel rem. Sunt magni aut eaque v', '2016-06-18 19:23:52', '1997-07-19 23:45:39'),
(16, 16, 16, 'Et et omnis est animi quaerat. Autem qui suscipit vel aut magnam architecto. Itaque ipsa tenetur exe', '2004-07-22 00:19:52', '1996-03-12 13:08:57'),
(17, 17, 17, 'In quia asperiores sed sit. Vero excepturi nihil harum sit et nemo rerum. Possimus odit qui voluptat', '2018-06-11 22:04:04', '2012-04-18 05:28:09'),
(18, 18, 18, 'Placeat amet veniam sit. Facilis id soluta quia quidem quibusdam odit. Voluptate et in non corrupti ', '2004-02-03 19:04:44', '2009-02-24 01:45:00'),
(19, 19, 19, 'Voluptatem ut quod assumenda a. Sit ut sapiente fugit ullam veniam beatae. Nemo aliquid ut quam ut.', '1974-09-10 03:43:49', '2004-07-10 12:31:25'),
(20, 20, 20, 'Aperiam dolor quis velit nesciunt praesentium. Dignissimos excepturi hic ducimus expedita et volupta', '1980-12-16 09:37:27', '1988-07-25 05:52:16');

-- --------------------------------------------------------

--
-- Structure de la table `migration_versions`
--

CREATE TABLE `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20190529171516', '2019-05-29 17:15:32');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `authenticated_user`
--
ALTER TABLE `authenticated_user`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `figures`
--
ALTER TABLE `figures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_ABF1009AEA9FDD75` (`media_id`),
  ADD KEY `IDX_ABF1009AFE54D947` (`group_id`);

--
-- Index pour la table `group_figures`
--
ALTER TABLE `group_figures`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_DB021E968B5472C8` (`authenticateduser_id`),
  ADD KEY `IDX_DB021E965C7F3A37` (`figures_id`);

--
-- Index pour la table `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `authenticated_user`
--
ALTER TABLE `authenticated_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `figures`
--
ALTER TABLE `figures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `group_figures`
--
ALTER TABLE `group_figures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `media`
--
ALTER TABLE `media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `figures`
--
ALTER TABLE `figures`
  ADD CONSTRAINT `FK_ABF1009AEA9FDD75` FOREIGN KEY (`media_id`) REFERENCES `media` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `FK_ABF1009AFE54D947` FOREIGN KEY (`group_id`) REFERENCES `group_figures` (`id`) ON DELETE SET NULL;

--
-- Contraintes pour la table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `FK_DB021E965C7F3A37` FOREIGN KEY (`figures_id`) REFERENCES `figures` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `FK_DB021E968B5472C8` FOREIGN KEY (`authenticateduser_id`) REFERENCES `authenticated_user` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
