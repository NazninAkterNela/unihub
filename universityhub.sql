-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2023 at 07:40 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `universityhub`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `forum_id` int(11) DEFAULT NULL,
  `comment` varchar(500) DEFAULT NULL,
  `commentor_id` varchar(20) DEFAULT NULL,
  `commentor_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `forum_id`, `comment`, `commentor_id`, `commentor_name`) VALUES
(21, 9, 'yes', '<br /><b>Warning</b>', 'busy banny'),
(22, 11, 'hellp', '<br /><b>Warning</b>', 'Shihab Hasan');

-- --------------------------------------------------------

--
-- Table structure for table `com_course`
--

CREATE TABLE `com_course` (
  `course_id` varchar(20) NOT NULL,
  `course_name` varchar(20) DEFAULT NULL,
  `gpa` decimal(3,2) DEFAULT NULL,
  `student_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_id` varchar(20) NOT NULL,
  `dept_name` varchar(20) DEFAULT NULL,
  `course_title` varchar(70) DEFAULT NULL,
  `prerequisite` varchar(50) NOT NULL,
  `credit` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `dept_name`, `course_title`, `prerequisite`, `credit`) VALUES
('ACT 2111', 'BBA', 'Financial and Managerial Accounting', 'None', 3),
('BDS 1201', 'BBA', 'History of the Emergence of Bangladesh', 'None', 2),
('BIO 3105', 'CSE', 'Biology for Engineers', 'None', 3),
('CSE 1110', 'CSE', 'Introduction to Computer Systems', 'None', 1),
('CSE 1111', 'CSE', 'Structured Programming Language', 'CSE 1110', 3),
('CSE 1112', 'CSE', 'Structured Programming Language Laboratory', 'CSE 1110', 1),
('CSE 1115', 'CSE', 'Object Oriented Programming', 'CSE 1111', 3),
('CSE 1116', 'CSE', 'Object Oriented Programming Lab', 'CSE 1112', 1),
('CSE 1325', 'CSE', 'Digital Logic Design', 'None', 3),
('CSE 1326', 'CSE', 'Digital Logic Design Lab', 'None', 1),
('CSE 2118', 'CSE', 'Advanced Object Oriented Programming Lab', 'CSE 1116', 1),
('CSE 2213', 'CSE', 'Discrete Mathematics', 'None', 3),
('CSE 2215', 'CSE', 'Data Structure and Algorithms I', 'CSE 1111, CSE 1115', 3),
('CSE 2216', 'CSE', 'Data Structure and Algorithms I Laboratory', 'CSE 1112, CSE 1116', 1),
('CSE 2217', 'CSE', 'Data Structure and Algorithms II', 'CSE 2215', 3),
('CSE 2218', 'CSE', 'Data Structure and Algorithms II Laboratory', 'CSE 2216', 1),
('CSE 2233', 'CSE', 'Theory of Computation ', 'None', 3),
('CSE 236', 'CSE', 'Assembly Programming Lab', 'None', 1),
('CSE 3313', 'CSE', 'Computer Architecture', 'CSE 1325, CSE 1326', 3),
('CSE 3411', 'CSE', 'System Analysis and Design', 'CSE 3521/CSI 221', 3),
('CSE 3412', 'CSE', 'System Analysis and Design Lab', 'CSE 3522/CSI 222', 1),
('CSE 3421', 'CSE', 'Software Engineering', 'CSE 3411', 3),
('CSE 3422', 'CSE', 'Software Engineering Lab', 'CSE 3412', 1),
('CSE 3522', 'CSE', 'Database Management Systems Lab', 'None', 1),
('CSE 3711', 'CSE', 'Computer Networks', 'None', 3),
('CSE 3712', 'CSE', 'Computer Networks Lab', 'None', 1),
('CSE 3715', 'CSE', 'Data Communication', 'None', 3),
('CSE 3811', 'CSE', 'Artificial Intelligence', 'CSI 227', 3),
('CSE 3812', 'CSE', 'Artificial Intelligence Lab', 'CSI 228', 1),
('CSE 4000 A', 'CSE', 'Final Year Design Project - I', 'None', 2),
('CSE 4000 B', 'CSE', 'Final Year Design Project - II', 'CSE 4000 A', 2),
('CSE 430', 'CSE', 'Digital System Design Lab', 'CSE 426', 1),
('CSE 4325', 'CSE', 'Microprocessor, Microcontroller and Interfacing', 'CSE 3313', 3),
('CSE 4326', 'CSE', 'Microprocessor, Microcontroller and Interfacing Lab', 'EEE 2124, CSE 236', 1),
('CSE 4329', 'CSE', 'Digital System Design', 'CSE 3313', 3),
('CSE 4509', 'CSE', 'Operating Systems Concept', 'None', 3),
('CSE 4510', 'CSE', 'Operating Systems Concept Lab', 'None', 1),
('CSE 4531', 'CSE', 'Computer Security', 'CSE 3711 / CSE 323', 3),
('CSE 4611', 'CSE', 'Compiler Design', 'CSE 2233', 3),
('CSI 221', 'CSE', 'Database Management Systems', 'None', 3),
('CSI 229', 'CSE', 'Numerical Methods', 'MATH 183', 3),
('CSI 412', 'CSE', 'Compiler Lab', 'CSI 122, CSI 233', 1),
('ECO 4101', 'BBA', 'Economics', 'None', 3),
('EEE 2113', 'EEE', 'Electrical Circuits', 'None', 3),
('EEE 2123', 'EEE', 'Electronics', 'EEE 2113/CSE 113', 3),
('EEE 2124', 'EEE', 'Electronics Lab', 'EEE 2113/CSE 113', 1),
('EEE 4261', 'EEE', 'Green Computing', 'None', 3),
('ENG 1105', 'CSE', 'Intensive English I', 'None', 4.5),
('ENG 1207', 'CSE', 'Intensive English II', 'ENG 1105', 4.5),
('IPE 3401', 'CSE', 'Industrial and Operational Management', 'None', 3),
('MATH 1151', 'CSE', 'Fundamental Calculus', 'None', 3),
('MATH 187', 'CSE', 'Fourier and Laplace Trans. and Complex Variables', 'MATH 183', 3),
('MATH 2183', 'CSE', 'Calculus and Linear Algebra', 'MATH 1151, MATH 003, MATH 151', 3),
('MATH 2201', 'CSE', 'Coordinate Geometry and Vector Analysis', 'MATH 1151', 3),
('MATH 2205', 'CSE', 'Probability and Statistics', 'MATH 1151', 3),
('PHY 2105', 'CSE', 'Physics', 'None', 3),
('PHY 2106', 'CSE', 'Physics Lab', 'None', 1),
('PSY 2101', 'CSE', 'Psychology', 'None', 3),
('SOC 2101', 'CSE', 'Society, Environment and Engineering Ethics', 'None', 3),
('TEC 2499', 'CSE', 'Technology Entrepreneurship', 'None', 3),
('URC 1101', 'CSE', 'Life Skills for Success', 'None', 2);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `dept_name` varchar(20) NOT NULL,
  `university_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dept_name`, `university_name`) VALUES
('BBA', 'United International University'),
('CSE', 'Ahsanullah University of Science and Technology'),
('CSE', 'American International University-Bangladesh'),
('CSE', 'BRAC University'),
('CSE', 'Daffodil International University'),
('CSE', 'Green University of Bangladesh'),
('CSE', 'Independent University Bangladesh'),
('CSE', 'North South University'),
('CSE', 'United International University'),
('EEE', 'United International University'),
('Pharmacy', 'East West University');

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `faculty_id` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `rating` decimal(1,0) DEFAULT NULL,
  `university_name` varchar(50) NOT NULL,
  `TA_needed` tinyint(1) DEFAULT NULL,
  `gender` varchar(20) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `state` varchar(20) DEFAULT NULL,
  `city` varchar(20) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `experience` int(11) DEFAULT NULL,
  `contact_number` varchar(50) DEFAULT NULL,
  `dept` varchar(20) DEFAULT NULL,
  `research` varchar(50) DEFAULT NULL,
  `works_for` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`firstname`, `lastname`, `faculty_id`, `email`, `rating`, `university_name`, `TA_needed`, `gender`, `user_id`, `state`, `city`, `start_date`, `end_date`, `experience`, `contact_number`, `dept`, `research`, `works_for`) VALUES
('Akib', 'Zaman', '022201', 'busybanny@gmail.com', NULL, 'United International University', NULL, 'Select', '022201', NULL, 'Dhaka', NULL, NULL, 5, '01631898367', 'Select your Departme', '', '3');

-- --------------------------------------------------------

--
-- Table structure for table `follower`
--

CREATE TABLE `follower` (
  `username` varchar(20) NOT NULL,
  `follower` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `follower`
--

INSERT INTO `follower` (`username`, `follower`) VALUES
('011193040', '011193041'),
('011193041', '011193041');

-- --------------------------------------------------------

--
-- Table structure for table `forum`
--

CREATE TABLE `forum` (
  `forum_id` int(11) NOT NULL,
  `creator_id` varchar(20) DEFAULT NULL,
  `content` varchar(1000) DEFAULT NULL,
  `creator_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `forum`
--

INSERT INTO `forum` (`forum_id`, `creator_id`, `content`, `creator_name`) VALUES
(7, '022201', 'good morning everyone.', 'Akib Zaman'),
(10, '011193040', 'How can I improve my coding skill\r\n', 'Rokibul Hasan'),
(11, '011193041', 'Hi', 'Shihab Hasan'),
(12, '011193042', 'Name some good thesis topics.', 'Sajeeb Sarkar');

-- --------------------------------------------------------

--
-- Table structure for table `home_tutor`
--

CREATE TABLE `home_tutor` (
  `contact_number` varchar(11) NOT NULL,
  `student_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `home_tutor`
--

INSERT INTO `home_tutor` (`contact_number`, `student_id`) VALUES
('0129324', '011193019'),
('0129325', '011193021'),
('0129326', '011193022');

-- --------------------------------------------------------

--
-- Table structure for table `home_tutor_subject`
--

CREATE TABLE `home_tutor_subject` (
  `subject` varchar(20) NOT NULL,
  `student_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `home_tutor_subject`
--

INSERT INTO `home_tutor_subject` (`subject`, `student_id`) VALUES
('Bangla', '011193019'),
('Bangla', '011193021'),
('English', '011193022'),
('ICT', '011193019'),
('Math', '011193021'),
('Math', '011193022'),
('Physics', '011193019');

-- --------------------------------------------------------

--
-- Table structure for table `logger`
--

CREATE TABLE `logger` (
  `username` varchar(50) NOT NULL,
  `time` varchar(50) NOT NULL,
  `block_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `logger`
--

INSERT INTO `logger` (`username`, `time`, `block_status`) VALUES
('root', '02:54:28pm 2023/04/07', 0),
('root', '02:56:26pm 2023/04/07', 0),
('011193043', '02:59:07pm 2023/04/07', 0),
('admin', '03:26:29pm 2023/04/07', 0),
('011193043', '03:31:19pm 2023/04/07', 0),
('admin', '03:37:05pm 2023/04/07', 0),
('011193040', '10:11:44am 2023/04/09', 0),
('011193041', '10:13:50am 2023/04/09', 0),
('011193040', '07:11:27pm 2023/04/10', 0),
('011193040', '07:16:29pm 2023/04/10', 0),
('022201', '08:22:12pm 2023/04/10', 0),
('011193040', '08:50:06pm 2023/04/10', 0),
('022201', '10:16:19pm 2023/04/15', 0),
('011193040', '10:40:39pm 2023/04/15', 0),
('admin', '11:37:49pm 2023/04/15', 0),
('011193040', '01:47:40am 2023/04/16', 0),
('022201', '03:26:41am 2023/04/16', 0),
('011193', '07:41:15am 2023/04/16', 0),
('011193', '07:46:15am 2023/04/16', 0),
('011193042', '08:07:17am 2023/04/16', 0),
('011193042', '09:36:02am 2023/04/16', 0),
('011193042', '02:50:40pm 2023/04/17', 0),
('022201', '06:11:45pm 2023/04/17', 0);

-- --------------------------------------------------------

--
-- Table structure for table `online_lectures`
--

CREATE TABLE `online_lectures` (
  `youtubeId` varchar(50) NOT NULL,
  `courseCode` varchar(50) NOT NULL,
  `courseName` varchar(100) NOT NULL,
  `facultyId` varchar(20) NOT NULL,
  `facultyName` varchar(50) NOT NULL,
  `videoName` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `online_lectures`
--

INSERT INTO `online_lectures` (`youtubeId`, `courseCode`, `courseName`, `facultyId`, `facultyName`, `videoName`) VALUES
('1wMHHbBg9wo', 'CSE 1115', 'Object Oriented Programming', '022123', 'Sharirar Alam', 'lecture video #01'),
('5sH2WHxApTE', 'CSE 1115', 'Object Oriented Programming', 'Akib Zaman', 'Akib Zaman', '5sH2WHxApTE'),
('asSTsLoPZTM', 'CSE 1115', 'Object Oriented Programming', '022123', 'Sharirar Alam', 'lecture video #02'),
('hvbCvpnvMaY', 'CSE 1115', 'Object Oriented Programming', 'Akib Zaman', 'Akib Zaman', 'hvbCvpnvMaY'),
('jQPpg_BZN4w', 'CSE 1115', 'Object Oriented Programming', '022123', 'Sharirar Alam', 'lecture video #03'),
('NpXbckymq5E', 'CSE 1115', 'Object Oriented Programming', '022123', 'Sharirar Alam', 'lecture video #04'),
('oFAWd4l9zQE', 'CSE 1115', 'Object Oriented Programming', 'Akib Zaman', 'Akib Zaman', 'oFAWd4l9zQE'),
('sGqUBTWxYj4', 'CSE 1115', 'Object Oriented Programming', 'Akib Zaman', 'Akib Zaman', 'sGqUBTWxYj4'),
('xLetJpcjHS0', 'CSE 2215', 'Data Structure and Algorithms I', 'Akib Zaman', 'Akib Zaman', 'xLetJpcjHS0'),
('ZaQ9Br0-Sbo', 'CSE 1115', 'Object Oriented Programming', 'Akib Zaman', 'Akib Zaman', 'ZaQ9Br0-Sbo');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `productid` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `seller` varchar(255) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `image` varchar(400) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `price` decimal(12,2) DEFAULT NULL,
  `used` int(11) DEFAULT NULL,
  `state` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`productid`, `title`, `seller`, `contact`, `email`, `image`, `description`, `price`, `used`, `state`) VALUES
(1, 'Servo Motor', 'Shihab', '017231', 'shihab@gmail.com', 'images/dTthZoCS/servo.jpg', '', '60.00', 21, NULL),
(2, 'IR Sensor', 'Abrar', '0111223', 'kh.abrarr@gmail.com', 'images/KKaDHQFL/irsensor.jpg', '', '70.00', 112, NULL),
(3, 'Relay Switch', 'Sajeeb', '012312', 'sajeb@gmail.com', 'images/SFJ55zzd/relay.jpg', '', '23.00', 12, NULL),
(4, 'Arduino', 'Khandaker Abrar', '01970235545', 'kh.abrarr@gmail.com', 'images/T0JIa8cg/ArduinoR3.jpg', '', '32.00', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `running_course`
--

CREATE TABLE `running_course` (
  `course_id` varchar(20) NOT NULL,
  `course_title` varchar(50) DEFAULT NULL,
  `student_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `running_course`
--

INSERT INTO `running_course` (`course_id`, `course_title`, `student_id`) VALUES
('CSE 2233', 'Computer Architecture', '011193027'),
('CSE 2233', 'Computer Architecture', '011193042'),
('CSE 2233', 'Computer Architecture', '011193046'),
('CSE 3401', 'Industrial and Operational Management', '011193019'),
('CSE 3401', 'Industrial and Operational Management', '011193027'),
('CSE 3401', 'Industrial and Operational Management', '011193042'),
('CSE 3401', 'Industrial and Operational Management', '011193046'),
('CSE 3521', 'Database Management System', '011193019'),
('CSE 3521', 'Database Management System', '011193027'),
('CSE 3521', 'Database Management System', '011193042'),
('CSE 3521', 'Database Management System', '011193046'),
('CSE 3522', 'Database Management Systems Laboratory', '011193019'),
('CSE 3522', 'Database Management Systems Laboratory', '011193027'),
('CSE 3522', 'Database Management Systems Laboratory', '011193042'),
('CSE 3522', 'Database Management Systems Laboratory', '011193046'),
('EEE 2123', 'Electronics', '011193019'),
('EEE 2123', 'Electronics', '011193027'),
('EEE 2123', 'Electronics', '011193042'),
('EEE 2123', 'Electronics', '011193046'),
('EEE 2233', 'Computer Architecture', '011193019');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `student_id` varchar(20) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `university_name` varchar(50) NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `home_tutor` tinyint(1) DEFAULT NULL,
  `TA` varchar(20) DEFAULT NULL,
  `city` varchar(20) DEFAULT NULL,
  `user_id` varchar(20) NOT NULL,
  `contact_number` varchar(20) DEFAULT NULL,
  `dept` varchar(20) DEFAULT NULL,
  `cgpa` decimal(3,2) DEFAULT NULL,
  `current_semester` varchar(20) DEFAULT NULL,
  `credit_completed` int(3) DEFAULT NULL,
  `RA` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `firstname`, `lastname`, `email`, `university_name`, `date_of_birth`, `gender`, `home_tutor`, `TA`, `city`, `user_id`, `contact_number`, `dept`, `cgpa`, `current_semester`, `credit_completed`, `RA`) VALUES
('011193', 'Khandaker', 'Abrar', 'kh.abrarr@gmail.com', 'United International University', NULL, '', NULL, NULL, NULL, '011193', NULL, 'Choose...', NULL, NULL, NULL, NULL),
('011193040', 'Rokibul', 'Hasan', 'rokib16x@gmail.com', 'United International University', '1999-11-16', 'Male', NULL, 'yes', 'Dhaka', '011193040', '01631898367', 'CSE', '3.43', '11', 94, 'yes'),
('011193041', 'Shihab', 'Hasan', 'enderboyrokib@gmail.com', 'United International University', NULL, '', NULL, NULL, NULL, '011193041', NULL, 'CSE', NULL, NULL, NULL, NULL),
('011193042', 'Sajeeb', 'Sarkar', 'busybanny@gmail.com', 'United International University', NULL, '', NULL, NULL, NULL, '011193042', NULL, 'CE', NULL, NULL, NULL, NULL),
('011193043', 'busy', 'banny', 'busybanny@gmail.com', 'United International University', '0000-00-00', 'Select', NULL, NULL, '', '011193043', '', 'Select your Departme', '4.00', '10', 92, NULL),
('011193046', 'Kh', 'Abrar', 'kh.abrar@gmail.com', 'United International University', NULL, '', NULL, NULL, NULL, '011193046', NULL, 'CSE', NULL, NULL, NULL, NULL),
('admin', 'Admin', '01', 'busybanny@gmail.com', 'United International University', NULL, '', NULL, NULL, NULL, 'admin', NULL, 'CSE', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `student_user`
--

CREATE TABLE `student_user` (
  `user_id` varchar(20) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `2FA_code` varchar(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_user`
--

INSERT INTO `student_user` (`user_id`, `password`, `2FA_code`) VALUES
('011193042', 'Sajeeb123$', '9007'),
(NULL, NULL, '2442'),
('011193043', 'Busy1234$', '3074'),
('admin', 'Admin123$', '4818'),
('011193040', '22gifta59E@', '6796'),
('011193041', '22gifta59E@', '4134'),
('011193046', '@@BBcc19', '4585'),
('011193', '@@BBcc19', '0579');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_user`
--

CREATE TABLE `teacher_user` (
  `user_id` varchar(20) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `2FA_code` varchar(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teacher_user`
--

INSERT INTO `teacher_user` (`user_id`, `password`, `2FA_code`) VALUES
('022201', 'Abik124$', '0898');

-- --------------------------------------------------------

--
-- Table structure for table `teaches`
--

CREATE TABLE `teaches` (
  `faculty_id` varchar(20) NOT NULL,
  `course_id` varchar(20) NOT NULL,
  `course_title` varchar(50) NOT NULL,
  `semester` varchar(20) NOT NULL,
  `year` int(4) NOT NULL,
  `university` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `university`
--

CREATE TABLE `university` (
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `university`
--

INSERT INTO `university` (`name`) VALUES
('Ahsanullah University of Science and Technology'),
('American International University-Bangladesh'),
('BRAC University'),
('Daffodil International University'),
('East West University'),
('Green University of Bangladesh'),
('Independent University Bangladesh'),
('North South University'),
('Southeast University'),
('Stamford University Bangladesh'),
('State University of Bangladesh'),
('United International University');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `forum_id` (`forum_id`);

--
-- Indexes for table `com_course`
--
ALTER TABLE `com_course`
  ADD PRIMARY KEY (`course_id`,`student_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`dept_name`,`university_name`),
  ADD KEY `fk_university` (`university_name`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`faculty_id`),
  ADD UNIQUE KEY `faculty_id` (`faculty_id`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD KEY `fk_university_name2` (`university_name`);

--
-- Indexes for table `follower`
--
ALTER TABLE `follower`
  ADD PRIMARY KEY (`username`,`follower`);

--
-- Indexes for table `forum`
--
ALTER TABLE `forum`
  ADD PRIMARY KEY (`forum_id`),
  ADD KEY `creator_id` (`creator_id`);

--
-- Indexes for table `home_tutor`
--
ALTER TABLE `home_tutor`
  ADD PRIMARY KEY (`student_id`),
  ADD UNIQUE KEY `contact_number` (`contact_number`);

--
-- Indexes for table `home_tutor_subject`
--
ALTER TABLE `home_tutor_subject`
  ADD PRIMARY KEY (`subject`,`student_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `online_lectures`
--
ALTER TABLE `online_lectures`
  ADD PRIMARY KEY (`youtubeId`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`productid`);

--
-- Indexes for table `running_course`
--
ALTER TABLE `running_course`
  ADD PRIMARY KEY (`course_id`,`student_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `teaches`
--
ALTER TABLE `teaches`
  ADD PRIMARY KEY (`faculty_id`,`course_id`,`course_title`,`semester`,`year`,`university`),
  ADD KEY `university` (`university`);

--
-- Indexes for table `university`
--
ALTER TABLE `university`
  ADD PRIMARY KEY (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `forum`
--
ALTER TABLE `forum`
  MODIFY `forum_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `productid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `teaches`
--
ALTER TABLE `teaches`
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`faculty_id`) REFERENCES `faculty` (`faculty_id`),
  ADD CONSTRAINT `teaches_ibfk_1` FOREIGN KEY (`university`) REFERENCES `university` (`name`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
