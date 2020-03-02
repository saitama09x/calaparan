-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 02, 2020 at 09:57 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `calaparan`
--

-- --------------------------------------------------------

--
-- Table structure for table `grade_sections`
--

CREATE TABLE `grade_sections` (
  `id` int(10) NOT NULL,
  `sectionname` varchar(25) NOT NULL,
  `teacher_id` int(10) NOT NULL,
  `datecreated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grade_sections`
--

INSERT INTO `grade_sections` (`id`, `sectionname`, `teacher_id`, `datecreated`) VALUES
(1, 'sample', 1, '2020-03-02');

-- --------------------------------------------------------

--
-- Table structure for table `grade_subjects`
--

CREATE TABLE `grade_subjects` (
  `id` int(20) NOT NULL,
  `subject_name` varchar(45) NOT NULL,
  `teacher_id` int(10) NOT NULL,
  `datecreated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grade_subjects`
--

INSERT INTO `grade_subjects` (`id`, `subject_name`, `teacher_id`, `datecreated`) VALUES
(2, 'english', 1, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(15) NOT NULL,
  `lname` varchar(30) DEFAULT NULL,
  `fname` varchar(30) DEFAULT NULL,
  `exname` varchar(10) DEFAULT NULL,
  `mname` varchar(30) DEFAULT NULL,
  `lrefno` varchar(60) DEFAULT NULL,
  `bday` date DEFAULT NULL,
  `sex` enum('Male','Female') DEFAULT NULL,
  `datecreated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `lname`, `fname`, `exname`, `mname`, `lrefno`, `bday`, `sex`, `datecreated`) VALUES
(1, 'asdasd', 'asdasd', NULL, 'asdasd', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `student_enrolls`
--

CREATE TABLE `student_enrolls` (
  `id` int(11) NOT NULL,
  `student_id` int(10) NOT NULL,
  `section_id` int(10) NOT NULL,
  `yr_from` date NOT NULL,
  `yr_to` date NOT NULL,
  `gradeyr` int(10) NOT NULL,
  `datecreated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_enrolls`
--

INSERT INTO `student_enrolls` (`id`, `student_id`, `section_id`, `yr_from`, `yr_to`, `gradeyr`, `datecreated`) VALUES
(1, 1, 1, '2020-03-03', '2021-03-04', 1, '2020-03-02');

-- --------------------------------------------------------

--
-- Table structure for table `student_records`
--

CREATE TABLE `student_records` (
  `id` int(10) NOT NULL,
  `enroll_id` int(10) NOT NULL,
  `subject_id` int(10) NOT NULL,
  `quarter` int(5) NOT NULL,
  `gradeval` int(11) DEFAULT NULL,
  `datecreated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student_remarks`
--

CREATE TABLE `student_remarks` (
  `id` int(10) NOT NULL,
  `student_id` int(10) NOT NULL,
  `subject_id` int(10) NOT NULL,
  `remarks` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(20) NOT NULL,
  `fullname` varchar(45) DEFAULT NULL,
  `sectname` varchar(20) DEFAULT NULL,
  `schooolyr` text NOT NULL,
  `classgrade` int(5) NOT NULL,
  `datecreated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `fullname`, `sectname`, `schooolyr`, `classgrade`, `datecreated`) VALUES
(1, 'asdasd', 'dasdasd', 'asdasd', 1, '2020-02-25 06:26:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `grade_sections`
--
ALTER TABLE `grade_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grade_subjects`
--
ALTER TABLE `grade_subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_enrolls`
--
ALTER TABLE `student_enrolls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_records`
--
ALTER TABLE `student_records`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_remarks`
--
ALTER TABLE `student_remarks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `grade_sections`
--
ALTER TABLE `grade_sections`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `grade_subjects`
--
ALTER TABLE `grade_subjects`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `student_enrolls`
--
ALTER TABLE `student_enrolls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `student_records`
--
ALTER TABLE `student_records`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_remarks`
--
ALTER TABLE `student_remarks`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
