-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  ven. 21 déc. 2018 à 12:24
-- Version du serveur :  10.1.36-MariaDB
-- Version de PHP :  7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `db_library`
--

-- --------------------------------------------------------

--
-- Structure de la table `books`
--

CREATE TABLE `books` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `author` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double DEFAULT NULL,
  `theme_id` int(191) NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(191) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `books`
--

INSERT INTO `books` (`id`, `title`, `author`, `price`, `theme_id`, `description`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'pain nu', 'med choukri', 200, 1, 'il parle de sa ville ..............', 1, NULL, NULL, '2018-12-20 07:29:10'),
(2, 'les nuits blaches', 'mohamed choukri', NULL, 2, '99999999999999999999999999999999', 0, NULL, '2018-12-19 13:09:57', '2018-12-19 14:12:16'),
(3, 'Les mésirables', 'victor hugo', NULL, 1, 'il parle de révolution francaise', 1, NULL, '2018-12-19 14:20:59', '2018-12-19 14:20:59'),
(4, 'les nuits blaches', 'mohamed choukri', NULL, 1, 'il parlse de ca ville .............', 1, NULL, '2018-12-21 09:46:57', '2018-12-21 09:46:57'),
(5, 'les nuits blaches', 'mohamed choukri', NULL, 1, 'il parlse de ca ville .............', 1, NULL, '2018-12-21 09:47:03', '2018-12-21 09:50:23');

-- --------------------------------------------------------

--
-- Structure de la table `borrows`
--

CREATE TABLE `borrows` (
  `id` int(10) UNSIGNED NOT NULL,
  `borrowdate` date NOT NULL,
  `borrowend` date NOT NULL,
  `return` tinyint(1) NOT NULL,
  `member_id` int(10) UNSIGNED NOT NULL,
  `book_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `borrows`
--

INSERT INTO `borrows` (`id`, `borrowdate`, `borrowend`, `return`, `member_id`, `book_id`, `created_at`, `updated_at`) VALUES
(5, '2018-12-18', '2018-12-18', 1, 1, 1, '2018-12-18 08:55:15', '2018-12-18 09:03:38'),
(6, '2018-12-18', '2018-12-21', 1, 1, 1, '2018-12-18 09:03:44', '2018-12-21 09:50:17'),
(7, '2018-12-18', '2018-12-18', 1, 1, 1, '2018-12-18 09:04:25', '2018-12-18 09:04:36'),
(8, '2018-12-18', '2018-12-18', 1, 1, 1, '2018-12-18 09:12:40', '2018-12-18 09:13:05'),
(9, '2018-12-18', '2018-12-18', 1, 1, 1, '2018-12-18 09:13:12', '2018-12-18 09:20:58'),
(10, '2018-12-18', '2018-12-21', 1, 1, 1, '2018-12-18 09:21:05', '2018-12-21 09:49:38'),
(11, '2018-12-19', '2018-12-19', 1, 1, 1, '2018-12-19 07:40:32', '2018-12-19 07:40:49'),
(12, '2018-12-19', '2018-12-20', 1, 1, 1, '2018-12-19 07:41:29', '2018-12-20 07:29:10'),
(13, '2018-12-21', '2018-12-21', 1, 1, 5, '2018-12-21 09:49:47', '2018-12-21 09:50:23');

-- --------------------------------------------------------

--
-- Structure de la table `members`
--

CREATE TABLE `members` (
  `id` int(10) UNSIGNED NOT NULL,
  `firstname` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthdate` date DEFAULT NULL,
  `cin` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `adress` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) NOT NULL,
  `phonenumber` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deposit` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `members`
--

INSERT INTO `members` (`id`, `firstname`, `lastname`, `birthdate`, `cin`, `adress`, `email`, `phonenumber`, `picture`, `created_at`, `updated_at`, `deleted_at`, `deposit`) VALUES
(1, 'anass', 'lamaalam', NULL, 'kb131598', 'tanger', 'anasslam199@gmail.com', '0699912566', '', NULL, '2018-12-19 13:55:37', NULL, 1),
(27, 'Claire', 'bourbiaux', '2018-12-07', 'kb131598', '25 lots jamila 2 tanger', 'anassito57@live.fr', '0699912566', 'storage/uploads/1545305449_claire.jpg', '2018-12-18 14:06:21', '2018-12-20 10:30:50', NULL, 1),
(28, 'Hassan', 'Lamaalam', '1997-12-06', 'l1616..', '25 lots jamila 2 tanger', 'hassan@lam.com', '0663025773', 'storage/uploads/1545145903_IMG_20180618_224937496.jpg', '2018-12-18 14:11:43', '2018-12-18 14:11:43', NULL, 1),
(29, 'Hassan', 'Lamaalam', '1997-12-06', 'l1616..', '25 lots jamila 2 tanger', 'hassan@lam.com', '0663025773', 'storage/uploads/1545146123_IMG_20180618_224937496.jpg', '2018-12-18 14:15:23', '2018-12-19 13:57:18', NULL, 1),
(30, 'Claire', 'bourbiaux', '1996-12-06', 'kb131598', '25 lots jamila 2 tanger', 'anasslam69@gmail.com', '0699912566', 'storage/uploads/1545147416_18268601_449664188707035_3725863176980786283_n.jpg', '2018-12-18 14:36:56', '2018-12-19 14:18:11', '2018-12-19 15:18:11', 1),
(31, 'Claire', 'bourbiaux', '1996-12-06', 'kb131598', '25 lots jamila 2 tanger', 'anasslam69@gmail.com', '0699912566', 'storage/uploads/1545147673_18268601_449664188707035_3725863176980786283_n.jpg', '2018-12-18 14:41:13', '2018-12-19 14:13:03', '2018-12-19 15:13:03', 1),
(32, 'Claire', 'bourbiaux', '1996-12-06', 'kb131598', '25 lots jamila 2 tanger', 'anasslam69@gmail.com', '0699912566', 'storage/uploads/1545147745_18268601_449664188707035_3725863176980786283_n.jpg', '2018-12-18 14:42:25', '2018-12-18 14:42:25', NULL, 1),
(33, 'Claire', 'bourbiaux', '1996-12-06', 'kb131598', '25 lots jamila 2 tanger', 'anasslam69@gmail.com', '0699912566', 'storage/uploads/1545147758_18268601_449664188707035_3725863176980786283_n.jpg', '2018-12-18 14:42:38', '2018-12-18 14:42:38', NULL, 1),
(34, 'Aymane', 'Lamaalam', '2005-12-08', 'kb131598', '25 lots jamila 2 tanger', 'aymane@gmail.com', '0533665522', 'storage/uploads/1545149171_46510369_2206028949428834_6936858978928295936_n.jpg', '2018-12-18 15:06:11', '2018-12-18 15:06:11', NULL, 1),
(35, 'fe', 'ben', '2018-12-12', '131598', '1 rue 7 lost jamila 2 tanger', 'fe@gmail.com', '0698574115', '', NULL, NULL, NULL, 1),
(36, 'fe', 'ben', '2018-12-12', '131598', '1 rue 7 lost jamila 2 tanger', 'fe@gmail.com', '0698574115', '', '2018-12-10 23:00:00', '2018-12-19 14:09:39', NULL, 1),
(37, 'fe', 'ben', '2018-12-12', '131598', '1 rue 7 lost jamila 2 tanger', 'fe@gmail.com', '0698574115', '', NULL, NULL, NULL, 1),
(38, 'fe', 'ben', '2018-12-12', '131598', '1 rue 7 lost jamila 2 tanger', 'fe@gmail.com', '0698574115', '', NULL, NULL, NULL, 1),
(39, 'fe', 'ben', '2018-12-12', '131598', '1 rue 7 lost jamila 2 tanger', 'fe@gmail.com', '0698574115', '', NULL, NULL, NULL, 1),
(40, 'fe', 'ben', '2018-12-12', '131598', '1 rue 7 lost jamila 2 tanger', 'fe@gmail.com', '0698574115', '', NULL, NULL, NULL, 1),
(41, 'fe', 'ben', '2018-12-12', '131598', '1 rue 7 lost jamila 2 tanger', 'fe@gmail.com', '0698574115', '', NULL, NULL, NULL, 1),
(42, 'fe', 'ben', '2018-12-12', '131598', '1 rue 7 lost jamila 2 tanger', 'fe@gmail.com', '0698574115', '', NULL, NULL, NULL, 1),
(43, 'fe', 'ben', '2018-12-12', '131598', '1 rue 7 lost jamila 2 tanger', 'fe@gmail.com', '0698574115', '', NULL, NULL, NULL, 1),
(44, 'fe', 'ben', '2018-12-12', '131598', '1 rue 7 lost jamila 2 tanger', 'fe@gmail.com', '0698574115', '', NULL, NULL, NULL, 1),
(45, 'fe', 'ben', '2018-12-12', '131598', '1 rue 7 lost jamila 2 tanger', 'fe@gmail.com', '0698574115', '', NULL, NULL, NULL, 1),
(46, 'fe', 'ben', '2018-12-12', '131598', '1 rue 7 lost jamila 2 tanger', 'fe@gmail.com', '0698574115', '', NULL, NULL, NULL, 1),
(47, 'fe', 'ben', '2018-12-12', '131598', '1 rue 7 lost jamila 2 tanger', 'fe@gmail.com', '0698574115', '', NULL, NULL, NULL, 1),
(48, 'fe', 'ben', '2018-12-12', '131598', '1 rue 7 lost jamila 2 tanger', 'fe@gmail.com', '0698574115', '', NULL, NULL, NULL, 1),
(49, 'fe', 'ben', '2018-12-12', '131598', '1 rue 7 lost jamila 2 tanger', 'fe@gmail.com', '0698574115', '', NULL, NULL, NULL, 1),
(50, 'fe', 'ben', '2018-12-12', '131598', '1 rue 7 lost jamila 2 tanger', 'fe@gmail.com', '0698574115', '', NULL, NULL, NULL, 1),
(51, 'fe', 'ben', '2018-12-12', '131598', '1 rue 7 lost jamila 2 tanger', 'fe@gmail.com', '0698574115', '', NULL, NULL, NULL, 1),
(52, 'fe', 'ben', '2018-12-12', '131598', '1 rue 7 lost jamila 2 tanger', 'fe@gmail.com', '0698574115', '', NULL, NULL, NULL, 1),
(53, 'fe', 'ben', '2018-12-12', '131598', '1 rue 7 lost jamila 2 tanger', 'fe@gmail.com', '0698574115', '', NULL, NULL, NULL, 1),
(54, 'fe', 'ben', '2018-12-12', '131598', '1 rue 7 lost jamila 2 tanger', 'fe@gmail.com', '0698574115', '', NULL, NULL, NULL, 1),
(55, 'fe', 'ben', '2018-12-12', '131598', '1 rue 7 lost jamila 2 tanger', 'fe@gmail.com', '0698574115', '', NULL, NULL, NULL, 1),
(56, 'fe', 'ben', '2018-12-12', '131598', '1 rue 7 lost jamila 2 tanger', 'fe@gmail.com', '0698574115', '', NULL, NULL, NULL, 1),
(57, 'fe', 'ben', '2018-12-12', '131598', '1 rue 7 lost jamila 2 tanger', 'fe@gmail.com', '0698574115', '', NULL, NULL, NULL, 1),
(58, 'fe', 'ben', '2018-12-12', '131598', '1 rue 7 lost jamila 2 tanger', 'fe@gmail.com', '0698574115', '', NULL, NULL, NULL, 1),
(59, 'fe', 'ben', '2018-12-12', '131598', '1 rue 7 lost jamila 2 tanger', 'fe@gmail.com', '0698574115', '', NULL, NULL, NULL, 1),
(60, 'fe', 'ben', '2018-12-12', '131598', '1 rue 7 lost jamila 2 tanger', 'fe@gmail.com', '0698574115', '', NULL, NULL, NULL, 1),
(61, 'fe', 'ben', '2018-12-12', '131598', '1 rue 7 lost jamila 2 tanger', 'fe@gmail.com', '0698574115', '', NULL, NULL, NULL, 1),
(62, 'fe', 'ben', '2018-12-12', '131598', '1 rue 7 lost jamila 2 tanger', 'fe@gmail.com', '0698574115', '', NULL, NULL, NULL, 1),
(63, 'fe', 'ben', '2018-12-12', '131598', '1 rue 7 lost jamila 2 tanger', 'fe@gmail.com', '0698574115', '', NULL, NULL, NULL, 1),
(64, 'fe', 'ben', '2018-12-12', '131598', '1 rue 7 lost jamila 2 tanger', 'fe@gmail.com', '0698574115', '', NULL, NULL, NULL, 1),
(65, 'fe', 'ben', '2018-12-12', '131598', '1 rue 7 lost jamila 2 tanger', 'fe@gmail.com', '0698574115', '', NULL, NULL, NULL, 1),
(66, 'fe', 'ben', '2018-12-12', '131598', '1 rue 7 lost jamila 2 tanger', 'fe@gmail.com', '0698574115', '', NULL, NULL, NULL, 1),
(67, 'fe', 'ben', '2018-12-12', '131598', '1 rue 7 lost jamila 2 tanger', 'fe@gmail.com', '0698574115', '', NULL, NULL, NULL, 1),
(68, 'fe', 'ben', '2018-12-12', '131598', '1 rue 7 lost jamila 2 tanger', 'fe@gmail.com', '0698574115', '', NULL, NULL, NULL, 1),
(69, 'fe', 'ben', '2018-12-12', '131598', '1 rue 7 lost jamila 2 tanger', 'fe@gmail.com', '0698574115', '', NULL, NULL, NULL, 1),
(70, 'fe', 'ben', '2018-12-12', '131598', '1 rue 7 lost jamila 2 tanger', 'fe@gmail.com', '0698574115', '', NULL, NULL, NULL, 1),
(71, 'fe', 'ben', '2018-12-12', '131598', '1 rue 7 lost jamila 2 tanger', 'fe@gmail.com', '0698574115', '', NULL, NULL, NULL, 1),
(72, 'fe', 'ben', '2018-12-12', '131598', '1 rue 7 lost jamila 2 tanger', 'fe@gmail.com', '0698574115', '', NULL, NULL, NULL, 1),
(73, 'fe', 'ben', '2018-12-12', '131598', '1 rue 7 lost jamila 2 tanger', 'fe@gmail.com', '0698574115', '', NULL, NULL, NULL, 1),
(74, 'fe', 'ben', '2018-12-12', '131598', '1 rue 7 lost jamila 2 tanger', 'fe@gmail.com', '0698574115', '', NULL, NULL, NULL, 1),
(75, 'fe', 'ben', '2018-12-12', '131598', '1 rue 7 lost jamila 2 tanger', 'fe@gmail.com', '0698574115', '', NULL, NULL, NULL, 1),
(76, 'fe', 'ben', '2018-12-12', '131598', '1 rue 7 lost jamila 2 tanger', 'fe@gmail.com', '0698574115', '', NULL, NULL, NULL, 1),
(77, 'fe', 'ben', '2018-12-12', '131598', '1 rue 7 lost jamila 2 tanger', 'fe@gmail.com', '0698574115', '', NULL, NULL, NULL, 1),
(78, 'fe', 'ben', '2018-12-12', '131598', '1 rue 7 lost jamila 2 tanger', 'fe@gmail.com', '0698574115', '', NULL, NULL, NULL, 1),
(79, 'fe', 'ben', '2018-12-12', '131598', '1 rue 7 lost jamila 2 tanger', 'fe@gmail.com', '0698574115', '', NULL, NULL, NULL, 1),
(80, 'fe', 'ben', '2018-12-12', '131598', '1 rue 7 lost jamila 2 tanger', 'fe@gmail.com', '0698574115', '', NULL, NULL, NULL, 1),
(81, 'fe', 'ben', '2018-12-12', '131598', '1 rue 7 lost jamila 2 tanger', 'fe@gmail.com', '0698574115', '', NULL, NULL, NULL, 1),
(82, 'fe', 'ben', '2018-12-12', '131598', '1 rue 7 lost jamila 2 tanger', 'fe@gmail.com', '0698574115', '', NULL, NULL, NULL, 1),
(83, 'fe', 'ben', '2018-12-12', '131598', '1 rue 7 lost jamila 2 tanger', 'fe@gmail.com', '0698574115', '', NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2018_12_10_135237_add_deletes_at_to_members', 1),
(2, '2018_12_11_094842_create_borrows_table', 2),
(3, '2018_12_11_100421_create_borrows_table', 3),
(4, '2018_12_11_104132_add_diposit_to_members', 4);

-- --------------------------------------------------------

--
-- Structure de la table `themes`
--

CREATE TABLE `themes` (
  `id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `themes`
--

INSERT INTO `themes` (`id`, `description`, `updated_at`, `created_at`) VALUES
(1, 'roman', '2018-12-10 11:22:19', '2018-12-10 11:22:19'),
(2, 'programming', '2018-12-10 11:22:33', '2018-12-10 11:22:33'),
(3, 'relégion', '2018-12-14 10:09:14', '2018-12-14 10:09:14'),
(4, 'children', '2018-12-14 10:09:26', '2018-12-14 10:09:26'),
(5, 'history', '2018-12-14 11:19:23', '2018-12-14 11:19:23'),
(6, 'Education', '2018-12-17 18:58:55', '2018-12-17 18:58:55'),
(7, 'coco', '2018-12-17 18:59:52', '2018-12-17 18:59:52'),
(8, 'Education', '2018-12-18 08:21:52', '2018-12-18 08:21:52'),
(9, 'Education', '2018-12-18 08:21:57', '2018-12-18 08:21:57');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `username`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(0, 'Anas', 'anasslam199@gmail.com', 'anasslam', NULL, '$2y$10$obabTZhgp4GSeYBS.KW7UuQBdnRtGu/kAVJMhmvI/C.wnrcgsKHse', 'FpuSZHiEIRK6cSGDDePaXjJPsrPgiG9ezn2WrJgy4YXtzhrswM9gwsdiuD5t', '2018-12-10 12:23:10', '2018-12-10 12:23:10');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `theme_id` (`theme_id`);

--
-- Index pour la table `borrows`
--
ALTER TABLE `borrows`
  ADD PRIMARY KEY (`id`),
  ADD KEY `borrows_members_id_foreign` (`member_id`),
  ADD KEY `borrows_books_id_foreign` (`book_id`);

--
-- Index pour la table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `themes`
--
ALTER TABLE `themes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `borrows`
--
ALTER TABLE `borrows`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `themes`
--
ALTER TABLE `themes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`theme_id`) REFERENCES `themes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `borrows`
--
ALTER TABLE `borrows`
  ADD CONSTRAINT `borrows_books_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `borrows_members_id_foreign` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
