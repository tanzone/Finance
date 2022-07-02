-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Feb 28, 2019 alle 22:10
-- Versione del server: 10.1.37-MariaDB
-- Versione PHP: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `finance`
--
CREATE DATABASE finance;
USE finance;

-- --------------------------------------------------------

--
-- Struttura della tabella `azione`
--

CREATE TABLE `azione` (
  `Simbolo` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `azione`
--

INSERT INTO `azione` (`Simbolo`) VALUES
('AAPL');

-- --------------------------------------------------------

--
-- Struttura della tabella `azione_down`
--

CREATE TABLE `azione_down` (
  `Username` varchar(50) NOT NULL,
  `Simbolo` varchar(10) NOT NULL,
  `DataApertura` date NOT NULL,
  `ValoreApertura` int(11) NOT NULL,
  `QuantitaApertura` int(11) NOT NULL,
  `DataChiusra` date NOT NULL,
  `ValoreChiusura` int(11) NOT NULL,
  `QuantitaChiusura` int(11) NOT NULL,
  `Ricavo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `azione_down`
--

INSERT INTO `azione_down` (`Username`, `Simbolo`, `DataApertura`, `ValoreApertura`, `QuantitaApertura`, `DataChiusra`, `ValoreChiusura`, `QuantitaChiusura`, `Ricavo`) VALUES
('Qwe', 'AAPL', '2019-02-12', 123, 23, '2019-02-13', 123, 123, 1),
('Qwe', 'AAPL', '2019-02-12', 123, 123, '2019-02-12', 123, 123, 2),
('Manuel', 'AAPL', '2019-02-12', 123, 123, '2019-02-12', 123, 123, 32),
('Qwe', 'AAPL', '2019-02-06', 123, 123, '2019-02-21', 123, 123, -12);

-- --------------------------------------------------------

--
-- Struttura della tabella `azione_up`
--

CREATE TABLE `azione_up` (
  `Username` varchar(50) NOT NULL,
  `Simbolo` varchar(10) NOT NULL,
  `Data` date NOT NULL,
  `Valore` int(11) NOT NULL,
  `Quantita` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `azione_up`
--

INSERT INTO `azione_up` (`Username`, `Simbolo`, `Data`, `Valore`, `Quantita`) VALUES
('Qwe', 'AAPL', '2019-02-20', 2342, 34234),
('Qwe', 'AAPL', '2019-02-28', 174, 2);

-- --------------------------------------------------------

--
-- Struttura della tabella `infoutente`
--

CREATE TABLE `infoutente` (
  `ID` int(11) NOT NULL,
  `Nome` varchar(50) NOT NULL,
  `Cognome` varchar(50) NOT NULL,
  `Sesso` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `infoutente`
--

INSERT INTO `infoutente` (`ID`, `Nome`, `Cognome`, `Sesso`) VALUES
(1, 'Manuel', 'Tanzi', 'M'),
(2, 'Luca', 'Ferrara', 'M'),
(3, 'Francesco', 'Cavalieri', 'M'),
(4, 'Manuel', 'Tanzi', 'Maschio'),
(5, 'Manuel', 'Tanzi', 'Maschio'),
(6, 'Aflre', 'Taniz', 'Maschio'),
(7, 'Manuel', 'Tanzi', 'Maschio');

-- --------------------------------------------------------

--
-- Struttura della tabella `transizioni`
--

CREATE TABLE `transizioni` (
  `ID_Versamento` int(11) NOT NULL,
  `Username_Utente` varchar(50) NOT NULL,
  `Data` date NOT NULL,
  `Valore` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `transizioni`
--

INSERT INTO `transizioni` (`ID_Versamento`, `Username_Utente`, `Data`, `Valore`) VALUES
(3, 'Qwe', '2019-02-22', 123),
(1, 'Qwe', '2019-02-19', -4353453);

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE `utente` (
  `Username` varchar(50) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Salt` int(11) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Saldo` int(11) NOT NULL,
  `ID_InfoUtente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`Username`, `Password`, `Salt`, `Email`, `Saldo`, `ID_InfoUtente`) VALUES
('Ferrara', 'FerraFerra', 1, 'luca.ferrara.1399@gmail.com', 999999, 2),
('KavaIlMagnifico', 'CavaCava', 1, 'cavalieriwebsites@gmail.com', 999999, 3),
('Manuel', '0be2b75fc156446d2ec712078245fc4c', 1577591, 'Tanzone2000@gmail.com', 0, 4),
('Manuel1', 'dcf3f17b6ba94231c383f0c0739238e9', 9700321, 'Tanzone2000@gmail.com', 0, 5),
('Qwe', 'a82a35d75361d556f7d9807342a75723', 9835202, 'Asd@ad.com', 99999651, 6),
('Qwer', '013da5944c2ffe66abc7130df3e5dcd1', 8575633, 'Tanzone2000@gmail.com', 0, 7),
('root', '1qqwe', 1, 'Tanzone2000@gmail.com', 444444, 6);

-- --------------------------------------------------------

--
-- Struttura della tabella `versamento`
--

CREATE TABLE `versamento` (
  `ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `versamento`
--

INSERT INTO `versamento` (`ID`) VALUES
(1),
(3);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `azione`
--
ALTER TABLE `azione`
  ADD PRIMARY KEY (`Simbolo`);

--
-- Indici per le tabelle `azione_down`
--
ALTER TABLE `azione_down`
  ADD KEY `FK_UsernameAzioneDown` (`Username`),
  ADD KEY `FK_SimboloAzioneDown` (`Simbolo`);

--
-- Indici per le tabelle `azione_up`
--
ALTER TABLE `azione_up`
  ADD KEY `FK_UsernameAzioneUp` (`Username`),
  ADD KEY `FK_SimboloAzioneUp` (`Simbolo`);

--
-- Indici per le tabelle `infoutente`
--
ALTER TABLE `infoutente`
  ADD PRIMARY KEY (`ID`);

--
-- Indici per le tabelle `transizioni`
--
ALTER TABLE `transizioni`
  ADD KEY `FK_IDVersamento` (`ID_Versamento`),
  ADD KEY `FK_UsernameUtente` (`Username_Utente`);

--
-- Indici per le tabelle `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`Username`),
  ADD KEY `FK_IDInfoUtente` (`ID_InfoUtente`);

--
-- Indici per le tabelle `versamento`
--
ALTER TABLE `versamento`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `infoutente`
--
ALTER TABLE `infoutente`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT per la tabella `versamento`
--
ALTER TABLE `versamento`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `azione_down`
--
ALTER TABLE `azione_down`
  ADD CONSTRAINT `FK_SimboloAzioneDown` FOREIGN KEY (`Simbolo`) REFERENCES `azione` (`Simbolo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_UsernameAzioneDown` FOREIGN KEY (`Username`) REFERENCES `utente` (`Username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `azione_up`
--
ALTER TABLE `azione_up`
  ADD CONSTRAINT `FK_SimboloAzioneUp` FOREIGN KEY (`Simbolo`) REFERENCES `azione` (`Simbolo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_UsernameAzioneUp` FOREIGN KEY (`Username`) REFERENCES `utente` (`Username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `transizioni`
--
ALTER TABLE `transizioni`
  ADD CONSTRAINT `FK_IDVersamento` FOREIGN KEY (`ID_Versamento`) REFERENCES `versamento` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_UsernameUtente` FOREIGN KEY (`Username_Utente`) REFERENCES `utente` (`Username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `utente`
--
ALTER TABLE `utente`
  ADD CONSTRAINT `FK_IDInfoUtente` FOREIGN KEY (`ID_InfoUtente`) REFERENCES `infoutente` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
