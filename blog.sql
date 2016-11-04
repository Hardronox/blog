-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Ноя 04 2016 г., 17:24
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
-- Структура таблицы `blogs`
--

CREATE TABLE IF NOT EXISTS `blogs` (
  `id` smallint(5) NOT NULL AUTO_INCREMENT,
  `user_id` smallint(5) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `text` text NOT NULL,
  `category_id` tinyint(2) NOT NULL,
  `views` mediumint(10) NOT NULL,
  `image` varchar(250) NOT NULL,
  `created_at` int(15) NOT NULL,
  `updated_at` int(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Дамп данных таблицы `blogs`
--

INSERT INTO `blogs` (`id`, `user_id`, `title`, `description`, `text`, `category_id`, `views`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, 'Статья 1', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but release of ', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, 431, 'adsfasd', 123123, 321313),
(2, 1, 'Статья 2', 't is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that', 't is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ''Content here, content here'', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for ''lorem ipsum'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, 2, 'asdf', 123, 321),
(3, 1, 'Статья 3', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don''t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn''t anything embarrassing hidden in the middle of text. ', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don''t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn''t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable', 3, 31, '', 2016, 2016),
(4, 1, 'Статья 4', 'csdfgsdfg', '231фывафыва', 4, 4, '', 2016, 2016),
(5, 0, 'tit', 'desc', '<p>dfghdfghdfghdfhg</p>', 0, 5, '', 2016, 2016),
(6, 0, 'tili', 'ghdfgh', '<p>dfghdfghdfghd</p>', 0, 342, '', 2016, 2016),
(7, 0, 'ertertertert', '3453453q3tqe', '<p>tdgdfgsdfg</p>', 0, 7, '', 2016, 2016),
(8, 0, 'asdfas123', '123dafsdfa', '<p>sdfasdfasdfsdf</p>', 0, 8, '', 2016, 2016),
(9, 0, 'asdfas123456', '123dafsdfa456', '<p>sdfasdfasdfsdfdfa</p>', 0, 9, '', 2016, 2016),
(10, 0, 'xsdfa', 'dfasdf', '<p>fdsaf</p>', 0, 1, '', 2016, 2016),
(11, 0, '1321231', 'afdasdfa', '<p>asdfasdf</p>', 2, 0, '', 2016, 2016);

-- --------------------------------------------------------

--
-- Структура таблицы `blog_category`
--

CREATE TABLE IF NOT EXISTS `blog_category` (
  `id` tinyint(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `blog_category`
--

INSERT INTO `blog_category` (`id`, `name`) VALUES
(1, 'Backend'),
(2, 'Frontend'),
(3, 'Design');

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
('2014_10_12_100000_create_password_resets_table', 1);

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
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Batya', 'Sanya.Chuck@mail.ru', '$2y$10$8JRycTHASYoV4CC/NCEYeOhgplO4tELV51UaSPfdPRUfVt0FekQBa', 'EDx1jvTbGZNL6ITyxuUM7U8LIay7WRxlGXE3Z5e1pBvPWctgF5SBXABs1MG1', '2016-10-20 06:01:25', '2016-11-04 09:19:05'),
(13, 'фываф', 'asdfa@mail.ru', '$2y$10$J/ahVLu00W8W1xJoV82WzOz1tbKBo3Suq1liv1pdKdax42lSDqrH.', NULL, '2016-11-04 13:13:30', '2016-11-04 13:13:30');

-- --------------------------------------------------------

--
-- Структура таблицы `users_profile`
--

CREATE TABLE IF NOT EXISTS `users_profile` (
  `id` smallint(5) NOT NULL AUTO_INCREMENT,
  `user_id` smallint(5) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `avatar` varchar(100) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Дамп данных таблицы `users_profile`
--

INSERT INTO `users_profile` (`id`, `user_id`, `firstname`, `lastname`, `avatar`, `updated_at`, `created_at`) VALUES
(1, 1, 'Чак', 'Дженко', 'rP4lYJDJQUg2Aivr6RVvFDEkPSEe73.jpeg', '2016-11-04 08:29:16', NULL),
(2, 2, 'Kek', 'Tikbek', 'UoJrhNXF5YiG8TiMV3V2Uleg84d4UU.jpeg', '2016-11-04 10:34:05', '2016-11-04 10:20:29');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
