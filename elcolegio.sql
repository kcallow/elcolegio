-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 27, 2017 at 02:10 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elcolegio`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `addCourse` (IN `courseName` VARCHAR(100), IN `courseDescription` VARCHAR(500), IN `courseImage` VARCHAR(256))  NO SQL
insert into course (name, description, imageURL)
values (courseName, courseDescription, courseImage)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `addCourseModule` (IN `moduleCourseID` INT, IN `moduleName` VARCHAR(100), IN `moduleDescription` VARCHAR(500), IN `modulePDF` VARCHAR(256))  NO SQL
insert into `module` (courseID, name, description, pdf)
values (moduleCourseID, moduleName, moduleDescription, modulePDF)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getCourse` (IN `courseID` INT)  NO SQL
select * from course where id = courseID$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getCourseModules` (IN `courseID` INT)  NO SQL
select * from `module` where `module`.courseID = courseID$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getCourses` ()  NO SQL
select * from course$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `validateUser` (IN `username` VARCHAR(100), IN `password` VARCHAR(200))  NO SQL
select * from user where user.username = username and user.password = password$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `id` int(10) UNSIGNED NOT NULL,
  `description` varchar(500) NOT NULL,
  `name` varchar(100) NOT NULL,
  `imageURL` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Main table';

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `description`, `name`, `imageURL`) VALUES
(1, 'Master the English language skills you need for a call center job.', 'English for Call Centers', 'img.jpg'),
(2, 'Vuelvase un usuario eficaz de los diferentes sistemas operativos de escritorio y moviles.', 'Sistemas operativos', 'img2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

CREATE TABLE `module` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(500) NOT NULL,
  `pdf` varchar(256) NOT NULL,
  `courseID` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Main table';

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`id`, `name`, `description`, `pdf`, `courseID`) VALUES
(2, 'Module 1', 'Welcome to English for Call Centers', 'English for Call Centers 1.pdf', 1),
(3, 'Module 2', 'Grammar', 'English for Call Centers 2.pdf', 1),
(4, 'Module 3', 'Filler', 'English for Call Centers 3.pdf', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sim`
--

CREATE TABLE `sim` (
  `id` int(10) UNSIGNED NOT NULL,
  `description` varchar(500) NOT NULL,
  `url` varchar(300) NOT NULL,
  `modID` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `simTry`
--

CREATE TABLE `simTry` (
  `id` int(10) UNSIGNED NOT NULL,
  `simID` int(10) UNSIGNED NOT NULL,
  `studentID` int(10) UNSIGNED NOT NULL,
  `tutorID` int(10) UNSIGNED NOT NULL,
  `grade` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(200) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `username`, `password`) VALUES
(1, 'thehumanisthipster@gmail.com', 'kc', 'perrow');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`id`),
  ADD KEY `courseID` (`courseID`);

--
-- Indexes for table `sim`
--
ALTER TABLE `sim`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modID` (`modID`),
  ADD KEY `modID_2` (`modID`);

--
-- Indexes for table `simTry`
--
ALTER TABLE `simTry`
  ADD PRIMARY KEY (`id`),
  ADD KEY `simID` (`simID`),
  ADD KEY `studentID` (`studentID`),
  ADD KEY `tutorID` (`tutorID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `module`
--
ALTER TABLE `module`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `sim`
--
ALTER TABLE `sim`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `simTry`
--
ALTER TABLE `simTry`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `module`
--
ALTER TABLE `module`
  ADD CONSTRAINT `module_ibfk_1` FOREIGN KEY (`courseID`) REFERENCES `course` (`id`);

--
-- Constraints for table `sim`
--
ALTER TABLE `sim`
  ADD CONSTRAINT `sim_ibfk_1` FOREIGN KEY (`modID`) REFERENCES `module` (`id`);

--
-- Constraints for table `simTry`
--
ALTER TABLE `simTry`
  ADD CONSTRAINT `student` FOREIGN KEY (`studentID`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `tutor` FOREIGN KEY (`tutorID`) REFERENCES `user` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
