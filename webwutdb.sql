-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 13, 2018 at 01:27 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

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
  `orgID` int(11) NOT NULL,
  `eventCreate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `registrableDate` datetime NOT NULL,
  `eventStart` datetime NOT NULL,
  `eventEnd` datetime NOT NULL,
  `eventName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_thai_520_w2 NOT NULL,
  `eventDetail` varchar(512) CHARACTER SET utf8mb4 COLLATE utf8mb4_thai_520_w2 NOT NULL,
  `age` int(11) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `price` int(11) NOT NULL,
  `capacity` int(11) NOT NULL,
  `indoorName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_thai_520_w2 NOT NULL,
  `location` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_thai_520_w2 NOT NULL,
  `type` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_thai_520_w2 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`eventID`, `orgID`, `eventCreate`, `registrableDate`, `eventStart`, `eventEnd`, `eventName`, `eventDetail`, `age`, `gender`, `price`, `capacity`, `indoorName`, `location`, `type`) VALUES
(1, 3, '2018-03-11 18:23:45', '2018-03-12 00:00:00', '2018-03-15 08:00:00', '2018-03-18 16:00:00', 'Health Exam', 'Health Examination at Vibhavadee Hospital', -1, 'all', 0, 100, 'Vibhavadee Hospital', '51/3 Thanon Ngam Wong Wan, Khwaeng Lat Yao, Khet Chatuchak, Krung Thep Maha Nakhon 10900, Thailand', 'Science'),
(2, 3, '2018-03-12 07:13:51', '2018-03-15 00:00:00', '2018-03-19 13:00:00', '2018-03-19 16:00:00', 'Pre-Test TOEIC', 'A test held for letting\n     students trying out their mad English skillz', -1, 'all', 100, 8, 'คณะมนุษยศาสตร์', 'คณะมนุษยศาสตร์ อาคาร 1 Khwaeng Lat Yao, Khet Chatuchak, Krung Thep Maha Nakhon 10220, Thailand', 'Education'),
(3, 3, '2018-03-12 23:51:06', '2018-06-05 06:50:02', '2018-06-07 22:20:02', '2018-06-21 13:50:02', 'Path of Destruction', 'FAIL WARNING', -1, 'female', 0, 9, 'Ucom', 'Ucom, Khwaeng Lat Yao, Khet Chatuchak, Krung Thep Maha Nakhon 10220, Thailand', 'Hobbies'),
(4, 5, '2018-03-13 00:07:03', '2018-03-15 10:00:42', '2018-03-22 19:00:42', '2018-03-22 21:00:42', 'Enigma in Paris', 'Straight from the DPC!', 20, 'male', 200, 10, 'สยามดิสคัฟเวอรี่', 'สยามดิสคัฟเวอรี่ Rama I Rd, Khwaeng Pathum Wan, Khet Pathum Wan, Krung Thep Maha Nakhon 10330, Thailand', 'Music');

-- --------------------------------------------------------

--
-- Table structure for table `event_attendant`
--

CREATE TABLE `event_attendant` (
  `eventID` int(11) NOT NULL,
  `aID` int(11) NOT NULL,
  `flag` varchar(8) NOT NULL,
  `paymentID` int(11) NOT NULL,
  `qrCode` varchar(255) NOT NULL,
  `registerStamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `event_attendant`
--

INSERT INTO `event_attendant` (`eventID`, `aID`, `flag`, `paymentID`, `qrCode`, `registerStamp`) VALUES
(1, 1, '', 1, '', '2018-03-12 01:08:11');

-- --------------------------------------------------------

--
-- Table structure for table `event_comment`
--

CREATE TABLE `event_comment` (
  `ID` int(11) NOT NULL,
  `eventID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `event_comment`
--

INSERT INTO `event_comment` (`ID`, `eventID`, `userID`, `comment`, `date`) VALUES
(1, 1, 1, 'hey', '2018-03-12 08:14:22'),
(2, 1, 4, 'wut', '2018-03-12 08:20:59');

-- --------------------------------------------------------

--
-- Table structure for table `event_image`
--

CREATE TABLE `event_image` (
  `eventID` int(11) NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event_image`
--

INSERT INTO `event_image` (`eventID`, `image`) VALUES
(1, 'event-1-org-3.png'),
(2, 'event-2-org-3.jpg'),
(3, 'event-3-org-3.png'),
(4, 'event-4-org-5.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `event_survey_link`
--

CREATE TABLE `event_survey_link` (
  `eventID` int(11) NOT NULL,
  `surveyLink` varchar(255) COLLATE utf8mb4_thai_520_w2 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_thai_520_w2;

--
-- Dumping data for table `event_survey_link`
--

INSERT INTO `event_survey_link` (`eventID`, `surveyLink`) VALUES
(1, 'https://goo.gl/forms/j35SqQAq5P2UzcdZ2');

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
(3, 'org', 'org@webwut.com', '0812345678'),
(5, 'RoastME', 'xxx', '0123456789');

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
  `displayName` text NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `email` varchar(320) NOT NULL,
  `phoneNo` char(10) DEFAULT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `personal_info`
--

INSERT INTO `personal_info` (`userID`, `displayName`, `firstName`, `lastName`, `age`, `gender`, `email`, `phoneNo`, `image`) VALUES
(1, 'icewow', 'wiwadh', 'chin', 21, 'male', 'wiwadh.c@ku.th', '0830504393', 'profile-1.jpg'),
(4, 'ice2', 'wi', 'chi', 21, 'female', 'wiwadh.c2@ku.th', '0830504393', '');

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
  `password` varchar(16) NOT NULL,
  `role` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `userID`, `password`, `role`) VALUES
(1, 'user', '$wiKP4kT.MWa2', 'AT'),
(2, 'admin', '$wykCC0S6UsnU', 'AD'),
(3, 'organizer', '$wShN7Lg53HX6', 'OR'),
(4, 'user2', 'user', 'AT'),
(5, 'roastme', '$wJkX1CFQOL5o', 'OR');

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
  ADD PRIMARY KEY (`ID`),
  ADD KEY `event_comment_user_id_fk` (`userID`),
  ADD KEY `eventID` (`eventID`);

--
-- Indexes for table `event_image`
--
ALTER TABLE `event_image`
  ADD PRIMARY KEY (`eventID`),
  ADD KEY `eventID` (`eventID`);

--
-- Indexes for table `event_survey_link`
--
ALTER TABLE `event_survey_link`
  ADD PRIMARY KEY (`eventID`);

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
  MODIFY `eventID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `event_comment`
--
ALTER TABLE `event_comment`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `event_image`
--
ALTER TABLE `event_image`
  MODIFY `eventID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `event_survey_link`
--
ALTER TABLE `event_survey_link`
  MODIFY `eventID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `event_user_id_fk` FOREIGN KEY (`orgID`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `event_survey_link`
--
ALTER TABLE `event_survey_link`
  ADD CONSTRAINT `event_survey_link_ibfk_1` FOREIGN KEY (`eventID`) REFERENCES `event` (`eventID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
