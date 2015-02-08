-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 08, 2015 at 10:22 
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ProTest`
--

-- --------------------------------------------------------

--
-- Table structure for table `Answer`
--

CREATE TABLE IF NOT EXISTS `Answer` (
`AnswerID` int(11) NOT NULL,
  `TestID` int(11) NOT NULL,
  `QuestionID` int(10) NOT NULL,
  `Answer` text,
  `Points` decimal(5,1) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=179 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Course`
--

CREATE TABLE IF NOT EXISTS `Course` (
  `CourseID` int(10) NOT NULL,
  `GroupID` int(10) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Syllabus` text,
  `Schedule` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Course`
--

INSERT INTO `Course` (`CourseID`, `GroupID`, `Name`, `Syllabus`, `Schedule`) VALUES
(1, 1, 'SSD', 'cefr', 'frgrg'),
(1, 2, 'SSD', 'cefr', 'frgrg'),
(1, 3, 'SSD', 'cefr', 'frgrg'),
(2, 1, 'CCS', 'cefr', 'frgrg'),
(2, 2, 'CCS', 'cefr', 'frgrg'),
(2, 3, 'CCS', 'cefr', 'frgrg');

-- --------------------------------------------------------

--
-- Table structure for table `Person`
--

CREATE TABLE IF NOT EXISTS `Person` (
  `PersonID` int(10) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Surname` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Discriminator` set('Student','Lecturer','Admin') NOT NULL DEFAULT 'Student'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Person`
--

INSERT INTO `Person` (`PersonID`, `Name`, `Surname`, `Password`, `Discriminator`) VALUES
(1, 'Fritz', 'Dieder', 'jurgen', 'Student'),
(2, 'jan', 'Kwiatkowski', 'nice', 'Lecturer');

-- --------------------------------------------------------

--
-- Table structure for table `Person_Course`
--

CREATE TABLE IF NOT EXISTS `Person_Course` (
  `PersonID` int(10) NOT NULL,
  `CourseID` int(10) NOT NULL,
  `GroupID` int(10) NOT NULL,
  `Discriminator` enum('hears','teaches') NOT NULL DEFAULT 'teaches'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Person_Course`
--

INSERT INTO `Person_Course` (`PersonID`, `CourseID`, `GroupID`, `Discriminator`) VALUES
(1, 1, 1, 'hears'),
(1, 2, 3, 'hears'),
(2, 1, 1, 'teaches'),
(2, 1, 2, 'teaches'),
(2, 1, 3, 'teaches'),
(2, 2, 1, 'teaches'),
(2, 2, 2, 'teaches'),
(2, 2, 3, 'teaches');

-- --------------------------------------------------------

--
-- Table structure for table `Question`
--

CREATE TABLE IF NOT EXISTS `Question` (
`QuestionID` int(10) NOT NULL,
  `TestTemplateID` int(10) NOT NULL,
  `Text` text NOT NULL,
  `Solution` text,
  `AnswerSet` text,
  `SolutionSet` varchar(255) DEFAULT NULL,
  `Max points` int(10) NOT NULL,
  `Discriminator` set('Closed','Gap','Open') NOT NULL DEFAULT 'Closed'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Question`
--

INSERT INTO `Question` (`QuestionID`, `TestTemplateID`, `Text`, `Solution`, `AnswerSet`, `SolutionSet`, `Max points`, `Discriminator`) VALUES
(1, 1, 'What is 1+1?', NULL, '1;;;2;;;3;;;4', '2', 1, 'Closed'),
(2, 1, '1+1= __?', '2', NULL, NULL, 1, 'Gap'),
(3, 1, 'What is a Pattern?', 'Solution for a common Problem.', NULL, NULL, 2, 'Open'),
(4, 1, 'Come on?', NULL, 'no;;;yes', '1;;;2', 1, 'Closed'),
(5, 1, 'Do you belive in God', 'Well,... no', NULL, NULL, 1, 'Open'),
(6, 1, 'Is it dark?', 'Yo', NULL, NULL, 1, 'Open');

-- --------------------------------------------------------

--
-- Table structure for table `Test`
--

CREATE TABLE IF NOT EXISTS `Test` (
`TestID` int(11) NOT NULL,
  `TestTemplateID` int(10) NOT NULL,
  `PersonID` int(10) NOT NULL,
  `Grade` decimal(2,1) DEFAULT NULL,
  `Result` decimal(6,1) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Test`
--

INSERT INTO `Test` (`TestID`, `TestTemplateID`, `PersonID`, `Grade`, `Result`) VALUES
(5, 3, 1, '2.0', '3.0');

-- --------------------------------------------------------

--
-- Table structure for table `TestTemplate`
--

CREATE TABLE IF NOT EXISTS `TestTemplate` (
`TestTemplateID` int(10) NOT NULL,
  `CourseID` int(10) NOT NULL,
  `GroupID` int(10) DEFAULT NULL,
  `Duration` int(10) NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `TestTemplate`
--

INSERT INTO `TestTemplate` (`TestTemplateID`, `CourseID`, `GroupID`, `Duration`, `Date`) VALUES
(1, 1, 1, 60, '2015-02-08'),
(2, 2, 2, 30, '2015-01-07'),
(3, 2, 3, 44, '2015-02-12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Answer`
--
ALTER TABLE `Answer`
 ADD PRIMARY KEY (`AnswerID`), ADD KEY `<of` (`TestID`), ADD KEY `for>` (`QuestionID`);

--
-- Indexes for table `Course`
--
ALTER TABLE `Course`
 ADD PRIMARY KEY (`CourseID`,`GroupID`);

--
-- Indexes for table `Person`
--
ALTER TABLE `Person`
 ADD PRIMARY KEY (`PersonID`);

--
-- Indexes for table `Person_Course`
--
ALTER TABLE `Person_Course`
 ADD PRIMARY KEY (`PersonID`,`CourseID`,`GroupID`), ADD KEY `is in >` (`PersonID`), ADD KEY `is in >2` (`CourseID`,`GroupID`);

--
-- Indexes for table `Question`
--
ALTER TABLE `Question`
 ADD PRIMARY KEY (`QuestionID`), ADD KEY `isPartOf>` (`TestTemplateID`);

--
-- Indexes for table `Test`
--
ALTER TABLE `Test`
 ADD PRIMARY KEY (`TestID`), ADD KEY `instanciates>` (`TestTemplateID`), ADD KEY `answerdBy>` (`PersonID`);

--
-- Indexes for table `TestTemplate`
--
ALTER TABLE `TestTemplate`
 ADD PRIMARY KEY (`TestTemplateID`), ADD KEY `partOf>` (`CourseID`,`GroupID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Answer`
--
ALTER TABLE `Answer`
MODIFY `AnswerID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=179;
--
-- AUTO_INCREMENT for table `Question`
--
ALTER TABLE `Question`
MODIFY `QuestionID` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `Test`
--
ALTER TABLE `Test`
MODIFY `TestID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=80;
--
-- AUTO_INCREMENT for table `TestTemplate`
--
ALTER TABLE `TestTemplate`
MODIFY `TestTemplateID` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `Answer`
--
ALTER TABLE `Answer`
ADD CONSTRAINT `<of` FOREIGN KEY (`TestID`) REFERENCES `Test` (`TestID`),
ADD CONSTRAINT `for>` FOREIGN KEY (`QuestionID`) REFERENCES `Question` (`QuestionID`);

--
-- Constraints for table `Person_Course`
--
ALTER TABLE `Person_Course`
ADD CONSTRAINT `is in >` FOREIGN KEY (`PersonID`) REFERENCES `Person` (`PersonID`),
ADD CONSTRAINT `is in >2` FOREIGN KEY (`CourseID`, `GroupID`) REFERENCES `Course` (`CourseID`, `GroupID`);

--
-- Constraints for table `Question`
--
ALTER TABLE `Question`
ADD CONSTRAINT `FKQuestion871462` FOREIGN KEY (`TestTemplateID`) REFERENCES `TestTemplate` (`TestTemplateID`);

--
-- Constraints for table `Test`
--
ALTER TABLE `Test`
ADD CONSTRAINT `FKTest200877` FOREIGN KEY (`PersonID`) REFERENCES `Person` (`PersonID`),
ADD CONSTRAINT `FKTest269860` FOREIGN KEY (`TestTemplateID`) REFERENCES `TestTemplate` (`TestTemplateID`);

--
-- Constraints for table `TestTemplate`
--
ALTER TABLE `TestTemplate`
ADD CONSTRAINT `FKTestTempla145338` FOREIGN KEY (`CourseID`, `GroupID`) REFERENCES `Course` (`CourseID`, `GroupID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
