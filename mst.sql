-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2024 at 08:16 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mst`
--

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `id` int(11) NOT NULL,
  `faculty_id` varchar(20) NOT NULL,
  `faculty_name` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`id`, `faculty_id`, `faculty_name`, `password`) VALUES
(1, '123', 'jai', '1234'),
(4, '12', 'kumar', '$2y$10$lg2u/HvOHW3fu2BhEvouyedg2.NYVegWPPYX4J7MFOwP296CykReK'),
(5, '100', 'narendra', '$2y$10$viXWVxHLv86FheTJk2VOC.5Gz07d68VisORJC757U.5f22iY4Juom'),
(6, '101', 'Mounika', '$2y$10$jnjJ60ps.kF7u59oJTOD4OcKeAg22.KSn38gWH02LXUbFTHw.IB2y'),
(7, '102', 'radhika', '$2y$10$a1UD6e1ekoTbdJnLyb3XiuHMOEJyTZUPzr1/F5XjvXjDTCMK2NZuG');

-- --------------------------------------------------------

--
-- Table structure for table `marks`
--

CREATE TABLE `marks` (
  `id` int(11) NOT NULL,
  `regd_no` varchar(20) NOT NULL,
  `subject_name` varchar(50) NOT NULL,
  `semester` int(11) NOT NULL,
  `grade` varchar(5) NOT NULL,
  `remarks` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `marks`
--

INSERT INTO `marks` (`id`, `regd_no`, `subject_name`, `semester`, `grade`, `remarks`) VALUES
(95, '21b91a0551', 'M1', 1, 'A', 'Nice'),
(96, '21b91a0551', 'CHEMISTRY', 1, 'A+', 'Very Good'),
(97, '21b91a0551', 'ENGLISH', 1, 'B', 'Improve it'),
(98, '21b91a0551', 'CFDL', 1, 'A', 'Not bad'),
(99, '21b91a0551', 'PPSC', 1, 'B', 'It is important subject improve it');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `student_name` varchar(50) NOT NULL,
  `regd_no` varchar(12) NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `contact_no` varchar(15) NOT NULL,
  `email_id` varchar(50) NOT NULL,
  `course` varchar(10) NOT NULL,
  `faculty_id` varchar(20) NOT NULL,
  `password` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `student_name`, `regd_no`, `date_of_birth`, `gender`, `contact_no`, `email_id`, `course`, `faculty_id`, `password`, `created_at`) VALUES
(1, 'Radhika', '21b91a0534', '2003-01-01', 'Female', '7032529801', 'radhika@gmail.com', 'cse', '123', '0612', '2024-05-16 14:12:24'),
(7, 'Jaikumar', '21b91a0551', '2002-04-06', 'Male', '9381466583', 'buddijaikumar06@gmail.com', 'cse', '123', '0612', '2024-03-18 18:10:08'),
(8, 'kavya', '21b91a0570', '2003-11-12', 'Female', '8074168745', 'kavyachippada@gmail.com', 'cse', '123', '0612', '2024-04-04 17:12:47'),
(10, 'mounika', '21b91a0531', '2003-02-07', 'Female', '6281217344', 'mounika@gmail.com', 'cse', '123', '0612', '2024-05-16 14:10:25'),
(11, 'Narendra', '21b91a0528', '2003-01-01', 'Male', '8179359063', 'narendra@gmail.com', 'cse', '123', '0612', '2024-05-16 14:14:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `marks`
--
ALTER TABLE `marks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `marks`
--
ALTER TABLE `marks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
