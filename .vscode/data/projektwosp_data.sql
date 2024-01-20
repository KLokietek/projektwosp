-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 14 Cze 2023, 11:12
-- Wersja serwera: 10.4.11-MariaDB
-- Wersja PHP: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `projektwosp`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `auctions`
--

CREATE TABLE `auctions` (
  `id_auction` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `start_price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `auctions`
--

INSERT INTO `auctions` (`id_auction`, `id_user`, `title`, `description`, `start_price`) VALUES
(15, 1, 'Obraz z 1930 roku!', 'Piękny obraz wykonany przez mojego pradziadka', 400),
(16, 1, 'Rakieta Igi Świątek', 'Rakieta Igi, którą grała podczas turnieju Rolanda Garrosa 2023!', 850),
(17, 1, 'Koszulka meczowa Roberta Lewandowskiego', 'Koszulka meczowa Roberta Lewandowskiego z meczu Polska-Czechy', 1000),
(18, 1, 'Łyżwy', 'Stare łyżwy hokejowe', 50),
(19, 1, 'Skrzypce', 'Skrzypce drewniane', 450);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `role`
--

CREATE TABLE `role` (
  `id` tinyint(4) NOT NULL,
  `role` enum('user','moderator','administrator') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `role`
--

INSERT INTO `role` (`id`, `role`) VALUES
(1, 'user'),
(2, 'moderator'),
(3, 'administrator');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `email` varchar(60) NOT NULL,
  `id_role` tinyint(4) NOT NULL DEFAULT 1,
  `pass` varchar(60) NOT NULL,
  `passwordrepeat` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id_user`, `firstName`, `lastName`, `email`, `id_role`, `pass`, `passwordrepeat`) VALUES
(7, 'piotr', 'jak', 'jak@wp.pl', 1, '$2y$10$MRCyAdsh.3ut/Ai66326Demi7Wf8/tzrOJMqQkCHGcbdMoRMhoV2S', '$2y$10$MRCyAdsh.3ut/Ai66326Demi7Wf8/tzrOJMqQkCHGcbdMoRMhoV2S'),
(8, 'Kacper', 'Lokiec', 'lokieta@wp.pl', 1, '$2y$10$wuzKf8xSkvbcp7abF0uMmeEE.XAz0ex9sSI..nyrd4w.liPaytIza', '$2y$10$wuzKf8xSkvbcp7abF0uMmeEE.XAz0ex9sSI..nyrd4w.liPaytIza'),
(9, 'Jakub', 'Kakub', 'kakub@wp.pl', 1, '$2y$10$th03v48GNlfV4hWrMzNf6.zxO7VQtEs5GZ/2HRizUaTJ8oZOrCV8O', '$2y$10$th03v48GNlfV4hWrMzNf6.zxO7VQtEs5GZ/2HRizUaTJ8oZOrCV8O'),
(11, 'Franc', 'Stans', 'franc@wp.pl', 3, '$2y$10$Gw/0SO9ODPPYiaL99nMp9.EihQy02aSeepVolXAIEKI7rfC0PE6ba', '$2y$10$Gw/0SO9ODPPYiaL99nMp9.EihQy02aSeepVolXAIEKI7rfC0PE6ba'),
(12, 'Jakub', 'Kumer', 'Jckbob@wp.pl', 1, '$2y$10$I9OgdVhLdHHw7FcxiOl.8Op4lNq8wz1MHyee9CBFbZ9z/ll93i/hW', '$2y$10$I9OgdVhLdHHw7FcxiOl.8Op4lNq8wz1MHyee9CBFbZ9z/ll93i/hW'),
(14, 'Kacper', 'Lokietek', 'kacperlokietek@wsb.pl', 1, '$2y$10$9LnmA/6skk1Rbum6i76Ht.mXLb/qsCOmq1R/gpuDRCHtHNPaR.REG', '$2y$10$9LnmA/6skk1Rbum6i76Ht.mXLb/qsCOmq1R/gpuDRCHtHNPaR.REG'),
(16, 'Nikolas', 'Mazur', 'mazur32@gmail.com', 1, '$2y$10$E3PKIGqsENEDBAw2mwfaiOLWUqS4OOxYwfKQ8fwzM5J0SGstyOo4K', '$2y$10$E3PKIGqsENEDBAw2mwfaiOLWUqS4OOxYwfKQ8fwzM5J0SGstyOo4K');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `auctions`
--
ALTER TABLE `auctions`
  ADD PRIMARY KEY (`id_auction`);

--
-- Indeksy dla tabeli `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_role` (`id_role`),
  ADD KEY `id_role_2` (`id_role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `auctions`
--
ALTER TABLE `auctions`
  MODIFY `id_auction` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT dla tabeli `role`
--
ALTER TABLE `role`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `role` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
