-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Creato il: Gen 28, 2021 alle 17:23
-- Versione del server: 10.4.14-MariaDB
-- Versione PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quiz_case`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `answers_given`
--

CREATE TABLE `answers_given` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `question_list_id` int(11) NOT NULL,
  `test_id` int(11) NOT NULL,
  `value` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `answers_given`
--

INSERT INTO `answers_given` (`id`, `user_id`, `question_list_id`, `test_id`, `value`) VALUES
(1, 5, 1, 1, 2),
(2, 5, 3, 1, 4),
(3, 5, 4, 1, 1),
(4, 5, 2, 1, 1),
(5, 5, 5, 1, NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `answers_lists`
--

CREATE TABLE `answers_lists` (
  `id` int(11) NOT NULL,
  `questions_id` int(11) NOT NULL,
  `text` text NOT NULL,
  `value` int(11) NOT NULL,
  `correct` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `answers_lists`
--

INSERT INTO `answers_lists` (`id`, `questions_id`, `text`, `value`, `correct`) VALUES
(1, 1, 'a) 30 minuti', 1, 0),
(2, 1, 'b) 4-5 minuti', 2, 1),
(3, 1, 'c) 10 minuti', 3, 0),
(4, 1, 'd) 15-20 minuti', 4, 0),
(5, 2, 'a)mantenere la perfusione e l\'ossigenazione di cuore e cervello', 1, 1),
(6, 2, 'b) mantenere una buona ossigenazione polmonare', 2, 0),
(7, 2, 'c)cardiovertire   un   aritmia   letaled', 3, 0),
(8, 2, 'd)far arrivare il sangue ossigenato alle parti piu\'distali del corpo', 4, 0),
(9, 3, 'a) iperestendere la testa', 1, 0),
(10, 3, 'b) mettere in posizione laterale di sicurezza', 2, 0),
(11, 3, 'c)applicare il collare cervicale dopo aver valutato B e C', 3, 0),
(12, 3, 'd)tutte le precedenti', 4, 1),
(13, 4, 'a) Guardo se il paziente esegue piccoli movimenti spontanei,     Ascolto eventuali rumori respiratori,     Sento se è presente il polso carotideo', 1, 0),
(14, 4, 'b) Guardo se il torace si espande,     Ascolto eventuali rumori respiratori     Sento se fuoriesce aria dalle vie aeree', 2, 1),
(15, 4, 'c)Guardo il colorito cutaneo del paziente    Ascolto se emette qualche lamento    Sento se fuoriesce aria dalle vie aeree', 3, 0),
(16, 5, 'a)almeno 50 compressioni al minuto', 1, 0),
(17, 5, 'b)almeno 80 compressioni al minuto', 2, 0),
(18, 5, 'c)almeno 100 compressioni al minuto', 3, 1),
(19, 5, 'd)almeno 140 compressioni al minuto', 4, 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `questions_list`
--

CREATE TABLE `questions_list` (
  `id` int(11) NOT NULL,
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `questions_list`
--

INSERT INTO `questions_list` (`id`, `text`) VALUES
(1, 'Dopo quanto tempo inizia il danno neurologico in un paziente in arresto cardio-respiratorio privo di assistenza rianimatoria?'),
(2, 'Qual\'è l\'obiettivo principale del BLS?'),
(3, 'Cosa non è opportuno fare in un paziente traumatizzato?'),
(4, 'Qual\'è il significato dell\'acronimo GAS nella fase B della valutazione del paziente?'),
(5, 'Qual\'è la corretta frequenza delle compressioni toraciche esterne nella RCP pediatrica?');

-- --------------------------------------------------------

--
-- Struttura della tabella `tests`
--

CREATE TABLE `tests` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `tests`
--

INSERT INTO `tests` (`id`) VALUES
(1);

-- --------------------------------------------------------

--
-- Struttura della tabella `tests_question_list`
--

CREATE TABLE `tests_question_list` (
  `test_id` int(11) NOT NULL,
  `questions_list_id` int(11) NOT NULL,
  `question_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `tests_question_list`
--

INSERT INTO `tests_question_list` (`test_id`, `questions_list_id`, `question_number`) VALUES
(5, 1, 1),
(5, 2, 4),
(5, 3, 2),
(5, 4, 3),
(5, 5, 5);

-- --------------------------------------------------------

--
-- Struttura della tabella `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nick` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `users`
--

INSERT INTO `users` (`id`, `nick`) VALUES
(5, 'Alex');

-- --------------------------------------------------------

--
-- Struttura della tabella `user_tests`
--

CREATE TABLE `user_tests` (
  `user_id` int(11) NOT NULL,
  `test_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `user_tests`
--

INSERT INTO `user_tests` (`user_id`, `test_id`) VALUES
(5, 1);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `answers_given`
--
ALTER TABLE `answers_given`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `answers_lists`
--
ALTER TABLE `answers_lists`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `questions_list`
--
ALTER TABLE `questions_list`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `tests_question_list`
--
ALTER TABLE `tests_question_list`
  ADD PRIMARY KEY (`test_id`,`questions_list_id`);

--
-- Indici per le tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `user_tests`
--
ALTER TABLE `user_tests`
  ADD PRIMARY KEY (`user_id`,`test_id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `answers_given`
--
ALTER TABLE `answers_given`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT per la tabella `answers_lists`
--
ALTER TABLE `answers_lists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT per la tabella `questions_list`
--
ALTER TABLE `questions_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT per la tabella `tests`
--
ALTER TABLE `tests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
