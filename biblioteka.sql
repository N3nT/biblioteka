-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Maj 30, 2023 at 05:33 PM
-- Wersja serwera: 10.4.28-MariaDB
-- Wersja PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `biblioteka`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ksiazki`
--

CREATE TABLE `ksiazki` (
  `book_id` bigint(20) UNSIGNED NOT NULL,
  `tytul` varchar(100) NOT NULL,
  `autor` varchar(100) NOT NULL,
  `rok_wydania` int(4) NOT NULL,
  `jezyk` varchar(50) NOT NULL,
  `wydawnictwo` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ksiazki`
--

INSERT INTO `ksiazki` (`book_id`, `tytul`, `autor`, `rok_wydania`, `jezyk`, `wydawnictwo`) VALUES
(1, 'Brzydkie kaczątko', 'Hans Christian Andersen', 1835, 'Polski', 'Fundacja nowoczesna Polska'),
(2, 'Balladyna', 'Juliusz Słowacki', 2020, 'Polski', 'PWN'),
(3, 'Harry Potter i Przeklęte Dziecko', 'J.K. Rowling', 2016, 'Angielski', 'Media Rodzina'),
(4, 'Harry Potter i więzień Azkabanu', 'J.K.Rowling', 2016, 'Polski', 'Media Rodzina'),
(5, 'Wiedźmin. Szpony i kły', 'Nadia Gasik', 2017, 'Polski', 'superNOWA'),
(6, 'Ludzie z mgły', 'Izabela Janiszewska', 2023, 'Polski', 'Czwarta Strona'),
(8, 'Pan Tadeusz', 'Adam Mickiewicz', 2022, 'Polski', 'Siedmiogród');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pracownicy`
--

CREATE TABLE `pracownicy` (
  `worker_id` bigint(20) UNSIGNED NOT NULL,
  `imie` varchar(50) NOT NULL,
  `nazwisko` varchar(50) NOT NULL,
  `stanowisko` varchar(50) NOT NULL,
  `pensja` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pracownicy`
--

INSERT INTO `pracownicy` (`worker_id`, `imie`, `nazwisko`, `stanowisko`, `pensja`) VALUES
(1, 'Aleksy', 'Majewski', 'Magazynier', 1200.00),
(2, 'Zachariasz', 'Nowak', 'Magazynier', 1251.00),
(3, 'Patrycja', 'Zawadzka', 'Kierownik', 5000.00),
(4, 'Cecylia', 'Adamczyk', 'Bibliotekarz', 3000.00),
(5, 'Franciszek', 'Wieczorek', 'Menedżer', 4500.00);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy`
--

CREATE TABLE `uzytkownicy` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `imie` varchar(50) NOT NULL,
  `nazwisko` varchar(50) NOT NULL,
  `email` varchar(90) NOT NULL,
  `numer_telefonu` varchar(9) NOT NULL,
  `haslo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`user_id`, `imie`, `nazwisko`, `email`, `numer_telefonu`, `haslo`) VALUES
(1, 'root', 'root', 'root@root.pl', '123456789', '$2y$10$ol/uAX/GCkewo3n5SP4ice3abryyxJY7ZH8AJlUsl5KufIYCSsqne'),
(2, 'Jan', 'Kowalski', 'jankowalski@czytelnik.pl', '934523469', '$2y$10$fu1uRjMK3DprmRVWTP4O1uZDV4xdQ.A0rwpsB4b4oeJDB00KaNeme'),
(3, 'Piotr', 'Nowak', 'piotrnowak@biblioteka.pl', '678946787', '$2y$10$ikSXsqa/yc6i0E8BG6qHFOinHNxn01ML3tEYTQsVfGsk9sHOTfS.q'),
(4, 'Andrzej', 'Witkowski', 'andrzejwitkowski@gmail.pl', '731923823', '$2y$10$LuVcA3u65S3vzFFfNFmG4.yGP.Z7Su.4bpoQbZujppEmY0WK0lwOK'),
(6, 'Henryk', 'Niemiec', 'henrykniemiec@czytelnik.pl', '546747523', '$2y$10$4r4qyohKxaeRrdnLKz0BrehCsyfN.L2nK3yuXzQnt.hybNs/ATPMO');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wypozyczenia`
--

CREATE TABLE `wypozyczenia` (
  `reservation_id` bigint(20) UNSIGNED NOT NULL,
  `ksiazka_id` bigint(20) NOT NULL,
  `czytelnik_id` bigint(20) NOT NULL,
  `data_wypozyczenia` date DEFAULT NULL,
  `data_zwrotu` date DEFAULT NULL,
  `rental_status` bit(1) DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wypozyczenia`
--

INSERT INTO `wypozyczenia` (`reservation_id`, `ksiazka_id`, `czytelnik_id`, `data_wypozyczenia`, `data_zwrotu`, `rental_status`) VALUES
(2, 6, 2, '2023-05-28', '2023-05-29', b'0'),
(3, 7, 3, '2023-05-28', '2023-06-04', b'1'),
(4, 5, 5, '2023-05-28', '2023-06-04', b'1'),
(5, 2, 4, '2023-05-28', '2023-06-04', b'1'),
(6, 1, 4, '2023-05-28', '2023-06-04', b'1'),
(7, 2, 2, '2023-05-29', '2023-05-29', b'0'),
(8, 1, 2, '2023-05-29', '2023-05-29', b'1'),
(9, 8, 2, '2023-05-29', '2023-05-29', b'1'),
(10, 8, 2, '2023-05-30', '2023-05-30', b'0'),
(11, 8, 2, '2023-05-30', '2023-05-30', b'1');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `ksiazki`
--
ALTER TABLE `ksiazki`
  ADD PRIMARY KEY (`book_id`);

--
-- Indeksy dla tabeli `pracownicy`
--
ALTER TABLE `pracownicy`
  ADD PRIMARY KEY (`worker_id`);

--
-- Indeksy dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `unique_email` (`email`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indeksy dla tabeli `wypozyczenia`
--
ALTER TABLE `wypozyczenia`
  ADD PRIMARY KEY (`reservation_id`),
  ADD KEY `ksiazka_id` (`ksiazka_id`),
  ADD KEY `czytelnik_id` (`czytelnik_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ksiazki`
--
ALTER TABLE `ksiazki`
  MODIFY `book_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pracownicy`
--
ALTER TABLE `pracownicy`
  MODIFY `worker_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `user_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `wypozyczenia`
--
ALTER TABLE `wypozyczenia`
  MODIFY `reservation_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
