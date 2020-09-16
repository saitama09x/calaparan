-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 16, 2020 at 03:02 PM
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
-- Table structure for table `admin_accounts`
--

CREATE TABLE `admin_accounts` (
  `id` int(10) NOT NULL,
  `username` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL,
  `fname` varchar(45) NOT NULL,
  `mname` varchar(45) NOT NULL,
  `lname` varchar(45) NOT NULL,
  `date_created` date NOT NULL,
  `date_updated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_accounts`
--

INSERT INTO `admin_accounts` (`id`, `username`, `password`, `fname`, `mname`, `lname`, `date_created`, `date_updated`) VALUES
(1, 'admin', '$2y$10$ggcvroe0inbudDCe7/9WT.bWbDS.7lJBzvnKpwANGvoR5mTnS7SgS', 'admin', 'admin', 'admin', '2020-03-12', '2020-03-12'),
(2, 'test', '$2y$10$37Spu88zkMUVyfm8VhL/N.xmeDqbbJ50lKGOLDH6NSOnASDu6cWCC', 'testadmin', 'testadmin', 'testadmin', '2020-09-16', '2020-09-16');

-- --------------------------------------------------------

--
-- Table structure for table `credentials`
--

CREATE TABLE `credentials` (
  `id` int(10) NOT NULL,
  `crname` varchar(45) NOT NULL,
  `date_created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `credentials`
--

INSERT INTO `credentials` (`id`, `crname`, `date_created`) VALUES
(1, 'Kinder Progress Report', '2020-03-10'),
(2, 'ECCD Checklist', '2020-03-10'),
(3, 'KIndergarten Certificate of Completion', '2020-03-10');

-- --------------------------------------------------------

--
-- Table structure for table `grade_sections`
--

CREATE TABLE `grade_sections` (
  `id` int(10) NOT NULL,
  `sectionname` varchar(25) NOT NULL,
  `gradelevel` int(5) NOT NULL,
  `date_created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grade_sections`
--

INSERT INTO `grade_sections` (`id`, `sectionname`, `gradelevel`, `date_created`) VALUES
(1, 'section 1', 0, '2020-03-02'),
(2, 'section 2', 1, '2020-03-13'),
(3, 'section 3', 2, '2020-03-13'),
(4, 'section 4', 3, '2020-03-13');

-- --------------------------------------------------------

--
-- Table structure for table `grade_subjects`
--

CREATE TABLE `grade_subjects` (
  `id` int(20) NOT NULL,
  `subjcode` varchar(10) NOT NULL,
  `teacher_id` int(10) NOT NULL,
  `datecreated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grade_subjects`
--

INSERT INTO `grade_subjects` (`id`, `subjcode`, `teacher_id`, `datecreated`) VALUES
(2, 'ENGL', 1, '0000-00-00'),
(3, 'FILI', 1, '0000-00-00'),
(4, 'MOTG', 1, '0000-00-00'),
(5, 'FILI', 5, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `guest_accounts`
--

CREATE TABLE `guest_accounts` (
  `id` int(10) NOT NULL,
  `username` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL,
  `fname` varchar(45) NOT NULL,
  `mname` varchar(45) NOT NULL,
  `lname` varchar(45) NOT NULL,
  `account_type` enum('Student','Teacher','Admin') NOT NULL,
  `email` varchar(60) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL,
  `acct_type_id` int(10) DEFAULT NULL,
  `remember_token` int(255) DEFAULT NULL,
  `date_created` date NOT NULL,
  `date_updated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guest_accounts`
--

INSERT INTO `guest_accounts` (`id`, `username`, `password`, `fname`, `mname`, `lname`, `account_type`, `email`, `is_active`, `acct_type_id`, `remember_token`, `date_created`, `date_updated`) VALUES
(1, 'ada', '$2y$10$3utv28iqnOgp9g1c4AZ1zOO.VKRzcKi0TMV5WZs.C1MEQtpS8obVq', 'adasd', 'asdasd', 'asdasd', 'Student', 'test@test.com', 0, NULL, NULL, '2020-03-11', '2020-03-11'),
(2, 'asdasdasd', '$2y$10$DjbYNCzuWK3ZHBafghZNO.X1XmmP/UhMfwHrV8Xb7ohrygAezFcxi', 'asdas', 'adasd', 'asdasdasd', 'Student', 'test@test.com', 0, NULL, NULL, '2020-03-11', '2020-03-11'),
(3, 'admin', '$2y$10$lWODX9AtGLoZnUyO/1CFEOspYfiyqdEFHukRIPZ5wgqDpoG83KhOu', 'test', 'test', 'test', 'Student', 'test@test.com', 0, NULL, NULL, '2020-03-11', '2020-03-11'),
(4, 'teacher', '$2y$10$IedqtoN.saPdF0dvCjwZQed66w2mVQZi0uuu6GUjcn4YKuopBM75S', 'Teacher', 'T', 'Teacher', 'Teacher', 'dartz09x@gmail.com', 0, NULL, NULL, '2020-03-12', '2020-03-12'),
(5, 'a', '$2y$10$ffPrvzB5H0YC5o0bGF4aJuNkBvyAG6g27xIooXZ./QeglAKGlkipu', 'a', 'a', 'a', 'Student', 'dartz09x@gmail.com', 0, NULL, NULL, '2020-06-09', '2020-06-09'),
(6, 'teacher1', '$2y$10$qsNXjHLuISnGCvJUxlqUFecMP2m9C1LrVutv.d9KBDj50a2Fa4Vc6', 'b', 'b', 'b', 'Teacher', 'dartz09x@gmail.com', 0, NULL, NULL, '2020-06-16', '2020-06-16');

-- --------------------------------------------------------

--
-- Table structure for table `schools`
--

CREATE TABLE `schools` (
  `id` int(10) NOT NULL,
  `shname` varchar(60) NOT NULL,
  `shid` varchar(10) NOT NULL,
  `district` varchar(60) NOT NULL,
  `division` varchar(60) NOT NULL,
  `region` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schools`
--

INSERT INTO `schools` (`id`, `shname`, `shid`, `district`, `division`, `region`) VALUES
(1, 'Calaparan School', '123', 'Arevalo', '2', 'VI');

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
  `datecreated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `lname`, `fname`, `exname`, `mname`, `lrefno`, `bday`, `sex`, `datecreated`) VALUES
(1, 'Student ', 'Student ', 'I', NULL, NULL, '2020-03-27', 'Male', '2020-03-04 06:43:38'),
(2, 'Student 2', 'Student ', 'a', NULL, NULL, '2020-06-18', 'Male', '2020-06-09 08:08:28'),
(3, 'Student 3', 'Student ', 'a', NULL, NULL, '2020-06-16', 'Male', '2020-06-22 08:00:28');

-- --------------------------------------------------------

--
-- Table structure for table `student_eligibles`
--

CREATE TABLE `student_eligibles` (
  `id` int(10) NOT NULL,
  `student_id` int(10) NOT NULL,
  `eligible_id` int(10) NOT NULL,
  `school_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_eligibles`
--

INSERT INTO `student_eligibles` (`id`, `student_id`, `eligible_id`, `school_id`) VALUES
(7, 1, 2, 1),
(8, 2, 1, 1),
(9, 2, 2, 1),
(10, 3, 1, 1),
(12, 5, 1, 1),
(13, 5, 2, 1),
(17, 6, 1, 1),
(18, 6, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `student_enrolls`
--

CREATE TABLE `student_enrolls` (
  `id` int(11) NOT NULL,
  `student_id` int(10) NOT NULL,
  `teacher_id` int(10) NOT NULL,
  `school_id` int(10) NOT NULL,
  `yr_from` date NOT NULL,
  `yr_to` date NOT NULL,
  `gradeyr` int(10) NOT NULL,
  `datecreated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_enrolls`
--

INSERT INTO `student_enrolls` (`id`, `student_id`, `teacher_id`, `school_id`, `yr_from`, `yr_to`, `gradeyr`, `datecreated`) VALUES
(3, 1, 1, 1, '1925-02-25', '2020-03-28', 1, '2020-03-05'),
(7, 3, 1, 1, '2020-06-09', '2020-06-13', 1, '2020-06-22');

-- --------------------------------------------------------

--
-- Table structure for table `student_records`
--

CREATE TABLE `student_records` (
  `id` int(10) NOT NULL,
  `enroll_id` int(10) NOT NULL,
  `subjcode` varchar(10) NOT NULL,
  `qtr_first` int(10) DEFAULT NULL,
  `qtr_second` int(10) DEFAULT NULL,
  `qtr_third` int(10) DEFAULT NULL,
  `qtr_fourth` int(10) DEFAULT NULL,
  `final_rate` int(10) DEFAULT NULL,
  `datecreated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_records`
--

INSERT INTO `student_records` (`id`, `enroll_id`, `subjcode`, `qtr_first`, `qtr_second`, `qtr_third`, `qtr_fourth`, `final_rate`, `datecreated`) VALUES
(8, 3, 'ENGL', 1, 1, 2, NULL, 1, '2020-03-06'),
(9, 3, 'FILI', 1, 1, 2, NULL, 1, '2020-03-06'),
(10, 3, 'MOTG', 1, 1, 2, NULL, 4, '2020-03-06'),
(11, 6, 'FILI', 1, 1, 1, NULL, 2, '2020-03-06'),
(12, 7, 'ENGL', 2, 4, 5, NULL, NULL, '2020-06-22'),
(13, 7, 'FILI', 2, 4, 5, NULL, NULL, '2020-06-22'),
(14, 7, 'MOTG', 2, 2, 5, NULL, NULL, '2020-06-22');

-- --------------------------------------------------------

--
-- Table structure for table `student_remarks`
--

CREATE TABLE `student_remarks` (
  `id` int(10) NOT NULL,
  `enroll_id` int(10) NOT NULL,
  `subjcode` varchar(10) NOT NULL,
  `remarks` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_remarks`
--

INSERT INTO `student_remarks` (`id`, `enroll_id`, `subjcode`, `remarks`) VALUES
(1, 1, 'ENGL', '<p>asdas123123</p>'),
(2, 1, 'FILI', '<p>asdasd</p>'),
(5, 1, 'MOTG', '<p>asdasd123</p>'),
(6, 3, 'ENGL', '<p>asdasdas445645</p>'),
(7, 3, 'FILI', '<p>etesting</p>'),
(8, 3, 'MOTG', '<p>123123231</p>'),
(9, 6, 'FILI', '<p>12312</p>'),
(10, 7, 'ENGL', '<p>asdasd</p>');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(10) NOT NULL,
  `subjcode` varchar(10) NOT NULL,
  `subjname` varchar(20) NOT NULL,
  `gradelevel` int(5) NOT NULL DEFAULT '0',
  `parent_id` int(10) DEFAULT '0',
  `date_created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `subjcode`, `subjname`, `gradelevel`, `parent_id`, `date_created`) VALUES
(1, 'ENGL', 'English', 0, 0, '0000-00-00'),
(2, 'FILI', 'Filipino', 0, 0, '0000-00-00'),
(3, 'MOTG', 'Mother Tongue', 0, 2, '0000-00-00'),
(4, 'MAPH', 'Mapeh', 0, 0, '2020-03-13'),
(5, 'PYED', 'Physical Education', 0, 0, '2020-03-13'),
(6, 'MUSC', 'Music', 0, 4, '2020-03-13');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(20) NOT NULL,
  `fullname` varchar(45) DEFAULT NULL,
  `section_id` int(10) NOT NULL,
  `classgrade` int(5) NOT NULL,
  `yr_from` date DEFAULT NULL,
  `yr_to` date DEFAULT NULL,
  `datecreated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `fullname`, `section_id`, `classgrade`, `yr_from`, `yr_to`, `datecreated`) VALUES
(1, 'teacher 1', 1, 1, NULL, NULL, '2020-02-25 06:26:06'),
(2, 'teacher 2', 2, 2, NULL, NULL, '2020-03-02 00:00:00'),
(3, 'teacher 3', 4, 2, NULL, NULL, '2020-03-02 00:00:00'),
(4, 'teacher 4', 3, 2, NULL, NULL, '2020-03-02 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_accounts`
--
ALTER TABLE `admin_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `credentials`
--
ALTER TABLE `credentials`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `guest_accounts`
--
ALTER TABLE `guest_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schools`
--
ALTER TABLE `schools`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_eligibles`
--
ALTER TABLE `student_eligibles`
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
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
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
-- AUTO_INCREMENT for table `admin_accounts`
--
ALTER TABLE `admin_accounts`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `credentials`
--
ALTER TABLE `credentials`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `grade_sections`
--
ALTER TABLE `grade_sections`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `grade_subjects`
--
ALTER TABLE `grade_subjects`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `guest_accounts`
--
ALTER TABLE `guest_accounts`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `schools`
--
ALTER TABLE `schools`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `student_eligibles`
--
ALTER TABLE `student_eligibles`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `student_enrolls`
--
ALTER TABLE `student_enrolls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `student_records`
--
ALTER TABLE `student_records`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `student_remarks`
--
ALTER TABLE `student_remarks`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
