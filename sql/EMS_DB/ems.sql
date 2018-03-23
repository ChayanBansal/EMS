-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 23, 2018 at 12:05 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.0.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ems`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic_sessions`
--

CREATE TABLE `academic_sessions` (
  `ac_session_id` int(5) NOT NULL,
  `from_year` year(4) NOT NULL,
  `course_id` int(5) NOT NULL,
  `current_semester` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `academic_sessions`
--

INSERT INTO `academic_sessions` (`ac_session_id`, `from_year`, `course_id`, `current_semester`) VALUES
(1, 2016, 1, 1),
(2, 2016, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `auditing`
--

CREATE TABLE `auditing` (
  `session_id` int(11) NOT NULL,
  `sub_code` varchar(12) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `check_id` int(11) DEFAULT '0',
  `component_id` int(2) NOT NULL,
  `type_flag` int(1) NOT NULL COMMENT '[0]:Main Examination,[1]:Retotalling,[2]:Revaluation,[3]:ATKT'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `course_id` int(4) NOT NULL,
  `program` varchar(60) NOT NULL,
  `branch` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`course_id`, `program`, `branch`) VALUES
(1, 'Bachelors of Technology', 'Computer Science & Information Technology'),
(2, 'Bachelors of Business Administration', 'Retail Management'),
(3, 'Bachelors of Technology', 'Automobile'),
(4, 'Bachelors of Technology', 'Mechatronics'),
(5, 'Bachelors of Business Administration', 'Banking Financial services and Insurance'),
(6, 'Masters of Business Administration', 'Banking Financial services and Insurance');

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `chat_id` int(10) NOT NULL,
  `sender` varchar(60) NOT NULL,
  `receiver` varchar(60) NOT NULL,
  `msg` varchar(500) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `checking`
--

CREATE TABLE `checking` (
  `check_id` int(11) NOT NULL,
  `operator_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `remark` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `component`
--

CREATE TABLE `component` (
  `component_id` int(2) NOT NULL,
  `component_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `component`
--

INSERT INTO `component` (`component_id`, `component_name`) VALUES
(1, 'Continuous Assessment Theory '),
(2, 'End Semester Theory'),
(3, 'Continuous Assessment Practical'),
(4, 'End Semester Practical'),
(5, 'Industry Assessment'),
(6, 'Internal Examination');

-- --------------------------------------------------------

--
-- Table structure for table `component_distribution`
--

CREATE TABLE `component_distribution` (
  `component_id` int(2) NOT NULL,
  `sub_id` int(5) NOT NULL,
  `passing_marks` decimal(7,4) NOT NULL,
  `max_marks` decimal(7,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `component_distribution`
--

INSERT INTO `component_distribution` (`component_id`, `sub_id`, `passing_marks`, `max_marks`) VALUES
(1, 1, '20.0000', '50.0000'),
(2, 1, '20.0000', '50.0000'),
(3, 2, '16.0000', '40.0000'),
(4, 2, '16.0000', '40.0000'),
(5, 2, '8.0000', '20.0000'),
(6, 3, '40.0000', '100.0000');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_id` int(4) NOT NULL,
  `school_id` int(11) NOT NULL,
  `level_id` int(1) NOT NULL,
  `course_name` varchar(300) NOT NULL,
  `duration` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `school_id`, `level_id`, `course_name`, `duration`) VALUES
(1, 1, 1, 'Bachelors of Technology Computer Science & Information Technology', 4),
(2, 4, 1, 'Bachelors of Business Administration Retail Management', 3),
(3, 2, 1, 'Bachelors of Technology Automobile', 4),
(4, 2, 1, 'Bachelors of Technology Mechatronics', 4),
(5, 3, 1, 'Bachelors of Business Administration Banking Financial services and Insurance', 3),
(6, 3, 2, 'Masters of Business Administration Banking Financial services and Insurance', 2);

-- --------------------------------------------------------

--
-- Table structure for table `course_level`
--

CREATE TABLE `course_level` (
  `level_id` int(1) NOT NULL,
  `level_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course_level`
--

INSERT INTO `course_level` (`level_id`, `level_name`) VALUES
(1, 'Undergraduate'),
(2, 'Postgraduate');

-- --------------------------------------------------------

--
-- Table structure for table `detained_subject`
--

CREATE TABLE `detained_subject` (
  `roll_id` int(11) NOT NULL,
  `detained_sub_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `edit_tr_request`
--

CREATE TABLE `edit_tr_request` (
  `request_id` int(11) NOT NULL,
  `requester` int(3) NOT NULL,
  `roll_id` int(11) NOT NULL,
  `sub_code` varchar(10) NOT NULL,
  `cat_flag` tinyint(1) NOT NULL,
  `end_theory_flag` tinyint(1) NOT NULL,
  `cap_flag` tinyint(1) NOT NULL,
  `end_practical_flag` tinyint(1) NOT NULL,
  `ia_flag` tinyint(1) NOT NULL,
  `ie_flag` tinyint(1) NOT NULL,
  `remarks` varchar(300) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(1) NOT NULL DEFAULT '0' COMMENT '0:No action taken; 1:Approved; 2:Disapproved; 3:Closed'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `elective_map`
--

CREATE TABLE `elective_map` (
  `enrol_no` varchar(12) NOT NULL,
  `elective_sub_code` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `exam_month_year`
--

CREATE TABLE `exam_month_year` (
  `session_id` int(11) NOT NULL,
  `month_year` varchar(30) NOT NULL,
  `type_flag` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `exam_summary`
--

CREATE TABLE `exam_summary` (
  `roll_id` int(10) NOT NULL,
  `total_credits_earned` int(3) NOT NULL,
  `total_gpv_earned` int(3) NOT NULL,
  `sgpa` decimal(6,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `failure_report`
--

CREATE TABLE `failure_report` (
  `roll_id` int(10) NOT NULL,
  `sub_id` int(5) NOT NULL,
  `component_id` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `issue_summary`
--

CREATE TABLE `issue_summary` (
  `session_id` int(5) NOT NULL,
  `notification_date` date NOT NULL,
  `type_flag` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `operators`
--

CREATE TABLE `operators` (
  `operator_id` int(3) NOT NULL,
  `operator_name` varchar(500) NOT NULL,
  `operator_email` varchar(30) NOT NULL,
  `operator_username` varchar(200) NOT NULL,
  `operator_password` varchar(200) NOT NULL,
  `operator_active` tinyint(1) NOT NULL DEFAULT '0',
  `locked` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `operators`
--

INSERT INTO `operators` (`operator_id`, `operator_name`, `operator_email`, `operator_username`, `operator_password`, `operator_active`, `locked`) VALUES
(2, 'operator', 'operator', 'operator', '5f4dcc3b5aa765d61d8327deb882cf99', 1, 0),
(4, 'Samyak', 'captainsamyak@gmail.com', 'captainsamyak', '296a154b460501a3ca3144c9f8a9d1d7', 0, 0),
(5, 'Samyak Jain', 'jainsamyak330@s.co', 'jainsamyak330', '5e3afa2252e7a70d135dd2447a112b22', 0, 0),
(6, 'Chayan Bansal', 'bansalc10@gmail.com', 'bansalc10', '5f4dcc3b5aa765d61d8327deb882cf99', 1, 0),
(7, 'Raghav', 'raghav.mundhra3011@gmail.com', 'raghav.mundhra3011', '9460d2107460db9c63715141329e96de', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `roll_list`
--

CREATE TABLE `roll_list` (
  `roll_id` int(10) NOT NULL,
  `enrol_no` varchar(12) NOT NULL,
  `semester` int(1) NOT NULL,
  `atkt_flag` tinyint(1) NOT NULL,
  `serial_no` decimal(8,0) DEFAULT NULL,
  `no_prints` int(3) NOT NULL DEFAULT '0',
  `retotal_reg_flag` int(1) NOT NULL DEFAULT '0',
  `reval_reg_flag` int(1) NOT NULL DEFAULT '0',
  `atkt_reg_flag` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roll_list`
--

INSERT INTO `roll_list` (`roll_id`, `enrol_no`, `semester`, `atkt_flag`, `serial_no`, `no_prints`, `retotal_reg_flag`, `reval_reg_flag`, `atkt_reg_flag`) VALUES
(1, '2016ab001010', 1, 0, '1', 0, 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `schools`
--

CREATE TABLE `schools` (
  `school_id` int(11) NOT NULL,
  `school_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schools`
--

INSERT INTO `schools` (`school_id`, `school_name`) VALUES
(1, 'School of Computer Science & Information Technology'),
(2, 'School of Automobile & Mechatronics Engineering'),
(3, 'School of Banking, Financial Services, Insurance'),
(4, 'School of Retail Management'),
(5, 'School of Construction Engineering & Management');

-- --------------------------------------------------------

--
-- Table structure for table `score`
--

CREATE TABLE `score` (
  `roll_id` int(10) NOT NULL,
  `component_id` int(2) NOT NULL,
  `sub_id` int(5) NOT NULL,
  `marks` decimal(7,4) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `check_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `enrol_no` varchar(12) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `father_name` varchar(255) NOT NULL,
  `mother_name` varchar(255) NOT NULL,
  `address` varchar(500) NOT NULL,
  `gender` char(1) NOT NULL,
  `stud_mobile` varchar(10) NOT NULL,
  `guardian_mobile` varchar(10) DEFAULT NULL,
  `to_year` year(4) NOT NULL,
  `cgpa` decimal(6,4) DEFAULT NULL,
  `ac_session_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`enrol_no`, `first_name`, `middle_name`, `last_name`, `father_name`, `mother_name`, `address`, `gender`, `stud_mobile`, `guardian_mobile`, `to_year`, `cgpa`, `ac_session_id`) VALUES
('2016ab001010', 'test', 'test', 'test', 'test', 'test', 'test', 'M', '9999999999', NULL, 2020, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `sub_code` varchar(10) NOT NULL,
  `sub_name` varchar(255) NOT NULL,
  `total_credits` int(2) NOT NULL,
  `ie_flag` int(11) NOT NULL,
  `elective_flag` tinyint(1) NOT NULL DEFAULT '0',
  `ac_session_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`sub_code`, `sub_name`, `total_credits`, `ie_flag`, `elective_flag`, `ac_session_id`) VALUES
('BTCS01CC01', 'Applied Mathematics', 5, 0, 0, 1),
('BTCS01CC02', 'PPM Management', 0, 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sub_distribution`
--

CREATE TABLE `sub_distribution` (
  `sub_id` int(5) NOT NULL,
  `sub_code` varchar(10) NOT NULL,
  `practical_flag` tinyint(1) NOT NULL,
  `credits_allotted` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_distribution`
--

INSERT INTO `sub_distribution` (`sub_id`, `sub_code`, `practical_flag`, `credits_allotted`) VALUES
(1, 'BTCS01CC01', 0, 2),
(2, 'BTCS01CC01', 1, 3),
(3, 'BTCS01CC02', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `super_admin`
--

CREATE TABLE `super_admin` (
  `super_admin_id` int(1) NOT NULL,
  `super_admin_name` varchar(200) NOT NULL,
  `super_admin_email` varchar(30) NOT NULL,
  `super_admin_username` varchar(200) NOT NULL,
  `super_admin_password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `super_admin`
--

INSERT INTO `super_admin` (`super_admin_id`, `super_admin_name`, `super_admin_email`, `super_admin_username`, `super_admin_password`) VALUES
(1, 'SuperAdmin', 'super@test.com', '17c4520f6cfd1ab53d8745e84681eb49', '874fcc6e14275dde5a23319c9ce5f8e4');

-- --------------------------------------------------------

--
-- Table structure for table `tr`
--

CREATE TABLE `tr` (
  `roll_id` int(10) NOT NULL,
  `sub_id` int(5) NOT NULL,
  `cat_cap` decimal(7,4) DEFAULT NULL,
  `ia` decimal(7,4) DEFAULT NULL,
  `end_sem` decimal(7,4) DEFAULT NULL,
  `ie` decimal(7,4) DEFAULT NULL,
  `total` decimal(7,4) NOT NULL,
  `percent` decimal(7,4) NOT NULL,
  `grade` char(2) NOT NULL,
  `gp` int(2) NOT NULL,
  `cr` int(2) NOT NULL,
  `gpv` decimal(7,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `transaction_id` int(11) NOT NULL,
  `operator_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `remark` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academic_sessions`
--
ALTER TABLE `academic_sessions`
  ADD PRIMARY KEY (`ac_session_id`),
  ADD UNIQUE KEY `from_year` (`from_year`,`course_id`,`current_semester`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `auditing`
--
ALTER TABLE `auditing`
  ADD PRIMARY KEY (`session_id`,`type_flag`),
  ADD KEY `check_id` (`check_id`),
  ADD KEY `transaction_id` (`transaction_id`),
  ADD KEY `component_id` (`component_id`),
  ADD KEY `sub_code` (`sub_code`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`chat_id`);

--
-- Indexes for table `checking`
--
ALTER TABLE `checking`
  ADD PRIMARY KEY (`check_id`),
  ADD KEY `operator_id` (`operator_id`);

--
-- Indexes for table `component`
--
ALTER TABLE `component`
  ADD PRIMARY KEY (`component_id`);

--
-- Indexes for table `component_distribution`
--
ALTER TABLE `component_distribution`
  ADD PRIMARY KEY (`component_id`,`sub_id`),
  ADD KEY `sub_id` (`sub_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`),
  ADD KEY `level_id` (`level_id`),
  ADD KEY `school_id` (`school_id`);

--
-- Indexes for table `course_level`
--
ALTER TABLE `course_level`
  ADD PRIMARY KEY (`level_id`);

--
-- Indexes for table `detained_subject`
--
ALTER TABLE `detained_subject`
  ADD PRIMARY KEY (`roll_id`,`detained_sub_id`),
  ADD KEY `detained_sub_id` (`detained_sub_id`);

--
-- Indexes for table `edit_tr_request`
--
ALTER TABLE `edit_tr_request`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `requester` (`requester`),
  ADD KEY `roll_id` (`roll_id`),
  ADD KEY `sub_code` (`sub_code`);

--
-- Indexes for table `elective_map`
--
ALTER TABLE `elective_map`
  ADD PRIMARY KEY (`enrol_no`,`elective_sub_code`),
  ADD KEY `elective_sub_code` (`elective_sub_code`);

--
-- Indexes for table `exam_month_year`
--
ALTER TABLE `exam_month_year`
  ADD PRIMARY KEY (`session_id`,`type_flag`);

--
-- Indexes for table `exam_summary`
--
ALTER TABLE `exam_summary`
  ADD PRIMARY KEY (`roll_id`);

--
-- Indexes for table `failure_report`
--
ALTER TABLE `failure_report`
  ADD PRIMARY KEY (`roll_id`,`sub_id`,`component_id`);

--
-- Indexes for table `issue_summary`
--
ALTER TABLE `issue_summary`
  ADD PRIMARY KEY (`session_id`,`type_flag`);

--
-- Indexes for table `operators`
--
ALTER TABLE `operators`
  ADD PRIMARY KEY (`operator_id`),
  ADD UNIQUE KEY `operator_username` (`operator_username`);

--
-- Indexes for table `roll_list`
--
ALTER TABLE `roll_list`
  ADD PRIMARY KEY (`roll_id`),
  ADD KEY `enrol_no` (`enrol_no`);

--
-- Indexes for table `schools`
--
ALTER TABLE `schools`
  ADD PRIMARY KEY (`school_id`);

--
-- Indexes for table `score`
--
ALTER TABLE `score`
  ADD PRIMARY KEY (`roll_id`,`component_id`,`sub_id`),
  ADD KEY `sub_id` (`sub_id`),
  ADD KEY `transaction_id` (`transaction_id`),
  ADD KEY `check_id` (`check_id`),
  ADD KEY `component_id` (`component_id`,`sub_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`enrol_no`),
  ADD KEY `ac_session_id` (`ac_session_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`sub_code`,`ac_session_id`),
  ADD KEY `ac_session_id` (`ac_session_id`);

--
-- Indexes for table `sub_distribution`
--
ALTER TABLE `sub_distribution`
  ADD PRIMARY KEY (`sub_id`),
  ADD KEY `sub_code` (`sub_code`);

--
-- Indexes for table `super_admin`
--
ALTER TABLE `super_admin`
  ADD PRIMARY KEY (`super_admin_id`);

--
-- Indexes for table `tr`
--
ALTER TABLE `tr`
  ADD PRIMARY KEY (`roll_id`,`sub_id`),
  ADD KEY `sub_id` (`sub_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `operator_id` (`operator_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academic_sessions`
--
ALTER TABLE `academic_sessions`
  MODIFY `ac_session_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `chat_id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `checking`
--
ALTER TABLE `checking`
  MODIFY `check_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `component`
--
ALTER TABLE `component`
  MODIFY `component_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `course_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `edit_tr_request`
--
ALTER TABLE `edit_tr_request`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `operators`
--
ALTER TABLE `operators`
  MODIFY `operator_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `roll_list`
--
ALTER TABLE `roll_list`
  MODIFY `roll_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `schools`
--
ALTER TABLE `schools`
  MODIFY `school_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `sub_distribution`
--
ALTER TABLE `sub_distribution`
  MODIFY `sub_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `super_admin`
--
ALTER TABLE `super_admin`
  MODIFY `super_admin_id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `academic_sessions`
--
ALTER TABLE `academic_sessions`
  ADD CONSTRAINT `academic_sessions_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`);

--
-- Constraints for table `auditing`
--
ALTER TABLE `auditing`
  ADD CONSTRAINT `auditing_ibfk_1` FOREIGN KEY (`check_id`) REFERENCES `checking` (`check_id`),
  ADD CONSTRAINT `auditing_ibfk_2` FOREIGN KEY (`component_id`) REFERENCES `component` (`component_id`),
  ADD CONSTRAINT `auditing_ibfk_4` FOREIGN KEY (`sub_code`) REFERENCES `subjects` (`sub_code`),
  ADD CONSTRAINT `auditing_ibfk_5` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`transaction_id`);

--
-- Constraints for table `branches`
--
ALTER TABLE `branches`
  ADD CONSTRAINT `branches_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`);

--
-- Constraints for table `checking`
--
ALTER TABLE `checking`
  ADD CONSTRAINT `checking_ibfk_1` FOREIGN KEY (`operator_id`) REFERENCES `operators` (`operator_id`);

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `component` (`component_id`),
  ADD CONSTRAINT `courses_ibfk_2` FOREIGN KEY (`level_id`) REFERENCES `course_level` (`level_id`),
  ADD CONSTRAINT `courses_ibfk_3` FOREIGN KEY (`school_id`) REFERENCES `schools` (`school_id`);

--
-- Constraints for table `detained_subject`
--
ALTER TABLE `detained_subject`
  ADD CONSTRAINT `detained_subject_ibfk_1` FOREIGN KEY (`roll_id`) REFERENCES `roll_list` (`roll_id`),
  ADD CONSTRAINT `detained_subject_ibfk_2` FOREIGN KEY (`detained_sub_id`) REFERENCES `sub_distribution` (`sub_id`);

--
-- Constraints for table `roll_list`
--
ALTER TABLE `roll_list`
  ADD CONSTRAINT `roll_list_ibfk_1` FOREIGN KEY (`enrol_no`) REFERENCES `students` (`enrol_no`);

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`ac_session_id`) REFERENCES `academic_sessions` (`ac_session_id`);

--
-- Constraints for table `subjects`
--
ALTER TABLE `subjects`
  ADD CONSTRAINT `subjects_ibfk_1` FOREIGN KEY (`ac_session_id`) REFERENCES `academic_sessions` (`ac_session_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
