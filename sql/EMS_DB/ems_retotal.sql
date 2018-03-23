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
-- Database: `ems_retotal`
--

-- --------------------------------------------------------

--
-- Table structure for table `retotal_exam_summary`
--

CREATE TABLE `retotal_exam_summary` (
  `retotal_roll_id` int(10) NOT NULL,
  `total_cr_earned` int(10) NOT NULL,
  `total_gpv_earned` int(10) NOT NULL,
  `sgpa` decimal(7,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `retotal_failure_report`
--

CREATE TABLE `retotal_failure_report` (
  `retotal_roll_id` int(10) NOT NULL,
  `sub_id` int(5) NOT NULL,
  `component_id` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `retotal_roll_list`
--

CREATE TABLE `retotal_roll_list` (
  `retotal_roll_id` int(10) NOT NULL,
  `roll_id` int(10) NOT NULL,
  `retotal_session_id` int(10) NOT NULL,
  `serial_no` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `retotal_sessions`
--

CREATE TABLE `retotal_sessions` (
  `retotal_session_id` int(10) NOT NULL,
  `ac_session_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `retotal_subjects`
--

CREATE TABLE `retotal_subjects` (
  `retotal_roll_id` int(10) NOT NULL,
  `sub_id` int(5) NOT NULL,
  `done_flag` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `score_retotal`
--

CREATE TABLE `score_retotal` (
  `retotal_roll_id` int(10) NOT NULL,
  `component_id` int(2) NOT NULL,
  `sub_id` int(5) NOT NULL,
  `marks` decimal(7,4) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `check_id` int(11) DEFAULT NULL,
  `status_flag` int(1) NOT NULL COMMENT '0: decrement; 1:no change; 2: incremented'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tr_retotal`
--

CREATE TABLE `tr_retotal` (
  `retotal_roll_id` int(10) NOT NULL,
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
-- Indexes for table `retotal_exam_summary`
--
ALTER TABLE `retotal_exam_summary`
  ADD PRIMARY KEY (`retotal_roll_id`);

--
-- Indexes for table `retotal_failure_report`
--
ALTER TABLE `retotal_failure_report`
  ADD PRIMARY KEY (`retotal_roll_id`,`sub_id`,`component_id`),
  ADD KEY `retotal_roll_id` (`retotal_roll_id`,`component_id`,`sub_id`);

--
-- Indexes for table `retotal_roll_list`
--
ALTER TABLE `retotal_roll_list`
  ADD PRIMARY KEY (`retotal_roll_id`),
  ADD KEY `roll_id` (`roll_id`),
  ADD KEY `retotal_session_id` (`retotal_session_id`);

--
-- Indexes for table `retotal_sessions`
--
ALTER TABLE `retotal_sessions`
  ADD PRIMARY KEY (`retotal_session_id`),
  ADD KEY `ac_session_id` (`ac_session_id`);

--
-- Indexes for table `retotal_subjects`
--
ALTER TABLE `retotal_subjects`
  ADD PRIMARY KEY (`retotal_roll_id`,`sub_id`),
  ADD KEY `sub_id` (`sub_id`),
  ADD KEY `retotal_roll_id` (`retotal_roll_id`);

--
-- Indexes for table `score_retotal`
--
ALTER TABLE `score_retotal`
  ADD PRIMARY KEY (`retotal_roll_id`,`component_id`,`sub_id`),
  ADD KEY `sub_id` (`sub_id`),
  ADD KEY `component_id` (`component_id`),
  ADD KEY `check_id` (`check_id`),
  ADD KEY `transaction_id` (`transaction_id`);

--
-- Indexes for table `tr_retotal`
--
ALTER TABLE `tr_retotal`
  ADD PRIMARY KEY (`retotal_roll_id`,`sub_id`),
  ADD KEY `sub_id` (`sub_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `retotal_roll_list`
--
ALTER TABLE `retotal_roll_list`
  MODIFY `retotal_roll_id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `retotal_sessions`
--
ALTER TABLE `retotal_sessions`
  MODIFY `retotal_session_id` int(10) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `retotal_exam_summary`
--
ALTER TABLE `retotal_exam_summary`
  ADD CONSTRAINT `retotal_exam_summary_ibfk_1` FOREIGN KEY (`retotal_roll_id`) REFERENCES `retotal_roll_list` (`retotal_roll_id`);

--
-- Constraints for table `retotal_failure_report`
--
ALTER TABLE `retotal_failure_report`
  ADD CONSTRAINT `retotal_failure_report_ibfk_1` FOREIGN KEY (`retotal_roll_id`,`component_id`,`sub_id`) REFERENCES `score_retotal` (`retotal_roll_id`, `component_id`, `sub_id`);

--
-- Constraints for table `retotal_roll_list`
--
ALTER TABLE `retotal_roll_list`
  ADD CONSTRAINT `retotal_roll_list_ibfk_1` FOREIGN KEY (`roll_id`) REFERENCES `ems`.`roll_list` (`roll_id`),
  ADD CONSTRAINT `retotal_roll_list_ibfk_2` FOREIGN KEY (`retotal_session_id`) REFERENCES `retotal_sessions` (`retotal_session_id`);

--
-- Constraints for table `retotal_sessions`
--
ALTER TABLE `retotal_sessions`
  ADD CONSTRAINT `retotal_sessions_ibfk_1` FOREIGN KEY (`ac_session_id`) REFERENCES `ems`.`academic_sessions` (`ac_session_id`);

--
-- Constraints for table `retotal_subjects`
--
ALTER TABLE `retotal_subjects`
  ADD CONSTRAINT `retotal_subjects_ibfk_1` FOREIGN KEY (`retotal_roll_id`) REFERENCES `retotal_roll_list` (`retotal_roll_id`),
  ADD CONSTRAINT `retotal_subjects_ibfk_2` FOREIGN KEY (`sub_id`) REFERENCES `ems`.`sub_distribution` (`sub_id`);

--
-- Constraints for table `score_retotal`
--
ALTER TABLE `score_retotal`
  ADD CONSTRAINT `score_retotal_ibfk_1` FOREIGN KEY (`retotal_roll_id`) REFERENCES `retotal_roll_list` (`retotal_roll_id`),
  ADD CONSTRAINT `score_retotal_ibfk_2` FOREIGN KEY (`sub_id`) REFERENCES `ems`.`sub_distribution` (`sub_id`),
  ADD CONSTRAINT `score_retotal_ibfk_3` FOREIGN KEY (`component_id`) REFERENCES `ems`.`component_distribution` (`component_id`),
  ADD CONSTRAINT `score_retotal_ibfk_4` FOREIGN KEY (`check_id`) REFERENCES `ems`.`checking` (`check_id`),
  ADD CONSTRAINT `score_retotal_ibfk_5` FOREIGN KEY (`transaction_id`) REFERENCES `ems`.`transactions` (`transaction_id`);

--
-- Constraints for table `tr_retotal`
--
ALTER TABLE `tr_retotal`
  ADD CONSTRAINT `tr_retotal_ibfk_1` FOREIGN KEY (`retotal_roll_id`) REFERENCES `retotal_roll_list` (`retotal_roll_id`),
  ADD CONSTRAINT `tr_retotal_ibfk_2` FOREIGN KEY (`sub_id`) REFERENCES `score_retotal` (`sub_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
