-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 05, 2015 at 11:29 
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
  `Points` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

-- --------------------------------------------------------

--
-- Table structure for table `Evaluation Rule`
--

CREATE TABLE IF NOT EXISTS `Evaluation Rule` (
`RuleID` int(10) NOT NULL,
  `QuestionID` int(10) NOT NULL,
  `EvaluationRule` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Person`
--

CREATE TABLE IF NOT EXISTS `Person` (
  `PersonID` int(10) NOT NULL,
  `PersonPersonalID` int(10) NOT NULL,
  `PersonStudentID` int(10) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Surname` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Discriminator` set('Student','Lecturer','Admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Person_Course`
--

CREATE TABLE IF NOT EXISTS `Person_Course` (
  `PersonID` int(10) NOT NULL,
  `PersonPersonalID` int(10) NOT NULL,
  `PersonStudentID` int(10) NOT NULL,
  `CourseID` int(10) NOT NULL,
  `GroupID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Question`
--

CREATE TABLE IF NOT EXISTS `Question` (
`QuestionID` int(10) NOT NULL,
  `TestTemplateID` int(10) NOT NULL,
  `Max points` int(10) DEFAULT NULL,
  `Text` text,
  `Solution:String[0..4]` int(10) DEFAULT NULL,
  `Answers` text,
  `Solution` varchar(255) DEFAULT NULL,
  `Discriminator` SET('Closed','Gap','Open') NOT NULL DEFAULT 'Closed'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Test`
--

CREATE TABLE IF NOT EXISTS `Test` (
`TestID` int(11) NOT NULL,
  `TestTemplateID` int(10) NOT NULL,
  `PersonID` int(10) NOT NULL,
  `PersonPersonalID` int(10) NOT NULL,
  `PersonStudentID` int(10) NOT NULL,
  `Grade` decimal(1,0) DEFAULT NULL,
  `Result` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;


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
-- Indexes for table `Evaluation Rule`
--
ALTER TABLE `Evaluation Rule`
 ADD PRIMARY KEY (`RuleID`), ADD KEY `FKEvaluation148495` (`QuestionID`);

--
-- Indexes for table `Person`
--
ALTER TABLE `Person`
 ADD PRIMARY KEY (`PersonID`,`PersonPersonalID`,`PersonStudentID`);

--
-- Indexes for table `Person_Course`
--
ALTER TABLE `Person_Course`
 ADD PRIMARY KEY (`PersonID`,`PersonPersonalID`,`PersonStudentID`,`CourseID`,`GroupID`), ADD KEY `is in >` (`PersonID`,`PersonPersonalID`,`PersonStudentID`), ADD KEY `is in >2` (`CourseID`,`GroupID`);

--
-- Indexes for table `Question`
--
ALTER TABLE `Question`
 ADD PRIMARY KEY (`QuestionID`), ADD KEY `FKQuestion871462` (`TestTemplateID`);

--
-- Indexes for table `Test`
--
ALTER TABLE `Test`
 ADD PRIMARY KEY (`TestID`), ADD KEY `FKTest269860` (`TestTemplateID`), ADD KEY `FKTest200877` (`PersonID`,`PersonPersonalID`,`PersonStudentID`);

--
-- Indexes for table `TestTemplate`
--
ALTER TABLE `TestTemplate`
 ADD PRIMARY KEY (`TestTemplateID`), ADD KEY `FKTestTempla145338` (`CourseID`,`GroupID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Answer`
--
ALTER TABLE `Answer`
MODIFY `AnswerID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Evaluation Rule`
--
ALTER TABLE `Evaluation Rule`
MODIFY `RuleID` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Question`
--
ALTER TABLE `Question`
MODIFY `QuestionID` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Test`
--
ALTER TABLE `Test`
MODIFY `TestID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `TestTemplate`
--
ALTER TABLE `TestTemplate`
MODIFY `TestTemplateID` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
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
-- Constraints for table `Evaluation Rule`
--
ALTER TABLE `Evaluation Rule`
ADD CONSTRAINT `FKEvaluation148495` FOREIGN KEY (`QuestionID`) REFERENCES `Question` (`QuestionID`);

--
-- Constraints for table `Person_Course`
--
ALTER TABLE `Person_Course`
ADD CONSTRAINT `is in >` FOREIGN KEY (`PersonID`, `PersonPersonalID`, `PersonStudentID`) REFERENCES `Person` (`PersonID`, `PersonPersonalID`, `PersonStudentID`),
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
ADD CONSTRAINT `FKTest200877` FOREIGN KEY (`PersonID`, `PersonPersonalID`, `PersonStudentID`) REFERENCES `Person` (`PersonID`, `PersonPersonalID`, `PersonStudentID`),
ADD CONSTRAINT `FKTest269860` FOREIGN KEY (`TestTemplateID`) REFERENCES `TestTemplate` (`TestTemplateID`);

--
-- Constraints for table `TestTemplate`
--
ALTER TABLE `TestTemplate`
ADD CONSTRAINT `FKTestTempla145338` FOREIGN KEY (`CourseID`, `GroupID`) REFERENCES `Course` (`CourseID`, `GroupID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
