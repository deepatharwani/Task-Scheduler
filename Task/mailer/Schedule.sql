-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 14, 2020 at 02:25 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Schedule`
--

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `username` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `phone` bigint(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`username`, `email`, `password`, `phone`) VALUES
('rdoshi29', 'riddhi.rd@somaiya.edu', 'b5b00d3e7a2756c936a0118124032818', 7506071803);

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `taskid` int(11) NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `tname` varchar(200) DEFAULT NULL,
  `detail` text DEFAULT NULL,
  `label` tinyint(1) DEFAULT NULL,
  `C_date` date NOT NULL,
  `deadline` date DEFAULT NULL,
  `done` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`taskid`, `username`, `tname`, `detail`, `label`, `C_date`, `deadline`, `done`) VALUES
(50, 'rdoshi29', 'Task  1', 'Howdy', 4, '2020-03-07', '2020-03-17', 0),
(51, 'rdoshi29', 'Task 234', '', 2, '2020-03-07', '2020-03-25', 0),
(52, 'rdoshi29', 'TAsk 11', 'Naa', 1, '2020-03-07', '2020-03-19', 0),
(53, 'rdoshi29', 'Taskkk 2', 'IDK', 2, '2020-03-07', '2020-03-31', 1),
(54, 'rdoshi29', 'Tasksks 3', 'SNCJ', 3, '2020-03-07', '2020-03-30', 0),
(55, 'rdoshi29', 'kjsffds', 'kjsd', 1, '2020-03-07', '2020-03-18', 0),
(56, 'rdoshi29', 'Hola', '11/3/2020', 2, '2020-03-11', '2020-03-25', 0),
(57, 'rdoshi29', 'TAsk 2ds', 'ecwcrww', 2, '2020-03-13', '2020-03-13', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`taskid`),
  ADD KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `taskid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `task_ibfk_1` FOREIGN KEY (`username`) REFERENCES `registration` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
