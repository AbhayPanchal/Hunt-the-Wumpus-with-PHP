-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2020 at 02:03 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";




--
-- Database: `wumpus`
--

-- --------------------------------------------------------

--
-- Table structure for table `players`
--

CREATE TABLE `players` (
  `email_add` varchar(100) NOT NULL,
  `wins` int(15) NOT NULL DEFAULT '0',
  `losses` int(15) NOT NULL DEFAULT '0',
  `played_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `players`
--

INSERT INTO `players` (`email_add`, `wins`, `losses`, `played_date`) VALUES
('abhaypanchal32@gmail.com', 0, 1, '0000-00-00'),
('admin@mail.com', 0, 2, '0000-00-00'),
('Brijesh.panchal0369@gmail.com', 1, 0, '0000-00-00'),
('d1692704@urhen.com', 3, 3, '0000-00-00'),
('dvlmkw18@gmail.com', 10, 17, '0000-00-00'),
('shaili0211@gmail.com', 3, 4, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `wumpuses`
--

CREATE TABLE `wumpuses` (
  `ID` int(11) NOT NULL,
  `wrow` int(11) NOT NULL,
  `wcol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wumpuses`
--

INSERT INTO `wumpuses` (`ID`, `wrow`, `wcol`) VALUES
(1, 1, 1),
(2, 3, 2),
(3, 3, 1),
(4, 1, 4),
(5, 2, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`email_add`);

--
-- Indexes for table `wumpuses`
--
ALTER TABLE `wumpuses`
  ADD PRIMARY KEY (`ID`);
COMMIT;

