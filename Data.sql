-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 06, 2015 at 01:45 
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

--
-- Dumping data for table `Person`
--

INSERT INTO `Person` (`PersonID`, `PersonPersonalID`, `PersonStudentID`, `Name`, `Surname`, `Password`, `Discriminator`) VALUES
(1, 0, 1, 'Fritz', 'Dieder', 'jurgen', 'Student'),
(2, 1, 0, 'jan', 'Kwiatkowski', 'nice', 'Lecturer');

--
-- Dumping data for table `Person_Course`
--

INSERT INTO `Person_Course` (`PersonID`, `PersonPersonalID`, `PersonStudentID`, `CourseID`, `GroupID`) VALUES
(2, 1, 0, 1, 1),
(2, 1, 0, 1, 2),
(2, 1, 0, 1, 3),
(2, 1, 0, 2, 1),
(2, 1, 0, 2, 2),
(2, 1, 0, 2, 3);

--
-- Dumping data for table `Test`
--

INSERT INTO `Test` (`TestID`, `TestTemplateID`, `PersonID`, `PersonPersonalID`, `PersonStudentID`, `Grade`, `Result`) VALUES
(1, 1, 1, 0, 1, '5.0', NULL),
(2, 2, 1, 0, 1, '4.5', 43);

--
-- Dumping data for table `TestTemplate`
--

INSERT INTO `TestTemplate` (`TestTemplateID`, `CourseID`, `GroupID`, `Duration`, `Date`) VALUES
(1, 1, 1, 60, '2015-02-11'),
(2, 2, 2, 30, '2015-01-07');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
