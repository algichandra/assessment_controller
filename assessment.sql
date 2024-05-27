-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2024 at 03:36 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

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
-- Table structure for table `apks`
--

CREATE TABLE `apks` (
  `id` int(11) NOT NULL,
  `nama_apk` varchar(150) NOT NULL,
  `nama_kegiatan` varchar(150) DEFAULT NULL,
  `thn_anggaran` varchar(15) DEFAULT NULL,
  `kegiatan_dpa` enum('dpa','non_dpa') NOT NULL,
  `cttan_dpa` text DEFAULT NULL,
  `pj` varchar(150) NOT NULL,
  `opd_id` int(11) NOT NULL,
  `user_apk_id` int(11) NOT NULL,
  `jenis_kegiatan_id` int(11) NOT NULL,
  `developer_id` int(11) NOT NULL,
  `programer_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `apks`
--

INSERT INTO `apks` (`id`, `nama_apk`, `nama_kegiatan`, `thn_anggaran`, `kegiatan_dpa`, `cttan_dpa`, `pj`, `opd_id`, `user_apk_id`, `jenis_kegiatan_id`, `developer_id`, `programer_id`, `created_at`, `updated_at`) VALUES
(1, 'Website Uji Coba', NULL, NULL, 'dpa', NULL, 'Orang', 1, 1, 1, 1, 1, '2024-04-24 21:25:28', '2024-04-24 21:25:28');

-- --------------------------------------------------------

--
-- Table structure for table `assessments`
--

CREATE TABLE `assessments` (
  `id` int(11) NOT NULL,
  `apk_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assessments`
--

INSERT INTO `assessments` (`id`, `apk_id`, `status_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2024-04-25 00:24:59', '2024-04-25 00:24:59');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
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
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `image`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, '0fu3E2oSO6dBai4XOhy6YTj8HJBlbfvaAFoAUXOi.png', 'Internet', 'internet', '2024-03-04 21:19:08', '2024-03-04 21:19:08'),
(2, 'Rzlm7TcVKOJLPyjDH9aDJaP6iJSH6tQMEYpvQ4gK.png', 'Referensi Bacaan', 'referensi-bacaan', '2024-03-04 21:19:42', '2024-03-04 21:19:42'),
(3, 'aYyHxGoUC4EokbKNdriCMSSXFqZIlzZRjK5CeHeb.png', 'Akademi', 'akademi', '2024-03-04 21:20:26', '2024-03-04 21:20:26');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
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
-- Table structure for table `developers`
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
-- Table structure for table `dokumens`
--

CREATE TABLE `dokumens` (
  `id` int(11) NOT NULL,
  `nama_dok` varchar(150) NOT NULL,
  `dok` varchar(250) NOT NULL,
  `assessment_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dokumens`
--

INSERT INTO `dokumens` (`id`, `nama_dok`, `dok`, `assessment_id`, `created_at`, `updated_at`) VALUES
(1, 'Test', 'acn1M3gOLX5BrkOf8wzRwWoEtRNbktaFo54yWeSG.pdf', 1, '2024-04-29 00:36:18', '2024-04-29 00:36:18'),
(2, 'Wkwkwk Anjg', 'G3CFM3WnLDdPote59bs7F92zl4RrEglbv3fBccpT.pdf', 1, '2024-04-29 00:38:19', '2024-04-29 01:13:22');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
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
-- Table structure for table `hosting_sub_domains`
--

CREATE TABLE `hosting_sub_domains` (
  `id` int(11) NOT NULL,
  `collocation_server` enum('ya','tidak') NOT NULL,
  `hosting` enum('ya','tidak') NOT NULL,
  `sub_domain` enum('ya','tidak') NOT NULL,
  `nama_subdomain` varchar(50) NOT NULL,
  `cttan_collock_server` text DEFAULT NULL,
  `cttan_hosting` text DEFAULT NULL,
  `cttan_sub_domain` text DEFAULT NULL,
  `assessment_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hosting_sub_domains`
--

INSERT INTO `hosting_sub_domains` (`id`, `collocation_server`, `hosting`, `sub_domain`, `nama_subdomain`, `cttan_collock_server`, `cttan_hosting`, `cttan_sub_domain`, `assessment_id`, `created_at`, `updated_at`) VALUES
(1, 'ya', 'tidak', 'ya', 'Test', NULL, NULL, NULL, 1, '2024-04-28 20:12:15', '2024-04-28 20:12:15'),
(2, 'ya', 'tidak', 'ya', 'test 2 anjay', 'wkwkwk', 'anjaya', 'wejhoiehrwq', 1, '2024-04-28 20:16:24', '2024-04-28 20:18:56');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_kegiatans`
--

CREATE TABLE `jenis_kegiatans` (
  `id` int(11) NOT NULL,
  `jenis_kegiatan` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jenis_kegiatans`
--

INSERT INTO `jenis_kegiatans` (`id`, `jenis_kegiatan`, `created_at`, `updated_at`) VALUES
(1, 'Pembangunan', '2024-04-24 07:46:12', '2024-04-24 07:46:12'),
(2, 'Pengembangan', '2024-04-24 07:46:12', '2024-04-24 07:46:12'),
(3, 'Pemeliharaan', '2024-04-24 07:46:12', '2024-04-24 07:46:12');

-- --------------------------------------------------------

--
-- Table structure for table `kontrol_akses`
--

CREATE TABLE `kontrol_akses` (
  `id` int(11) NOT NULL,
  `user_lvl_manej` enum('ya','tidak') NOT NULL,
  `dshbrd_admin` enum('ya','tidak') NOT NULL,
  `verif_token` enum('ya','tidak') NOT NULL,
  `anti_csrf` enum('ya','tidak') NOT NULL,
  `pnjelajah_dirt` enum('ya','tidak') NOT NULL,
  `cttan_user_lvl_manej` text DEFAULT NULL,
  `cttan_dshbrd_admin` text DEFAULT NULL,
  `cttan_verif_token` text DEFAULT NULL,
  `cttan_anti_csrf` text DEFAULT NULL,
  `cttan_pnjelajah_dirt` text DEFAULT NULL,
  `foto_data_validasi` varchar(150) NOT NULL,
  `foto_dashbrd_admin` varchar(150) NOT NULL,
  `foto_anti_csrf` varchar(150) NOT NULL,
  `foto_penjelajahan_direktori` varchar(150) NOT NULL,
  `assessment_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `manajemen_sesis`
--

CREATE TABLE `manajemen_sesis` (
  `id` int(11) NOT NULL,
  `token_url` enum('ya','tidak') NOT NULL,
  `manej_sesi` enum('ya','tidak') NOT NULL,
  `set_sesi` enum('ya','tidak') NOT NULL,
  `back_sesi_out` enum('ya','tidak') NOT NULL,
  `aunten_12_jam` enum('ya','tidak') NOT NULL,
  `satu_akun_satu_user` enum('ya','tidak') NOT NULL,
  `satu_akun_berbagai_device` enum('ya','tidak') NOT NULL,
  `cttan_token_url` text DEFAULT NULL,
  `cttan_manej_sesi` text DEFAULT NULL,
  `cttan_set_sesi` text DEFAULT NULL,
  `cttan_back_sesi_out` text DEFAULT NULL,
  `cttan_auten_12_jam` text DEFAULT NULL,
  `cttan_satu_akun_satu_user` text DEFAULT NULL,
  `cttan_satu_akun_berbagai_device` text DEFAULT NULL,
  `foto_manej_sesi` varchar(150) NOT NULL,
  `foto_set_sesi` varchar(150) NOT NULL,
  `foto_aunten` varchar(150) NOT NULL,
  `foto_satu_akun_berbagai_device` varchar(150) NOT NULL,
  `assessment_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `manajemen_sesis`
--

INSERT INTO `manajemen_sesis` (`id`, `token_url`, `manej_sesi`, `set_sesi`, `back_sesi_out`, `aunten_12_jam`, `satu_akun_satu_user`, `satu_akun_berbagai_device`, `cttan_token_url`, `cttan_manej_sesi`, `cttan_set_sesi`, `cttan_back_sesi_out`, `cttan_auten_12_jam`, `cttan_satu_akun_satu_user`, `cttan_satu_akun_berbagai_device`, `foto_manej_sesi`, `foto_set_sesi`, `foto_aunten`, `foto_satu_akun_berbagai_device`, `assessment_id`, `created_at`, `updated_at`) VALUES
(1, 'ya', 'ya', 'ya', 'ya', 'ya', 'ya', 'ya', 'wtkwtkwtk', 'wtkwtkwtk', 'wtkwtkwtk', 'wtkwtkwtk', 'wtkwtkwtk', 'wtkwtkwtk', 'wtkwtkwtk', 'vts0jgEktZRs53mpeIejMqPeAzDJXESeNGQqaPdx.png', 'HsUN2wuRR6rCwQuHe5xzSK13wzL317VcicxrpQi0.png', '5xt5v7vFVvakveNbuRHWRAs4VVsEEGeatunn3NYR.png', 'zNel0RUyT3vSMbMGdwgJLzeCwcBpyiBqEKFre5VR.png', 1, '2024-05-16 21:12:07', '2024-05-16 21:12:07');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
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
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
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
-- Table structure for table `opds`
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
-- Dumping data for table `opds`
--

INSERT INTO `opds` (`id`, `opd`, `alamat`, `telp`, `email`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Dinas ABC', 'Jl. Alfabet ABC', '0251-5567-223', 'dinasabc@gmail.com', 2, '2024-04-23 01:44:50', '2024-04-23 18:27:45');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penilaian_otentifikasis`
--

CREATE TABLE `penilaian_otentifikasis` (
  `id` int(11) NOT NULL,
  `penilaian_login` enum('sesuai','tidak') NOT NULL,
  `penilaian_captcha_login` enum('sesuai','tidak') NOT NULL,
  `penilaian_cpatcha_lain` enum('sesuai','tidak') NOT NULL,
  `penilaian_daftar` enum('sesuai','tidak') NOT NULL,
  `penilaian_reset_password` enum('sesuai','tidak') NOT NULL,
  `penilaian_password_8_krtr` enum('sesuai','tidak') NOT NULL,
  `penilaian_password_besar_kecil_khusus` enum('sesuai','tidak') NOT NULL,
  `penilaian_ukur_sandi` enum('sesuai','tidak') NOT NULL,
  `penilaian_tampil_sembunyi_sandi` enum('sesuai','tidak') NOT NULL,
  `penilaian_valid_email_new_user` enum('sesuai','tidak') NOT NULL,
  `penilaian_verif_admin_new_user` enum('sesuai','tidak') NOT NULL,
  `penilaian_exp_password_1_thn` enum('sesuai','tidak') NOT NULL,
  `penilaian_user_dibuat_admin` enum('sesuai','tidak') NOT NULL,
  `penilaian_reset_password_user_dibuat_admin` enum('sesuai','tidak') NOT NULL,
  `cttan_penilaian_login` text DEFAULT NULL,
  `cttan_penilaian_captcha_login` text DEFAULT NULL,
  `cttan_penilaian_captcha_lain` text DEFAULT NULL,
  `cttan_penilaian_daftar` text DEFAULT NULL,
  `cttan_penilaian_reset_password` text DEFAULT NULL,
  `cttan_penilaian_valid_pw_8_karakter` text DEFAULT NULL,
  `cttan_penilaian_pw_besar_kecil_khusus` text DEFAULT NULL,
  `cttan_penilaian_ukur_sandi` text DEFAULT NULL,
  `cttan_penilaian_tampil_sembunyi_sandi` text DEFAULT NULL,
  `cttan_penilaian_valid_email_new_user` text DEFAULT NULL,
  `cttan_penilaian_verif_admin_new_user` text DEFAULT NULL,
  `cttan_penilaian_exp_password_1_thn` text DEFAULT NULL,
  `cttan_penilaian_user_dibuat_admin` text DEFAULT NULL,
  `cttan_penilaian_reset_pw_user_dibuat_admin` text DEFAULT NULL,
  `foto_valid_pw_karakter` varchar(150) NOT NULL,
  `foto_pw_besar_kecil_khusus` varchar(150) NOT NULL,
  `foto_exp_password` varchar(150) NOT NULL,
  `assessment_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penilaian_otentifikasis`
--

INSERT INTO `penilaian_otentifikasis` (`id`, `penilaian_login`, `penilaian_captcha_login`, `penilaian_cpatcha_lain`, `penilaian_daftar`, `penilaian_reset_password`, `penilaian_password_8_krtr`, `penilaian_password_besar_kecil_khusus`, `penilaian_ukur_sandi`, `penilaian_tampil_sembunyi_sandi`, `penilaian_valid_email_new_user`, `penilaian_verif_admin_new_user`, `penilaian_exp_password_1_thn`, `penilaian_user_dibuat_admin`, `penilaian_reset_password_user_dibuat_admin`, `cttan_penilaian_login`, `cttan_penilaian_captcha_login`, `cttan_penilaian_captcha_lain`, `cttan_penilaian_daftar`, `cttan_penilaian_reset_password`, `cttan_penilaian_valid_pw_8_karakter`, `cttan_penilaian_pw_besar_kecil_khusus`, `cttan_penilaian_ukur_sandi`, `cttan_penilaian_tampil_sembunyi_sandi`, `cttan_penilaian_valid_email_new_user`, `cttan_penilaian_verif_admin_new_user`, `cttan_penilaian_exp_password_1_thn`, `cttan_penilaian_user_dibuat_admin`, `cttan_penilaian_reset_pw_user_dibuat_admin`, `foto_valid_pw_karakter`, `foto_pw_besar_kecil_khusus`, `foto_exp_password`, `assessment_id`, `created_at`, `updated_at`) VALUES
(1, 'tidak', 'tidak', 'tidak', 'tidak', 'tidak', 'tidak', 'tidak', 'sesuai', 'sesuai', 'sesuai', 'sesuai', 'sesuai', 'sesuai', 'sesuai', 'wadidau', 'wadidau', NULL, 'wadidau', 'wadidau', 'wadidau', 'wadidau', 'wadidau', 'wadidau', 'wadidau', 'wadidau', 'wadidau', 'wadidau', 'wadidau', 'EjNP13opaCWMDjkCvGeuIPiLLQMj4UI1JUdo6DsJ.png', 'DO82NgIinAWHfsdk6vn8VthyzMeQIWh9hrTIpsue.jpg', 'FsRGWPNiJHaQ7H2jPMSEuLREqXlS2IOVajc1uZIo.png', 1, '2024-05-15 21:56:35', '2024-05-15 21:56:35'),
(3, 'tidak', 'tidak', 'tidak', 'tidak', 'tidak', 'tidak', 'tidak', 'sesuai', 'sesuai', 'sesuai', 'sesuai', 'sesuai', 'sesuai', 'sesuai', 'wadidau', 'wadidau', NULL, 'wadidau', 'wadidau', 'wadidau', 'wadidau', 'wadidau', 'wadidau', 'wadidau', 'wadidau', 'wadidau', 'wadidau', 'wadidau', 'd45oJ41LfXJZnC4QResswlNXl9HArqhzPbrBFtY2.png', 'XmqXIdRbmKONWIKGQaQxFXiCmmPS49c1qGVSvscW.jpg', 'LozBLtoi06BDTPIN7LN2OEYSdx4bhRMZ66jHpAcW.png', 1, '2024-05-16 00:20:34', '2024-05-16 00:20:34');

-- --------------------------------------------------------

--
-- Table structure for table `penilaian_tata_kelolas`
--

CREATE TABLE `penilaian_tata_kelolas` (
  `id` int(11) NOT NULL,
  `penilaian_dok_kak_tor` enum('sesuai','tidak') NOT NULL,
  `penilaian_laporan_dpa` enum('sesuai','tidak') NOT NULL,
  `penilaian_sk_pengelola_apk` enum('sesuai','tidak') NOT NULL,
  `penilaian_sk_helpdesk_apk` enum('sesuai','tidak') NOT NULL,
  `penilaian_laporan_akhir` enum('sesuai','tidak') NOT NULL,
  `penilaian_sop` enum('sesuai','tidak') NOT NULL,
  `penilaian_panduan_apk` enum('sesuai','tidak') NOT NULL,
  `penilaian_link_video_apk` enum('sesuai','tidak') NOT NULL,
  `penilaian_panduan_apkserver` enum('sesuai','tidak') NOT NULL,
  `penilaian_dok_mnjresiko` enum('sesuai','tidak') NOT NULL,
  `penilaian_dok_api` enum('sesuai','tidak') NOT NULL,
  `penilaian_file_scapk` enum('sesuai','tidak') NOT NULL,
  `cttan_penilaian_kak_tor` text DEFAULT NULL,
  `cttan_penilaian_lap_awal` text DEFAULT NULL,
  `cttan_penilaian_sk_pengelola_apk` text DEFAULT NULL,
  `cttan_penilaian_sk_helpdesk_apk` text DEFAULT NULL,
  `cttan_penilaian_lap_akhir` text DEFAULT NULL,
  `cttan_penilaian_sop` text DEFAULT NULL,
  `cttan_penilaian_pduan_pnglola` text DEFAULT NULL,
  `cttan_penilaian_vid_tutor_apk` text DEFAULT NULL,
  `cttan_penilaian_pand_apkserver` text DEFAULT NULL,
  `cttan_penilaian_manej_resiko` text DEFAULT NULL,
  `cttan_penilaian_dok_api` text DEFAULT NULL,
  `cttan_penilaian_source_code` text DEFAULT NULL,
  `tata_kelola_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penilaian_tata_kelolas`
--

INSERT INTO `penilaian_tata_kelolas` (`id`, `penilaian_dok_kak_tor`, `penilaian_laporan_dpa`, `penilaian_sk_pengelola_apk`, `penilaian_sk_helpdesk_apk`, `penilaian_laporan_akhir`, `penilaian_sop`, `penilaian_panduan_apk`, `penilaian_link_video_apk`, `penilaian_panduan_apkserver`, `penilaian_dok_mnjresiko`, `penilaian_dok_api`, `penilaian_file_scapk`, `cttan_penilaian_kak_tor`, `cttan_penilaian_lap_awal`, `cttan_penilaian_sk_pengelola_apk`, `cttan_penilaian_sk_helpdesk_apk`, `cttan_penilaian_lap_akhir`, `cttan_penilaian_sop`, `cttan_penilaian_pduan_pnglola`, `cttan_penilaian_vid_tutor_apk`, `cttan_penilaian_pand_apkserver`, `cttan_penilaian_manej_resiko`, `cttan_penilaian_dok_api`, `cttan_penilaian_source_code`, `tata_kelola_id`, `created_at`, `updated_at`) VALUES
(1, 'sesuai', 'tidak', 'sesuai', 'sesuai', 'sesuai', 'tidak', 'tidak', 'tidak', 'sesuai', 'sesuai', 'sesuai', 'sesuai', 'wakodjowrijw', 'weihwioefadsd', 'scfdishfoewf', 'asdfghjklpoeti', 'wihincwoiuawr b', 'jewktnewk feewrc', 'asojdfoewfj bshdiweie nceoiwfniweofn', NULL, NULL, 'fioweh sdncsaoidfj banyak buku', 'ieifewh cttan_penilaian_dok_api cttan_penilaian_dok_api', 'ejrgjer', 1, '2024-05-06 18:28:42', '2024-05-06 18:28:42'),
(3, 'sesuai', 'tidak', 'sesuai', 'sesuai', 'sesuai', 'tidak', 'tidak', 'tidak', 'sesuai', 'sesuai', 'sesuai', 'sesuai', 'wakodjowrijw', 'weihwioefadsd', 'scfdishfoewf', 'asdfghjklpoeti', 'wihincwoiuawr b', 'jewktnewk feewrc', 'asojdfoewfj bshdiweie nceoiwfniweofn', 'wanjir', 'wiwiwi', 'fioweh sdncsaoidfj banyak buku', 'ieifewh cttan_penilaian_dok_api cttan_penilaian_dok_api', 'ejrgjer', 1, '2024-05-06 18:40:28', '2024-05-06 18:40:28');

-- --------------------------------------------------------

--
-- Table structure for table `penilaian_ui_uxes`
--

CREATE TABLE `penilaian_ui_uxes` (
  `id` int(11) NOT NULL,
  `penilaian_warna` enum('sesuai','tidak') NOT NULL,
  `penilaian_logo_kotabgr` enum('sesuai','tidak') NOT NULL,
  `penilaian_logo_apk` enum('sesuai','tidak') NOT NULL,
  `penilaian_copyright_pemkot` enum('sesuai','tidak') NOT NULL,
  `penilaian_info_identitasopd` enum('sesuai','tidak') NOT NULL,
  `penilaian_info_apk` enum('sesuai','tidak') NOT NULL,
  `penilaian_faq` enum('sesuai','tidak') NOT NULL,
  `penilaian_user_friendly` enum('sesuai','tidak') NOT NULL,
  `penilaian_fungsionalitas` enum('sesuai','tidak') NOT NULL,
  `penilaian_dashboard` enum('sesuai','tidak') NOT NULL,
  `penilaian_log_user` enum('sesuai','tidak') NOT NULL,
  `cttan_penilaian_warna` text DEFAULT NULL,
  `cttan_penilaian_logo_kota` text DEFAULT NULL,
  `cttan_penilaian_logo_apk` text DEFAULT NULL,
  `cttan_penilaian_cr_pemkot` text DEFAULT NULL,
  `cttan_penilaian_identitas_odp` text DEFAULT NULL,
  `cttan_penilaian_info_apk` text DEFAULT NULL,
  `cttan_penilaian_faq` text DEFAULT NULL,
  `cttan_penilaian_uiux_frendly` text DEFAULT NULL,
  `cttan_penilaian_fungsionalitas` text DEFAULT NULL,
  `cttan_penilaian_dashboard` text DEFAULT NULL,
  `cttan_penilaian_log_usr` text DEFAULT NULL,
  `assessment_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penilaian_ui_uxes`
--

INSERT INTO `penilaian_ui_uxes` (`id`, `penilaian_warna`, `penilaian_logo_kotabgr`, `penilaian_logo_apk`, `penilaian_copyright_pemkot`, `penilaian_info_identitasopd`, `penilaian_info_apk`, `penilaian_faq`, `penilaian_user_friendly`, `penilaian_fungsionalitas`, `penilaian_dashboard`, `penilaian_log_user`, `cttan_penilaian_warna`, `cttan_penilaian_logo_kota`, `cttan_penilaian_logo_apk`, `cttan_penilaian_cr_pemkot`, `cttan_penilaian_identitas_odp`, `cttan_penilaian_info_apk`, `cttan_penilaian_faq`, `cttan_penilaian_uiux_frendly`, `cttan_penilaian_fungsionalitas`, `cttan_penilaian_dashboard`, `cttan_penilaian_log_usr`, `assessment_id`, `created_at`, `updated_at`) VALUES
(1, 'sesuai', 'tidak', 'tidak', 'tidak', 'sesuai', 'sesuai', 'sesuai', 'sesuai', 'sesuai', 'tidak', 'tidak', 'wadidau', 'wadidau', 'wawawau', 'wanjir', 'bebebel', 'cttan_penilaian_info_apk', 'wanjir wkwk', 'newncoias', 'wkaksm', 'wdwdwdwdwd', 'waduh wkwkwk', 1, '2024-05-06 20:26:56', '2024-05-06 20:26:56');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
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
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 1, 'my-token', '23c363cab62c647698caf2de93bfdf9fb6c6b88e1ee07e0aaa8c6d09e832348c', '[\"*\"]', '2024-05-26 00:07:50', NULL, '2024-04-18 18:38:53', '2024-05-26 00:07:50'),
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
(33, 'App\\Models\\User', 2, 'my-token', '7e952157c7259b3f991d634db028b2572370bfaa045e957a5448ef5aca3758b2', '[\"*\"]', '2024-04-24 21:27:30', NULL, '2024-04-23 20:07:12', '2024-04-24 21:27:30'),
(34, 'App\\Models\\User', 2, 'my-token', '802543745704eb62f101959701566540d6b2be4ba34c8c5d23d22ce82de6eb57', '[\"*\"]', '2024-05-01 19:20:55', NULL, '2024-04-24 21:13:33', '2024-05-01 19:20:55'),
(35, 'App\\Models\\User', 3, 'my-token', 'e5b00569eafe5ca20dd74e4aac7b424b90396ee0f4c6906cee7ae6ca0fd626a1', '[\"*\"]', '2024-05-16 21:21:48', NULL, '2024-05-01 19:23:31', '2024-05-16 21:21:48'),
(36, 'App\\Models\\User', 1, 'my-token', 'd29a4a708b178d55fb3dfb49566fec47b567b0316d4523042f073f03135df4e9', '[\"*\"]', NULL, NULL, '2024-05-21 19:55:59', '2024-05-21 19:55:59'),
(37, 'App\\Models\\User', 2, 'my-token', 'd59407e695bbd7ba31dc98b79fa1718d066349cd770df087cd59c0c533ceb192', '[\"*\"]', NULL, NULL, '2024-05-21 19:56:54', '2024-05-21 19:56:54'),
(38, 'App\\Models\\User', 1, 'my-token', 'af8ae59d32fee31e12206f6d9a488fd995f73e11ca6c6fa6a4c1b85d12d661ed', '[\"*\"]', NULL, NULL, '2024-05-24 08:07:48', '2024-05-24 08:07:48'),
(39, 'App\\Models\\User', 1, 'my-token', 'f1188bd54cad4b4540d04a7cf2ec23f3f4eec3235ca514ec7d669d559cd66663', '[\"*\"]', NULL, NULL, '2024-05-24 08:13:47', '2024-05-24 08:13:47'),
(40, 'App\\Models\\User', 1, 'my-token', '5523c96aab6929dac84b958cef3819606ec3f6ddaf9df5708616f768fef42826', '[\"*\"]', NULL, NULL, '2024-05-24 08:15:52', '2024-05-24 08:15:52'),
(41, 'App\\Models\\User', 1, 'my-token', '57e4c5880f0228cb3e62591d3eb70918a1f178169d4e9040499f1775e0bd257c', '[\"*\"]', NULL, NULL, '2024-05-24 08:16:45', '2024-05-24 08:16:45'),
(42, 'App\\Models\\User', 1, 'my-token', '7578e2bed0c5439fb92b4503ab6f812421cf220be172b2000958e93373865b54', '[\"*\"]', NULL, NULL, '2024-05-24 08:18:30', '2024-05-24 08:18:30'),
(43, 'App\\Models\\User', 1, 'my-token', '657d6bfa25dfaad804a64637911406d06c4f1f60c9e47bc87c3540f0a8542666', '[\"*\"]', NULL, NULL, '2024-05-24 08:20:24', '2024-05-24 08:20:24'),
(44, 'App\\Models\\User', 1, 'my-token', '45566ffa6a9dc7660fe0706876a8b3adcaced75c288ad68abaeaf07d55a82f78', '[\"*\"]', NULL, NULL, '2024-05-24 08:20:34', '2024-05-24 08:20:34'),
(45, 'App\\Models\\User', 1, 'my-token', 'b23a4130ac4925ddf8089c4d8286b54f14d54b8ab852c94de808dd575b559dae', '[\"*\"]', NULL, NULL, '2024-05-24 08:54:55', '2024-05-24 08:54:55'),
(46, 'App\\Models\\User', 1, 'my-token', '0fe0d93db9041ccc467ee3c5cd1e082aa55ef15e77f02101178a110abcc7dd61', '[\"*\"]', NULL, NULL, '2024-05-24 11:05:56', '2024-05-24 11:05:56'),
(47, 'App\\Models\\User', 1, 'my-token', 'c6b75406c7809456f4131b64eec03946cca0d5652d278450e764be9391f471cf', '[\"*\"]', NULL, NULL, '2024-05-24 11:12:45', '2024-05-24 11:12:45'),
(48, 'App\\Models\\User', 1, 'my-token', 'a341155906c630f2634c66a17f48a0229757db30a95db6d7802660d7eb0cd145', '[\"*\"]', NULL, NULL, '2024-05-24 11:15:45', '2024-05-24 11:15:45'),
(49, 'App\\Models\\User', 1, 'my-token', 'b75474cc476c586f23f8184d140c5c7b3196af0ee05423073fc4088169298fd3', '[\"*\"]', NULL, NULL, '2024-05-24 11:18:00', '2024-05-24 11:18:00'),
(50, 'App\\Models\\User', 1, 'my-token', '5c7a64cd36e955c48139844146504f0a8ba98f01af7b052bf0435a735d40b1be', '[\"*\"]', NULL, NULL, '2024-05-24 11:22:13', '2024-05-24 11:22:13'),
(51, 'App\\Models\\User', 1, 'my-token', '94f58b23928ba531d2b06874505f71a57af36f71d84e5cbc70c25cc16e49d688', '[\"*\"]', NULL, NULL, '2024-05-24 11:22:18', '2024-05-24 11:22:18'),
(52, 'App\\Models\\User', 1, 'my-token', '2ec3f2df3f7ae8123de10b5e345cdb93b9537147f64924906fbd647d3558a1db', '[\"*\"]', NULL, NULL, '2024-05-24 11:26:12', '2024-05-24 11:26:12'),
(53, 'App\\Models\\User', 1, 'my-token', '7c9db0a3a02c11d80037559f86df951b7717d90a7f2621a04a1f5ca8540c1910', '[\"*\"]', NULL, NULL, '2024-05-24 11:28:28', '2024-05-24 11:28:28'),
(54, 'App\\Models\\User', 1, 'my-token', '6a1ea14c967a90102054dd72269dc4b6947e5002ab1e02f64a6399efcfc6b2d9', '[\"*\"]', '2024-05-24 23:53:54', NULL, '2024-05-24 21:59:22', '2024-05-24 23:53:54'),
(55, 'App\\Models\\User', 1, 'my-token', '6c4220f65147c398c6a3d94856c21a37a2fbfda9d12e35c114c4e74ab0199593', '[\"*\"]', NULL, NULL, '2024-05-24 21:59:27', '2024-05-24 21:59:27'),
(56, 'App\\Models\\User', 1, 'my-token', 'ba028f83fcfa264d05f14c7faa5670998a44374f88bd43bd6665da549ada7479', '[\"*\"]', NULL, NULL, '2024-05-24 21:59:30', '2024-05-24 21:59:30'),
(57, 'App\\Models\\User', 1, 'my-token', 'a30c63dd9ef62edce6f386c24ef8076f1a27b538702bf0997a55f9bfce021a1a', '[\"*\"]', '2024-05-26 00:09:03', NULL, '2024-05-25 21:29:40', '2024-05-26 00:09:03'),
(58, 'App\\Models\\User', 1, 'my-token', 'a86fed9349eced017e42050bc6e4089d4120167278ef90fda01fc313c6283e52', '[\"*\"]', NULL, NULL, '2024-05-25 21:29:46', '2024-05-25 21:29:46'),
(59, 'App\\Models\\User', 1, 'my-token', 'b6ef275fb6a75b20c1747a7f2e0f43b8b2e04ebaca544a3d4e6ce0622c58c3bf', '[\"*\"]', NULL, NULL, '2024-05-25 21:29:48', '2024-05-25 21:29:48'),
(60, 'App\\Models\\User', 1, 'my-token', 'cfe34d5219b78fb64abdf8b8d51ba3bf2138d9f23b1e4074b99168e97790cdb1', '[\"*\"]', '2024-05-26 00:12:42', NULL, '2024-05-26 00:12:35', '2024-05-26 00:12:42'),
(61, 'App\\Models\\User', 1, 'my-token', 'b40981eb79ea01cc15a6544dbfec32b520d64b8d8d466d62c15c21c51ee29ae4', '[\"*\"]', '2024-05-26 01:45:41', NULL, '2024-05-26 01:45:32', '2024-05-26 01:45:41'),
(62, 'App\\Models\\User', 1, 'my-token', '06bad6966bee64e2ca96cde7aa028dce22ebb08d55018558229893e71db29f40', '[\"*\"]', '2024-05-26 05:19:48', NULL, '2024-05-26 05:01:22', '2024-05-26 05:19:48'),
(63, 'App\\Models\\User', 1, 'my-token', '2c174510e048e3ab8e919cd441f08a696876f789219028222aa320cdba14bfe0', '[\"*\"]', NULL, NULL, '2024-05-26 05:23:19', '2024-05-26 05:23:19'),
(64, 'App\\Models\\User', 1, 'my-token', '8a630b0ea61a4b336615b7cd333b91f965e053e18ba2245b0acf82a5993c534b', '[\"*\"]', NULL, NULL, '2024-05-26 05:26:57', '2024-05-26 05:26:57'),
(65, 'App\\Models\\User', 1, 'my-token', '2b667867b3328de5bafcae7d0fda9f198e9528b9074bbd100470f9a5299dce29', '[\"*\"]', '2024-05-26 05:54:11', NULL, '2024-05-26 05:31:00', '2024-05-26 05:54:11'),
(66, 'App\\Models\\User', 1, 'my-token', '47841b63bf38759db5d8971fa159e6131cd0990691e2842c7c64f6bbb75bef48', '[\"*\"]', '2024-05-26 08:16:03', NULL, '2024-05-26 05:56:25', '2024-05-26 08:16:03'),
(67, 'App\\Models\\User', 1, 'my-token', '4e8f14bb551fed72157fd45e6daf94ee946707d4aec46d71790cdf11b3420130', '[\"*\"]', NULL, NULL, '2024-05-26 17:30:35', '2024-05-26 17:30:35'),
(68, 'App\\Models\\User', 1, 'my-token', '3aea5c7fe98d088d004eeda71b4785440a7eef98f78c6c4971abb8c56903c3c9', '[\"*\"]', NULL, NULL, '2024-05-26 17:33:40', '2024-05-26 17:33:40'),
(69, 'App\\Models\\User', 1, 'my-token', '2bc7e73f473b90a0c06e7207208cfd324a5de4762f453f4cfe17702602dfa376', '[\"*\"]', NULL, NULL, '2024-05-26 17:36:05', '2024-05-26 17:36:05'),
(70, 'App\\Models\\User', 6, 'my-token', '430756900c46eddcb415dbee132940c3908084da6ce3665e0c647f61d88c0d06', '[\"*\"]', NULL, NULL, '2024-05-26 17:58:32', '2024-05-26 17:58:32'),
(71, 'App\\Models\\User', 3, 'my-token', 'dedcca37d729981ad5104bf03807359cdf8e2a150d7d36a72f52d12ab4837448', '[\"*\"]', NULL, NULL, '2024-05-26 18:07:49', '2024-05-26 18:07:49'),
(72, 'App\\Models\\User', 1, 'my-token', '3a199fb5d6855845a06dcc0157d38756df13dff73a9d9086bceda85177c96aa2', '[\"*\"]', '2024-05-26 18:14:38', NULL, '2024-05-26 18:14:30', '2024-05-26 18:14:38');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
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
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `slug`, `category_id`, `user_id`, `content`, `image`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Sosialisasi E-Government', 'sosialisasi-e-government', 3, 1, '<p>Sosialisasi EGovernment Sosialisasi EGovernmentSosialisasi EGovernmentSosialisasi EGovernmentSosialisasi EGovernmentSosialisasi EGovernmentSosialisasi EGovernmentSosialisasi EGovernment</p><p>Sosialisasi EGovernmentSosialisasi EGovernmentSosialisasi EGovernmentSosialisasi EGovernmentSosialisasi EGovernmentSosialisasi EGovernmentSosialisasi EGovernmentSosialisasi EGovernmentSosialisasi EGovernmentSosialisasi EGovernmentSosialisasi EGovernmentSosialisasi EGovernmentSosialisasi EGovernmentSosialisasi EGovernment Sosialisasi EGovernment</p><p>Sosialisasi EGovernment Sosialisasi EGovernment Sosialisasi EGovernment Sosialisasi EGovernment Sosialisasi EGovernment Sosialisasi EGovernment Sosialisasi EGovernment</p>', 'VDTqnP5hup845vZmlih4Z6Kw8NjhVNSiE6hANyY4.jpg', 'Sosialisasi EGovernment Sosialisasi EGovernment Sosialisasi EGovernment Sosialisasi EGovernment Sosialisasi EGovernment Sosialisasi EGovernment Sosialisasi EGovernment', '2024-03-04 22:30:47', '2024-03-04 22:30:47');

-- --------------------------------------------------------

--
-- Table structure for table `post_tag`
--

CREATE TABLE `post_tag` (
  `post_id` int(10) UNSIGNED NOT NULL,
  `tag_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post_tag`
--

INSERT INTO `post_tag` (`post_id`, `tag_id`) VALUES
(1, 3),
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `programers`
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
-- Dumping data for table `programers`
--

INSERT INTO `programers` (`id`, `nama`, `alamat`, `telp`, `email`, `created_at`, `updated_at`) VALUES
(1, 'Aul The Programer', 'Tajur komplek pakuan 2 sebrang dokter juliana', '0887264', 'aul@gmail.com', '2024-04-23 21:36:55', '2024-04-23 21:36:55');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `image`, `created_at`, `updated_at`) VALUES
(1, 'iN5uliv0n95qkhSzgyQ7gBTgWBBCvbXzvhDUhGcw.jpg', '2024-03-04 22:10:45', '2024-03-04 22:10:45'),
(2, 'ruYPJFZiTfegJxDpGHL3YqxDL5903JFHq9X01gUW.jpg', '2024-03-04 22:11:56', '2024-03-04 22:11:56'),
(3, 'l1k1fhyDGEEU6jLlD5N8PfM9WCy7uIMNx31pPbGU.jpg', '2024-03-04 22:12:55', '2024-03-04 22:12:55');

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

CREATE TABLE `statuses` (
  `id` int(11) NOT NULL,
  `status` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `statuses`
--

INSERT INTO `statuses` (`id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Pengajuan Assessment', '2024-04-24 08:20:21', '2024-04-24 08:20:21'),
(2, 'Assessment Pertama', '2024-04-24 08:20:21', '2024-04-24 08:20:21'),
(3, 'Rekomendasi Assessment 1', '2024-04-24 08:20:21', '2024-04-24 08:20:21'),
(4, 'Assessment Kedua', '2024-04-24 08:20:21', '2024-04-24 08:20:21'),
(5, 'Rekomendasi Assessment 2', '2024-04-24 08:20:21', '2024-04-24 08:20:21'),
(6, 'Evaluasi', '2024-04-24 08:20:21', '2024-04-24 08:20:21'),
(7, 'Surat Lulus Assessment', '2024-04-24 08:20:21', '2024-04-24 08:20:21'),
(8, 'Pembuatan Server', '2024-04-24 08:20:21', '2024-04-24 08:20:21'),
(9, 'Proses Hosting dan Setting Sub-domain', '2024-04-24 08:20:21', '2024-04-24 08:20:21'),
(10, 'Sub-domain bisa diakses', '2024-04-24 08:20:21', '2024-04-24 08:20:21');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Komputer', 'komputer', '2024-03-04 21:29:47', '2024-03-04 21:29:47'),
(2, 'Belajar', 'belajar', '2024-03-04 21:30:09', '2024-03-04 21:30:09'),
(3, 'Teknologi', 'teknologi', '2024-03-04 21:30:22', '2024-03-04 21:30:37'),
(4, 'Pemprograman', 'pemprograman', '2024-03-04 21:31:08', '2024-03-04 21:31:08');

-- --------------------------------------------------------

--
-- Table structure for table `tata_kelolas`
--

CREATE TABLE `tata_kelolas` (
  `id` int(11) NOT NULL,
  `dok_kak_tor` varchar(250) NOT NULL,
  `laporan_dpa` varchar(250) DEFAULT NULL,
  `sk_pengelola_apk` varchar(250) NOT NULL,
  `sk_helpdesk_apk` varchar(250) NOT NULL,
  `laporan_akhir` varchar(250) NOT NULL,
  `sop` varchar(250) NOT NULL,
  `panduan_apk` varchar(250) NOT NULL,
  `link_video_apk` varchar(250) NOT NULL,
  `panduan_apkserver` varchar(250) NOT NULL,
  `dok_mnjresiko` varchar(250) NOT NULL,
  `dok_api` varchar(250) NOT NULL,
  `file_scapk` varchar(250) NOT NULL,
  `assessment_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tata_kelolas`
--

INSERT INTO `tata_kelolas` (`id`, `dok_kak_tor`, `laporan_dpa`, `sk_pengelola_apk`, `sk_helpdesk_apk`, `laporan_akhir`, `sop`, `panduan_apk`, `link_video_apk`, `panduan_apkserver`, `dok_mnjresiko`, `dok_api`, `file_scapk`, `assessment_id`, `created_at`, `updated_at`) VALUES
(1, 'pdm42OQbLIq753jGC672vipH7XjR9Pzx7fBFNFin.pdf', NULL, 'QMQUe2a3DR1shRePRLVZXGTrPBv7xmWaix2SM6Io.pdf', 'BLQflzM7TeUiFmFnat21HP8JXYRzCYlbZ7pTBcfL.pdf', 'AuZmlZ3zj9tfe8pdj8gxpBNIIRM4Q1pAbdPC0Zsu.pdf', 'OYmPzUkaWoUoPUTwAiDVHXDhp1hU6V4ZnPOCmziP.pdf', 'HecsLAeyL34m1r6ue6vGWwbEhDecKmiiKyyZV1Hj.pdf', 'wkwkwkwk', 'bTnlCvyl97wC27ElpZ5l4mlSoltbjzLRarB1ZUcM.pdf', 'Ygk9Kdim6yLvUVdr0BWhL3xqIbN4cc2XzZRuofWT.pdf', 'BqTNXhnKAcYgGkz8WoMDy7LK7z1LpGtnRtKdw6ZN.pdf', 'hjjYKnLCbma7jgNl88k6urFZWfE8Yy4YSCmZzj0i.pdf', 1, '2024-05-01 20:45:53', '2024-05-01 20:45:53'),
(3, 'TSHC4Kg2pR9BQWvte4XBn2vbrLomNGxBExLILzrf.pdf', 'Q4SQZH5oW7S5pAvjGug0nE2cdoQGg8KW8sXyvC74.pdf', 'rWghoR9742sL5yPoi6e61QmEdydNy64zStlNRpnJ.pdf', 'WU9QfvGIPX5jC3LgS4Cf5CFODRUrUQxy71x8u8E7.pdf', 'NP0pYlW3ocTo4s9xHPE9l2E34gtYBujCTcNrbn3r.pdf', 'NRSUBhH53Vv76245jYLnubrn4BJcSdcvlg4gn5xf.pdf', 'oAHaOMe9MVh7eiqLh2LD14iycmpNNpRsnTwIDdPA.pdf', 'wkwkwkwk', '8LImeZ9vNkD31pyOrvZezj5OnS89xXImfk7WaPak.pdf', 'b1T4qnKs5E9JQAk0qXatxaqdnDg9rgOwCG4lzdfY.pdf', 'h3yYFHMK7II6421NrdFMqX43vgdJjkho6JJh6Ru8.pdf', 'YaUrnqbRFWJUEBY2NdQOYo6RCM9KcQXAhHNoRoxw.pdf', 1, '2024-05-01 21:04:00', '2024-05-01 21:04:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
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
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', '2024-03-05 03:20:45', '$2y$10$0bUjfDZOFVd4jGucUxWrbOFQeeG.EGDHK2rSrpByzIxaFFbtpGk4y', 'admin', NULL, '2024-03-05 03:20:45', '2024-03-05 03:20:45'),
(2, 'Dinas ABC', 'dinasabc@gmail.com', NULL, '$2y$10$C3t29ZVMPUdS0/Xg1zQBwOB8yMRf.OXH07zqcCyI1eXw1MAt8RDqe', 'opd', NULL, '2024-04-18 19:48:41', '2024-04-18 19:48:41'),
(3, 'Diskominfo', 'diskominfo@gmail.com', NULL, '$2y$10$Qs4woo4g2J81oaJJtLY2HeAp2FHZSsN6d716gMhyD5AtmZKBDP3nq', 'assessment', NULL, '2024-04-18 19:53:51', '2024-04-18 19:53:51'),
(5, 'test3', 'test3@gmail.com', NULL, '$2y$10$q00A9NaIVkQirOqCsHXbXOCgzeXnny7GQkMt5Z1LEE7U5Pbamizbm', 'assessment', NULL, '2024-05-26 00:07:52', '2024-05-26 08:04:45'),
(6, 'Dinas Kesehatan', 'dinkes@gmail.com', NULL, '$2y$10$7IYuTh23EDNE.gGKeIwhJOh/uZEozwxfGfWOV200sEFehJKB/lQ82', 'opd', NULL, '2024-05-26 05:54:12', '2024-05-26 05:54:12'),
(7, 'Dinas Sosial', 'dinsos@gmail.com', NULL, '$2y$10$B8K.C7GyPZsY7qfZHZUk1u8XrURSIGYJFKq7mxy/F/aywrJ0T.ooS', 'opd', NULL, '2024-05-26 06:08:02', '2024-05-26 06:08:02'),
(8, 'Dinas Ketenaga Kerjaan', 'disnaker@gmail.com', NULL, '$2y$10$FpWH6YNTwleFbK5WKnyM/O.SNbDXvV8aHk9E9cEpMHq1N4BqMjI/.', 'opd', NULL, '2024-05-26 06:09:56', '2024-05-26 06:09:56'),
(9, 'Dinas Pendidikan', 'disdik@gmail.com', NULL, '$2y$10$l2Aw/AyP6lpR8D5xyvyIzOo.bXjLfoglCGAlw4paF/Bzn5Uml/Xbm', 'opd', NULL, '2024-05-26 06:14:22', '2024-05-26 06:14:22'),
(10, 'Dinas Lingkungan Hidup', 'dlh@gmail.com', NULL, '$2y$10$9EzOFxg0/FYz0uiEQkcF6uQNEqUkfIfRuTvlp.DFfgfcMckvIpkhK', 'opd', NULL, '2024-05-26 06:19:23', '2024-05-26 06:19:23'),
(11, 'Dinas Pemuda dan Olahraga', 'dispora@gmail.com', NULL, '$2y$10$dRacSuxNTc7uci0YozN4/uzwSF6klA/bdvov4QYLpGC/brwz9tLK2', 'opd', NULL, '2024-05-26 06:45:51', '2024-05-26 06:45:51'),
(12, 'Dinas Pekerjaan Umum dan Perumahan Rakyat', 'dpupr@gmail.com', NULL, '$2y$10$NpBxtZ2lPhj.7NudG5oAd.4UZxTYwM16UURDFpD8aETu65zKxE8Ja', 'opd', NULL, '2024-05-26 06:50:54', '2024-05-26 06:50:54');

-- --------------------------------------------------------

--
-- Table structure for table `user_apks`
--

CREATE TABLE `user_apks` (
  `id` int(11) NOT NULL,
  `pengguna_apk` varchar(150) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_apks`
--

INSERT INTO `user_apks` (`id`, `pengguna_apk`, `created_at`, `updated_at`) VALUES
(1, 'Aplikasi Internal Perangkat Daerah', '2024-04-24 07:11:56', '2024-04-24 07:11:56'),
(2, 'Perangkat Daerah Pemilik Aplikasi dan Beberapa Perangkat Daerah Lain', '2024-04-24 07:11:56', '2024-04-24 07:11:56'),
(3, 'Semua Perangkat Daerah Pemerintah Kota Bogor', '2024-04-24 07:11:56', '2024-04-24 07:11:56'),
(4, 'Perangkat Daerah Pemilik Aplikasi dan Masyarakat', '2024-04-24 07:11:56', '2024-04-24 07:11:56'),
(5, 'Perangkat Daerah Pemilik Aplikasi, Beberapa Perangkat Daerah Lain dan Masyarakat', '2024-04-24 07:11:56', '2024-04-24 07:11:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `apks`
--
ALTER TABLE `apks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assessments`
--
ALTER TABLE `assessments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `developers`
--
ALTER TABLE `developers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dokumens`
--
ALTER TABLE `dokumens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `hosting_sub_domains`
--
ALTER TABLE `hosting_sub_domains`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenis_kegiatans`
--
ALTER TABLE `jenis_kegiatans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kontrol_akses`
--
ALTER TABLE `kontrol_akses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manajemen_sesis`
--
ALTER TABLE `manajemen_sesis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `opds`
--
ALTER TABLE `opds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `penilaian_otentifikasis`
--
ALTER TABLE `penilaian_otentifikasis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penilaian_tata_kelolas`
--
ALTER TABLE `penilaian_tata_kelolas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penilaian_ui_uxes`
--
ALTER TABLE `penilaian_ui_uxes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `posts_slug_unique` (`slug`);

--
-- Indexes for table `programers`
--
ALTER TABLE `programers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tags_slug_unique` (`slug`);

--
-- Indexes for table `tata_kelolas`
--
ALTER TABLE `tata_kelolas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_apks`
--
ALTER TABLE `user_apks`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `apks`
--
ALTER TABLE `apks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `assessments`
--
ALTER TABLE `assessments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `developers`
--
ALTER TABLE `developers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `dokumens`
--
ALTER TABLE `dokumens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hosting_sub_domains`
--
ALTER TABLE `hosting_sub_domains`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jenis_kegiatans`
--
ALTER TABLE `jenis_kegiatans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kontrol_akses`
--
ALTER TABLE `kontrol_akses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `manajemen_sesis`
--
ALTER TABLE `manajemen_sesis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `opds`
--
ALTER TABLE `opds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `penilaian_otentifikasis`
--
ALTER TABLE `penilaian_otentifikasis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `penilaian_tata_kelolas`
--
ALTER TABLE `penilaian_tata_kelolas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `penilaian_ui_uxes`
--
ALTER TABLE `penilaian_ui_uxes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `programers`
--
ALTER TABLE `programers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `statuses`
--
ALTER TABLE `statuses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tata_kelolas`
--
ALTER TABLE `tata_kelolas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user_apks`
--
ALTER TABLE `user_apks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
