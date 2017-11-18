-- phpMyAdmin SQL Dump
-- version 3.4.3.2
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Ноя 18 2017 г., 06:15
-- Версия сервера: 5.1.67
-- Версия PHP: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `db_xogoc_7`
--

-- --------------------------------------------------------

--
-- Структура таблицы `feedback`
--

CREATE TABLE IF NOT EXISTS `feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `feedback` text NOT NULL,
  `nickname` varchar(64) NOT NULL DEFAULT 'Аноним',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Дамп данных таблицы `feedback`
--

INSERT INTO `feedback` (`id`, `feedback`, `nickname`) VALUES
(1, 'тестовый анонимный отзыв edir', 'Аноним not'),
(2, 'Ура, отзывы работают!', 'Константин'),
(3, 'тест', 'К.И. Ходосевич'),
(8, 'тест', 'очень длинное имя очень длинное им'),
(9, 'тест', 'ао, аме, уведеенос'),
(10, 'тест из админки', 'admin'),
(15, 'last test', 'Аноним'),
(16, 'new test', 'test'),
(18, 'Hello', 'tested');

-- --------------------------------------------------------

--
-- Структура таблицы `gallery_images`
--

CREATE TABLE IF NOT EXISTS `gallery_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `size` int(11) NOT NULL,
  `views` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Дамп данных таблицы `gallery_images`
--

INSERT INTO `gallery_images` (`id`, `name`, `path`, `size`, `views`) VALUES
(1, 'Hydrangeas.jpg', 'img/gallery/', 595284, 0),
(2, 'Chrysanthemum.jpg', 'img/gallery/', 879394, 0),
(3, 'Desert.jpg', 'img/gallery/', 845941, 1),
(4, 'Penguins.jpg', 'img/gallery/', 777835, 3),
(5, 'Lighthouse.jpg', 'img/gallery/', 561276, 3),
(6, 'Koala.jpg', 'img/gallery/', 780831, 8),
(7, 'Jellyfish.jpg', 'img/gallery/', 775702, 1),
(8, 'Tulips.jpg', 'img/gallery/', 620888, 1),
(9, 'agl.jpg', 'img/gallery/', 331976, 15);

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `price` decimal(6,2) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `description`, `image`) VALUES
(1, 'Зарядное устройство USB', 74.99, 'Зарядное устройство для всех твоих гаджетов!\r\nИмеет 6 портов USB с автоматическим определением типа устройства.\r\nМаксимальный выходной ток 7 Ампер.', 'zaryadka.jpeg'),
(2, 'Кресло', 199.00, 'Крутое кресло', 'IMG_20160829_200213.jpg'),
(3, 'Пиво и KFC', 23.45, 'Диетическое блюдо на каждый день.', 'f50d7b1d458c87484837882ef27e7fe5c7a281b72326da34d5578539aab5c737_full.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_login` (`login`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`) VALUES
(1, 'test', '827ccb0eea8a706c4c34a16891f84e7b');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
