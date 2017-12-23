-- phpMyAdmin SQL Dump
-- version 4.7.1
-- https://www.phpmyadmin.net/
--
-- Host: sql2.freemysqlhosting.net
-- Generation Time: Dec 23, 2017 at 07:40 AM
-- Server version: 5.5.54-0ubuntu0.12.04.1
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
-- Database: `sql2211945`
--

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
-- Table structure for table `audit`
--

CREATE TABLE `audit` (
  `from_year` year(4) NOT NULL,
  `course_id` int(3) NOT NULL,
  `semester` int(1) NOT NULL,
  `sub_id` int(5) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `check_id` int(11) NOT NULL
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
(101, 'username', 'username@username', '14c4b06b824ec593239362517f538b29', '5f4dcc3b5aa765d61d8327deb882cf99', 0, 0),
(102, 'Chayan', 'bansalc10@gmail.com', 'asdf', 'pass', 0, 0),
(103, 'Chayan', 'bansalc10@gmail.com', 'baCh', '167c138724d667719e638176fcb112c2', 0, 0),
(104, 'Chayan', 'bansalc10@gmail.com', 'baCh', '09aac8b2fb3018fef93ffc0af965c4ed', 0, 0),
(105, 'Chayan', 'bansalc10@gmail.com', 'baCh', '5019e42e0efe8fb560f761eae0f5c36e', 0, 0),
(106, 'Chayan', 'bansalc10@gmail.com', 'baCh', 'fce23b741b661e942ae1121d13fc7a3b', 0, 0),
(107, 'Chayan', 'bansalc10@gmail.com', 'baCh', '7536871939f3085ab4365e1eb115003c', 0, 0),
(108, 'Chayan', 'bansalc10@gmail.com', 'baCh', '957e274f9d978c3c148e8020eb1cb163', 0, 0),
(109, 'Chayan', 'bansalc10@gmail.com', 'baCh', 'f34d4a65026f8e6d21324368b5099494', 0, 0),
(110, 'Chayan', 'bansalc10@gmail.com', 'baCh', '25680993a7094c49d4bbf52b53b57153', 0, 0),
(111, 'Chayan', 'bansalc10@gmail.com', 'baCh', '4521a2f44fcc4d67c0bada825d577c90', 0, 0),
(112, 'Chayan', 'bansalc10@gmail.com', 'baCh', '61bf900d3cb39624ca31bc7a7650d96f', 0, 0),
(113, 'Chayan', 'bansalc10@gmail.com', 'baCh', '3b7b80bc7a9fc09d7015bf872ddcc41b', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `roll_list`
--

CREATE TABLE `roll_list` (
  `roll_id` int(10) NOT NULL,
  `enrol_no` varchar(12) NOT NULL,
  `semester` int(1) NOT NULL,
  `atkt_flag` tinyint(1) NOT NULL
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
  `guardian_mobile` varchar(10) NOT NULL,
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
  `ie_flag` int(11) NOT NULL
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
(1, 'SuperAdmin', 'super@test.com', '17c4520f6cfd1ab53d8745e84681eb49', '5f4dcc3b5aa765d61d8327deb882cf99');

-- --------------------------------------------------------

--
-- Table structure for table `tr`
--

CREATE TABLE `tr` (
  `roll_id` int(10) NOT NULL,
  `sub_id` int(5) NOT NULL,
  `cat_cap_ia` decimal(7,4) NOT NULL,
  `end_sem` decimal(7,4) NOT NULL,
  `total` decimal(7,4) NOT NULL,
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
-- Indexes for table `audit`
--
ALTER TABLE `audit`
  ADD PRIMARY KEY (`from_year`,`course_id`,`semester`,`sub_id`),
  ADD KEY `check_id` (`check_id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `sub_id` (`sub_id`),
  ADD KEY `transaction_id` (`transaction_id`);

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
  ADD PRIMARY KEY (`operator_id`);

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
-- AUTO_INCREMENT for table `atkt_list`
--
ALTER TABLE `atkt_list`
  MODIFY `atkt_roll_id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `checking`
--
ALTER TABLE `checking`
  MODIFY `check_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `component`
--
ALTER TABLE `component`
  MODIFY `component_id` int(2) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `course_id` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `operators`
--
ALTER TABLE `operators`
  MODIFY `operator_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;
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
-- Constraints for table `atkt_subjects`
--
ALTER TABLE `atkt_subjects`
  ADD CONSTRAINT `atkt_subjects_ibfk_1` FOREIGN KEY (`roll_id`,`component_id`,`sub_id`) REFERENCES `failure_report` (`roll_id`, `component_id`, `sub_id`);

--
-- Constraints for table `audit`
--
ALTER TABLE `audit`
  ADD CONSTRAINT `audit_ibfk_1` FOREIGN KEY (`check_id`) REFERENCES `checking` (`check_id`),
  ADD CONSTRAINT `audit_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`),
  ADD CONSTRAINT `audit_ibfk_3` FOREIGN KEY (`sub_id`) REFERENCES `sub_distribution` (`sub_id`),
  ADD CONSTRAINT `audit_ibfk_4` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`transaction_id`);

--
-- Constraints for table `checking`
--
ALTER TABLE `checking`
  ADD CONSTRAINT `checking_ibfk_1` FOREIGN KEY (`operator_id`) REFERENCES `operators` (`operator_id`);

--
-- Constraints for table `component_distribution`
--
ALTER TABLE `component_distribution`
  ADD CONSTRAINT `component_distribution_ibfk_1` FOREIGN KEY (`component_id`) REFERENCES `component` (`component_id`),
  ADD CONSTRAINT `component_distribution_ibfk_2` FOREIGN KEY (`sub_id`) REFERENCES `sub_distribution` (`sub_id`);

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`level_id`) REFERENCES `course_level` (`level_id`);

--
-- Constraints for table `exam_summary`
--
ALTER TABLE `exam_summary`
  ADD CONSTRAINT `exam_summary_ibfk_1` FOREIGN KEY (`roll_id`) REFERENCES `roll_list` (`roll_id`);

--
-- Constraints for table `failure_report`
--
ALTER TABLE `failure_report`
  ADD CONSTRAINT `failure_report_ibfk_1` FOREIGN KEY (`roll_id`,`component_id`,`sub_id`) REFERENCES `score` (`roll_id`, `component_id`, `sub_id`);

--
-- Constraints for table `roll_list`
--
ALTER TABLE `roll_list`
  ADD CONSTRAINT `roll_list_ibfk_1` FOREIGN KEY (`enrol_no`) REFERENCES `students` (`enrol_no`);

--
-- Constraints for table `score`
--
ALTER TABLE `score`
  ADD CONSTRAINT `score_ibfk_1` FOREIGN KEY (`roll_id`) REFERENCES `roll_list` (`roll_id`),
  ADD CONSTRAINT `score_ibfk_3` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`transaction_id`),
  ADD CONSTRAINT `score_ibfk_4` FOREIGN KEY (`check_id`) REFERENCES `checking` (`check_id`),
  ADD CONSTRAINT `score_ibfk_5` FOREIGN KEY (`component_id`,`sub_id`) REFERENCES `component_distribution` (`component_id`, `sub_id`);

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`);

--
-- Constraints for table `subjects`
--
ALTER TABLE `subjects`
  ADD CONSTRAINT `subjects_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`);

--
-- Constraints for table `sub_distribution`
--
ALTER TABLE `sub_distribution`
  ADD CONSTRAINT `sub_distribution_ibfk_1` FOREIGN KEY (`sub_code`) REFERENCES `subjects` (`sub_code`);

--
-- Constraints for table `tr`
--
ALTER TABLE `tr`
  ADD CONSTRAINT `tr_ibfk_1` FOREIGN KEY (`roll_id`) REFERENCES `roll_list` (`roll_id`),
  ADD CONSTRAINT `tr_ibfk_2` FOREIGN KEY (`sub_id`) REFERENCES `sub_distribution` (`sub_id`);

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`operator_id`) REFERENCES `operators` (`operator_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
