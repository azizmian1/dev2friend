-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 18, 2023 at 06:33 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dev2friend`
--

-- --------------------------------------------------------

--
-- Table structure for table `ci_event`
--

CREATE TABLE `ci_event` (
  `EVENT_ID` int(11) NOT NULL,
  `DESCRIPTION` varchar(64) NOT NULL,
  `EVENT_DTTM` datetime NOT NULL,
  `EVT_STATUS_FLG` enum('OPEN','CLOSED') NOT NULL,
  `LONG_DESC` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ci_event`
--

INSERT INTO `ci_event` (`EVENT_ID`, `DESCRIPTION`, `EVENT_DTTM`, `EVT_STATUS_FLG`, `LONG_DESC`) VALUES
(21, 'June 24 - Night of Prayer', '2022-06-24 19:30:00', 'OPEN', 'Speaker: Ptr. Bong '),
(25, 'TEST', '2022-06-22 13:02:00', 'OPEN', 'TEST'),
(27, 'fda', '2022-06-22 14:20:00', 'OPEN', 'fdas');

-- --------------------------------------------------------

--
-- Table structure for table `ci_event_attendee`
--

CREATE TABLE `ci_event_attendee` (
  `EVENT_ID` int(11) NOT NULL,
  `MEMBER_ID` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ci_event_attendee`
--

INSERT INTO `ci_event_attendee` (`EVENT_ID`, `MEMBER_ID`) VALUES
(21, 'JILREGAB005'),
(21, 'JILREGAD004'),
(21, 'JILREGCG005'),
(21, 'JILREGEM004'),
(21, 'JILREGQJ006'),
(25, 'JILREGAB005'),
(25, 'JILREGCG005'),
(25, 'JILREGEM004'),
(25, 'JILREGQJ006');

-- --------------------------------------------------------

--
-- Table structure for table `ci_evt_non_member`
--

CREATE TABLE `ci_evt_non_member` (
  `EVENT_ID` int(11) NOT NULL,
  `FIRST_NAME` varchar(64) NOT NULL,
  `LAST_NAME` varchar(64) NOT NULL,
  `CONTACT_NUMBER` varchar(32) NOT NULL,
  `NETWORK` varchar(32) NOT NULL,
  `ADDRESS` varchar(254) NOT NULL,
  `GENDER` enum('MALE','FEMALE') NOT NULL,
  `FIRST_TIMER_FLG` enum('YES','NO') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ci_evt_non_member`
--

INSERT INTO `ci_evt_non_member` (`EVENT_ID`, `FIRST_NAME`, `LAST_NAME`, `CONTACT_NUMBER`, `NETWORK`, `ADDRESS`, `GENDER`, `FIRST_TIMER_FLG`) VALUES
(25, 'Test', 'Try', '(111) 111-1111', 'YAN', 'Test', 'MALE', 'YES'),
(25, 'asdasdad', 'Sasas', '(111) 111-1111', 'MEN', '123123', 'MALE', 'NO'),
(25, 'assadasdad', 'asdadasdad', '(111) 111-1111', 'YAN', '123123 Regina', 'MALE', 'NO'),
(25, 'asdasd', 'asdada', '(112) 333-3333', 'KIDDOS', '4123', 'MALE', 'YES'),
(25, 'aaaaaa`', 'assdd', '(444) 444-4444', 'WOMEN', '1233', 'MALE', 'NO'),
(25, 'ee', 'e', '(133) 333-3311', 'WOMEN', '12313', 'MALE', 'NO'),
(25, 'aadddd', 'asdddd', '(199) 999-9999', 'WOMEN', '9999', 'MALE', 'YES'),
(25, 'laksjdlaksjd', 'alskdjaklsdj', '(999) 999-9990', 'CYN', 'askdasd', 'FEMALE', 'YES'),
(25, 'kjaskjsd', 'oakj', '(009) 988-9440', 'WOMEN', 'asddd', 'MALE', 'YES'),
(25, 'aslkajsldkj', 'asdlkasd', '(009) 099-0909', 'WOMEN', 'asdadasd', 'MALE', 'YES'),
(27, 'fdsa', 'dsa', '(306) 234-2456', 'WOMEN', '2834 Parliament Avenue', 'MALE', 'NO'),
(21, 'Test', 'Test', '(306) 201-5554', 'CYN', '2834 Parliament Avenue', 'MALE', 'YES'),
(21, 'fds', 'fdsa', '(306) 201-5554', 'KIDDOS', '2834 Parliament Avenue', 'MALE', 'NO'),
(27, 'fdas', 'fads', '(306) 234-2456', 'KIDDOS', '12-2834 Parliament Avenue', 'MALE', 'NO'),
(27, 'Test', 'Test', '(306) 555-1111', 'MEN', '12-2834 Parliament Avenue', 'FEMALE', 'NO'),
(27, 'fda', 'fdsa', '(306) 201-5554', 'CYN', '12-2834 Parliament Avenue', 'MALE', 'NO'),
(27, 'asdf', 'asdf', '(306) 123-4512', 'KIDDOS', '2834 Parliament Avenue', 'MALE', 'NO'),
(27, 'rew', '24', '(306) 123-4512', 'KIDDOS', '12-2834 Parliament Avenue', 'MALE', 'NO'),
(27, 'seta', 'rewa', '(306) 201-5554', 'KIDDOS', '2834 Parliament Avenue', 'MALE', 'NO'),
(27, 'fdas', 'afds', '(306) 201-5554', 'CYN', '2834 Parliament Avenue', 'MALE', 'NO'),
(27, 'Alert', 'Test', '(306) 123-4512', 'CYN', '132 Rundleridge Road NE', 'MALE', 'NO'),
(27, 'asdf', 'fda', '(306) 201-5554', 'CYN', '2834 Parliament Avenue', 'MALE', 'NO'),
(27, 'ds', 'gdsag', '(306) 111-3333', 'CYN', '12-2834 Parliament Avenue', 'FEMALE', 'NO');

-- --------------------------------------------------------

--
-- Table structure for table `ci_member`
--

CREATE TABLE `ci_member` (
  `MEMBER_ID` varchar(11) NOT NULL,
  `FIRST_NAME` varchar(64) NOT NULL,
  `LAST_NAME` varchar(64) NOT NULL,
  `EMAIL` varchar(32) NOT NULL,
  `USER_PASS` varchar(32) NOT NULL,
  `ACTIVE_STAT_FLG` enum('A','I') NOT NULL,
  `ACCESS_ROLE_FLG` enum('ADMIN','USER') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ci_member`
--

INSERT INTO `ci_member` (`MEMBER_ID`, `FIRST_NAME`, `LAST_NAME`, `EMAIL`, `USER_PASS`, `ACTIVE_STAT_FLG`, `ACCESS_ROLE_FLG`) VALUES
('D2FAP006', 'Admin', 'Page', 'adminpage@gmail.com', 'password', 'A', 'ADMIN'),
('D2FAT009', 'Admin', 'Terry', 'TerryAdmin@gmail.com', 'password', 'A', 'ADMIN'),
('D2FAU008', 'Admin', 'User', 'admin@gmail.com', 'password', 'A', 'ADMIN'),
('D2FAX007', 'Amiel', 'Xavier', 'amiel@gmail.com', 'password', 'A', 'USER'),
('D2FJE009', 'Jaimie', 'Ericka', 'jaimie@gmail.com', 'password', 'I', 'ADMIN'),
('D2FTN008', 'Terry', 'Nguyen', 'terrngu@gmail.com', 'password', 'A', 'USER'),
('D2FTU004', 'Test', 'User', 'test@gmail.com', 'pass', 'A', 'USER'),
('D2FUP005', 'User', 'Page', 'userpage@gmail.com', 'password', 'A', 'USER');

-- --------------------------------------------------------

--
-- Table structure for table `ci_project`
--

CREATE TABLE `ci_project` (
  `PROJECT_ID` int(11) NOT NULL,
  `ABBREVIATION` varchar(64) NOT NULL,
  `DESCRIPTION` varchar(64) NOT NULL,
  `PROJECT_DESCRIPTION` varchar(2000) DEFAULT NULL,
  `SECURITY_TYPE` varchar(64) NOT NULL,
  `PROJECT_PASSWORD` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ci_project`
--

INSERT INTO `ci_project` (`PROJECT_ID`, `ABBREVIATION`, `DESCRIPTION`, `PROJECT_DESCRIPTION`, `SECURITY_TYPE`, `PROJECT_PASSWORD`) VALUES
(1, 'D2F', 'Dev2Friend', 'This Project is a social media platform for developers to connect and group up to work on a specific project with the same goals and mission.', 'PUBLIC', NULL),
(2, 'TPN', 'Test Project Name 2', 'Test Project Description.', 'PUBLIC', NULL),
(20, 'TPT', 'Terry\'s Public Test', '', 'PUBLIC', NULL),
(21, 'TPT', 'Terry\'s Private Test', '', 'PRIVATE', '52189023451fcc5c54eda0bb35aa4023');

-- --------------------------------------------------------

--
-- Table structure for table `ci_project_mem`
--

CREATE TABLE `ci_project_mem` (
  `PROJECT_ID` int(11) NOT NULL,
  `MEMBER_ID` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ci_project_mem`
--

INSERT INTO `ci_project_mem` (`PROJECT_ID`, `MEMBER_ID`) VALUES
(1, 'D2FAU008'),
(1, 'D2FAX007'),
(1, 'D2FJE009'),
(1, 'D2FTN008'),
(1, 'D2FUP005'),
(2, 'D2FAU008'),
(2, 'D2FAX007'),
(2, 'D2FJE009'),
(2, 'D2FTN008'),
(3, 'D2FJE009'),
(3, 'D2FTU004'),
(4, 'D2FJE009'),
(4, 'D2FTN008'),
(20, 'D2FTN008'),
(21, 'D2FTN008'),
(29, 'D2FTN008'),
(30, 'D2FAX007'),
(31, 'D2FTN008'),
(32, 'D2FTN008'),
(33, 'D2FTN008'),
(34, 'D2FTN008'),
(35, 'D2FTN008'),
(36, 'D2FTN008'),
(37, 'D2FTN008'),
(38, 'D2FTN008'),
(39, 'D2FTN008');

-- --------------------------------------------------------

--
-- Table structure for table `ci_user`
--

CREATE TABLE `ci_user` (
  `FULL_NAME` varchar(64) NOT NULL,
  `USER_EMAIL` varchar(64) NOT NULL,
  `USER_PASS` varchar(512) NOT NULL,
  `ACTIVE_STAT_FLG` enum('A','I') DEFAULT NULL,
  `ACCESS_ROLE_FLG` enum('SUPER','ADMIN','USER') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ci_user`
--

INSERT INTO `ci_user` (`FULL_NAME`, `USER_EMAIL`, `USER_PASS`, `ACTIVE_STAT_FLG`, `ACCESS_ROLE_FLG`) VALUES
('Admin', 'adminuser@d2f.com', 'password', 'A', 'ADMIN'),
('hahaha', 'hahaha@gmail.com', 'pass', 'A', 'ADMIN'),
('Migz Topacio', 'migz@gmail.com', 'password', 'A', 'USER'),
('Test User', 'test@gmail.com', 'password', 'A', 'ADMIN'),
('Test User', 'user@d2f.com', 'password', 'A', 'USER');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ci_member`
--
ALTER TABLE `ci_member`
  ADD PRIMARY KEY (`MEMBER_ID`);

--
-- Indexes for table `ci_project`
--
ALTER TABLE `ci_project`
  ADD PRIMARY KEY (`PROJECT_ID`);

--
-- Indexes for table `ci_project_mem`
--
ALTER TABLE `ci_project_mem`
  ADD PRIMARY KEY (`PROJECT_ID`,`MEMBER_ID`);

--
-- Indexes for table `ci_user`
--
ALTER TABLE `ci_user`
  ADD PRIMARY KEY (`USER_EMAIL`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ci_project`
--
ALTER TABLE `ci_project`
  MODIFY `PROJECT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `ci_project_mem`
--
ALTER TABLE `ci_project_mem`
  MODIFY `PROJECT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
