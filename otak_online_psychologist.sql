-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Час створення: Чрв 13 2022 р., 05:11
-- Версія сервера: 8.0.24
-- Версія PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База даних: `otak_online_psychologist`
--

-- --------------------------------------------------------

--
-- Структура таблиці `administrators`
--

CREATE TABLE `administrators` (
  `email` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп даних таблиці `administrators`
--

INSERT INTO `administrators` (`email`) VALUES
('ericspz531@gmail.com');

-- --------------------------------------------------------

--
-- Структура таблиці `books`
--

CREATE TABLE `books` (
  `id` int NOT NULL,
  `book` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп даних таблиці `books`
--

INSERT INTO `books` (`id`, `book`) VALUES
(1, 'https://bookclub.ua/catalog/books/psychology/mistectvo-lyubovi'),
(2, 'https://bookclub.ua/catalog/books/psychology/igri-u-yaki-grayut-lyudi'),
(3, 'https://bookclub.ua/catalog/books/psychology/lyudina-v-poshukah-spravjnogo-sensu'),
(4, 'https://shron1.chtyvo.org.ua/Sacks_Oliver/Cholovik_iakyi_splutav_druzhynu_z_kapeliukhom_ta_inshi_istorii_z_likarskoi_praktyky.pdf?'),
(5, 'https://bookclub.ua/catalog/books/psychology/liki-vid-kohannya-ta-inshi-opovidi-psihoterapevta'),
(6, 'http://book-online.com.ua/read.php?book=2116'),
(7, 'https://chtyvo.org.ua/authors/Zimbardo_Philip/Efekt_Liutsyfera_Chomu_khoroshi_liudy_chyniat_zlo/'),
(8, 'https://shron1.chtyvo.org.ua/Holmz_Dzheimi/Nonsens_osiahnuty_i_peremohty.pdf?'),
(9, 'https://www.yakaboo.ua/ua/sila-introvertiv-tihi-ljudi-u-sviti-scho-ne-mozhe-movchati.html'),
(10, 'https://bookclub.ua/catalog/books/psychology/psihologiya-101-fakti-teoriya-statistika-testi-y-take-inshe-1'),
(11, 'https://vsiknygy.net.ua/neformat/48492/'),
(12, 'https://sch15.edu.vn.ua/56-%D1%86%D1%96%D0%BA%D0%B0%D0%B2%D0%B8%D1%85-%D1%84%D0%B0%D0%BA%D1%82%D1%96%D0%B2-%D0%BF%D1%80%D0%BE-%D0%BF%D1%81%D0%B8%D1%85%D0%BE%D0%BB%D0%BE%D0%B3%D1%96%D1%8E-%D0%BB%D1%8E%D0%B4%D0%B8%D0%BD%D0%B8/'),
(13, 'https://cikavo-znaty.com/549-ckav-fakti-z-psihologyi-html/');

-- --------------------------------------------------------

--
-- Структура таблиці `tests`
--

CREATE TABLE `tests` (
  `id` int NOT NULL,
  `img` varchar(225) NOT NULL,
  `title` varchar(225) NOT NULL,
  `url` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп даних таблиці `tests`
--

INSERT INTO `tests` (`id`, `img`, `title`, `url`) VALUES
(1, 'https://www.mh4u.in.ua/wp-content/themes/mh4u/assets/img/logo.png', 'Як ваше психічне здоров’я?', 'https://www.mh4u.in.ua/test/yak-vashe-psyhichne-zdorovya/'),
(2, 'https://tezzt.com/wp-content/uploads/2019/08/i1080x475-110x110.jpg', 'Яка у вас самооцінка? Тест', 'https://tezzt.com/samooczinka-test'),
(3, 'https://tezzt.com/wp-content/uploads/2019/07/Careers-in-Psy-Head-110x110.jpg', 'Чи хороший ви психолог?', 'https://tezzt.com/chy-horoshyj-vy-psyholog'),
(4, 'https://www.arealme.com/newimg/tn_@2x_ukrainian-vocabulary-size-test.png', 'Тест на психологічний вік', 'https://www.arealme.com/mental/uk/'),
(5, 'https://online-test.club/img/rorschach/test-rorshah-ink-stains-01.jpg', 'Чорнильні плями Роршаха', 'https://online-test.club/rorschach/15-ink-stains.html'),
(6, 'https://www.idrlabs.com/misc_pictures/global-style-silver-psi-card.png', 'Тест на визначення розладу особистості', 'https://www.idrlabs.com/ua/personality-style/test.php');

-- --------------------------------------------------------

--
-- Структура таблиці `videos`
--

CREATE TABLE `videos` (
  `id` int NOT NULL,
  `video_url` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп даних таблиці `videos`
--

INSERT INTO `videos` (`id`, `video_url`) VALUES
(1, 'https://www.youtube.com/embed/AHXDGhuMGgI'),
(2, 'https://www.youtube.com/embed/c0mk-KkTcTA'),
(3, 'https://www.youtube.com/embed/er3nGpGBLSs'),
(4, 'https://www.youtube.com/embed/pQFc0GlcL4g'),
(5, 'https://www.youtube.com/embed/D_c9VZtzVqs'),
(6, 'https://www.youtube.com/embed/PZAN6oLCOMo'),
(7, 'https://www.youtube.com/embed/hemiJpWtMyc'),
(8, 'https://www.youtube.com/embed/ruTuR6trMp0'),
(9, 'https://www.youtube.com/embed/X3H7vfOz7no'),
(10, 'https://www.youtube.com/embed/TlcJuw8tBqE'),
(11, 'https://www.youtube.com/embed/XVEqbX-H2is'),
(12, 'https://www.youtube.com/embed/uKyrwCEFI88'),
(13, 'https://www.youtube.com/embed/D-LPqbn0p8s');

--
-- Індекси збережених таблиць
--

--
-- Індекси таблиці `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для збережених таблиць
--

--
-- AUTO_INCREMENT для таблиці `books`
--
ALTER TABLE `books`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблиці `tests`
--
ALTER TABLE `tests`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблиці `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
