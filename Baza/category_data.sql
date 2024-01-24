-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sty 24, 2024 at 10:53 AM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `moja_strona`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `category_data`
--

CREATE TABLE `category_data` (
  `id` int(11) NOT NULL,
  `matka` int(11) NOT NULL DEFAULT 0,
  `nazwa` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category_data`
--

INSERT INTO `category_data` (`id`, `matka`, `nazwa`) VALUES
(39, 0, 'Elektronikaa'),
(40, 39, 'laptopy'),
(41, 39, 'Komputery'),
(42, 39, 'Konsole'),
(44, 0, 'Motoryzacja'),
(45, 0, 'Sport i turystyka'),
(46, 44, 'Cześci samochodowe'),
(47, 44, 'Gadzety motoryzacyjne'),
(48, 44, 'Opony i felgi'),
(49, 45, 'Rowery i akcesoria'),
(50, 45, 'Narty'),
(53, 0, 'Dzieckooo'),
(58, 44, 'Chemia samochodowa'),
(60, 39, 'Telefony'),
(61, 53, 'Puzzle'),
(65, 53, 'KLocki Lego');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `category_data`
--
ALTER TABLE `category_data`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category_data`
--
ALTER TABLE `category_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
