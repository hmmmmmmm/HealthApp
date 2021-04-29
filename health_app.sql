-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2021 at 12:38 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `health_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `exercise_data`
--

CREATE TABLE `exercise_data` (
  `user_id` int(11) NOT NULL,
  `timestamp` datetime NOT NULL,
  `ename` text NOT NULL,
  `etime` text NOT NULL,
  `enotes` text NOT NULL,
  `exercise_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `exercise_data`
--

INSERT INTO `exercise_data` (`user_id`, `timestamp`, `ename`, `etime`, `enotes`, `exercise_id`) VALUES
(2, '2021-04-29 22:17:37', 'Running', '1 hour', 'Ran for an hour', 1);

-- --------------------------------------------------------

--
-- Table structure for table `health_data`
--

CREATE TABLE `health_data` (
  `user_id` int(11) NOT NULL,
  `timestamp` datetime NOT NULL,
  `heartrate` int(3) NOT NULL,
  `bodtemp` int(3) NOT NULL,
  `blpressure` text NOT NULL,
  `bloxygen` int(3) NOT NULL,
  `breathrate` int(3) NOT NULL,
  `ecgdet` int(4) NOT NULL,
  `checkin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `health_data`
--

INSERT INTO `health_data` (`user_id`, `timestamp`, `heartrate`, `bodtemp`, `blpressure`, `bloxygen`, `breathrate`, `ecgdet`, `checkin_id`) VALUES
(0, '2021-04-29 21:20:19', 0, 2, '3', 4, 5, 6, 1),
(2, '2021-04-29 21:31:11', 10, 10, '10', 10, 10, 10, 2);

-- --------------------------------------------------------

--
-- Table structure for table `reminders`
--

CREATE TABLE `reminders` (
  `user_id` int(11) NOT NULL,
  `timestamp` datetime NOT NULL,
  `reminderdate` datetime NOT NULL,
  `reminderdetails` text NOT NULL,
  `reminder_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reminders`
--

INSERT INTO `reminders` (`user_id`, `timestamp`, `reminderdate`, `reminderdetails`, `reminder_id`) VALUES
(2, '2021-04-29 22:07:22', '2021-04-30 00:00:00', 'test', 1),
(2, '2021-04-29 22:08:52', '2021-05-01 00:00:00', 'test 2', 2),
(2, '2021-04-29 22:14:35', '2021-05-02 03:05:00', 'fds', 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `admin`) VALUES
(2, 'eilidh', '$2y$10$fVbYT0eHB6XInYb9vBE6Ee9KRllLWr4Bx04ooBDz.0OSQXpbW67Ei', 1),
(3, 'p', '$2y$10$XrTMrmi4EM0FlAyvfmH3oeyLi.Z7maIfv.cTw.mQIg3q0tpHJ/Sze', 0),
(4, 'riderlessseven', '$2y$10$G/ZmNFcrLAAFmJ8IBGxZj.uhFrFdqmxD9omdSLJb28EFIKPIJ6s6e', 0),
(10, 'me', '$2y$10$RhjgiPa901UNoBrW0jjBEOu0yVuaNvwUjdDXr.eOL8x.pCATTwCVi', 0),
(11, 'caa', '$2y$10$jFdVwgmtScfIkBXw1qssde42.RyjI2Iqms.5NN0rsif/T.H6ptwx.', 0),
(12, 'a', '$2y$10$xisDaavMntQ2TrHQyzC4ZuiVpKFfakMgkgDUFFtBKTrBs5e5FaTLa', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `user_id` int(11) NOT NULL,
  `first_names` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`user_id`, `first_names`, `surname`, `date_of_birth`) VALUES
(2, 'Eilidh', 'Martin', '1993-12-31'),
(3, 'Peter', 'Majek', '1990-01-01'),
(4, 'Kevin', 'Urama', '1994-06-23'),
(10, '', '', '0000-00-00'),
(11, '', '', '0000-00-00'),
(12, '', '', '0000-00-00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `exercise_data`
--
ALTER TABLE `exercise_data`
  ADD PRIMARY KEY (`exercise_id`);

--
-- Indexes for table `health_data`
--
ALTER TABLE `health_data`
  ADD PRIMARY KEY (`checkin_id`);

--
-- Indexes for table `reminders`
--
ALTER TABLE `reminders`
  ADD PRIMARY KEY (`reminder_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD UNIQUE KEY `user_id_2` (`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `exercise_data`
--
ALTER TABLE `exercise_data`
  MODIFY `exercise_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `health_data`
--
ALTER TABLE `health_data`
  MODIFY `checkin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `reminders`
--
ALTER TABLE `reminders`
  MODIFY `reminder_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_details`
--
ALTER TABLE `user_details`
  ADD CONSTRAINT `user_id_constraint` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
