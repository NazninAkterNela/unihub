CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `forum_id` int(11) DEFAULT NULL,
  `comment` varchar(500) DEFAULT NULL,
  `commentor_id` varchar(20) DEFAULT NULL,
  `commentor_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
CREATE TABLE `com_course` (
  `course_id` varchar(20) NOT NULL,
  `course_name` varchar(20) DEFAULT NULL,
  `gpa` decimal(3,2) DEFAULT NULL,
  `student_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `courses` (
  `course_id` varchar(20) NOT NULL,
  `dept_name` varchar(20) DEFAULT NULL,
  `course_title` varchar(70) DEFAULT NULL,
  `prerequisite` varchar(50) NOT NULL,
  `credit` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `department` (
  `dept_name` varchar(20) NOT NULL,
  `university_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

INSERT INTO `faculty` (`firstname`, `lastname`, `faculty_id`, `email`, `rating`, `university_name`, `TA_needed`, `gender`, `user_id`, `state`, `city`, `start_date`, `end_date`, `experience`, `contact_number`, `dept`, `research`, `works_for`) VALUES
('Akib', 'Zaman', '022201', 'busybanny@gmail.com', NULL, 'United International University', NULL, 'Select', '022201', NULL, 'Dhaka', NULL, NULL, 5, '01631898367', 'Select your Departme', '', '3');

CREATE TABLE `follower` (
  `username` varchar(20) NOT NULL,
  `follower` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `forum` (
  `forum_id` int(11) NOT NULL,
  `creator_id` varchar(20) DEFAULT NULL,
  `content` varchar(1000) DEFAULT NULL,
  `creator_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
CREATE TABLE `home_tutor` (
  `contact_number` varchar(11) NOT NULL,
  `student_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `home_tutor` (`contact_number`, `student_id`) VALUES
('0129324', '011193019'),
('0129325', '011193021'),
('0129326', '011193022');

CREATE TABLE `home_tutor_subject` (
  `subject` varchar(20) NOT NULL,
  `student_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `home_tutor_subject` (`subject`, `student_id`) VALUES
('Bangla', '011193019'),
('Bangla', '011193021'),
('English', '011193022'),
('ICT', '011193019'),
('Math', '011193021'),
('Math', '011193022'),
('Physics', '011193019');

CREATE TABLE `logger` (
  `username` varchar(50) NOT NULL,
  `time` varchar(50) NOT NULL,
  `block_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `online_lectures` (
  `youtubeId` varchar(50) NOT NULL,
  `courseCode` varchar(50) NOT NULL,
  `courseName` varchar(100) NOT NULL,
  `facultyId` varchar(20) NOT NULL,
  `facultyName` varchar(50) NOT NULL,
  `videoName` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

CREATE TABLE `running_course` (
  `course_id` varchar(20) NOT NULL,
  `course_title` varchar(50) DEFAULT NULL,
  `student_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

CREATE TABLE `teacher_user` (
  `user_id` varchar(20) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `2FA_code` varchar(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `teacher_user` (`user_id`, `password`, `2FA_code`) VALUES
('022201', 'Abik124$', '0898');

CREATE TABLE `teaches` (
  `faculty_id` varchar(20) NOT NULL,
  `course_id` varchar(20) NOT NULL,
  `course_title` varchar(50) NOT NULL,
  `semester` varchar(20) NOT NULL,
  `year` int(4) NOT NULL,
  `university` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `university` (
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `forum_id` (`forum_id`);
--
ALTER TABLE `com_course`
  ADD PRIMARY KEY (`course_id`,`student_id`);
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`);
ALTER TABLE `department`
  ADD PRIMARY KEY (`dept_name`,`university_name`),
  ADD KEY `fk_university` (`university_name`);
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`faculty_id`),
  ADD UNIQUE KEY `faculty_id` (`faculty_id`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD KEY `fk_university_name2` (`university_name`);
ALTER TABLE `follower`
  ADD PRIMARY KEY (`username`,`follower`);
ALTER TABLE `forum`
  ADD PRIMARY KEY (`forum_id`),
  ADD KEY `creator_id` (`creator_id`);
ALTER TABLE `home_tutor`
  ADD PRIMARY KEY (`student_id`),
  ADD UNIQUE KEY `contact_number` (`contact_number`);
ALTER TABLE `home_tutor_subject`
  ADD PRIMARY KEY (`subject`,`student_id`),
  ADD KEY `student_id` (`student_id`);
ALTER TABLE `online_lectures`
  ADD PRIMARY KEY (`youtubeId`);
ALTER TABLE `products`
  ADD PRIMARY KEY (`productid`);
ALTER TABLE `running_course`
  ADD PRIMARY KEY (`course_id`,`student_id`),
  ADD KEY `student_id` (`student_id`);
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_id`),
  ADD UNIQUE KEY `user_id` (`user_id`);
ALTER TABLE `teaches`
  ADD PRIMARY KEY (`faculty_id`,`course_id`,`course_title`,`semester`,`year`,`university`),
  ADD KEY `university` (`university`);
ALTER TABLE `university`
  ADD PRIMARY KEY (`name`);
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
ALTER TABLE `forum`
  MODIFY `forum_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
ALTER TABLE `products`
  MODIFY `productid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
ALTER TABLE `teaches`
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`faculty_id`) REFERENCES `faculty` (`faculty_id`),
  ADD CONSTRAINT `teaches_ibfk_1` FOREIGN KEY (`university`) REFERENCES `university` (`name`);
COMMIT;



INSERT INTO online_lectures(youtubeId, courseCode, courseName, facultyId, facultyName, videoName) VALUES 
('_px61fQCXc8', 'CSE 2215', 'Data Structure and Algorithms I', '022201', 'MNH Dr. Mohammad Nurul Huda', 'Lecture 1'),
('Wx_i-pVxw4g', 'CSE 2215', 'Data Structure and Algorithms I', '022201', 'MNH Dr. Mohammad Nurul Huda', 'Lecture 2'),
('ktx0Uctwwec', 'CSE 2215', 'Data Structure and Algorithms I', '022201', 'MNH Dr. Mohammad Nurul Huda', 'Lecture 3'),
('wgUf6uaQ17w', 'CSE 2215', 'Data Structure and Algorithms I', '022201', 'MNH Dr. Mohammad Nurul Huda', 'Lecture 4'),
('Kv48fYQwG3U', 'CSE 2215', 'Data Structure and Algorithms I', '022201', 'MNH Dr. Mohammad Nurul Huda', 'Lecture 5'),
('92nk7S1ib10', 'CSE 2215', 'Data Structure and Algorithms I', '022201', 'MNH Dr. Mohammad Nurul Huda', 'Lecture 6'),
('W_FD-oNrUsg', 'CSE 2215', 'Data Structure and Algorithms I', '022201', 'MNH Dr. Mohammad Nurul Huda', 'Lecture 7'),
('LVDDLC7SJ9M', 'CSE 2215', 'Data Structure and Algorithms I', '022201', 'MNH Dr. Mohammad Nurul Huda', 'Lecture 8');