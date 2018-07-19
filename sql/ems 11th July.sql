-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 11, 2018 at 04:58 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.1.17

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
  `current_semester` int(1) NOT NULL,
  `tr_gen_flag` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `academic_sessions`
--

INSERT INTO `academic_sessions` (`ac_session_id`, `from_year`, `course_id`, `current_semester`, `tr_gen_flag`) VALUES
(1, 2016, 1, 1, 1);

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
  `serial_no` int(10) DEFAULT NULL,
  `no_prints` int(3) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `atkt_sessions`
--

CREATE TABLE `atkt_sessions` (
  `atkt_session_id` int(5) NOT NULL,
  `ac_session_id` int(5) NOT NULL,
  `tr_gen_flag` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `atkt_subjects`
--

CREATE TABLE `atkt_subjects` (
  `atkt_roll_id` int(10) NOT NULL,
  `sub_id` int(5) NOT NULL,
  `component_id` int(1) NOT NULL,
  `done_flag` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `auditing`
--

CREATE TABLE `auditing` (
  `session_id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `check_id` int(11) DEFAULT NULL,
  `component_id` int(2) NOT NULL,
  `type_flag` int(1) NOT NULL COMMENT '[0]:Main Examination,[1]:Retotalling,[2]:Revaluation,[3]:ATKT',
  `ac_sub_code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auditing`
--

INSERT INTO `auditing` (`session_id`, `transaction_id`, `check_id`, `component_id`, `type_flag`, `ac_sub_code`) VALUES
(1, 3, 1, 1, 0, 1),
(1, 4, 2, 2, 0, 1),
(1, 5, 3, 3, 0, 1),
(1, 6, 4, 4, 0, 1),
(1, 7, 5, 5, 0, 1),
(1, 8, 6, 6, 0, 2),
(1, 13, 7, 4, 1, 1);

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

--
-- Dumping data for table `checking`
--

INSERT INTO `checking` (`check_id`, `operator_id`, `timestamp`, `remark`) VALUES
(1, 4, '2018-07-11 10:57:54', 'Checked'),
(2, 4, '2018-07-11 10:58:07', 'Checked'),
(3, 4, '2018-07-11 10:58:13', 'Checked'),
(4, 4, '2018-07-11 10:58:20', 'Checked'),
(5, 4, '2018-07-11 10:58:27', 'Checked'),
(6, 4, '2018-07-11 10:58:33', 'Checked'),
(7, 4, '2018-07-11 14:57:23', 'Changed');

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
(1, 'Continuous Assessment Theory'),
(2, 'End Semester Theory'),
(3, 'Continous Assessment Practical'),
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
(1, 1, 1, 'B.Tech CSIT', 4);

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
  `cat_flag` tinyint(1) NOT NULL,
  `end_theory_flag` tinyint(1) NOT NULL,
  `cap_flag` tinyint(1) NOT NULL,
  `end_practical_flag` tinyint(1) NOT NULL,
  `ia_flag` tinyint(1) NOT NULL,
  `ie_flag` tinyint(1) NOT NULL,
  `remarks` varchar(300) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(1) NOT NULL DEFAULT '0' COMMENT '0:No action taken; 1:Approved; 2:Disapproved; 3:Closed',
  `ac_sub_code` int(11) NOT NULL
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

--
-- Dumping data for table `exam_summary`
--

INSERT INTO `exam_summary` (`roll_id`, `total_credits_earned`, `total_gpv_earned`, `sgpa`) VALUES
(1, 5, 32, '6.4000'),
(2, 3, 24, '4.8000');

-- --------------------------------------------------------

--
-- Table structure for table `failure_report`
--

CREATE TABLE `failure_report` (
  `roll_id` int(10) NOT NULL,
  `sub_id` int(5) NOT NULL,
  `component_id` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `failure_report`
--

INSERT INTO `failure_report` (`roll_id`, `sub_id`, `component_id`) VALUES
(1, 2, 4),
(2, 1, 1),
(2, 1, 2);

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
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` bigint(20) NOT NULL,
  `message` varchar(255) NOT NULL,
  `type` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `message`, `type`) VALUES
(1, 'Failed to update session!', 'danger'),
(2, 'Unable to lock account!', 'danger'),
(3, 'Please open an academic session first!', 'warning'),
(4, 'Please check your username or password! <b>3 attempts remaining!</b>', 'danger'),
(5, 'Please check your username or password! <b>2 attempts remaining!</b>', 'danger'),
(6, 'Your account is locked for security reasons! Please contact the superadmin to unlock your account!', 'warning'),
(7, 'Please enter a remark!', 'warning'),
(8, 'Please enter correct value(s) for marks!', 'warning'),
(9, 'Not able to execute the updation. Please try again!', 'danger'),
(10, 'Not able to execute the updation. Please try again!', 'danger'),
(11, 'Unable to generate Tabulation Register', 'danger'),
(12, 'Please check your username or password! <b>3 attempts remaining!</b>', 'danger'),
(13, 'Please check your username or password! <b>3 attempts remaining!</b>', 'danger'),
(14, 'Please enter a remark!', 'warning'),
(15, 'Please enter correct value(s) for marks!', 'warning'),
(16, 'Please enter correct value(s) for marks!', 'warning'),
(17, 'Unable to insert marks! Please try again..', 'danger'),
(18, 'Unable to insert marks! Please try again..', 'danger');

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
(4, 'Samyak', 'captainsamyak@gmail.com', 'captainsamyak', '296a154b460501a3ca3144c9f8a9d1d7', 1, 0),
(5, 'Samyak Jain', 'jainsamyak330@s.co', 'jainsamyak330', '5e3afa2252e7a70d135dd2447a112b22', 0, 0),
(6, 'Chayan Bansal', 'bansalc10@gmail.com', 'bansalc10', '5f4dcc3b5aa765d61d8327deb882cf99', 1, 0),
(7, 'Raghav', 'raghav.mundhra3011@gmail.com', 'raghav.mundhra3011', '9460d2107460db9c63715141329e96de', 0, 0);

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
  `serial_no` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `retotal_roll_list`
--

INSERT INTO `retotal_roll_list` (`retotal_roll_id`, `roll_id`, `retotal_session_id`, `serial_no`) VALUES
(1, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `retotal_sessions`
--

CREATE TABLE `retotal_sessions` (
  `retotal_session_id` int(10) NOT NULL,
  `ac_session_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `retotal_sessions`
--

INSERT INTO `retotal_sessions` (`retotal_session_id`, `ac_session_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `retotal_subjects`
--

CREATE TABLE `retotal_subjects` (
  `retotal_roll_id` int(10) NOT NULL,
  `sub_id` int(5) NOT NULL,
  `done_flag` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `retotal_subjects`
--

INSERT INTO `retotal_subjects` (`retotal_roll_id`, `sub_id`, `done_flag`) VALUES
(1, 2, 0);

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

-- --------------------------------------------------------

--
-- Table structure for table `reval_sessions`
--

CREATE TABLE `reval_sessions` (
  `reval_session_id` int(5) NOT NULL,
  `ac_session_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, '2016AB001052', 1, 1, NULL, 0, 1, 0, 0),
(2, '2016AB001059', 1, 1, NULL, 0, 0, 0, 0);

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
(2, 'School of Automobile & Manufacturing Engineering'),
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

--
-- Dumping data for table `score`
--

INSERT INTO `score` (`roll_id`, `component_id`, `sub_id`, `marks`, `transaction_id`, `check_id`) VALUES
(1, 1, 1, '38.0000', 3, 1),
(1, 2, 1, '28.0000', 4, 2),
(1, 3, 2, '36.0000', 5, 3),
(1, 4, 2, '5.0000', 6, 4),
(1, 5, 2, '12.0000', 7, 5),
(1, 6, 3, '58.0000', 8, 6),
(2, 1, 1, '0.0000', 3, 1),
(2, 2, 1, '12.0000', 4, 2),
(2, 3, 2, '25.0000', 5, 3),
(2, 4, 2, '36.0000', 6, 4),
(2, 5, 2, '18.0000', 7, 5),
(2, 6, 3, '96.0000', 8, 6);

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

--
-- Dumping data for table `score_retotal`
--

INSERT INTO `score_retotal` (`retotal_roll_id`, `component_id`, `sub_id`, `marks`, `transaction_id`, `check_id`, `status_flag`) VALUES
(1, 4, 2, '40.0000', 13, 7, 2);

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
  `ac_session_id` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`enrol_no`, `first_name`, `middle_name`, `last_name`, `father_name`, `mother_name`, `address`, `gender`, `stud_mobile`, `guardian_mobile`, `to_year`, `cgpa`, `ac_session_id`) VALUES
('2016AB001052', 'test', 'test', 'test', 'test', 'test', 'tets', 'M', '9898989898', NULL, 2020, NULL, 1),
('2016AB001059', 'test2', 'test', 'tetst', 'tdtd', 'test', 'test', 'M', '9090909090', NULL, 2020, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `ac_sub_code` int(11) NOT NULL,
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

INSERT INTO `subjects` (`ac_sub_code`, `sub_code`, `sub_name`, `total_credits`, `ie_flag`, `elective_flag`, `ac_session_id`) VALUES
(1, 'BTCS01CC01', 'Maths', 5, 0, 0, 1),
(2, 'BTCS01CC02', 'PPM', 0, 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sub_distribution`
--

CREATE TABLE `sub_distribution` (
  `sub_id` int(5) NOT NULL,
  `practical_flag` tinyint(1) NOT NULL COMMENT '[0]: Theory sub_id, [1]: Practical sub_id, [2]: Internal Examination',
  `credits_allotted` int(1) NOT NULL,
  `ac_sub_code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_distribution`
--

INSERT INTO `sub_distribution` (`sub_id`, `practical_flag`, `credits_allotted`, `ac_sub_code`) VALUES
(1, 0, 2, 1),
(2, 1, 3, 1),
(3, 2, 0, 2);

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

--
-- Dumping data for table `tr`
--

INSERT INTO `tr` (`roll_id`, `sub_id`, `cat_cap`, `ia`, `end_sem`, `ie`, `total`, `percent`, `grade`, `gp`, `cr`, `gpv`) VALUES
(1, 1, '38.0000', NULL, '28.0000', NULL, '66.0000', '66.0000', 'B+', 7, 2, '14.0000'),
(1, 2, '36.0000', '12.0000', '5.0000', NULL, '53.0000', '53.0000', 'B', 6, 3, '18.0000'),
(1, 3, NULL, NULL, NULL, '58.0000', '58.0000', '58.0000', 'B', 6, 0, '0.0000'),
(2, 1, '0.0000', NULL, '12.0000', NULL, '12.0000', '12.0000', 'F', 0, 0, '0.0000'),
(2, 2, '25.0000', '18.0000', '36.0000', NULL, '79.0000', '79.0000', 'A', 8, 3, '24.0000'),
(2, 3, NULL, NULL, NULL, '96.0000', '96.0000', '96.0000', 'O', 10, 0, '0.0000');

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
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`transaction_id`, `operator_id`, `timestamp`, `remark`) VALUES
(3, 4, '2018-07-11 10:55:22', 'Done'),
(4, 4, '2018-07-11 10:56:08', 'Done'),
(5, 4, '2018-07-11 10:56:46', 'Done'),
(6, 4, '2018-07-11 10:57:09', 'Done'),
(7, 4, '2018-07-11 10:57:24', 'Done'),
(8, 4, '2018-07-11 10:57:44', 'Done'),
(13, 4, '2018-07-11 11:03:26', 'Done');

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
-- Indexes for table `academic_sessions`
--
ALTER TABLE `academic_sessions`
  ADD PRIMARY KEY (`ac_session_id`),
  ADD UNIQUE KEY `from_year` (`from_year`,`course_id`,`current_semester`),
  ADD KEY `course_id` (`course_id`);

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
  ADD PRIMARY KEY (`atkt_roll_id`,`sub_id`,`component_id`),
  ADD KEY `sub_id` (`sub_id`),
  ADD KEY `component_id` (`component_id`);

--
-- Indexes for table `auditing`
--
ALTER TABLE `auditing`
  ADD PRIMARY KEY (`session_id`,`transaction_id`,`component_id`,`type_flag`,`ac_sub_code`),
  ADD KEY `check_id` (`check_id`),
  ADD KEY `transaction_id` (`transaction_id`),
  ADD KEY `component_id` (`component_id`),
  ADD KEY `ac_subject_code_idx` (`ac_sub_code`);

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
  ADD KEY `ac_subject_code_idx` (`ac_sub_code`);

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
  ADD PRIMARY KEY (`roll_id`,`sub_id`,`component_id`),
  ADD KEY `roll_id` (`roll_id`,`component_id`,`sub_id`);

--
-- Indexes for table `issue_summary`
--
ALTER TABLE `issue_summary`
  ADD PRIMARY KEY (`session_id`,`type_flag`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `operators`
--
ALTER TABLE `operators`
  ADD PRIMARY KEY (`operator_id`),
  ADD UNIQUE KEY `operator_username` (`operator_username`);

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
-- Indexes for table `score_retotal`
--
ALTER TABLE `score_retotal`
  ADD PRIMARY KEY (`retotal_roll_id`,`component_id`,`sub_id`),
  ADD KEY `sub_id` (`sub_id`),
  ADD KEY `component_id` (`component_id`),
  ADD KEY `check_id` (`check_id`),
  ADD KEY `transaction_id` (`transaction_id`);

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
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`enrol_no`),
  ADD KEY `ac_session_id` (`ac_session_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`ac_sub_code`),
  ADD UNIQUE KEY `ac_sub_code_UNIQUE` (`ac_sub_code`),
  ADD KEY `ac_session_id` (`ac_session_id`);

--
-- Indexes for table `sub_distribution`
--
ALTER TABLE `sub_distribution`
  ADD PRIMARY KEY (`sub_id`),
  ADD KEY `academic_subject_code_idx` (`ac_sub_code`);

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
  ADD KEY `sub_id` (`sub_id`),
  ADD KEY `roll_id` (`roll_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `operator_id` (`operator_id`),
  ADD KEY `transaction_id` (`transaction_id`);

--
-- Indexes for table `tr_atkt`
--
ALTER TABLE `tr_atkt`
  ADD PRIMARY KEY (`atkt_roll_id`,`sub_id`),
  ADD KEY `sub_id` (`sub_id`),
  ADD KEY `atkt_roll_id` (`atkt_roll_id`);

--
-- Indexes for table `tr_retotal`
--
ALTER TABLE `tr_retotal`
  ADD PRIMARY KEY (`retotal_roll_id`,`sub_id`),
  ADD KEY `sub_id` (`sub_id`);

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
-- AUTO_INCREMENT for table `academic_sessions`
--
ALTER TABLE `academic_sessions`
  MODIFY `ac_session_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `atkt_roll_list`
--
ALTER TABLE `atkt_roll_list`
  MODIFY `atkt_roll_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `atkt_sessions`
--
ALTER TABLE `atkt_sessions`
  MODIFY `atkt_session_id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `chat_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `checking`
--
ALTER TABLE `checking`
  MODIFY `check_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `component`
--
ALTER TABLE `component`
  MODIFY `component_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `course_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `edit_tr_request`
--
ALTER TABLE `edit_tr_request`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `operators`
--
ALTER TABLE `operators`
  MODIFY `operator_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `retotal_roll_list`
--
ALTER TABLE `retotal_roll_list`
  MODIFY `retotal_roll_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `retotal_sessions`
--
ALTER TABLE `retotal_sessions`
  MODIFY `retotal_session_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reval_roll_list`
--
ALTER TABLE `reval_roll_list`
  MODIFY `reval_roll_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reval_sessions`
--
ALTER TABLE `reval_sessions`
  MODIFY `reval_session_id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roll_list`
--
ALTER TABLE `roll_list`
  MODIFY `roll_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `schools`
--
ALTER TABLE `schools`
  MODIFY `school_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `score_reval_3`
--
ALTER TABLE `score_reval_3`
  MODIFY `third_reval_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `ac_sub_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `academic_sessions`
--
ALTER TABLE `academic_sessions`
  ADD CONSTRAINT `academic_sessions_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`);

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
  ADD CONSTRAINT `atkt_roll_list_ibfk_2` FOREIGN KEY (`roll_id`) REFERENCES `failure_report` (`roll_id`),
  ADD CONSTRAINT `atkt_roll_list_ibfk_3` FOREIGN KEY (`atkt_session_id`) REFERENCES `atkt_sessions` (`atkt_session_id`);

--
-- Constraints for table `atkt_sessions`
--
ALTER TABLE `atkt_sessions`
  ADD CONSTRAINT `atkt_sessions_ibfk_1` FOREIGN KEY (`ac_session_id`) REFERENCES `academic_sessions` (`ac_session_id`);

--
-- Constraints for table `atkt_subjects`
--
ALTER TABLE `atkt_subjects`
  ADD CONSTRAINT `atkt_subjects_ibfk_1` FOREIGN KEY (`atkt_roll_id`) REFERENCES `atkt_roll_list` (`atkt_roll_id`),
  ADD CONSTRAINT `atkt_subjects_ibfk_2` FOREIGN KEY (`sub_id`) REFERENCES `sub_distribution` (`sub_id`),
  ADD CONSTRAINT `atkt_subjects_ibfk_3` FOREIGN KEY (`component_id`) REFERENCES `component` (`component_id`);

--
-- Constraints for table `auditing`
--
ALTER TABLE `auditing`
  ADD CONSTRAINT `ac_subject_code` FOREIGN KEY (`ac_sub_code`) REFERENCES `subjects` (`ac_sub_code`),
  ADD CONSTRAINT `auditing_ibfk_2` FOREIGN KEY (`component_id`) REFERENCES `component` (`component_id`),
  ADD CONSTRAINT `auditing_ibfk_5` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`transaction_id`),
  ADD CONSTRAINT `auditing_ibfk_6` FOREIGN KEY (`check_id`) REFERENCES `checking` (`check_id`);

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
-- Constraints for table `component_distribution`
--
ALTER TABLE `component_distribution`
  ADD CONSTRAINT `component_distribution_ibfk_1` FOREIGN KEY (`component_id`) REFERENCES `component` (`component_id`),
  ADD CONSTRAINT `component_distribution_ibfk_2` FOREIGN KEY (`sub_id`) REFERENCES `sub_distribution` (`sub_id`);

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_2` FOREIGN KEY (`level_id`) REFERENCES `course_level` (`level_id`),
  ADD CONSTRAINT `courses_ibfk_3` FOREIGN KEY (`school_id`) REFERENCES `schools` (`school_id`);

--
-- Constraints for table `detained_subject`
--
ALTER TABLE `detained_subject`
  ADD CONSTRAINT `detained_subject_ibfk_1` FOREIGN KEY (`roll_id`) REFERENCES `roll_list` (`roll_id`),
  ADD CONSTRAINT `detained_subject_ibfk_2` FOREIGN KEY (`detained_sub_id`) REFERENCES `sub_distribution` (`sub_id`);

--
-- Constraints for table `edit_tr_request`
--
ALTER TABLE `edit_tr_request`
  ADD CONSTRAINT `ac_subjec_code` FOREIGN KEY (`ac_sub_code`) REFERENCES `subjects` (`ac_sub_code`),
  ADD CONSTRAINT `edit_tr_request_ibfk_1` FOREIGN KEY (`roll_id`) REFERENCES `roll_list` (`roll_id`),
  ADD CONSTRAINT `edit_tr_request_ibfk_2` FOREIGN KEY (`requester`) REFERENCES `operators` (`operator_id`);

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
  ADD CONSTRAINT `retotal_roll_list_ibfk_1` FOREIGN KEY (`roll_id`) REFERENCES `roll_list` (`roll_id`),
  ADD CONSTRAINT `retotal_roll_list_ibfk_2` FOREIGN KEY (`retotal_session_id`) REFERENCES `retotal_sessions` (`retotal_session_id`);

--
-- Constraints for table `retotal_sessions`
--
ALTER TABLE `retotal_sessions`
  ADD CONSTRAINT `retotal_sessions_ibfk_1` FOREIGN KEY (`ac_session_id`) REFERENCES `academic_sessions` (`ac_session_id`);

--
-- Constraints for table `retotal_subjects`
--
ALTER TABLE `retotal_subjects`
  ADD CONSTRAINT `retotal_subjects_ibfk_1` FOREIGN KEY (`retotal_roll_id`) REFERENCES `retotal_roll_list` (`retotal_roll_id`),
  ADD CONSTRAINT `retotal_subjects_ibfk_2` FOREIGN KEY (`sub_id`) REFERENCES `sub_distribution` (`sub_id`);

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
  ADD CONSTRAINT `reval_roll_list_ibfk_2` FOREIGN KEY (`roll_id`) REFERENCES `roll_list` (`roll_id`);

--
-- Constraints for table `reval_sessions`
--
ALTER TABLE `reval_sessions`
  ADD CONSTRAINT `reval_sessions_ibfk_1` FOREIGN KEY (`ac_session_id`) REFERENCES `academic_sessions` (`ac_session_id`);

--
-- Constraints for table `reval_subjects`
--
ALTER TABLE `reval_subjects`
  ADD CONSTRAINT `reval_subjects_ibfk_1` FOREIGN KEY (`reval_roll_id`) REFERENCES `reval_roll_list` (`reval_roll_id`),
  ADD CONSTRAINT `reval_subjects_ibfk_2` FOREIGN KEY (`sub_id`) REFERENCES `sub_distribution` (`sub_id`);

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
  ADD CONSTRAINT `score_ibfk_2` FOREIGN KEY (`component_id`) REFERENCES `component` (`component_id`),
  ADD CONSTRAINT `score_ibfk_3` FOREIGN KEY (`sub_id`) REFERENCES `sub_distribution` (`sub_id`),
  ADD CONSTRAINT `score_ibfk_4` FOREIGN KEY (`check_id`) REFERENCES `checking` (`check_id`),
  ADD CONSTRAINT `score_ibfk_5` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`transaction_id`);

--
-- Constraints for table `score_atkt`
--
ALTER TABLE `score_atkt`
  ADD CONSTRAINT `score_atkt_ibfk_2` FOREIGN KEY (`check_id`) REFERENCES `checking` (`check_id`),
  ADD CONSTRAINT `score_atkt_ibfk_3` FOREIGN KEY (`component_id`) REFERENCES `component` (`component_id`),
  ADD CONSTRAINT `score_atkt_ibfk_4` FOREIGN KEY (`sub_id`) REFERENCES `sub_distribution` (`sub_id`),
  ADD CONSTRAINT `score_atkt_ibfk_5` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`transaction_id`),
  ADD CONSTRAINT `score_atkt_ibfk_6` FOREIGN KEY (`atkt_roll_id`) REFERENCES `atkt_roll_list` (`atkt_roll_id`);

--
-- Constraints for table `score_retotal`
--
ALTER TABLE `score_retotal`
  ADD CONSTRAINT `score_retotal_ibfk_1` FOREIGN KEY (`retotal_roll_id`) REFERENCES `retotal_roll_list` (`retotal_roll_id`),
  ADD CONSTRAINT `score_retotal_ibfk_2` FOREIGN KEY (`sub_id`) REFERENCES `sub_distribution` (`sub_id`),
  ADD CONSTRAINT `score_retotal_ibfk_3` FOREIGN KEY (`component_id`) REFERENCES `component_distribution` (`component_id`),
  ADD CONSTRAINT `score_retotal_ibfk_4` FOREIGN KEY (`check_id`) REFERENCES `checking` (`check_id`),
  ADD CONSTRAINT `score_retotal_ibfk_5` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`transaction_id`);

--
-- Constraints for table `score_reval_1_2`
--
ALTER TABLE `score_reval_1_2`
  ADD CONSTRAINT `score_reval_1_2_ibfk_2` FOREIGN KEY (`component_id`) REFERENCES `component` (`component_id`),
  ADD CONSTRAINT `score_reval_1_2_ibfk_3` FOREIGN KEY (`sub_id`) REFERENCES `sub_distribution` (`sub_id`),
  ADD CONSTRAINT `score_reval_1_2_ibfk_4` FOREIGN KEY (`third_reval_id`) REFERENCES `score_reval_3` (`third_reval_id`),
  ADD CONSTRAINT `score_reval_1_2_ibfk_5` FOREIGN KEY (`check_id`) REFERENCES `checking` (`check_id`),
  ADD CONSTRAINT `score_reval_1_2_ibfk_6` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`transaction_id`);

--
-- Constraints for table `score_reval_3`
--
ALTER TABLE `score_reval_3`
  ADD CONSTRAINT `score_reval_3_ibfk_1` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`transaction_id`),
  ADD CONSTRAINT `score_reval_3_ibfk_2` FOREIGN KEY (`check_id`) REFERENCES `checking` (`check_id`);

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

--
-- Constraints for table `sub_distribution`
--
ALTER TABLE `sub_distribution`
  ADD CONSTRAINT `academic_subject_code` FOREIGN KEY (`ac_sub_code`) REFERENCES `subjects` (`ac_sub_code`);

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

--
-- Constraints for table `tr_atkt`
--
ALTER TABLE `tr_atkt`
  ADD CONSTRAINT `tr_atkt_ibfk_2` FOREIGN KEY (`sub_id`) REFERENCES `sub_distribution` (`sub_id`),
  ADD CONSTRAINT `tr_atkt_ibfk_3` FOREIGN KEY (`atkt_roll_id`) REFERENCES `atkt_roll_list` (`atkt_roll_id`);

--
-- Constraints for table `tr_retotal`
--
ALTER TABLE `tr_retotal`
  ADD CONSTRAINT `tr_retotal_ibfk_1` FOREIGN KEY (`retotal_roll_id`) REFERENCES `retotal_roll_list` (`retotal_roll_id`),
  ADD CONSTRAINT `tr_retotal_ibfk_2` FOREIGN KEY (`sub_id`) REFERENCES `score_retotal` (`sub_id`);

--
-- Constraints for table `tr_reval`
--
ALTER TABLE `tr_reval`
  ADD CONSTRAINT `tr_reval_ibfk_2` FOREIGN KEY (`sub_id`) REFERENCES `sub_distribution` (`sub_id`),
  ADD CONSTRAINT `tr_reval_ibfk_3` FOREIGN KEY (`reval_roll_id`) REFERENCES `reval_roll_list` (`reval_roll_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
