-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 09, 2021 at 10:25 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prodhandb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_tbl`
--

CREATE TABLE `admin_tbl` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(100) NOT NULL,
  `admin_password` varchar(150) NOT NULL,
  `admin_email` varchar(100) NOT NULL,
  `admin_user_type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_tbl`
--

INSERT INTO `admin_tbl` (`admin_id`, `admin_name`, `admin_password`, `admin_email`, `admin_user_type`) VALUES
(1, 'raiyan', '$2y$10$dcvQcj/oDlkX8j0fbURYSOa8fQFrlKgFd26urkGiFgjMEOd7Grs2i', 'r@ewubd.edu', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `attendance_tbl`
--

CREATE TABLE `attendance_tbl` (
  `attendance_id` int(11) NOT NULL,
  `attendance_student_id` int(11) NOT NULL,
  `attendance_status` varchar(10) NOT NULL,
  `attendance_date` date NOT NULL,
  `attendance_course_code` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendance_tbl`
--

INSERT INTO `attendance_tbl` (`attendance_id`, `attendance_student_id`, `attendance_status`, `attendance_date`, `attendance_course_code`) VALUES
(352, 1, 'present', '2021-01-04', 'CSE480-1'),
(353, 2, 'absent', '2021-01-04', 'CSE480-1'),
(354, 3, 'present', '2021-01-04', 'CSE480-1'),
(355, 4, 'absent', '2021-01-04', 'CSE480-1'),
(356, 1, 'present', '2021-01-04', 'CSE411-3'),
(357, 2, 'present', '2021-01-04', 'CSE411-3'),
(358, 3, 'present', '2021-01-04', 'CSE411-3'),
(359, 4, 'present', '2021-01-04', 'CSE411-3'),
(360, 7, 'absent', '2021-01-03', 'CSE411-3'),
(361, 8, 'absent', '2021-01-03', 'CSE411-3'),
(362, 9, 'absent', '2021-01-02', 'CSE411-3'),
(363, 1, 'present', '2021-01-06', 'CSE480-1'),
(364, 2, 'present', '2021-01-06', 'CSE480-1'),
(365, 3, 'absent', '2021-01-06', 'CSE480-1'),
(366, 4, 'absent', '2021-01-06', 'CSE480-1');

-- --------------------------------------------------------

--
-- Table structure for table `course_tbl`
--

CREATE TABLE `course_tbl` (
  `course_id` int(11) NOT NULL,
  `course_code` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course_tbl`
--

INSERT INTO `course_tbl` (`course_id`, `course_code`) VALUES
(6, 'CSE480-1'),
(7, 'CSE105-2'),
(8, 'CSE411-3'),
(9, 'CSE365-1'),
(10, 'CSE225-2'),
(11, 'CSE480-2'),
(12, 'CSE420-1'),
(13, 'CSE301-3');

-- --------------------------------------------------------

--
-- Table structure for table `student_tbl`
--

CREATE TABLE `student_tbl` (
  `student_id` int(11) NOT NULL,
  `student_name` varchar(150) NOT NULL,
  `student_password` varchar(100) NOT NULL,
  `student_roll_number` varchar(15) NOT NULL,
  `student_email` varchar(100) NOT NULL,
  `student_dob` date NOT NULL,
  `student_course_code` varchar(100) NOT NULL,
  `student_user_type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_tbl`
--

INSERT INTO `student_tbl` (`student_id`, `student_name`, `student_password`, `student_roll_number`, `student_email`, `student_dob`, `student_course_code`, `student_user_type`) VALUES
(1, 'Raiyan Rashid Prodhan', '$2y$10$.4ZLx8stojepPp8jn4s6perjW2L3wvAmhv.jsN19HOhg6M6Vyci4y', '2016-3-60-012', '2016-3-60-012@std.ewubd.edu', '1998-10-09', 'CSE480-1,CSE411-3', 'student'),
(2, 'Mamun Or Rashid', '$2y$10$dpSpr.kNHWFgzIwCduzKVON1RlJMQwOoOAhP7vUYXJwPdExXMTUw.', '2015-1-30-005', '2015-1-30-005@std.ewubd.edu', '1996-04-19', 'CSE480-1,CSE411-3', 'student'),
(3, 'Maznir Rashid', '$2y$10$fm8dcWVUGZ.e2z9KgSBdWurw7h8TwxCK1COmKglGfm9hv8V.j3ltW', '2018-2-20-010', '2018-2-20-010@std.ewubd.edu', '2000-01-15', 'CSE480-1,CSE411-3', 'student'),
(4, 'Rakib Shishir', '$2y$10$DHhJhauqa7tw7MzS0cHiH.Mxw7ekToCBGReOmdvCQnRNThlOX8Q0G', '2015-3-50-055', '2015-3-50-055@std.ewubd.edu', '2003-12-14', 'CSE480-1,CSE411-3', 'student'),
(5, 'Kamal Ataturk', '$2y$10$Z34jFHeCmoEExcU1Acq5f.pWfFgZ0HUwZobdZbya96FEAF4xhLDjO', '2017-1-30-020', '2017-1-30-020@std.ewubd.edu', '2003-07-12', 'CSE105-2,CSE225-2', 'student'),
(6, 'Ibrahim Pasha', '$2y$10$Mv5kxM2XWj.kzRAeVirMbuIueEpMGs.asHy3.9N9L7hDxuXpAGdCG', '2015-2-40-041', '2015-2-40-041@std.ewubd.edu', '2003-12-19', 'CSE105-2,CSE225-2', 'student'),
(7, 'Zihad Hawlader', '$2y$10$d5OK8gVAuQKiziEAPTomTepPtSL0l61Ir2lc4LB1nKRCW4xYkvqWK', '2017-3-60-033', '2017-3-60-033@std.ewubd.edu', '2002-12-19', 'CSE411-3,CSE225-2', 'student'),
(8, 'Moon Chowdhury', '$2y$10$X/7BFtPMnHEeEdb56gkwoulBp2P7oW6OinEcdkdGS8/i3gfBpCX0S', '2013-3-60-033', '2013-3-60-033@std.ewubd.edu', '2003-04-01', 'CSE411-3,CSE225-2', 'student'),
(9, 'Tuhin Pasha', '$2y$10$jTPATSUzO7VJzjbfS8uooe.E6QxpGEuvzNK4fV.HuHcaR3TCD4AxS', '2014-3-60-033', '2014-3-60-033@std.ewubd.edu', '2003-08-15', 'CSE411-3,CSE105-2', 'student'),
(10, 'Ibrahim Raju', '$2y$10$D58bvTRU7ipkRxNNkam12.WorTN4EVldJlsD8JmqN0H4bz2P/q8Ny', '2015-3-60-033', '2015-3-60-033@std.ewubd.edu', '2003-06-18', 'CSE365-1,CSE105-2', 'student'),
(11, 'Kholil Pasha', '$2y$10$eNn2PL9XUuVgtxzZ3Ml74O2ucWDHyjzNKAAEli/6o3az5NW2W4zcu', '2016-3-60-033', '2016-3-60-033@std.ewubd.edu', '2002-05-01', 'CSE365-1,CSE420-1', 'student'),
(12, 'Solaiman Prodhan', '$2y$10$i.OZTWhbbVYlf5g3OMH9XejYqPwdY.q0/R3td.uV6NP7MSEAjq/hO', '2018-3-60-033', '2018-3-60-033@std.ewubd.edu', '2002-04-12', 'CSE225-2,CSE420-1', 'student'),
(13, 'Marjuk Rasel', '$2y$10$Xu1mKXwRy91Xn12yylq4XO9D.4q4kuacOKPVKmvKv.byrXKElaV3C', '2019-3-60-033', '2019-3-60-033@std.ewubd.edu', '2002-10-12', 'CSE225-2,CSE301-3', 'student'),
(14, 'Sakib Khan', '$2y$10$x2cHLoHZ1J0w1xW3eHoJTOqXfRNHednwbWHWnDlE6YtAkbTzQfty6', '2020-3-60-033', '2020-3-60-033@std.ewubd.edu', '2002-02-27', 'CSE480-2,CSE301-3', 'student'),
(15, 'Raju Alom', '$2y$10$H2kW2IwAhEz.WtxyFw5AO.eRHaYDvnYJnkpI5NUeas5QNj2UjUhm2', '2016-3-50-055', '2016-3-50-055@std.ewubd.edu', '2002-06-12', 'CSE480-2', 'student'),
(16, 'Hamja Joarder', '$2y$10$7OQDHQvM//opmNZvSb6CIe/3szXQBd2YF4vg9gYUvbxYCRLWGTh0O', '2017-3-50-055', '2017-3-50-055@std.ewubd.edu', '2002-08-17', 'CSE480-2', 'student'),
(17, 'Rana Rashid', '$2y$10$RP8kFcvrG.Hu6BDjfrGoHu/rQGTBxeVHKfYrp6G.yXzmVqhLfz1ha', '2018-3-50-055', '2018-3-50-055@std.ewubd.edu', '2002-09-18', 'CSE420-1', 'student'),
(18, 'Parvej Halim', '$2y$10$A2lu1aq403naaGyIpt1jN.EuQl1dHFfwz.f9RURdyveio5dLkgo/.', '2019-3-50-055', '2019-3-50-055@std.ewubd.edu', '2002-07-15', 'CSE420-1', 'student'),
(19, 'Jafor Shahid', '$2y$10$inN8CbAnlBQuyb1mDvWkl.jXNux8rQOzcQ4GMaJFogk3l1Pr2kQFS', '2020-3-50-055', '2020-3-50-055@std.ewubd.edu', '2002-01-14', 'CSE420-1', 'student'),
(20, 'Konik Chowdhury', '$2y$10$YKsrucLNjCxghoocfx5w7.hZhw5mdRtYYKMWmdzlxoyxXErxNTyFy', '2017-3-60-012', '2017-3-60-012@std.ewubd.edu', '2002-12-05', 'CSE301-3', 'student'),
(21, 'Sajidul Haque', '$2y$10$1l61srQz7lIbIxWCDDA.Su/OfAtgG9fVILNEP/itZrs8f8gzKAxjy', '2018-3-60-012', '2018-3-60-012@std.ewubd.edu', '2002-04-11', 'CSE301-3', 'student');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_tbl`
--

CREATE TABLE `teacher_tbl` (
  `teacher_id` int(11) NOT NULL,
  `teacher_name` varchar(150) NOT NULL,
  `teacher_address` text NOT NULL,
  `teacher_email` varchar(100) NOT NULL,
  `teacher_password` varchar(100) NOT NULL,
  `teacher_qualification` varchar(100) NOT NULL,
  `teacher_doj` date NOT NULL,
  `teacher_course_code` varchar(100) NOT NULL,
  `teacher_user_type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher_tbl`
--

INSERT INTO `teacher_tbl` (`teacher_id`, `teacher_name`, `teacher_address`, `teacher_email`, `teacher_password`, `teacher_qualification`, `teacher_doj`, `teacher_course_code`, `teacher_user_type`) VALUES
(2, 'Mohsin Kamal', '123/abc', 'mk@ewubd.edu', '$2y$10$1B0HI7Zmp/8uVZeHB3YmFebrqOxHSuY2dhHP7L/j6pH75k.3fGGKu', 'M.Sc', '2012-05-01', 'CSE480-2,CSE301-3', 'teacher'),
(3, 'Abdus Satter', '567/def', 'as@ewubd.edu', '$2y$10$GuHeHfE8nuiknhkZojKk2uLX5EcYnYb5nkEwhlpbsNobmbTSA349i', 'M.Sc', '2013-12-31', 'CSE480-1,CSE411-3,CSE365-1', 'teacher'),
(4, 'Ashfaqul Haque', '891/ghi', 'ah@ewubd.edu', '$2y$10$vYxsJNsS1g2bAf0ZlZDmTe0pjYLrKIIfvYAyoufNkth600DjM7g1u', 'B.Sc', '2011-05-01', 'CSE105-2', 'teacher'),
(5, 'Ridwanul Huq', '765/jkl', 'rh@ewubd.edu', '$2y$10$tjOaPh3RiernYE6XrmuVIuu3t/T/SOIg6Kc7WMRukKcGSZkG.3Bna', 'M.Sc', '2010-05-01', 'CSE225-2,CSE420-1', 'teacher');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_tbl`
--
ALTER TABLE `admin_tbl`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `attendance_tbl`
--
ALTER TABLE `attendance_tbl`
  ADD PRIMARY KEY (`attendance_id`),
  ADD KEY `attendance_tbl_ibfk_1` (`attendance_student_id`);

--
-- Indexes for table `course_tbl`
--
ALTER TABLE `course_tbl`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `student_tbl`
--
ALTER TABLE `student_tbl`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `teacher_tbl`
--
ALTER TABLE `teacher_tbl`
  ADD PRIMARY KEY (`teacher_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_tbl`
--
ALTER TABLE `admin_tbl`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `attendance_tbl`
--
ALTER TABLE `attendance_tbl`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=367;

--
-- AUTO_INCREMENT for table `course_tbl`
--
ALTER TABLE `course_tbl`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `student_tbl`
--
ALTER TABLE `student_tbl`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `teacher_tbl`
--
ALTER TABLE `teacher_tbl`
  MODIFY `teacher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
