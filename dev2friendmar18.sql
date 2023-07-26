-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 19, 2023 at 04:42 AM
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
('D2FTW009', 'Thayne', 'Winder', 'thayne.winder@gmail.com', 'Passw0rd', 'A', 'USER'),
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
  `PROJECT_PASSWORD` varchar(64) DEFAULT NULL,
  `DISCORD_LINK` varchar(64) DEFAULT NULL,
  `GITHUB_LINK` varchar(64) DEFAULT NULL,
  `CONTACT_EMAIL` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ci_project`
--

INSERT INTO `ci_project` (`PROJECT_ID`, `ABBREVIATION`, `DESCRIPTION`, `PROJECT_DESCRIPTION`, `SECURITY_TYPE`, `PROJECT_PASSWORD`, `DISCORD_LINK`, `GITHUB_LINK`, `CONTACT_EMAIL`) VALUES
(1, 'D2F', 'Dev2Friend', 'This Project is a social media platform for developers to connect and group up to work on a specific project with the same goals and mission.', 'PUBLIC', '', 'https://discord.gg/example123', 'https://github.com/Terrngu/CS476_Project', 'terrngu@gmail.com'),
(2, 'TPN', 'Test Project Name 2', 'Test Project Description.', 'PUBLIC', NULL, NULL, NULL, NULL),
(4, 'TNP', 'Test Name Project', 'Test Project Description.', 'PUBLIC', NULL, NULL, NULL, NULL),
(20, 'TPT', 'Terry\'s Public Test', '', 'PUBLIC', NULL, NULL, NULL, NULL),
(21, 'TPT', 'Terry\'s Private Test', '', 'PRIVATE', 'newpass', NULL, NULL, NULL),
(29, 'NPT', 'new project test', 'Made from the new create menu', 'PRIVATE', '04d3a5591acef893056bc836785cf6f0', NULL, NULL, NULL);

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
(1, 'D2FTW009'),
(1, 'D2FUP005'),
(2, 'D2FAU008'),
(2, 'D2FAX007'),
(2, 'D2FJE009'),
(2, 'D2FTW009'),
(3, 'D2FJE009'),
(3, 'D2FTU004'),
(4, 'D2FJE009'),
(4, 'D2FTW009'),
(20, 'D2FTW009'),
(21, 'D2FTN008'),
(21, 'D2FTW009'),
(30, 'D2FAX007'),
(30, 'D2FTN008'),
(31, 'D2FTN008'),
(32, 'D2FTN008');

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ci_project`
--
ALTER TABLE `ci_project`
  MODIFY `PROJECT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `ci_project_mem`
--
ALTER TABLE `ci_project_mem`
  MODIFY `PROJECT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
