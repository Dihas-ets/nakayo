-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 10 avr. 2026 à 07:32
-- Version du serveur : 10.4.24-MariaDB
-- Version de PHP : 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `laravel`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE `articles` (
  `id_article` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `id_categorie` bigint(20) UNSIGNED NOT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tag` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vue` int(11) NOT NULL DEFAULT 0,
  `status` enum('brouillon','publié') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'brouillon',
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `likes` int(11) NOT NULL DEFAULT 0,
  `media` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `featured` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

CREATE TABLE `avis` (
  `id_avis` bigint(20) UNSIGNED NOT NULL,
  `id_article` bigint(20) UNSIGNED DEFAULT NULL,
  `id_service` bigint(20) UNSIGNED DEFAULT NULL,
  `nom_auteur` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_auteur` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` int(11) NOT NULL DEFAULT 5,
  `commentaire` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('en_attente','approuvé','rejeté') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en_attente',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id_categorie` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id_categorie`, `nom`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Énergies Renouvelables', 'energies-renouvelables', 1, '2026-04-07 16:00:39', '2026-04-07 16:00:39'),
(3, 'Immobilier', 'immobilier', 1, '2026-04-09 07:10:14', '2026-04-09 07:10:14');

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

CREATE TABLE `commentaires` (
  `id_commentaire` bigint(20) UNSIGNED NOT NULL,
  `id_article` bigint(20) UNSIGNED NOT NULL,
  `nom_auteur` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_auteur` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contenu` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `statut` enum('en_attente','approuvé','rejeté') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en_attente',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `company_settings`
--

CREATE TABLE `company_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ifu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nom_agence` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `annee_creation` year(4) DEFAULT NULL,
  `statut_juridique` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `numero_rccm` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telephone_appel` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telephone_whatsapp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `localisation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google_maps_link` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook_link` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram_link` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin_link` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `availability_hours` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jours_ouverture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `horaires_ouverture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `company_settings`
--

INSERT INTO `company_settings` (`id`, `ifu`, `nom_agence`, `annee_creation`, `statut_juridique`, `numero_rccm`, `telephone_appel`, `telephone_whatsapp`, `email`, `localisation`, `google_maps_link`, `facebook_link`, `instagram_link`, `linkedin_link`, `availability_hours`, `jours_ouverture`, `horaires_ouverture`, `created_at`, `updated_at`) VALUES
(1, NULL, 'NAKAYO CORPORATION Sarl', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-07 06:29:39', '2026-04-07 06:29:39');

-- --------------------------------------------------------

--
-- Structure de la table `equipe`
--

CREATE TABLE `equipe` (
  `id_membre` bigint(20) UNSIGNED NOT NULL,
  `nom_complet` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `poste` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ordre` int(11) NOT NULL DEFAULT 0,
  `statut` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `formations`
--

CREATE TABLE `formations` (
  `id_formation` bigint(20) UNSIGNED NOT NULL,
  `id_service` bigint(20) UNSIGNED NOT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lieu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_formation` datetime DEFAULT NULL,
  `cout` decimal(10,2) DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'disponible',
  `contact` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `galleries`
--

CREATE TABLE `galleries` (
  `id_gallerie` bigint(20) UNSIGNED NOT NULL,
  `id_service` bigint(20) UNSIGNED DEFAULT NULL,
  `id_produit` bigint(20) UNSIGNED DEFAULT NULL,
  `type_media` enum('image','video') COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `galleries`
--

INSERT INTO `galleries` (`id_gallerie`, `id_service`, `id_produit`, `type_media`, `link`, `image_url`, `created_at`, `updated_at`) VALUES
(45, 21, NULL, 'image', NULL, 'gallery/YtjQ3onNtIVMu61cl45ZOblluCU5et9wqsJiOhDN.jpg', '2026-04-08 11:58:24', '2026-04-08 11:58:24'),
(46, 21, NULL, 'image', NULL, 'gallery/4IVCb7hsJ1LnbEp9neUEmfib16VE0FS5JyEUtTlg.webp', '2026-04-08 11:58:25', '2026-04-08 11:58:25'),
(47, 21, NULL, 'image', NULL, 'gallery/KZFazU1NlXq82OH9iifVobdkld6Xwgzk7XCiMkxi.webp', '2026-04-08 11:58:25', '2026-04-08 11:58:25'),
(48, 21, NULL, 'image', NULL, 'gallery/epqlyYCCFilJBuRdnMJVk1hhL8s4zB77A9uGRNOv.jpg', '2026-04-08 11:58:25', '2026-04-08 11:58:25'),
(49, 21, NULL, 'video', 'https://www.youtube.com/watch?v=9byD3uYzQzk&list=PPSV', NULL, '2026-04-08 11:58:25', '2026-04-08 11:58:25'),
(50, 22, NULL, 'image', NULL, 'gallery/M3I5YMbmRRG7OGgfdtCWk4RdMRUkPFd07JeAD7gf.jpg', '2026-04-09 08:11:10', '2026-04-09 08:11:10'),
(51, 22, NULL, 'image', NULL, 'gallery/25dHxe60MDeiKBm6U8qWkBxLmopLgxQyxAB9haE1.png', '2026-04-09 08:11:10', '2026-04-09 08:11:10'),
(52, 22, NULL, 'image', NULL, 'gallery/M5eXGxelr88Krzo6DPD5ggiSGZ0ryZ1UVGIuaMjm.jpg', '2026-04-09 08:11:10', '2026-04-09 08:11:10'),
(53, 22, NULL, 'image', NULL, 'gallery/3ORlPjbDbD1YBgzI6gGGJFEY4VvKcxxfS07Sm4Q1.jpg', '2026-04-09 08:11:10', '2026-04-09 08:11:10'),
(54, 22, NULL, 'video', 'https://www.youtube.com/watch?v=9byD3uYzQzk&list=PPSV', NULL, '2026-04-09 08:11:10', '2026-04-09 08:11:10'),
(55, 23, NULL, 'image', NULL, 'gallery/pWinIr69mFXBgANmr6XkUEAKJtUPGSrg3x2iKAbH.jpg', '2026-04-09 08:12:21', '2026-04-09 08:12:21'),
(56, 23, NULL, 'image', NULL, 'gallery/mnNgeLt4dKoeSWvt5tNSiHirRefcPnd8Mom5d9V4.jpg', '2026-04-09 08:12:21', '2026-04-09 08:12:21'),
(57, 23, NULL, 'image', NULL, 'gallery/A4YNX3ScQSFDmPIZ7vrCiEW76Xl1wdYIQGdVs0yY.jpg', '2026-04-09 08:12:21', '2026-04-09 08:12:21'),
(58, 23, NULL, 'image', NULL, 'gallery/QHkq3LAz5jpJtEPXTmip0KyyQiveXsAFPERrLs4K.jpg', '2026-04-09 08:12:22', '2026-04-09 08:12:22'),
(59, 23, NULL, 'video', 'https://www.youtube.com/watch?v=9byD3uYzQzk&list=PPSV', NULL, '2026-04-09 08:12:22', '2026-04-09 08:12:22'),
(60, 24, NULL, 'image', NULL, 'gallery/YajYiEZalRKmXl2LLqHMp8kwSSFLJKKQwMG1PrWN.jpg', '2026-04-09 08:15:51', '2026-04-09 08:15:51'),
(61, 24, NULL, 'image', NULL, 'gallery/4s5scgRznqh4a7crqURjE1y0Jf1P8WiiHzkMeMru.jpg', '2026-04-09 08:15:51', '2026-04-09 08:15:51'),
(62, 24, NULL, 'image', NULL, 'gallery/Ob93RocuLYXWcmERSHssOG6EXf0bMwX5pHyd93ho.jpg', '2026-04-09 08:15:52', '2026-04-09 08:15:52');

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2026_03_30_143918_create_all_tables', 1),
(3, '2026_04_05_193027_create_avis_table', 1),
(4, '2026_04_05_210138_create_tags_table', 1),
(5, '2026_04_06_154232_add_commentaire_to_articles_table', 1),
(6, '2026_04_06_161822_add_details_to_articles', 1),
(7, '2026_04_06_175312_create_notifications_table', 1),
(8, '2026_04_06_221814_add_nom_to_produits_table', 1),
(9, '2026_04_07_042022_create_recrutements_table', 1),
(10, '2026_04_07_044856_create_commentaires_table', 1),
(11, '2026_04_07_052758_create_company_settings_table', 1),
(12, '2026_04_08_035302_create_equipe_table', 2),
(13, '2026_04_08_043317_create_projets_table', 3),
(14, '2026_04_08_073514_update_status_in_formations_table', 4),
(15, '2026_04_09_102511_add_status_to_services_table', 5);

-- --------------------------------------------------------

--
-- Structure de la table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE `produits` (
  `id_produit` bigint(20) UNSIGNED NOT NULL,
  `id_service` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prix` decimal(10,2) DEFAULT NULL,
  `statut` enum('disponible','en_rupture') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'disponible',
  `contact` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id_produit`, `id_service`, `nom`, `image`, `description`, `prix`, `statut`, `contact`, `created_at`, `updated_at`) VALUES
(4, 21, 'Savon', 'produits/l01i1KutjsCANYa47rJ1kOSuKmRYvllQCWw4jI5q.jpg', 'dcrddxsefsxedrd', NULL, 'disponible', '229 01 66 55 61 61', '2026-04-08 12:50:01', '2026-04-08 20:17:21'),
(8, 21, 'Immobilier', 'produits/hilsdXqTFcQfny40JNh3627bZTiCTrl7LSlktzWl.webp', 'ini,kkkjkhji', NULL, 'disponible', '+229 94327964', '2026-04-08 20:42:42', '2026-04-08 20:42:42'),
(9, 23, 'Bureautique', 'produits/n3smlfKpztQrI6G7GODmcfg4ChIgIxfILm3g4EbP.jpg', ';mo;ol;;pmml', NULL, 'disponible', '+229 94327964', '2026-04-09 08:19:41', '2026-04-09 08:19:41'),
(10, 22, 'Savon', 'produits/wUzJ3uncuFNpfwZDnvL6dqaidCPYG342oZ8yGtfx.jpg', 'okmpppppppppkl', NULL, 'disponible', '+229 94327964', '2026-04-09 08:20:35', '2026-04-09 08:20:35'),
(11, 25, 'Immobilier', 'produits/MdnkgzwMdqTsmNmyMYRcIBfJFSoNbqn7DkaL6VEK.jpg', 'm;po;lm;lm:', NULL, 'disponible', '+229 94327964', '2026-04-09 08:21:17', '2026-04-09 08:21:17'),
(12, 24, 'piscine', 'produits/llb0ZSanEvdheIERRYQpVVfRGfv9fWghOWhJ5xf2.webp', ',kmol;mmpl', NULL, 'disponible', '+229 94327964', '2026-04-09 08:22:26', '2026-04-09 08:22:26');

-- --------------------------------------------------------

--
-- Structure de la table `projets`
--

CREATE TABLE `projets` (
  `id_projet` bigint(20) UNSIGNED NOT NULL,
  `id_service` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `lieu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_realisation` date DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('brouillon','publié') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'publié',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `recrutements`
--

CREATE TABLE `recrutements` (
  `id_recrutement` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `lieu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `agence` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('CDI','CDD','Mission','Stage','Freelance') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'CDI',
  `date_limite` date NOT NULL,
  `email_whatsapp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('brouillon','publié','cloturé') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'brouillon',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `recrutements`
--

INSERT INTO `recrutements` (`id_recrutement`, `nom`, `image`, `description`, `lieu`, `agence`, `type`, `date_limite`, `email_whatsapp`, `status`, `created_at`, `updated_at`) VALUES
(4, 'Bureautique', 'recrutements/QlH3cftM2m94k7vSJgVn8mbhNyfz84WPVxOAmRj5.jpg', 'urjfuresqsrgdhfjhujiklpkojliuruhjhkh', 'calavi', 'caboma', 'CDI', '2026-04-30', 'recrutement@gmail.com', 'publié', '2026-04-08 04:12:24', '2026-04-08 04:12:24');

-- --------------------------------------------------------

--
-- Structure de la table `services`
--

CREATE TABLE `services` (
  `id_service` bigint(20) UNSIGNED NOT NULL,
  `media` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `courte_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('publié','brouillon') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'publié',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `services`
--

INSERT INTO `services` (`id_service`, `media`, `titre`, `courte_description`, `description`, `status`, `created_at`, `updated_at`) VALUES
(21, 'defaults/default-service.jpg', 'Agro industrie et élevage', 'lpl;:p:,m;', 'mll;mkop;ml;:', 'publié', '2026-04-08 11:58:23', '2026-04-08 11:58:23'),
(22, 'defaults/default-service.jpg', 'Savonnerie', 'mokkkkkkkl', 'kj,kl:,;l;moiomkooopk', 'publié', '2026-04-09 08:11:09', '2026-04-09 08:11:09'),
(23, 'services/YG2xHbowSec2XUEJX6rIBkAnEVyLGtZNQKi6rns4.jpg', 'Papeterie', 'mpkom', 'koopikàçopl', 'publié', '2026-04-09 08:12:21', '2026-04-09 08:12:21'),
(24, 'defaults/default-service.jpg', 'Construction Piscine', 'kom', ',lkopm;lmmm', 'publié', '2026-04-09 08:15:51', '2026-04-09 08:15:51'),
(25, 'services/InzqRC0TLsG4vPiF5viv7rix9Y16YgVbDsuR3olr.jpg', 'NAKAYO Immobilier', 'klkk', 'k,;lk', 'publié', '2026-04-09 08:17:41', '2026-04-09 08:17:41');

-- --------------------------------------------------------

--
-- Structure de la table `tags`
--

CREATE TABLE `tags` (
  `id_tag` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `tags`
--

INSERT INTO `tags` (`id_tag`, `nom`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Bureautique', 'bureautique', '2026-04-07 06:42:47', '2026-04-07 06:42:47');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `nom_complet` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','abonné','rédacteur') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'abonné',
  `telephone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `confirm_password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_user`, `nom_complet`, `email`, `role`, `telephone`, `password`, `confirm_password`, `created_at`, `updated_at`) VALUES
(1, 'Administrateur Principal', 'admin@accessfinance.bj', 'admin', '+229 00 00 00 01', '$2y$12$Lg//uKkUYAM0S5QVfvall.SSY9Zfw86KeTqlZqfzibVw80VX74KUq', 'admin1234', '2026-04-07 06:29:44', '2026-04-07 06:29:44'),
(2, 'Jean Rédacteur', 'redacteur@accessfinance.bj', 'rédacteur', '+229 00 00 00 02', '$2y$12$A7BqwfhgF2/FWuhYAlvwm.Wsob4rbUc74F91iANFtWVzJvmJUshhC', 'redac1234', '2026-04-07 06:29:45', '2026-04-07 06:29:45'),
(3, 'Mr Matinou', 'houhadoris1@gmail.com', 'admin', '94327954', '$2y$12$mJ7HsVmOiJl4eJE.wJ91Bu2Ko6yWaQ2zR7.WPOrFvseSmprxdkyNu', 'matinou1234', '2026-04-07 06:34:58', '2026-04-07 06:34:58'),
(4, 'Koubourath', 'i7285800@gmail.com', 'rédacteur', '94327954', '$2y$12$V7/8N2v9ftd4fHRnx5GfvutU.cAaN8iyXTEkmHFc2TuuICF0Je2om', 'koubourath1234', '2026-04-07 06:36:11', '2026-04-07 06:36:11'),
(5, 'Inès', 'ines@gmail.com', 'abonné', '94327954', '$2y$12$O/ahil0Uowe8NWOOC1XsWO2edRMS8alwr9u.UgtZLdhy3aUt7TbcW', 'ines1234', '2026-04-07 06:36:59', '2026-04-07 06:36:59');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id_article`),
  ADD UNIQUE KEY `articles_slug_unique` (`slug`),
  ADD KEY `articles_id_user_foreign` (`id_user`),
  ADD KEY `articles_id_categorie_foreign` (`id_categorie`);

--
-- Index pour la table `avis`
--
ALTER TABLE `avis`
  ADD PRIMARY KEY (`id_avis`),
  ADD KEY `avis_id_article_foreign` (`id_article`),
  ADD KEY `avis_id_service_foreign` (`id_service`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_categorie`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Index pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD PRIMARY KEY (`id_commentaire`),
  ADD KEY `commentaires_id_article_foreign` (`id_article`);

--
-- Index pour la table `company_settings`
--
ALTER TABLE `company_settings`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `equipe`
--
ALTER TABLE `equipe`
  ADD PRIMARY KEY (`id_membre`);

--
-- Index pour la table `formations`
--
ALTER TABLE `formations`
  ADD PRIMARY KEY (`id_formation`),
  ADD KEY `formations_id_service_foreign` (`id_service`);

--
-- Index pour la table `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`id_gallerie`),
  ADD KEY `galleries_id_service_foreign` (`id_service`),
  ADD KEY `galleries_id_produit_foreign` (`id_produit`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Index pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Index pour la table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`id_produit`),
  ADD KEY `produits_id_service_foreign` (`id_service`);

--
-- Index pour la table `projets`
--
ALTER TABLE `projets`
  ADD PRIMARY KEY (`id_projet`),
  ADD KEY `projets_id_service_foreign` (`id_service`);

--
-- Index pour la table `recrutements`
--
ALTER TABLE `recrutements`
  ADD PRIMARY KEY (`id_recrutement`);

--
-- Index pour la table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id_service`);

--
-- Index pour la table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id_tag`),
  ADD UNIQUE KEY `tags_nom_unique` (`nom`),
  ADD UNIQUE KEY `tags_slug_unique` (`slug`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `articles`
--
ALTER TABLE `articles`
  MODIFY `id_article` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `avis`
--
ALTER TABLE `avis`
  MODIFY `id_avis` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id_categorie` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `commentaires`
--
ALTER TABLE `commentaires`
  MODIFY `id_commentaire` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `company_settings`
--
ALTER TABLE `company_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `equipe`
--
ALTER TABLE `equipe`
  MODIFY `id_membre` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `formations`
--
ALTER TABLE `formations`
  MODIFY `id_formation` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id_gallerie` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE `produits`
  MODIFY `id_produit` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `projets`
--
ALTER TABLE `projets`
  MODIFY `id_projet` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `recrutements`
--
ALTER TABLE `recrutements`
  MODIFY `id_recrutement` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `services`
--
ALTER TABLE `services`
  MODIFY `id_service` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT pour la table `tags`
--
ALTER TABLE `tags`
  MODIFY `id_tag` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_id_categorie_foreign` FOREIGN KEY (`id_categorie`) REFERENCES `categories` (`id_categorie`) ON DELETE CASCADE,
  ADD CONSTRAINT `articles_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE;

--
-- Contraintes pour la table `avis`
--
ALTER TABLE `avis`
  ADD CONSTRAINT `avis_id_article_foreign` FOREIGN KEY (`id_article`) REFERENCES `articles` (`id_article`) ON DELETE CASCADE,
  ADD CONSTRAINT `avis_id_service_foreign` FOREIGN KEY (`id_service`) REFERENCES `services` (`id_service`) ON DELETE CASCADE;

--
-- Contraintes pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD CONSTRAINT `commentaires_id_article_foreign` FOREIGN KEY (`id_article`) REFERENCES `articles` (`id_article`) ON DELETE CASCADE;

--
-- Contraintes pour la table `formations`
--
ALTER TABLE `formations`
  ADD CONSTRAINT `formations_id_service_foreign` FOREIGN KEY (`id_service`) REFERENCES `services` (`id_service`) ON DELETE CASCADE;

--
-- Contraintes pour la table `galleries`
--
ALTER TABLE `galleries`
  ADD CONSTRAINT `galleries_id_produit_foreign` FOREIGN KEY (`id_produit`) REFERENCES `produits` (`id_produit`) ON DELETE SET NULL,
  ADD CONSTRAINT `galleries_id_service_foreign` FOREIGN KEY (`id_service`) REFERENCES `services` (`id_service`) ON DELETE SET NULL;

--
-- Contraintes pour la table `produits`
--
ALTER TABLE `produits`
  ADD CONSTRAINT `produits_id_service_foreign` FOREIGN KEY (`id_service`) REFERENCES `services` (`id_service`) ON DELETE CASCADE;

--
-- Contraintes pour la table `projets`
--
ALTER TABLE `projets`
  ADD CONSTRAINT `projets_id_service_foreign` FOREIGN KEY (`id_service`) REFERENCES `services` (`id_service`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
