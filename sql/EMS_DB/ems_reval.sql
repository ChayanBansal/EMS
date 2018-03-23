-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 23, 2018 at 12:06 PM
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
-- Database: `ems_reval`
--

-- --------------------------------------------------------

--
-- Table structure for table `reval_exam_summary`
--

CREATE TABLE `reval_exam_summary` (
  `reval_roll_id` int(10) NOT NULL,
  `total_cr_earned` int(10) NOT NULL,
  `total_gpv_earned` int(10) NOT NULL,
  `sgpa` decimal(7,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reval_failure_report`
--

CREATE TABLE `reval_failure_report` (
  `reval_roll_id` int(10) NOT NULL,
  `sub_id` int(5) NOT NULL,
  `component_id` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reval_roll_list`
--

CREATE TABLE `reval_roll_list` (
  `reval_roll_id` int(10) NOT NULL,
  `roll_id` int(10) NOT NULL,
  `reval_session_id` int(10) NOT NULL,
  `serial_no` int(10) NOT NULL,
  `no_prints` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reval_roll_list`
--

INSERT INTO `reval_roll_list` (`reval_roll_id`, `roll_id`, `reval_session_id`, `serial_no`, `no_prints`) VALUES
(1, 1, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `reval_sessions`
--

CREATE TABLE `reval_sessions` (
  `reval_session_id` int(5) NOT NULL,
  `ac_session_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reval_sessions`
--

INSERT INTO `reval_sessions` (`reval_session_id`, `ac_session_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `reval_subjects`
--

CREATE TABLE `reval_subjects` (
  `reval_roll_id` int(10) NOT NULL,
  `sub_id` int(5) NOT NULL,
  `done_flag` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `score_reval_1_2`
--

CREATE TABLE `score_reval_1_2` (
  `reval_roll_id` int(10) NOT NULL,
  `component_id` int(2) NOT NULL,
  `sub_id` int(5) NOT NULL,
  `original_marks` decimal(7,4) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `check_id` int(11) DEFAULT NULL,
  `status_flag` int(1) NOT NULL COMMENT '0: decrement; 1:no change; 2: incremented',
  `marks_1` decimal(7,4) DEFAULT NULL,
  `marks_2` decimal(7,4) DEFAULT NULL,
  `avearge` decimal(7,4) DEFAULT NULL,
  `third_reval_flag` int(1) NOT NULL DEFAULT '0',
  `third_reval_id` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `score_reval_3`
--

CREATE TABLE `score_reval_3` (
  `third_reval_id` int(10) NOT NULL,
  `transaction_id` int(10) NOT NULL,
  `check_id` int(10) NOT NULL,
  `marks` decimal(7,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tr_reval`
--

CREATE TABLE `tr_reval` (
  `reval_roll_id` int(10) NOT NULL,
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
  `gpv` decimal(7,4) NOT NULL,
  `status_flag` int(1) NOT NULL COMMENT '[0]: Score decremented,[1]:Score unchanged, [2]:Score incremented'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `reval_exam_summary`
--
ALTER TABLE `reval_exam_summary`
  ADD PRIMARY KEY (`reval_roll_id`),
  ADD KEY `reval_roll_id` (`reval_roll_id`);

--
-- Indexes for table `reval_failure_report`
--
ALTER TABLE `reval_failure_report`
  ADD PRIMARY KEY (`reval_roll_id`,`sub_id`,`component_id`),
  ADD KEY `reval_roll_id` (`reval_roll_id`,`component_id`,`sub_id`);

--
-- Indexes for table `reval_roll_list`
--
ALTER TABLE `reval_roll_list`
  ADD PRIMARY KEY (`reval_roll_id`),
  ADD KEY `reval_session_id` (`reval_session_id`),
  ADD KEY `roll_id` (`roll_id`);

--
-- Indexes for table `reval_sessions`
--
ALTER TABLE `reval_sessions`
  ADD PRIMARY KEY (`reval_session_id`),
  ADD KEY `ac_session_id` (`ac_session_id`);

--
-- Indexes for table `reval_subjects`
--
ALTER TABLE `reval_subjects`
  ADD PRIMARY KEY (`reval_roll_id`,`sub_id`),
  ADD KEY `sub_id` (`sub_id`);

--
-- Indexes for table `score_reval_1_2`
--
ALTER TABLE `score_reval_1_2`
  ADD PRIMARY KEY (`reval_roll_id`,`component_id`,`sub_id`),
  ADD KEY `component_id` (`component_id`),
  ADD KEY `sub_id` (`sub_id`),
  ADD KEY `third_reval_id` (`third_reval_id`),
  ADD KEY `check_id` (`check_id`),
  ADD KEY `transaction_id` (`transaction_id`);

--
-- Indexes for table `score_reval_3`
--
ALTER TABLE `score_reval_3`
  ADD PRIMARY KEY (`third_reval_id`),
  ADD KEY `transaction_id` (`transaction_id`),
  ADD KEY `check_id` (`check_id`);

--
-- Indexes for table `tr_reval`
--
ALTER TABLE `tr_reval`
  ADD PRIMARY KEY (`reval_roll_id`,`sub_id`),
  ADD KEY `sub_id` (`sub_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `reval_roll_list`
--
ALTER TABLE `reval_roll_list`
  MODIFY `reval_roll_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `reval_sessions`
--
ALTER TABLE `reval_sessions`
  MODIFY `reval_session_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `score_reval_3`
--
ALTER TABLE `score_reval_3`
  MODIFY `third_reval_id` int(10) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `reval_exam_summary`
--
ALTER TABLE `reval_exam_summary`
  ADD CONSTRAINT `reval_exam_summary_ibfk_1` FOREIGN KEY (`reval_roll_id`) REFERENCES `reval_roll_list` (`reval_roll_id`);

--
-- Constraints for table `reval_failure_report`
--
ALTER TABLE `reval_failure_report`
  ADD CONSTRAINT `reval_failure_report_ibfk_1` FOREIGN KEY (`reval_roll_id`,`component_id`,`sub_id`) REFERENCES `score_reval_1_2` (`reval_roll_id`, `component_id`, `sub_id`);

--
-- Constraints for table `reval_roll_list`
--
ALTER TABLE `reval_roll_list`
  ADD CONSTRAINT `reval_roll_list_ibfk_1` FOREIGN KEY (`reval_session_id`) REFERENCES `reval_sessions` (`reval_session_id`),
  ADD CONSTRAINT `reval_roll_list_ibfk_2` FOREIGN KEY (`roll_id`) REFERENCES `ems`.`roll_list` (`roll_id`);

--
-- Constraints for table `reval_sessions`
--
ALTER TABLE `reval_sessions`
  ADD CONSTRAINT `reval_sessions_ibfk_1` FOREIGN KEY (`ac_session_id`) REFERENCES `ems`.`academic_sessions` (`ac_session_id`);

--
-- Constraints for table `reval_subjects`
--
ALTER TABLE `reval_subjects`
  ADD CONSTRAINT `reval_subjects_ibfk_1` FOREIGN KEY (`reval_roll_id`) REFERENCES `reval_roll_list` (`reval_roll_id`);

--
-- Constraints for table `score_reval_1_2`
--
ALTER TABLE `score_reval_1_2`
  ADD CONSTRAINT `score_reval_1_2_ibfk_2` FOREIGN KEY (`component_id`) REFERENCES `ems`.`component` (`component_id`),
  ADD CONSTRAINT `score_reval_1_2_ibfk_3` FOREIGN KEY (`sub_id`) REFERENCES `ems`.`sub_distribution` (`sub_id`),
  ADD CONSTRAINT `score_reval_1_2_ibfk_4` FOREIGN KEY (`third_reval_id`) REFERENCES `score_reval_3` (`third_reval_id`),
  ADD CONSTRAINT `score_reval_1_2_ibfk_5` FOREIGN KEY (`check_id`) REFERENCES `ems`.`checking` (`check_id`),
  ADD CONSTRAINT `score_reval_1_2_ibfk_6` FOREIGN KEY (`transaction_id`) REFERENCES `ems`.`transactions` (`transaction_id`);

--
-- Constraints for table `score_reval_3`
--
ALTER TABLE `score_reval_3`
  ADD CONSTRAINT `score_reval_3_ibfk_1` FOREIGN KEY (`transaction_id`) REFERENCES `ems`.`transactions` (`transaction_id`),
  ADD CONSTRAINT `score_reval_3_ibfk_2` FOREIGN KEY (`check_id`) REFERENCES `ems`.`checking` (`check_id`);

--
-- Constraints for table `tr_reval`
--
ALTER TABLE `tr_reval`
  ADD CONSTRAINT `tr_reval_ibfk_2` FOREIGN KEY (`sub_id`) REFERENCES `ems`.`sub_distribution` (`sub_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
