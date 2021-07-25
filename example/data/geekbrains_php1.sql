-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Июн 29 2021 г., 14:25
-- Версия сервера: 10.4.13-MariaDB
-- Версия PHP: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `geekbrains_php1`
--

-- --------------------------------------------------------

--
-- Структура таблицы `basket`
--

CREATE TABLE `basket` (
  `id` int(11) NOT NULL,
  `session_id` varchar(100) NOT NULL,
  `good_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `basket`
--

INSERT INTO `basket` (`id`, `session_id`, `good_id`) VALUES
(187, '5ggy5ehje5rujr7j7', '3'),
(188, 'be5r4bbw64bb6', '1'),
(199, 'jpks6duf48eolh7o4t53qclnke', '2');

-- --------------------------------------------------------

--
-- Структура таблицы `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `feedback` longtext NOT NULL,
  `id_image` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `feedback`
--

INSERT INTO `feedback` (`id`, `name`, `feedback`, `id_image`) VALUES
(71, 'Иван', 'Ghbjkkl', 12),
(72, 'Нина', 'Привет', 12),
(73, 'Аграфена', 'Привет', 0),
(75, 'Галина Михайлова', 'сообщение', 3),
(76, 'Аграфена', '66666', 15),
(77, 'Иван35', '1651651', 15),
(79, 'Нина', 'сообщение', 9),
(84, 'Нина', 'сообщение', 0),
(102, 'Иван', 'Привет2222', 0),
(105, 'Нина', 'Привет', 0),
(109, 'Иванушка', '66666', 3),
(110, 'Иван', 'Привет', 3),
(112, 'Иван', 'сообщение', 3),
(115, 'Галина Михайлова', 'Привет', 9);

-- --------------------------------------------------------

--
-- Структура таблицы `goods`
--

CREATE TABLE `goods` (
  `id` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `description` text NOT NULL,
  `photo` varchar(200) NOT NULL,
  `price` int(100) NOT NULL,
  `likes` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `goods`
--

INSERT INTO `goods` (`id`, `title`, `description`, `photo`, `price`, `likes`) VALUES
(1, 'Акварельные краски', 'Лучший подарок для юного художника.', '/img/goods/color.jpg', 155, '14'),
(2, 'Кисть', 'Кисть для рисования № 3. Средней жесткости.', '/img/goods/brush.jpg', 68, '10'),
(3, 'Пластилин', 'Очень мягкий восковой пластилин. Яркие краски.', '/img/goods/plasticine.jpg', 170, '10'),
(4, 'Гуашь', 'Яркие гуашевые краски - отличный подарок любому ребенку.', '/img/goods/gouache.jpg', 250, '4'),
(25, 'Чай', 'Цейлонский', '/img/goods/tea.jpg\r\n', 100, '5'),
(31, 'Апельсин', 'Вкусный оранжевый апельсин', '/img/goods/apelsini.jpg', 150, '8');

-- --------------------------------------------------------

--
-- Структура таблицы `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `filename` varchar(100) NOT NULL,
  `likes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `images`
--

INSERT INTO `images` (`id`, `filename`, `likes`) VALUES
(1, '01.jpg', 11),
(2, '02.jpg', 3),
(3, '03.jpg', 67),
(4, '04.jpg', 5),
(5, '05.jpg', 10),
(6, '06.jpg', 0),
(7, '07.jpg', 11),
(8, '08.jpg', 2),
(9, '09.jpg', 54),
(10, '10.jpg', 0),
(11, '11.jpg', 1),
(12, '12.jpg', 27),
(13, '13.jpg', 2),
(14, '14.jpg', 2),
(15, '15.jpg', 9);

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `text` text NOT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `likes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `news`
--

INSERT INTO `news` (`id`, `title`, `text`, `photo`, `likes`) VALUES
(4, 'В Петербурге ограничили выход пешеходов на Невский проспект', 'С.-ПЕТЕРБУРГ, 6 фев — РИА Новости. Дорожная техника препятствует выходу пешеходов на Невский проспект, передает корреспондент РИА Новости.\r\nПо наблюдению корреспондента, коммунальная техника перекрыла Садовую улицу на углу с Невским проспектом и на участке рядом с Александринским театром. Здесь же стоят металлические ограждения, рядом с которыми дежурят силовики.', '/photo/news_1.jpg', 0),
(5, 'В России разработали ракетный двигатель, не используя бумажных чертежей', 'МОСКВА, 6 фев — РИА Новости. Российские конструкторы впервые спроектировали ракетный двигатель полностью в цифровом виде, рассказал главный конструктор НПО \"Энергомаш\" Петр Левочкин.\r\n\"Мы сделали двигатель РД-171МВ для ракеты \"Союз-5\" полностью в цифровой документации. Более того, согласовали с заказчиком работ, что эта 3D-документация будет являться подлинником конструкторской документации\", — сказал он в видео, опубликованном \"Роскосмосом\" на YouTube.\r\nВ декабре 2020 года сообщалось, что НПО \"Энергомаш\" (предприятие \"Роскосмоса\") провело первое огневое испытание самого мощного в мире жидкостного двигателя РД-171МВ для первой ступени ракеты-носителя \"Союз-5\".\r\nДвигатель РД-171МВ является развитием двигателя, использовавшегося на ракете \"Зенит\", а до этого на боковых блоках ракеты \"Энергия\".', '/photo/news_3.jpg', 3),
(8, 'Нидерланды отказались привлекать Киев к ответу по делу о крушении MH17', 'МОСКВА, 6 фев — РИА Новости. Нидерланды не нашли достаточно убедительных юридических оснований для привлечения Украины к ответственности за неполное закрытие воздушного пространства в день крушения малайзийского Boeing (рейс MH17) в 2014 году, говорится в документе, опубликованном на сайте правительства.\r\nВласти опирались на отчет Фонда безопасности полетов (на сайте организации говорится, что она является международной, некоммерческой и независимой, штаб-квартира находится в США. — Прим. ред.), авторы которого изучили 34 случая крушения гражданских самолетов над зонами конфликтов в период 1985-2020 годов.', '/photo/news_2.jpg', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `phone` text NOT NULL,
  `session_id` text NOT NULL,
  `status` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `name`, `phone`, `session_id`, `status`) VALUES
(1, 'Иван', '89996546545', 'jpks6duf48eolh7o4t53qclnke', 0),
(9, 'Нина', '5555555', 'jpks6duf48eolh7o4t53qclnke', 0),
(10, 'Нина', '498351321322', 'jpks6duf48eolh7o4t53qclnke', 0),
(11, 'Аграфена', '5555555', 'jpks6duf48eolh7o4t53qclnke', 0),
(12, 'Иван35', '5555555', '4qd9h3mbtlt3dkvbsiv1m31omt', 0),
(13, 'Галина Михайлова', '5555555', 'uu97smsqocesk0qo1g4k9ope8b', 0),
(14, 'Нина', '5555555', 'dsfpqnkqr9n514vvq8dhmremt8', 0),
(15, 'Галина Михайлова', '5555555', 'h7n1v01d2ucvnnt6hndhiloavi', 0),
(16, 'Иван30', '5555555', '46jbej4qi62ddkiihr0qt7so8q', 0),
(17, 'Иван', '5555555', 'c0rrgcjem2o9u0pt5v4kj144gk', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `e-mail` varchar(100) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `date` text NOT NULL,
  `user_group` int(11) NOT NULL DEFAULT 0,
  `hash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `e-mail`, `pass`, `date`, `user_group`, `hash`) VALUES
(1, 'admin', '', '$2y$10$tkmo1kiLJ9wzOY8f7IdVLODGBXMK.0kwRDdd4EHe760hptqCEQPle', '	\r\n03.10.21', 1, '34952523560a0d6323593d4.33613223'),
(2, 'galina', '', '$2y$10$8JACowe59ryS4Y0B5EUcT.HVX8qvCg1fwfvWEinb4V2QIp4VjCV6G', '	\r\n03.11.21', 0, '1194214603604f206f636279.93198172'),
(105, 'Ivan5', 'movat02101986@gmail.com', '$2y$10$kPz3Pk6/KQIHuGgTouQNuOdluOTQvhlf3SlC0TgRE2Cn4YtMQXHEu', '	\r\n03.18.21', 0, '156326312860530a86931fa3.58358499'),
(106, 'Agrafena', 'dgfsdfg@dfhbfd', '$2y$10$KGXHeuK/Q7Z7hdRy09/ij.dRIyqPOW8i4sBxV49P41qcfrJtg4bBO', '	\r\n03.18.21', 0, ''),
(107, 'galina2', 'dfgdfg@ddfgdf', '$2y$10$RrfiH5GLS7dHIFL/Dt0rquDtOynAk9ZcATJR8Uk5sWgD9yn0JW9Ti', '03.18.21', 0, ''),
(108, 'Поля', '', '122', '', 0, ''),
(115, 'Поля', '', '122', '', 0, ''),
(116, 'Поля', '', '122', '', 0, ''),
(117, 'Поля', '', '122', '', 0, '');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `basket`
--
ALTER TABLE `basket`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `goods`
--
ALTER TABLE `goods`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `basket`
--
ALTER TABLE `basket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=225;

--
-- AUTO_INCREMENT для таблицы `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT для таблицы `goods`
--
ALTER TABLE `goods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT для таблицы `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT для таблицы `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
