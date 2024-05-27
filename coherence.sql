-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 12 déc. 2023 à 02:41
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `coherence`
--

-- --------------------------------------------------------

--
-- Structure de la table `actions`
--

CREATE TABLE `actions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `action` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `date` date DEFAULT NULL,
  `poste_id` bigint(20) UNSIGNED NOT NULL,
  `risque_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `action_ams`
--

CREATE TABLE `action_ams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `action` varchar(255) NOT NULL,
  `poste_id` bigint(20) UNSIGNED NOT NULL,
  `risque_id` bigint(20) UNSIGNED DEFAULT NULL,
  `risque_id_am` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ameliorations`
--

CREATE TABLE `ameliorations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `date_fiche` date NOT NULL,
  `lieu` varchar(255) NOT NULL,
  `detecteur` varchar(255) NOT NULL,
  `non_conformite` varchar(255) NOT NULL,
  `consequence` text NOT NULL,
  `cause` text NOT NULL,
  `choix_select` varchar(255) NOT NULL,
  `statut` varchar(255) NOT NULL,
  `date_validation` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `autorisations`
--

CREATE TABLE `autorisations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `new_user` varchar(255) NOT NULL,
  `list_user` varchar(255) NOT NULL,
  `new_poste` varchar(255) NOT NULL,
  `list_poste` varchar(255) NOT NULL,
  `historiq` varchar(255) NOT NULL,
  `stat` varchar(255) NOT NULL,
  `new_proces` varchar(255) NOT NULL,
  `list_proces` varchar(255) NOT NULL,
  `eva_proces` varchar(255) NOT NULL,
  `new_risk` varchar(255) NOT NULL,
  `list_risk` varchar(255) NOT NULL,
  `val_risk` varchar(255) NOT NULL,
  `act_n_val` varchar(255) NOT NULL,
  `suivi_actp` varchar(255) NOT NULL,
  `list_actp` varchar(255) NOT NULL,
  `suivi_actc` varchar(255) NOT NULL,
  `list_actc_eff` varchar(255) NOT NULL,
  `list_actc` varchar(255) NOT NULL,
  `fiche_am` varchar(255) NOT NULL,
  `list_am` varchar(255) NOT NULL,
  `val_am` varchar(255) NOT NULL,
  `am_n_val` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `autorisations`
--

INSERT INTO `autorisations` (`id`, `new_user`, `list_user`, `new_poste`, `list_poste`, `historiq`, `stat`, `new_proces`, `list_proces`, `eva_proces`, `new_risk`, `list_risk`, `val_risk`, `act_n_val`, `suivi_actp`, `list_actp`, `suivi_actc`, `list_actc_eff`, `list_actc`, `fiche_am`, `list_am`, `val_am`, `am_n_val`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'oui', 'oui', 'oui', 'oui', 'oui', 'oui', 'oui', 'oui', 'oui', 'oui', 'oui', 'oui', 'oui', 'oui', 'oui', 'oui', 'oui', 'oui', 'oui', 'oui', 'oui', 'oui', 1, '2023-12-12 01:40:04', '2023-12-12 01:40:04');

-- --------------------------------------------------------

--
-- Structure de la table `causes`
--

CREATE TABLE `causes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `dispositif` varchar(255) DEFAULT NULL,
  `risque_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `causetrouvers`
--

CREATE TABLE `causetrouvers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `amelioration_id` bigint(20) UNSIGNED NOT NULL,
  `cause_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `cause_ams`
--

CREATE TABLE `cause_ams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `risque_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `historique_actions`
--

CREATE TABLE `historique_actions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom_formulaire` varchar(255) NOT NULL,
  `nom_action` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(285, '2013_11_09_084133_create_postes_table', 1),
(286, '2014_10_11_000000_create_users_table', 1),
(287, '2014_10_12_100000_create_password_resets_table', 1),
(288, '2019_08_19_000000_create_failed_jobs_table', 1),
(289, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(290, '2023_10_10_114949_create_processuses_table', 1),
(291, '2023_10_10_115038_create_objectifs_table', 1),
(292, '2023_10_11_225439_create_risques_table', 1),
(293, '2023_10_11_225524_create_causes_table', 1),
(294, '2023_10_13_150745_create_rejets_table', 1),
(295, '2023_10_14_221834_create_actions_table', 1),
(296, '2023_10_17_093423_create_suivi_actions_table', 1),
(297, '2023_10_23_162437_create_pdf_files_table', 1),
(298, '2023_11_04_103429_create_historique_actions_table', 1),
(299, '2023_11_07_000846_create_sessions_table', 1),
(300, '2023_11_10_231839_create_ameliorations_table', 1),
(301, '2023_11_18_212815_create_pdf_file_processuses_table', 1),
(302, '2023_11_19_202300_create_causetrouvers_table', 1),
(303, '2023_11_19_203753_create_risquetrouvers_table', 1),
(304, '2023_11_27_005841_create_risque_ams_table', 1),
(305, '2023_11_27_012326_create_suivi_ameliorations_table', 1),
(306, '2023_11_27_041011_create_cause_ams_table', 1),
(307, '2023_11_27_130412_create_action_ams_table', 1),
(308, '2023_12_07_223510_create_autorisations_table', 1),
(309, '2023_12_10_231543_create_rejet_ams_table', 1);

-- --------------------------------------------------------

--
-- Structure de la table `objectifs`
--

CREATE TABLE `objectifs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `processus_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `pdf_files`
--

CREATE TABLE `pdf_files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pdf_nom` varchar(255) NOT NULL,
  `pdf_chemin` varchar(255) NOT NULL,
  `risque_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `pdf_file_processuses`
--

CREATE TABLE `pdf_file_processuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pdf_nom` varchar(255) NOT NULL,
  `pdf_chemin` varchar(255) NOT NULL,
  `processus_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `postes`
--

CREATE TABLE `postes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `postes`
--

INSERT INTO `postes` (`id`, `nom`, `created_at`, `updated_at`) VALUES
(1, 'CONTRÔLEUR', '2023-12-12 01:40:03', '2023-12-12 01:40:03'),
(2, 'OPÉRATEUR DE SAISIE', '2023-12-12 01:40:03', '2023-12-12 01:40:03'),
(3, 'ADMINISTRATEUR', '2023-12-12 01:40:03', '2023-12-12 01:40:03'),
(4, 'PRODUCTION', '2023-12-12 01:40:04', '2023-12-12 01:40:04'),
(5, 'VALIDATEUR', '2023-12-12 01:40:04', '2023-12-12 01:40:04');

-- --------------------------------------------------------

--
-- Structure de la table `processuses`
--

CREATE TABLE `processuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `finalite` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `rejets`
--

CREATE TABLE `rejets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `motif` text NOT NULL,
  `risque_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `rejet_ams`
--

CREATE TABLE `rejet_ams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `motif` text NOT NULL,
  `amelioration_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `risques`
--

CREATE TABLE `risques` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `vraisemblence` int(11) DEFAULT NULL,
  `gravite` int(11) DEFAULT NULL,
  `evaluation` int(11) DEFAULT NULL,
  `cout` varchar(255) DEFAULT NULL,
  `traitement` varchar(255) DEFAULT NULL,
  `statut` varchar(255) DEFAULT NULL,
  `vraisemblence_residuel` int(11) DEFAULT NULL,
  `gravite_residuel` int(11) DEFAULT NULL,
  `evaluation_residuel` int(11) DEFAULT NULL,
  `cout_residuel` varchar(255) DEFAULT NULL,
  `date_validation` datetime DEFAULT NULL,
  `commentaire` text DEFAULT NULL,
  `processus_id` bigint(20) UNSIGNED NOT NULL,
  `poste_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `risquetrouvers`
--

CREATE TABLE `risquetrouvers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `amelioration_id` bigint(20) UNSIGNED NOT NULL,
  `risque_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `risque_ams`
--

CREATE TABLE `risque_ams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `processus_id` bigint(20) UNSIGNED NOT NULL,
  `poste_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` text NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `suivi_actions`
--

CREATE TABLE `suivi_actions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `efficacite` varchar(255) DEFAULT NULL,
  `commentaire` text DEFAULT NULL,
  `date_action` date DEFAULT NULL,
  `date_suivi` datetime DEFAULT NULL,
  `delai` date DEFAULT NULL,
  `statut` varchar(255) DEFAULT NULL,
  `action_id` bigint(20) UNSIGNED NOT NULL,
  `processus_id` bigint(20) UNSIGNED NOT NULL,
  `risque_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `suivi_ameliorations`
--

CREATE TABLE `suivi_ameliorations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `efficacite` varchar(255) DEFAULT NULL,
  `nature` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `commentaire` text DEFAULT NULL,
  `trouve` text DEFAULT NULL,
  `commentaire_am` text DEFAULT NULL,
  `date_action` date DEFAULT NULL,
  `date_suivi` datetime DEFAULT NULL,
  `delai` date DEFAULT NULL,
  `statut` varchar(255) DEFAULT NULL,
  `amelioration_id` bigint(20) UNSIGNED NOT NULL,
  `action_id` bigint(20) UNSIGNED NOT NULL,
  `risque_id` bigint(20) UNSIGNED DEFAULT NULL,
  `risque_id_am` bigint(20) UNSIGNED DEFAULT NULL,
  `cause_id` bigint(20) UNSIGNED DEFAULT NULL,
  `processus_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `poste_id` bigint(20) UNSIGNED NOT NULL,
  `tel` varchar(255) NOT NULL,
  `matricule` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `poste_id`, `tel`, `matricule`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'David Kouachi', 'david@gmail.com', NULL, '$2y$10$kvA.xiZnOlGUwBYaX8Fcbutdq7ovuwsHLRQE/n7gdFH3fYFsaTZni', 1, '0585782723', 'C123456', NULL, '2023-12-12 01:40:04', '2023-12-12 01:40:04');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `actions`
--
ALTER TABLE `actions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `actions_poste_id_foreign` (`poste_id`),
  ADD KEY `actions_risque_id_foreign` (`risque_id`);

--
-- Index pour la table `action_ams`
--
ALTER TABLE `action_ams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `action_ams_poste_id_foreign` (`poste_id`),
  ADD KEY `action_ams_risque_id_foreign` (`risque_id`),
  ADD KEY `action_ams_risque_id_am_foreign` (`risque_id_am`);

--
-- Index pour la table `ameliorations`
--
ALTER TABLE `ameliorations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `autorisations`
--
ALTER TABLE `autorisations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `autorisations_user_id_foreign` (`user_id`);

--
-- Index pour la table `causes`
--
ALTER TABLE `causes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `causes_risque_id_foreign` (`risque_id`);

--
-- Index pour la table `causetrouvers`
--
ALTER TABLE `causetrouvers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `causetrouvers_amelioration_id_foreign` (`amelioration_id`),
  ADD KEY `causetrouvers_cause_id_foreign` (`cause_id`);

--
-- Index pour la table `cause_ams`
--
ALTER TABLE `cause_ams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cause_ams_risque_id_foreign` (`risque_id`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `historique_actions`
--
ALTER TABLE `historique_actions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `historique_actions_user_id_foreign` (`user_id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `objectifs`
--
ALTER TABLE `objectifs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `objectifs_processus_id_foreign` (`processus_id`);

--
-- Index pour la table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Index pour la table `pdf_files`
--
ALTER TABLE `pdf_files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pdf_files_risque_id_foreign` (`risque_id`);

--
-- Index pour la table `pdf_file_processuses`
--
ALTER TABLE `pdf_file_processuses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pdf_file_processuses_processus_id_foreign` (`processus_id`);

--
-- Index pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Index pour la table `postes`
--
ALTER TABLE `postes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `processuses`
--
ALTER TABLE `processuses`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `rejets`
--
ALTER TABLE `rejets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rejets_risque_id_foreign` (`risque_id`);

--
-- Index pour la table `rejet_ams`
--
ALTER TABLE `rejet_ams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rejet_ams_amelioration_id_foreign` (`amelioration_id`);

--
-- Index pour la table `risques`
--
ALTER TABLE `risques`
  ADD PRIMARY KEY (`id`),
  ADD KEY `risques_processus_id_foreign` (`processus_id`),
  ADD KEY `risques_poste_id_foreign` (`poste_id`);

--
-- Index pour la table `risquetrouvers`
--
ALTER TABLE `risquetrouvers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `risquetrouvers_amelioration_id_foreign` (`amelioration_id`),
  ADD KEY `risquetrouvers_risque_id_foreign` (`risque_id`);

--
-- Index pour la table `risque_ams`
--
ALTER TABLE `risque_ams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `risque_ams_processus_id_foreign` (`processus_id`),
  ADD KEY `risque_ams_poste_id_foreign` (`poste_id`);

--
-- Index pour la table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Index pour la table `suivi_actions`
--
ALTER TABLE `suivi_actions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `suivi_actions_action_id_foreign` (`action_id`),
  ADD KEY `suivi_actions_processus_id_foreign` (`processus_id`),
  ADD KEY `suivi_actions_risque_id_foreign` (`risque_id`);

--
-- Index pour la table `suivi_ameliorations`
--
ALTER TABLE `suivi_ameliorations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `suivi_ameliorations_amelioration_id_foreign` (`amelioration_id`),
  ADD KEY `suivi_ameliorations_action_id_foreign` (`action_id`),
  ADD KEY `suivi_ameliorations_risque_id_foreign` (`risque_id`),
  ADD KEY `suivi_ameliorations_risque_id_am_foreign` (`risque_id_am`),
  ADD KEY `suivi_ameliorations_cause_id_foreign` (`cause_id`),
  ADD KEY `suivi_ameliorations_processus_id_foreign` (`processus_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_matricule_unique` (`matricule`),
  ADD KEY `users_poste_id_foreign` (`poste_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `actions`
--
ALTER TABLE `actions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `action_ams`
--
ALTER TABLE `action_ams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ameliorations`
--
ALTER TABLE `ameliorations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `autorisations`
--
ALTER TABLE `autorisations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `causes`
--
ALTER TABLE `causes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `causetrouvers`
--
ALTER TABLE `causetrouvers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `cause_ams`
--
ALTER TABLE `cause_ams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `historique_actions`
--
ALTER TABLE `historique_actions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=310;

--
-- AUTO_INCREMENT pour la table `objectifs`
--
ALTER TABLE `objectifs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pdf_files`
--
ALTER TABLE `pdf_files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pdf_file_processuses`
--
ALTER TABLE `pdf_file_processuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `postes`
--
ALTER TABLE `postes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `processuses`
--
ALTER TABLE `processuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `rejets`
--
ALTER TABLE `rejets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `rejet_ams`
--
ALTER TABLE `rejet_ams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `risques`
--
ALTER TABLE `risques`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `risquetrouvers`
--
ALTER TABLE `risquetrouvers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `risque_ams`
--
ALTER TABLE `risque_ams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `suivi_actions`
--
ALTER TABLE `suivi_actions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `suivi_ameliorations`
--
ALTER TABLE `suivi_ameliorations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `actions`
--
ALTER TABLE `actions`
  ADD CONSTRAINT `actions_poste_id_foreign` FOREIGN KEY (`poste_id`) REFERENCES `postes` (`id`),
  ADD CONSTRAINT `actions_risque_id_foreign` FOREIGN KEY (`risque_id`) REFERENCES `risques` (`id`);

--
-- Contraintes pour la table `action_ams`
--
ALTER TABLE `action_ams`
  ADD CONSTRAINT `action_ams_poste_id_foreign` FOREIGN KEY (`poste_id`) REFERENCES `postes` (`id`),
  ADD CONSTRAINT `action_ams_risque_id_am_foreign` FOREIGN KEY (`risque_id_am`) REFERENCES `risque_ams` (`id`),
  ADD CONSTRAINT `action_ams_risque_id_foreign` FOREIGN KEY (`risque_id`) REFERENCES `risques` (`id`);

--
-- Contraintes pour la table `autorisations`
--
ALTER TABLE `autorisations`
  ADD CONSTRAINT `autorisations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `causes`
--
ALTER TABLE `causes`
  ADD CONSTRAINT `causes_risque_id_foreign` FOREIGN KEY (`risque_id`) REFERENCES `risques` (`id`);

--
-- Contraintes pour la table `causetrouvers`
--
ALTER TABLE `causetrouvers`
  ADD CONSTRAINT `causetrouvers_amelioration_id_foreign` FOREIGN KEY (`amelioration_id`) REFERENCES `ameliorations` (`id`),
  ADD CONSTRAINT `causetrouvers_cause_id_foreign` FOREIGN KEY (`cause_id`) REFERENCES `causes` (`id`);

--
-- Contraintes pour la table `cause_ams`
--
ALTER TABLE `cause_ams`
  ADD CONSTRAINT `cause_ams_risque_id_foreign` FOREIGN KEY (`risque_id`) REFERENCES `risque_ams` (`id`);

--
-- Contraintes pour la table `historique_actions`
--
ALTER TABLE `historique_actions`
  ADD CONSTRAINT `historique_actions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `objectifs`
--
ALTER TABLE `objectifs`
  ADD CONSTRAINT `objectifs_processus_id_foreign` FOREIGN KEY (`processus_id`) REFERENCES `processuses` (`id`);

--
-- Contraintes pour la table `pdf_files`
--
ALTER TABLE `pdf_files`
  ADD CONSTRAINT `pdf_files_risque_id_foreign` FOREIGN KEY (`risque_id`) REFERENCES `risques` (`id`);

--
-- Contraintes pour la table `pdf_file_processuses`
--
ALTER TABLE `pdf_file_processuses`
  ADD CONSTRAINT `pdf_file_processuses_processus_id_foreign` FOREIGN KEY (`processus_id`) REFERENCES `processuses` (`id`);

--
-- Contraintes pour la table `rejets`
--
ALTER TABLE `rejets`
  ADD CONSTRAINT `rejets_risque_id_foreign` FOREIGN KEY (`risque_id`) REFERENCES `risques` (`id`);

--
-- Contraintes pour la table `rejet_ams`
--
ALTER TABLE `rejet_ams`
  ADD CONSTRAINT `rejet_ams_amelioration_id_foreign` FOREIGN KEY (`amelioration_id`) REFERENCES `ameliorations` (`id`);

--
-- Contraintes pour la table `risques`
--
ALTER TABLE `risques`
  ADD CONSTRAINT `risques_poste_id_foreign` FOREIGN KEY (`poste_id`) REFERENCES `postes` (`id`),
  ADD CONSTRAINT `risques_processus_id_foreign` FOREIGN KEY (`processus_id`) REFERENCES `processuses` (`id`);

--
-- Contraintes pour la table `risquetrouvers`
--
ALTER TABLE `risquetrouvers`
  ADD CONSTRAINT `risquetrouvers_amelioration_id_foreign` FOREIGN KEY (`amelioration_id`) REFERENCES `ameliorations` (`id`),
  ADD CONSTRAINT `risquetrouvers_risque_id_foreign` FOREIGN KEY (`risque_id`) REFERENCES `risques` (`id`);

--
-- Contraintes pour la table `risque_ams`
--
ALTER TABLE `risque_ams`
  ADD CONSTRAINT `risque_ams_poste_id_foreign` FOREIGN KEY (`poste_id`) REFERENCES `postes` (`id`),
  ADD CONSTRAINT `risque_ams_processus_id_foreign` FOREIGN KEY (`processus_id`) REFERENCES `processuses` (`id`);

--
-- Contraintes pour la table `suivi_actions`
--
ALTER TABLE `suivi_actions`
  ADD CONSTRAINT `suivi_actions_action_id_foreign` FOREIGN KEY (`action_id`) REFERENCES `actions` (`id`),
  ADD CONSTRAINT `suivi_actions_processus_id_foreign` FOREIGN KEY (`processus_id`) REFERENCES `processuses` (`id`),
  ADD CONSTRAINT `suivi_actions_risque_id_foreign` FOREIGN KEY (`risque_id`) REFERENCES `risques` (`id`);

--
-- Contraintes pour la table `suivi_ameliorations`
--
ALTER TABLE `suivi_ameliorations`
  ADD CONSTRAINT `suivi_ameliorations_action_id_foreign` FOREIGN KEY (`action_id`) REFERENCES `actions` (`id`),
  ADD CONSTRAINT `suivi_ameliorations_amelioration_id_foreign` FOREIGN KEY (`amelioration_id`) REFERENCES `ameliorations` (`id`),
  ADD CONSTRAINT `suivi_ameliorations_cause_id_foreign` FOREIGN KEY (`cause_id`) REFERENCES `causes` (`id`),
  ADD CONSTRAINT `suivi_ameliorations_processus_id_foreign` FOREIGN KEY (`processus_id`) REFERENCES `processuses` (`id`),
  ADD CONSTRAINT `suivi_ameliorations_risque_id_am_foreign` FOREIGN KEY (`risque_id_am`) REFERENCES `risque_ams` (`id`),
  ADD CONSTRAINT `suivi_ameliorations_risque_id_foreign` FOREIGN KEY (`risque_id`) REFERENCES `risques` (`id`);

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_poste_id_foreign` FOREIGN KEY (`poste_id`) REFERENCES `postes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
