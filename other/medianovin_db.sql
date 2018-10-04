-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 04, 2018 at 09:59 AM
-- Server version: 5.7.19
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `medianovin_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog_articles`
--

DROP TABLE IF EXISTS `blog_articles`;
CREATE TABLE IF NOT EXISTS `blog_articles` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `blog_category_id` int(10) UNSIGNED NOT NULL,
  `author_id` int(10) UNSIGNED NOT NULL,
  `editor_id` int(10) UNSIGNED DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fa_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `en_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fa_slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `en_slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fa_description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `en_description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fa_body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `en_body` text COLLATE utf8mb4_unicode_ci,
  `comments` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blog_article_blog_tag`
--

DROP TABLE IF EXISTS `blog_article_blog_tag`;
CREATE TABLE IF NOT EXISTS `blog_article_blog_tag` (
  `blog_article_id` int(10) UNSIGNED NOT NULL,
  `blog_tag_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blog_categories`
--

DROP TABLE IF EXISTS `blog_categories`;
CREATE TABLE IF NOT EXISTS `blog_categories` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `fa_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `en_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blog_comments`
--

DROP TABLE IF EXISTS `blog_comments`;
CREATE TABLE IF NOT EXISTS `blog_comments` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `blog_article_id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blog_tags`
--

DROP TABLE IF EXISTS `blog_tags`;
CREATE TABLE IF NOT EXISTS `blog_tags` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `fa_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `en_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_09_27_103215_create_permissions_table', 1),
(4, '2018_09_27_103250_create_permission_user_table', 1),
(5, '2018_09_29_090033_create_settings_table', 1),
(6, '2018_10_01_094311_create_tickets_table', 1),
(7, '2018_10_02_164748_create_blog_articles_table', 1),
(8, '2018_10_02_171254_create_blog_tags_table', 1),
(9, '2018_10_02_171312_create_blog_categories_table', 1),
(10, '2018_10_02_171328_create_blog_comments_table', 1),
(11, '2018_10_02_171443_create_blog_article_blog_tag_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `fa_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `en_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `fa_title`, `en_title`, `parent`, `created_at`, `updated_at`) VALUES
(1, 'مدیران', 'admins', NULL, '2018-10-04 09:35:32', '2018-10-04 09:35:32'),
(2, 'تیکت ها', 'tickets', NULL, '2018-10-04 09:35:39', '2018-10-04 09:35:39'),
(3, 'ارسال تیکت', 'tickets-send', 'tickets', '2018-10-04 09:35:39', '2018-10-04 09:35:39'),
(4, 'حذف تیکت', 'tickets-delete', 'tickets', '2018-10-04 09:35:39', '2018-10-04 09:35:39'),
(5, 'وبلاگ', 'blog', NULL, '2018-10-04 09:56:11', '2018-10-04 09:56:11'),
(6, 'ایجاد مقاله', 'blog-articles-create', NULL, '2018-10-04 09:56:11', '2018-10-04 09:56:11'),
(7, 'ویرایش مقاله', 'blog-articles-edit', NULL, '2018-10-04 09:56:11', '2018-10-04 09:56:11'),
(8, 'حذف مقاله', 'blog-articles-delete', NULL, '2018-10-04 09:56:11', '2018-10-04 09:56:11'),
(9, 'ایجاد دسته بندی', 'blog-categories-create', NULL, '2018-10-04 09:56:11', '2018-10-04 09:56:11'),
(10, 'ویرایش دسته بندی', 'blog-categories-edit', NULL, '2018-10-04 09:56:11', '2018-10-04 09:56:11'),
(11, 'حذف دسته بندی', 'blog-categories-delete', NULL, '2018-10-04 09:56:11', '2018-10-04 09:56:11'),
(12, 'ایجاد تگ', 'blog-tags-create', NULL, '2018-10-04 09:56:11', '2018-10-04 09:56:11'),
(13, 'ویرایش تگ', 'blog-tags-edit', NULL, '2018-10-04 09:56:11', '2018-10-04 09:56:11'),
(14, 'حذف تگ', 'blog-tags-delete', NULL, '2018-10-04 09:56:11', '2018-10-04 09:56:11'),
(15, 'تایید نظر', 'blog-comments-approve', NULL, '2018-10-04 09:56:11', '2018-10-04 09:56:11'),
(16, 'ویرایش نظر', 'blog-comments-edit', NULL, '2018-10-04 09:56:11', '2018-10-04 09:56:11'),
(17, 'حذف نظر', 'blog-comments-delete', NULL, '2018-10-04 09:56:11', '2018-10-04 09:56:11'),
(18, 'پاسخ به نظر', 'blog-comments-reply', NULL, '2018-10-04 09:56:11', '2018-10-04 09:56:11');

-- --------------------------------------------------------

--
-- Table structure for table `permission_user`
--

DROP TABLE IF EXISTS `permission_user`;
CREATE TABLE IF NOT EXISTS `permission_user` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_user`
--

INSERT INTO `permission_user` (`permission_id`, `user_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(2, 3),
(3, 3),
(4, 3),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

DROP TABLE IF EXISTS `tickets`;
CREATE TABLE IF NOT EXISTS `tickets` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `user_id`, `title`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 'تست', 'closed', '2018-10-04 09:23:53', '2018-10-04 09:23:53'),
(2, 2, 'تست', 'closed', '2018-10-04 09:35:39', '2018-10-04 09:35:39');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `email`, `password`, `role`, `remember_token`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'a', 'a', 'admin', 'admin@email.com', '$2y$10$d.hu9UIgZEOW1UIMvq30bOZrtKHzIyT8FCIL4oYKMjDPjXN1BgDNm', 'super-admin', NULL, NULL, '2018-10-04 09:24:35', '2018-10-04 09:24:35'),
(2, 'b', 'b', 'user', 'user@email.com', '$2y$10$DACkkdXdeky2u2qerYO2R.cPZCAQsdJHRHMniI4neEd4W70UhYzX6', 'user', NULL, NULL, '2018-10-04 09:24:35', '2018-10-04 09:24:35'),
(3, 'c', 'c', 'admin2', 'admin2@email.com', '$2y$10$kacDG0ZBJvSNVw2kcRf/v.A7peFmctdOTDQ76laItVgjKOJITxL1K', 'admin', NULL, NULL, '2018-10-04 09:30:09', '2018-10-04 09:50:19'),
(5, 'd', 'd', 'admin3', 'admin3@email.com', '$2y$10$hOejHwtXUcSL9Gp2JmBZHuYDKSnfN9nV/Ws0zKorgxXo.VOSBTaCu', 'admin', NULL, NULL, '2018-10-04 09:40:59', '2018-10-04 09:40:59');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
