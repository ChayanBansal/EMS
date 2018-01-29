-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 29, 2018 at 10:24 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

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
(1, 2016, 1, 3),
(2, 2017, 1, 1),
(3, 2017, 3, 1),
(4, 2016, 3, 3),
(5, 2017, 4, 1),
(6, 2016, 2, 3),
(7, 2017, 2, 1),
(8, 2016, 5, 3),
(9, 2017, 5, 1),
(10, 2017, 6, 1);

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

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `level_id`, `course_name`, `duration`) VALUES
(1, 1, 'Bachelors of Technology Computer Science & Information Technology', 4),
(2, 1, 'Bachelors of Business Administration Retail Management', 3),
(3, 1, 'Bachelors of Technology Automobile', 4),
(4, 1, 'Bachelors of Technology Mechatronics', 4),
(5, 1, 'Bachelors of Business Administration Banking Financial services and Insurance', 3),
(6, 2, 'Masters of Business Administration Banking Financial services and Insurance', 2);

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
  `enrol_no` varchar(12) NOT NULL,
  `semester` int(1) NOT NULL,
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
  `result_withheld` tinyint(1) NOT NULL
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
(2, 'operator', 'operator', 'operator', '5f4dcc3b5aa765d61d8327deb882cf99', 1, 0),
(4, 'Samyak', 'captainsamyak@gmail.com', 'captainsamyak', '296a154b460501a3ca3144c9f8a9d1d7', 1, 0),
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
  `no_prints` int(3) NOT NULL DEFAULT '0'
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
  `gender` char(1) NOT NULL,
  `stud_mobile` varchar(10) NOT NULL,
  `guardian_mobile` varchar(10) DEFAULT NULL,
  `course_id` int(4) NOT NULL,
  `from_year` year(4) NOT NULL,
  `to_year` year(4) NOT NULL,
  `current_sem` int(1) NOT NULL,
  `cgpa` decimal(6,4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`enrol_no`, `first_name`, `middle_name`, `last_name`, `father_name`, `mother_name`, `address`, `gender`, `stud_mobile`, `guardian_mobile`, `course_id`, `from_year`, `to_year`, `current_sem`, `cgpa`) VALUES
('2016AA001001', 'Abhijeet', '', ' Kumbhare', 'Purushottam  Kumbhare', 'Kalpana  Kumbhare', '1A/G1 Jai Shree Villa Sanchar Nagar Main Kanadia Road, Indore (M.P.), 452016', 'M', '9589058079', '', 3, 2016, 2020, 3, NULL),
('2016AA001002', 'Abhijeet', '', ' Shrivastava', 'Dharmendra  Shrivastava', 'Mangla  Shrivastava', '116, Saket Nagar, Flat No. 201, Rachna Appt, Indore (M.P.) 452018', 'M', '8319335164', '', 3, 2016, 2020, 3, NULL),
('2016AA001003', 'Aaditya ', '', ' Jain', 'Narendra Kumar Jain', 'Padma  Jain', ' 98, Peer Gali, Gulab Bhawan Wali Gali, Indore, (M.P.) 452010', 'M', '9753872200', '', 3, 2016, 2020, 3, NULL),
('2016AA001004', 'Aman', '', ' Yadav', 'Dharam Singh Yadav', 'Laxmi  Yadav', '4, Karmchari Colony Khategaon, Dewas, (M.P.) 455336', 'M', '8819826021', '', 3, 2016, 2020, 3, NULL),
('2016AA001005', 'Avani', '', ' Zingade', 'Vijay  Zingade', 'Roopam  Zingade', '201, Vasant Vihar Appt., 164, Saket Nagar,Indore, M.P. 452018', 'F', '9893056563', '', 3, 2016, 2020, 3, NULL),
('2016AA001006', 'Deepak', '', ' Sahu', 'Rajendra Kumar Sahu', 'Malti  Sahu', 'B-466 Ujjwal Nagar NTPC Sipat, Bilaspur, Chattisgarh, 495555', 'M', '9425281363', '', 3, 2016, 2020, 3, NULL),
('2016AA001007', 'Ishan', '  Rajesh ', 'Pusalkar', 'Rajesh Sadashiv Pusalkar', 'Archana Rajesh Pusalkar', '137 ROYAL BUNGLOW, MR 10 SUKHLIYA, Indore, M.P. 452010', 'M', '8878663019', '', 3, 2016, 2020, 3, NULL),
('2016AA001008', 'Jyotirmaya', '', ' Sainy', 'Amitabh  Sainy', ' Dr Monica   Sainy', '142 Sanchar Nagar Extension, Opposite Main Garden, Kanadia Road, Indore, M.P. 452016', 'M', '9826028025', '', 3, 2016, 2020, 3, NULL),
('2016AA001009', 'Kashyap', '', ' Zalavadiya', 'Kishorbhai  Zalavadiya', 'Muktaben  Zalavadiya', 'Darshan Arjunpark Opp Golden Park NanaMava Main Road Rajkot, Gujarat 360005', 'M', '9726360046', '', 3, 2016, 2020, 3, NULL),
('2016AA001010', 'Manasvi', '', ' Narolia', 'Rajesh  Narolia', 'Ritu  Narolia', 'C-1/21 Scheme No. 78, Opposite Patel Motors, AB Road, Indore, M.P. 452010', 'M', '9425937308', '', 3, 2016, 2020, 3, NULL),
('2016AA001011', 'Mohammed', 'Miran ', '  Khan', 'Mohd Jahangir Khan', 'Tahera  Khan', '86 Ashoka Colony, Manik Bagh Road , Indore, M.P. 452014', 'M', '7000850029', '', 3, 2016, 2020, 3, NULL),
('2016AA001013', 'Prathamesh', '', ' Nigam', 'Chitrasen   Nigam', 'Ritu  Nigam', 'F. No. 606, Surendra Residency, Opp. Danan Pani Resturant, E-8 Extention, Bawadia Kalan,  Bhopal, M.P. 462039', 'M', '8871210861', '', 3, 2016, 2020, 3, NULL),
('2016AA001014', 'Saad', '', ' Siddiqui', 'Ameenur Rehman Siddiqui', 'Iffat  Siddiqui', '8, Retghat, Chowki Talaiyya Road, Bhopal, M.P. 462001', 'M', '7772903985', '', 3, 2016, 2020, 3, NULL),
('2016AA001015', 'Sarmad', '', ' Javed', 'Javed  Siddiqui', 'Khalda  Javed', '50, Hawamahal Road, Bhopal, M.P. 462033', 'M', '9009562280', '', 3, 2016, 2020, 3, NULL),
('2016AA001016', 'Shabaz', '', ' Khan', 'Azad  Khan', 'Yasmin  Khan', '10 Jawahar Nagar (AB) Road, Dewas, M.P. 455001', 'M', '8770451750', '', 3, 2016, 2020, 3, NULL),
('2016AA001017', 'Shrikant', '', ' Badade', 'Dattatray  Badade', 'Sangeeta  Badade', '606/C sukhliya, Indore, M.P. 452010', 'M', '8982382495', '', 3, 2016, 2020, 3, NULL),
('2016AA001018', 'Shyam', '', '  Jangid Sharma', 'Satyanarayan Jangid', 'Santosh  Jangid', 'N-1, EB,Scheme No. 94 House No. 279, Indore, M.P. 452010', 'M', '9826744040', '', 3, 2016, 2020, 3, NULL),
('2016AA001019', 'Tanmay', '', ' Jaiswal', 'Vijay   Jaiswal', 'Nitesh  Jaiswal', '309 A Pandit Deendayal Upadyaya Nagar, Sukhliya, Indore, M.P. 452010', 'M', '8982378970', '', 3, 2016, 2020, 3, NULL),
('2016AA001020', 'Vaibhav', '', ' Patidar', 'Vinod  Patidar', 'Ranjana  Patidar', '118 Sadar Bazar , Sagore, Dhar, M.P. 454774', 'M', '8982108010', '', 3, 2016, 2020, 3, NULL),
('2016AA001021', 'Varnika', '', ' Dwivedi', 'Pradeep  Dwivedi', 'Archana  Dwivedi', 'F-2, Ankur Aangan Nipania Road, Indore, M.P. 452010', 'F', '7471114591', '', 3, 2016, 2020, 3, NULL),
('2016AA001022', 'Varun', 'Kumar', '  Yadav', 'Sughar  Singh Yadav', 'Munni Devi Yadav', '6DB Slice No 3, Scheme No 78, Vijay Nagar, Indore, M.P. 452010', 'M', '9479387384', '', 3, 2016, 2020, 3, NULL),
('2016AB001001', 'Aarushi', '', ' Bhansali', 'Dharmendra  Bhansali', 'Madhuri  Bhansali', '163/164 Seth Jagannath Ki Chal ,108 Ash Tower Nemawar Road,Indore', 'F', '7610303939', '', 1, 2016, 2020, 3, NULL),
('2016AB001002', 'Aayushi', '', ' Pachorkar', 'Dinesh Ramesh Pachorkar', 'Rachana Dinesh Pachorkar', '140 Ahilya Nagar ExtensionAnnapurna Main Road,Indore', 'F', '7509999475', '', 1, 2016, 2020, 3, NULL),
('2016AB001003', 'Abhishek', '', ' Dwivedi', 'Arvind  Dwivedi', 'Chandrakala  Dwivedi', 'H No. 428 Scheme No.114 Rajiv Awas Vihar,Indore', 'M', '9993945663', '', 1, 2016, 2020, 3, NULL),
('2016AB001004', 'Aditya', '', ' Gupta', 'Lalit  Gupta', 'Anjali  Gupta', '45 Moon Palace Colony,Indore', 'M', '8889988824', '', 1, 2016, 2020, 3, NULL),
('2016AB001005', 'Aditya', '', ' Jain', 'Vivek  Jain', 'Manisha  Jain', '24 F ,Block-B ,Scheme No.78 Slice-4 Vijaynagar,Indore', 'M', '7389932157', '', 1, 2016, 2020, 3, NULL),
('2016AB001006', 'Aaditya', '', ' Vijayvargiya', 'Rohit   Vijayvargiya', 'Amita  Vijayvargiya', '37 Chatrapati Nagar,13  Kanchan Bagh,Indore', '', '9009344777', '', 1, 2016, 2020, 3, NULL),
('2016AB001007', 'Aishwarya', '', ' Sadhwani', 'Sanjay  Sadhwani', 'Rekha  Sadhwani', 'Flat No.10 ,Amber Building MG,Road,Indore', 'F', '9425154170', '', 1, 2016, 2020, 3, NULL),
('2016AB001008', 'Akshat', '', ' Rai', 'Kailash  Rai', 'Brijlata  Rai', 'Akshat,279 Gulab Bagh Colony Near Dewas Naka,Indore', 'M', '8964815175', '', 1, 2016, 2020, 3, NULL),
('2016AB001009', 'Aman', '', ' Shaikh', 'Azam  Shaikh', 'Kavita  Shaikh', 'C-105, Basant Vihar Colony Behind Bombay Hospital,Indore', 'M', '9425048450', '', 1, 2016, 2020, 3, NULL),
('2016AB001010', 'Anirudha', '', ' Jain', 'Sanjay  Jain', 'Alka  Jain', '217/1 Clerk Colony,Pardeshipura,Indore', 'M', '9009000631', '', 1, 2016, 2020, 3, NULL),
('2016AB001011', 'Anushka', '', ' Mandloi', 'Naman  Mandloi', 'Kalpana  Mandloi', '31-B Sch No. 103, Kesarbagh Road,Indore', 'F', '9713114931', '', 1, 2016, 2020, 3, NULL),
('2016AB001012', 'Apoorv', '', ' Lokhande', 'Sanjay  Lokhande', 'Smita  Lokhande', '104 A Abhinandan Nagar Sukhliya,Indore', 'M', '7415211590', '', 1, 2016, 2020, 3, NULL),
('2016AB001013', 'Aaradhya', '', ' Agrawal', 'Ajay  Agrawal', 'Vandana  Agrawal', '8-9 Sunil Nagar, Near Vandana Nagar,Indore', 'M', '8982674078', '', 1, 2016, 2020, 3, NULL),
('2016AB001014', 'Arish', '', ' Pathak', 'Pankaj Pathak', 'Namita Pathak', '152/A , Near Arun Dairy , Wright Town,Jabulpur', 'M', '8349032999', '', 1, 2016, 2020, 3, NULL),
('2016AB001015', 'Aseem', '', ' Sharma', 'Sunil  Sharma', 'Shyama  Sharma', '45 Anjani Nagar,Airport Road,Indore', 'M', '8085284449', '', 1, 2016, 2020, 3, NULL),
('2016AB001016', 'Ashi', '  Singh ', 'Parihar', 'Anil Kumar Singh', 'Sangeeta  Singh', 'H No 9/2 Sneh Nagar,Hoshangabad Road,Bhopal', 'F', '9826984640', '', 1, 2016, 2020, 3, NULL),
('2016AB001017', 'Ashish', '', ' Arora', 'Ravindra Kumar Arora', 'Sheetal  Arora', 'B-11 Vistara Township Arandiya Phase,Bypass,Jhalaria,Indore', 'M', '8226000064', '', 1, 2016, 2020, 3, NULL),
('2016AB001018', 'Ashrav', '', ' Neema', 'Narsing  Neema', 'Neelam  Neema', '7/5 North Raj Mohalla,Jawahar Marg,Indore', 'M', '9993566188', '', 1, 2016, 2020, 3, NULL),
('2016AB001019', 'Ashray', '', ' Khandelwal', 'Santosh  Khandelwal', 'Uma  Khandelwal', '939 LIG II Sector B Scheme No.71', 'M', '9644336995', '', 1, 2016, 2020, 3, NULL),
('2016AB001020', 'Avani', '', ' Agrawal', 'Sushil  Agarawal', 'Rekha  Agarawal', '25 C, Sevasardar Nagar,Near Geeta Bhavan,Indore', 'F', '9406666201', '', 1, 2016, 2020, 3, NULL),
('2016AB001021', 'Ayush', '', ' Jaiswal', 'Vinod  Jaiswal', 'Ragini   Jaiswal', 'H-48 Vigyan Nagar, Rajendra NagarNear Railway Over Bridge,Indore', 'M', '9753401846', '', 1, 2016, 2020, 3, NULL),
('2016AB001022', 'Chayan', '', ' Bansal', 'Ashok  Bansal', 'Seema  Bansal', 'Flat No. 405, Luv Apartment, Chinar Residency, Kishanganj,Mhow', 'M', '9644959600', '', 1, 2016, 2020, 3, NULL),
('2016AB001023', 'Chinmay', '', ' Bakshi', 'Anand Mukund Bakshi', 'Sonali Anand Bakshi', '108 A Sarvasampanna Nagar,Near Bicholi Hapsi Road,Indore', 'M', '9179275291', '', 1, 2016, 2020, 3, NULL),
('2016AB001024', 'Darshna', '', ' Kathed', 'Dilip  Kathed', 'Varsha  Kathed', '155 Telephone Nagar ,201 Deep Apartment,Indore', 'F', '8770511429', '', 1, 2016, 2020, 3, NULL),
('2016AB001025', 'Deepak', '', ' Goswami', 'Shyam Puri Goswami', 'Lalita Puri Goswami', '202 Main Sukhdev Nagar,Airport Road,Indore', 'M', '9685555755', '', 1, 2016, 2020, 3, NULL),
('2016AB001027', 'Evisha', '', ' Soneja', 'Deepak   Soneja', 'Harsha  Soneja', '115 Vidhya Nagar 101 Ashoka Palace,Indore', 'F', '9907580100', '', 1, 2016, 2020, 3, NULL),
('2016AB001028', 'Gunjan', '', ' Idnani', 'Arjun  Idnani', 'Archana  Idnani', '9-C, Girdhar Nagar,Near St. Paul H.S. School,Indore', 'F', '9669945858', '', 1, 2016, 2020, 3, NULL),
('2016AB001029', 'Harsh', '', 'Sharma', 'Sunil Kumar  Sharma', 'Anita   Sharma', 'C 94,Nehru Nagar,Bhopal', 'M', '8463031814', '', 1, 2016, 2020, 3, NULL),
('2016AB001030', 'Harsh ', '', 'Sharma', 'Tarun  Sharma', 'Kalpana  Sharma', '112-C, Spical Gandhi Nagar,Indore', 'M', '9826424012', '', 1, 2016, 2020, 3, NULL),
('2016AB001031', 'Harshit', '', ' Agrawal', 'Sanjeev  Agrawal', 'Anjali  Agrawal', '60, Radio Colony ,Near Residency Club', 'M', '9827529122', '', 1, 2016, 2020, 3, NULL),
('2016AB001032', 'Himanshu', '', ' Nehchalani', 'Inderchand  Nehchalani', 'Hema  Nehchalani', '213 Revenue Nagar,Annapurna Road,Indore', 'M', '9644807612', '', 1, 2016, 2020, 3, NULL),
('2016AB001033', 'Ishan', '', ' Patle', 'Chandrashekhar Diwakar Patle', 'Ekta  Chandrashekhar Patle', 'House No- 600,Duttnagar,Indore', 'M', '9993592011', '', 1, 2016, 2020, 3, NULL),
('2016AB001034', 'Jagrati', '', ' Arney', 'Kishor  Arney', 'Bharti  Arney', '391 Clerk Colony, MR9,Indore', 'F', '9575201673', '', 1, 2016, 2020, 3, NULL),
('2016AB001035', 'Laksh', '', ' Khandelwal', 'Deepak  Khandelwal', 'Rekha   Khandelwal', '84-B , Bakhtawar Ram Nagar', 'M', '7879255746', '', 1, 2016, 2020, 3, NULL),
('2016AB001036', 'Madhur', '', ' Oza', 'Ashok  Oza', 'Seema  Oza', '46, Vyanktesh Nagar,Aerodrome Road,Indore', 'M', '9827255901', '', 1, 2016, 2020, 3, NULL),
('2016AB001037', 'Malay', '', ' Swarnkar', 'Anoop  Swarnkar', 'Chandrakanta  Swarnkar', '201 Hans Appartment, 609 Grtr. Brijeshwari,Near A.P.S., Piplyahana,Indore', 'M', '8962228824', '', 1, 2016, 2020, 3, NULL),
('2016AB001038', 'Mayank', '', ' Jain', 'Mukesh Jayantiprasad Jain', 'Vandana Mukesh Jain', 'House No A 34, Swapna Srushti, Near Marathi School,Khodiyar Nagar, Koparli Road,Vapi', 'M', '8980709157', '', 1, 2016, 2020, 3, NULL),
('2016AB001039', 'Meet', '', ' Vani', 'Rakesh  Vani', 'Bharti  Vani', 'Mg Road Sadar Bazar Nanpur ,Alirajpur', 'M', '9179474583', '', 1, 2016, 2020, 3, NULL),
('2016AB001040', 'Mohit', '', ' Khandelwal', 'Mahesh  Khandelwal', 'Rupali  Khandelwal', '6, Piplie Bazar,Indore', 'M', '7869620777', '', 1, 2016, 2020, 3, NULL),
('2016AB001041', 'Mukund', '', ' Kalantri', 'Mohit  ', 'Anita  ', '23 Chinar Residency Kishanganj,Mhow', 'M', '9926000151', '', 1, 2016, 2020, 3, NULL),
('2016AB001042', 'Muskan', '', ' Jain', 'Vipin  Jain', 'Anita  Jain', '42 Tilak Nagar Extension,Near Pachori Garden,Indore', 'F', '9424011922', '', 1, 2016, 2020, 3, NULL),
('2016AB001043', 'Muskan', '', ' Patel', 'Ajit  Patel', 'Sushma  Patel', 'Gram Maghardha,Post Nakatua,Narsingpur', 'F', '8305806899', '', 1, 2016, 2020, 3, NULL),
('2016AB001044', 'Nidhi', '', ' Parashar', 'Keshav Kumar Parashar', 'Rashmi  Parashar', '88 Keshav Kunj Shri Nagar ColonyBhandariya Road,Khandwa', 'F', '9977117895', '', 1, 2016, 2020, 3, NULL),
('2016AB001045', 'Nimish', '', ' Vyas', 'Bharat  Vyas', 'Rashmi  Vyas', '534 Kalani Nagar,Airport Road,Indore', 'M', '8989411392', '', 1, 2016, 2020, 3, NULL),
('2016AB001046', 'Nitesh', '', ' Varlani', 'Dilip Kumar Varlani', 'Harsha  Varlani', '35 Badi Sindhi Colony,Harda', 'M', '7697340876', '', 1, 2016, 2020, 3, NULL),
('2016AB001047', 'Nivedita', '', ' Trivedi', 'Dilip Kumar Trivedi', 'Vandana  Trivedi', '82 B Shrikrishna Avenue,Phase -1 Limbodi, Khandwa Road', 'F', '8349282486', '', 1, 2016, 2020, 3, NULL),
('2016AB001048', 'Noopur', '', ' Chhajed', 'Ashok  Chhajed', 'Kiran  Chhajed', '5 -A , Umesh  Nagar  Annapurna Road,Indore', 'F', '9425317754', '', 1, 2016, 2020, 3, NULL),
('2016AB001049', 'Palak', '', ' Garg', 'Dinesh Kumar Garg', 'Manisha  Garg', '62 B Gopur Colony,Annapurna Road,Indore', 'F', '9993016539', '', 1, 2016, 2020, 3, NULL),
('2016AB001050', 'Palash', '', ' Sharma', 'Satish   Sharma', 'Ritu  Sharma', 'F38 2nd Floor Lav Kush Awas Vihar, Sukhliya,Indore', 'M', '9407566541', '', 1, 2016, 2020, 3, NULL),
('2016AB001051', 'Pankhuri', '', ' Panchal', 'Pankaj  Panchal', 'Monica  Panchal', '3 Gorana Palace Dhaba Road,Ujjain', 'F', '7000058281', '', 1, 2016, 2020, 3, NULL),
('2016AB001052', 'Prabuddha', 'Vardhan', ' Shastri', 'Krishna  Shastri', 'Vandana  Shastri', '701/B1 Shehnai Residency,AB Rd MR-9 Square,Indore', 'M', '7999992982', '', 1, 2016, 2020, 3, NULL),
('2016AB001053', 'Prakhar', '', ' Patni', 'Shailendra  Kumar Patni', 'Rashmi  Patni', '129, Matushree Nagar,Indore Road,Harda', 'M', '9479884180', '', 1, 2016, 2020, 3, NULL),
('2016AB001054', 'Prashant', '', ' Choukse', 'Dinesh Mangial Choukse', 'Manju Dinesh Choukse', '77/1 Maruti Nagar,Sukhilya,Indore', 'M', '9075404571', '', 1, 2016, 2020, 3, NULL),
('2016AB001055', 'Priya', '', ' Choudhary', 'Prakash  Choudhary', 'Neelima  Choudhary', '100 Brajeshwari Ex. Near World Cup Square,Indore', 'F', '9630091365', '', 1, 2016, 2020, 3, NULL),
('2016AB001056', 'Priyanshi', '', ' Agrawal', 'Jeetendra  Agrawal', 'Rita  Agrawal', '52,Suyog Parisar Extension,Near Mukherjee Nagar', 'F', '9300592323', '', 1, 2016, 2020, 3, NULL),
('2016AB001057', 'Rachit', '', ' Sachdev', 'Anil Kumar Sachdev', 'Neelam  Sachdev', 'Qtr E-13, Gandhi Sagar Colony, No-3, Teh- Bhanpura, Dist- Mandsaur', 'M', '9425382885', '', 1, 2016, 2020, 3, NULL),
('2016AB001058', 'Raghav', '', 'Mundhra', 'Vijay Kumar Mundhra', 'Deepti  Mundhra', 'Flat No.G-1 Sanskar Aprtment,94-95,Goyal Nagar,Indore', 'M', '9981625830', '', 1, 2016, 2020, 3, NULL),
('2016AB001059', 'Raghav', '', 'Shrivastava', 'Mohan  Shrivastava', 'Rupa  Shrivastava', '30 CJRM,Sukhliya,Indore', 'M', '8719898306', '', 1, 2016, 2020, 3, NULL),
('2016AB001060', 'Rajat', '', ' Pandey', 'Rajendra Kumar Pandey', 'Sapna  Pandey', 'Rewa Bhagwati Nagar,Malakhedi Road,Hoshangabad', 'M', '8964952727', '', 1, 2016, 2020, 3, NULL),
('2016AB001061', 'Rashi', '', ' Jain', 'Rajesh  Jain', 'Manisha  Jain', '15/1 Old Palasia ,Mangalam Pride Flat No. 401,Indore', 'F', '9009945666', '', 1, 2016, 2020, 3, NULL),
('2016AB001062', 'Rishabh', '', ' Sarraf', 'Sunil  Sarraf', 'Krishna  Sarraf', '21 Normal School Road Colony,Indore', 'M', '8962536123', '', 1, 2016, 2020, 3, NULL),
('2016AB001063', 'Ritik', '', ' Gupta', 'Rajesh  Gupta', 'Bhavna  Gupta', '145-B, Ramchandranagar Airport Road,Indore', 'M', '9981459435', '', 1, 2016, 2020, 3, NULL),
('2016AB001064', 'Rituraj', ' Singh ', 'Mourya', 'Bhupendra  Singh Mourya', 'Archana  Mourya', 'HIG-2 , Shriram Kunj, Shriram Colony,Behind Petrol Pump, Mhow Naka,Bhopal', 'M', '9752255744', '', 1, 2016, 2020, 3, NULL),
('2016AB001065', 'Riya', '', ' Pandey', 'Jai Prakash Pandey', 'Mamta  Pandey', '202 Anukul Aprtment,70 Anup Nagar,Indore', 'F', '9425318622', '', 1, 2016, 2020, 3, NULL),
('2016AB001066', 'Rohit', '', ' Choudhary', 'Kishore  Choudhary', 'Indira  Choudhary', '271 Saikripa Colony,Near Bombay Hospital,Indore', 'M', '9174537404', '', 1, 2016, 2020, 3, NULL),
('2016AB001067', 'Roochin', '', ' Dwivedi', 'Mahendra   Dwivedi', 'Bhavana  Dwivedi', '342 Vyanktesh Nagar,Aerodrum Road,Indore', 'M', '7415140895', '', 1, 2016, 2020, 3, NULL),
('2016AB001068', 'Rugal', '', ' Neema', 'Dilip  Neema', 'Amrita  Neema', '17 Shri Krishna Nagar,Airport Road,Indore', 'F', '9425321142', '', 1, 2016, 2020, 3, NULL),
('2016AB001069', 'Saloni', '', ' Jaiswal', 'Jitendra  Jaiswal', 'Sarika  Jaiswal', '1120, Sudama Nagar,Indore', 'F', '8962263594', '', 1, 2016, 2020, 3, NULL),
('2016AB001070', 'Saloni', '', ' Sharma', 'Radha Charan  Sharma', 'Manju  Sharma', '6 Abh 74C Near Narmada Bhavan ,Vijay Nagar,Indore', 'F', '9685567355', '', 1, 2016, 2020, 3, NULL),
('2016AB001071', 'Samyak', '', ' Jain', 'Kamal Kishore Jain', 'Ranuka  Jain', 'V-23,IIMI Campus, Indian Institute Of Management, Rau', 'M', '8085479525', '', 1, 2016, 2020, 3, NULL),
('2016AB001072', 'Saniya', '', ' Jeswani', 'Deepak  Jeswani', 'Seema  Jeswani', '202 Navya Mansion 42 Greater Tirupati,Indore', 'F', '9893027058', '', 1, 2016, 2020, 3, NULL),
('2016AB001073', 'Sanket', '', ' Sanglikar', 'Nitin Padmakar Sanglikar', 'Vaishali Nitin Sanglikar', '18,Indrajeet Nagar Near Upkar Public School,Lalbag Road,Indore', 'M', '9424896771', '', 1, 2016, 2020, 3, NULL),
('2016AB001074', 'Shivani', '', ' Baghel', 'Awadhesh Singh Baghel', 'Astha  Baghel', 'A - 101, Chinar Woodland, Chuna BhattiKolar Road,Bhopal', 'F', '7354455363', '', 1, 2016, 2020, 3, NULL),
('2016AB001075', 'Shubham', ' Neeraj ', 'Goyal', 'Neeraj  Satyaprakash  Goyal', 'Anita Neeraj  Goyal', '41 Laxminagar, Garkheda Parisar,Aurangabad', '', '9225364634', '', 1, 2016, 2020, 3, NULL),
('2016AB001076', 'Shubham', '', ' Pandey', 'Devendra Kumar Pandey', 'Lalita   Pandey', 'B 86 Phase 2 Gail Complex Vijaipur,Guna', 'M', '8989412411', '', 1, 2016, 2020, 3, NULL),
('2016AB001077', 'Simran', '', ' Bhawnani', 'Dilip   Bhawnani', 'Rekha  Bhawnani', '70- Gopalbagh, manikbagh road, Indore', 'F', '8109735350', '', 1, 2016, 2020, 3, NULL),
('2016AB001078', 'Simran', '', ' Jain', 'Manoj  Jain', 'Mrudulata  Jain', 'Behind Varni Vachnalaya 84,Katra Bazar Sagar', 'F', '9827088501', '', 1, 2016, 2020, 3, NULL),
('2016AB001079', 'Snigdha', '', ' Bhagat', 'Manish Ramchandra Bhagat', 'Vaidehi Manish Bhagat', 'C3, Aditi Lane, Dhanwantari Nagar, Rajendra Nagar,Indore', 'F', '8962785116', '', 1, 2016, 2020, 3, NULL),
('2016AB001080', 'Sparsh', '', ' Bhawsar', 'Jitendra  Bhawsar', 'Sangeeta  Bhawsar', '124 M.G. Road, Barwani', 'M', '9424005556', '', 1, 2016, 2020, 3, NULL),
('2016AB001081', 'Sujeet', '', ' Tiwari', 'Pawan Kumar Tiwari', 'Shyama  Tiwari', '1122-H Scheme No.114 Part-1,Vijay Nagar,Indore', 'M', '8349393488', '', 1, 2016, 2020, 3, NULL),
('2016AB001082', 'Swastik', '', ' Malviya', 'Bhagwat Singh Malviya', 'Shraddha  Malviya', '13, Sharma Enclave, Near Nandgaon Apartment, Girdhar Nagar,Indore', 'M', '8989940094', '', 1, 2016, 2020, 3, NULL),
('2016AB001083', 'Tanishq', '', ' Khetpal', 'Sunil  Khetpal', 'Anita  Khetpal', '51-52 Sarvodaya Nagar,Indore', 'M', '9993051011', '', 1, 2016, 2020, 3, NULL),
('2016AB001084', 'Tanishq', '', ' Shashtri', 'Ashok   Shashtri', 'Sarita  Shashtri', '245- M.G. Road, Anand Chaupati,Dhar', 'M', '8989136966', '', 1, 2016, 2020, 3, NULL),
('2016AB001085', 'Tarun', '', ' Goud', 'Yuvraj  Goud', 'Mamta  Goud', 'Type II Quarter No.17 Near Navratan Bagh Telephone Office,Indore', 'M', '9617591998', '', 1, 2016, 2020, 3, NULL),
('2016AB001086', 'Tarun', '', ' Gupta', 'Vipin  Gupta', 'Mala  Gupta', 'B-10 #346 St.No.19 Prem Basti Sangrur', 'M', '7307303120', '', 1, 2016, 2020, 3, NULL),
('2016AB001087', 'Teena', '', ' Malani', 'Rajkumar  Malani', 'Seema  Malani', '2/9 Mahesh Nagar,Indore', 'F', '9406629681', '', 1, 2016, 2020, 3, NULL),
('2016AB001088', 'Tejasva', 'Anil', '  Jaitly', 'Anil N Jaitly', 'Sundram  Jaitly', 'B-303 Silverene Hermitage Chs Off Western Express Highway,Mira Road East,Mumbai', 'M', '9833950656', '', 1, 2016, 2020, 3, NULL),
('2016AB001089', 'Tilak', '', ' Sisodiya', 'Mani Kumar Sisodiya', 'Chandan Bala Sisodiya', '390, Katju Nagar,Ratlam', 'M', '9424823377', '', 1, 2016, 2020, 3, NULL),
('2016AB001090', 'Triveni Prasad', '', '  Verma', 'Shailendra   Verma', 'Mamta  Verma', '100-101 Mangal Murti Krishna Ji Nagar,Indore', 'M', '9752009204', '', 1, 2016, 2020, 3, NULL),
('2016AB001091', 'Vaidehi', '', ' Mehta', 'Sanjay  Mehta', 'Shraddha  Mehta', '24 Ab, Parshwanath Nagar,RTO Road,Indore', 'F', '9406816462', '', 1, 2016, 2020, 3, NULL),
('2016AB001092', 'Vedant', '', ' Agrawal', 'Devendra   Agrawal', 'Dyuti  Agrawal', '525,MR-3,Mahalaxmi Nagar,Indore', 'M', '9755524026', '', 1, 2016, 2020, 3, NULL),
('2016AB001093', 'Vedant ', '', 'Tripathi*', 'Vijay  Tripathi', 'Varsha  Tripathi', '173 Pricanco Colony Flat No.101,Gunjan Appartment,Annapurna Road,indore,452009', 'M', '9993978489', '', 1, 2016, 2020, 3, NULL),
('2016AB001094', 'Vedant', '', ' Paliwal', 'Vipin  Paliwal', 'Archana  Paliwal', 'B/118 M.I.G. Colony,Behind C.H.L. Hospital,Indore', 'M', '8989687724', '', 1, 2016, 2020, 3, NULL),
('2016AB001096', 'Yash', '', ' Joshi', 'Dnesh  Joshi ', 'Vrinda  Joshi', '30 Bhagyashree Colony,Indore', 'M', '9827240714', '', 1, 2016, 2020, 3, NULL),
('2016AB001097', 'Yash', '', ' Sakalley', 'Arvind  Sakalley', 'Kiran  Sakalley', '35,Kalpana Lok Anand Bazaar,Khajrana Road,Indore', 'M', '7869270912', '', 1, 2016, 2020, 3, NULL),
('2016BA001002', 'Aayushi', '', ' Mittal', 'Shyam  Mittal', 'Anita  Mittal', '201,Urvashi Complex,Jaora Compound M.Y. Near B.J.P Office', 'F', '9993631505', '', 5, 2016, 2019, 3, NULL),
('2016BA001003', 'Aayushi', '', ' Sahni', 'Prem  Sahni', 'Shweta  Sahni', '16,Girdhar Nagar Near Mahesh Nagar, Indore, M.P.', 'F', '7898719452', '', 5, 2016, 2019, 3, NULL),
('2016BA001004', 'Abhinav', '', 'Singh Yadav', 'Anirudh Singh Yadav', 'Kanti  Yadav', 'F-119/31 Shivaji Nagar,Indore, M.P.', 'M', '9424454843', '', 5, 2016, 2019, 3, NULL),
('2016BA001005', 'Abhishek ', ' Singh ', ' Thakur', 'Bhim  Singh Thakur', 'Savita Singh Thankur', '107, Chandani Apartment, 2/2 New Palasia, Indore, M.P.', 'M', '8085789999', '', 5, 2016, 2019, 3, NULL),
('2016BA001006', 'Abhishek', '', ' Singhal', 'Virendra  Agrawal', 'Madhubala  Agrawal', '107 Janki Nagar Extention, near Vikram Tower, Indore, M.P.', 'M', '9826068884', '', 5, 2016, 2019, 3, NULL),
('2016BA001008', 'Aditya', '', ' Oad', 'Krishan Kumar Oad', 'Saroj  Oad', '344 A Tulsi Nagar, Near Bombay Hospital, Indore, M.P.', 'M', '9009572475', '', 5, 2016, 2019, 3, NULL),
('2016BA001009', 'Ajju', '', ' Patel', 'Mansur  Patel', 'Shamin  Patel', '168 Dharampuri Solsinda Sanwer', 'M', '7415797781', '', 5, 2016, 2019, 3, NULL),
('2016BA001010', 'Akshat', '', ' Maheshwari', 'Mahesh  Maheshwari', 'Jyoti  Maheshwari', '402, sakar terraces,2/2 new palasia curewell hospital road Indore MP', 'M', '9630001039', '', 5, 2016, 2019, 3, NULL),
('2016BA001011', 'Akshat', '', ' Surya', 'Ashish  Surya', 'Sonal  Surya', '51, Aazad Nagar, Dewas Road, Ujjain', 'M', '9826096601', '', 5, 2016, 2019, 3, NULL),
('2016BA001012', 'Amay', '', ' Gite', 'Yogesh  Shastri', 'Smriti Shastri', 'J 135 LIG Colony Near Kanchan Apartment, Indore, M.P.', 'M', '9617059593', '', 5, 2016, 2019, 3, NULL),
('2016BA001013', 'Amisha', '', ' Sharma', 'Rajesh  Sharma', 'Alka  Sharma', 'A 1/26 Rishi Nagar, Ujjain, M.P.', 'F', '9144424642', '', 5, 2016, 2019, 3, NULL),
('2016BA001014', 'Amolie', '', ' Shukla', 'Ajay  Shukla', 'Neela  Shukla', 'C-501, Balaji Heights, Mahalakshmi Nagar, Bombay Hospital Nipaniya Indore', 'F', '9038099991', '', 5, 2016, 2019, 3, NULL),
('2016BA001015', 'Amrita', '', ' Mahant', 'Virendra  Mahant', 'Alpana  Mahant', '966 Maryada Park Kodariya, Mhow ', 'F', '9926465421', '', 5, 2016, 2019, 3, NULL),
('2016BA001016', 'Anukrati', '', ' Agrawal', 'Hemant  Agrawal', 'Pooja  ', 'BG 228 Sc No 74 C Vijaynagar Indore ', 'F', '9826075300', '', 5, 2016, 2019, 3, NULL),
('2016BA001017', 'Arpit', '', ' Sharma', 'Dilip Kumar Sharma', 'Rashmi  Sharma', 'EK 134 Scheme No. 54, Vijay Nagar, Indore, M.P.', 'M', '9425748688', '', 5, 2016, 2019, 3, NULL),
('2016BA001018', 'Aseem', '', ' Bhale', 'Ashish Vasant Bhale', 'Ujjwala  Bhale', '29 Ravindra Nagar, Near Old Palasia, Indore, M.P.', 'M', '9111190773', '', 5, 2016, 2019, 3, NULL),
('2016BA001019', 'Ashish', '', ' Singh', 'V P   Singh', 'Veena  Singh', 'H No 60, Nagarjun Nagar Khajuri Kalan Road, Bhopal, Indore', 'M', '8989587070', '', 5, 2016, 2019, 3, NULL),
('2016BA001020', 'Atishay', '', ' Patodi', 'Manish Patodi', 'Aanchal  Patodi', 'G2 136 Rajsheela Apartment Ramchandra Nagar Airport Road ', 'M', '9669375440', '', 5, 2016, 2019, 3, NULL),
('2016BA001021', 'Avish', '', ' Lalwani', 'Rajesh  Lalwani', 'Mona   Lalwani', 'G-2 Jawara Tower, 22/2 Manoramaganj, Indore, M.P.', 'M', '8358894881', '', 5, 2016, 2019, 3, NULL),
('2016BA001022', 'Ayushi', '', ' Tripathi', 'Om Prakash  Tripathi', 'Nisha  Tripathi', 'Radha Colony, Behind Canara Bank, A.B. Road,Indore, M.P.', 'F', '7389875444', '', 5, 2016, 2019, 3, NULL),
('2016BA001023', 'Bhumika', '', ' Ghindani', 'Ajay  Ghindani', 'Kritika  Ghindani', '7, Anand Nagar,Chitawad, Navlakha, Indore, M.P.', 'F', '9926324939', '', 5, 2016, 2019, 3, NULL),
('2016BA001024', 'Deepak', '', ' Solanki', 'Dinesh  Solanki', 'Santoshi  Solanki', '9 Maa Vihar Colony, Indore, M.P.', 'M', '9644792311', '', 5, 2016, 2019, 3, NULL),
('2016BA001025', 'Dhanshree', '', ' Nitin Bhale', 'Nitin Vidyadhar Bhale', 'Purnima Nitin Bhale', '238/2, Lokmanya Nagar, RTO Road, Indore, M.P.', 'F', '9993885316', '', 5, 2016, 2019, 3, NULL),
('2016BA001026', 'Dikshant', '', ' Bapat', 'Ulhas  Bapat', 'Ranjana  Bapat', '18, Jati Colony Near Rambagh, Indore, M.P.', 'M', '9826904078', '', 5, 2016, 2019, 3, NULL),
('2016BA001027', 'Disha', '', ' Patodi', 'Devendra  Patodi', 'Neena  Patodi', '7,  Vindhyachal Nagar Airport Road, Near Badaganapati, Indore, M.P.', 'F', '9406575059', '', 5, 2016, 2019, 3, NULL),
('2016BA001028', 'Divyanshu', '', ' Aggarwal', 'Rajender Kumar Aggarwal', 'Monika  Aggarwal', 'H.No. 1542, Sector 10A Gurgaon, Haryana, 122001', 'M', '7840077259', '', 5, 2016, 2019, 3, NULL),
('2016BA001029', 'Dungaram', '', ' Choudhary', 'Dhanaram  Choudhary', 'Kastu Devi  Choudhary', '1 Vaibhav Nagar Kanadia Road, Indore, M.P.', 'M', '9602567322', '', 5, 2016, 2019, 3, NULL),
('2016BA001030', 'Gaurav', '', ' Bajaj', 'Sohanlal  Bajaj', 'Varsha  Bajaj', '10, Geeta Nagar , Near Shishukunj Nursery School, Indore, M.P.', 'M', '9754371729', '', 5, 2016, 2019, 3, NULL),
('2016BA001031', 'Grishma', '', ' Dhoka', 'Dinesh  Dhoka', 'Sunita   Dhoka', '12 HIG Deendayal Puram, Dhar, M.P.', 'F', '7300373274', '', 5, 2016, 2019, 3, NULL),
('2016BA001032', 'Gursaheb', '', ' Singh', 'Gurmukh  Singh', 'Jaspreet  Kaur', 'E 3 HIG Colony AB Road Indore, M.P.', 'M', '8109128429', '', 5, 2016, 2019, 3, NULL),
('2016BA001033', 'Harjeet', '', 'Chouhan', 'Manjeet  Singh', 'Madhu  Chouhan', '209, Nagorkot Eazalpura, Ujjain', 'M', '9827967785', '', 5, 2016, 2019, 3, NULL),
('2016BA001034', 'Himani', ' Anil', '  Sarraf', 'Anil Kumar Sarraf', 'Shweta Anil Sarraf', '21 Normal School Road, Colony, Behind Petorl Pump,Mhow Naka, Indore M.P.', 'F', '9589922287', '', 5, 2016, 2019, 3, NULL),
('2016BA001035', 'Isha', '', ' Gajeshwar', 'Vijay  Gajeshwar', 'Anju  Gajeshwar', '312, MG Road, Sonkatch, Dist- Dewas, M.P.', 'F', '7723906111', '', 5, 2016, 2019, 3, NULL),
('2016BA001036', 'Jaikesh', '', ' Yadav', 'Bhupender  Yadav', 'Poonam  ', 'VPO Sikandar pur Badha Tehsil Maneasar, Gurugram, Haryana India ', 'M', '9266667667', '', 5, 2016, 2019, 3, NULL),
('2016BA001037', 'Mehul', '', ' Shrivastava', 'Mahendra  Shrivastava', 'Pratibha  Shrivastava', '12 RH, Aashirwad Villa, Nipania, Indore, M.P.', 'M', '8720003838', '', 5, 2016, 2019, 3, NULL),
('2016BA001038', 'Mohit', '', ' Rahadwani', 'Satram Das Rahadwani', 'Vandana  Rahadwani', 'Behind jain Mandir Padav Mandla MP', 'M', '9109411313', '', 5, 2016, 2019, 3, NULL),
('2016BA001039', 'Nakshatra', '', ' Gaikwad', 'Pramod  Gaikwad', 'Sunita  Gaikwad', 'MIG 40 Mukherji Nagar , Indore, M.P.', 'M', '8305760092', '', 5, 2016, 2019, 3, NULL),
('2016BA001040', 'Nancy', '', ' Jain', 'Narendra Kumar Jain', 'Neelam   Jain', '1078 Sector C, Sukhliya, Indore, M.P.', 'F', '9685251455', '', 5, 2016, 2019, 3, NULL),
('2016BA001041', 'Natasha', '', ' Gidwani', 'Rajesh  Gidwani', 'Sangita  Gidwani', '78,Pricanco Colony, Near Annie Besant School Indore, M.P.', 'F', '9827573777', '', 5, 2016, 2019, 3, NULL),
('2016BA001042', 'Navam', '', ' Gupta', 'Giriraj  Gupta', 'Rekha  Gupta', '23-A Akhand Nagar, Airport Road, Indore, M.P.', 'M', '8871512906', '', 5, 2016, 2019, 3, NULL),
('2016BA001043', 'Noman', '', ' Khan', 'Parvez  Khan', 'Shagufta  Khan', '471, Green Park  Colony Dhar Road, Indore, M.P.', 'M', '8602178863', '', 5, 2016, 2019, 3, NULL),
('2016BA001044', 'Palak', '  Dinesh', ' Manglani', 'Dinesh  Manglani', 'Harsha Dinesh Manglani', 'E 76 Saket Nagar, Opposite Devki Apartment, Indore, M.P. ', 'F', '9669442211', '', 5, 2016, 2019, 3, NULL),
('2016BA001045', 'Palash', '', ' Jain', 'Anoop  Jain', 'Bunty  Jain', '101 Sukhdham Apartments, 165 Vidhya Nagar, Indore, M.P.', 'M', '7389928819', '', 5, 2016, 2019, 3, NULL),
('2016BA001046', 'Parth', '', ' Chawda', 'Anil  Chawda', 'Dimple  Chawda', '66, Mangal Colony Udyan Marg, Ujjain, M.P.', 'M', '8989144740', '', 5, 2016, 2019, 3, NULL),
('2016BA001047', 'Piyush', '', ' Ramani', 'Sunil  Ramani', 'Karishma  Ramani', '98-A Main Ranibagh Colony Main, Khandwa Road, Indore, M.P.', 'M', '9516046210', '', 5, 2016, 2019, 3, NULL),
('2016BA001048', 'Prabal', '', ' Neema', 'Anurag  Neema', 'Pranita  Neema', '8/3 North Rajmohalla, Indore, M.P.', 'M', '7999992985', '', 5, 2016, 2019, 3, NULL),
('2016BA001049', 'Prachi', '', ' Patni', 'Ashok  Patni', 'Sonal  Patni', '61, MG Road, Sonkatch, M.P.', 'F', '8989165388', '', 5, 2016, 2019, 3, NULL),
('2016BA001050', 'Pratik', '', ' Khandelwal', 'Naveen  Khandelwal', 'Preeti  Khandelwal', 'Gupta Disk House, Bada Bazar, Nasrullaganj, Sehore', 'M', '7773098552', '', 5, 2016, 2019, 3, NULL),
('2016BA001051', 'Priyal ', '', ' Maheshwari', 'Sanjay  ', 'Neelima  ', 'F505 Eliteanmol Opposite Adarsh Shishu Vihar School Bengali ', 'F', '9425900895', '', 5, 2016, 2019, 3, NULL),
('2016BA001052', 'Raghav', '', ' Maheshwari', 'Govind Narayan Maheshwari', 'Madhu  Maheshwari', '88 Janki Nagar Ext, Near Talent School', 'M', '9993825585', '', 5, 2016, 2019, 3, NULL),
('2016BA001053', 'Ragini', '', ' Joshi', 'Rajesh  Joshi', 'Anita  Joshi', '783/84, Opp. Shitla Mata Mandir, Paditar Colony , Khajrana, Indore, M.P.', 'F', '8982920169', '', 5, 2016, 2019, 3, NULL),
('2016BA001054', 'Rahil', '', ' Jain', 'Vinay   Jain', 'Sadhana  Jain', '88 Tarani Colony, Indore, M.P.', 'M', '9425034322', '', 5, 2016, 2019, 3, NULL),
('2016BA001055', 'Rajan', '', ' Rajpal', 'Vivek  ', 'Sadhana  ', 'Ek-66 Sch No.54 Vijay Nagar', 'M', '9424753542', '', 5, 2016, 2019, 3, NULL),
('2016BA001056', 'Rashi', '', ' Masand', 'Sanjay   Masand', 'Geeti  Masand', 'F/7, Century Estate, Gulmohur Extension, Indore, M.P.', 'F', '8770567475', '', 5, 2016, 2019, 3, NULL),
('2016BA001057', 'Riddhi', '', ' Kathed', 'Sanjay  Kathed', 'Tanuja   Kathed', '3 Ravindra Nagar, Medicare Hospital, Indore, M.P.', 'F', '8989699484', '', 5, 2016, 2019, 3, NULL),
('2016BA001058', 'Riham', '', ' Thakkar', 'Jitin  Thakkar', 'Archana  Thakkar', '22-24  Yashwant Nivas Road Opposite Rani Sati Gate, Indore, M.P.', 'F', '9406852078', '', 5, 2016, 2019, 3, NULL),
('2016BA001059', 'Rinki', '', ' Joshi', 'Narendra Kumar Joshi', 'Shobhna Joshi', 'H43 Vigyan Nagar Near Rajendra Nagar Indore', 'F', '9826603163', '', 5, 2016, 2019, 3, NULL),
('2016BA001060', 'Ritu', '', ' Verma', 'Poonam Chand Verma', 'Chanchal  Verma', '545, Kalani Nagar, Airport Road, Indore, M.P.', 'F', '8109470605', '', 5, 2016, 2019, 3, NULL),
('2016BA001061', 'Riya', '', ' Samaiya', 'Sanjay  Samaiya', 'Navonnati  Samaiya', '759 Usha Nagar Ext, Near Mahalaxmi Mandir, Indore, M.P.', 'F', '9303245116', '', 5, 2016, 2019, 3, NULL),
('2016BA001062', 'Rohan', '', ' Jain', 'Sharad Kumar Jain', 'Kumud  Jain', '186 Sukhdev Nagar, Airport Road, Indore, M.P.', 'M', '7725054212', '', 5, 2016, 2019, 3, NULL),
('2016BA001063', 'Saheb', '', ' Kochar', 'Prashant  Kochar', 'Kavita  Kochar', '18 Bedekar Colony, Opp. St. Pius School', 'M', '8989593139', '', 5, 2016, 2019, 3, NULL),
('2016BA001065', 'Sakshi', '', ' Modi', 'Sudesh  Modi', 'Swarna  Modi', '23 Ganeshdham Colony, Near Brijeshwari Bangali Square, Indore, M.P.', 'F', '9644038881', '', 5, 2016, 2019, 3, NULL),
('2016BA001066', 'Sakshi', '', ' Pandey', 'Govind   Pandey', 'Kamla   Pandey', 'Block No.10, H.No-127, Khichripur,New Delhi', 'F', '9650043716', '', 5, 2016, 2019, 3, NULL),
('2016BA001067', 'Shivani', '', ' Garg', 'Mahesh   Garg', 'Manju  Garg', '48, Mangal Murti Dham, Navlakha', 'F', '9303242504', '', 5, 2016, 2019, 3, NULL),
('2016BA001068', 'Shruti', '', ' Jain', 'Sanjeev  Jain', 'Surbhi  Jain', '116, Sharma Enclave, Tilak Nagar, Indore, M.P.', 'F', '7400676070', '', 5, 2016, 2019, 3, NULL),
('2016BA001069', 'Simran', '', ' Dhawan', 'Jitendra  Dhawan', 'Anuradha  Dhawan', '12-A Manish Puri Ext Near Paliwal Nagar, Indore, M.P.', 'F', '8770901532', '', 5, 2016, 2019, 3, NULL),
('2016BA001070', 'Simran', '', ' Juneja', 'Naveen   Juneja', 'Nidhi  Juneja', '75 Anoop Nagar, Main Road, Opp CHL Hospital', 'F', '9926807051', '', 5, 2016, 2019, 3, NULL),
('2016BA001071', 'Simran', '', ' Khushwani', 'Narendra  Khushwani', 'Juhi  Khushwani', 'E-18 HIG Colony Behind Shaifali Jain Hospital,  Behind Andhra Bank, Indore, M.P. ', 'F', '9425910575', '', 5, 2016, 2019, 3, NULL),
('2016BA001072', 'Sonam', '', ' Vyas', 'Ashok  Vyas', 'Vinita  Vyas', '95 Prakash Nagar Navlakha, Indore, M.P.', 'F', '9893171857', '', 5, 2016, 2019, 3, NULL),
('2016BA001073', 'Srajan', '', ' Singh Tomar', 'Late Satish Singh Tomar', 'Anuradha  Tomar', '101,C-Block,Sanghvi Residency, Opposite Kalindi Midtown,Bicholi , Indore M.P.', 'M', '9755657805', '', 5, 2016, 2019, 3, NULL),
('2016BA001074', 'Suyasha', '', ' Narolia', 'Rajesh  ', 'Ritu  ', 'C 1/21 Sch No.78 Opp.Patel Motors A B Road, Indore, M.P.', 'F', '7869567074', '', 5, 2016, 2019, 3, NULL),
('2016BA001075', 'Tanvi', '', ' Modi', 'Anil  Modi', 'Sapna  Modi', '568 Kalani Nagar Airport Road, Indore, M.P.', 'F', '9770349070', '', 5, 2016, 2019, 3, NULL),
('2016BA001076', 'Tanya', '', ' Jain', 'Vipul  Jain', 'Shalini  Jain', 'GH-4, Scheme No.54, near S.I.C.A. School, Indore M.P.', 'F', '9406682829', '', 5, 2016, 2019, 3, NULL),
('2016BA001078', 'Vibhuti', '', ' Yadav', 'Pankaj  Yadav', 'Ratna  Yadav', '174, Preconco Colony, Flat No. 102, Annapurna Road, Indore, M.P.', 'F', '9009442585', '', 5, 2016, 2019, 3, NULL),
('2016BA001079', 'Vinit', '', ' Makhija', 'Shrichand  Makhija', 'Lata  Makhija', '65 Basant Puri,Opp Maa Vihar,Colony, Indore, M.P.', 'M', '9009389317', '', 5, 2016, 2019, 3, NULL),
('2016BB001001', 'Aditya', '', ' Gupta', 'Giriraj  Gupta', 'Anju  Gupta', '301, Vyanktesh Nagar, Air Port Road, Opp-BSF Water tank, Inodre, M.P.', 'M', '9926686775', '', 2, 2016, 2019, 3, NULL),
('2016BB001002', 'Aditya', '', ' Singhal', 'Swadesh  Singhal', 'Kavita  Singhal', '201, 62/1,South Tukoganj Indore', 'M', '9993895215', '', 2, 2016, 2019, 3, NULL),
('2016BB001003', 'Afrid', '', ' Khan', 'Sadik  Khan', 'Farida  Khan', '02, Shanti Nagar, shri nagar ext shrinathji residency tilaknagar Indore ', 'M', '9009005838', '', 2, 2016, 2019, 3, NULL),
('2016BB001004', 'Aftab', '', ' Jagirdar', 'Abdul Wadood Jagirdar', 'Nadra Bee Jagirdar', '7/3 Mohanpura, Jawaharmarg, Indore, M.P.', 'M', '7389613333', '', 2, 2016, 2019, 3, NULL),
('2016BB001005', 'Akansha', '', ' Maheshwari', 'Deepak  Maheshwari', 'Varsha  Maheshwari', '23/Aakshay deep colony  MR9 AB Road Indore 452001', 'F', '9039009913', '', 2, 2016, 2019, 3, NULL),
('2016BB001007', 'Ankit', '', ' Soni', 'Vishnu  Soni', 'Sunita  Soni', '164/4, Sunder Nagar, Sawer Road, Industrial Area, Banganga, Indore, M.P.', 'M', '7692908069', '', 2, 2016, 2019, 3, NULL),
('2016BB001008', 'Anushi', '', ' Sheth', 'Deepak  Sheth', 'Priti  Sheth', '4/2 New Palasia Mahek App, Indore 452001', 'F', '9425349240', '', 2, 2016, 2019, 3, NULL),
('2016BB001009', 'Apoorva', '', ' Upadhyay', 'Anil Kumar Upadhyay', 'Meena  Upadhyay', '430, MIG Duplex Nalanda Parisar, Kesarbagh Road ,Indore', 'F', '9425911830', '', 2, 2016, 2019, 3, NULL),
('2016BB001010', 'Archesh', '', ' Patodi', 'Nilesh  Patodi', 'Archana  Patodi', '111, Ramchandra Nagar, Airport Road, Indore, M.P.', 'M', '9425353721', '', 2, 2016, 2019, 3, NULL),
('2016BB001012', 'Avi', '', ' Soni', 'Sanjay  ', 'Shweta  ', '39/2 Malharganj, Indore, M.P.', 'M', '9522222190', '', 2, 2016, 2019, 3, NULL),
('2016BB001013', 'Bhumika', '', ' Sodhani', 'Ajay Shankarlal Sodhani', 'Sarita Ajay Sodhani', '67, Vishwakarmanagar, Annapurna Road, Indore, M.P.', 'F', '9826041200', '', 2, 2016, 2019, 3, NULL),
('2016BB001015', 'Harjot', ' Singh', ' Bindra', 'Harjinder  Singh Bindra', 'Manmeet Kaur ', 'ward no 14 Makam M arya nagar suraj ganj Itarsi 461111', 'M', '7879591006', '', 2, 2016, 2019, 3, NULL),
('2016BB001017', 'Himanshu', '', ' Agrawal', 'Rajnish   Agrawal', 'Sunita  Agrawal', 'Ward-05, Opp Jain Temple, Narsingh Ward, Harda, M.P.', 'M', '9424471151', '', 2, 2016, 2019, 3, NULL),
('2016BB001018', 'Hitesh', '', ' Bhatter', 'Mr Rakesh Bhatter  ', 'Mrs Mamta Bhatter  ', 'Kabra Colony, Near Kabra Water Tank, Pipariya, M.P.', 'M', '8982446447', '', 2, 2016, 2019, 3, NULL),
('2016BB001019', 'Jatin', '', ' Kukreja', 'Prakash  Kukreja', 'Neelima  Kukreja', '8 Raj Mahal colony Extension Manik bagh road Indore 452001', 'M', '9302251000', '', 2, 2016, 2019, 3, NULL),
('2016BB001020', 'Jay', 'Vardhan', ' Jain', 'Surendra  Jain', 'Asha  Jain', '34, Vikas Nagar, 14/2 Neemuch, M.P.', 'M', '7000736767', '', 2, 2016, 2019, 3, NULL),
('2016BB001021', 'Kartik', '', ' Mirchandani', 'Mahesh  Mirchandani', 'Rajni  Mirchandani', '7 Sadhu Nagar Manik bagh road Indore 452007', 'M', '7566193000', '', 2, 2016, 2019, 3, NULL),
('2016BB001022', 'Kushagra', '', ' Kasliwal', 'Pankaj   Kasliwal', 'Ritu  Kasliwal', '705 Sai Sampada, behind lotus Showroom, A.B. Road, Indore, M.P.', 'M', '8103057336', '', 2, 2016, 2019, 3, NULL),
('2016BB001025', 'Megha', '', ' Laddha', 'Ashok Narayan Das Laddha', 'Rekha Ashok Laddha', '167-168, Flat No. 304, Sukhniwas Appartment, Precanco Colony, Indore, M.P.', 'F', '9039779258', '', 2, 2016, 2019, 3, NULL),
('2016BB001027', 'Mohammed', '  Sohail ', 'Mansoori', 'Mubarik  Mansoori', 'Naseem  Mansoori', '14, near Gandhi Chowk, Shivalaya Road Pachore, Rajgarh,M.P. 465683', 'M', '8109759464', '', 2, 2016, 2019, 3, NULL),
('2016BB001028', 'Mohammad', ' Basit ', 'Ahmed', 'Sadik  Ahmed', 'Naima  Ahmed', '40/2 & 42/2, Mohanpura, Jawaharmarg, Indore', 'M', '9644565666', '', 2, 2016, 2019, 3, NULL),
('2016BB001029', 'Mudit', '', ' Johri', 'Sumeet   Johri', 'Ruby  Johri', '46/1, Shakkar Bazar, Indore, M.P.', 'M', '9826127008', '', 2, 2016, 2019, 3, NULL),
('2016BB001030', 'Palak', '', ' Maheshwari', 'Prakash  Maheshwari', 'Nayan  Maheshwari', '52, Neelkanth Colony, Near Jain Temple, Jinsi, Indore, M.P.', 'F', '9009963610', '', 2, 2016, 2019, 3, NULL),
('2016BB001031', 'Pankaj', '', ' Sharma', 'Gopal   Sharma', 'Vimla  Sharma', 'RZ 34 gali no 25 B near mother dairy indira park palam village Delhi Cantt Delhi 110045', 'M', '9461056712', '', 2, 2016, 2019, 3, NULL),
('2016BB001032', 'Parth', '', ' Sharma', 'Umesh  Sharma', 'Sunita   Sharma', '23, Rasmandal, Dhar, M.P.', 'M', '9644147448', '', 2, 2016, 2019, 3, NULL),
('2016BB001033', 'Parv', '', ' Jain', 'Prakash  Chand  Jain', 'Sujata  Jain', 'B.S. Jain, Naya Bangla, Rajeev Nagar Ward, B.S. Jain Road, Moti Nagar, Sagar, M.P.', 'M', '8770161988', '', 2, 2016, 2019, 3, NULL),
('2016BB001034', 'Prameet', '', ' Gupta', 'Rajendra Kumar Gupta', 'Manjula  Gupta', 'S.D. 287 MPPGCL Colony, Sarni 460447', 'M', '8770817983', '', 2, 2016, 2019, 3, NULL),
('2016BB001035', 'Pryash', '', ' Khandelwal', 'Narendra  Khandelwal', 'Kiran  Khandelwal', 'B-2/102, Paras City, E-3, Arera Colony, Bhopal, M.P.', 'M', '8871464333', '', 2, 2016, 2019, 3, NULL),
('2016BB001036', 'Rajwardhan', '', ' Singh', 'Ajay  Singh', 'Asha  Singh', '401, Rupal Appt 68, shankarbagh colony near marimata square, Indore, M.P.', 'M', '9993905444', '', 2, 2016, 2019, 3, NULL),
('2016BB001037', 'Rishita', '', ' Jain', 'Vijay  Jain', 'Honey  Jain', 'BG 235 scheme no. 54 Indore 452010', 'F', '9893493772', '', 2, 2016, 2019, 3, NULL),
('2016BB001038', 'Samruddhi', '', ' Zambre', 'Shyam   Zambre', 'Shubha  Zambre', '292, Lokmanya Nagar, Keshar Bagh Road, Indore, M.P.', 'F', '8827660984', '', 2, 2016, 2019, 3, NULL),
('2016BB001041', 'Saurabh', '', ' Pahuja', 'Rajeev  Pahuja', 'Kajol  Pahuja', '4, Manishpuri, Paliwal Nagar, Indore, M.P.', 'M', '8989005954', '', 2, 2016, 2019, 3, NULL),
('2016BB001042', 'Shreyance', '', ' Bhandari', 'Ajay Surendra Bhandari', 'Babita Ajay Bhandari', '75/B Bhawanipur Colony, Indore, M.P.', 'M', '9300640077', '', 2, 2016, 2019, 3, NULL),
('2016BB001043', 'Shubham', '', ' Solanki', 'Mahesh Singh  ', 'Bhagwati  Solanki', '9 Maa Vihar Colony Indore 452001', 'M', '7771080777', '', 2, 2016, 2019, 3, NULL),
('2016BB001044', 'Siddhi', '', ' Untwale', 'Shashikant Prabhakar Untwale', 'Supriya Shashikant Untwale', '83, VIP Paraspar Nagar, Indore, Scheme No. 97/4, Slice-4', 'F', '7389778474', '', 2, 2016, 2019, 3, NULL),
('2016BB001045', 'Sourabh', '', ' Agrawal', 'Naveen  Agrawal', 'Shashi  Agrawal', '121, Agrawal Nagar, Indore, M.P.', 'M', '9644472846', '', 2, 2016, 2019, 3, NULL),
('2016BB001046', 'Yash', '', ' Gupta', 'Shailendra   Gupta', 'Neetu  Gupta', '65/A Shrikant Palace Colony, near Bengali Square', 'M', '9589171073', '', 2, 2016, 2019, 3, NULL),
('2016BB001047', 'Yashraj', '', 'Lokesh  Rampuria', 'Lokesh  Rampuria', 'Meena  Rampuria', '503- Simran Park, 5-Nehru Park Road, Opp. New railway Station, Indore, M.P.', 'M', '9993312739', '', 2, 2016, 2019, 3, NULL),
('2016BB001048', 'Yashraj', ' Singh', ' Solanki', 'Surendra Singh Solanki', 'Mamta  Solanki', 'Maharana Pratap Ward, Pandhana Dist. Khandwa, M.P.', 'M', '8959120555', '', 2, 2016, 2019, 3, NULL),
('2016BB001049', 'Yukti', '  Kumari', ' Chugh', 'Sanjay Kumar Chugh', 'Rekha  Chugh', '76 Vasudev Nagar Manik Bagh Road city 2 Indore MP 452002', 'F', '9009588927', '', 2, 2016, 2019, 3, NULL),
('2017BBBF001', 'AAYUSHI', '', 'SINGH', 'SANJAY SINGH', 'SARIKA SINGH', 'S/O DURGVIJAY SINGH, VETERINARY HOSPITAL ARNAY, JALOR (RJ)', 'F', '8601261410', '', 5, 2017, 2020, 1, NULL),
('2017BBBF002', 'ABHYUDAY', '', 'PANDEY', 'ASHOK PANDEY', 'CHETNA PANDEY', '261 OMAXE CITY 2,MAGLIYA BYPASS,INDORE (MP)', 'M', '9752977473', '', 5, 2017, 2020, 1, NULL),
('2017BBBF003', 'ADITI', '', 'DUBEY', 'LAXMIKANT DUBEY', 'VANDANA DUBEY', '151, GANESH SHANKAR VIDYARTHI, HARDA (MP)', 'F', '9425042015', '', 5, 2017, 2020, 1, NULL),
('2017BBBF004', 'ADITYA', '', 'SHARMA', 'LATE MR AKHILESH SHARMA', 'DEEPTI SHARMA', '200 SACHIDANAND NAGAR, KESAR BAGH ROAD, INDORE (MP)', 'M', '9993426599', '', 5, 2017, 2020, 1, NULL),
('2017BBBF005', 'ADITYA', '', 'SIRPURKAR', 'ATUL SIRPURKAR', 'MANISHA SIRPURKAR', 'D-404 SHEHNAI RESIDENCY OPP HOTEL AMAR VILAS A.B.ROAD, INDORE (MP)', 'M', '9644533049', '', 5, 2017, 2020, 1, NULL),
('2017BBBF006', 'AKSHAY', '', 'RATHI', 'HANUMAN PRASAD RATHI', 'PREMLATA RATHI', '69, SHRIKANT PALACE BICHOLI ROAD, INDORE (MP)', 'M', '9691903475', '', 5, 2017, 2020, 1, NULL),
('2017BBBF007', 'AKSHITA', '', 'GOUR', 'BHUPENDRA SINGH GOUR', 'CHHAYA GOUR', '26-A TELEPHONE NAGAR KANADIA ROAD, INDORE (MP)', 'F', '7987610450', '', 5, 2017, 2020, 1, NULL),
('2017BBBF008', 'AKSHITA', '', 'GUPTA', 'ASHOK GUPTA', 'ANITA GUPTA', '25/1 NORTH RAJMOHALLA, INDORE (MP)', 'F', '9424836346', '', 5, 2017, 2020, 1, NULL),
('2017BBBF009', 'AMAN', '', 'DUGGAD', 'BHUPENDRA KUMAR DUGGAD', 'PRAMILA DUGGAD', '1,NAMAK MANDI NEAR KHARA KUA POLICE CHOWKI, UJJAIN (MP)', 'M', '7987155868', '', 5, 2017, 2020, 1, NULL),
('2017BBBF010', 'AMI', '', 'VADALIA', 'MANOJ VADALIA', 'ABHA VADALIA', 'VADALIA STATE 7/2 YASHWANT NIWAS ROAD, INDORE (MP)', 'F', '9926429966', '', 5, 2017, 2020, 1, NULL),
('2017BBBF011', 'ANANTVIRYA', '', 'JAIN', 'SANJAY JAIN', 'NEELAM JAIN', '104 ROYAL PALACE PRPLIHANA INDORE 105 ROYAL PALACE PEPLIHANA, INDORE (MP)', 'M', '9993675910', '', 5, 2017, 2020, 1, NULL),
('2017BBBF012', 'ANKUR', '', 'DUGGAR', 'ASHOK DUGGAR', 'ARUN SURYA DUGGAR', '103, HORIZON AVENUE 19/16 VISHRAM COLONY Y. N., INDORE (MP)', 'M', '8305722814', '', 5, 2017, 2020, 1, NULL),
('2017BBBF013', 'ANSHI', '', 'MANORIA', 'MOHIT KUMAR MANORIA', 'PURVA MANORIA', 'HUKAMCHAND SUMERCHAND JAIN LAJPATRAI MARG, ASHOK NAGAR (MP)', 'F', '9424482222', '', 5, 2017, 2020, 1, NULL),
('2017BBBF014', 'ANUBHAV', '', 'SINGHAI', 'SWATANTRA SINGHAI', 'RIMI SINGHAI', 'NEAR BUS STAND KILA MOHALLA MUNGALOI, ASHOK NAGAR (MP)', 'M', '9685983609', '', 5, 2017, 2020, 1, NULL),
('2017BBBF015', 'ANUGYA', '', 'SINGH', 'VINOD SINGH', 'SANGEETA JAIN', 'A 83 VEENA NAGAR SUKHLIYA, INDORE (MP)', 'F', '9826071184', '', 5, 2017, 2020, 1, NULL),
('2017BBBF016', 'ANURAG', '', 'CHINCHOLIKAR', 'PRAMOD CHINCHOLIKAR', 'ANITA CHINCHOLIKAR', 'FLAT NO. 202 PRIME PALACE 122-C RAJENDRA NAGAR, INDORE (MP)', 'M', '9753581560', '', 5, 2017, 2020, 1, NULL),
('2017BBBF017', 'ANUSHKA', 'MAHESH', 'WADHWANI', 'MAHESH GYANCHAND WADHWANI', 'SIMRAN WADHWANI', 'GANESH RESIDENCY FLAT NO 401 MATA MAHAKALI ROAD, MAHAKALI, MALKAPUR (MH)', 'F', '7038623290', '', 5, 2017, 2020, 1, NULL),
('2017BBBF019', 'ANIKET', '', 'JAMLIYA', 'PARASMAL JAMLIYA', 'SUSHMA JAMLIYA', '149, MANAWATA NAGAR KANADIA ROAD, INDORE (MP)', 'M', '9755988606', '', 5, 2017, 2020, 1, NULL),
('2017BBBF020', 'ASHUTOSH', '', 'MITTAL', 'VINOD MITTAL', 'VEENA MITTAL', '25, SAI GANGOTRI VIHAR COLONY,  AIRPORT POLICE STATION, INDORE (MP)', 'M', '9926643338', '', 5, 2017, 2020, 1, NULL),
('2017BBBF021', 'AYUSH', '', 'SONI', 'GOPAL SONI', 'BASANTI SONI', 'KASOD DARWAZA NAIYO KI GALI, NIMBAHERA (RJ)', 'M', '7742446135', '', 5, 2017, 2020, 1, NULL),
('2017BBBF022', 'AYUSHI', '', 'JAIN', 'PANKAJ JAIN', 'VANDANA JAIN', '200 VINDCHYAL NAGAR AERODRUM ROAD, INDORE (MP)', 'F', '9111112656', '', 5, 2017, 2020, 1, NULL),
('2017BBBF023', 'AYUSHI', '', 'PANDEY', 'AKHILESH PANDEY', 'ARADHANA PANDEY', '106,SHRI MANGAL NAGAR NR LUV KUSH VIDYA VIHAR BICHOLI HAPSI ROAD, INDORE (MP)', 'F', '7611188876', '', 5, 2017, 2020, 1, NULL),
('2017BBBF024', 'AYUSHI', '', 'RATHOD', 'SANJAY RATHOD', 'MONU RATHOD', '1567 GULLOWA CHOWK, OPP CENTRAL BANK GARHA, JABALPUR (MP)', 'F', '8878737222', '', 5, 2017, 2020, 1, NULL),
('2017BBBF025', 'BHAVYA', '', 'JAIN', 'JITENDRA KUMAR JAIN', 'NISHA JAIN', '119, MAHAVEER NAGAR, INDORE (MP)', 'F', '9589390842', '', 5, 2017, 2020, 1, NULL),
('2017BBBF026', 'BHAVYA', '', 'PUNWANI', 'SANJAY PUNWANI', 'VISHAKHA PUNWANI', '9-D SEVA SARDAR NAGAR  BEHIND GEETA BHAWAN TEMPLE, INDORE (MP)', 'F', '9893480109', '', 5, 2017, 2020, 1, NULL),
('2017BBBF027', 'BHAWANA', '', 'BOTHRA', 'NAWRATAN KUMAR BOTHRA', 'SHAKUNTALA BOTHRA', '303-A BLOCK, SKY HEIGHTS BUILDING, NAVLAKHA SQUARE, A.B. ROAD, INDORE (MP)', 'F', '9977935421', '', 5, 2017, 2020, 1, NULL),
('2017BBBF028', 'BHOOMIKA', 'RAJESH', 'SHAH', 'RAJESH CHANDRAKANT SHAH', 'VANDANA SHAH', '16/1, SOUTH TUKOGANJ  FLAT NO.203, SAMAVOSHARAN APPARTMENT, INDORE (MP)', 'F', '9752159118', '', 5, 2017, 2020, 1, NULL),
('2017BBBF029', 'CHAHETI', '', 'ORA', 'VINEET ORA', 'VARSHA ORA', 'CH-11 SUKHLIYA, INDORE (MP)', 'F', '9229256110', '', 5, 2017, 2020, 1, NULL),
('2017BBBF030', 'CHINMAY', '', 'AGRAWAL', 'DEEPAK AGRAWAL', 'KIRAN AGRAWAL', '18 INDORE DHAR ROAD, BETMA, INDORE (MP)', 'M', '9425030277', '', 5, 2017, 2020, 1, NULL),
('2017BBBF031', 'DEEPANSH', '', 'JAIN', 'MITESH JAIN', 'MONIKA JAIN', '54, AHILYA MATA COLONY RANI SATI GATE, INDORE (MP)', 'M', '9407116549', '', 5, 2017, 2020, 1, NULL),
('2017BBBF033', 'DEVASHISH', '', 'KUSHWAHA', 'DEVENDRA SINGH KUSHWAHA', 'DEVKI KUSHWAHA', '146 A VEENA NAGAR NX PRIME CITY SUKHLIA BEHIND MADANMAHAL GARDEN, INDORE (MP)', 'M', '9644163237', '', 5, 2017, 2020, 1, NULL),
('2017BBBF034', 'DIKSHA', '', 'YADAV', 'RAMESH YADAV', 'RADHA YADAV', '40 ANANDGANJ KI JHIRI INDORE GATE UJJAIN (MP)', 'F', '9826048940', '', 5, 2017, 2020, 1, NULL),
('2017BBBF035', 'DIVYANSHI', '', 'SHARMA', 'SUNIL SHARMA', 'SUMONA SHARMA', 'FLAT NO. 103 MALWA ENCLAVE SCHEME NO. 54 VIJAY NAGAR, INDORE (MP)', 'F', '7879999712', '', 5, 2017, 2020, 1, NULL),
('2017BBBF036', 'DIVY', '', 'TONGIYA', 'RAJESH TONGIYA', 'SARITA TONGIYA', '110 SUKHDEV NAGAR MAIN AIRPORT ROAD, INDORE (MP)', 'M', '9926842641', '', 5, 2017, 2020, 1, NULL),
('2017BBBF037', 'GAIRIK', '', 'ROY', 'AKHIL BANDHU ROY', 'RITA ROY', '86/B SANCHAR NAGAR EXT KANADIA ROAD, INDORE (MP)', 'M', '8839347625', '', 5, 2017, 2020, 1, NULL),
('2017BBBF038', 'GARIMA', '', 'VYAS', 'RAVINDRA VYAS', 'KIRTI VYAS', '101 SECTOR A SURYADEV NAGAR, INDORE (MP)', 'F', '9424025678', '', 5, 2017, 2020, 1, NULL),
('2017BBBF039', 'HARSH', '', 'JAISWAL', 'SUNIL JAISWAL', 'NANDANA JAISWAL', '148 RNT MARG HOTEL RAMA INN. CHAVNI, INDORE (MP)', 'M', '9926800060', '', 5, 2017, 2020, 1, NULL),
('2017BBBF040', 'HARSHITA', '', 'KALA', 'VIJAY KALA', 'SHWETA KALA', '42/B, SCHEME NO. 103 KESHARBAGH ROAD NEAR CHAMELI DEVI PUBLIC SCHOOL, INDORE (MP)', 'F', '8770123124', '', 5, 2017, 2020, 1, NULL),
('2017BBBF041', 'HERIN', '', 'DOSHI', 'DEVENDRA DOSHI', 'MANJULA DOSHI', '36 , SAI GANGOTRI NEAR BHUTESHWAR MANDIR, PANCHKUIYA, INDORE (MP)', 'F', '9009099679', '', 5, 2017, 2020, 1, NULL),
('2017BBBF042', 'HRITIKA', '', 'SETHIA', 'ASHOK KUMAR SETHIA', 'USHA SETHIA', '301, LAKSHYA AVENUE 4/4, MANORAMAGANJ, INDORE (MP)', 'F', '9425317186', '', 5, 2017, 2020, 1, NULL),
('2017BBBF043', 'HUSAIN', '', 'ALI', 'JOHAR ALI', 'HUSAINA RANI', '134,SAIFY NAGAR KHATIWALA TANK, INDORE (MP)', 'M', '7389921783', '', 5, 2017, 2020, 1, NULL),
('2017BBBF044', 'ISHA', '', 'JAJU', 'RAJESH JAJU', 'SANGEETA JAJU', 'ISHA JAJU D/O RAJESH JAJU, JAJU ELECTRONICS, PURA BAZAAR BETMA, INDORE (MP)', 'F', '8319873214', '', 5, 2017, 2020, 1, NULL),
('2017BBBF045', 'JAYASTHA', '', 'GARG', 'PRAVEEN GARG', 'NIDHI GARG', '507 VICTORIA URBANE VALLABH NAGAR, INDORE (MP)', 'F', '9329602401', '', 5, 2017, 2020, 1, NULL),
('2017BBBF046', 'JAYESH', '', 'SONI', 'JAYANT SONI', 'BABITA SONI', '124, JAWAHAR MARG MEAHIDPUR DIST UJJAIN (MP)', 'M', '9009872424', '', 5, 2017, 2020, 1, NULL);
INSERT INTO `students` (`enrol_no`, `first_name`, `middle_name`, `last_name`, `father_name`, `mother_name`, `address`, `gender`, `stud_mobile`, `guardian_mobile`, `course_id`, `from_year`, `to_year`, `current_sem`, `cgpa`) VALUES
('2017BBBF047', 'KANINIKA', '', 'PANDIT', 'SUSHIL GAUTAM', 'AMITESH GAUTAM', '131, VIP PARASPAR NAGAR SCH NO 97 PART 4, SLICE-4 RING ROAD NAVNEET GARDEN, INDORE (MP)', 'F', '7567011752', '', 5, 2017, 2020, 1, NULL),
('2017BBBF048', 'KINJAL', '', 'GANDHI', 'RAJNIKANT GANDHI', 'SWATI GANDHI', 'FLAT NO 302 SAMAVSARAN APPARTMENT 16/1 SOUTHTUKO GANJ, INDORE (MP)', 'F', '9425911337', '', 5, 2017, 2020, 1, NULL),
('2017BBBF049', 'KRISHNA', 'KUMAR', 'SINGH', 'D N SINGH', 'GEETA SINGH', 'VILL BAVANPALI BASDEO,PO ISHRAULI DIST-DEORIA (UP)', 'M', '7771855999', '', 5, 2017, 2020, 1, NULL),
('2017BBBF050', 'MAANU', '', 'SHARMA', 'MAHESH SHARMA', 'PRATIBHA SHARMA', '124,GOYAL VIHAR COLONY NEAR KHAJARANA TEMPLE, INDORE (MP)', 'F', '9827055161', '', 5, 2017, 2020, 1, NULL),
('2017BBBF051', 'MAHEK', '', 'PORWAL', 'VIKAS PORWAL', 'DEEPTI PORWAL', '21 GREEN PARK GOLONY 1/1 SOUTH TUKOGANJ, INDORE (MP)', 'F', '8827749701', '', 5, 2017, 2020, 1, NULL),
('2017BBBF052', 'MANSI', '', 'CHORDIA', 'RAJNEESH CHORDIA', 'ARCHANA', 'C-305 NARIMAN POINT MAHALAXMI NAGAR, INDORE (MP)', 'F', '9887480217', '', 5, 2017, 2020, 1, NULL),
('2017BBBF053', 'MINAL', '', 'KOTIYA', 'MAHESH KOTIYA', 'SMITA KOTIYA', '15/1 SOUTH TUKOGANJ  KRISHNA AVENU FLAT NO 101, INDORE (MP)', 'F', '9516559519', '', 5, 2017, 2020, 1, NULL),
('2017BBBF055', 'MUSKAN', '', 'SAHU', 'AJAY KUMAR SAHU', 'RAJKUMARI SAHU', 'JALPA DEVI WARD KATNI (MP)', 'F', '9755041414', '', 5, 2017, 2020, 1, NULL),
('2017BBBF056', 'NAMAN', '', 'SHARMA', 'RAJESH SHARMA', 'PREETI SHARMA', '6,RAMCHANDRA NAGAR EXT AIRPORT ROAD, INDORE (MP)', 'M', '9575457546', '', 5, 2017, 2020, 1, NULL),
('2017BBBF057', 'NANDINI', '', 'GARG', 'ASHOK GARG', 'AVANTI GARG', '30,DALIYA BAKHAL MALHARGANJ, INDORE (MP)', 'F', '9755371317', '', 5, 2017, 2020, 1, NULL),
('2017BBBF058', 'NANDINI', '', 'MALVIYA', 'NARAYAN MALVIYA', 'ASHA MALVIYA', '189 JANKI NAGAR EXTENSION, INDORE (MP)', 'F', '7617276172', '', 5, 2017, 2020, 1, NULL),
('2017BBBF059', 'NAVNIT', '', 'PATEL', 'SOHAN PATEL', 'SULOCHANA PATEL', '185, SANJANA PARK, NEAR AGARWAL PUBLIC SCHOOL, BICHOLI MARDANA, INDORE (MP)', 'M', '7999792350', '', 5, 2017, 2020, 1, NULL),
('2017BBBF060', 'NAVRAAJ', 'SINGH', 'RANDHAWA', 'AJIT RANDHAWA', 'SIMRAN RANDHAWA', 'E-801,SURYA BLOCK, BCM PARADISE, NIPANIA, INDORE (MP)', 'M', '8770442021', '', 5, 2017, 2020, 1, NULL),
('2017BBBF061', 'NIKHIL', '', 'GOYAL', 'YOGESH GOYAL', 'RADHA GOYAL', '178, JANKI NAGAR EXTENTION, INDORE (MP)', 'M', '9617687585', '', 5, 2017, 2020, 1, NULL),
('2017BBBF062', 'OM', 'SINGH', 'SISODIA', 'DEVENDRA SINGH SISODIA', 'DR SANGEETA RATHORE', '29, DAITYA MAGRI BEHIND NCC OFFICE, UDAIPUR, RAJASTHAN', 'M', '7230077401', '', 5, 2017, 2020, 1, NULL),
('2017BBBF063', 'PALAK', '', 'AGRAWAL', 'SACHIN AGRAWAL', 'MANISHA AGRAWAL', 'CHANDRASHEKHAR MOHALLA WARD NO 09 TEHSIL SEONI MALWA, HOSHANGABAD (MP)', 'F', '9826664065', '', 5, 2017, 2020, 1, NULL),
('2017BBBF064', 'PALAK', '', 'PATEL', 'BHAWNESH PATEL', 'PRATIKSHA PATEL', '401, SUJATA APPARTMENT, 22/1 R.S.BHANDARI MARG, RACE COURSE ROAD, INDORE (MP)', 'F', '7697809020', '', 5, 2017, 2020, 1, NULL),
('2017BBBF065', 'PALKESH', '', 'AGRAWAL', 'SATISH AGRAWAL', 'DEEPA AGRAWAL', '10/3 NEW PALASIA NEAR RECOVERY HOSPITAL, INDORE (MP)', 'M', '7748884884', '', 5, 2017, 2020, 1, NULL),
('2017BBBF066', 'PAROOL', '', 'AGRAWAL', 'SANDEEP AGRAWAL', 'ANJALI AGRAWAL', 'H NO. 2 PARADISE HOUSES OPPOSITE BHAVAN\'S PROMINENET SCHOOL, INDORE (MP)', 'F', '7869510661', '', 5, 2017, 2020, 1, NULL),
('2017BBBF067', 'PAWANI', '', 'PARE', 'RAJESH PARE', 'SUNITA PARE', '81 PADMAWATI COLONY BEHIND ST PAUL H.S SCHOOL, INDORE (MP)', 'F', '9406853248', '', 5, 2017, 2020, 1, NULL),
('2017BBBF068', 'PAYAL', '', 'MAITY', 'DR RAJA MAITY', 'DEEPTI MAITY', '54, RAMANAND NAGAR, LALGHATI BHOAPL (MP)', 'F', '7898442194', '', 5, 2017, 2020, 1, NULL),
('2017BBBF069', 'PRAJJWAL', '', 'JAIN', 'SANJEEV JAIN', 'SHARMILA JAIN', 'ARADHYA 5 M- 62, NIT FARIDABAD DELHI NCR', 'M', '9540201046', '', 5, 2017, 2020, 1, NULL),
('2017BBBF070', 'PRAKHAR', '', 'JAIN', 'KAPIL JAIN', 'NEELAM JAIN', '35/205 2ND FLOOR PARSHAVANATH TOWER SHANKUMARG FREEGUNJ, UJJAIN (MP)', 'M', '8319801209', '', 5, 2017, 2020, 1, NULL),
('2017BBBF071', 'PRANJAL', '', 'RALHAN', 'SURENDRA RALHAN', 'RAKHI RALHAN', '15 DD ESTATES OPP CHURCH GROUND, SEHORE (MP)', 'M', '7089524169', '', 5, 2017, 2020, 1, NULL),
('2017BBBF072', 'PRANJALI', '', 'LAHANE', 'MILIND LAHANE', 'ROHINI LAHANE', 'CH-99, SCHEME NO.-74 VIJAY NAGAR, INDORE (MP)', 'F', '9425055876', '', 5, 2017, 2020, 1, NULL),
('2017BBBF073', 'PRASANG', '', 'GARG', 'SANJAY GARG', 'KAVITA GARG', 'DH 98 SCHEME NO 74C VIJAY NAGAR, INDORE (MP)', 'M', '9179283338', '', 5, 2017, 2020, 1, NULL),
('2017BBBF074', 'PRATHANA', 'GIRISH', 'MUNDRA', 'GIRISH MUNDRA', 'POOJA MUNDRA', '504, IMPERIAL BLOCK SAKAR RESIDENCY OPP. LOTUS SHOWROOM A.B ROAD, INDORE (MP)', 'F', '9522222189', '', 5, 2017, 2020, 1, NULL),
('2017BBBF075', 'PRAVAH', '', 'MUNGAD', 'LATE RAMESH MUNGAD', 'GAYATRI MUNGAD', '347 A/B GUMASTA NAGAR NEAR ARIHANT HOSPITAL, INDORE (MP)', 'M', '9977995522', '', 5, 2017, 2020, 1, NULL),
('2017BBBF076', 'PRITISH', '', 'SHEEL', 'ANAND SHEEL', 'SHUBHRA SHEEL', '682, SUDAMA NAGAR, INDORE (MP)', 'M', '9630009100', '', 5, 2017, 2020, 1, NULL),
('2017BBBF077', 'PRIYAL', '', 'JAIN', 'PAWAN JAIN', 'FULMALA JAIN', '520, MR-5 MAHALAXMI NAGAR, INDORE (MP)', 'F', '9926402881', '', 5, 2017, 2020, 1, NULL),
('2017BBBF078', 'PRIYANSH', '', 'THAKUR', 'ANOOP THAKUR', 'PRITI THAKUR', 'GM 6  SCHEME NO 54 VIJAY NAGAR, INDORE (MP)', 'M', '9407397978', '', 5, 2017, 2020, 1, NULL),
('2017BBBF080', 'PURVI', '', 'JAIN', 'YOGENDRA JAIN', 'ABHILASH JAIN', '403 SUKH SHEETAL APPT-I, 16/1 SOUTH TUKOGANJ, INDORE (MP)', 'F', '9425479725', '', 5, 2017, 2020, 1, NULL),
('2017BBBF081', 'RICHA', '', 'WAIKAR', 'PRAMOD WAIKAR', 'SAVITA WAIKAR', '28 A ANNPURNA NAGAR, INDORE (MP)', 'F', '9826818096', '', 5, 2017, 2020, 1, NULL),
('2017BBBF082', 'RIDDH', 'RAVINDRA', 'BHATTAR', 'RAVINDRA BHATTAR', 'NIDHI BHATTAR', 'SAKAR RESIDENCY. 504-ROYAL BLOCK. IN FRONT OF C21 MALL, NEAR LOTUS SHOWROOM. A.B. ROAD., INDORE (MP)', 'M', '9300595984', '', 5, 2017, 2020, 1, NULL),
('2017BBBF084', 'RISHABH', '', 'JAIN', 'SHRENIK JAIN', 'SUNITA JAIN', '80 AGRASEN NAGAR AIRPORT ROAD, INDORE (MP)', 'M', '8109086803', '', 5, 2017, 2020, 1, NULL),
('2017BBBF085', 'RITWIK', '', 'UPADHYAY', 'VIVEK UPADHYAY', 'JAGRATI UPADHYAY', '128-B PRAGATI NAGAR, RAJENDRA, INDORE (MP)', 'M', '8982253127', '', 5, 2017, 2020, 1, NULL),
('2017BBBF086', 'RONAK', '', 'DANANI', 'SHAILESH DANANI', 'BHAVESHRI DANANI', '11, SAMWAD NAGAR, NAVLAKHA, INDORE (MP)', 'M', '8962869630', '', 5, 2017, 2020, 1, NULL),
('2017BBBF089', 'SAHIL', '', 'CHOUDHARY', 'ATUL CHOUDHARY', 'SANGEETA CHOUDHARY', '182 DH SCHEME NO. 74 C VIJAY NAGAR, INDORE (MP)', 'M', '9174403590', '', 5, 2017, 2020, 1, NULL),
('2017BBBF090', 'SAJAL', '', 'LAHOTI', 'VIJAY LAHOTI', 'VANDANA LAHOTI', '19,JANKI NAGAR MAIN, INDORE (MP)', 'M', '9098181036', '', 5, 2017, 2020, 1, NULL),
('2017BBBF091', 'SAKSHI', '', 'AGARWAL', 'HANUMAN PRASAD AGARWAL', 'URMILA AGARWAL', '275 GOYAL VIHAR COLONY NEAR KHAJRANA MANDIR, INDORE (MP)', 'F', '9425318539', '', 5, 2017, 2020, 1, NULL),
('2017BBBF093', 'SAKSHI', '', 'NATANI', 'MUKESH NATANI', 'PREETI NATANI', '33 AP TIWARI MARG SAKHIPURA DAULATGANJ, UJJAIN (MP)', 'F', '9131285187', '', 5, 2017, 2020, 1, NULL),
('2017BBBF094', 'SAKSHI', '', 'PATNI', 'NAVIN PATNI', 'KAVITA PATNI', '82/A VIDHYANCHAL NAGAR, INDORE (MP)', 'F', '9424535457', '', 5, 2017, 2020, 1, NULL),
('2017BBBF095', 'SALONI', '', 'KAPOOR', 'NARENDRA KAPOOR', 'SUNITA KAPOOR', 'FLAT NO. 101 GULMOHAR NIKETAN BASANT VIHAR NEAR SHANTI NIKETAN COLONY, INDORE (MP)', 'F', '7611145329', '', 5, 2017, 2020, 1, NULL),
('2017BBBF096', 'SAMARTH', '', 'AGRAWAL', 'SHAILENDRA AGRAWAL', 'SHWETA AGRAWAL', '108/3 VALLABH NAGAR, INDORE (MP)', 'M', '9425317744', '', 5, 2017, 2020, 1, NULL),
('2017BBBF097', 'H. SAMRUDDH', '', '', 'S HARI MOHAN IYER', 'SUDHA MOHAN', '202 NAVMI APARTMENTS, #67, 2ND CROSS LAKSHMI NAGAR, BASAWESHWARA NAGAR BANGALORE NORTH, (KL)', 'M', '8920421584', '', 5, 2017, 2020, 1, NULL),
('2017BBBF098', 'SAMRUDDHI', '', 'SUPEKAR', 'LALIT SUPEKAR', 'NEHA SUPEKAR', '135 DHANWANTRI NAGAR RAJENDRA NAGAR, INDORE (MP)', 'F', '9755986914', '', 5, 2017, 2020, 1, NULL),
('2017BBBF099', 'SANAYA', '', 'MITTAL', 'BIHARI MITTAL', 'PREETI MITTAL', '229 BG-74-C VIJAY NAGAR, INDORE (MP)', 'F', '8103781293', '', 5, 2017, 2020, 1, NULL),
('2017BBBF100', 'SANNIDHYA', '', 'MAHAJAN', 'VIKRANT MAHAJAN', 'SARIKA MAHAJAN', '34 (W) SHRIKRISHNA NAGAR AIRPORT ROAD, INDORE (MP)', 'M', '9993168741', '', 5, 2017, 2020, 1, NULL),
('2017BBBF101', 'SANSKAR', '', 'TIWARI', 'RAJENDRA KUMAR TIWARI', 'MADHUKANTA TIWARI', '84, ARYAWARAT EXT 1 ABHINANDAN COLONY, MANDSAUR (MP)', 'M', '8435273712', '', 5, 2017, 2020, 1, NULL),
('2017BBBF102', 'SANYA', '', 'MAHESHWARI', 'SAPAN MAHESHWARI', 'NEETU MAHESHWARI', '44,GHATKAR PAR MARG FREEGUNJ, UJJAIN (MP)', 'F', '8827080808', '', 5, 2017, 2020, 1, NULL),
('2017BBBF103', 'SAUMYA', '', 'TIWARI', 'AWADHESH TIWARI', 'KOMAL TIWARI', '489 SECTOR R MAHALAXMI NAGAR NEAR CHURCH, INDORE (MP)', 'F', '9993044445', '', 5, 2017, 2020, 1, NULL),
('2017BBBF104', 'SAURAV', '', 'DHAWAN', 'ASHOK DHAWAN', 'SHEELA DHAWAN', '40 SHYAM NAGAR MAIN SUKHALIYA, INDORE (MP)', 'M', '8319784573', '', 5, 2017, 2020, 1, NULL),
('2017BBBF105', 'SHIVAM', '', 'BAPNA', 'SUSHEEL BAPNA', 'MONIKA BAPNA', '308 CLASSIC CROWN  5/2 OLD PALASIA , INDORE (MP)', 'M', '9993607794', '', 5, 2017, 2020, 1, NULL),
('2017BBBF106', 'SHIVANI', '', 'BADODIYA', 'RAJESH BADODIYA', 'PINKY BADODIYA', '105, C SPECIAL, GANDHI NAGAR, INDORE (MP)', 'F', '9165300100', '', 5, 2017, 2020, 1, NULL),
('2017BBBF107', 'SHRESTH', '', 'TONGYA', 'AMIT TONGYA', 'DIMPLE TONGYA', '227, LABRIYA BHERU, TONGYA COMPOUND DHAR ROAD, INDORE (MP)', 'M', '9826038591', '', 5, 2017, 2020, 1, NULL),
('2017BBBF109', 'SHRUTI', '', 'TIWARI', 'SHARAD TIWARI', 'RUPALI TIWARI', '47/B ANNAPURNA NAGAR, INDORE (MP)', 'F', '9669666400', '', 5, 2017, 2020, 1, NULL),
('2017BBBF110', 'SHUBHAM', '', 'SURANA', 'NIRBHAY SURANA', 'ANJU SURANA', '36 RAMCHANDRA NAGAR EXT, INDORE (MP)', 'M', '9826672600', '', 5, 2017, 2020, 1, NULL),
('2017BBBF111', 'SHUBHANGI', '', 'MISHRA', 'SOMESH MISHRA', 'SUMAN MISHRA', '411,GOVINDAM GOPALAM APPT. TIRUPATI CO. LALARAM NAGAR INDORE  (MP)', 'F', '9009017797', '', 5, 2017, 2020, 1, NULL),
('2017BBBF112', 'SUMRIDHI', '', 'NAHATA', 'SUNIL NAHATA', 'NEETA NAHATA', 'B-77, BAKHTAWAR RAM NAGAR NEAR TILAK NAGAR, INDORE (MP)', 'F', '9752932900', '', 5, 2017, 2020, 1, NULL),
('2017BBBF113', 'SWAPNIL', '', 'VERMA', 'KAILASH VERMA', 'SHALINI VERMA', 'ARVIND VINAY K.GAMI.15 REVENUE  NAGAR, INDORE', 'M', '9131572283', '', 5, 2017, 2020, 1, NULL),
('2017BBBF114', 'TANISHA', '', 'KATARIA', 'BHISHAM KATARIA', 'ANJU KATARIA', '239/1  MR-4   MAHALAXMI   NAGAR,INDORE,SATYA SAI', 'F', '8878128128', '', 5, 2017, 2020, 1, NULL),
('2017BBBF115', 'TANVI', '', 'JAIN', 'PUSHPENDRA JAIN', 'SEEMA JAIN', 'B 9/5 MAHANANDA NAGAR, UJJAIN (MP)', 'F', '9926908227', '', 5, 2017, 2020, 1, NULL),
('2017BBBF117', 'VANDITA', '', 'MUTHA', 'VIKAS MUTHA', 'DEEPIKA MUTHA', '22 AKSHAYDEEP COLONY MR 9 BEHIND LOTUS SHOWROOM INDORE ', 'F', '8989537673', '', 5, 2017, 2020, 1, NULL),
('2017BBBF118', 'VASU', '', 'SINGHAL', 'M K SINGHAL', 'NEETU SINGHAL', 'B-30 KASTURBA NAGAR, BHOPAL (MP)', 'M', '8305530339', '', 5, 2017, 2020, 1, NULL),
('2017BBBF119', 'VASUDEV', '', 'VIJAYWARGIYA', 'ATUL VIJAYWARGIYA', 'NIKITA VIJAYWARGIYA', '23 SILVER HILLS COLONY, DHAR (MP)', 'M', '9425306721', '', 5, 2017, 2020, 1, NULL),
('2017BBBF120', 'VEDANT', '', 'MITTAL', 'VIPIN MITTAL', 'SEEMA MITTAL', 'D-601, 602, SHEHNAI RESIDENCY, A.B. ROAD, INDORE (MP)', 'M', '9644322322', '', 5, 2017, 2020, 1, NULL),
('2017BBBF121', 'YASH', '', 'BHANDARI', 'YOGENDRA BHANDARI', 'MONIKA BHANDARI', '102,NAVNEET TOWER,5/2 OLD PALASIA GREATER KAILASH ROAD, INDORE (MP)', 'M', '9575683338', '', 5, 2017, 2020, 1, NULL),
('2017BBBF122', 'YASH', '', 'PAL', 'DHARMENDRA KUMAR PAL', 'HEMLATA PAL', 'EK 66 SKEM NO. 54   VJAY NAGAR, INDORE (MP)', 'M', '8964067307', '', 5, 2017, 2020, 1, NULL),
('2017BBBF123', 'YASH', '', 'VIJAYVARGIYA', 'ANURAG VIJAYVARGIYA', 'KIRTI VIJAYVARGIYA', '37, A CHATRAPATI NAGAR, INDORE (MP)', 'M', '9301280450', '', 5, 2017, 2020, 1, NULL),
('2017BBBF124', 'YASHIKA', '', 'RATHORE', 'RAMKRISHNA RATHORE', 'SARITA RATHORE', '69 NANDLAL ROAD, HATOD, INDORE (MP)', 'F', '7898744105', '', 5, 2017, 2020, 1, NULL),
('2017BBBF125', 'YASHVEER', '', 'YADAV', 'RAJKUMAR YADAV', 'MANJEET YADAV', '10/503 KAVERI PATH, MANSAROVAR JAIPUR (RAJASTHAN)', 'M', '9413914002', '', 5, 2017, 2020, 1, NULL),
('2017BBBF126', 'AVANI', '', 'GUPTA', 'SANDEEP GUPTA', 'KIRTI GUPTA', 'FLAT NO. 102, PARK RESIDENCY, 82 SHRI NAGAR EXT., INDORE', 'F', '9589342290', '', 5, 2017, 2020, 1, NULL),
('2017BBBF127', 'BAKALYA', 'RAJPALSINH', 'RAKESHKUMAR', 'RAKESH BAKALIYA', 'USHABEN R BAKARIYA', 'GOVIND NAGAR PRASANG PATIL PLAT DAHAD (GJ)', 'M', '9979665555', '', 5, 2017, 2020, 1, NULL),
('2017BBBF128', 'DIVYA', '', 'GURBANI', 'HARISH GURBANI', 'PRIYANKA GURBANI', '6-D-28, NEW HOUSING BOARD SHASTRI NAGAR BHILWARA (RJ)', 'F', '7726000240', '', 5, 2017, 2020, 1, NULL),
('2017BBBF129', 'TASNEEM', '', 'BOOKWALA', 'JUZAR ALI BOOKWALA', 'MUNIRA', '217, BABJI NAGAR,NEAR MAHINDRA SHOWROOM AB ROAD, INDORE (MP)', 'F', '7771910521', '', 5, 2017, 2020, 1, NULL),
('2017BBBF130', 'VANSHIKA', '', 'GUPTA', 'SURESH GUPTA', 'MUKTA GUPTA', '510, SHANTI NAGAR, NEAR DAMOH NAKA JABALPUR (MP)', 'F', '8319898845', '', 5, 2017, 2020, 1, NULL),
('2017BBBF131', 'YUVRAJ', 'SINGH', 'JADOUN', 'SHIV BAHADUR SINGH JADOUN', 'SAROJ JADON', '109 NANDALAL ROAD HATOD NEAR BANK OF INDIA, INDORE (MP)', 'M', '9340616112', '', 5, 2017, 2020, 1, NULL),
('2017BBBF132', 'SHREYA', '', 'AGRAWAL', 'MANOJ AGRAWAL', 'VARSHA AGRAWAL', '103, P.D. COMPLEX, GUNA NAKA, A.B. RAOD, BIAORA, RAJGARH (MP)', 'F', '9425037663', '', 5, 2017, 2020, 1, NULL),
('2017BBRM001', 'AADITYA', '', 'JAIN', 'AJIT JAIN', 'ANUBHA JAIN', 'GEETA BHAVAN SQUARE, 308 A YASHRAJ RESIDENCY 10/1 MANORAMA GANJ, INDORE (MP)', 'M', '9827137623', '', 2, 2017, 2020, 1, NULL),
('2017BBRM002', 'AASHAY', '', 'JAIN', 'RAJESH JAIN', 'PRIYA JAIN', '142, VINDHYANCHAL NAGAR, AIRPORT ROAD, INDORE (MP)', 'M', '7898863828', '', 2, 2017, 2020, 1, NULL),
('2017BBRM003', 'ADITYA', '', 'GUPTA', 'AMIT GUPTA', 'ARCHANA GUPTA', '134 ANOOP NAGAR, INDORE (MP)', 'M', '9977445638', '', 2, 2017, 2020, 1, NULL),
('2017BBRM004', 'AJEET', 'SINGH', 'TUTEJA', 'MANMOHAN SINGH TUTEJA', 'GURJEET KAUR TUTEJA', '10 DUBEY COLONY PALSIKAR COLONY, INDORE (MP)', 'M', '9893556000', '', 2, 2017, 2020, 1, NULL),
('2017BBRM006', 'AKASH', '', 'BAIRAGI', 'KRISHNAKANT BAIRAGI', 'ASHA BAIRAGI', '141 VYANKTESH NAGAR EXT AIRPORT ROAD, INDORE (MP)', 'M', '9111117131', '', 2, 2017, 2020, 1, NULL),
('2017BBRM007', 'AKASH', '', 'GUPTA', 'RADHESHYAM GUPTA', 'MANGLA GUPTA', 'E-47 SAKET NAGAR, INDORE (MP)', 'M', '8871432986', '', 2, 2017, 2020, 1, NULL),
('2017BBRM008', 'AKSHAT', '', 'AGRAWAL', 'SUBHASH CHANDRA AGRAWAL', 'PINKY AGRAWAL', 'C-13 HIG COLONY OPP. CHRISTIAN EMIN. SCHOOL, INDORE (MP)', 'M', '9425107240', '', 2, 2017, 2020, 1, NULL),
('2017BBRM009', 'AKSHITA', '', 'BHOJANI', 'RAKESH BHOJANI', 'PARUL BHOJANI', '102,KALPANA APARTMENT 7-8,SOUTH TUKOGANJ, INDORE (MP)', 'F', '9826964040', '', 2, 2017, 2020, 1, NULL),
('2017BBRM011', 'AMBER', '', 'PATODI', 'MANOJ PATODI', 'RINKU PATODI', '22 HUKAM CHAND MARG ITWARIA BAZAR, INDORE (MP)', 'M', '8719871987', '', 2, 2017, 2020, 1, NULL),
('2017BBRM012', 'ANIRUDH', '', 'SONI', 'AJAY SONI', 'LAXMI SONI', 'INFRONT OF GEETANJAL HOTEL SHOBHAPUR ROAD, PIPARIYA, HOSHANGABAD (MP)', 'M', '9407384979', '', 2, 2017, 2020, 1, NULL),
('2017BBRM014', 'ANUDISH', '', 'JAIN', 'ANURAG JAIN ', 'ARCHANA JAIN', '13 HIG HOUSING BOARD COLONY MADHAV NAGAR KATNI (MP)', 'M', '9977106343', '', 2, 2017, 2020, 1, NULL),
('2017BBRM015', 'ANUJ', '', 'GODHA', 'SUNIL KUMAR GODHA', 'SAPNA GODHA', '84, VINDHYACHAL NAGAR AIRPORT ROAD, INDORE (MP)', 'M', '7805888810', '', 2, 2017, 2020, 1, NULL),
('2017BBRM016', 'ANUJ', 'PRATAP', 'SINGH', 'JITENDRA SINGH', 'ASHWINI SINGH', '143 ANOOP NAGAR NEAR MAHAVIR BAL VINAY MANDIR, INDORE (MP)', 'M', '9644459205', '', 2, 2017, 2020, 1, NULL),
('2017BBRM017', 'ARUSHI', '', 'KHARE', 'DINESH KHARE', 'LEENA KHARE', 'DD S/2 PLOT NO 342 SCHEME NO 78 VIJAY NAGAR, INDORE (MP)', 'F', '9893370254', '', 2, 2017, 2020, 1, NULL),
('2017BBRM018', 'ASTI', '', 'BHAVSAR', 'VIVEK BHAVSAR', 'KIRTI BHAVSAR', 'H-17 EWS RISHI NAGAR, UJJAIN (MP)', 'F', '9039429708', '', 2, 2017, 2020, 1, NULL),
('2017BBRM020', 'AYUSH', '', 'SONI', 'CHANDRASHEKHAR SONI', 'SHALINI SONI', 'NEAR VEERBROTHER SARAFA BAZZAR, MANDSAUR (MP)', 'M', '7999406604', '', 2, 2017, 2020, 1, NULL),
('2017BBRM021', 'CHAITANYA', '', 'GANDHI', 'SANKET GANDHI', 'SONALI GANDHI', 'HOUSE NO. 105, WARD NO. 21 TILAK WARD, MOHTA PLOT PIPARIYA (MP)', 'M', '8602630200', '', 2, 2017, 2020, 1, NULL),
('2017BBRM022', 'CHETAN', '', 'RAJORA', 'JAGDISH RAJORA', 'SUNITA RAJORA', 'CHITRAKUT DAK BUNGLOW ROAD, NIMBAHERA (RJ)', 'M', '9414148920', '', 2, 2017, 2020, 1, NULL),
('2017BBRM023', 'DEEWANSHI', '', 'DOSHI', 'NIRMAL JAIN', 'SAPNA JAIN', '450 KALANI NAGAR AIRPORT ROAD, INDORE (MP)', 'F', '8962123337', '', 2, 2017, 2020, 1, NULL),
('2017BBRM024', 'DIVYANSHI', '', 'SONI', 'HARISH SONI', 'SAPNA SONI', 'BEHIND SONALI SCHOOL CHOUDHRAN COLONY ASHIRWAD ROAD, GUNA (MP)', 'F', '9685063999', '', 2, 2017, 2020, 1, NULL),
('2017BBRM025', 'GAGANDEEP', 'KAUR', 'SALUJA', 'MANINDER SINGH SALUJA', 'KAWALJEET KAUR SALUJA', 'USHA STEEL INDUSTRIES,JEEWAN BIMA MARG,PANDARI,RAIPUR(C.G) H.NO.24/1226,NEAR GURUDWARA GOVIND NAGAR,PANDARI,RAIPUR(C.G)', 'F', '8889388869', '', 2, 2017, 2020, 1, NULL),
('2017BBRM026', 'GURMAN', 'SINGH', 'SALUJA', 'RAVINDER SINGH SALUJA', 'MANJEET KAUR SALUJA', '444 VISHNUPURI ANNEX, INDORE (MP)', 'M', '9826237813', '', 2, 2017, 2020, 1, NULL),
('2017BBRM028', 'KANISHQ', '', 'BALANI', 'MAHESH BALANI', 'BHAVIKA BALANI', '55 SINDHU NAGAR, INDORE (MP)', 'M', '9981430000', '', 2, 2017, 2020, 1, NULL),
('2017BBRM029', 'KHUSHBOO', '', 'AGRAWAL', 'PRAKASH AGRAWAL', 'MEGHNA AGRAWAL', '12,A AGRAWAL NAGAR SAPNA SANGEETA, INDORE (MP)', 'F', '7697712000', '', 2, 2017, 2020, 1, NULL),
('2017BBRM030', 'LAKSHYA', '', 'MIRCHANDANI', 'JITENDRA MIRCHANDANI', 'VARSHA MIRCHANDANI', '7 SADHU NAGAR MANIK BAGH ROAD, INDORE (MP)', 'M', '8518844440', '', 2, 2017, 2020, 1, NULL),
('2017BBRM031', 'LOHITAKSHI', 'MAHENDRA', 'MALVIYA', 'MAHENDRA MALVIYA', 'KUMUD MALVIYA', 'B/H Z.P.GIRLS SCHOOL WARD NO.3 DHARNI TQ DHARNI (MH)', 'F', '9644196110', '', 2, 2017, 2020, 1, NULL),
('2017BBRM032', 'MANAS', '', 'GODA', 'HITEN GODA', 'KAVITA GODA', '401,REGAL HEIGHTS 14/8,NEW PALASIA, INDORE (MP)', 'M', '9826031889', '', 2, 2017, 2020, 1, NULL),
('2017BBRM033', 'MANPREET', 'SINGH', 'CHHABRA', 'SATVINDER SINGH CHHABRA', 'PARVINDER KAUR CHHABRA', 'R-122 KHATIWALA TANK NEAR HEALTH PLUS, INDORE (MP)', 'M', '9424098333', '', 2, 2017, 2020, 1, NULL),
('2017BBRM034', 'MANSI', '', 'GARG', 'ANAND GARG', 'PREETI GARG', 'GOVIND KUTIR,LAXMI GANJ, GWALIOR (MP)', 'F', '9425351416', '', 2, 2017, 2020, 1, NULL),
('2017BBRM035', 'MOHIT', '', 'YADAV', 'KRISHNA KUMAR YADAV', 'MAMTA YADAV', '3 DHEERAJ NAGAR, INDORE (MP)', 'M', '9826035158', '', 2, 2017, 2020, 1, NULL),
('2017BBRM036', 'MOIZ', '', 'SABUNWALA', 'KHUZEMA SABUNWALA', 'MARIYA SABUNWALA', '131 SAIFEE NAGAR, INDORE (MP)', 'M', '9993565045', '', 2, 2017, 2020, 1, NULL),
('2017BBRM037', 'MUSKAN', '', 'PORWAL', 'MANISH PORWAL', 'NITU PORWAL', '405 RADHA KRISHNA APPT 71 GUMUSTA NAGAR OPP MAHAVIR GATE, INDORE (MP)', 'F', '9826064800', '', 2, 2017, 2020, 1, NULL),
('2017BBRM038', 'NAMIT', '', 'BAFNA', 'PRADEEP BAFNA', 'RAKHI BAFNA', '11/12 SOURTH TOKOGANJ, SHEKHAR PRIDE FLAT NO. 405, INDORE (MP)', 'M', '9111111066', '', 2, 2017, 2020, 1, NULL),
('2017BBRM039', 'NIDHI', '', 'BHARGAVA', 'AMITESH BHARGAVA', 'MANISHA BHARGAVA', 'TAPTI MAIN ROAD, VIVEKANAND WARD, MULTAI, DIST-BETUL (MP)', 'F', '7000785772', '', 2, 2017, 2020, 1, NULL),
('2017BBRM040', 'NISARG', 'BHAVIN', 'DALAL', 'BHAVIN JAYANTILAL DALAL', 'MUKTI B. DALAL', '44 BHAGWATI PARK ROWHOUSE NEAR PATEL PRAGATI MANDAL, HONEY PARK ROAD, ADAJAN SURAT (GJ)', 'M', '9374779006', '', 2, 2017, 2020, 1, NULL),
('2017BBRM041', 'NISHI', '', 'MANGAL', 'MANOJ MANGAL', 'SHILPA MANGAL', 'AGRAWAL COLONY NIWALI ROAD, SENDHWA (MP)', 'F', '8718839999', '', 2, 2017, 2020, 1, NULL),
('2017BBRM042', 'PRANAY', '', 'BARVE', 'CHOUBELAL BARVE', 'SAROJ BARVE', 'DIAMOND TENT SUPPLIER NEAR MAHAVIR CHOUK WARD NO 16, BALAGHAT (MP)', 'M', '7999954569', '', 2, 2017, 2020, 1, NULL),
('2017BBRM043', 'RIBHAV', '', 'SINGH', 'VIVEK KUMAR SINGH', 'RASHMI SINGH', '454 PANCHVATI COLONY  BEHIND BHOPAL MOTORS AB ROAD, INDORE (MP)', 'M', '8120206523', '', 2, 2017, 2020, 1, NULL),
('2017BBRM044', 'ROHISH', '', 'JAIN', 'RAJESH JAIN', 'RITU JAIN', '195 SILVER HILLS COLONY, DHAR (MP)', 'M', '9425047059', '', 2, 2017, 2020, 1, NULL),
('2017BBRM045', 'SHANTANU', '', 'JAIN', 'KAPIL JAIN', 'SMITA JAIN', '1314 SOUTH TUKOGANJ BANK OF INDIA COLONY, INDORE (MP)', 'M', '8889915296', '', 2, 2017, 2020, 1, NULL),
('2017BBRM046', 'SHIVAM', '', 'CHOUKSE', 'KAILASH CHOUKSE', 'BABITA CHOUKSE', 'FH 307-308 SCHEME NO 54 VIJAY NAGAR, INDORE (MP)', 'M', '9993750009', '', 2, 2017, 2020, 1, NULL),
('2017BBRM047', 'SHIVAM', '', 'JETWANI', 'BHAGWANDAS JETWANI', 'LATA JETWANI', '64 M, KHATIWALA TANK, , INDORE (MP)', 'M', '8989733182', '', 2, 2017, 2020, 1, NULL),
('2017BBRM048', 'SHUBHI', '', 'LAKHOTIA', 'JITENDRA LAKHOTIA', 'SONAM LAKHOTIA', '8/24 MAHESH NAGAR, INDORE (MP)', 'F', '8989229629', '', 2, 2017, 2020, 1, NULL),
('2017BBRM049', 'SIDDHARTH', '', 'LUNKAR', 'PRAVEEN LUNKAR', 'RAJESHWARI LUNKAR', '202 B BLOCK SUKHSAGAR APARTMENT RACE COURSE ROAD, INDORE (MP)', 'M', '8827635770', '', 2, 2017, 2020, 1, NULL),
('2017BBRM050', 'SIDDIKA', '', 'CHARA', 'MOHD HANIF CHARA', 'SANA CHARA', '254 ANOOP NAGAR, INDORE (MP)', 'F', '9669249797', '', 2, 2017, 2020, 1, NULL),
('2017BBRM052', 'SIMRAN', '', 'BHARDWAJ', 'DEEPAK SHARMA', 'ARCHANA SHARMA', 'SHARMA NIWAS NEAR GURUDWARA PO KITADIH, JAMSHEDPUR (MP)', 'F', '9771467042', '', 2, 2017, 2020, 1, NULL),
('2017BBRM053', 'SPARSH', '', 'JAIN', 'MANOJ JAIN', 'SWEETY JAIN', '14/10 MALHARGANJ TELI BAKHAL, INDORE (MP)', 'M', '8965999321', '', 2, 2017, 2020, 1, NULL),
('2017BBRM054', 'SURYANSH', 'SINGH', 'TOMAR', 'DEVENDRA SINGH TOMAR', 'KAVITA TOMAR', '32,RATANLOK COLONY,SCHEME NO.53 VIJAY NAGAR,NEAR B.S.N.L. OFFICE, INDORE (MP)', 'M', '8085401933', '', 2, 2017, 2020, 1, NULL),
('2017BBRM056', 'TEERTH', '', 'JUREL', 'MUKESH JUREL', 'REENA JUREL', '147, RANGWASA GATE, PITHAMPUR ROAD, RAU, INDORE (MP)', 'M', '9826099797', '', 2, 2017, 2020, 1, NULL),
('2017BBRM057', 'TISHNEET', '', 'RAJPAL', 'MANMEET RAJPAL', 'SUKHMEET RAJPAL', 'AMRAT NAGAR AB ROAD, SENDHWA (MP)', 'F', '7000361210', '', 2, 2017, 2020, 1, NULL),
('2017BBRM058', 'UTKARSH', '', 'DEOLE', 'GIRISH DEOLE', 'PREETI DEOLE', 'U-102, SHALIMAR PALM, BEHIND APS PIPLIYAHANA, INDORE (MP)', 'M', '9752066688', '', 2, 2017, 2020, 1, NULL),
('2017BBRM060', 'VANSH', '', 'GOYAL', 'DUSHYANT GOYAL', 'SANGEETA GOYAL', 'SANSKAR BHAVAN NEAR CINE CITY, RAJAKHEDI MAKRONIA, SAGAR (MP)', 'M', '7999435530', '', 2, 2017, 2020, 1, NULL),
('2017BBRM061', 'VANSHIKA', '', 'GUPTA', 'VIPIN GUPTA', 'PALLAVI GUPTA', '15A/7 SANGHI COLONY NEAR RANADE COMPOUND OLD PALASIYA, INDORE (MP)', 'F', '9685885748', '', 2, 2017, 2020, 1, NULL),
('2017BBRM062', 'YASH', '', 'BHARATI', 'DR NARESH BHARATI', 'JAISHRI BHARATI', '88, SACHHIDANAND NAGAR, OPP OLD RTO KESARBAGH ROAD, INDORE (MP)', 'M', '9827035699', '', 2, 2017, 2020, 1, NULL),
('2017BBRM063', 'YASH', '', 'DANDIR', 'DILIP DANDIR', 'PRABHA DANDIR', '38, PHADH SING PURA, NEAR KALASH CHOK MANDIR, KHARONGE (MP)', 'M', '8223920698', '', 2, 2017, 2020, 1, NULL),
('2017BBRM064', 'YASH', '', 'PARWAR', 'RAKESH PARWAR', 'MANGLA PARWAR', '324 MG ROAD TORI CORNER, INDORE (MP)', 'M', '8463830072', '', 2, 2017, 2020, 1, NULL),
('2017BBRM065', 'YOUTEE', '', 'KHER', 'AJAY KHER', 'ANJALI KHER', '101 TILAK PATH 105 CMR POINT NARAYAN BAG SQUARE, INDORE (MP)', 'F', '7049513431', '', 2, 2017, 2020, 1, NULL),
('2017BBRM066', 'YUGAL', '', 'MAHESHWARI', 'BRIJ KISHORE MAHESHWARI', 'SMITA MAHESHWARI', '101 CLASSIC DREAMZ , MANISHPURI 201 CLASSIC DREAMZ, MANISHPURI, INDORE (MP)', 'M', '9301940002', '', 2, 2017, 2020, 1, NULL),
('2017BBRM067', 'ANUBHA', '', 'TOMAR', 'NARENDRA SINGH TOMAR', 'MEDHA TOMAR', '101-B PRABHU NAGAR, ANNAPURNA MAIN ROAD INDORE (MP)', 'F', '9893648415', '', 2, 2017, 2020, 1, NULL),
('2017BBRM068', 'DEV', '', 'SHARMA', 'SUNIL SHARMA', 'ANITA SHARMA', 'G-103 SHRINATH SHREY APPT.  33/1 RACE COURSE ROAD OPP ABHAY PRASHAL, INDORE (MP)', 'M', '9111112874', '', 2, 2017, 2020, 1, NULL),
('2017BBRM069', 'DIKSHA', '', 'KHANDELWAL', 'YOGESH KHANDELWAL', 'SHEETAL KHANDELWAL', '404-SHRI KRISHNA SOLITARE PARK, SCH NO. 71 FOOTIKOTHI SQUARE, INDORE (MP)', 'F', '8959136136', '', 2, 2017, 2020, 1, NULL),
('2017BBRM070', 'RISHABH', 'ASHOK', 'MISHRA', 'ASHOK R MISHRA', 'MIRA A MISHRA', 'B/902 RAJ CLASSIC, INDRALOK 6 BHAYANDER EAST (MH)', 'M', '9769809479', '', 2, 2017, 2020, 1, NULL),
('2017BBRM071', 'RAGHAV', '', 'MAHESHWARI', 'DHRUV MAHESHWARI', 'JYOTI MAHESHWARI', 'SHRI NIKATON 2, CIVIL LINES KATNI (MP)', 'M', '9993357999', '', 2, 2017, 2020, 1, NULL),
('2017BBRM072', 'ROSHIT', 'MOTWANI', '', 'VIJAY MOTWANI', 'PALAK MOTWANI', '20 MAA VIHAR COLONY A B ROAD, INDORE (MP)', 'M', '9981388855', '', 2, 2017, 2020, 1, NULL),
('2017BBRM073', 'SAMARTH', 'YADAV', '', 'PRADEEP YADAV', 'MANJU YADAV', '29, NIKAS CHOURAHA, UJJAIN (MP)', 'M', '7448281624', '', 2, 2017, 2020, 1, NULL),
('2017BTAU002', 'PARAGCHANDRA', 'ARAV', 'BAROT', 'PARAGCHANDRA M. BAROT', 'NITA PARAGCHANDRA BAROT', 'F-5 GODREJ NAGAR, NEAR GATTY SCHOOL, GIDC ANKLESHWAR DIST BHARUCH, GUJRAT', 'M', '9099008743', '', 3, 2017, 2021, 1, NULL),
('2017BTAU003', 'MANAN', '', 'DADHICH', 'MANOJ DADHICH', 'SHALINI DADHICH ', '87 B  BRAJ VIHAR COLONY, INDORE (MP)', 'M', '7898822581', '', 3, 2017, 2021, 1, NULL),
('2017BTAU005', 'SHIRIN', '', 'PHADKE', 'SHASHANK PHADKE', 'VAISHALI PHADKE', '22,BAXI COLONY EXTENSION NEAR SADAR BAZAR POLICE STATION, INDORE (MP)', 'F', '9575800226', '', 3, 2017, 2021, 1, NULL),
('2017BTAU006', 'SHUBHAM', '', 'PATEL', 'MAHESH PATEL', 'SUNITA PATEL', '27, VIRAT NAGAR MUSAKHEDI, INDORE (MP)', 'M', '8817003317', '', 3, 2017, 2021, 1, NULL),
('2017BTAU007', 'SUVI', '', 'BHATNAGAR', 'VIJAY BHATNAGAR', 'SUNITA BHATNAGAR', '36 AG SCH NO. 54 VIJAY NAGAR INDORE (MP)', 'M', '9424501110', '', 3, 2017, 2021, 1, NULL),
('2017BTAU008', 'VATS', '', 'KAPOOR', 'MADHUSUDAN KAPOOR', 'MONIKA KAPOOR', 'H-322, GOVINDPURAM, GHAZIABAD, UTTAR PRADESH', 'M', '8383801117', '', 3, 2017, 2021, 1, NULL),
('2017BTAU009', 'VEDANT', '', 'BHARGAV', 'SANKALP BHARGAV', 'SHALINI BHARGAVA', '12 GOYAL NAGAR NEAR BENGALI SQUARE, INDORE (MP)', 'M', '9644442424', '', 3, 2017, 2021, 1, NULL),
('2017BTAU010', 'VISHAL', '', 'WADHWANI', 'NARENDRA WADHWANI', 'JAYA WADHWANI', '43 TRIVENI COLONY MAIN NEAR SIX BUNGLOW, INDORE (MP)', 'M', '9893160299', '', 3, 2017, 2021, 1, NULL),
('2017BTAU011', 'YAKSHENDRA', '', 'BHARDWAJ', 'OM PRAKASH BHARDWAJ', 'MADHURI BHARDWAJ', 'G 77/17 SOUTH T.T NAGAR NEAR STADIUM, BHOPAL (MP)', 'M', '7999667156', '', 3, 2017, 2021, 1, NULL),
('2017BTAU012', 'YASH', '', 'BILLORE', 'MANNULAL BILLORE', 'SEEMA BILLORE', '520 HIGH LINK CITY, CHHOTA BANGARDA AIRPORT ROAD, INDORE (MP)', 'M', '7000898207', '', 3, 2017, 2021, 1, NULL),
('2017BTAU013', 'YUVRAJ', '', 'KHANNA', 'RAJESH KHANNA', 'BHAVANA KHANNA', 'HIG 22 NEW HOUSING BOARD COLONY RATANPURA, JHABUA (MP)', 'M', '9827309534', '', 3, 2017, 2021, 1, NULL),
('2017BTCS001', 'AADITYA', '', 'JOSHI', 'NARENDRA JOSHI', 'ANITA JOSHI', '25, VYANKATESH MARKET MANIK BAGH ROAD, INDORE (MP)', 'M', '9009182315', '', 1, 2017, 2021, 1, NULL),
('2017BTCS002', 'AASHI', '', 'SHRIMAL', 'VIKRAM SHRIMAL', 'KAMNA SHRIMAL', '70-B SECTOR A SAINATH COLONY, INDORE (MP)', 'F', '9302905060', '', 1, 2017, 2021, 1, NULL),
('2017BTCS003', 'ABHISHEK', 'P.', 'PATWA', 'PRAVIN PATWA', 'SNEH PATWA', '402-A,KANCHAN ROYAL RESIDENCY PALIWAL NAGAR, INDORE (MP)', 'M', '9589596528', '', 1, 2017, 2021, 1, NULL),
('2017BTCS004', 'ABHISHEK', '', 'RADHAKRISHNAN', 'RADHAKRISHNAN K P', 'NEENA RADHAKRISHNAN', 'HOUSE NO.201, TYPE-3 QUARTERS IIM INDORE CAMPUS, RAU, INDORE (MP)', 'M', '9617972042', '', 1, 2017, 2021, 1, NULL),
('2017BTCS005', 'ABHIYANT', '', 'SINGH', 'RAJENDRA PAL SINGH', 'SANGEETA SINGH', '69 LAXMI NAGAR BHOSLEY COLONY, DEWAS (MP)', 'M', '9926447765', '', 1, 2017, 2021, 1, NULL),
('2017BTCS006', 'ADHIRAJ', 'SINGH', 'THAKUR', 'ASHWANI SINGH THAKUR', 'SIMRAN SINGH THAKUR', '303, RUPAYATAN APPARTMENT NEW PALASIA, INDORE (MP)', 'M', '9755649773', '', 1, 2017, 2021, 1, NULL),
('2017BTCS007', 'ADITYA', '', 'SISODIYA', 'MANOJ SISODIYA', 'SARITA SISODIYA', '55, BANK COLONY, ANNAPURNA ROAD, INDORE (MP)', 'M', '9754334049', '', 1, 2017, 2021, 1, NULL),
('2017BTCS008', 'ADITYA', '', 'PATHAK', 'VIJAY PATHAK', 'SEJAL PATHAK', 'F-44 MIG COLONY RAVI SHANKAR SHUKLA NAGAR, INDORE (MP)', 'M', '9893645908', '', 1, 2017, 2021, 1, NULL),
('2017BTCS009', 'AISHWARYA', '', 'MAJUMDAR', 'PRABIR MAJUMBAR', 'PRABHA MAJUMDAR', '103 SAI SAMPADA AB ROAD, INDORE (MP)', 'F', '8827999981', '', 1, 2017, 2021, 1, NULL),
('2017BTCS010', 'AKANSH', 'SINGH', 'PARIHAR', 'DHARMENDRA SINGH PARIHAR', 'KAMINI SINGH PARIHAR', 'A-52 M.I.G. COLONY  BEHIND CHL HOSPITAL, A.B.ROAD, INDORE (MP)', 'M', '9826200049', '', 1, 2017, 2021, 1, NULL),
('2017BTCS011', 'AKSHRA', '', 'PATIDAR', 'PRAKASH PATIDAR', 'REKHA PATIDAR', '26 MAIN ROAD SAHAPURA GOGAWA NEAR BAPNA PUBLIC SCHOOL, KHARGONE (MP)', 'F', '9893372700', '', 1, 2017, 2021, 1, NULL),
('2017BTCS012', 'ANANYA', '', 'YADAV', 'ANAND YADAV', 'NEELIMA YADAV', '8 DWARKAPURI KATRA ROAD BHOPAL (MP)', 'F', '9826028114', '', 1, 2017, 2021, 1, NULL),
('2017BTCS013', 'ANCHAL', '', 'SHARMA', 'DILIP KUMAR SHARMA', 'BINA SHARMA', 'G-1 KHUSHBOO PALACE SECTOR G, BAKHTAWAR RAM NAGAR, INDORE (MP)', 'F', '8120793525', '', 1, 2017, 2021, 1, NULL),
('2017BTCS015', 'ANITA', 'S', 'AYACHIT', 'SHIRISH AYACHIT', 'NEHA AYACHIT', 'M-190 VIGYAN NAGAR NEAR NAVNEET GARDEN, INDORE (MP)', 'F', '9179473130', '', 1, 2017, 2021, 1, NULL),
('2017BTCS016', 'ANJALI', '', 'DUBEY', 'SHAILENDRA DUBEY', 'SAVITA DUBEY', '487 SUDAMA NAGAR NEAR MAHAVEER GATE, INDORE (MP)', 'F', '9926505067', '', 1, 2017, 2021, 1, NULL),
('2017BTCS017', 'ANSHUMAN', '', 'SARAF', 'HEMANT SARAF', 'DEEPA SARAF', '112 MAHADEV TOTLA NAGAR NEAR KANADIA ROAD, INDORE (MP)', 'M', '9303450050', '', 1, 2017, 2021, 1, NULL),
('2017BTCS018', 'ANUKRUTI', '', 'KANUNGO', 'JITENDRA KANUNGO', 'CHETNA KANUNGO', 'HB-5, NALANDA PARISAR KESHAR BAG ROAD, OPP.CHAMELIDEVI SCHOOL, INDORE (MP)', 'F', '9755097224', '', 1, 2017, 2021, 1, NULL),
('2017BTCS019', 'ANURAG', '', 'KABRA', 'RAKESH KABRA', 'SANTOSH KABRA', '45-A SANJAY COLONY NR. NEW LOOK CENTRAL SCHOOL, BHILWARA (RAJASTHAN)', 'M', '9462240300', '', 1, 2017, 2021, 1, NULL),
('2017BTCS020', 'ANUSHREE', '', 'PATIL', 'DR SANJAY PATIL', 'MAMTA PATIL', '129 C VAIBHAV NAGAR KANADIA ROAD, INDORE (MP)', 'F', '9009871237', '', 1, 2017, 2021, 1, NULL),
('2017BTCS021', 'ARJUN', '', 'BAJPAI', 'DEEPAK BAJPAI', 'RAJNI BAJPAI', 'EH-29, NEHRU NAGAR, NEAR AVM SCHOOL, BHOPAL (MP)', 'M', '9754468047', '', 1, 2017, 2021, 1, NULL),
('2017BTCS022', 'ARMAAN', '', 'TUTEJA', 'RAJENDRA TUTEJA', 'RANI TUTEJA', '1 PRATAP NAGAR MANIK BAGH ROAD, INDORE (MP)', 'M', '9300123077', '', 1, 2017, 2021, 1, NULL),
('2017BTCS023', 'ARUSHI', '', 'KOTHARI', 'PRIYESH KOTHARI', 'HEMA KOTHARI', '368-F KALANI NAGAR, INDORE (MP)', 'F', '9340154893', '', 1, 2017, 2021, 1, NULL),
('2017BTCS024', 'ASHI', '', 'GARG', 'VIKAS GARG', 'VANDANA GARG', '8/1 NAVALAKHA BEHIND NETRAM OPTICAL, INDORE (MP)', 'F', '9826508000', '', 1, 2017, 2021, 1, NULL),
('2017BTCS025', 'ASHMEET', 'SINGH', 'HORA', 'ARVINDER SINGH HORA', 'GURVINDER KAUR HORA', '35 TELEPHONE NAGAR, INDORE (MP)', 'M', '9827033883', '', 1, 2017, 2021, 1, NULL),
('2017BTCS026', 'ASHWINI', '', 'JOSHI', 'PRASAD JOSHI', 'ARTI JOSHI', '294/C RAJENDRA NAGAR, INDORE (MP)', 'F', '9425316224', '', 1, 2017, 2021, 1, NULL),
('2017BTCS027', 'BHAVESH', '', 'JAIN', 'ANIL JAIN', 'REKHA JAIN', 'WARD NO. 3 RANA PRATAP MARG TAL, RATLAM (MP)', 'M', '9893541020', '', 1, 2017, 2021, 1, NULL),
('2017BTCS028', 'BHAVYA', '', 'BAFNA', 'AJAY BAFNA', 'SAROJ BAFNA', 'C 305 NARIMAN POINT MAHALAXMI NAGAR BOMBAY HOSPITAL, INDORE (MP)', 'M', '7024253100', '', 1, 2017, 2021, 1, NULL),
('2017BTCS029', 'CHANDRAPAL', 'RAJ', 'GAUTAM', 'KAILASH GAUTAM', 'SUSMA GAUTAM', '17/12 VIJAY NAGAR, INDORE (MP)', 'M', '9424859091', '', 1, 2017, 2021, 1, NULL),
('2017BTCS030', 'CHITRANSHI', '', '', 'SANDEEP BHATNAGAR', 'YASHI BHATNAGAR', '2952 BLOCK A STREET NO 2 SGM NAGAR, NIT FARIDABAD (HR)', 'F', '9811693683', '', 1, 2017, 2021, 1, NULL),
('2017BTCS031', 'DHRUV', '', 'GUPTA', 'VINAY GUPTA', 'ANJU GUPTA', '108 B CHHATRAPATI NAGAR AIRPORT ROAD, INDORE (MP)', 'M', '9907913947', '', 1, 2017, 2021, 1, NULL),
('2017BTCS032', 'DIKSHA', '', 'TOMAR', 'MANVENDRA SINGH TOMAR', 'SANGEETA TOMAR', 'QTR NO 4/3 MEGHDOOTPARK BSNL TEL EXCH CAMPUS,  RASOMA SQUARE AB ROAD, INDORE (MP)', 'F', '9425316077', '', 1, 2017, 2021, 1, NULL),
('2017BTCS034', 'GAUTAMI', '', 'SANJIVA', 'SANJIVA P MANKAPURE', 'ASHWINA SANJIVA', '45 TELECOM COLONY RANAPRATAP NAGAR (MH)', 'F', '7247471760', '', 1, 2017, 2021, 1, NULL),
('2017BTCS035', 'HARNEET', 'KOUR', 'BHATIA', 'HARBHAJAN SINGH BHATIA', 'CHARANJEET KOUR BHATIA', '4 PAHAD SINGH PURA KHARGONE (MP)', 'F', '9826088578', '', 1, 2017, 2021, 1, NULL),
('2017BTCS036', 'HARSH VARDHAN', 'SINGH', 'DANGI', 'RAGHURAJ SINGH THAKUR', 'DHEERAJ DANGI', 'HOUSE NO 75  STREET NO 3 PRABHAKAR NAGAR , MAKRONIA, SAGAR (MP)', 'M', '9074770963', '', 1, 2017, 2021, 1, NULL),
('2017BTCS037', 'HARSHIT', '', 'KOCHAR', 'NARESH KOCHAR', 'ANJALI KOCHAR', '89 RAMESH BHAVAN 6TH FLOUR ROOM NO 80 MUMBADEVI ROAD MANDVI, MUMBAI (MH)', 'M', '8169946077', '', 1, 2017, 2021, 1, NULL),
('2017BTCS038', 'HARSHITA', '', 'BHAYRE', 'RAJEEV BHAYRE', 'RAJKUMARI BHAYRE', '159 LIG COLONY RAJENDRA PRASAD WARD, HARDA (MP)', 'F', '9826552263', '', 1, 2017, 2021, 1, NULL),
('2017BTCS039', 'HARSHVARDHAN', '', 'JAIN', 'LATE DR VIKRAM JAIN', 'LEENA JAIN', '15 LAD COLONY OPP TUKOGANJ POLICE STATION, INDORE (MP)', 'M', '8718989899', '', 1, 2017, 2021, 1, NULL),
('2017BTCS040', 'IKYA ', 'SHYAM', 'BAILUNG', 'CHAUMALA RANJIT BAILUNG', 'DOLLY SHYAM', 'SATYAPUR PATH H.NO 22 BYELANE-2 BELTOLA, GUWAHATI (AS)', 'M', '8723093790', '', 1, 2017, 2021, 1, NULL),
('2017BTCS041', 'ISHITA', '', 'GAUR', 'MANISH GAUR', 'SANTWANA GAUR', 'FLAT NO. 306, NEELKANTH HEIGHTS, BAIS GODAM, JAIPUR (RJ)', 'F', '9571045111', '', 1, 2017, 2021, 1, NULL),
('2017BTCS042', 'JITESH', '', 'RAJPAL', 'DR KHUSHIRAM RAJPAL', 'DR LACHMI RAJPAL', '9B SCH 71 SECTOR C, INDORE (MP)', 'M', '8720043269', '', 1, 2017, 2021, 1, NULL),
('2017BTCS043', 'KAVYA', '', 'DWIVEDI', 'DR MK DWIVEDI', 'VAISHALI DWIVEDI', '98 PRIME PARK LIMBODI KHANDWA ROAD, INDORE (MP)', 'F', '8819034098', '', 1, 2017, 2021, 1, NULL),
('2017BTCS044', 'KHUSHBOO', '', 'AGRAWAL', 'ANIL AGRAWAL', 'ANUPAMA AGRAWAL', '58 SHIKSHAK NAGAR AIRPORT ROAD, INDORE (MP)', 'F', '9981242655', '', 1, 2017, 2021, 1, NULL),
('2017BTCS045', 'KRATI', '', 'KUMAWAT', 'NEERAJ KUMAWAT', 'UMA KUMAWAT', '601-A1 BLOCK, BALAJI HEIGHTS, MAHALAXMI NAGAR, INDORE (MP)', 'F', '7771025555', '', 1, 2017, 2021, 1, NULL),
('2017BTCS046', 'LAKSHYA', '', 'JOSHI', 'ASHOK JOSHI', 'ANJEETA JOSHI', '176 A SURYA DEV NAGAR NEAR GOPUR SQUARE, INDORE (MP)', 'M', '9425095112', '', 1, 2017, 2021, 1, NULL),
('2017BTCS047', 'LUV', '', 'KHUBANI', 'MAHESH NANAKRAM KHUBANI', 'BHAWNA KHUBANI', '105, SACHHIDANAND NAGAR, RTO ROAD MHOW NAKA, INDORE (MP)', 'M', '9993455555', '', 1, 2017, 2021, 1, NULL),
('2017BTCS049', 'MANTHAN', '', 'SOLANKI', 'PRASHANT SOLANKI', 'BHAWANA SOLANKI', 'C/HD 48, SUKHLIYA, NEAR LAV KUSH VIHAR, SUKHLIYA, INDORE (MP)', 'M', '7697904545', '', 1, 2017, 2021, 1, NULL),
('2017BTCS050', 'MEENAL', '', 'SHRIVASTAVA', 'MANOJ SHRIVASTAVA', 'SADHNA SHRIVASTAVA', '205 HIMGIRI COMPLEX NEAR GATE NO 3 WRIGHT TOWN, JABALPUR (MP)', 'F', '8435793538', '', 1, 2017, 2021, 1, NULL),
('2017BTCS051', 'MOHAMMED', '', 'ASAD', 'MOHAMMED HAFIZ', 'AAISHA CHARA', '254 ANOOP NAGAR, INDORE (MP)', 'M', '9826437864', '', 1, 2017, 2021, 1, NULL),
('2017BTCS052', 'MOHIL', '', 'JAIN', 'SACHIN KUMAR JAIN', 'SWATI JAIN', '10/1 MANORAMAGANJ,FLATE NO.307 BLOCK-A,YASHRAJ RESIDENCY, INDORE (MP)', 'M', '9713816369', '', 1, 2017, 2021, 1, NULL),
('2017BTCS053', 'MOINUDDIN', '', 'SHEIKH', 'SHEIKH MOHSIN NABI', 'MAFIZA B', '43/2 CHHIPA BAKHAL, INDORE (MP)', 'M', '8269974045', '', 1, 2017, 2021, 1, NULL),
('2017BTCS054', 'MUFADDAL', '', 'TALWALA', 'JOHAR HUSSAIN', 'FARHAT JOHAR', '598 G MG ROAD, MHOW 64 PLOWDEN ROAD, MHOW (MP)', 'M', '7693046772', '', 1, 2017, 2021, 1, NULL),
('2017BTCS055', 'MUSKAN', '', 'SHARMA', 'BHAWANI SHANKAR SHARMA', 'KIRAN SHARMA', '412 MANAVTA NAGAR NEAR BYPASS ROAD KANADIA, INDORE (MP)', 'F', '9977575003', '', 1, 2017, 2021, 1, NULL),
('2017BTCS056', 'NAKUL', '', 'BHORASKAR', 'SWATANTRA BHORASKAR', 'SHRUTI BHORASKAR', 'G-2 SHRI NIDHI APPARTMENT 11/2 SNEHLATA GANJ, INDORE (MP)', 'M', '9111110027', '', 1, 2017, 2021, 1, NULL),
('2017BTCS057', 'NEELAM', '', 'KUKREJA', 'MAHESH KUKREJA', 'BHAWNA KUKREJA', '104, B SUDAMA NAGAR, INDORE (MP)', 'F', '9826015399', '', 1, 2017, 2021, 1, NULL),
('2017BTCS058', 'NEELANSH', 'SINGH', 'RATHORE', 'NILESH SINGH RATHORE', 'RICHA SINGH RATHORE', '303,KALANI NAGAR,AIRPORT ROAD, INDORE (MP)', 'M', '9977032280', '', 1, 2017, 2021, 1, NULL),
('2017BTCS059', 'NIHARIKA', '', '', 'SHAILESH KUMAR ROY', 'NISHI ROY', 'HOUSE NO. 73, MANGAL MURTI KRISHNA JI NAGAR SCHEME NO. 77, BEHIND MAYUR HOSPITAL, INDORE (MP)', 'F', '9425450749', '', 1, 2017, 2021, 1, NULL),
('2017BTCS060', 'PALASH', '', 'ASIJA', 'KISHOR ASIJA', 'RITIKA ASIJA', '143 VINAY NAGAR, KESARBAGH ROAD, INDORE (MP)', 'M', '9993883303', '', 1, 2017, 2021, 1, NULL),
('2017BTCS061', 'PARUL', 'SHIVCHARAN', 'RAJWADE', 'SHIVCHARAN RAJWADE', 'KALPANA RAJWADE', '42, SHRINAGAR, NAGPUR (MH)', 'F', '7223009436', '', 1, 2017, 2021, 1, NULL),
('2017BTCS062', 'PIYUSH', '', 'KHEDE', 'KAMAL KISHORE KHEDE', 'USHA KHEDE', '14 DEEPKUNJ SCH NO 140, INDORE (MP)', 'M', '9111672122', '', 1, 2017, 2021, 1, NULL),
('2017BTCS063', 'PRABHRUTI', '', 'CHAUDHARY', 'PRANAY CHAUDHARY', 'JYOTI CHOUDHARY', '239 INDRAPURI COLONY MAIN ROAD, INDORE (MP)', 'F', '7509634850', '', 1, 2017, 2021, 1, NULL),
('2017BTCS064', 'PRADYUMNA SATYENDRA', 'SINGH', 'JADAUN', 'SATYENDRA SINGH JADAUN', 'MEERA DEVI JADAUN', 'INDRA COLONY, NEAR POST OFFICE KARAULI, (RJ)', 'M', '9785277234', '', 1, 2017, 2021, 1, NULL),
('2017BTCS065', 'PRAKHAR', '', 'GUPTA', 'ATUL GUPTA', 'PRITI GUPTA', '47-B UMESH NAGAR ANNAPURNA ROAD, INDORE (MP)', 'M', '9893853858', '', 1, 2017, 2021, 1, NULL),
('2017BTCS066', 'PRANJAL', '', 'GARG', 'SANJAY GARG', 'SHEETAL GARG', '39, AGRASEN NAGAR, NEAR DR GOVIND GUPTA, INDORE (MP)', 'M', '9926501550', '', 1, 2017, 2021, 1, NULL),
('2017BTCS067', 'PRATEEK', '', 'DUBEY', 'MANISH DUBEY', 'SWATI DUBEY', '2155-D SUDAMA NAGAR JAROLIYA MARKET, INDORE (MP)', 'M', '7697177546', '', 1, 2017, 2021, 1, NULL),
('2017BTCS068', 'PRATIK', '', 'RUPANI', 'GHANSHYAM RUPANI', 'VINITA RUPANI', '1580, WARD NO. 3, SAI KIRPA BUILDING, NEAR NAGAR NIGAM OFFICE, SANT HIRDARAM NAGAR BHOPAL (MP)', 'M', '8463061781', '', 1, 2017, 2021, 1, NULL),
('2017BTCS069', 'PRITESH', '', 'PATIDAR', 'KAMAL PATIAR', 'KAVITA PATIDAR', 'PATEL COLONY DHAMNOD (DHAR) (MP)', 'M', '8223098227', '', 1, 2017, 2021, 1, NULL),
('2017BTCS070', 'PRIYAL', '', 'NEEMA', 'ASHVIN NEEMA', 'ARCHANA NEEMA', '35 RAMCHANDRA NAGAR EXT, INDORE (MP)', 'M', '9827293920', '', 1, 2017, 2021, 1, NULL),
('2017BTCS071', 'PRIYANSH', '', 'JAIN', 'AJAY JAIN', 'RANJANA JAIN', '7 MANORAM INDORE ROAD, DHAR (MP)', 'M', '9589295651', '', 1, 2017, 2021, 1, NULL),
('2017BTCS072', 'RADHIKA', '', 'TAORI', 'ASHISH TAORI', 'DEEPA TAORI', '302  SIDDHATRTH VIHAR APP12-13  PRAKASH NAGAR  NAVLAKHA, INDORE (MP)', 'F', '9993554666', '', 1, 2017, 2021, 1, NULL),
('2017BTCS073', 'RAKSHIT', '', 'BHARDWAJ', 'SUNIL KUMAR', 'VISHRUTA SHARMA', 'A 23 PURUSHOTTAM VIHAR COLONY GOLE KA MANDIR, GWALIOR (MP)', 'M', '9425111466', '', 1, 2017, 2021, 1, NULL),
('2017BTCS074', 'RASHI', '', 'TIWARI', 'VINAY TIWARI', 'PREETI TIWARI', '178- B VIVEKANAND COLONY, UJJAIN (MP)', 'F', '8770176686', '', 1, 2017, 2021, 1, NULL),
('2017BTCS075', 'RISHI', '', 'SHUKLA', 'PRABHAKAR SHUKLA', 'ARCHANA SHUKLA', '328 PEACE POINT LIMBODI KHANDWA ROAD, INDORE (MP)', 'M', '9407414477', '', 1, 2017, 2021, 1, NULL),
('2017BTCS076', 'RITHIK', '', 'BHANDARI', 'ALPESH BHANDARI', 'NEHA BHANDARI', '177-A TELEPHONE NAGAR, INDORE (MP)', 'M', '9575950005', '', 1, 2017, 2021, 1, NULL),
('2017BTCS077', 'RITVIK', '', 'OHRI', 'SAMIR OHRI', 'DR. PRIYANKA OHRI', '3, ASHISH VIHAR NX, NEAR BENGALI SQUARE, INDORE (MP)', 'M', '9977142170', '', 1, 2017, 2021, 1, NULL),
('2017BTCS078', 'RUDRAKSH', '', 'AGARWAL', 'PARIKSHIT AGARWAL', 'RASHMI AGRAWAL', '65 MISHRA NAGAR ANNAPURNA ROAD, INDORE (MP)', 'M', '9907877700', '', 1, 2017, 2021, 1, NULL),
('2017BTCS079', 'RUTVIK', '', 'VENGURLEKAR', 'ASHISH VENGURLEKAR', 'SUDHA VENGURLEKAR', '501 EXOTICA B, SHALIMAR TOWNSHIP, INDORE (MP)', 'M', '9753040040', '', 1, 2017, 2021, 1, NULL),
('2017BTCS080', 'SAFFRON', 'KUMAR', 'CHOURASIA', 'DINESH KUMAR CHOURASIA', 'RAGINI CHOURASIA', 'BISIDE MONTFORT SCHOOL RAJEEV COLONY DEVDARA, MANDLA (MP)', 'M', '8120113595', '', 1, 2017, 2021, 1, NULL),
('2017BTCS081', 'SALONI', '', 'KHANDELWAL', 'MANOJ KHANDELWAL', 'SANGEETA KHANDELWAL', '48 KESHAV NAGAR COLONY NEAR NEELGANGA THANA, UJJAIN (MP)', 'F', '9522595221', '', 1, 2017, 2021, 1, NULL),
('2017BTCS082', 'SAMARTH', '', 'WATH', 'SHANTARAM WATH', 'MINAKSHI WATH', '614 PREMIUM PARK OPP AUROBINDO HOSPITAL, INDORE (MP)', 'M', '9926621619', '', 1, 2017, 2021, 1, NULL),
('2017BTCS083', 'SANIDHYA', '', 'DANDWATE', 'SHRIKANT DANDWATE', 'VANDANA DANDWATE', '603/A-36 TREASURE FANTANSY RAU ROAD, INDORE (MP)', 'M', '7999967545', '', 1, 2017, 2021, 1, NULL),
('2017BTCS084', 'SANJOLI', '', 'SOGANI', 'SACHIN SOGANI', 'PRAVEENA SOGANI', '78,SIDDHRATH NAGAR R.T.O. ROAD, INDORE (MP)', 'F', '9329187000', '', 1, 2017, 2021, 1, NULL),
('2017BTCS085', 'SANYA ', '', 'AHUJA', 'DEEPAK AHUJA', 'CHHAYA AHUJA', '50-A, SECTOR-G, BAKHTAWAR RAM NAGAR, NEAR AJIT CLUB, INDORE (MP)', 'F', '9826843220', '', 1, 2017, 2021, 1, NULL),
('2017BTCS086', 'SANYA ', '', 'MUNDHRA', 'MADAN MUNDHRA', 'archana mundhara', 'FLAT NO. 301, VISHAL APARTMENT, 51-52, PRABHU NAGAR ANNAPURNA ROAD, INDORE (MP)', 'F', '8871275041', '', 1, 2017, 2021, 1, NULL),
('2017BTCS087', 'SATVIK', '', 'AGRAWAL', 'SATISH AGRAWAL', 'SANGITA AGRAWAL', '114, SAWARIYA APRK, 42 SEWA SARDAR NAGAR, GEETA BHAVAN, INDORE (MP)', 'M', '7389875400', '', 1, 2017, 2021, 1, NULL),
('2017BTCS088', 'SHIVAM', '', 'SHARMA', 'LOKESH SHARMA', 'DR SHOBHA SHARMA', '121 M.I.G NALANDA PARISAR KESAR BAGH ROAD, INDORE (MP)', 'M', '9993563244', '', 1, 2017, 2021, 1, NULL),
('2017BTCS089', 'SHIVASHISH', '', 'JOSHI', 'ASHISH JOSHI', 'SONALI JOSHI', 'M-298 NALANDA PARISAR OPP CHAMELI DEVI PUBLIC SCHOOL KESAR BAGH ROAD, INDORE (MP)', 'M', '8602285283', '', 1, 2017, 2021, 1, NULL),
('2017BTCS090', 'SHRUTI', '', 'MITTAL', 'DHARMESH MITTAL', 'KUSUM', '51 OLD AGRAWAL NAGAR SAPNA SANGEETA, INDORE (MP)', 'F', '9826667897', '', 1, 2017, 2021, 1, NULL),
('2017BTCS091', 'SIDDHARTH', '', 'KHANDELWAL', 'PRADEEP KUMAR KHANDELWAL', 'SANGEETA KHANDELWAL', 'C/O PRADEEP KHANDELWAL MIG A-12 SANJAY NAGAR, BEHIND PATEL ELECTRONICS, BURHANPUR (MP)', 'M', '9425951317', '', 1, 2017, 2021, 1, NULL),
('2017BTCS092', 'SIDDHARTHA', '', 'TIWARI', 'LOKNATH TIWARI', 'SUSHMA TIWARI', '43 SHAKTINAGAR, JABALPUR, (MP)', 'M', '9893318840', '', 1, 2017, 2021, 1, NULL),
('2017BTCS093', 'SIMARPREET', 'KAUR', 'SAHNI', 'SAMARJEET SINGH SAHNI', 'MANIT KAUR SAHNI', '72 KSHAPANAK MARG GHAS MANDI, UJJAIN (MP)', 'F', '9406839588', '', 1, 2017, 2021, 1, NULL),
('2017BTCS094', 'SIMARPREET', '', 'MUCHHAL', 'RAJENDER SINGH MUCHHAL', 'PARVINDER KAUR MUCHHAL', '26-277 AVANTIKA NAGAR SCH NO 51, INDORE (MP)', 'F', '8959390205', '', 1, 2017, 2021, 1, NULL),
('2017BTCS095', 'SNEHI', '', 'JOSHI', 'RAVINDRA JOSHI', 'ANJU JOSHI', '3085 SUDAMA NAGAR E SECTOR HAWA BAGLO ROAD, INDORE (MP)', 'F', '9479444671', '', 1, 2017, 2021, 1, NULL),
('2017BTCS096', 'SUDHANSHU', '', 'VISHWAKARMA', 'KISHAN VISHWAKARMA', 'MADHURI VISHWAKARMA', 'H.NO GP 128 KRISHNA NAGAR BEHIND BAPU ASHARAM JABALPUR ROAD, SAGAR (MP)', 'M', '7974551863', '', 1, 2017, 2021, 1, NULL),
('2017BTCS097', 'TANAY', '', 'PATIDAR', 'AJAY PATIDAR', 'KAVITA PATIDAR', '202 RAM APARTMENT 70 PRABHU NAGAR ANNAPURNA ROAD, INDORE (MP)', 'M', '8085733637', '', 1, 2017, 2021, 1, NULL),
('2017BTCS098', 'TANIYA', '', 'KALGAONKAR', 'MANISH KALGAONKAR', 'NEETI KALGAONKAR', '144-A BRIJESHWARI ANNEX, OPP SARASWATI APARTMENT, PIPLIAHANA, INDORE (MP)', 'F', '9425400530', '', 1, 2017, 2021, 1, NULL),
('2017BTCS099', 'TANMAY', '', 'NEEMA', 'MUKESH NEEMA', 'ALKA NEEMA', '412 GUMASTA NAGAR, INDORE (MP)', 'M', '9425053603', '', 1, 2017, 2021, 1, NULL),
('2017BTCS100', 'TEJASV', '', 'GAUTAM', 'JITENDRA SINGH GAUTAM', 'NITISHI GAUTAM', 'POOJA 9 HOUSING COLONY NEAR KAMBAL KENDRA NAI ABADI, MANDSAUR (MP)', 'M', '7828039998', '', 1, 2017, 2021, 1, NULL),
('2017BTCS101', 'TUSHAR', '', 'DONGE', 'RAJU DONGE', 'BABITA DONGE', '313/4 CRWS COLONY NISHATPURA BHOPAL (MP)', 'M', '8871357460', '', 1, 2017, 2021, 1, NULL),
('2017BTCS102', 'UDIT', '', 'TIWARI', 'DINESH KUMAR TIWARI', 'PRANITA TIWARI', '93 B SAGAR VIHAR COLONY MR-10 SQUARE SUKHLIYA, INDORE (MP)', 'M', '9589050730', '', 1, 2017, 2021, 1, NULL),
('2017BTCS103', 'VANSHAJ', '', 'SINGH', 'RAKESH KUMAR SINGH', 'MANJU SINGH', 'DD/D 03, AKSHVANI VIHAR RESIDENCY AREA, INDORE (MP)', 'M', '9407138179', '', 1, 2017, 2021, 1, NULL),
('2017BTCS104', 'VEDANSH', '', 'AIREN', 'ASHOK AIREN', 'SHIKHA AIREN', '202 EDEN VIEW APARTMENT, RIDDHI SIDDHI VIHAR COLONY, KHAJRANA, INDORE (MP)', 'M', '9425965747', '', 1, 2017, 2021, 1, NULL),
('2017BTCS105', 'VEDANSH', '', 'BARVE', 'SWAYAMPRAKASH BARVE', 'CHANCHALA BARVE', '11 CHOICE PALACE COLONY BEHIND NAVNEET GARDEN  ANNPURNA ROAD, INDORE (MP)', 'M', '9926692388', '', 1, 2017, 2021, 1, NULL),
('2017BTCS106', 'VINAYAK', '', 'LAL', 'VINAY LAL', 'SHIKHA LAL', 'FLAT NO 206-207 BLOCK A2 BALAJI HEIGHTS MAHALAXMI NAGAR NEAR BOMBAY HOSPITAL, INDORE (MP)', 'M', '8818917001', '', 1, 2017, 2021, 1, NULL),
('2017BTCS107', 'ADITYENDRA', 'SINGH', 'RANAWAT', 'CHHATRAPAL SINGH RANAWAT', 'ARUNA SINGH CHAUHAN', 'RAVALA MUNGANA, MUNGANA PRATAPGARH, RAJASTHAN', 'M', '8003940545', '', 1, 2017, 2021, 1, NULL),
('2017BTCS108', 'ARUNDHATI', '', 'DUBEY', 'RATNESH DUBEY', 'PRITI DUBEY', 'C-204 SHREENATH TOWER, MOG LINES GANGWAL BUS STAND INDORE (MP)', 'F', '9425351590', '', 1, 2017, 2021, 1, NULL),
('2017BTCS109', 'DHRUV', 'K', 'AGRAWAL', 'KAILASH AGARWAL', 'MADHUBALA AGARWAL', '17, SARASWATI NAGAR, ANNAPURNA ROAD, INDORE (MP)', 'M', '9987282486', '', 1, 2017, 2021, 1, NULL),
('2017BTCS110', 'HEMANT', '', 'JANGID', 'RAMLAL JANGID', 'MAMTA JANGID', '749 SAIKRIPA COLONY, INDORE (MP)', 'M', '9977133222', '', 1, 2017, 2021, 1, NULL),
('2017BTCS111', 'PRANAY', '', 'KHIRWADKAR', 'HEMANT KHIRWADKAR', 'GEETANJALI KHIRWADKAR', '308-B SURYADEV NAGAR INDORE (MP)', 'M', '9340646153', '', 1, 2017, 2021, 1, NULL),
('2017BTCS112', 'RACHIT', '', 'SATLE', 'NAVIN SATLE', 'ROSHNI SATLE', '21 M.G. ROAD SANAWAD', 'M', '9977663222', '', 1, 2017, 2021, 1, NULL),
('2017BTCS113', 'RAGHVENDRA', 'SINGH', 'HOLKAR', 'SANTAJIRAO HOLKAR', 'SHUBHAGINI HOLKAR', '10 MANIK BAGH ROAD NEAR MARTAND TEMPLE HOLKAR BANGLOW, INDORE (MP)', 'M', '9755194345', '', 1, 2017, 2021, 1, NULL),
('2017BTCS114', 'SIDDHARTH', '', 'JOSHI', 'SUBHASH JOSHI', 'ARCHANA JOSHI', '170, VISHNUPURI NX, INDORE (MP)', 'M', '7587529399', '', 1, 2017, 2021, 1, NULL),
('2017BTCS115', 'SHIVANI', '', 'ARYA', 'PRAKASH ARYA', 'HEMLATA ARYA', '21, BANK COLONY NEAR MANGRUL ROAD KHARGONE (MP)', 'F', '8226069588', '', 1, 2017, 2021, 1, NULL),
('2017BTMT001', 'AASHITA', '', 'ACHARYA', 'ASHISH ACHARYA', 'NAMRATA ACHARYA', '39 MARTAND CHOWK NEAR RAISHREE NURSING HOME 101 MANAS APPT. RAMBAGH, INDORE', 'F', '9826081328', '', 4, 2017, 2021, 1, NULL),
('2017BTMT002', 'ANANYA', '', 'PAWNARKAR', 'PRASHANT GOVARDHANRAO PAWNARKAR', 'VANDANA PAWNARKAR', '162 PRAGATI NAGAR  NEAR RAJENDRA NAGAR, INDORE (MP)', 'F', '9479445650', '', 4, 2017, 2021, 1, NULL),
('2017BTMT003', 'ANUSHKA', '', 'ANAND', 'RITESH ANAND', 'NANDA ANAND', '648,E-7 ARERA COLONY, BHOPAL (MP)', 'F', '8085551932', '', 4, 2017, 2021, 1, NULL),
('2017BTMT004', 'BRAUNY', 'MATHEW', 'JACOB', 'JACOB MATHEW', 'BABITA JACOB', 'BOBBY VILLA LAJNATH WARD ALLEPPEY, ALLEPPEY, KERALA', 'M', '9895572739', '', 4, 2017, 2021, 1, NULL),
('2017BTMT005', 'HARSHIT', '', 'KUMRAWAT', 'MAHESH KUMAR KUMRAWAT', 'NEELU KUMRAWAT', '294 ROYAL KRISHNA COLONY, NEAR EMRALD HEIGHTS SCHOOL RAU, INDORE (MP)', 'M', '8827072110', '', 4, 2017, 2021, 1, NULL),
('2017BTMT006', 'ISHAN', '', 'JAIN', 'NAVIN JAIN', 'SINDHU JAIN', '67/3 TILAK NAGAR SHOPPING CENTER, INDORE (MP)', 'M', '9039898094', '', 4, 2017, 2021, 1, NULL),
('2017BTMT007', 'NAMAN', '', 'JAIN', 'NITIN JAIN', 'MAMTA JAIN', '129 SUKHDEV VIHAR COLONY OPPOSITE PALHAR NAGAR WATER TANK, AIRPORT ROAD, INDORE (MP)', 'M', '9575900222', '', 4, 2017, 2021, 1, NULL),
('2017BTMT008', 'NAMAN', '', 'SHAH', 'PRASHANT SHAH', 'NINA SHAH', '29-RUBY VILLA, SILVER SPRINGS, PHASE -1 BYPASS ROAD, INDORE (MP)', 'M', '9589255888', '', 4, 2017, 2021, 1, NULL),
('2017BTMT009', 'PRIYAL', '', 'JAIN', 'JITESH JAIN', 'NANDITA JAIN', '80, MG ROAD, SANAWAD DIST KHARGONE (MP)', 'F', '8719851084', '', 4, 2017, 2021, 1, NULL),
('2017BTMT010', 'R K', '', 'SREERAJ', 'RAVIKANT IYER', 'SUMADEVI IYER', 'F-90/1, LAVKUSH VIHAR, SUKHLIYA, INDORE, (MP)', 'M', '9827304959', '', 4, 2017, 2021, 1, NULL),
('2017BTMT011', 'RUDRANSH', '', 'GUPTA', 'JITENDRA GUPTA', 'SHEETAL GUPTA', '571/7, NANDA NAGAR INDORE (MP)', 'M', '8989463521', '', 4, 2017, 2021, 1, NULL),
('2017BTMT012', 'SARTHAK', '', 'JAIN', 'NITIN JAIN', 'VINITA JAIN', '154, M.G. ROAD, CHANDRA COMPLEX NEAR SBI ATM, BARWANI (MP)', 'M', '7566887474', '', 4, 2017, 2021, 1, NULL);
INSERT INTO `students` (`enrol_no`, `first_name`, `middle_name`, `last_name`, `father_name`, `mother_name`, `address`, `gender`, `stud_mobile`, `guardian_mobile`, `course_id`, `from_year`, `to_year`, `current_sem`, `cgpa`) VALUES
('2017BTMT013', 'SATYAM', '', 'GUPTA', 'RAKESH GUPTA', 'RAJNI GUPTA', '113 PINKCITY RINGRAOD MUSAKHEDI SQUARE INDORE (MP)', 'M', '9575622644', '', 4, 2017, 2021, 1, NULL),
('2017BTMT014', 'TANAY', '', 'CHORMARE', 'MUKESH CHORMARE', 'SUREKHA CHORMARE', '3245 SECTOR E SUDAMA NAGAR, INDORE (MP)', 'M', '8602430297', '', 4, 2017, 2021, 1, NULL),
('2017BTMT015', 'THILAK', 'RAM', 'S', 'SENTHIL VEL S', 'RAJALAKSHMI S', 'AL-160 2ND STREET 12 MAIN ROAD ANNA NAGAR CHENNAI, TAMIL NADU', 'M', '9444122988', '', 4, 2017, 2021, 1, NULL),
('2017BTMT016', 'VARDHMAN', '', 'MISHRA', 'DEVENDRA MISHRA', 'SEEMA MISHRA', '12/4, CHEMICAL STAFF COLONY, NAGDA (MP)', 'M', '9406972603', '', 4, 2017, 2021, 1, NULL),
('2017BTMT017', 'VIDHI', '', 'PORWAL', 'MANISH PORWAL', 'SEEMA PORWAL', 'GH-144 SCH NO. 54 VIJAY NAGAR INDORE (MP)', 'F', '7354444112', '', 4, 2017, 2021, 1, NULL),
('2017BTMT018', 'HARSHWARDHAN', 'SINGH', 'CHOUHAN', 'SUJIT SINGH CHOUHAN', 'BHAWNA CHOUHAN', 'ORCHID 26, RUCHI LIFE SCAPES, BEHIND BHABHA INSTITUTE OF TECHNOLOGY HOSHANGABAD ROAD BHOPAL', 'M', '8823881558', '', 4, 2017, 2021, 1, NULL),
('2017MBBF001', 'ADITI', '', 'BAJAJ', 'YOGESH  BAJAJ', 'SHIPRA BAJAJ', '12/4, PRAGATI NAGAR,NANAKHEDA, UJJAIN M.P.', 'F', '9685821075', '', 6, 2017, 2019, 1, NULL),
('2017MBBF002', 'AKSHAY', '', 'TASKAR', 'RAMESH TASKAR', 'NIRMALA TASKAR', 'D-2,MAITRSRYSHITI DUPLEX,SHINDENAGAR,MAKHAMALABAD ROAD,NASHIK', 'M', '9921943138', '', 6, 2017, 2019, 1, NULL),
('2017MBBF003', 'ALAN', '', 'ANTONY', 'LATE ANTONY BENCHILAS', 'BEENA ANTONY', 'TC-47/652,CHERRIYAMUTTAM,POONTHURA,TRIVENDRUM,KERALA', 'M', '7736563698', '', 6, 2017, 2019, 1, NULL),
('2017MBBF004', 'AMAN', '', 'JAIN', 'DR. ANIL JAIN', 'DR. DEEPTI JAIN', '17/355 BUDHWARI BAZAR,NEAR PATNI TALKIES,CHHINDWARA', 'M', '8989967400', '', 6, 2017, 2019, 1, NULL),
('2017MBBF005', 'AMAN', 'SHAHNIZAM', ' ANSARI', 'SHAHNIZAM ZAHAOOR ANSARI', 'MUSARRAT NIZAM ANSARI', 'RH 92/2 PRABHAT SOCIETY FALT NO A 13 SHAHUNAGAR CHNICHWAD PUNE 411019', 'M', '8237745321', '', 6, 2017, 2019, 1, NULL),
('2017MBBF006', 'AMBUJ', '', 'TIWARI', 'SATYANARAYAN TIWARI', 'LEELAWATI TIWARI', 'H.NO. 1444,STREET NO-2 NEAR RAM SWEET HOUSE,PARVATIYA COLONY NIT FARIDABAD, HARYANA', 'M', '7503153639', '', 6, 2017, 2019, 1, NULL),
('2017MBBF007', 'ANSHUL PRATAP', 'SINGH', 'RAGHUWANSHI', 'K.S. RAGHUWANSHI', 'MONIKA RAGHUWANSHI', '68, SHANKAR BAGH G1 RUPAL APARTMENT MARIMATA SQ INDORE', 'M', '9926256880', '', 6, 2017, 2019, 1, NULL),
('2017MBBF008', 'ANUBHUTI', '', 'PANDIT', 'AJAY KUMAR PANDIT', 'SARIKA PANDIT', 'GOVT.QUATERS, 15 th BATALIAN NO. A 13(A TYPE)KILA MAIDAN,MAHESH GARD LINE,INDORE', 'F', '9826603321', '', 6, 2017, 2019, 1, NULL),
('2017MBBF009', 'ARUSHI', '', 'NAIK', 'AJAY NAIK', 'ARCHANA NAIK', 'E 21 FORTUNE SHAIL PARISAR NEAR ADARSH NAGAR HOSHANGABAD ROAD, BHOPAL, M.P. 462026', 'F', '9589280995', '', 6, 2017, 2019, 1, NULL),
('2017MBBF010', 'AVI', '', 'SRIVASTAVA', 'AYOG SRIVASTAVA', 'KAVITA SRIVASTAVA', 'A 98 NEW MINAL RESIDENCY JK ROAD GOVINDPURA, BHOPAL M.P. 462023', 'M', '9893376195', '', 6, 2017, 2019, 1, NULL),
('2017MBBF011', 'AYUSH', '', 'JAIN', 'KAILASH JAIN', 'SANGEETA JAIN', '73,RAM CHANDRA NAGAR EXT.,AIRPORT ROAD', 'M', '9993363346', '', 6, 2017, 2019, 1, NULL),
('2017MBBF012', 'DIPESH', '', 'GUPTA', 'RADHARAMAN GUPTA', 'MANJU GUPTA', '613,KHAJURI BAZAR,INDORE', 'M', '8085525788', '', 6, 2017, 2019, 1, NULL),
('2017MBBF013', 'DIVYAANSH', '', 'BHATNAGAR', 'RAJESH BHATNAGAR', 'JYOTSNA BHATNAGAR', 'C 106 NARIMAN POINT PIPLIYAKUMAR INDORE', 'M', '9302956871', '', 6, 2017, 2019, 1, NULL),
('2017MBBF014', 'GAURAV', '', 'KALA', 'MAHESH KALA', 'REKHA KALA', '260,VYANKTESH NAGAR,INDORE', 'M', '9111119333', '', 6, 2017, 2019, 1, NULL),
('2017MBBF015', 'KAJAL', 'BHASKAR', 'GADHE', 'BHASKAR SHRIRAM GADHE', 'SHYAMALA BHASKAR GADHE', 'FLAT NO 401 ELITE ENCLANE PLOT NO 78 SC 14 KOPAR KHAIRANE', 'F', '7021155997', '', 6, 2017, 2019, 1, NULL),
('2017MBBF016', 'KANIKA', '', 'SONI', 'SHRIRAM SONI', 'GEETA SONI', 'NB 60/AB TYPE COLONY OFFICERS COLONY SARNI, DIST- BETUL (MP)', 'F', '8989507493', '', 6, 2017, 2019, 1, NULL),
('2017MBBF017', 'MEET', '', 'VADALIA', 'MANOJ VADALIA', 'ABHA VADALIA', '7/2 Y.N. ROAD,VADALIA STATE,HIMMATLAL MARG ', 'M', '9977159997', '', 6, 2017, 2019, 1, NULL),
('2017MBBF018', 'MOHANA', '', 'RATNAPARKHE', 'MILIND RATNAPARKHE', 'SUPRIYA RATNAPARKHE', '124,MIDRISE APTS,SILVER SPRINGS AB BYPASS ROAD', 'F', '8821800409', '', 6, 2017, 2019, 1, NULL),
('2017MBBF019', 'MOHD', '', 'ASLAM', 'MOHD VAKIL', 'FOOL JAHAN', '# 181 HINDU PURWA REWALI POST-KAISERGANJ DIST BAHARAICH', 'M', '8807257931', '', 6, 2017, 2019, 1, NULL),
('2017MBBF020', 'NAINA', '', 'SHARDA', 'DINESH SHARDA', 'POOJA SHARDA', '120,KANYAKUBJ NAGAR,AIRPORT ROAD', 'F', '9827035373', '', 6, 2017, 2019, 1, NULL),
('2017MBBF021', 'NARENDRA', 'KUMAR', 'PATEL', 'MAHESH PATEL', 'PAPPUBAI PATEL', 'L II 171 KITIYANI MANDSUAR', 'M', '8989701867', '', 6, 2017, 2019, 1, NULL),
('2017MBBF022', 'NEELAM', '', 'KARDHEKAR', 'AJAY KARDHEKAR', 'VAISHALI KARDHEKAR', '35 WILSON HOUSE DUMAINE ROAD KOLABA MUMBAI', 'F', '9869466063', '', 6, 2017, 2019, 1, NULL),
('2017MBBF023', 'POONAM', '', 'PANDE', 'NIRMAL PANDE', 'PREETI PANDE', 'A-17 SCHEME NO. 51 NEAR RJ GYM INDORE', 'F', '9993087890', '', 6, 2017, 2019, 1, NULL),
('2017MBBF024', 'POORVA', '', 'SHINDE', 'PRADEEP SHINDE', 'SEEMA SHINDE', 'KHATE WALI GALI, JANAKGANJ,LASHKAR', 'F', '9301113706', '', 6, 2017, 2019, 1, NULL),
('2017MBBF025', 'PRATIK', 'SINGH', 'WADHWA', 'PRITPAL SINGH WADHWA', 'KAWAL WADHWA', 'B/M 51,NEAR BHARAT MATA MANDIR BAPAT SQUARE ', 'M', '9826021521', '', 6, 2017, 2019, 1, NULL),
('2017MBBF026', 'RISHABH', '', 'BAPNA', 'NUTAN KUMAR BAPNA', 'SUNITA BAPNA', 'A3 BRAJESHWARI EXTENSION NEAR PIPLIYAHANA SQ', 'M', '9522222563', '', 6, 2017, 2019, 1, NULL),
('2017MBBF027', 'RUCHIKA', '', 'ASAWA', 'ARUN KUMAR ASAWA', 'MANJU ASAWA', '50,SHRADDHANAND MARG,CHHAWNI,INDORE', 'F', '9425311575', '', 6, 2017, 2019, 1, NULL),
('2017MBBF028', 'SAMANS', '', 'JAIN', 'DINESH JAIN', 'SHILPA JAIN', '3A RAO-RAJA PARK,PALASAIA , INDORE', 'M', '9826146486', '', 6, 2017, 2019, 1, NULL),
('2017MBBF029', 'SHAILY', '', 'CHHABRA', 'RAJKUMAR CHHABRA', 'REKHA CHHABRA', 'VIJAY DRESSESS SHEETLA MATA ROAD SHAMGARH', 'F', '7773847030', '', 6, 2017, 2019, 1, NULL),
('2017MBBF030', 'SHIVAM', '', 'BHAWSAR', 'KAILASH BHAWSAR', 'SUNITA BHAWSAR', 'TILAK MARG,DEPALPUR,DIST INDORE', 'M', '9589999311', '', 6, 2017, 2019, 1, NULL),
('2017MBBF031', 'SHOURYA', '', 'AGRAWAL', 'DEEPAK RAJ SINGHAL', 'KAVITA SINGHAL', '100,OLD AGRAWAL NAGAR,BEHIND VIKRAM TOWER', 'F', '9977760003', '', 6, 2017, 2019, 1, NULL),
('2017MBBF032', 'SHREYA', '', 'AGRAWAL', 'MANISH AGRAWAL', 'ARTI AGRAWAL', '144,RAMCHANDRA NAGAR,AERODRUM ROAD', 'F', '9425314156', '', 6, 2017, 2019, 1, NULL),
('2017MBBF033', 'SHRIVARDHAN', '', 'MANDHANYA', 'SANJAY MANDHANYA', 'LALITA MANDHANYA', '601,ELITE TOWER,5/2,PARK ROAD,INDORE', 'M', '9407444777', '', 6, 2017, 2019, 1, NULL),
('2017MBBF034', 'TRAPTI', '', 'JAIN', 'ARUN PADLIYA', 'INDU PADLIYA', '4,MISHRA VIHAR NEAR GEETA BHAWAN', 'F', '8080508777', '', 6, 2017, 2019, 1, NULL),
('2017MBBF035', 'VAIBHAV', '', 'JOSHI', 'HARI SHANKAR JOSHI', 'SHANTI JOSHI', '61,SADAR BAZAR,INDORE', 'M', '8962499661', '', 6, 2017, 2019, 1, NULL),
('2017MBBF036', 'VIJIT', '', 'SHAH', 'NILESH SHAH', 'VARSHA SHAH', 'OPPOSITE SBI BANK MISHRAKRIPA BUILDING,VANI ALI,URAN', 'M', '9029502105', '', 6, 2017, 2019, 1, NULL),
('2017MBBF037', 'VIPUL', '', 'GARG', 'VINAY GARG', 'NIDHI GARG', '157/2-11 CIVIL LINES ROORKEE', 'M', '9818736314', '', 6, 2017, 2019, 1, NULL),
('2017MBBF038', 'YASH', '', 'BOTHRA', 'GIRISH BOTHRA', 'SEEMA BOTHRA', '4/3 MALHARGANJ,204 RAJRATAN TOWER,INDORE', 'M', '9479688884', '', 6, 2017, 2019, 1, NULL),
('2017MBBF039', 'HARSHALI', '', 'JAIN', 'GAUTAM JAIN', 'NISHA JAIN', '2, RADHAGANJ NEAR DEVKAR NURSING HOME DEWAS', 'F', '9669884268', '', 6, 2017, 2019, 1, NULL),
('2017MBBF040', 'PRIYANSHI', '', 'JAIN', 'DEEPAK JAIN', 'KIRAN JAIN', '11/1, ALOK BROTHERS JAWAHAR GANJ WARD NO. 17 DABRA (MP)', 'F', '7073516074', '', 6, 2017, 2019, 1, NULL),
('2017MBBF041', 'NILESH', '', 'SHARMA', 'RAJESH SHARMA', 'ANNU SHARMA', '6, SHIVAGANJ SENDHWA (MP)', 'M', '9009500008', '', 6, 2017, 2019, 1, NULL);

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
(1, 'SuperAdmin', 'super@test.com', '17c4520f6cfd1ab53d8745e84681eb49', '874fcc6e14275dde5a23319c9ce5f8e4');

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
  ADD PRIMARY KEY (`ac_session_id`),
  ADD KEY `course_id` (`course_id`);

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
  ADD KEY `roll_id` (`roll_id`,`component_id`,`sub_id`),
  ADD KEY `component_id` (`component_id`),
  ADD KEY `sub_id` (`sub_id`);

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
  ADD PRIMARY KEY (`sub_code`,`from_year`),
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
  MODIFY `ac_session_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
  MODIFY `roll_id` int(10) NOT NULL AUTO_INCREMENT;

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
-- Constraints for table `academic_sessions`
--
ALTER TABLE `academic_sessions`
  ADD CONSTRAINT `academic_sessions_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `students` (`course_id`);

--
-- Constraints for table `atkt_list`
--
ALTER TABLE `atkt_list`
  ADD CONSTRAINT `atkt_list_ibfk_1` FOREIGN KEY (`enrol_no`) REFERENCES `students` (`enrol_no`),
  ADD CONSTRAINT `atkt_list_ibfk_2` FOREIGN KEY (`roll_id`) REFERENCES `roll_list` (`roll_id`);

--
-- Constraints for table `atkt_subjects`
--
ALTER TABLE `atkt_subjects`
  ADD CONSTRAINT `atkt_subjects_ibfk_1` FOREIGN KEY (`component_id`) REFERENCES `component` (`component_id`),
  ADD CONSTRAINT `atkt_subjects_ibfk_2` FOREIGN KEY (`roll_id`) REFERENCES `roll_list` (`roll_id`),
  ADD CONSTRAINT `atkt_subjects_ibfk_3` FOREIGN KEY (`sub_id`) REFERENCES `sub_distribution` (`sub_id`);

--
-- Constraints for table `auditing`
--
ALTER TABLE `auditing`
  ADD CONSTRAINT `auditing_ibfk_1` FOREIGN KEY (`check_id`) REFERENCES `checking` (`check_id`),
  ADD CONSTRAINT `auditing_ibfk_2` FOREIGN KEY (`component_id`) REFERENCES `component` (`component_id`),
  ADD CONSTRAINT `auditing_ibfk_3` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`),
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
  ADD CONSTRAINT `courses_ibfk_2` FOREIGN KEY (`level_id`) REFERENCES `course_level` (`level_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
