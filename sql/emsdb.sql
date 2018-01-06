-- phpMyAdmin SQL Dump
-- version 4.7.1
-- https://www.phpmyadmin.net/
--
-- Host: sql12.freemysqlhosting.net
-- Generation Time: Jan 06, 2018 at 02:27 PM
-- Server version: 5.5.58-0ubuntu0.14.04.1
-- PHP Version: 7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sql12214328`
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

-- --------------------------------------------------------

--
-- Table structure for table `atkt_list`
--

CREATE TABLE `atkt_list` (
  `atkt_roll_id` int(10) NOT NULL,
  `enrol_no` varchar(12) NOT NULL,
  `semester` int(1) NOT NULL,
  `roll_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `atkt_subjects`
--

CREATE TABLE `atkt_subjects` (
  `atkt_roll_id` int(10) NOT NULL,
  `roll_id` int(10) NOT NULL,
  `sub_id` int(5) NOT NULL,
  `component_id` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `auditing`
--

CREATE TABLE `auditing` (
  `from_year` year(4) NOT NULL,
  `course_id` int(3) NOT NULL,
  `semester` int(1) NOT NULL,
  `sub_code` varchar(12) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `check_id` int(11) DEFAULT '0',
  `component_id` int(2) NOT NULL,
  `atkt_flag` tinyint(1) NOT NULL DEFAULT '0'
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

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `chat_id` int(10) NOT NULL,
  `sender` varchar(60) NOT NULL,
  `receiver` varchar(60) NOT NULL,
  `msg` varchar(500) NOT NULL
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

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_id` int(4) NOT NULL,
  `level_id` int(1) NOT NULL,
  `course_name` varchar(300) NOT NULL,
  `duration` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(2, 'Postgraduate'),
(3, 'Test');

-- --------------------------------------------------------

--
-- Table structure for table `detained_subject`
--

CREATE TABLE `detained_subject` (
  `enrol_no` varchar(12) NOT NULL,
  `semester` int(1) NOT NULL,
  `detained_sub_id` int(5) NOT NULL
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
  `ac_session_id` int(5) NOT NULL,
  `month_year` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `exam_summary`
--

CREATE TABLE `exam_summary` (
  `roll_id` int(10) NOT NULL,
  `total_credits_earned` int(3) NOT NULL,
  `total_gpv_earned` int(3) NOT NULL,
  `sgpa` decimal(6,4) NOT NULL,
  `result_withheld` tinyint(1) NOT NULL,
  `remarks` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exam_summary`
--

INSERT INTO `exam_summary` (`roll_id`, `total_credits_earned`, `total_gpv_earned`, `sgpa`, `result_withheld`, `remarks`) VALUES
(3001, 26, 251, '9.6538', 0, '');

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
(2, 'operator', 'operator', 'operator', '5f4dcc3b5aa765d61d8327deb882cf99', 0, 0),
(3, 'raghav', 'raghav.mundhra3011@gmail.com', 'raghav.mundhra3011', '725a87af7097011ecdc3b9863fbdf240', 0, 0),
(4, 'Samyak', 'captainsamyak@gmail.com', 'captainsamyak', '296a154b460501a3ca3144c9f8a9d1d7', 1, 0),
(5, 'Samyak Jain', 'jainsamyak330@s.co', 'jainsamyak330', '5e3afa2252e7a70d135dd2447a112b22', 0, 0),
(6, 'Chayan Bansal', 'bansalc10@gmail.com', 'bansalc10', '8d4e3889471088efdf90a25b548b1eb9', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `roll_list`
--

CREATE TABLE `roll_list` (
  `roll_id` int(10) NOT NULL,
  `enrol_no` varchar(12) NOT NULL,
  `semester` int(1) NOT NULL,
  `atkt_flag` tinyint(1) NOT NULL,
  `no_prints` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `stud_mobile` varchar(10) NOT NULL,
  `guardian_mobile` varchar(10) DEFAULT NULL,
  `course_id` int(4) NOT NULL,
  `from_year` year(4) NOT NULL,
  `to_year` year(4) NOT NULL,
  `current_sem` int(1) NOT NULL,
  `cgpa` decimal(6,4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `sub_code` varchar(10) NOT NULL,
  `course_id` int(4) NOT NULL,
  `sub_name` varchar(255) NOT NULL,
  `total_credits` int(2) NOT NULL,
  `semester` int(1) NOT NULL,
  `ie_flag` int(11) NOT NULL,
  `from_year` year(4) NOT NULL,
  `elective_flag` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, 'SuperAdmin', 'super@test.com', '17c4520f6cfd1ab53d8745e84681eb49', '6f9dff5af05096ea9f23cc7bedd65683');

-- --------------------------------------------------------

--
-- Table structure for table `tr`
--

CREATE TABLE `tr` (
  `roll_id` int(10) NOT NULL,
  `sub_id` int(5) NOT NULL,
  `cat_cap_ia` decimal(7,4) DEFAULT NULL,
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
  ADD PRIMARY KEY (`ac_session_id`);

--
-- Indexes for table `atkt_list`
--
ALTER TABLE `atkt_list`
  ADD PRIMARY KEY (`atkt_roll_id`),
  ADD KEY `enrol_no` (`enrol_no`),
  ADD KEY `roll_id` (`roll_id`);

--
-- Indexes for table `atkt_subjects`
--
ALTER TABLE `atkt_subjects`
  ADD PRIMARY KEY (`atkt_roll_id`,`roll_id`,`sub_id`,`component_id`),
  ADD KEY `roll_id` (`roll_id`,`component_id`,`sub_id`);

--
-- Indexes for table `auditing`
--
ALTER TABLE `auditing`
  ADD KEY `check_id` (`check_id`),
  ADD KEY `course_id` (`course_id`),
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
  ADD KEY `level_id` (`level_id`);

--
-- Indexes for table `course_level`
--
ALTER TABLE `course_level`
  ADD PRIMARY KEY (`level_id`);

--
-- Indexes for table `detained_subject`
--
ALTER TABLE `detained_subject`
  ADD PRIMARY KEY (`enrol_no`,`semester`,`detained_sub_id`),
  ADD KEY `detained_sub_id` (`detained_sub_id`);

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
  ADD KEY `ac_session_id` (`ac_session_id`);

--
-- Indexes for table `exam_summary`
--
ALTER TABLE `exam_summary`
  ADD PRIMARY KEY (`roll_id`);

--
-- Indexes for table `failure_report`
--
ALTER TABLE `failure_report`
  ADD PRIMARY KEY (`roll_id`,`sub_id`,`component_id`),
  ADD KEY `roll_id` (`roll_id`,`component_id`,`sub_id`);

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
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`sub_code`),
  ADD KEY `course_id` (`course_id`);

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
  MODIFY `ac_session_id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `atkt_list`
--
ALTER TABLE `atkt_list`
  MODIFY `atkt_roll_id` int(10) NOT NULL AUTO_INCREMENT;
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
  MODIFY `course_id` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `operators`
--
ALTER TABLE `operators`
  MODIFY `operator_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `sub_distribution`
--
ALTER TABLE `sub_distribution`
  MODIFY `sub_id` int(5) NOT NULL AUTO_INCREMENT;
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
-- Constraints for table `atkt_list`
--
ALTER TABLE `atkt_list`
  ADD CONSTRAINT `atkt_list_ibfk_2` FOREIGN KEY (`roll_id`) REFERENCES `roll_list` (`roll_id`),
  ADD CONSTRAINT `atkt_list_ibfk_1` FOREIGN KEY (`enrol_no`) REFERENCES `students` (`enrol_no`);

--
-- Constraints for table `branches`
--
ALTER TABLE `branches`
  ADD CONSTRAINT `branches_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`);

--
-- Constraints for table `detained_subject`
--
ALTER TABLE `detained_subject`
  ADD CONSTRAINT `detained_subject_ibfk_2` FOREIGN KEY (`detained_sub_id`) REFERENCES `sub_distribution` (`sub_id`),
  ADD CONSTRAINT `detained_subject_ibfk_1` FOREIGN KEY (`enrol_no`) REFERENCES `students` (`enrol_no`);

--
-- Constraints for table `elective_map`
--
ALTER TABLE `elective_map`
  ADD CONSTRAINT `elective_map_ibfk_2` FOREIGN KEY (`elective_sub_code`) REFERENCES `subjects` (`sub_code`),
  ADD CONSTRAINT `elective_map_ibfk_1` FOREIGN KEY (`enrol_no`) REFERENCES `students` (`enrol_no`);

--
-- Constraints for table `exam_month_year`
--
ALTER TABLE `exam_month_year`
  ADD CONSTRAINT `exam_month_year_ibfk_1` FOREIGN KEY (`ac_session_id`) REFERENCES `academic_sessions` (`ac_session_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
