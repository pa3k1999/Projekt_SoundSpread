-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 25, 2021 at 08:55 PM
-- Server version: 5.7.17
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `soundspread`
--
CREATE DATABASE IF NOT EXISTS `epiz_27784619_soundspread` DEFAULT CHARACTER SET utf8 COLLATE utf8_croatian_ci;
USE `epiz_27784619_soundspread`;

-- --------------------------------------------------------

--
-- Table structure for table `albums_lists`
--

CREATE TABLE `albums_lists` (
  `id_albums_lists` int(11) NOT NULL,
  `album_list_title` varchar(45) COLLATE utf8_croatian_ci NOT NULL,
  `img_path` varchar(128) COLLATE utf8_croatian_ci NOT NULL,
  `users_username` varchar(25) COLLATE utf8_croatian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

--
-- Dumping data for table `albums_lists`
--

INSERT INTO `albums_lists` (`id_albums_lists`, `album_list_title`, `img_path`, `users_username`) VALUES
(4, 'Top pjesme', 'uploads/listaSlike/6000b7d0a42b14.08184593.jpg', 'pa3k'),
(5, '90s Rock', 'uploads/listaSlike/6000de6a7b2cc7.22430734.jpg', 'pa3k'),
(6, 'Spuderman!', 'uploads/listaSlike/6000e1a06cf8e2.30301835.jpg', 'pa3k');

-- --------------------------------------------------------

--
-- Table structure for table `music`
--

CREATE TABLE `music` (
  `id_music` int(11) NOT NULL,
  `title` varchar(45) COLLATE utf8_croatian_ci NOT NULL,
  `bpm` int(11) NOT NULL,
  `genre` varchar(45) COLLATE utf8_croatian_ci NOT NULL,
  `duration` varchar(8) COLLATE utf8_croatian_ci NOT NULL,
  `img_path` varchar(128) COLLATE utf8_croatian_ci NOT NULL,
  `music_path` varchar(128) COLLATE utf8_croatian_ci NOT NULL,
  `users_username` varchar(25) COLLATE utf8_croatian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

--
-- Dumping data for table `music`
--

INSERT INTO `music` (`id_music`, `title`, `bpm`, `genre`, `duration`, `img_path`, `music_path`, `users_username`) VALUES
(9, 'Snake pit poetry', 123, 'medevil', '10:11', 'uploads/glazbaSlike/5ff742e1178160.13390891.jpg', 'uploads/glazba/5ff742e0ee4033.32290085.mp3', 'pa3k'),
(13, 'UH', 120, 'rap', '3:45', 'uploads/glazbaSlike/5fff0a96746ee1.88254858.jpg', 'uploads/glazba/5fff0a96745119.53525667.mp3', 'user'),
(14, 'Magican cvet', 123, 'rap', '3:09', 'uploads/glazbaSlike/5fff0abe5ef668.00162606.jpg', 'uploads/glazba/5fff0abe5ed621.92480796.mp3', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `music_in_albums`
--

CREATE TABLE `music_in_albums` (
  `music_id_music` int(11) NOT NULL,
  `albums_lists_id_albums_lists` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

--
-- Dumping data for table `music_in_albums`
--

INSERT INTO `music_in_albums` (`music_id_music`, `albums_lists_id_albums_lists`) VALUES
(13, 4),
(14, 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(25) COLLATE utf8_croatian_ci NOT NULL,
  `uname` varchar(45) COLLATE utf8_croatian_ci NOT NULL,
  `last_name` varchar(45) COLLATE utf8_croatian_ci NOT NULL,
  `bio` varchar(256) COLLATE utf8_croatian_ci NOT NULL,
  `upassword` varchar(45) COLLATE utf8_croatian_ci NOT NULL,
  `img_path` varchar(128) COLLATE utf8_croatian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `uname`, `last_name`, `bio`, `upassword`, `img_path`) VALUES
('admin', 'user', 'r', '123', '123', 'uploads/profilSlike/6003582e97afa3.12134951.jpg'),
('pa3k', 'patrik', 'baldas', '123', '123', 'uploads/profilSlike/5ff72b6f275721.00017629.jpg'),
('user', 'user', '123', 'ja sam user', 'user', 'uploads/profilSlike/5fff09b6f36b36.71461984.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `albums_lists`
--
ALTER TABLE `albums_lists`
  ADD PRIMARY KEY (`id_albums_lists`),
  ADD KEY `fk_users_username` (`users_username`);

--
-- Indexes for table `music`
--
ALTER TABLE `music`
  ADD PRIMARY KEY (`id_music`,`users_username`),
  ADD KEY `fk_music_vsers1_idx` (`users_username`);

--
-- Indexes for table `music_in_albums`
--
ALTER TABLE `music_in_albums`
  ADD PRIMARY KEY (`music_id_music`,`albums_lists_id_albums_lists`),
  ADD KEY `fk_music_has_albums_lists_albums_lists1_idx` (`albums_lists_id_albums_lists`),
  ADD KEY `fk_music_has_albums_lists_music1_idx` (`music_id_music`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `albums_lists`
--
ALTER TABLE `albums_lists`
  MODIFY `id_albums_lists` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `music`
--
ALTER TABLE `music`
  MODIFY `id_music` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `albums_lists`
--
ALTER TABLE `albums_lists`
  ADD CONSTRAINT `fk_users_username` FOREIGN KEY (`users_username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `music`
--
ALTER TABLE `music`
  ADD CONSTRAINT `fk_music_vsers1` FOREIGN KEY (`users_username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `music_in_albums`
--
ALTER TABLE `music_in_albums`
  ADD CONSTRAINT `fk_music_has_albums_lists_albums_lists1` FOREIGN KEY (`albums_lists_id_albums_lists`) REFERENCES `albums_lists` (`id_albums_lists`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_music_has_albums_lists_music1` FOREIGN KEY (`music_id_music`) REFERENCES `music` (`id_music`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
