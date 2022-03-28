-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 08 2022 г., 18:46
-- Версия сервера: 10.3.22-MariaDB
-- Версия PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `hytorapp`
--

-- --------------------------------------------------------

--
-- Структура таблицы `apartment`
--

CREATE TABLE `apartment` (
  `id` int(11) NOT NULL,
  `name` varchar(190) NOT NULL,
  `description` text DEFAULT NULL,
  `image` text DEFAULT NULL,
  `price` text DEFAULT NULL,
  `display_order` smallint(6) NOT NULL DEFAULT 0,
  `status` tinyint(3) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `apartment`
--

INSERT INTO `apartment` (`id`, `name`, `description`, `image`, `price`, `display_order`, `status`) VALUES
(1, 'Хатина 1914 р.', '', '', '{\"days2\":\"11\",\"days5\":\"52\",\"days10\":\"103\",\"days15\":\"154\"}', 0, 1),
(2, 'Хатина 1928 р.', '', NULL, '{\"days2\":\"220\",\"days5\":\"530\",\"days10\":\"\",\"days15\":\"\"}', 0, 1),
(3, 'Хатина 1930 р.', '', NULL, '{\"days2\":\"\",\"days5\":\"\",\"days10\":\"\",\"days15\":\"\"}', 0, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `apartment_order`
--

CREATE TABLE `apartment_order` (
  `apartment_order_id` int(11) NOT NULL,
  `apartment_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `check_in` date DEFAULT NULL,
  `check_out` date DEFAULT NULL,
  `people` tinyint(3) DEFAULT NULL,
  `child` tinyint(3) DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `fio` varchar(255) DEFAULT NULL,
  `auth_key` varchar(32) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `password_reset_token` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `verification_token` varchar(255) DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT 10,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `logged_at` int(11) DEFAULT NULL,
  `postal_code` int(6) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `customer`
--

INSERT INTO `customer` (`id`, `username`, `fio`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `phone`, `verification_token`, `status`, `created_at`, `updated_at`, `logged_at`, `postal_code`, `street`, `city`) VALUES
(1, 'oleg', 'Пупкин Василий Иванович', '', '', NULL, '', '0668368836', NULL, 10, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `food`
--

CREATE TABLE `food` (
  `id` int(11) NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `outlet` smallint(6) DEFAULT NULL,
  `outlet_amount` smallint(6) DEFAULT NULL,
  `dish_type` smallint(6) DEFAULT NULL COMMENT 'vegan/post',
  `type` smallint(6) DEFAULT 0 COMMENT 'snidanok/obid/vecherya',
  `status` smallint(6) NOT NULL DEFAULT 0,
  `sort_order` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `food`
--

INSERT INTO `food` (`id`, `title`, `description`, `price`, `outlet`, `outlet_amount`, `dish_type`, `type`, `status`, `sort_order`) VALUES
(1, 'Салат з капусти', 'ываыфвафы', '12.50', 0, 100, 1, 0, 1, 0),
(2, 'Борщ пісний', '', '12.30', 0, 0, 2, 1, 1, 0),
(3, 'Вареники з картоплею', '', '31.55', 0, 150, 0, 2, 1, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `food_order`
--

CREATE TABLE `food_order` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `apartment_id` int(11) DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT 0,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `food_order`
--

INSERT INTO `food_order` (`id`, `customer_id`, `apartment_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, NULL, NULL),
(3, 1, 1, 0, NULL, NULL),
(4, 1, 1, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `food_order_type`
--

CREATE TABLE `food_order_type` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `order_type` smallint(6) NOT NULL COMMENT 'snidanok/obid/vecherya',
  `serve_at` int(11) DEFAULT NULL COMMENT 'chas serveryvannya'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `food_order_type`
--

INSERT INTO `food_order_type` (`id`, `order_id`, `order_type`, `serve_at`) VALUES
(3, 3, 1, NULL),
(20, 1, 1, 0),
(21, 1, 0, 1635680700),
(22, 1, 2, 0),
(23, 4, 1, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `food_order_type_item`
--

CREATE TABLE `food_order_type_item` (
  `id` int(11) NOT NULL,
  `order_type_id` int(11) NOT NULL,
  `food_id` int(11) DEFAULT NULL,
  `quantity` int(4) NOT NULL,
  `price` decimal(11,2) DEFAULT 0.00,
  `total` decimal(11,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `food_order_type_item`
--

INSERT INTO `food_order_type_item` (`id`, `order_type_id`, `food_id`, `quantity`, `price`, `total`) VALUES
(6, 3, 1, 4, '0.00', '0.00'),
(7, 3, 3, 2, '0.00', '0.00'),
(32, 20, 1, 11, '25.00', '137.50'),
(34, 21, 3, 22, '63.10', '694.10'),
(36, 21, 2, 1, '24.60', '12.30'),
(37, 21, 1, 12315, '25.00', '153937.50'),
(38, 20, 3, 256464, '63.10', '8091439.20');

-- --------------------------------------------------------

--
-- Структура таблицы `food_set`
--

CREATE TABLE `food_set` (
  `id` int(11) NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` smallint(6) NOT NULL DEFAULT 0 COMMENT 'snidanok/obid/vecherya',
  `status` smallint(6) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `food_set`
--

INSERT INTO `food_set` (`id`, `title`, `description`, `type`, `status`) VALUES
(1, 'Легкі сніданки', '', 0, 1),
(2, 'Обідні страви', '', 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `food_to_set`
--

CREATE TABLE `food_to_set` (
  `food_id` int(11) NOT NULL,
  `set_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `food_to_set`
--

INSERT INTO `food_to_set` (`food_id`, `set_id`) VALUES
(1, 1),
(1, 2),
(2, 1),
(3, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `key_storage_item`
--

CREATE TABLE `key_storage_item` (
  `key` varchar(128) NOT NULL,
  `value` text NOT NULL,
  `comment` text DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `key_storage_item`
--

INSERT INTO `key_storage_item` (`key`, `value`, `comment`, `updated_at`, `created_at`) VALUES
('backend.layout-boxed', '0', NULL, NULL, NULL),
('backend.layout-collapsed-sidebar', '0', NULL, NULL, NULL),
('backend.layout-fixed', '0', NULL, NULL, NULL),
('backend.theme-skin', 'skin-blue', 'skin-blue, skin-black, skin-purple, skin-green, skin-red, skin-yellow', NULL, NULL),
('frontend.maintenance', 'disabled', 'Set it to \"enabled\" to turn on maintenance mode', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `rbac_auth_assignment`
--

CREATE TABLE `rbac_auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `rbac_auth_assignment`
--

INSERT INTO `rbac_auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('administrator', '1', 1618248213),
('manager', '2', 1618248213),
('user', '3', 1618248213);

-- --------------------------------------------------------

--
-- Структура таблицы `rbac_auth_item`
--

CREATE TABLE `rbac_auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `rbac_auth_item`
--

INSERT INTO `rbac_auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('administrator', 1, NULL, NULL, NULL, 1618248213, 1635601386),
('editOwnModel', 2, NULL, 'ownModelRule', NULL, 1618248213, 1635601373),
('loginToBackend', 2, NULL, NULL, NULL, 1618248213, 1618248213),
('manager', 1, NULL, NULL, NULL, 1618248213, 1618248213),
('user', 1, NULL, NULL, NULL, 1618248213, 1618248213);

-- --------------------------------------------------------

--
-- Структура таблицы `rbac_auth_item_child`
--

CREATE TABLE `rbac_auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `rbac_auth_item_child`
--

INSERT INTO `rbac_auth_item_child` (`parent`, `child`) VALUES
('administrator', 'loginToBackend'),
('administrator', 'manager'),
('administrator', 'user'),
('manager', 'loginToBackend'),
('manager', 'user'),
('user', 'editOwnModel');

-- --------------------------------------------------------

--
-- Структура таблицы `rbac_auth_rule`
--

CREATE TABLE `rbac_auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `rbac_auth_rule`
--

INSERT INTO `rbac_auth_rule` (`name`, `data`, `created_at`, `updated_at`) VALUES
('ownModelRule', 0x4f3a32393a22636f6d6d6f6e5c726261635c72756c655c4f776e4d6f64656c52756c65223a333a7b733a343a226e616d65223b733a31323a226f776e4d6f64656c52756c65223b733a393a22637265617465644174223b693a313631383234383231333b733a393a22757064617465644174223b693a313631383234383231333b7d, 1618248213, 1618248213);

-- --------------------------------------------------------

--
-- Структура таблицы `system_db_migration`
--

CREATE TABLE `system_db_migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `system_db_migration`
--

INSERT INTO `system_db_migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1618247612),
('m140703_123000_user', 1618247615),
('m140703_123813_rbac', 1618247616),
('m140805_084745_key_storage_item', 1618247617),
('m150725_192740_seed_data', 1618247619),
('m160203_095604_user_token', 1618247620),
('m210415_193035_create_client_table', 1618516409);

-- --------------------------------------------------------

--
-- Структура таблицы `system_rbac_migration`
--

CREATE TABLE `system_rbac_migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `system_rbac_migration`
--

INSERT INTO `system_rbac_migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1618248210),
('m150625_214101_roles', 1618248213),
('m150625_215624_init_permissions', 1618248213),
('m151223_074604_edit_own_model', 1618248213);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(32) DEFAULT NULL,
  `auth_key` varchar(32) NOT NULL,
  `access_token` varchar(40) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `oauth_client` varchar(255) DEFAULT NULL,
  `oauth_client_user_id` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT 2,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `logged_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `access_token`, `password_hash`, `oauth_client`, `oauth_client_user_id`, `email`, `status`, `created_at`, `updated_at`, `logged_at`) VALUES
(1, 'webmaster', 'Cdoka2hVvADdk1E-JcbkNFUKU653yvCd', 'VsI-WBPn_-3_V2PRS0hovk0z5nR7WrDp4d4tUsoQ', '$2y$13$SAwZtdC7/i.3xp4GsJlfNe4L7HQzX/iN2iLUBgn/9FZE/aflhb2NW', NULL, NULL, 'webmaster@example.com', 2, 1618247618, 1618247618, NULL),
(2, 'manager', '3eXzU73060eyoLXGWzoCZ8q_QdzoKyl8', 'f-x_l0qdCaNliwYIpE47gQS2SZsWTRfuQ5aexxlA', '$2y$13$tCPWLjrNuA8N2SBiRFlUlO0NRNWCMoipnDtSA//A6a5udj7uYm8gq', NULL, NULL, 'manager@example.com', 2, 1618247618, 1618247618, NULL),
(3, 'user', 'dCTwpZd2aFwhnqqNC3TFf4xgADxCPkB3', '71yracfMkIkL1ry73asLvp71nv7MmMNkUJkRMZUk', '$2y$13$j8NqRytAqAW7nfze3OntPux40XoU1YY2/MjhoOx2AIdUb8zT596UK', NULL, NULL, 'user@example.com', 2, 1618247619, 1618247619, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `user_profile`
--

CREATE TABLE `user_profile` (
  `user_id` int(11) NOT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `middlename` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `avatar_path` varchar(255) DEFAULT NULL,
  `avatar_base_url` varchar(255) DEFAULT NULL,
  `locale` varchar(32) NOT NULL,
  `gender` smallint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `user_profile`
--

INSERT INTO `user_profile` (`user_id`, `firstname`, `middlename`, `lastname`, `avatar_path`, `avatar_base_url`, `locale`, `gender`) VALUES
(1, 'Oleg', '', 'Kononchuk', NULL, NULL, 'uk-UA', 2),
(2, NULL, NULL, NULL, NULL, NULL, 'uk-UA', NULL),
(3, NULL, NULL, NULL, NULL, NULL, 'uk-UA', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `user_token`
--

CREATE TABLE `user_token` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `token` varchar(40) NOT NULL,
  `expire_at` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `apartment`
--
ALTER TABLE `apartment`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `apartment_order`
--
ALTER TABLE `apartment_order`
  ADD PRIMARY KEY (`apartment_order_id`),
  ADD KEY `FK_apartment_order_apartment` (`apartment_id`),
  ADD KEY `FK_apartment_order_customer` (`customer_id`);

--
-- Индексы таблицы `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- Индексы таблицы `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `food_order`
--
ALTER TABLE `food_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_food_order_customer` (`customer_id`),
  ADD KEY `FK_food_order_apartment` (`apartment_id`);

--
-- Индексы таблицы `food_order_type`
--
ALTER TABLE `food_order_type`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_food_order_type_food_order` (`order_id`);

--
-- Индексы таблицы `food_order_type_item`
--
ALTER TABLE `food_order_type_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_food_order_type_item_food_order_type` (`order_type_id`),
  ADD KEY `FK_food_order_type_item_food` (`food_id`);

--
-- Индексы таблицы `food_set`
--
ALTER TABLE `food_set`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `food_to_set`
--
ALTER TABLE `food_to_set`
  ADD PRIMARY KEY (`food_id`,`set_id`) USING BTREE,
  ADD KEY `FK_food_to_set_food_set` (`set_id`);

--
-- Индексы таблицы `key_storage_item`
--
ALTER TABLE `key_storage_item`
  ADD PRIMARY KEY (`key`),
  ADD UNIQUE KEY `idx_key_storage_item_key` (`key`);

--
-- Индексы таблицы `rbac_auth_assignment`
--
ALTER TABLE `rbac_auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`);

--
-- Индексы таблицы `rbac_auth_item`
--
ALTER TABLE `rbac_auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Индексы таблицы `rbac_auth_item_child`
--
ALTER TABLE `rbac_auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Индексы таблицы `rbac_auth_rule`
--
ALTER TABLE `rbac_auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Индексы таблицы `system_db_migration`
--
ALTER TABLE `system_db_migration`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `system_rbac_migration`
--
ALTER TABLE `system_rbac_migration`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user_profile`
--
ALTER TABLE `user_profile`
  ADD PRIMARY KEY (`user_id`);

--
-- Индексы таблицы `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `apartment`
--
ALTER TABLE `apartment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `apartment_order`
--
ALTER TABLE `apartment_order`
  MODIFY `apartment_order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `food`
--
ALTER TABLE `food`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `food_order`
--
ALTER TABLE `food_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `food_order_type`
--
ALTER TABLE `food_order_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT для таблицы `food_order_type_item`
--
ALTER TABLE `food_order_type_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT для таблицы `food_set`
--
ALTER TABLE `food_set`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `user_profile`
--
ALTER TABLE `user_profile`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `apartment_order`
--
ALTER TABLE `apartment_order`
  ADD CONSTRAINT `FK_apartment_order_apartment` FOREIGN KEY (`apartment_id`) REFERENCES `apartment` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_apartment_order_customer` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `food_order`
--
ALTER TABLE `food_order`
  ADD CONSTRAINT `FK_food_order_apartment` FOREIGN KEY (`apartment_id`) REFERENCES `apartment` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_food_order_customer` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `food_order_type`
--
ALTER TABLE `food_order_type`
  ADD CONSTRAINT `FK_food_order_type_food_order` FOREIGN KEY (`order_id`) REFERENCES `food_order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `food_order_type_item`
--
ALTER TABLE `food_order_type_item`
  ADD CONSTRAINT `FK_food_order_type_item_food` FOREIGN KEY (`food_id`) REFERENCES `food` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_food_order_type_item_food_order_type` FOREIGN KEY (`order_type_id`) REFERENCES `food_order_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `food_to_set`
--
ALTER TABLE `food_to_set`
  ADD CONSTRAINT `FK_food_to_set_food` FOREIGN KEY (`food_id`) REFERENCES `food` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_food_to_set_food_set` FOREIGN KEY (`set_id`) REFERENCES `food_set` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `rbac_auth_assignment`
--
ALTER TABLE `rbac_auth_assignment`
  ADD CONSTRAINT `rbac_auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `rbac_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `rbac_auth_item`
--
ALTER TABLE `rbac_auth_item`
  ADD CONSTRAINT `rbac_auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `rbac_auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `rbac_auth_item_child`
--
ALTER TABLE `rbac_auth_item_child`
  ADD CONSTRAINT `rbac_auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `rbac_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rbac_auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `rbac_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `user_profile`
--
ALTER TABLE `user_profile`
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
