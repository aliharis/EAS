-- phpMyAdmin SQL Dump
-- version 3.3.9.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 11, 2012 at 10:32 PM
-- Server version: 5.5.9
-- PHP Version: 5.3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `empdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `annualperformance`
--

CREATE TABLE `annualperformance` (
  `anperf_id` int(10) NOT NULL AUTO_INCREMENT,
  `perf_id` int(10) NOT NULL,
  `annualperf` int(3) NOT NULL,
  `remarks` varchar(500) NOT NULL,
  PRIMARY KEY (`anperf_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `annualperformance`
--


-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` varchar(5) NOT NULL,
  `catname` varchar(150) NOT NULL,
  `percentallocated` int(3) NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` VALUES('CAT A', 'Task Ratings', 50);
INSERT INTO `categories` VALUES('CAT B', 'Knowledge and skills', 10);
INSERT INTO `categories` VALUES('CAT C', 'Employee Qualities', 10);
INSERT INTO `categories` VALUES('CAT D', 'Work ethics and code of conduct', 10);
INSERT INTO `categories` VALUES('CAT E', 'Attendance', 10);

-- --------------------------------------------------------

--
-- Table structure for table `cat_ratingtotals`
--

CREATE TABLE `cat_ratingtotals` (
  `cat_id` varchar(5) NOT NULL,
  `perf_id` int(10) NOT NULL,
  `cat_total` int(3) NOT NULL,
  PRIMARY KEY (`cat_id`,`perf_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cat_ratingtotals`
--

INSERT INTO `cat_ratingtotals` VALUES('CAT A', 1, 15);
INSERT INTO `cat_ratingtotals` VALUES('CAT B', 1, 35);
INSERT INTO `cat_ratingtotals` VALUES('CAT C', 1, 19);
INSERT INTO `cat_ratingtotals` VALUES('CAT D', 1, 2);
INSERT INTO `cat_ratingtotals` VALUES('CAT E', 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `dept_id` int(3) NOT NULL AUTO_INCREMENT,
  `deptabbrv` varchar(3) NOT NULL,
  `deptname` varchar(80) NOT NULL,
  PRIMARY KEY (`dept_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `department`
--

INSERT INTO `department` VALUES(8, 'Mar', 'Marketing Department');
INSERT INTO `department` VALUES(9, 'Acc', 'Accounts Department');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `emp_id` int(5) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) NOT NULL,
  `middlename` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `gender` char(1) NOT NULL,
  `nationalid` varchar(7) NOT NULL,
  `dob` date NOT NULL,
  `permaddress` varchar(80) NOT NULL,
  `prsntaddress` varchar(80) NOT NULL,
  `contactnos` varchar(50) DEFAULT NULL,
  `sup_id` int(5) DEFAULT NULL,
  PRIMARY KEY (`emp_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` VALUES(23, 'Ali', '', 'Haris', 'M', 'A100001', '1994-02-26', 'Winterfell ', 'House of Stark', '7973033', 23);
INSERT INTO `employee` VALUES(24, 'Mohamed', '', 'Axmean', 'M', 'A100001', '0000-00-00', '', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `emp_dept`
--

CREATE TABLE `emp_dept` (
  `emp_id` int(5) NOT NULL,
  `dept_id` int(3) NOT NULL,
  PRIMARY KEY (`emp_id`,`dept_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `emp_dept`
--

INSERT INTO `emp_dept` VALUES(23, 8);
INSERT INTO `emp_dept` VALUES(24, 8);

-- --------------------------------------------------------

--
-- Table structure for table `emp_job`
--

CREATE TABLE `emp_job` (
  `emp_id` int(5) NOT NULL,
  `job_id` int(3) NOT NULL,
  `startdate` date NOT NULL,
  `enddate` date DEFAULT NULL,
  PRIMARY KEY (`emp_id`,`job_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `emp_job`
--

INSERT INTO `emp_job` VALUES(1, 4, '2012-01-10', NULL);
INSERT INTO `emp_job` VALUES(3, 1, '2012-01-10', NULL);
INSERT INTO `emp_job` VALUES(4, 6, '2012-01-10', NULL);
INSERT INTO `emp_job` VALUES(5, 1, '2012-01-10', NULL);
INSERT INTO `emp_job` VALUES(7, 8, '2012-01-10', NULL);
INSERT INTO `emp_job` VALUES(8, 2, '2012-01-10', NULL);
INSERT INTO `emp_job` VALUES(9, 6, '2012-01-10', NULL);
INSERT INTO `emp_job` VALUES(10, 2, '2012-01-10', NULL);
INSERT INTO `emp_job` VALUES(23, 1, '0000-00-00', NULL);
INSERT INTO `emp_job` VALUES(24, 1, '0000-00-00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jobtitles`
--

CREATE TABLE `jobtitles` (
  `job_id` int(3) NOT NULL AUTO_INCREMENT,
  `jobtitle` varchar(80) NOT NULL,
  `description` varchar(250) NOT NULL,
  PRIMARY KEY (`job_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `jobtitles`
--

INSERT INTO `jobtitles` VALUES(1, 'Administrative Assistant', 'Junior Level Officer');
INSERT INTO `jobtitles` VALUES(2, 'Administrative Officer', 'Junior Level Officer');
INSERT INTO `jobtitles` VALUES(3, 'Accounts Officer', 'Senior Level Officer');
INSERT INTO `jobtitles` VALUES(4, 'Accounts Assistant', 'Junior Level Officer');
INSERT INTO `jobtitles` VALUES(5, 'Accounts Clerk', 'Clerical Staff');
INSERT INTO `jobtitles` VALUES(6, 'Director', 'Excecutive Officer Level 1');
INSERT INTO `jobtitles` VALUES(7, 'Senior Administrative Officer', 'Senior Level Officer');
INSERT INTO `jobtitles` VALUES(8, 'Excecutive Director', 'Excecutive Officer Level 3');
INSERT INTO `jobtitles` VALUES(9, 'Sales Officer', 'Senior Sales Officer');

-- --------------------------------------------------------

--
-- Table structure for table `performance`
--

CREATE TABLE `performance` (
  `perf_id` int(10) NOT NULL AUTO_INCREMENT,
  `emp_id` int(5) NOT NULL,
  `sup_id` int(5) NOT NULL,
  `perfmonth` varchar(10) NOT NULL,
  `perfyear` int(4) NOT NULL,
  `monthlyperf` int(3) NOT NULL,
  `remarks` varchar(500) NOT NULL,
  PRIMARY KEY (`perf_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `performance`
--

INSERT INTO `performance` VALUES(1, 24, 0, 'November', 2012, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `perf_ratings`
--

CREATE TABLE `perf_ratings` (
  `subcat_id` int(5) NOT NULL,
  `catid` varchar(5) NOT NULL,
  `perf_id` int(10) NOT NULL,
  `categoryrating` int(3) NOT NULL,
  PRIMARY KEY (`subcat_id`,`perf_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `perf_ratings`
--

INSERT INTO `perf_ratings` VALUES(1, 'CAT A', 1, 5);
INSERT INTO `perf_ratings` VALUES(2, 'CAT A', 1, 5);
INSERT INTO `perf_ratings` VALUES(3, 'CAT A', 1, 5);
INSERT INTO `perf_ratings` VALUES(4, 'CAT B', 1, 3);
INSERT INTO `perf_ratings` VALUES(5, 'CAT B', 1, 5);
INSERT INTO `perf_ratings` VALUES(6, 'CAT B', 1, 3);
INSERT INTO `perf_ratings` VALUES(7, 'CAT B', 1, 5);
INSERT INTO `perf_ratings` VALUES(8, 'CAT B', 1, 5);
INSERT INTO `perf_ratings` VALUES(9, 'CAT B', 1, 4);
INSERT INTO `perf_ratings` VALUES(10, 'CAT B', 1, 3);
INSERT INTO `perf_ratings` VALUES(11, 'CAT B', 1, 3);
INSERT INTO `perf_ratings` VALUES(12, 'CAT B', 1, 4);
INSERT INTO `perf_ratings` VALUES(13, 'CAT C', 1, 3);
INSERT INTO `perf_ratings` VALUES(14, 'CAT C', 1, 2);
INSERT INTO `perf_ratings` VALUES(15, 'CAT C', 1, 2);
INSERT INTO `perf_ratings` VALUES(16, 'CAT C', 1, 4);
INSERT INTO `perf_ratings` VALUES(17, 'CAT C', 1, 3);
INSERT INTO `perf_ratings` VALUES(18, 'CAT C', 1, 5);
INSERT INTO `perf_ratings` VALUES(19, 'CAT C', 1, 0);
INSERT INTO `perf_ratings` VALUES(20, 'CAT D', 1, 2);
INSERT INTO `perf_ratings` VALUES(21, 'CAT D', 1, 0);
INSERT INTO `perf_ratings` VALUES(22, 'CAT E', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `subcat_id` int(3) NOT NULL AUTO_INCREMENT,
  `cat_id` varchar(5) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`subcat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` VALUES(1, 'CAT A', 'Hello World');
INSERT INTO `subcategories` VALUES(2, 'CAT A', 'Samplecdssd');
INSERT INTO `subcategories` VALUES(3, 'CAT A', 'Level of work completed within schedule/time');
INSERT INTO `subcategories` VALUES(4, 'CAT B', 'Level of understanding of work need to be undertaken and how it benefits and the work of the employe');
INSERT INTO `subcategories` VALUES(5, 'CAT B', 'Level of organizing skills of job duties and work related tasks');
INSERT INTO `subcategories` VALUES(6, 'CAT B', 'Level of attentiveness in delegating and accomplishing tasks');
INSERT INTO `subcategories` VALUES(7, 'CAT B', 'Level of comunication skills of the employee');
INSERT INTO `subcategories` VALUES(8, 'CAT B', 'Level of using own knowledge and skills');
INSERT INTO `subcategories` VALUES(9, 'CAT B', 'Level of problem solving skills');
INSERT INTO `subcategories` VALUES(10, 'CAT B', 'Foresight and productivity');
INSERT INTO `subcategories` VALUES(11, 'CAT B', 'Time management');
INSERT INTO `subcategories` VALUES(12, 'CAT B', 'Ability to face challenges');
INSERT INTO `subcategories` VALUES(13, 'CAT C', 'Taking initiative in the workplace');
INSERT INTO `subcategories` VALUES(14, 'CAT C', 'Integrity and honesty');
INSERT INTO `subcategories` VALUES(15, 'CAT C', 'Equality');
INSERT INTO `subcategories` VALUES(16, 'CAT C', 'Level of interest in performing duty');
INSERT INTO `subcategories` VALUES(17, 'CAT C', 'Self-development');
INSERT INTO `subcategories` VALUES(18, 'CAT C', 'Behavioral conduct');
INSERT INTO `subcategories` VALUES(20, 'CAT D', 'Level of adherence to organizations rules and regulations');
INSERT INTO `subcategories` VALUES(22, 'CAT E', 'Attendance');

-- --------------------------------------------------------

--
-- Table structure for table `supervision`
--

CREATE TABLE `supervision` (
  `emp_id` int(5) NOT NULL,
  `sup_id` int(5) NOT NULL,
  `startdate` date NOT NULL,
  `enddate` date DEFAULT NULL,
  PRIMARY KEY (`sup_id`,`emp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supervision`
--

INSERT INTO `supervision` VALUES(20, 0, '2012-11-07', '0000-00-00');
INSERT INTO `supervision` VALUES(22, 0, '2012-11-11', '0000-00-00');
INSERT INTO `supervision` VALUES(23, 23, '2012-11-11', '0000-00-00');
INSERT INTO `supervision` VALUES(24, 23, '2012-11-11', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `task_id` int(10) NOT NULL AUTO_INCREMENT,
  `emp_id` int(5) NOT NULL,
  `sup_id` int(5) NOT NULL,
  `taskdetail` varchar(300) NOT NULL,
  `assigneddate` date NOT NULL,
  `duedate` date NOT NULL,
  `submitdate` date DEFAULT NULL,
  `total_rating` int(2) DEFAULT NULL,
  `remarks` varchar(500) NOT NULL,
  PRIMARY KEY (`task_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `task`
--

INSERT INTO `task` VALUES(1, 20, 1, 'Finalizing Draft', '0000-00-00', '0000-00-00', '2012-11-06', 10, 'N/A');
INSERT INTO `task` VALUES(2, 20, 1, 'Risk Evaluation', '2012-11-02', '2012-11-02', '2012-11-06', 10, 'hefdbs');
INSERT INTO `task` VALUES(3, 20, 1, 'Hello World', '0000-00-00', '0000-00-00', '0000-00-00', 0, 'Sample');
INSERT INTO `task` VALUES(4, 20, 1, 'tftyhh', '0000-00-00', '0000-00-00', '0000-00-00', 0, '');
INSERT INTO `task` VALUES(5, 24, 0, 'Hello World', '2012-11-11', '2013-01-01', '2012-11-11', 15, 'Not Available');

-- --------------------------------------------------------

--
-- Table structure for table `task_ratings`
--

CREATE TABLE `task_ratings` (
  `task_id` int(10) NOT NULL,
  `subcat_id` int(5) NOT NULL,
  `rating` int(3) NOT NULL,
  PRIMARY KEY (`subcat_id`,`task_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `task_ratings`
--

INSERT INTO `task_ratings` VALUES(1, 1, 2);
INSERT INTO `task_ratings` VALUES(2, 1, 4);
INSERT INTO `task_ratings` VALUES(3, 1, 0);
INSERT INTO `task_ratings` VALUES(4, 1, 0);
INSERT INTO `task_ratings` VALUES(5, 1, 5);
INSERT INTO `task_ratings` VALUES(1, 2, 3);
INSERT INTO `task_ratings` VALUES(2, 2, 2);
INSERT INTO `task_ratings` VALUES(3, 2, 0);
INSERT INTO `task_ratings` VALUES(4, 2, 0);
INSERT INTO `task_ratings` VALUES(5, 2, 5);
INSERT INTO `task_ratings` VALUES(1, 3, 5);
INSERT INTO `task_ratings` VALUES(2, 3, 4);
INSERT INTO `task_ratings` VALUES(3, 3, 0);
INSERT INTO `task_ratings` VALUES(4, 3, 0);
INSERT INTO `task_ratings` VALUES(5, 3, 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(3) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL,
  `usertype` varchar(10) NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` VALUES(1, 'izzath', '1234', 'admin');
INSERT INTO `users` VALUES(2, 'shifa', '1234', 'supervisor');
INSERT INTO `users` VALUES(3, 'naxa', '1234', 'employee');
