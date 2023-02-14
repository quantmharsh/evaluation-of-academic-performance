-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 23, 2022 at 07:03 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `evaluation_of_academic_performance`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_data`
--

CREATE TABLE `admin_data` (
  `id` int(10) NOT NULL,
  `admin_email` varchar(25) NOT NULL,
  `admin_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_data`
--

INSERT INTO `admin_data` (`id`, `admin_email`, `admin_password`) VALUES
(1, 'aman@gmail.com', 'aman'),
(6, 'amanmashqoor99@gmail.com', '$2y$10$OS0qVFVVPLiEXoYf1beZGOzff8r/KQCXy07IOQj9cSZVLL4X2Hs72');

-- --------------------------------------------------------

--
-- Table structure for table `student_data`
--

CREATE TABLE `student_data` (
  `id` int(15) NOT NULL,
  `s_name` text NOT NULL,
  `s_email` varchar(30) NOT NULL,
  `s_password` varchar(255) NOT NULL,
  `course` text NOT NULL,
  `roll_no` varchar(10) NOT NULL,
  `attendance` int(2) NOT NULL,
  `CNS` int(3) NOT NULL,
  `ISADIE` int(3) NOT NULL,
  `KM` int(3) NOT NULL,
  `ECOM` int(3) NOT NULL,
  `subject_marks` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_data`
--

INSERT INTO `student_data` (`id`, `s_name`, `s_email`, `s_password`, `course`, `roll_no`, `attendance`, `CNS`, `ISADIE`, `KM`, `ECOM`, `subject_marks`) VALUES
(22, 'Hemkar', 'hemkar@yahoo.com', '$2y$10$uCtCwXfcV6z/8WJb8ixA4uWQfmqsJ5PqrJS5XQbGppR6iWll3WHNi', 'BJMC', 'bm/22/32', 45, 0, 0, 0, 0, 0),
(23, 'Harsh Srivaastav', 'harsh@gmail.com', '$2y$10$xD8YIj3MILQPeO5ySAfB8ehPFm7MJShKhsDHC4eCVdb63JiO5Us3K', 'BCA', 'bc/22/035', 56, 36, 45, 65, 75, 221),
(25, 'Aman Mashqoor', 'amanmashqoor99@gmail.com', '$2y$10$OQu/20yxwzGRngDdVfKpUueA3kQIW/7vfz71x0ueEFS9IuRlxqgka', 'BCA', 'bc/22/012', 66, 24, 53, 44, 36, 157),
(28, 'Anusheel Srivastav', 'anusheel@gmail.com', '$2y$10$oaehVblvLbaGL6U1AsFIreH3FzaaRidnuIN3mrbJj3IRm.8IJNOGi', 'BCA', 'bc/22/019', 45, 88, 75, 45, 56, 264),
(29, 'Adarsh Srivastav', 'adarsh@gmail.com', '$2y$10$GJc4dy13xQnu5KpjquEGl.rcBXtIo58Hndc63RSVODZCP4Zlzninq', 'BCA', 'bc/22/006', 0, 0, 0, 0, 0, 0),
(30, 'Akash Mishra', 'akash@gmail.com', '$2y$10$YwKNErX204cZqBIny3xzWOC3jusd8WyQlwTBHvck1ookst5ayxRPG', 'BCA', 'bc/22/009', 0, 0, 0, 0, 0, 0),
(31, 'Gagan Singh', 'gagan@email.com', '$2y$10$NnRQkLz6DsZCLaAfjDTk4e5/j/n1cThhSLdAeflEI8o/eq/UUSETu', 'BJMC', 'bm/22/034', 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `subject_marks`
--

CREATE TABLE `subject_marks` (
  `student_table_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `teacher_data`
--

CREATE TABLE `teacher_data` (
  `id` int(15) NOT NULL,
  `t_name` text NOT NULL,
  `t_email` varchar(100) NOT NULL,
  `t_password` varchar(255) NOT NULL,
  `phone` text NOT NULL,
  `gender` char(1) NOT NULL,
  `department` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teacher_data`
--

INSERT INTO `teacher_data` (`id`, `t_name`, `t_email`, `t_password`, `phone`, `gender`, `department`) VALUES
(27, 'Tushar Vighnoi', 'tushar@gmail.com', '$2y$10$zr8jWMeI', '9945632154', 'M', 'BCOM'),
(28, 'Kshitij Kumar', 'kk@gmail.com', '$2y$10$FLzP3GA6gmRcbRXm6ZsT2ObwRGGUoyIJbo1/4GbTO6X47d8SDfFdq', '9845765156', 'M', 'BBA'),
(29, 'DK Gupta', 'dkg@gmail.com', '$2y$10$syAhbA/yH508FpfOfWY6ZuEtb4oMKcBXA7S2VQ9aVS8aqz5xH0HHu', '9578456321', 'M', 'BJMC'),
(30, 'Vivek Singh', 'vivek@gmail.com', '$2y$10$KpT1Gmdj1FMlPfSVjTjgCOdyc3.ed9DgvI6z313VqCImN8hHzBIDm', '9748563215', 'M', 'BCA'),
(34, 'Shubham Mittal', 'shubham@gmail.com', '$2y$10$QkfpxmcIl4xxWWFNOeDA5eNSFNePMnneq1tz8oGOHsXCRtp7L/1oi', '9567893215', 'M', 'BCA');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_data`
--
ALTER TABLE `admin_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_data`
--
ALTER TABLE `student_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject_marks`
--
ALTER TABLE `subject_marks`
  ADD KEY `student_table_id` (`student_table_id`);

--
-- Indexes for table `teacher_data`
--
ALTER TABLE `teacher_data`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_data`
--
ALTER TABLE `admin_data`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `student_data`
--
ALTER TABLE `student_data`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `teacher_data`
--
ALTER TABLE `teacher_data`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `subject_marks`
--
ALTER TABLE `subject_marks`
  ADD CONSTRAINT `subject_marks_ibfk_1` FOREIGN KEY (`student_table_id`) REFERENCES `student_data` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
