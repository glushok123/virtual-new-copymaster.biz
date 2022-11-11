-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3307
-- Время создания: Мар 29 2022 г., 18:51
-- Версия сервера: 10.3.22-MariaDB-log
-- Версия PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `testzayavki`
--

-- --------------------------------------------------------

--
-- Структура таблицы `user_accaunt`
--

CREATE TABLE `user_accaunt` (
  `id` int(100) NOT NULL,
  `login` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `passwd` varchar(100) NOT NULL,
  `date_creat` datetime NOT NULL,
  `device` varchar(200) DEFAULT NULL,
  `ip` varchar(20) DEFAULT NULL,
  `type_user` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user_accaunt`
--

INSERT INTO `user_accaunt` (`id`, `login`, `email`, `passwd`, `date_creat`, `device`, `ip`, `type_user`) VALUES
(5, 'glushok', 'glushok19999@gmail.com', '!140199!qazWSX', '2022-03-29 10:28:45', 'Chrome/98.0.4758.109/test', '127.0.0.1', 'false'),
(6, 'admin', 'ewrg@edhg.er', '!140199!qazWSX', '2022-03-29 13:00:25', 'Chrome/98.0.4758.109/test', '127.0.0.1', 'true'),
(7, 'admin2', 'asg@dsr.ru', '!140199!qazWSX', '2022-03-29 15:00:04', 'Chrome/98.0.4758.109/test', '127.0.0.1', 'true');

-- --------------------------------------------------------

--
-- Структура таблицы `user_accaunt_session`
--

CREATE TABLE `user_accaunt_session` (
  `id` int(100) NOT NULL,
  `id_user` int(100) NOT NULL,
  `date_in` datetime NOT NULL,
  `device` varchar(150) DEFAULT NULL,
  `ip` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user_accaunt_session`
--

INSERT INTO `user_accaunt_session` (`id`, `id_user`, `date_in`, `device`, `ip`) VALUES
(27, 5, '2022-03-29 11:52:54', 'Chrome/98.0.4758.109/test', '127.0.0.1'),
(28, 5, '2022-03-29 11:53:24', 'Chrome/98.0.4758.109/test', '127.0.0.1'),
(29, 5, '2022-03-29 12:48:18', 'Chrome/98.0.4758.109/test', '127.0.0.1'),
(30, 5, '2022-03-29 14:25:12', 'Chrome/98.0.4758.109/test', '127.0.0.1'),
(31, 6, '2022-03-29 14:30:58', 'Chrome/98.0.4758.109/test', '127.0.0.1'),
(32, 5, '2022-03-29 14:31:21', 'Chrome/98.0.4758.109/test', '127.0.0.1'),
(33, 5, '2022-03-29 14:43:30', 'Chrome/98.0.4758.109/test', '127.0.0.1'),
(34, 6, '2022-03-29 14:48:00', 'Chrome/98.0.4758.109/test', '127.0.0.1'),
(35, 5, '2022-03-29 14:57:10', 'Chrome/98.0.4758.109/test', '127.0.0.1'),
(36, 5, '2022-03-29 16:13:50', 'Chrome/98.0.4758.109/test', '127.0.0.1'),
(37, 6, '2022-03-29 16:22:05', 'Chrome/98.0.4758.109/test', '127.0.0.1'),
(38, 5, '2022-03-29 16:26:27', 'Chrome/98.0.4758.109/test', '127.0.0.1'),
(39, 5, '2022-03-29 16:26:42', 'Chrome/98.0.4758.109/test', '127.0.0.1'),
(40, 6, '2022-03-29 16:27:26', 'Chrome/98.0.4758.109/test', '127.0.0.1'),
(41, 5, '2022-03-29 16:36:56', 'Chrome/98.0.4758.109/test', '127.0.0.1'),
(42, 6, '2022-03-29 16:37:43', 'Chrome/98.0.4758.109/test', '127.0.0.1');

-- --------------------------------------------------------

--
-- Структура таблицы `zayavki`
--

CREATE TABLE `zayavki` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `status` varchar(10) DEFAULT 'Active',
  `message` varchar(1000) NOT NULL,
  `comment` varchar(1000) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `zayavki`
--

INSERT INTO `zayavki` (`id`, `name`, `email`, `status`, `message`, `comment`, `created_at`, `updated_at`) VALUES
(24, 'glushok', 'glushok19999@gmail.com', 'Resolved', 'dgjf', 'wtreu', '2022-03-29 16:27:05', '2022-03-29 16:34:51'),
(25, 'glushok', 'glushok19999@gmail.com', 'Resolved', 'dfgj', 'rewqy', '2022-03-29 16:27:08', '2022-03-29 16:35:13'),
(26, 'glushok', 'glushok19999@gmail.com', 'Resolved', 'sdfhj', 'wrtuy', '2022-03-29 16:37:01', '2022-03-29 16:48:28'),
(27, 'glushok', 'glushok19999@gmail.com', 'Active', 'sfgj', NULL, '2022-03-29 16:37:04', NULL),
(28, 'glushok', 'glushok19999@gmail.com', 'Active', 'sfgj', NULL, '2022-03-29 16:37:07', NULL),
(29, 'glushok', 'glushok19999@gmail.com', 'Active', 'fsdgjfsgj', NULL, '2022-03-29 16:37:11', NULL),
(30, 'glushok', 'glushok19999@gmail.com', 'Active', 'sfgjsfgj', NULL, '2022-03-29 16:37:14', NULL),
(31, 'glushok', 'glushok19999@gmail.com', 'Active', 'sfgjsgfjsf', NULL, '2022-03-29 16:37:17', NULL),
(32, 'glushok', 'glushok19999@gmail.com', 'Active', 'sfgjsfgjsfg', NULL, '2022-03-29 16:37:20', NULL),
(33, 'glushok', 'glushok19999@gmail.com', 'Active', 'sfgjsgfsgf', NULL, '2022-03-29 16:37:24', NULL),
(34, 'glushok', 'glushok19999@gmail.com', 'Active', 'dfgj', NULL, '2022-03-29 16:37:27', NULL),
(35, 'glushok', 'glushok19999@gmail.com', 'Active', 'sfgjsfg', NULL, '2022-03-29 16:37:30', NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `user_accaunt`
--
ALTER TABLE `user_accaunt`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`,`login`);

--
-- Индексы таблицы `user_accaunt_session`
--
ALTER TABLE `user_accaunt_session`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `zayavki`
--
ALTER TABLE `zayavki`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `user_accaunt`
--
ALTER TABLE `user_accaunt`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `user_accaunt_session`
--
ALTER TABLE `user_accaunt_session`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT для таблицы `zayavki`
--
ALTER TABLE `zayavki`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
