-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 11, 2018 at 04:27 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webwutdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `eventID` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `orgID` int(11) NOT NULL,
  `eventName` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `capacity` int(11) NOT NULL,
  `location` varchar(255) NOT NULL,
  `qrCode` varchar(255) NOT NULL,
  `type` varchar(8) NOT NULL,
  `surveyLink` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `event_attendant`
--

CREATE TABLE `event_attendant` (
  `eventID` int(11) NOT NULL,
  `aID` int(11) NOT NULL,
  `flag` varchar(8) NOT NULL,
  `paymentID` int(11) NOT NULL,
  `qrCode` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `event_comment`
--

CREATE TABLE `event_comment` (
  `eventID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `event_image`
--

CREATE TABLE `event_image` (
  `eventID` int(11) NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `event_requirement`
--

CREATE TABLE `event_requirement` (
  `currentEventID` int(11) NOT NULL,
  `prevEventID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `organizer_info`
--

CREATE TABLE `organizer_info` (
  `userID` int(11) NOT NULL,
  `orgName` varchar(255) CHARACTER SET utf8 NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `phoneNo` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `organizer_info`
--

INSERT INTO `organizer_info` (`userID`, `orgName`, `email`, `phoneNo`) VALUES
(43, 'admin', 'admin@webwut.com', '0812345678'),
(45, 'GodMakeEvent', 'god@webwut.com', '0912345678'),
(51, 'kampanatkr-org', 'kampanatkr@org.com', '0864589595'),
(52, 'chotika-org', 'chotika@org.com', '0834561234');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `paymentID` int(11) NOT NULL,
  `evidence` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`paymentID`, `evidence`) VALUES
(1, 'payment-1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `personal_info`
--

CREATE TABLE `personal_info` (
  `userID` int(11) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `email` varchar(320) NOT NULL,
  `age` int(5) NOT NULL,
  `phoneNo` char(10) DEFAULT NULL,
  `gender` varchar(16) NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `personal_info`
--

INSERT INTO `personal_info` (`userID`, `firstName`, `lastName`, `email`, `age`, `phoneNo`, `gender`, `image`) VALUES
(47, 'gracy', 'oman', 'omen@webwut.com', 18, '081122333', 'female', ''),
(48, 'bobmaley', 'thailand', 'bobmaley@webwut.com', 25, '0818182838', 'male', ''),
(49, 'sarah', 'dankala', 'sarah@webwut.com', 23, '0830011223', 'female', ''),
(50, 'godji', 'ruangbamroong', 'kampanatkr@webwut.com', 20, '0853948854', 'male', '');

-- --------------------------------------------------------

--
-- Table structure for table `personal_message`
--

CREATE TABLE `personal_message` (
  `fromID` int(11) NOT NULL,
  `toID` int(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `filePath` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `userID` varchar(16) NOT NULL,
  `password` char(255) NOT NULL,
  `role` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `userID`, `password`, `role`) VALUES
(44, 'admin', '$wykCC0S6UsnU', 'AD'),
(45, 'god', '$w75ElNTVyllI', 'OR'),
(47, 'grace', '$wQosiKUx6mmg', 'AT'),
(48, 'bob', '$wquD143UiKqw', 'AT'),
(49, 'sarah', '$wquD143UiKqw', 'AT'),
(50, 'godji', '$wquD143UiKqw', 'AT'),
(51, 'kampanat', '$wquD143UiKqw', 'OR'),
(52, 'chotika', '$wquD143UiKqw', 'OR');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`eventID`),
  ADD KEY `event_user_id_fk` (`orgID`);

--
-- Indexes for table `event_attendant`
--
ALTER TABLE `event_attendant`
  ADD PRIMARY KEY (`eventID`,`aID`),
  ADD KEY `eventAttendant_user_id_fk` (`aID`),
  ADD KEY `event_attendant_payment_paymentID_fk` (`paymentID`);

--
-- Indexes for table `event_comment`
--
ALTER TABLE `event_comment`
  ADD PRIMARY KEY (`eventID`),
  ADD KEY `event_comment_user_id_fk` (`userID`);

--
-- Indexes for table `event_image`
--
ALTER TABLE `event_image`
  ADD KEY `eventID` (`eventID`);

--
-- Indexes for table `event_requirement`
--
ALTER TABLE `event_requirement`
  ADD PRIMARY KEY (`currentEventID`,`prevEventID`),
  ADD KEY `event_requirement_event_prevID_fk` (`prevEventID`);

--
-- Indexes for table `organizer_info`
--
ALTER TABLE `organizer_info`
  ADD PRIMARY KEY (`userID`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`paymentID`);

--
-- Indexes for table `personal_info`
--
ALTER TABLE `personal_info`
  ADD PRIMARY KEY (`userID`);

--
-- Indexes for table `personal_message`
--
ALTER TABLE `personal_message`
  ADD PRIMARY KEY (`fromID`,`toID`,`timestamp`) USING BTREE,
  ADD KEY `personalmessage_user_to_id_fk` (`toID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `eventID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `paymentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `event_user_id_fk` FOREIGN KEY (`orgID`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `event_attendant`
--
ALTER TABLE `event_attendant`
  ADD CONSTRAINT `eventAttendant_event_eventID_fk` FOREIGN KEY (`eventID`) REFERENCES `event` (`eventID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `eventAttendant_user_id_fk` FOREIGN KEY (`aID`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `event_attendant_payment_paymentID_fk` FOREIGN KEY (`paymentID`) REFERENCES `payment` (`paymentID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `event_comment`
--
ALTER TABLE `event_comment`
  ADD CONSTRAINT `eventComment_event_eventID_fk` FOREIGN KEY (`eventID`) REFERENCES `event` (`eventID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `event_comment_user_id_fk` FOREIGN KEY (`userID`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `event_image`
--
ALTER TABLE `event_image`
  ADD CONSTRAINT `event_image_ibfk_1` FOREIGN KEY (`eventID`) REFERENCES `event` (`eventID`);

--
-- Constraints for table `event_requirement`
--
ALTER TABLE `event_requirement`
  ADD CONSTRAINT `event_requirement_event_currentID_fk` FOREIGN KEY (`currentEventID`) REFERENCES `event` (`eventID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `event_requirement_event_prevID_fk` FOREIGN KEY (`prevEventID`) REFERENCES `event` (`eventID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `personal_info`
--
ALTER TABLE `personal_info`
  ADD CONSTRAINT `personalinfo_user_id_fk` FOREIGN KEY (`userID`) REFERENCES `user` (`id`);

--
-- Constraints for table `personal_message`
--
ALTER TABLE `personal_message`
  ADD CONSTRAINT `personalmessage_user_from_id_fk` FOREIGN KEY (`fromID`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `personalmessage_user_to_id_fk` FOREIGN KEY (`toID`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
