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
-- Database: `ems_atkt`
--

-- --------------------------------------------------------

--
-- Table structure for table `atkt_exam_summary`
--

CREATE TABLE `atkt_exam_summary` (
  `atkt_roll_id` int(10) NOT NULL,
  `total_credits_earned` int(3) NOT NULL,
  `total_gpv_earned` int(3) NOT NULL,
  `sgpa` decimal(6,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `atkt_failure_report`
--

CREATE TABLE `atkt_failure_report` (
  `atkt_roll_id` int(10) NOT NULL,
  `sub_id` int(5) NOT NULL,
  `component_id` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `atkt_roll_list`
--

CREATE TABLE `atkt_roll_list` (
  `atkt_roll_id` int(10) NOT NULL,
  `roll_id` int(10) NOT NULL,
  `atkt_session_id` int(10) NOT NULL,
  `serial_no` int(10) NOT NULL,
  `no_prints` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `atkt_sessions`
--

CREATE TABLE `atkt_sessions` (
  `atkt_session_id` int(5) NOT NULL DEFAULT '0',
  `ac_session_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `atkt_subjects`
--

CREATE TABLE `atkt_subjects` (
  `atkt_roll_id` int(10) NOT NULL,
  `sub_id` int(5) NOT NULL,
  `done_flag` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `score_atkt`
--

CREATE TABLE `score_atkt` (
  `atkt_roll_id` int(10) NOT NULL,
  `component_id` int(2) NOT NULL,
  `sub_id` int(5) NOT NULL,
  `marks` decimal(7,4) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `check_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tr_atkt`
--

CREATE TABLE `tr_atkt` (
  `atkt_roll_id` int(10) NOT NULL,
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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `atkt_exam_summary`
--
ALTER TABLE `atkt_exam_summary`
  ADD PRIMARY KEY (`atkt_roll_id`),
  ADD KEY `atkt_roll_id` (`atkt_roll_id`);

--
-- Indexes for table `atkt_failure_report`
--
ALTER TABLE `atkt_failure_report`
  ADD PRIMARY KEY (`atkt_roll_id`,`sub_id`,`component_id`),
  ADD KEY `component_id` (`component_id`),
  ADD KEY `sub_id` (`sub_id`),
  ADD KEY `atkt_roll_id` (`atkt_roll_id`,`component_id`,`sub_id`);

--
-- Indexes for table `atkt_roll_list`
--
ALTER TABLE `atkt_roll_list`
  ADD PRIMARY KEY (`atkt_roll_id`),
  ADD KEY `atkt_session_id` (`atkt_session_id`),
  ADD KEY `roll_id` (`roll_id`),
  ADD KEY `atkt_roll_id` (`atkt_roll_id`);

--
-- Indexes for table `atkt_sessions`
--
ALTER TABLE `atkt_sessions`
  ADD PRIMARY KEY (`atkt_session_id`),
  ADD KEY `ac_session_id` (`ac_session_id`);

--
-- Indexes for table `atkt_subjects`
--
ALTER TABLE `atkt_subjects`
  ADD PRIMARY KEY (`atkt_roll_id`,`sub_id`),
  ADD KEY `sub_id` (`sub_id`);

--
-- Indexes for table `score_atkt`
--
ALTER TABLE `score_atkt`
  ADD PRIMARY KEY (`atkt_roll_id`,`component_id`,`sub_id`),
  ADD KEY `check_id` (`check_id`),
  ADD KEY `component_id` (`component_id`),
  ADD KEY `sub_id` (`sub_id`),
  ADD KEY `transaction_id` (`transaction_id`),
  ADD KEY `atkt_roll_id` (`atkt_roll_id`);

--
-- Indexes for table `tr_atkt`
--
ALTER TABLE `tr_atkt`
  ADD PRIMARY KEY (`atkt_roll_id`,`sub_id`),
  ADD KEY `sub_id` (`sub_id`),
  ADD KEY `atkt_roll_id` (`atkt_roll_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `atkt_roll_list`
--
ALTER TABLE `atkt_roll_list`
  MODIFY `atkt_roll_id` int(10) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `atkt_exam_summary`
--
ALTER TABLE `atkt_exam_summary`
  ADD CONSTRAINT `atkt_exam_summary_ibfk_1` FOREIGN KEY (`atkt_roll_id`) REFERENCES `atkt_roll_list` (`atkt_roll_id`);

--
-- Constraints for table `atkt_failure_report`
--
ALTER TABLE `atkt_failure_report`
  ADD CONSTRAINT `atkt_failure_report_ibfk_1` FOREIGN KEY (`atkt_roll_id`,`component_id`,`sub_id`) REFERENCES `score_atkt` (`atkt_roll_id`, `component_id`, `sub_id`);

--
-- Constraints for table `atkt_roll_list`
--
ALTER TABLE `atkt_roll_list`
  ADD CONSTRAINT `atkt_roll_list_ibfk_1` FOREIGN KEY (`atkt_session_id`) REFERENCES `atkt_sessions` (`atkt_session_id`),
  ADD CONSTRAINT `atkt_roll_list_ibfk_2` FOREIGN KEY (`roll_id`) REFERENCES `ems`.`roll_list` (`roll_id`);

--
-- Constraints for table `atkt_sessions`
--
ALTER TABLE `atkt_sessions`
  ADD CONSTRAINT `atkt_sessions_ibfk_1` FOREIGN KEY (`ac_session_id`) REFERENCES `ems`.`academic_sessions` (`ac_session_id`);

--
-- Constraints for table `atkt_subjects`
--
ALTER TABLE `atkt_subjects`
  ADD CONSTRAINT `atkt_subjects_ibfk_1` FOREIGN KEY (`atkt_roll_id`) REFERENCES `atkt_roll_list` (`atkt_roll_id`),
  ADD CONSTRAINT `atkt_subjects_ibfk_2` FOREIGN KEY (`sub_id`) REFERENCES `ems`.`sub_distribution` (`sub_id`);

--
-- Constraints for table `score_atkt`
--
ALTER TABLE `score_atkt`
  ADD CONSTRAINT `score_atkt_ibfk_2` FOREIGN KEY (`check_id`) REFERENCES `ems`.`checking` (`check_id`),
  ADD CONSTRAINT `score_atkt_ibfk_3` FOREIGN KEY (`component_id`) REFERENCES `ems`.`component` (`component_id`),
  ADD CONSTRAINT `score_atkt_ibfk_4` FOREIGN KEY (`sub_id`) REFERENCES `ems`.`sub_distribution` (`sub_id`),
  ADD CONSTRAINT `score_atkt_ibfk_5` FOREIGN KEY (`transaction_id`) REFERENCES `ems`.`transactions` (`transaction_id`),
  ADD CONSTRAINT `score_atkt_ibfk_6` FOREIGN KEY (`atkt_roll_id`) REFERENCES `atkt_roll_list` (`atkt_roll_id`);

--
-- Constraints for table `tr_atkt`
--
ALTER TABLE `tr_atkt`
  ADD CONSTRAINT `tr_atkt_ibfk_2` FOREIGN KEY (`sub_id`) REFERENCES `ems`.`sub_distribution` (`sub_id`),
  ADD CONSTRAINT `tr_atkt_ibfk_3` FOREIGN KEY (`atkt_roll_id`) REFERENCES `atkt_roll_list` (`atkt_roll_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
