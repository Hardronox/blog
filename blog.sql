-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Мар 27 2017 г., 11:41
-- Версия сервера: 5.5.44-0ubuntu0.14.04.1
-- Версия PHP: 5.5.9-1ubuntu4.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `blog`
--

-- --------------------------------------------------------

--
-- Структура таблицы `advertisements`
--

CREATE TABLE IF NOT EXISTS `advertisements` (
  `id` smallint(5) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `website` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `advertisements`
--

INSERT INTO `advertisements` (`id`, `title`, `name`, `website`, `image`, `created_at`) VALUES
(1, 'The PHP Framework For Web Artisans', 'Laravel', 'https://laravel.com/', 'public/images/advertisement/laravel.png', '2017-02-22 11:30:54'),
(2, 'HTML enhanced for web apps!', 'AngularJs', 'https://angularjs.org/', 'public/images/advertisement/angular.png', '2017-02-22 11:31:10'),
(3, 'The most popular HTML, CSS, and JS framework', 'Bootstrap 3', 'http://getbootstrap.com/', 'public/images/advertisement/bootstrap.png', '2017-02-22 11:31:14'),
(4, 'Lightning-smart PHP IDE', 'PhpStorm', 'https://www.jetbrains.com/phpstorm/', 'public/images/advertisement/PhpStorm.png', '2017-02-22 11:31:19'),
(5, 'THE WORLD''S LARGEST WEB DEVELOPER SITE', 'w3schools', 'http://www.w3schools.com/', 'public/images/advertisement/w3schools.png', '2017-02-22 11:31:24');

-- --------------------------------------------------------

--
-- Структура таблицы `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `title` varchar(100) NOT NULL,
  `slug` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `text` text NOT NULL,
  `category_id` tinyint(2) NOT NULL,
  `image` varchar(250) DEFAULT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'published',
  `premium` varchar(10) NOT NULL DEFAULT 'free',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `article_category`
--

CREATE TABLE IF NOT EXISTS `article_category` (
  `id` tinyint(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `article_category`
--

INSERT INTO `article_category` (`id`, `name`) VALUES
(1, 'Backend'),
(2, 'Frontend'),
(3, 'Design');

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `article_id` mediumint(8) NOT NULL,
  `author_id` smallint(5) DEFAULT NULL,
  `text` text,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `owner_name` (`article_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=84 ;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`id`, `article_id`, `author_id`, `text`, `created_at`) VALUES
(57, 81, 1, 'asdasd', '2017-03-09 09:47:29'),
(58, 81, 1, 'gsdgdfg', '2017-03-09 09:51:43'),
(59, 81, 1, 'sdfgsdfg', '2017-03-09 09:51:45'),
(60, 81, 1, 'sdfgsdfgsdfgsdfgsdfg\ngsdfgsdfgsdfgsdfgsdfgsdfgsdfgsdfgsdfgsdfgsdfgsdfg', '2017-03-09 10:06:00'),
(61, 81, 1, 'sdfg\ndfgsdfgsdfgsdfgsdfgsdfgsdfgsdfgsdfgsdfgsdfgsdfgsdf\nsdfgsdfgsdfgsdfgsdfgsdas', '2017-03-09 10:06:35'),
(62, 81, 1, 'sdfgsdfgsdfgsdfgsdfgsdf\ngsdfgsdfgsdfgsdfgsdfgsdfgsdfgsdfgsdfgsdfgsdfg', '2017-03-09 10:09:00'),
(63, 81, 1, 'sdfgsdfgsdfgsdfgsdfgsdfgsdfgsdfgsdfgsdfgsdfgsdfgsdfgsdfgsdfgsdfg\ngsdfgsdfgsdfgsdfgsdfgsdas', '2017-03-09 10:09:08'),
(64, 81, 1, 'asdfasd fasdf asdfsdfa sdf asdfa sdfasdf asdfa sdVdfgsdfgsdfgsd dfgsdfgsdfgsddfgsdfgsdfgsddfgsdfgsdfgsd dfgsdfgsdfgsd', '2017-03-09 10:09:33'),
(65, 81, 1, 'и зрения доходов, если не брать во внимание Черную пятницу с ее распродажами (которая помогла нам удвоить прибыль ноября 2016 года), мы выросли примерно до $ 22 000 выручки в месяц. Часть ее уходит на оплату комиссии по партнерской программе, НДС, налога поставщиков и другие траты. В результате на данный момент мы имеем около $17,000 ежемесячной чистой прибыли. \nСегодня я хочу поделиться с вами, как мы со', '2017-03-09 10:11:00'),
(66, 81, 1, 'asdfasdf asdfa sdfa sdfasdf', '2017-03-09 10:11:34'),
(67, 81, 1, 'asdfasdfas dfasdf asdfa', '2017-03-09 10:20:27'),
(68, 81, 1, 'таби пизда', '2017-03-09 10:26:18'),
(69, 81, 1, 'Чак, таби пизда', '2017-03-09 10:26:28'),
(70, 80, 1, 'фывфыв', '2017-03-09 11:50:57'),
(71, 66, 7, 'fsgdfgsdfg', '2017-03-10 14:45:59'),
(72, 66, 7, 'hgdfhdfhg', '2017-03-10 14:46:02'),
(73, 66, 7, 'сямчсм', '2017-03-13 11:26:27'),
(74, 76, 7, 'dasdfasdf', '2017-03-15 10:30:36'),
(75, 76, 7, 'dfasdfasd', '2017-03-15 10:30:46'),
(76, 76, 7, 'adfgadfg', '2017-03-15 10:31:50'),
(77, 76, 7, 'asdfgadfg', '2017-03-15 10:34:22'),
(78, 76, 7, 'adfgadfg', '2017-03-15 10:34:28'),
(79, 76, 7, 'adfga', '2017-03-15 10:34:35'),
(80, 76, 7, 'asdfasdf', '2017-03-15 10:35:38'),
(81, 80, 7, 'nkbklbjkl', '2017-03-20 12:10:47'),
(82, 82, 7, 'hmghmghm', '2017-03-21 11:13:15'),
(83, 82, 7, 'вафпап', '2017-03-22 11:00:08');

-- --------------------------------------------------------

--
-- Структура таблицы `likes`
--

CREATE TABLE IF NOT EXISTS `likes` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `type` varchar(10) NOT NULL,
  `type_id` mediumint(8) NOT NULL,
  `user_id` mediumint(8) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `type` (`type`,`type_id`,`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=67 ;

--
-- Дамп данных таблицы `likes`
--

INSERT INTO `likes` (`id`, `type`, `type_id`, `user_id`) VALUES
(25, 'Blog', 4, 1),
(26, 'Blog', 10, 1),
(2, 'Blog', 14, 2),
(3, 'Blog', 14, 2),
(22, 'Blog', 19, 1),
(58, 'Blog', 21, 6),
(23, 'Blog', 40, 1),
(27, 'Blog', 50, 1),
(57, 'Blog', 80, 6),
(65, 'Blog', 81, 1),
(56, 'Blog', 81, 6),
(48, 'Blog', 159, 1),
(28, 'Blog', 160, 1),
(30, 'Blog', 161, 1),
(49, 'Blog', 162, 1),
(53, 'Comment', 3, 1),
(50, 'Comment', 37, 1),
(54, 'Comment', 47, 6),
(55, 'Comment', 51, 6),
(59, 'Comment', 52, 6),
(60, 'Comment', 65, 1),
(61, 'Comment', 66, 1),
(66, 'Comment', 71, 7);

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2015_01_15_105324_create_roles_table', 2),
('2015_01_15_114412_create_role_user_table', 2),
('2015_01_26_115212_create_permissions_table', 2),
('2015_01_26_115523_create_permission_role_table', 2),
('2015_02_09_132439_create_permission_user_table', 2),
('2016_11_02_131122_create_customers_table', 2),
('2016_11_07_102148_entrust_setup_tables', 3),
('2017_01_04_102431_entrust_setup_tables', 4),
('2017_01_04_123435_create_roles_table', 5),
('2017_01_04_124436_create_user_role_table', 5);

-- --------------------------------------------------------

--
-- Структура таблицы `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `created_at`, `updated_at`, `name`, `description`) VALUES
(1, '2017-01-04 11:46:54', '2017-01-04 11:46:54', 'admin', 'User is the Administrator of this site'),
(2, '2017-01-04 11:46:54', '2017-01-04 11:46:54', 'subscriber', 'User is allowed to watch special courses and videos');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Chuck', 'sanya19891@mail.ru', '$2y$10$HEHOD4/y9/X59nq40nVLJeYPmKXdbwJw84u8Tk6jXPxkP0r1iBGZS', 0, NULL, '2017-03-10 10:10:19', '2017-03-10 10:10:19'),
(2, 'Chucks', 'sanya19891@mail.rus', '$2y$10$Q3UQJD9u2wKCYWJUsVfbz.4CYpCjOzp3NVo5iOTWgb2fGoBpihLpa', 0, NULL, '2017-03-10 10:14:43', '2017-03-10 10:14:43'),
(3, 'Chuckss', 'sanya19891@mail.russ', '$2y$10$bns59WoGsifpVsSFQh2CKuN91xlthI0vQhWjc7pQh9TUpem6iqtoO', 1, 'LSnP9F4LhiVg9O1gOEu0DFbAiQZ9rQwoK2nggkJsVIEPlmjVykDcYDFqD013', '2017-03-10 10:17:11', '2017-03-10 10:25:33'),
(4, 'Chuckgfda', 'sanya19891@mail.ruz', '$2y$10$THIhYQdkpgJ4FLyUDfwnSu5tPdMXTiNt.ZimLKL/7l/KDgl0WtZPS', 0, NULL, '2017-03-10 10:27:15', '2017-03-10 10:27:15'),
(7, 'Chuckbv', 'sanya19891@mail.ruzbvx', '$2y$10$r3HFTs2kMVLQ.3ERp7Ehbe4Y2pht1iGr0xrJNqRfDFdOD2y2v/6i6', 1, 'AKFEncTT48bVJKVKKlLafmtcDNOcGMfq0l99tPIgt18rmLhWmmzjJO4cZdi0', '2017-03-10 10:57:35', '2017-03-10 12:05:36');

-- --------------------------------------------------------

--
-- Структура таблицы `users_profile`
--

CREATE TABLE IF NOT EXISTS `users_profile` (
  `id` smallint(5) NOT NULL AUTO_INCREMENT,
  `user_id` smallint(5) NOT NULL,
  `firstname` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `avatar` varchar(100) DEFAULT 'public/images/avatars/no-image.png',
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Дамп данных таблицы `users_profile`
--

INSERT INTO `users_profile` (`id`, `user_id`, `firstname`, `lastname`, `avatar`, `updated_at`, `created_at`) VALUES
(1, 1, 'Чакы', 'Дженкоы', 'public/images/avatars/6sjMJRzGZQBsN42cHg7eBHhcPQvZkeyb3khk5Wc3.jpeg', '2017-03-09 08:36:41', NULL),
(2, 23, 'dfas', 'fdasdf', 'public/images/avatars/HY0kFif8PeTdJg9lpUnO0kP7F0TxjJ3z1xbBxZnr.jpeg', '2017-03-06 10:57:56', '2017-03-06 10:55:21'),
(3, 24, 'gfhdgdhfgvhj', 'hdfghdfhgfghdfhgghjg', 'public/images/avatars/IQ9jThj2yd0bWD67EpoN6RVh0ykV6PXtgio7xi7a.jpeg', '2017-03-06 11:29:09', '2017-03-06 11:00:52'),
(4, 25, 'pizda', 'alkash ebanii', 'public/images/avatars/1ttDcRfjZHLr3dCrCMNE25PI4jUcNoCuFxLXrOwO.jpeg', '2017-03-07 09:35:48', '2017-03-07 09:34:42'),
(5, 26, NULL, NULL, 'public/images/avatars/no-image.png', '2017-03-09 11:25:58', '2017-03-09 11:25:58'),
(6, 27, NULL, NULL, 'public/images/avatars/no-image.png', '2017-03-09 12:18:42', '2017-03-09 12:18:42'),
(7, 28, NULL, NULL, 'public/images/avatars/no-image.png', '2017-03-09 12:43:38', '2017-03-09 12:43:38'),
(8, 29, NULL, NULL, 'public/images/avatars/no-image.png', '2017-03-09 12:45:49', '2017-03-09 12:45:49'),
(9, 30, NULL, NULL, 'public/images/avatars/no-image.png', '2017-03-09 12:48:07', '2017-03-09 12:48:07'),
(10, 31, NULL, NULL, 'public/images/avatars/no-image.png', '2017-03-10 09:59:20', '2017-03-10 09:59:20'),
(11, 32, NULL, NULL, 'public/images/avatars/no-image.png', '2017-03-10 10:05:44', '2017-03-10 10:05:44'),
(12, 33, NULL, NULL, 'public/images/avatars/no-image.png', '2017-03-10 10:07:56', '2017-03-10 10:07:56'),
(13, 3, NULL, NULL, 'public/images/avatars/no-image.png', '2017-03-10 10:17:12', '2017-03-10 10:17:12'),
(14, 4, NULL, NULL, 'public/images/avatars/no-image.png', '2017-03-10 10:27:17', '2017-03-10 10:27:17'),
(17, 7, 'Чак', 'Дженко', 'public/images/avatars/8x7G7u7DGEZQ5hCiAI6e6Wid1HjxKUqG39YbU77d.jpeg', '2017-03-22 06:41:24', '2017-03-10 10:57:37');

-- --------------------------------------------------------

--
-- Структура таблицы `user_provider`
--

CREATE TABLE IF NOT EXISTS `user_provider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `provider` varchar(50) NOT NULL,
  `provideruser` varchar(255) NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=159 ;

--
-- Дамп данных таблицы `user_provider`
--

INSERT INTO `user_provider` (`id`, `user_id`, `provider`, `provideruser`, `link`) VALUES
(24, 84, 'google', 'https://www.google.com/accounts/o8/id?id=AItOawnY_gMs1BgLcPnxa56PqY96VmpH8rbMjHo', NULL),
(134, 268, 'linkedin', '-nW8Eh3D63', 'https://www.linkedin.com/in/alex-cheremisin-3909b7110'),
(22, 62, 'linkedin', 'Y6ryzQjq13', NULL),
(25, 85, 'linkedin', 'SES-Y3Ff4G', NULL),
(26, 86, 'google', 'https://www.google.com/accounts/o8/id?id=AItOawmpcDdH5H9yuABw7enHLqG8mk2WeQTY4us', NULL),
(27, 62, 'linkedin', 'FDZzifVIhe', NULL),
(28, 62, 'facebook', '100003985389410', NULL),
(31, 93, 'google', 'https://www.google.com/accounts/o8/id?id=AItOawlKF-T2vliGmc3fGpH_XhJlmfXf2j1OFz8', NULL),
(32, 94, 'facebook', '1562227125', NULL),
(33, 94, 'linkedin', 'QtM4skszMw', NULL),
(34, 95, 'twitter', '208442076', NULL),
(35, 94, 'twitter', '208442076', NULL),
(36, 62, 'twitter', '1057770583', NULL),
(37, 62, 'google', 'https://www.google.com/accounts/o8/id?id=AItOawnKI6lJQym3BzLBuM4qVZC-A9aL9dyqtqI', NULL),
(38, 94, 'google', 'https://www.google.com/accounts/o8/id?id=AItOawk2fJ9FnqPxsPadS7MDBXCdCznS0Nov-z8', NULL),
(39, 96, 'google', 'https://www.google.com/accounts/o8/id?id=AItOawlHJUyvO3tAmD-dXHlWEFCRLYfBr7Hyz6A', NULL),
(44, 96, 'linkedin', 'QtM4skszMw', NULL),
(43, 96, 'facebook', '100001572891857', NULL),
(45, 96, 'twitter', '208442076', NULL),
(46, 97, 'google', 'https://www.google.com/accounts/o8/id?id=AItOawmph6PpgdDaRR0py_RxG5qQL5f-L6N1JtI', NULL),
(47, 98, 'facebook', '100001848013486', 'http://www.facebook.com/dmitry.oblachko'),
(48, 99, 'google', 'https://www.google.com/accounts/o8/id?id=AItOawk2fJ9FnqPxsPadS7MDBXCdCznS0Nov-z8', 'https://www.google.com/accounts/o8/id?id=AItOawk2fJ9FnqPxsPadS7MDBXCdCznS0Nov-z8'),
(66, 122, 'google', 'https://www.google.com/accounts/o8/id?id=AItOawluQu7UeK5HwgxthBTj5cYG4SXFSQzjW-E', 'https://www.google.com/accounts/o8/id?id=AItOawluQu7UeK5HwgxthBTj5cYG4SXFSQzjW-E'),
(50, 96, 'vkontakte', '22228489', NULL),
(64, 119, 'vkontakte', '9523874', 'http://vk.com/id9523874'),
(65, 120, 'vkontakte', '118475896', 'http://vk.com/id118475896'),
(53, 99, 'facebook', '100001569891723', NULL),
(54, 98, 'vkontakte', '5801334', NULL),
(55, 98, 'twitter', '204443768', NULL),
(56, 98, 'linkedin', 'zo-hr0VO2T', NULL),
(57, 98, 'google', 'https://www.google.com/accounts/o8/id?id=AItOawk1vcJWzYmoElHSREib6Aybt6w9nnvCoTU', NULL),
(67, 124, 'linkedin', 'NCWb-4diIK', 'http://www.linkedin.com/pub/mayya-chyrva/30/b9a/10'),
(68, 126, 'linkedin', 'SMWANqaFke', 'http://www.linkedin.com/pub/natalia-medvedeva/1/318/ab7'),
(63, 117, 'google', 'https://www.google.com/accounts/o8/id?id=AItOawmph6PpgdDaRR0py_RxG5qQL5f-L6N1JtI', 'https://www.google.com/accounts/o8/id?id=AItOawmph6PpgdDaRR0py_RxG5qQL5f-L6N1JtI'),
(69, 129, 'google', 'https://www.google.com/accounts/o8/id?id=AItOawnbNL0lBrsggPxDcJKhNBsxaK0hytHOQ9I', 'https://www.google.com/accounts/o8/id?id=AItOawnbNL0lBrsggPxDcJKhNBsxaK0hytHOQ9I'),
(70, 130, 'vkontakte', '19907049', 'http://vk.com/id19907049'),
(71, 133, 'vkontakte', '17585824', 'http://vk.com/id17585824'),
(72, 137, 'facebook', '100004770099117', 'https://www.facebook.com/tanyasvyat'),
(73, 138, 'vkontakte', '59440507', 'http://vk.com/id59440507'),
(74, 140, 'linkedin', 'D3vzY9wDZa', 'http://www.linkedin.com/pub/%D0%BE%D0%BB%D1%8C%D0%B3%D0%B0-%D1%88%D0%B8%D0%BC%D0%B0%D0%BD/72/244/961'),
(75, 142, 'facebook', '100001599859257', 'https://www.facebook.com/nick.zadvorniy'),
(76, 144, 'google', 'https://www.google.com/accounts/o8/id?id=AItOawkOeIKyvu7w3QkNYfrjQaKb0mEkfUdyCNQ', 'https://www.google.com/accounts/o8/id?id=AItOawkOeIKyvu7w3QkNYfrjQaKb0mEkfUdyCNQ'),
(77, 149, 'linkedin', 'aYYko8l6RG', 'http://www.linkedin.com/in/ekuzminov'),
(115, 148, 'linkedin', 'behl4Oyg1J', NULL),
(79, 152, 'linkedin', 'guL8XWfRqE', NULL),
(80, 155, 'linkedin', '3ET2izBf-C', 'http://www.linkedin.com/in/andreykononenko'),
(81, 159, 'facebook', '100000732752012', 'https://www.facebook.com/katrrin.maslova'),
(82, 160, 'linkedin', 'GiWaWC0KGu', NULL),
(83, 163, 'facebook', '100000726801528', 'https://www.facebook.com/oksinet'),
(84, 164, 'facebook', '100001544084125', 'https://www.facebook.com/tanya.khmelenko'),
(85, 165, 'facebook', '100001802765683', 'https://www.facebook.com/victoria.malaya.3'),
(86, 168, 'google', 'https://www.google.com/accounts/o8/id?id=AItOawmnliIw4DkCDf0tvAV8Jqb0vD-erJgVgrg', 'https://www.google.com/accounts/o8/id?id=AItOawmnliIw4DkCDf0tvAV8Jqb0vD-erJgVgrg'),
(87, 169, 'google', 'https://www.google.com/accounts/o8/id?id=AItOawmFVe1L14yTghQt01KtUKc7wIOt8PjxlqM', 'https://www.google.com/accounts/o8/id?id=AItOawmFVe1L14yTghQt01KtUKc7wIOt8PjxlqM'),
(88, 170, 'linkedin', 'CXcmbwbaMp', 'http://www.linkedin.com/pub/olga-vakhromova/17/160/516'),
(89, 172, 'vkontakte', '18439794', 'http://vk.com/id18439794'),
(90, 173, 'google', 'https://www.google.com/accounts/o8/id?id=AItOawkkeY7ebXwfUyNPRtSomLrNlCpxnJHHI0U', 'https://www.google.com/accounts/o8/id?id=AItOawkkeY7ebXwfUyNPRtSomLrNlCpxnJHHI0U'),
(91, 174, 'vkontakte', '42146120', 'http://vk.com/id42146120'),
(92, 175, 'vkontakte', '50584602', 'http://vk.com/id50584602'),
(93, 178, 'facebook', '100001327237979', 'https://www.facebook.com/elane.koroleva'),
(94, 179, 'google', 'https://www.google.com/accounts/o8/id?id=AItOawmhwjuEs0Kj3bK0HS0yIqfMsgwpCCsdy8c', 'https://www.google.com/accounts/o8/id?id=AItOawmhwjuEs0Kj3bK0HS0yIqfMsgwpCCsdy8c'),
(95, 180, 'facebook', '100001194206150', 'https://www.facebook.com/nadia.beregova'),
(96, 187, 'vkontakte', '262582876', 'http://vk.com/id262582876'),
(97, 193, 'linkedin', 't4X94w9REV', 'https://www.linkedin.com/pub/tatiana-svyatenko/54/395/580'),
(98, 195, 'google', 'https://www.google.com/accounts/o8/id?id=AItOawn6JPVjR27Y9vaGwzTm-kBghCc4LzbGlwM', 'https://www.google.com/accounts/o8/id?id=AItOawn6JPVjR27Y9vaGwzTm-kBghCc4LzbGlwM'),
(99, 197, 'facebook', '100002232512208', 'https://www.facebook.com/spichak.dima'),
(100, 200, 'linkedin', 'ZyHQ65r5m-', 'https://www.linkedin.com/pub/tatyana-kozovaya/a/851/92'),
(101, 201, 'vkontakte', '225973051', 'http://vk.com/id225973051'),
(102, 202, 'facebook', '100004319405143', 'https://www.facebook.com/kinkyell'),
(103, 203, 'facebook', '100003253503531', 'https://www.facebook.com/tanya.saputo'),
(104, 211, 'google', 'https://www.google.com/accounts/o8/id?id=AItOawlCNF_CTpYk_TAjlAJSyGEfd_5y0uMcS9Q', 'https://www.google.com/accounts/o8/id?id=AItOawlCNF_CTpYk_TAjlAJSyGEfd_5y0uMcS9Q'),
(105, 218, 'google', 'https://www.google.com/accounts/o8/id?id=AItOawnaIroD0j5qvZj3Ub4dqBMlsxY8tbu1YQ8', 'https://www.google.com/accounts/o8/id?id=AItOawnaIroD0j5qvZj3Ub4dqBMlsxY8tbu1YQ8'),
(106, 221, 'google', 'https://www.google.com/accounts/o8/id?id=AItOawljjf9rwJ5zITdpaZeIjYd-YtJ9tYja03k', 'https://www.google.com/accounts/o8/id?id=AItOawljjf9rwJ5zITdpaZeIjYd-YtJ9tYja03k'),
(107, 226, 'google', 'https://www.google.com/accounts/o8/id?id=AItOawlcbLAvbphqVZVfoURFGylXQvNCBkTCeN8', 'https://www.google.com/accounts/o8/id?id=AItOawlcbLAvbphqVZVfoURFGylXQvNCBkTCeN8'),
(108, 227, 'google', 'https://www.google.com/accounts/o8/id?id=AItOawnfQ8b52s0HURdQGHxGFsNgfXSSDHwzCA0', 'https://www.google.com/accounts/o8/id?id=AItOawnfQ8b52s0HURdQGHxGFsNgfXSSDHwzCA0'),
(109, 228, 'linkedin', 'XDFnWZDCDx', NULL),
(110, 253, 'linkedin', 'xta8UsDyV4', NULL),
(116, 257, 'linkedin', '-nW8Eh3D63', NULL),
(112, 257, 'vkontakte', '61850668', NULL),
(113, 257, 'facebook', '938661796223817', NULL),
(114, 257, 'twitter', '3402893177', NULL),
(117, 258, 'linkedin', '-nW8Eh3D63', 'https://www.linkedin.com/in/alex-cheremisin-3909b7110'),
(118, 258, 'facebook', '938661796223817', NULL),
(119, 259, 'facebook', '938661796223817', 'https://www.facebook.com/app_scoped_user_id/938661796223817/'),
(120, 260, 'facebook', '525040867663657', 'https://www.facebook.com/app_scoped_user_id/525040867663657/'),
(121, 261, 'facebook', '938661796223817', 'https://www.facebook.com/app_scoped_user_id/938661796223817/'),
(122, 261, 'linkedin', '-nW8Eh3D63', NULL),
(123, 261, 'vkontakte', '61850668', NULL),
(124, 262, 'vkontakte', '61850668', 'http://vk.com/id61850668'),
(125, 263, 'vkontakte', '61850668', 'http://vk.com/id61850668'),
(126, 263, 'facebook', '938661796223817', NULL),
(127, 263, 'linkedin', '-nW8Eh3D63', NULL),
(128, 264, 'linkedin', '-nW8Eh3D63', 'https://www.linkedin.com/in/alex-cheremisin-3909b7110'),
(129, 265, 'linkedin', '-nW8Eh3D63', 'https://www.linkedin.com/in/alex-cheremisin-3909b7110'),
(130, 266, 'linkedin', '-nW8Eh3D63', 'https://www.linkedin.com/in/alex-cheremisin-3909b7110'),
(131, 266, 'vkontakte', '61850668', NULL),
(132, 267, 'linkedin', '0dncJgw2Rt', 'https://www.linkedin.com/in/ellina-aleynikova-5ba34051'),
(133, 267, 'facebook', '100004319405143', NULL),
(135, 269, 'facebook', '938661796223817', 'https://www.facebook.com/app_scoped_user_id/938661796223817/'),
(136, 269, 'linkedin', '-nW8Eh3D63', NULL),
(137, 80, 'linkedin', 'clsG4lzl6e', NULL),
(138, 285, 'facebook', '938661796223817', 'https://www.facebook.com/app_scoped_user_id/938661796223817/'),
(139, 286, 'facebook', '938661796223817', 'https://www.facebook.com/app_scoped_user_id/938661796223817/'),
(140, 286, 'vkontakte', '61850668', NULL),
(141, 286, 'linkedin', '-nW8Eh3D63', NULL),
(142, 292, 'vkontakte', '11216887', 'http://vk.com/id11216887'),
(143, 293, 'vkontakte', '4514198', 'http://vk.com/id4514198'),
(144, 294, 'vkontakte', '28614615', 'http://vk.com/id28614615'),
(145, 295, 'linkedin', 'mrHDzJ0Dkc', 'https://www.linkedin.com/in/julia-akimova-32ab8a4'),
(146, 298, 'linkedin', 'pZnEZ5aqJi', 'https://www.linkedin.com/in/anna-hr-9556ab37'),
(147, 303, 'linkedin', 'Xg3WaAFYKQ', 'https://www.linkedin.com/in/sergey-kostyrko-62a4a143'),
(148, 304, 'linkedin', 'WzqTOWYHni', 'https://www.linkedin.com/in/vera-adamenko-5a25312'),
(149, 302, 'facebook', '531209420373411', NULL),
(150, 308, 'vkontakte', '8448598', 'http://vk.com/id8448598'),
(151, 309, 'linkedin', 'kpk8WrMUli', 'https://www.linkedin.com/in/olga-didenko-34ab4654'),
(152, 311, 'linkedin', 'TipTmeX3L8', 'https://www.linkedin.com/in/antonchepurda'),
(153, 313, 'linkedin', 'czKAIBLqOO', 'https://www.linkedin.com/in/gaplevskaya-elizaveta-601839111'),
(154, 312, 'linkedin', '8SPeph3HhR', NULL),
(155, 317, 'vkontakte', '187918734', 'http://vk.com/id187918734'),
(156, 323, 'linkedin', 'yhzxIx9r3i', 'https://www.linkedin.com/in/stanislav-snezhkovskiy-39336b47'),
(157, 325, 'vkontakte', '141227229', 'http://vk.com/id141227229'),
(158, 327, 'linkedin', 'CLwulF1ONN', 'https://www.linkedin.com/in/viacheslavshcherbak');

-- --------------------------------------------------------

--
-- Структура таблицы `user_role`
--

CREATE TABLE IF NOT EXISTS `user_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `user_role`
--

INSERT INTO `user_role` (`id`, `created_at`, `updated_at`, `user_id`, `role_id`) VALUES
(1, NULL, NULL, 7, 1),
(2, NULL, NULL, 7, 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
