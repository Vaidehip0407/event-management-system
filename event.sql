-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 13, 2024 at 12:45 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `event`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_master`
--

CREATE TABLE `admin_master` (
  `admin_id` int(11) NOT NULL,
  `admin_name` text DEFAULT NULL,
  `admin_password` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_master`
--

INSERT INTO `admin_master` (`admin_id`, `admin_name`, `admin_password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `audience`
--

CREATE TABLE `audience` (
  `a_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `address` text NOT NULL,
  `phone` text NOT NULL,
  `members` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `event_master`
--

CREATE TABLE `event_master` (
  `event_id` int(11) NOT NULL,
  `event_name` text DEFAULT NULL,
  `event_description` text DEFAULT NULL,
  `event_date` text DEFAULT NULL,
  `event_location` text DEFAULT NULL,
  `event_time` text DEFAULT NULL,
  `event_charges` text DEFAULT NULL,
  `loc` text NOT NULL,
  `f_prize` text NOT NULL,
  `s_prize` text NOT NULL,
  `t_prize` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event_master`
--

INSERT INTO `event_master` (`event_id`, `event_name`, `event_description`, `event_date`, `event_location`, `event_time`, `event_charges`, `loc`, `f_prize`, `s_prize`, `t_prize`) VALUES
(11, 'Quizzical', 'Round 1: 10:30-11:00Round 2,3: 1:30-3:30', '2024-10-13', 'MKICS, Bharuch', '11:30-12:30', '300/-', 'assets/images/quiz.jpeg', '1000/-, certificate', '500/-, certificate ', '300/-, certificate'),

-- --------------------------------------------------------

--
-- Table structure for table `feedback_website`
--

CREATE TABLE `feedback_website` (
  `f_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `email` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback_website`
--

INSERT INTO `feedback_website` (`f_id`, `u_id`, `message`, `email`) VALUES
(5, 31, 'website not working', 'bipa@gmail.com'),
(6, 31, 'excellent', 'xyz@gmail.com'),
(7, 31, 'GOOD', 'hetvigothana@gmail.com'),
(8, 31, 'HHH', 'GFGG@FG'),
(9, 34, 'good', 'xyz@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `participate_master`
--

CREATE TABLE `participate_master` (
  `participation_id` int(11) NOT NULL,
  `event_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `participation_status` text DEFAULT NULL,
  `p_name` text NOT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `participate_master`
--

INSERT INTO `participate_master` (`participation_id`, `event_id`, `user_id`, `participation_status`, `p_name`, `status`) VALUES
(38, 20, 34, 'Accepted', 'Bipassa ', 2),
(42, 21, 34, 'Accepted', 'drashti', 1),
(43, 15, 34, 'Accepted', 'hetvi', 3);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL,
  `payment_amount` text DEFAULT NULL,
  `payment_date` text DEFAULT NULL,
  `payment_status` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `user_id`, `event_id`, `payment_amount`, `payment_date`, `payment_status`) VALUES
(1, 1, 1, '900', '1984', 'coa'),
(2, 1, 2, '900', '1984', 'coa'),
(3, 1, 1, '10000', '1985', 'coa'),
(4, 1, 3, '500', '1984', 'coa'),
(5, 1, 3, '500', '1984', 'coa'),
(6, 1, 1, '10000', '2009', 'coa'),
(7, 1, 1, '10000', '1987', 'coa'),
(8, 1, 1, '10000', '2004', 'coa'),
(9, 1, 4, '700', '1989', 'coa'),
(10, 1, 3, '500', '2011', 'coa'),
(11, 1, 6, '200', '1997', 'coa'),
(12, 9, 9, '1500', '2003', 'upi'),
(13, 9, 9, '1500', '1996', 'upi'),
(14, 11, 11, '500', '1993', 'coa'),
(15, 13, 11, '500', '2000', 'upi'),
(16, 13, 11, '500', '2000', 'coa'),
(17, 13, 11, '500', '2005', 'coa'),
(18, 13, 11, '500', '2004', 'upi'),
(19, 14, 11, '500', '1995', 'upi'),
(20, 17, 12, '2558', '2001', 'coa'),
(21, 14, 12, '2558', '1993', 'upi'),
(22, 17, 13, '52000', '2001', 'coa'),
(23, 17, 11, '500', '1990', 'coa'),
(24, 18, 15, '800', '1982', 'coa'),
(25, 23, 11, '500', '1989', 'upi'),
(26, 24, 11, '500', '1994', 'card'),
(27, 25, 15, '800', '1994', 'card'),
(28, 26, 11, '500', '2012', 'card'),
(29, 25, 17, '900', '2013', 'upi'),
(30, 27, 11, '500', '2013', 'upi'),
(31, 28, 15, '800', '1996', 'upi'),
(32, 28, 11, '500', '1993', 'card'),
(33, 28, 18, '1000', '2007', 'coa'),
(34, 33, 19, '800', '2009', 'card'),
(35, 35, 20, '1000', '2012', 'card'),
(36, 34, 21, '900', '2012', 'card'),
(37, 34, 20, '1000', '1994', 'card'),
(38, 34, 20, '1000', '1994', 'upi'),
(39, 34, 21, '900', '2017', 'upi'),
(40, 34, 15, '800', '1998', 'upi'),
(41, 34, 21, '900', '2008', 'upi'),
(42, 34, 21, '900', '2002', 'upi'),
(43, 34, 15, '800', '2004', 'upi');

-- --------------------------------------------------------

--
-- Table structure for table `user_master`
--

CREATE TABLE `user_master` (
  `user_id` int(11) NOT NULL,
  `user_name` text DEFAULT NULL,
  `user_email` text DEFAULT NULL,
  `user_password` text DEFAULT NULL,
  `user_address` text DEFAULT NULL,
  `user_age` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_master`
--

INSERT INTO `user_master` (`user_id`, `user_name`, `user_email`, `user_password`, `user_address`, `user_age`) VALUES
(29, 'Hetvi', 'hetvigothana@gmail.com', '12345', 'ankleshwer', ''),
(32, 'bipasha', 'bipa@gmail.com', '345678', 'bharuch ', ''),
(34, 'bipasa', 'bipa@gmail.com', '123456789', 'vapi', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_master`
--
ALTER TABLE `admin_master`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `audience`
--
ALTER TABLE `audience`
  ADD PRIMARY KEY (`a_id`);

--
-- Indexes for table `event_master`
--
ALTER TABLE `event_master`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `feedback_website`
--
ALTER TABLE `feedback_website`
  ADD PRIMARY KEY (`f_id`);

--
-- Indexes for table `participate_master`
--
ALTER TABLE `participate_master`
  ADD PRIMARY KEY (`participation_id`),
  ADD KEY `event_id` (`event_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `user_master`
--
ALTER TABLE `user_master`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `audience`
--
ALTER TABLE `audience`
  MODIFY `a_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `event_master`
--
ALTER TABLE `event_master`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `feedback_website`
--
ALTER TABLE `feedback_website`
  MODIFY `f_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `participate_master`
--
ALTER TABLE `participate_master`
  MODIFY `participation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `user_master`
--
ALTER TABLE `user_master`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
