-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 24 Apr 2024 pada 06.51
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `assessment`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`id`, `image`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, '0fu3E2oSO6dBai4XOhy6YTj8HJBlbfvaAFoAUXOi.png', 'Internet', 'internet', '2024-03-04 21:19:08', '2024-03-04 21:19:08'),
(2, 'Rzlm7TcVKOJLPyjDH9aDJaP6iJSH6tQMEYpvQ4gK.png', 'Referensi Bacaan', 'referensi-bacaan', '2024-03-04 21:19:42', '2024-03-04 21:19:42'),
(3, 'aYyHxGoUC4EokbKNdriCMSSXFqZIlzZRjK5CeHeb.png', 'Akademi', 'akademi', '2024-03-04 21:20:26', '2024-03-04 21:20:26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `developers`
--

CREATE TABLE `developers` (
  `id` int(11) NOT NULL,
  `nama_perusahaan` varchar(150) NOT NULL,
  `nama_pj` varchar(150) NOT NULL,
  `alamat` text NOT NULL,
  `telp` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
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
-- Struktur dari tabel `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_06_01_093404_create_tags_table', 1),
(6, '2022_06_01_093500_create_categories_table', 1),
(7, '2022_06_01_093551_create_posts_table', 1),
(8, '2022_06_01_093640_post_tag', 1),
(9, '2022_06_01_093712_create_comments_table', 1),
(10, '2022_06_01_093750_create_menus_table', 1),
(11, '2022_06_01_093822_create_sliders_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `opds`
--

CREATE TABLE `opds` (
  `id` int(11) NOT NULL,
  `opd` varchar(150) NOT NULL,
  `alamat` text NOT NULL,
  `telp` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `opds`
--

INSERT INTO `opds` (`id`, `opd`, `alamat`, `telp`, `email`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Dinas ABC', 'Jl. Alfabet ABC', '0251-5567-223', 'dinasabc@gmail.com', 2, '2024-04-23 01:44:50', '2024-04-23 18:27:45');

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 1, 'my-token', '23c363cab62c647698caf2de93bfdf9fb6c6b88e1ee07e0aaa8c6d09e832348c', '[\"*\"]', '2024-04-23 19:15:49', NULL, '2024-04-18 18:38:53', '2024-04-23 19:15:49'),
(2, 'App\\Models\\User', 2, 'my-token', '1088a838c4f5f2bddd80ef407946bbab84012f1f40c4a9b60905bf0ab6b0d7f1', '[\"*\"]', NULL, NULL, '2024-04-20 00:13:46', '2024-04-20 00:13:46'),
(3, 'App\\Models\\User', 1, 'my-token', 'e2c84e2bcd76bda4e8c861e73e3f987df4f0bf8165764c4f228ef5c6fc0b03d2', '[\"*\"]', NULL, NULL, '2024-04-21 02:09:28', '2024-04-21 02:09:28'),
(4, 'App\\Models\\User', 1, 'my-token', 'c19eb326b669569e03e7b0796aba30b430088ae3e6150582f02de2abeb65cc07', '[\"*\"]', NULL, NULL, '2024-04-21 05:40:22', '2024-04-21 05:40:22'),
(5, 'App\\Models\\User', 1, 'my-token', '2a2723a502edd61284689025ab4dad23fee864b69a2742bb3bd2274bdb7a6e21', '[\"*\"]', NULL, NULL, '2024-04-21 05:42:33', '2024-04-21 05:42:33'),
(6, 'App\\Models\\User', 1, 'my-token', 'e18e4e0be25df6102ea6443ed6c3509088ad115c342bb220390ad2634e7aca1d', '[\"*\"]', NULL, NULL, '2024-04-21 05:44:54', '2024-04-21 05:44:54'),
(7, 'App\\Models\\User', 1, 'my-token', 'fb86d672d611668d16d23a150111171a9077440cee7d39329586344ea13cecaf', '[\"*\"]', NULL, NULL, '2024-04-21 05:47:13', '2024-04-21 05:47:13'),
(8, 'App\\Models\\User', 1, 'my-token', '0d4c7818110e8a7eb5893fe664341a484249d83f2a5845fb666fe0041af7469c', '[\"*\"]', NULL, NULL, '2024-04-21 05:48:04', '2024-04-21 05:48:04'),
(9, 'App\\Models\\User', 1, 'my-token', 'dbabb51ae3cb2a6042c152857edd7564f68f12fd413db8d2ac6ceb36dad4e77c', '[\"*\"]', NULL, NULL, '2024-04-21 05:50:33', '2024-04-21 05:50:33'),
(10, 'App\\Models\\User', 1, 'my-token', '5de683111d4cf56c9f6ddbb6a47dfc44a156c0471fe6ec797eaa3383efce4afa', '[\"*\"]', NULL, NULL, '2024-04-21 05:52:01', '2024-04-21 05:52:01'),
(11, 'App\\Models\\User', 1, 'my-token', 'f2997b7c3d6b74d36a93a78e759ba5ed09696dc1a27fc88c825805ea76f2b43e', '[\"*\"]', NULL, NULL, '2024-04-21 06:01:25', '2024-04-21 06:01:25'),
(12, 'App\\Models\\User', 1, 'my-token', '96d07f48de0e435a4fc9ba8ad64547b71b3e2d90653267c18f53f8ca8ed2114b', '[\"*\"]', NULL, NULL, '2024-04-21 06:05:22', '2024-04-21 06:05:22'),
(13, 'App\\Models\\User', 1, 'my-token', 'c8a9670ec5b18629dcc03e2a1349714f60094befac2fb2011fe3ccfdbd4b2d0d', '[\"*\"]', NULL, NULL, '2024-04-21 17:44:42', '2024-04-21 17:44:42'),
(14, 'App\\Models\\User', 2, 'my-token', 'c4a14acd312f6354f3a692c892c3605e01bcbdb1f64647aaf6a532aa7de29c56', '[\"*\"]', NULL, NULL, '2024-04-21 19:07:58', '2024-04-21 19:07:58'),
(15, 'App\\Models\\User', 2, 'my-token', 'be5d99d380b67efc0b9cc06b80e7c239480cf94f13e6dc0368bfcb7a637e5294', '[\"*\"]', NULL, NULL, '2024-04-21 19:08:03', '2024-04-21 19:08:03'),
(16, 'App\\Models\\User', 2, 'my-token', '3c11f484248f17153ffadba013101c1bb40b1c6b79f57e64f0371c37a018be27', '[\"*\"]', NULL, NULL, '2024-04-21 19:08:31', '2024-04-21 19:08:31'),
(17, 'App\\Models\\User', 3, 'my-token', 'd1e77e6b71fc45805dcaa56a2056aeda6b97998e6946c813274824dbf308b5e5', '[\"*\"]', NULL, NULL, '2024-04-21 19:08:55', '2024-04-21 19:08:55'),
(18, 'App\\Models\\User', 3, 'my-token', 'cc736046137f257b514eb78392e2e8d656c5a07a0d2737d6344bf823c1bc0ddd', '[\"*\"]', NULL, NULL, '2024-04-21 19:24:32', '2024-04-21 19:24:32'),
(19, 'App\\Models\\User', 2, 'my-token', '814c2c4ac70df91d0773caf7d324269fab47b13d4c142b592e139cdf4aaec2b3', '[\"*\"]', NULL, NULL, '2024-04-21 19:24:59', '2024-04-21 19:24:59'),
(20, 'App\\Models\\User', 1, 'my-token', '37fef7801b0eee02595515986a2fb1f02ed160853db2e3dc2097eeb2ea83bfe0', '[\"*\"]', NULL, NULL, '2024-04-21 20:39:10', '2024-04-21 20:39:10'),
(21, 'App\\Models\\User', 3, 'my-token', '4a5fdcbffe30597aa0bc7af12885b6980bbd027e3fc6957bcc6768e39c101af4', '[\"*\"]', NULL, NULL, '2024-04-21 21:02:05', '2024-04-21 21:02:05'),
(22, 'App\\Models\\User', 3, 'my-token', '71fcb2b7ab0823b3dccd446fc65eaea94fa8aa8a0e8cf574a98e9ee07e24f085', '[\"*\"]', NULL, NULL, '2024-04-21 21:02:10', '2024-04-21 21:02:10'),
(23, 'App\\Models\\User', 1, 'my-token', '60367df2b782454b6c0b53a4c4d2951c1c2cc747b2ef32674a7e4526b4eee879', '[\"*\"]', NULL, NULL, '2024-04-21 23:37:52', '2024-04-21 23:37:52'),
(24, 'App\\Models\\User', 1, 'my-token', 'f7d7927c9675f1d04ca14060ead623befc9443156ac67be2c02976699e027426', '[\"*\"]', NULL, NULL, '2024-04-21 23:37:55', '2024-04-21 23:37:55'),
(25, 'App\\Models\\User', 1, 'my-token', '2f04a28b091bee55095efa5c6d55ecf9e86e57e659ca49f9a432b090a16977f5', '[\"*\"]', NULL, NULL, '2024-04-21 23:40:20', '2024-04-21 23:40:20'),
(26, 'App\\Models\\User', 1, 'my-token', '8952d6c01fa62af58f8450250cff07d4263273a2f0e3d4de5db9030bdc8fcad2', '[\"*\"]', NULL, NULL, '2024-04-21 23:47:27', '2024-04-21 23:47:27'),
(27, 'App\\Models\\User', 1, 'my-token', 'bb4f55b6ba27c4186054f1dd2433c1152fb37b3716910c95736176ecf0eb6a91', '[\"*\"]', NULL, NULL, '2024-04-21 23:47:29', '2024-04-21 23:47:29'),
(28, 'App\\Models\\User', 1, 'my-token', '2f28b32c17a6461c12e3b873f4b5ff4eb1202416917fcc0d91d1594b06fa4fce', '[\"*\"]', NULL, NULL, '2024-04-21 23:47:32', '2024-04-21 23:47:32'),
(29, 'App\\Models\\User', 1, 'my-token', 'dc2612d85765b588c153a14d22549d3b9da4eda76527309d18461b5442826441', '[\"*\"]', NULL, NULL, '2024-04-21 23:49:51', '2024-04-21 23:49:51'),
(30, 'App\\Models\\User', 1, 'my-token', '31505717b89eb1f47389c8a17af6119c616b3bf37ee3112054b677d253465e83', '[\"*\"]', NULL, NULL, '2024-04-21 23:50:20', '2024-04-21 23:50:20'),
(31, 'App\\Models\\User', 1, 'my-token', '0b8c6765435ce35b3bda9f6c006a36a990491b597bb4049647923e1556005357', '[\"*\"]', NULL, NULL, '2024-04-21 23:50:49', '2024-04-21 23:50:49'),
(32, 'App\\Models\\User', 1, 'my-token', '55c4c64843766db4ef09466dbe99edc2b93e9386332329e85b84a201e6a2dac3', '[\"*\"]', NULL, NULL, '2024-04-21 23:51:26', '2024-04-21 23:51:26'),
(33, 'App\\Models\\User', 2, 'my-token', '7e952157c7259b3f991d634db028b2572370bfaa045e957a5448ef5aca3758b2', '[\"*\"]', '2024-04-23 21:43:57', NULL, '2024-04-23 20:07:12', '2024-04-23 21:43:57');

-- --------------------------------------------------------

--
-- Struktur dari tabel `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `content` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `posts`
--

INSERT INTO `posts` (`id`, `title`, `slug`, `category_id`, `user_id`, `content`, `image`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Sosialisasi E-Government', 'sosialisasi-e-government', 3, 1, '<p>Sosialisasi EGovernment Sosialisasi EGovernmentSosialisasi EGovernmentSosialisasi EGovernmentSosialisasi EGovernmentSosialisasi EGovernmentSosialisasi EGovernmentSosialisasi EGovernment</p><p>Sosialisasi EGovernmentSosialisasi EGovernmentSosialisasi EGovernmentSosialisasi EGovernmentSosialisasi EGovernmentSosialisasi EGovernmentSosialisasi EGovernmentSosialisasi EGovernmentSosialisasi EGovernmentSosialisasi EGovernmentSosialisasi EGovernmentSosialisasi EGovernmentSosialisasi EGovernmentSosialisasi EGovernment Sosialisasi EGovernment</p><p>Sosialisasi EGovernment Sosialisasi EGovernment Sosialisasi EGovernment Sosialisasi EGovernment Sosialisasi EGovernment Sosialisasi EGovernment Sosialisasi EGovernment</p>', 'VDTqnP5hup845vZmlih4Z6Kw8NjhVNSiE6hANyY4.jpg', 'Sosialisasi EGovernment Sosialisasi EGovernment Sosialisasi EGovernment Sosialisasi EGovernment Sosialisasi EGovernment Sosialisasi EGovernment Sosialisasi EGovernment', '2024-03-04 22:30:47', '2024-03-04 22:30:47');

-- --------------------------------------------------------

--
-- Struktur dari tabel `post_tag`
--

CREATE TABLE `post_tag` (
  `post_id` int(10) UNSIGNED NOT NULL,
  `tag_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `post_tag`
--

INSERT INTO `post_tag` (`post_id`, `tag_id`) VALUES
(1, 3),
(1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `programers`
--

CREATE TABLE `programers` (
  `id` int(11) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `alamat` text NOT NULL,
  `telp` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `programers`
--

INSERT INTO `programers` (`id`, `nama`, `alamat`, `telp`, `email`, `created_at`, `updated_at`) VALUES
(1, 'Aul The Programer', 'Tajur komplek pakuan 2 sebrang dokter juliana', '0887264', 'aul@gmail.com', '2024-04-23 21:36:55', '2024-04-23 21:36:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sliders`
--

INSERT INTO `sliders` (`id`, `image`, `created_at`, `updated_at`) VALUES
(1, 'iN5uliv0n95qkhSzgyQ7gBTgWBBCvbXzvhDUhGcw.jpg', '2024-03-04 22:10:45', '2024-03-04 22:10:45'),
(2, 'ruYPJFZiTfegJxDpGHL3YqxDL5903JFHq9X01gUW.jpg', '2024-03-04 22:11:56', '2024-03-04 22:11:56'),
(3, 'l1k1fhyDGEEU6jLlD5N8PfM9WCy7uIMNx31pPbGU.jpg', '2024-03-04 22:12:55', '2024-03-04 22:12:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tags`
--

CREATE TABLE `tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tags`
--

INSERT INTO `tags` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Komputer', 'komputer', '2024-03-04 21:29:47', '2024-03-04 21:29:47'),
(2, 'Belajar', 'belajar', '2024-03-04 21:30:09', '2024-03-04 21:30:09'),
(3, 'Teknologi', 'teknologi', '2024-03-04 21:30:22', '2024-03-04 21:30:37'),
(4, 'Pemprograman', 'pemprograman', '2024-03-04 21:31:08', '2024-03-04 21:31:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','opd','assessment') NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', '2024-03-05 03:20:45', '$2y$10$0bUjfDZOFVd4jGucUxWrbOFQeeG.EGDHK2rSrpByzIxaFFbtpGk4y', 'admin', NULL, '2024-03-05 03:20:45', '2024-03-05 03:20:45'),
(2, 'Dinas ABC', 'dinasabc@gmail.com', NULL, '$2y$10$C3t29ZVMPUdS0/Xg1zQBwOB8yMRf.OXH07zqcCyI1eXw1MAt8RDqe', 'opd', NULL, '2024-04-18 19:48:41', '2024-04-18 19:48:41'),
(3, 'Diskominfo', 'diskominfo@gmail.com', NULL, '$2y$10$Qs4woo4g2J81oaJJtLY2HeAp2FHZSsN6d716gMhyD5AtmZKBDP3nq', 'assessment', NULL, '2024-04-18 19:53:51', '2024-04-18 19:53:51');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indeks untuk tabel `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `developers`
--
ALTER TABLE `developers`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `opds`
--
ALTER TABLE `opds`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `posts_slug_unique` (`slug`);

--
-- Indeks untuk tabel `programers`
--
ALTER TABLE `programers`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tags_slug_unique` (`slug`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `developers`
--
ALTER TABLE `developers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `opds`
--
ALTER TABLE `opds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT untuk tabel `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `programers`
--
ALTER TABLE `programers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
